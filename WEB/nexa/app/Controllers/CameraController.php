<?php

namespace App\Controllers;

use App\Models\CameraModel;
use App\Models\SetorModel;

class CameraController extends BaseController
{
    public function index()
    {
        $modelCamera = new CameraModel();
        $modelSetor = new SetorModel();

        $cameras['cameras'] = $modelCamera->findAll();
        $cameras['setor'] = $modelSetor->findAll();

        return view('sistema/Camera/index', $cameras);
    }

    public function novo()
    {
        $modelCamera = new CameraModel();
        $modelSetor = new SetorModel();

        $cameras['cameras'] = $modelCamera->findAll();
        $cameras['setor'] = $modelSetor->findAll();

        return view('sistema/Camera/index', $cameras);
    }

    public function inserir()
    {
        $model = new CameraModel();

        // Remove a máscara do CNPJ antes de inserir no banco
        $cnpjLimpo = preg_replace('/\D/', '', $this->request->getPost('CNPJ'));

        $model->insert([
            'IDENTIFICADOR_CAMERA' => $this->request->getPost('nome'),
            'STATUS'               => $this->request->getPost('status'),
            'FK_ID_SETOR'          => $this->request->getPost('idSetor'),
            'FK_CNPJ_EMPRESA'      => $cnpjLimpo
        ]);

        return redirect()->to(base_url('/Camera'));
    }

    public function editar($id)
    {
        $modelCamera = new CameraModel();
        $modelSetor = new SetorModel();

        $cameras['cameras'] = $modelCamera->findAll();
        $cameras['camera']  = $modelCamera->find($id);
        $cameras['setor']   = $modelSetor->findAll();

        return view('sistema/Camera/index', $cameras);
    }

    public function atualizar($id)
    {
        $model = new CameraModel();

        // 1. Pega o valor digitado no formulário
        $cnpjPost = $this->request->getPost('cnpj');

        // 2. Limpa o CNPJ para checar apenas números
        $cnpjLimpo = preg_replace('/\D/', '', $cnpjPost);

        // 3. Descobre qual formato está gravado no banco de dados da empresa
        $db = \Config\Database::connect();
        
        // Testa primeiro o CNPJ apenas com números
        $empresa = $db->table('empresa')->where('CNPJ', $cnpjLimpo)->get()->getRow();
        $cnpjFinal = $cnpjLimpo;

        // Se não achou, testa se a empresa foi cadastrada com a máscara original (pontos/traços)
        if (!$empresa) {
            $empresa = $db->table('empresa')->where('CNPJ', $cnpjPost)->get()->getRow();
            $cnpjFinal = $cnpjPost;
        }

        // 4. Se não achou de nenhum dos dois jeitos, impede o erro 1452 e avisa o usuário
        if (!$empresa) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', "O CNPJ '{$cnpjPost}' não existe na tabela de empresas. Cadastre a empresa primeiro.");
        }

        // 5. Executa a atualização usando o CNPJ correto que o banco validou
        $model->update($id, [
            'IDENTIFICADOR_CAMERA' => $this->request->getPost('nome'),
            'STATUS'               => $this->request->getPost('status'),
            'FK_ID_SETOR'          => $this->request->getPost('idSetor'),
            'FK_CNPJ_EMPRESA'      => $cnpjFinal
        ]);

        return redirect()->to(base_url('/Camera'))->with('success', 'Câmera atualizada com sucesso!');
    }

    public function excluir($id)
    {
        $model = new CameraModel();
        $model->delete($id);

        return redirect()->to(base_url('/Camera'));
    }
}