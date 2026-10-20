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

    padding:0;

    display:flex;
    align-items:center;
    justify-content:center;

    background:#000;

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

    border-radius:0;

    background:#050505;

    border:0;

    box-shadow:none;

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

/* MASCOTE 3D + PAINEL DE STATUS DOS EPIs */
.mascote-epi{position:absolute;left:24px;bottom:22px;z-index:24;width:220px;padding:13px 12px 11px;border-radius:20px;background:linear-gradient(145deg,rgba(9,35,59,.97),rgba(2,12,26,.94));border:1px solid rgba(65,174,255,.55);box-shadow:0 18px 42px rgba(0,0,0,.42),inset 0 1px 0 rgba(255,255,255,.12);color:#fff;backdrop-filter:blur(14px);text-align:center;overflow:hidden}
.mascote-epi:before{content:"";position:absolute;inset:0 0 auto;height:3px;background:linear-gradient(90deg,#16a3ff,#42ff87,#16a3ff)}
.mascote-titulo{position:relative;font-size:11px;font-weight:900;letter-spacing:1.2px;margin:2px 0 4px;color:#d9efff;text-shadow:0 0 12px rgba(25,170,237,.3)}
.mascote-subtitulo{font-size:9px;color:#8fb7d5;margin-bottom:2px}
.mascote-figura-wrap{position:relative;width:100%;height:260px;max-width:100%;margin:0 auto;overflow:visible}
.mascote-svg{position:relative;display:block;width:100%;height:100%;object-fit:contain;overflow:visible;filter:drop-shadow(0 12px 10px rgba(0,0,0,.3))}
.mascote-ppe-overlay{position:absolute;inset:0;width:100%;height:100%;pointer-events:none;overflow:visible}
.ppe-highlight{display:none;fill:rgba(34,229,139,.54);stroke:#22e58b;stroke-width:12;stroke-linejoin:round;filter:drop-shadow(0 0 18px rgba(34,229,139,.95));transition:fill .25s,stroke .25s,opacity .25s}
.ppe-highlight.ppe-registrado{display:block;fill:rgba(255,255,255,.04);stroke:rgba(255,255,255,.05);filter:none}
.ppe-highlight.ppe-detectado{display:block;fill:rgba(34,229,139,.48);stroke:#22e58b;filter:drop-shadow(0 0 18px rgba(34,229,139,.95))}
.ppe-highlight.ppe-ausente{display:block;fill:rgba(255,64,88,.52);stroke:#ff4058;filter:drop-shadow(0 0 18px rgba(255,64,88,.95))}
.ppe-part{fill:#10151d;stroke:#080d14;stroke-width:2;stroke-linejoin:round;transition:fill .3s,stroke .3s,filter .3s;paint-order:stroke fill}
.ppe-part.ppe-registrado{fill:#f8fbff;stroke:#d7e5f2;filter:drop-shadow(0 0 4px rgba(255,255,255,.35))}
.ppe-part.ppe-detectado{fill:#22e58b;stroke:#079b58;filter:drop-shadow(0 0 5px rgba(34,229,139,.9))}
.ppe-part.ppe-ausente{fill:#ff4058;stroke:#a90d2c;filter:drop-shadow(0 0 6px rgba(255,64,88,.9))}
.mascote-legenda{display:flex;justify-content:center;gap:8px;flex-wrap:wrap;font-size:9px;color:#c7d9e9;margin-top:3px}
.mascote-legenda span{display:flex;align-items:center;gap:4px}
.legenda-ponto{display:inline-block;width:8px;height:8px;border-radius:50%;background:#fff;box-shadow:0 0 6px currentColor}
.legenda-ponto.ausente{background:#111;border:1px solid #8ea1b4}
.epis-obrigatorios{background:linear-gradient(145deg,rgba(7,27,47,.96),rgba(3,15,29,.96));border:1px solid rgba(67,164,235,.4);box-shadow:0 18px 45px rgba(0,0,0,.36),inset 0 1px 0 rgba(255,255,255,.07);backdrop-filter:blur(14px)}
.epis-obrigatorios h3{display:flex;align-items:center;gap:9px;color:#f2f8ff;font-size:16px;letter-spacing:.2px}
.epis-obrigatorios h3 i{color:#40b9ff;text-shadow:0 0 12px rgba(64,185,255,.4)}
.epi-obrigatorio-item{position:relative;overflow:hidden;background:linear-gradient(100deg,rgba(255,255,255,.09),rgba(255,255,255,.035));border:1px solid rgba(255,255,255,.06);border-radius:12px;transition:transform .2s,border-color .2s,background .2s}
.epi-obrigatorio-item:hover{transform:translateX(3px);border-color:rgba(67,164,235,.45)}
.epi-status{padding:5px 8px;border-radius:20px;background:rgba(255,209,102,.1);letter-spacing:.3px}
.epi-status.epi-detectado{background:rgba(34,229,139,.12);text-shadow:0 0 10px rgba(34,229,139,.25)}
.epi-status.epi-ausente{background:rgba(255,64,88,.12);text-shadow:0 0 10px rgba(255,64,88,.25)}
.analysis-status{background:linear-gradient(110deg,rgba(5,27,47,.96),rgba(7,48,76,.91));border-color:rgba(25,170,237,.65);box-shadow:0 12px 30px rgba(0,0,0,.3),inset 0 1px 0 rgba(255,255,255,.1)}
@media(max-width:800px){.mascote-epi{left:12px;bottom:12px;width:135px;padding:7px 6px;border-radius:13px}.mascote-figura-wrap{height:155px}.mascote-svg{height:100%}.mascote-titulo{font-size:8px}.mascote-subtitulo{font-size:7px}.mascote-legenda{font-size:7px;gap:4px}.epis-obrigatorios{width:calc(100% - 24px);top:62px;left:12px;padding:10px}.epi-obrigatorio-item{padding:7px 8px}.epi-nome{font-size:11px}.epi-status{font-size:9px;padding:4px 6px}}

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


/* PAINEL NEXA: lateral esquerda completa, sem botão de voltar */
.mascote-epi{
    position:absolute !important; top:0 !important; left:0 !important; bottom:0 !important; right:auto !important;
    z-index:40; width:clamp(300px, 26vw, 370px); max-width:42vw; height:100%; max-height:none;
    padding:16px 14px; display:flex; flex-direction:column; align-items:stretch; gap:8px;
    overflow:hidden; border-radius:0 20px 20px 0;
    background:linear-gradient(155deg,rgba(8,31,52,.98),rgba(2,12,25,.98));
    border:1px solid rgba(48,177,245,.65); border-left:0;
    box-shadow:0 16px 44px rgba(0,0,0,.48),inset 0 1px 0 rgba(255,255,255,.1);
    color:#fff; backdrop-filter:blur(14px); text-align:center; box-sizing:border-box;
}
.mascote-epi:before{content:"";position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#159fe8,#36e6a0,#159fe8)}
.mascote-titulo{position:relative;flex-shrink:0;text-align:center;font-size:14px;font-weight:900;letter-spacing:1px;margin:4px 0 1px;color:#e4f4ff}
.mascote-subtitulo{flex-shrink:0;text-align:center;font-size:10px;color:#a8c8df;margin:0}
.mascote-svg{position:relative;display:block;width:100%;height:clamp(220px, 39vh, 350px);max-height:42vh;flex:0 1 auto;min-height:180px;overflow:visible;object-fit:contain;filter:drop-shadow(0 10px 12px rgba(0,0,0,.32))}
.ppe-part{fill:#10151d;stroke:#080d14;stroke-width:2;stroke-linejoin:round;transition:fill .3s,stroke .3s,filter .3s,opacity .3s;paint-order:stroke fill}
.ppe-part.ppe-registrado{fill:#f8fbff;stroke:#d7e5f2;filter:drop-shadow(0 0 4px rgba(255,255,255,.35))}
.ppe-part.ppe-detectado{fill:#22e58b;stroke:#079b58;filter:drop-shadow(0 0 5px rgba(34,229,139,.9))}
.ppe-part.ppe-ausente{fill:#ff4058;stroke:#a90d2c;filter:drop-shadow(0 0 6px rgba(255,64,88,.9))}
.mascote-legenda{display:flex;justify-content:center;gap:9px;flex-wrap:wrap;font-size:10px;color:#d2e4f2;margin:0 0 4px;flex-shrink:0}
.mascote-legenda span{display:flex;align-items:center;gap:5px}
.legenda-ponto{display:inline-block;width:9px;height:9px;border-radius:50%;background:#f8fbff;border:1px solid #d7e5f2;box-shadow:0 0 6px rgba(255,255,255,.35)}
.legenda-ponto.ausente{background:#ff4058;border-color:#ff4058;box-shadow:0 0 6px rgba(255,64,88,.6)}
.epis-obrigatorios{background:linear-gradient(145deg,rgba(7,27,47,.96),rgba(3,15,29,.96));border:1px solid rgba(67,164,235,.4);box-shadow:0 18px 45px rgba(0,0,0,.36),inset 0 1px 0 rgba(255,255,255,.07);backdrop-filter:blur(14px)}
.epis-obrigatorios h3{display:flex;align-items:center;gap:9px;color:#f2f8ff;font-size:15px;letter-spacing:.2px}
.epis-obrigatorios h3 i{color:#40b9ff;text-shadow:0 0 12px rgba(64,185,255,.4)}
.epi-obrigatorio-item{position:relative;overflow:hidden;background:linear-gradient(100deg,rgba(255,255,255,.09),rgba(255,255,255,.035));border:1px solid rgba(255,255,255,.06);border-radius:12px;transition:transform .2s,border-color .2s,background .2s}
.epi-status{padding:5px 8px;border-radius:20px;background:rgba(255,255,255,.1);letter-spacing:.2px;color:#f8fbff}
.epi-aguardando{color:#f8fbff !important;background:rgba(255,255,255,.12) !important}
.epi-status.epi-detectado{color:#42ff87;background:rgba(34,229,139,.12);text-shadow:0 0 10px rgba(34,229,139,.25)}
.epi-status.epi-ausente{color:#ff5c5c;background:rgba(255,64,88,.12);text-shadow:0 0 10px rgba(255,64,88,.25)}
.mascote-epi .epis-obrigatorios{position:relative !important;inset:auto !important;width:100% !important;max-width:100% !important;min-width:0 !important;min-height:0;max-height:none;flex:1 1 auto;padding:10px !important;margin:0 !important;display:flex;flex-direction:column;overflow-y:auto;overflow-x:hidden;border-radius:14px;box-sizing:border-box;scrollbar-width:thin;scrollbar-color:rgba(64,185,255,.65) rgba(255,255,255,.05)}
.mascote-epi .epis-obrigatorios h3{flex-shrink:0;display:flex;align-items:center;gap:8px;font-size:14px;margin:0 0 9px;line-height:1.25;white-space:normal}
.mascote-epi .epi-obrigatorio-item{flex-shrink:0;width:100%;min-width:0;gap:8px;padding:9px 10px;margin-bottom:6px;display:flex;align-items:center;justify-content:space-between}
.mascote-epi .epi-nome{min-width:0;overflow-wrap:anywhere;text-align:left;font-size:12px;line-height:1.25}
.mascote-epi .epi-status{flex-shrink:0;font-size:10px;padding:5px 7px}
.camera-box{padding:0}
.btn-voltar{display:none !important}
@media(max-width:800px){
 .mascote-epi{top:0 !important;left:0 !important;right:auto !important;bottom:0 !important;width:min(300px, 48vw);max-width:48vw;padding:10px 8px;gap:5px;border-radius:0 16px 16px 0}
 .mascote-svg{height:clamp(165px, 27vh, 230px);max-height:30vh;min-height:140px}
 .mascote-titulo{font-size:11px}.mascote-subtitulo{font-size:9px}
 .mascote-epi .epis-obrigatorios{padding:8px !important}
 .mascote-epi .epis-obrigatorios h3{font-size:12px;margin-bottom:7px}
 .mascote-epi .epi-obrigatorio-item{padding:7px 6px;gap:5px;margin-bottom:5px}
 .mascote-epi .epi-nome{font-size:10px}.mascote-epi .epi-status{font-size:9px;padding:4px 5px}
 .mascote-legenda{font-size:8px;gap:6px}
}
@media(max-height:620px){.mascote-epi{padding:7px;gap:3px}.mascote-svg{height:150px;max-height:25vh;min-height:110px}.mascote-epi .epis-obrigatorios{padding:6px !important}}


/* =========================================================
   ACABAMENTO PREMIUM — COLUNAS LATERAIS
========================================================= */
.main, .camera-wrapper, .camera-box { background: #020914; }
.camera-box { isolation: isolate; }
#camera { background: radial-gradient(ellipse at 52% 45%, #10243a 0%, #050b14 68%, #02050a 100%); }
.record-status, .analysis-status {
    border: 1px solid rgba(62, 190, 255, .42) !important;
    background: linear-gradient(135deg, rgba(5, 25, 44, .96), rgba(7, 42, 66, .91)) !important;
    box-shadow: 0 10px 28px rgba(0,0,0,.28), inset 0 1px 0 rgba(255,255,255,.08) !important;
    backdrop-filter: blur(16px);
}
.record-status { top: 22px; right: 28px; left: auto; border-radius: 999px; padding: 12px 18px; }
.analysis-status { top: 76px; right: 28px; border-radius: 18px; min-width: 245px; }

/* Coluna esquerda: mapa e lista em um cartão coeso */
.mascote-epi {
    width: clamp(320px, 25vw, 390px) !important;
    padding: 18px 16px 15px !important;
    gap: 10px !important;
    border-radius: 0 24px 24px 0 !important;
    background: linear-gradient(155deg, rgba(7,31,53,.985), rgba(2,12,25,.985)) !important;
    border: 1px solid rgba(44,181,245,.62) !important;
    border-left: 0 !important;
    box-shadow: 12px 0 45px rgba(0,0,0,.28), inset 0 1px 0 rgba(255,255,255,.1) !important;
}
.mascote-titulo { font-size: 15px !important; letter-spacing: 1.2px; }
.mascote-subtitulo { font-size: 11px !important; }
.mascote-svg { filter: drop-shadow(0 12px 16px rgba(0,0,0,.38)); }
.mascote-legenda { font-size: 11px !important; gap: 12px !important; }
.mascote-epi .epis-obrigatorios {
    border-radius: 16px !important;
    border-color: rgba(65,174,235,.46) !important;
    background: linear-gradient(145deg, rgba(9,30,49,.98), rgba(3,15,29,.98)) !important;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.07), 0 8px 22px rgba(0,0,0,.2) !important;
    padding: 12px !important;
}
.mascote-epi .epis-obrigatorios h3 { font-size: 15px !important; margin-bottom: 11px !important; }
.mascote-epi .epi-obrigatorio-item {
    min-height: 48px; padding: 10px 11px !important; margin-bottom: 7px !important;
    border-radius: 13px !important; border: 1px solid rgba(143,190,220,.12) !important;
    background: linear-gradient(105deg, rgba(255,255,255,.095), rgba(255,255,255,.035)) !important;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.035);
}
.mascote-epi .epi-obrigatorio-item:hover { transform: translateX(2px); border-color: rgba(45,185,255,.42) !important; }
.mascote-epi .epi-nome { font-size: 13px !important; font-weight: 600; }
.mascote-epi .epi-status { font-size: 10px !important; padding: 6px 9px !important; border: 1px solid rgba(255,255,255,.06); }

/* Coluna direita: painel de violação mais legível e equilibrado */
.resultado-box {
    position: absolute !important;
    right: clamp(18px, 2.2vw, 38px) !important;
    bottom: clamp(18px, 3vh, 34px) !important;
    width: clamp(330px, 25vw, 440px) !important;
    max-width: calc(100vw - 420px) !important;
    max-height: min(72vh, 680px);
    overflow: auto;
    padding: 22px !important;
    border-radius: 22px !important;
    border: 1px solid rgba(37,190,255,.85) !important;
    background: linear-gradient(145deg, rgba(8,27,45,.97), rgba(3,13,26,.97)) !important;
    box-shadow: 0 18px 55px rgba(0,0,0,.48), 0 0 0 1px rgba(34,183,255,.08), inset 0 1px 0 rgba(255,255,255,.09) !important;
    backdrop-filter: blur(18px) saturate(125%);
    scrollbar-width: thin;
    scrollbar-color: rgba(46,176,236,.65) rgba(255,255,255,.04);
}
.resultado-box h3 {
    display: flex; align-items: center; gap: 11px;
    margin: 0 0 16px !important; padding: 0 0 15px;
    font-size: clamp(18px, 1.35vw, 24px) !important;
    line-height: 1.25; font-weight: 800; letter-spacing: .3px;
    border-bottom: 1px solid rgba(145,190,220,.17);
}
.resultado-box h3 i { color: #ffc857; filter: drop-shadow(0 0 8px rgba(255,200,87,.22)); }
#lista-epis { display: flex; flex-direction: column; gap: 9px; }
#lista-epis > div, #lista-epis > li {
    min-height: 54px; display: flex; align-items: center; gap: 10px;
    padding: 13px 14px; border-radius: 13px;
    background: linear-gradient(100deg, rgba(255,69,88,.13), rgba(255,69,88,.055));
    border: 1px solid rgba(255,69,88,.16); border-left: 4px solid #ff4b5c;
    color: #f0f6ff; font-size: 14px; font-weight: 600; line-height: 1.35;
}
#lista-epis .detectado, #lista-epis .epi-detectado { border-left-color: #27e58b; }
#lista-epis .ausente, #lista-epis .epi-ausente { border-left-color: #ff4b5c; }

@media (max-width: 1000px) {
    .mascote-epi { width: min(320px, 38vw) !important; }
    .resultado-box { width: 300px !important; max-width: calc(100vw - 350px) !important; right: 12px !important; bottom: 12px !important; padding: 15px !important; }
    .resultado-box h3 { font-size: 17px !important; }
    #lista-epis > div, #lista-epis > li { padding: 10px; font-size: 12px; }
    .record-status { top: 14px; right: 14px; }
    .analysis-status { top: 64px; right: 14px; min-width: 0; }
}
@media (max-width: 650px) {
    .mascote-epi { width: 44vw !important; padding: 9px 7px !important; }
    .mascote-svg { height: 22vh !important; min-height: 115px !important; }
    .mascote-titulo { font-size: 10px !important; }
    .mascote-subtitulo, .mascote-legenda { font-size: 8px !important; }
    .mascote-epi .epi-nome { font-size: 10px !important; }
    .mascote-epi .epi-status { font-size: 8px !important; padding: 4px !important; }
    .resultado-box { width: 48vw !important; max-width: 48vw !important; right: 7px !important; bottom: 7px !important; padding: 10px !important; border-radius: 14px !important; }
    .resultado-box h3 { font-size: 13px !important; gap: 6px; margin-bottom: 9px !important; padding-bottom: 8px; }
    #lista-epis { gap: 5px; }
    #lista-epis > div, #lista-epis > li { min-height: 38px; padding: 7px; font-size: 10px; }
    .record-status { font-size: 11px; padding: 8px 10px; }
    .analysis-status { font-size: 11px; top: 54px; padding: 8px 10px; }
}



/* =========================================================
   AJUSTE FINAL — PAINEL ESCURO ORIGINAL + CORES REAIS DOS EPIs
========================================================= */
.mascote-epi {
    font-family: 'Inter', Arial, sans-serif !important;
    background: linear-gradient(155deg, rgba(8,31,52,.99), rgba(2,12,25,.99)) !important;
    color: #f2f8ff !important;
    border: 1px solid rgba(48,177,245,.65) !important;
    border-top: 4px solid #16a3ff !important;
    border-left: 0 !important;
    border-radius: 0 20px 20px 0 !important;
    box-shadow: 0 16px 44px rgba(0,0,0,.48), inset 0 1px 0 rgba(255,255,255,.1) !important;
    backdrop-filter: blur(14px) !important;
}
.mascote-titulo { color: #e4f4ff !important; text-shadow: 0 0 12px rgba(25,170,237,.25) !important; font-family: 'Inter', Arial, sans-serif !important; }
.mascote-subtitulo { color: #a8c8df !important; font-family: 'Inter', Arial, sans-serif !important; }
.mascote-svg { filter: drop-shadow(0 10px 12px rgba(0,0,0,.32)) !important; transform: translateZ(0); }
.mascote-epi:before { background: linear-gradient(90deg,#159fe8,#36e6a0,#159fe8) !important; }
.mascote-legenda { color: #d2e4f2 !important; font-family: 'Inter', Arial, sans-serif !important; }

/* O EPI mantém aparência natural enquanto a análise está pendente.
   Só muda para verde/vermelho quando existe resultado final. */
.ppe-part { transition: fill .3s, stroke .3s, filter .3s, opacity .3s; }
.ppe-part[data-epi="capacete"] { fill: url(#capacete3d); stroke: #b7811b; }
.ppe-part[data-epi="oculos"] { fill: #34495e; stroke: #172b40; }
.ppe-part[data-epi="mascara"] { fill: #d9e8f4; stroke: #a7c2d8; }
.ppe-part[data-epi="colete"] { fill: url(#colete3d); stroke: #d69b13; }
.ppe-part[data-epi="luvas"] { fill: #202833; stroke: #0c121a; }
.ppe-part[data-epi="botas"] { fill: url(#boot3d); stroke: #080d14; }
.ppe-part.ppe-registrado { fill: revert; filter: none; }
.ppe-part.ppe-detectado { fill: #22e58b !important; stroke: #079b58 !important; filter: drop-shadow(0 0 6px rgba(34,229,139,.9)); }
.ppe-part.ppe-ausente { fill: #ff4058 !important; stroke: #a90d2c !important; filter: drop-shadow(0 0 6px rgba(255,64,88,.9)); }

.mascote-epi .epis-obrigatorios {
    background: linear-gradient(145deg,rgba(7,27,47,.97),rgba(3,15,29,.98)) !important;
    border: 1px solid rgba(67,164,235,.42) !important;
    box-shadow: 0 18px 45px rgba(0,0,0,.36), inset 0 1px 0 rgba(255,255,255,.07) !important;
}
.mascote-epi .epis-obrigatorios h3 { color: #f2f8ff !important; font-family: 'Inter', Arial, sans-serif !important; }
.mascote-epi .epis-obrigatorios h3 i { color: #40b9ff !important; text-shadow: 0 0 12px rgba(64,185,255,.4) !important; }
.mascote-epi .epi-obrigatorio-item {
    background: linear-gradient(100deg,rgba(255,255,255,.09),rgba(255,255,255,.035)) !important;
    border: 1px solid rgba(255,255,255,.08) !important;
    border-radius: 12px !important;
    box-shadow: inset 0 1px 0 rgba(255,255,255,.035) !important;
}
.mascote-epi .epi-obrigatorio-item:hover { transform: translateX(2px) !important; border-color: rgba(45,185,255,.42) !important; }
.mascote-epi .epi-nome { color: #f0f7ff !important; font-family: 'Inter', Arial, sans-serif !important; }
.mascote-epi .epi-status { font-family: 'Inter', Arial, sans-serif !important; color: #f8fbff !important; background: rgba(255,255,255,.1) !important; }
.mascote-epi .epi-aguardando { color: #f8fbff !important; background: rgba(255,255,255,.12) !important; border-color: rgba(255,255,255,.12) !important; }
.mascote-epi .epi-status.epi-detectado { color: #42ff87 !important; background: rgba(34,229,139,.12) !important; border-color: rgba(34,229,139,.24) !important; text-shadow: 0 0 10px rgba(34,229,139,.25) !important; }
.mascote-epi .epi-status.epi-ausente { color: #ff5c5c !important; background: rgba(255,64,88,.12) !important; border-color: rgba(255,64,88,.24) !important; text-shadow: 0 0 10px rgba(255,64,88,.25) !important; }

/* Painel de violações um pouco mais alto para não ficar encostado na borda inferior */
.resultado-box { bottom: clamp(78px, 10vh, 125px) !important; }
@media (max-width: 1000px) { .resultado-box { bottom: 72px !important; } }
@media (max-width: 650px) { .resultado-box { bottom: 56px !important; } }



/* =========================================================
   NEXA DASHBOARD — layout inspirado na referência visual
   Mantém o vídeo real, o canvas da IA e o SVG do mascote dinâmicos.
========================================================= */
:root { --nexa-side: 218px; --nexa-right: 318px; --nexa-cyan: #18b9f4; --nexa-blue: #0878d1; --nexa-green: #18e79a; }
html, body { width:100%; height:100%; min-height:100%; overflow:hidden; background:#020a16 !important; color:#eef7ff; }
.main.nexa-dashboard {
    position:relative !important; width:100vw !important; height:100vh !important; min-height:0 !important;
    display:grid !important; grid-template-columns:var(--nexa-side) minmax(0,1fr) var(--nexa-right) !important;
    gap:12px !important; align-items:stretch !important; justify-content:stretch !important;
    padding:12px !important; overflow:hidden !important;
    background:radial-gradient(ellipse at 54% 0%, #0b2d50 0%, #041326 47%, #010711 100%) !important;
}
.nexa-sidebar {
    min-width:0; height:100%; display:flex; flex-direction:column; gap:20px; padding:20px 12px 12px;
    border:1px solid rgba(28,155,225,.48); border-radius:18px; overflow:hidden;
    background:linear-gradient(165deg,rgba(4,24,50,.99),rgba(2,12,29,.99));
    box-shadow:0 14px 38px rgba(0,0,0,.3), inset 0 1px 0 rgba(255,255,255,.05);
}
.nexa-brand { display:flex; align-items:center; gap:12px; padding:2px 6px 18px; color:#eaf7ff; text-decoration:none; border-bottom:1px solid rgba(74,164,219,.16); }
.brand-shield { display:grid; place-items:center; width:48px; height:54px; color:#20c9ff; font-size:39px; filter:drop-shadow(0 0 12px rgba(24,185,244,.28)); }
.brand-copy { display:flex; flex-direction:column; min-width:0; }
.brand-copy strong { font-size:28px; font-weight:900; letter-spacing:2px; line-height:1.05; }
.brand-copy small { color:#39caff; font-size:10px; white-space:nowrap; margin-top:5px; }
.nexa-nav { display:flex; flex-direction:column; gap:7px; }
.nexa-nav a { display:flex; align-items:center; gap:13px; min-height:47px; padding:0 13px; border-radius:12px; color:#d4e9fb; text-decoration:none; font-size:13px; font-weight:650; transition:background .2s,color .2s,transform .2s; }
.nexa-nav a i { width:20px; text-align:center; color:#7bcfff; font-size:17px; }
.nexa-nav a:hover { background:rgba(20,143,230,.15); color:#fff; transform:translateX(2px); }
.nexa-nav a.active { background:linear-gradient(100deg,#087bd4,rgba(7,88,163,.4)); color:#fff; box-shadow:inset 0 0 0 1px rgba(64,192,255,.14),0 8px 20px rgba(0,93,177,.18); }
.nexa-nav a.active i { color:#37e3ff; }
.nexa-nav .nav-disabled { display:flex; align-items:center; gap:13px; min-height:47px; padding:0 13px; border-radius:12px; color:#718da8; font-size:13px; font-weight:650; opacity:.7; cursor:not-allowed; }
.nexa-nav .nav-disabled i { width:20px; text-align:center; color:#5b7d9b; font-size:17px; }
.sidebar-footer { margin-top:auto; min-height:135px; padding:15px 12px; border:1px solid rgba(24,166,238,.42); border-radius:15px; background:linear-gradient(150deg,rgba(3,39,75,.78),rgba(2,15,34,.82)); }
.footer-brand { display:flex; align-items:center; gap:10px; color:#25caff; }
.footer-brand i { font-size:25px; }
.footer-brand span { display:flex; flex-direction:column; }
.footer-brand strong { color:#e8f6ff; font-size:16px; letter-spacing:1px; }
.footer-brand small { font-size:9px; }
.sidebar-footer p { color:#c5d8e8; font-size:12px; line-height:1.5; margin-top:13px; }
.camera-wrapper { position:relative !important; width:100% !important; height:100% !important; min-width:0 !important; min-height:0 !important; display:flex !important; align-items:stretch !important; justify-content:stretch !important; overflow:hidden !important; }
.camera-box { position:relative !important; width:100% !important; height:100% !important; min-width:0 !important; min-height:0 !important; border-radius:18px !important; overflow:hidden !important; border:1px solid rgba(26,164,235,.65) !important; background:#020914 !important; box-shadow:0 16px 38px rgba(0,0,0,.38),inset 0 1px 0 rgba(255,255,255,.05) !important; }
#camera { width:100% !important; height:100% !important; object-fit:cover !important; background:#020914 !important; }
#overlay { z-index:15; }
.camera-heading { position:absolute; top:14px; left:14px; z-index:28; display:flex; align-items:center; gap:11px; max-width:calc(100% - 30px); padding:11px 14px; border-radius:13px; border:1px solid rgba(24,163,235,.48); background:linear-gradient(110deg,rgba(3,23,44,.92),rgba(5,36,63,.84)); box-shadow:0 8px 22px rgba(0,0,0,.22); backdrop-filter:blur(12px); }
.camera-heading-icon { display:grid; place-items:center; width:34px; height:34px; flex:none; border-radius:9px; color:#2ccaff; background:rgba(16,166,233,.15); font-size:17px; }
.camera-heading strong { display:block; color:#f0f8ff; font-size:16px; line-height:1.2; }
.camera-heading small { display:block; margin-top:4px; color:#9ec5df; font-size:10px; }
.record-status { top:20px !important; right:18px !important; padding:9px 13px !important; border:1px solid rgba(24,185,120,.25); background:rgba(2,20,30,.78) !important; }
.analysis-status { top:76px !important; right:18px !important; min-width:0 !important; max-width:calc(100% - 36px); padding:10px 13px !important; border-radius:13px !important; background:rgba(3,24,43,.9) !important; }
.info { position:fixed !important; top:94px !important; left:calc(var(--nexa-side) + 32px) !important; z-index:27 !important; max-width:260px; padding:8px 11px !important; border:1px solid rgba(70,163,218,.25); border-radius:10px !important; background:rgba(2,20,38,.78) !important; color:#dcefff !important; font-size:10px !important; line-height:1.5; backdrop-filter:blur(9px); }
.right-panel { position:relative; min-width:0; min-height:0; height:100%; display:flex; flex-direction:column; overflow:hidden; border-radius:18px; border:1px solid rgba(23,156,225,.62); background:linear-gradient(160deg,rgba(4,27,51,.99),rgba(2,12,27,.99)); box-shadow:0 16px 38px rgba(0,0,0,.35),inset 0 1px 0 rgba(255,255,255,.05); }
.right-panel-topline { flex:none; height:29px; display:flex; align-items:center; justify-content:center; gap:7px; border-bottom:1px solid rgba(48,148,203,.16); color:#72b8d9; font-size:8px; letter-spacing:1.1px; font-weight:800; }
.right-panel-topline span:first-child { width:6px; height:6px; border-radius:50%; background:#22ed9a; box-shadow:0 0 9px #22ed9a; }
.mascote-epi { position:relative !important; inset:auto !important; width:100% !important; max-width:none !important; height:auto !important; max-height:none !important; flex:1 1 auto; min-height:0; padding:12px 10px 10px !important; display:flex !important; flex-direction:column !important; align-items:stretch !important; gap:7px !important; overflow:hidden !important; border:0 !important; border-radius:0 !important; background:transparent !important; box-shadow:none !important; backdrop-filter:none !important; text-align:center !important; }
.mascote-epi:before { height:2px !important; opacity:.75; }
.mascote-titulo { font-size:14px !important; margin:3px 0 0 !important; }
.mascote-subtitulo { font-size:10px !important; }
.mascote-svg { flex:0 1 auto !important; width:100% !important; height:clamp(240px, 39vh, 410px) !important; min-height:210px !important; max-height:44vh !important; object-fit:contain !important; filter:drop-shadow(0 12px 16px rgba(0,0,0,.4)) !important; }
.mascote-legenda { flex:none !important; font-size:9px !important; margin:0 0 6px !important; gap:8px !important; }
.epis-obrigatorios { position:relative !important; inset:auto !important; left:auto !important; top:auto !important; width:100% !important; max-width:none !important; min-width:0 !important; max-height:none !important; min-height:0 !important; flex:1 1 auto !important; display:flex !important; flex-direction:column !important; overflow:auto !important; margin:0 !important; padding:11px !important; border:1px solid rgba(24,157,220,.42) !important; border-radius:15px !important; background:linear-gradient(155deg,rgba(3,26,48,.92),rgba(2,15,30,.94)) !important; box-shadow:inset 0 1px 0 rgba(255,255,255,.04) !important; scrollbar-width:thin; scrollbar-color:rgba(31,160,220,.65) rgba(255,255,255,.04); }
.epis-obrigatorios h3 { flex:none !important; margin:0 0 10px !important; padding:2px 1px 9px !important; border-bottom:1px solid rgba(103,171,210,.15); font-size:14px !important; }
.epi-obrigatorio-item { flex:none !important; display:flex !important; align-items:center !important; justify-content:space-between !important; gap:7px !important; width:100% !important; min-width:0 !important; min-height:45px; margin:0 0 7px !important; padding:9px 9px !important; border:1px solid rgba(39,157,222,.22) !important; border-radius:12px !important; background:linear-gradient(105deg,rgba(6,47,77,.8),rgba(4,27,49,.85)) !important; box-shadow:inset 0 1px 0 rgba(255,255,255,.025) !important; }
.epi-obrigatorio-item:last-child { margin-bottom:0 !important; }
.epi-nome { min-width:0 !important; color:#eaf6ff !important; font-size:11px !important; line-height:1.3; text-align:left !important; overflow-wrap:anywhere; }
.epi-status { flex:none !important; padding:5px 7px !important; border-radius:9px !important; font-size:9px !important; letter-spacing:0 !important; white-space:nowrap; }
.epi-aguardando { color:#eff8ff !important; background:rgba(255,255,255,.12) !important; }
.epi-status.epi-detectado { color:#20f1a0 !important; background:rgba(17,221,139,.12) !important; border:1px solid rgba(32,241,160,.18); }
.epi-status.epi-ausente { color:#ff6678 !important; background:rgba(255,65,87,.13) !important; border:1px solid rgba(255,65,87,.18); }
.resultado-box { z-index:32 !important; right:14px !important; bottom:14px !important; width:min(330px, calc(100% - 28px)) !important; max-width:calc(100% - 28px) !important; max-height:52vh !important; padding:14px !important; border-radius:16px !important; }
.resultado-box h3 { font-size:16px !important; margin-bottom:10px !important; padding-bottom:9px !important; }
#lista-epis > div, #lista-epis > li { min-height:38px; padding:9px 10px; font-size:11px; }
.btn-voltar { display:none !important; }
@media (max-width: 1180px) {
    :root { --nexa-side: 188px; --nexa-right: 280px; }
    .main.nexa-dashboard { gap:9px !important; padding:9px !important; }
    .nexa-sidebar { padding:16px 9px 10px; }
    .brand-shield { width:38px; font-size:32px; }
    .brand-copy strong { font-size:23px; }
    .nexa-nav a { gap:9px; padding:0 9px; font-size:12px; }
    .mascote-svg { height:34vh !important; min-height:190px !important; }
}
@media (max-width: 900px) {
    :root { --nexa-side: 66px; --nexa-right: 255px; }
    .nexa-sidebar { align-items:center; padding:13px 6px; }
    .nexa-brand { justify-content:center; padding:0 0 14px; }
    .brand-copy, .nexa-nav a span, .sidebar-footer { display:none !important; }
    .nexa-nav { width:100%; }
    .nexa-nav a, .nexa-nav .nav-disabled { justify-content:center; padding:0; }
    .nexa-nav a i, .nexa-nav .nav-disabled i { font-size:17px; }
    .info { left:calc(var(--nexa-side) + 22px) !important; }
    .camera-heading strong { font-size:14px; }
    .camera-heading small { display:none; }
    .mascote-svg { height:30vh !important; min-height:165px !important; }
}
@media (max-width: 680px) {
    html, body { height:auto !important; min-height:100%; overflow:auto !important; }
    .main.nexa-dashboard { width:100% !important; height:auto !important; min-height:100vh !important; grid-template-columns:minmax(0,1fr) !important; grid-template-rows:auto minmax(56vh,1fr) auto !important; overflow:visible !important; padding:8px !important; gap:8px !important; }
    .nexa-sidebar { display:none !important; }
    .camera-wrapper { height:60vh !important; min-height:420px !important; }
    .camera-box { border-radius:14px !important; }
    .right-panel { min-height:0; height:auto; }
    .mascote-epi { padding:12px !important; }
    .mascote-svg { height:280px !important; min-height:250px !important; max-height:none !important; }
    .epis-obrigatorios { max-height:38vh !important; flex:none !important; }
    .info { position:absolute !important; top:78px !important; left:17px !important; font-size:9px !important; }
    .camera-heading { top:10px; left:10px; padding:8px; }
    .camera-heading-icon { width:29px; height:29px; }
    .camera-heading strong { font-size:12px; }
    .record-status { top:12px !important; right:10px !important; font-size:10px !important; padding:7px 9px !important; }
    .analysis-status { top:58px !important; right:10px !important; font-size:10px !important; padding:7px 9px !important; }
    .resultado-box { width:calc(100% - 20px) !important; max-width:calc(100% - 20px) !important; right:10px !important; bottom:10px !important; max-height:45% !important; }
}


/* =========================================================
   LAYOUT CLÁSSICO: MASCOTE À ESQUERDA + CÂMERA À DIREITA
   Mantém o fluxo real da câmera, canvas, análise e violações.
========================================================= */
:root { --nexa-mascote: 300px; }
html, body { width:100%; height:100%; overflow:hidden; background:#000 !important; }
.main.nexa-dashboard {
    width:100vw !important; height:100vh !important; min-height:0 !important;
    display:grid !important;
    grid-template-columns:minmax(250px, var(--nexa-mascote)) minmax(0,1fr) !important;
    grid-template-rows:minmax(0,1fr) !important;
    gap:0 !important; padding:0 !important; margin:0 !important;
    align-items:stretch !important; justify-content:stretch !important;
    overflow:hidden !important; border:0 !important; border-radius:0 !important;
    background:#000 !important;
}
.nexa-sidebar { display:none !important; }
.right-panel {
    grid-column:1 !important; grid-row:1 !important;
    width:100% !important; min-width:0 !important; height:100% !important;
    border-radius:0 18px 18px 0 !important;
    border-left:0 !important; border-top:0 !important; border-bottom:0 !important;
    border-right:1px solid rgba(24,185,244,.72) !important;
    box-shadow:8px 0 28px rgba(0,0,0,.28) !important;
}
.camera-wrapper {
    grid-column:2 !important; grid-row:1 !important;
    width:100% !important; height:100% !important; min-width:0 !important; min-height:0 !important;
    padding:0 !important; margin:0 !important; align-self:stretch !important;
}
.camera-box {
    width:100% !important; height:100% !important; min-width:0 !important; min-height:0 !important;
    border-radius:0 !important; border:0 !important; box-shadow:none !important;
}
#camera { object-fit:cover !important; }
.info { left:calc(var(--nexa-mascote) + 16px) !important; }
.mascote-epi { padding:12px 10px !important; }
.mascote-svg { height:clamp(210px, 36vh, 390px) !important; max-height:42vh !important; }
.resultado-box { right:18px !important; bottom:18px !important; }
@media (max-width: 900px) {
    :root { --nexa-mascote:260px; }
    .main.nexa-dashboard { grid-template-columns:minmax(225px, var(--nexa-mascote)) minmax(0,1fr) !important; }
    .mascote-svg { height:31vh !important; min-height:170px !important; }
    .info { left:calc(var(--nexa-mascote) + 12px) !important; }
}
@media (max-width: 640px) {
    html, body { height:100% !important; min-height:0 !important; overflow:hidden !important; }
    :root { --nexa-mascote: 42vw; }
    .main.nexa-dashboard { grid-template-columns:minmax(145px, var(--nexa-mascote)) minmax(0,1fr) !important; grid-template-rows:100% !important; padding:0 !important; gap:0 !important; }
    .right-panel { border-radius:0 12px 12px 0 !important; }
    .right-panel-topline { height:23px; font-size:7px; }
    .mascote-epi { padding:7px 5px !important; gap:4px !important; }
    .mascote-titulo { font-size:9px !important; letter-spacing:.5px !important; }
    .mascote-subtitulo { font-size:7px !important; }
    .mascote-svg { height:22vh !important; min-height:110px !important; max-height:25vh !important; }
    .mascote-legenda { font-size:7px !important; gap:4px !important; }
    .epis-obrigatorios { padding:6px !important; }
    .epis-obrigatorios h3 { font-size:10px !important; }
    .epi-obrigatorio-item { min-height:32px !important; padding:5px 4px !important; gap:3px !important; }
    .epi-nome { font-size:8px !important; }
    .epi-status { font-size:7px !important; padding:3px 4px !important; }
    .camera-heading { top:8px; left:8px; padding:7px 9px; }
    .camera-heading strong { font-size:11px !important; }
    .record-status { top:8px !important; right:8px !important; font-size:9px !important; }
    .analysis-status { top:48px !important; right:8px !important; font-size:9px !important; }
    .info { display:none !important; }
    .resultado-box { right:8px !important; bottom:8px !important; width:min(240px, calc(100% - 16px)) !important; max-height:42vh !important; }
}



/* MENU HORIZONTAL FINO: título + transmissão/análise na mesma linha */
.camera-topbar{
    position:absolute!important;top:0!important;left:0!important;right:0!important;z-index:40!important;
    min-height:48px!important;height:48px!important;padding:5px 12px!important;
    display:flex!important;align-items:center!important;justify-content:space-between!important;gap:12px!important;
    border-bottom:1px solid rgba(36,177,236,.42)!important;
    background:linear-gradient(100deg,rgba(2,16,31,.94),rgba(4,35,59,.9))!important;
    box-shadow:0 5px 18px rgba(0,0,0,.22)!important;backdrop-filter:blur(10px)!important;
}
.camera-topbar .camera-heading{
    position:static!important;inset:auto!important;max-width:45%!important;min-width:0!important;
    display:flex!important;align-items:center!important;gap:8px!important;padding:0!important;
    border:0!important;border-radius:0!important;background:transparent!important;box-shadow:none!important;backdrop-filter:none!important;
}
.camera-topbar .camera-heading-icon{width:29px!important;height:29px!important;border-radius:8px!important;font-size:14px!important;}
.camera-topbar .camera-heading strong{font-size:13px!important;line-height:1.1!important;white-space:nowrap!important;}
.camera-topbar .camera-heading small{display:none!important;}
.camera-topbar-status{display:flex!important;align-items:center!important;justify-content:flex-end!important;gap:8px!important;min-width:0!important;}
.camera-topbar .record-status,.camera-topbar .analysis-status{
    position:static!important;inset:auto!important;transform:none!important;min-width:0!important;max-width:none!important;
    display:flex!important;align-items:center!important;gap:7px!important;white-space:nowrap!important;
    margin:0!important;padding:7px 10px!important;border-radius:999px!important;font-size:10px!important;line-height:1!important;
    box-shadow:none!important;backdrop-filter:none!important;
}
.camera-topbar .record-status{border:1px solid rgba(24,185,120,.25)!important;background:rgba(2,20,30,.6)!important;}
.camera-topbar .analysis-status{border:1px solid rgba(25,170,237,.32)!important;background:rgba(3,24,43,.68)!important;}
.camera-topbar .record-dot,.camera-topbar .status-icon{width:7px!important;height:7px!important;flex:none!important;}
.camera-topbar .analysis-timer{font-size:10px!important;margin-left:2px!important;}
.camera-box #camera,.camera-box #overlay{position:absolute!important;inset:0!important;width:100%!important;height:100%!important;}
/* Mascote vetorial 2D: contornos limpos, cores planas e sombra discreta */
.mascote-svg-2d{filter:drop-shadow(0 5px 6px rgba(0,0,0,.24))!important;}
.mascote-svg-2d .ppe-part{stroke-linejoin:round!important;stroke-linecap:round!important;transition:fill .22s ease,stroke .22s ease,filter .22s ease!important;}
.mascote-svg-2d .ppe-part[data-epi="capacete"]{fill:#f4c542!important;stroke:#c58a08!important;}
.mascote-svg-2d .ppe-part[data-epi="oculos"]{fill:#6cdbff!important;fill-opacity:.3;stroke:#25374a!important;}
.mascote-svg-2d .ppe-part[data-epi="mascara"]{fill:#cfe8f6!important;stroke:#9abdd4!important;}
.mascote-svg-2d .ppe-part[data-epi="colete"]{fill:#247bd1!important;stroke:#0b3974!important;}
.mascote-svg-2d .ppe-part[data-epi="luvas"]{fill:#202833!important;stroke:#0b1119!important;}
.mascote-svg-2d .ppe-part[data-epi="botas"]{fill:#222b38!important;stroke:#111923!important;}
.mascote-svg-2d .ppe-part.ppe-registrado{filter:none!important;}
.mascote-svg-2d .ppe-part.ppe-detectado{fill:#20e58b!important;stroke:#078d51!important;filter:drop-shadow(0 0 4px rgba(32,229,139,.45))!important;}
.mascote-svg-2d .ppe-part.ppe-ausente{fill:#ff4058!important;stroke:#b81731!important;filter:drop-shadow(0 0 4px rgba(255,64,88,.42))!important;}
@media(max-width:680px){
 .camera-topbar{height:43px!important;min-height:43px!important;padding:4px 7px!important;gap:5px!important;}
 .camera-topbar .camera-heading{max-width:40%!important;gap:5px!important;}
 .camera-topbar .camera-heading-icon{width:24px!important;height:24px!important;font-size:11px!important;}
 .camera-topbar .camera-heading strong{font-size:10px!important;}
 .camera-topbar-status{gap:4px!important;}
 .camera-topbar .record-status,.camera-topbar .analysis-status{gap:4px!important;padding:6px 6px!important;font-size:8px!important;}
 .camera-topbar .analysis-timer{font-size:8px!important;}
}



/* AJUSTE SOLICITADO: menu fino com funcionário/câmera e EPIs lado a lado */
.camera-topbar{
    height:42px!important;min-height:42px!important;padding:4px 12px!important;
    justify-content:flex-start!important;align-items:center!important;
    background:linear-gradient(100deg,rgba(2,16,31,.96),rgba(4,35,59,.93))!important;
}
.camera-topbar .camera-heading{display:none!important;}
.camera-topbar .camera-topbar-status{display:flex!important;align-items:center!important;justify-content:flex-end!important;gap:8px!important;flex:0 0 auto!important;margin-left:auto!important;}
.camera-topbar .record-status{display:none!important;}
.camera-topbar .analysis-status{display:flex!important;}
.camera-info-menu{display:flex!important;align-items:center!important;gap:9px!important;min-width:0!important;width:auto!important;flex:1 1 auto!important;overflow:hidden!important;}
.camera-info-item{display:flex!important;align-items:center!important;gap:7px!important;min-width:0!important;max-width:50%!important;padding:6px 10px!important;border:1px solid rgba(50,174,232,.23)!important;border-radius:9px!important;background:rgba(8,42,66,.72)!important;color:#e9f6ff!important;font:500 11px/1.2 Inter,Arial,sans-serif!important;white-space:nowrap!important;overflow:hidden!important;text-overflow:ellipsis!important;}
.camera-info-item i{color:#35c8f5!important;flex:none!important;font-size:11px!important;}
.camera-info-item span{min-width:0!important;overflow:hidden!important;text-overflow:ellipsis!important;}
.camera-info-item strong{color:#8edfff!important;font-weight:800!important;}
.info{display:none!important;}
.mascote-epi .epis-obrigatorios{display:grid!important;grid-template-columns:repeat(2,minmax(0,1fr))!important;align-content:start!important;align-items:stretch!important;gap:7px!important;}
.mascote-epi .epis-obrigatorios h3{grid-column:1/-1!important;width:100%!important;}
.mascote-epi .epi-obrigatorio-item{display:flex!important;flex-direction:column!important;align-items:flex-start!important;justify-content:space-between!important;gap:8px!important;min-width:0!important;min-height:66px!important;margin:0!important;padding:9px!important;box-sizing:border-box!important;}
.mascote-epi .epi-nome{width:100%!important;overflow-wrap:anywhere!important;font-size:11px!important;}
.mascote-epi .epi-status{align-self:flex-start!important;max-width:100%!important;white-space:normal!important;font-size:9px!important;}
@media(max-width:680px){
 .camera-topbar{height:40px!important;min-height:40px!important;padding:4px 6px!important;}
 .camera-info-menu{gap:5px!important;}
 .camera-info-item{max-width:50%!important;padding:5px 6px!important;font-size:9px!important;gap:4px!important;}
 .camera-info-item i{font-size:9px!important;}
 .mascote-epi .epis-obrigatorios{grid-template-columns:repeat(2,minmax(0,1fr))!important;}
 .mascote-epi .epi-obrigatorio-item{min-height:58px!important;padding:6px!important;}
 .mascote-epi .epi-nome{font-size:9px!important;}
 .mascote-epi .epi-status{font-size:8px!important;padding:3px 5px!important;}
}


/* Mascote 3D NEXA: imagem de corpo inteiro, sem cortar mãos ou botas */
.mascote-svg-3d{display:block;width:100%;height:clamp(220px,39vh,350px);max-height:42vh;min-height:180px;object-fit:contain;object-position:center bottom;border-radius:12px;filter:drop-shadow(0 8px 14px rgba(0,0,0,.28));background:transparent;}
@media(max-width:800px){.mascote-svg-3d{height:clamp(165px,27vh,230px);max-height:30vh;min-height:140px;}}
@media(max-height:620px){.mascote-svg-3d{height:150px;max-height:25vh;min-height:110px;}}
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

<div class="main nexa-dashboard">

    <div class="camera-wrapper">


        <!-- =================================================
             CAMERA
        ================================================== -->

        <div class="camera-box">

            <div class="camera-topbar" aria-label="Informações da câmera e do funcionário">
                <div class="camera-info-menu">
                    <div class="camera-info-item">
                        <i class="fa-solid fa-user" aria-hidden="true"></i>
                        <span><strong>Funcionário:</strong> <?= esc($funcionario['NOME_COMPLETO']) ?></span>
                    </div>
                    <div class="camera-info-item">
                        <i class="fa-solid fa-video" aria-hidden="true"></i>
                        <span><strong>Câmera:</strong> <?= !empty($cameras) ? esc($cameras[0]['IDENTIFICADOR_CAMERA']) : 'Nenhuma câmera' ?></span>
                    </div>
                </div>
                <!-- Mantidos ocultos para preservar os callbacks de análise já existentes. -->
                <div class="camera-topbar-status" aria-hidden="true">
                    <div class="record-status"><span class="record-dot"></span><span>Transmitindo</span></div>
                    <div class="analysis-status" id="analysis-status">
                        <span class="status-icon"></span>
                        <span class="status-text" id="analysis-status-text">Preparando análise...</span>
                        <span class="analysis-timer" id="analysis-timer">0s</span>
                    </div>
                </div>
            </div>


            <!-- VÍDEO -->

            <video
                id="camera"
                autoplay
                playsinline
                muted>
            </video>

            <canvas id="overlay"></canvas>



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

    <aside class="right-panel" aria-label="Mapa e status dos EPIs">
        <div class="right-panel-topline"><span></span><span>MONITORAMENTO ATIVO</span></div>
                    <!-- MASCOTE NEXA 3D: cada parte do EPI muda de cor conforme o resultado -->
            <div class="mascote-epi" id="mascote-epi" aria-label="Mascote NEXA com status visual dos EPIs">
                <div class="mascote-titulo"><i class="fa-solid fa-shield-halved"></i> MAPA DE EPIs</div>
                <div class="mascote-subtitulo">Monitoramento de corpo inteiro</div>
                <div class="mascote-figura-wrap" aria-label="Mascote com destaque visual dos EPIs cadastrados">
                    <img class="mascote-svg mascote-svg-3d" src="<?= base_url('assets/images/mascote_nexa_3d_amarelo.png') ?>" alt="Mascote NEXA 3D de corpo inteiro, com capacete amarelo, óculos de proteção, máscara azul, protetores auriculares, uniforme azul com faixas refletivas, luvas pretas e botas pretas">
                    <!-- Camada SVG transparente: destaca em verde/vermelho somente os EPIs cadastrados. -->
                    <svg class="mascote-ppe-overlay" viewBox="0 0 1086 1448" preserveAspectRatio="xMidYMid meet" aria-hidden="true">
                        <path class="ppe-highlight" data-epi="capacete" d="M385 253 Q385 155 468 112 Q540 72 615 117 Q694 161 700 253 L700 274 Q545 305 385 274 Z"/>
                        <path class="ppe-highlight" data-epi="oculos" d="M405 270 Q440 253 482 271 L521 286 L552 286 L590 270 Q635 252 675 274 L665 332 Q626 356 579 331 L542 318 L505 332 Q459 357 418 331 Z"/>
                        <path class="ppe-highlight" data-epi="mascara" d="M426 342 Q541 315 658 343 L642 424 Q541 477 441 424 Z"/>
                        <path class="ppe-highlight" data-epi="colete" d="M377 460 L447 449 L477 495 L610 495 L641 449 L710 461 L744 750 L687 795 L399 795 L343 750 Z"/>
                        <path class="ppe-highlight" data-epi="luvas" d="M202 812 Q218 789 251 801 L299 829 L333 899 L318 950 Q294 982 263 962 L218 928 Q192 895 202 812 Z M744 829 L791 801 Q823 789 840 812 Q850 895 824 928 L779 962 Q748 982 724 950 L709 899 Z"/>
                        <path class="ppe-highlight" data-epi="botas" d="M302 1166 L478 1166 L484 1287 Q489 1311 479 1332 L276 1332 Q263 1324 267 1302 L282 1235 Z M555 1166 L730 1166 L755 1235 L771 1302 Q775 1324 762 1332 L559 1332 Q549 1311 553 1287 Z"/>
                    </svg>
                </div>
                <div class="mascote-legenda">
                    <span><i class="legenda-ponto"></i>Aguardando análise</span>
                    <span><i class="legenda-ponto ausente"></i>EPI ausente</span>
                </div>

                <!-- Lista integrada ao mesmo cartão do mascote -->
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

    <?php endif; ?>

</div>
            </div>
    </aside>

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


function normalizarTipoEpi(nome){
    const n = normalizarEpiFrontend(nome);
    if (n.includes('capacete')) return 'capacete';
    if (n.includes('oculo')) return 'oculos';
    if (n.includes('luva')) return 'luvas';
    if (n.includes('mascara') || n.includes('respirador')) return 'mascara';
    if (n.includes('colete') || n.includes('refletivo')) return 'colete';
    if (n.includes('bota') || n.includes('calcado') || n.includes('botina')) return 'botas';
    return null;
}

function atualizarMascoteEpis(epis, resultadoFinal){
    const partes = document.querySelectorAll('.ppe-part[data-epi], .ppe-highlight[data-epi]');
    const cadastrados = Array.from(document.querySelectorAll('.epi-obrigatorio-item[data-epi]'))
        .map(item => normalizarTipoEpi(item.dataset.epi))
        .filter(Boolean);
    partes.forEach(parte => {
        const tipo = parte.dataset.epi;
        parte.classList.remove('ppe-registrado','ppe-detectado','ppe-ausente');
        if (!cadastrados.includes(tipo)) {
            parte.style.display = 'none';
            return;
        }
        parte.style.display = '';
        if (!resultadoFinal) {
            // Enquanto analisa, não pinta o equipamento: a imagem mantém a aparência natural.
            parte.classList.add('ppe-registrado');
            return;
        }
        const resultado = Array.isArray(epis) ? epis.find(e => normalizarTipoEpi(e.nome) === tipo) : null;
        if (resultado && resultado.detectado === true) parte.classList.add('ppe-detectado');
        else parte.classList.add('ppe-ausente');
    });
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

        const tipoItem = normalizarTipoEpi(item.dataset.epi);
        const epi =
            Array.isArray(epis)
                ? epis.find(function(e){
                    return normalizarEpiFrontend(e.nome) === nomeItem ||
                        (tipoItem && normalizarTipoEpi(e.nome) === tipoItem);
                })
                : null;

        const status = item.querySelector('.epi-status');
        if (!status) return;

        if (!epi) {
            status.classList.remove('epi-aguardando', 'epi-detectado', 'epi-ausente');
            if (resultadoFinal) {
                status.textContent = '✕ AUSENTE';
                status.classList.add('epi-ausente');
            } else {
                status.textContent = 'AGUARDANDO';
                status.classList.add('epi-aguardando');
            }
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
            status.textContent = 'AGUARDANDO';
            status.classList.add('epi-aguardando');
        }
    });

    atualizarMascoteEpis(epis, resultadoFinal);
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
        atualizarMascoteEpis([], false);
        document.querySelectorAll('.epi-obrigatorio-item .epi-status').forEach(function(status){
            status.textContent = 'AGUARDANDO';
            status.classList.remove('epi-detectado', 'epi-ausente');
            status.classList.add('epi-aguardando');
        });
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