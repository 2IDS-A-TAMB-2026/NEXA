<?php

namespace App\Controllers;

use App\Models\OcorrenciaModel;
use App\Models\CameraModel;
use App\Models\FuncionarioModel;
use App\Models\SetorModel;

class DashboardController extends BaseController
{


    public function index()
    {
        $ocorrenciaModel = new OcorrenciaModel();
        $cameraModel = new CameraModel();
        $funcModel = new FuncionarioModel();
        $setorModel = new SetorModel();

        $conforme = $ocorrenciaModel
            ->where('STATUS_OCORRENCIA', 'Regular')
            ->countAllResults();

        $naoConforme = $ocorrenciaModel
            ->where('STATUS_OCORRENCIA', 'Irregular')
            ->countAllResults();

        $parcial = $ocorrenciaModel
            ->where('STATUS_OCORRENCIA', 'Parcial')
            ->countAllResults();

        // TOTAL
        $total = $conforme + $naoConforme + $parcial;

        // CONFORMIDADE
        $conformidade = 0;

        if($total > 0)
        {
            $conformidade = round(($conforme / $total) * 100);
        }

        // ALERTAS
        $alertas = $naoConforme;

        // CAMERAS
        $camerasAtivas = $cameraModel
            ->where('STATUS', 'Ativa')
            ->countAllResults();

        // FUNCIONARIOS VERIFICADOS
        $verificados = $conforme + $parcial;
        $faltaram = $naoConforme;

        // FUNCIONARIOS POR SETOR
        $setores = $setorModel
            ->select('ID, NOME')
            ->findAll();

        $nomesSetores = [];
        $totaisSetores = [];

            foreach($setores as $s)
            {
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

            'conforme' => $conforme,
            'naoConforme' => $naoConforme,
            'parcial' => $parcial,

            'verificados' => $verificados,
            'faltaram' => $faltaram,

            'nomesSetores' => json_encode($nomesSetores),
            'totaisSetores' => json_encode($totaisSetores)
        ];

        return view('sistema/Dashboard/index', $dados);
    }
}