<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>NEXA | Ocorrências</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet"
        href="<?= base_url('assets/css/acessibilidade.css') ?>">

    <link rel="stylesheet"
        href="<?= base_url('assets/css/style_geral.css') ?>">

    <link rel="stylesheet"
        href="<?= base_url('assets/css/ocorrencia.css') ?>">

    <style>
        .alto-contraste .btn-limpar,
        .alto-contraste #filtroFuncionario,
        .alto-contraste #filtroStatus{
            color:#000;
            background-color: yellow;
        }

        .alto-contraste #monitoramento{color: yellow}
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

            <a href="<?= base_url('/dashboard_camera') ?>">
                <i class="fas fa-video"></i>
                <span>Dashboard de Câmeras</span>
            </a>

            <a href="<?= base_url('/ocorrencia') ?>" class="active">
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

        <button class="access-btn"
            onclick="Acessibilidade.toggleContraste()">
            <i class="fas fa-adjust"></i>
        </button>

        <button class="access-btn"
            onclick="toggleDark()">
            <i class="fas fa-moon"></i>
        </button>

        <button class="access-btn"
            onclick="Acessibilidade.aumentarFonte()">
            A+
        </button>

        <button class="access-btn"
            onclick="Acessibilidade.diminuirFonte()">
            A-
        </button>

        <button class="access-btn"
            onclick="Acessibilidade.lerPagina()">
            <i class="fas fa-volume-up"></i>
        </button>

    </div>

    <!-- MAIN -->
         <div class="overlay">
    
        <header>
            <h1>Ocorrências</h1>
            <p id="monitoramento">Monitoramento de eventos de segurança</p>
        </header>

        <!-- FILTROS -->

        <div class="filtros">

            <input type="text"
                id="filtroFuncionario"
                placeholder="Buscar funcionário...">

            <select id="filtroStatus">

                <option value="">Todos status</option>
                <option value="violacao">Violação</option>
                <option value="conforme">Conforme</option>

            </select>

            <input type="date" id="filtroData">

            <button class="btn-limpar"
                onclick="limparFiltros()">
                Limpar
            </button>

        </div>

        <!-- CARDS -->

        <div class="ocorrencias">

            <?php if (!empty($ocorrencias)) : ?>

                <?php foreach ($ocorrencias as $o) : ?>

                    <?php

                        $statusClasse = 'conforme';
                        $icone = 'fa-circle-check';
                        $texto = 'Conforme';

                        if ($o['STATUS_OCORRENCIA'] == 'Irregular') {

                            $statusClasse = 'violacao';
                            $icone = 'fa-exclamation-triangle';
                            $texto = 'Violação';

                        }

                    ?>

                    <div class="card <?= $statusClasse ?>"

                        data-funcionario="<?= strtolower($o['NOME_COMPLETO'] ?? 'não informado') ?>"

                        data-status="<?= $statusClasse ?>"

                        data-data="<?= $o['DATA_ANALISE'] ?>">

                        <div class="card-header">

                            <i class="fas <?= $icone ?>"></i>

                            <?= $texto ?> -
                            <?= $o['IDENTIFICADOR_CAMERA'] ?>

                        </div>

                        <div class="info-grid">

                            <div>
                                <strong>Funcionário:</strong>
                                <?= $o['NOME_COMPLETO'] ?? 'Não informado' ?>
                            </div>

                            <div>
                                <strong>Local:</strong>
                                <?= $o['SETOR'] ?? 'Não informado' ?>
                            </div>

                            <div>
                                <strong>Data:</strong>

                                <?= date(
                                    'd/m/Y',
                                    strtotime($o['DATA_ANALISE'])
                                ) ?>

                            </div>

                            <div>
                                <strong>Hora:</strong>
                                <?= $o['HORA_ANALISE'] ?>
                            </div>

                        </div>

                        <div class="epi-box">

                            <span class="ok">

                                <i class="fas fa-check"></i>

                                <?= $o['EPIS_DETECTADOS'] ?>

                            </span>

                            <?php if (
                                isset($o['EPIS_AUSENTE']) &&
                                $o['EPIS_AUSENTE'] != 'Nenhum'
                            ) : ?>

                                <span class="fail">

                                    <i class="fas fa-xmark"></i>

                                    <?= $o['EPIS_AUSENTE'] ?>

                                </span>

                            <?php endif; ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <div class="card">
                    Nenhuma ocorrência encontrada.
                </div>

            <?php endif; ?>

        </div>

        <footer>
            © 2026 – NEXA | Segurança no centro
        </footer>

    </main>

    <!-- JS -->

    <script>

        const filtroFuncionario =
            document.getElementById('filtroFuncionario');

        const filtroStatus =
            document.getElementById('filtroStatus');

        const filtroData =
            document.getElementById('filtroData');

        const cards =
            document.querySelectorAll('.card');

        function filtrarOcorrencias(){

            const nome =
                filtroFuncionario.value.toLowerCase();

            const status =
                filtroStatus.value;

            const data =
                filtroData.value;

            cards.forEach(card => {

                const funcionario =
                    card.dataset.funcionario || '';

                const cardStatus =
                    card.dataset.status || '';

                const cardData =
                    card.dataset.data || '';

                const matchNome =
                    funcionario.includes(nome);

                const matchStatus =
                    status === '' ||
                    cardStatus === status;

                const matchData =
                    data === '' ||
                    cardData === data;

                if(
                    matchNome &&
                    matchStatus &&
                    matchData
                ){
                    card.style.display = 'block';
                }else{
                    card.style.display = 'none';
                }

            });

        }

        function limparFiltros(){

            filtroFuncionario.value = '';
            filtroStatus.value = '';
            filtroData.value = '';

            filtrarOcorrencias();

        }

        filtroFuncionario.addEventListener(
            'keyup',
            filtrarOcorrencias
        );

        filtroStatus.addEventListener(
            'change',
            filtrarOcorrencias
        );

        filtroData.addEventListener(
            'change',
            filtrarOcorrencias
        );

        function toggleDark(){
            document.body.classList.toggle('dark-mode');
        }

    </script>

    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>

</body>

</html>