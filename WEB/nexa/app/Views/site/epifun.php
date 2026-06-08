<!DOCTYPE html>
<html lang="pt-BR">
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro de EPIs</title>
<link rel="stylesheet" href="assets/css/acessibilidade.css">
  <link rel="stylesheet" href="assets/css/style_geral.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    background:url('https://img.freepik.com/photos-premium/pour-securite-operation-travail-ingenieur-deux-ouvriers-du-batiment-tiennent-respectivement-casque-securite-jaune-blanc-the-generative-ai_28914-25222.jpg') no-repeat center center/cover;
}
/* Container */
.nexa-popup {
    border-radius: 16px;
    font-family: 'Inter', sans-serif;
    padding: 20px;
}

/* Título */
.nexa-title {
    font-size: 22px;
    font-weight: 600;
    color: #1e293b;
}

/* Texto */
.nexa-text {
    font-size: 15px;
    color: #475569;
    text-align: left;
}

/* Botão excluir */
.nexa-btn-confirm {
    background: linear-gradient(135deg, #2563eb, #1e40af);
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 500;
    transition: 0.3s;
}

.nexa-btn-confirm:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
}

/* Botão cancelar */
.nexa-btn-cancel {
    background: #e2e8f0;
    color: #1e293b;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 500;
    margin-right: 10px;
    transition: 0.3s;
}

.nexa-btn-cancel:hover {
    background: #cbd5f5;
}

/* Conteúdo */
.swal-content p {
    margin: 5px 0;
}

.access-bar {
    position: fixed !important;
    top: 20px !important;
    right: 20px !important;
}

/* SIDEBAR */
.sidebar {
    width: 270px;
    background: #0f2a44;
    color: #fff;

    position: fixed; /* 🔥 fixa */
    top: 0;
    left: 0;

    height: 100vh; /* ocupa tela inteira */
    display: flex;
    flex-direction: column;

  
}



.sidebar h1 {
    text-align: center;
    margin-bottom: 30px;
}

.sidebar a {
    display: block;
    padding: 10px;
    margin-bottom: 8px;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
}

.sidebar a:hover {
    background: #0a66c2;
}


.sidebar-logo {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 12px 0; /* ↓ antes 25px */
}
.sidebar-logo img {
    width: 120px; /* ↓ levemente menor */
    margin: 0 auto;
    display: block;
}


.menu {
    display: flex;
    flex-direction: column;
    padding: 8px 12px; /* ↓ antes 25px 18px */
    flex: 1;
    gap: 4px; /* ↓ antes 14px */
}

/* ITENS DO MENU */
.menu a {
    display: flex;
    align-items: center;
    gap: 12px;

    padding: 9px 11px; /* ↓ antes 16px 18px */
    border-radius: 12px;

    color: #cbd5e1;
    text-decoration: none;

    transition: 0.2s;
    font-size: 15px; /* ↓ leve ajuste */
}
.menu i {
    font-size: 15px; /* ↓ antes 18px */
    width: 18px;
    text-align: center;
}

/* HOVER MAIS LEVE */
.menu a:hover {
    background: #0a66c2;
    color: #fff;
    transform: translateX(3px);
}


.menu a.active {
    background: #0a66c2;
    color: #fff;
    font-weight: bold;
    border-left: 4px solid #19aaed; /* detalhe visual moderno */
}

.menu a.active i {
    color: #fff;
}
/* SAIR */
.logout-item {
    margin: 10px 12px 30px 12px; /* 🔥 sobe ele */
    padding: 12px;

    border-radius: 10px;

    display: flex;
    align-items: center;
    gap: 10px;

    color: #cbd5e1;
    text-decoration: none;

    border-top: 1px solid rgba(255,255,255,0.1);
}
/* LOGO DO SAIR */
.logout-item i {
    font-size: 16px;
}

.logout-item:hover {
    background: #dc2626;
    color: #fff;
}



/* CONTEÚDO */

.page-header {
    width: 100%;
    margin-bottom: 20px;
}

.page-header h1 {
    padding: 40px;
    color: #fff;
    font-size: 32px;
}

.content-grid {
    display: flex;
    gap: 30px;
    margin-top: 20px;
    width: 100%;
    justify-content: center;
    flex-wrap: wrap;
}

/* CARD ESQUERDA */
.left-box{
    margin-top: 50px;
    width:430px;
    min-height:430px;
    background:#f8f8f8;
    border-radius:25px;
    padding:35px;
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
}

.left-box h1{
    text-align:center;
    color:#0a66c2;
    margin-bottom:25px;
    font-size:30px;
}

