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
>
    <h3 id="mensagem"></h3>

    <div id="lista-epis"></div>
</div>

                <h3 id="mensagem"></h3>

                <div
                    class="resultado-item"
                    id="capacete">
                </div>

                <div
                    class="resultado-item"
                    id="luva">
                </div>

                <div
                    class="resultado-item"
                    id="oculos">
                </div>

            </div>


            <!-- =================================================
                 BOTÃO ANALISAR
            ================================================== -->

            <button class="btn-analisar">

                <i class="fa-solid fa-shield-halved"></i>

                ANALISAR EPI

            </button>


        </div>

    </div>

</div>
<script>

let analisando = false;
let streamCamera = null;


/* =========================================================
   INICIAR CÂMERA
========================================================= */

async function iniciarCamera() {

    const video = document.getElementById('camera');

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


        console.log(
            'Câmera iniciada com sucesso.'
        );


    } catch (erro) {

        console.error(
            'Erro ao iniciar câmera:',
            erro
        );


        const status =
            document.querySelector(
                '.record-status'
            );


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


        Swal.fire({

            icon: 'error',

            title: 'Câmera não disponível',

            text:
                'Permita o acesso à câmera no navegador para utilizar a análise de EPI.',

            confirmButtonColor: '#0a66c2'

        });

    }

}


/* =========================================================
   ANALISAR EPI
========================================================= */

