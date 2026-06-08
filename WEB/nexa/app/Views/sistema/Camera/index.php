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

    <style>
        button {
            font-size: 17px;
            padding: 1em 2.7em;
            font-weight: 500;
            background: #0A66c2;
            color: white;
            border: none;
            position: relative;
            overflow: hidden;
            border-radius: 0.6em;
            cursor: pointer;
        }

        .gradient {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            border-radius: 0.6em;
            margin-top: -0.25em;
            background-image: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.3));
        }

        .label {
            position: relative;
            top: -1px;
        }

        .transition {
            transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
            transition-duration: 500ms;
            background-color: #1e4b75;
            border-radius: 9999px;
            width: 0;
            height: 0;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        button:hover .transition {
            width: 14em;
            height: 14em;
        }

        button:active {
            transform: scale(0.97);
        }

        #lista {
            display: flex;
            flex-direction: column;
            gap: 15px;
            height: 520px;
            overflow-y: auto;
        }

        #lista::-webkit-scrollbar {
            width: 8px;
        }

        #lista::-webkit-scrollbar-track {
            background: #e5e7eb;
        }

        #lista::-webkit-scrollbar-thumb {
            background: #0A66c2;
            border-radius: 10px;
        }

        #lista::-webkit-scrollbar-thumb:hover {
            background: #1e4b75;
        }
    </style>
</head>

