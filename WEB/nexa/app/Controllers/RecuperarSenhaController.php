<?php

namespace App\Controllers;

use App\Models\LoginFunModel;
use App\Models\RecuperarSenhaModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RecuperarSenhaController extends BaseController
{
    public function index()
    {
          return view('sistema/RecuperarSenha/index');
    }

    public function enviar()
    {
        $email = $this->request->getPost('email');

        $funcionarioModel = new LoginFunModel();

        $usuario =
            $funcionarioModel
            ->where('EMAIL_CORPORATIVO', $email)
            ->first();

        if (!$usuario) {

            return $this->response
                ->setStatusCode(404)
                ->setBody('E-mail não encontrado');
        }

        $token = bin2hex(random_bytes(32));

        $expira = date(
            'Y-m-d H:i:s',
            strtotime('+1 hour')
        );

        $recuperarModel =
            new RecuperarSenhaModel();

        $recuperarModel->insert([
            'EMAIL' => $email,
            'TOKEN' => $token,
            'EXPIRA_EM' => $expira
        ]);

        $link =
            base_url(
                'nova-senha?token='
                . $token
            );

        try {

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            

            $mail->Host = 'smtp.gmail.com';

            $mail->SMTPAuth = true;

            $mail->Username =
                'nexa.senai@gmail.com';

            $mail->Password =
                'zwik bfpw rdtw qxcw';

            $mail->SMTPSecure =
                PHPMailer::ENCRYPTION_STARTTLS;

            $mail->Port = 587;

            $mail->CharSet = 'UTF-8';

            $mail->setFrom(
                'nexa.senai@gmail.com',
                'NEXA'
            );

            $mail->addAddress($email);

            $mail->isHTML(true);

            $mail->Subject =
                'Recuperação de Senha';

            $mail->Body = "

            <h2>Recuperação de Senha</h2>

            <p>
            Clique no botão abaixo:
            </p>

            <a href='$link'
            style='
                background:#0057b8;
                color:white;
                padding:12px 20px;
                border-radius:10px;
                text-decoration:none;
                display:inline-block;
            '>

            Redefinir Senha

            </a>

            <p>
            O link expira em 1 hora.
            </p>
            ";


            $mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';

            $mail->send();

            return $this->response
                ->setBody('sucesso');

        } catch (\Exception $e) {

            return $this->response
                ->setBody(
                    'Erro ao enviar e-mail'
                );
        }
    }
}