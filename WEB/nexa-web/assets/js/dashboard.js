document.addEventListener("DOMContentLoaded", () => {

    // ESTADO DO SISTEMA (simula backend)
    let estado = {
        pessoas: 120,
        alertas: 3,
        cameras: 4
    };

    // ELEMENTOS
    const cardPessoas = document.getElementById("cardPessoas");
    const cardConformidade = document.getElementById("cardConformidade");
    const cardAlertas = document.getElementById("cardAlertas");
    const cardCameras = document.getElementById("cardCameras");
    const listaAlertas = document.getElementById("listaAlertas");

    // SEGURANÇA
    if (!cardPessoas || !listaAlertas) return;

    // ATUALIZA CARDS
    function atualizarDashboard() {
        const conformidade = Math.max(
            60,
            100 - estado.alertas * 5
        );

        cardPessoas.innerText = estado.pessoas;
        cardAlertas.innerText = estado.alertas;
        cardCameras.innerText = estado.cameras;
        cardConformidade.innerText = conformidade + "%";
    }

    // ATUALIZA ALERTAS VISUAIS
    function atualizarAlertas() {
        listaAlertas.innerHTML = "";

        for (let i = 0; i < estado.alertas; i++) {
            const div = document.createElement("div");
            div.className = "alert-item";
            div.innerHTML = `
                Funcionário sem EPI detectado<br>
                <span>${new Date().toLocaleTimeString()}</span>
            `;
            listaAlertas.appendChild(div);
        }
    }

    // SIMULA EVENTOS EM TEMPO REAL
    setInterval(() => {
        // Pessoas sempre aumentam
        estado.pessoas += Math.floor(Math.random() * 4) + 1;

        // Alertas sobem ou descem
        const variacao = Math.floor(Math.random() * 3) - 1;
        estado.alertas = Math.max(0, estado.alertas + variacao);

        atualizarDashboard();
        atualizarAlertas();
    }, 5000); // a cada 5 segundos

    // INICIALIZA
    atualizarDashboard();
    atualizarAlertas();
});

// LOGOUT
function logout() {
    window.location.href = "login.html";
}
