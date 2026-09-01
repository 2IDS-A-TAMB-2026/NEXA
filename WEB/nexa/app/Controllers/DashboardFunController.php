<?php

namespace App\Controllers;
use App\Models\FuncionarioModel;
use App\Models\OcorrenciaModel;

class DashboardFunController extends BaseController
{
    public function index()
    {
        if (!session()->get('logado_fun')) {
            return redirect()->to('/loginfun');
        }

        $cpf = session()->get('cpf_fun');

        $funcionarioModel = new FuncionarioModel();
        $ocorrenciaModel = new OcorrenciaModel();

        $funcionario = $funcionarioModel->find($cpf);
        $ocorrencias = $ocorrenciaModel->getByFuncionario($cpf);

        return view('sistema/DashboardFun/dashboardfun', [
            'funcionario' => $funcionario,
            'ocorrencias' => $ocorrencias
        ]);
    }
}