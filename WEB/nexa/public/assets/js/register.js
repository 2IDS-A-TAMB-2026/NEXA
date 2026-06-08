/* mascara cpf */
document.getElementById("cpf").addEventListener("input", function () {

    let cpf = this.value.replace(/\D/g, "");

    if (cpf.length > 3 && cpf.length <= 6) {
        cpf = cpf.slice(0, 3) + "." + cpf.slice(3);
    }
    else if (cpf.length > 6 && cpf.length <= 9) {
        cpf = cpf.slice(0, 3) + "." + cpf.slice(3, 6) + "." + cpf.slice(6);
    }
    else if (cpf.length > 9) {
        cpf = cpf.slice(0, 3) + "." + cpf.slice(3, 6) + "." + cpf.slice(6, 9) + "-" + cpf.slice(9, 11);
    }

    this.value = cpf;

});


/* mascara de telefone */
document.getElementById("telefone").addEventListener("input", function () {

    let telefone = this.value.replace(/\D/g, "");

    if (telefone.length > 2 && telefone.length <= 7) {
        telefone = "(" + telefone.slice(0, 2) + ") " + telefone.slice(2);
    }
    else if (telefone.length > 7) {
        telefone = "(" + telefone.slice(0, 2) + ") " +
            telefone.slice(2, 7) + "-" + telefone.slice(7, 11);
    }

    this.value = telefone;

});


/* mostra o codigo da empresa */
document.getElementById("tipo").addEventListener("change", function () {

    const campoEmpresa = document.getElementById("campoEmpresa");

    if (this.value === "funcionario") {
        campoEmpresa.style.display = "block";
    }
    else {
        campoEmpresa.style.display = "none";
    }

});


/* cadastrar */
document.getElementById("registerForm").addEventListener("submit", function (event) {

    event.preventDefault();

    const nome = document.getElementById("nome").value.trim();
    const cpf = document.getElementById("cpf").value.replace(/\D/g, "");
    const nascimento = document.getElementById("nascimento").value;
    const email = document.getElementById("email").value.trim();
    const telefone = document.getElementById("telefone").value.replace(/\D/g, "");
    const senha = document.getElementById("senha").value;
    const confirmar = document.getElementById("confirmar").value;
    const tipo = document.getElementById("tipo").value;
    const codigoEmpresa = document.getElementById("codigo_empresa").value.trim();


    /* campos obrigatorios */

    if (!nome || !cpf || !nascimento || !email || !telefone || !senha || !confirmar) {

        Swal.fire({
            title: "Campos obrigatórios",
            text: "Preencha todos os campos antes de continuar.",
            icon: "warning"
        });

        return;

    }


    /* cpf invalido*/

    if (cpf.length !== 11) {

        Swal.fire({
            title: "Erro no CPF",
            text: "Digite um CPF válido.",
            icon: "error"
        });

        return;

    }


    /* telefone invalido */

    if (telefone.length !== 11) {

        Swal.fire({
            title: "Erro no telefone",
            text: "Digite um telefone válido.",
            icon: "error"
        });

        return;

    }


    /* senha */

    if (senha.length < 6) {

        Swal.fire({
            title: "Erro na senha",
            text: "A senha deve ter no mínimo 6 caracteres.",
            icon: "error"
        });

        return;

    }


    /* confirma a senha */

    if (senha !== confirmar) {

        Swal.fire({
            title: "Erro de senha",
            text: "As senhas não conferem.",
            icon: "error"
        });

        return;

    }


    /* codigo empresa*/

    if (tipo === "funcionario" && codigoEmpresa === "") {

        Swal.fire({
            title: "Erro no cadastro",
            text: "Funcionários precisam informar o código da empresa.",
            icon: "error"
        });

        return;

    }

    /*sucesso*/

    Swal.fire({
        title: "Cadastro realizado",
        text: "Usuário cadastrado com sucesso.",
        icon: "success"
    }).then(() => {

        document.getElementById("registerForm").reset();

    });

});//capturar o formulário
const form = document.getElementById("formCadastro");

