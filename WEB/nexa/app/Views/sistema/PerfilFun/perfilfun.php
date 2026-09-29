<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NEXA | Perfil</title>


    <!-- FONT AWESOME -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >


    <!-- CSS -->

    <link
        rel="stylesheet"
        href="<?= base_url('/assets/css/acessibilidade_fun.css') ?>"
    >

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/style_funci.css') ?>"
    >

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/perfil_fun.css') ?>"
    >


    <!-- SWEET ALERT -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>


<body>


<?php

/*
|--------------------------------------------------------------------------
| MENSAGENS VINDAS DO CONTROLLER
|--------------------------------------------------------------------------
*/

$mensagemErro =
    session()->getFlashdata('erro');

$mensagemSucesso =
    session()->getFlashdata('sucesso');


/*
|--------------------------------------------------------------------------
| ERROS DE SENHA
|--------------------------------------------------------------------------
*/

$erroSenhaAtual = '';

$erroNovaSenha = '';

$erroConfirmarSenha = '';

$erroGeral = '';


/*
|--------------------------------------------------------------------------
| IDENTIFICA O TIPO DO ERRO
|--------------------------------------------------------------------------
*/

if (!empty($mensagemErro)) {

    $mensagemErroLower =
        strtolower($mensagemErro);


    if (
        str_contains(
            $mensagemErroLower,
            'senha atual'
        )
    ) {

        $erroSenhaAtual =
            $mensagemErro;

    }

    elseif (
        str_contains(
            $mensagemErroLower,
            'nova senha'
        )
    ) {

        $erroNovaSenha =
            $mensagemErro;

    }

    elseif (
        str_contains(
            $mensagemErroLower,
            'senhas não coincidem'
        )
        ||
        str_contains(
            $mensagemErroLower,
            'confirmação'
        )
    ) {

        $erroConfirmarSenha =
            $mensagemErro;

    }

    else {

        $erroGeral =
            $mensagemErro;

    }

}

?>


<!-- =========================================================
     ERRO GERAL
========================================================= -->

<?php if (!empty($erroGeral)): ?>

<script>

document.addEventListener(
    'DOMContentLoaded',
    function ()
    {

        Swal.fire({

            icon: 'error',

            title: 'Não foi possível atualizar',

            text: <?= json_encode($erroGeral) ?>,

            confirmButtonColor: '#0a66c2',

            confirmButtonText: 'Continuar'

        });

    }
);

</script>

<?php endif; ?>


<!-- =========================================================
     SUCESSO
========================================================= -->

<?php if (!empty($mensagemSucesso)): ?>

<script>

document.addEventListener(
    'DOMContentLoaded',
    function ()
    {

        Swal.fire({

            icon: 'success',

            title: 'Sucesso!',

            text: <?= json_encode($mensagemSucesso) ?>,

            confirmButtonColor: '#0a66c2',

            confirmButtonText: 'Continuar'

        });

    }
);

</script>

<?php endif; ?>


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

                <strong>
                    NEXA
                </strong>

                <span>
                    Segurança é prioridade
                </span>

            </div>

        </div>


        <!-- =====================================================
             MENU
        ===================================================== -->

        <nav class="menu">


            <!-- PRINCIPAL -->

            <div class="menu-title">
                PRINCIPAL
            </div>


            <!-- DASHBOARD -->

            <a href="<?= base_url('/dashboardfun') ?>">

                <i class="fas fa-chart-line"></i>

                <span>
                    Dashboard
                </span>

            </a>


            <!-- ANÁLISE DE EPI -->

            <a href="<?= base_url('/camera_analise') ?>">

                <i class="fas fa-video"></i>

                <span>
                    Análise de EPI
                </span>

            </a>


            <!-- CONTA -->

            <div class="menu-title">
                CONTA
            </div>


            <!-- PERFIL -->

            <a
                href="<?= base_url('/perfilfun') ?>"
                class="active"
            >

                <i class="fas fa-user"></i>

                <span>
                    Perfil
                </span>

            </a>


        </nav>


        <!-- =====================================================
             SAIR
        ===================================================== -->

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
     OVERLAY
