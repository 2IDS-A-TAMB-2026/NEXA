<?php

namespace App\Controllers;

use App\Models\OcorrenciaModel;

class AnaliseEpiController extends BaseController
{
    public function index()
    {
        return view('sistema/analise_epi/index');
    }


    /**
     * =========================================================
     * ANALISAR IMAGEM
     * =========================================================
     */
    public function analisar()
    {
        $dados = $this->request->getJSON(true);

        $imagem = $dados['imagem'] ?? '';
        $camera = $dados['camera'] ?? 'CAM 03';


        /*
        =========================================================
        VERIFICAR IMAGEM
        =========================================================
        */

        if (empty($imagem)) {

            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => false,
                    'mensagem' => 'Imagem não recebida.'
                ]);
        }


        try {

            /*
            =====================================================
            CHAMAR ROBOFLOW
            =====================================================
            */

            $resultadoIA =
                $this->analisarComRoboflow($imagem);


            /*
            =====================================================
            PEGAR PREDICTIONS
            =====================================================

            Seu Workflow possui:

            Outputs
                predictions
                    model.predictions
            */

            $predictions =
                $resultadoIA['predictions']
                ?? [];


            /*
            =====================================================
            VARIÁVEIS DOS EPIs
            =====================================================
            */

            $capacete = false;
            $luva = false;
            $oculos = false;


            /*
            =====================================================
            PERCORRER DETECÇÕES
            =====================================================
            */

            foreach ($predictions as $prediction) {

                /*
                Dependendo da resposta do Workflow,
                a classe normalmente vem em class.
                */

                $classe =
                    strtolower(
                        trim(
                            $prediction['class']
                            ?? $prediction['class_name']
                            ?? ''
                        )
                    );


                /*
                =============================================
                CAPACETE
                =============================================
                */

                if ($classe === 'capacete') {

                    $capacete = true;

                }


                /*
                =============================================
                LUVA
                =============================================
                */

                if ($classe === 'luva') {

                    $luva = true;

                }


                /*
                =============================================
                ÓCULOS
                =============================================
                */

                if (
                    $classe === 'oculos' ||
                    $classe === 'óculos'
                ) {

                    $oculos = true;

                }
            }


            /*
            =====================================================
            EPIs DETECTADOS
            =====================================================
            */

            $episDetectados = [];
            $episAusentes = [];


            if ($capacete) {

                $episDetectados[] =
                    'Capacete';

            } else {

                $episAusentes[] =
                    'Capacete';

            }


            if ($luva) {

                $episDetectados[] =
                    'Luva';

            } else {

                $episAusentes[] =
                    'Luva';

            }


            if ($oculos) {

                $episDetectados[] =
                    'Óculos';

            } else {

                $episAusentes[] =
                    'Óculos';

            }


            /*
            =====================================================
            STATUS DA OCORRÊNCIA
            =====================================================
            */

            $irregular =
                count($episAusentes) > 0;


            $status =
                $irregular
                    ? 'Irregular'
                    : 'Conforme';


            /*
            =====================================================
            SALVAR OCORRÊNCIA
            =====================================================
            */

            $model =
                new OcorrenciaModel();


            $model->insert([

                'IDENTIFICADOR_CAMERA' =>
                    $camera,

                'NOME_COMPLETO' =>
                    'Funcionário Teste',

                'SETOR' =>
                    'Produção',

                'STATUS_OCORRENCIA' =>
                    $status,

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

                'DATA_ANALISE' =>
                    date('Y-m-d'),

                'HORA_ANALISE' =>
                    date('H:i:s')

            ]);


            /*
            =====================================================
            RETORNO PARA O JAVASCRIPT
            =====================================================
            */

            return $this->response->setJSON([

                'status' => true,

                'mensagem' =>
                    $irregular
                        ? 'EPI IRREGULAR DETECTADO'
                        : 'Todos os EPIs foram detectados',

                'epis' => [

                    'capacete' =>
                        $capacete,

                    'luva' =>
                        $luva,

                    'oculos' =>
                        $oculos

                ]

            ]);


        } catch (\Throwable $erro) {
             return $this->response
        ->setStatusCode(500)
        ->setJSON([
            'status' => false,
            'mensagem' => 'Erro na IA',
            'erro' => $erro->getMessage()
        ]);

        

            /*
            =====================================================
            REGISTRAR ERRO
            =====================================================
            */

            log_message(
                'error',
                'Erro na análise Roboflow: ' .
                $erro->getMessage()
            );


            return $this->response
                ->setStatusCode(500)
                ->setJSON([

                    'status' => false,

                    'mensagem' =>
                        'Erro ao realizar análise da IA.',

                    'erro' =>
                        $erro->getMessage()

                ]);
        }
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

    /*
    =========================================================
    ENDPOINT SERVERLESS DA ROBOFLOW
    =========================================================
    */

    $url =
        'https://serverless.roboflow.com/' .
        'nexaepi/workflows/nexa-epi';


    /*
    =========================================================
    REMOVER PREFIXO DO BASE64
    =========================================================

    A câmera envia:

    data:image/jpeg;base64,AAAA...

    Vamos deixar somente o Base64.
    */

    if (strpos($imagem, ',') !== false) {

        $imagem =
            explode(',', $imagem, 2)[1];
    }


    /*
    =========================================================
    PAYLOAD
    =========================================================
    */

    $payload = [

        'api_key' => $apiKey,

        'inputs' => [

            'image' => [

                'type' => 'base64',

                'value' => $imagem

            ]

        ]

    ];


    /*
    =========================================================
    CURL
    =========================================================
    */

    $ch = curl_init($url);

    curl_setopt_array($ch, [

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_POST => true,

        CURLOPT_HTTPHEADER => [

            'Content-Type: application/json',

            'Accept: application/json'

        ],

        CURLOPT_POSTFIELDS =>
            json_encode(
                $payload,
                JSON_UNESCAPED_SLASHES
            ),

        CURLOPT_CONNECTTIMEOUT => 15,

        CURLOPT_TIMEOUT => 60

    ]);


    $resposta = curl_exec($ch);


    /*
    =========================================================
    ERRO DE CONEXÃO
    =========================================================
    */

    if ($resposta === false) {

        $erro = curl_error($ch);

        curl_close($ch);

        throw new \Exception(
            'Erro ao conectar à Roboflow: ' . $erro
        );
    }


    /*
    =========================================================
    STATUS HTTP
    =========================================================
    */

    $codigoHTTP =
        curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );

    curl_close($ch);


    /*
    =========================================================
    ERRO DA ROBOFLOW
    =========================================================
    */

    if (
        $codigoHTTP < 200 ||
        $codigoHTTP >= 300
    ) {

        throw new \Exception(
            'Roboflow HTTP ' .
            $codigoHTTP .
            ': ' .
            $resposta
        );
    }


    /*
    =========================================================
    JSON
    =========================================================
    */

    $resultado =
        json_decode(
            $resposta,
            true
        );


    if (
        json_last_error() !==
        JSON_ERROR_NONE
    ) {

        throw new \Exception(
            'Resposta inválida da Roboflow: ' .
            $resposta
        );
    }


    return $resultado;
}
}