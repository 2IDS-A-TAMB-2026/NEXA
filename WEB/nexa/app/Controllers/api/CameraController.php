<?php

namespace App\Controllers\api;
date_default_timezone_set('America/Sao_Paulo');

use CodeIgniter\RESTful\ResourceController;
use Config\Database;

class CameraController extends ResourceController
{
    protected $format = 'json';

    /**
     * GET /api/cameras
     */
    public function index()
    {
        $db = Database::connect();

        $builder = $db->table('CAMERA c');

        $builder->select([
            'c.ID',
            'c.STATUS',
            'c.IDENTIFICADOR_CAMERA',
            'c.FK_CNPJ_EMPRESA',
            'c.FK_ID_SETOR',
            'e.NOME AS EMPRESA',
            's.NOME AS SETOR',
            's.LOCAL AS LOCAL_SETOR'
        ]);

        $builder->join(
            'EMPRESA e',
            'e.CNPJ = c.FK_CNPJ_EMPRESA',
            'left'
        );

        $builder->join(
            'SETOR s',
            's.ID = c.FK_ID_SETOR',
            'left'
        );

        $builder->orderBy('c.ID', 'ASC');

        $cameras = $builder->get()->getResultArray();

        return $this->respond([
            'status' => 200,
            'message' => 'Câmeras encontradas com sucesso.',
            'total' => count($cameras),
            'cameras' => $cameras
        ], 200);
    }


    /**
     * GET /api/cameras/{id}
     */
    public function show($id = null)
    {
        if (!$id) {
            return $this->respond([
                'status' => 400,
                'message' => 'ID da câmera não informado.'
            ], 400);
        }

        $db = Database::connect();

        $builder = $db->table('CAMERA c');

        $builder->select([
            'c.ID',
            'c.STATUS',
            'c.IDENTIFICADOR_CAMERA',
            'c.FK_CNPJ_EMPRESA',
            'c.FK_ID_SETOR',
            'e.NOME AS EMPRESA',
            's.NOME AS SETOR',
            's.LOCAL AS LOCAL_SETOR'
        ]);

        $builder->join(
            'EMPRESA e',
            'e.CNPJ = c.FK_CNPJ_EMPRESA',
            'left'
        );

        $builder->join(
            'SETOR s',
            's.ID = c.FK_ID_SETOR',
            'left'
        );

        $builder->where('c.ID', $id);

        $camera = $builder->get()->getRowArray();

        if (!$camera) {
            return $this->respond([
                'status' => 404,
                'message' => 'Câmera não encontrada.'
            ], 404);
        }

        return $this->respond([
            'status' => 200,
            'message' => 'Câmera encontrada com sucesso.',
            'data' => $camera
        ], 200);
    }


