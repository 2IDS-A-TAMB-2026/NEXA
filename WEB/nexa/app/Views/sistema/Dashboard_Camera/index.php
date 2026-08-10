<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <title>Dashboard de Câmeras</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/style_geral.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard_camera.css') ?>">

  

</head>

<body>
<aside class="sidebar">

    <!-- FUNDO -->
    <img
        class="sidebar-construction"
        src="<?= base_url('assets/images/construcao.jpg') ?>"
        alt=""
    >

    <!-- CONTEÚDO -->
    <div class="sidebar-content">

        <div class="sidebar-logo">

    <img src="<?= base_url('assets/images/logo_escura_transparente.png') ?>">

    <div class="sidebar-brand-text">
        <strong>NEXA</strong>
        <span>Segurança é prioridade</span>
    </div>

</div>


        <nav class="menu">

            <div class="menu-title">PRINCIPAL</div>

            <a href="<?= base_url('/dashboard') ?>">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>

            <a href="<?= base_url('/dashboard_camera') ?>"  class="active">
                <i class="fas fa-video"></i>
                <span>Dashboard de Câmeras</span>
            </a>

            <a href="<?= base_url('/ocorrencia') ?>">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Ocorrências</span>
            </a>


            <div class="menu-title">CADASTROS</div>

            <a href="<?= base_url('/cadastro-funcionario') ?>">
                <i class="fas fa-users"></i>
                <span>Cadastro Funcionários</span>
            </a>

            <a href="<?= base_url('/epi') ?>">
                <i class="fas fa-helmet-safety"></i>
                <span>Cadastro EPIs</span>
            </a>

            <a href="<?= base_url('/Camera') ?>">
                <i class="fas fa-camera"></i>
                <span>Cadastro Câmeras</span>
            </a>

            <a href="<?= base_url('/setor') ?>">
                <i class="fas fa-building"></i>
                <span>Cadastro Setores</span>
            </a>


            <div class="menu-title">CONTA</div>

            <a href="<?= base_url('/administrador') ?>">
                <i class="fas fa-user"></i>
                <span>Perfil</span>
            </a>

        </nav>


        <a href="<?= base_url('/') ?>" class="logout-item">
            <i class="fas fa-sign-out-alt"></i>
            <span>Sair do Sistema</span>
        </a>

    </div>

</aside>

        <div class="main">

        <!-- MENU ACESSIBILIDADE -->
        <div class="access-menu">

            <button class="gear-btn" onclick="toggleAccessMenu()">
                <i class="fas fa-cog"></i>
            </button>

            <div class="access-options" id="accessOptions">

                <button class="access-btn" onclick="Acessibilidade.toggleContraste()">
                    <i class="fas fa-adjust"></i>
                </button>

                <button class="access-btn" onclick="toggleDark()">
                    <i class="fas fa-moon"></i>
                </button>

                <button class="access-btn" onclick="Acessibilidade.aumentarFonte()">
                    A+
                </button>

                <button class="access-btn" onclick="Acessibilidade.diminuirFonte()">
                    A-
                </button>

                <button class="access-btn" onclick="Acessibilidade.lerPagina()">
                    <i class="fas fa-volume-up"></i>
                </button>

            </div>

        </div>



        <header class="dashboard-header">


            <!-- ESQUERDA -->

            <div class="header-left">

                <div class="header-title">

                    <h1>
                       Dashboard de Câmeras
                    </h1>

                    <p>
                        Acompanhe as câmeras da sua empresa
                    </p>

                </div>

            </div>


            <!-- =================================================
                 DIREITA
            ================================================== -->

            <div class="header-right">


                <a
                    href="<?= base_url('/administrador') ?>"
                    class="profile"
                >


                    <!-- AVATAR -->

                    <div class="profile-avatar">

                        <?= strtoupper(
                            substr(
                                session()->get('nome'),
                                0,
                                1
                            )
                        ) ?>

                    </div>


                    <!-- INFORMAÇÕES -->

                    <div class="profile-info">

                        <strong>

                            <?= esc(
                                session()->get('nome')
                            ) ?>

                        </strong>

                        <span>
                            NEXA SOLUÇÕES
                        </span>

                    </div>


                </a>

            </div>


        </header>


        <form method="GET">

            <div class="filtros">

                <input type="text" name="buscar" placeholder="Pesquisar câmera ou setor..."
                    value="<?= isset($buscar) ? $buscar : '' ?>">

                <button type="submit" class="btn-filtrar">

                    Filtrar

                </button>

            </div>

        </form>

        <div class="cameras-grid">

            <?php foreach ($cameras as $camera): ?>

                <div class="camera-card">

                    <div class="camera-icon">
                        <i class="fas fa-video"></i>
                    </div>

                    <div class="camera-nome">
                        <?= $camera['IDENTIFICADOR_CAMERA'] ?>
                    </div>

                    <div class="setor">
                        <?= $camera['SETOR'] ?>
                    </div>

                    <div class="status-box">

                        <?php if (strtoupper($camera['STATUS']) == 'ATIVA' || strtoupper($camera['STATUS']) == 'ATIVO'): ?>

                            <span class="status ativo"></span>

                            <span class="texto-status">
                                Ativa
                            </span>

                        <?php else: ?>

                            <span class="status inativo"></span>

                            <span class="texto-status">
                                Inativa
                            </span>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

        

    </div>

    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>

    <script>
        // Função global auxiliar para o Dark Mode funcionar em conjunto
        function toggleDark() {
            document.body.classList.toggle('dark-mode');
            if (typeof atualizarLogo === 'function') {
                atualizarLogo();
            }
        }
    </script>

</body>

</html>