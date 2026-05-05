// tipo de usuário (pega do sistema)
let tipoUsuario = localStorage.getItem("tipoUsuario") || "funcionario";

// CAMPOS
const nome = document.getElementById("nome");
const telefone = document.getElementById("telefone");
const cpf = document.getElementById("cpf");
const nascimento = document.getElementById("nascimento");
const email = document.getElementById("email");
const tipo = document.getElementById("tipo");
const rfid = document.getElementById("rfid");
const epis = document.getElementById("epis");

// BOTÕES (agora sem conflito)
const btnEdit = document.querySelector(".btn_edit");
const btnSave = document.querySelector(".btn_save");
const btnCancel = document.querySelector(".btn_cancel");

function editar(){
    btnEdit.style.display = "none";
    btnSave.style.display = "flex";
    btnCancel.style.display = "flex";
}

function salvar(){
    btnEdit.style.display = "flex";
    btnSave.style.display = "none";
    btnCancel.style.display = "none";

    alert("Dados atualizados!");
}

function cancelar(){
    location.reload();
}
// EDITAR
function editar(){

    if(tipoUsuario === "admin"){
        nome.disabled = false;
        telefone.disabled = false;
        cpf.disabled = false;
        nascimento.disabled = false;
        email.disabled = false;
        tipo.disabled = false;
        rfid.disabled = false;
        epis.disabled = false;
    } else {
        // funcionário
        nome.disabled = false;
        telefone.disabled = false;
        email.disabled = false;
    }

    btnEdit.style.display = "none";
    btnSave.style.display = "flex";
    btnCancel.style.display = "flex";
}

// SALVAR
function salvar(){

    nome.disabled = true;
    telefone.disabled = true;
    cpf.disabled = true;
    nascimento.disabled = true;
    email.disabled = true;
    tipo.disabled = true;
    rfid.disabled = true;
    epis.disabled = true;

    // salva exemplo
    localStorage.setItem("telefoneUsuario", telefone.value);
    localStorage.setItem("nomeUsuario", nome.value);

    btnEdit.style.display = "flex";
    btnSave.style.display = "none";
    btnCancel.style.display = "none";

    alert("Dados atualizados com sucesso!");
}

// CANCELAR
function cancelar(){
    location.reload();
}

// MOSTRAR SENHA (toggle melhorado)
function mostrarAlterarSenha(){
    const box = document.getElementById("alterarSenhaBox");

    if(box.style.display === "block"){
        box.style.display = "none";
    } else {
        box.style.display = "block";
    }
}

// ALTERAR SENHA (AGORA REAL)
function alterarSenha(){

    const atual = document.getElementById("senhaAtual").value;
    const nova = document.getElementById("novaSenha").value;
    const confirmar = document.getElementById("confirmarSenha").value;

    const senhaSalva = localStorage.getItem("senhaUsuario") || "123456";

    if(!atual || !nova || !confirmar){
        alert("Preencha todos os campos");
        return;
    }

    if(atual !== senhaSalva){
        alert("Senha atual incorreta");
        return;
    }

    if(nova.length < 4){
        alert("A senha deve ter pelo menos 4 caracteres");
        return;
    }

    if(nova !== confirmar){
        alert("As senhas não conferem");
        return;
    }

    localStorage.setItem("senhaUsuario", nova);

    alert("Senha alterada com sucesso!");

    // limpa campos
    document.getElementById("senhaAtual").value = "";
    document.getElementById("novaSenha").value = "";
    document.getElementById("confirmarSenha").value = "";

    document.getElementById("alterarSenhaBox").style.display = "none";
}

// CARREGAR DADOS
window.onload = function(){

    const tel = localStorage.getItem("telefoneUsuario");
    const nomeSalvo = localStorage.getItem("nomeUsuario");

    if(tel) telefone.value = tel;
    if(nomeSalvo) nome.value = nomeSalvo;
}
