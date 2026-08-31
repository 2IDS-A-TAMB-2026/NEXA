<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>NEXA | Safety at the Core</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/css_institucional.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade_inst.css') ?>">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        #visao_comp_img {
            margin: 15px auto;
            /*nao mexe ainda*/
            justify-content: center;
            display: flex;
        }

        #legenda_visao_comp {
            font-style: itallic;
            color: grey;
            font-size: 12px;
            text-align: center;
            justify-content: center;
            display: flex;
        }
       
        /* Contêiner de Acessibilidade Posicionado */
        .access-menu {
            position: relative;
            display: flex;
            align-items: center;
        }

        /* Botão da Engrenagem */
        .gear-btn {
            background: transparent;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: #4a5568;
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            z-index: 2;
        }

        .gear-btn:hover {
            background-color: rgba(0, 0, 0, 0.06);
            color: #1a202c;
        }

        /* Menu HORIZONTAL posicionado à ESQUERDA da engrenagem */
.access-options {
    display: flex; /* Mantém a estrutura flexível */
    visibility: hidden; /* Oculta sem quebrar o layout */
    opacity: 0;
    pointer-events: none; /* Desativa cliques quando oculto */
    
    position: absolute;
    right: 100%;
    top: 50%;
    transform: translateY(-50%) translateX(10px);
    margin-right: 8px;
    
    flex-direction: row;
    align-items: center;
    gap: 6px;
    
    background-color: #ffffff;
    padding: 4px 8px;
    border-radius: 30px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.12);
    border: 1px solid #e2e8f0;
    z-index: 999; /* Garante que fique por cima de outros elementos */
    white-space: nowrap;
    
    transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s;
}

/* Exibição ativa via Classe */
.access-options.show {
    visibility: visible;
    opacity: 1;
    pointer-events: auto; /* Habilita cliques quando visível */
    transform: translateY(-50%) translateX(0);
}
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50%) translateX(10px);
            }
            to {
                opacity: 1;
                transform: translateY(-50%) translateX(0);
            }
        }

        /* Estilo dos Botões do Menu */
        .access-btn {
            background: transparent;
            border: none;
            padding: 6px 10px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
            color: #0A66C2;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .access-btn:hover {
            background-color: #edf2f7;
        }

        /* Compatibilidade com Modo Escuro */
        body.dark-mode .access-options {
            background-color: #2d3748;
            border-color: #4a5568;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.4);
        }

        body.dark-mode .access-btn {
            color: #63b3ed;
        }

        body.dark-mode .access-btn:hover {
            background-color: #4a5568;
        }

        body.dark-mode .gear-btn {
            color: #e2e8f0;
        }
    
    </style>
</head>