    /**
     * POST /api/cameras/{id}/analisar
     *
     * Recebe uma imagem do aplicativo,
     * envia para o Roboflow,
     * verifica os EPIs obrigatórios do funcionário
     * e cria uma ocorrência.
     *
     * JSON esperado:
     *
     * {
     *   "cpf": "00000000000",
     *   "imagem": "BASE64_DA_IMAGEM"
     * }
     */
    public function analisar($id = null)
    {
        if (!$id) {
            return $this->respond([
                'status' => 400,
                'message' => 'ID da câmera não informado.'
            ], 400);
        }

        /*
         * ==========================================================
         * 1. RECEBER JSON DO APP
         * ==========================================================
         */

        $json = $this->request->getJSON(true);

        if (!$json) {
            return $this->respond([
                'status' => 400,
                'message' => 'JSON não enviado.'
            ], 400);
        }

        $cpf = $json['cpf'] ?? null;
        $imagem = $json['imagem'] ?? null;

        if (!$cpf) {
            return $this->respond([
                'status' => 400,
                'message' => 'CPF do funcionário não informado.'
            ], 400);
        }

        if (!$imagem) {
            return $this->respond([
                'status' => 400,
                'message' => 'Imagem não informada.'
            ], 400);
        }


        /*
         * ==========================================================
         * 2. CONECTAR AO BANCO
         * ==========================================================
         */

        $db = Database::connect();


        /*
         * ==========================================================
         * 3. VERIFICAR CÂMERA
         * ==========================================================
         */

        $camera = $db->table('CAMERA')
            ->where('ID', $id)
            ->get()
            ->getRowArray();

        if (!$camera) {
            return $this->respond([
                'status' => 404,
                'message' => 'Câmera não encontrada.'
            ], 404);
        }


        /*
         * ==========================================================
         * 4. BUSCAR FUNCIONÁRIO
         * ==========================================================
         */

        $funcionario = $db->table('FUNCIONARIO')
            ->where('CPF', $cpf)
            ->get()
            ->getRowArray();

        if (!$funcionario) {
            return $this->respond([
                'status' => 404,
                'message' => 'Funcionário não encontrado.'
            ], 404);
        }


        /*
         * ==========================================================
         * 5. BUSCAR EPIs OBRIGATÓRIOS
         * ==========================================================
         *
         * A relação funcionário <-> EPI está em FUN_EPI.
         */

        $episFuncionario = $db->table('FUN_EPI fe')
            ->select('e.NOME_EPI')
            ->join(
                'EPI e',
                'e.ID = fe.FK_EPI_ID',
                'left'
            )
            ->where('fe.FK_FUNCIONARIO_CPF', $cpf)
            ->get()
            ->getResultArray();


        $episObrigatorios = [];

        foreach ($episFuncionario as $epi) {

            if (!empty($epi['NOME_EPI'])) {
                $episObrigatorios[] = $this->normalizarEpi(
                    $epi['NOME_EPI']
                );
            }
        }


        /*
         * ==========================================================
         * 6. PREPARAR IMAGEM
         * ==========================================================
         */

        $imagemRoboflow = $imagem;

        /*
         * Caso o Flutter envie:
         *
         * data:image/jpeg;base64,XXXXXXXX
         *
         * removemos o começo.
         */

        if (strpos($imagemRoboflow, 'base64,') !== false) {

            $imagemRoboflow = substr(
                $imagemRoboflow,
                strpos($imagemRoboflow, 'base64,') + 7
            );
        }


        /*
         * ==========================================================
         * 7. PEGAR API KEY DO ROBOFLOW
         * ==========================================================
         */

        $apiKey = env('ROBOFLOW_API_KEY');

        if (!$apiKey) {

            log_message(
                'error',
                'NEXA: ROBOFLOW_API_KEY não encontrada.'
            );

            return $this->respond([
                'status' => 500,
                'message' => 'Chave da API do Roboflow não configurada.'
            ], 500);
        }


        /*
         * ==========================================================
         * 8. ENVIAR IMAGEM PARA ROBOFLOW
         * ==========================================================
         */

        $url =
            'https://detect.roboflow.com/nexaepi/' .
            'sh17-hmkpl-p2fiz-1-rfdetr-small-t1' .
            '?api_key=' . urlencode($apiKey);


        $ch = curl_init($url);

        curl_setopt_array($ch, [

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_POST => true,

            CURLOPT_POSTFIELDS => $imagemRoboflow,

            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded'
            ],

            CURLOPT_TIMEOUT => 60,

            CURLOPT_CONNECTTIMEOUT => 15
        ]);


        $respostaRoboflow = curl_exec($ch);

