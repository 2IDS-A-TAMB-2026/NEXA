<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>NEXA | Perfil</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="stylesheet" href="<?= base_url('/assets/css/acessibilidade_fun.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style_funci.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/perfil_fun.css') ?>">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ESTILOS CORRIGIDOS PARA CORRIGIR O MODO ESCURO E ACESSIBILIDADE DO HEADER -->
    <style>
      
        /* =========================================================
           REGRAS FORÇADAS PARA O MODO ESCURO NO HEADER
           ========================================================= */
        body.dark .main-header,
        body.dark-mode .main-header,
        body.modo-escuro .main-header,
        html.dark .main-header,
        html.dark-mode .main-header,
        [data-theme="dark"] .main-header {
            background-color: #111827 !important;
            background: #111827 !important;
            border-bottom-color: #374151 !important;
        }

        body.dark .header-subtitle,
        body.dark-mode .header-subtitle,
        body.modo-escuro .header-subtitle,
        body.dark .profile-name,
        body.dark-mode .profile-name,
        body.modo-escuro .profile-name,
        html.dark .header-subtitle,
        html.dark .profile-name {
            color: #f3f4f6 !important;
        }

        body.dark .header-title,
        body.dark-mode .header-title,
        body.modo-escuro .header-title,
        html.dark .header-title {
            color: #60a5fa !important;
        }

        body.dark .profile-company,
        body.dark-mode .profile-company,
        body.modo-escuro .profile-company,
        html.dark .profile-company {
            color: #9ca3af !important;
        }

        body.dark .gear-btn,
        body.dark-mode .gear-btn,
        body.modo-escuro .gear-btn,
        html.dark .gear-btn {
            background-color: #1f2937 !important;
            border-color: #374151 !important;
            color: #f3f4f6 !important;
        }

        body.dark .access-options,
        body.dark-mode .access-options,
        body.modo-escuro .access-options,
        html.dark .access-options {
            background-color: #1f2937 !important;
            border-color: #374151 !important;
        }

        body.dark .access-btn,
        body.dark-mode .access-btn,
        body.modo-escuro .access-btn,
        html.dark .access-btn {
            background-color: #374151 !important;
            color: #f3f4f6 !important;
        }

        /* =========================================================
           REGRAS FORÇADAS PARA MODO ALTO CONTRASTE NO HEADER
           ========================================================= */
        body.alto-contraste .main-header,
        body.contrast .main-header,
        [data-theme="contrast"] .main-header {
            background-color: #000000 !important;
            border-bottom: 2px solid #ffff00 !important;
        }

        body.alto-contraste .main-header *,
        body.contrast .main-header *,
        [data-theme="contrast"] .main-header * {
            color: #ffff00 !important;
        }

        body.alto-contraste .profile-avatar,
        body.contrast .profile-avatar {
            background-color: #ffff00 !important;
            color: #000000 !important;
        }
    </style>
</head>

<body>

<aside class="sidebar">

    <!-- FUNDO -->
    <img
        class="sidebar-construction"
        src="<?= base_url('assets/images/construcao.jpg') ?>"
        alt=""
    >

    <!-- CONTEÚDO -->
    <div class="sidebar-content">

        <!-- LOGO -->
        <div class="sidebar-logo">
            <img
                src="<?= base_url('assets/images/logo_escura_transparente.png') ?>"
                alt="NEXA"
            >
            <div class="sidebar-brand-text">
                <strong>NEXA</strong>
                <span>
                    Segurança é prioridade
                </span>
            </div>
        </div>

        <!-- MENU -->
        <nav class="menu">

            <!-- PRINCIPAL -->
            <div class="menu-title">
                PRINCIPAL
            </div>

            <!-- DASHBOARD -->
            <a href="<?= base_url('/dashboardfun') ?>">
                <i class="fas fa-chart-line"></i>
                <span>
                    Dashboard
                </span>
            </a>

            <!-- DASHBOARD CÂMERAS -->
            <a href="<?= base_url('/camera_analise') ?>">
                <i class="fas fa-video"></i>
                <span>
                    Análise de EPI
                </span>
            </a>

            <!-- CONTA -->
            <div class="menu-title">
                CONTA
            </div>

            <!-- PERFIL -->
            <a href="<?= base_url('/perfilfun') ?>" class="active">
                <i class="fas fa-user"></i>
                <span>
                    Perfil
                </span>
            </a>

        </nav>

        <!-- SAIR -->
        <a
            href="<?= base_url('/') ?>"
            class="logout-item"
        >
            <i class="fas fa-sign-out-alt"></i>
            <span>
                Sair do Sistema
            </span>
        </a>

    </div>

