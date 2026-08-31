<?php
namespace App\Controllers;

use App\Models\FuncionarioModel;
use App\Models\CameraModel;
use App\Models\FunEpi;
use App\Models\EpiModel;
use App\Models\OcorrenciaModel;
use App\Models\FunOcorrenciaModel;

class AnaliseEpiController extends BaseController
{
    /**
     * =========================================================
     * TELA DE ANÁLISE
     * =========================================================
     */
    public function index()
    {
        if (!session()->get('logado_fun')) {
            return redirect()->to('/loginfun');
        }

        $cpf = session()->get('cpf_fun');

        if (!$cpf) {
            return redirect()->to('/loginfun');
        }

        $funcionarioModel = new FuncionarioModel();
        $cameraModel = new CameraModel();

        /*
         * Busca o funcionário logado.
         */
        $funcionario = $funcionarioModel->find($cpf);

        if (!$funcionario) {
            session()->destroy();

            return redirect()
                ->to('/loginfun')
                ->with('erro', 'Funcionário não encontrado.');
        }

        /*
         * Busca as câmeras do setor do funcionário.
         */
        $cameras = $cameraModel
            ->where('FK_ID_SETOR', $funcionario['FK_ID_SETOR'])
            ->where('FK_CNPJ_EMPRESA', $funcionario['FK_CNPJ_EMPRESA'])
            ->findAll();

        return view('sistema/analise_epi/index', [
            'funcionario' => $funcionario,
            'cameras' => $cameras
        ]);
    }


