<?php

namespace App\Controllers;

use App\Models\DashboardCameraModel;
use App\Models\AdministradorModel;

class DashboardCameraController extends BaseController
{
    public function index()
    {

    
        $model = new DashboardCameraModel();
        $modelAdm = new AdministradorModel();

        $filtro = $this->request->getGet('buscar');

        $dados_adm = $modelAdm->find(session()->get("cpf"));

        $dados['cameras'] = $model->listarCameras(
            $filtro,
            $dados_adm['FK_CNPJ_EMPRESA']
        );

        $dados['buscar'] = $filtro;

        return view('sistema/Dashboard_Camera/index', $dados);
    }
}