.subtitle{
    color:#0066cc;
    font-size:24px;
    font-weight:bold;
    margin-bottom:18px;
}

.input-box{
    width:100%;
    height:58px;
    background:#eceff1;
    border-radius:15px;
    display:flex;
    align-items:center;
    padding:0 18px;
    margin-bottom:15px;
}

.input-box i{
    color:#0066cc;
    font-size:20px;
    margin-right:12px;
}

.input-box input{
    border:none;
    outline:none;
    background:transparent;
    font-size:18px;
    width:100%;
}

.btn-area{
    display:flex;
    justify-content:center;
    margin-top:25px;
}

.btn{
    background:#0066cc;
    color:white;
    border:none;
    border-radius:40px;
    width:220px;
    height:52px;
    font-size:22px;
    cursor:pointer;
}

/* CARD DIREITA */
.right-box{
    width:500px;
    min-height:430px;
    background:#f8f8f8;
    border-radius:25px;
    padding:35px;
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
    max-height:75vh;
    overflow-y:auto;
      margin-top: 50px
}

.right-box h2{
    text-align:center;
    color:#0a66c2;
    margin-bottom:20px;
    font-size:30px;
}

.lista-card{
    width:100%;
    background:white;
    border-radius:20px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:18px 20px;
    margin-top:15px;
}

.lista-left{
    display:flex;
    align-items:center;
    gap:15px;
    max-width:75%;
}

.lista-left i{
    color:#0066cc;
    font-size:26px;
}

.lista-info h3{
    font-size:18px;
    color:#222;
    word-break:break-word;
}

.lista-info p{
    font-size:15px;
    color:#333;
    word-break:break-word;
}

.lista-actions{
    display:flex;
    gap:16px;
}

.edit{
    color:#1e88e5;
    cursor:pointer;
    font-size:22px;
}

.delete{
    color:#f44336;
    cursor:pointer;
    font-size:22px;
}

.modal-bg{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.45);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:999;
    backdrop-filter: blur(4px);
}

/* ERRO NO CAMPO COMPLETO */
.input-box.error{
    border:2px solid #e53935;
}



.modal{
    width:380px;
    background:#ffffff;
    border-radius:24px;
    padding:35px 30px;
    box-shadow:0 10px 30px rgba(0,0,0,0.18);
    animation:fadeIn .25s ease;
}

.modal h2{
    font-size:30px;
    font-weight:600;
    color:#0f2a44;
    margin-bottom:30px;
    text-align:center;
}

.modal input{
    width:100%;
    height:50px;
    border:none;
    border-radius:12px;
    background:#f1f4f8;
    font-size:16px;
    padding:0 15px;
    margin-bottom:18px;
    outline:none;
    transition:.2s;
}

.modal input:focus{
    border:2px solid #0a66c2;
    background:#fff;
}

.modal-buttons{
    display:flex;
    justify-content:space-between;
    gap:15px;
    margin-top:15px;
}

.modal-buttons button{
    flex:1;
    height:45px;
    border:none;
    border-radius:12px;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:.2s;
}

.modal-buttons button:first-child{
    background:#eef2f7;
    color:#555;
}

.modal-buttons button:first-child:hover{
    background:#dde5ee;
}

.save-btn{
    background:#0a66c2 !important;
    color:#fff !important;
}

.save-btn:hover{
    background:#084f97 !important;
}

@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(-15px) scale(.95);
    }
    to{
        opacity:1;
        transform:translateY(0) scale(1);
    }
}

#mensagemVazia{
    display:flex;
    justify-content:center;
    align-items:center;
    text-align:center;
    color:#9e9e9e;
    font-size:22px;
    font-weight:500;
    height:100%;
    min-height:250px;
}

.menu_nome{
    text-align: center;

}

/* ESTADO NORMAL */
/* ESTADO NORMAL */
.logo-light {
    display: block;
}

.logo-dark {
    display: none;
}

/* DARK MODE */
body.dark .logo-light {
    display: none;
}

body.dark .logo-dark {
    display: block;
}

/* ALTO CONTRASTE */
body.alto-contraste .logo-light {
    display: none;
}

body.alto-contraste .logo-dark {
    display: block;
}

body.alto-contraste .barra {
    border: 1px solid #FFD700;
}

body.alto-contraste .eixo-y div {
    color: #FFD700 !important;
}

body.alto-contraste .access-btn {
    background: #000 !important;
    color: #FFD700 !important;
    border: 1px solid #FFD700 !important;
}

.form-group{
    width:100%;
}

