// tipo de usuário
// alterar para "admin" quando for administrador
let tipoUsuario = "funcionario";

// campos
const nome = document.getElementById("nome");
const telefone = document.getElementById("telefone");
const cpf = document.getElementById("cpf");
const nascimento = document.getElementById("nascimento");
const email = document.getElementById("email");
const tipo = document.getElementById("tipo");
const rfid = document.getElementById("rfid");
const epis = document.getElementById("epis");

// botões
const btnEdit = document.querySelector(".Btn.edit");
const btnSave = document.querySelector(".Btn.save");
const btnCancel = document.querySelector(".Btn.cancel");

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

}else{

// funcionário só pode editar nome e telefone
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

btnEdit.style.display = "flex";
btnSave.style.display = "none";
btnCancel.style.display = "none";

alert("Dados atualizados com sucesso!");

}

// CANCELAR
function cancelar(){

location.reload();

}

// MOSTRAR ALTERAR SENHA
function mostrarAlterarSenha(){

document.getElementById("alterarSenhaBox").style.display = "block";

}

// ALTERAR SENHA
function alterarSenha(){

const atual = document.getElementById("senhaAtual").value;
const nova = document.getElementById("novaSenha").value;
const confirmar = document.getElementById("confirmarSenha").value;

if(!atual || !nova || !confirmar){

alert("Preencha todos os campos");
return;

}

if(nova !== confirmar){

alert("As senhas não conferem");
return;

}

alert("Senha alterada com sucesso!");

document.getElementById("alterarSenhaBox").style.display = "none";

}