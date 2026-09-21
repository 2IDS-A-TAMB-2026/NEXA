<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>NEXA | Ocorrências</title>

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >


    <!-- =====================================================
         FONT AWESOME
    ====================================================== -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >


    <!-- =====================================================
         CSS
    ====================================================== -->

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/acessibilidade_adm.css') ?>"
    >

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/style_geral.css') ?>"
    >

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/ocorrencia.css') ?>"
    >

</head>


<body>


<!-- =========================================================
     SIDEBAR
========================================================= -->

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

                <span>
                    Segurança é prioridade
                </span>

            </div>

        </div>


        <!-- =================================================
             MENU
        ================================================== -->

        <nav class="menu">


            <!-- PRINCIPAL -->

            <div class="menu-title">
                PRINCIPAL
            </div>


            <!-- DASHBOARD -->

            <a href="<?= base_url('/dashboard') ?>">

                <i class="fas fa-chart-line"></i>

                <span>
                    Dashboard
                </span>

            </a>


            <!-- DASHBOARD CÂMERAS -->

            <a href="<?= base_url('/dashboard_camera') ?>">

                <i class="fas fa-video"></i>

                <span>
                    Dashboard de Câmeras
                </span>

            </a>


            <!-- OCORRÊNCIAS -->

            <a
                href="<?= base_url('/ocorrencia') ?>"
                class="active"
            >

                <i class="fas fa-exclamation-triangle"></i>

                <span>
                    Ocorrências
                </span>

            </a>


            <!-- =================================================
                 CADASTROS
            ================================================== -->

            <div class="menu-title">
                CADASTROS
            </div>


            <!-- FUNCIONÁRIOS -->

            <a href="<?= base_url('/cadastro-funcionario') ?>">

                <i class="fas fa-users"></i>

                <span>
                    Cadastro Funcionários
                </span>

            </a>


            <!-- EPIs -->

            <a href="<?= base_url('/epi') ?>">

                <i class="fas fa-helmet-safety"></i>

                <span>
                    Cadastro EPIs
                </span>

            </a>


            <!-- CÂMERAS -->

            <a href="<?= base_url('/Camera') ?>">

                <i class="fas fa-camera"></i>

                <span>
                    Cadastro Câmeras
                </span>

            </a>


            <!-- SETORES -->

            <a href="<?= base_url('/setor') ?>">

                <i class="fas fa-building"></i>

                <span>
                    Cadastro Setores
                </span>

            </a>


            <!-- =================================================
                 CONTA
            ================================================== -->

            <div class="menu-title">
                CONTA
            </div>


            <!-- PERFIL -->

            <a href="<?= base_url('/administrador') ?>">

                <i class="fas fa-user"></i>

                <span>
                    Perfil
                </span>

            </a>


        </nav>


        <!-- =================================================
             SAIR
        ================================================== -->

        <a
            href="<?= base_url('/') ?>"
            class="logout-item"
        >

            <i class="fas fa-sign-out-alt"></i>

            <span>
                Sair do Sistema
            </span>

        </a>


    </div>

</aside>



<!-- =========================================================
     ACESSIBILIDADE
========================================================= -->



<!-- =========================================================
     ÁREA PRINCIPAL
========================================================= -->

<div class="overlay">


    <div class="main">


        <!-- =================================================
             HEADER
        ================================================== -->

        <header class="dashboard-header">


            <!-- ESQUERDA -->

            <div class="header-left">

                <div class="header-title">

                    <h1>
                        Ocorrências
                    </h1>

                    <p>
                        Acompanhe as ocorrências da sua empresa
                    </p>

                </div>

            </div>


            <!-- =================================================
                 DIREITA
            ================================================== -->

            <div class="header-right">
                
<div class="access-menu">


    <!-- BOTÃO CONFIGURAÇÕES -->

    <button
        class="gear-btn"
        onclick="toggleAccessMenu()"
    >

        <i class="fas fa-cog"></i>

    </button>


    <!-- OPÇÕES -->

    <div
        class="access-options"
        id="accessOptions"
    >


        <!-- CONTRASTE -->

        <button
            class="access-btn"
            onclick="Acessibilidade.toggleContraste()"
            title="Alto contraste"
        >

            <i class="fas fa-adjust"></i>

        </button>


        <!-- MODO ESCURO -->

        <button
            class="access-btn"
            onclick="toggleDark()"
            title="Modo escuro"
        >

            <i class="fas fa-moon"></i>

        </button>


        <!-- AUMENTAR FONTE -->

        <button
            class="access-btn"
            onclick="Acessibilidade.aumentarFonte()"
            title="Aumentar fonte"
        >

            A+

        </button>


        <!-- DIMINUIR FONTE -->

        <button
            class="access-btn"
            onclick="Acessibilidade.diminuirFonte()"
            title="Diminuir fonte"
        >

            A-

        </button>


        <!-- LER PÁGINA -->

        <button
            class="access-btn"
            onclick="Acessibilidade.lerPagina()"
            title="Ler página"
        >

            <i class="fas fa-volume-up"></i>

        </button>


    </div>

