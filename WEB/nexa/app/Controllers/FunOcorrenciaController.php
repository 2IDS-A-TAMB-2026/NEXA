<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FunOcorrenciaModel;

class FunOcorrenciaController extends BaseController
{
    protected $funOcorrenciaModel;

    public function __construct()
    {
        $this->funOcorrenciaModel = new FunOcorrenciaModel();
    }

    // LISTAGEM
    public function index()
    {
        $dados['funOcorrencias'] =
            $this->funOcorrenciaModel->findAll();

        return view('FunOcorrencia/index', $dados);
    }

    // FORM NOVO
    public function novo()
    {
        return view('FunOcorrencia/novo');
    }

    // INSERIR
    public function inserir()
    {
        $dados = [
            'FK_FUNCIONARIO_CPF' =>
                $this->request->getPost('FK_FUNCIONARIO_CPF'),

            'FK_ID_OCORRENCIA' =>
                $this->request->getPost('FK_ID_OCORRENCIA')
        ];

        $this->funOcorrenciaModel->insert($dados);

        return redirect()->to('/funocorrencia');
    }

    // FORM EDITAR
    public function editar($id)
    {
        $dados['funOcorrencia'] =
            $this->funOcorrenciaModel->find($id);

        return view('FunOcorrencia/editar', $dados);
    }

    // ATUALIZAR
    public function atualizar($id)
    {
        $dados = [
            'FK_FUNCIONARIO_CPF' =>
                $this->request->getPost('FK_FUNCIONARIO_CPF'),

            'FK_ID_OCORRENCIA' =>
                $this->request->getPost('FK_ID_OCORRENCIA')
        ];

        $this->funOcorrenciaModel->update($id, $dados);

        return redirect()->to('/funocorrencia');
    }

    // EXCLUIR
    public function excluir($id)
    {
        $this->funOcorrenciaModel->delete($id);

        return redirect()->to('/funocorrencia');
    }
}