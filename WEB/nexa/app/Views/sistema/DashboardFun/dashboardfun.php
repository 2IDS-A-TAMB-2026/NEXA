<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>NEXA | Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('/assets/css/style_funci.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/acessibilidade.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/dashboard_fun.css') ?>">

    <!-- ICONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        
        .sidebar-top {
            position: relative;
            height: 160px;
            background: url('<?= base_url("assets/images/slide1.jpg") ?>') center/cover;
            display: flex;
            align-items: flex-end;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
            <div class="sidebar-top">
                <span>NEXA</span>
            </div>
            <nav class="menu">
                        <a href="<?= base_url('/dashboardfun') ?>">
                            <i class="fas fa-th-large"></i>
                            Dashboard
                         </a>
                    <a href="<?= base_url('/camera_analise') ?>">
                        <i class="fas fa-camera"></i>
                          Análise EPI
                    </a>
            <a href="<?= base_url('/perfilfun') ?>">
                <i class="fas fa-user"></i>
                Perfil
            </a>            
            </nav>

        <a href="<?= base_url('/') ?>" class="logout-item" onclick="logout()">
            <i class="fas fa-sign-out-alt"></i>
            Sair
        </a>

    </aside>

    <div class="overlay">

        <!-- MAIN -->
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

            <header>
              <h1>Bem-vindo,
               </h1>
               <p>  <?= session()->get('nome') ?></p>
            </header>

            <div class="grid">

                <!-- CALENDÁRIO -->
                <div class="card">

                    <div class="calendar-header">

                        <button onclick="mudarMes(-1)">◀</button>

                        <div>
                            <strong id="mesAno"></strong><br>
                            <small id="ano"></small>
                        </div>

                        <button onclick="mudarMes(1)">▶</button>

                    </div>

                    <div class="dias" id="dias"></div>

                    <div class="legend">
                        <span><span class="dot verde"></span> Correto</span>
                        <span><span class="dot vermelho"></span> Erro</span>
                        <span><span class="dot cinza"></span> Folga</span>
                    </div>

                </div>

                <!-- DICAS -->
                <div class="card dicas">

                    <h3>
                        <i class="fa-solid fa-shield-halved"></i>
                        Dicas de Segurança
                    </h3>

                    <ul>
                        <li>
                            <i class="fa-solid fa-helmet-safety"></i>
                            Use sempre EPIs completos
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Verifique seus equipamentos
                        </li>

                        <li>
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            Atenção às áreas de risco
                        </li>

                        <li>
                            <i class="fa-solid fa-file-shield"></i>
                            Siga as normas da empresa
                        </li>
                    </ul>

                </div>

            </div>

        </div>

    </div>


    
<script>

const meses = ["JAN","FEV","MAR","ABR","MAI","JUN","JUL","AGO","SET","OUT","NOV","DEZ"];

let dataAtual = new Date();

/* =========================
   DADOS DO BANCO
========================= */
const ocorrencias = <?= json_encode($ocorrencias ?? []) ?>;

const mapa = {};

ocorrencias.forEach(o => {
    mapa[o.DATA_ANALISE] = o;
});

/* =========================
   MODAL SIMPLES
========================= */
function abrirModal(info) {
    const modal = document.getElementById("modal");

    modal.innerHTML = `
        <div class="modal-box">
            <h3>Detalhes do Dia</h3>
            <p><b>Status:</b> ${info.STATUS_OCORRENCIA}</p>
            <p><b>Hora:</b> ${info.HORA_ANALISE}</p>
            <p><b>EPIs Detectados:</b> ${info.EPIS_DETECTADOS}</p>
            <p><b>EPIs Ausentes:</b> ${info.EPIS_AUSENTE}</p>
            <button onclick="fecharModal()">Fechar</button>
        </div>
    `;

    modal.style.display = "flex";
}

function fecharModal() {
    document.getElementById("modal").style.display = "none";
}

/* =========================
   CALENDÁRIO
========================= */
function renderCalendario() {

    let dias = document.getElementById("dias");
    dias.innerHTML = "";

    let ano = dataAtual.getFullYear();
    let mes = dataAtual.getMonth();

    document.getElementById("mesAno").innerText = meses[mes];
    document.getElementById("ano").innerText = ano;

    let primeiroDia = new Date(ano, mes, 1).getDay();
    let totalDias = new Date(ano, mes + 1, 0).getDate();

    for (let i = 0; i < primeiroDia; i++) {
        dias.innerHTML += "<div></div>";
    }

    for (let dia = 1; dia <= totalDias; dia++) {

        let div = document.createElement("div");
        div.classList.add("dia");
        div.innerText = dia;

        let status = document.createElement("div");
        status.classList.add("status");

        let data = `${ano}-${String(mes+1).padStart(2,'0')}-${String(dia).padStart(2,'0')}`;

        let info = mapa[data];

        let cor = "cinza";
        if (info?.STATUS_OCORRENCIA === "Regular") cor = "verde";
        if (info?.STATUS_OCORRENCIA === "Irregular") cor = "vermelho";

        status.classList.add(cor);

        // CLICK no dia
        div.onclick = () => {
            if (info) {
                abrirModal(info);
            }
        };

        div.appendChild(status);
        dias.appendChild(div);
    }
}

/* =========================
   TROCAR MÊS
========================= */
function mudarMes(v) {
    dataAtual.setMonth(dataAtual.getMonth() + v);
    renderCalendario();
}

renderCalendario();

</script>
<script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>
</body>