async function analisarAutomatico() {

    /* Evita duas análises ao mesmo tempo */

    if (analisando) {

        return;

    }


    const video =
        document.getElementById('camera');


    /* =====================================================
       VERIFICAR CÂMERA
    ===================================================== */

    if (
        !video ||
        !video.srcObject ||
        video.readyState < 2 ||
        video.videoWidth === 0 ||
        video.videoHeight === 0
    ) {

        Swal.fire({

            icon: 'warning',

            title: 'Câmera não está pronta',

            text:
                'Aguarde a câmera carregar antes de realizar a análise.',

            confirmButtonColor: '#0a66c2'

        });

        return;

    }


    /* =====================================================
       PEGAR ID DA CÂMERA
    ===================================================== */

    const cameraId =
        document.body.dataset.cameraId;


    if (!cameraId) {

        Swal.fire({

            icon: 'warning',

            title: 'Câmera não encontrada',

            text:
                'Não existe uma câmera cadastrada para o setor deste funcionário.',

            confirmButtonColor: '#0a66c2'

        });

        return;

    }


    analisando = true;


    /* =====================================================
       ALTERAR BOTÃO
    ===================================================== */

    const botao =
        document.querySelector(
            '.btn-analisar'
        );


    const textoOriginal =
        botao
            ? botao.innerHTML
            : '';


    if (botao) {

        botao.disabled = true;

        botao.innerHTML = `

            <i class="fa-solid fa-spinner fa-spin"></i>

            ANALISANDO...

        `;

    }


    try {


        /* =====================================================
           CRIAR IMAGEM DA CÂMERA
        ===================================================== */

        const canvas =
            document.createElement(
                'canvas'
            );


        canvas.width =
            video.videoWidth;


        canvas.height =
            video.videoHeight;


        const ctx =
            canvas.getContext(
                '2d'
            );


        ctx.drawImage(

            video,

            0,
            0,

            canvas.width,
            canvas.height

        );


        const imagemBase64 =
            canvas.toDataURL(

                'image/jpeg',

                0.85

            );


        /* =====================================================
           ENVIAR PARA O BACKEND
        ===================================================== */

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

                        imagem:
                            imagemBase64,

                        camera_id:
                            cameraId

                    })

                }

            );


        /* =====================================================
           LER RESPOSTA
        ===================================================== */

        const textoResposta =
            await resposta.text();


        console.log(
            'Resposta do servidor:',
            textoResposta
        );


        if (!resposta.ok) {

            throw new Error(

                `Erro HTTP ${resposta.status}: ${textoResposta}`

            );

        }


        let dados;


        try {

            dados =
                JSON.parse(
                    textoResposta
                );

        } catch (erroJSON) {

            throw new Error(
                'O servidor retornou uma resposta que não é um JSON válido.'
            );

        }


        console.log(
            'Dados da IA:',
            dados
        );


        /* =====================================================
           VERIFICAR STATUS
        ===================================================== */

        if (!dados.status) {

            throw new Error(

                dados.mensagem ||
                'Não foi possível realizar a análise.'

            );

        }


        /* =====================================================
           PEGAR ELEMENTOS DO RESULTADO
        ===================================================== */

        const resultado =
            document.getElementById(
                'resultado'
            );


        const mensagem =
            document.getElementById(
                'mensagem'
            );


        const lista =
            document.getElementById(
                'lista-epis'
            );


        /* =====================================================
           VERIFICAR ELEMENTOS
        ===================================================== */

        if (!resultado) {

            throw new Error(
                'Elemento #resultado não encontrado no HTML.'
            );

        }


        if (!mensagem) {

            throw new Error(
                'Elemento #mensagem não encontrado no HTML.'
            );

        }


        if (!lista) {

            throw new Error(
                'Elemento #lista-epis não encontrado no HTML.'
            );

        }


        /* =====================================================
           MOSTRAR CARD
        ===================================================== */

        resultado.style.display =
            'block';


        /* =====================================================
           LIMPAR RESULTADO ANTERIOR
        ===================================================== */

        lista.innerHTML = '';


        /* =====================================================
           PEGAR EPIs
        ===================================================== */

        const epis =
            Array.isArray(dados.epis)
                ? dados.epis
                : [];

        atualizarListaEpis(epis);
        desenharDeteccoes(epis);


        /* =====================================================
           NENHUM EPI CADASTRADO
        ===================================================== */

        if (epis.length === 0) {

            mensagem.textContent =
                '⚠️ Nenhum EPI cadastrado';


            lista.innerHTML = `

                <div class="resultado-item">

                    Nenhum EPI foi cadastrado para este funcionário.

                </div>

            `;

            return;

        }


        /* =====================================================
           SEPARAR DETECTADOS E AUSENTES
        ===================================================== */

        const detectados =
            epis.filter(function(epi) {

                return epi.detectado === true;

            });


        const ausentes =
            epis.filter(function(epi) {

                return epi.detectado !== true;

            });


        /* =====================================================
           DEFINIR TÍTULO
        ===================================================== */

        if (ausentes.length > 0) {

            mensagem.textContent =
                '⚠️ Violação de EPI';

        } else {

            mensagem.textContent =
                '✅ Todos os EPIs estão corretos';

        }


        /* =====================================================
           MOSTRAR DETECTADOS
        ===================================================== */

        if (detectados.length > 0) {

            detectados.forEach(function(epi) {

                const item =
                    document.createElement(
                        'div'
                    );


                item.className =
                    'resultado-item';


                item.textContent =
                    `✅ ${epi.nome} detectado`;


                lista.appendChild(
                    item
                );

            });

        }


        /* =====================================================
           MOSTRAR AUSENTES
        ===================================================== */

        if (ausentes.length > 0) {

            ausentes.forEach(function(epi) {

                const item =
                    document.createElement(
                        'div'
                    );


                item.className =
                    'resultado-item';


                item.textContent =
                    `❌ ${epi.nome} ausente`;


                lista.appendChild(
                    item
                );

            });

        }


        /* =====================================================
           LOG DA OCORRÊNCIA
        ===================================================== */

        if (dados.ocorrencia) {

            console.log(
                'Ocorrência:',
                dados.ocorrencia
            );

        }


        /* =====================================================
           LOG DO FUNCIONÁRIO
        ===================================================== */

        if (dados.funcionario) {

            console.log(

                'Funcionário:',
                dados.funcionario.nome

            );

        }


        /* =====================================================
           LOG DA CÂMERA
        ===================================================== */

        if (dados.camera) {

            console.log(

                'Câmera:',
                dados.camera.identificador

            );

        }

/* =====================================================
   ENCERRAR SESSÃO APÓS 2 SEGUNDOS
===================================================== */

