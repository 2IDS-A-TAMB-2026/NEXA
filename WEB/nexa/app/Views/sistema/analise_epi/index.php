<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>NEXA | Análise EPI</title>

<link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/analise_epi.css') ?>">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

/* =========================================================
   RESET
========================================================= */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', Arial, sans-serif;
}

html,
body{
    width:100%;
    height:100%;
    overflow:hidden;
    background:#000;
}


/* =========================================================
   ÁREA PRINCIPAL
========================================================= */

.main{

    width:100vw;
    height:100vh;

    padding:18px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:#fff;

}


/* =========================================================
   CAMERA
========================================================= */

.camera-wrapper{

    position:relative;

    width:100%;
    height:100%;

    display:flex;
    align-items:center;
    justify-content:center;

}


/* =========================================================
   BOX DA CÂMERA
========================================================= */

.camera-box{

    position:relative;

    width:100%;
    height:100%;

    overflow:hidden;

    border-radius:22px;

    background:#050505;

    border:2px solid rgba(255,255,255,.12);

    box-shadow:
        0 15px 50px rgba(0,0,0,.55);

}


/* =========================================================
   VÍDEO
========================================================= */

#camera{

    width:100%;
    height:100%;

    display:block;

    object-fit:cover;

    background:#000;

}


/* =========================================================
   BOTÃO VOLTAR
========================================================= */

.btn-voltar{

    position:absolute;

    top:20px;
    left:20px;

    z-index:30;

    display:flex;
    align-items:center;
    gap:9px;

    padding:11px 18px;

    border:none;
    border-radius:25px;

    background:rgba(16, 101, 187, 0.94);

    color:#fff;

    font-size:15px;
    font-weight:600;

    text-decoration:none;

    cursor:pointer;

    backdrop-filter:blur(8px);

    box-shadow:
        0 5px 20px rgba(0,0,0,.3);

    transition:.2s;
}

.btn-voltar:hover{

    background:#0a66c2;

    transform:translateX(-2px);

}

.btn-voltar i{

    font-size:14px;

}


/* =========================================================
   INDICADOR DE TRANSMISSÃO
========================================================= */

.record-status{

    position:absolute;

    top:22px;
    right:22px;

    z-index:30;

    display:flex;
    align-items:center;
    gap:8px;

    padding:8px 14px;

    border-radius:20px;

    background:rgba(0,0,0,.55);

    color:#fff;

    font-size:13px;
    font-weight:600;

    backdrop-filter:blur(7px);

}

.record-dot{

    width:9px;
    height:9px;

    background:#42ff87;

    border-radius:50%;

    box-shadow:
        0 0 8px #42ff87,
        0 0 15px #42ff87;

    animation:pulse 1.2s infinite;

}

@keyframes pulse{

    0%{
        transform:scale(1);
        opacity:1;
    }

    50%{
        transform:scale(1.35);
        opacity:.6;
    }

    100%{
        transform:scale(1);
        opacity:1;
    }

}


/* =========================================================
   CARD DE RESULTADO
========================================================= */
/* =========================================
   ALERTA DE RESULTADO DA ANÁLISE
========================================= */

.resultado-box {
    position: absolute;
    right: 25px;
    bottom: 25px;

    width: 350px;
    max-height: 300px;

    padding: 18px 20px;

    background: rgba(8, 20, 32, 0.94);

    border: 2px solid #19aaed;
    border-radius: 14px;

    box-shadow:
        0 0 10px rgba(25, 170, 237, 0.35),
        0 0 30px rgba(25, 170, 237, 0.15);

    backdrop-filter: blur(8px);

    color: white;

    z-index: 20;

    animation: alertaEntrada 0.35s ease-out;
}


/* TÍTULO DO ALERTA */

.resultado-box h3 {
    display: flex;
    align-items: center;
    gap: 10px;

    margin: 0 0 14px 0;

    font-size: 16px;
    font-weight: 800;

    text-transform: uppercase;
    letter-spacing: 0.8px;

    color: #19aaed;
}


/* ÍCONE DO ALERTA */