        $httpCode = curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );

        $curlErro = curl_error($ch);

        curl_close($ch);


        /*
         * ==========================================================
         * 9. VERIFICAR RESPOSTA DO ROBOFLOW
         * ==========================================================
         */

        if ($respostaRoboflow === false) {

            log_message(
                'error',
                'NEXA ROBOFLOW CURL ERROR: ' . $curlErro
            );

            return $this->respond([
                'status' => 500,
                'message' => 'Erro ao conectar com o Roboflow.',
                'erro' => $curlErro
            ], 500);
        }


        log_message(
            'error',
            'NEXA ROBOFLOW HTTP: ' . $httpCode
        );

        log_message(
            'error',
            'NEXA ROBOFLOW RESPONSE: ' . $respostaRoboflow
        );


        if ($httpCode < 200 || $httpCode >= 300) {

            return $this->respond([
                'status' => 502,
                'message' => 'Roboflow retornou um erro.',
                'http_code' => $httpCode,
                'resposta' => json_decode(
                    $respostaRoboflow,
                    true
                )
            ], 502);
        }


        $resultadoRoboflow = json_decode(
            $respostaRoboflow,
            true
        );


        if (!is_array($resultadoRoboflow)) {

            return $this->respond([
                'status' => 500,
                'message' => 'Resposta inválida do Roboflow.'
            ], 500);
        }


        /*
         * ==========================================================
         * 10. PEGAR PREDICTIONS
         * ==========================================================
         */

        $predictions =
            $resultadoRoboflow['predictions'] ?? [];


            $imagemLargura =
    (float) (
        $resultadoRoboflow['image']['width']
        ?? 0
    );

$imagemAltura =
    (float) (
        $resultadoRoboflow['image']['height']
        ?? 0
    );


 /*
 * ==========================================================
 * 11. IDENTIFICAR EPIs DETECTADOS
 * ==========================================================
 */

$episDetectados = [];
$deteccoesObrigatorias = [];

foreach ($predictions as $prediction) {

    $classe =
        $prediction['class']
        ?? $prediction['class_name']
        ?? null;

    if (!$classe) {
        continue;
    }

    $epiNormalizado =
        $this->normalizarEpi($classe);

    /*
     * Só consideramos classes que são EPIs.
     */
    if (!$this->ehEpi($epiNormalizado)) {
        continue;
    }

    /*
     * Verifica se esse EPI é obrigatório
     * para o funcionário.
     */
    if (
        !in_array(
            $epiNormalizado,
            $episObrigatorios,
            true
        )
    ) {
        continue;
    }

    /*
     * Adiciona à lista de EPIs detectados.
     */
    if (
        !in_array(
            $epiNormalizado,
            $episDetectados,
            true
        )
    ) {
        $episDetectados[] = $epiNormalizado;
    }

    /*
     * Guarda a posição da detecção
     * para desenhar a caixa no Flutter.
     */
    $deteccoesObrigatorias[] = [
        'nome' => $this->formatarNomeEpi(
            $epiNormalizado
        ),

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

        'confidence' => (float) (
            $prediction['confidence'] ?? 0
        ),
    ];
}

/*
 * ==========================================================
 * FILTRAR DETECTADOS
 * SOMENTE EPIs OBRIGATÓRIOS DO FUNCIONÁRIO
 * ==========================================================
 */

$episDetectadosObrigatorios = [];

foreach ($episDetectados as $epiDetectado) {

    $detectadoNormalizado =
        $this->normalizarEpi($epiDetectado);

    foreach ($episObrigatorios as $epiObrigatorio) {

        $obrigatorioNormalizado =
            $this->normalizarEpi($epiObrigatorio);

        if ($detectadoNormalizado === $obrigatorioNormalizado) {

            if (
                !in_array(
                    $epiDetectado,
                    $episDetectadosObrigatorios
                )
            ) {
                $episDetectadosObrigatorios[] =
                    $epiDetectado;
            }

            break;
        }
    }
}

$episDetectados = $episDetectadosObrigatorios;
        /*
         * ==========================================================
         * 12. DESCOBRIR EPIs AUSENTES
         * ==========================================================
         */

  $episAusentes = [];

