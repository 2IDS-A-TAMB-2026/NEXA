
// =========================
// ACESSIBILIDADE GLOBAL
// =========================

const Acessibilidade = {

    // Tamanho atual dos cards
    zoom: 1,

    // =========================
    // ALTO CONTRASTE
    // =========================

    toggleContraste() {

        document.body.classList.toggle("alto-contraste");

        if (typeof atualizarLogo === "function") {
            atualizarLogo();
        }
    },


    // =========================
    // AUMENTAR FONTE / CARDS
    // =========================

    aumentarFonte() {

        if (this.zoom < 1.5) {

            this.zoom = Math.min(
                1.5,
                this.zoom + 0.1
            );

            this.aplicarZoom();
        }
    },


    // =========================
    // DIMINUIR FONTE / CARDS
    // =========================

    diminuirFonte() {

        if (this.zoom > 0.8) {

            this.zoom = Math.max(
                0.8,
                this.zoom - 0.1
            );

            this.aplicarZoom();
        }
    },


    // =========================
    // APLICA O ZOOM NOS CARDS
    // =========================

    aplicarZoom() {

        const cards = document.querySelectorAll(
            ".solution, .value, .block, .team-card"
        );

        cards.forEach(card => {

            card.style.zoom = this.zoom;

        });
    },


    // =========================
    // LEITOR DE TELA
    // =========================

    lerPagina() {

        window.speechSynthesis.cancel();

        const texto = document.body.innerText;

        const speech =
            new SpeechSynthesisUtterance(texto);

        speech.lang = "pt-BR";

        speech.rate = 1.1;

        window.speechSynthesis.speak(speech);
    }
};


// =========================
// DARK MODE
// =========================

function toggleDark() {

    document.body.classList.toggle("dark-mode");

    if (typeof atualizarLogo === "function") {
        atualizarLogo();
    }
}


// =========================
// MENU DE ACESSIBILIDADE
// =========================

function toggleAccessMenu() {

    const menu =
        document.getElementById("accessOptions");

    if (menu) {

        menu.classList.toggle("active");

    }
}


// =========================
// ATUALIZAR LOGO
// =========================

function atualizarLogo() {

    const logoLight =
        document.querySelector(".logo-light");

    const logoDark =
        document.querySelector(".logo-dark");

    if (!logoLight || !logoDark) {
        return;
    }


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


// =========================
// INICIALIZAÇÃO
// =========================

document.addEventListener("DOMContentLoaded", () => {

    // Aplica o tamanho inicial dos cards
    Acessibilidade.aplicarZoom();

    // Atualiza a logo
    atualizarLogo();

});
