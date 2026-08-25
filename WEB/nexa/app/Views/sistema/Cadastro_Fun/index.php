<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionários</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade_adm.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style_geral.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/cadastro_funci.css') ?>">

    <style>
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .access-menu {
            position: relative;
            display: flex;
            align-items: center;
        }

        .gear-btn {
            background: transparent !important;
            border: none !important;
            outline: none !important;
            cursor: pointer;
            font-size: 1.2rem;
            color: #6c757d;
            padding: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s, transform 0.3s;
        }

        .gear-btn:hover {
            color: #2b3674;
            transform: rotate(45deg);
        }

        .access-options {
            display: none;
            position: absolute;
            top: 130%;
            right: 0;
            background: #ffffff;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.12);
            border-radius: 8px;
            padding: 8px;
            gap: 6px;
            z-index: 1000;
        }

        .access-options.show {
            display: flex;
        }

        .access-btn {
            background: #f4f7fe;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            color: #2b3674;
            font-weight: 600;
            transition: background 0.2s;
        }

        .access-btn:hover {
            background: #e0e5f2;
        }

        body.dark-mode {
            background-color: #0b1437 !important;
            color: #ffffff !important;
        }
        body.dark-mode .dashboard-header,
        body.dark-mode .form-card,
        body.dark-mode .list-card,
        body.dark-mode .sidebar {
            background-color: #111c44 !important;
            color: #ffffff !important;
        }
        body.dark-mode input, 
        body.dark-mode select {
            background-color: #1b254b !important;
            color: #ffffff !important;
            border-color: #2b3674 !important;
        }

        body.high-contrast {
            background-color: #000000 !important;
            color: #ffff00 !important;
        }
        body.high-contrast *,
        body.high-contrast input,
        body.high-contrast select,
        body.high-contrast button {
            background-color: #000000 !important;
            color: #ffff00 !important;
            border-color: #ffff00 !important;
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <img class="sidebar-construction" src="<?= base_url('assets/images/construcao.jpg') ?>" alt="">

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

                <a href="<?= base_url('/cadastro-funcionario') ?>" class="active">
                    <i class="fas fa-users"></i>
                    <span>Cadastro Funcionários</span>
                </a>

                <a href="<?= base_url('/epi') ?>">
                    <i class="fas fa-helmet-safety"></i>
                    <span>Cadastro EPIs</span>
                </a>

                <a href="<?= base_url('/Camera') ?>">
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
        <div class="header-title">
            <h1>Cadastro de Funcionários</h1>
            <p>Gerencie os funcionários cadastrados da sua empresa</p>
        </div>

        <div class="header-right">
            <div class="access-menu">
                <button class="gear-btn" onclick="toggleAccessMenu()" title="Acessibilidade">
                    <i class="fas fa-cog"></i>
                </button>

                <div class="access-options" id="accessOptions">
                    <button class="access-btn" onclick="Acessibilidade.toggleContraste()" title="Alto Contraste">
                        <i class="fas fa-adjust"></i>
                    </button>
                    <button class="access-btn" onclick="toggleDark()" title="Modo Escuro">
                        <i class="fas fa-moon"></i>
                    </button>
                    <button class="access-btn" onclick="Acessibilidade.aumentarFonte()" title="Aumentar Fonte">A+</button>
                    <button class="access-btn" onclick="Acessibilidade.diminuirFonte()" title="Diminuir Fonte">A-</button>
                    <button class="access-btn" onclick="Acessibilidade.lerPagina()" title="Ler Página">
                        <i class="fas fa-volume-up"></i>
                    </button>
                </div>
            </div>

            <a href="<?= base_url('/administrador') ?>" class="profile">
                <div class="profile-avatar">
                    <?= strtoupper(substr(session()->get('nome') ?? 'A', 0, 1)) ?>
                </div>
                <div class="profile-info">
                    <strong><?= esc(session()->get('nome') ?? 'Administrador') ?></strong>
                    <span>NEXA SOLUÇÕES</span>
                </div>
            </a>
        </div>
    </header>

    <div class="overlay">
        <div class="content-container">
            <section class="form-card">
                <div class="cadastro-topo">
                    <div class="cadastro-info">
                        <div class="funcionario-icon-bg">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div>
                            <h2>Cadastrar Novo Funcionário</h2>
                            <p>Preencha as informações para adicionar um novo funcionário ao sistema.</p>
                        </div>
                    </div>
                </div>

                <div class="subtitle">Informações</div>

                <form id="form-fun" action="<?= base_url('/Cadastro_Fun/inserir') ?>" method="post" onsubmit="return prepararEEnviar(this);">
                    <?= csrf_field() ?>
                    <input type="hidden" name="CPF_ORIGINAL" id="cpf_original">

                    <div class="form-grid">
                        <div class="form-group">
                            <p class="p-card">Nome completo</p>
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" id="nome" name="NOME_COMPLETO" placeholder="Nome completo" value="<?= old('NOME_COMPLETO') ?>" oninput="validarNome(this)" required>
                            </div>
                            <div class="error-text"></div>
                        </div>

                        <div class="form-group">
                            <p class="p-card">CPF</p>
                            <div class="input-box">
                                <i class="fas fa-id-card"></i>
                                <input type="text" id="cpf" name="CPF" placeholder="000.000.000-00" maxlength="14" oninput="maskCPF(this)" value="<?= old('CPF') ?>" required>
                            </div>
                            <div class="error-text"></div>
                        </div>

                        <div class="form-group">
                            <p class="p-card">Data de nascimento</p>
                            <div class="input-box">
                                <i class="fas fa-calendar"></i>
                                <input type="date" id="nascimento" name="DATA_NASCIMENTO" max="<?= date('Y-m-d') ?>" value="<?= old('DATA_NASCIMENTO') ?>" required>
                            </div>
                            <div class="error-text"></div>
                        </div>

                        <div class="form-group">
                            <p class="p-card">E-mail corporativo</p>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="email" name="EMAIL_CORPORATIVO" placeholder="E-mail corporativo" value="<?= old('EMAIL_CORPORATIVO') ?>" required>
                            </div>
                            <div class="error-text"></div>
                        </div>

                        <div class="form-group">
                            <p class="p-card">Telefone</p>
                            <div class="input-box">
                                <i class="fas fa-phone"></i>
                                <input type="text" id="telefone" name="TELEFONE" placeholder="(00) 00000-0000" maxlength="15" oninput="maskTel(this)" value="<?= old('TELEFONE') ?>">
                            </div>
                            <div class="error-text"></div>
                        </div>

                        <div class="form-group">
                            <p class="p-card">UID RFID</p>
                            <div class="input-box">
                                <i class="fas fa-wave-square"></i>
                                <input type="text" id="uid_rfid" name="UID_RFID" placeholder="UID RFID" value="<?= old('UID_RFID') ?>">
                            </div>
                            <div class="error-text"></div>
                        </div>

                        <div class="form-group">
                            <p class="p-card">Setor</p>
                            <div class="input-box select">
                                <i class="fas fa-building"></i>
                                <select id="id_setor" name="FK_ID_SETOR" required>
                                    <option value="">Selecione o setor</option>
                                    <?php if (!empty($setores)): ?>
                                        <?php foreach ($setores as $s): ?>
                                            <option value="<?= $s['ID'] ?>" <?= old('FK_ID_SETOR') == $s['ID'] ? 'selected' : '' ?>>
                                                <?= esc($s['NOME']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="error-text"></div>
                        </div>

                        <div class="form-group">
                            <p class="p-card">Senha</p>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="senha" name="SENHA" placeholder="Senha">
                            </div>
                            <div class="error-text"></div>
                        </div>

                        <div class="form-group">
                            <p class="p-card">Confirmar senha</p>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="confirmSenha" placeholder="Confirmar senha">
                            </div>
                            <div class="error-text"></div>
                        </div>

                        <div class="form-group full-width">
                            <p class="p-card">EPIs obrigatórios</p>
                            <div class="epi-container">
                                <button type="button" class="btn-selecionar-epi" onclick="abrirModalEPI()">
                                    <i class="fas fa-helmet-safety"></i>
                                    Selecionar EPIs
                                </button>
                                <div id="episSelecionados">
                                    Nenhum EPI selecionado
                                </div>
                                <input type="hidden" id="episHidden" name="EPIS">
                            </div>
                        </div>
                    </div>

                    <div class="btn-area">
                        <button type="button" id="btn-cancelar" class="btn-cancelar" style="display:none" onclick="resetarFormulario()">
                            <i class="fas fa-times"></i> Cancelar
                        </button>
                        <button type="submit" id="btn-salvar">
                            <i class="fas fa-user-plus"></i> Cadastrar Funcionário
                        </button>
                    </div>
                </form>

                <div class="form-ilustracao">
                    <img src="<?= base_url('assets/images/cartao.png') ?>" alt="Funcionário">
                </div>
            </section>

            <br>
            <section class="list-card">
                <div class="listagem-header">
                    <div>
                        <h2>Funcionários Cadastrados</h2>
                        <p>Gerencie todos os funcionários cadastrados no sistema.</p>
                    </div>

                    <div class="table-tools">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="pesquisaFuncionario" placeholder="Pesquisar funcionário...">
                        </div>
                        <button class="filter-btn">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table class="table-funcionarios">
                        <thead>
                            <tr>
                                <th>Funcionário</th>
                                <th>CPF</th>
                                <th>Data Nasc.</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>UID RFID</th>
                                <th>Setor</th>
                                <th>EPIs</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="listaFuncionarios"></tbody>
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
            </section>
        </div>
    </div>

    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>new window.VLibras.Widget('https://vlibras.gov.br/app');</script>

    <script>
        const Acessibilidade = {
            tamanhoFonteAtual: 100,

            aumentarFonte: function() {
                if (this.tamanhoFonteAtual < 140) {
                    this.tamanhoFonteAtual += 10;
                    document.body.style.fontSize = this.tamanhoFonteAtual + '%';
                }
            },

            diminuirFonte: function() {
                if (this.tamanhoFonteAtual > 70) {
                    this.tamanhoFonteAtual -= 10;
                    document.body.style.fontSize = this.tamanhoFonteAtual + '%';
                }
            },

            toggleContraste: function() {
                document.body.classList.remove('dark-mode');
                document.body.classList.toggle('high-contrast');
            },

            lerPagina: function() {
                if ('speechSynthesis' in window) {
                    if (window.speechSynthesis.speaking) {
                        window.speechSynthesis.cancel();
                        return;
                    }
                    const conteudo = document.querySelector('.content-container') || document.body;
                    const utterance = new SpeechSynthesisUtterance(conteudo.innerText);
                    utterance.lang = 'pt-BR';
                    utterance.rate = 1.1;
                    window.speechSynthesis.speak(utterance);
                } else {
                    alert('Seu navegador não suporta a leitura de texto por voz.');
                }
            }
        };

        function toggleDark() {
            document.body.classList.remove('high-contrast');
            document.body.classList.toggle('dark-mode');
        }

        function toggleAccessMenu() {
            const options = document.getElementById('accessOptions');
            if (options) {
                options.classList.toggle('show');
            }
        }

        document.addEventListener('click', function (event) {
            const menu = document.querySelector('.access-menu');
            if (menu && !menu.contains(event.target)) {
                document.getElementById('accessOptions')?.classList.remove('show');
            }
        });
    </script>

    <script>
        window.funcionariosData = <?= json_encode($funcionarios ?? [], JSON_UNESCAPED_UNICODE) ?>;
        window.setoresData = <?= json_encode($setores ?? [], JSON_UNESCAPED_UNICODE) ?>;

        const funcionarios = window.funcionariosData ?? [];
        const setores = window.setoresData ?? [];

        const mapaSetores = {};
        setores.forEach(setor => {
            mapaSetores[setor.ID] = setor.NOME;
        });

        let paginaAtual = 1;
        let linhasPorPagina = 5;
        let funcionariosFiltrados = [...funcionarios];

        document.addEventListener("DOMContentLoaded", () => {
            iniciarEventos();
            renderizarTabela();
        });

        function iniciarEventos() {
            const pesquisa = document.getElementById("pesquisaFuncionario");
            if (pesquisa) {
                pesquisa.addEventListener("input", () => {
                    paginaAtual = 1;
                    aplicarPesquisa();
                });
            }

            const linhas = document.getElementById("linhasPagina");
            if (linhas) {
                linhas.addEventListener("change", function () {
                    linhasPorPagina = Number(this.value);
                    paginaAtual = 1;
                    renderizarTabela();
                });
            }

            const anterior = document.getElementById("anterior");
            if (anterior) {
                anterior.addEventListener("click", () => {
                    if (paginaAtual > 1) {
                        paginaAtual--;
                        renderizarTabela();
                    }
                });
            }

            const proximo = document.getElementById("proximo");
            if (proximo) {
                proximo.addEventListener("click", () => {
                    const totalPaginas = Math.ceil(funcionariosFiltrados.length / linhasPorPagina);
                    if (paginaAtual < totalPaginas) {
                        paginaAtual++;
                        renderizarTabela();
                    }
                });
            }
        }

        function aplicarPesquisa() {
            const campo = document.getElementById("pesquisaFuncionario");
            if (!campo) return;

            const texto = campo.value.toLowerCase().trim();

            funcionariosFiltrados = funcionarios.filter(fun => {
                const nome = String(fun.NOME_COMPLETO ?? "").toLowerCase();
                const cpf = String(fun.CPF ?? "").toLowerCase();
                const email = String(fun.EMAIL_CORPORATIVO ?? "").toLowerCase();
                const telefone = String(fun.TELEFONE ?? "").toLowerCase();
                const setor = String(mapaSetores[fun.FK_ID_SETOR] ?? "").toLowerCase();
                const uid = String(fun.UID_RFID ?? "").toLowerCase();

                return (
                    nome.includes(texto) ||
                    cpf.includes(texto) ||
                    email.includes(texto) ||
                    telefone.includes(texto) ||
                    setor.includes(texto) ||
                    uid.includes(texto)
                );
            });

            renderizarTabela();
        }

        function renderizarTabela() {
            const tabela = document.getElementById("listaFuncionarios");
            if (!tabela) return;

            tabela.innerHTML = "";

            if (funcionariosFiltrados.length === 0) {
                tabela.innerHTML = `
                    <tr>
                        <td colspan="9" class="mensagem-vazia">
                            <i class="fas fa-users-slash"></i>
                            <br><br>
                            Nenhum funcionário encontrado.
                        </td>
                    </tr>
                `;
                atualizarRodape(0, 0, 0);
                return;
            }

            const inicio = (paginaAtual - 1) * linhasPorPagina;
            const fim = inicio + linhasPorPagina;
            const paginaAtualFuncionarios = funcionariosFiltrados.slice(inicio, fim);

            paginaAtualFuncionarios.forEach(fun => {
                let epis = "-";
                if (fun.EPIS) {
                    try {
                        const lista = JSON.parse(fun.EPIS);
                        epis = lista.map(e => e.nome || e.NOME_EPI).join(", ");
                    } catch (e) {
                        epis = fun.EPIS;
                    }
                }

                tabela.innerHTML += `
                <tr>
                    <td>
                        <div class="func-avatar">
                            <strong>${escapeHTML(fun.NOME_COMPLETO)}</strong>
                        </div>
                    </td>
                    <td>${escapeHTML(fun.CPF)}</td>
                    <td>${fun.DATA_NASCIMENTO || "-"}</td>
                    <td>${escapeHTML(fun.EMAIL_CORPORATIVO)}</td>
                    <td>${fun.TELEFONE || "-"}</td>
                    <td>${fun.UID_RFID || "-"}</td>
                    <td>${mapaSetores[fun.FK_ID_SETOR] ?? "-"}</td>
                    <td>${epis}</td>
                    <td>
                        <div class="table-actions">
                            <button class="table-action edit" onclick="preencherFormulario('${escapeHTML(fun.NOME_COMPLETO)}', '${fun.CPF}', '${fun.EMAIL_CORPORATIVO}', '${fun.TELEFONE || ''}', '${fun.FK_ID_SETOR}', '${fun.UID_RFID || ''}', '${fun.DATA_NASCIMENTO || ''}')">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button class="table-action delete" onclick="confirmarExclusao('${fun.CPF}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                `;
            });

            atualizarRodape(
                inicio + 1,
                Math.min(fim, funcionariosFiltrados.length),
                funcionariosFiltrados.length
            );
        }

        function atualizarRodape(inicio, fim, total) {
            const info = document.getElementById("infoTabela");
            const pagina = document.getElementById("paginaAtual");
            const anterior = document.getElementById("anterior");
            const proximo = document.getElementById("proximo");

            if (info) info.innerHTML = `Mostrando ${inicio} a ${fim} de ${total}`;
            if (pagina) pagina.innerHTML = paginaAtual;

            const totalPaginas = Math.max(1, Math.ceil(total / linhasPorPagina));

            if (anterior) anterior.disabled = paginaAtual === 1;
            if (proximo) proximo.disabled = paginaAtual >= totalPaginas;
        }

        function escapeHTML(valor) {
            return String(valor ?? "")
                .replaceAll("&", "&amp;")
                .replaceAll("<", "&lt;")
                .replaceAll(">", "&gt;")
                .replaceAll('"', "&quot;")
                .replaceAll("'", "&#039;");
        }

        function maskCPF(input) {
            let valor = input.value.replace(/\D/g, "").substring(0, 11);
            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
            valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            input.value = valor;
        }

        function maskTel(input) {
            let valor = input.value.replace(/\D/g, "").substring(0, 11);
            if (valor.length <= 10) {
                valor = valor.replace(/(\d{2})(\d)/, "($1) $2");
                valor = valor.replace(/(\d{4})(\d)/, "$1-$2");
            } else {
                valor = valor.replace(/(\d{2})(\d)/, "($1) $2");
                valor = valor.replace(/(\d{5})(\d)/, "$1-$2");
            }
            input.value = valor;
        }

        function validarNome(input) {
            input.value = input.value.replace(/[^a-zA-AÀ-ÿ\s]/g, "");
        }

        function prepararEEnviar(form) {
            const senha = document.getElementById("senha").value;
            const confirmSenha = document.getElementById("confirmSenha").value;

            if (senha && senha !== confirmSenha) {
                Swal.fire('Erro', 'As senhas digitadas não coincidem!', 'error');
                return false;
            }
            return true;
        }

        function abrirModalEPI() {
            Swal.fire('Seleção de EPIs', 'Recurso em desenvolvimento', 'info');
        }

        function preencherFormulario(nome, cpf, email, telefone, setor, uid, nascimento) {
            document.getElementById("nome").value = nome;
            document.getElementById("cpf").value = cpf;
            document.getElementById("cpf_original").value = cpf;
            document.getElementById("email").value = email;
            document.getElementById("telefone").value = telefone;
            document.getElementById("id_setor").value = setor;
            document.getElementById("uid_rfid").value = uid;
            document.getElementById("nascimento").value = nascimento;

            document.getElementById("btn-cancelar").style.display = "inline-flex";
            document.getElementById("btn-salvar").innerHTML = '<i class="fas fa-save"></i> Salvar Alterações';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function resetarFormulario() {
            document.getElementById("form-fun").reset();
            document.getElementById("cpf_original").value = "";
            document.getElementById("btn-cancelar").style.display = "none";
            document.getElementById("btn-salvar").innerHTML = '<i class="fas fa-user-plus"></i> Cadastrar Funcionário';
        }

        function confirmarExclusao(cpf) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Esta ação não poderá ser desfeita!",
                icon: 'warning',
                showCancelButton: true,
                confirmColor: '#d33',
                cancelColor: '#3085d6',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `<?= base_url('/Cadastro_Fun/excluir/') ?>/${cpf}`;
                }
            });
        }
    </script>

</body>

</html>