<?php

namespace App\Controllers;
use App\Models\EpiAdmModel;
use App\Models\AdministradorModel;
use App\Controllers\BaseController;
use App\Models\EpiModel;
//use App\Models\FuncionarioModel;

class EpiController extends BaseController
{
    protected $epiModel;

    public function __construct()
    {
        $this->epiModel = new EpiModel();
    }

    // LISTAGEM
    public function index()
    {
        //$funcionarioModel = new FuncionarioModel();

        $modelAdm = new AdministradorModel();
$modelEpiAdm = new EpiAdmModel();

$cpf = session()->get("cpf");

$dados_adm = $modelAdm->find($cpf);

// busca IDs dos EPIs do administrador logado
$episAdm = $modelEpiAdm
    ->where('FK_ADMINISTRADOR_CPF', $cpf)
    ->findAll();

$ids = array_column($episAdm, 'FK_EPI_ADM');

if (!empty($ids)) {
    $dados['epis'] = $this->epiModel
        ->whereIn('ID', $ids)
        ->findAll();
} else {
    $dados['epis'] = [];
}

        return view('sistema/Epi/index', $dados);
    }

    // FORM NOVO
    public function novo()
    {
        return redirect()->to('/epi');
    }

    // INSERIR
    public function inserir()
    {
        $imagem = $this->request->getFile('imagem_epi');

        $nomeImagem = '';

        if ($imagem && $imagem->isValid() && !$imagem->hasMoved()) {
            $nomeImagem = $imagem->getRandomName();
            $imagem->move(FCPATH . 'uploads/epis', $nomeImagem);
        }

        $dados = [
            'NOME_EPI' => $this->request->getPost('nome_epi'),
            'IMAGEM_EPI' => $nomeImagem,
            'DESCRICAO_EPI' => $this->request->getPost('des_epi'),
            //'FK_CPF_FUNCIONARIO' => $this->request->getPost('FK_CPF_FUNCIONARIO')
        ];

        
        
    
      if (!$this->epiModel->insert($dados)) {
    return redirect()->back()
        ->withInput()
        ->with('errors', $this->epiModel->errors());
}

$idEpi = $this->epiModel->getInsertID();

$modelEpiAdm = new EpiAdmModel();

$modelEpiAdm->insert([
    'FK_EPI_ADM' => $idEpi,
    'FK_ADMINISTRADOR_CPF' => session()->get('cpf')
]);

return redirect()->to('/epi')
    ->with('sucesso', 'EPI cadastrado com sucesso!');
    }


    public function atualizar($id)
    {
        $dados = [
            'NOME_EPI' => $this->request->getPost('nome_epi'),
            'DESCRICAO_EPI' => $this->request->getPost('des_epi'),
            //'FK_CPF_FUNCIONARIO' => $this->request->getPost('FK_CPF_FUNCIONARIO')
        ];

        $this->epiModel->update($id, $dados);

        return redirect()->to('/epi')
            ->with('sucesso', 'EPI atualizado com sucesso!');
    }

    // EXCLUIR
    public function excluir($id)
    {
        $this->epiModel->delete($id);

        return redirect()->to('/epi');
    }
}