========================================================= -->

<div class="overlay">


    <div
        class="main"
        style="
            display:flex;
            flex-direction:column;
            width:100%;
            box-sizing:border-box;
            padding:20px;
        "
    >


        <!-- =====================================================
             HEADER
        ===================================================== -->

        <header class="dashboard-header">


            <!-- LADO ESQUERDO -->

            <div class="header-left">

                <div class="header-title">

                    <h1>
                        Perfil do Funcionário
                    </h1>

                    <p>
                        Visualize seus dados
                    </p>

                </div>

            </div>


            <!-- LADO DIREITO -->

            <div class="header-right">


                <!-- =================================================
                     ACESSIBILIDADE
                ================================================= -->

                <div class="access-menu">


                    <!-- ENGRENAGEM -->

                    <button
                        type="button"
                        class="gear-btn"
                        onclick="toggleAccessMenu()"
                        title="Opções de Acessibilidade"
                    >

                        <i class="fas fa-cog"></i>

                    </button>


                    <!-- OPÇÕES -->

                    <div
                        class="access-options"
                        id="accessOptions"
                    >


                        <!-- ALTO CONTRASTE -->

                        <button
                            type="button"
                            class="access-btn"
                            onclick="Acessibilidade.toggleContraste()"
                            title="Alto Contraste"
                        >

                            <i class="fas fa-adjust"></i>

                        </button>


                        <!-- MODO ESCURO -->

                        <button
                            type="button"
                            class="access-btn"
                            onclick="toggleDark()"
                            title="Modo Escuro"
                        >

                            <i class="fas fa-moon"></i>

                        </button>


                        <!-- AUMENTAR FONTE -->

                        <button
                            type="button"
                            class="access-btn"
                            onclick="Acessibilidade.aumentarFonte()"
                            title="Aumentar Fonte"
                        >

                            A+

                        </button>


                        <!-- DIMINUIR FONTE -->

                        <button
                            type="button"
                            class="access-btn"
                            onclick="Acessibilidade.diminuirFonte()"
                            title="Diminuir Fonte"
                        >

                            A-

                        </button>


                        <!-- LER PÁGINA -->

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


                <!-- EMPRESA -->

                <p class="nome-empresa">
                    NEXA SOLUÇÕES
                </p>


            </div>

        </header>


        <!-- =====================================================
             FORMULÁRIO
        ===================================================== -->

        <form
            action="<?= base_url('perfilfun/atualizar') ?>"
            method="post"
            id="formPerfil"
        >

            <?= csrf_field() ?>


            <!-- =================================================
                 CARD
            ================================================= -->

            <div class="card">


                <!-- =================================================
                     CABEÇALHO
                ================================================= -->

                <div class="perfil-header">


                    <!-- ESQUERDA -->

                    <div class="perfil-esquerda">


                        <!-- AVATAR -->

                        <div class="avatar">

                            <?= strtoupper(

                                substr(

                                    $funcionario['NOME_COMPLETO']

                                    ?? session()->get('nome_fun')

                                    ?? 'F',

                                    0,

                                    1

                                )

                            ); ?>

                        </div>


                        <!-- TEXTO -->

                        <div class="perfil-info">

                            <h1>
                                Perfil do Funcionário
                            </h1>

                            <p>
                                Visualize e gerencie suas informações pessoais
                            </p>

                            <span class="linha"></span>

                        </div>


                    </div>


                    <!-- DIREITA -->

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
                     INFORMAÇÕES PESSOAIS
                ================================================= -->

                <div class="subtitle">

                    <i class="fa-regular fa-user"></i>

                    Informações pessoais

                </div>


                <div class="form-grid">


                    <!-- =================================================
                         NOME
                    ================================================= -->

                    <div class="input-box full">

                        <i class="fas fa-user"></i>

                        <input
                            id="nome"
                            name="nome"
                            type="text"
                            value="<?= esc(

                                old('nome')

                                ?? $funcionario['NOME_COMPLETO']

                                ?? session()->get('nome_fun')

                                ?? ''

                            ) ?>"
                            maxlength="120"
                            oninput="somenteLetras(this)"
                            disabled
                        >

                    </div>


                    <!-- =================================================
                         E-MAIL
                    ================================================= -->

                    <div class="input-box">

                        <i class="fas fa-envelope"></i>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="<?= esc(

                                old('email')

                                ?? $funcionario['EMAIL_CORPORATIVO']

                                ?? session()->get('email_fun')

                                ?? ''

                            ) ?>"
                            maxlength="120"
                            disabled
                        >

                    </div>


                    <!-- =================================================
                         TELEFONE
                    ================================================= -->

                    <div
                        class="input-box"
                        id="telefoneBox"
                    >

                        <i class="fas fa-phone"></i>

                        <input
                            id="telefone"
                            name="telefone"
                            type="text"
                            value="<?= esc(

                                old('telefone')

                                ?? $funcionario['TELEFONE']

                                ?? ''

                            ) ?>"
                            placeholder="(00) 00000-0000"
                            maxlength="15"
                            oninput="mascaraTelefone(this)"
                            disabled
                        >

                    </div>


                    <!-- =================================================
                         DATA NASCIMENTO
                    ================================================= -->

                    <div class="input-box">

                        <i class="fas fa-calendar"></i>

                        <input
                            type="text"
                            value="<?= isset(

                                $funcionario['DATA_NASCIMENTO']

                            )

                                ? date(

                                    'd/m/Y',

                                    strtotime(

                                        $funcionario['DATA_NASCIMENTO']

                                    )

                                )

                                : '' ?>"
                            disabled
                        >

                    </div>


                    <!-- =================================================
                         RFID
                    ================================================= -->

                    <div class="input-box">

                        <i class="fas fa-id-badge"></i>

                        <input
                            type="text"
                            value="<?= esc(

                                $funcionario['UID_RFID']

                                ?? ''

                            ) ?>"
                            disabled
                        >

                    </div>


                    <!-- =================================================
                         EPIs
                    ================================================= -->

                    <div class="full">


                        <div class="subtitle">

                            <i class="fas fa-shield-alt"></i>

                            EPIs Obrigatórios

                        </div>


                        <?php if (!empty($epis)): ?>


                            <?php foreach ($epis as $epi): ?>


                                <div
                                    class="input-box"
                                    style="
                                        margin-bottom:10px;
                                        gap:15px;
                                    "
                                >


                                    <img
                                        src="<?= base_url(

                                            'uploads/epis/'

                                            . $epi['IMAGEM_EPI']

                                        ) ?>"
                                        alt="<?= esc(

                                            $epi['NOME_EPI']

                                        ) ?>"
                                        style="
                                            width:60px;
                                            height:60px;
                                            object-fit:cover;
                                            border-radius:10px;
                                            border:1px solid #ddd;
                                        "
                                    >


                                    <div>

                                        <strong>

                                            <?= esc(

                                                $epi['NOME_EPI']

                                            ) ?>

                                        </strong>

                                        <br>

                                        <small>

                                            <?= esc(

                                                $epi['DESCRICAO_EPI']

                                                ?? ''

                                            ) ?>

                                        </small>

                                    </div>


                                </div>


                            <?php endforeach; ?>


                        <?php else: ?>


                            <div class="input-box">

                                <i class="fas fa-hard-hat"></i>

                                <span>

                                    Nenhum EPI obrigatório cadastrado.

                                </span>

                            </div>


                        <?php endif; ?>


                    </div>


                </div>


                <!-- =================================================
                     SEGURANÇA
                ================================================= -->

                <div class="subtitle">

                    <i class="fas fa-lock"></i>

                    Segurança

                </div>


                <div class="seguranca-box">


                    <!-- =================================================
                         SENHA ATUAL
                    ================================================= -->

                    <div
                        class="input-box full input-group <?= !empty($erroSenhaAtual) ? 'error' : '' ?>"
                        id="senhaAtualBox"
                    >


                        <div
                            style="
                                display:flex;
                                align-items:center;
                                width:100%;
                            "
                        >

                            <i class="fas fa-lock"></i>


                            <div class="campo">

                                <label>
                                    Senha atual
                                </label>


                                <input
                                    id="senhaAtual"
                                    name="senhaAtual"
                                    type="password"
                                    placeholder="Digite sua senha atual"
                                    disabled
                                >


                            </div>


                        </div>


                        <!-- ERRO APARECE AQUI -->

                        <div
                            class="error-text"
                            id="erroAtual"
                        >

                            <?= esc($erroSenhaAtual) ?>

                        </div>


                    </div>


                    <!-- =================================================
                         NOVA SENHA
                    ================================================= -->

                    <div
                        class="input-box input-group <?= !empty($erroNovaSenha) ? 'error' : '' ?>"
                        id="novaSenhaBox"
                        style="display:none;"
                    >


                        <div
                            style="
                                display:flex;
                                align-items:center;
                                width:100%;
                            "
                        >

                            <i class="fas fa-key"></i>


                            <div class="campo">

                                <label>
                                    Nova senha
                                </label>


                                <input
                                    id="novaSenha"
                                    name="novaSenha"
                                    type="password"
                                    minlength="6"
                                    maxlength="100"
                                    placeholder="Mínimo 6 caracteres"
                                >


                            </div>


                        </div>


                        <div
                            class="error-text"
                            id="erroNova"
                        >

                            <?= esc($erroNovaSenha) ?>

                        </div>


                    </div>


                    <!-- =================================================
                         CONFIRMAR SENHA
                    ================================================= -->

                    <div
                        class="input-box input-group <?= !empty($erroConfirmarSenha) ? 'error' : '' ?>"
                        id="confirmarSenhaBox"
                        style="display:none;"
                    >


                        <div
                            style="
                                display:flex;
                                align-items:center;
                                width:100%;
                            "
                        >

                            <i class="fas fa-key"></i>


                            <div class="campo">

                                <label>
                                    Confirmar senha
                                </label>


                                <input
                                    id="confirmarSenha"
                                    name="confirmarSenha"
                                    type="password"
                                    minlength="6"
                                    maxlength="100"
                                    placeholder="Digite novamente"
                                >


                            </div>


                        </div>


                        <div
                            class="error-text"
                            id="erroConfirmar"
                        >

                            <?= esc($erroConfirmarSenha) ?>

                        </div>


                    </div>


                </div>


                <!-- =================================================
                     BOTÕES
                ================================================= -->

                <button
                    type="button"
                    class="btn editar"
                    onclick="editar()"
                >

                    <i class="fas fa-edit"></i>

                    Editar Campos

                </button>


                <button
                    type="button"
                    class="btn salvar"
                    onclick="salvar()"
                    style="display:none;"
                >

                    <i class="fas fa-save"></i>

                    Salvar Alterações

                </button>


            </div>


        </form>


    </div>


