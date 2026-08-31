<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXA | Cadastro de EPIs</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade_adm.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style_geral.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/epi.css') ?>">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Contêiner de Acessibilidade Posicionado */
        .access-menu {
            position: relative;
            display: flex;
            align-items: center;
        }

        /* Botão da Engrenagem */
        .gear-btn {
            background: transparent;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: #4a5568;
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            z-index: 2;
        }

        .gear-btn:hover {
            background-color: rgba(0, 0, 0, 0.06);
            color: #1a202c;
        }

        /* Menu HORIZONTAL posicionado à ESQUERDA da engrenagem */
.access-options {
    display: flex; /* Mantém a estrutura flexível */
    visibility: hidden; /* Oculta sem quebrar o layout */
    opacity: 0;
    pointer-events: none; /* Desativa cliques quando oculto */
    
    position: absolute;
    right: 100%;
    top: 50%;
    transform: translateY(-50%) translateX(10px);
    margin-right: 8px;
    
    flex-direction: row;
    align-items: center;
    gap: 6px;
    
    background-color: #ffffff;
    padding: 4px 8px;
    border-radius: 30px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.12);
    border: 1px solid #e2e8f0;
    z-index: 999; /* Garante que fique por cima de outros elementos */
    white-space: nowrap;
    
    transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s;
}

/* Exibição ativa via Classe */
.access-options.show {
    visibility: visible;
    opacity: 1;
    pointer-events: auto; /* Habilita cliques quando visível */
    transform: translateY(-50%) translateX(0);
}
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50%) translateX(10px);
            }
            to {
                opacity: 1;
                transform: translateY(-50%) translateX(0);
            }
        }

        /* Estilo dos Botões do Menu */
        .access-btn {
            background: transparent;
            border: none;
            padding: 6px 10px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
            color: #0A66C2;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .access-btn:hover {
            background-color: #edf2f7;
        }

        /* Compatibilidade com Modo Escuro */
        body.dark-mode .access-options {
            background-color: #2d3748;
            border-color: #4a5568;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.4);
        }

        body.dark-mode .access-btn {
            color: #63b3ed;
        }

        body.dark-mode .access-btn:hover {
            background-color: #4a5568;
        }

        body.dark-mode .gear-btn {
            color: #e2e8f0;
        }
    </style>
</head>

