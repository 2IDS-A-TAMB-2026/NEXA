<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SetorModel;

class SetorController extends BaseController
{
    protected $setorModel;

    public function __construct()
    {
        $this->setorModel = new SetorModel();
    }

    // LISTAGEM
    public function index()
    {
        $dados['setores'] = $this->setorModel->findAll();

        return view('sistema/Setor/index', $dados);
    }

    // INSERIR
    public function inserir()
    {
        $dados = [
            'NOME' => $this->request->getPost('nome_setor'),
            'LOCAL' => $this->request->getPost('localizacao'),
            'FK_CNPJ_EMPRESA' => $this->request->getPost('cnpj_empresa')
        ];

        $this->setorModel->insert($dados);

        return redirect()->to('/setor');
    }

    // ATUALIZAR
    public function atualizar($id)
    {
        $dados = [
            'NOME' => $this->request->getPost('nome_setor'),
            'LOCAL' => $this->request->getPost('localizacao'),
            'FK_CNPJ_EMPRESA' => $this->request->getPost('cnpj_empresa')
        ];

        $this->setorModel->update($id, $dados);

        return redirect()->to('/setor');
    }

    // EXCLUIR
    public function excluir($id)
    {
        $this->setorModel->delete($id);

        return redirect()->to('/setor');
    }
}