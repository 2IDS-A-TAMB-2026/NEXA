<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>NEXA | Login</title>

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<!-- FONT -->
<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
    rel="stylesheet"
>

<!-- ÍCONES -->
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
>

<!-- ACESSIBILIDADE -->
<link
    rel="stylesheet"
    href="<?= base_url('assets/css/acessibilidade_login.css') ?>"
>

<!-- LOGIN -->
<link
    rel="stylesheet"
    href="<?= base_url('assets/css/login_funcionario.css') ?>"
>

</head>

<body>


<!-- =====================================================
     ACESSIBILIDADE
====================================================== -->

<div class="access-menu">

    <button
        class="gear-btn"
        onclick="toggleAccessMenu()"
    >
        <i class="fas fa-cog"></i>
    </button>


    <div
        class="access-options"
        id="accessOptions"
    >

        <button
            class="access-btn"
            onclick="Acessibilidade.toggleContraste()"
        >
            <i class="fas fa-adjust"></i>
        </button>


        <button
            class="access-btn"
            onclick="toggleDark()"
        >
            <i class="fas fa-moon"></i>
        </button>


        <button
            class="access-btn"
            onclick="Acessibilidade.aumentarFonte()"
        >
            A+
        </button>


        <button
            class="access-btn"
            onclick="Acessibilidade.diminuirFonte()"
        >
            A-
        </button>


        <button
            class="access-btn"
            onclick="Acessibilidade.lerPagina()"
        >
            <i class="fas fa-volume-up"></i>
        </button>

    </div>

</div>


<!-- =====================================================
     CONTAINER PRINCIPAL
====================================================== -->

<div class="login-container">


    <!-- =================================================
         LADO ESQUERDO
    ================================================== -->

    <div class="left-side">


        <!-- =================================================
             CARROSSEL DE VÍDEOS
        ================================================== -->

        <div class="video-carousel">

            <video
                id="videoCarousel"
                autoplay
                muted
                playsinline
                preload="auto"
            >

                <source
                    src="<?= base_url('assets/videos/epi_construcao_1.mp4') ?>"
                    type="video/mp4"
                >

            </video>

        </div>


        <!-- =================================================
             TEXTO SOBRE O VÍDEO
        ================================================== -->

        <div class="left-content">

            <div class="linha"></div>

            <h2>

                Segurança

                <strong>
                    em primeiro lugar.
                </strong>

            </h2>

            <p>

                Tecnologia e prevenção trabalhando
                juntas para um ambiente mais seguro.

            </p>

        </div>

    </div>


    <!-- =================================================
         LADO DIREITO
    ================================================== -->

    <div class="right-side">


        <!-- =================================================
             LOGO
        ================================================== -->

        <div class="logo-container">

            <img
                class="logo-light"
                src="<?= base_url('assets/images/logo_transparente.png') ?>"
                alt="NEXA - Safety at the Core"
            >

            <img
                class="logo-dark"
                src="<?= base_url('assets/images/logo_escura.png') ?>"
                alt="NEXA - Safety at the Core"
            >

        </div>


        <!-- =================================================
             ÁREA DO FORMULÁRIO
        ================================================== -->

        <div class="login-form-area">


            <h1 class="titulo">
                Login
            </h1>


            <p class="subtitulo">
                Área do Funcionário
            </p>


            <!-- =================================================
                 MENSAGEM DE ERRO
            ================================================== -->

            <?php if (session()->getFlashdata('erro')): ?>

                <div class="erro-login">

                    <?= esc(session()->getFlashdata('erro')) ?>

                </div>

            <?php endif; ?>


            <!-- =================================================
                 FORMULÁRIO
            ================================================== -->

            <form
                method="post"
                action="<?= base_url('/loginfun/autenticar') ?>"
            >

                <?= csrf_field() ?>

                <div class="input-box">

                    <i class="fas fa-envelope"></i>

                    <input
                        type="email"
                        name="email_fun"
                        placeholder="E-mail corporativo"
                        autocomplete="email"
                        
                    >

                </div>


                <div class="input-box">

                    <i class="fas fa-lock"></i>

                    <input
                        type="password"
                        name="senha"
                        placeholder="Senha"
                        autocomplete="current-password"
                        
                    >

                </div>


                <button
                    type="submit"
                    class="btn-login"
                >

                    Entrar

                </button>

                <button
                    type="button"
                    id="btnLoginCartao"
                    class="btn-login-cartao"
                    onclick="ativarLoginCartao()"
                >
                    <i class="fas fa-id-card"></i>
                    Login com o cartão
                </button>

                <div
                    id="statusRFID"
                    class="status-rfid"
                    style="display: none;"
                >
                    <i class="fas fa-spinner fa-spin"></i>
                    Aguardando aproximação do cartão...
                </div>

            </form>


            <!-- =================================================
                 LINKS
            ================================================== -->

            <div class="links">

                <a href="<?= base_url('/') ?>">

                    Voltar para página inicial

                </a>

            </div>


            <!-- =================================================
                 RODAPÉ
            ================================================== -->

            <div class="footer">

                © 2026 — NEXA

            </div>


        </div>

    </div>

