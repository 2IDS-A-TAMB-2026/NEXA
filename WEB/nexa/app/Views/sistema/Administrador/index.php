<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Perfil do administrador | NEXA</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!--<link rel="stylesheet" href="assets/css/acessibilidade_adm.css">
    <link rel="stylesheet" href="assets/css/style_geral.css">

     Mantidos -->
    <!--<link rel="stylesheet" href="assets/css/cadastro_camera.css">
    <link rel="stylesheet" href="assets/css/perfil_admin.css">-->
    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade_adm.css') ?>">
    
    <link rel="stylesheet" href="<?= base_url('assets/css/style_geral.css') ?>">

    <!-- Mantidos -->
    <link rel="stylesheet" href="<?= base_url('assets/css/cadastro_camera.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/perfil_admin.css') ?>">

<!--mudar icone?-->
    

</head>


<body class="has-bg-image">


    <!-- =========================================================
         VLIBRAS
    ========================================================== -->

    <div vw class="enabled">

        <div vw-access-button class="active"></div>

        <div vw-plugin-wrapper>

            <div class="vw-plugin-top-wrapper"></div>

        </div>

    </div>


    <!-- =========================================================
         ASIDE — MANTIDO DO SEGUNDO CÓDIGO
    ========================================================== -->

    <aside class="sidebar">


        <img
            class="sidebar-construction"
            src="<?= base_url('assets/images/construcao.jpg') ?>"
            alt=""
        >


        <div class="sidebar-content">


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


                <a
                    href="<?= base_url('/ocorrencia') ?>"
                >

                    <i class="fas fa-exclamation-triangle"></i>

                    <span>
                        Ocorrências
                    </span>

                </a>


                <div class="menu-title">
                    CADASTROS
                </div>


                <a href="<?= base_url('/cadastro-funcionario') ?>">

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


                <a href="<?= base_url('/administrador') ?>" class="active">

                    <i class="fas fa-user"></i>

                    <span>
                        Perfil
                    </span>

                </a>


            </nav>


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
         CONTEÚDO
    ========================================================== -->

    <div class="overlay">

    


        <!-- =====================================================
             HEADER — MANTIDO
        ====================================================== -->

        <header class="dashboard-header">

    <!-- LADO ESQUERDO -->
    <div class="header-left">

        <div class="header-title">

            <h1>
                Perfil do administrador
            </h1>

            <p>
                Visualize seus dados
            </p>

        </div>

    </div>

<!-- LADO DIREITO -->
<div class="header-right">

    <!-- MENU DE ACESSIBILIDADE -->
    <div class="access-menu">

        <button
            type="button"
            class="gear-btn"
            onclick="toggleAccessMenu()"
            title="Opções de Acessibilidade"
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
                onclick="Acessibilidade.toggleContraste()"
                title="Alto Contraste"
            >
                <i class="fas fa-adjust"></i>
            </button>

            <button
                type="button"
                class="access-btn"
                onclick="toggleDark()"
                title="Modo Escuro"
            >
                <i class="fas fa-moon"></i>
            </button>

            <button
                type="button"
                class="access-btn"
                onclick="Acessibilidade.aumentarFonte()"
                title="Aumentar Fonte"
            >
                A+
            </button>

            <button
                type="button"
                class="access-btn"
                onclick="Acessibilidade.diminuirFonte()"
                title="Diminuir Fonte"
            >
                A-
            </button>

            <button
                type="button"
                class="access-btn"
                onclick="Acessibilidade.lerPagina()"
                title="Ler Página"
            >
                <i class="fas fa-volume-up"></i>
            </button>

        </div>

    </div>

    <!-- NOME DA EMPRESA -->
    <p class="nome-empresa">
        NEXA SOLUÇÕES
    </p>

</div>
     


</header>


        <!-- =====================================================
             CARD DO PERFIL
        ====================================================== -->

        <div class="card">


            <!-- =================================================
                 CABEÇALHO DO CARD
            ================================================== -->

            <div class="perfil-header">


                <div class="perfil-esquerda">


                    <div class="avatar">

                        <?= strtoupper(
                            substr(
                                $administrador['NOME_COMPLETO'] ?? 'A',
                                0,
                                1
                            )
                        ) ?>

                    </div>


                    <div class="perfil-info">

                        <h1>
                            Perfil do administrador
                        </h1>

                        <p>
                            Visualize e gerencie suas informações pessoais
                        </p>

                        <span class="linha"></span>

                    </div>


                </div>


                <div class="perfil-direita">

    <img
        id="imagemSeguranca"
        src="<?= base_url('assets/images/capacete_perfil.png') ?>"
        alt="Segurança com capacete"
        class="imagem-seguranca"
    >

