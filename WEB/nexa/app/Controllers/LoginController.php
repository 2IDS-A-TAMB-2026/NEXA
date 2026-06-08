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

        $usuario = $model
            ->where('EMAIL_CORPORATIVO', $email)
            ->where('SENHA', $senha)
            ->first();

        if ($usuario) {

            if ($senha == $usuario['SENHA']) {

                session()->set([
                    'cpf' => $usuario['CPF'],
                    'nome' => $usuario['NOME_COMPLETO'],
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