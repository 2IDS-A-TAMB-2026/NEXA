// =========================
// ACESSIBILIDADE GLOBAL
// =========================

const Acessibilidade = {

    // =========================
    // TAMANHO DA FONTE
    // =========================

    tamanhoFonte: 100,
    limiteMaximo: 140,
    limiteMinimo: 80,
    passo: 10,


    // =========================
    // ALTO CONTRASTE
    // =========================

    toggleContraste() {

        document.body.classList.toggle("alto-contraste");

        const contrasteAtivo =
            document.body.classList.contains("alto-contraste");

        localStorage.setItem(
            "altoContrasteNexa",
            contrasteAtivo
        );

        atualizarLogo();
    },


    carregarContrasteSalvo() {

        const contrasteSalvo =
            localStorage.getItem("altoContrasteNexa");

        if (contrasteSalvo === "true") {

            document.body.classList.add("alto-contraste");

        } else {

            document.body.classList.remove("alto-contraste");
        }
    },


    // =========================
    // AUMENTAR FONTE
    // =========================

    aumentarFonte() {

        if (this.tamanhoFonte < this.limiteMaximo) {

            this.tamanhoFonte += this.passo;

            this.aplicarFonte();
        }
    },


    // =========================
    // DIMINUIR FONTE
    // =========================

    diminuirFonte() {

        if (this.tamanhoFonte > this.limiteMinimo) {

            this.tamanhoFonte -= this.passo;

            this.aplicarFonte();
        }
    },


    // =========================
    // APLICAR TAMANHO DA FONTE
    // =========================

    aplicarFonte() {

        // Calcula a escala atual
        const escala = this.tamanhoFonte / 100;


        // Cria a variável que será usada pelo CSS
        document.documentElement.style.setProperty(
            "--escala-fonte",
            escala
        );


        // Remove todas as classes anteriores
        document.body.classList.remove(
            "fonte-80",
            "fonte-90",
            "fonte-100",
            "fonte-110",
            "fonte-120",
            "fonte-130",
            "fonte-140"
        );


        // Adiciona somente a classe atual
        document.body.classList.add(
            `fonte-${this.tamanhoFonte}`
        );


        // Salva a configuração
        localStorage.setItem(
            "tamanhoFonteNexa",
            this.tamanhoFonte
        );
    },


    // =========================
    // CARREGAR FONTE SALVA
    // =========================

    carregarFonteSalva() {

        const fonteSalva =
            localStorage.getItem("tamanhoFonteNexa");


        if (fonteSalva) {

            this.tamanhoFonte =
                parseInt(fonteSalva);

        } else {

            this.tamanhoFonte = 100;
        }


        // Calcula a escala salva
        const escala = this.tamanhoFonte / 100;


        // Define a variável CSS
        document.documentElement.style.setProperty(
            "--escala-fonte",
            escala
        );


        // Remove possíveis classes antigas
        document.body.classList.remove(
            "fonte-80",
            "fonte-90",
            "fonte-100",
            "fonte-110",
            "fonte-120",
            "fonte-130",
            "fonte-140"
        );


        // Aplica a classe da fonte salva
        document.body.classList.add(
            `fonte-${this.tamanhoFonte}`
        );
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

    const darkAtivo =
        document.body.classList.contains("dark-mode");

    localStorage.setItem(
        "darkModeNexa",
        darkAtivo
    );

    atualizarLogo();
}



// =========================
// CARREGAR DARK MODE SALVO
// =========================

function carregarDarkModeSalvo() {

    const darkSalvo =
        localStorage.getItem("darkModeNexa");

    if (darkSalvo === "true") {

        document.body.classList.add("dark-mode");

    } else {

        document.body.classList.remove("dark-mode");
    }
}



// =========================
// MENU DE ACESSIBILIDADE
// =========================

function toggleAccessMenu() {
    const options = document.getElementById('accessOptions');
    if (!options) return;
    
    // Alterna a classe 'active' para abrir/fechar
    options.classList.toggle('active');
}



// =========================
// ATUALIZAR LOGO
// =========================

function atualizarLogo() {

    const logoLight =
        document.querySelector(".logo-light");

    const logoDark =
        document.querySelector(".logo-dark");


    // Se a página não tiver as logos,
    // não faz nada.

    if (!logoLight || !logoDark) {

        return;
    }


    const darkAtivo =
        document.body.classList.contains("dark-mode");

    const contrasteAtivo =
        document.body.classList.contains("alto-contraste");


    // =========================
    // MODO ESCURO / CONTRASTE
    // =========================

    if (darkAtivo || contrasteAtivo) {

        logoLight.style.display = "none";

        logoDark.style.display = "block";

    }


    // =========================
    // MODO CLARO
    // =========================

    else {

        logoLight.style.display = "block";

        logoDark.style.display = "none";
    }
}



// =========================
// INICIALIZAÇÃO
// =========================

document.addEventListener("DOMContentLoaded", () => {

    // 1. Carrega tamanho da fonte
    Acessibilidade.carregarFonteSalva();


    // 2. Carrega modo escuro
    carregarDarkModeSalvo();


    // 3. Carrega alto contraste
    Acessibilidade.carregarContrasteSalvo();


    // 4. Atualiza a logo
    atualizarLogo();

});