</div>



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


                <!-- =====================================================
             FILTROS
        ====================================================== -->

        <div class="filtros">


            <!-- BUSCAR FUNCIONÁRIO -->

            <input
                type="text"
                id="filtroFuncionario"
                placeholder="Buscar funcionário..."
            >


            <!-- STATUS -->
        
            <select id="filtroStatus">

                <option value="">
                    Todos status
                </option>

                <option value="violacao">
                    Violação
                </option>

                <option value="conforme">
                    Conforme
                </option>

            </select>


            <!-- DATA -->

            <input
                type="date"
                id="filtroData"
            >


            <!-- LIMPAR -->

            <button
                type="button"
                class="btn-limpar"
                onclick="limparFiltros()"
            >

                <i class="fas fa-filter-circle-xmark"></i>

                Limpar

            </button>

        </div>



        <!-- =====================================================
             LISTA DE OCORRÊNCIAS
        ====================================================== -->

        <div
            class="ocorrencias"
            id="listaOcorrencias"
        >


            <?php if (!empty($ocorrencias)) : ?>


                <?php foreach ($ocorrencias as $o) : ?>


                    <?php

                        /*
                        =================================================
                        DEFINIÇÃO DO STATUS
                        =================================================
                        */

                        $statusClasse = 'conforme';

                        $icone = 'fa-circle-check';

                        $texto = 'Conforme';


                        if (
                            $o['STATUS_OCORRENCIA']
                            == 'Irregular'
                        ) {

                            $statusClasse = 'violacao';

                            $icone =
                                'fa-triangle-exclamation';

                            $texto = 'Violação';

                        }

                    ?>


                    <!-- =================================================
                         CARD
                    ================================================= -->

                    <div
                        class="card <?= $statusClasse ?>"

                        data-funcionario="<?= strtolower(
                            $o['NOME_COMPLETO']
                            ?? 'não informado'
                        ) ?>"

                        data-status="<?= $statusClasse ?>"

                        data-data="<?= esc($o['DATA_ANALISE'] ?? '') ?>"
data-hora="<?= esc($o['HORA_ANALISE'] ?? '00:00:00') ?>"
                    >


                        <!-- =============================================
                             CABEÇALHO DO CARD
                        ============================================== -->

                        <div class="card-header">


                            <!-- ÍCONE DE STATUS -->

                            <i class="fas <?= $icone ?>"></i>


                            <!-- TEXTO -->

                            <div>

                                <span>
                                    <?= $texto ?>
                                </span>

                                <small>
                                   
                                    <?= esc(
                                        $o['IDENTIFICADOR_CAMERA']
                                    ) ?>
                                </small>

                            </div>


                        </div>



                        <!-- =============================================
                             INFORMAÇÕES
                        ============================================== -->

                        <div class="info-grid">


                            <!-- FUNCIONÁRIO -->

                            <div>

                                <strong>
                                    Funcionário
                                </strong>

                                <span>
                                    <?= esc(
                                        $o['NOME_COMPLETO']
                                        ?? 'Não informado'
                                    ) ?>
                                </span>

                            </div>


                            <!-- SETOR -->

                            <div>

                                <strong>
                                    Setor
                                </strong>

                                <span>
                                    <?= esc(
                                        $o['SETOR']
                                        ?? 'Não informado'
                                    ) ?>
                                </span>

                            </div>


                            <!-- DATA -->

                            <div>

                                <strong>
                                    Data
                                </strong>

                                <span>

                                    <?= date(
                                        'd/m/Y',
                                        strtotime(
                                            $o['DATA_ANALISE']
                                        )
                                    ) ?>

                                </span>

                            </div>


                            <!-- HORA -->

                            <div>

                                <strong>
                                    Hora
                                </strong>

                                <span>
                                    <?= esc(
                                        $o['HORA_ANALISE']
                                    ) ?>
                                </span>

                            </div>


                        </div>



                        <!-- =============================================
                             EPIs
                        ============================================== -->

                    <!-- =============================================
     EPIs
