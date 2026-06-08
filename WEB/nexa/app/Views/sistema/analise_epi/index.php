<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>NEXA | Análise EPI</title>

<!-- CSS -->
<link rel="stylesheet" href="<?= base_url('assets/css/style_funci.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/analise_epi.css') ?>">

<!-- ICONES -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    
        .sidebar-top {
            position: relative;
            height: 160px;
            background: url('<?= base_url("assets/images/slide1.jpg") ?>') center/cover;
            display: flex;
            align-items: flex-end;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }

</style>

</head>

<body>

<!-- SIDEBAR -->

<aside class="sidebar">

    <div>

        <div class="sidebar-top">
            <span>NEXA</span>
        </div>

        <nav class="menu">

            <a href="<?= base_url('dashboardfun') ?>">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>

            <a href="<?= base_url('camera_analise') ?>">
                <i class="fas fa-camera"></i>
                <span>Análise EPI</span>
            </a>

            <a href="<?= base_url('perfilfun') ?>">
                <i class="fas fa-user"></i>
                <span>Perfil</span>
            </a>

        </nav>

    </div>

    <a href="<?= base_url('/') ?>" class="logout-item">
        <i class="fas fa-sign-out-alt"></i>
        <span>Sair</span>
    </a>

</aside>

<!-- MAIN -->

<div class="main">

    <!-- CAMERA -->

    <div class="camera-wrapper">

        <div class="camera-box">

            <div class="camera-label">
                CAM 03
            </div>

            <div class="record-dot"></div>

            <video
            id="camera"
            autoplay
            playsinline
            muted>
            </video>

        </div>

        <button class="btn-analisar">

            <i class="fa-solid fa-shield-halved"></i>

            ANALISAR EPI

        </button>

        <!-- RESULTADO -->

        <div class="resultado-box" id="resultado">

            <h3 id="mensagem"></h3>

            <div class="resultado-item" id="capacete"></div>
            <div class="resultado-item" id="luva"></div>
            <div class="resultado-item" id="colete"></div>

        </div>

    </div>

</div>
<script>

let analisando = false;

/* =========================
INICIAR CAMERA
========================= */

async function iniciarCamera(){

    const video = document.getElementById('camera');

    try{

        const stream = await navigator.mediaDevices.getUserMedia({
            video: true,
            audio: false
        });

        video.srcObject = stream;

    }catch(erro){

        console.error(erro);

        alert(
            'Nome: ' + erro.name +
            '\nMensagem: ' + erro.message
        );

    }

}

/* =========================
ANÁLISE AUTOMÁTICA
========================= */

async function analisarAutomatico(){

    if(analisando){
        return;
    }

    const video = document.getElementById('camera');

    if(video.videoWidth === 0){
        return;
    }

    analisando = true;

    try{

        const canvas = document.createElement('canvas');

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        const ctx = canvas.getContext('2d');

        ctx.drawImage(video, 0, 0);

        const imagemBase64 =
        canvas.toDataURL('image/jpeg');

        const resposta = await fetch(
            '<?= base_url('camera_analise/analisar') ?>',
            {
                method:'POST',
                headers:{
                    'Content-Type':'application/json'
                },
                body:JSON.stringify({
                    imagem: imagemBase64,
                    camera: 'CAM 03'
                })
            }
        );

        const dados = await resposta.json();

        console.log(dados);

        if(dados.status){

            document.getElementById('resultado')
            .style.display = 'block';

            document.getElementById('mensagem')
            .innerHTML = dados.mensagem;

            document.getElementById('capacete')
            .innerHTML =
            dados.epis.capacete
            ? '✅ Capacete detectado'
            : '❌ Capacete ausente';

            document.getElementById('luva')
            .innerHTML =
            dados.epis.luva
            ? '✅ Luva detectada'
            : '❌ Luva ausente';

            document.getElementById('colete')
            .innerHTML =
            dados.epis.colete
            ? '✅ Colete detectado'
            : '❌ Colete ausente';

        }

    }catch(erro){

        console.error(erro);

    }

    analisando = false;

}

/* =========================
BOTÃO MANUAL
========================= */

const botao =
document.querySelector('.btn-analisar');

botao.addEventListener('click', ()=>{

    analisarAutomatico();

});

/* =========================
INICIAR SISTEMA
========================= */

iniciarCamera();

/* Analisa automaticamente a cada 3 segundos */

setInterval(
    analisarAutomatico,
    3000
);

</script>
</body>
</html>