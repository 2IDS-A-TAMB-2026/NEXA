<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CameraModel;
use App\Models\SetorModel;
use App\Models\EmpresaModel;
use App\Models\AdministradorModel;

class CameraController extends BaseController
{
    /**
     * Exibe a tela de cadastro e a listagem das câmeras.
     */
    public function index()
    {
        $modelCamera = new CameraModel();
        $modelSetor = new SetorModel();
        $modelEmpresa = new EmpresaModel();
        $modelAdministrador = new AdministradorModel();

        // Recupera o administrador logado
        $cpf = session()->get('cpf');

        if (!$cpf) {
            return redirect()->to('/login');
        }

        $dados_adm = $modelAdministrador->find($cpf);

        if (!$dados_adm) {
            return redirect()->to('/login')
                ->with('error', 'Administrador não encontrado.');
        }

        // Recupera o CNPJ da empresa vinculada ao administrador
        $cnpjEmpresa = $dados_adm['FK_CNPJ_EMPRESA'];

        // Busca a empresa
        $empresa = $modelEmpresa->find($cnpjEmpresa);

        if (!$empresa) {
            return redirect()->back()
                ->with('error', 'Empresa não encontrada.');
        }

        // Busca somente as câmeras da empresa do administrador logado
        $cameras = $modelCamera
            ->where('FK_CNPJ_EMPRESA', $cnpjEmpresa)
            ->findAll();

        // Busca somente os setores da empresa
        $setores = $modelSetor
            ->where('FK_CNPJ_EMPRESA', $cnpjEmpresa)
            ->findAll();

        $dados = [
            'cameras' => $cameras,
            'setor'   => $setores,
            'empresa' => $empresa
        ];

        return view('sistema/Camera/index', $dados);
    }


    /**
     * Cadastra uma nova câmera.
     */
    public function inserir()
    {
        $modelCamera = new CameraModel();
        $modelAdministrador = new AdministradorModel();

        // Recupera o administrador logado
        $cpf = session()->get('cpf');

        if (!$cpf) {
            return redirect()->to('/login');
        }

        $dados_adm = $modelAdministrador->find($cpf);

        if (!$dados_adm) {
            return redirect()->back()
                ->with('error', 'Administrador não encontrado.');
        }

        // Dados enviados pelo formulário
        $nome = trim($this->request->getPost('nome'));
        $status = trim($this->request->getPost('status'));
        $idSetor = trim($this->request->getPost('idSetor'));

        // Validação básica
        if ($nome === '' || $status === '' || $idSetor === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Preencha todos os campos obrigatórios.');
        }

        // CNPJ da empresa do administrador logado
        $cnpjEmpresa = $dados_adm['FK_CNPJ_EMPRESA'];

        // Dados que serão inseridos
        $dados = [
            'IDENTIFICADOR_CAMERA' => $nome,
            'STATUS'               => $status,
            'FK_ID_SETOR'          => $idSetor,
            'FK_CNPJ_EMPRESA'      => $cnpjEmpresa
        ];

        // Tenta inserir
        if (!$modelCamera->insert($dados)) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Não foi possível cadastrar a câmera.'
                );
        }

        return redirect()->to(base_url('/Camera'))
            ->with(
                'success',
                'Câmera cadastrada com sucesso!'
            );
    }


    /**
     * Abre a tela de edição.
     */
    public function editar($id)
    {
        $modelCamera = new CameraModel();
        $modelSetor = new SetorModel();
        $modelEmpresa = new EmpresaModel();

        $dados = [
            'cameras' => $modelCamera->findAll(),
            'camera'  => $modelCamera->find($id),
            'setor'   => $modelSetor->findAll(),
            'empresa' => $modelEmpresa->findAll()
        ];

        return view('sistema/Camera/index', $dados);
    }


    /**
     * Atualiza uma câmera.
     */
    public function atualizar($id)
    {
        $modelCamera = new CameraModel();
        $modelAdministrador = new AdministradorModel();

        $cpf = session()->get('cpf');

        if (!$cpf) {
            return redirect()->to('/login');
        }

        $dados_adm = $modelAdministrador->find($cpf);

        if (!$dados_adm) {
            return redirect()->back()
                ->with('error', 'Administrador não encontrado.');
        }

        $nome = trim($this->request->getPost('nome'));
        $status = trim($this->request->getPost('status'));
        $idSetor = trim($this->request->getPost('idSetor'));

        if ($nome === '' || $status === '' || $idSetor === '') {
            return redirect()->back()
                ->with('error', 'Preencha todos os campos obrigatórios.');
        }

        $dados = [
            'IDENTIFICADOR_CAMERA' => $nome,
            'STATUS'               => $status,
            'FK_ID_SETOR'          => $idSetor,
            'FK_CNPJ_EMPRESA'      => $dados_adm['FK_CNPJ_EMPRESA']
        ];

        if (!$modelCamera->update($id, $dados)) {

            return redirect()->back()
                ->with('error', 'Não foi possível atualizar a câmera.');
        }

        return redirect()->to(base_url('/Camera'))
            ->with(
                'success',
                'Câmera atualizada com sucesso!'
            );
    }


    /**
     * Exclui uma câmera.
     */
    public function excluir($id)
    {
        $modelCamera = new CameraModel();

        if (!$modelCamera->delete($id)) {

            return redirect()->back()
                ->with(
                    'error',
                    'Não foi possível excluir a câmera.'
                );
        }

        return redirect()->to(base_url('/Camera'))
            ->with(
                'success',
                'Câmera excluída com sucesso!'
            );
    }
}