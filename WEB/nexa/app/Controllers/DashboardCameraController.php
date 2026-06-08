<?php

namespace App\Controllers;

use App\Models\DashboardCameraModel;

class DashboardCameraController extends BaseController
{
    public function index()
    {
        $model = new DashboardCameraModel();

        $filtro = $this->request->getGet('buscar');

        $dados['cameras'] = $model->listarCameras($filtro);

        $dados['buscar'] = $filtro;

        return view('sistema/Dashboard_Camera/index', $dados);
    }
}