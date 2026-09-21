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
    $funEpiModel = new FunEpi();
    $epiModel = new EpiModel();

    /*
     * =========================================================
     * BUSCAR FUNCIONÁRIO
     * =========================================================
     */

    $funcionario = $funcionarioModel->find($cpf);

    if (!$funcionario) {

        session()->destroy();

        return redirect()
            ->to('/loginfun')
            ->with('erro', 'Funcionário não encontrado.');
    }


    /*
     * =========================================================
     * BUSCAR CÂMERAS DO SETOR
     * =========================================================
     */

    $cameras = $cameraModel
        ->where('FK_ID_SETOR', $funcionario['FK_ID_SETOR'])
        ->where('FK_CNPJ_EMPRESA', $funcionario['FK_CNPJ_EMPRESA'])
        ->findAll();


    /*
     * =========================================================
     * BUSCAR EPIs OBRIGATÓRIOS DO FUNCIONÁRIO
     * =========================================================
     */

    $relacoesEpi = $funEpiModel
        ->where('FK_FUNCIONARIO_CPF', $cpf)
        ->findAll();


    $idsEpi = [];

    foreach ($relacoesEpi as $relacao) {

        if (!empty($relacao['FK_EPI_ID'])) {

            $idsEpi[] = $relacao['FK_EPI_ID'];

        }
    }


    $episObrigatorios = [];

    if (!empty($idsEpi)) {

        $episObrigatorios = $epiModel
            ->whereIn('ID', $idsEpi)
            ->findAll();

    }


    /*
     * =========================================================
     * ENVIAR PARA A VIEW
     * =========================================================
     */

    return view('sistema/analise_epi/index', [

        'funcionario' => $funcionario,

        'cameras' => $cameras,

        'episObrigatorios' => $episObrigatorios

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
 * PEGAR TODOS OS EPIs DETECTADOS
 * =====================================================
 */

$classesDetectadas = [];


/*
 * Classes que NÃO são EPIs.
 */

$classesIgnoradas = [

    'person',
    'face',
    'head',
    'hands',
    'hand',
    'ear',
    'tool'

];


foreach ($predictions as $prediction) {

    $classe = strtolower(
        trim(
            $prediction['class']
            ?? $prediction['class_name']
            ?? ''
        )
    );


    if (empty($classe)) {
        continue;
    }


    /*
     * Ignora partes do corpo e pessoa.
     */

    if (
        in_array(
            $classe,
            $classesIgnoradas,
            true
        )
    ) {
        continue;
    }


    /*
     * Converte para o padrão NEXA.
     */

    $epiNormalizado =
        $this->normalizarEpi($classe);


    /*
     * Adiciona apenas EPIs conhecidos.
     */

    $classesDetectadas[] =
        $epiNormalizado;

}


/*
 * Remove duplicados.
 */

$classesDetectadas =
    array_values(
        array_unique(
            $classesDetectadas
        )
    );


/*
 * DEBUG
 */

log_message(
    'error',
    'NEXA CONSIDEROU COMO EPI: ' .
    json_encode(
        $classesDetectadas,
        JSON_UNESCAPED_UNICODE
    )
);



            /*
 * =====================================================
 * DEBUG - CLASSES RECEBIDAS DA ROBOFLOW
 * =====================================================
 */

$classesBrutas = [];

foreach ($predictions as $prediction) {

    $classe =
        $prediction['class']
        ?? $prediction['class_name']
        ?? '';

    if ($classe !== '') {

        $classesBrutas[] = $classe;

    }
}

log_message(
    'error',
    'ROBOFLOW DETECTOU: ' .
    json_encode(
        $classesBrutas,
        JSON_UNESCAPED_UNICODE
    )
);

    
        /*
         * =====================================================
         * 9. COMPARAR SOMENTE OS EPIs DO FUNCIONÁRIO
         * =====================================================
         */

        $episDetectados = [];
        $episAusentes = [];

        $resultadoEpis = [];
        $detecoesEpi = [];


       foreach ($episFuncionario as $epi) {

    $nomeEpiBanco =
        $epi['NOME_EPI'] ?? '';

    $nomeNormalizado =
        $this->normalizarEpi($nomeEpiBanco);


    /*
     * =====================================================
     * PROCURAR DETECÇÃO CORRESPONDENTE
     * =====================================================
     */

    $deteccaoEncontrada = null;

    foreach ($predictions as $prediction) {

        $classe =
            strtolower(
                trim(
                    $prediction['class']
                    ?? $prediction['class_name']
                    ?? ''
                )
            );

        if (empty($classe)) {
            continue;
        }


        /*
         * Ignora objetos que não são EPI
         */

        if (
            in_array(
                $classe,
                $classesIgnoradas,
                true
            )
        ) {
            continue;
        }


        $epiDetectadoNormalizado =
            $this->normalizarEpi($classe);


        /*
         * Verifica se é o EPI obrigatório
         */

        if ($epiDetectadoNormalizado !== $nomeNormalizado) {
            continue;
        }


        /*
         * Guarda a primeira detecção encontrada
         */

        $deteccaoEncontrada = [

            'x' =>
                (float) ($prediction['x'] ?? 0),

            'y' =>
                (float) ($prediction['y'] ?? 0),

            'width' =>
                (float) ($prediction['width'] ?? 0),

            'height' =>
                (float) ($prediction['height'] ?? 0),

            'confianca' =>
                (float) (
                    $prediction['confidence']
                    ?? $prediction['score']
                    ?? 0
                )

        ];

        break;
    }


    /*
     * =====================================================
     * VERIFICAR SE FOI DETECTADO
     * =====================================================
     */

    $detectado =
        $deteccaoEncontrada !== null;


    /*
     * =====================================================
     * SE DETECTADO
     * =====================================================
     */

    if ($detectado) {

        $episDetectados[] =
            $nomeEpiBanco;

    } else {

        $episAusentes[] =
            $nomeEpiBanco;

    }


    /*
     * =====================================================
     * RESULTADO
     * =====================================================
     */

    $resultadoEpis[] = [

        'id' =>
            $epi['ID'],

        'nome' =>
            $nomeEpiBanco,

        'detectado' =>
            $detectado,

        'deteccao' =>
            $deteccaoEncontrada

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
    $nome = trim(mb_strtolower($nome, 'UTF-8'));

    // Remove acentos
    $nome = strtr($nome, [
        'á' => 'a',
        'à' => 'a',
        'ã' => 'a',
        'â' => 'a',
        'ä' => 'a',

        'é' => 'e',
        'è' => 'e',
        'ê' => 'e',
        'ë' => 'e',

        'í' => 'i',
        'ì' => 'i',
        'î' => 'i',
        'ï' => 'i',

        'ó' => 'o',
        'ò' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ö' => 'o',

        'ú' => 'u',
        'ù' => 'u',
        'û' => 'u',
        'ü' => 'u',

        'ç' => 'c'
    ]);

    // Normaliza espaços
    $nome = preg_replace('/\s+/', ' ', $nome);

    $mapa = [

        // CAPACETE
        'hard hat' => 'capacete',
        'helmet' => 'capacete',
        'capacete' => 'capacete',

        // LUVAS
        'gloves' => 'luvas',
        'glove' => 'luvas',
        'luvas' => 'luvas',
        'luva' => 'luvas',

        // OCULOS
        'glasses' => 'oculos de protecao',
        'glass' => 'oculos de protecao',
        'protective glasses' => 'oculos de protecao',
        'safety glasses' => 'oculos de protecao',
        'safety glass' => 'oculos de protecao',
        'oculos' => 'oculos de protecao',
        'oculos de protecao' => 'oculos de protecao',

        // BOTAS
        'safety shoes' => 'botas de seguranca',
        'safety shoe' => 'botas de seguranca',
        'boots' => 'botas de seguranca',
        'boot' => 'botas de seguranca',
        'botas' => 'botas de seguranca',
        'botas de seguranca' => 'botas de seguranca',

        // MASCARA
        'mask' => 'mascara',
        'masks' => 'mascara',
        'mascara' => 'mascara',

        // COLETE
        'safety vest' => 'colete',
        'vest' => 'colete',
        'colete' => 'colete',

        // PROTETOR AURICULAR
        'ear muffs' => 'protetor auricular',
        'ear muff' => 'protetor auricular',
        'ear protection' => 'protetor auricular',
        'protetor auricular' => 'protetor auricular'
    ];

    return $mapa[$nome] ?? $nome;
}


private function objetoPertenceAPessoa(
    array $epi,
    array $pessoa
): bool {

    /*
     * Coordenadas da pessoa
     */

    $pessoaX = (float) ($pessoa['x'] ?? 0);
    $pessoaY = (float) ($pessoa['y'] ?? 0);

    $pessoaW = (float) ($pessoa['width'] ?? 0);
    $pessoaH = (float) ($pessoa['height'] ?? 0);


    /*
     * Coordenadas do EPI
     */

    $epiX = (float) ($epi['x'] ?? 0);
    $epiY = (float) ($epi['y'] ?? 0);

    $epiW = (float) ($epi['width'] ?? 0);
    $epiH = (float) ($epi['height'] ?? 0);


    /*
     * Centro do EPI
     */

    $centroEpiX =
        $epiX;

    $centroEpiY =
        $epiY;


    /*
     * Algumas respostas da Roboflow
     * usam x/y como centro da bounding box.
     *
     * Então verificamos o centro diretamente.
     */

    $limiteEsquerdo =
        $pessoaX - ($pessoaW / 2);

    $limiteDireito =
        $pessoaX + ($pessoaW / 2);

    $limiteSuperior =
        $pessoaY - ($pessoaH / 2);

    $limiteInferior =
        $pessoaY + ($pessoaH / 2);


    return (
        $centroEpiX >= $limiteEsquerdo &&
        $centroEpiX <= $limiteDireito &&
        $centroEpiY >= $limiteSuperior &&
        $centroEpiY <= $limiteInferior
    );
}
    /**
     * =========================================================
     * CHAMAR ROBOFLOW
     * =========================================================
     */
private function analisarComRoboflow(string $imagem)
{
    $apiKey = trim((string) env('ROBOFLOW_API_KEY'));

    if (empty($apiKey)) {
        throw new \Exception(
            'ROBOFLOW_API_KEY não configurada no .env.'
        );
    }

    /*
     * MODELO SH17
     */
    $modelUrl =
        'https://detect.roboflow.com/' .
        'nexaepi/sh17-hmkpl-p2fiz-1-rfdetr-small-t1';


    /*
     * Remove o prefixo da imagem Base64.
     */
    $imagemBase64 = preg_replace(
        '#^data:image/\w+;base64,#i',
        '',
        $imagem
    );

    if (empty($imagemBase64)) {
        throw new \Exception(
            'Imagem Base64 inválida.'
        );
    }


    $client = \Config\Services::curlrequest();


    /*
     * Envia a imagem diretamente para o modelo SH17.
     */
    $resposta = $client->post(
        $modelUrl,
        [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json'
            ],

            'query' => [
                'api_key' => $apiKey
            ],

            'body' => $imagemBase64,

            'http_errors' => false,

            'timeout' => 60,

            'connect_timeout' => 15
        ]
    );


    $statusCode = $resposta->getStatusCode();

    $corpo = $resposta->getBody();


    log_message(
        'error',
        'Roboflow HTTP ' .
        $statusCode .
        ': ' .
        $corpo
    );


    if ($statusCode < 200 || $statusCode >= 300) {

        throw new \Exception(
            'Roboflow retornou HTTP ' .
            $statusCode .
            ': ' .
            $corpo
        );
    }


    $resultado = json_decode(
        $corpo,
        true
    );


    if (!is_array($resultado)) {

        throw new \Exception(
            'Resposta inválida da Roboflow: ' .
            $corpo
        );
    }


    return $resultado;
}
}