<body>

    <!-- ================= SIDEBAR ================= -->
    <aside class="sidebar">
        <img class="sidebar-construction" src="<?= base_url('assets/images/construcao.jpg') ?>" alt="Fundo construção">

        <div class="sidebar-content">
            <div class="sidebar-logo">
                <img src="<?= base_url('assets/images/logo_escura_transparente.png') ?>" alt="Logo NEXA">
                <div class="sidebar-brand-text">
                    <strong>NEXA</strong>
                    <span>Segurança é prioridade</span>
                </div>
            </div>

            <nav class="menu">
                <div class="menu-title">PRINCIPAL</div>

                <a href="<?= base_url('dashboard') ?>">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>

                <a href="<?= base_url('dashboard_camera') ?>">
                    <i class="fas fa-video"></i>
                    <span>Dashboard de Câmeras</span>
                </a>

                <a href="<?= base_url('ocorrencia') ?>">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Ocorrências</span>
                </a>

                <div class="menu-title">CADASTROS</div>

                <a href="<?= base_url('cadastro-funcionario') ?>">
                    <i class="fas fa-users"></i>
                    <span>Cadastro Funcionários</span>
                </a>

                <a href="<?= base_url('epi') ?>" class="active">
                    <i class="fas fa-helmet-safety"></i>
                    <span>Cadastro EPIs</span>
                </a>

                <a href="<?= base_url('Camera') ?>">
                    <i class="fas fa-camera"></i>
                    <span>Cadastro Câmeras</span>
                </a>

                <a href="<?= base_url('setor') ?>">
                    <i class="fas fa-building"></i>
                    <span>Cadastro Setores</span>
                </a>

                <div class="menu-title">CONTA</div>

                <a href="<?= base_url('administrador') ?>">
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

    <!-- ================= HEADER ================= -->
    <header class="dashboard-header">
        <div class="header-left">
            <div class="header-title">
                <h1>Cadastro de EPIs</h1>
                <p>Gerencie os equipamentos de proteção individual da sua empresa</p>
            </div>
        </div>

        <div class="header-right">
            <div class="access-menu">

                <div class="access-options" id="accessOptions">

                    <button class="access-btn" onclick="if(window.Acessibilidade) Acessibilidade.toggleContraste()" title="Alto Contraste">
                        <i class="fas fa-adjust"></i>
                    </button>

                    <button class="access-btn" onclick="toggleDark()" title="Modo Escuro">
                        <i class="fas fa-moon"></i>
                    </button>

                    <button class="access-btn" onclick="if(window.Acessibilidade) Acessibilidade.aumentarFonte()" title="Aumentar Fonte">
                        A+
                    </button>

                    <button class="access-btn" onclick="if(window.Acessibilidade) Acessibilidade.diminuirFonte()" title="Diminuir Fonte">
                        A-
                    </button>

                    <button class="access-btn" onclick="if(window.Acessibilidade) Acessibilidade.lerPagina()" title="Ler Página">
                        <i class="fas fa-volume-up"></i>
                    </button>

                </div>

                <button class="gear-btn" onclick="toggleAccessMenu()" title="Opções de Acessibilidade">
                    <i class="fas fa-cog"></i>
                </button>

            </div>

            <a href="<?= base_url('/administrador') ?>" class="profile">
                <div class="profile-avatar">
                    <?= strtoupper(substr(session()->get('nome') ?? 'A', 0, 1)) ?>
                </div>
                <div class="profile-info">
                    <strong><?= esc(session()->get('nome')) ?></strong>
                    <span>NEXA SOLUÇÕES</span>
                </div>
            </a>
        </div>
    </header>

    <!-- ================= CONTEÚDO ================= -->
    <div class="overlay">
        <div class="content-container">

            <!-- ================= CADASTRO ================= -->
            <div class="cadastro-box">
                <div class="cadastro-topo">
                    <div class="cadastro-info">
                        <div class="camera-icon-bg">
                            <i id="epiIconeCadastro" class="fas fa-helmet-safety"></i>
                        </div>
                        <div>
                            <h2>Cadastrar Novo EPI</h2>
                            <p>Preencha as informações para adicionar um novo equipamento ao sistema.</p>
                        </div>
                    </div>

                    <div class="camera-ilustracao">
                        <img src="<?= base_url('assets/images/oculos.png') ?>" alt="Ilustração EPI">
                    </div>
                </div>

                <div class="subtitle">Informações</div>

                <form method="post" action="<?= base_url('epi/inserir') ?>" id="inserir_epi" enctype="multipart/form-data">
                    <div class="form-grid">
                        <div class="form-group">
                            <p class="p-card">Nome do EPI</p>
                            <div class="input-box select">
                                <i id="iconeCadastroEpi" class="fas fa-helmet-safety"></i>
                                <select id="nome_epi" name="nome_epi">
                                    <option value="">Selecione o EPI</option>
                                    <option value="Capacete">Capacete</option>
                                    <option value="Luvas">Luvas</option>
                                    <option value="Óculos de proteção">Óculos de proteção</option>
                                    <option value="Botas de segurança">Botas de segurança</option>
                                    <option value="Máscara">Máscara</option>
                                    <option value="Colete">Colete</option>
                                    <option value="Protetor auricular">Protetor auricular</option>
                                </select>
                            </div>
                            <div class="error-text"></div>
                        </div>

                        <div class="form-group">
                            <p class="p-card">Imagem do EPI</p>
                            <div class="input-box">
                                <i class="fas fa-image"></i>
                                <input type="file" id="imagem_epi" name="imagem_epi">
                            </div>
                            <div class="error-text"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <p class="p-card">Descrição do EPI</p>
                        <div class="input-box">
                            <i class="fas fa-align-left"></i>
                            <textarea id="des_epi" name="des_epi" placeholder="Descreva o equipamento, finalidade e recomendações de uso..."></textarea>
                        </div>
                        <div class="error-text"></div>
                    </div>

                    <div class="btn-area">
                        <button type="submit">
                            <i class="fas fa-plus"></i> Cadastrar
                        </button>
                    </div>
                </form>
            </div>

            <!-- ================= LISTAGEM ================= -->
            <div class="listagem-box">
                <div class="listagem-header">
                    <div>
                        <h2>EPIs Cadastrados</h2>
                        <p>Gerencie todos os equipamentos cadastrados no sistema.</p>
                    </div>

                    <div class="table-tools">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="pesquisaEpi" placeholder="Pesquisar EPI...">
                        </div>
                        <!-- Botão de filtro funcional -->
                        <button class="filter-btn" id="btnFiltrarEpi" onclick="abrirModalFiltro()" title="Filtrar e Ordenar">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table class="table-cameras">
                        <colgroup>
                            <col style="width:25%">
                            <col style="width:25%">
                            <col style="width:25%">
                            <col style="width:25%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>EPI</th>
                                <th>Descrição</th>
                                <th>Imagem</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="lista"></tbody>
                    </table>
                </div>

                <!-- ================= RODAPÉ ================= -->
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

                    <div id="infoTabela">Mostrando 0 de 0</div>

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

    <!-- ================= JAVASCRIPT ================= -->
    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>

    <script>
        let epis = <?= json_encode(
            $epis ?? [],
            JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
        ) ?> || [];

        let episFiltrados = [...epis];
        let paginaAtual = 1;
        let linhasPorPagina = 5;
        let ordemAtual = 'asc';

        window.onload = function () {
            renderizar();
            iniciarEventos();
        };

        function iniciarEventos() {
            const pesquisa = document.getElementById("pesquisaEpi");
            if (pesquisa) {
                pesquisa.addEventListener("input", function () {
                    paginaAtual = 1;
                    aplicarPesquisa();
                });
            }

            const linhas = document.getElementById("linhasPagina");
            if (linhas) {
                linhas.addEventListener("change", function () {
                    linhasPorPagina = parseInt(this.value);
                    paginaAtual = 1;
                    renderizar();
                });
            }

            const btnAnterior = document.getElementById("anterior");
            if (btnAnterior) {
                btnAnterior.onclick = function () {
                    if (paginaAtual > 1) {
                        paginaAtual--;
                        renderizar();
                    }
                };
            }

            const btnProximo = document.getElementById("proximo");
            if (btnProximo) {
                btnProximo.onclick = function () {
                    let totalPaginas = Math.ceil(episFiltrados.length / linhasPorPagina);
                    if (paginaAtual < totalPaginas) {
                        paginaAtual++;
                        renderizar();
                    }
                };
            }
        }

        function aplicarPesquisa() {
            let texto = document.getElementById("pesquisaEpi").value.toLowerCase().trim();

            episFiltrados = epis.filter(epi => {
                return (
                    String(epi.ID || "").toLowerCase().includes(texto) ||
                    String(epi.NOME_EPI || "").toLowerCase().includes(texto) ||
                    String(epi.DESCRICAO_EPI || "").toLowerCase().includes(texto) ||
                    String(epi.IMAGEM_EPI || "").toLowerCase().includes(texto)
                );
            });

            renderizar();
        }

        function abrirModalFiltro() {
            Swal.fire({
                title: 'Ordenar EPIs',
                html: `
                    <div style="text-align:left; font-size: 0.95rem;">
                        <label style="display:block; margin-bottom:8px; font-weight:600;">Ordem Alfabética:</label>
                        <select id="swalOrdem" class="swal2-select" style="width:100%; margin:0 0 15px 0;">
                            <option value="asc" ${ordemAtual === 'asc' ? 'selected' : ''}>A-Z (Crescente)</option>
                            <option value="desc" ${ordemAtual === 'desc' ? 'selected' : ''}>Z-A (Decrescente)</option>
                        </select>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Aplicar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#0A66C2',
                preConfirm: () => {
                    return document.getElementById('swalOrdem').value;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    ordemAtual = result.value;
                    episFiltrados.sort((a, b) => {
                        let nomeA = (a.NOME_EPI || '').toLowerCase();
                        let nomeB = (b.NOME_EPI || '').toLowerCase();
                        if (ordemAtual === 'asc') return nomeA.localeCompare(nomeB);
                        return nomeB.localeCompare(nomeA);
                    });
                    paginaAtual = 1;
                    renderizar();
                }
            });
        }

        function iconeEpi(nome) {
            if (!nome) return "fa-shield-halved";
            nome = nome.toLowerCase();

            if (nome.includes("capacete")) return "fa-helmet-safety";
            if (nome.includes("luva")) return "fa-mitten";
            if (nome.includes("óculos") || nome.includes("oculos")) return "fa-glasses";
            if (nome.includes("bota")) return "fa-shoe-prints";
            if (nome.includes("máscara") || nome.includes("mascara")) return "fa-mask-face";
            if (nome.includes("colete")) return "fa-vest";
            if (nome.includes("protetor auricular")) return "fa-headphones";

            return "fa-shield-halved";
        }

        const selectNomeEpi = document.getElementById("nome_epi");
        if (selectNomeEpi) {
            selectNomeEpi.addEventListener("change", function () {
                let icone = document.getElementById("iconeCadastroEpi");
                let iconeTopo = document.getElementById("epiIconeCadastro");
                let iconeClasse = "fas " + iconeEpi(this.value);
                
                if (icone) icone.className = iconeClasse;
                if (iconeTopo) iconeTopo.className = iconeClasse;
            });
        }

        function renderizar() {
            let lista = document.getElementById("lista");
            if (!lista) return;

            lista.innerHTML = "";

            if (episFiltrados.length === 0) {
                lista.innerHTML = `
                    <tr>
                        <td colspan="4" class="mensagem-vazia" style="text-align:center; padding: 20px;">
                            <i class="fas fa-helmet-safety" style="font-size: 2rem; color: #cbd5e1;"></i>
                            <br><br>
                            Nenhum EPI encontrado.
                        </td>
                    </tr>
                `;
                atualizarRodape(0, 0, 0);
                return;
            }

            let inicio = (paginaAtual - 1) * linhasPorPagina;
            let fim = inicio + linhasPorPagina;
            let pagina = episFiltrados.slice(inicio, fim);

            pagina.forEach(e => {
                lista.innerHTML += `
                    <tr>
                        <td>
                            <i class="fas ${iconeEpi(e.NOME_EPI)}" style="color:#0A66C2;margin-right:8px;"></i>
                            ${e.NOME_EPI}
                        </td>
                        <td>${e.DESCRICAO_EPI || ''}</td>
                        <td>
                            ${e.IMAGEM_EPI
                                ? `<img src="<?= base_url('uploads/epis/') ?>${e.IMAGEM_EPI}" class="epi-img-table" style="max-height:40px; border-radius:4px;">`
                                : `<span style="color:#94a3b8">Sem imagem</span>`
                            }
                        </td>
                        <td>
                            <div class="table-actions">
                                <button class="table-action edit" onclick="editarEpi(${e.ID})">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="table-action delete" onclick="excluirEpi(${e.ID})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });

            atualizarRodape(
                inicio + 1,
                Math.min(fim, episFiltrados.length),
                episFiltrados.length
            );
        }

        function atualizarRodape(inicio, fim, total) {
            const info = document.getElementById("infoTabela");
            const pagAtual = document.getElementById("paginaAtual");

            if (info) info.innerHTML = `Mostrando ${inicio} a ${fim} de ${total}`;
            if (pagAtual) pagAtual.innerHTML = paginaAtual;

            let totalPaginas = Math.max(1, Math.ceil(total / linhasPorPagina));

            const btnAnt = document.getElementById("anterior");
            const btnProx = document.getElementById("proximo");

            if (btnAnt) btnAnt.disabled = (paginaAtual === 1);
            if (btnProx) btnProx.disabled = (paginaAtual >= totalPaginas);
        }

        function editarEpi(id) {
            const epi = epis.find(e => e.ID == id);
            if (!epi) return;

            Swal.fire({
                title: 'Editar EPI',
                width: 600,
                html: `
                    <select id="swalNome" class="swal2-select" style="width:100%; margin-bottom: 10px;">
                        <option value="Capacete">Capacete</option>
                        <option value="Luvas">Luvas</option>
                        <option value="Óculos de proteção">Óculos de proteção</option>
                        <option value="Botas de segurança">Botas de segurança</option>
                        <option value="Máscara">Máscara</option>
                        <option value="Colete">Colete</option>
                        <option value="Protetor auricular">Protetor auricular</option>
                    </select>
                    <textarea id="swalDescricao" class="swal2-textarea" style="width:100%;" placeholder="Descrição">${epi.DESCRICAO_EPI || ''}</textarea>
                `,
                didOpen() {
                    document.getElementById("swalNome").value = epi.NOME_EPI;
                },
                showCancelButton: true,
                confirmButtonText: "Salvar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#0A66C2",
                preConfirm() {
                    let nome = document.getElementById("swalNome").value;
                    let descricao = document.getElementById("swalDescricao").value.trim();

                    if (descricao === "") {
                        Swal.showValidationMessage("Informe a descrição do EPI.");
                        return false;
                    }

                    return { nome, descricao };
                }
            }).then(result => {
                if (!result.isConfirmed) return;

                const dados = result.value;
                const form = document.createElement("form");
                form.method = "POST";
                form.action = `<?= base_url('epi/atualizar') ?>/${id}`;

                form.innerHTML = `
                    <input type="hidden" name="nome_epi" value="${dados.nome}">
                    <input type="hidden" name="des_epi" value="${dados.descricao}">
                `;

                document.body.appendChild(form);
                form.submit();
            });
        }

        function excluirEpi(id) {
            Swal.fire({
                title: "Excluir EPI?",
                text: "Essa ação não poderá ser desfeita.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                confirmButtonText: "Excluir",
                cancelButtonText: "Cancelar"
            }).then(result => {
                if (result.isConfirmed) {
                    window.location.href = `<?= base_url('epi/excluir') ?>/${id}`;
                }
            });
        }

        const formInserir = document.getElementById("inserir_epi");
        if (formInserir) {
            formInserir.addEventListener("submit", function (e) {
                let ok = true;

                const nome = document.getElementById("nome_epi");
                const imagem = document.getElementById("imagem_epi");
                const descricao = document.getElementById("des_epi");

                [nome, imagem, descricao].forEach(clearError);

                if (!nome.value.trim()) {
                    setError(nome, "Campo obrigatório");
                    ok = false;
                }

                if (imagem.files.length === 0) {
                    setError(imagem, "Campo obrigatório");
                    ok = false;
                }

                if (!descricao.value.trim()) {
                    setError(descricao, "Campo obrigatório");
                    ok = false;
                }

                if (!ok) {
                    e.preventDefault();
                    Swal.fire({
                        icon: "warning",
                        title: "Campos obrigatórios",
                        text: "Preencha todos os campos destacados.",
                        confirmButtonColor: "#0A66C2"
                    });
                }
            });
        }

        function setError(input, msg) {
            const group = input.closest(".form-group");
            if (!group) return;

            const box = group.querySelector(".input-box");
            if (box) box.classList.add("error");

            const erro = group.querySelector(".error-text");
            if (erro) erro.innerHTML = msg;
        }

        function clearError(input) {
            const group = input.closest(".form-group");
            if (!group) return;

            const box = group.querySelector(".input-box");
            if (box) box.classList.remove("error");

            const erro = group.querySelector(".error-text");
            if (erro) erro.innerHTML = "";
        }

        


    <?php if (session()->getFlashdata('sucesso')): ?>
   
    Swal.fire({
        icon: 'success',
        title: 'Sucesso!',
        text: <?= json_encode(session()->getFlashdata('sucesso')); ?>,
        confirmButtonColor: '#0A66C2'
    });
  
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>

    Swal.fire({
        icon: 'error',
        title: 'Erro!',
        text: <?= json_encode(session()->getFlashdata('error')); ?>,
        confirmButtonColor: '#0A66C2'
    });

    <?php endif; ?>

    <!-- COMPONENTE VLIBRAS -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
  
    
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>


</body>
</html>