============================================= -->

<div class="epi-box">

    <?php
        /*
        =========================================================
        EPIs DETECTADOS
        =========================================================

        Se o banco tiver salvo "Nenhum", não mostramos nada.

        Isso acontece quando a câmera não identificou nenhum
        EPI naquela análise.
        */

        $episDetectados = trim(
            $o['EPIS_DETECTADOS'] ?? ''
        );

        $mostrarDetectados = (
            $episDetectados !== '' &&
            mb_strtolower(
                $episDetectados,
                'UTF-8'
            ) !== 'nenhum' &&
            mb_strtolower(
                $episDetectados,
                'UTF-8'
            ) !== 'nenhuma'
        );
    ?>


    <!-- =============================================
         EPIs DETECTADOS
    ============================================== -->

    <?php if ($mostrarDetectados) : ?>

        <span class="ok">

            <i class="fas fa-check"></i>

            <?= esc($episDetectados) ?>

        </span>

    <?php endif; ?>


    <?php
        /*
        =========================================================
        EPIs AUSENTES
        =========================================================

        "Nenhum" NÃO será mostrado aqui também.

        Só aparecem os EPIs que realmente estão ausentes.
        */

        $episAusentes = trim(
            $o['EPIS_AUSENTE'] ?? ''
        );

        $mostrarAusentes = (
            $episAusentes !== '' &&
            mb_strtolower(
                $episAusentes,
                'UTF-8'
            ) !== 'nenhum' &&
            mb_strtolower(
                $episAusentes,
                'UTF-8'
            ) !== 'nenhuma'
        );
    ?>


    <!-- =============================================
         EPIs AUSENTES
    ============================================== -->

    <?php if ($mostrarAusentes) : ?>

        <span class="fail">

            <i class="fas fa-xmark"></i>

            <?= esc($episAusentes) ?>

        </span>

    <?php endif; ?>


</div>


                    </div>


                <?php endforeach; ?>


            <?php else : ?>


                <!-- =============================================
                     SEM OCORRÊNCIAS
                ============================================== -->

                <div
                    class="card conforme"
                    id="semOcorrencias"
                >

                    <div class="card-header">

                        <i class="fas fa-circle-info"></i>

                        <div>

                            <span>
                                Nenhuma ocorrência encontrada
                            </span>

                            <small>
                                Tente alterar os filtros
                            </small>

                        </div>

                    </div>

                </div>


            <?php endif; ?>


        </div>



        <!-- =====================================================
             PAGINAÇÃO
        ====================================================== -->

   <!-- =====================================================
     PAGINAÇÃO
====================================================== -->

<div class="paginacao-container">

    <!-- QUANTIDADE POR PÁGINA -->

    <div class="itens-por-pagina">

        <span>
            Mostrar
        </span>

        <select id="itensPorPagina">

            <option value="5" selected>
                5
            </option>

            <option value="10">
                10
            </option>

            <option value="20">
                20
            </option>

            <option value="50">
                50
            </option>

        </select>

        <span>
            por página
        </span>

    </div>


    <!-- INFORMAÇÃO DOS RESULTADOS -->

    <div id="infoOcorrencias">

        Mostrando 0 de 0

    </div>


    <!-- PAGINAÇÃO -->

    <div class="pagination">

        <button
            id="anterior"
            type="button"
            title="Página anterior"
        >

            <i class="fas fa-chevron-left"></i>

        </button>


        <span id="paginaAtual">
            1
        </span>


        <button
            id="proximo"
            type="button"
            title="Próxima página"
        >

            <i class="fas fa-chevron-right"></i>

        </button>

    </div>

</div>
            


    </div>
    <!-- FIM .main -->


</div>
<!-- FIM .overlay -->



<!-- =========================================================
     JAVASCRIPT
========================================================= -->
 <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>new window.VLibras.Widget('https://vlibras.gov.br/app');</script>


    <script>

/* ==========================================================
   ELEMENTOS DOS FILTROS
========================================================== */

const filtroFuncionario =
    document.getElementById('filtroFuncionario');

const filtroStatus =
    document.getElementById('filtroStatus');

const filtroData =
    document.getElementById('filtroData');

const todosCards =
    Array.from(
        document.querySelectorAll(
            '#listaOcorrencias .card'
        )
    );


    // ==========================================================