</div>


<!-- =====================================================
     JAVASCRIPT DE ACESSIBILIDADE
====================================================== -->

<script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>


<!-- =====================================================
     RFID
====================================================== -->

<!-- <script>

(function () {

    /*
     * ==================================================
     * CONTROLE DO RFID
     * ==================================================
     */

    let verificandoRFID = false;

    let rfidRedirecionando = false;

    /*
     * Guarda o ID da sessão RFID que já foi processada
     * neste navegador.
     */

    let sessaoRFIDProcessada = null;


    /*
     * ==================================================
     * VERIFICAR RFID
     * ==================================================
     */

    async function verificarRFID() {

        /*
         * Evita consultas simultâneas.
         */

        if (verificandoRFID) {

            return;

        }


        /*
         * Se já está redirecionando,
         * não faz outra consulta.
         */

        if (rfidRedirecionando) {

            return;

        }


        verificandoRFID = true;


        try {

            /*
             * Consulta a API.
             */

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


            /*
             * Verifica resposta HTTP.
             */

            if (!resposta.ok) {

                return;

            }


            /*
             * Converte para JSON.
             */

            const dados = await resposta.json();


            console.log(
                'RFID STATUS:',
                dados
            );


            /*
             * ==================================================
             * JÁ ESTÁ LOGADO
             * ==================================================
             *
             * Se o servidor informar que a sessão atual
             * já está autenticada, não fazemos outro login.
             */

            if (dados.jaLogado === true) {

                console.log(
                    'Usuário já está logado.'
                );

                return;

            }


            /*
             * ==================================================
             * NENHUM ACESSO NOVO
             * ==================================================
             */

            if (
                dados.sucesso !== true ||
                dados.novoAcesso !== true
            ) {

                return;

            }


            /*
             * ==================================================
             * IDENTIFICAR A SESSÃO RFID
             * ==================================================
             *
             * O backend deve enviar o ID da sessão.
             */

            const sessaoId =
                dados.sessaoId ??
                dados.id ??
                null;


            /*
             * Se recebemos um ID e ele já foi processado,
             * não processamos novamente.
             */

            if (
                sessaoId !== null &&
                sessaoRFIDProcessada === sessaoId
            ) {

                console.log(
                    'Sessão RFID já processada:',
                    sessaoId
                );

                return;

            }


            /*
             * ==================================================
             * NOVO ACESSO
             * ==================================================
             */

            console.log(
                'RFID identificado:',
                dados.funcionario?.nome
            );


            console.log(
                'CPF:',
                dados.funcionario?.cpf
            );


            console.log(
                'Câmera:',
                dados.camera?.identificador
            );


            console.log(
                'Terminal:',
                dados.terminalId
            );


            /*
             * ==================================================
             * MARCAR COMO PROCESSADO
             * ==================================================
             */

            if (sessaoId !== null) {

                sessaoRFIDProcessada = sessaoId;

            }


            /*
             * ==================================================
             * BLOQUEAR OUTROS REDIRECIONAMENTOS
             * ==================================================
             */

            rfidRedirecionando = true;


            /*
             * ==================================================
             * REDIRECIONAMENTO
             * ==================================================
             */

            if (dados.redirect) {

                window.location.href =
                    dados.redirect;

            } else {

                window.location.href =
                    '<?= base_url("camera_analise") ?>';

            }


        } catch (erro) {

            console.error(
                'Erro ao consultar RFID:',
                erro
            );


        } finally {

            verificandoRFID = false;

        }

    }


    /*
     * ==================================================
     * PRIMEIRA CONSULTA
     * ==================================================
     */

    verificarRFID();


    /*
     * ==================================================
     * CONSULTAR A CADA 1 SEGUNDO
     * ==================================================
     */

    setInterval(
        verificarRFID,
        1000
    );


})();

