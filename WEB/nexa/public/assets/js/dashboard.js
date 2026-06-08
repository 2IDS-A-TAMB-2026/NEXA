document.addEventListener("DOMContentLoaded", () => {

    //controle do acesso
    const tipo = localStorage.getItem("tipoUsuario");

    if (tipo !== "admin") {
        alert("Acesso restrito!");
        window.location.href = "dashboard_funcionario.html";
        return;
    }

    // nn ta funcionando
    const span = document.getElementById("boasVindas");
    if (span) {
        span.innerText = "Bem-vindo, Administrador";
    }

    // simulação
    let estado = {
        pessoas: 120,
        alertas: 3,
        cameras: 4
    };

    // elemento
    const cardPessoas = document.getElementById("cardPessoas");
    const cardConformidade = document.getElementById("cardConformidade");
    const cardAlertas = document.getElementById("cardAlertas");
    const cardCameras = document.getElementById("cardCameras");
    const listaAlertas = document.getElementById("listaAlertas");

    // atualiza o dashboard, nn funciona
    function atualizarDashboard() {
        const conformidade = Math.max(60, 100 - estado.alertas * 5);

        cardPessoas.innerText = estado.pessoas;
        cardAlertas.innerText = estado.alertas;
        cardCameras.innerText = estado.cameras;
        cardConformidade.innerText = conformidade + "%";
    }

    // alertas atualiza
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

    // simula tempo
    setInterval(() => {
        estado.pessoas += Math.floor(Math.random() * 4) + 1;

        const variacao = Math.floor(Math.random() * 3) - 1;
        estado.alertas = Math.max(0, estado.alertas + variacao);

        atualizarDashboard();
        atualizarAlertas();
    }, 5000);

    //começa
    atualizarDashboard();
    atualizarAlertas();
});

//sair
function logout() {
    localStorage.removeItem("tipoUsuario");
    window.location.href = "login.html";
}