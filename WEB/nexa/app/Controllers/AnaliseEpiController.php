<?php

namespace App\Controllers;

use App\Models\OcorrenciaModel;

class AnaliseEpiController extends BaseController
{
  
    public function index()
    {

        return view('sistema/analise_epi/index');

    }

   public function analisar()
{
$dados = $this->request->getJSON(true);

$imagem = $dados['imagem'] ?? '';
    /*
    ===================================
    IA FAKE TEMPORÁRIA
    ===================================
    */

    $capacete = true;
    $luva = false;
    $colete = true;

    /*
    ===================================
    EPIS
    ===================================
    */

    $episDetectados = [];
    $episAusentes = [];

    if($capacete){

        $episDetectados[] = 'Capacete';

    }else{

        $episAusentes[] = 'Capacete';

    }

    if($luva){

        $episDetectados[] = 'Luva';

    }else{

        $episAusentes[] = 'Luva';

    }

    if($colete){

        $episDetectados[] = 'Colete';

    }else{

        $episAusentes[] = 'Colete';

    }

    /*
    ===================================
    STATUS
    ===================================
    */

    $irregular =
    count($episAusentes) > 0;

    $status =
    $irregular
    ? 'Irregular'
    : 'Conforme';

    /*
    ===================================
    SALVAR OCORRENCIA
    ===================================
    */

    $model =
    new OcorrenciaModel();

    $model->insert([

        'IDENTIFICADOR_CAMERA' => 'CAM 03',

        'NOME_COMPLETO' => 'Funcionário Teste',

        'SETOR' => 'Produção',

        'STATUS_OCORRENCIA' => $status,

        'EPIS_DETECTADOS' =>
        implode(', ', $episDetectados),

        'EPIS_AUSENTE' =>
        empty($episAusentes)
        ? 'Nenhum'
        : implode(', ', $episAusentes),

        'DATA_ANALISE' =>
        date('Y-m-d'),

        'HORA_ANALISE' =>
        date('H:i:s')

    ]);

    /*
    ===================================
    RETORNO
    ===================================
    */

    return $this->response->setJSON([

        'status' => true,

        'mensagem' =>
        $irregular
        ? 'EPI IRREGULAR DETECTADO'
        : 'Todos EPIs detectados',

        'epis' => [

            'capacete' => $capacete,
            'luva' => $luva,
            'colete' => $colete

        ]

    ]);

}

}