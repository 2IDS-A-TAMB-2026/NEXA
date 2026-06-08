<?php

namespace App\Controllers;

use App\Models\LoginFunModel;

class LoginFunController extends BaseController
{
    public function index()
    {
        return view('/loginfun');
    }

    public function autenticar()
    {
        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');

        $model = new LoginFunModel();

        $funcionario = $model
            ->verificarLogin($email);

        if ($funcionario) {

        if (password_verify($senha, $funcionario['SENHA'])) {

                session()->set([

                    'cpf' => $funcionario['CPF'],
                    'nome' => $funcionario['NOME_COMPLETO'],
                    'email' => $funcionario['EMAIL_CORPORATIVO'],
                    'logado_fun' => true

                ]);

                

                return redirect()
                    ->to('/dashboardfun');
            }
        }

        return redirect()
            ->back()
            ->with(
                'erro',
                'Email ou senha inválidos'
            );
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/loginfun');
    }
}