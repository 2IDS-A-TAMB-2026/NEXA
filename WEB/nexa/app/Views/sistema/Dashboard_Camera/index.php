<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <title>Dashboard de Câmeras</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet"
          href="<?= base_url('assets/css/acessibilidade.css') ?>">

    <link rel="stylesheet"
          href="<?= base_url('assets/css/style_geral.css') ?>">

    <link rel="stylesheet"
          href="<?= base_url('assets/css/dashboard_camera.css') ?>">

    <style>
    body{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 16px;
    }

    header h1{
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    header p{
        font-size: 16px;
        color: #666;
        margin-bottom: 30px;
    }

    .camera-card{
        font-size: 16px;
    }

    .camera-nome{
        font-size: 18px;
        font-weight: 600;
    }

    .setor{
        font-size: 15px;
    }

    .texto-status{
        font-size: 14px;
    }
</style>

</head>

<body>

<!-- SIDEBAR -->
  <aside class="sidebar">

        <div class="sidebar-logo">
            <img src="<?= base_url('assets/images/logo_escura_transparente.png') ?>">
        </div>

        <nav class="menu">

            <a href="<?= base_url('/dashboard') ?>">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>

            <a href="<?= base_url('/dashboard_camera') ?>"class="active">
                <i class="fas fa-video"></i>
                <span>Dashboard de Câmeras</span>
            </a>

            <a href="<?= base_url('/ocorrencia') ?>" >
                <i class="fas fa-exclamation-triangle"></i>
                <span>Ocorrências</span>
            </a>

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

            <a href="<?= base_url('/administrador') ?>">
                <i class="fas fa-user"></i>
                <span>Perfil</span>
            </a>

        </nav>

        <a href="<?= base_url('/') ?>" class="logout-item">
            <i class="fas fa-sign-out-alt"></i>
            <span>Sair</span>
        </a>

    </aside>

<!-- ACESSIBILIDADE -->
<div class="access-bar">

    <button class="access-btn">
        <i class="fas fa-adjust"></i>
    </button>

    <button class="access-btn">
        <i class="fas fa-moon"></i>
    </button>

    <button class="access-btn">A+</button>

    <button class="access-btn">A-</button>

    <button class="access-btn">
        <i class="fas fa-volume-up"></i>
    </button>

</div>
<div class="overlay">

    <header>

        <h1>Dashboard de Câmeras</h1>

        <p style="color:white;">
            Monitoramento das câmeras cadastradas
        </p>

    </header>

    <form method="GET">

        <div class="filtros">

            <input
                type="text"
                name="buscar"
                placeholder="Pesquisar câmera ou setor..."
                value="<?= isset($buscar) ? $buscar : '' ?>">

            <button
                type="submit"
                class="btn-filtrar">

                Filtrar

            </button>

        </div>

    </form>

    <div class="cameras-grid">

        <?php foreach($cameras as $camera): ?>

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

                    <?php if(strtoupper($camera['STATUS']) == 'ATIVA'): ?>

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

    <footer>
        © 2026 – NEXA | Segurança no centro
    </footer>

</div>

<script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>

</body>
</html>