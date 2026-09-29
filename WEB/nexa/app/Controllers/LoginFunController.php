<?php

namespace App\Controllers;

use App\Models\LoginFunModel;

class LoginFunController extends BaseController
{
    public function index()
    {
        return view('loginfun');
    }

    public function autenticar()
    {
        $email = $this->request->getPost('email_fun');
        $senha = $this->request->getPost('senha');

        $model = new LoginFunModel();

        $funcionario = $model->verificarLogin($email);

        if ($funcionario) {

            if (password_verify($senha, $funcionario['SENHA'])) {

                session()->set([
                    'cpf_fun' => $funcionario['CPF'],
                    'nome_fun' => $funcionario['NOME_COMPLETO'],
                    'email_fun' => $funcionario['EMAIL_CORPORATIVO'],
                    'logado_fun' => true,

                    // Login normal, não RFID
                    'rfid_login' => false,

                    // Limpa informações antigas do RFID
                    'camera_rfid' => null,
                    'terminal_id' => null,
                    'totem_id' => null
                ]);

                return redirect()->to('/dashboardfun');
            }
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('erro', 'E-mail ou senha inválidos.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/loginfun');
    }
}