<body class="has-bg-image">

    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="assets/images/logo_escura_transparente.png" class="logo">
        </div>

        <nav class="menu">
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
            <a href="<?= base_url('/cadastro-funcionario') ?>">
                <i class="fas fa-users"></i>
                <span>Cadastro funcionários</span>
            </a>
            <a href="<?= base_url('/epi') ?>">
                <i class="fas fa-helmet-safety"></i>
                <span>Cadastro EPIs</span>
            </a>
            <a href="<?= base_url('/Camera') ?>" class="active">
                <i class="fas fa-camera"></i>
                <span>Cadastro Câmeras</span>
            </a>
            <a href="<?= base_url('/setor') ?>">
                <i class="fas fa-building"></i>
                <span>Cadastro Setores</span>
            </a>
            <a href="<?= base_url('/administrador') ?>">
                <i class="fas fa-user"></i>
                <span>Perfil</span>
            </a>
        </nav>

        <a href="<?= base_url('/') ?>" class="logout-item">
            <i class="fas fa-sign-out-alt"></i>
            <span>Sair</span>
        </a>
    </aside>

    <div class="access-bar">
        <button class="access-btn" onclick="Acessibilidade.toggleContraste()"><i class="fas fa-adjust"></i></button>
        <button class="access-btn" onclick="toggleDark()"><i class="fas fa-moon"></i></button>
        <button class="access-btn" onclick="Acessibilidade.aumentarFonte()">A+</button>
        <button class="access-btn" onclick="Acessibilidade.diminuirFonte()">A-</button>
        <button class="access-btn" onclick="Acessibilidade.lerPagina()"><i class="fas fa-volume-up"></i></button>
    </div>

    <div class="overlay">
        <div class="content-grid">

            <div class="left-box">
                <h1>Cadastro de Câmeras</h1>
                <div class="subtitle">Informações</div>
                <form method="post" action="<?= base_url('/Camera/inserir') ?>" onsubmit="return validarCadastro()">

                    <div class="form-group">
                        <div class="input-box">
                            <i class="fas fa-video"></i>
                            <input type="text" id="nome" name="nome" placeholder="Nome da câmera">
                        </div>
                        <div class="error-text"></div>
                    </div>

                    <div class="form-group">
                        <div class="input-box select">
                            <i class="fas fa-toggle-on"></i>
                            <select id="status" name="status">
                                <option value="">Selecione o status</option>
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                            </select>
                        </div>
                        <div class="error-text"></div>
                    </div>

                    <div class="form-group">
                        <div class="input-box select">
                            <i class="fas fa-building"></i>
                            <select id="idSetor" name="idSetor">
                                <option value="">Selecione o setor</option>
                                <?php foreach ($setor as $s): ?>
                                    <option value="<?= $s['ID'] ?>"><?= $s['NOME'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="error-text"></div>
                    </div>

                    <div class="form-group">
                        <div class="input-box">
                            <i class="fas fa-building"></i>
                            <input type="text" id="CNPJ" name="CNPJ" placeholder="CNPJ da empresa"
                                oninput="maskCNPJ(this)">
                        </div>
                        <div class="error-text"></div>
                    </div>
                    <br>
                    <div class="btn-area">
                        <button type="submit">
                            <span class="transition"></span>
                            <span class="gradient"></span>
                            <span class="label">Cadastrar</span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="right-box">
                <h2>Câmeras Cadastradas</h2>
                <div id="lista">
                    <p id="mensagemVazia">Nenhuma câmera registrada</p>
                </div>
            </div>

            <div class="modal-bg" id="modalBg">
                <div class="modal">
                    <h2>Editar Câmera</h2>

                    <div class="form-group">
                        <label>Nome</label>
                        <div class="input-box">
                            <i class="fas fa-video"></i>
                            <input type="text" id="editNome" oninput="clearError(this)">
                        </div>
                        <div class="error-text"></div>
                    </div>

                    <div class="form-group">
                        <label>Setor</label>
                        <div class="input-box select">
                            <i class="fas fa-building"></i>
                            <select id="editIdSetor" onchange="clearError(this)">
                                <option value="">Selecione o setor</option>
                                <?php foreach ($setor as $s): ?>
                                    <option value="<?= $s['ID'] ?>"><?= $s['NOME'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="error-text"></div>
                    </div>

                    <div class="form-group">
                        <label>CNPJ</label>
                        <div class="input-box">
                            <i class="fas fa-building"></i>
                            <input type="text" id="editCnpj" oninput="maskCNPJ(this); clearError(this)">
                        </div>
                        <div class="error-text"></div>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="input-box select">
                            <i class="fas fa-toggle-on"></i>
                            <select id="editStatus" onchange="clearError(this)">
                                <option value="">Selecione</option>
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                            </select>
                        </div>
                        <div class="error-text"></div>
                    </div>

                    <div class="modal-buttons">
                        <button type="button" class="cancel-btn" onclick="fecharModal()">Cancelar</button>
                        <button type="button" class="save-btn" onclick="salvarEdicao()">Salvar</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        let cameras = <?= json_encode($cameras ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
        let editIndex = null;

        window.onload = function () {
            renderizar();
        };

        function renderizar() {
            const lista = document.getElementById('lista');

            if (!cameras || cameras.length === 0) {
                lista.innerHTML = `<p id="mensagemVazia">Nenhuma câmera registrada :(</p>`;
                return;
            }

            lista.innerHTML = '';

            cameras.forEach((cam, index) => {
                const nome = cam.IDENTIFICADOR_CAMERA || cam.identificador_camera || 'Sem nome';
                const setor = cam.FK_ID_SETOR || cam.fk_id_setor || 'N/A';
                const cnpj = cam.FK_CNPJ_EMPRESA || cam.fk_cnpj_empresa || 'N/A';
                const status = cam.STATUS || cam.status || 'N/A';
                const id = cam.ID || cam.id || cam.ID_CAMERA || cam.id_camera;

                lista.innerHTML += `
                <div class="lista-card">
                    <div class="lista-left">
                        <i class="fas fa-video"></i>
                        <div class="lista-info">
                            <h3>${nome}</h3>
                            <p>ID câmera: ${id}</p>
                            <p>ID Setor: ${setor}</p>
                            <p>CNPJ: ${cnpj}</p>
                            <p>Status: ${status}</p>
                        </div>
                    </div>
                    <div class="lista-actions">
                        <i class="fas fa-pen edit" title="Editar" onclick="editar(${index})"></i>
                        <i class="fas fa-trash delete" title="Excluir" onclick="excluir_db(${id})"></i>
                    </div>
                </div>`;
            });
        }

        function validarCadastro() {
            const nome = document.getElementById('nome');
            const idSetor = document.getElementById('idSetor');
            const cnpj = document.getElementById('CNPJ');
            const status = document.getElementById('status');

            let ok = true;

            [nome, idSetor, cnpj, status].forEach(i => clearError(i));

            if (!validarObrigatorio(nome)) ok = false;
            if (!validarObrigatorio(idSetor)) ok = false;
            if (!validarObrigatorio(cnpj)) ok = false;
            if (!validarObrigatorio(status)) ok = false;

            return ok;
        }

        function editar(index) {
            editIndex = index;
            const cam = cameras[index];

            document.getElementById('editNome').value = cam.IDENTIFICADOR_CAMERA || cam.identificador_camera || "";
            document.getElementById('editIdSetor').value = cam.FK_ID_SETOR || cam.fk_id_setor || "";
            document.getElementById('editCnpj').value = cam.FK_CNPJ_EMPRESA || cam.fk_cnpj_empresa || "";
            document.getElementById('editStatus').value = cam.STATUS || cam.status || "";

            document.getElementById('modalBg').style.display = 'flex';
        }

        function salvarEdicao() {
            const nome = document.getElementById('editNome');
            const idSetor = document.getElementById('editIdSetor');
            const cnpj = document.getElementById('editCnpj');
            const status = document.getElementById('editStatus');

            let ok = true;
            [nome, idSetor, cnpj, status].forEach(clearError);

            if (!validarObrigatorio(nome)) ok = false;
            if (!validarObrigatorio(idSetor)) ok = false;
            if (!validarObrigatorio(status)) ok = false;

            if (!ok) return;

            // CORREÇÃO DO UNDEFINED AQUI: Mapeia todas as possibilidades de chave de ID do banco
            const currentCam = cameras[editIndex];
            const idCamera = currentCam.ID || currentCam.id || currentCam.ID_CAMERA || currentCam.id_camera;

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `<?= base_url('/Camera/atualizar/') ?>/${idCamera}`;

            const campos = {
                'nome': nome.value,
                'idSetor': idSetor.value,
                'cnpj': cnpj.value,
                'status': status.value
            };

            for (const key in campos) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = campos[key];
                form.appendChild(input);
            }

            document.body.appendChild(form);
            form.submit();
        }

        function excluir_db(id) {
            Swal.fire({
                title: "Excluir câmera permanentemente?",
                text: "Esta ação apagará o registro no banco de dados.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim, excluir",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `<?= base_url('/Camera/excluir/') ?>/${id}`;
                }
            });
        }

        function fecharModal() {
            document.getElementById('modalBg').style.display = 'none';
        }

        function validarObrigatorio(input, msg = "Campo obrigatório") {
            if (!input.value || !input.value.trim()) {
                setError(input, msg);
                return false;
            }
            return true;
        }

        function setError(input, msg) {
            const group = input.closest(".form-group");
            const box = group.querySelector(".input-box");
            const erro = group.querySelector(".error-text");
            if (box) box.classList.add("error");
            if (erro) erro.innerText = msg;
        }

        function clearError(input) {
            const group = input.closest(".form-group");
            const box = group.querySelector(".input-box");
            const erro = group.querySelector(".error-text");
            if (box) box.classList.remove("error");
            if (erro) erro.innerText = "";
        }

        function maskCNPJ(input) {
            let v = input.value.replace(/\D/g, "").slice(0, 14);
            v = v.replace(/^(\d{2})(\d)/, "$1.$2");
            v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
            v = v.replace(/\.(\d{3})(\d)/, ".$1/$2");
            v = v.replace(/(\d{4})(\d)/, "$1-$2");
            input.value = v;
        }
    </script>
    <script src="assets/js/acessibilidade.js"></script>
</body>

</html>