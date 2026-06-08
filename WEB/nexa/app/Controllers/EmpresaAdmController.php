<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpresaAdmModel;

class EmpresaAdmController extends BaseController
{
    protected $empresaAdmModel;

    public function __construct()
    {
        $this->empresaAdmModel = new EmpresaAdmModel();
    }

    // LISTAGEM
    public function index()
    {
        $dados['empresaAdm'] =
            $this->empresaAdmModel->findAll();

        return view('EmpresaAdm/index', $dados);
    }

    // FORM NOVO
    public function novo()
    {
        return view('EmpresaAdm/novo');
    }

    // INSERIR
    public function inserir()
    {
        $dados = [
            'FK_EMPRESA_CNPJ' =>
                $this->request->getPost('FK_EMPRESA_CNPJ'),

            'FK_ADMINISTRADOR_CPF' =>
                $this->request->getPost('FK_ADMINISTRADOR_CPF')
        ];

        $this->empresaAdmModel->insert($dados);

        return redirect()->to('/empresaadm');
    }

    // FORM EDITAR
    public function editar($id)
    {
        $dados['empresaAdm'] =
            $this->empresaAdmModel->find($id);

        return view('EmpresaAdm/editar', $dados);
    }

    // ATUALIZAR
    public function atualizar($id)
    {
        $dados = [
            'FK_EMPRESA_CNPJ' =>
                $this->request->getPost('FK_EMPRESA_CNPJ'),

            'FK_ADMINISTRADOR_CPF' =>
                $this->request->getPost('FK_ADMINISTRADOR_CPF')
        ];

        $this->empresaAdmModel->update($id, $dados);

        return redirect()->to('/empresaadm');
    }

    // EXCLUIR
    public function excluir($id)
    {
        $this->empresaAdmModel->delete($id);

        return redirect()->to('/empresaadm');
    }
}