    /**
     * =========================================================
     * ANALISAR IMAGEM
     * =========================================================
     */
    public function analisar()
    {
        /*
         * =====================================================
         * 1. VERIFICAR FUNCIONÁRIO LOGADO
         * =====================================================
         */

        if (!session()->get('logado_fun')) {

            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status' => false,
                    'mensagem' => 'Funcionário não autenticado.'
                ]);
        }

        $cpf = session()->get('cpf_fun');

        if (!$cpf) {

            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status' => false,
                    'mensagem' => 'CPF do funcionário não encontrado na sessão.'
                ]);
        }


        /*
         * =====================================================
         * 2. PEGAR DADOS ENVIADOS
         * =====================================================
         */

        $dados = $this->request->getJSON(true);

        $imagem = $dados['imagem'] ?? '';
        $cameraId = $dados['camera_id'] ?? null;


        if (empty($imagem)) {

            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => false,
                    'mensagem' => 'Imagem não recebida.'
                ]);
        }


        /*
         * =====================================================
         * 3. BUSCAR FUNCIONÁRIO
         * =====================================================
         */

        $funcionarioModel = new FuncionarioModel();

        $funcionario = $funcionarioModel->find($cpf);

        if (!$funcionario) {

            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status' => false,
                    'mensagem' => 'Funcionário não encontrado.'
                ]);
        }


        /*
         * =====================================================
         * 4. BUSCAR CÂMERA
         * =====================================================
         */

        $cameraModel = new CameraModel();

        /*
         * Se o frontend mandar uma câmera específica,
         * usamos essa câmera.
         *
         * Caso contrário, pegamos a primeira câmera
         * pertencente ao setor do funcionário.
         */

        if ($cameraId) {

            $camera = $cameraModel
                ->where('ID', $cameraId)
                ->where(
                    'FK_ID_SETOR',
                    $funcionario['FK_ID_SETOR']
                )
                ->where(
                    'FK_CNPJ_EMPRESA',
                    $funcionario['FK_CNPJ_EMPRESA']
                )
                ->first();

        } else {

            $camera = $cameraModel
                ->where(
                    'FK_ID_SETOR',
                    $funcionario['FK_ID_SETOR']
                )
                ->where(
                    'FK_CNPJ_EMPRESA',
                    $funcionario['FK_CNPJ_EMPRESA']
                )
                ->first();
        }


        if (!$camera) {

            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status' => false,
                    'mensagem' =>
                        'Nenhuma câmera cadastrada para o setor deste funcionário.'
                ]);
        }


        /*
         * =====================================================
         * 5. BUSCAR EPIs DO FUNCIONÁRIO
         * =====================================================
         */

        $funEpiModel = new FunEpi();
        $epiModel = new EpiModel();

        $relacoesEpi = $funEpiModel
            ->where(
                'FK_FUNCIONARIO_CPF',
                $cpf
            )
            ->findAll();


        /*
         * IDs dos EPIs.
         */
        $idsEpi = [];

        foreach ($relacoesEpi as $relacao) {

            if (!empty($relacao['FK_EPI_ID'])) {

                $idsEpi[] = $relacao['FK_EPI_ID'];

            }
        }


        /*
         * Se o funcionário não possui nenhum EPI cadastrado,
         * não existe o que comparar.
         */

        if (empty($idsEpi)) {

            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'status' => false,
                    'mensagem' =>
                        'Nenhum EPI foi cadastrado para este funcionário.'
                ]);
        }


        /*
         * Busca os EPIs.
         */
        $episFuncionario = $epiModel
            ->whereIn('ID', $idsEpi)
            ->findAll();


        if (empty($episFuncionario)) {

            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'status' => false,
                    'mensagem' =>
                        'Não foi possível encontrar os EPIs cadastrados para o funcionário.'
                ]);
        }


        /*
         * =====================================================
         * 6. CHAMAR ROBOFLOW
         * =====================================================
         */

        try {

            $resultadoIA =
                $this->analisarComRoboflow($imagem);

        } catch (\Throwable $erro) {

            log_message(
                'error',
                'Erro na análise Roboflow: ' .
                $erro->getMessage()
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status' => false,
                    'mensagem' => 'Erro ao realizar análise da IA.',
                    'erro' => $erro->getMessage()
                ]);
        }


        /*
         * =====================================================
         * 7. PEGAR PREDICTIONS
         * =====================================================
         */

        $predictions =
            $resultadoIA['predictions']
            ?? [];


        /*
         * =====================================================
         * 8. TRANSFORMAR DETECÇÕES DA IA
         * =====================================================
         */

        $classesDetectadas = [];

        foreach ($predictions as $prediction) {

            $classe = strtolower(
                trim(
                    $prediction['class']
                    ?? $prediction['class_name']
                    ?? ''
                )
            );

            if ($classe !== '') {

                $classesDetectadas[] =
                    $this->normalizarEpi($classe);

            }
        }

        /*
         * Remove duplicados.
         */
        $classesDetectadas =
            array_values(
                array_unique($classesDetectadas)
            );


        /*
         * =====================================================
         * 9. COMPARAR SOMENTE OS EPIs DO FUNCIONÁRIO
         * =====================================================
         */

        $episDetectados = [];
        $episAusentes = [];

        $resultadoEpis = [];


        foreach ($episFuncionario as $epi) {

            $nomeEpiBanco =
                $epi['NOME_EPI'] ?? '';

            $nomeNormalizado =
                $this->normalizarEpi($nomeEpiBanco);


            /*
             * A IA detectou esse EPI?
             */
            $detectado =
                in_array(
                    $nomeNormalizado,
                    $classesDetectadas,
                    true
                );


            if ($detectado) {

                $episDetectados[] =
                    $nomeEpiBanco;

            } else {

                $episAusentes[] =
                    $nomeEpiBanco;

            }


            $resultadoEpis[] = [

                'id' =>
                    $epi['ID'],

                'nome' =>
                    $nomeEpiBanco,

                'detectado' =>
                    $detectado

            ];
        }


        /*
         * =====================================================
         * 10. DEFINIR STATUS
         * =====================================================
         */

        $irregular =
            !empty($episAusentes);

        $status =
            $irregular
                ? 'Irregular'
                : 'Conforme';


        /*
         * =====================================================
         * 11. SALVAR OCORRÊNCIA
         * =====================================================
         */

        $ocorrenciaModel =
            new OcorrenciaModel();


        $idOcorrencia =
            $ocorrenciaModel->insert([

                'DATA_ANALISE' =>
                    date('Y-m-d'),

                'HORA_ANALISE' =>
                    date('H:i:s'),

                'EPIS_DETECTADOS' =>
                    empty($episDetectados)
                        ? 'Nenhum'
                        : implode(
                            ', ',
                            $episDetectados
                        ),

                'EPIS_AUSENTE' =>
                    empty($episAusentes)
                        ? 'Nenhum'
                        : implode(
                            ', ',
                            $episAusentes
                        ),

                'STATUS_OCORRENCIA' =>
                    $status,

                'FK_ID_CAMERA' =>
                    $camera['ID']

            ]);


        if (!$idOcorrencia) {

            throw new \Exception(
                'Não foi possível salvar a ocorrência.'
            );
        }


        /*
         * =====================================================
         * 12. RELACIONAR FUNCIONÁRIO À OCORRÊNCIA
         * =====================================================
         */

        $funOcorrenciaModel =
            new FunOcorrenciaModel();


        $vinculoSalvo =
            $funOcorrenciaModel->insert([

                'FK_FUNCIONARIO_CPF' =>
                    $cpf,

                'FK_ID_OCORRENCIA' =>
                    $idOcorrencia

            ]);


        if (!$vinculoSalvo) {

            throw new \Exception(
                'Ocorrência criada, mas não foi possível vincular o funcionário.'
            );
        }


        /*
         * =====================================================
         * 13. RETORNO
         * =====================================================
         */

        return $this->response->setJSON([

            'status' => true,

            'mensagem' =>
                $irregular
                    ? 'EPI irregular detectado.'
                    : 'Todos os EPIs obrigatórios foram detectados.',

            'funcionario' => [

                'cpf' =>
                    $funcionario['CPF'],

                'nome' =>
                    $funcionario['NOME_COMPLETO'],

                'setor_id' =>
                    $funcionario['FK_ID_SETOR']

            ],

            'camera' => [

                'id' =>
                    $camera['ID'],

                'identificador' =>
                    $camera['IDENTIFICADOR_CAMERA']

            ],

            'epis' =>
                $resultadoEpis,

            'epis_detectados' =>
                $episDetectados,

            'epis_ausentes' =>
                $episAusentes,

            'ocorrencia' => [

                'id' =>
                    $idOcorrencia,

                'status' =>
                    $status

            ]

        ]);
    }


    /**
     * =========================================================
     * NORMALIZAR NOME DO EPI
     * =========================================================
     */
    private function normalizarEpi(string $nome): string
    {
        $nome = strtolower(trim($nome));

        $nome = str_replace(
            [
                'á',
                'à',
                'ã',
                'â',
                'é',
                'ê',
                'í',
                'ó',
                'ô',
                'õ',
                'ú',
                'ç'
            ],
            [
                'a',
                'a',
                'a',
                'a',
                'e',
                'e',
                'i',
                'o',
                'o',
                'o',
                'u',
                'c'
            ],
            $nome
        );

        return $nome;
    }


    /**
     * =========================================================
     * CHAMAR ROBOFLOW
     * =========================================================
     */
    private function analisarComRoboflow(string $imagem)
    {
        $apiKey = env('ROBOFLOW_API_KEY');

        if (empty($apiKey)) {

            throw new \Exception(
                'ROBOFLOW_API_KEY não configurada no .env.'
            );
        }


        $url =
            'https://serverless.roboflow.com/' .
            'nexaepi/workflows/nexa-epi';


        $client = \Config\Services::curlrequest();


        $resposta = $client->post(
            $url,
            [
                'headers' => [
                    'Content-Type' =>
                        'application/json'
                ],

                'query' => [
                    'api_key' =>
                        $apiKey
                ],

                'json' => [
                    'inputs' => [
                        'image' => [
                            'type' =>
                                'base64',
                            'value' =>
                                preg_replace(
                                    '#^data:image/\w+;base64,#i',
                                    '',
                                    $imagem
                                )
                        ]
                    ]
                ],

                'http_errors' => false,

                'timeout' => 60
            ]
        );


        $statusCode =
            $resposta->getStatusCode();

        $corpo =
            $resposta->getBody();


        if ($statusCode < 200 || $statusCode >= 300) {

            throw new \Exception(
                'Roboflow retornou HTTP ' .
                $statusCode .
                ': ' .
                $corpo
            );
        }


        $resultado =
            json_decode(
                $corpo,
                true
            );


        if (!is_array($resultado)) {

            throw new \Exception(
                'Resposta inválida da Roboflow.'
            );
        }


        return $resultado;
    }
}