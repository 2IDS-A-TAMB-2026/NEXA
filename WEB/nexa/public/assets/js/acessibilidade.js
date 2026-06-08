// =========================
// ACESSIBILIDADE GLOBAL
// =========================

const Acessibilidade = {
    escala: 1,

    // 🔴 ALTO CONTRASTE
    toggleContraste() {
        document.body.classList.toggle("alto-contraste");
        atualizarLogo();
    },

    // 🔵 AUMENTAR FONTE
    aumentarFonte() {
        this.escala += 0.1;
        document.body.style.fontSize = (16 * this.escala) + "px";
    },

    // 🔵 DIMINUIR FONTE
    diminuirFonte() {
        if (this.escala > 0.8) {
            this.escala -= 0.1;
            document.body.style.fontSize = (16 * this.escala) + "px";
        }
    },

    // 🔊 LEITOR DE TELA
    lerPagina() {
        const texto = document.body.innerText;

        const speech = new SpeechSynthesisUtterance(texto);
        speech.lang = "pt-BR";
        speech.rate = 1;

        window.speechSynthesis.cancel();
        window.speechSynthesis.speak(speech);
    }
};

// =========================
// DARK MODE
// =========================
function toggleDark() {
    document.body.classList.toggle("dark-mode");
    atualizarLogo();
}

// =========================
// LOGO (OPCIONAL)
// =========================
function atualizarLogo() {
    const logoLight = document.querySelector(".logo-light");
    const logoDark = document.querySelector(".logo-dark");

    if (!logoLight || !logoDark) return;

    const darkAtivo =
        document.body.classList.contains("dark-mode") ||
        document.body.classList.contains("alto-contraste");

    if (darkAtivo) {
        logoLight.style.display = "none";
        logoDark.style.display = "block";
    } else {
        logoLight.style.display = "block";
        logoDark.style.display = "none";
    }
}

function toggleAccessMenu(){
    document
        .getElementById("accessOptions")
        .classList
        .toggle("active");
}