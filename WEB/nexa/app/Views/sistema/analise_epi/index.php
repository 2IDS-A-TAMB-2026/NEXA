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

.resultado-box{

    position:absolute;

    z-index:20;

    right:25px;
    bottom:25px;

    width:330px;

    padding:22px;

    border-radius:20px;

    background:rgba(8,27,46,.94);

    border:1px solid rgba(255,255,255,.15);

    color:#fff;

    box-shadow:
        0 15px 40px rgba(0,0,0,.5);

    backdrop-filter:blur(12px);

    display:none;

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

        streamCamera = await navigator.mediaDevices.getUserMedia({

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

        console.log('Câmera iniciada com sucesso.');

    } catch (erro) {

        console.error(
            'Erro ao iniciar câmera:',
            erro
        );

        document.querySelector(
            '.record-status'
        ).innerHTML = `

            <span style="
                width:9px;
                height:9px;
                background:#ff4444;
                border-radius:50%;
                display:inline-block;
            "></span>

            Câmera indisponível

        `;


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
   ANÁLISE
========================================================= */

async function analisarAutomatico() {

    if (analisando) {
        return;
    }


    const video =
        document.getElementById('camera');


    /*
     * Verifica se a câmera está pronta.
     */

    if (
        !video.srcObject ||
        video.readyState < 2 ||
        video.videoWidth === 0 ||
        video.videoHeight === 0
    ) {

        console.log(
            'Câmera ainda não está pronta.'
        );

        return;
    }


    /*
     * Pega a câmera definida pelo backend.
     */

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


    try {

        /* =====================================================
           CRIAR IMAGEM DA CÂMERA
        ===================================================== */

        const canvas =
            document.createElement('canvas');


        canvas.width =
            video.videoWidth;


        canvas.height =
            video.videoHeight;


        const ctx =
            canvas.getContext('2d');


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
           VERIFICAR RESPOSTA
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


        const dados =
            JSON.parse(textoResposta);


        console.log(
            'Dados da IA:',
            dados
        );


        /* =====================================================
           MOSTRAR RESULTADO
        ===================================================== */

        if (dados.status) {

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


            resultado.style.display =
                'block';


            mensagem.textContent =
                dados.mensagem ||
                'Resultado da análise';


            /*
             * Limpa resultados anteriores.
             */

            lista.innerHTML = '';


            /*
             * EPIs retornados pelo backend.
             *
             * Exemplo:
             *
             * [
             *   {
             *      nome: "Capacete",
             *      detectado: true
             *   },
             *
             *   {
             *      nome: "Luva",
             *      detectado: false
             *   }
             * ]
             */

            const epis =
                Array.isArray(dados.epis)
                    ? dados.epis
                    : [];


            if (epis.length === 0) {

                lista.innerHTML = `

                    <div class="resultado-item">
                        Nenhum EPI cadastrado para análise.
                    </div>

                `;

            } else {

                epis.forEach(function(epi) {

                    const item =
                        document.createElement(
                            'div'
                        );


                    item.className =
                        'resultado-item';


                    if (epi.detectado) {

                        item.textContent =
                            `✅ ${epi.nome} detectado`;

                    } else {

                        item.textContent =
                            `❌ ${epi.nome} ausente`;

                    }


                    lista.appendChild(item);

                });

            }


            /*
             * Mostra também informações da ocorrência
             * no console para conferência.
             */

            if (dados.ocorrencia) {

                console.log(
                    'Ocorrência:',
                    dados.ocorrencia
                );

            }


            /*
             * Mostra funcionário e câmera
             * identificados pelo backend.
             */

            if (dados.funcionario) {

                console.log(
                    'Funcionário:',
                    dados.funcionario.nome
                );

            }


            if (dados.camera) {

                console.log(
                    'Câmera:',
                    dados.camera.identificador
                );

            }

        }

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

    }

}


/* =========================================================
   BOTÃO MANUAL
========================================================= */

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


/* =========================================================
   INICIAR SISTEMA
========================================================= */

document.addEventListener(
    'DOMContentLoaded',
    function() {

        iniciarCamera();

    }
);


/* =========================================================
   ANÁLISE AUTOMÁTICA
========================================================= */

setInterval(

    analisarAutomatico,

    3000

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

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>