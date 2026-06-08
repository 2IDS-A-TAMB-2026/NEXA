<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdministradorModel;

class AdministradorController extends BaseController
{
    protected $administradorModel;

    public function __construct()
    {
        $this->administradorModel = new AdministradorModel();
    }

    // LISTAGEM
    /*public function index()
    {
        $dados['administradores'] = $this->administradorModel->findAll();

        return view('Administrador/index', $dados);
    } a gente vai precisar listar os administradores?*/

public function index()
{
    $cpf = session()->get('cpf');

    $dados['administrador'] =
        $this->administradorModel->find($cpf);

    return view(
        'sistema/Administrador/index',
        $dados
    );
}

    // FORM NOVO
    /*public function novo()
    {
        return view('Administrador/novo');
    }*/ //cadastro de admin é pelo banco

    // INSERIR
    public function inserir()
    {
        $dados = [
            'CPF' => $this->request->getPost('CPF'),
            'NOME_COMPLETO' => $this->request->getPost('NOME_COMPLETO'),
            'DATA_NASCIMENTO' => $this->request->getPost('DATA_NASCIMENTO'),
            'EMAIL_CORPORATIVO' => $this->request->getPost('EMAIL_CORPORATIVO'),
            'TELEFONE' => $this->request->getPost('TELEFONE'),
            'SENHA' => $this->request->getPost('SENHA')
            //'FK_ID_CAMERA' => $this->request->getPost('FK_ID_CAMERA')
        ];

        $this->administradorModel->insert($dados);

        return redirect()->to('/administrador');
    }

    // FORM EDITAR
    public function editar($cpf)
    {
        $dados['administrador'] =
            $this->administradorModel->find($cpf);

        return view('sistema/Administrador/index', $dados);//adm já edita na página de perfil
    }

    // ATUALIZAR
    public function atualizar($cpf)
    {
        $this->administradorModel = new AdministradorModel();

        $dados = [
            'NOME_COMPLETO'     => $this->request->getPost('NOME_COMPLETO'),
            'EMAIL_CORPORATIVO' => $this->request->getPost('EMAIL_CORPORATIVO'),
            'TELEFONE'          => $this->request->getPost('TELEFONE'),
        ];

        // Se o usuário digitou uma nova senha, atualiza. Se não, mantém a antiga.
        $novaSenha = $this->request->getPost('SENHA');
        if (!empty($novaSenha) && $novaSenha !== '°°°°°°°°°') {
            $dados['SENHA'] = password_hash($novaSenha, PASSWORD_DEFAULT); 
        }

        if ($this->administradorModel->update($cpf, $dados)) {
            // Atualiza os dados da sessão atual para refletir na tela imediatamente
            session()->set([
                'nome'     => $dados['NOME_COMPLETO'],
                'email'    => $dados['EMAIL_CORPORATIVO'],
                'telefone' => $dados['TELEFONE']
            ]);

            return redirect()->to('/sistema/administrador/index')->with('success', 'Perfil atualizado com sucesso!');
        }

        return redirect()->back()->with('error', 'Erro ao atualizar perfil.');
    }

    // EXCLUIR
    public function excluir($cpf)
    {
        $this->administradorModel->delete($cpf);

        return redirect()->to('/administrador/index');
    }
}