.error-text{
    color: #e53935;
    font-size: 14px;
    margin-top: -10px;
    margin-bottom: 10px;
    padding-left: 10px;
    font-weight: 500;
}

.input-box.error{
    border:2px solid #e53935;
}

</style>
</head>
<body class="has-bg-image">

<aside class="sidebar">

    
     <div class="sidebar-logo">
    <img src="assets/images/logo_escura_transparente.png" class="logo">
</div> 

    <!-- MENU -->
    <nav class="menu">
        <a href="dashboard.html">
            <i class="fas fa-chart-line"></i>
            <span>Dashboard</span>
        </a>

        <a href="dashboard_cam.html">
            <i class="fas fa-video"></i>
            <span>Dashboard de Câmeras</span>
        </a>

        <a href="history.html">
            <i class="fas fa-exclamation-triangle"></i>
            <span>Ocorrências</span>
        </a>

        <a href="cadastro_funcionario.html">
            <i class="fas fa-users"></i>
            <span>Cadastro funcionários</span>
        </a>

        <a href="register_epi.html" class="active">
            <i class="fas fa-helmet-safety"></i>
            <span>Cadastro EPIs</span>
        </a>

        <a href="cadastro_camera.html">
            <i class="fas fa-camera"></i>
            <span>Cadastro Câmeras</span>
        </a>

        <a href="cadastro_setor.html">
            <i class="fas fa-building"></i>
            <span>Cadastro setores</span>
        </a>
    


      <a href="perfil_admin.html">
            <i class="fas fa-user"></i>
            <span>Perfil</span>
        </a>
    </nav>


    <!-- SAIR (sempre no final) -->
    <a href="index.html" class="logout-item">
        <i class="fas fa-sign-out-alt"></i>
        <span>Sair</span>
    </a>

</aside>


        <!-- 🔹 MENU ACESSIBILIDADE -->
      <div class="access-bar">

    <button class="access-btn" onclick="Acessibilidade.toggleContraste()">
        <i class="fas fa-adjust"></i>
    </button>

     <button class="access-btn" onclick="toggleDark()">
            <i class="fas fa-moon"></i>
        </button>

    <button class="access-btn" onclick="Acessibilidade.aumentarFonte()">
         A+
    </button>

    <button class="access-btn" onclick="Acessibilidade.diminuirFonte()">
        A-
    </button>

    <button class="access-btn" onclick="Acessibilidade.lerPagina()">
        <i class="fas fa-volume-up"></i>
    </button>

</div>


<div class="overlay">
    <div class="page-header">
  
    </div>


    <div class="content-grid">

    <!-- ESQUERDA -->
    <div class="left-box">
        <h1>Cadastro de EPIs</h1>
        <div class="subtitle">Informações dos EPIs</div>

        <div class="form-group">
    <div class="input-box">
        <i class="fas fa-helmet-safety"></i>
        <input type="text" id="nome" oninput="validarNome(this)" placeholder="Nome">
    </div>
    <div class="error-text"></div>
</div>

    <div class="form-group">
    <div class="input-box">
        <i class="fas fa-helmet-safety"></i>
        <input type="text" id="des" oninput="validarNome(this)" placeholder="Descrição">
    </div>
    <div class="error-text"></div>
</div>
 <div class="form-group">
    <div class="input-box">
        <i class="fas fa-helmet-safety"></i>
        <input type="text" id="cpf" oninput="maskCPF(this)" placeholder="CPF funcionário">
    </div>
    <div class="error-text"></div>
</div>


        <div class="btn-area">
            <button class="btn" onclick="cadastrar()">
                <i class="fas fa-plus"></i> Cadastrar
            </button>
        </div>
    </div>

    <!-- DIREITA -->
    <div class="right-box">
        <h2>EPIs Cadastrados</h2>
        <div id="lista">
            <p id="mensagemVazia">Nenhum EPI cadastrado </p>
        </div>
    </div>
</div>
</div>

<!-- MODAL EDITAR -->
<div class="modal-bg" id="modalBg" style="display:none;">
    <div class="modal">
        <h2>Editar EPI</h2>

        <input type="text" id="editNome" placeholder="Nome">
        <input type="text" id="editcpf" placeholder="CPF">
        <input type="text" id="editDes" placeholder="Descrição">

        <div class="modal-buttons">
            <button onclick="fecharModal()">Cancelar</button>
            <button class="save-btn" onclick="salvarEdicao()">Salvar</button>
        </div>
    </div>
</div>

<script>
let epis = [];

