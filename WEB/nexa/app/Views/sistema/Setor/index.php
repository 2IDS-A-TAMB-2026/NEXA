<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Setor</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/style_geral.css') ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/cadastro_setor.css') ?>">

    <style>
        /* From Uiverse.io by cssbuttons-io */
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
            background-image: linear-gradient(rgba(0, 0, 0, 0),
                    rgba(0, 0, 0, 0),
                    rgba(0, 0, 0, 0.3));
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

        /* LISTA COM ROLAGEM */

        #lista {
            display: flex;
            flex-direction: column;
            gap: 15px;

            height: 520px;
            overflow-y: auto;
        }

        /* Barra de rolagem azul */

        #lista::-webkit-scrollbar {
            width: 8px;
        }

        #lista::-webkit-scrollbar-track {
            background: #e5e7eb;
            border-radius: 10px;
        }

        #lista::-webkit-scrollbar-thumb {
            background: #0A66c2 !important;
            border-radius: 10px;
        }

        #lista::-webkit-scrollbar-thumb:hover {
            background: #1e4b75 !important;
        }
    </style>
</head>

<body class="has-bg-image">

    <aside class="sidebar">


        <div class="sidebar-logo">
            <img src="<?= base_url('assets/images/logo_escura_transparente.png') ?>" class="logo">
        </div>

        <!-- MENU -->
        <nav class="menu">
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

            <a href="<?= base_url('cadastro-funcionario') ?>">
                <i class="fas fa-users"></i>
                <span>Cadastro Funcionários</span>
            </a>

            <a href="<?= base_url('epi') ?>">
                <i class="fas fa-helmet-safety"></i>
                <span>Cadastro EPIs</span>
            </a>

            <a href="<?= base_url('/camera') ?>">
                <i class="fas fa-camera"></i>
                <span>Cadastro Câmeras</span>
            </a>

            <a href="<?= base_url('setor') ?>" class="active">
                <i class="fas fa-building"></i>
                <span>Cadastro Setores</span>
            </a>



            <a href="<?= base_url('/administrador') ?>">
                <i class="fas fa-user"></i>
                <span>Perfil</span>
            </a>
        </nav>


        <!-- SAIR (sempre no final) -->
        <a href="<?= base_url('/') ?>">
            <i class="fas fa-sign-out-alt"></i>
            <span>Sair</span>
        </a>

    </aside>

    <!-- 🔹 MENU ACESSIBILIDADE -->

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
                <h1>Cadastro de Setores</h1>
                <div class="subtitle">Informações do Setor</div>


                <form method="post" action="<?= base_url('setor/inserir') ?>">

                    <div class="form-group">
                        <div class="input-box">
                            <i class="fas fa-building"></i>

                            <input type="text" name="nome_setor" placeholder="Nome do setor" oninput="clearError(this)">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-box">
                            <i class="fas fa-map-marker-alt"></i>

                            <input type="text" name="localizacao" placeholder="Localização" oninput="clearError(this)">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-box">
                            <i class="fas fa-building"></i>

                            <input type="text" name="cnpj_empresa" placeholder="CNPJ da empresa"
                                oninput="maskCNPJ(this)">
                        </div>
                    </div>

                    <br>

                    <div class="btn-area">
                        <button>
                            <span class="transition"></span>
                            <span class="gradient"></span>
                            <span class="label">Cadastrar</span>
                        </button>
                    </div>

            </div>

            <!-- DIREITA -->
            <div class="right-box">
                <h2>Setores Cadastrados</h2>
                <div id="lista">

                    <?php foreach ($setores as $s): ?>

                        <div class="lista-card">

                            <div class="lista-left">

                                <i class="fas fa-building"></i>

                                <div class="lista-info">
                                    <h3><?= $s['NOME'] ?></h3>
                                    <p>Local: <?= $s['LOCAL'] ?></p>
                                    <p>CNPJ: <?= $s['FK_CNPJ_EMPRESA'] ?></p>
                                </div>

                            </div>

                            <div class="lista-actions">

                                <i class="fas fa-pen edit" onclick='editar(
            <?= json_encode($s["ID"]) ?>,
            <?= json_encode($s["NOME"]) ?>,
            <?= json_encode($s["LOCAL"]) ?>,
            <?= json_encode($s["FK_CNPJ_EMPRESA"]) ?>
        )'>
                                </i>

                                <a href="<?= base_url('setor/excluir/' . $s['ID']) ?>">
                                    <i class="fas fa-trash delete"></i>
                                </a>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDITAR -->
    <div class="modal-bg" id="modalBg" style="display:none;">
        <div class="modal">

            <h2>Editar Setor</h2>

            <div class="form-group">
                <div class="input-box">
                    <i class="fas fa-building"></i>
                    <input type="text" id="editNome" oninput="clearError(this)" placeholder="Nome">
                </div>
                <div class="error-text"></div>
            </div>


            <div class="form-group">
                <div class="input-box">
                    <i class="fas fa-building"></i>
                    <input type="text" id="editLocal" oninput="clearError(this)" placeholder="Localização">
                </div>
                <div class="error-text"></div>
            </div>

            <div class="form-group">
                <div class="input-box">
                    <i class="fas fa-building"></i>
                    <input type="text" id="editCnpj" oninput="clearError(this)" placeholder="CNPJ empresa">
                </div>
                <div class="error-text"></div>
            </div>

            <div class="modal-buttons">
                <button onclick="fecharModal()">Cancelar</button>
                <button class="save-btn" onclick="salvarEdicao()">Salvar</button>
            </div>
        </div>
    </div>

    <script>
        function fecharModal() {
            document.getElementById('modalBg').style.display = 'none';
        }
        function salvarEdicao() {
            const nome = document.getElementById('editNome');
            const local = document.getElementById('editLocal');
            const cnpj = document.getElementById('editCnpj');

            let ok = true;

            [nome, local, cnpj].forEach(clearError);

            if (!validarObrigatorio(nome)) ok = false;
            if (!validarObrigatorio(local)) ok = false;

            if (!validarObrigatorio(cnpj)) {
                ok = false;
            } else if (!validarCNPJ(cnpj.value)) {
                setError(cnpj, "CNPJ inválido");
                ok = false;
            }

            if (!ok) return;

            setores[editIndex] = {
                nome: nome.value,
                local: local.value,
                cnpj: cnpj.value
            };

            renderizar();
            fecharModal();
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
            if (!group) return;

            const box = group.querySelector(".input-box");
            const erro = group.querySelector(".error-text");

            if (box) box.classList.add("error");
            if (erro) erro.innerText = msg;
        }

        function clearError(input) {
            const group = input.closest(".form-group");
            if (!group) return;

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

        function validarCNPJ(cnpj) {
            cnpj = cnpj.replace(/[^\d]+/g, '');

            if (cnpj.length !== 14) return false;
            if (/^(\d)\1+$/.test(cnpj)) return false;

            let tamanho = cnpj.length - 2;
            let numeros = cnpj.substring(0, tamanho);
            let digitos = cnpj.substring(tamanho);

            let soma = 0;
            let pos = tamanho - 7;

            for (let i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2) pos = 9;
            }

            let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0)) return false;

            tamanho++;
            numeros = cnpj.substring(0, tamanho);

            soma = 0;
            pos = tamanho - 7;

            for (let i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2) pos = 9;
            }

            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;

            return resultado == digitos.charAt(1);
        }
    </script>
    <script src="assets/js/permissions.js"></script>
    <script src="assets/js/acessibilidade.js"></script>
    <script>
        function editar(id, nome, local, cnpj) {

            Swal.fire({
                title: 'Editar Setor',
                html: `
            <input id="swalNome" class="swal2-input" placeholder="Nome do setor" value="${nome}">
            <input id="swalLocal" class="swal2-input" placeholder="Localização" value="${local}">
            <input id="swalCnpj" class="swal2-input" placeholder="CNPJ" value="${cnpj}">
        `,
                showCancelButton: true,
                confirmButtonText: 'Salvar',
                cancelButtonText: 'Cancelar',

                preConfirm: () => {

                    const nomeSetor = document.getElementById('swalNome').value.trim();
                    const localizacao = document.getElementById('swalLocal').value.trim();
                    const cnpjEmpresa = document.getElementById('swalCnpj').value.trim();

                    if (!nomeSetor || !localizacao || !cnpjEmpresa) {

                        Swal.showValidationMessage(
                            'Preencha todos os campos'
                        );

                        return false;
                    }

                    return {
                        nome_setor: nomeSetor,
                        localizacao: localizacao,
                        cnpj_empresa: cnpjEmpresa
                    };
                }

            }).then((result) => {

                if (result.isConfirmed) {

                    const form = document.createElement('form');

                    form.method = 'POST';

                    form.action =
                        '<?= base_url("setor/atualizar") ?>/' + id;

                    form.innerHTML = `
                <input type="hidden" name="nome_setor" value="${result.value.nome_setor}">
                <input type="hidden" name="localizacao" value="${result.value.localizacao}">
                <input type="hidden" name="cnpj_empresa" value="${result.value.cnpj_empresa}">
            `;

                    document.body.appendChild(form);

                    form.submit();
                }
            });
        }

        function maskCNPJ(input) {

            let v = input.value.replace(/\D/g, '');

            v = v.substring(0, 14);

            v = v.replace(/^(\d{2})(\d)/, '$1.$2');
            v = v.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
            v = v.replace(/\.(\d{3})(\d)/, '.$1/$2');
            v = v.replace(/(\d{4})(\d)/, '$1-$2');

            input.value = v;
        }
    </script>

</body>

</html>