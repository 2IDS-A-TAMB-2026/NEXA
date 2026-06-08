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

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    

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
            <p id="paragrafo_inst">
                A segurança do trabalho é responsável por reduzir acidentes, 
                preservar vidas e garantir conformidade com as normas regulamentadoras. 
                A NEXA utiliza visão computacional e análise de dados para auxiliar empresas
                no monitoramento do uso correto de EPIs em tempo real.
            </p>

            <div class="hero-buttons">
                <a href="<?= site_url('/login') ?>" class="btn-primary">Acessar Plataforma</a>
                <a href="#sobre_nexa" class="btn-secondary">Saiba Mais</a>
            </div>
        </div>

        <div class="carousel">
            <img class="active" src="<?= base_url('assets/images/slide1.jpg') ?>">
            <img src="<?= base_url('assets/images/slide2.jpg')?>">
            <img src="<?= base_url('assets/images/slide3.jpg')?>">
        </div>
    </section>

    <section class="page" id="solucoes_nexa">
        <h1>Nossas Soluções</h1>
        <p class="subtitle">
            A NEXA oferece soluções digitais integradas que garantem
            segurança, conformidade e inteligência operacional em
            ambientes corporativos e industriais.
        </p>

        <div class="solutions">
            <div class="solution">
                <i class="fa-solid fa-helmet-safety"></i>
                <h3>Monitoramento de EPIs</h3>
                <p>Detecção automática de capacetes, óculos, 
                    luvas e outros EPIs por meio de visão computacional
                    e inteligência artificial.</p>
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

        <video  id="videoNexa" autoplay muted loop playsinline>
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
        <p class="subtitle">
            A visão computacional é um campo da inteligência artificial que treina computadores para interpretar e compreender o
            mundo visual de forma semelhante aos humanos. Utilizando
            modelos de aprendizado de máquina e redes neurais profundas, 
            o sistema analisa imagens digitais, vídeos e entradas de sensores
            para identificar padrões, detectar objetos, classificar cenas e 
            até rastrear movimentos. Na NEXA, usamos a visão computacional
            para detectar o uso de EPI's pelos funcionários, aliando segurança
            e tecnologia para o benefício de todos.
        </p>
    </div>
</section>
    <!--conteudo aqui-->
    <section class="page">

    <h1>Dados da Segurança do Trabalho no Brasil</h1>

    <p class="subtitle">
        Os acidentes de trabalho continuam sendo um grande desafio para empresas e trabalhadores.
        A tecnologia tem um papel fundamental na prevenção de riscos e na proteção da vida.
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
            <p>Mortes relacionadas ao trabalho registradas em 2025.</p>
        </div>

        <div class="solution">
            <i class="fa-solid fa-calendar-xmark"></i>
            <h3>106 Milhões</h3>
            <p>Dias de trabalho perdidos por acidentes entre 2016 e 2025.</p>
        </div>

    </div>

    <p class="subtitle" style="margin-top:30px;">
        A NEXA utiliza visão computacional e inteligência artificial para auxiliar empresas na prevenção de acidentes, no monitoramento do uso correto de EPIs e na construção de ambientes de trabalho mais seguros.
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

        <p>
            A NEXA nasceu com o propósito de transformar a segurança do trabalho
            em um processo inteligente, integrado e orientado por dados.
        </p>

        <p>
           Nossa plataforma integra câmeras, inteligência artificial e análise de dados para 
           identificar situações de risco, monitorar o uso de EPIs e fornecer 
           informações que auxiliam gestores na tomada de decisões relacionadas à segurança do trabalho.
        </p>

        <div class="blocks">
            <div class="block">
                <i class="fa-solid fa-bullseye"></i>
                <h3>Propósito</h3>
                <p>Elevar o padrão da segurança do trabalho.</p>
            </div>

            <div class="block">
                <i class="fa-solid fa-lightbulb"></i>
                <h3>Inovação</h3>
                <p>Tecnologia para antecipar riscos.</p>
            </div>

            <div class="block">
                <i class="fa-solid fa-shield-halved"></i>
                <h3>Compromisso</h3>
                <p>Proteção da vida em primeiro lugar.</p>
            </div>
        </div>
    </section>
   <section class="team-section" id="nossa_equipe">

    <h1 class="team-title">Nossa Equipe</h1>

    <div class="team-grid">

        <div class="team-card">
            <img src="<?= base_url('assets/images/ryan.jpg')?>">
            <h3>Ryan Donizetti</h3>
            <p>Analista de Sistemas e Design</p>
        </div>

        <div class="team-card">
            <img src="<?= base_url('assets/images/laura.jpg')?>">
            <h3>Laura Ubaldo</h3>
            <p>Analista de Sistemas e Design</p>
        </div>

        <div class="team-card">
            <img src="<?= base_url('assets/images/livia.jpg')?>">
            <h3>Livia Bispo</h3>
            <p>Programadora Full Stack</p>
        </div>

        <div class="team-card">
            <img src="<?= base_url('assets/images/bruno.jpg')?>">
            <h3>Bruno de Souza</h3>
            <p>Full Stack e Product Owner</p>
        </div>

        <div class="team-card">
            <img src="<?= base_url('assets/images/nicoly.jpg')?>">
            <h3>Nicoly Gentina</h3>
            <p>Back-End e Scrum Master</p>
        </div>

        <div class="team-card">
            <img src="<?= base_url('assets/images/erick.jpg')?>">
            <h3>Erick Ferreira</h3>
            <p>Programador Back-End</p>
        </div>

        <div class="team-card">
            <img src="<?= base_url('assets/images/fernanda.jpg')?>">
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

        <!-- COPYRIGHT FORA DA GRID -->
        <div class="copy">
            <p>© 2026 Nexa | <a href="<?=base_url('/login')?>" class="admin">Área restrita</a></p>
            <!--login temporário, tem que fazer um controller pro admin tbm-->
        </div>
    </footer>



    <script>
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