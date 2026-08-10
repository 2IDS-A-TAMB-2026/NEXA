<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Câmeras</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/acessibilidade.css">
    <link rel="stylesheet" href="assets/css/style_geral.css">
    <link rel="stylesheet" href="assets/css/cadastro_camera.css">

  

</head>

<body>
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

 <aside class="sidebar">

    <!-- FUNDO -->
    <img
        class="sidebar-construction"
        src="<?= base_url('assets/images/construcao.jpg') ?>"
        alt=""
    >

    <!-- CONTEÚDO -->
    <div class="sidebar-content">

        <div class="sidebar-logo">

    <img src="<?= base_url('assets/images/logo_escura_transparente.png') ?>">

    <div class="sidebar-brand-text">
        <strong>NEXA</strong>
        <span>Segurança é prioridade</span>
    </div>

</div>


        <nav class="menu">

            <div class="menu-title">PRINCIPAL</div>

            <a href="<?= base_url('/dashboard') ?>">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>

            <a href="<?= base_url('/dashboard_camera') ?>">
                <i class="fas fa-video"></i>
                <span>Dashboard de Câmeras</span>
            </a>

            <a href="<?= base_url('/ocorrencia') ?>">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Ocorrências</span>
            </a>


            <div class="menu-title">CADASTROS</div>

            <a href="<?= base_url('/cadastro-funcionario') ?>">
                <i class="fas fa-users"></i>
                <span>Cadastro Funcionários</span>
            </a>

            <a href="<?= base_url('/epi') ?>">
                <i class="fas fa-helmet-safety"></i>
                <span>Cadastro EPIs</span>
            </a>

            <a href="<?= base_url('/Camera') ?>"  class="active">
                <i class="fas fa-camera"></i>
                <span>Cadastro Câmeras</span>
            </a>

            <a href="<?= base_url('/setor') ?>">
                <i class="fas fa-building"></i>
                <span>Cadastro Setores</span>
            </a>


            <div class="menu-title">CONTA</div>

            <a href="<?= base_url('/administrador') ?>">
                <i class="fas fa-user"></i>
                <span>Perfil</span>
            </a>

        </nav>


        <a href="<?= base_url('/') ?>" class="logout-item">
            <i class="fas fa-sign-out-alt"></i>
            <span>Sair do Sistema</span>
        </a>

    </div>

</aside>
    <header class="dashboard-header">
<div class="header-left">

    
    <div class="header-title">
        <h1>Cadastro de Câmeras</h1>
        <p>Gerencie as câmeras de segurança da sua empresa</p>
    </div>

</div>

<div class="header-right">

    
      
    </button>

    <div class="profile">

        </div>

      <a href="<?= base_url('/administrador') ?>" class="profile">


<div class="profile-avatar">

<?= strtoupper(substr(session()->get('nome'),0,1)) ?>

</div>



<div class="profile-info">

<strong>
<?= esc(session()->get('nome')) ?>
</strong>


<span>
NEXA SOLUÇÕES
</span>


</div>





</a>

</div>

</header>

    <div class="access-menu">
        <button class="gear-btn" onclick="toggleAccessMenu()">
            <i class="fas fa-cog"></i>
        </button>

        <div class="access-options" id="accessOptions">
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
    </div>

    <div class="overlay">
        <div class="content-container">

   

          
    <div class="cadastro-box">

    <div class="cadastro-topo">

        <div class="cadastro-info">

            <div class="camera-icon-bg">
                <i class="fas fa-video"></i>
            </div>

            <div>

                <h2>Cadastrar Nova Câmera</h2>

                <p>
                    Preencha as informações para adicionar uma nova câmera ao sistema.
                </p>

            </div>

        </div>

        <div class="camera-ilustracao">
            <img src="assets/images/camera_cadastro.png">
        </div>

    </div>

    <div class="subtitle">
        Informações
    </div>

    

               
                <form method="post" action="<?= base_url('/Camera/inserir') ?>" onsubmit="return validarCadastro()">