<body>

    <header class="topbar">

        <div class="logo">
            <img class="logo-light" src="<?= base_url('assets/images/logo.nexa.png') ?>">
            <img class="logo-dark" src="<?= base_url('assets/images/logo_escura_transparente.png') ?>">

            <span>NEXA</span>
        </div>

        <nav class="menu">



            <!-- LADO ESQUERDO (TUDO JUNTO) -->
            <div class="menu-left">
                <a href="<?= site_url('/') ?>">Home</a>
                <a href="#solucoes_nexa">Soluções</a>
                <a href="#valores_nexa">Valores</a>
                <a href="#sobre_nexa">Sobre</a>
                <a href="#nossa_equipe">Nossa equipe</a>
                <button class="access-btnindex" onclick="Acessibilidade.toggleContraste()">
                    <i class="fas fa-adjust"></i>
                </button>

                <button class="access-btnindex" onclick="toggleDark()">
                    <i class="fas fa-moon"></i>
                </button>

                <button class="access-btnindex" onclick="Acessibilidade.aumentarFonte()">A+</button>
                <button class="access-btnindex" onclick="Acessibilidade.diminuirFonte()">A-</button>

                <button class="access-btnindex" onclick="Acessibilidade.lerPagina()">
                    <i class="fas fa-volume-up"></i>
                </button>

                <a href="<?= site_url('/loginfun') ?>" class="button">
                    Entrar
                </a>
            </div>

        </nav>

    </header>

    <section class="hero">
        <div>
            <h1 id="safety">Safety at the <span id="core">Core</span></h1>
            <p id="paragrafo_inst" style="text-align: justify;">
                A segurança do trabalho é um fator essencial para a proteção da vida,
                a redução de acidentes e o cumprimento das normas regulamentadoras.
                A NEXA utiliza visão computacional e análise de dados para monitorar
                o uso correto de Equipamentos de Proteção Individual (EPIs) em tempo
                real, promovendo ambientes de trabalho mais seguros, eficientes e
                alinhados às exigências legais.
            </p>

            <div class="hero-buttons">
                <a href="<?= site_url('/login') ?>" class="btn-primary">Acessar Plataforma</a>
                <a href="#sobre_nexa" class="btn-secondary">Saiba Mais</a>
            </div>
        </div>

        <div class="carousel">
            <img class="active" src="<?= base_url('assets/images/slide1.jpg') ?>">
            <img src="<?= base_url('assets/images/slide2.jpg') ?>">
            <img src="<?= base_url('assets/images/slide3.jpg') ?>">
        </div>
    </section>

    <section class="page" id="solucoes_nexa">
        <h1>Nossas Soluções</h1>
        <p class="subtitle" style="justify-content: left;">
            A NEXA oferece soluções digitais integradas que garantem
            segurança, conformidade e inteligência operacional em
            ambientes corporativos e industriais.
        </p>

        <div class="solutions">
            <div class="solution">
                <i class="fa-solid fa-helmet-safety"></i>
                <h3>Monitoramento de EPIs</h3>
                <p style="text-align: justify;">
                Monitoramento automatizado do uso de capacetes, óculos, luvas e
                demais Equipamentos de Proteção Individual por meio de visão
                computacional.
                </p>
            </div>

            <div class="solution">
                <i class="fa-solid fa-chart-line"></i>
                <h3>Relatórios Inteligentes</h3>
                <p>Análises em tempo real para decisões estratégicas.</p>
            </div>

            <div class="solution">
                <i class="fa-solid fa-globe"></i>
                <h3>Compliance Global</h3>
                <p> Apoio ao cumprimento da NR-6 e
                    demais normas relacionadas à segurança e
                    saúde ocupacional.</p>
            </div>
        </div>
        <div class="solutions">
            <div class="solution">
                <i class="fa-solid fa-bell"></i>
                <h3>Alertas em Tempo Real</h3>
                <p>Notificações imediatas para prevenção de acidentes.</p>
            </div>

            <div class="solution">
                <i class="fa-solid fa-database"></i>
                <h3>Centralização de Dados</h3>
                <p>Histórico seguro e rastreável de informações.</p>
            </div>

            <div class="solution">
                <i class="fa-solid fa-shield-halved"></i>
                <h3>Gestão de Riscos</h3>
                <p>Mitigação de riscos com apoio tecnológico.</p>
            </div>
        </div>
    </section>

    <section class="video-section reveal">

        <div class="video-container">

            <video id="videoNexa" autoplay muted loop playsinline>
                <source src="<?= base_url('assets/images/nexa.mp4') ?>" type="video/mp4">

            </video>

            <button class="btn-som" onclick="toggleSom()">
                <i class="fas fa-volume-mute"></i>
            </button>

        </div>

    </section>

    <section class="page">
        <h1>Visão computacional</h1>

        <div class="visao_comp">
            <p class="subtitle" style="text-align: justify;">
            A visão computacional é uma área da computação que permite aos sistemas
            interpretar e analisar imagens e vídeos de forma automatizada. Por meio
            de algoritmos especializados, é possível identificar padrões, reconhecer
            objetos, classificar elementos visuais e acompanhar movimentações em
            tempo real. Na NEXA, essa tecnologia é aplicada para identificar o uso
            correto dos Equipamentos de Proteção Individual (EPIs), contribuindo para
            a prevenção de acidentes, o cumprimento das normas de segurança e a
            construção de ambientes de trabalho mais seguros.
            </p>

            <img src="<?= base_url('assets/images/visao_comp_ex.jpeg') ?>" id="visao_comp_img" width="40%"
                alt="Exemplo de atuação da visão computacional na identificação de EPIs">
            <figcaption id="legenda_visao_comp">
                Exemplo de atuação da visão computacional na identificação de EPIs</figcaption>
        </div>
    </section>
    <!--conteudo aqui-->
   <section class="page">

    <h1>Dados da Segurança do Trabalho no Brasil</h1>

    <p class="subtitle" style="text-align: justify;">
        Os acidentes de trabalho continuam sendo um grande desafio para empresas
        e trabalhadores. A adoção de tecnologias voltadas à prevenção de riscos
        contribui para a redução de ocorrências e para a promoção de ambientes
        mais seguros.
    </p>

    <div class="solutions">

        <div class="solution">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <h3>806 Mil</h3>
            <p>Acidentes de trabalho registrados no Brasil em 2025.</p>
        </div>

        <div class="solution">
            <i class="fa-solid fa-heart-crack"></i>
            <h3>3.644</h3>
            <p>Óbitos relacionados ao trabalho registrados em 2025.</p>
        </div>

        <div class="solution">
            <i class="fa-solid fa-calendar-xmark"></i>
            <h3>106 Milhões</h3>
            <p>Dias de trabalho perdidos por acidentes entre 2016 e 2025.</p>
        </div>

    </div>

    <p class="subtitle" style="margin-top:30px; text-align: justify;">
        A NEXA utiliza visão computacional e análise de dados para auxiliar
        empresas na prevenção de acidentes, no monitoramento do uso correto
        de EPIs e na construção de ambientes de trabalho mais seguros.
    </p>

    <p style="
        margin-top:20px;
        font-size:0.9rem;
        color:#777;
        text-align:center;
    ">
        Fonte: Ministério do Trabalho e Emprego (MTE). Estudo Técnico
        "Acidentes do Trabalho no Brasil – 2016 a 2025", publicado em 2026.
    </p>