.resultado-box h3 i {
    font-size: 20px;
}


/* CADA RESULTADO */

.resultado-item {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 12px;

    padding: 10px 12px;
    margin-bottom: 8px;

    border-radius: 8px;

    background: rgba(255, 255, 255, 0.07);

    border-left: 4px solid #19aaed;

    font-size: 14px;
}


/* TEXTO */

.resultado-item span {
    font-weight: 600;
}


/* =========================================
   DETECTADO
========================================= */

.resultado-item.detectado {
    border-left-color: #42ff87;

    background: rgba(66, 255, 135, 0.08);
}

.resultado-item.detectado i {
    color: #42ff87;
}


/* =========================================
   AUSENTE
========================================= */

.resultado-item.ausente {
    border-left-color: #ff5252;

    background: rgba(255, 82, 82, 0.10);

    animation: alertaPulso 1.5s infinite;
}

.resultado-item.ausente i {
    color: #ff5252;
}


/* =========================================
   ANIMAÇÕES
========================================= */

@keyframes alertaEntrada {

    from {
        opacity: 0;
        transform: translateY(15px) scale(0.97);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

}


@keyframes alertaPulso {

    0%, 100% {
        box-shadow: 0 0 0 rgba(255, 82, 82, 0);
    }

    50% {
        box-shadow: 0 0 14px rgba(255, 82, 82, 0.25);
    }

}
/* TÍTULO DO RESULTADO */

.resultado-box h3{

    margin:0 0 16px 0;

    font-size:20px;

    font-weight:700;

    color:#fff;

    line-height:1.3;

}


/* =========================================================
   ITENS DO RESULTADO
========================================================= */

.resultado-item{

    padding:10px 12px;

    margin-bottom:8px;

    border-radius:10px;

    background:rgba(255,255,255,.08);

    font-size:14px;

    color:#e8eef5;

}

.resultado-item:last-child{

    margin-bottom:0;

}


/* =========================================================
   BOTÃO ANALISAR
========================================================= */

.btn-analisar{

    position:absolute;

    z-index:25;

    bottom:25px;
    left:50%;

    transform:translateX(-50%);

    width:250px;
    height:52px;

    border:none;

    border-radius:30px;

    background:#0a66c2;

    color:#fff;

    font-size:16px;

    font-weight:700;

    cursor:pointer;

    display:flex;
    align-items:center;
    justify-content:center;

    gap:10px;

    box-shadow:
        0 8px 25px rgba(0,0,0,.35);

    transition:.2s;

}

.btn-analisar:hover{

    background:#084d93;

    transform:translateX(-50%) translateY(-2px);

}

.btn-analisar i{

    font-size:18px;

}

/* =========================================================
   CANVAS DA IA
========================================================= */

#overlay{

    position:absolute;

    inset:0;

    width:100%;
    height:100%;

    z-index:15;

    pointer-events:none;

}


/* =========================================================
   PAINEL DOS EPIs OBRIGATÓRIOS
========================================================= */

.epis-obrigatorios{

    position:absolute;

    top:70px;

    left:25px;

    z-index:25;

    width:300px;

    padding:18px;

    border-radius:18px;

    background:rgba(8,27,46,.94);

    border:1px solid rgba(255,255,255,.15);

    box-shadow:
        0 15px 40px rgba(0,0,0,.45);

    backdrop-filter:blur(12px);

    color:#fff;

}


.epis-obrigatorios h3{

    margin:0 0 14px 0;

    font-size:17px;

    font-weight:700;

}


.epi-obrigatorio-item{

    display:flex;

    align-items:center;

    justify-content:space-between;

    gap:10px;

    padding:10px 12px;

    margin-bottom:7px;

    border-radius:10px;

    background:rgba(255,255,255,.08);

    font-size:13px;

}


.epi-obrigatorio-item:last-child{

    margin-bottom:0;

}


.epi-nome{

    font-weight:600;

}


.epi-status{

    font-size:11px;

    font-weight:700;

    white-space:nowrap;

}


/* AGUARDANDO */

