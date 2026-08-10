<?php

namespace App\Controllers;

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

    // ADM LOGADO
    $adm = $admModel->find(session()->get('cpf'));
    $cnpj = $adm['FK_CNPJ_EMPRESA'];

    // CÂMERAS DA EMPRESA
    $camerasEmpresa = $cameraModel
        ->where('FK_CNPJ_EMPRESA', $cnpj)
        ->findAll();

    $idsCameras = array_column($camerasEmpresa, 'ID');

    // SETORES DA EMPRESA
    $setores = $setorModel
        ->where('FK_CNPJ_EMPRESA', $cnpj)
        ->findAll();

    // FUNCIONÁRIOS DA EMPRESA
    $funcionarios = $funcModel
        ->where('FK_CNPJ_EMPRESA', $cnpj)
        ->findAll();

    // ============================
    // OCORRÊNCIAS DA EMPRESA
    // ============================

    $conforme = 0;
    $naoConforme = 0;
    $parcial = 0;

    $episAusentes = [];

    foreach ($idsCameras as $idCamera) {

        $ocorrencias = $ocorrenciaModel
            ->where('FK_ID_CAMERA', $idCamera)
            ->findAll();

        foreach ($ocorrencias as $o) {

            if ($o['STATUS_OCORRENCIA'] == 'Regular')
                $conforme++;

            if ($o['STATUS_OCORRENCIA'] == 'Irregular')
                $naoConforme++;

            if ($o['STATUS_OCORRENCIA'] == 'Parcial')
                $parcial++;

            // EPIs AUSENTES
            $epis = explode(',', $o['EPIS_AUSENTE']);

            foreach ($epis as $epi) {

                $epi = trim($epi);

                if ($epi == '')
                    continue;

                if (!isset($episAusentes[$epi])) {
                    $episAusentes[$epi] = 0;
                }

                $episAusentes[$epi]++;
            }
        }
    }

    // ============================
    // CONFORMIDADE
    // ============================

    $total = $conforme + $naoConforme + $parcial;

    $conformidade = 0;

    if ($total > 0) {
        $conformidade = round(($conforme / $total) * 100);
    }

    // ALERTAS
    $alertas = $naoConforme;

    // ============================
    // CÂMERAS
    // ============================

    $camerasAtivas = $cameraModel
        ->where('FK_CNPJ_EMPRESA', $cnpj)
        ->where('STATUS', 'Ativo')
        ->countAllResults();

    $camerasInativas = $cameraModel
        ->where('FK_CNPJ_EMPRESA', $cnpj)
        ->where('STATUS', 'Inativo')
        ->countAllResults();

    // ============================
    // EPIs MAIS AUSENTES
    // ============================

    arsort($episAusentes);

    $nomesEpi = array_keys($episAusentes);
    $totaisEpi = array_values($episAusentes);

    // ============================
    // OCORRÊNCIAS POR CÂMERA
    // ============================

    $nomesCamera = [];
    $totalOcorrencias = [];

    foreach ($camerasEmpresa as $camera) {

        $nomesCamera[] = $camera['IDENTIFICADOR_CAMERA'];

        $qtd = $ocorrenciaModel
            ->where('FK_ID_CAMERA', $camera['ID'])
            ->countAllResults();

        $totalOcorrencias[] = $qtd;
    }

    // ============================
    // FUNCIONÁRIOS POR SETOR
    // ============================

    $nomesSetores = [];
    $totaisSetores = [];

    foreach ($setores as $s) {

        $nomesSetores[] = $s['NOME'];

        $quantidade = $funcModel
            ->where('FK_ID_SETOR', $s['ID'])
            ->countAllResults();

        $totaisSetores[] = $quantidade;
    }

    $pessoasHoje = $total;

    $dados = [
        'pessoasHoje' => $pessoasHoje,
        'conformidade' => $conformidade,
        'alertas' => $alertas,

        'camerasAtivas' => $camerasAtivas,
        'camerasInativas' => $camerasInativas,

        'conforme' => $conforme,
        'naoConforme' => $naoConforme,
        'parcial' => $parcial,

        // NOVO GRÁFICO: EPIs AUSENTES
        'nomesEpi' => json_encode($nomesEpi),
        'totaisEpi' => json_encode($totaisEpi),

        // NOVO GRÁFICO: OCORRÊNCIAS POR CÂMERA
        'nomesCamera' => json_encode($nomesCamera),
        'totalOcorrencias' => json_encode($totalOcorrencias),

        // FUNCIONÁRIOS POR SETOR
        'nomesSetores' => json_encode($nomesSetores),
        'totaisSetores' => json_encode($totaisSetores)
    ];

    return view('sistema/Dashboard/index', $dados);
}
}