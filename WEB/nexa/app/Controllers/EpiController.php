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
    $cpf = session()->get('cpf');
    $nome = trim($this->request->getPost('nome_epi') ?? '');
    $descricao = trim($this->request->getPost('des_epi') ?? '');
    $imagem = $this->request->getFile('imagem_epi');

    if (!$cpf) {
        return redirect()->to('/login');
    }

    if (empty($nome) || empty($descricao)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Preencha todos os campos obrigatórios.');
    }

    // Bloqueia EPI repetido para a mesma empresa/administrador
    if ($this->epiJaCadastrado($nome, $cpf)) {
        return redirect()->to('/epi')
            ->with('error', 'Este tipo de EPI já está cadastrado!');
    }

    // Valida a imagem
    if (!$imagem || !$imagem->isValid() || $imagem->hasMoved()) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Selecione uma imagem válida para o EPI.');
    }

    $nomeImagem = $imagem->getRandomName();

    if (!$imagem->move(FCPATH . 'uploads/epis', $nomeImagem)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Não foi possível salvar a imagem.');
    }

    $dados = [
        'NOME_EPI' => $nome,
        'IMAGEM_EPI' => $nomeImagem,
        'DESCRICAO_EPI' => $descricao
    ];

    if (!$this->epiModel->insert($dados)) {
        $caminhoImagem = FCPATH . 'uploads/epis/' . $nomeImagem;

        if (is_file($caminhoImagem)) {
            unlink($caminhoImagem);
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Não foi possível cadastrar o EPI.');
    }

    $idEpi = $this->epiModel->getInsertID();

    $modelEpiAdm = new EpiAdmModel();

    if (!$modelEpiAdm->insert([
        'FK_EPI_ADM' => $idEpi,
        'FK_ADMINISTRADOR_CPF' => $cpf
    ])) {
        $this->epiModel->delete($idEpi);

        $caminhoImagem = FCPATH . 'uploads/epis/' . $nomeImagem;

        if (is_file($caminhoImagem)) {
            unlink($caminhoImagem);
        }

        return redirect()->to('/epi')
            ->with('error', 'Não foi possível vincular o EPI ao administrador.');
    }

    return redirect()->to('/epi')
        ->with('sucesso', 'EPI cadastrado com sucesso!');
}


 public function atualizar($id)
{
    $cpf = session()->get('cpf');

    if (!$cpf) {
        return redirect()->to('/login');
    }

    $nome = trim($this->request->getPost('nome_epi') ?? '');
    $descricao = trim($this->request->getPost('des_epi') ?? '');

    if (empty($nome) || empty($descricao)) {
        return redirect()->to('/epi')
            ->with('error', 'Preencha todos os campos obrigatórios.');
    }

    // Confirma que o EPI pertence ao administrador logado
    $modelEpiAdm = new EpiAdmModel();

    $relacao = $modelEpiAdm
        ->where('FK_ADMINISTRADOR_CPF', $cpf)
        ->where('FK_EPI_ADM', $id)
        ->first();

    if (!$relacao) {
        return redirect()->to('/epi')
            ->with('error', 'EPI não encontrado ou sem permissão para edição.');
    }

    // Ignora o próprio registro, mas bloqueia outros iguais
    if ($this->epiJaCadastrado($nome, $cpf, $id)) {
        return redirect()->to('/epi')
            ->with('error', 'Já existe outro EPI desse tipo cadastrado!');
    }

    $this->epiModel->update($id, [
        'NOME_EPI' => $nome,
        'DESCRICAO_EPI' => $descricao
    ]);

    return redirect()->to('/epi')
        ->with('sucesso', 'EPI atualizado com sucesso!');
}

    // EXCLUIR
    public function excluir($id)
    {
        $this->epiModel->delete($id);

        return redirect()->to('/epi');
    }




    private function epiJaCadastrado($nome, $cpf, $ignorarId = null)
{
    $modelEpiAdm = new EpiAdmModel();

    $relacoes = $modelEpiAdm
        ->where('FK_ADMINISTRADOR_CPF', $cpf)
        ->findAll();

    $ids = array_column($relacoes, 'FK_EPI_ADM');

    if (empty($ids)) {
        return false;
    }

    $epis = $this->epiModel
        ->whereIn('ID', $ids)
        ->findAll();

    $normalizar = function ($texto) {
        return mb_strtolower(trim($texto), 'UTF-8');
    };

    foreach ($epis as $epi) {
        if (
            $ignorarId !== null &&
            (int) $epi['ID'] === (int) $ignorarId
        ) {
            continue;
        }

        if (
            $normalizar($epi['NOME_EPI']) ===
            $normalizar($nome)
        ) {
            return true;
        }
    }

    return false;
}
}