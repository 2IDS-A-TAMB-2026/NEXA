<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FunEpiModel;

class FunEpiController extends BaseController
{
    protected $FunEpiModel;

    public function __construct()
    {
        $this->FunEpiModel = new FunEpiModel();
    }

    // LISTAGEM
    public function index()
    {
        $dados['FunEpi'] =
            $this->FunEpiModel->findAll();

        return view('FunEpi/index', $dados);
    }

    // FORM NOVO
    public function novo()
    {
        return view('fun_epi/novo');
    }

    // INSERIR
    public function inserir()
    {
        $dados = [
            'FK_EPI_ID' =>
                $this->request->getPost('FK_EPI_ID'),

            'FK_FUNCI_CPF' =>
                $this->request->getPost('FK_FUNCI_CPF')
        ];

        $this->FunEpiModel->insert($dados);

        return redirect()->to('/fun_epi');
    }

    // FORM EDITAR
    public function editar($id)
    {
        $dados['funEpi'] =
            $this->FunEpiModel->find($id);

        return view('fun_epi/editar', $dados);
    }

    // ATUALIZAR
    public function atualizar($id)
    {
        $dados = [
            'FK_EPI_ID' =>
                $this->request->getPost('FK_EPI_ID'),

            'FK_ADMINISTRADOR_CPF' =>
                $this->request->getPost('FK_FUNCI_CPF')
        ];

        $this->FunEpiModel->update($id, $dados);

        return redirect()->to('/fun_epi');
    }

    // EXCLUIR
    public function excluir($id)
    {
        $this->FunEpiModel->delete($id);

        return redirect()->to('/fun_epi');
    }
}
?>