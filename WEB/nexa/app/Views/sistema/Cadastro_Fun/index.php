<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Funcionários</title>

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    >

    <!-- CSS -->
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
        href="<?= base_url('assets/css/cadastro_funci.css') ?>"
    >

    <style>

        /* =========================================================
           HEADER
        ========================================================= */

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 18px;
        }


        /* =========================================================
           MENU DE ACESSIBILIDADE
        ========================================================= */

        .access-options.show,
        .access-options.active {
            display: flex;
        }

        .access-menu {
            position: relative;
            display: flex;
            align-items: center;
        }

        .gear-btn {
            background: transparent !important;
            border: none !important;
            outline: none !important;
            cursor: pointer;

            font-size: 1.2rem;
            color: #6c757d;

            padding: 6px;

            display: flex;
            align-items: center;
            justify-content: center;

            transition:
                color 0.2s,
                transform 0.3s;
        }

        .gear-btn:hover {
            color: #2b3674;
            transform: rotate(45deg);
        }

        .access-options {
            display: none;

            position: absolute;

            top: 130%;
            right: 0;

            background: #ffffff;

            box-shadow:
                0px 4px 15px rgba(0, 0, 0, 0.12);

            border-radius: 8px;

            padding: 8px;

            gap: 6px;

            z-index: 1000;
        }

        .access-options.show {
            display: flex;
        }

        .access-btn {
            background: #f4f7fe;

            border: none;

            padding: 8px 12px;

            border-radius: 6px;

            cursor: pointer;

            color: #2b3674;

            font-weight: 600;

            transition: background 0.2s;
        }

        .access-btn:hover {
            background: #e0e5f2;
        }


        /* =========================================================
           MODO ESCURO
        ========================================================= */

        body.dark-mode {
            background-color: #0b1437 !important;
            color: #ffffff !important;
        }

        body.dark-mode .dashboard-header,
        body.dark-mode .form-card,
        body.dark-mode .list-card,
        body.dark-mode .sidebar {
            background-color: #111c44 !important;
            color: #ffffff !important;
        }

        body.dark-mode input,
        body.dark-mode select,
        body.dark-mode textarea {
            background-color: #1b254b !important;
            color: #ffffff !important;
            border-color: #2b3674 !important;
        }


        /* =========================================================
           ALTO CONTRASTE
        ========================================================= */

        body.high-contrast {
            background-color: #000000 !important;
            color: #ffff00 !important;
        }

        body.high-contrast *,
        body.high-contrast input,
        body.high-contrast select,
        body.high-contrast button {
            background-color: #000000 !important;
            color: #ffff00 !important;
            border-color: #ffff00 !important;
        }

    