foreach ($episObrigatorios as $epiObrigatorio) {

    $obrigatorio = $this->normalizarEpi($epiObrigatorio);

    $encontrado = false;

    foreach ($episDetectados as $epiDetectado) {

        $detectado = $this->normalizarEpi($epiDetectado);

        if ($obrigatorio === $detectado) {
            $encontrado = true;
            break;
        }
    }

    if (!$encontrado) {
        $episAusentes[] = $epiObrigatorio;
    }
}
        /*
         * ==========================================================
         * 13. DEFINIR STATUS
         * ==========================================================
         */

        $statusOcorrencia =
            empty($episAusentes)
                ? 'Conforme'
                : 'Irregular';


        /*
         * ==========================================================
         * 14. LOGS PARA DEBUG
         * ==========================================================
         */

        log_message(
            'error',
            'NEXA API EPIs OBRIGATÓRIOS: ' .
            json_encode(
                $episObrigatorios,
                JSON_UNESCAPED_UNICODE
            )
        );


        log_message(
            'error',
            'NEXA API EPIs DETECTADOS: ' .
            json_encode(
                $episDetectados,
                JSON_UNESCAPED_UNICODE
            )
        );


        log_message(
            'error',
            'NEXA API EPIs AUSENTES: ' .
            json_encode(
                $episAusentes,
                JSON_UNESCAPED_UNICODE
            )
        );


        /*
         * ==========================================================
         * 15. DATA E HORA
         * ==========================================================
         */

        $dataAnalise = date('Y-m-d');

        $horaAnalise = date('H:i:s');



        


        /*
         * ==========================================================
         * 16. CRIAR OCORRÊNCIA
         * ==========================================================
         */

       $episDetectadosFormatados = array_map(
    fn($epi) => $this->formatarNomeEpi($epi),
    $episDetectados
);

$episAusentesFormatados = array_map(
    fn($epi) => $this->formatarNomeEpi($epi),
    $episAusentes
);

$dadosOcorrencia = [
    'DATA_ANALISE' => $dataAnalise,

    'HORA_ANALISE' => $horaAnalise,

    'EPIS_DETECTADOS' =>
        implode(
            ', ',
            $episDetectadosFormatados
        ),

    'EPIS_AUSENTE' =>
        empty($episAusentesFormatados)
            ? 'Nenhum'
            : implode(
                ', ',
                $episAusentesFormatados
            ),

    'STATUS_OCORRENCIA' =>
        $statusOcorrencia,

    'FK_ID_CAMERA' =>
        $id
];


        $db->table('OCORRENCIA')
            ->insert($dadosOcorrencia);


        $idOcorrencia =
            $db->insertID();


        if (!$idOcorrencia) {

            log_message(
                'error',
                'NEXA: ERRO AO CRIAR OCORRENCIA'
            );

            return $this->respond([
                'status' => 500,
                'message' =>
                    'Erro ao salvar ocorrência.'
            ], 500);
        }


        /*
         * ==========================================================
         * 17. CRIAR FUN_OCORRENCIA
         * ==========================================================
         */

        $db->table('FUN_OCORRENCIA')
            ->insert([

                'FK_FUNCIONARIO_CPF' =>
                    $cpf,

                'FK_ID_OCORRENCIA' =>
                    $idOcorrencia
            ]);


        /*
         * ==========================================================
         * 18. RETORNAR RESULTADO PARA O APP
         * ==========================================================
         */

        return $this->respond([

            'status' => 200,

            'message' =>
                'Análise realizada com sucesso.',

            'funcionario' => [

                'cpf' =>
                    $cpf,

                'nome' =>
                    $funcionario['NOME']
                    ?? null
            ],

            'camera' => [

                'id' =>
                    $id,

                'identificador' =>
                    $camera['IDENTIFICADOR_CAMERA']
                    ?? null
            ],

            'epis_obrigatorios' =>
                $episObrigatorios,

            'epis_detectados' =>
                $episDetectados,

                'deteccoes' =>
    $deteccoesObrigatorias,

            'epis_ausentes' =>
                $episAusentes,

            'status_ocorrencia' =>
                $statusOcorrencia,

            'ocorrencia' => [

                'id' =>
                    $idOcorrencia,

                'data' =>
                    $dataAnalise,

                'hora' =>
                    $horaAnalise
            ]

        ], 200);
    }