.epi-aguardando{

    color:#ffd166;

}


/* DETECTADO */

.epi-detectado{

    color:#42ff87;

}


/* AUSENTE */

.epi-ausente{

    color:#ff5c5c;

}
/* =========================================================
   RESPONSIVO
========================================================= */

@media(max-width:800px){

    .main{

        padding:8px;

    }

    .camera-box{

        border-radius:15px;

    }

    .resultado-box{

        width:calc(100% - 30px);

        right:15px;
        bottom:80px;

    }

    .btn-analisar{

        bottom:15px;

        width:220px;

    }

    .btn-voltar{

        top:15px;
        left:15px;

    
    }

    .info{

    position:absolute;
    top:100px;
    left:20px;
    z-index:30;
    background:rgba(0,0,0,.65);
    color:#fff;
    padding:10px 15px;
    border-radius:12px;
    font-size:13px;
}

}


/* =========================================================
   STATUS DA ANÁLISE CONTÍNUA
========================================================= */

.analysis-status{
    position:absolute;
    top:68px;
    right:22px;
    z-index:30;

    display:flex;
    align-items:center;
    gap:10px;

    padding:10px 16px;
    min-width:230px;

    border-radius:22px;

    background:rgba(8,20,32,.82);
    border:1px solid rgba(25,170,237,.45);

    color:#fff;
    font-size:13px;
    font-weight:700;

    backdrop-filter:blur(8px);
    box-shadow:0 8px 25px rgba(0,0,0,.25);
}

.analysis-status .status-icon{
    width:10px;
    height:10px;
    border-radius:50%;
    background:#ffd166;
    box-shadow:0 0 10px rgba(255,209,102,.8);
    flex:none;
}

.analysis-status.analisando .status-icon{
    background:#42ff87;
    box-shadow:0 0 10px rgba(66,255,135,.9);
    animation:pulse 1s infinite;
}

.analysis-status.finalizando .status-icon{
    background:#19aaed;
    box-shadow:0 0 10px rgba(25,170,237,.9);
}

.analysis-status.concluido .status-icon{
    background:#42ff87;
    box-shadow:0 0 10px rgba(66,255,135,.9);
    animation:none;
}

.analysis-status.erro .status-icon{
    background:#ff5252;
    box-shadow:0 0 10px rgba(255,82,82,.9);
    animation:none;
}

.analysis-status .status-text{
    white-space:nowrap;
}

.analysis-timer{
    margin-left:auto;
    color:#19aaed;
    font-weight:800;
}

#overlay{
    object-fit:cover;
}

</style>

</head>

<body
    data-camera-id="<?= !empty($cameras) ? $cameras[0]['ID'] : '' ?>"
>
<div class= "info">
  

    Funcionário:
    <?= esc($funcionario['NOME_COMPLETO']) ?>

    <br>

    Câmera:
    <?= !empty($cameras)
        ? esc($cameras[0]['IDENTIFICADOR_CAMERA'])
        : 'Nenhuma câmera' ?>
</div>
<!-- =========================================================
     ÁREA PRINCIPAL
========================================================= -->

<div class="main">

    <div class="camera-wrapper">


        <!-- =================================================
             CAMERA
        ================================================== -->

        <div class="camera-box">


            <!-- VOLTAR -->

            <a
                href="<?= base_url('dashboardfun') ?>"
                class="btn-voltar"
            >

                <i class="fas fa-arrow-left"></i>

                Voltar

            </a>


            <!-- STATUS -->

            <div class="record-status">

                <span class="record-dot"></span>

                Transmitindo

            </div>

            <div class="analysis-status" id="analysis-status">
                <span class="status-icon"></span>
                <span class="status-text" id="analysis-status-text">
                    Preparando análise...
                </span>
                <span class="analysis-timer" id="analysis-timer">
                    0s
                </span>
            </div>


            <!-- VÍDEO -->

            <video
                id="camera"
                autoplay
                playsinline
                muted>
            </video>

            <canvas id="overlay"></canvas>

            <div class="epis-obrigatorios" id="epis-obrigatorios">

    <h3>
        <i class="fa-solid fa-shield-halved"></i>
        EPIs OBRIGATÓRIOS
    </h3>

    <?php if (!empty($episObrigatorios)): ?>

        <?php foreach ($episObrigatorios as $epi): ?>

            <div
                class="epi-obrigatorio-item"
                data-epi="<?= esc($epi['NOME_EPI']) ?>"
            >

                <span class="epi-nome">
                    <?= esc($epi['NOME_EPI']) ?>
                </span>

                <span class="epi-status epi-aguardando">
                    AGUARDANDO
                </span>

            </div>

        <?php endforeach; ?>

    <?php else: ?>

        <div class="epi-obrigatorio-item">

            <span class="epi-nome">
                Nenhum EPI cadastrado
            </span>

        </div>

    <?php endif; ?>