</div>


<!-- =========================================================
     VLIBRAS
========================================================= -->

<div
    vw
    class="enabled"
>

    <div
        vw-access-button
        class="active"
    ></div>


    <div vw-plugin-wrapper>

        <div class="vw-plugin-top-wrapper"></div>

    </div>

</div>


<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>


<script>

new window.VLibras.Widget(
    'https://vlibras.gov.br/app'
);


/* =========================================================
   MENU DE ACESSIBILIDADE
========================================================= */

function toggleAccessMenu()
{

    const menu =
        document.getElementById(
            "accessOptions"
        );


    if (menu) {

        menu.classList.toggle(
            "active"
        );

    }

}


/* =========================================================
   MODO ESCURO
========================================================= */

function toggleDark()
{

    document.body.classList.toggle(
        "dark"
    );

    document.body.classList.toggle(
        "dark-mode"
    );

    document.documentElement.classList.toggle(
        "dark"
    );


    atualizarImagemPerfil();

}


/* =========================================================
   SOMENTE LETRAS NO NOME
========================================================= */

function somenteLetras(input)
{

    /*
    |--------------------------------------------------------------------------
    | Permite letras, espaços e acentos.
    |--------------------------------------------------------------------------
    */

    input.value =
        input.value.replace(
            /[^A-Za-zÀ-ÿ\s]/g,
            ''
        );

}


