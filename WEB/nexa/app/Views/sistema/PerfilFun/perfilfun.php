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


        <!-- =================================================
             MENU
        ================================================== -->

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


           
            <!-- =================================================
                 CONTA
            ================================================== -->

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


        <!-- =================================================
             SAIR
        ================================================== -->

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

    <div class="main">


               <!-- MENU ACESSIBILIDADE -->
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

        <div class="fundo-capacete"></div>

        <div class="circulo"></div>

        <i class="fa-solid fa-helmet-safety"></i>
<div class="dots dots1"></div>
<div class="dots dots2"></div>
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
value="<?= $funcionario['TELEFONE'] ?? '' ?>"                    placeholder="(00) 00000-0000"
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
<button type="button" class="btn salvar" onclick="salvar()">
                <i class="fas fa-save"></i> Salvar Alterações
            </button>
        </div>
    </div>
<input type="hidden" name="novaSenha" id="novaSenhaHidden"></form>

    <script>
        function editar(){
            // Habilita os campos específicos e adiciona a classe visual de "editável"
            const telefoneInput = document.getElementById("telefone");
            const senhaAtualInput = document.getElementById("senhaAtual");
            
            telefoneInput.disabled = false;
            senhaAtualInput.disabled = false;

            document.getElementById("telefoneBox").classList.add("editable-field");
            document.getElementById("senhaAtualBox").classList.add("editable-field");
            document.getElementById("novaSenhaBox").classList.add("editable-field");
            document.getElementById("confirmarSenhaBox").classList.add("editable-field");

            // Exibe os campos de nova senha
            document.getElementById("novaSenhaBox").style.display = "flex";
            document.getElementById("confirmarSenhaBox").style.display = "flex";

            // Alterna os botões
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

            // Se tudo estiver certo, desabilita e limpa as classes editáveis
            document.getElementById("telefone").readOnly = true;
           

            document.getElementById("telefoneBox").classList.remove("editable-field");
            document.getElementById("senhaAtualBox").classList.remove("editable-field");

            document.getElementById("novaSenhaBox").style.display = "none";
            document.getElementById("confirmarSenhaBox").style.display = "none";

            document.querySelector(".editar").style.display = "flex";
            document.querySelector(".salvar").style.display = "none";

            // Dispara o alerta customizado elegante
     document.getElementById("novaSenhaHidden").value =
    document.getElementById("novaSenha").value;
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

        function toggleDark() {
            document.body.classList.toggle("dark");
        }
    </script>

    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>

</body>
</html>