// ORDENAR OCORRÊNCIAS — MAIS RECENTES PRIMEIRO
// ==========================================================
todosCards.sort((a, b) => {
    const dataA = a.dataset.data || '';
    const dataB = b.dataset.data || '';

    // Pega também o horário da ocorrência
    const horaA = a.dataset.hora || '00:00:00';
    const horaB = b.dataset.hora || '00:00:00';

    const dataHoraA = new Date(`${dataA}T${horaA}`);
    const dataHoraB = new Date(`${dataB}T${horaB}`);

    return dataHoraB - dataHoraA;
});


/* ==========================================================
   CONFIGURAÇÃO DA PAGINAÇÃO
========================================================== */

let cardsPorPagina = 5;

let paginaAtual = 1;

let cardsFiltrados = [...todosCards];


/* ==========================================================
   MOSTRAR PÁGINA
========================================================== */

function mostrarPagina() {

    /* ------------------------------------------
       Esconde todos os cards
    ------------------------------------------ */

    todosCards.forEach(card => {

        card.style.display = 'none';

    });


    /* ------------------------------------------
       Calcula início e fim
    ------------------------------------------ */

    const inicio =
        (paginaAtual - 1) *
        cardsPorPagina;

    const fim =
        inicio +
        cardsPorPagina;


    /* ------------------------------------------
       Cards da página atual
    ------------------------------------------ */

    const cardsPagina =
        cardsFiltrados.slice(
            inicio,
            fim
        );


    /* ------------------------------------------
       Mostra os cards
    ------------------------------------------ */

    cardsPagina.forEach(card => {

        card.style.display = 'block';

    });


    /* ------------------------------------------
       Atualiza rodapé
    ------------------------------------------ */

    atualizarRodape(
        inicio,
        Math.min(
            fim,
            cardsFiltrados.length
        ),
        cardsFiltrados.length
    );

}


/* ==========================================================
   ATUALIZAR RODAPÉ
========================================================== */

function atualizarRodape(
    inicio,
    fim,
    total
) {

    const info =
        document.getElementById(
            'infoOcorrencias'
        );

    const pagina =
        document.getElementById(
            'paginaAtual'
        );

    const anterior =
        document.getElementById(
            'anterior'
        );

    const proximo =
        document.getElementById(
            'proximo'
        );


    /* ------------------------------------------
       Informação dos resultados
    ------------------------------------------ */

    if (total === 0) {

        info.textContent =
            'Mostrando 0 de 0';

    } else {

        info.textContent =
            `Mostrando ${inicio + 1} a ${fim} de ${total}`;

    }


    /* ------------------------------------------
       Número da página
    ------------------------------------------ */

    pagina.textContent =
        paginaAtual;


    /* ------------------------------------------
       Total de páginas
    ------------------------------------------ */

    const totalPaginas =
        Math.max(
            1,
            Math.ceil(
                total /
                cardsPorPagina
            )
        );


    /* ------------------------------------------
       Botão ANTERIOR
    ------------------------------------------ */

    anterior.disabled =
        paginaAtual <= 1;


    /* ------------------------------------------
       Botão PRÓXIMO
    ------------------------------------------ */

    proximo.disabled =
        paginaAtual >= totalPaginas;

}


/* ==========================================================
   ALTERAR ITENS POR PÁGINA
========================================================== */

function alterarItensPorPagina() {

    const seletor =
        document.getElementById(
            'itensPorPagina'
        );


    cardsPorPagina =
        parseInt(
            seletor.value
        );


    paginaAtual = 1;


    mostrarPagina();

}


/* ==========================================================
   MUDAR PÁGINA
========================================================== */

function mudarPagina(direcao) {

    const totalPaginas =
        Math.ceil(
            cardsFiltrados.length /
            cardsPorPagina
        );


    /* ------------------------------------------
       Calcula nova página
    ------------------------------------------ */

    paginaAtual += direcao;


    /* ------------------------------------------
       Limite mínimo
    ------------------------------------------ */

    if (paginaAtual < 1) {

        paginaAtual = 1;

    }


    /* ------------------------------------------
       Limite máximo
    ------------------------------------------ */

    if (
        paginaAtual >
        totalPaginas
    ) {

        paginaAtual =
            totalPaginas;

    }


    mostrarPagina();

}


/* ==========================================================
   FILTRAR OCORRÊNCIAS
========================================================== */

