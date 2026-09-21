<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OcorrenciaModel;
use App\Models\CameraModel;
use App\Models\FuncionarioModel;
use App\Models\SetorModel;
use App\Models\AdministradorModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $ocorrenciaModel = new OcorrenciaModel();
        $cameraModel = new CameraModel();
        $funcModel = new FuncionarioModel();
        $setorModel = new SetorModel();
        $admModel = new AdministradorModel();

        // ==========================================================
        // DATA ATUAL - HORÁRIO DE SÃO PAULO
        // ==========================================================

        $timezone = new \DateTimeZone('America/Sao_Paulo');

        $hoje = new \DateTime('now', $timezone);

        $dataHoje = $hoje->format('Y-m-d');


        // ==========================================================
        // ADMINISTRADOR LOGADO
        // ==========================================================

        $cpfAdm = session()->get('cpf');

        $adm = $admModel->find($cpfAdm);

        if (!$adm) {
            return redirect()->to('/login');
        }

        $cnpj = $adm['FK_CNPJ_EMPRESA'];


        // ==========================================================
        // CÂMERAS DA EMPRESA
        // ==========================================================

        $camerasEmpresa = $cameraModel
            ->where('FK_CNPJ_EMPRESA', $cnpj)
            ->findAll();

        $idsCameras = array_column(
            $camerasEmpresa,
            'ID'
        );


        // ==========================================================
        // SETORES DA EMPRESA
        // ==========================================================

        $setores = $setorModel
            ->where('FK_CNPJ_EMPRESA', $cnpj)
            ->findAll();


        // ==========================================================
        // FUNCIONÁRIOS DA EMPRESA
        // ==========================================================

        $funcionarios = $funcModel
            ->where('FK_CNPJ_EMPRESA', $cnpj)
            ->findAll();


        // ==========================================================
        // VARIÁVEIS
        // ==========================================================

        $conforme = 0;

        $naoConforme = 0;

        $parcial = 0;

        $episAusentes = [];

        /*
         * Funcionários analisados hoje.
         *
         * A chave será o CPF.
         * Assim, se o mesmo funcionário for analisado
         * várias vezes hoje, ele será contado apenas uma vez.
         */
        $funcionariosAnalisadosHoje = [];


        // ==========================================================
        // OCORRÊNCIAS DE HOJE
        // SOMENTE DAS CÂMERAS DA EMPRESA
        // ==========================================================

        foreach ($idsCameras as $idCamera) {

            $ocorrencias = $ocorrenciaModel
                ->select('
                    OCORRENCIA.*,
                    FUN_OCORRENCIA.FK_FUNCIONARIO_CPF
                ')
                ->join(
                    'FUN_OCORRENCIA',
                    'FUN_OCORRENCIA.FK_ID_OCORRENCIA = OCORRENCIA.ID',
                    'left'
                )
                ->where(
                    'OCORRENCIA.FK_ID_CAMERA',
                    $idCamera
                )
                ->where(
                    'OCORRENCIA.DATA_ANALISE',
                    $dataHoje
                )
                ->findAll();


            foreach ($ocorrencias as $o) {

                // ==================================================
                // FUNCIONÁRIO ANALISADO
                // ==================================================

                if (!empty($o['FK_FUNCIONARIO_CPF'])) {

                    $funcionariosAnalisadosHoje[
                        $o['FK_FUNCIONARIO_CPF']
                    ] = true;
                }


                // ==================================================
                // STATUS DA OCORRÊNCIA
                // ==================================================

                $status = strtolower(
                    trim(
                        $o['STATUS_OCORRENCIA'] ?? ''
                    )
                );


                // CONFORME

                if (
                    $status === 'regular' ||
                    $status === 'conforme'
                ) {

                    $conforme++;
                }


                // NÃO CONFORME

                elseif (
                    $status === 'irregular' ||
                    $status === 'não conforme' ||
                    $status === 'nao conforme'
                ) {

                    $naoConforme++;
                }


                // PARCIAL

                elseif (
                    $status === 'parcial'
                ) {

                    $parcial++;
                }


                // ==================================================
                // EPIs AUSENTES
                // ==================================================

                $epis = $o['EPIS_AUSENTE'] ?? '';

                if (!empty($epis)) {

                    /*
                     * Tenta descobrir se o banco salvou
                     * os EPIs como JSON.
                     */

                    $episJson = json_decode(
                        $epis,
                        true
                    );


                    if (
                        json_last_error() === JSON_ERROR_NONE &&
                        is_array($episJson)
                    ) {

                        $epis = $episJson;

                    } else {

                        /*
                         * Caso esteja salvo como:
                         *
                         * Capacete, Óculos, Luvas
                         */

                        $epis = explode(
                            ',',
                            $epis
                        );
                    }


                  foreach ($epis as $epi) {

    if (is_array($epi)) {
        continue;
    }

    $epi = trim($epi);

    if ($epi === '') {
        continue;
    }

    // ==================================================
    // IGNORA "NENHUM"
    // "Nenhum" significa que a análise está conforme,
    // portanto NÃO é um EPI ausente.
    // ==================================================

    $epiMinusculo = mb_strtolower(
        $epi,
        'UTF-8'
    );

    if (
        $epiMinusculo === 'nenhum' ||
        $epiMinusculo === 'nenhuma'
    ) {
        continue;
    }

    // Normaliza o nome do EPI

    $epiNormalizado = $this->normalizarEpi($epi);

    // Conta somente EPIs realmente ausentes

    if (!isset($episAusentes[$epiNormalizado])) {
        $episAusentes[$epiNormalizado] = 0;
    }

    $episAusentes[$epiNormalizado]++;
}
                }
            }
        }


        // ==========================================================
        // PESSOAS ANALISADAS HOJE
        // ==========================================================

        $pessoasHoje = count(
            $funcionariosAnalisadosHoje
        );


        // ==========================================================
        // CONFORMIDADE DE HOJE
        // ==========================================================

        $totalAnalisesHoje =
            $conforme +
            $naoConforme +
            $parcial;


        $conformidade = 0;


        if ($totalAnalisesHoje > 0) {

            $conformidade = round(
                (
                    $conforme /
                    $totalAnalisesHoje
                ) * 100
            );
        }


        // ==========================================================
        // ALERTAS ATIVOS
        // SOMENTE NÃO CONFORMES DE HOJE
        // ==========================================================

        $alertas = $naoConforme;


        // ==========================================================
        // CÂMERAS ATIVAS
        // ==========================================================

        $camerasAtivas = $cameraModel
            ->where(
                'FK_CNPJ_EMPRESA',
                $cnpj
            )
            ->where(
                'STATUS',
                'Ativo'
            )
            ->countAllResults();


        // ==========================================================
        // CÂMERAS INATIVAS
        // ==========================================================

        $camerasInativas = $cameraModel
            ->where(
                'FK_CNPJ_EMPRESA',
                $cnpj
            )
            ->where(
                'STATUS',
                'Inativo'
            )
            ->countAllResults();


        // ==========================================================
        // EPIs MAIS AUSENTES HOJE
        // ==========================================================

        arsort($episAusentes);


        /*
         * IMPORTANTE:
         *
         * Estas duas variáveis continuam como ARRAY.
         *
         * Isso permite usar foreach() diretamente na View.
         */

        $nomesEpi = array_keys(
            $episAusentes
        );

        $totaisEpi = array_values(
            $episAusentes
        );


        // ==========================================================
        // OCORRÊNCIAS POR CÂMERA
        // SOMENTE HOJE
        // ==========================================================

        $nomesCamera = [];

        $totalOcorrencias = [];


        foreach ($camerasEmpresa as $camera) {

            $nomesCamera[] =
                $camera['IDENTIFICADOR_CAMERA'];


            $qtd = $ocorrenciaModel
                ->where(
                    'FK_ID_CAMERA',
                    $camera['ID']
                )
                ->where(
                    'DATA_ANALISE',
                    $dataHoje
                )
                ->countAllResults();


            $totalOcorrencias[] = $qtd;
        }


        // ==========================================================
        // FUNCIONÁRIOS POR SETOR
        // ==========================================================

        $nomesSetores = [];

        $totaisSetores = [];


        foreach ($setores as $s) {

            $nomesSetores[] =
                $s['NOME'];


            $quantidade = $funcModel
                ->where(
                    'FK_ID_SETOR',
                    $s['ID']
                )
                ->where(
                    'FK_CNPJ_EMPRESA',
                    $cnpj
                )
                ->countAllResults();


            $totaisSetores[] =
                $quantidade;
        }


        // ==========================================================
        // DADOS PARA A VIEW
        // ==========================================================

       $dados = [
    'pessoasHoje' => $pessoasHoje,
    'conformidade' => $conformidade,
    'alertas' => $alertas,

    'camerasAtivas' => $camerasAtivas,
    'camerasInativas' => $camerasInativas,

    'conforme' => $conforme,
    'naoConforme' => $naoConforme,
    'parcial' => $parcial,

    // ARRAYS — usados pelo foreach da View
    'nomesEpi' => $nomesEpi,
'totaisEpi' => $totaisEpi,
'iconesEpi' => array_map(
    function ($epi) {
        return $this->iconeEpi($epi);
    },
    $nomesEpi
),

    // JSON — usados pelo Chart.js
    'nomesCamera' => json_encode(
        $nomesCamera,
        JSON_UNESCAPED_UNICODE
    ),

    'totalOcorrencias' => json_encode(
        $totalOcorrencias
    ),

    'nomesSetores' => json_encode(
        $nomesSetores,
        JSON_UNESCAPED_UNICODE
    ),

    'totaisSetores' => json_encode(
        $totaisSetores
    )
];

        // ==========================================================
        // VIEW
        // ==========================================================

        return view(
            'sistema/Dashboard/index',
            $dados
        );
    }


    // ==============================================================
    // NORMALIZAÇÃO DOS NOMES DOS EPIs
    // ==============================================================

    private function normalizarEpi($epi)
    {
        $epi = trim($epi);

        $epi = mb_strtolower(
            $epi,
            'UTF-8'
        );


        $mapa = [

            // ÓCULOS

            'oculos' =>
                'Óculos de proteção',

            'óculos' =>
                'Óculos de proteção',

            'oculos de protecao' =>
                'Óculos de proteção',

            'óculos de proteção' =>
                'Óculos de proteção',


            // CAPACETE

            'capacete' =>
                'Capacete',

            'helmet' =>
                'Capacete',

            'hard hat' =>
                'Capacete',


            // LUVAS

            'luvas' =>
                'Luvas',

            'luva' =>
                'Luvas',

            'gloves' =>
                'Luvas',


            // BOTAS

            'botas' =>
                'Botas de segurança',

            'bota' =>
                'Botas de segurança',

            'boots' =>
                'Botas de segurança',

            'safety shoes' =>
                'Botas de segurança',


            // MÁSCARA

            'mascara' =>
                'Máscara',

            'máscara' =>
                'Máscara',

            'mask' =>
                'Máscara',


            // COLETE

            'colete' =>
                'Colete',

            'safety vest' =>
                'Colete',

            'vest' =>
                'Colete',


            // PROTETOR AURICULAR

            'protetor auricular' =>
                'Protetor auricular',

            'ear muffs' =>
                'Protetor auricular',

            'ear protection' =>
                'Protetor auricular'
        ];


        if (isset($mapa[$epi])) {

            return $mapa[$epi];
        }


        // Caso seja um EPI diferente dos mapeados

        return mb_convert_case(
            $epi,
            MB_CASE_TITLE,
            'UTF-8'
        );
    }


    private function iconeEpi($epi)
{
    $epi = mb_strtolower(
        trim($epi),
        'UTF-8'
    );

    switch ($epi) {

        case 'capacete':
        case 'helmet':
        case 'hard hat':
            return 'fa-helmet-safety';

        case 'óculos de proteção':
        case 'oculos de protecao':
        case 'óculos':
        case 'oculos':
        case 'glasses':
            return 'fa-glasses';

        case 'luvas':
        case 'luva':
        case 'gloves':
            return 'fa-hand';

        case 'botas de segurança':
        case 'bota':
        case 'botas':
        case 'boots':
        case 'safety shoes':
            return 'fa-shoe-prints';

        case 'máscara':
        case 'mascara':
        case 'mask':
            return 'fa-head-side-mask';

        case 'colete':
        case 'safety vest':
        case 'vest':
            return 'fa-vest';

        case 'protetor auricular':
        case 'ear muffs':
        case 'ear protection':
            return 'fa-ear-listen';

        default:
            return 'fa-shield-halved';
    }
}
}