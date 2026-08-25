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
        href="<?= base_url('assets/css/login.css') ?>"
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
         LOGIN
    ====================================================== -->

    <div class="login-container">


        <!-- =================================================
             LADO ESQUERDO
        ================================================== -->

        <div class="left-side">


            <!-- VÍDEO DE FUNDO -->

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


            <!-- CONTEÚDO SOBRE O VÍDEO -->

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


            <!-- LOGO -->
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


            <div class="login-form-area">


                <!-- TÍTULO -->

                <h1 class="titulo">
                    Login
                </h1>



                <!-- MENSAGEM DE ERRO -->

                <?php if(session()->getFlashdata('erro')): ?>

                    <div class="erro-login">

                        <?= session()->getFlashdata('erro') ?>

                    </div>

                <?php endif; ?>



                <!-- FORMULÁRIO -->

                <form
                    method="post"
                    action="<?= base_url('/login/autenticar') ?>"
                >


                    <!-- E-MAIL -->

                    <div class="input-box">

                        <i class="fas fa-envelope"></i>

                        <input
                            type="email"
                            name="email"
                            placeholder="E-mail"
                           
                        >

                    </div>



                    <!-- SENHA -->

                    <div class="input-box">

                        <i class="fas fa-lock"></i>

                        <input
                            type="password"
                            name="senha"
                            placeholder="Senha"
                           
                        >

                    </div>



                    <!-- BOTÃO -->

                    <button
                        type="submit"
                        class="btn-login"
                    >
                        Entrar
                    </button>


                </form>



                <!-- LINK -->

                <div class="links">

                    <a href="<?= site_url('/') ?>">
                        Voltar para a página inicial
                    </a>

                </div>



                <!-- FOOTER -->

                <div class="footer">

                    © 2026 – NEXA

                </div>


            </div>

        </div>


    </div>



    <!-- =====================================================
         ACESSIBILIDADE JS
    ====================================================== -->

    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>
    <script>

    const videos = [
        "<?= base_url('assets/videos/epi_construcao_1.mp4') ?>",
        "<?= base_url('assets/videos/epi_construcao_2.mp4') ?>",
        "<?= base_url('assets/videos/epi_construcao_3.mp4') ?>",
        "<?= base_url('assets/videos/epi_construcao_4.mp4') ?>"
    ];

    const video = document.getElementById("videoCarousel");

    let videoAtual = 0;


    video.addEventListener("ended", function () {

        videoAtual++;

        // Quando chegar ao final dos 4,
        // volta para o primeiro.
        if (videoAtual >= videos.length) {
            videoAtual = 0;
        }

        video.src = videos[videoAtual];

        video.load();

        video.play();

    });

</script>


</body>

</html>