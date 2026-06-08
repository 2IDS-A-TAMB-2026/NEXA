<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>NEXA | Dashboard</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ICONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">

    <link rel="stylesheet" href="<?= base_url('/assets/css/style_geral.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade.css') ?>">

    <!-- CHART JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="sidebar-logo">
            <img src="<?= base_url('assets/images/logo_escura_transparente.png') ?>">
        </div>

        <nav class="menu">

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

            <a href="<?= base_url('/cadastro-funcionario') ?>">
                <i class="fas fa-users"></i>
                <span>Cadastro funcionários</span>
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

    <div class="overlay">

        <header>

            <h1>Dashboard</h1>

            <p>

                Bem-vindo,
                <?= session()->get('nome') ?>

            </p>

        </header>

        <!-- METRICAS -->
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
                <span style="color:green;">
                    <?= $conformidade ?>%
                </span>

            </div>

            <div class="metric">

                <div class="metric-icon alerta">
                    <i class="fas fa-triangle-exclamation"></i>
                </div>

                <h4>Alertas ativos</h4>
                <span style="color:red;">
                    <?= $alertas ?>
                </span>

            </div>

            <div class="metric">

                <div class="metric-icon camera">
                    <i class="fas fa-video"></i>
                </div>

                <h4>Câmeras ativas</h4>
                <span><?= $camerasAtivas ?></span>

            </div>

        </div>

        <!-- GRAFICOS -->
        <div class="graficos-grid">

            <!-- GRAFICO 1 -->
            <div class="card">
                <h3>Controle diário de EPIs</h3>

                <div class="chart-container">
                    <canvas id="graficoBarra"></canvas>
                </div>
            </div>

            <!-- GRAFICO 2 -->
            <div class="card">
                <h3>Funcionários Verificados</h3>

                <div class="chart-container">
                    <canvas id="graficoPizza"></canvas>
                </div>
            </div>

            <!-- GRAFICO 3 -->
            <div class="card">
                <h3>Controle Semanal de EPIs</h3>

                <div class="chart-container">
                    <canvas id="linhaChart"></canvas>
                </div>
            </div>

            <!-- GRAFICO 4 -->
            <div class="card">
                <h3>Funcionários por Setor</h3>

                <div class="chart-container">
                    <canvas id="graficoSetores"></canvas>
                </div>
            </div>

        </div>

    </div>

    </div>

    <!-- SCRIPTS -->
    <script>

        new Chart(document.getElementById('graficoBarra'), {

            type: 'bar',

            data: {
                labels: [
                    'Conforme',
                    'Não Conforme',
                    'Parcial'
                ],

                datasets: [{
                    label: 'EPIs',

                    data: [
                        <?= $conforme ?>,
                        <?= $naoConforme ?>,
                        <?= $parcial ?>
                    ],

                    backgroundColor: [
                        '#04b507',
                        '#c7040e',
                        'orange'
                    ]
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    }
                }
            }

        });

        new Chart(document.getElementById('graficoPizza'), {

            type: 'doughnut',

            data: {

                labels: [
                    'Verificados',
                    'Faltaram'
                ],

                datasets: [{
                    data: [
                        <?= $verificados ?>,
                        <?= $faltaram ?>
                    ],

                    backgroundColor: [
                        '#04b507',
                        '#c7040e'
                    ]
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }

        });

        new Chart(document.getElementById('linhaChart'), {

            type: 'line',

            data: {

                labels: [
                    'Seg',
                    'Ter',
                    'Qua',
                    'Qui',
                    'Sex'
                ],

                datasets: [{

                    label: 'Uso Correto de EPIs',

                    data: [
                        12,
                        19,
                        15,
                        22,
                        18
                    ],

                    borderColor: '#0a66c2',

                    backgroundColor:
                        'rgba(10,102,194,0.15)',

                    tension: 0.4,

                    fill: true
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    }
                }
            }

        });

        const nomesSetores = <?= $nomesSetores ?>;
        const totaisSetores = <?= $totaisSetores ?>;

        // Gera uma cor diferente para cada setor
        const cores = [];

        for (let i = 0; i < nomesSetores.length; i++) {

            const luminosidade =
                25 + (i * 45 / nomesSetores.length);

            cores.push(
                `hsl(210, 85%, ${luminosidade}%)`
            );

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
                        display: false
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

    </script>

    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>

</body>

</html>