/* CHECKBOXES DE EPI NA EDICAO */
.edit-epis-container { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:10px; width:100%; max-height:220px; overflow-y:auto; padding:4px; }
.edit-epi-checkbox { display:flex; align-items:center; gap:10px; min-height:48px; padding:10px 12px; border:1px solid #d9e2ec; border-radius:10px; background:#fff; cursor:pointer; transition:.2s ease; }
.edit-epi-checkbox:hover { border-color:#0a66c2; }
.edit-epi-checkbox input { position:absolute; opacity:0; pointer-events:none; }
.edit-epi-checkmark { width:22px; height:22px; min-width:22px; border:2px solid #aab7c4; border-radius:5px; display:flex; align-items:center; justify-content:center; transition:.2s ease; }
.edit-epi-checkmark i { display:none; font-size:12px; color:#fff; }
.edit-epi-checkbox input:checked + .edit-epi-checkmark { background:#198754; border-color:#198754; }
.edit-epi-checkbox input:checked + .edit-epi-checkmark i { display:block; }
.edit-epi-name { font-weight:600; }
@media (max-width:600px) { .edit-epis-container { grid-template-columns:1fr; } }
</style>

</head>


<body>


<!-- =============================================================
     SIDEBAR
============================================================= -->

<aside class="sidebar">

    <img
        class="sidebar-construction"
        src="<?= base_url('assets/images/construcao.jpg') ?>"
        alt=""
    >

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


        <!-- MENU -->

        <nav class="menu">

            <div class="menu-title">
                PRINCIPAL
            </div>


            <a href="<?= base_url('/dashboard') ?>">

                <i class="fas fa-chart-line"></i>

                <span>
                    Dashboard
                </span>

            </a>


            <a href="<?= base_url('/dashboard_camera') ?>">

                <i class="fas fa-video"></i>

                <span>
                    Dashboard de Câmeras
                </span>

            </a>


            <a href="<?= base_url('/ocorrencia') ?>">

                <i class="fas fa-exclamation-triangle"></i>

                <span>
                    Ocorrências
                </span>

            </a>


            <div class="menu-title">
                CADASTROS
            </div>


            <a
                href="<?= base_url('/cadastro-funcionario') ?>"
                class="active"
            >

                <i class="fas fa-users"></i>

                <span>
                    Cadastro Funcionários
                </span>

            </a>


            <a href="<?= base_url('/epi') ?>">

                <i class="fas fa-helmet-safety"></i>

                <span>
                    Cadastro EPIs
                </span>

            </a>


            <a href="<?= base_url('/Camera') ?>">

                <i class="fas fa-camera"></i>

                <span>
                    Cadastro Câmeras
                </span>

            </a>


            <a href="<?= base_url('/setor') ?>">

                <i class="fas fa-building"></i>

                <span>
                    Cadastro Setores
                </span>

            </a>


            <div class="menu-title">
                CONTA
            </div>


            <a href="<?= base_url('/administrador') ?>">

                <i class="fas fa-user"></i>

                <span>
                    Perfil
                </span>

            </a>

        </nav>


        <!-- SAIR -->

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



<!-- =============================================================
     HEADER
============================================================= -->

<header class="dashboard-header">

    <div class="header-title">

        <h1>
            Cadastro de Funcionários
        </h1>

        <p>
            Gerencie os funcionários cadastrados da sua empresa
        </p>

    </div>


    <div class="header-right">


        <!-- ACESSIBILIDADE -->

        <div class="access-menu">

            <button
                type="button"
                class="gear-btn"
                onclick="toggleAccessMenu()"
                title="Acessibilidade"
            >

                <i class="fas fa-cog"></i>

            </button>


            <div
                class="access-options"
                id="accessOptions"
            >

                <button
                    type="button"
                    class="access-btn"
                    onclick="AcessibilidadePagina.toggleContraste()"
                    title="Alto Contraste"
                >

                    <i class="fas fa-adjust"></i>

                </button>


                <button
                    type="button"
                    class="access-btn"
                    onclick="AcessibilidadePagina.toggleDark()"
                    title="Modo Escuro"
                >

                    <i class="fas fa-moon"></i>

                </button>


                <button
                    type="button"
                    class="access-btn"
                    onclick="AcessibilidadePagina.aumentarFonte()"
                    title="Aumentar Fonte"
                >
                    A+
                </button>


                <button
                    type="button"
                    class="access-btn"
                    onclick="AcessibilidadePagina.diminuirFonte()"
                    title="Diminuir Fonte"
                >
                    A-
                </button>


                <button
                    type="button"
                    class="access-btn"
                    onclick="AcessibilidadePagina.lerPagina()"
                    title="Ler Página"
                >

                    <i class="fas fa-volume-up"></i>

                </button>

            </div>

        </div>


        <!-- PERFIL -->

        <a
            href="<?= base_url('/administrador') ?>"
            class="profile"
        >

            <div class="profile-avatar">

                <?= strtoupper(
                    substr(
                        session()->get('nome') ?? 'A',
                        0,
                        1
                    )
                ) ?>

            </div>


            <div class="profile-info">

                <strong>
                    <?= esc(
                        session()->get('nome')
                        ?? 'Administrador'
                    ) ?>
                </strong>

                <span>
                    NEXA SOLUÇÕES
                </span>

            </div>

        </a>

    </div>

</header>



<!-- =============================================================
     CONTEÚDO
============================================================= -->

<div class="overlay">

    <div class="content-container">


        <!-- =====================================================
             CARD DE CADASTRO
        ===================================================== -->

        <section class="form-card">


            <!-- TOPO -->

            <div class="cadastro-topo">

                <div class="cadastro-info">


                    <div class="funcionario-icon-bg">

                        <i class="fas fa-user-plus"></i>

                    </div>


                    <div>

                        <h2>
                            Cadastrar Novo Funcionário
                        </h2>

                        <p>
                            Preencha as informações para adicionar
                            um novo funcionário ao sistema.
                        </p>

                    </div>

                </div>

            </div>


            <div class="subtitle">
                Informações
            </div>



            <!-- =================================================
                 FORMULÁRIO
            ================================================= -->

            <form
                id="form-fun"
                action="<?= base_url('/Cadastro_Fun/inserir') ?>"
                method="post"
            >

                <?= csrf_field() ?>


                <input
                    type="hidden"
                    name="CPF_ORIGINAL"
                    id="cpf_original"
                >


                <div class="form-grid">


                    <!-- NOME -->

                    <div class="form-group">

                        <p class="p-card">
                            Nome completo
                        </p>

                        <div class="input-box">

                            <i class="fas fa-user"></i>

                            <input
                                type="text"
                                id="nome"
                                name="NOME_COMPLETO"
                                placeholder="Nome completo"
                                value="<?= old('NOME_COMPLETO') ?>"
                                oninput="validarNome(this)"
                                
                            >

                        </div>

                        <div class="error-text"></div>

                    </div>



                    <!-- CPF -->

                    <div class="form-group">

                        <p class="p-card">
                            CPF
                        </p>

                        <div class="input-box">

                            <i class="fas fa-id-card"></i>

                            <input
                                type="text"
                                id="cpf"
                                name="CPF"
                                placeholder="000.000.000-00"
                                maxlength="14"
                                oninput="maskCPF(this)"
                                value="<?= old('CPF') ?>"
                                
                            >

                        </div>

                        <div class="error-text"></div>

                    </div>



                    <!-- DATA NASCIMENTO -->

                    <div class="form-group">

                        <p class="p-card">
                            Data de nascimento
                        </p>

                        <div class="input-box">

                            <i class="fas fa-calendar"></i>

                            <input
                                type="date"
                                id="nascimento"
                                name="DATA_NASCIMENTO"
                                max="<?= date('Y-m-d') ?>"
                                value="<?= old('DATA_NASCIMENTO') ?>"
                                
                            >

                        </div>

                        <div class="error-text"></div>

                    </div>



                    <!-- EMAIL -->

                    <div class="form-group">

                        <p class="p-card">
                            E-mail corporativo
                        </p>

                        <div class="input-box">

                            <i class="fas fa-envelope"></i>

                            <input
                                type="email"
                                id="email"
                                name="EMAIL_CORPORATIVO"
                                placeholder="E-mail corporativo"
                                value="<?= old('EMAIL_CORPORATIVO') ?>"
                                
                            >

                        </div>

                        <div class="error-text"></div>

                    </div>



                    <!-- TELEFONE -->

                    <div class="form-group">

                        <p class="p-card">
                            Telefone
                        </p>

                        <div class="input-box">

                            <i class="fas fa-phone"></i>

                            <input
                                type="text"
                                id="telefone"
                                name="TELEFONE"
                                placeholder="(00) 00000-0000"
                                maxlength="15"
                                oninput="maskTel(this)"
                                value="<?= old('TELEFONE') ?>"
                            >

                        </div>

                        <div class="error-text"></div>

                    </div>



                    <!-- RFID -->

                    <div class="form-group">

                        <p class="p-card">
                            UID RFID
                        </p>

                        <div class="input-box">

                            <i class="fas fa-wave-square"></i>

                            <input
                                type="text"
                                id="uid_rfid"
                                name="UID_RFID"
                                placeholder="UID RFID"
                                value="<?= old('UID_RFID') ?>"
                            >

                        </div>

                        <div class="error-text"></div>

                    </div>



                    <!-- SETOR -->

                    <div class="form-group">

                        <p class="p-card">
                            Setor
                        </p>

                        <div class="input-box select">

                            <i class="fas fa-building"></i>

                            <select
                                id="id_setor"
                                name="FK_ID_SETOR"
                                
                            >

                                <option value="">
                                    Selecione o setor
                                </option>


                                <?php if (!empty($setores)): ?>

                                    <?php foreach ($setores as $s): ?>

                                        <option
                                            value="<?= $s['ID'] ?>"
                                            <?= old('FK_ID_SETOR') == $s['ID']
                                                ? 'selected'
                                                : '' ?>
                                        >

                                            <?= esc($s['NOME']) ?>

                                        </option>

                                    <?php endforeach; ?>

                                <?php endif; ?>

                            </select>

                        </div>

                        <div class="error-text"></div>

                    </div>



                    <!-- SENHA -->

                    <div class="form-group">

                        <p class="p-card">
                            Senha
                        </p>

                        <div class="input-box">

                            <i class="fas fa-lock"></i>

                            <input
                                type="password"
                                id="senha"
                                name="SENHA"
                                minlength="6"
                                placeholder="Senha (mínimo 6 caracteres)"
                                
                            >

                        </div>

                        <div class="error-text"></div>

                    </div>



                    <!-- CONFIRMAR SENHA -->

                    <div class="form-group">

                        <p class="p-card">
                            Confirmar senha
                        </p>

                        <div class="input-box">

                            <i class="fas fa-lock"></i>

                            <input
                                type="password"
                                id="confirmSenha"
                                name="CONFIRMAR_SENHA"
                                minlength="6"
                                placeholder="Confirmar senha"
                                
                            >

                        </div>

                        <div class="error-text"></div>

                    </div>



                    <!-- EPIS -->

                    <div class="form-group full-width">

                        <p class="p-card">
                            EPIs obrigatórios
                        </p>


                        <div class="epi-container">

                            <button
                                type="button"
                                class="btn-selecionar-epi"
                                onclick="abrirModalEPI('cadastro')"
                            >

                                <i class="fas fa-helmet-safety"></i>

                                Selecionar EPIs

                            </button>


                            <div id="episSelecionados">

                                Nenhum EPI selecionado

                            </div>


                            <input
                                type="hidden"
                                id="episHidden"
                                name="EPIS"
                                value="[]"
                            >

                        </div>

                    </div>

                </div>



                <!-- BOTÕES -->

                <div class="btn-area">

                    <button
                        type="button"
                        id="btn-cancelar"
                        class="btn-cancelar"
                        style="display:none"
                        onclick="resetarFormulario()"
                    >

                        <i class="fas fa-times"></i>

                        Cancelar

                    </button>


                    <button
                        type="submit"
                        id="btn-salvar"
                    >

                        <i class="fas fa-user-plus"></i>

                        Cadastrar Funcionário

                    </button>

                </div>

            </form>



            <!-- ILUSTRAÇÃO -->

            <div class="form-ilustracao">

                <img
                    src="<?= base_url('assets/images/cartao.png') ?>"
                    alt="Funcionário"
                >

            </div>

        </section>



        <br>



        <!-- =====================================================
             LISTAGEM
        ===================================================== -->

        <section class="list-card">


            <!-- CABEÇALHO DA LISTAGEM -->

            <div class="listagem-header">

                <div>

                    <h2>
                        Funcionários Cadastrados
                    </h2>

                    <p>
                        Gerencie todos os funcionários cadastrados
                        no sistema.
                    </p>

                </div>


                <div class="table-tools">


                    <!-- PESQUISA -->

                    <div class="search-box">

                        <i class="fas fa-search"></i>

                        <input
                            type="text"
                            id="pesquisaFuncionario"
                            placeholder="Pesquisar funcionário..."
                        >

                    </div>


                    <!-- FILTRO -->

                    <button class="filter-btn" type="button">
                            <i class="fas fa-filter"></i>
                        </button>

                </div>

            </div>



            <!-- =================================================
                 TABELA
            ================================================= -->

            <div class="table-wrapper">

                <table class="table-funcionarios">

                    <thead>

                        <tr>

                            <th>
                                Funcionário
                            </th>

                            <th>
                                CPF
                            </th>

                            <th>
                                Data Nasc.
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Telefone
                            </th>

                            <th>
                                UID RFID
                            </th>

                            <th>
                                Setor
                            </th>

                            <th>
                                EPIs
                            </th>

                            <th>
                                Ações
                            </th>

                        </tr>

                    </thead>


                    <tbody id="listaFuncionarios">

                    </tbody>

                </table>

            </div>



            <!-- =================================================
                 RODAPÉ DA TABELA
            ================================================= -->

            <div class="table-footer">


                <div class="rows-page">

                    Mostrar

                    <select id="linhasPagina">

                        <option value="5" selected>
                            5
                        </option>

                        <option value="10">
                            10
                        </option>

                        <option value="20">
                            20
                        </option>

                    </select>

                    por página

                </div>


                <div id="infoTabela">
                    Mostrando 0 de 0
                </div>


                <div class="pagination">
                        <button id="anterior" type="button">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <span id="paginaAtual">1</span>
                        <button id="proximo" type="button">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>

        </section>

    </div>

</div>

<!-- =============================================================
     SCRIPTS EXTERNOS
============================================================= -->

<script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>

<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

<script>
    new window.VLibras.Widget(
        'https://vlibras.gov.br/app'
    );
</script>


<!-- SweetAlert2 -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!-- =============================================================
     DADOS PHP → JAVASCRIPT
============================================================= -->

<script>

    /*
     * IMPORTANTE:
     * Cada variável é declarada UMA ÚNICA VEZ.
     *
     * O erro que estava quebrando sua tabela estava aqui.
     */

    window.funcionariosData =
        <?= json_encode(
            $funcionarios ?? [],
            JSON_UNESCAPED_UNICODE
        ) ?>;


    window.setoresData =
        <?= json_encode(
            $setores ?? [],
            JSON_UNESCAPED_UNICODE
        ) ?>;


    window.episData =
        <?= json_encode(
            $epis ?? [],
            JSON_UNESCAPED_UNICODE
        ) ?>;



    /* =========================================================
       VARIÁVEIS PRINCIPAIS
    ========================================================= */

    const funcionarios =
        Array.isArray(window.funcionariosData)
            ? window.funcionariosData
            : [];


    const setores =
        Array.isArray(window.setoresData)
            ? window.setoresData
            : [];


    const episDisponiveis =
        Array.isArray(window.episData)
            ? window.episData
            : [];



    /* =========================================================
       MAPA DE SETORES
    ========================================================= */

    const mapaSetores = {};


    setores.forEach(setor => {

        mapaSetores[String(setor.ID)] =
            setor.NOME;

    });



    /* =========================================================
       PAGINAÇÃO
    ========================================================= */

    let paginaAtual = 1;

    let linhasPorPagina = 5;

    let funcionariosFiltrados =
        [...funcionarios];



    /* =========================================================
       EPIS SELECIONADOS
    ========================================================= */

    let episSelecionadosAtuais = [];

    let modoSelecaoEPI = "cadastro";



    /* =========================================================
       ACESSIBILIDADE
    ========================================================= */

    const AcessibilidadePagina = {

        tamanhoFonteAtual: 100,


        aumentarFonte() {

            if (this.tamanhoFonteAtual < 140) {

                this.tamanhoFonteAtual += 10;

                document.body.style.fontSize =
                    this.tamanhoFonteAtual + "%";

            }

        },


        diminuirFonte() {

            if (this.tamanhoFonteAtual > 70) {

                this.tamanhoFonteAtual -= 10;

                document.body.style.fontSize =
                    this.tamanhoFonteAtual + "%";

            }

        },


        toggleContraste() {

            document.body.classList.remove(
                "dark-mode"
            );

            document.body.classList.toggle(
                "high-contrast"
            );

        },


        toggleDark() {

            document.body.classList.remove(
                "high-contrast"
            );

            document.body.classList.toggle(
                "dark-mode"
            );

        },


        lerPagina() {

            if (!("speechSynthesis" in window)) {

                alert(
                    "Seu navegador não suporta a leitura de texto por voz."
                );

                return;

            }


            if (window.speechSynthesis.speaking) {

                window.speechSynthesis.cancel();

                return;

            }


            const conteudo =
                document.querySelector(
                    ".content-container"
                ) || document.body;


            const utterance =
                new SpeechSynthesisUtterance(
                    conteudo.innerText
                );


            utterance.lang = "pt-BR";

            utterance.rate = 1.1;


            window.speechSynthesis.speak(
                utterance
            );

        }

    };



    /* =========================================================
       MENU ACESSIBILIDADE
    ========================================================= */

   function toggleAccessMenu() {
            const options = document.getElementById('accessOptions');
            if (options) {
                options.classList.toggle('show');
                options.classList.toggle('active');
            }
        }

        document.addEventListener('click', function (event) {
            const menu = document.querySelector('.access-menu');
            if (menu && !menu.contains(event.target)) {
                const options = document.getElementById('accessOptions');
                if (options) {
                    options.classList.remove('show');
                    options.classList.remove('active');
                }
            }
        });



    /* =========================================================
       DOM CARREGADO
    ========================================================= */

    document.addEventListener(
        "DOMContentLoaded",
        function() {

            iniciarEventos();

            renderizarTabela();

        }
    );



    /* =========================================================
       EVENTOS DA TABELA
    ========================================================= */

    function iniciarEventos() {


        /* PESQUISA */

        const pesquisa =
            document.getElementById(
                "pesquisaFuncionario"
            );


        if (pesquisa) {

            pesquisa.addEventListener(
                "input",
                function() {

                    paginaAtual = 1;

                    aplicarPesquisa();

                }
            );

        }



        /* LINHAS POR PÁGINA */

        const linhas =
            document.getElementById(
                "linhasPagina"
            );


        if (linhas) {

            linhas.addEventListener(
                "change",
                function() {

                    linhasPorPagina =
                        Number(this.value);

                    paginaAtual = 1;

                    renderizarTabela();

                }
            );

        }



        /* BOTÃO ANTERIOR */

        const anterior =
            document.getElementById(
                "anterior"
            );


        if (anterior) {

            anterior.addEventListener(
                "click",
                function() {

                    if (paginaAtual > 1) {

                        paginaAtual--;

                        renderizarTabela();

                    }

                }
            );

        }



        /* BOTÃO PRÓXIMO */

        const proximo =
            document.getElementById(
                "proximo"
            );


        if (proximo) {

            proximo.addEventListener(
                "click",
                function() {

                    const totalPaginas =
                        Math.ceil(
                            funcionariosFiltrados.length /
                            linhasPorPagina
                        );


                    if (
                        paginaAtual <
                        totalPaginas
                    ) {

                        paginaAtual++;

                        renderizarTabela();

                    }

                }
            );

        }

    }



    /* =========================================================
       PESQUISA
    ========================================================= */

    function aplicarPesquisa() {

        const campo =
            document.getElementById(
                "pesquisaFuncionario"
            );


        if (!campo) return;


        const texto =
            campo.value
                .toLowerCase()
                .trim();


        funcionariosFiltrados =
            funcionarios.filter(
                function(fun) {


                    const nome =
                        String(
                            fun.NOME_COMPLETO ?? ""
                        ).toLowerCase();


                    const cpf =
                        String(
                            fun.CPF ?? ""
                        ).toLowerCase();


                    const email =
                        String(
                            fun.EMAIL_CORPORATIVO ?? ""
                        ).toLowerCase();


                    const telefone =
                        String(
                            fun.TELEFONE ?? ""
                        ).toLowerCase();


                    const setor =
                        String(
                            mapaSetores[
                                String(
                                    fun.FK_ID_SETOR
                                )
                            ] ?? ""
                        ).toLowerCase();


                    const uid =
                        String(
                            fun.UID_RFID ?? ""
                        ).toLowerCase();


                    return (

                        nome.includes(texto) ||

                        cpf.includes(texto) ||

                        email.includes(texto) ||

                        telefone.includes(texto) ||

                        setor.includes(texto) ||

                        uid.includes(texto)

                    );

                }
            );


        renderizarTabela();

    }



    /* =========================================================
       RENDERIZAR TABELA
    ========================================================= */

    function renderizarTabela() {

        const tabela =
            document.getElementById(
                "listaFuncionarios"
            );


        if (!tabela) return;


        tabela.innerHTML = "";



        /* NENHUM FUNCIONÁRIO */

        if (
            funcionariosFiltrados.length === 0
        ) {

            tabela.innerHTML = `

                <tr>

                    <td
                        colspan="9"
                        class="mensagem-vazia"
                    >

                        <i class="fas fa-users-slash"></i>

                        <br><br>

                        Nenhum funcionário encontrado.

                    </td>

                </tr>

            `;


            atualizarRodape(
                0,
                0,
                0
            );


            return;

        }



        /* PAGINAÇÃO */

        const inicio =
            (paginaAtual - 1) *
            linhasPorPagina;


        const fim =
            inicio +
            linhasPorPagina;


        const paginaFuncionarios =
            funcionariosFiltrados.slice(
                inicio,
                fim
            );



        /* =====================================================
           FUNCIONÁRIOS
        ===================================================== */

        paginaFuncionarios.forEach(
            function(fun) {


                /* EPIS */

                let episHTML = "-";


                if (
                    Array.isArray(fun.EPIS) &&
                    fun.EPIS.length > 0
                ) {

                    episHTML =
                        fun.EPIS.map(
                            function(epi) {

                                const nomeEPI =
                                    epi.nome ??
                                    epi.NOME_EPI ??
                                    "EPI";


                                return `

                                    <span class="epi-tag">

                                        <i
                                            class="fas ${iconeEPI(nomeEPI)}"
                                        ></i>

                                        ${escapeHTML(nomeEPI)}

                                    </span>

                                `;

                            }
                        ).join("");

                }



                /* LINHA */

                tabela.innerHTML += `

                    <tr>


                        <!-- FUNCIONÁRIO -->

                        <td>

                            <div class="func-avatar">

                                <strong>
                                    ${escapeHTML(
                                        fun.NOME_COMPLETO
                                    )}
                                </strong>

                            </div>

                        </td>


                        <!-- CPF -->

                        <td>
                            ${escapeHTML(
                                fun.CPF
                            )}
                        </td>


                        <!-- NASCIMENTO -->

                        <td>
                            ${escapeHTML(
                                fun.DATA_NASCIMENTO ||
                                "-"
                            )}
                        </td>


                        <!-- EMAIL -->

                        <td>
                            ${escapeHTML(
                                fun.EMAIL_CORPORATIVO
                            )}
                        </td>


                        <!-- TELEFONE -->

                        <td>
                            ${escapeHTML(
                                fun.TELEFONE ||
                                "-"
                            )}
                        </td>


                        <!-- RFID -->

                        <td>
                            ${escapeHTML(
                                fun.UID_RFID ||
                                "-"
                            )}
                        </td>


                        <!-- SETOR -->

                        <td>
                            ${escapeHTML(
                                mapaSetores[
                                    String(
                                        fun.FK_ID_SETOR
                                    )
                                ] ??
                                "-"
                            )}
                        </td>


                        <!-- EPIS -->

                        <td>

                            <div class="epis-tabela">

                                ${episHTML}

                            </div>

                        </td>


                   <!-- AÇÕES -->
<td>
    <div class="table-actions">

        <!-- EDITAR -->
        <button
            class="table-action edit"
            type="button"
            onclick="abrirModalEdicaoPorCPF('${escapeJS(fun.CPF)}')"
            title="Editar funcionário"
        >
            <i class="fas fa-pen"></i>
        </button>

        <!-- EXCLUIR -->
        <button
            class="table-action delete"
            type="button"
            onclick="confirmarExclusao('${escapeJS(fun.CPF)}')"
            title="Excluir funcionário"
        >
            <i class="fas fa-trash"></i>
        </button>

    </div>
</td>

                    </tr>

                `;

            }
        );



        /* RODAPÉ */

        atualizarRodape(

            inicio + 1,

            Math.min(
                fim,
                funcionariosFiltrados.length
            ),

            funcionariosFiltrados.length

        );

    }



    /* =========================================================
       RODAPÉ
    ========================================================= */

    function atualizarRodape(
        inicio,
        fim,
        total
    ) {

        const info =
            document.getElementById(
                "infoTabela"
            );


        const pagina =
            document.getElementById(
                "paginaAtual"
            );


        const anterior =
            document.getElementById(
                "anterior"
            );


        const proximo =
            document.getElementById(
                "proximo"
            );


        if (info) {

            info.innerHTML =
                `Mostrando ${inicio} a ${fim} de ${total}`;

        }


        if (pagina) {

            pagina.innerHTML =
                paginaAtual;

        }


        const totalPaginas =
            Math.max(
                1,
                Math.ceil(
                    total /
                    linhasPorPagina
                )
            );


        if (anterior) {

            anterior.disabled =
                paginaAtual === 1;

        }


        if (proximo) {

            proximo.disabled =
                paginaAtual >= totalPaginas;

        }

    }



    /* =========================================================
       ESCAPAR HTML
    ========================================================= */

    function escapeHTML(valor) {

        return String(valor ?? "")

            .replaceAll(
                "&",
                "&amp;"
            )

            .replaceAll(
                "<",
                "&lt;"
            )

            .replaceAll(
                ">",
                "&gt;"
            )

            .replaceAll(
                '"',
                "&quot;"
            )

            .replaceAll(
                "'",
                "&#039;"
            );

    }



    /* =========================================================
       ESCAPAR JAVASCRIPT
    ========================================================= */

    function escapeJS(valor) {

        return String(valor ?? "")
            .replaceAll("\\", "\\\\")
            .replaceAll("'", "\\'")
            .replaceAll("\n", "\\n")
            .replaceAll("\r", "\\r");

    }



    /* =========================================================
       CPF
    ========================================================= */

    function maskCPF(input) {

        let valor =
            input.value
                .replace(/\D/g, "")
                .substring(0, 11);


        valor =
            valor.replace(
                /(\d{3})(\d)/,
                "$1.$2"
            );


        valor =
            valor.replace(
                /(\d{3})(\d)/,
                "$1.$2"
            );


        valor =
            valor.replace(
                /(\d{3})(\d{1,2})$/,
                "$1-$2"
            );


        input.value = valor;

    }



    /* =========================================================
       TELEFONE
    ========================================================= */

    function maskTel(input) {

        let valor =
            input.value
                .replace(/\D/g, "")
                .substring(0, 11);


        if (valor.length <= 10) {

            valor =
                valor.replace(
                    /(\d{2})(\d)/,
                    "($1) $2"
                );


            valor =
                valor.replace(
                    /(\d{4})(\d)/,
                    "$1-$2"
                );

        } else {

            valor =
                valor.replace(
                    /(\d{2})(\d)/,
                    "($1) $2"
                );


            valor =
                valor.replace(
                    /(\d{5})(\d)/,
                    "$1-$2"
                );

        }


        input.value = valor;

    }



    /* =========================================================
       NOME
    ========================================================= */

    function validarNome(input) {

        input.value =
            input.value.replace(
                /[^a-zA-ZÀ-ÿ\s]/g,
                ""
            );

    }



    /* =========================================================
       ÍCONES DOS EPIS
    ========================================================= */

    function iconeEPI(nome) {

        const texto =
            String(nome || "")
                .toLowerCase();


        if (
            texto.includes("capacete") ||
            texto.includes("helmet")
        ) {

            return "fa-helmet-safety";

        }


        if (
            texto.includes("óculos") ||
            texto.includes("oculos") ||
            texto.includes("proteção ocular")
        ) {

            return "fa-glasses";

        }


        if (
            texto.includes("luva") ||
            texto.includes("luvas")
        ) {

            return "fa-hand";

        }


        if (
            texto.includes("botina") ||
            texto.includes("bota") ||
            texto.includes("calçado")
        ) {

            return "fa-shoe-prints";

        }


        if (
            texto.includes("protetor auricular") ||
            texto.includes("auricular") ||
            texto.includes("ouvido")
        ) {

            return "fa-ear-listen";

        }


        if (
            texto.includes("máscara") ||
            texto.includes("mascara") ||
            texto.includes("respirador")
        ) {

            return "fa-mask-face";

        }


        if (
            texto.includes("colete")
        ) {

            return "fa-vest";

        }


        if (
            texto.includes("cinto") ||
            texto.includes("segurança")
        ) {

            return "fa-person-falling";

        }


        if (
            texto.includes("protetor facial") ||
            texto.includes("face")
        ) {

            return "fa-face-smile";

        }


        if (
            texto.includes("avental")
        ) {

            return "fa-shirt";

        }


        return "fa-shield-halved";

    }



    /* =========================================================
       ABRIR MODAL EPI
    ========================================================= */

    function abrirModalEPI(
        modo = "cadastro"
    ) {

        modoSelecaoEPI = modo;


        const modal =
            document.getElementById(
                "modalEPI"
            );


        const lista =
            document.getElementById(
                "listaEPIsModal"
            );


        if (!modal || !lista) return;


        lista.innerHTML = "";



        /* NENHUM EPI */

        if (
            episDisponiveis.length === 0
        ) {

            lista.innerHTML = `

                <div
                    style="
                        grid-column:1/-1;
                        text-align:center;
                        padding:30px;
                    "
                >

                    <i
                        class="fas fa-shield-halved"
                        style="
                            font-size:40px;
                            color:#a0aec0;
                        "
                    ></i>

                    <p>
                        Nenhum EPI disponível
                        para esta empresa.
                    </p>

                </div>

            `;
            atualizarBonecoEPI();


            modal.classList.add("show");

            return;

        }



        /* EPIS */

        episDisponiveis.forEach(
            function(epi) {

                const id =
                    Number(epi.ID);


                const nome =
                    epi.NOME_EPI ||
                    epi.nome ||
                    "EPI";


                const selecionado =
                    episSelecionadosAtuais.some(
                        function(item) {

                            return (
                                Number(item.id) ===
                                id
                            );

                        }
                    );


                lista.innerHTML += `

                    <label
                        class="epi-option ${
                            selecionado
                                ? "selected"
                                : ""
                        }"
                    >


                        <div class="epi-icon">

                            <i
                                class="fas ${iconeEPI(nome)}"
                            ></i>

                        </div>


                        <div class="epi-option-info">

                            <strong>
                                ${escapeHTML(nome)}
                            </strong>

                            <small>
                                EPI obrigatório
                            </small>

                        </div>


                        <input
                            type="checkbox"
                            class="epi-check"
                            value="${id}"
                            ${
                                selecionado
                                    ? "checked"
                                    : ""
                            }
                            onchange="
                                alterarSelecaoEPI(
                                    ${id},
                                    this
                                )
                            "
                        >

                    </label>

                `;

            }
        );


        atualizarContadorEPIs();


        modal.classList.add("show");

    }



    /* =========================================================
       ALTERAR SELEÇÃO EPI
    ========================================================= */
function alterarSelecaoEPI(id, checkbox) {

    const epi = episDisponiveis.find(function(item) {

        return Number(item.ID) === Number(id);

    });

    if (!epi) return;


    const nome =
        epi.NOME_EPI ||
        epi.nome ||
        "EPI";


    if (checkbox.checked) {

        const jaExiste =
            episSelecionadosAtuais.some(function(item) {

                return Number(item.id) === Number(id);

            });


        if (!jaExiste) {

            episSelecionadosAtuais.push({

                id: Number(epi.ID),

                nome: nome

            });

        }

    } else {

        episSelecionadosAtuais =
            episSelecionadosAtuais.filter(function(item) {

                return Number(item.id) !== Number(id);

            });

    }


    /* CARD DO EPI */

    checkbox
        .closest(".epi-option")
        ?.classList.toggle(
            "selected",
            checkbox.checked
        );


    /* ATUALIZA O BONECO */

    atualizarBonecoEPI();


    /* ATUALIZA CONTADOR */

    atualizarContadorEPIs();

}
function atualizarBonecoEPI() {

    /* Remove o estado anterior */

    document
        .querySelectorAll(".epi-boneco")
        .forEach(function(epi) {

            epi.classList.remove("ativo");

        });


    /* Verifica cada EPI selecionado */

    episSelecionadosAtuais.forEach(function(epi) {

        const nome =
            String(epi.nome || "")
                .toLowerCase();


        /* CAPACETE */

        if (
            nome.includes("capacete") ||
            nome.includes("helmet")
        ) {

            document
                .querySelectorAll(".zona-capacete")
                .forEach(function(elemento) {

                    elemento.classList.add("ativo");

                });

        }


        /* ÓCULOS */

        if (
            nome.includes("óculos") ||
            nome.includes("oculos") ||
            nome.includes("proteção ocular")
        ) {

            document
                .querySelectorAll(".zona-oculos")
                .forEach(function(elemento) {

                    elemento.classList.add("ativo");

                });

        }


        /* MÁSCARA */

        if (
            nome.includes("máscara") ||
            nome.includes("mascara") ||
            nome.includes("respirador")
        ) {

            document
                .querySelectorAll(".zona-mascara")
                .forEach(function(elemento) {

                    elemento.classList.add("ativo");

                });

        }


        /* PROTETOR AURICULAR */

        if (
            nome.includes("auricular") ||
            nome.includes("ouvido")
        ) {

            document
                .querySelectorAll(".zona-auricular")
                .forEach(function(elemento) {

                    elemento.classList.add("ativo");

                });

        }


        /* COLETE */

        if (
            nome.includes("colete")
        ) {

            document
                .querySelectorAll(".zona-colete")
                .forEach(function(elemento) {

                    elemento.classList.add("ativo");

                });

        }


        /* CINTO */

        if (
            nome.includes("cinto") ||
            nome.includes("segurança")
        ) {

            document
                .querySelectorAll(".zona-cinto")
                .forEach(function(elemento) {

                    elemento.classList.add("ativo");

                });

        }


        /* LUVA */

        if (
            nome.includes("luva")
        ) {

            document
                .querySelectorAll(".zona-luva")
                .forEach(function(elemento) {

                    elemento.classList.add("ativo");

                });

        }


        /* BOTINA / BOTA */

        if (
            nome.includes("botina") ||
            nome.includes("bota") ||
            nome.includes("calçado") ||
            nome.includes("calcado")
        ) {

            document
                .querySelectorAll(".zona-calcado")
                .forEach(function(elemento) {

                    elemento.classList.add("ativo");

                });

        }

    });

}
    /* =========================================================
       CONTADOR EPI
    ========================================================= */

    function atualizarContadorEPIs() {

        const contador =
            document.getElementById(
                "contadorEPIs"
            );


        if (!contador) return;


        const quantidade =
            episSelecionadosAtuais.length;


        contador.textContent =
            quantidade === 1
                ? "1 EPI selecionado"
                : `${quantidade} EPIs selecionados`;

    }



    /* =========================================================
       CONFIRMAR EPIS
    ========================================================= */

    function confirmarEPIs() {

        const lista =
            document.getElementById(

                modoSelecaoEPI === "edicao"
                    ? "episSelecionadosEdicao"
                    : "episSelecionados"

            );


        const hidden =
            document.getElementById(

                modoSelecaoEPI === "edicao"
                    ? "episHiddenEdicao"
                    : "episHidden"

            );


        if (!lista || !hidden) return;


        if (
            episSelecionadosAtuais.length === 0
        ) {

            lista.innerHTML =
                "Nenhum EPI selecionado";


            hidden.value = "[]";

        } else {

            lista.innerHTML =
                episSelecionadosAtuais
                    .map(
                        function(epi) {

                            return `

                                <span class="epi-tag">

                                    <i
                                        class="fas ${iconeEPI(
                                            epi.nome
                                        )}"
                                    ></i>

                                    ${escapeHTML(
                                        epi.nome
                                    )}

                                </span>

                            `;

                        }
                    )
                    .join("");


            hidden.value =
                JSON.stringify(
                    episSelecionadosAtuais
                );

        }


        fecharModalEPI();

    }



    /* =========================================================
       FECHAR MODAL EPI
    ========================================================= */

    function fecharModalEPI() {

        document
            .getElementById("modalEPI")
            ?.classList.remove("show");

    }

</script>



<!-- =============================================================
     MODAL DE EPI
============================================================= -->

<div
    id="modalEPI"
    class="modal-overlay"
>

    <div class="modal-box modal-epi">


        <!-- HEADER -->

        <div class="modal-header">

            <div>

                <h2>

                    <i class="fas fa-shield-halved"></i>

                    Selecionar EPIs

                </h2>

                <p>

                    Selecione os EPIs obrigatórios
                    para este funcionário.

                </p>

            </div>


            <button
                type="button"
                class="modal-close"
                onclick="fecharModalEPI()"
            >

                <i class="fas fa-times"></i>

            </button>

        </div>



        <!-- LISTA -->

      <div class="epi-interativo">

    <!-- BONEQUINHO -->
   <div class="boneco-container">

    <div class="boneco">

        <!-- =========================
             CABEÇA
        ========================== -->

        <div class="boneco-cabeca">

            <!-- CAPACETE -->
            <div
                class="epi-boneco zona-capacete"
                data-zona="capacete"
            >
                <div class="capacete-cima"></div>
                <div class="capacete-aba"></div>
            </div>

            <!-- ÓCULOS -->
            <div
                class="epi-boneco zona-oculos"
                data-zona="oculos"
            >
                <div class="oculo esquerdo"></div>
                <div class="oculo direito"></div>
                <div class="ponte-oculos"></div>
            </div>

            <!-- ROSTO -->
            <div class="boneco-rosto">

                <div class="olho olho-esquerdo"></div>
                <div class="olho olho-direito"></div>

                <div class="boca"></div>

            </div>

            <!-- MÁSCARA -->
            <div
                class="epi-boneco zona-mascara"
                data-zona="mascara"
            >
                <div class="mascara-tecido"></div>
                <div class="mascara-alca esquerda"></div>
                <div class="mascara-alca direita"></div>
            </div>

            <!-- PROTETOR AURICULAR -->
            <div
                class="epi-boneco zona-auricular"
                data-zona="auricular"
            >
                <div class="fone esquerdo"></div>
                <div class="fone direito"></div>
                <div class="arco-fone"></div>
            </div>

        </div>


        <!-- PESCOÇO -->

        <div class="boneco-pescoco"></div>


        <!-- =========================
             UNIFORME
        ========================== -->

        <div class="boneco-uniforme">

            <div class="uniforme-logo">
                NEXA
            </div>

            <div class="uniforme-linha"></div>

        </div>


        <!-- =========================
             COLETE
        ========================== -->

        <div
            class="epi-boneco zona-colete"
            data-zona="colete"
        >

            <div class="colete-esquerdo"></div>
            <div class="colete-direito"></div>

            <div class="colete-faixa"></div>

        </div>


        <!-- =========================
             CINTO
        ========================== -->

        <div
            class="epi-boneco zona-cinto"
            data-zona="cinto"
        >
            <div class="cinto-faixa"></div>
            <div class="cinto-fivela"></div>
        </div>


        <!-- =========================
             BRAÇO ESQUERDO
        ========================== -->

        <div class="boneco-braco esquerdo">

            <div
                class="epi-boneco zona-luva"
                data-zona="luva"
            >
                <div class="luva-forma"></div>
            </div>

        </div>


        <!-- =========================
             BRAÇO DIREITO
        ========================== -->

        <div class="boneco-braco direito">

            <div
                class="epi-boneco zona-luva"
                data-zona="luva"
            >
                <div class="luva-forma"></div>
            </div>

        </div>


        <!-- =========================
             PERNAS
        ========================== -->

        <div class="boneco-perna esquerda"></div>

        <div class="boneco-perna direita"></div>


        <!-- =========================
             BOTINAS
        ========================== -->

        <div
            class="epi-boneco zona-calcado calcado-esquerdo"
            data-zona="calcado"
        >
            <div class="bota-forma"></div>
        </div>

        <div
            class="epi-boneco zona-calcado calcado-direito"
            data-zona="calcado"
        >
            <div class="bota-forma"></div>
        </div>

    </div>

</div>

    <!-- OPÇÕES DOS EPIs -->
    <div
        class="epis-opcoes-interativas"
        id="listaEPIsModal"
    >
    </div>

</div>



        <!-- FOOTER -->

        <div class="modal-footer">

            <span id="contadorEPIs">
                0 EPIs selecionados
            </span>


            <div>

                <button
                    type="button"
                    class="btn-modal-cancelar"
                    onclick="fecharModalEPI()"
                >

                    Cancelar

                </button>


                <button
                    type="button"
                    class="btn-modal-confirmar"
                    onclick="confirmarEPIs()"
                >

                    <i class="fas fa-check"></i>

                    Confirmar

                </button>

            </div>

        </div>

    </div>

</div>

<!-- =============================================================
     MODAL DE EDIÇÃO
============================================================= -->

<div
    id="modalEdicao"
    class="modal-overlay"
>

    <div class="modal-box modal-edicao">


        <!-- HEADER -->

        <div class="modal-header">

            <div>

                <h2>

                    <i class="fas fa-user-pen"></i>

                    Editar Funcionário

                </h2>

                <p>

                    Altere as informações
                    do funcionário.

                </p>

            </div>


            <button
                type="button"
                class="modal-close"
                onclick="fecharModalEdicao()"
            >

                <i class="fas fa-times"></i>

            </button>

        </div>



        <!-- FORMULÁRIO DE EDIÇÃO -->

        <form
            id="form-edicao"
            action="<?= base_url('/Cadastro_Fun/editar') ?>"
            method="post"
        >

            <?= csrf_field() ?>


            <input
                type="hidden"
                name="CPF_ORIGINAL"
                id="edit_cpf_original"
            >


            <div class="form-grid">


                <!-- NOME -->

                <div class="form-group">

                    <p class="p-card">
                        Nome completo
                    </p>

                    <div class="input-box">

                        <i class="fas fa-user"></i>

                        <input
                            type="text"
                            id="edit_nome"
                            name="NOME_COMPLETO"
                            
                        >

                    </div>

                </div>



                <!-- CPF -->

                <div class="form-group">

                    <p class="p-card">
                        CPF
                    </p>

                    <div class="input-box">

                        <i class="fas fa-id-card"></i>

                        <input
                            type="text"
                            id="edit_cpf"
                            disabled
                        >

                    </div>

                </div>



                <!-- NASCIMENTO -->

                <div class="form-group">

                    <p class="p-card">
                        Data de nascimento
                    </p>

                    <div class="input-box">

                        <i class="fas fa-calendar"></i>

                        <input
                            type="date"
                            id="edit_nascimento"
                            name="DATA_NASCIMENTO"
                            
                        >

                    </div>

                </div>



                <!-- EMAIL -->

                <div class="form-group">

                    <p class="p-card">
                        E-mail corporativo
                    </p>

                    <div class="input-box">

                        <i class="fas fa-envelope"></i>

                        <input
                            type="email"
                            id="edit_email"
                            name="EMAIL_CORPORATIVO"
                            
                        >

                    </div>

                </div>



                <!-- TELEFONE -->

                <div class="form-group">

                    <p class="p-card">
                        Telefone
                    </p>

                    <div class="input-box">

                        <i class="fas fa-phone"></i>

                        <input
                            type="text"
                            id="edit_telefone"
                            name="TELEFONE"
                            maxlength="15"
                            oninput="maskTel(this)"
                        >

                    </div>

                </div>



                <!-- RFID -->

                <div class="form-group">

                    <p class="p-card">
                        UID RFID
                    </p>

                    <div class="input-box">

                        <i class="fas fa-wave-square"></i>

                        <input
                            type="text"
                            id="edit_uid_rfid"
                            name="UID_RFID"
                        >

                    </div>

                </div>



                <!-- SETOR -->

                <div class="form-group">

                    <p class="p-card">
                        Setor
                    </p>

                    <div class="input-box select">

                        <i class="fas fa-building"></i>

                        <select
                            id="edit_setor"
                            name="FK_ID_SETOR"
                            
                        >

                            <option value="">
                                Selecione o setor
                            </option>


                            <?php foreach ($setores ?? [] as $s): ?>

                                <option
                                    value="<?= $s['ID'] ?>"
                                >

                                    <?= esc(
                                        $s['NOME']
                                    ) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                </div>



                <!-- SENHA -->

                <div class="form-group">

                    <p class="p-card">
                        Nova senha
                    </p>

                    <div class="input-box">

                        <i class="fas fa-lock"></i>

                        <input
                            type="password"
                            id="edit_senha"
                            name="SENHA"
                            minlength="6"
                            placeholder="Deixe vazio para manter a atual"
                        >

                    </div>

                    <div class="error-text"></div>

                </div>


                <!-- CONFIRMAR NOVA SENHA -->

                <div class="form-group">

                    <p class="p-card">
                        Confirmar nova senha
                    </p>

                    <div class="input-box">

                        <i class="fas fa-lock"></i>

                        <input
                            type="password"
                            id="edit_confirmSenha"
                            name="CONFIRMAR_SENHA"
                            minlength="6"
                            placeholder="Confirme a nova senha"
                        >

                    </div>

                    <div class="error-text"></div>

                </div>


                <!-- EPIS -->

                <div class="form-group full-width">

                    <p class="p-card">
                        EPIs obrigatórios
                    </p>

                    <div class="edit-epis-container" id="edit_epis_container">

                        <?php foreach ($epis ?? [] as $epi): ?>

                            <label class="edit-epi-checkbox">
                                <input
                                    type="checkbox"
                                    name="EPIS[]"
                                    value="<?= $epi['ID'] ?>"
                                    class="edit-epi"
                                >

                                <span class="edit-epi-checkmark">
                                    <i class="fas fa-check"></i>
                                </span>

                                <span class="edit-epi-name">
                                    <?= esc($epi['NOME_EPI']) ?>
                                </span>
                            </label>

                        <?php endforeach; ?>

                    </div>

                    <small>
                        Marque os EPIs obrigatórios para este funcionário.
                    </small>

                </div>

            </div>



            <!-- FOOTER -->

            <div class="modal-footer">


                <button
                    type="button"
                    class="btn-modal-cancelar"
                    onclick="fecharModalEdicao()"
                >

                    Cancelar

                </button>


                <button
                    type="submit"
                    class="btn-modal-confirmar"
                >

                    <i class="fas fa-save"></i>

                    Salvar Alterações

                </button>

            </div>

        </form>

    </div>

</div>



<!-- =============================================================
     JAVASCRIPT FINAL
============================================================= -->

<script>


    /* =========================================================
       ABRIR EDIÇÃO PELO CPF
    ========================================================= */

    function abrirModalEdicaoPorCPF(cpf) {

        const funcionario =
            funcionarios.find(
                function(fun) {

                    return String(fun.CPF) ===
                        String(cpf);

                }
            );


        if (!funcionario) {

            console.error(
                "Funcionário não encontrado:",
                cpf
            );

            return;

        }


        abrirModalEdicao(
            funcionario
        );

    }



    /* =========================================================
       ABRIR MODAL DE EDIÇÃO
    ========================================================= */

    function abrirModalEdicao(fun) {

        if (!fun) return;


        const cpfOriginal =
            document.getElementById(
                "edit_cpf_original"
            );


        const cpf =
            document.getElementById(
                "edit_cpf"
            );


        const nome =
            document.getElementById(
                "edit_nome"
            );


        const nascimento =
            document.getElementById(
                "edit_nascimento"
            );


        const email =
            document.getElementById(
                "edit_email"
            );


        const telefone =
            document.getElementById(
                "edit_telefone"
            );


        const uid =
            document.getElementById(
                "edit_uid_rfid"
            );


        const setor =
            document.getElementById(
                "edit_setor"
            );

        const senha =
            document.getElementById(
                "edit_senha"
            );

        const confirmarSenha =
            document.getElementById(
                "edit_confirmSenha"
            );

        const episCheckboxes =
            document.querySelectorAll(
                ".edit-epi"
            );


        if (cpfOriginal) {

            cpfOriginal.value =
                fun.CPF || "";

        }


        if (cpf) {

            cpf.value =
                fun.CPF || "";

        }


        if (nome) {

            nome.value =
                fun.NOME_COMPLETO || "";

        }


        if (nascimento) {

            nascimento.value =
                fun.DATA_NASCIMENTO || "";

        }


        if (email) {

            email.value =
                fun.EMAIL_CORPORATIVO || "";

        }


        if (telefone) {

            telefone.value =
                fun.TELEFONE || "";

        }


        if (uid) {

            uid.value =
                fun.UID_RFID || "";

        }


        if (setor) {

            setor.value =
                fun.FK_ID_SETOR || "";

        }



        if (senha) {
            senha.value = "";
        }

        if (confirmarSenha) {
            confirmarSenha.value = "";
        }

        /*
        =====================================================
        EPIS — CHECKBOXES
        =====================================================
        */

        if (episCheckboxes.length) {

            const idsSelecionados =
                Array.isArray(fun.EPIS)
                    ? fun.EPIS.map(function(epi) {

                        if (typeof epi === "object" && epi !== null) {
                            return String(
                                epi.ID ??
                                epi.id ??
                                epi.FK_EPI_ID ??
                                epi.FK_ID_EPI ??
                                ""
                            );
                        }

                        return String(epi);

                    }).filter(function(id) {
                        return id !== "";
                    })
                    : [];

            episCheckboxes.forEach(function(checkbox) {
                checkbox.checked =
                    idsSelecionados.includes(
                        String(checkbox.value)
                    );
            });
        }


        document
            .getElementById(
                "modalEdicao"
            )
            ?.classList.add("show");

    }



    /* =========================================================
       FECHAR EDIÇÃO
    ========================================================= */

    function fecharModalEdicao() {

        document
            .getElementById(
                "modalEdicao"
            )
            ?.classList.remove("show");

    }



    /* =========================================================
       RESETAR FORMULÁRIO
    ========================================================= */

    function resetarFormulario() {

        const form =
            document.getElementById(
                "form-fun"
            );


        if (form) {

            form.reset();

        }


        const cpfOriginal =
            document.getElementById(
                "cpf_original"
            );


        if (cpfOriginal) {

            cpfOriginal.value = "";

        }


        const btnCancelar =
            document.getElementById(
                "btn-cancelar"
            );


        if (btnCancelar) {

            btnCancelar.style.display =
                "none";

        }


        const btnSalvar =
            document.getElementById(
                "btn-salvar"
            );


        if (btnSalvar) {

            btnSalvar.innerHTML = `

                <i class="fas fa-user-plus"></i>

                Cadastrar Funcionário

            `;

        }


        episSelecionadosAtuais = [];


        const episSelecionados =
            document.getElementById(
                "episSelecionados"
            );


        if (episSelecionados) {

            episSelecionados.innerHTML =
                "Nenhum EPI selecionado";

        }


        const episHidden =
            document.getElementById(
                "episHidden"
            );


        if (episHidden) {

            episHidden.value = "[]";

        }

    }



    /* =========================================================
       VALIDAÇÃO E CONFIRMAÇÃO DO CADASTRO
    ========================================================= */

    function validarSenhasCadastro() {

        const senha =
            document.getElementById("senha");

        const confirmarSenha =
            document.getElementById("confirmSenha");

        if (!senha || !confirmarSenha) {
            return true;
        }

        if (senha.value.length < 6) {

            Swal.fire({
                icon: "warning",
                title: "Senha inválida",
                text: "A senha deve ter no mínimo 6 caracteres."
            });

            senha.focus();
            return false;
        }

        if (senha.value !== confirmarSenha.value) {

            Swal.fire({
                icon: "warning",
                title: "Senhas diferentes",
                text: "A senha e a confirmação de senha devem ser iguais."
            });

            confirmarSenha.focus();
            return false;
        }

        return true;
    }


    document.addEventListener(
        "DOMContentLoaded",
        function() {

            const formCadastro =
                document.getElementById("form-fun");

            const formEdicao =
                document.getElementById("form-edicao");


            if (formCadastro) {

                formCadastro.addEventListener(
                    "submit",
                    function(event) {

                        if (!validarSenhasCadastro()) {
                            event.preventDefault();
                            return;
                        }

                        event.preventDefault();

                        Swal.fire({
                            title: "Confirmar cadastro?",
                            text: "Deseja realmente cadastrar este funcionário?",
                            icon: "question",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Sim, cadastrar!",
                            cancelButtonText: "Cancelar"
                        }).then(function(result) {

                            if (result.isConfirmed) {
                                formCadastro.submit();
                            }

                        });

                    }
                );

            }


            if (formEdicao) {

                formEdicao.addEventListener(
                    "submit",
                    function(event) {

                        const senha =
                            document.getElementById("edit_senha");

                        const confirmarSenha =
                            document.getElementById("edit_confirmSenha");

                        if (
                            senha &&
                            confirmarSenha &&
                            senha.value !== ""
                        ) {

                            if (senha.value.length < 6) {

                                event.preventDefault();

                                Swal.fire({
                                    icon: "warning",
                                    title: "Senha inválida",
                                    text: "A nova senha deve ter no mínimo 6 caracteres."
                                });

                                senha.focus();
                                return;
                            }

                            if (senha.value !== confirmarSenha.value) {

                                event.preventDefault();

                                Swal.fire({
                                    icon: "warning",
                                    title: "Senhas diferentes",
                                    text: "A nova senha e a confirmação devem ser iguais."
                                });

                                confirmarSenha.focus();
                                return;
                            }

                        } else if (
                            confirmarSenha &&
                            confirmarSenha.value !== ""
                        ) {

                            event.preventDefault();

                            Swal.fire({
                                icon: "warning",
                                title: "Nova senha",
                                text: "Digite a nova senha ou deixe os dois campos vazios."
                            });

                            senha?.focus();
                            return;

                        }

                    }
                );

            }


            /* =====================================================
               ALERTAS DE RETORNO DO PHP
            ===================================================== */

            <?php if (session()->getFlashdata('sucesso')): ?>

                Swal.fire({
                    icon: "success",
                    title: "Sucesso!",
                    text: "<?= esc(session()->getFlashdata('sucesso')) ?>",
                    confirmButtonText: "OK"
                });

            <?php endif; ?>


            <?php if (session()->getFlashdata('erro')): ?>

                Swal.fire({
                    icon: "error",
                    title: "Não foi possível concluir",
                    html: "<?= esc(session()->getFlashdata('erro')) ?>",
                    confirmButtonText: "OK"
                });

            <?php endif; ?>

        }
    );


    /* =========================================================
       EXCLUSÃO
    ========================================================= */

    function confirmarExclusao(cpf) {

        if (
            typeof Swal === "undefined"
        ) {

            if (
                confirm(
                    "Tem certeza que deseja excluir este funcionário?"
                )
            ) {

                window.location.href =
                    `<?= base_url('/Cadastro_Fun/excluir/') ?>/${encodeURIComponent(cpf)}`;

            }

            return;

        }


        Swal.fire({

            title: "Tem certeza?",

            text:
                "Esta ação não poderá ser desfeita!",

            icon: "warning",

            showCancelButton: true,

            confirmButtonColor: "#d33",

            cancelButtonColor: "#3085d6",

            confirmButtonText:
                "Sim, excluir!",

            cancelButtonText:
                "Cancelar"

        }).then(
            function(result) {

                if (
                    result.isConfirmed
                ) {

                    window.location.href =
                        `<?= base_url('/Cadastro_Fun/excluir/') ?>/${encodeURIComponent(cpf)}`;

                }

            }
        );

    }



    /* =========================================================
       FECHAR MODAIS CLICANDO FORA
    ========================================================= */

    document.addEventListener(
        "click",
        function(event) {


            const modalEPI =
                document.getElementById(
                    "modalEPI"
                );


            const modalEdicao =
                document.getElementById(
                    "modalEdicao"
                );


            if (
                event.target === modalEPI
            ) {

                fecharModalEPI();

            }


            if (
                event.target === modalEdicao
            ) {

                fecharModalEdicao();

            }

        }
    );



    /* =========================================================
       ESC FECHA MODAIS
    ========================================================= */

    document.addEventListener(
        "keydown",
        function(event) {

            if (
                event.key !== "Escape"
            ) {

                return;

            }


            fecharModalEPI();

            fecharModalEdicao();

        }
    );



</script>


</body>

</html>