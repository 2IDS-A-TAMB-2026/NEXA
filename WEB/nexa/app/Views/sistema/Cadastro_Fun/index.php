<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionário</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style_geral.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/cadastro_funci.css') ?>">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* =========================
   LAYOUT PRINCIPAL
========================= */

      .main {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 50px;
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
    box-sizing: border-box;
}

.card {
    width: 700px;
    max-width: 700px;
    flex-shrink: 0;
}
        /* =========================
   LISTA FUNCIONÁRIOS
========================= */

        .lista-funcionarios {
            background: #fff;
            border-radius: 25px;
            padding: 20px;
            overflow-y: auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .15);
        }

        .lista-funcionarios::-webkit-scrollbar {
            width: 8px;
        }.lista

        .lista-funcionarios::-webkit-scrollbar-thumb {
            background: #0A66c2;
            border-radius: 10px;
        }

        .lista-funcionarios::-webkit-scrollbar-track {
            background: #e5e7eb;
        }

        .lista-funcionarios h2 {
            text-align: center;
            color: #0a66c2;
            font-size: 24px;
            margin-bottom: 20px;
            position: sticky;
            top: 0;
            background: white;
            padding-bottom: 10px;
            z-index: 10;
        }

        /* =========================
   CARD FUNCIONÁRIO
========================= */

        .funcionario-card {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 15px;
            padding: 15px;

            background: #fff;

            border-radius: 15px;

            border-left: 5px solid #0a66c2;

            box-shadow:
                0 4px 12px rgba(0, 0, 0, .08);

            transition: .3s;
        }

        .funcionario-card:hover {
            transform: translateY(-3px);
            box-shadow:
                0 10px 20px rgba(0, 0, 0, .15);
        }

        .funcionario-info {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .funcionario-info i {
            font-size: 35px;
            color: #0a66c2;
        }

        .funcionario-info h3 {
            font-size: 18px;
            color: #222;
            margin-bottom: 4px;
        }

        .funcionario-info p {
            font-size: 13px;
            color: #555;
            margin: 2px 0;
        }

        /* =========================
   AÇÕES
========================= */

        .acoes {
            display: flex;
            gap: 15px;
        }

        .acoes a {
            font-size: 20px;
            transition: .3s;
        }

        .acoes a:hover {
            transform: scale(1.15);
        }

        .acoes .editar {
            color: #0a66c2;
        }

        .acoes .excluir {
            color: #ef4444;
        }

        /* =========================
   MENU LATERAL MENOR
========================= */

        .menu {
            padding: 10px;
            gap: 4px;
        }

        .menu a {
            padding: 10px 12px;
            font-size: 15px;
        }

        .menu a i {
            width: 18px;
            font-size: 14px;
        }

        .logout-item {
            padding: 12px;
            font-size: 14px;
        }

        /* =========================
   ALTO CONTRASTE
========================= */

        .alto-contraste .lista-funcionarios {
            background: black !important;
            color: yellow !important;
            border: 1px solid yellow;
        }

        /* =========================
   DARK MODE
========================= */

        .dark-mode .lista-funcionarios {
            background: #2d2d2d;
            color: white;
            border: 1px solid #0a66c2;
        }

        .dark-mode .funcionario-card {
            background: #3a3a3a;
        }

        .dark-mode .funcionario-info h3,
        .dark-mode .funcionario-info p {
            color: white;
        }

        /* =========================
   RESPONSIVO
========================= */

        @media(max-width:1200px) {

            .main {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 95%;
                max-width: 750px;
            }

            .lista-funcionarios {
                width: 95%;
                max-width: 750px;
                height: 500px;
            }
        }

        @media(max-width:768px) {

            .main {
                padding: 10px;
            }

            .card {
                width: 100%;
            }

            .lista-funcionarios {
                width: 100%;
            }
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
    </style>
</head>

<body class="has-bg-image">

    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="<?= base_url('assets/images/logo_escura_transparente.png') ?>" class="logo">
        </div>

        <nav class="menu">
            <a href="<?= base_url('/dashboard') ?>"><i class="fas fa-chart-line"></i> <span>Dashboard</span></a>
            <a href="<?= base_url('/dashboard_camera') ?>"><i class="fas fa-video"></i> <span>Dashboard de Câmeras</span></a>
            <a href="<?= base_url('/ocorrencia') ?>"><i class="fas fa-exclamation-triangle"></i> <span>Ocorrências</span></a>
            <a href="<?= base_url('/cadastro-funcionario') ?>" class="active"><i class="fas fa-users"></i> <span>Cadastro Funcionários</span></a>
            <a href="<?= base_url('/epi') ?>"><i class="fas fa-helmet-safety"></i> <span>Cadastro EPIs</span></a>
            <a href="<?= base_url('/Camera') ?>"><i class="fas fa-camera"></i> <span>Cadastro Câmeras</span></a>
            <a href="<?= base_url('/setor') ?>"><i class="fas fa-building"></i> <span>Cadastro Setores</span></a>
            <a href="<?= base_url('/administrador') ?>"><i class="fas fa-user"></i> <span>Perfil</span></a>
        </nav>

        <a href="<?= base_url('/logout-admin') ?>" class="logout-item"><i class="fas fa-sign-out-alt"></i> <span>Sair</span></a>
    </aside>

    <div class="access-bar">
        <button class="access-btn" onclick="Acessibilidade.toggleContraste()"><i class="fas fa-adjust"></i></button>
        <button class="access-btn" onclick="toggleDark()"><i class="fas fa-moon"></i></button>
        <button class="access-btn" onclick="Acessibilidade.aumentarFonte()">A+</button>
        <button class="access-btn" onclick="Acessibilidade.diminuirFonte()">A-</button>
        <button class="access-btn" onclick="Acessibilidade.lerPagina()"><i class="fas fa-volume-up"></i></button>
    </div>

    <div class="overlay" style="display: flex; flex-direction: column; align-items: center; width: calc(100% - 270px); margin-left: 270px; padding: 20px;">
        
        <?php if (session()->getFlashdata('sucesso')): ?>
            <div style="background: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 10px; border: 1px solid #c3e6cb; width: 100%; max-width: 1400px; box-sizing: border-box;">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('sucesso') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('erro')): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 10px; border: 1px solid #f5c6cb; width: 100%; max-width: 1400px; box-sizing: border-box;">
                <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('erro') ?>
            </div>
        <?php endif; ?>

        <div class="main">
        

            <div class="card">
                <h1 id="titulo-form">Cadastro de Funcionário</h1>

                <form id="form-fun" action="<?= base_url('/Cadastro_Fun/inserir') ?>" method="post">
                    <input type="hidden" name="CPF_ORIGINAL" id="cpf_original" value="">

                    <div class="form-grid">
                        <div class="input-box">
                            <i class="fas fa-user"></i>
                            <input name="NOME_COMPLETO" id="nome" type="text" placeholder="Nome completo"
                                oninput="validarNome(this)">
                        </div>

                        <div class="input-box">
                            <i class="fas fa-id-card"></i>
                            <input name="CPF" id="cpf" type="text" placeholder="CPF" oninput="maskCPF(this)">
                        </div>

                        <div class="input-box">
                            <i class="fas fa-calendar"></i>
                            <input name="DATA_NASCIMENTO" id="nascimento" type="date">
                        </div>

                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <input name="EMAIL_CORPORATIVO" id="email" type="email" placeholder="E-mail corporativo">
                        </div>

                        <div class="input-box">
                            <i class="fas fa-phone"></i>
                            <input name="TELEFONE" id="telefone" type="text" placeholder="Telefone"
                                oninput="maskTel(this)">
                        </div>

                        <div class="input-box">
                            <i class="fas fa-wave-square"></i>
                            <input name="UID_RFID" id="uid_rfid" type="text" placeholder="UID RFID">
                        </div>

                        <div class="input-box">
                            <i class="fas fa-building"></i>
                            <input name="FK_CNPJ_EMPRESA" id="cnpj" type="text" placeholder="CNPJ Empresa"
                                oninput="maskCNPJ(this)">
                        </div>

                        <div class="input-box">
                            <i class="fas fa-layer-group"></i>
                            <input name="FK_ID_SETOR" id="id_setor" type="text" placeholder="ID Setor">
                        </div>

                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input name="SENHA" id="senha" type="password"
                                placeholder="Senha (vazio para manter se editar)">
                        </div>

                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input id="confirmSenha" type="password" placeholder="Confirmar Senha">
                        </div>
                    </div>


                    <br>
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

            <div>
                <div class="lista-funcionarios">
                    <h2>Funcionários Cadastrados</h2>

                    <?php if (!empty($funcionarios)): ?>
                        <?php foreach ($funcionarios as $f): ?>
                            <div class="funcionario-card">
                                <div class="funcionario-info">
                                    <i class="fas fa-user-tie"></i>
                                    <div>
                                        <h3><?= esc($f['NOME_COMPLETO']) ?></h3>
                                        <p>CPF: <?= esc($f['CPF']) ?></p>
                                        <p>Email: <?= esc($f['EMAIL_CORPORATIVO']) ?></p>
                                        <p>Telefone: <?= esc($f['TELEFONE']) ?></p>
                                        <p>Setor: <?= esc($f['FK_ID_SETOR']) ?></p>
                                    </div>
                                </div>

                                <div class="acoes">
                                    <a class="editar" title="Editar" onclick="preencherFormulario(
                                '<?= addslashes($f['NOME_COMPLETO']) ?>', 
                                '<?= $f['CPF'] ?>', 
                                '<?= $f['EMAIL_CORPORATIVO'] ?>', 
                                '<?= $f['TELEFONE'] ?? '' ?>', 
                                '<?= $f['FK_ID_SETOR'] ?>', 
                                '<?= $f['UID_RFID'] ?? '' ?>', 
                                '<?= preg_replace('/\D/', '', $f['FK_CNPJ_EMPRESA']) ?>', 
                                '<?= $f['DATA_NASCIMENTO'] ?? '' ?>'
                                 ); return false;">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    <?php $cpfLimpo = preg_replace('/\D/', '', $f['CPF']); ?>
                                    <a href="<?= base_url('/Cadastro_Fun/excluir/' . $cpfLimpo) ?>" class="excluir"
                                        title="Excluir"
                                        onclick="return confirm('Deseja realmente excluir o funcionário com o CPF <?= $f['CPF'] ?>?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Nenhum funcionário cadastrado.</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

    <script>
        function preencherFormulario(nome, cpf, email, telefone, setor, rfid, cnpj, nascimento) {
            document.getElementById('titulo-form').innerText = "Editar Funcionário";

            // Altera o texto do botão usando o ID correto do seu novo CSS
            const botao = document.getElementById('btn-salvar');
            if (botao) botao.innerText = "Salvar Alterações";

            // Define a rota de destino do formulário para edição
            document.getElementById('form-fun').action = "<?= base_url('/Cadastro_Fun/editar') ?>";

            // Preenche os inputs de texto
            if (document.getElementById('nome')) document.getElementById('nome').value = nome;
            if (document.getElementById('cpf')) document.getElementById('cpf').value = cpf;
            if (document.getElementById('cpf_original')) document.getElementById('cpf_original').value = cpf;
            if (document.getElementById('email')) document.getElementById('email').value = email;
            if (document.getElementById('telefone')) document.getElementById('telefone').value = telefone;
            if (document.getElementById('uid_rfid')) document.getElementById('uid_rfid').value = rfid;
            if (document.getElementById('nascimento')) document.getElementById('nascimento').value = nascimento;

            // Preenche os Selects Dinâmicos buscando pelo value correto
            const selectCnpj = document.getElementById('cnpj');
            if (selectCnpj) {
                // Limpa o CNPJ recebido para garantir correspondência com o value da option
                let cnpjLimpo = cnpj.replace(/\D/g, "");
                selectCnpj.value = cnpjLimpo;
            }

            const selectSetor = document.getElementById('id_setor');
            if (selectSetor) selectSetor.value = setor;

            // Rola a página suavemente de volta para o formulário
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function maskCPF(input) {
            let v = input.value.replace(/\D/g, "").slice(0, 11);
            v = v.replace(/(\d{3})(\d)/, "$1.$2");
            v = v.replace(/(\d{3})(\d)/, "$1.$2");
            v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            input.value = v;
        }

        function maskTel(input) {
            let v = input.value.replace(/\D/g, "").slice(0, 11);
            if (v.length > 10) {
                v = v.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");
            } else {
                v = v.replace(/(\d{2})(\d{4})(\d{4})/, "($1) $2-$3");
            }
            input.value = v;
        }

        function validarNome(input) {
            input.value = input.value.replace(/[0-9]/g, "");
        }
    </script>

    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>
</body>

</html>