</div>
</div>


            <!-- =================================================
                 FORMULÁRIO
            ================================================== -->

            <form
                id="editar-perfil"
                method="post"
                action="<?= base_url('/administrador/atualizar/' . session()->get('cpf')) ?>"
            >


                <!-- =================================================
                     INFORMAÇÕES PESSOAIS
                ================================================== -->

                <div class="subtitle">

                    <i class="fa-regular fa-user"></i>

                    Informações pessoais

                </div>


                <!-- =================================================
                     VISUALIZAÇÃO
                ================================================== -->

                <div
                    id="formulario-demonstracao"
                    class="form-grid"
                >


                    <div
                        id="clique-editar"
                        class="full"
                    >
                        Clique em "<b>Editar dados</b>"
                        se quiser alterar as informações abaixo.
                    </div>


                    <div class="input-box full">

                        <i class="fas fa-user"></i>

                        <input
                            disabled
                            id="NOME_COMPLETO"
                            type="text"
                            value="<?= $administrador['NOME_COMPLETO'] ?>"
                        >

                    </div>


                    <div class="input-box">

                        <i class="fas fa-envelope"></i>

                        <input
                            disabled
                            type="email"
                            value="<?= $administrador['EMAIL_CORPORATIVO'] ?>"
                        >

                    </div>


                    <div class="input-box">

                        <i class="fas fa-phone"></i>

                        <input
                            disabled
                            type="text"
                            value="<?= $administrador['TELEFONE'] ?>"
                        >

                    </div>


                    <div class="input-box">

                        <i class="fas fa-address-card"></i>

                        <input
                            disabled
                            type="text"
                            value="<?= session()->get('cpf') ?? '000.000.000-00' ?>"
                        >

                    </div>


                    <div class="input-box">

                        <i class="fas fa-calendar"></i>

                        <input
                            disabled
                            type="date"
                            value="<?= session()->get('data_nascimento') ?? '2001-09-11' ?>"
                        >

                    </div>


                </div>


                <!-- =================================================
                     FORMULÁRIO FUNCIONAL
                ================================================== -->

                <div
                    id="formulario-funcional"
                    class="form-grid"
                >


                    <div
                        id="atencao"
                        class="full"
                    >

                        <b>ATENÇÃO:</b>
                        você está alterando os dados do seu perfil.

                    </div>


                    <div class="input-box full">

                        <i class="fas fa-user"></i>

                        <input
                            id="NOME_COMPLETO_FUNC"
                            name="NOME_COMPLETO"
                            type="text"
                            value="<?= $administrador['NOME_COMPLETO'] ?>"
                        >

                    </div>


                    <div class="input-box">

                        <i class="fas fa-envelope"></i>

                        <input
                            id="EMAIL_CORPORATIVO_FUNC"
                            name="EMAIL_CORPORATIVO"
                            type="email"
                            value="<?= $administrador['EMAIL_CORPORATIVO'] ?>"
                        >

                    </div>


                    <div class="input-box">

                        <i class="fas fa-phone"></i>

                      <input
    id="TELEFONE_FUNC"
    name="TELEFONE"
    type="text"
    value="<?= esc($administrador['TELEFONE'] ?? '') ?>"
    maxlength="15"
    inputmode="numeric"
    placeholder="(00) 00000-0000"