function renderizar(){
    const lista = document.getElementById('lista');

    if(epis.length === 0){
        lista.innerHTML = `<p id="mensagemVazia">Nenhum EPI cadastrado </p>`;
        return;
    }

    lista.innerHTML = '';

    epis.forEach((epi,index)=>{
        lista.innerHTML += `
        <div class="lista-card">
            <div class="lista-left">
                <i class="fas fa-building"></i>
                <div class="lista-info">
                    <h3>${epi.nome}</h3>
                    <p>CPF: ${epi.cpf}</p>
                    <p>Descrição: ${epi.des}</p>
                </div>
            </div>
            <div class="lista-actions">
                <i class="fas fa-pen edit" onclick="editar(${index})"></i>
                <i class="fas fa-trash delete" onclick="excluir(${index})"></i>
            </div>
        </div>`;
    });
}
function cadastrar(){
    const nome = document.getElementById('nome');
    const cpf = document.getElementById('cpf');
    const des = document.getElementById('des');

    let ok = true;

    [nome, cpf, des].forEach(i => clearError(i));

    if(!nome.value.trim()){
        setError(nome, "Campo obrigatório");
        ok = false;
    }

    if(!des.value.trim()){
        setError(des, "Campo obrigatório");
        ok = false;
    }

    if(cpf.value.replace(/\D/g,"").length !== 11){
        setError(cpf, "Campo Obrigatório");
        ok = false;
    }

    if(!ok) return;

    epis.push({
        nome: nome.value,
        cpf: cpf.value,
        des: des.value
    });

    renderizar();

    nome.value = '';
    cpf.value = '';
    des.value = '';
}
function editar(index){
    editIndex = index;
    document.getElementById('editNome').value = epis[index].nome;
    document.getElementById('editcpf').value = epis[index].cpf;
        document.getElementById('editDes').value = epis[index].des;

    document.getElementById('modalBg').style.display = 'flex';
}

function excluir(index){
    const epi = epis[index];

    Swal.fire({
        title: "Excluir registro?",
        icon: "warning",
        html: `
            <div class="swal-content">
                <p><b>Nome:</b> ${epi.nome}</p>
                <p><b>CPF:</b> ${epi.cpf}</p>
                <p><b>Descrição:</b> ${epi.des}</p>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: "Excluir",
        cancelButtonText: "Cancelar",
        customClass: {
            popup: 'nexa-popup',
            title: 'nexa-title',
            htmlContainer: 'nexa-text',
            confirmButton: 'nexa-btn-confirm',
            cancelButton: 'nexa-btn-cancel'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            epis.splice(index,1);
            renderizar();

            Swal.fire({
                icon: "success",
                title: "Excluído!",
                text: "Registro removido com sucesso.",
                timer: 1500,
                showConfirmButton: false,
                customClass: {
                    popup: 'nexa-popup'
                }
            });
        }
    });
}
function logout(){
    alert("Saindo...");
    window.location.href = "login_adm.html";
}

let editIndex = null;

function fecharModal(){
    document.getElementById('modalBg').style.display = 'none';
}

function salvarEdicao(){
    const novoNome = document.getElementById('editNome').value.trim();
    const novocpf = document.getElementById('editcpf').value.trim();
     const novoDes = document.getElementById('editDes').value.trim();

    if(novoNome && novocpf && novoDes){
        epis[editIndex].nome = novoNome;
        epis[editIndex].cpf = novocpf;
        epis[editIndex].des = novoDes;
        renderizar();
        fecharModal();
    }
}


/* ================= NOME (SEM NÚMERO) ================= */
function validarNome(input){
    input.value = input.value.replace(/[0-9]/g,"");
}

/* ================= CPF ================= */
function maskCPF(input){
    let v = input.value.replace(/\D/g,"").slice(0,11); // limite 11

    v = v.replace(/(\d{3})(\d)/,"$1.$2");
    v = v.replace(/(\d{3})(\d)/,"$1.$2");
    v = v.replace(/(\d{3})(\d{1,2})$/,"$1-$2");

    input.value = v;
}
function setError(input, msg){
    const group = input.closest(".form-group");
    const box = group.querySelector(".input-box");
    const erro = group.querySelector(".error-text");

    box.classList.add("error");
    erro.innerText = msg;
}

function clearError(input){
    const group = input.closest(".form-group");
    const box = group.querySelector(".input-box");
    const erro = group.querySelector(".error-text");

    box.classList.remove("error");
    erro.innerText = "";
}

</script>
 <script src="assets/js/permissions.js"></script>
<script src="assets/js/acessibilidade.js"></script>

</body>
</html>