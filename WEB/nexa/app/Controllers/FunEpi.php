<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FunEpi;

class FunEpiController extends BaseController
{
    protected $funEpiModel;

    public function __construct()
    {
        $this->funEpiModel = new FunEpi();
    }

    public function index()
    {
        $dados['funEpi'] = $this->funEpiModel
            ->join(
                'FUNCIONARIO',
                'FUNCIONARIO.CPF = FUN_EPI.FK_FUNCIONARIO_CPF'
            )
            ->join(
                'EPI',
                'EPI.ID = FUN_EPI.FK_EPI_ID'
            )
            ->findAll();

        return view('fun_epi/index', $dados);
    }

    public function novo()
    {
        return view('fun_epi/novo');
    }

    public function inserir()
    {
        $dados = [
            'FK_FUNCIONARIO_CPF' => $this->request->getPost('FK_FUNCIONARIO_CPF'),
            'FK_EPI_ID' => $this->request->getPost('FK_EPI_ID')
        ];

        $this->funEpiModel->insert($dados);

        return redirect()->to('/fun_epi');
    }

    public function editar($id)
    {
        $dados['funEpi'] = $this->funEpiModel->find($id);

        return view('fun_epi/editar', $dados);
    }

    public function atualizar($id)
    {
        $dados = [
            'FK_FUNCIONARIO_CPF' => $this->request->getPost('FK_FUNCIONARIO_CPF'),
            'FK_EPI_ID' => $this->request->getPost('FK_EPI_ID')
        ];

        $this->funEpiModel->update($id, $dados);

        return redirect()->to('/fun_epi');
    }

    public function excluir($id)
    {
        $this->funEpiModel->delete($id);

        return redirect()->to('/fun_epi');
    }
}