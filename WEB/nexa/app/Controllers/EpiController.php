<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EpiModel;
use App\Models\FuncionarioModel;

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
        $funcionarioModel = new FuncionarioModel();

        $dados['epis'] = $this->epiModel->findAll();
        $dados['funcionarios'] = $funcionarioModel->findAll();

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
            'FK_CPF_FUNCIONARIO' => $this->request->getPost('FK_CPF_FUNCIONARIO')
        ];

        $exists = $this->epiModel
            ->where('NOME_EPI', $dados['NOME_EPI'])
            ->where('FK_CPF_FUNCIONARIO', $dados['FK_CPF_FUNCIONARIO'])
            ->first();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('erro_epi', 'Este funcionário já possui esse EPI.');
        }

        if (!$this->epiModel->insert($dados)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->epiModel->errors());
        }

        return redirect()->to('/epi')
            ->with('sucesso', 'EPI cadastrado com sucesso!');
    }


    public function atualizar($id)
    {
        $dados = [
            'NOME_EPI' => $this->request->getPost('NOME_EPI'),
            'DESCRICAO_EPI' => $this->request->getPost('DESCRICAO_EPI'),
            'FK_CPF_FUNCIONARIO' => $this->request->getPost('FK_CPF_FUNCIONARIO')
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