/* =========================================================
   EDITAR
========================================================= */

function editar()
{

    const nome =
        document.getElementById(
            "nome"
        );


    const email =
        document.getElementById(
            "email"
        );


    const telefone =
        document.getElementById(
            "telefone"
        );


    const senhaAtual =
        document.getElementById(
            "senhaAtual"
        );


    /*
    |--------------------------------------------------------------------------
    | LIBERA DADOS PESSOAIS
    |--------------------------------------------------------------------------
    */

    nome.disabled = false;

    email.disabled = false;

    telefone.disabled = false;


    /*
    |--------------------------------------------------------------------------
    | LIBERA SENHA ATUAL
    |--------------------------------------------------------------------------
    */

    senhaAtual.disabled = false;


    /*
    |--------------------------------------------------------------------------
    | CLASSES VISUAIS
    |--------------------------------------------------------------------------
    */

    nome
        .closest(".input-box")
        .classList
        .add("editable-field");


    email
        .closest(".input-box")
        .classList
        .add("editable-field");


    document
        .getElementById(
            "telefoneBox"
        )
        .classList
        .add("editable-field");


    document
        .getElementById(
            "senhaAtualBox"
        )
        .classList
        .add("editable-field");


    /*
    |--------------------------------------------------------------------------
    | MOSTRA NOVA SENHA
    |--------------------------------------------------------------------------
    */

    document
        .getElementById(
            "novaSenhaBox"
        )
        .style
        .display = "flex";


    document
        .getElementById(
            "confirmarSenhaBox"
        )
        .style
        .display = "flex";


    /*
    |--------------------------------------------------------------------------
    | TROCA BOTÕES
    |--------------------------------------------------------------------------
    */

    document
        .querySelector(
            ".editar"
        )
        .style
        .display = "none";


    document
        .querySelector(
            ".salvar"
        )
        .style
        .display = "flex";

}