</section>

    <section class="page" id="valores_nexa">
        <h1>Missão, Visão e Valores</h1>
        <p class="subtitle">
            Os princípios que orientam a NEXA refletem nosso compromisso
            com inovação, ética e proteção da vida.
        </p>

        <div class="values">
            <div class="value">
                <i class="fa-solid fa-bullseye"></i>
                <h3>Missão</h3>
                <p>
                    Transformar a segurança do trabalho em inteligência,
                    promovendo ambientes mais seguros e eficientes.
                </p>
            </div>

            <div class="value">
                <i class="fa-solid fa-eye"></i>
                <h3>Visão</h3>
                <p>
                    Ser referência global em soluções tecnológicas de
                    segurança e compliance corporativo.
                </p>
            </div>

            <div class="value">
                <i class="fa-solid fa-scale-balanced"></i>
                <h3>Valores</h3>
                <p>
                    Ética, inovação, responsabilidade social,
                    transparência e compromisso com a vida.
                </p>
            </div>
        </div>
    </section>

    <section class="page" id="sobre_nexa">
        <h1>Sobre a NEXA</h1>

        <p class="subtitle" style="text-align: justify;">
            A NEXA nasceu para transformar a gestão da segurança do trabalho por
            meio da tecnologia, integrando visão computacional e análise de dados
            em uma única plataforma.
        </p>

        <p class="subtitle" style="text-align: justify;">
            Nossa solução conecta câmeras e recursos de monitoramento para
            identificar situações de risco, acompanhar o uso correto de EPIs
            e fornecer informações estratégicas que auxiliam gestores na tomada
            de decisões relacionadas à segurança ocupacional.
        </p>

        <div class="blocks">
            <div class="block">
                <i class="fa-solid fa-bullseye"></i>
                <h3 style="justify-content: left;">Propósito</h3>
                <p style="text-align: justify;">
                    Promover ambientes de trabalho mais seguros por meio da tecnologia e da inovação.
                </p>
        </div>

            <div class="block">
                <i class="fa-solid fa-lightbulb"></i>
                <h3 style="justify-content: left;">Inovação</h3>
                <p style="text-align: justify;">
                    Desenvolver soluções tecnológicas capazes de ampliar a eficiência operacional e fortalecer a segurança ocupacional.
                </p>
            </div>

            <div class="block">
                <i class="fa-solid fa-shield-halved"></i>
                <h3 style="justify-content: left;">Compromisso</h3>
                <p style="text-align: justify;">
                    Colocar a proteção da vida e a segurança das pessoas no centro de todas as ações.
                </p>
            </div>
        </div>
    </section>
    <section class="team-section" id="nossa_equipe">

        <h1 class="team-title">Nossa Equipe</h1>

        <div class="team-grid">

            <div class="team-card">
                <img src="<?= base_url('assets/images/ryan.jpg') ?>">
                <h3 style="justify-content: left;">Ryan Donizetti</h3>
                <p  style="justify-content: left;">Analista de Sistemas e Design</p>
            </div>

            <div class="team-card">
                <img src="<?= base_url('assets/images/laura.jpg') ?>">
                <h3>Laura Ubaldo</h3>
                <p>Analista de Sistemas e Design</p>
            </div>

            <div class="team-card">
                <img src="<?= base_url('assets/images/livia.jpg') ?>">
                <h3>Livia Bispo</h3>
                <p>Programadora Full Stack</p>
            </div>

            <div class="team-card">
                <img src="<?= base_url('assets/images/bruno.jpg') ?>">
                <h3>Bruno de Souza</h3>
                <p>Full Stack e Product Owner</p>
            </div>

            <div class="team-card">
                <img src="<?= base_url('assets/images/nicoly.jpg') ?>">
                <h3>Nicoly Gentina</h3>
                <p>Back-End e Scrum Master</p>
            </div>

            <div class="team-card">
                <img src="<?= base_url('assets/images/erick.jpg') ?>">
                <h3>Erick Ferreira</h3>
                <p>Programador Back-End</p>
            </div>

            <div class="team-card">
                <img src="<?= base_url('assets/images/fernanda.jpg') ?>">
                <h3>Fernanda Machado</h3>
                <p>Programadora Back-End</p>
            </div>

        </div>

    </section>

    <footer>
        <div class="footer-grid">

            <div>
                <h4>NEXA</h4>
                <p>Safety at the core of modern operations.</p>

                <div class="social">
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=nexa.senai@gmail.com" target="_blank">
                        <i class="fas fa-envelope"></i>
                    </a>
                    <a href="https://www.instagram.com/nexa.senai/" target="_blank" title="Nos siga no Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#"><i class="fab fa-github"></i></a>
                </div>
            </div>

            <div>
                <h4>Empresa</h4>
                <a href="#sobre_nexa">Sobre</a><br>
                <a href="#">Carreiras</a><br>
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=nexa.senai@gmail.com" target="_blank">
                    nexa.senai@gmail.com
                </a>
            </div>

            <div>
                <h4></h4>
                <a href="login.html"></a><br>
            </div>

        </div>
        <!-- CAPACETE ANIMADO -->
