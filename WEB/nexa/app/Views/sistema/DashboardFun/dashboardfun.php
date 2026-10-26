<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>NEXA | Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('/assets/css/style_funci.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/acessibilidade_fun.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/dashboard_fun.css') ?>">

    <!-- ICONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <!-- FUNDO -->
        <img
            class="sidebar-construction"
            src="<?= base_url('assets/images/construcao.jpg') ?>"
            alt=""
        >

        <!-- CONTEÚDO -->
        <div class="sidebar-content">

            <!-- LOGO -->
            <div class="sidebar-logo">
                <img
                    src="<?= base_url('assets/images/logo_escura_transparente.png') ?>"
                    alt="NEXA"
                >
                <div class="sidebar-brand-text">
                    <strong>NEXA</strong>
                    <span>Segurança é prioridade</span>
                </div>
            </div>

            <!-- MENU -->
            <nav class="menu">
                <div class="menu-title">PRINCIPAL</div>

                <a href="<?= base_url('/dashboardfun') ?>">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>

                <a href="<?= base_url('/camera_analise') ?>">
                    <i class="fas fa-video"></i>
                    <span>Análise de EPI</span>
                </a>

                <div class="menu-title">CONTA</div>

                <a href="<?= base_url('/perfilfun') ?>">
                    <i class="fas fa-user"></i>
                    <span>Perfil</span>
                </a>
            </nav>

            <!-- SAIR -->
            <a href="<?= base_url('/') ?>" class="logout-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sair do Sistema</span>
            </a>

        </div>

    </aside>

    <div class="overlay">

        <!-- MAIN -->
        <div class="main">

            <header class="dashboard-header">
                <div class="header-left">
                    <h1>Bem-vindo,</h1>
                    <span><?= session()->get('nome_fun') ?></span>
                </div>

                <div class="header-right">
                    <a href="<?= base_url('/perfilfun') ?>" class="profile">
                        <div class="profile-avatar">
                            <?= strtoupper(substr(session()->get('nome_fun'),0,1)) ?>
                        </div>
                        <div class="profile-info">
                            <strong><?= session()->get('nome_fun') ?></strong>
                            <small>NEXA SOLUÇÕES</small>
                        </div>
                    </a>

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
                </div>
            </header>

            <!-- CALENDÁRIO -->
            <div class="grid">
                <div class="card">
                    <div class="calendar-title">
                        <div class="calendar-icon">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <div>
                            <h2>Calendário</h2>
                            <span>Visualize os dias e suas atividades</span>
                        </div>
                    </div>

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
                        <span><span class="dot cinza"></span> Não analisado</span>
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

    <div id="modal"></div>

    <!-- ESTRUTURA DO WIDGET VLIBRAS -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

   <script>
const mascoteOcorrenciaUrl = <?= json_encode(base_url('assets/images/mascote_nexa_3d_amarelo.png')) ?>;

function normalizarEpiOcorrencia(nome) {
    return String(nome || '').toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').trim();
}

function tipoEpiOcorrencia(nome) {
    const n = normalizarEpiOcorrencia(nome);
    if (n.includes('capacete')) return 'capacete';
    if (n.includes('oculo')) return 'oculos';
    if (n.includes('mascara') || n.includes('respirador')) return 'mascara';
    if (n.includes('protetor auricular') || n.includes('protetor auditivo') || n.includes('abafador')) return 'protetor-auricular';
    if (n.includes('colete') || n.includes('refletivo')) return 'colete';
    if (n.includes('luva')) return 'luvas';
    if (n.includes('bota') || n.includes('botina') || n.includes('calcado')) return 'botas';
    return null;
}

function listaEpisOcorrencia(valor) {
    const texto = String(valor || '').trim();
    if (!texto || ['nenhum', 'nenhuma', 'n/a'].includes(normalizarEpiOcorrencia(texto))) return [];
    return texto.split(/[,;|]+/).map(item => item.trim()).filter(Boolean);
}