>

                    </div>


                    <div class="input-box">

                        <i class="fas fa-address-card"></i>

                        <input
                            disabled
                            type="text"
                            value="<?= session()->get('cpf') ?? '000.000.000-00' ?>"
                        >

                    </div>


                    <div class="input-box">

                        <i class="fas fa-calendar"></i>

                        <input
                            disabled
                            type="date"
                            value="<?= session()->get('data_nascimento') ?? '2001-09-11' ?>"
                        >

                    </div>


                    <!-- =================================================
                         SEGURANÇA
                    ================================================== -->

                    <div class="subtitle full">

                        <i class="fas fa-lock"></i>

                        Segurança

                    </div>


                    <div
                        class="input-box full"
                        id="senhaBox"
                        style="display:none;"
                    >

                        <i class="fas fa-lock"></i>

                        <input
                            id="SENHA"
                            name="SENHA"
                            type="password"
                            placeholder="Digite a nova senha"
                        >

                    </div>


                    <div
                        class="input-box full"
                        id="confirmarSenhaBox"
                        style="display:none;"
                    >

                        <i class="fas fa-lock"></i>

                        <input
                            name="CONFIRMAR_SENHA"
                            id="CONFIRMAR_SENHA"
                            type="password"
                            placeholder="Confirme a nova senha"
                        >

                    </div>


                    <span
                        id="mudar-senha"
                        class="full"
                    >
                        Preencha os campos de senha somente se quiser
                        alterá-la.
                    </span>


                </div>


                <!-- =================================================
                     BOTÕES
                ================================================== -->

                <div id="botoes-edicao">


                    <button
                        type="button"
                        id="botao_editar"
                        onclick="editar()"
                        class="btn"
                    >

                        <i class="fas fa-edit"></i>

                        <span class="label">
                            Editar dados
                        </span>

                    </button>


                    <div
                        id="grupo-acoes"
                        style="display:none;"
                    >


                        <button
                            type="button"
                            class="btn"
                            onclick="cancelarEdicao()"
                        >

                            <i class="fas fa-xmark"></i>

                            <span class="label">
                                Cancelar
                            </span>

                        </button>


                        <button
                            id="botao_salvar"
                            class="btn salvar"
                            type="submit"
                        >

                            <i class="fas fa-save"></i>

                            <span class="label">
                                Salvar alterações
                            </span>

                        </button>


                    </div>


                </div>


            </form>


        </div>

    </div>


    <!-- =========================================================
         SCRIPTS
    ========================================================== -->

    <!--<script src="assets/js/acessibilidade.js"></script>-->
    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>


    <!-- VLibras -->

    <script src="<?= base_url('https://vlibras.gov.br/app/vlibras-plugin.js')?>"></script>

    <script>
        new window.VLibras.Widget(
            'https://vlibras.gov.br/app'
        );
    </script>

<script>

/* =========================================================
   ELEMENTOS
========================================================= */

const mudarSenha =
    document.getElementById('mudar-senha');

const atencao =
    document.getElementById('atencao');

const senhaIPT =
    document.getElementById('SENHA');

const btnEditar =
    document.getElementById('botao_editar');

const btnSalvar =
    document.getElementById('botao_salvar');

const senhaBox =
    document.getElementById('senhaBox');

const confirmarSenhaBox =
    document.getElementById('confirmarSenhaBox');

const clique_editar =
    document.getElementById('clique-editar');

const telefoneInput =
    document.getElementById('TELEFONE_FUNC');


/* =========================================================
   MÁSCARA DE TELEFONE
   Aceita:
   (11) 99999-9999
   (11) 9999-9999
========================================================= */

if (telefoneInput) {

    telefoneInput.addEventListener('input', function () {

        let valor = this.value.replace(/\D/g, '');

        // Máximo de 11 números
        valor = valor.substring(0, 11);

        if (valor.length <= 10) {

            // Telefone fixo
            valor = valor.replace(
                /^(\d{2})(\d{4})(\d{0,4})$/,
                '($1) $2-$3'
            );

        } else {

            // Celular
            valor = valor.replace(
                /^(\d{2})(\d{5})(\d{0,4})$/,
                '($1) $2-$3'
            );
        }

        this.value = valor;

    });

}


/* =========================================================
   SUBMIT DO FORMULÁRIO
========================================================= */