</div>


            <!-- =================================================
                 RESULTADO
            ================================================== -->

           <div
    class="resultado-box"
    id="resultado"
    style="display:none;"
>
    <h3 id="mensagem"></h3>
    <div id="lista-epis"></div>
</div>


        </div>

    </div>

</div>
<script>

let analisando = false;
let monitorando = false;
let frameEmAnalise = false;

let streamCamera = null;
let intervaloMonitoramento = null;
let intervaloRelogio = null;

let inicioAnalise = 0;
const DURACAO_ANALISE = 7000;
const INTERVALO_FRAMES = 700;

let melhorFrame = null;


/* =========================================================
   ELEMENTOS
========================================================= */

function obterElemento(id){
    return document.getElementById(id);
}


/* =========================================================
   STATUS VISUAL
========================================================= */

function atualizarStatusAnalise(tipo, texto, tempo = null){

    const status = obterElemento('analysis-status');
    const textoElemento = obterElemento('analysis-status-text');
    const timer = obterElemento('analysis-timer');

    if (!status || !textoElemento) {
        return;
    }

    status.classList.remove(
        'analisando',
        'finalizando',
        'concluido',
        'erro'
    );

    if (tipo) {
        status.classList.add(tipo);
    }

    textoElemento.textContent = texto;

    if (timer) {
        timer.textContent =
            tempo !== null
                ? `${tempo}s`
                : '';
    }
}


/* =========================================================
   INICIAR CÂMERA
========================================================= */

async function iniciarCamera(){

    const video = obterElemento('camera');

    try {

        if (
            !navigator.mediaDevices ||
            !navigator.mediaDevices.getUserMedia
        ) {
            throw new Error(
                'Seu navegador não permite acesso à câmera.'
            );
        }

        streamCamera =
            await navigator.mediaDevices.getUserMedia({

                video: {
                    facingMode: 'user',

                    width: {
                        ideal: 1280
                    },

                    height: {
                        ideal: 720
                    }
                },

                audio: false
            });

        video.srcObject = streamCamera;

        await video.play();

        atualizarStatusAnalise(
            '',
            'Câmera pronta. Iniciando...',
            0
        );

        /*
         * Dá um pequeno tempo para o vídeo estabilizar antes
         * de começar a enviar os frames.
         */
        setTimeout(function(){

            if (
                video.readyState >= 2 &&
                video.videoWidth > 0 &&
                video.videoHeight > 0
            ) {
                iniciarAnaliseContinua();
            }

        }, 500);

    } catch (erro) {

        console.error(
            'Erro ao iniciar câmera:',
            erro
        );

        atualizarStatusAnalise(
            'erro',
            'Câmera indisponível',
            ''
        );

        const status =
            document.querySelector('.record-status');

        if (status) {

            status.innerHTML = `
                <span style="
                    width:9px;
                    height:9px;
                    background:#ff4444;
                    border-radius:50%;
                    display:inline-block;
                "></span>
                Câmera indisponível
            `;
        }

        if (typeof Swal !== 'undefined') {

            Swal.fire({
                icon: 'error',
                title: 'Câmera não disponível',
                text:
                    'Permita o acesso à câmera no navegador para utilizar a análise de EPI.',
                confirmButtonColor: '#0a66c2'
            });
        }
    }
}


