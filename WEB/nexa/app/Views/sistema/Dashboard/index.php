<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>NEXA | Dashboard</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/style_geral.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade_adm.css') ?>">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   
</head>

<body>

    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

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

            <a href="<?= base_url('/dashboard') ?>" class="active">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>

            <a href="<?= base_url('/dashboard_camera') ?>">
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
    

    <div class="overlay">
        <div class="main">
            <header class="dashboard-header">

                <!-- ESQUERDA -->
                <div class="header-left">
                    <div class="header-title">
                        <h1>Dashboard</h1>
                        <p>Acompanhe as principais analises da sua empresa</p>
                    </div>
                </div>

                <!-- DIREITA -->
                <div class="header-right">
                    <div class="access-menu">
                        <div class="header-right">
            <div class="access-menu">
                <button class="gear-btn" onclick="toggleAccessMenu()" title="Acessibilidade">
                    <i class="fas fa-cog"></i>
                </button>

                <div class="access-options" id="accessOptions">
                    <button class="access-btn" onclick="Acessibilidade.toggleContraste()" title="Alto Contraste">
                        <i class="fas fa-adjust"></i>
                    </button>
                    <button class="access-btn" onclick="toggleDark()" title="Modo Escuro">
                        <i class="fas fa-moon"></i>
                    </button>
                    <button class="access-btn" onclick="Acessibilidade.aumentarFonte()" title="Aumentar Fonte">A+</button>
                    <button class="access-btn" onclick="Acessibilidade.diminuirFonte()" title="Diminuir Fonte">A-</button>
                    <button class="access-btn" onclick="Acessibilidade.lerPagina()" title="Ler Página">
                        <i class="fas fa-volume-up"></i>
                    </button>
                </div>
            </div>

                    <a href="<?= base_url('/administrador') ?>" class="profile">
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
                            <span>NEXA SOLUÇÕES</span>
                        </div>
                    </a>
                </div>

            </header>


            <div class="content">
                <div class="metrics">
                    <div class="metric">
                        <div class="metric-icon pessoas">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Pessoas analisadas hoje</h4>
                        <span><?= $pessoasHoje ?></span>
                    </div>

                    <div class="metric">
                        <div class="metric-icon conformidade">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>Conformidade</h4>
                        <span style="color:green;"><?= $conformidade ?>%</span>
                    </div>

                    <div class="metric">
                        <div class="metric-icon alerta">
                            <i class="fas fa-triangle-exclamation"></i>
                        </div>
                        <h4>Alertas ativos</h4>
                        <span style="color:red;"><?= $alertas ?></span>
                    </div>

                    <div class="metric">
                        <div class="metric-icon camera">
                            <i class="fas fa-video"></i>
                        </div>
                        <h4>Câmeras ativas</h4>
                        <span><?= $camerasAtivas ?></span>
                    </div>
                </div>

                <div class="graficos-grid">
                    <div class="card">
                        <h3>Controle diário de EPIs</h3>
                        <div class="chart-container">
                            <canvas id="graficoBarra"></canvas>
                        </div>
                    </div>

                    <div class="card">
                        <h3>EPIs mais ausentes</h3>
                        <div class="chart-container">
                            <canvas id="graficoPizza"></canvas>
                        </div>
                    </div>

                    <div class="card">
                        <h3>Ocorrências por câmera</h3>
                        <div class="chart-container">
                            <canvas id="linhaChart"></canvas>
                        </div>
                    </div>

                    <div class="card">
                        <h3>Funcionários por Setor</h3>
                        <div class="chart-container">
                            <canvas id="graficoSetores"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>
    
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>new window.VLibras.Widget('https://vlibras.gov.br/app');</script>

    <script>
        new Chart(document.getElementById('graficoBarra'), {
            type: 'bar',
            data: {
                labels: ['Conforme', 'Não Conforme'],
                datasets: [{
                    label: 'EPIs',
                    data: [<?= $conforme ?>, <?= $naoConforme ?>],
                    backgroundColor: ['#04b507', '#c7040e'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } }
            }
        });

        new Chart(document.getElementById('graficoPizza'), {
            type: "doughnut",
            data: {
                labels: <?= $nomesEpi ?>,
                datasets: [{
                    data: <?= $totaisEpi ?>,
                    backgroundColor: [
                        '#0A66c2',
                        '#04b507',
                        '#f59e0b',
                        '#c7040e',
                        '#8b5cf6'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        new Chart(document.getElementById('linhaChart'), {
            type: 'bar',
            data: {
                labels: <?= $nomesCamera ?>,
                datasets: [{
                    label: 'Ocorrências',
                    data: <?= $totalOcorrencias ?>,
                    backgroundColor: '#0A66c2'
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });

        const nomesSetores = <?= $nomesSetores ?>;
        const totaisSetores = <?= $totaisSetores ?>;
        const cores = [];

        for (let i = 0; i < nomesSetores.length; i++) {
            const luminosidade = 25 + (i * 45 / nomesSetores.length);
            cores.push(`hsl(210, 85%, ${luminosidade}%)`);
        }

        new Chart(document.getElementById('graficoSetores'), {
            type: 'pie',
            data: {
                labels: nomesSetores,
                datasets: [{
                    label: 'Funcionários',
                    data: totaisSetores,
                    backgroundColor: cores,
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.label + ': ' + context.raw;
                            }
                        }
                    }
                }
            }
        });

        function toggleDark() {
            document.body.classList.toggle('dark-mode');
        }

        /* Alterna a classe 'show' no menu de opções */
        function toggleAccessMenu() {
            const options = document.getElementById('accessOptions');
            options.classList.toggle('show');
        }
    </script>
</body>
</html>