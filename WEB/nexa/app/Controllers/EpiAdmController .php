<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EpiAdmModel;

class EpiAdmController extends BaseController
{
    protected $epiAdmModel;

    public function __construct()
    {
        $this->epiAdmModel = new EpiAdmModel();
    }

    // LISTAGEM
    public function index()
    {
        $dados['epiAdm'] =
            $this->epiAdmModel->findAll();

        return view('EpiAdm/index', $dados);
    }

    // FORM NOVO
    public function novo()
    {
        return view('EpiAdm/novo');
    }

    // INSERIR
    public function inserir()
    {
        $dados = [
            'FK_EPI_ADM' =>
                $this->request->getPost('FK_EPI_ADM'),

            'FK_ADMINISTRADOR_CPF' =>
                $this->request->getPost('FK_ADMINISTRADOR_CPF')
        ];

        $this->epiAdmModel->insert($dados);

        return redirect()->to('/epiadm');
    }

    // FORM EDITAR
    public function editar($id)
    {
        $dados['epiAdm'] =
            $this->epiAdmModel->find($id);

        return view('EpiAdm/editar', $dados);
    }

    // ATUALIZAR
    public function atualizar($id)
    {
        $dados = [
            'FK_EPI_ADM' =>
                $this->request->getPost('FK_EPI_ADM'),

            'FK_ADMINISTRADOR_CPF' =>
                $this->request->getPost('FK_ADMINISTRADOR_CPF')
        ];

        $this->epiAdmModel->update($id, $dados);

        return redirect()->to('/epiadm');
    }

    // EXCLUIR
    public function excluir($id)
    {
        $this->epiAdmModel->delete($id);

        return redirect()->to('/epiadm');
    }
}