/* =========================================================
   SALVAR
========================================================= */

async function salvar()
{

    const nome =
        document.getElementById(
            "nome"
        );


    const email =
        document.getElementById(
            "email"
        );


    const telefone =
        document.getElementById(
            "telefone"
        );


    const senhaAtual =
        document.getElementById(
            "senhaAtual"
        );


    const nova =
        document.getElementById(
            "novaSenha"
        );


    const confirmar =
        document.getElementById(
            "confirmarSenha"
        );


    const senhaAtualBox =
        document.getElementById(
            "senhaAtualBox"
        );


    const novaBox =
        document.getElementById(
            "novaSenhaBox"
        );


    const confirmarBox =
        document.getElementById(
            "confirmarSenhaBox"
        );


    /*
    |--------------------------------------------------------------------------
    | LIMPA ERROS
    |--------------------------------------------------------------------------
    */

    limparErros();


    /*
    |--------------------------------------------------------------------------
    | NOME
    |--------------------------------------------------------------------------
    */

    const nomeLimpo =
        nome.value.trim();


    if (
        nomeLimpo.length < 3
    ) {

        mostrarErroNome(
            "O nome deve possuir pelo menos 3 caracteres."
        );

        nome.focus();

        return;

    }


    const nomeValido =
        /^[A-Za-zÀ-ÿ\s]+$/.test(
            nomeLimpo
        );


    if (!nomeValido) {

        mostrarErroNome(
            "O nome deve conter somente letras e espaços."
        );

        nome.focus();

        return;

    }


    /*
    |--------------------------------------------------------------------------
    | E-MAIL
    |--------------------------------------------------------------------------
    */

    const emailValor =
        email.value.trim();


    const emailValido =
        /^[^\s@]+@[^\s@]+\.[^\s@]+$/
        .test(
            emailValor
        );


    if (!emailValido) {

        Swal.fire({

            icon: "error",

            title: "E-mail inválido",

            text: "Digite um e-mail válido.",

            confirmButtonColor: "#0a66c2"

        });

        email.focus();

        return;

    }


    /*
    |--------------------------------------------------------------------------
    | TELEFONE
    |--------------------------------------------------------------------------
    */

    if (
        telefone.value.trim() === ""
    ) {

        mostrarErroTelefone(
            "Digite seu telefone."
        );

        telefone.focus();

        return;

    }


    /*
    |--------------------------------------------------------------------------
    | VERIFICA SE ESTÁ ALTERANDO A SENHA
    |--------------------------------------------------------------------------
    */

    const estaAlterandoSenha =
        nova.value !== "" ||
        confirmar.value !== "";


    /*
    |--------------------------------------------------------------------------
    | SENHA
    |--------------------------------------------------------------------------
    */

    if (estaAlterandoSenha) {


        /*
        |--------------------------------------------------------------------------
        | SENHA ATUAL OBRIGATÓRIA
        |--------------------------------------------------------------------------
        */

        if (
            senhaAtual.value.trim() === ""
        ) {

            senhaAtualBox
                .classList
                .add("error");


            document
                .getElementById(
                    "erroAtual"
                )
                .innerText =
                "Digite sua senha atual para alterar a senha.";


            senhaAtual.focus();

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | NOVA SENHA
        |--------------------------------------------------------------------------
        */

        if (
            nova.value.length < 6
        ) {

            novaBox
                .classList
                .add("error");


            document
                .getElementById(
                    "erroNova"
                )
                .innerText =
                "A senha deve ter no mínimo 6 caracteres.";


            nova.focus();

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | CONFIRMAÇÃO
        |--------------------------------------------------------------------------
        */

        if (
            nova.value !==
            confirmar.value
        ) {

            confirmarBox
                .classList
                .add("error");


            document
                .getElementById(
                    "erroConfirmar"
                )
                .innerText =
                "As senhas não coincidem.";


            confirmar.focus();

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | IMPORTANTE:
        | PRIMEIRO VERIFICA A SENHA NO PHP.
        |
        | O SWEET ALERT AINDA NÃO APARECE.
        |--------------------------------------------------------------------------
        */

        const senhaFoiVerificada =
            await verificarSenhaAtual();


        /*
        |--------------------------------------------------------------------------
        | SENHA INCORRETA
        |
        | O verificarSenhaAtual() já mostra o erro
        | diretamente no campo.
        |--------------------------------------------------------------------------
        */

        if (!senhaFoiVerificada) {

            return;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | LIBERA CAMPOS PARA O POST
    |--------------------------------------------------------------------------
    */

    nome.disabled = false;

    email.disabled = false;

    telefone.disabled = false;

    senhaAtual.disabled = false;


    /*
    |--------------------------------------------------------------------------
    | AGORA SIM:
    | SWEET ALERT DE CONFIRMAÇÃO
    |--------------------------------------------------------------------------
    */

    Swal.fire({

        icon: "question",

        title: "Salvar alterações?",

        text: "Seus dados serão atualizados.",

        showCancelButton: true,

        confirmButtonText: "Salvar",

        cancelButtonText: "Cancelar",

        confirmButtonColor: "#0a66c2",

        cancelButtonColor: "#64748b"

    }).then(

        function (result)
        {

            if (
                result.isConfirmed
            ) {

                document
                    .getElementById(
                        "formPerfil"
                    )
                    .submit();

            }

        }

    );

}


/* =========================================================
   VERIFICAR SENHA ATUAL ANTES DO SWEET ALERT
========================================================= */

async function verificarSenhaAtual()
{

    const senhaAtual =
        document.getElementById(
            "senhaAtual"
        );


    const senhaAtualBox =
        document.getElementById(
            "senhaAtualBox"
        );


    const erroAtual =
        document.getElementById(
            "erroAtual"
        );


    /*
    |--------------------------------------------------------------------------
    | MOSTRA LOADING
    |--------------------------------------------------------------------------
    */

    const botaoSalvar =
        document.querySelector(
            ".salvar"
        );


    const textoOriginal =
        botaoSalvar.innerHTML;


    botaoSalvar.disabled = true;


    botaoSalvar.innerHTML =
        '<i class="fas fa-spinner fa-spin"></i> Verificando...';


    try {


        /*
        |--------------------------------------------------------------------------
        | ENVIA A SENHA PARA O CONTROLLER
        |--------------------------------------------------------------------------
        */

        const resposta =
            await fetch(
                "<?= base_url('perfilfun/verificar-senha') ?>",
                {

                    method: "POST",

                    headers: {

                        "Content-Type":
                            "application/x-www-form-urlencoded",

                        "X-Requested-With":
                            "XMLHttpRequest"

                    },

                    body:

                        "senhaAtual=" +

                        encodeURIComponent(
                            senhaAtual.value
                        ) +

                        "&<?= csrf_token() ?>=" +

                        encodeURIComponent(
                            "<?= csrf_hash() ?>"
                        )

                }
            );


        /*
        |--------------------------------------------------------------------------
        | CONVERTE RESPOSTA
        |--------------------------------------------------------------------------
        */

        const dados =
            await resposta.json();


        /*
        |--------------------------------------------------------------------------
        | SENHA INCORRETA
        |--------------------------------------------------------------------------
        */

        if (
            !dados.sucesso
        ) {


            senhaAtualBox
                .classList
                .add("error");


            erroAtual.innerText =
                dados.mensagem
                ||
                "A senha atual está incorreta.";


            /*
            |--------------------------------------------------------------------------
            | FOCA NO CAMPO
            |--------------------------------------------------------------------------
            */

            senhaAtual.focus();


            return false;

        }


        /*
        |--------------------------------------------------------------------------
        | SENHA CORRETA
        |--------------------------------------------------------------------------
        */

        return true;


    }

    catch (erro) {


        /*
        |--------------------------------------------------------------------------
        | ERRO DE COMUNICAÇÃO
        |--------------------------------------------------------------------------
        */

        senhaAtualBox
            .classList
            .add("error");


        erroAtual.innerText =
            "Não foi possível verificar a senha. Tente novamente.";


        return false;


    }

    finally {


        /*
        |--------------------------------------------------------------------------
        | RESTAURA BOTÃO
        |--------------------------------------------------------------------------
        */

        botaoSalvar.disabled =
            false;


        botaoSalvar.innerHTML =
            textoOriginal;

    }

}


/* =========================================================
   ERRO DO NOME
========================================================= */

function mostrarErroNome(
    mensagem
)
{

    const nome =
        document.getElementById(
            "nome"
        );


    let erro =
        document.getElementById(
            "erroNome"
        );


    /*
    |--------------------------------------------------------------------------
    | CRIA O ERRO CASO NÃO EXISTA
    |--------------------------------------------------------------------------
    */

    if (!erro) {

        erro =
            document.createElement(
                "div"
            );


        erro.id =
            "erroNome";


        erro.className =
            "error-text";


        nome
            .closest(".input-box")
            .appendChild(
                erro
            );

    }


    erro.innerText =
        mensagem;


    nome
        .closest(".input-box")
        .classList
        .add("error");

}


/* =========================================================
   ERRO DO TELEFONE
========================================================= */

function mostrarErroTelefone(
    mensagem
)
{

    const telefone =
        document.getElementById(
            "telefone"
        );


    const telefoneBox =
        document.getElementById(
            "telefoneBox"
        );


    let erro =
        document.getElementById(
            "erroTelefone"
        );


    if (!erro) {

        erro =
            document.createElement(
                "div"
            );


        erro.id =
            "erroTelefone";


        erro.className =
            "error-text";


        telefoneBox.appendChild(
            erro
        );

    }


    erro.innerText =
        mensagem;


    telefoneBox
        .classList
        .add("error");

}


/* =========================================================
   LIMPAR ERROS
========================================================= */

function limparErros()
{

    const erroNome =
        document.getElementById(
            "erroNome"
        );


    if (erroNome) {

        erroNome.innerText =
            "";

    }


    const erroTelefone =
        document.getElementById(
            "erroTelefone"
        );


    if (erroTelefone) {

        erroTelefone.innerText =
            "";

    }


    document
        .getElementById(
            "erroAtual"
        )
        .innerText =
        "";


    document
        .getElementById(
            "erroNova"
        )
        .innerText =
        "";


    document
        .getElementById(
            "erroConfirmar"
        )
        .innerText =
        "";


    document
        .getElementById(
            "senhaAtualBox"
        )
        .classList
        .remove("error");


    document
        .getElementById(
            "novaSenhaBox"
        )
        .classList
        .remove("error");


    document
        .getElementById(
            "confirmarSenhaBox"
        )
        .classList
        .remove("error");


    document
        .getElementById(
            "telefoneBox"
        )
        .classList
        .remove("error");


    const nome =
        document.getElementById(
            "nome"
        );


    if (nome) {

        nome
            .closest(".input-box")
            .classList
            .remove("error");

    }

}


/* =========================================================
   MÁSCARA TELEFONE
========================================================= */

function mascaraTelefone(
    input
)
{

    let v =
        input.value
        .replace(
            /\D/g,
            ""
        );


    if (
        v.length > 11
    ) {

        v =
            v.substring(
                0,
                11
            );

    }


    if (
        v.length <= 10
    ) {

        v =
            v.replace(
                /(\d{2})(\d)/,
                "($1) $2"
            );


        v =
            v.replace(
                /(\d{4})(\d)/,
                "$1-$2"
            );

    }

    else {

        v =
            v.replace(
                /(\d{2})(\d)/,
                "($1) $2"
            );


        v =
            v.replace(
                /(\d{5})(\d)/,
                "$1-$2"
            );

    }


    input.value =
        v;

}


/* =========================================================
   IMAGEM DO PERFIL
========================================================= */

function atualizarImagemPerfil()
{

    const imagem =
        document.getElementById(
            'imagemSeguranca'
        );


    if (!imagem) {

        return;

    }


    const modoEscuro =

        document.body.classList.contains(
            'dark-mode'
        )

        ||

        document.body.classList.contains(
            'dark'
        );


    const altoContraste =

        document.body.classList.contains(
            'alto-contraste'
        );


    const imagemClara =
        "<?= base_url(
            'assets/images/capacete_perfil.png'
        ) ?>";


    const imagemEscura =
        "<?= base_url(
            'assets/images/capacete_perfil_escuro.png'
        ) ?>";


    if (
        modoEscuro ||
        altoContraste
    ) {

        imagem.src =
            imagemEscura;

    }

    else {

        imagem.src =
            imagemClara;

    }

}


/* =========================================================
   AO CARREGAR
========================================================= */

document.addEventListener(
    'DOMContentLoaded',
    function ()
    {

        atualizarImagemPerfil();


        /*
        |--------------------------------------------------------------------------
        | SE HOUVE ERRO DE SENHA,
        | REABRE AUTOMATICAMENTE A EDIÇÃO
        |--------------------------------------------------------------------------
        */

        const possuiErroSenha =

            <?= (

                !empty($erroSenhaAtual)

                ||

                !empty($erroNovaSenha)

                ||

                !empty($erroConfirmarSenha)

            )

                ? 'true'

                : 'false'

            ?>;


        if (
            possuiErroSenha
        ) {

            editar();

        }

    }

);


/* =========================================================
   OBSERVAR MODO ESCURO / CONTRASTE
========================================================= */

const observadorModo =

    new MutationObserver(

        function ()
        {

            atualizarImagemPerfil();

        }

    );


observadorModo.observe(

    document.body,

    {

        attributes: true,

        attributeFilter: [
            'class'
        ]

    }

);

</script>


<!-- =========================================================
     ACESSIBILIDADE
========================================================= -->

<script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>


</body>

</html>