<div class="form-grid">
                    <div class="form-group">
                        <p class= "p-card">Nome</p>
                        <div class="input-box">
                            <i class="fas fa-video"></i>
                           
                            <input type="text" id="nome" name="nome" placeholder="Nome...">
                        </div>
                        <div class="error-text"></div>
                    </div>
                <div class="row-fields">
                    <div class="form-group">
                        <p class= "p-card">Status</p>
                        <div class="input-box select">
   <i id="iconeStatus" class="fas fa-toggle-on"></i>                            <select id="status" name="status">
                                <option value="">Selecione o status</option>
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                            </select>
                        </div>
                        <div class="error-text"></div>
                    </div>

                    <div class="form-group">
                        <p class= "p-card">Setor</p>
                        <div class="input-box select">
                            <i class="fas fa-building"></i>
                            <select id="idSetor" name="idSetor">
                                <option value="">Selecione o setor</option>
                                <?php foreach ($setor as $s): ?>
                                    <option value="<?= trim($s['ID']) ?>"><?= $s['NOME'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="error-text"></div>
                    </div>
                </div>
                                </div>

                    <div class="btn-area">
                        <button type="submit"><i class="fas fa-plus"></i>   Cadastrar </button>
                    </div>
                </form>
            </div>

            

          <div class="listagem-box">

    <div class="listagem-header">

        <div>

            <h2>Câmeras Cadastradas</h2>

            <p>Gerencie todas as câmeras cadastradas no sistema.</p>

        </div>

        <div class="table-tools">

            <div class="search-box">

                <i class="fas fa-search"></i>

                <input
                    type="text"
                    id="pesquisaCamera"
                    placeholder="Pesquisar câmera...">

            </div>

            <button class="filter-btn">

                <i class="fas fa-filter"></i>

            </button>

        </div>

    </div>

    <div class="table-wrapper">
        <table class="table-cameras">

   <colgroup>

<col style="width:35%">

<col style="width:30%">

<col style="width:20%">

<col style="width:15%">

</colgroup>

   <thead>
<tr>

<th>Câmera</th>

<th>Setor</th>

<th>Status</th>

<th>Ações</th>

</tr>
</thead>



    <tbody id="lista"></tbody>

</table>

    </div>

    <div class="table-footer">

    <div class="rows-page">

        Mostrar

        <select id="linhasPagina">

            <option value="5" selected>5</option>
            <option value="10">10</option>
            <option value="20">20</option>

        </select>

        por página

    </div>

    <div id="infoTabela">

        Mostrando 0 de 0

    </div>

    <div class="pagination">

        <button id="anterior">

            <i class="fas fa-chevron-left"></i>

        </button>

        <span id="paginaAtual">1</span>

        <button id="proximo">

            <i class="fas fa-chevron-right"></i>

        </button>

    </div>

</div>

</div>

        </div>
    </div>

    <script>
        // =====================================================================
// DADOS
// =====================================================================
// =====================================================================
// DADOS
// =====================================================================

const setores = <?= json_encode($setor) ?>;

const mapaSetores = {};

setores.forEach(s => {
    mapaSetores[s.ID] = s.NOME;
});

let cameras = <?= json_encode($cameras ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

let paginaAtual = 1;
let linhasPorPagina = 5;
let camerasFiltradas = [...cameras];

// =====================================================================
// INICIALIZAÇÃO
// =====================================================================

window.onload = function () {

    const status = document.getElementById("status");

    if (status) {

        atualizarIconeStatus(status.value);

        status.addEventListener("change", function () {
            atualizarIconeStatus(this.value);
        });

    }

    iniciarEventos();

    renderizar();

};

// =====================================================================
// ÍCONE DO STATUS
// =====================================================================

function atualizarIconeStatus(valor) {

    const icone = document.querySelector("#status")
        .closest(".input-box")
        .querySelector("i");

    switch (valor) {

        case "Ativo":
            icone.className = "fas fa-toggle-on";
            break;

        case "Inativo":
            icone.className = "fas fa-toggle-off";
            break;

        default:
            icone.className = "fas fa-toggle-on";
            break;

    }

}

// =====================================================================
// EVENTOS
// =====================================================================

function iniciarEventos() {

    const pesquisa = document.getElementById("pesquisaCamera");

    if (pesquisa) {

        pesquisa.addEventListener("input", function () {

            paginaAtual = 1;
            aplicarPesquisa();

        });

    }

    const select = document.getElementById("linhasPagina");

    if (select) {

        select.addEventListener("change", function () {

            linhasPorPagina = parseInt(this.value);

            paginaAtual = 1;

            renderizar();

        });

    }

    const anterior = document.getElementById("anterior");

    if (anterior) {

        anterior.onclick = function () {

            if (paginaAtual > 1) {

                paginaAtual--;

                renderizar();

            }

        };

    }

    const proximo = document.getElementById("proximo");

    if (proximo) {

        proximo.onclick = function () {

            const totalPaginas =
                Math.ceil(camerasFiltradas.length / linhasPorPagina);

            if (paginaAtual < totalPaginas) {

                paginaAtual++;

                renderizar();

            }

        };

    }

}

// =====================================================================
// PESQUISA
// =====================================================================

function aplicarPesquisa() {

    const texto =
        document
            .getElementById("pesquisaCamera")
            .value
            .toLowerCase()
            .trim();

    camerasFiltradas = cameras.filter(cam => {

        return (

            String(cam.ID)
                .toLowerCase()
                .includes(texto)

            ||

            String(cam.IDENTIFICADOR_CAMERA)
                .toLowerCase()
                .includes(texto)

            ||

            String(cam.STATUS)
                .toLowerCase()
                .includes(texto)

            ||

            String(cam.FK_CNPJ_EMPRESA)
                .toLowerCase()
                .includes(texto)

            ||

            String(cam.FK_ID_SETOR)
                .toLowerCase()
                .includes(texto)

        );

    });

    renderizar();

}


// =====================================================================
// RENDERIZAÇÃO
// =====================================================================

function renderizar() {

    const lista = document.getElementById("lista");

    lista.innerHTML = "";

    if (camerasFiltradas.length === 0) {

        lista.innerHTML = `

        <tr>

            <td colspan="4" class="mensagem-vazia">

                <i class="fas fa-video-slash"></i>

                <br><br>

                Nenhuma câmera encontrada.

            </td>

        </tr>

        `;

        atualizarRodape(0, 0, 0);

        return;

    }

    const inicio = (paginaAtual - 1) * linhasPorPagina;

    const fim = inicio + linhasPorPagina;

    const pagina = camerasFiltradas.slice(inicio, fim);

    pagina.forEach(cam => {

        const statusClasse =
            cam.STATUS.toLowerCase() === "ativo"
                ? "status-ativo"
                : "status-inativo";

        lista.innerHTML += `

        <tr>

            <td>

                <strong>${cam.IDENTIFICADOR_CAMERA}</strong>

            </td>

            <td>

                <i class="fas fa-building"
                   style="color:#0A66C2;margin-right:6px;"></i>

                ${mapaSetores[cam.FK_ID_SETOR] || "Sem setor"}

            </td>

            <td>

                <span class="${statusClasse}">

                    <i class="fas fa-circle"
                       style="font-size:8px;"></i>

                    ${cam.STATUS}

                </span>

            </td>

            <td>

                <div class="table-actions">

                    <button
                        class="table-action edit"
                        onclick="editarCamera(${cam.ID})">

                        <i class="fas fa-pen"></i>

                    </button>

                    <button
                        class="table-action delete"
                        onclick="excluir_db(${cam.ID})">

                        <i class="fas fa-trash"></i>

                    </button>

                </div>

            </td>

        </tr>

        `;

    });

    atualizarRodape(

        inicio + 1,

        Math.min(fim, camerasFiltradas.length),

        camerasFiltradas.length

    );

}

// =====================================================================
// RODAPÉ DA TABELA
// =====================================================================

function atualizarRodape(inicio, fim, total) {

    document.getElementById("infoTabela").innerHTML =
        `Mostrando ${inicio} a ${fim} de ${total}`;

    document.getElementById("paginaAtual").innerHTML =
        paginaAtual;

    const totalPaginas =
        Math.max(1, Math.ceil(total / linhasPorPagina));

    document.getElementById("anterior").disabled =
        paginaAtual === 1;

    document.getElementById("proximo").disabled =
        paginaAtual >= totalPaginas;

}

// =====================================================================
// EDITAR CÂMERA
// =====================================================================

function editarCamera(id) {

    const cam = cameras.find(c => c.ID == id);

    if (!cam) return;

    Swal.fire({

        title: "Editar câmera",

        width: 600,

        html: `

            <input
                id="swalNome"
                class="swal2-input"
                placeholder="Nome da câmera"
                value="${cam.IDENTIFICADOR_CAMERA}">

            <select
                id="swalStatus"
                class="swal2-select">

                <option value="Ativo"
                    ${cam.STATUS === "Ativo" ? "selected" : ""}>
                    Ativo
                </option>

                <option value="Inativo"
                    ${cam.STATUS === "Inativo" ? "selected" : ""}>
                    Inativo
                </option>

            </select>

            <select
                id="swalSetor"
                class="swal2-select">

                <?php foreach($setor as $s): ?>

                    <option value="<?= trim($s['ID']) ?>">

                        <?= $s['NOME'] ?>

                    </option>

                <?php endforeach; ?>

            </select>

        `,

        didOpen() {

            document.getElementById("swalSetor").value =
                cam.FK_ID_SETOR;

        },

        showCancelButton: true,

        confirmButtonText: "Salvar",

        cancelButtonText: "Cancelar",

        confirmButtonColor: "#0A66C2",

        preConfirm() {

            const nome =
                document.getElementById("swalNome")
                    .value
                    .trim();

            const status =
                document.getElementById("swalStatus").value;

            const setor =
                document.getElementById("swalSetor").value;

            if (nome === "") {

                Swal.showValidationMessage(
                    "Informe o nome da câmera."
                );

                return false;

            }

            if (setor === "") {

                Swal.showValidationMessage(
                    "Selecione um setor."
                );

                return false;

            }

            return {

                nome,
                status,
                setor

            };

        }

    }).then(result => {

        if (!result.isConfirmed) return;

        const dados = result.value;

        const form = document.createElement("form");

        form.method = "POST";

        form.action =
            `<?= base_url('/Camera/atualizar/') ?>/${cam.ID}`;

        form.innerHTML = `

            <input
                type="hidden"
                name="nome"
                value="${dados.nome}">

            <input
                type="hidden"
                name="status"
                value="${dados.status}">

            <input
                type="hidden"
                name="idSetor"
                value="${dados.setor}">

        `;

        document.body.appendChild(form);

        form.submit();

    });

}

// =====================================================================
// EXCLUIR CÂMERA
// =====================================================================

function excluir_db(id) {

    Swal.fire({

        title: "Excluir câmera?",

        text: "Essa ação não poderá ser desfeita.",

        icon: "warning",

        showCancelButton: true,

        confirmButtonText: "Excluir",

        cancelButtonText: "Cancelar",

        confirmButtonColor: "#d33",

        cancelButtonColor: "#0A66C2"

    }).then(result => {

        if (result.isConfirmed) {

            window.location.href =
                `<?= base_url('/Camera/excluir/') ?>/${id}`;

        }

    });

}

// =====================================================================
// VALIDAÇÃO DO CADASTRO
// =====================================================================

function validarCadastro() {

    let ok = true;

    const nome = document.getElementById("nome");
    const status = document.getElementById("status");
    const setor = document.getElementById("idSetor");

    [nome, status, setor].forEach(clearError);

    if (!validarObrigatorio(nome))
        ok = false;

    if (!validarObrigatorio(status))
        ok = false;

    if (!validarObrigatorio(setor))
        ok = false;

    if (!ok) {

        Swal.fire({

            icon: "warning",

            title: "Campos obrigatórios",

            text: "Preencha todos os campos destacados.",

            confirmButtonColor: "#0A66C2"

        });

    }

    return ok;

}

// =====================================================================
// VALIDA CAMPO OBRIGATÓRIO
// =====================================================================

function validarObrigatorio(input, msg = "Campo obrigatório") {

    if (!input.value.trim()) {

        setError(input, msg);

        input.addEventListener("input", function () {
            clearError(input);
        }, { once: true });

        input.addEventListener("change", function () {
            clearError(input);
        }, { once: true });

        return false;

    }

    clearError(input);

    return true;

}

// =====================================================================
// EXIBE ERRO
// =====================================================================

function setError(input, msg) {

    const group = input.closest(".form-group");

    if (!group) return;

    const box = group.querySelector(".input-box");

    if (box)
        box.classList.add("error");

    const erro = group.querySelector(".error-text");

    if (erro)
        erro.innerHTML = msg;

}

// =====================================================================
// REMOVE ERRO
// =====================================================================

function clearError(input) {

    const group = input.closest(".form-group");

    if (!group) return;

    const box = group.querySelector(".input-box");

    if (box)
        box.classList.remove("error");

    const erro = group.querySelector(".error-text");

    if (erro)
        erro.innerHTML = "";

}

// =====================================================================
// MENU DE ACESSIBILIDADE
// =====================================================================

function toggleAccessMenu() {

    const menu = document.getElementById("accessOptions");

    menu.style.display =
        menu.style.display === "flex"
            ? "none"
            : "flex";

}

// =====================================================================
// DARK MODE
// =====================================================================

function toggleDark() {

    document.body.classList.toggle("dark-mode");

}

// =====================================================================
// FECHA MENU AO CLICAR FORA
// =====================================================================

document.addEventListener("click", function (e) {

    const menu = document.getElementById("accessOptions");
    const gear = document.querySelector(".gear-btn");

    if (!menu || !gear) return;

    if (!menu.contains(e.target) && !gear.contains(e.target)) {

        menu.style.display = "none";

    }

});
</script>
    <script src="assets/js/acessibilidade.js"></script>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>


<?php if(session()->getFlashdata('success')): ?>

<script>
Swal.fire({
    icon: 'success',
    title: 'Sucesso!',
    text: '<?= session()->getFlashdata('success'); ?>',
    confirmButtonColor: '#0A66C2'
});
</script>

<?php endif; ?>


<?php if(session()->getFlashdata('error')): ?>

<script>
Swal.fire({
    icon: 'warning',
    title: 'Atenção!',
    text: '<?= session()->getFlashdata('error'); ?>',
    confirmButtonColor: '#0A66C2'
});


function atualizarIconeStatus(status) {

    const icone = document.getElementById("iconeStatus");

    if (status === "Ativo") {
        icone.className = "fas fa-toggle-on";
        icone.style.color = "#22c55e";
    }
    else if (status === "Inativo") {
        icone.className = "fas fa-toggle-off";
        icone.style.color = "#ef4444";
    }
    else {
        icone.className = "fas fa-toggle-on";
        icone.style.color = "#0A66C2";
    }

}



</script>

<?php endif; ?>
</body>

</html>