</aside>

<div class="overlay">

    <div class="main" style="display: flex; flex-direction: column; width: 100%; box-sizing: border-box; padding: 20px;">

         <header class="dashboard-header">

            <div class="header-left">

                <div class="header-title">

                    <h1>
                        Perfil do Funcionário
                    </h1>

                    <p>
                        Visualize seus dados
                    </p>

                </div>

            </div>





        <!--botao de acessibilidade TESTE que nao deu muito certo, o vlibras ta funcionando-->
    <!-- BOTÃO CONFIGURAÇÕES -->

            <button
                class="gear-btn"
                onclick="toggleAccessMenu()"
            >
        
                <i class="fas fa-cog"></i>
        
            </button>
        
        
            <!-- OPÇÕES -->
        
            <div
                class="access-options"
                id="accessOptions"
            >
        
        
                <!-- CONTRASTE -->
        
                <button
                    class="access-btn"
                    onclick="Acessibilidade.toggleContraste()"
                    title="Alto contraste"
                >
        
                    <i class="fas fa-adjust"></i>
        
                </button>
        
        
                <!-- MODO ESCURO -->
        
                <button
                    class="access-btn"
                    onclick="toggleDark()"
                    title="Modo escuro"
                >
        
                    <i class="fas fa-moon"></i>
        
                </button>
        
        
                <!-- AUMENTAR FONTE -->
        
                <button
                    class="access-btn"
                    onclick="Acessibilidade.aumentarFonte()"
                    title="Aumentar fonte"
                >
        
                    A+
        
                </button>
        
        
                <!-- DIMINUIR FONTE -->
        
                <button
                    class="access-btn"
                    onclick="Acessibilidade.diminuirFonte()"
                    title="Diminuir fonte"
                >
        
                    A-
        
                </button>
        
        
                <!-- LER PÁGINA -->
        
                <button
                    class="access-btn"
                    onclick="Acessibilidade.lerPagina()"
                    title="Ler página"
                >
        
                    <i class="fas fa-volume-up"></i>
        
                </button>
        
        
            </div> 





        </header>

        <form action="<?= base_url('perfilfun/atualizar') ?>" method="post">
            <div class="card">
                <div class="perfil-header">

                    <div class="perfil-esquerda">

                        <div class="avatar">
                            <?= strtoupper(substr(session()->get('nome_fun'),0,1)); ?>
                        </div>

                        <div class="perfil-info">

                            <h1>Perfil do Funcionário</h1>

                            <p>Visualize e gerencie suas informações pessoais</p>

                            <span class="linha"></span>

                        </div>

                    </div>

                  <div class="perfil-direita">

    <img
        src="<?= base_url('assets/images/capacete_perfil.png') ?>"
        alt="Segurança com capacete"
        class="imagem-seguranca"
    >