function filtrarOcorrencias() {

    const nome =
        filtroFuncionario
            .value
            .toLowerCase()
            .trim();


    const status =
        filtroStatus.value;


    const data =
        filtroData.value;


    /* ------------------------------------------
       Filtra os cards
    ------------------------------------------ */

    cardsFiltrados =
        todosCards.filter(card => {


            const funcionario =
                (
                    card.dataset.funcionario
                    || ''
                ).toLowerCase();


            const cardStatus =
                card.dataset.status
                || '';


            const cardData =
                card.dataset.data
                || '';


            /* ----------------------------------
               Filtro funcionário
            ---------------------------------- */

            const matchNome =
                funcionario.includes(nome);


            /* ----------------------------------
               Filtro status
            ---------------------------------- */

            const matchStatus =
                status === '' ||
                cardStatus === status;


            /* ----------------------------------
               Filtro data
            ---------------------------------- */

            const matchData =
                data === '' ||
                cardData === data;


            return (
                matchNome &&
                matchStatus &&
                matchData
            );

        });


    /* ------------------------------------------
       Sempre volta para página 1
    ------------------------------------------ */

    paginaAtual = 1;


    mostrarPagina();

}


/* ==========================================================
   LIMPAR FILTROS
========================================================== */

function limparFiltros() {

    filtroFuncionario.value = '';

    filtroStatus.value = '';

    filtroData.value = '';

    paginaAtual = 1;

    filtrarOcorrencias();

}


/* ==========================================================
   EVENTOS DOS FILTROS
========================================================== */


/* ------------------------------------------
   Funcionário
------------------------------------------ */

filtroFuncionario.addEventListener(
    'input',
    filtrarOcorrencias
);


/* ------------------------------------------
   Status
------------------------------------------ */

filtroStatus.addEventListener(
    'change',
    filtrarOcorrencias
);


/* ------------------------------------------
   Data
------------------------------------------ */

filtroData.addEventListener(
    'change',
    filtrarOcorrencias
);


/* ==========================================================
   EVENTOS DA PAGINAÇÃO
========================================================== */


/* ------------------------------------------
   Quantidade por página
------------------------------------------ */

const seletorPagina =
    document.getElementById(
        'itensPorPagina'
    );

if (seletorPagina) {

    seletorPagina.addEventListener(
        'change',
        function () {

            cardsPorPagina =
                parseInt(
                    this.value
                );

            paginaAtual = 1;

            mostrarPagina();

        }
    );

}


/* ------------------------------------------
   Botão ANTERIOR
------------------------------------------ */

const botaoAnterior =
    document.getElementById(
        'anterior'
    );

if (botaoAnterior) {

    botaoAnterior.addEventListener(
        'click',
        function () {

            if (paginaAtual > 1) {

                paginaAtual--;

                mostrarPagina();

            }

        }
    );

}


/* ------------------------------------------
   Botão PRÓXIMO
------------------------------------------ */

const botaoProximo =
    document.getElementById(
        'proximo'
    );

if (botaoProximo) {

    botaoProximo.addEventListener(
        'click',
        function () {

            const totalPaginas =
                Math.ceil(
                    cardsFiltrados.length /
                    cardsPorPagina
                );


            if (
                paginaAtual <
                totalPaginas
            ) {

                paginaAtual++;

                mostrarPagina();

            }

        }
    );

}


/* ==========================================================
   MODO ESCURO
========================================================== */

function toggleDark() {

    document.body.classList.toggle(
        'dark-mode'
    );

}


/* ==========================================================
   MENU DE ACESSIBILIDADE
========================================================== */

function toggleAccessMenu() {

    const menu =
        document.getElementById(
            'accessOptions'
        );


    if (!menu) return;


    menu.classList.toggle(
        'show'
    );

}


/* ==========================================================
   FECHAR MENU AO CLICAR FORA
========================================================== */

document.addEventListener(
    'click',
    function (event) {

        const menu =
            document.getElementById(
                'accessOptions'
            );

        const botao =
            document.querySelector(
                '.gear-btn'
            );


        if (
            menu &&
            botao &&
            !menu.contains(event.target) &&
            !botao.contains(event.target)
        ) {

            menu.classList.remove(
                'show'
            );

        }

    }
);


/* ==========================================================
   INICIALIZAÇÃO
========================================================== */

mostrarPagina();

</script>
<!-- =========================================================
     ACESSIBILIDADE
========================================================= -->

<script
    src="<?= base_url(
        'assets/js/acessibilidade.js'
    ) ?>"
></script>
<!-- COMPONENTE VLIBRAS -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

</body>
</html>