/* =========================================================
   CAPTURAR FRAME DA CÂMERA
========================================================= */

function capturarFrame(){

    const video = obterElemento('camera');

    if (
        !video ||
        video.readyState < 2 ||
        !video.videoWidth ||
        !video.videoHeight
    ) {
        return null;
    }

    const canvas =
        document.createElement('canvas');

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    const ctx =
        canvas.getContext('2d', {
            alpha: false
        });

    if (!ctx) {
        return null;
    }

    ctx.drawImage(
        video,
        0,
        0,
        canvas.width,
        canvas.height
    );

    return canvas.toDataURL(
        'image/jpeg',
        0.82
    );
}


/* =========================================================
   ENVIAR FRAME PARA O BACKEND
========================================================= */

async function enviarFrame(imagem, modo){

    const cameraId =
        document.body.dataset.cameraId;

    if (!cameraId || !imagem) {
        throw new Error(
            'Câmera ou imagem não disponível.'
        );
    }

    const resposta =
        await fetch(
            '<?= base_url('camera_analise/analisar') ?>',
            {
                method: 'POST',

                headers: {
                    'Content-Type':
                        'application/json',

                    'Accept':
                        'application/json'
                },

                body: JSON.stringify({

                    imagem: imagem,

                    camera_id: cameraId,

                    modo: modo
                })
            }
        );

    const textoResposta =
        await resposta.text();

    if (!resposta.ok) {

        throw new Error(
            `Erro HTTP ${resposta.status}: ${textoResposta}`
        );
    }

    let dados;

    try {

        dados =
            JSON.parse(textoResposta);

    } catch (erroJSON) {

        throw new Error(
            'O servidor retornou uma resposta que não é um JSON válido.'
        );
    }

    if (!dados.status) {

        throw new Error(
            dados.mensagem ||
            'Não foi possível realizar a análise.'
        );
    }

    return dados;
}


/* =========================================================
   CALCULAR QUALIDADE DO FRAME
========================================================= */

function calcularQualidadeFrame(epis){

    if (!Array.isArray(epis) || !epis.length) {
        return 0;
    }

    let detectados = 0;
    let pontuacao = 0;

    epis.forEach(function(epi){

        if (epi.detectado === true) {

            detectados++;

            const d =
                epi.deteccao || {};

            const confianca =
                Number(
                    d.confianca || 0
                );

            const score =
                Number(
                    d.pontuacao || 0
                );

            pontuacao +=
                (confianca * 100) +
                score;
        }
    });

    /*
     * Cobertura dos EPIs tem prioridade.
     * Depois usamos confiança/pontuação para desempatar.
     */
    return (
        detectados * 10000
    ) + pontuacao;
}


/* =========================================================
   GUARDAR MELHOR FRAME
========================================================= */

function guardarMelhorFrame(imagem, dados){

    const epis =
        Array.isArray(dados.epis)
            ? dados.epis
            : [];

    const qualidade =
        calcularQualidadeFrame(epis);

    if (
        !melhorFrame ||
        qualidade > melhorFrame.qualidade
    ) {

        melhorFrame = {

            imagem: imagem,

            dados: dados,

            qualidade: qualidade
        };

        console.log(
            'NEXA - novo melhor frame:',
            melhorFrame
        );
    }
}


/* =========================================================
   ANÁLISE CONTÍNUA
========================================================= */

function iniciarAnaliseContinua(){

    if (monitorando || analisando) {
        return;
    }

    monitorando = true;
    analisando = true;

    melhorFrame = null;
    inicioAnalise = Date.now();

    limparOverlay();

    atualizarStatusAnalise(
        'analisando',
        'Analisando câmera ao vivo...',
        0
    );

    /*
     * Primeiro frame imediatamente.
     */
    analisarFrameMonitoramento();

    intervaloMonitoramento =
        setInterval(
            analisarFrameMonitoramento,
            INTERVALO_FRAMES
        );

    intervaloRelogio =
        setInterval(
            atualizarRelogioAnalise,
            250
        );
}