</div>

                </div>

                <div class="subtitle">
                    <i class="fa-regular fa-user"></i>
                    Informações pessoais
                </div>

                <div class="form-grid">
                    <div class="input-box full">
                        <i class="fas fa-user"></i>
                        <input type="text" value="<?= session()->get('nome_fun') ?? 'Nome do Funcionário' ?>" disabled>
                    </div>

                    <div class="input-box">
                        <i class="fas fa-envelope"></i>
                        <input id="email" type="email" value="<?= session()->get('email_fun') ?? 'email@nexa.com' ?>" disabled>
                    </div>

                    <div class="input-box" id="telefoneBox">
                        <i class="fas fa-phone"></i>
                        <input
                            id="telefone"     
                            name="telefone"
                            type="text"
                            value="<?= $funcionario['TELEFONE'] ?? '' ?>"                    
                            placeholder="(00) 00000-0000"
                            maxlength="15"
                            oninput="mascaraTelefone(this)"
                            disabled
                        >
                    </div>

                    <div class="input-box">
                        <i class="fas fa-calendar"></i>
                        <input type="text" value="<?= isset($funcionario['DATA_NASCIMENTO']) 
                            ? date('d/m/Y', strtotime($funcionario['DATA_NASCIMENTO'])) 
                            : '' ?>" disabled>
                    </div>

                    <div class="input-box">
                        <i class="fas fa-id-badge"></i>
                        <input type="text" value="<?= $funcionario['UID_RFID'] ?? '' ?>" disabled>
                    </div>

                    <div class="full">
                        <div class="subtitle">
                            <i class="fas fa-shield-alt"></i>
                            EPIs Obrigatórios
                        </div>

                        <?php if (!empty($epis)): ?>
                            <?php foreach ($epis as $epi): ?>
                               <div class="input-box" style="margin-bottom:10px; gap:15px;">

                                    <img
                                        src="<?= base_url('uploads/epis/' . $epi['IMAGEM_EPI']) ?>"
                                        alt="<?= $epi['NOME_EPI'] ?>"
                                        style="
                                            width:60px;
                                            height:60px;
                                            object-fit:cover;
                                            border-radius:10px;
                                            border:1px solid #ddd;
                                        "
                                    >

                                    <div>
                                        <strong><?= $epi['NOME_EPI'] ?></strong><br>
                                        <small><?= $epi['DESCRICAO_EPI'] ?></small>
                                    </div>

                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="input-box">
                                <i class="fas fa-hard-hat"></i>
                                <span>Nenhum EPI obrigatório cadastrado.</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="subtitle">
                    <i class="fas fa-lock"></i>
                    Segurança
                </div>

                <div class="seguranca-box">

                    <!-- Senha atual -->
                    <div class="input-box full input-group" id="senhaAtualBox">

                        <div style="display:flex;align-items:center;width:100%;">

                            <i class="fas fa-lock"></i>

                            <div class="campo">

                                <label>Senha atual</label>

                                <input
                                    id="senhaAtual"
                                    name="SenhaAtual"
                                    type="password"
                                    placeholder="********"
                                    disabled>

                            </div>

                        </div>

                        <div class="error-text" id="erroAtual"></div>

                    </div>

                    <!-- Nova senha -->
                    <div class="input-box input-group" id="novaSenhaBox" style="display:none;">

                        <div style="display:flex;align-items:center;width:100%;">

                            <i class="fas fa-key"></i>

                            <div class="campo">

                                <label>Nova senha</label>

                                <input
                                    id="novaSenha"
                                    name="novaSenha"
                                    type="password">

                            </div>

                        </div>

                        <div class="error-text" id="erroNova"></div>

                    </div>

                    <!-- Confirmar senha -->
                    <div class="input-box input-group" id="confirmarSenhaBox" style="display:none;">

                        <div style="display:flex;align-items:center;width:100%;">

                            <i class="fas fa-key"></i>

                            <div class="campo">

                                <label>Confirmar senha</label>

                                <input
                                    id="confirmarSenha"
                                    type="password">

                            </div>

                        </div>

                        <div class="error-text" id="erroConfirmar"></div>

                    </div>

                </div>

                <button type="button" class="btn editar" onclick="editar()">
                    <i class="fas fa-edit"></i> Editar Campos
                </button>
                <button type="button" class="btn salvar" onclick="salvar()" style="display:none;">
                    <i class="fas fa-save"></i> Salvar Alterações
                </button>
            </div>
            <input type="hidden" name="novaSenha" id="novaSenhaHidden">
        </form>

    </div>