function escaparHtmlOcorrencia(valor) {
    return String(valor ?? '').replace(/[&<>"']/g, caractere => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[caractere]));
}

function montarMascoteOcorrencia(info) {
    const detectados = listaEpisOcorrencia(info.EPIS_DETECTADOS);
    const ausentes = listaEpisOcorrencia(info.EPIS_AUSENTE);
    const defs = [
        {key:'capacete', label:'Capacete', d:'M385 253 Q385 155 468 112 Q540 72 615 117 Q694 161 700 253 L700 274 Q545 305 385 274 Z'},
        {key:'oculos', label:'Óculos', d:'M405 270 Q440 253 482 271 L521 286 L552 286 L590 270 Q635 252 675 274 L665 332 Q626 356 579 331 L542 318 L505 332 Q459 357 418 331 Z'},
        {key:'mascara', label:'Máscara', d:'M426 342 Q541 315 658 343 L642 424 Q541 477 441 424 Z'},
        {key:'protetor-auricular', label:'Protetor auricular', d:'M333 278 Q318 302 329 368 L350 407 L380 392 L372 302 Z M705 278 Q720 302 709 368 L688 407 L658 392 L666 302 Z'},
        {key:'colete', label:'Colete refletivo', d:'M377 460 L447 449 L477 495 L610 495 L641 449 L710 461 L744 750 L687 795 L399 795 L343 750 Z'},
        {key:'luvas', label:'Luvas', d:'M202 812 Q218 789 251 801 L299 829 L333 899 L318 950 Q294 982 263 962 L218 928 Q192 895 202 812 Z M744 829 L791 801 Q823 789 840 812 Q850 895 824 928 L779 962 Q748 982 724 950 L709 899 Z'},
        {key:'botas', label:'Botas', d:'M302 1166 L478 1166 L484 1287 Q489 1311 479 1332 L276 1332 Q263 1324 267 1302 L282 1235 Z M555 1166 L730 1166 L755 1235 L771 1302 Q775 1324 762 1332 L559 1332 Q549 1311 553 1287 Z'}
    ];
    const status = {};
    defs.forEach(def => {
        const encontrado = detectados.some(item => tipoEpiOcorrencia(item) === def.key);
        const ausente = ausentes.some(item => tipoEpiOcorrencia(item) === def.key);
        status[def.key] = encontrado ? 'detectado' : (ausente ? 'ausente' : '');
    });
    const paths = defs.filter(def => status[def.key]).map(def => `<path class="ppe-highlight ${status[def.key]}" data-epi="${def.key}" d="${def.d}"/>`).join('');
    const chips = defs.filter(def => status[def.key]).map(def => `<span class="epi-resumo-status ${status[def.key]}"><i class="fa-solid ${status[def.key] === 'detectado' ? 'fa-check' : 'fa-xmark'}"></i>${escaparHtmlOcorrencia(def.label)}</span>`).join('');
    return `
        <aside class="ocorrencia-mascote-painel" aria-label="Mascote e status dos EPIs">
            <div class="ocorrencia-mascote-figura">
                <img src="${mascoteOcorrenciaUrl}" alt="Mascote NEXA com equipamentos de segurança">
                <svg class="ocorrencia-mascote-overlay" viewBox="0 0 1086 1448" preserveAspectRatio="xMidYMid meet" aria-hidden="true">${paths}</svg>
            </div>
            <div class="ocorrencia-mascote-legenda">${chips || '<span class="epi-resumo-vazio">Sem status de EPI disponível</span>'}</div>
        </aside>`;
}

const meses = [
    "JAN", "FEV", "MAR", "ABR", "MAI", "JUN",
    "JUL", "AGO", "SET", "OUT", "NOV", "DEZ"
];

let dataAtual = new Date();

/* =====================================================
   DADOS DO BANCO
===================================================== */

const ocorrencias = <?= json_encode($ocorrencias ?? [], JSON_UNESCAPED_UNICODE) ?>;


/* =====================================================
   AGRUPAR OCORRÊNCIAS POR DATA
===================================================== */

const mapa = {};

ocorrencias.forEach(o => {

    const data = o.DATA_ANALISE;

    if (!mapa[data]) {
        mapa[data] = [];
    }

    mapa[data].push(o);

});


/* =====================================================
   MODAL
===================================================== */

function abrirModal(data, ocorrenciasDoDia) {

    const modal = document.getElementById("modal");

    /* Ordena por horário */
    ocorrenciasDoDia.sort((a, b) => {

        const horaA = a.HORA_ANALISE || "";
        const horaB = b.HORA_ANALISE || "";

        return horaA.localeCompare(horaB);

    });


    /* Formata a data */
    const partes = data.split("-");

    const dataFormatada =
        `${partes[2]}/${partes[1]}/${partes[0]}`;


    /* Cria os cards das ocorrências */

    let ocorrenciasHTML = "";

    ocorrenciasDoDia.forEach((info, index) => {

        const status =
            info.STATUS_OCORRENCIA || "Sem status";

      const statusNormalizado =
    String(status || "").toLowerCase().trim();

const statusConforme =
    statusNormalizado === "conforme" ||
    statusNormalizado === "regular";

const statusClasse =
    statusConforme
        ? "modal-status-regular"
        : "modal-status-irregular";

        ocorrenciasHTML += `

            <div class="ocorrencia-item">
              <div class="ocorrencia-item-layout">
                <div class="ocorrencia-item-conteudo">

                <div class="ocorrencia-topo">

                    <div class="ocorrencia-numero">
                        Ocorrência ${index + 1}
                    </div>

                    <div class="ocorrencia-hora">
                        <i class="fa-regular fa-clock"></i>
                        ${info.HORA_ANALISE || "--:--"}
                    </div>

                </div>


                <div class="ocorrencia-status ${statusClasse}">

                    <i class="fa-solid ${
                      statusConforme
    ? "fa-circle-check"
    : "fa-triangle-exclamation"
                    }"></i>

                    ${status}

                </div>

<div class="ocorrencia-dados">

    ${
        info.EPIS_DETECTADOS &&
        info.EPIS_DETECTADOS.trim().toLowerCase() !== "nenhum"
        ? `
            <div class="dado">

                <div class="dado-icone detectado">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>

                <div>
                    <span>EPIs Detectados</span>
                    <strong>
                        ${info.EPIS_DETECTADOS}
                    </strong>
                </div>

            </div>
        `
        : ""
    }


    ${
        info.EPIS_AUSENTE &&
        info.EPIS_AUSENTE.trim().toLowerCase() !== "nenhum"
        ? `
            <div class="dado">

                <div class="dado-icone ausente">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>

                <div>
                    <span>EPIs Ausentes</span>
                    <strong>
                        ${info.EPIS_AUSENTE}
                    </strong>
                </div>

            </div>
        `
        : ""
    }

</div>
                </div><!-- /ocorrencia-item-conteudo -->
                ${montarMascoteOcorrencia(info)}
              </div><!-- /ocorrencia-item-layout -->
            </div>

        `;

    });


    /* Monta o modal */

    modal.innerHTML = `

        <div class="modal-box">

            <div class="modal-header">

                <div class="modal-titulo">

                    <div class="modal-icon">
                        <i class="fa-solid fa-calendar-day"></i>
                    </div>

                    <div>

                        <h3>Ocorrências do dia</h3>

                        <span>
                            ${dataFormatada}
                        </span>

                    </div>

                </div>


                <button
                    class="modal-fechar"
                    onclick="fecharModal()"
                    aria-label="Fechar"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>

            </div>


            <div class="modal-resumo">

                <div class="resumo-icon">
                    <i class="fa-solid fa-list-check"></i>
                </div>

                <div>

                    <strong>
                        ${ocorrenciasDoDia.length}
                        ${
                            ocorrenciasDoDia.length === 1
                            ? "ocorrência registrada"
                            : "ocorrências registradas"
                        }
                    </strong>

                    <span>
                        Confira os horários e detalhes das análises.
                    </span>

                </div>

            </div>


            <div class="ocorrencias-lista">

                ${ocorrenciasHTML}

            </div>


            <div class="modal-footer">

                <button
                    class="btn-fechar-modal"
                    onclick="fecharModal()"
                >
                    <i class="fa-solid fa-check"></i>
                    Fechar
                </button>

            </div>

        </div>

    `;


    modal.style.display = "flex";

}


/* =====================================================
   FECHAR MODAL
===================================================== */

function fecharModal() {

    document.getElementById("modal").style.display = "none";

}


/* =====================================================
   FECHAR CLICANDO FORA DO MODAL
===================================================== */

document.getElementById("modal").addEventListener("click", function(e) {

    if (e.target === this) {
        fecharModal();
    }

});


/* =====================================================
   CALENDÁRIO
===================================================== */

function renderCalendario() {

    let dias = document.getElementById("dias");

    dias.innerHTML = "";


    let ano = dataAtual.getFullYear();

    let mes = dataAtual.getMonth();


    document.getElementById("mesAno").innerText =
        meses[mes];

    document.getElementById("ano").innerText =
        ano;


    let primeiroDia =
        new Date(ano, mes, 1).getDay();

    let totalDias =
        new Date(ano, mes + 1, 0).getDate();


    /* Espaços antes do primeiro dia */

    for (let i = 0; i < primeiroDia; i++) {

        dias.innerHTML += "<div></div>";

    }


    /* Dias */

    for (let dia = 1; dia <= totalDias; dia++) {

        let div = document.createElement("div");

        div.classList.add("dia");

        div.innerText = dia;


        let status = document.createElement("div");

        status.classList.add("status");


        let data =
            `${ano}-${String(mes + 1).padStart(2, '0')}-${String(dia).padStart(2, '0')}`;


        /* TODAS as ocorrências daquele dia */

        let ocorrenciasDoDia =
            mapa[data] || [];


  /* =================================================
   DEFINIR COR DO DIA
================================================= */

let cor = "cinza";

if (ocorrenciasDoDia.length > 0) {

    /*
     * Se existir pelo menos uma ocorrência irregular,
     * o dia inteiro fica vermelho.
     */
    const temIrregular = ocorrenciasDoDia.some(o =>
        String(o.STATUS_OCORRENCIA || "").toLowerCase() === "irregular"
    );

    /*
     * Se não existe irregular e existe ocorrência,
     * significa que todas são conformes.
     */
    const temConforme = ocorrenciasDoDia.some(o =>
        ["conforme", "regular"].includes(
            String(o.STATUS_OCORRENCIA || "").toLowerCase()
        )
    );

    if (temIrregular) {

        cor = "vermelho";

    } else if (temConforme) {

        cor = "verde";

    }
}


        status.classList.add(cor);


        /* =================================================
           CLIQUE NO DIA
        ================================================= */

        div.onclick = () => {

            if (ocorrenciasDoDia.length > 0) {

                abrirModal(
                    data,
                    ocorrenciasDoDia
                );

            }

        };


        /*
         * Mostra que existem várias ocorrências
         */

        if (ocorrenciasDoDia.length > 1) {

            div.classList.add("tem-varias");

            const quantidade =
                document.createElement("span");

            quantidade.classList.add(
                "quantidade-ocorrencias"
            );

            quantidade.innerText =
                ocorrenciasDoDia.length;

            div.appendChild(quantidade);

        }


        div.appendChild(status);

        dias.appendChild(div);

    }

}


/* =====================================================
   TROCAR MÊS
===================================================== */

function mudarMes(v) {

    dataAtual.setMonth(
        dataAtual.getMonth() + v
    );

    renderCalendario();

}


/* =====================================================
   VLIBRAS
===================================================== */

function toggleVLibras() {

    const btn =
        document.querySelector('[vw-access-button]');

    if (btn) {
        btn.click();
    }

}


/* =====================================================
   INICIAR
===================================================== */

renderCalendario();

</script>

    <!-- SCRIPT DA NOSSA ACESSIBILIDADE E DO VLIBRAS -->
    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>


    <script>

        // =====================================================
        // NEXA RFID - LOGIN AUTOMÁTICO
        // =====================================================

        let verificandoRFID = false;

        async function verificarRFID() {

            if (verificandoRFID) {
                return;
            }

            verificandoRFID = true;

            try {

                const resposta = await fetch(
                    '<?= base_url("api/rfid/status") ?>',
                    {
                        method: 'GET',

                        headers: {
                            'Accept': 'application/json'
                        },

                        cache: 'no-store'
                    }
                );


                if (!resposta.ok) {

                    console.log(
                        'Erro ao consultar RFID:',
                        resposta.status
                    );

                    return;
                }


                const dados =
                    await resposta.json();


                console.log(
                    'Status RFID:',
                    dados
                );


                // =================================================
                // NENHUM CARTÃO
                // =================================================

                if (
                    !dados.novoAcesso
                ) {

                    return;
                }


                // =================================================
                // FUNCIONÁRIO IDENTIFICADO
                // =================================================

                console.log(
                    'Funcionário identificado:',
                    dados.funcionario.nome
                );


                console.log(
                    'Câmera:',
                    dados.camera?.identificador
                );


                // =================================================
                // REDIRECIONAR
                // =================================================

                if (
                    dados.redirect
                ) {

                    window.location.href =
                        dados.redirect;

                }

            } catch (erro) {

                console.error(
                    'Erro ao verificar RFID:',
                    erro
                );

            } finally {

                verificandoRFID = false;
            }
        }


        // =====================================================
        // VERIFICAR A CADA 1 SEGUNDO
        // =====================================================

        setInterval(
            verificarRFID,
            1000
        );


        // Primeira verificação
        verificarRFID();

        </script>
</body>
</html>