document
    .getElementById('editar-perfil')
    .addEventListener('submit', function(event) {

        event.preventDefault();

        const senha =
            document.getElementById('SENHA').value;

        const confirmar =
            document.getElementById('CONFIRMAR_SENHA').value;

        const telefone =
            document.getElementById('TELEFONE_FUNC').value;

        const telefoneNumeros =
            telefone.replace(/\D/g, '');


        /* -------------------------------------------------
           VALIDAÇÃO DO TELEFONE
        ------------------------------------------------- */

        if (
            telefoneNumeros.length !== 10 &&
            telefoneNumeros.length !== 11
        ) {

            Swal.fire({

                icon: 'error',

                title: 'Telefone inválido',

                text:
                    'Digite um telefone válido com DDD.',

                confirmButtonColor:
                    '#0a66c2',

                confirmButtonText:
                    'Entendi'

            });

            return;
        }


        /* -------------------------------------------------
           VALIDAÇÃO DAS SENHAS
        ------------------------------------------------- */

        if (
            senha !== '' &&
            senha !== confirmar
        ) {

            Swal.fire({

                icon: 'error',

                title: 'Erro',

                text:
                    'As senhas não coincidem.',

                confirmButtonColor:
                    '#0a66c2',

                confirmButtonText:
                    'Entendi'

            });

            return;
        }


        /* -------------------------------------------------
           CONFIRMAÇÃO
        ------------------------------------------------- */

        Swal.fire({

            title:
                'Confirmar alterações?',

            text:
                'Deseja realmente salvar as alterações do seu perfil?',

            icon:
                'warning',

            showCancelButton:
                true,

            confirmButtonText:
                'Sim, salvar',

            cancelButtonText:
                'Cancelar',

            confirmButtonColor:
                '#0a66c2',

            cancelButtonColor:
                '#6c757d'

        }).then((result) => {

            if (result.isConfirmed) {

                this.submit();

            }

        });

    });


/* =========================================================
   EDITAR PERFIL
========================================================= */

function editar() {

    document
        .getElementById('formulario-demonstracao')
        .style.display = 'none';


    document
        .getElementById('formulario-funcional')
        .style.display = 'grid';


    document
        .getElementById('grupo-acoes')
        .style.display = 'flex';


    document
        .getElementById('atencao')
        .style.display = 'block';


    document
        .getElementById('clique-editar')
        .style.display = 'none';


    document
        .getElementById('mudar-senha')
        .style.display = 'block';


    document
        .getElementById('senhaBox')
        .style.display = 'flex';


    document
        .getElementById('confirmarSenhaBox')
        .style.display = 'flex';


    btnEditar.style.display = 'none';

    btnSalvar.style.display = 'flex';


    // Coloca o cursor no nome
    document
        .getElementById('NOME_COMPLETO_FUNC')
        .focus();

}


/* =========================================================
   IMAGEM DO PERFIL
   CLARO / ESCURO / ALTO CONTRASTE
========================================================= */

function atualizarImagemPerfil() {

    const imagem =
        document.getElementById('imagemSeguranca');

    if (!imagem) {
        return;
    }

    const modoEscuro =
        document.body.classList.contains('dark-mode');

    const altoContraste =
        document.body.classList.contains('alto-contraste');

    const imagemClara =
        "<?= base_url('assets/images/capacete_perfil.png') ?>";

    const imagemEscura =
        "<?= base_url('assets/images/capacete_perfil_escuro.png') ?>";


    if (modoEscuro || altoContraste) {

        imagem.src = imagemEscura;

    } else {

        imagem.src = imagemClara;

    }

}


/* =========================================================
   CARREGAR IMAGEM AO ABRIR A PÁGINA
========================================================= */

document.addEventListener(
    'DOMContentLoaded',
    function () {

        atualizarImagemPerfil();

    }
);


/* =========================================================
   DETECTAR MUDANÇA DE TEMA
========================================================= */

const observadorModo =
    new MutationObserver(function () {

        atualizarImagemPerfil();

    });


observadorModo.observe(
    document.body,
    {
        attributes: true,
        attributeFilter: ['class']
    }
);


/* =========================================================
   CANCELAR EDIÇÃO
========================================================= */

function cancelarEdicao() {

    Swal.fire({

        title:
            'Cancelar edição?',

        text:
            'As alterações realizadas serão descartadas.',

        icon:
            'question',

        showCancelButton:
            true,

        confirmButtonText:
            'Sim, cancelar',

        cancelButtonText:
            'Continuar editando',

        confirmButtonColor:
            '#d33',

        cancelButtonColor:
            '#0a66c2'

    }).then((result) => {

        if (result.isConfirmed) {

            location.reload();

        }

    });

}


    </script>

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