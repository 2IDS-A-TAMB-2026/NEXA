let linhaEditando = null;

/* ABRIR MODAL */
function abrirModal() {
    linhaEditando = null;
    document.getElementById("modalTitulo").innerText = "Novo Usuário";
    document.getElementById("nome").value = "";
    document.getElementById("email").value = "";
    document.getElementById("tipo").value = "Operador";
    document.getElementById("modal").style.display = "block";
}

/* FECHAR MODAL */
function fecharModal() {
    document.getElementById("modal").style.display = "none";
}

/* SALVAR USUÁRIO */
function salvarUsuario() {
    const nome = document.getElementById("nome").value;
    const email = document.getElementById("email").value;
    const tipo = document.getElementById("tipo").value;

    if (!nome || !email) {
        Swal.fire({
            title: "Campos obrigatórios",
            text: "Preencha todos os campos antes de salvar.",
            icon: "warning"
        });
        return;
    }

    if (linhaEditando) {
        linhaEditando.cells[0].innerText = nome;
        linhaEditando.cells[1].innerText = email;
        linhaEditando.cells[2].innerText = tipo;

        Swal.fire({
            title: "Usuário atualizado",
            text: "Os dados foram alterados com sucesso.",
            icon: "success"
        });
    } else {
        const tabela = document.getElementById("tabelaUsuarios");
        const novaLinha = tabela.insertRow();

        novaLinha.innerHTML = `
            <td>${nome}</td>
            <td>${email}</td>
            <td>${tipo}</td>
            <td>
                <button class="btn btn-edit" onclick="editarUsuario(this)">Editar</button>
                <button class="btn btn-delete" onclick="excluirUsuario(this)">Excluir</button>
            </td>
        `;

        Swal.fire({
            title: "Usuário cadastrado",
            text: "O usuário foi adicionado com sucesso.",
            icon: "success"
        });
    }

    fecharModal();
}

/* EDITAR USUÁRIO */
function editarUsuario(botao) {
    linhaEditando = botao.parentElement.parentElement;

    document.getElementById("modalTitulo").innerText = "Editar Usuário";
    document.getElementById("nome").value = linhaEditando.cells[0].innerText;
    document.getElementById("email").value = linhaEditando.cells[1].innerText;
    document.getElementById("tipo").value = linhaEditando.cells[2].innerText;

    Swal.fire({
        title: "Modo edição ativado",
        text: "Você pode alterar os dados do usuário.",
        icon: "success",
        draggable: true
    });

    document.getElementById("modal").style.display = "block";
}

/* EXCLUIR USUÁRIO */
function excluirUsuario(botao) {
    Swal.fire({
        title: "Confirmar exclusão",
        text: "Deseja realmente excluir este usuário?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, excluir",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            botao.parentElement.parentElement.remove();

            Swal.fire({
                title: "Usuário excluído",
                text: "O usuário foi removido com sucesso.",
                icon: "success"
            });
        }
    });
}