setTimeout(function() {

    encerrarSessao();

}, 2000);


    } catch (erro) {

        console.error(
            'Erro durante análise:',
            erro
        );


        Swal.fire({

            icon: 'error',

            title: 'Erro na análise',

            text:
                erro.message ||
                'Não foi possível realizar a análise.',

            confirmButtonColor: '#0a66c2'

        });


    } finally {

        analisando = false;


        /* =====================================================
           RESTAURAR BOTÃO
        ===================================================== */

        if (botao) {

            botao.disabled = false;

            botao.innerHTML =
                textoOriginal ||
                `

                    <i class="fa-solid fa-shield-halved"></i>

                    ANALISAR EPI

                `;

        }

    }

}


/* =========================================================
   BOTÃO ANALISAR
========================================================= */

document.addEventListener(
    'DOMContentLoaded',
    function() {

        const botao =
            document.querySelector(
                '.btn-analisar'
            );


        if (botao) {

            botao.addEventListener(
                'click',
                function() {

                    analisarAutomatico();

                }
            );

        }


        /* Inicia a câmera */

        iniciarCamera();

    }
);


/* =========================================================
   ENCERRAR CÂMERA
========================================================= */

window.addEventListener(
    'beforeunload',
    function() {

        if (streamCamera) {

            streamCamera
                .getTracks()
                .forEach(function(track) {

                    track.stop();

                });

        }

    }
);


function normalizarEpiFrontend(nome) {

    return String(nome || '')
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .trim();

}


function atualizarListaEpis(epis) {

    const itens =
        document.querySelectorAll(
            '.epi-obrigatorio-item[data-epi]'
        );


    itens.forEach(function(item) {

        const nomeItem =
            normalizarEpiFrontend(
                item.dataset.epi
            );


        const epi =
            epis.find(function(e) {

                return (
                    normalizarEpiFrontend(e.nome)
                    ===
                    nomeItem
                );

            });


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

    });

}


function limparOverlay() {

    const canvas =
        document.getElementById('overlay');

    if (!canvas) {
        return;
    }

    const ctx =
        canvas.getContext('2d');

    ctx.clearRect(
        0,
        0,
        canvas.width,
        canvas.height
    );

}


function desenharDeteccoes(epis) {

    const video =
        document.getElementById('camera');

    const canvas =
        document.getElementById('overlay');


    if (!video || !canvas) {
        return;
    }


    if (
        !video.videoWidth ||
        !video.videoHeight
    ) {
        return;
    }


    canvas.width =
        video.videoWidth;

    canvas.height =
        video.videoHeight;


    const ctx =
        canvas.getContext('2d');


    ctx.clearRect(
        0,
        0,
        canvas.width,
        canvas.height
    );


    epis.forEach(function(epi) {

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
         * =====================================================
         * CONTORNO VERDE
         * =====================================================
         */

        ctx.strokeStyle =
            '#42ff87';

        ctx.lineWidth =
            5;

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


        ctx.shadowBlur =
            0;


        /*
         * =====================================================
         * NOME + CONFIANÇA
         * =====================================================
         */

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
            'rgba(0,0,0,.75)';


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
   FECHAR CÂMERA APÓS 2 SEGUNDOS
========================================================= */

function fecharCamera() {

    if (streamCamera) {

        streamCamera
            .getTracks()
            .forEach(function(track) {

                track.stop();

            });

        streamCamera = null;

    }

    const video = document.getElementById('camera');

    if (video) {

        video.pause();

        video.srcObject = null;

    }

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

            Câmera encerrada

        `;

    }

    console.log('Câmera encerrada após 2 segundos.');

}

/* =========================================================
   ENCERRAR SESSÃO E VOLTAR PARA LOGIN
========================================================= */

function encerrarSessao() {

    // Para a câmera antes de sair
    if (streamCamera) {

        streamCamera
            .getTracks()
            .forEach(function(track) {

                track.stop();

            });

        streamCamera = null;

    }

    // Redireciona para o logout do funcionário
    window.location.href =
        '<?= base_url('logoutfun') ?>';

}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>