/* =========================================================
   RELÓGIO DOS 7 SEGUNDOS
========================================================= */

function atualizarRelogioAnalise(){

    if (!monitorando) {
        return;
    }

    const decorrido =
        Date.now() - inicioAnalise;

    const segundos =
        Math.min(
            7,
            Math.floor(decorrido / 1000)
        );

    atualizarStatusAnalise(
        'analisando',
        'Analisando câmera ao vivo...',
        segundos
    );

    if (decorrido >= DURACAO_ANALISE) {

        pararMonitoramento();

        finalizarAnalise();
    }
}


/* =========================================================
   PARAR MONITORAMENTO
========================================================= */

function pararMonitoramento(){

    monitorando = false;

    if (intervaloMonitoramento) {

        clearInterval(
            intervaloMonitoramento
        );

        intervaloMonitoramento = null;
    }

    if (intervaloRelogio) {

        clearInterval(
            intervaloRelogio
        );

        intervaloRelogio = null;
    }
}


/* =========================================================
   ANALISAR FRAME DURANTE OS 7 SEGUNDOS
========================================================= */

async function analisarFrameMonitoramento(){

    if (
        !monitorando ||
        frameEmAnalise
    ) {
        return;
    }

    const tempoDecorrido =
        Date.now() - inicioAnalise;

    if (tempoDecorrido >= DURACAO_ANALISE) {
        return;
    }

    const imagem =
        capturarFrame();

    if (!imagem) {
        return;
    }

    frameEmAnalise = true;

    try {

        const dados =
            await enviarFrame(
                imagem,
                'monitoramento'
            );

        if (!monitorando) {
            return;
        }

        /*
         * O quadrado é atualizado a cada frame que chega.
         */
        desenharDeteccoes(
            Array.isArray(dados.epis)
                ? dados.epis
                : []
        );

        atualizarListaEpis(
            Array.isArray(dados.epis)
                ? dados.epis
                : [],
            false
        );

        guardarMelhorFrame(
            imagem,
            dados
        );

    } catch (erro) {

        /*
         * Erros momentâneos durante o monitoramento não
         * encerram a câmera. Apenas ficam no console.
         */
        console.warn(
            'NEXA - falha momentânea no frame:',
            erro.message
        );

    } finally {

        frameEmAnalise = false;
    }
}


/* =========================================================
   ANÁLISE FINAL
========================================================= */

async function finalizarAnalise(){

    analisando = true;

    atualizarStatusAnalise(
        'finalizando',
        'Consolidando análise final...',
        7
    );

    /*
     * Se o último frame ainda estiver chegando, espera um
     * pouco para aproveitar a melhor detecção possível.
     */
    const limiteEspera =
        Date.now() + 4000;

    while (
        frameEmAnalise &&
        Date.now() < limiteEspera
    ) {

        await new Promise(function(resolve){
            setTimeout(resolve, 100);
        });
    }

    let imagemFinal =
        melhorFrame
            ? melhorFrame.imagem
            : capturarFrame();

    if (!imagemFinal) {

        analisando = false;

        atualizarStatusAnalise(
            'erro',
            'Não foi possível capturar a imagem final.',
            ''
        );

        return;
    }

    try {

        /*
         * IMPORTANTE:
         * somente o modo "final" pode gerar ocorrência.
         */
        const dados =
            await enviarFrame(
                imagemFinal,
                'final'
            );

        console.log(
            'NEXA - ANÁLISE FINAL:',
            dados
        );

        atualizarListaEpis(
            Array.isArray(dados.epis)
                ? dados.epis
                : [],
            true
        );

        desenharDeteccoes(
            Array.isArray(dados.epis)
                ? dados.epis
                : []
        );

        mostrarResultadoFinal(
            dados
        );

        atualizarStatusAnalise(
            'concluido',
            'Análise concluída',
            7
        );

        /*
         * Mantém o resultado visível por 4 segundos.
         * Depois encerra a câmera e desloga o funcionário.
         */
        setTimeout(function(){

            encerrarSessao();

        }, 4000);

    } catch (erro) {

        console.error(
            'Erro na análise final:',
            erro
        );

        atualizarStatusAnalise(
            'erro',
            'Erro na análise final',
            ''
        );

        if (typeof Swal !== 'undefined') {

            Swal.fire({
                icon: 'error',
                title: 'Erro na análise',
                text:
                    erro.message ||
                    'Não foi possível realizar a análise final.',
                confirmButtonColor: '#0a66c2'
            });
        }

    } finally {

        analisando = false;
    }
}


