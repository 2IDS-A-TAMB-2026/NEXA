<?php

namespace App\Controllers;

use App\Models\FuncionarioModel;

class CadastroFunController extends BaseController
{
    public function index()
    {
         $model = new FuncionarioModel();

         $dados['funcionarios'] = $model->findAll();

         return view('sistema/Cadastro_Fun/index', $dados);
    }

    public function inserir()
    {
        $model = new FuncionarioModel();

        $dados = [

            'NOME_COMPLETO' => $this->request->getPost('NOME_COMPLETO'),

            'CPF' => $this->request->getPost('CPF'),

            'DATA_NASCIMENTO' => $this->request->getPost('DATA_NASCIMENTO'),

            'EMAIL_CORPORATIVO' => $this->request->getPost('EMAIL_CORPORATIVO'),

            'TELEFONE' => $this->request->getPost('TELEFONE'),

            'UID_RFID' => $this->request->getPost('UID_RFID'),

            'FK_CNPJ_EMPRESA' => $this->request->getPost('FK_CNPJ_EMPRESA'),

            'FK_ID_SETOR' => $this->request->getPost('FK_ID_SETOR'),

            'SENHA' => password_hash(
                $this->request->getPost('SENHA'),
                PASSWORD_DEFAULT
            ),

            'FK_ADMINISTRADOR_CPF' => '100.000.000-01'

        ];

        $model->insert($dados);

        return redirect()->to('/cadastro-funcionario');
    }
}