private function formatarNomeEpi($nome)
{
    $nome = trim($nome);

    // Normaliza primeiro para conseguir reconhecer os nomes
    $normalizado = $this->normalizarEpi($nome);

    $nomes = [
        'oculos de protecao' => 'Óculos de proteção',
        'capacete' => 'Capacete',
        'luvas' => 'Luvas',
        'colete' => 'Colete',
        'mascara' => 'Máscara',
        'botas de seguranca' => 'Botas de segurança',
        'protetor auricular' => 'Protetor auricular',
    ];

    return $nomes[$normalizado]
        ?? mb_convert_case(
            $nome,
            MB_CASE_TITLE,
            'UTF-8'
        );
}

    /*
     * ==========================================================
     * NORMALIZAR NOME DO EPI
     * ==========================================================
     */

   private function normalizarEpi($nome)
{
    $nome = trim($nome);

    // Primeiro remove os acentos
    $nome = $this->removerAcentos($nome);

    // Depois transforma tudo em minúsculo
    $nome = strtolower($nome);

    // Remove espaços duplicados
    $nome = preg_replace(
        '/\s+/',
        ' ',
        $nome
    );

    switch ($nome) {

        case 'hard hat':
        case 'helmet':
        case 'capacete':
            return 'capacete';

        case 'gloves':
        case 'glove':
        case 'luvas':
        case 'luva':
            return 'luvas';

        case 'glasses':
        case 'protective glasses':
        case 'safety glasses':
        case 'oculos':
        case 'oculos de protecao':
            return 'oculos de protecao';

        case 'safety shoes':
        case 'boots':
        case 'boot':
        case 'botas':
        case 'botas de seguranca':
        case 'sapatos de seguranca':
            return 'botas de seguranca';

        case 'mask':
        case 'masks':
        case 'mascara':
            return 'mascara';

        case 'safety vest':
        case 'vest':
        case 'colete':
            return 'colete';

        case 'ear muffs':
        case 'ear protection':
        case 'protetor auricular':
            return 'protetor auricular';

        default:
            return $nome;
    }
}


    /*
     * ==========================================================
     * VERIFICAR SE É EPI
     * ==========================================================
     */

    private function ehEpi($nome)
    {
        $episValidos = [

            'capacete',

            'luvas',

            'oculos de protecao',

            'botas de seguranca',

            'mascara',

            'colete',

            'protetor auricular'
        ];


        return in_array(
            $nome,
            $episValidos
        );
    }


    /*
     * ==========================================================
     * REMOVER ACENTOS
     * ==========================================================
     */
private function removerAcentos($texto)
{
    $acentos = [

        // Minúsculas
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
        'õ' => 'o',
        'ô' => 'o',
        'ö' => 'o',

        'ú' => 'u',
        'ù' => 'u',
        'û' => 'u',
        'ü' => 'u',

        'ç' => 'c',

        // Maiúsculas
        'Á' => 'A',
        'À' => 'A',
        'Ã' => 'A',
        'Â' => 'A',
        'Ä' => 'A',

        'É' => 'E',
        'È' => 'E',
        'Ê' => 'E',
        'Ë' => 'E',

        'Í' => 'I',
        'Ì' => 'I',
        'Î' => 'I',
        'Ï' => 'I',

        'Ó' => 'O',
        'Ò' => 'O',
        'Õ' => 'O',
        'Ô' => 'O',
        'Ö' => 'O',

        'Ú' => 'U',
        'Ù' => 'U',
        'Û' => 'U',
        'Ü' => 'U',

        'Ç' => 'C'
    ];

    return strtr($texto, $acentos);
}
}