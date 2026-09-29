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
    /*
     * =========================================================
     * CONFIGURAÇÕES DA ANÁLISE
     * =========================================================
     */

    /**
     * Confiança mínima para uma detecção entrar na análise.
     *
     * Não colocamos muito alto porque alguns EPIs podem ser
     * reconhecidos com confiança menor dependendo da distância.
     */
    private const CONFIANCA_MINIMA = 0.35;


    /**
     * Confiança mínima preferencial.
     *
     * Detecções acima disso recebem uma pontuação melhor.
     */
    private const CONFIANCA_PREFERENCIAL = 0.50;


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
         * =====================================================
         * BUSCAR FUNCIONÁRIO
         * =====================================================
         */

        $funcionario = $funcionarioModel->find($cpf);

        if (!$funcionario) {

            session()->destroy();

            return redirect()
                ->to('/loginfun')
                ->with(
                    'erro',
                    'Funcionário não encontrado.'
                );
        }


        /*
         * =====================================================
         * BUSCAR CÂMERAS DO SETOR
         * =====================================================
         */

        $cameras = $cameraModel
            ->where(
                'FK_ID_SETOR',
                $funcionario['FK_ID_SETOR']
            )
            ->where(
                'FK_CNPJ_EMPRESA',
                $funcionario['FK_CNPJ_EMPRESA']
            )
            ->findAll();


        /*
         * =====================================================
         * BUSCAR EPIs OBRIGATÓRIOS
         * =====================================================
         */

        $relacoesEpi = $funEpiModel
            ->where(
                'FK_FUNCIONARIO_CPF',
                $cpf
            )
            ->findAll();


        $idsEpi = [];

        foreach ($relacoesEpi as $relacao) {

            if (!empty($relacao['FK_EPI_ID'])) {

                $idsEpi[] =
                    $relacao['FK_EPI_ID'];
            }
        }


        $episObrigatorios = [];


        if (!empty($idsEpi)) {

            $episObrigatorios =
                $epiModel
                    ->whereIn(
                        'ID',
                        $idsEpi
                    )
                    ->findAll();
        }


        /*
         * =====================================================
         * ENVIAR PARA A VIEW
         * =====================================================
         */

        return view(
            'sistema/analise_epi/index',
            [
                'funcionario' =>
                    $funcionario,

                'cameras' =>
                    $cameras,

                'episObrigatorios' =>
                    $episObrigatorios
            ]
        );
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
                    'status' =>
                        false,

                    'mensagem' =>
                        'Funcionário não autenticado.'
                ]);
        }


        $cpf =
            session()->get('cpf_fun');


        if (!$cpf) {

            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status' =>
                        false,

                    'mensagem' =>
                        'CPF do funcionário não encontrado na sessão.'
                ]);
        }


        /*
         * =====================================================
         * 2. PEGAR DADOS ENVIADOS
         * =====================================================
         */

        $dados =
            $this->request->getJSON(true);


        $imagem =
            $dados['imagem'] ?? '';


        $cameraId =
            $dados['camera_id'] ?? null;

        /*
         * modo:
         * - monitoramento = análise ao vivo, sem criar ocorrência
         * - final = análise final, cria a ocorrência normalmente
         */
        $modo =
            $dados['modo'] ?? 'final';

        if (!in_array($modo, ['monitoramento', 'final'], true)) {
            $modo = 'final';
        }


        if (empty($imagem)) {

            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' =>
                        false,

                    'mensagem' =>
                        'Imagem não recebida.'
                ]);
        }


        /*
         * =====================================================
         * 3. BUSCAR FUNCIONÁRIO
         * =====================================================
         */

        $funcionarioModel =
            new FuncionarioModel();


        $funcionario =
            $funcionarioModel->find($cpf);


        if (!$funcionario) {

            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status' =>
                        false,

                    'mensagem' =>
                        'Funcionário não encontrado.'
                ]);
        }


        /*
         * =====================================================
         * 4. BUSCAR CÂMERA
         * =====================================================
         */

        $cameraModel =
            new CameraModel();


        if ($cameraId) {

            $camera =
                $cameraModel
                    ->where(
                        'ID',
                        $cameraId
                    )
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

            $camera =
                $cameraModel
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
                    'status' =>
                        false,

                    'mensagem' =>
                        'Nenhuma câmera cadastrada para o setor deste funcionário.'
                ]);
        }


        /*
         * =====================================================
         * 5. BUSCAR EPIs DO FUNCIONÁRIO
         * =====================================================
         */

        $funEpiModel =
            new FunEpi();

        $epiModel =
            new EpiModel();


        $relacoesEpi =
            $funEpiModel
                ->where(
                    'FK_FUNCIONARIO_CPF',
                    $cpf
                )
                ->findAll();


        $idsEpi = [];


        foreach ($relacoesEpi as $relacao) {

            if (!empty($relacao['FK_EPI_ID'])) {

                $idsEpi[] =
                    $relacao['FK_EPI_ID'];
            }
        }


        if (empty($idsEpi)) {

            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'status' =>
                        false,

                    'mensagem' =>
                        'Nenhum EPI foi cadastrado para este funcionário.'
                ]);
        }


        /*
         * =====================================================
         * BUSCAR EPIs
         * =====================================================
         */

        $episFuncionario =
            $epiModel
                ->whereIn(
                    'ID',
                    $idsEpi
                )
                ->findAll();


        if (empty($episFuncionario)) {

            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'status' =>
                        false,

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
                $this->analisarComRoboflow(
                    $imagem
                );

        } catch (\Throwable $erro) {

            log_message(
                'error',
                'ERRO NA ANÁLISE ROBOFLOW: ' .
                $erro->getMessage()
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status' =>
                        false,

                    'mensagem' =>
                        'Erro ao realizar análise da IA.',

                    'erro' =>
                        $erro->getMessage()
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
         * CLASSES IGNORADAS
         * =====================================================
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


        /*
         * =====================================================
         * LOG COMPLETO DA ROBOFLOW
         * =====================================================
         */

        log_message(
            'error',
            '====================================================='
        );

        log_message(
            'error',
            'NEXA - NOVA ANÁLISE DE EPI'
        );

        log_message(
            'error',
            'TOTAL DE PREDICTIONS: ' .
            count($predictions)
        );


        /*
         * Mostrar todas as classes com confiança.
         */

        foreach ($predictions as $indice => $prediction) {

            $classe =
                $prediction['class']
                ?? $prediction['class_name']
                ?? '';

            $confianca =
                (float) (
                    $prediction['confidence']
                    ?? $prediction['score']
                    ?? 0
                );


            log_message(
                'error',
                'ROBOFLOW #' .
                ($indice + 1) .
                ' => ' .
                $classe .
                ' | confiança=' .
                round(
                    $confianca * 100,
                    2
                ) .
                '%' .
                ' | x=' .
                ($prediction['x'] ?? 0) .
                ' | y=' .
                ($prediction['y'] ?? 0) .
                ' | w=' .
                ($prediction['width'] ?? 0) .
                ' | h=' .
                ($prediction['height'] ?? 0)
            );
        }


        /*
         * =====================================================
         * 8. PESSOAS / CABEÇAS / FACES / ORELHAS
         * =====================================================
         *
         * Essas detecções serão utilizadas para descobrir
         * onde o EPI deveria estar.
         */

        $pessoas = [];
        $cabecas = [];
        $faces = [];
        $orelhas = [];


        foreach ($predictions as $prediction) {

            $classe =
                strtolower(
                    trim(
                        $prediction['class']
                        ?? $prediction['class_name']
                        ?? ''
                    )
                );


            if ($classe === 'person') {

                $pessoas[] =
                    $prediction;

            } elseif ($classe === 'head') {

                $cabecas[] =
                    $prediction;

            } elseif ($classe === 'face') {

                $faces[] =
                    $prediction;

            } elseif ($classe === 'ear') {

                $orelhas[] =
                    $prediction;
            }
        }


        /*
         * =====================================================
         * 9. COMPARAR SOMENTE EPIs DO FUNCIONÁRIO
         * =====================================================
         */

        $episDetectados = [];

        $episAusentes = [];

        $resultadoEpis = [];

        $detecoesEpi = [];


        foreach ($episFuncionario as $epi) {

            $nomeEpiBanco =
                $epi['NOME_EPI']
                ?? '';


            $nomeNormalizado =
                $this->normalizarEpi(
                    $nomeEpiBanco
                );


            /*
             * =================================================
             * ENCONTRAR MELHOR DETECÇÃO
             * =================================================
             */

            $melhor =
                $this->encontrarMelhorDeteccao(
                    $nomeNormalizado,
                    $predictions,
                    $pessoas,
                    $cabecas,
                    $faces,
                    $orelhas,
                    $classesIgnoradas
                );


            $deteccaoEncontrada =
                $melhor['deteccao'];


            $detectado =
                $melhor['detectado'];


            /*
             * =================================================
             * RESULTADO DO EPI
             * =================================================
             */

            if ($detectado) {

                $episDetectados[] =
                    $nomeEpiBanco;

            } else {

                $episAusentes[] =
                    $nomeEpiBanco;
            }


            /*
             * Guardar detecção.
             */

            if ($detectado) {

                $detecoesEpi[] = [

                    'nome' =>
                        $nomeEpiBanco,

                    'confianca' =>
                        $deteccaoEncontrada['confianca']
                        ?? 0,

                    'pontuacao' =>
                        $deteccaoEncontrada['pontuacao']
                        ?? 0

                ];
            }


            /*
             * =================================================
             * RESULTADO INDIVIDUAL
             * =================================================
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
         * LOG FINAL
         * =====================================================
         */

        log_message(
            'error',
            'NEXA - EPIs CONSIDERADOS COMO DETECTADOS: ' .
            json_encode(
                $episDetectados,
                JSON_UNESCAPED_UNICODE
            )
        );


        log_message(
            'error',
            'NEXA - EPIs CONSIDERADOS AUSENTES: ' .
            json_encode(
                $episAusentes,
                JSON_UNESCAPED_UNICODE
            )
        );


        log_message(
            'error',
            '====================================================='
        );


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
         * 11. MODO MONITORAMENTO
         * =====================================================
         *
         * Durante os primeiros segundos a câmera envia vários
         * frames. Esses frames NÃO podem criar ocorrências,
         * senão uma única análise geraria dezenas de registros.
         *
         * O monitoramento devolve apenas as detecções para a tela.
         * A ocorrência só é criada no modo "final".
         */

        if ($modo === 'monitoramento') {

            return $this->response->setJSON([

                'status' =>
                    true,

                'modo' =>
                    'monitoramento',

                'mensagem' =>
                    $irregular
                        ? 'Monitoramento: há EPI(s) não confirmados neste frame.'
                        : 'Monitoramento: EPIs confirmados neste frame.',

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

                'ocorrencia' =>
                    null

            ]);
        }


        /*
         * =====================================================
         * 12. SALVAR OCORRÊNCIA
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
         * 12. RELACIONAR FUNCIONÁRIO
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

            'status' =>
                true,

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
     * ENCONTRAR MELHOR DETECÇÃO PARA QUALQUER EPI
     * =========================================================
     *
     * Essa é a parte principal da correção.
     *
     * Não pega mais a primeira detecção.
     *
     * Analisa TODAS as detecções daquele EPI e calcula:
     *
     * - confiança;
     * - posição;
     * - relação com pessoa;
     * - relação com cabeça;
     * - relação com rosto;
     * - relação com orelha;
     * - região esperada do corpo.
     *
     */
    private function encontrarMelhorDeteccao(
        string $nomeEpi,
        array $predictions,
        array $pessoas,
        array $cabecas,
        array $faces,
        array $orelhas,
        array $classesIgnoradas
    ): array {

        /*
         * =========================================================
         * OBJETIVO
         * =========================================================
         *
         * Não pegar a primeira detecção.
         *
         * Todas as detecções que correspondem ao EPI são avaliadas.
         *
         * A confiança do Roboflow é o fator PRINCIPAL.
         * A posição é usada como reforço, e não como bloqueio.
         *
         * Isso evita que um EPI corretamente reconhecido seja marcado
         * como ausente apenas porque person/head/face não apareceu
         * naquele frame.
         */

        $melhorDeteccao = null;
        $melhorPontuacao = -INF;
        $candidatos = 0;

        foreach ($predictions as $indice => $prediction) {

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
             * Ignorar classes que não são EPIs.
             */
            if (in_array($classe, $classesIgnoradas, true)) {
                continue;
            }

            /*
             * Normalizar classe da Roboflow.
             */
            $classeNormalizada = $this->normalizarEpi($classe);

            /*
             * Verificar se corresponde ao EPI obrigatório.
             */
            if ($classeNormalizada !== $nomeEpi) {
                continue;
            }

            /*
             * Confiança retornada pelo Roboflow.
             */
            $confianca = (float) (
                $prediction['confidence']
                ?? $prediction['score']
                ?? 0
            );

            /*
             * Descartar somente detecções realmente muito fracas.
             *
             * Não aumentamos esse valor porque objetos pequenos,
             * como luvas e protetores auriculares, podem ter uma
             * confiança menor dependendo da distância da câmera.
             */
            if ($confianca < self::CONFIANCA_MINIMA) {

                log_message(
                    'error',
                    'NEXA - DETECÇÃO IGNORADA POR BAIXA CONFIANÇA: ' .
                    $classe .
                    ' = ' .
                    round($confianca * 100, 2) .
                    '%'
                );

                continue;
            }

            $candidatos++;

            /*
             * =====================================================
             * PONTUAÇÃO
             * =====================================================
             *
             * A confiança é o fator principal.
             * A posição acrescenta no máximo 20 pontos.
             *
             * Assim:
             *
             * 90% confiança -> muito forte
             * 75% confiança -> forte
             * 60% confiança -> boa
             * 50% confiança -> aceitável
             *
             * A posição pode desempatar duas detecções do mesmo EPI.
             */
            $relacaoPosicional = $this->calcularPontuacaoEpi(
                $nomeEpi,
                $prediction,
                $confianca,
                $pessoas,
                $cabecas,
                $faces,
                $orelhas
            );

            $pontuacao = ($confianca * 80) + ($relacaoPosicional * 20);

            /*
             * Não deixar passar de 100.
             */
            $pontuacao = min(100, max(0, $pontuacao));

            log_message(
                'error',
                'NEXA - CANDIDATO EPI [' .
                $nomeEpi .
                '] #' .
                ($indice + 1) .
                ' => ' .
                $classe .
                ' | confiança=' .
                round($confianca * 100, 2) .
                '% | posição=' .
                round($relacaoPosicional * 100, 2) .
                '% | pontuação=' .
                round($pontuacao, 2) .
                '% | x=' .
                ($prediction['x'] ?? 0) .
                ' | y=' .
                ($prediction['y'] ?? 0)
            );

            /*
             * Escolher a maior pontuação.
             *
             * Em caso de confiança muito próxima, a posição ajuda
             * a escolher a detecção mais coerente com a pessoa.
             */
            if (
                $melhorDeteccao === null ||
                $pontuacao > $melhorPontuacao
            ) {

                $melhorPontuacao = $pontuacao;

                $melhorDeteccao = [
                    'x' => (float) (
                        $prediction['x'] ?? 0
                    ),

                    'y' => (float) (
                        $prediction['y'] ?? 0
                    ),

                    'width' => (float) (
                        $prediction['width'] ?? 0
                    ),

                    'height' => (float) (
                        $prediction['height'] ?? 0
                    ),

                    'confianca' => $confianca,

                    'pontuacao' => $pontuacao,

                    'posicao' => $relacaoPosicional,

                    'classe_robofflow' => $classe,

                    'metodo' => 'melhor_deteccao_por_confianca_e_posicao'
                ];
            }
        }

        /*
         * =========================================================
         * NENHUM CANDIDATO
         * =========================================================
         */
        if ($melhorDeteccao === null) {

            log_message(
                'error',
                'NEXA - EPI AUSENTE: ' .
                $nomeEpi .
                ' | nenhum candidato válido.'
            );

            return [
                'detectado' => false,
                'deteccao' => null
            ];
        }

        /*
         * =========================================================
         * DECISÃO FINAL
         * =========================================================
         *
         * A confiança passa a ser a principal regra.
         *
         * Regra 1:
         * 50% ou mais -> aceita.
         *
         * Regra 2:
         * entre 40% e 49.99% -> aceita somente se a posição
         * também for muito coerente.
         *
         * Abaixo de 40% -> não aceita.
         *
         * Dessa forma, a posição ajuda os casos difíceis, mas
         * não consegue "inventar" um EPI quando a confiança é baixa.
         */
        $confiancaFinal = $melhorDeteccao['confianca'];
        $pontuacaoFinal = $melhorDeteccao['pontuacao'];
        $posicaoFinal = $melhorDeteccao['posicao'];

        $aceitar = false;

        if ($confiancaFinal >= 0.50) {

            $aceitar = true;

        } elseif (
            $confiancaFinal >= 0.40 &&
            $posicaoFinal >= 0.65 &&
            $pontuacaoFinal >= 45
        ) {

            $aceitar = true;
        }

        log_message(
            'error',
            'NEXA - MELHOR DETECÇÃO [' .
            $nomeEpi .
            '] => ' .
            json_encode(
                [
                    'detectado' => $aceitar,

                    'confianca' => round(
                        $confiancaFinal * 100,
                        2
                    ),

                    'pontuacao' => round(
                        $pontuacaoFinal,
                        2
                    ),

                    'posicao' => round(
                        $posicaoFinal * 100,
                        2
                    ),

                    'classe' =>
                        $melhorDeteccao['classe_robofflow'],

                    'x' =>
                        $melhorDeteccao['x'],

                    'y' =>
                        $melhorDeteccao['y'],

                    'width' =>
                        $melhorDeteccao['width'],

                    'height' =>
                        $melhorDeteccao['height'],

                    'candidatos_validos' =>
                        $candidatos
                ],
                JSON_UNESCAPED_UNICODE
            )
        );

        return [
            'detectado' => $aceitar,

            'deteccao' =>
                $aceitar
                    ? $melhorDeteccao
                    : null
        ];
    }


    /**
     * =========================================================
     * CALCULAR PONTUAÇÃO DO EPI
     * =========================================================
     */
    private function calcularPontuacaoEpi(
        string $nomeEpi,
        array $epi,
        float $confianca,
        array $pessoas,
        array $cabecas,
        array $faces,
        array $orelhas
    ): float {

        /*
         * Esta função NÃO decide se o EPI existe.
         *
         * Ela calcula apenas a coerência da posição.
         * A confiança do Roboflow é tratada separadamente como
         * o principal fator da decisão.
         */

        $melhorPessoa = 0;

        foreach ($pessoas as $pessoa) {

            $relacao = $this->calcularRelacaoCaixa(
                $epi,
                $pessoa
            );

            if ($relacao > $melhorPessoa) {
                $melhorPessoa = $relacao;
            }
        }

        /*
         * Se não houver pessoa, não penalizar a detecção.
         */
        if (empty($pessoas)) {
            $melhorPessoa = 0.50;
        }

        /*
         * Começamos com a relação com a pessoa.
         */
        $pontuacao = $melhorPessoa;

        /*
         * =========================================================
         * CAPACETE
         * =========================================================
         */
        if ($nomeEpi === 'capacete') {

            $relacaoCabeca = $this->melhorRelacaoComRegiao(
                $epi,
                $cabecas
            );

            /*
             * Se não houver head, tentamos usar a face como
             * referência secundária.
             */
            $relacaoFace = $this->melhorRelacaoComRegiao(
                $epi,
                $faces
            );

            $melhorRegiao = max(
                $relacaoCabeca,
                $relacaoFace
            );

            /*
             * Capacete também pode ficar ligeiramente acima da
             * bounding box da cabeça, portanto não exigimos
             * sobreposição perfeita.
             */
            $pontuacao = max(
                $pontuacao,
                $melhorRegiao
            );

            log_message(
                'error',
                'NEXA - POSIÇÃO CAPACETE: ' .
                'relação_cabeça=' .
                round($relacaoCabeca * 100, 2) .
                '% | relação_face=' .
                round($relacaoFace * 100, 2) .
                '%'
            );
        }

        /*
         * =========================================================
         * ÓCULOS
         * =========================================================
         */
        elseif ($nomeEpi === 'oculos de protecao') {

            $relacaoFace = $this->melhorRelacaoComRegiao(
                $epi,
                $faces
            );

            $relacaoCabeca = $this->melhorRelacaoComRegiao(
                $epi,
                $cabecas
            );

            $pontuacao = max(
                $pontuacao,
                $relacaoFace,
                $relacaoCabeca
            );

            log_message(
                'error',
                'NEXA - POSIÇÃO ÓCULOS: ' .
                'relação_face=' .
                round($relacaoFace * 100, 2) .
                '% | relação_cabeça=' .
                round($relacaoCabeca * 100, 2) .
                '%'
            );
        }

        /*
         * =========================================================
         * MÁSCARA
         * =========================================================
         */
        elseif ($nomeEpi === 'mascara') {

            $relacaoFace = $this->melhorRelacaoComRegiao(
                $epi,
                $faces
            );

            $relacaoCabeca = $this->melhorRelacaoComRegiao(
                $epi,
                $cabecas
            );

            $pontuacao = max(
                $pontuacao,
                $relacaoFace,
                $relacaoCabeca
            );

            log_message(
                'error',
                'NEXA - POSIÇÃO MÁSCARA: ' .
                'relação_face=' .
                round($relacaoFace * 100, 2) .
                '% | relação_cabeça=' .
                round($relacaoCabeca * 100, 2) .
                '%'
            );
        }

        /*
         * =========================================================
         * PROTETOR AURICULAR
         * =========================================================
         */
        elseif ($nomeEpi === 'protetor auricular') {

            $relacaoOrelha = $this->melhorRelacaoComRegiao(
                $epi,
                $orelhas
            );

            $relacaoCabeca = $this->melhorRelacaoComRegiao(
                $epi,
                $cabecas
            );

            $pontuacao = max(
                $pontuacao,
                $relacaoOrelha,
                $relacaoCabeca
            );

            log_message(
                'error',
                'NEXA - POSIÇÃO PROTETOR AURICULAR: ' .
                'relação_orelha=' .
                round($relacaoOrelha * 100, 2) .
                '% | relação_cabeça=' .
                round($relacaoCabeca * 100, 2) .
                '%'
            );
        }

        /*
         * =========================================================
         * COLETE
         * =========================================================
         */
        elseif ($nomeEpi === 'colete') {

            $posicaoCorpo = $this->pontuacaoRegiaoCorporal(
                $epi,
                $pessoas,
                'centro'
            );

            $pontuacao = max(
                $pontuacao,
                $posicaoCorpo
            );

            log_message(
                'error',
                'NEXA - POSIÇÃO COLETE: ' .
                round($posicaoCorpo * 100, 2) .
                '%'
            );
        }

        /*
         * =========================================================
         * LUVAS
         * =========================================================
         */
        elseif ($nomeEpi === 'luvas') {

            $posicaoCorpo = $this->pontuacaoRegiaoCorporal(
                $epi,
                $pessoas,
                'lateral'
            );

            $pontuacao = max(
                $pontuacao,
                $posicaoCorpo
            );

            log_message(
                'error',
                'NEXA - POSIÇÃO LUVAS: ' .
                round($posicaoCorpo * 100, 2) .
                '%'
            );
        }

        /*
         * =========================================================
         * BOTAS
         * =========================================================
         */
        elseif ($nomeEpi === 'botas de seguranca') {

            $posicaoCorpo = $this->pontuacaoRegiaoCorporal(
                $epi,
                $pessoas,
                'inferior'
            );

            $pontuacao = max(
                $pontuacao,
                $posicaoCorpo
            );

            log_message(
                'error',
                'NEXA - POSIÇÃO BOTAS: ' .
                round($posicaoCorpo * 100, 2) .
                '%'
            );
        }

        /*
         * Limitar entre 0 e 1.
         */
        return min(
            1,
            max(
                0,
                $pontuacao
            )
        );
    }


    /**
     * =========================================================
     * RELAÇÃO ENTRE DUAS BOUNDING BOXES
     * =========================================================
     */
    private function calcularRelacaoCaixa(
        array $objeto,
        array $referencia
    ): float {

        $objetoX =
            (float) ($objeto['x'] ?? 0);

        $objetoY =
            (float) ($objeto['y'] ?? 0);

        $objetoW =
            (float) ($objeto['width'] ?? 0);

        $objetoH =
            (float) ($objeto['height'] ?? 0);


        $referenciaX =
            (float) ($referencia['x'] ?? 0);

        $referenciaY =
            (float) ($referencia['y'] ?? 0);

        $referenciaW =
            (float) ($referencia['width'] ?? 0);

        $referenciaH =
            (float) ($referencia['height'] ?? 0);


        if (
            $objetoW <= 0 ||
            $objetoH <= 0 ||
            $referenciaW <= 0 ||
            $referenciaH <= 0
        ) {

            return 0;
        }


        /*
         * =====================================================
         * CENTROS
         * =====================================================
         */

        $distanciaX =
            abs(
                $objetoX -
                $referenciaX
            );


        $distanciaY =
            abs(
                $objetoY -
                $referenciaY
            );


        /*
         * Normalizar pela dimensão da referência.
         */

        $distanciaXNormalizada =
            $distanciaX /
            $referenciaW;


        $distanciaYNormalizada =
            $distanciaY /
            $referenciaH;


        /*
         * Quanto menor a distância,
         * maior a pontuação.
         */

        $pontuacaoX =
            max(
                0,
                1 -
                $distanciaXNormalizada
            );


        $pontuacaoY =
            max(
                0,
                1 -
                $distanciaYNormalizada
            );


        /*
         * =====================================================
         * INTERSEÇÃO
         * =====================================================
         */

        $objetoEsquerda =
            $objetoX -
            ($objetoW / 2);


        $objetoDireita =
            $objetoX +
            ($objetoW / 2);


        $objetoTopo =
            $objetoY -
            ($objetoH / 2);


        $objetoBaixo =
            $objetoY +
            ($objetoH / 2);


        $refEsquerda =
            $referenciaX -
            ($referenciaW / 2);


        $refDireita =
            $referenciaX +
            ($referenciaW / 2);


        $refTopo =
            $referenciaY -
            ($referenciaH / 2);


        $refBaixo =
            $referenciaY +
            ($referenciaH / 2);


        $interEsquerda =
            max(
                $objetoEsquerda,
                $refEsquerda
            );


        $interDireita =
            min(
                $objetoDireita,
                $refDireita
            );


        $interTopo =
            max(
                $objetoTopo,
                $refTopo
            );


        $interBaixo =
            min(
                $objetoBaixo,
                $refBaixo
            );


        $interW =
            max(
                0,
                $interDireita -
                $interEsquerda
            );


        $interH =
            max(
                0,
                $interBaixo -
                $interTopo
            );


        $areaIntersecao =
            $interW *
            $interH;


        $areaReferencia =
            $referenciaW *
            $referenciaH;


        $sobreposicao =
            $areaReferencia > 0
                ? $areaIntersecao /
                  $areaReferencia
                : 0;


        /*
         * =====================================================
         * RESULTADO
         * =====================================================
         */

        $resultado =
            ($pontuacaoX * 0.30) +
            ($pontuacaoY * 0.30) +
            ($sobreposicao * 0.40);


        return min(
            1,
            max(
                0,
                $resultado
            )
        );
    }


    /**
     * =========================================================
     * MELHOR RELAÇÃO COM CABEÇA/FACE/ORELHA
     * =========================================================
     */
    private function melhorRelacaoComRegiao(
        array $epi,
        array $regioes
    ): float {

        if (empty($regioes)) {
            return 0;
        }


        $melhor =
            0;


        foreach ($regioes as $regiao) {

            $relacao =
                $this->calcularRelacaoCaixa(
                    $epi,
                    $regiao
                );


            if (
                $relacao >
                $melhor
            ) {

                $melhor =
                    $relacao;
            }
        }


        return $melhor;
    }


    /**
     * =========================================================
     * POSIÇÃO DO EPI DENTRO DA PESSOA
     * =========================================================
     *
     * $regiao:
     *
     * centro
     * lateral
     * inferior
     *
     */
    private function pontuacaoRegiaoCorporal(
        array $epi,
        array $pessoas,
        string $regiao
    ): float {

        if (empty($pessoas)) {
            return 0.5;
        }


        $melhor =
            0;


        foreach ($pessoas as $pessoa) {

            $pessoaX =
                (float) (
                    $pessoa['x']
                    ?? 0
                );


            $pessoaY =
                (float) (
                    $pessoa['y']
                    ?? 0
                );


            $pessoaW =
                (float) (
                    $pessoa['width']
                    ?? 0
                );


            $pessoaH =
                (float) (
                    $pessoa['height']
                    ?? 0
                );


            if (
                $pessoaW <= 0 ||
                $pessoaH <= 0
            ) {

                continue;
            }


            $epiX =
                (float) (
                    $epi['x']
                    ?? 0
                );


            $epiY =
                (float) (
                    $epi['y']
                    ?? 0
                );


            /*
             * Coordenadas relativas dentro da pessoa.
             *
             * 0 = topo
             * 1 = parte inferior
             */

            $relX =
                (
                    $epiX -
                    (
                        $pessoaX -
                        ($pessoaW / 2)
                    )
                ) /
                $pessoaW;


            $relY =
                (
                    $epiY -
                    (
                        $pessoaY -
                        ($pessoaH / 2)
                    )
                ) /
                $pessoaH;


            /*
             * =================================================
             * CENTRO
             * =================================================
             */

            if (
                $regiao ===
                'centro'
            ) {

                $distancia =
                    abs(
                        $relX -
                        0.50
                    );


                $pontuacaoX =
                    max(
                        0,
                        1 -
                        (
                            $distancia * 2
                        )
                    );


                /*
                 * Colete normalmente fica entre
                 * aproximadamente 25% e 70% da altura.
                 */

                $distanciaY =
                    abs(
                        $relY -
                        0.45
                    );


                $pontuacaoY =
                    max(
                        0,
                        1 -
                        (
                            $distanciaY * 2
                        )
                    );


                $pontuacao =
                    (
                        $pontuacaoX *
                        0.40
                    ) +
                    (
                        $pontuacaoY *
                        0.60
                    );
            }


            /*
             * =================================================
             * LATERAL
             * =================================================
             */

            elseif (
                $regiao ===
                'lateral'
            ) {

                /*
                 * Luvas podem ficar dos lados.
                 */

                $distanciaLateral =
                    abs(
                        $relX -
                        0.15
                    );


                $distanciaLateralDireita =
                    abs(
                        $relX -
                        0.85
                    );


                $menorDistancia =
                    min(
                        $distanciaLateral,
                        $distanciaLateralDireita
                    );


                $pontuacaoX =
                    max(
                        0,
                        1 -
                        (
                            $menorDistancia *
                            2
                        )
                    );


                /*
                 * Não exigimos uma altura específica
                 * muito rígida para luvas.
                 */

                $pontuacao =
                    $pontuacaoX * 0.60 +
                    0.40;
            }


            /*
             * =================================================
             * INFERIOR
             * =================================================
             */

            elseif (
                $regiao ===
                'inferior'
            ) {

                /*
                 * Botas devem estar próximas da parte
                 * inferior da pessoa.
                 */

                $distanciaY =
                    abs(
                        $relY -
                        0.90
                    );


                $pontuacaoY =
                    max(
                        0,
                        1 -
                        (
                            $distanciaY * 3
                        )
                    );


                $pontuacao =
                    $pontuacaoY;
            }


            else {

                $pontuacao =
                    0.5;
            }


            /*
             * Verificar também se está dentro da pessoa.
             */

            $dentroPessoa =
                $this->objetoPertenceAPessoa(
                    $epi,
                    $pessoa
                );


            if ($dentroPessoa) {

                $pontuacao =
                    min(
                        1,
                        $pontuacao +
                        0.20
                    );
            }


            if (
                $pontuacao >
                $melhor
            ) {

                $melhor =
                    $pontuacao;
            }
        }


        return min(
            1,
            max(
                0,
                $melhor
            )
        );
    }


    /**
     * =========================================================
     * NORMALIZAR NOME DO EPI
     * =========================================================
     */
    private function normalizarEpi(
        string $nome
    ): string {

        $nome =
            trim(
                mb_strtolower(
                    $nome,
                    'UTF-8'
                )
            );


        /*
         * =====================================================
         * REMOVER ACENTOS
         * =====================================================
         */

        $nome =
            strtr(
                $nome,
                [

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
                ]
            );


        /*
         * Normalizar espaços.
         */

        $nome =
            preg_replace(
                '/\s+/',
                ' ',
                $nome
            );


        /*
         * =====================================================
         * MAPA ROBOFLOW -> NEXA
         * =====================================================
         */

        $mapa = [

            /*
             * CAPACETE
             */

            'hard hat' =>
                'capacete',

            'hardhat' =>
                'capacete',

            'helmet' =>
                'capacete',

            'capacete' =>
                'capacete',


            /*
             * LUVAS
             */

            'gloves' =>
                'luvas',

            'glove' =>
                'luvas',

            'luvas' =>
                'luvas',

            'luva' =>
                'luvas',


            /*
             * ÓCULOS
             */

            'glasses' =>
                'oculos de protecao',

            'glass' =>
                'oculos de protecao',

            'protective glasses' =>
                'oculos de protecao',

            'safety glasses' =>
                'oculos de protecao',

            'safety glass' =>
                'oculos de protecao',

            'oculos' =>
                'oculos de protecao',

            'oculos de protecao' =>
                'oculos de protecao',


            /*
             * BOTAS
             */

            'safety shoes' =>
                'botas de seguranca',

            'safety shoe' =>
                'botas de seguranca',

            'boots' =>
                'botas de seguranca',

            'boot' =>
                'botas de seguranca',

            'botas' =>
                'botas de seguranca',

            'bota' =>
                'botas de seguranca',

            'botas de seguranca' =>
                'botas de seguranca',


            /*
             * MÁSCARA
             */

            'mask' =>
                'mascara',

            'masks' =>
                'mascara',

            'face mask' =>
                'mascara',

            'mascara' =>
                'mascara',


            /*
             * COLETE
             */

            'safety vest' =>
                'colete',

            'vest' =>
                'colete',

            'reflective vest' =>
                'colete',

            'colete' =>
                'colete',


            /*
             * PROTETOR AURICULAR
             */

            'ear muffs' =>
                'protetor auricular',

            'ear muff' =>
                'protetor auricular',

            'ear protection' =>
                'protetor auricular',

            'hearing protection' =>
                'protetor auricular',

            'ear protector' =>
                'protetor auricular',

            'protetor auricular' =>
                'protetor auricular',

            'protetor de orelha' =>
                'protetor auricular'
        ];


        return $mapa[$nome]
            ?? $nome;
    }


    /**
     * =========================================================
     * OBJETO PERTENCE À PESSOA
     * =========================================================
     */
    private function objetoPertenceAPessoa(
        array $epi,
        array $pessoa
    ): bool {

        $pessoaX =
            (float) (
                $pessoa['x']
                ?? 0
            );


        $pessoaY =
            (float) (
                $pessoa['y']
                ?? 0
            );


        $pessoaW =
            (float) (
                $pessoa['width']
                ?? 0
            );


        $pessoaH =
            (float) (
                $pessoa['height']
                ?? 0
            );


        $epiX =
            (float) (
                $epi['x']
                ?? 0
            );


        $epiY =
            (float) (
                $epi['y']
                ?? 0
            );


        if (
            $pessoaW <= 0 ||
            $pessoaH <= 0
        ) {

            return false;
        }


        /*
         * Margens.
         *
         * Aumentamos um pouco principalmente na parte superior,
         * porque o capacete pode ficar acima da bounding box
         * da pessoa.
         */

        $margemHorizontal =
            $pessoaW * 0.10;


        $margemSuperior =
            $pessoaH * 0.20;


        $margemInferior =
            $pessoaH * 0.05;


        $limiteEsquerdo =
            $pessoaX -
            ($pessoaW / 2) -
            $margemHorizontal;


        $limiteDireito =
            $pessoaX +
            ($pessoaW / 2) +
            $margemHorizontal;


        $limiteSuperior =
            $pessoaY -
            ($pessoaH / 2) -
            $margemSuperior;


        $limiteInferior =
            $pessoaY +
            ($pessoaH / 2) +
            $margemInferior;


        return (

            $epiX >=
            $limiteEsquerdo

            &&

            $epiX <=
            $limiteDireito

            &&

            $epiY >=
            $limiteSuperior

            &&

            $epiY <=
            $limiteInferior
        );
    }


    /**
     * =========================================================
     * CHAMAR ROBOFLOW
     * =========================================================
     */
    private function analisarComRoboflow(
        string $imagem
    ) {

        $apiKey =
            trim(
                (string)
                env(
                    'ROBOFLOW_API_KEY'
                )
            );


        if (empty($apiKey)) {

            throw new \Exception(
                'ROBOFLOW_API_KEY não configurada no .env.'
            );
        }


        /*
         * =====================================================
         * MODELO SH17
         * =====================================================
         */

        $modelUrl =
            'https://detect.roboflow.com/' .
            'nexaepi/sh17-hmkpl-p2fiz-1-rfdetr-small-t1';


        /*
         * =====================================================
         * REMOVER PREFIXO BASE64
         * =====================================================
         */

        $imagemBase64 =
            preg_replace(
                '#^data:image/\w+;base64,#i',
                '',
                $imagem
            );


        if (empty($imagemBase64)) {

            throw new \Exception(
                'Imagem Base64 inválida.'
            );
        }


        /*
         * =====================================================
         * CLIENTE
         * =====================================================
         */

        $client =
            \Config\Services::curlrequest();


        /*
         * =====================================================
         * ENVIAR PARA ROBOFLOW
         * =====================================================
         */

        $resposta =
            $client->post(
                $modelUrl,
                [

                    'headers' => [

                        'Content-Type' =>
                            'application/x-www-form-urlencoded',

                        'Accept' =>
                            'application/json'

                    ],

                    'query' => [

                        'api_key' =>
                            $apiKey

                    ],

                    'body' =>
                        $imagemBase64,

                    'http_errors' =>
                        false,

                    'timeout' =>
                        60,

                    'connect_timeout' =>
                        15
                ]
            );


        /*
         * =====================================================
         * RESPOSTA
         * =====================================================
         */

        $statusCode =
            $resposta->getStatusCode();


        $corpo =
            $resposta->getBody();


        log_message(
            'error',
            'ROBOFLOW HTTP ' .
            $statusCode .
            ': ' .
            $corpo
        );


        /*
         * =====================================================
         * VERIFICAR STATUS
         * =====================================================
         */

        if (
            $statusCode < 200 ||
            $statusCode >= 300
        ) {

            throw new \Exception(
                'Roboflow retornou HTTP ' .
                $statusCode .
                ': ' .
                $corpo
            );
        }


        /*
         * =====================================================
         * DECODIFICAR JSON
         * =====================================================
         */

        $resultado =
            json_decode(
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