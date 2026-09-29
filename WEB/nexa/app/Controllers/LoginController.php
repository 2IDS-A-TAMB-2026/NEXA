<?php

namespace App\Controllers;

use App\Models\AdministradorModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login');
    }


public function autenticar()
{
    $email = $this->request->getPost('email');
    $senha = $this->request->getPost('senha');

    $model = new AdministradorModel();

    // Busca somente pelo e-mail
    $usuario = $model
        ->where('EMAIL_CORPORATIVO', $email)
        ->first();

    if ($usuario) {

        $senhaBanco = $usuario['SENHA'];

        /*
         * Aceita os dois formatos:
         * 1. Senha criptografada com password_hash()
         * 2. Senha salva diretamente em texto
         */

        $senhaValida = false;

        // Tenta verificar como senha criptografada
        if (password_verify($senha, $senhaBanco)) {
            $senhaValida = true;
        }

        // Se não for hash, compara diretamente
        if (!$senhaValida && $senha === $senhaBanco) {
            $senhaValida = true;
        }

        if ($senhaValida) {

            session()->set([
                'cpf'    => $usuario['CPF'],
                'nome'   => $usuario['NOME_COMPLETO'],
                'logado' => true
            ]);

            return redirect()->to('/dashboard');
        }
    }

    return redirect()->back()
        ->with('erro', 'Email ou senha inválidos');
}

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}