<!-- CAPACETE ANIMADO -->
<div class="footer-helmet" aria-hidden="true">

    <div class="impact-lines">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <i class="fa-solid fa-helmet-safety"></i>

</div>
        <!-- COPYRIGHT FORA DA GRID -->
        <div class="copy">
            <p>© 2026 Nexa | <a href="<?= base_url('/login') ?>" class="admin">Área restrita</a></p>
        </div>
    </footer>



    <script>

        function toggleAccessMenu() {
    const menu = document.getElementById("accessOptions");
    if (menu) {
        menu.classList.toggle("show");
    }
}      else {
            menu.style.display = "flex";
            menu.classList.add("show");
        }
        
        const slides = document.querySelectorAll('.carousel img');
        let index = 0;

        setInterval(() => {
            slides[index].classList.remove('active');
            index = (index + 1) % slides.length;
            slides[index].classList.add('active');
        }, 3500);

        let clicks = 0;

        document.addEventListener("DOMContentLoaded", () => {
            const logo = document.getElementById("logo");

            logo.addEventListener("click", () => {
                clicks++;
                if (clicks === 5) {
                    window.location.href = "login_adm.html";
                }
            });
        });




        const reveals = document.querySelectorAll('.reveal');

        function revealOnScroll() {
            const windowHeight = window.innerHeight;

            reveals.forEach(el => {
                const elementTop = el.getBoundingClientRect().top;

                if (elementTop < windowHeight - 100) {
                    el.classList.add('active');
                }
            });
        }

        window.addEventListener('scroll', revealOnScroll);
        window.addEventListener('load', revealOnScroll);

        function toggleSom() {
            const video = document.getElementById("videoNexa");
            const icon = document.getElementById("iconSom");

            video.muted = !video.muted;

            if (video.muted) {
                icon.classList.remove("fa-volume-up");
                icon.classList.add("fa-volume-mute");
            } else {
                icon.classList.remove("fa-volume-mute");
                icon.classList.add("fa-volume-up");
            }
        }
    </script>

    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>

   
</body>

</html>