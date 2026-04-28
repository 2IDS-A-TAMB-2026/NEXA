document.addEventListener("DOMContentLoaded", function(){

    // ===== TIPO DE USUÁRIO =====
    const tipoUsuario = localStorage.getItem("tipoUsuario");

    console.log("Tipo usuário:", tipoUsuario);

    // ===== PROTEÇÃO DE LOGIN =====
    if(!tipoUsuario){
        window.location.href = "login.html";
        return;
    }

    // ===== PÁGINA ATUAL =====
    const paginaAtual = window.location.pathname.split("/").pop();

    // ===== CONTROLE FUNCIONÁRIO =====
    if(tipoUsuario === "funcionario"){

        // ===== PEGAR MENUS =====
        const menuUsers = document.getElementById("menu-users");
        const menuReports = document.getElementById("menu-reports");
        const menuCameras = document.getElementById("menuCameras");
        const menuHistory = document.getElementById("menu-history");

        console.log("Menu history:", menuHistory);

        // ===== ESCONDER MENUS (SE EXISTIREM) =====
        if(menuUsers) menuUsers.style.display = "none";
        if(menuReports) menuReports.style.display = "none";
        if(menuCameras) menuCameras.style.display = "none";
        if(menuHistory) menuHistory.style.display = "none";

        // 🔥 GARANTIA EXTRA (mesmo sem ID no HTML)
        document.querySelectorAll('a[href="history.html"]').forEach(el => {
            el.style.display = "none";
        });

        document.querySelectorAll('a[href="dashboard_cameras.html"]').forEach(el => {
            el.style.display = "none";
        });

        document.querySelectorAll('a[href="users.html"]').forEach(el => {
            el.style.display = "none";
        });

        document.querySelectorAll('a[href="reports.html"]').forEach(el => {
            el.style.display = "none";
        });

        // ===== BLOQUEAR ACESSO DIRETO =====
        const paginasBloqueadas = [
            "users.html",
            "reports.html",
            "dashboard_cameras.html",
            "history.html"
        ];

        if(paginasBloqueadas.includes(paginaAtual)){
            alert("Acesso restrito ao administrador.");
            window.location.href = "dashboard.html";
        }
    }

});