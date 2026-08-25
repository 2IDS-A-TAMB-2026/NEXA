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


                <!-- LINHA DECORATIVA -->

                <div class="linha"></div>


                <!-- TÍTULO -->

                <h2>

                    Segurança

                    <strong>
                        em primeiro lugar.
                    </strong>

                </h2>


                <!-- TEXTO -->

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
            <!-- ÁREA DO FORMULÁRIO -->

            <div class="login-form-area">


                <!-- =================================================
                     TÍTULO
                ================================================== -->

                <h1 class="titulo">

                    Login

                </h1>


                <!-- =================================================
                     SUBTÍTULO
                ================================================== -->

                <p class="subtitulo">

                    Área do Funcionário

                </p>



                <!-- =================================================
                     MENSAGEM DE ERRO
                ================================================== -->

                <?php if(session()->getFlashdata('erro')): ?>

                    <div class="erro-login">

                        <?= session()->getFlashdata('erro') ?>

                    </div>

                <?php endif; ?>



                <!-- =================================================
                     FORMULÁRIO
                ================================================== -->

                <form
                    method="post"
                    action="<?= base_url('/loginfun/autenticar') ?>"
                >


                    <!-- =================================================
                         E-MAIL
                    ================================================== -->

                    <div class="input-box">


                        <i class="fas fa-envelope"></i>


                        <input
                            type="email"
                            name="email_fun"
                            placeholder="E-mail corporativo"
                            autocomplete="email"
                            
                        >


                    </div>



                    <!-- =================================================
                         SENHA
                    ================================================== -->

                    <div class="input-box">


                        <i class="fas fa-lock"></i>


                        <input
                            type="password"
                            name="senha"
                            placeholder="Senha"
                            autocomplete="current-password"
                            
                        >


                    </div>



                    <!-- =================================================
                         BOTÃO ENTRAR
                    ================================================== -->

                    <button
                        type="submit"
                        class="btn-login"
                    >

                        Entrar

                    </button>


                </form>



                <!-- =================================================
                     LINKS
                ================================================== -->

                <div class="links">


                    <!-- RECUPERAÇÃO -->

                    <a href="<?= base_url('recuperar') ?>">

                        Esqueci minha senha

                    </a>


                    <!-- VOLTAR -->

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
         * Quando o vídeo termina,
         * passa automaticamente para o próximo.
         */

        videoCarousel.addEventListener('ended', function () {


            videoAtual++;


            /*
             * Quando chegar ao quarto vídeo,
             * volta para o primeiro.
             */

            if (videoAtual >= videos.length) {

                videoAtual = 0;

            }


            /*
             * Troca o vídeo.
             */

            videoCarousel.src = videos[videoAtual];


            /*
             * Carrega o novo vídeo.
             */

            videoCarousel.load();


            /*
             * Inicia automaticamente.
             */

            videoCarousel.play();


        });

    </script>


</body>

</html>