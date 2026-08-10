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
    $modelEmpresa = new \App\Models\EmpresaModel();
    $modelAdministrador = new \App\Models\AdministradorModel();

    $dados_adm = $modelAdministrador->find(session()->get("cpf"));

    // empresa do administrador logado
    $empresa = $modelEmpresa->find($dados_adm['FK_CNPJ_EMPRESA']);

    $dados['empresa'] = $empresa;

    // somente setores da empresa logada
    $dados['setores'] = $this->setorModel
        ->where('FK_CNPJ_EMPRESA', $empresa['CNPJ'])
        ->findAll();

    return view('sistema/Setor/index', $dados);
}

    // INSERIR
 public function inserir()
{
    $modelEmpresa = new \App\Models\EmpresaModel();
    $modelAdministrador = new \App\Models\AdministradorModel();

    $dados_adm = $modelAdministrador->find(session()->get("cpf"));

    $empresa = $modelEmpresa->find($dados_adm['FK_CNPJ_EMPRESA']);

    $dados = [
        'NOME' => $this->request->getPost('nome_setor'),
        'LOCAL' => $this->request->getPost('localizacao'),

        // força a empresa logada
        'FK_CNPJ_EMPRESA' => $empresa['CNPJ']
    ];

    $this->setorModel->insert($dados);

   return redirect()
->to('/setor')
->with('sucesso','Setor cadastrado com sucesso!');
}
    // ATUALIZAR
   public function atualizar($id)
{
    $modelEmpresa = new \App\Models\EmpresaModel();
    $modelAdministrador = new \App\Models\AdministradorModel();

    $dados_adm = $modelAdministrador->find(session()->get("cpf"));

    $empresa = $modelEmpresa->find($dados_adm['FK_CNPJ_EMPRESA']);

    $dados = [
        'NOME' => $this->request->getPost('nome_setor'),
        'LOCAL' => $this->request->getPost('localizacao'),

        // mantém sempre a empresa do ADM logado
        'FK_CNPJ_EMPRESA' => $empresa['CNPJ']
    ];

    $this->setorModel->update($id, $dados);

    return redirect()
    ->to('/setor')
    ->with('sucesso_edicao', 'Setor atualizado com sucesso!');
}

    // EXCLUIR
    public function excluir($id)
    {
        $this->setorModel->delete($id);

        return redirect()->to('/setor');
    }
}