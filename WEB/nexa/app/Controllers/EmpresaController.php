<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpresaModel;

class EmpresaController extends BaseController
{
    protected $empresaModel;

    public function __construct()
    {
        $this->empresaModel = new EmpresaModel();
    }

    // LISTAGEM
    public function index()
    {
        $dados['empresas'] = $this->empresaModel->findAll();

        return view('Empresa/index', $dados);
    }

    // FORM NOVO
    public function novo()
    {
        return view('Empresa/novo');
    }

    // INSERIR
    public function inserir()
    {
        $dados = [
            'CNPJ' => $this->request->getPost('CNPJ'),
            'NOME' => $this->request->getPost('NOME'),
            'RUA' => $this->request->getPost('RUA'),
            'CEP' => $this->request->getPost('CEP'),
            'NUMERO' => $this->request->getPost('NUMERO')
        ];

        $this->empresaModel->insert($dados);

        return redirect()->to('/empresa');
    }

    // FORM EDITAR
    public function editar($cnpj)
    {
        $dados['empresa'] = $this->empresaModel->find($cnpj);

        return view('Empresa/editar', $dados);
    }

    // ATUALIZAR
    public function atualizar($cnpj)
    {
        $dados = [
            'NOME' => $this->request->getPost('NOME'),
            'RUA' => $this->request->getPost('RUA'),
            'CEP' => $this->request->getPost('CEP'),
            'NUMERO' => $this->request->getPost('NUMERO')
        ];

        $this->empresaModel->update($cnpj, $dados);

        return redirect()->to('/empresa');
    }

    // EXCLUIR
    public function excluir($cnpj)
    {
        $this->empresaModel->delete($cnpj);

        return redirect()->to('/empresa');
    }
}