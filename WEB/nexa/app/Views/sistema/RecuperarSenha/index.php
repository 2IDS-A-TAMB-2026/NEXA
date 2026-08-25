<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>NEXA | Recuperar Senha</title>

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >


    <!-- =====================================================
         FONT
    ====================================================== -->

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >


    <!-- =====================================================
         ÍCONES
    ====================================================== -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >


    <!-- =====================================================
         CSS DE ACESSIBILIDADE E LOGIN
    ====================================================== -->

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/acessibilidade_login.css') ?>"
    >

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/login_funcionario.css') ?>"
    >

    <style>
        /* Estilos mantidos para as mensagens de validação do JavaScript */
        .error {
            display: none;
            color: #d9534f;
            text-align: center;
            font-size: 13px;
            margin-top: 10px;
        }

        .success {
            display: none;
            color: #5cb85c;
            text-align: center;
            font-size: 13px;
            margin-top: 10px;
        }
    </style>

</head>


<body>


    <!-- =====================================================
         MENU DE ACESSIBILIDADE
    ====================================================== -->

    <div class="access-bar" style="position: absolute; top: 15px; right: 15px; display: flex; gap: 10px; z-index: 10;">

        <button class="access-btn" onclick="Acessibilidade.toggleContraste()" title="Alto Contraste">
            <i class="fas fa-adjust"></i>
        </button>

        <button class="access-btn" onclick="toggleDark()" title="Modo Escuro">
            <i class="fas fa-moon"></i>
        </button>

        <button class="access-btn" onclick="Acessibilidade.aumentarFonte()" title="Aumentar Fonte">
            A+
        </button>

        <button class="access-btn" onclick="Acessibilidade.diminuirFonte()" title="Diminuir Fonte">
            A-
        </button>

        <button class="access-btn" onclick="Acessibilidade.lerPagina()" title="Ler Página">
            <i class="fas fa-volume-up"></i>
        </button>

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

                    Recuperar Senha

                </h1>


                <!-- =================================================
                     SUBTÍTULO
                ================================================== -->

                <p class="subtitulo">

                    Digite seu e-mail para continuar

                </p>



                <!-- =================================================
                     FORMULÁRIO / CAMPO E-MAIL
                ================================================== -->

                <div class="input-box">

                    <i class="fas fa-envelope"></i>

                    <input
                        type="email"
                        id="email"
                        placeholder="Seu e-mail"
                        autocomplete="email"
                        required
                    >

                </div>



                <!-- =================================================
                     BOTÃO CONTINUAR
                ================================================== -->

                <button
                    type="button"
                    class="btn-login"
                    onclick="recuperarSenha()"
                >

                    Continuar

                </button>



                <!-- =================================================
                     MENSAGENS DE ERRO / SUCESSO
                ================================================== -->

                <div class="error" id="erro">

                    E-mail não encontrado

                </div>

                <div class="success" id="sucesso">

                    Redirecionando...

                </div>



                <!-- =================================================
                     LINKS
                ================================================== -->

                <div class="links">

                    <a href="<?= base_url('loginfun') ?>">

                        Voltar para o login

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


        videoCarousel.addEventListener('ended', function () {

            videoAtual++;

            if (videoAtual >= videos.length) {

                videoAtual = 0;

            }

            videoCarousel.src = videos[videoAtual];

            videoCarousel.load();

            videoCarousel.play();

        });

    </script>



    <!-- =====================================================
         LÓGICA DE RECUPERAÇÃO DE SENHA
    ====================================================== -->

    <script>

        async function recuperarSenha(){

            const emailInput = document.getElementById("email");
            const email = emailInput ? emailInput.value.trim() : "";

            const erro = document.getElementById("erro");
            const sucesso = document.getElementById("sucesso");

            erro.style.display = "none";
            sucesso.style.display = "none";

            if(!email){

                erro.innerText = "Digite um e-mail";
                erro.style.display = "block";
                return;

            }

            try{

                const resposta = await fetch(
                    "<?= site_url('recuperar/enviar') ?>",
                    {
                        method: "POST",
                        headers:{
                            "Content-Type":"application/x-www-form-urlencoded"
                        },
                        body:`email=${encodeURIComponent(email)}`
                    }
                );

                if(!resposta.ok){
                    erro.innerText = "Ocorreu um erro no servidor ao processar o e-mail.";
                    erro.style.display = "block";
                    return;
                }

                const texto = (await resposta.text()).trim();

                if(texto === "sucesso"){

                    sucesso.innerText = "E-mail enviado com sucesso";
                    sucesso.style.display = "block";

                }else{

                    erro.innerText = texto;
                    erro.style.display = "block";

                }

            }catch(e){

                erro.innerText = "Erro ao conectar";
                erro.style.display = "block";

            }

        }

    </script>


</body>

</html>