/* =========================================================
   MOSTRAR RESULTADO FINAL
========================================================= */

function mostrarResultadoFinal(dados){

    const resultado =
        obterElemento('resultado');

    const mensagem =
        obterElemento('mensagem');

    const lista =
        obterElemento('lista-epis');

    if (!resultado || !mensagem || !lista) {
        return;
    }

    resultado.style.display =
        'block';

    lista.innerHTML = '';

    const epis =
        Array.isArray(dados.epis)
            ? dados.epis
            : [];

    if (!epis.length) {

        mensagem.textContent =
            '⚠️ Nenhum EPI cadastrado';

        lista.innerHTML = `
            <div class="resultado-item">
                Nenhum EPI foi cadastrado para este funcionário.
            </div>
        `;

        return;
    }

    const detectados =
        epis.filter(function(epi){
            return epi.detectado === true;
        });

    const ausentes =
        epis.filter(function(epi){
            return epi.detectado !== true;
        });

    if (ausentes.length > 0) {

        mensagem.textContent =
            '⚠️ Violação de EPI';

    } else {

        mensagem.textContent =
            '✅ Todos os EPIs estão corretos';
    }

    detectados.forEach(function(epi){

        const item =
            document.createElement('div');

        item.className =
            'resultado-item detectado';

        item.textContent =
            `✅ ${epi.nome} detectado`;

        lista.appendChild(item);
    });

    ausentes.forEach(function(epi){

        const item =
            document.createElement('div');

        item.className =
            'resultado-item ausente';

        item.textContent =
            `❌ ${epi.nome} ausente`;

        lista.appendChild(item);
    });

    if (dados.ocorrencia) {

        console.log(
            'NEXA - ocorrência criada:',
            dados.ocorrencia
        );
    }
}


/* =========================================================
   ATUALIZAR LISTA DE EPIs
========================================================= */

function normalizarEpiFrontend(nome){

    return String(nome || '')
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .trim();
}


function atualizarListaEpis(epis, resultadoFinal){

    const itens =
        document.querySelectorAll(
            '.epi-obrigatorio-item[data-epi]'
        );

    itens.forEach(function(item){

        const nomeItem =
            normalizarEpiFrontend(
                item.dataset.epi
            );

        const epi =
            Array.isArray(epis)
                ? epis.find(function(e){
                    return (
                        normalizarEpiFrontend(e.nome)
                        ===
                        nomeItem
                    );
                })
                : null;

        if (!epi) {
            return;
        }

        const status =
            item.querySelector('.epi-status');

        if (!status) {
            return;
        }

        status.classList.remove(
            'epi-aguardando',
            'epi-detectado',
            'epi-ausente'
        );

        if (resultadoFinal) {

            if (epi.detectado === true) {

                status.textContent =
                    '✓ DETECTADO';

                status.classList.add(
                    'epi-detectado'
                );

            } else {

                status.textContent =
                    '✕ AUSENTE';

                status.classList.add(
                    'epi-ausente'
                );
            }

        } else {

            if (epi.detectado === true) {

                status.textContent =
                    '✓ DETECTADO';

                status.classList.add(
                    'epi-detectado'
                );

            } else {

                status.textContent =
                    'ANALISANDO';

                status.classList.add(
                    'epi-aguardando'
                );
            }
        }
    });
}


/* =========================================================
   LIMPAR OVERLAY
========================================================= */

