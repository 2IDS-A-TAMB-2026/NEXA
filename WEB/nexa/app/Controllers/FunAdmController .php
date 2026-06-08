<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FunAdmModel;

class FunAdmController extends BaseController
{
    protected $funAdmModel;

    public function __construct()
    {
        $this->funAdmModel = new FunAdmModel();
    }

    // LISTAGEM
    public function index()
    {
        $dados['funAdm'] =
            $this->funAdmModel->findAll();

        return view('FunAdm/index', $dados);
    }

    // FORM NOVO
    public function novo()
    {
        return view('FunAdm/novo');
    }

    // INSERIR
    public function inserir()
    {
        $dados = [
            'FK_FUNCIONARIO_CPF' =>
                $this->request->getPost('FK_FUNCIONARIO_CPF'),

            'FK_ADMINISTRADOR_CPF' =>
                $this->request->getPost('FK_ADMINISTRADOR_CPF')
        ];

        $this->funAdmModel->insert($dados);

        return redirect()->to('/funadm');
    }

    // FORM EDITAR
    public function editar($id)
    {
        $dados['funAdm'] =
            $this->funAdmModel->find($id);

        return view('FunAdm/editar', $dados);
    }

    // ATUALIZAR
    public function atualizar($id)
    {
        $dados = [
            'FK_FUNCIONARIO_CPF' =>
                $this->request->getPost('FK_FUNCIONARIO_CPF'),

            'FK_ADMINISTRADOR_CPF' =>
                $this->request->getPost('FK_ADMINISTRADOR_CPF')
        ];

        $this->funAdmModel->update($id, $dados);

        return redirect()->to('/funadm');
    }

    // EXCLUIR
    public function excluir($id)
    {
        $this->funAdmModel->delete($id);

        return redirect()->to('/funadm');
    }
}