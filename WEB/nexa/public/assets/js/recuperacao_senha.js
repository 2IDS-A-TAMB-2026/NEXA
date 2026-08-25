// ==========================================
// 1. FUNÇÕES DE ACESSIBILIDADE
// ==========================================

// Alternar exibição do menu de acessibilidade
function toggleAccessMenu() {
    const menu = document.getElementById('accessOptions');
    menu.classList.toggle('active');
}

// Fechar o menu de acessibilidade ao clicar fora dele
document.addEventListener('click', function(event) {
    const accessDiv = document.querySelector('.header-access');
    if (accessDiv && !accessDiv.contains(event.target)) {
        document.getElementById('accessOptions').classList.remove('active');
    }
});

// Aumentar/Diminuir Tamanho da Fonte
let tamanhoFonteAtual = 100; // Porcentagem
function alterarFonte(delta) {
    tamanhoFonteAtual += delta * 10;
    if (tamanhoFonteAtual >= 80 && tamanhoFonteAtual <= 140) {
        document.body.style.fontSize = tamanhoFonteAtual + '%';
    }
}

// Alternar Alto Contraste
function toggleContraste() {
    document.body.classList.toggle('alto-contraste');
}

// ==========================================
// 2. VALIDAÇÃO DO FORMULÁRIO DE RECUPERAÇÃO
// ==========================================
const form = document.getElementById('form_recuperacao');
const msgErro = document.getElementById('mensagem_erro');
const ref = '123456'; // Validação falsa para testes

form.addEventListener('submit', function(event) {
    event.preventDefault();

    // Pegando os elementos dos inputs
    const inputCodigo = document.getElementById('codigo');
    const inputSenha = document.getElementById('novasenha');
    const inputConfirmar = document.getElementById('confirmar');

    // Pegando os valores
    const codigoIPT = inputCodigo.value.trim();
    const senhaIPT = inputSenha.value;
    const confirmarIPT = inputConfirmar.value;

    let erros = [];

    // 1. Validação do Código
    if (codigoIPT !== ref) {
        erros.push("Código de verificação inválido.");
        inputCodigo.style.borderColor = 'red';
    } else {
        inputCodigo.style.borderColor = '#ccc';
    }

    // 2. Validação da Senha
    if (senhaIPT.length < 6) {
        erros.push("A senha deve ter no mínimo 6 caracteres.");
        inputSenha.style.borderColor = 'red';
    } else {
        inputSenha.style.borderColor = '#ccc';
    }

    // 3. Confirmação da Senha
    if (senhaIPT !== confirmarIPT || confirmarIPT === '') {
        erros.push("As senhas não coincidem.");
        inputConfirmar.style.borderColor = 'red';
    } else {
        inputConfirmar.style.borderColor = '#ccc';
    }

    // Exibição dos Erros ou Sucesso
    if (erros.length > 0) {
        Swal.fire({
            title: "Campos inválidos",
            html: erros.join("<br>"),
            icon: "warning"
        });
    } else {
        Swal.fire({
            title: "Sucesso!",
            text: "Senha alterada com sucesso.",
            icon: "success",
            confirmButtonText: "OK"
        }).then(() => {
            window.location.reload();
        });
    }
});