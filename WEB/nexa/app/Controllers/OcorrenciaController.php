<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OcorrenciaModel;
use App\Models\CameraModel;

class OcorrenciaController extends BaseController
{
    protected $ocorrenciaModel;

    public function __construct()
    {
        $this->ocorrenciaModel = new OcorrenciaModel();
    }

    // LISTAGEM
    public function index()
    {
     $dados['ocorrencias'] = $this->ocorrenciaModel
    ->select('
        OCORRENCIA.*,
        CAMERA.IDENTIFICADOR_CAMERA,
        FUNCIONARIO.NOME_COMPLETO,
        SETOR.NOME AS SETOR
    ')
    ->join('CAMERA', 'CAMERA.ID = OCORRENCIA.FK_ID_CAMERA')
    ->join('FUN_OCORRENCIA', 'FUN_OCORRENCIA.FK_ID_OCORRENCIA = OCORRENCIA.ID')
    ->join('FUNCIONARIO', 'FUNCIONARIO.CPF = FUN_OCORRENCIA.FK_FUNCIONARIO_CPF')
    ->join('SETOR', 'SETOR.ID = FUNCIONARIO.FK_ID_SETOR')
    ->findAll();
 
        return view('sistema/Ocorrencia/index', $dados);
    }

    // FORM NOVO
    public function novo()
    {
        $cameraModel = new CameraModel();

        $dados['cameras'] = $cameraModel->findAll();

        return view('sistema/Ocorrencia/novo', $dados);
    }

    // INSERIR
    public function inserir()
    {
        $dados = [
            'DATA_ANALISE' => $this->request->getPost('data_analise'),
            'HORA_ANALISE' => $this->request->getPost('hora_analise'),
            'EPIS_DETECTADOS' => $this->request->getPost('epis_detectados'),
            'EPIS_AUSENTE' => $this->request->getPost('epis_ausente'),
            'STATUS_OCORRENCIA' => $this->request->getPost('status_ocorrencia'),
            'FK_ID_CAMERA' => $this->request->getPost('fk_id_camera')
        ];

        $this->ocorrenciaModel->insert($dados);

        return redirect()->to('/Ocorrencia');
    }

    // FORM EDITAR
    public function editar($id)
    {
        $cameraModel = new CameraModel();

        $dados['ocorrencia'] = $this->ocorrenciaModel->find($id);

        $dados['cameras'] = $cameraModel->findAll();

        return view('sistema/Ocorrencia/editar', $dados);
    }

    // ATUALIZAR
    public function atualizar($id)
    {
        $dados = [
            'DATA_ANALISE' => $this->request->getPost('data_analise'),
            'HORA_ANALISE' => $this->request->getPost('hora_analise'),
            'EPIS_DETECTADOS' => $this->request->getPost('epis_detectados'),
            'EPIS_AUSENTE' => $this->request->getPost('epis_ausente'),
            'STATUS_OCORRENCIA' => $this->request->getPost('status_ocorrencia'),
            'FK_ID_CAMERA' => $this->request->getPost('fk_id_camera')
        ];

        $this->ocorrenciaModel->update($id, $dados);

        return redirect()->to('/Ocorrencia');
    }

    // EXCLUIR
    public function excluir($id)
    {
        $this->ocorrenciaModel->delete($id);

        return redirect()->to('/Ocorrencia');
    }
}