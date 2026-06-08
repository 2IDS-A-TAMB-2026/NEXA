<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <title>NEXA | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- ÍCONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- ACESSIBILIDADE -->
    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade_login.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
    
</head>

<body>

    <!-- BOTÕES -->
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

            <h1 class="titulo">Login</h1>

            <!-- MENSAGEM DE ERRO -->
            <?php if(session()->getFlashdata('erro')): ?>

                <div class="erro-login">
                    <?= session()->getFlashdata('erro') ?>
                </div>

            <?php endif; ?>

            <form method="post" action="<?= base_url('/login/autenticar') ?>">

                <div class="input-box">
                    <i class="fas fa-envelope"></i>

                    <input type="email" name="email" placeholder="E-mail" required>
                </div>

                <div class="input-box">
                    <i class="fas fa-lock"></i>

                    <input type="password" name="senha" placeholder="Senha" required>
                </div>

                <button type="submit" class="btn-login">
                    Entrar
                </button>

            </form>

            <div class="links">

                <a href="<?= site_url('/') ?>">
                    Voltar para a página inicial
                </a>

            </div>

            <div class="footer">
                © 2026 – NEXA
            </div>

        </div>

    </div>

    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>

</body>

</html>