function limparOverlay(){

    const canvas =
        obterElemento('overlay');

    if (!canvas) {
        return;
    }

    const ctx =
        canvas.getContext('2d');

    if (!ctx) {
        return;
    }

    ctx.clearRect(
        0,
        0,
        canvas.width,
        canvas.height
    );
}


/* =========================================================
   DESENHAR DETECÇÕES AO VIVO
========================================================= */

function desenharDeteccoes(epis){

    const video =
        obterElemento('camera');

    const canvas =
        obterElemento('overlay');

    if (!video || !canvas) {
        return;
    }

    if (
        !video.videoWidth ||
        !video.videoHeight
    ) {
        return;
    }

    /*
     * O canvas usa exatamente a mesma proporção da câmera.
     * Como o CSS aplica object-fit: cover tanto no vídeo
     * quanto no canvas, o recorte fica alinhado.
     */
    canvas.width =
        video.videoWidth;

    canvas.height =
        video.videoHeight;

    const ctx =
        canvas.getContext('2d');

    if (!ctx) {
        return;
    }

    ctx.clearRect(
        0,
        0,
        canvas.width,
        canvas.height
    );

    if (!Array.isArray(epis)) {
        return;
    }

    epis.forEach(function(epi){

        if (
            !epi.detectado ||
            !epi.deteccao
        ) {
            return;
        }

        const d =
            epi.deteccao;

        const x =
            Number(d.x || 0);

        const y =
            Number(d.y || 0);

        const width =
            Number(d.width || 0);

        const height =
            Number(d.height || 0);

        if (
            width <= 0 ||
            height <= 0
        ) {
            return;
        }

        /*
         * Quadrado verde acompanha a posição enviada
         * pelo Roboflow em cada novo frame.
         */
        ctx.save();

        ctx.strokeStyle =
            '#42ff87';

        ctx.lineWidth =
            Math.max(
                4,
                canvas.width / 300
            );

        ctx.shadowColor =
            '#42ff87';

        ctx.shadowBlur =
            12;

        ctx.strokeRect(
            x - width / 2,
            y - height / 2,
            width,
            height
        );

        ctx.restore();

        const confianca =
            Number(
                d.confianca || 0
            );

        const porcentagem =
            Math.round(
                confianca * 100
            );

        const texto =
            `${epi.nome} ${porcentagem}%`;

        ctx.font =
            'bold 18px Arial';

        const medida =
            ctx.measureText(texto);

        const larguraTexto =
            medida.width + 20;

        const alturaTexto =
            34;

        const labelX =
            x - width / 2;

        const labelY =
            Math.max(
                5,
                y - height / 2 - alturaTexto
            );

        ctx.fillStyle =
            'rgba(0,0,0,.78)';

        ctx.fillRect(
            labelX,
            labelY,
            larguraTexto,
            alturaTexto
        );

        ctx.fillStyle =
            '#42ff87';

        ctx.fillText(
            texto,
            labelX + 10,
            labelY + 23
        );
    });
}


/* =========================================================
   INICIALIZAÇÃO
========================================================= */

document.addEventListener(
    'DOMContentLoaded',
    function(){

        /*
         * Não existe mais botão para iniciar a análise.
         * A análise começa automaticamente assim que o vídeo
         * estiver disponível.
         */
        iniciarCamera();
    }
);


/* =========================================================
   ENCERRAR CÂMERA AO SAIR DA PÁGINA
========================================================= */

window.addEventListener(
    'beforeunload',
    function(){

        pararMonitoramento();

        if (streamCamera) {

            streamCamera
                .getTracks()
                .forEach(function(track){
                    track.stop();
                });
        }
    }
);


/* =========================================================
   ENCERRAR SESSÃO APÓS A ANÁLISE FINAL
========================================================= */

function encerrarSessao(){

    pararMonitoramento();

    if (streamCamera) {

        streamCamera
            .getTracks()
            .forEach(function(track){
                track.stop();
            });

        streamCamera = null;
    }

    const video =
        obterElemento('camera');

    if (video) {
        video.pause();
        video.srcObject = null;
    }

    window.location.href =
        '<?= base_url('logoutfun') ?>';
}

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>