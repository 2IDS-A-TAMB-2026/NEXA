<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OcorrenciaEpiModel;

class OcorrenciaEpiController extends BaseController
{
    protected $ocorrenciaEpiModel;

    public function __construct()
    {
        $this->ocorrenciaEpiModel = new OcorrenciaEpiModel();
    }

    // LISTAGEM
    public function index()
    {
        $dados['ocorrenciaEpi'] =
            $this->ocorrenciaEpiModel->findAll();

        return view('OcorrenciaEpi/index', $dados);
    }

    // FORM NOVO
    public function novo()
    {
        return view('OcorrenciaEpi/novo');
    }

    // INSERIR
    public function inserir()
    {
        $dados = [
            'FK_OCORRENCIA_ID' =>
                $this->request->getPost('FK_OCORRENCIA_ID'),

            'FK_EPI_ID' =>
                $this->request->getPost('FK_EPI_ID')
        ];

        $this->ocorrenciaEpiModel->insert($dados);

        return redirect()->to('/ocorrenciaepi');
    }

    // FORM EDITAR
    public function editar($id)
    {
        $dados['ocorrenciaEpi'] =
            $this->ocorrenciaEpiModel->find($id);

        return view('OcorrenciaEpi/editar', $dados);
    }

    // ATUALIZAR
    public function atualizar($id)
    {
        $dados = [
            'FK_OCORRENCIA_ID' =>
                $this->request->getPost('FK_OCORRENCIA_ID'),

            'FK_EPI_ID' =>
                $this->request->getPost('FK_EPI_ID')
        ];

        $this->ocorrenciaEpiModel->update($id, $dados);

        return redirect()->to('/ocorrenciaepi');
    }

    // EXCLUIR
    public function excluir($id)
    {
        $this->ocorrenciaEpiModel->delete($id);

        return redirect()->to('/ocorrenciaepi');
    }
}