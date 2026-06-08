<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <title>NEXA | Funcionário</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- ÍCONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- ACESSIBILIDADE -->
    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade_login.css') ?>">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Inter', sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#0057b8,#002f6c);
            padding:20px;
            overflow:hidden;
            position:relative;
        }

        body::before{
            content:"";
            position:absolute;
            width:100%;
            height:100%;
            background:
            radial-gradient(circle at top left,
            rgba(255,255,255,.08),
            transparent 40%),

            radial-gradient(circle at bottom right,
            rgba(255,255,255,.05),
            transparent 40%);
        }

        /* ACESSIBILIDADE */

        .access-bar{
            position:absolute;
            top:15px;
            right:15px;
            display:flex;
            gap:10px;
            z-index:100;
        }

        .access-btn{
            width:42px;
            height:42px;
            border:none;
            border-radius:12px;
            background:#fff;
            color:#0057b8;
            cursor:pointer;
            font-size:16px;
        }

        /* CARD */

        .login-container{
            width:850px;
            height:460px;
            background:#fff;
            border-radius:28px;
            overflow:hidden;
            display:flex;
            box-shadow:0 20px 50px rgba(0,0,0,.35);
            position:relative;
            z-index:2;
        }

        /* ESQUERDA */

        .left-side{
            width:45%;
            background:linear-gradient(145deg,#0057b8,#002f6c);
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .logo-box img{
            width:180px;
        }

        /* DIREITA */

        .right-side{
            width:55%;
            padding:45px;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .titulo{
            text-align:center;
            font-size:32px;
            color:#0d2f5f;
            margin-bottom:10px;
        }

        .subtitulo{
            text-align:center;
            margin-bottom:25px;
            color:#666;
        }

        /* ERRO */

        .erro-login{
            background:#ffe5e5;
            color:#d90429;
            padding:12px;
            border-radius:10px;
            margin-bottom:15px;
            text-align:center;
            font-size:14px;
            font-weight:600;
        }

        /* INPUTS */

        .input-box{
            position:relative;
            margin-bottom:15px;
        }

        .input-box i{
            position:absolute;
            left:15px;
            top:50%;
            transform:translateY(-50%);
            color:#999;
        }

        .input-box input{
            width:100%;
            height:48px;
            border:2px solid #d1d5db;
            border-radius:12px;
            padding-left:45px;
            font-size:14px;
            outline:none;
        }

        /* BOTÃO */

        .btn-login{
            width:100%;
            height:48px;
            border:none;
            border-radius:12px;
            background:linear-gradient(90deg,#0066d6,#003f96);
            color:white;
            font-size:18px;
            font-weight:bold;
            cursor:pointer;
        }

        .btn-login:hover{
            opacity:.9;
        }

        /* LINKS */

        .links{
            margin-top:20px;
            text-align:center;
        }

        .links a{
            display:block;
            text-decoration:none;
            margin-bottom:10px;
            color:#0066d6;
        }

        .footer{
            margin-top:10px;
            text-align:center;
            color:#999;
        }

        @media(max-width:900px){

            .login-container{
                flex-direction:column;
                height:auto;
            }

            .left-side,
            .right-side{
                width:100%;
            }

            .left-side{
                padding:30px;
            }

        }

    </style>

</head>

<body>

    <!-- ACESSIBILIDADE -->

    <div class="access-bar">

        <button class="access-btn" onclick="Acessibilidade.toggleContraste()">
            <i class="fas fa-adjust"></i>
        </button>

        <button class="access-btn" onclick="Acessibilidade.toggleDark()">
            <i class="fas fa-moon"></i>
        </button>

        <button class="access-btn" onclick="Acessibilidade.aumentarFonte()">
            A+
        </button>

        <button class="access-btn" onclick="Acessibilidade.diminuirFonte()">
            A-
        </button>

        <button class="access-btn">
            <i class="fas fa-volume-up"></i>
        </button>

    </div>

    <!-- LOGIN -->

    <div class="login-container">

        <!-- ESQUERDA -->

        <div class="left-side">

            <div class="logo-box">

                <img src="<?= base_url('assets/images/logo_escura_transparente.png') ?>">

            </div>

        </div>

        <!-- DIREITA -->

        <div class="right-side">

            <h1 class="titulo">
                Login
            </h1>

            <p class="subtitulo">
                Área do Funcionário
            </p>

            <!-- ERRO -->

            <?php if(session()->getFlashdata('erro')): ?>

                <div class="erro-login">

                    <?= session()->getFlashdata('erro') ?>

                </div>

            <?php endif; ?>

            <form method="post" action="<?= base_url('/loginfun/autenticar') ?>">

                <div class="input-box">

                    <i class="fas fa-envelope"></i>

                    <input type="email"
                           name="email"
                           placeholder="E-mail corporativo"
                           required>

                </div>

                <div class="input-box">

                    <i class="fas fa-lock"></i>

                    <input type="password"
                           name="senha"
                           placeholder="Senha"
                           required>

                </div>

                <button type="submit" class="btn-login">

                    Entrar

                </button>

            </form>

            <div class="links">

                <a href="<?= base_url('recuperar') ?>">
                  Esqueci minha senha
                </a>
                 
                <a href="<?= base_url('/') ?>">
                    Voltar para página inicial
                </a>

            </div>

            <div class="footer">

                © 2026 — NEXA

            </div>

        </div>

    </div>

    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>

</body>

</html>