<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXA | Cadastro de EPI's</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style_geral.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/epi.css') ?>">

    <style>
        .option-funci {
            border-radius: 5px;
            border: none;
        }

        /* Estilo base dos textos de erro */
        .error-text {
            display: none;
            color: #d32f2f !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            margin-top: 5px !important;
            margin-bottom: 10px !important;
            font-family: 'Inter', sans-serif !important;
        }

        .error-text.active {
            display: block !important;
        }

        /* 🔥 REGRA DO CONTORNO VERMELHO */
        .input-error {
            border: 2px solid #d32f2f !important;
        }

        /* ========================================================
           INPUT FILE (UPLOAD DE IMAGEM BONITO)
           ======================================================== */
        .file-input-wrapper {
            position: relative;
            width: 100%;
            height: 58px;
            background: #eceff1;
            border-radius: 15px;
            display: flex;
            align-items: center;
            padding: 0 18px;
            cursor: pointer;
            overflow: hidden;
            margin-bottom: 15px !important;
            box-sizing: border-box;
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-wrapper i.fa-camera {
            color: #0066cc !important;
            font-size: 20px !important;
            margin-right: 12px !important;
        }

        .file-input-text {
            font-size: 18px;
            color: #757575;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ========================================================
           SELECT DE FUNCIONÁRIO 
           ======================================================== */
        .busca-funcionario-container {
            width: 100% !important;
            margin-bottom: 15px !important;
        }

        .select-input-box {
            width: 100% !important;
            height: 58px !important;
            background: #eceff1 !important;
            border-radius: 15px !important;
            display: flex !important;
            align-items: center !important;
            padding: 0 18px !important;
            position: relative !important;
            box-sizing: border-box;
        }

        .select-input-box select {
            width: 100% !important;
            height: 100% !important;
            background: transparent !important;
            border: none !important;
            outline: none !important;
            font-size: 18px !important;
            color: #475569 !important;
            cursor: pointer !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
            padding-left: 32px !important;
            padding-right: 35px !important;
        }

        .select-input-box i.fa-search {
            position: absolute !important;
            left: 18px !important;
            color: #0066cc !important;
            font-size: 20px !important;
            pointer-events: none !important;
        }

        .select-input-box .fa-chevron-down {
            position: absolute !important;
            right: 18px !important;
            color: #0066cc !important;
            font-size: 16px !important;
            pointer-events: none !important;
        }

        /* ========================================================
           💥 BLOCO BRANCO OTIMIZADO COM MAIS ESPAÇO PARA LINHAS
           ======================================================== */

        .right-box {
            width: 100% !important;
            max-width: 100% !important;
            flex: 1 !important;

            height: 600px !important;

            display: flex !important;
            flex-direction: column !important;
        }

        /* =========================
        ACESSIBILIDADE - GLOBAL
        ========================= */

        html {
            font-size: 16px;
            transition: font-size 0.2s ease;
        }

        body {
            transition: all 0.3s ease;
        }

        /* =========================
        MODO NOTURNO
        ========================= */
        .dark-mode {
            background: #0b1220 !important;
            color: #e5e7eb !important;
        }

        .dark-mode .left-box,
        .dark-mode .right-box,
        .dark-mode .table-container,
        .dark-mode .input-box,
        .dark-mode .file-input-wrapper,
        .dark-mode .select-input-box,
        .dark-mode th,
        .dark-mode tr,
        .dark-mode .tabela-epi tr,
        .dark-mode .overlay {
            background-color: #111827 !important;
            color: #e5e7eb !important;
        }
        .dark-mode .tabela-epi{border-color: #1e4b75;}

        /* =========================
        ALTO CONTRASTE
        ========================= */
        .high-contrast {
            background: #000 !important;
            color: #ffff00 !important;
        }

        /* textos */
        .high-contrast h1,
        .high-contrast h2,
        .high-contrast h3,
        .high-contrast p,
        .high-contrast span,
        .high-contrast td,
        .high-contrast th,
        .high-contrast label {
            color: #ffff00 !important;
        }

        /* caixas */
        .high-contrast .left-box,
        .high-contrast .right-box,
        .high-contrast .table-container,
        .high-contrast .input-box,
        .high-contrast .file-input-wrapper,
        .high-contrast .select-input-box {
            background: #000 !important;
            border: 2px solid #ffff00 !important;
        }

        /* botões */
        .high-contrast button,
        .high-contrast .btn {
            background: #000 !important;
            color: #ffff00 !important;
            border: 2px solid #ffff00 !important;
        }

        /* links */
        .high-contrast a {
            color: #ffff00 !important;
        }



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
        
        #lista {
            display: flex;
            flex-direction: column;
            gap: 15px;

            flex: 1;
            overflow-y: auto;

            min-height: 0;
        }

        #lista::-webkit-scrollbar {
            width: 8px;
        }

        #lista::-webkit-scrollbar-thumb {
            background: #0A66c2;
            border-radius: 10px;
        }

        #lista::-webkit-scrollbar-track {
            background: #e5e7eb;
        }

        .lista-card {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .lista-left {
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .lista-left i {
            font-size: 30px;
            color: #0A66c2;
        }

        .lista-info h3 {
            margin-bottom: 8px;
            color: #1e293b;
        }

        .lista-info p {
            margin: 4px 0;
            color: #64748b;
        }

        .lista-actions {
            display: flex;
            gap: 15px;
            font-size: 20px;
        }

        .lista-actions .edit {
            color: #0A66c2;
            cursor: pointer;
        }

        .lista-actions .delete {
            color: #ef4444;
            cursor: pointer;
        }
        .access-bar{
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;

            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body class="has-bg-image">

    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="<?= base_url('assets/images/logo_escura_transparente.png') ?>" class="logo">
        </div>

        <nav class="menu">
            <a href="<?= base_url('/dashboard') ?>"><i class="fas fa-chart-line"></i> <span>Dashboard</span></a>
            <a href="<?= base_url('/dashboard_camera') ?>"><i class="fas fa-video"></i> <span>Dashboard de
                    Câmeras</span></a>
            <a href="<?= base_url('/ocorrencia') ?>"><i class="fas fa-exclamation-triangle"></i>
                <span>Ocorrências</span></a>
            <a href="<?= base_url('/cadastro-funcionario') ?>"><i class="fas fa-users"></i> <span>Cadastro
                    funcionários</span></a>
            <a href="<?= base_url('/epi') ?>" class="active"><i class="fas fa-helmet-safety"></i> <span>Cadastro
                    EPIs</span></a>
            <a href="<?= base_url('/Camera') ?>"><i class="fas fa-camera"></i> <span>Cadastro Câmeras</span></a>
            <a href="<?= base_url('/setor') ?>"><i class="fas fa-building"></i> <span>Cadastro Setores</span></a>
            <a href="<?= base_url('/administrador') ?>"><i class="fas fa-user"></i> <span>Perfil</span></a>
        </nav>

        <a href="<?= base_url('/logout-admin') ?>" class="logout-item">
            <i class="fas fa-sign-out-alt"></i> <span>Sair</span>
        </a>
    </aside>

    <div class="access-bar">
        <button class="access-btn" onclick="Acessibilidade.toggleContraste()"><i class="fas fa-adjust"></i></button>
        <button class="access-btn" onclick="Acessibilidade.toggleDark()"><i class="fas fa-moon"></i></button>
        <button class="access-btn" onclick="Acessibilidade.aumentarFonte()">A+</button>
        <button class="access-btn" onclick="Acessibilidade.diminuirFonte()">A-</button>
        <button class="access-btn" onclick="Acessibilidade.lerPagina()"><i class="fas fa-volume-up"></i></button>
    </div>

    <div class="overlay">
        <div class="page-header"></div>



        <?php if (session()->getFlashdata('erro_epi')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('erro_epi') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <?php $errors = session()->getFlashdata('errors'); ?>

            <?php foreach ($errors as $erro): ?>
                <div class="alert alert-danger">
                    <?= $erro ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>


        <div class="content-grid">
            <div class="left-box">
                <h1>Cadastro de EPIs</h1>
                <div class="subtitle">Informações dos EPIs</div>
                <form method="post" action="<?= base_url('/epi/inserir') ?>" id="inserir_epi"
                    enctype="multipart/form-data">

                    <div class="form-group">
                        <div class="input-box">
                            <i class="fas fa-helmet-safety"></i>
                            <input type="text" id="nome_epi" name="nome_epi" placeholder="Nome do EPI">
                        </div>
                        <div class="error-text" id="erro-nome"></div>
                    </div>

                    <div class="form-group">
                        <div class="input-box">
                            <i class="fas fa-file-alt"></i>
                            <input type="text" id="des_epi" name="des_epi" placeholder="Descrição">
                        </div>
                        <div class="error-text" id="erro-des"></div>
                    </div>

                    <div class="form-group">
                        <div class="file-input-wrapper">
                            <i class="fas fa-camera"></i>
                            <span class="file-input-text" id="file-label">Selecionar Imagem do EPI</span>
                            <input type="file" id="imagem_epi" name="imagem_epi" onchange="atualizarNomeArquivo(this)">
                        </div>
                        <div class="error-text" id="erro-img"></div>
                    </div>

                    <div class="form-group">
                        <div class="busca-funcionario-container">
                            <div class="select-input-box">
                                <i class="fas fa-search"></i>
                                <select id="funcionario" name="FK_CPF_FUNCIONARIO">
                                    <option value="">Selecione um funcionário</option>
                                    <?php foreach ($funcionarios as $f): ?>
                                        <option value="<?= $f['CPF'] ?>"><?= $f['NOME_COMPLETO'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="error-text" id="erro-funci"></div>
                    </div>

                    <br>
                    <div class="btn-area">
                        <button>
                            <span class="transition"></span>
                            <span class="gradient"></span>
                            <span class="label">Cadastrar</span>
                        </button>
                    </div>

                </form>
            </div>

            <div class="right-box">
    <h2>EPI's Cadastrados</h2>

    <div id="lista">

        <?php if (empty($epis)): ?>
            <p id="mensagemVazia">Nenhum EPI registrado</p>
        <?php else: ?>

            <?php foreach ($epis as $e): ?>
                <div class="lista-card">

                    <div class="lista-left">
                        <?php
                        $icone = "fa-helmet-safety";

                        $nome = strtolower(trim($e['NOME_EPI']));

                        if (strpos($nome, 'luva') !== false) {
                            $icone = "fa-hand";
                        }
                        elseif (
                            strpos($nome, 'oculos') !== false ||
                            strpos($nome, 'óculos') !== false
                        ) {
                            $icone = "fa-glasses";
                        }
                        elseif (strpos($nome, 'bota') !== false) {
                            $icone = "fa-shoe-prints";
                        }
                         elseif (strpos($nome, 'máscara') !== false || strpos($nome, 'mascara') !== false) {
                            $icone = "fa-head-side-mask";
                        } elseif (strpos($nome, 'colete') !== false) {
                            $icone = "fa-vest";
                        } elseif (strpos($nome, 'protetor auricular') !== false) {
                            $icone = "fa-ear-listen";
                        }

                        ?>

                        <i class="fas <?= $icone ?>"></i>
                        
                        <div class="lista-info">
                            <h3><?= $e['NOME_EPI'] ?></h3>
                            <p>ID: <?= $e['ID'] ?></p>
                            <p>Descrição: <?= $e['DESCRICAO_EPI'] ?></p>
                            <p>Funcionário: <?= $e['FK_CPF_FUNCIONARIO'] ?></p>
                            <p>Imagem: <?= $e['IMAGEM_EPI'] ?></p>
                        </div>
                    </div>

                    <div class="lista-actions">

                        <i class="fas fa-pen edit"
                            title="Editar"
                            onclick="editarEpi(
                                <?= $e['ID'] ?>,
                                '<?= esc($e['NOME_EPI']) ?>',
                                '<?= esc($e['DESCRICAO_EPI']) ?>',
                                '<?= $e['FK_CPF_FUNCIONARIO'] ?>'
                            )">
                        </i>

                        <a href="<?= base_url('epi/excluir/' . $e['ID']) ?>">
                            <i class="fas fa-trash delete" title="Excluir"></i>
                        </a>

                    </div>

                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>
        </div>
    </div>
    <script>
        let fontSize = 16;

        const Acessibilidade = {

            toggleContraste: function () {
                document.body.classList.toggle("high-contrast");
            },

            toggleDark: function () {
                document.body.classList.toggle("dark-mode");
            },

            aumentarFonte: function () {
                fontSize += 1;
                if (fontSize > 24) fontSize = 24;
                document.documentElement.style.fontSize = fontSize + "px";
            },

            diminuirFonte: function () {
                fontSize -= 1;
                if (fontSize < 12) fontSize = 12;
                document.documentElement.style.fontSize = fontSize + "px";
            },

            lerPagina: function () {
                let texto = document.body.innerText;
                let fala = new SpeechSynthesisUtterance(texto);
                fala.lang = "pt-BR";
                speechSynthesis.cancel();
                speechSynthesis.speak(fala);
            }
        };
    </script>
</body>

<script src="assets/js/permissions.js"></script>
<script src="assets/js/acessibilidade.js"></script>

<script>
    function actualizarNomeArquivo(input) {
        let label = document.getElementById('file-label');
        if (input.files && input.files.length > 0) {
            label.textContent = input.files[0].name;
            label.style.color = "#1e293b";
        } else {
            label.textContent = "Selecionar Imagem do EPI";
            label.style.color = "#757575";
        }
    }

    let erro_nome = document.getElementById('erro-nome');
    let erro_des = document.getElementById('erro-des');
    let erro_img = document.getElementById('erro-img');
    let erro_funci = document.getElementById('erro-funci');

    document.getElementById('inserir_epi').addEventListener('submit', function (event) {
        let nomeInput = document.getElementById('nome_epi');
        let desInput = document.getElementById('des_epi');
        const imagemInput = document.getElementById('imagem_epi');
        const funcionarioInput = document.getElementById('funcionario');

        let boxNome = nomeInput.closest('.input-box');
        let boxDes = desInput.closest('.input-box');
        let boxImg = imagemInput.closest('.file-input-wrapper');
        let boxFunci = funcionarioInput.closest('.select-input-box');

        [erro_nome, erro_des, erro_img, erro_funci].forEach(div => {
            div.innerHTML = "";
            div.classList.remove('active');
        });
        [boxNome, boxDes, boxImg, boxFunci].forEach(box => {
            if (box) box.classList.remove('input-error');
        });

        if (nomeInput.value.trim() === "") {
            event.preventDefault();
            erro_nome.textContent = "Este campo é obrigatório.";
            erro_nome.classList.add('active');
            if (boxNome) boxNome.classList.add('input-error');
            return;
        }

        if (desInput.value.trim() === "") {
            event.preventDefault();
            erro_des.textContent = "Este campo é obrigatório.";
            erro_des.classList.add('active');
            if (boxDes) boxDes.classList.add('input-error');
            return;
        }

        if (imagemInput.files.length === 0) {
            event.preventDefault();
            erro_img.textContent = "Este campo é obrigatório.";
            erro_img.classList.add('active');
            if (boxImg) boxImg.classList.add('input-error');
            return;
        }

        if (funcionarioInput.value === "") {
            event.preventDefault();
            erro_funci.textContent = "Este campo é obrigatório.";
            erro_funci.classList.add('active');
            if (boxFunci) boxFunci.classList.add('input-error');
            return;
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function editarEpi(id, nome, descricao, funcionario) {
        Swal.fire({
            title: 'Editar EPI',

            html: `
            <input id="swal_nome"
                class="swal2-input"
                placeholder="Nome"
                value="${nome}">

            <input id="swal_descricao"
                class="swal2-input"
                placeholder="Descrição"
                value="${descricao}">
        `,

            showCancelButton: true,
            confirmButtonText: 'Salvar',

            preConfirm: () => {

                const nomeNovo =
                    document.getElementById('swal_nome').value;

                const descricaoNova =
                    document.getElementById('swal_descricao').value;

                if (!nomeNovo || !descricaoNova) {
                    Swal.showValidationMessage(
                        'Preencha todos os campos'
                    );
                    return false;
                }

                return {
                    nome: nomeNovo,
                    descricao: descricaoNova
                };
            }

        }).then((result) => {

            if (result.isConfirmed) {
                const form = document.createElement('form');

                form.method = 'POST';

                form.action =
                    '<?= base_url('epi/atualizar') ?>/' + id;

                form.innerHTML = `
                <input type="hidden"
                    name="NOME_EPI"
                    value="${result.value.nome}">

                <input type="hidden"
                    name="DESCRICAO_EPI"
                    value="${result.value.descricao}">

                <input type="hidden"
                    name="FK_CPF_FUNCIONARIO"
                    value="${funcionario}">
            `;

                document.body.appendChild(form);

                form.submit();
            }

        });
    }
</script>



</html>