</script> -->

<script>

(function () {

    /*
     * ==================================================
     * CONTROLE DO LOGIN RFID
     * ==================================================
     */

    let verificandoRFID = false;

    let rfidAtivo = false;

    let rfidRedirecionando = false;

    let intervaloRFID = null;

    let sessaoRFIDProcessada = null;


    /*
     * ==================================================
     * ELEMENTOS
     * ==================================================
     */

    const btnLoginCartao =
        document.getElementById('btnLoginCartao');

    const statusRFID =
        document.getElementById('statusRFID');


    /*
     * ==================================================
     * ATIVAR LOGIN COM CARTÃO
     * ==================================================
     */

    window.ativarLoginCartao = function () {

        /*
         * Se já estiver ativo,
         * não faz nada.
         */

        if (rfidAtivo) {
            return;
        }


        /*
         * Ativa o RFID.
         */

        rfidAtivo = true;


        /*
         * Limpa uma sessão RFID processada anteriormente
         * neste navegador.
         */

        sessaoRFIDProcessada = null;


        /*
         * Altera o botão.
         */

        btnLoginCartao.innerHTML =
            '<i class="fas fa-spinner fa-spin"></i> ' +
            'Aguardando cartão...';


        btnLoginCartao.classList.add(
            'aguardando'
        );


        /*
         * Mostra mensagem.
         */

        statusRFID.style.display =
            'block';


        /*
         * Primeira consulta imediatamente.
         */

        verificarRFID();


        /*
         * Começa a consultar a cada 1 segundo.
         */

        intervaloRFID = setInterval(
            verificarRFID,
            1000
        );

    };


    /*
     * ==================================================
     * DESATIVAR LOGIN RFID
     * ==================================================
     */

    window.cancelarLoginCartao = function () {

        rfidAtivo = false;


        /*
         * Para o intervalo.
         */

        if (intervaloRFID !== null) {

            clearInterval(
                intervaloRFID
            );

            intervaloRFID = null;

        }


        /*
         * Restaura botão.
         */

        btnLoginCartao.innerHTML =
            '<i class="fas fa-id-card"></i> ' +
            'Login com o cartão';


        btnLoginCartao.classList.remove(
            'aguardando'
        );


        /*
         * Esconde status.
         */

        statusRFID.style.display =
            'none';

    };


    /*
     * ==================================================
     * VERIFICAR RFID
     * ==================================================
     */

    async function verificarRFID() {

        /*
         * Só consulta se o usuário
         * tiver clicado no botão.
         */

        if (!rfidAtivo) {

            return;

        }


        /*
         * Evita duas consultas simultâneas.
         */

        if (verificandoRFID) {

            return;

        }


        /*
         * Se já está redirecionando,
         * não faz nova consulta.
         */

        if (rfidRedirecionando) {

            return;

        }


        verificandoRFID = true;


        try {

            /*
             * Consulta o backend.
             */

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


            /*
             * Verifica resposta HTTP.
             */

            if (!resposta.ok) {

                return;

            }


            /*
             * Converte para JSON.
             */

            const dados =
                await resposta.json();


            console.log(
                'RFID STATUS:',
                dados
            );


            /*
             * ==================================================
             * NENHUM CARTÃO
             * ==================================================
             */

            if (
                dados.sucesso !== true ||
                dados.novoAcesso !== true
            ) {

                return;

            }


            /*
             * ==================================================
             * PEGAR ID DA SESSÃO RFID
             * ==================================================
             */

            const sessaoId =
                dados.sessaoId ??
                dados.id ??
                null;


            /*
             * Evita processar a mesma sessão
             * duas vezes.
             */

            if (
                sessaoId !== null &&
                sessaoRFIDProcessada === sessaoId
            ) {

                return;

            }


            /*
             * ==================================================
             * CARTÃO ENCONTRADO
             * ==================================================
             */

            console.log(
                'Cartão identificado:',
                dados.funcionario?.nome
            );


            console.log(
                'CPF:',
                dados.funcionario?.cpf
            );


            /*
             * Marca sessão como processada.
             */

            if (sessaoId !== null) {

                sessaoRFIDProcessada =
                    sessaoId;

            }


            /*
             * Bloqueia novas consultas.
             */

            rfidRedirecionando = true;


            /*
             * Para o intervalo.
             */

            if (intervaloRFID !== null) {

                clearInterval(
                    intervaloRFID
                );

                intervaloRFID = null;

            }


            /*
             * Atualiza botão.
             */

            btnLoginCartao.innerHTML =
                '<i class="fas fa-check"></i> ' +
                'Cartão identificado!';


            /*
             * Atualiza mensagem.
             */

            statusRFID.innerHTML =
                '<i class="fas fa-check"></i> ' +
                'Login realizado. Entrando...';


            /*
             * ==================================================
             * REDIRECIONAMENTO
             * ==================================================
             */

            if (dados.redirect) {

                window.location.href =
                    dados.redirect;

            } else {

                window.location.href =
                    '<?= base_url("camera_analise") ?>';

            }

        } catch (erro) {

            console.error(
                'Erro ao consultar RFID:',
                erro
            );

        } finally {

            verificandoRFID = false;

        }

    }


})();

