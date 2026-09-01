const Acessibilidade = {

    tamanhoFonte: 100,
    limiteMaximo: 140,
    limiteMinimo: 80,
    passo: 10,


    // =========================================
    // AUMENTAR FONTE
    // =========================================

    aumentarFonte: function () {

        console.log("A+ CLICADO");

        if (this.tamanhoFonte < this.limiteMaximo) {
            this.tamanhoFonte += this.passo;
        }

        this.aplicarFonte();
    },


    // =========================================
    // DIMINUIR FONTE
    // =========================================

    diminuirFonte: function () {

        console.log("A- CLICADO");

        if (this.tamanhoFonte > this.limiteMinimo) {
            this.tamanhoFonte -= this.passo;
        }

        this.aplicarFonte();
    },


    // =========================================
    // APLICAR FONTE
    // =========================================

    aplicarFonte: function () {

        const escala = this.tamanhoFonte / 100;

        console.log(
            "Tamanho atual:",
            this.tamanhoFonte + "%"
        );


        // Variável CSS
        document.documentElement.style.setProperty(
            "--escala-fonte",
            escala
        );


        // Guarda a escala no HTML
        document.documentElement.setAttribute(
            "data-escala-fonte",
            this.tamanhoFonte
        );


        // Remove classes anteriores
        document.body.classList.remove(
            "fonte-80",
            "fonte-90",
            "fonte-100",
            "fonte-110",
            "fonte-120",
            "fonte-130",
            "fonte-140"
        );


        // Adiciona a classe atual
        document.body.classList.add(
            "fonte-" + this.tamanhoFonte
        );


        // =========================================
        // FORÇA O TAMANHO DOS TEXTOS
        // =========================================

        const textos = document.querySelectorAll(
            "body *:not(.access-btn):not(.gear-btn)"
        );


        textos.forEach(function (elemento) {

            if (
                elemento.tagName === "SCRIPT" ||
                elemento.tagName === "STYLE"
            ) {
                return;
            }


            // Guarda o tamanho original apenas uma vez
            if (
                !elemento.hasAttribute(
                    "data-fonte-original"
                )
            ) {

                const tamanho =
                    window.getComputedStyle(
                        elemento
                    ).fontSize;

                elemento.setAttribute(
                    "data-fonte-original",
                    tamanho
                );
            }


            const original =
                parseFloat(
                    elemento.getAttribute(
                        "data-fonte-original"
                    )
                );


            if (!isNaN(original)) {

                elemento.style.setProperty(
                    "font-size",
                    (original * escala) + "px",
                    "important"
                );
            }

        });


        // Salva a preferência
        localStorage.setItem(
            "tamanhoFonteNexa",
            this.tamanhoFonte
        );
    },


    // =========================================
    // CARREGAR FONTE SALVA
    // =========================================

    carregarFonteSalva: function () {

        const salva =
            localStorage.getItem(
                "tamanhoFonteNexa"
            );


        if (salva) {

            const valor =
                parseInt(salva);


            if (
                valor >= this.limiteMinimo &&
                valor <= this.limiteMaximo
            ) {

                this.tamanhoFonte = valor;
            }
        }


        if (document.body) {
            this.aplicarFonte();
        }
    },


    // =========================================
    // ALTO CONTRASTE
    // =========================================

    toggleContraste: function () {

        document.body.classList.toggle(
            "alto-contraste"
        );


        const ativo =
            document.body.classList.contains(
                "alto-contraste"
            );


        localStorage.setItem(
            "altoContrasteNexa",
            ativo
        );


        atualizarLogo();
    },


    // =========================================
    // CARREGAR CONTRASTE
    // =========================================

    carregarContrasteSalvo: function () {

        const salvo =
            localStorage.getItem(
                "altoContrasteNexa"
            );


        if (salvo === "true") {

            document.body.classList.add(
                "alto-contraste"
            );
        }
    },


    // =========================================
    // LEITOR DE TELA
    // =========================================

    lerPagina: function () {

        window.speechSynthesis.cancel();


        const texto =
            document.body.innerText;


        const fala =
            new SpeechSynthesisUtterance(
                texto
            );


        fala.lang = "pt-BR";
        fala.rate = 1.1;


        window.speechSynthesis.speak(
            fala
        );
    }

};


// =========================================
// DARK MODE
// =========================================

function toggleDark() {

    document.body.classList.toggle(
        "dark-mode"
    );


    localStorage.setItem(
        "darkModeNexa",
        document.body.classList.contains(
            "dark-mode"
        )
    );


    atualizarLogo();
}


// =========================================
// CARREGAR DARK MODE
// =========================================

function carregarDarkModeSalvo() {

    const salvo =
        localStorage.getItem(
            "darkModeNexa"
        );


    if (salvo === "true") {

        document.body.classList.add(
            "dark-mode"
        );
    }
}


// =========================================
// MENU DE ACESSIBILIDADE
// =========================================

function toggleAccessMenu() {

    const menu =
        document.getElementById(
            "accessOptions"
        );


    if (menu) {

        menu.classList.toggle(
            "active"
        );
    }
}


// =========================================
// ATUALIZAR LOGO
// =========================================

function atualizarLogo() {

    const logoLight =
        document.querySelector(
            ".logo-light"
        );


    const logoDark =
        document.querySelector(
            ".logo-dark"
        );


    if (!logoLight || !logoDark) {
        return;
    }


    const dark =
        document.body.classList.contains(
            "dark-mode"
        );


    const contraste =
        document.body.classList.contains(
            "alto-contraste"
        );


    if (dark || contraste) {

        logoLight.style.display = "none";
        logoDark.style.display = "block";

    } else {

        logoLight.style.display = "block";
        logoDark.style.display = "none";
    }
}


// =========================================
// INICIALIZAÇÃO
// =========================================

document.addEventListener(
    "DOMContentLoaded",
    function () {

        console.log(
            "ACESSIBILIDADE NEXA ATIVADA"
        );


        Acessibilidade.carregarFonteSalva();


        carregarDarkModeSalvo();


        Acessibilidade.carregarContrasteSalvo();


        atualizarLogo();

    }
);