</div>

    <!-- WIDGET VLIBRAS -->
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

    <script>
        // Função para abrir/fechar o submenu de acessibilidade
        function toggleAccessMenu() {
            const menu = document.getElementById("accessOptions");
            if (menu) {
                menu.classList.toggle("active");
            }
        }

        // Função do Modo Escuro garantindo a classe no body e html
        function toggleDark() {
            document.body.classList.toggle("dark");
            document.body.classList.toggle("dark-mode");
            document.documentElement.classList.toggle("dark");
        }

        // Handlers seguros para chamar o arquivo acessibilidade.js
        function toggleContrasteHandler() {
            if (typeof Acessibilidade !== 'undefined' && Acessibilidade.toggleContraste) {
                Acessibilidade.toggleContraste();
            } else {
                document.body.classList.toggle("alto-contraste");
            }
        }

        function aumentarFonteHandler() {
            if (typeof Acessibilidade !== 'undefined' && Acessibilidade.aumentarFonte) {
                Acessibilidade.aumentarFonte();
            }
        }

        function diminuirFonteHandler() {
            if (typeof Acessibilidade !== 'undefined' && Acessibilidade.diminuirFonte) {
                Acessibilidade.diminuirFonte();
            }
        }

        function lerPaginaHandler() {
            if (typeof Acessibilidade !== 'undefined' && Acessibilidade.lerPagina) {
                Acessibilidade.lerPagina();
            }
        }

        function toggleVLibras() {
            const vlibrasBtn = document.querySelector('[vw-access-button]');
            if (vlibrasBtn) {
                vlibrasBtn.click();
            }
        }

        function editar(){
            const telefoneInput = document.getElementById("telefone");
            const senhaAtualInput = document.getElementById("senhaAtual");
            
            telefoneInput.disabled = false;
            senhaAtualInput.disabled = false;

            document.getElementById("telefoneBox").classList.add("editable-field");
            document.getElementById("senhaAtualBox").classList.add("editable-field");
            document.getElementById("novaSenhaBox").classList.add("editable-field");
            document.getElementById("confirmarSenhaBox").classList.add("editable-field");

            document.getElementById("novaSenhaBox").style.display = "flex";
            document.getElementById("confirmarSenhaBox").style.display = "flex";

            document.querySelector(".editar").style.display = "none";
            document.querySelector(".salvar").style.display = "flex";
        }

        function salvar(){
            let ok = true;

            const nova = document.getElementById("novaSenha");
            const confirmar = document.getElementById("confirmarSenha");
            const novaBox = document.getElementById("novaSenhaBox");
            const confirmarBox = document.getElementById("confirmarSenhaBox");

            limparErros();

            if(nova.value !== "" || confirmar.value !== ""){
                if(nova.value.length < 8){
                    document.getElementById("erroNova").innerText = "A senha deve ter no mínimo 8 caracteres";
                    novaBox.classList.add("error");
                    ok = false;
                }

                if(nova.value !== confirmar.value){
                    document.getElementById("erroConfirmar").innerText = "As senhas não coincidem";
                    confirmarBox.classList.add("error");
                    ok = false;
                }
            }

            if(!ok) return;

            document.getElementById("telefone").readOnly = true;

            document.getElementById("telefoneBox").classList.remove("editable-field");
            document.getElementById("senhaAtualBox").classList.remove("editable-field");

            document.getElementById("novaSenhaBox").style.display = "none";
            document.getElementById("confirmarSenhaBox").style.display = "none";

            document.querySelector(".editar").style.display = "flex";
            document.querySelector(".salvar").style.display = "none";

            document.getElementById("novaSenhaHidden").value = document.getElementById("novaSenha").value;
            
            Swal.fire({
                icon: "success",
                title: "Sucesso!",
                text: "Seus dados foram atualizados com sucesso.",
                confirmButtonColor: "#0a66c2",
                confirmButtonText: "Continuar"
            }).then(() => {
                document.querySelector("form").submit();
            });
        }

        function limparErros(){
            document.getElementById("erroNova").innerText = "";
            document.getElementById("erroConfirmar").innerText = "";
            document.getElementById("novaSenhaBox").classList.remove("error");
            document.getElementById("confirmarSenhaBox").classList.remove("error");
        }

        function mascaraTelefone(input){
            let v = input.value.replace(/\D/g, "");

            if(v.length <= 10){
                v = v.replace(/(\d{2})(\d)/, "($1) $2");
                v = v.replace(/(\d{4})(\d)/, "$1-$2");
            } else {
                v = v.replace(/(\d{2})(\d)/, "($1) $2");
                v = v.replace(/(\d{5})(\d)/, "$1-$2");
            }
            input.value = v;
        }
    </script>

    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>

</body>
</html>