</script>


<!-- =====================================================
     CARROSSEL DE VÍDEOS
====================================================== -->

<script>

const videos = [

    "<?= base_url('assets/videos/epi_construcao_1.mp4') ?>",

    "<?= base_url('assets/videos/epi_construcao_2.mp4') ?>",

    "<?= base_url('assets/videos/epi_construcao_3.mp4') ?>",

    "<?= base_url('assets/videos/epi_construcao_4.mp4') ?>"

];


const videoCarousel =
    document.getElementById('videoCarousel');


let videoAtual = 0;


/*
 * ==================================================
 * TROCAR VÍDEO
 * ==================================================
 */

videoCarousel.addEventListener(
    'ended',
    function () {


        videoAtual++;


        /*
         * Quando chegar ao último,
         * volta para o primeiro.
         */

        if (
            videoAtual >= videos.length
        ) {

            videoAtual = 0;

        }


        /*
         * Troca o vídeo.
         */

        videoCarousel.src =
            videos[videoAtual];


        /*
         * Carrega o novo vídeo.
         */

        videoCarousel.load();


        /*
         * Reproduz automaticamente.

         */

        videoCarousel.play()
            .catch(function (erro) {

                console.log(
                    'Não foi possível iniciar o vídeo:',
                    erro
                );

            });

    }
);

</script>


</body>

</html>