// Capturar os inputs
const nomeInput = document.getElementById("nome");
const codigoInput = document.getElementById("codigo");
const categoriaInput = document.getElementById("categoria");
const serieInput = document.getElementById("serie");
const fornecedorInput = document.getElementById("fornecedor");
const telefoneInput = document.getElementById("telefone");
const cnpjInput = document.getElementById("cnpj");
const precoInput = document.getElementById("preco");
const dataInput = document.getElementById("dataFabricacao");

//Capturar as mensagens de erro(span)
const erroNome = document.getElementById("erroNome");
const erroCodigo = document.getElementById("erroCodigo");
const erroCategoria = document.getElementById("erroCategoria");
const erroSerie = document.getElementById("erroSerie");
const erroFornecedor = document.getElementById("erroFornecedor");
const erroTelefone = document.getElementById("erroTelefone");
const erroCNPJ = document.getElementById("erroCNPJ");
const erroPreco = document.getElementById("erroPreco");
const erroData = document.getElementById("erroData");


// validação dos inputs
form.addEventListener("submit", function (event) {

    event.preventDefault();

    let formValidado = true;

    if (nomeInput.value.trim() === "") {
        erroNome.innerText = "O nome do produto é obrigatório!";
        nomeInput.style.border = "2px solid red";
        formValidado = false;
    } else {
        erroNome.innerText = "";
        nomeInput.style.border = "2px solid green";
    }

    if (codigoInput.value.trim() === "") {
        erroCodigo.innerText = "O código do produto é obrigatório!";
        codigoInput.style.border = "2px solid red";
        formValidado = false;
    } else {
        erroCodigo.innerText = "";
        codigoInput.style.border = "2px solid green";
    }

    if (categoriaInput.value === "") {
        erroCategoria.innerText = "A categoria do produto é obrigatória!";
        categoriaInput.style.border = "2px solid red";
        formValidado = false;
    } else {
        erroCategoria.innerText = "";
        categoriaInput.style.border = "2px solid green";
    }

    if (serieInput.value.trim() === "") {
        erroSerie.innerText = "O número de série é obrigatório!";
        serieInput.style.border = "2px solid red";
        formValidado = false;
    } else {
        erroSerie.innerText = "";
        serieInput.style.border = "2px solid green";
    }

    if (fornecedorInput.value.trim() === "") {
        erroFornecedor.innerText = "O fornecedor é obrigatório!";
        fornecedorInput.style.border = "2px solid red";
        formValidado = false;
    } else {
        erroFornecedor.innerText = "";
        fornecedorInput.style.border = "2px solid green";
    }

    if (telefoneInput.value.replace(/\D/g, "").length !== 11) {
        erroTelefone.innerText = "Telefone inválido!";
        telefoneInput.style.border = "2px solid red";
        formValidado = false;
    } else {
        erroTelefone.innerText = "";
        telefoneInput.style.border = "2px solid green";
    }

    if (cnpjInput.value.replace(/\D/g, "").length !== 14) {
        erroCNPJ.innerText = "CNPJ inválido!";
        cnpjInput.style.border = "2px solid red";
        formValidado = false;
    } else {
        erroCNPJ.innerText = "";
        cnpjInput.style.border = "2px solid green";
    }

    if (precoInput.value <= 0) {
        erroPreco.innerText = "Preço inválido!";
        precoInput.style.border = "2px solid red";
        formValidado = false;
    } else {
        erroPreco.innerText = "";
        precoInput.style.border = "2px solid green";
    }

    if (dataInput.value === "") {
        erroData.innerText = "A data de fabricação é obrigatória!";
        dataInput.style.border = "2px solid red";
        formValidado = false;
    } else {
        erroData.innerText = "";
        dataInput.style.border = "2px solid green";
    }


    if (formValidado === true) {

        Swal.fire({
            title: "Sucesso!",
            text: "Dados cadastrados com sucesso.",
            icon: "success",
            confirmButtonText: "OK"
        }).then(() => {
            window.location.reload(true);
        });

    }
    else {

        Swal.fire({
            title: "Erro no cadastro",
            text: "Verifique os campos obrigatórios.",
            icon: "error",
            confirmButtonText: "Corrigir"
        });

    }

});