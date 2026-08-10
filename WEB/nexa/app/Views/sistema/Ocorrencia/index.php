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
        href="<?= base_url('assets/css/acessibilidade.css') ?>"
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

                        data-data="<?= $o['DATA_ANALISE'] ?>"
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

                        <div class="epi-box">


                            <!-- EPIs DETECTADOS -->

                            <?php if (
                                !empty(
                                    $o['EPIS_DETECTADOS']
                                )
                            ) : ?>

                                <span class="ok">

                                    <i class="fas fa-check"></i>

                                    <?= esc(
                                        $o['EPIS_DETECTADOS']
                                    ) ?>

                                </span>

                            <?php endif; ?>



                            <!-- EPIs AUSENTES -->

                            <?php if (
                                isset(
                                    $o['EPIS_AUSENTE']
                                )
                                &&
                                $o['EPIS_AUSENTE']
                                != 'Nenhum'
                                &&
                                !empty(
                                    $o['EPIS_AUSENTE']
                                )
                            ) : ?>

                                <span class="fail">

                                    <i class="fas fa-xmark"></i>

                                    <?= esc(
                                        $o['EPIS_AUSENTE']
                                    ) ?>

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

     <div class="paginacao-container">

    <!-- QUANTIDADE POR PÁGINA -->

    <div class="itens-por-pagina">

        <span>
            Exibir:
        </span>

        <select
            id="itensPorPagina"
            onchange="alterarItensPorPagina()"
        >

            <option value="5">
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


    <!-- PAGINAÇÃO -->

    <div
        class="paginacao"
        id="paginacao"
    ></div>

</div>
            


    </div>
    <!-- FIM .main -->


</div>
<!-- FIM .overlay -->



<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>


/* ==========================================================
   ELEMENTOS DOS FILTROS
========================================================== */

const filtroFuncionario =
    document.getElementById(
        'filtroFuncionario'
    );


const filtroStatus =
    document.getElementById(
        'filtroStatus'
    );


const filtroData =
    document.getElementById(
        'filtroData'
    );


const todosCards =
    Array.from(
        document.querySelectorAll(
            '#listaOcorrencias .card'
        )
    );



/* ==========================================================
   CONFIGURAÇÃO DA PAGINAÇÃO
========================================================== */

let cardsPorPagina = 5;

let paginaAtual = 1;

let cardsFiltrados = [
    ...todosCards
];


function alterarItensPorPagina() {

    const seletor =
        document.getElementById(
            'itensPorPagina'
        );

    cardsPorPagina =
        parseInt(seletor.value);

    paginaAtual = 1;

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



            const matchNome =
                funcionario.includes(nome);


            const matchStatus =
                status === ''
                ||
                cardStatus === status;


            const matchData =
                data === ''
                ||
                cardData === data;



            return (
                matchNome
                &&
                matchStatus
                &&
                matchData
            );

        });



    /* Volta para a primeira página */

    paginaAtual = 1;


    mostrarPagina();

}



/* ==========================================================
   MOSTRAR PÁGINA
========================================================== */

function mostrarPagina() {


    /*
    Esconde todos os cards
    */

    todosCards.forEach(card => {

        card.style.display = 'none';

    });



    /*
    Calcula início e fim
    */

    const inicio =
        (paginaAtual - 1)
        * cardsPorPagina;


    const fim =
        inicio
        + cardsPorPagina;



    /*
    Pega somente os cards
    daquela página
    */

    const cardsPagina =
        cardsFiltrados.slice(
            inicio,
            fim
        );



    /*
    Mostra os cards
    */

    cardsPagina.forEach(card => {

        card.style.display =
            'block';

    });



    /*
    Atualiza paginação
    */

    criarPaginacao();

}



/* ==========================================================
   CRIAR PAGINAÇÃO
========================================================== */

function criarPaginacao() {


    const paginacao =
        document.getElementById(
            'paginacao'
        );


    paginacao.innerHTML = '';



    /*
    Quantidade total de páginas
    */

    const totalPaginas =
        Math.ceil(
            cardsFiltrados.length
            /
            cardsPorPagina
        );



    /*
    Se não houver resultados
    */

    if (totalPaginas === 0) {

        return;

    }



    /* ======================================================
       BOTÃO ANTERIOR
    ======================================================= */

    const anterior =
        document.createElement(
            'button'
        );


    anterior.className =
        'pagina-btn';


    anterior.innerHTML =
        '<i class="fas fa-chevron-left"></i>';


    anterior.disabled =
        paginaAtual === 1;


    anterior.onclick =
        function () {

            mudarPagina(-1);

        };


    paginacao.appendChild(
        anterior
    );



    /* ======================================================
       NÚMEROS DAS PÁGINAS
    ======================================================= */

    for (
        let i = 1;
        i <= totalPaginas;
        i++
    ) {


        const botao =
            document.createElement(
                'button'
            );


        botao.className =
            'pagina-btn';


        botao.textContent =
            i;



        /*
        Página atual
        */

        if (
            i === paginaAtual
        ) {

            botao.classList.add(
                'ativa'
            );

        }



        /*
        Ao clicar
        */

        botao.onclick =
            function () {

                paginaAtual = i;

                mostrarPagina();

            };



        paginacao.appendChild(
            botao
        );

    }



    /* ======================================================
       BOTÃO PRÓXIMO
    ======================================================= */

    const proximo =
        document.createElement(
            'button'
        );


    proximo.className =
        'pagina-btn';


    proximo.innerHTML =
        '<i class="fas fa-chevron-right"></i>';


    proximo.disabled =
        paginaAtual === totalPaginas;


    proximo.onclick =
        function () {

            mudarPagina(1);

        };


    paginacao.appendChild(
        proximo
    );

}



/* ==========================================================
   MUDAR PÁGINA
========================================================== */

function mudarPagina(direcao) {


    const totalPaginas =
        Math.ceil(
            cardsFiltrados.length
            /
            cardsPorPagina
        );


    paginaAtual += direcao;



    /*
    Impede página menor que 1
    */

    if (
        paginaAtual < 1
    ) {

        paginaAtual = 1;

    }



    /*
    Impede passar da última
    */

    if (
        paginaAtual > totalPaginas
    ) {

        paginaAtual =
            totalPaginas;

    }



    mostrarPagina();

}



/* ==========================================================
   LIMPAR FILTROS
========================================================== */

function limparFiltros() {


    filtroFuncionario.value =
        '';


    filtroStatus.value =
        '';


    filtroData.value =
        '';



    paginaAtual = 1;


    filtrarOcorrencias();

}



/* ==========================================================
   EVENTOS DOS FILTROS
========================================================== */


/*
Busca enquanto digita
*/

filtroFuncionario.addEventListener(
    'input',
    filtrarOcorrencias
);


/*
Status
*/

filtroStatus.addEventListener(
    'change',
    filtrarOcorrencias
);


/*
Data
*/

filtroData.addEventListener(
    'change',
    filtrarOcorrencias
);



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
            menu
            &&
            !menu.contains(event.target)
            &&
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


</body>

</html>