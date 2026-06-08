<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>NEXA | Perfil</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style_funci.css') ?>">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* ===== RESET E CONFIGURAÇÕES GLOBAIS ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        h1{
            color: #0d7ce3;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: url('https://img.freepik.com/photos-premium/pour-securite-operation-travail-ingenieur-deux-ouvriers-du-batiment-tiennent-respectivement-casque-securite-jaune-blanc-the-generative-ai_28914-25222.jpg') no-repeat center center/cover;
            transition:  0.3s;
        }

        /* ===== SIDEBAR (MENU LATERAL FIXO) ===== */
        .sidebar {
            width: 260px;
            background: #0f2a44;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            z-index: 10;
        }

        .sidebar-top {
            position: relative;
            height: 160px;
            background: url('<?= base_url("assets/images/slide1.jpg") ?>') center/cover;
            display: flex;
            align-items: flex-end;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .sidebar-top::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(15,42,68,0.95));
        }

        .sidebar-top span {
            position: relative;
            z-index: 1;
        }

        .menu {
            display: flex;
            flex-direction: column;
            padding: 10px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            margin-bottom: 5px;
            border-radius: 8px;
            color: #cbd5e1;
            text-decoration: none;
            transition: .2s;
        }

        .menu a:hover, .menu a.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.08);
        }

        .logout-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            margin: 15px;
            border-radius: 8px;
            color: #cbd5e1;
            text-decoration: none;
            transition: .2s;
            border-top: 1px solid rgba(255,255,255,.1);
            margin-top: auto;
        }

        .logout-item:hover {
            background: #e53935;
            color: #fff;
        }

   .main {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;

    padding-top: 0px;
}
          



        /* ===== CARD DO FORMULÁRIO (CONTAINER BRANCO) ===== */
        .card {
            width: 100%;
            max-width: 850px;
            background: #ffffff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            margin: auto;

        }

        .card h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #0a66c2;
            font-size: 28px;
            font-weight: bold;
        }

        .subtitle {
            color: #0a66c2;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Estrutura em Grid */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }

        .full {
            grid-column: span 2;
        }

        .input-group {
            display: flex;
            flex-direction: column;
        }

        /* Caixas de Input Arredondadas e Elegantes */
        .input-box {
            background: #f5f5f5;
            border-radius: 12px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            border: 1px solid #dcdcdc;
            transition: all 0.2s;
        }

        .input-box i {
            color: #0a66c2;
            margin-right: 12px;
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .input-box input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            font-size: 15px;
            color: #333;
        }

        /* Estado quando o input está liberado para editar */
        .input-box.editable-field {
            background: #ffffff;
            border-color: #cccccc;
        }

        .input-box.editable-field:focus-within {
            border-color: #0a66c2;
            box-shadow: 0 0 0 3px rgba(10, 102, 194, 0.15);
        }

        /* Validação de Erro */
        .input-box.error {
            border-color: #e53935;
            background: #fff8f8;
        }

        .error-text {
            font-size: 13px;
            color: #e53935;
            margin-top: 6px;
            padding-left: 5px;
            font-weight: bold;
        }

        /* ===== BOTÕES ===== */
        .btn {
            margin-top: 15px;
            width: 200px;
            height: 48px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-left: auto;
            margin-right: auto;
            transition: background 0.2s, transform 0.1s;
        }

        .editar {
            background: #0a66c2;
            color: #fff;
        }

        .editar:hover {
            background: #084d93;
        }

        .salvar {
            display: none;
            background: #28a745;
            color: #fff;
        }

        .salvar:hover {
            background: #1e7e34;
        }

        .btn:active {
            transform: scale(0.98);
        }

        /* ===== ACESSIBILIDADE - DARK MODE ===== */
        .dark {
            background: #0f172a !important;
        }

        .dark .card {
            background: #1e293b;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .dark .card h1 {
            color: #fff;
        }

        .dark .subtitle {
            color: #38bdf8;
        }

        .dark .input-box {
            background: #334155;
            border-color: #475569;
        }

        .dark .input-box i {
            color: #38bdf8;
        }

        .dark .input-box input {
            color: #fff;
        }

        .dark .input-box.editable-field {
            background: #1e293b;
            border-color: #64748b;
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-top">
            <span>NEXA</span>
        </div>

        <nav class="menu">
            <a href="<?= base_url('dashboardfun') ?>"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="<?= base_url('camera_analise') ?>"><i class="fas fa-camera"></i> Análise EPI</a>
            <a href="<?= base_url('/perfilfun') ?>" class="active"><i class="fas fa-user"></i> Perfil</a>
        </nav>

        <a href="<?= base_url('logout') ?>" class="logout-item">
            <i class="fas fa-sign-out-alt"></i> Sair
        </a>
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
            <h1>Perfil do Funcionário</h1>

            <div class="subtitle">Informações pessoais</div>

            <div class="form-grid">
                <div class="input-box full">
                    <i class="fas fa-user"></i>
                    <input type="text" value="<?= session()->get('nome') ?? 'Nome do Funcionário' ?>" disabled>
                </div>

                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input id="email" type="email" value="<?= session()->get('email') ?? 'email@nexa.com' ?>" disabled>
                </div>

                <div class="input-box" id="telefoneBox">
                    <i class="fas fa-phone"></i>
                  <input
                    id="telefone"     
                    name="telefone"
                    type="text"
                    value="<?= $funcionario['TELEFONE'] ?>"
                    placeholder="(00) 00000-0000"
                    maxlength="15"
                    oninput="mascaraTelefone(this)"
                    disabled
                >
                </div>

                <div class="input-box">
                    <i class="fas fa-calendar"></i>
                    <input type="text" value="<?= date('d/m/Y', strtotime($funcionario['DATA_NASCIMENTO'])) ?>" disabled>
                </div>

                <div class="input-box">
                    <i class="fas fa-id-badge"></i>
                <input type="text" value="<?= $funcionario['UID_RFID'] ?>" disabled>
                </div>

                <div class="input-box full">
                    <i class="fas fa-hard-hat"></i>
                    <input type="text" value="Capacete, Luvas, Óculos" disabled>
                </div>
            </div>

            <div class="subtitle">Segurança</div>

            <div class="form-grid">
                <div class="input-box input-group" id="senhaAtualBox">
                    <div style="display:flex; align-items:center; width:100%;">
                        <i class="fas fa-lock"></i>
                        <input id="senhaAtual" type="password" placeholder="Senha atual" disabled>
                    </div>
                    <div class="error-text" id="erroAtual"></div>
                </div>

                <div class="input-box input-group" id="novaSenhaBox" style="display:none;">
                    <div style="display:flex; align-items:center; width:100%;">
                        <i class="fas fa-key"></i>
                        <input id="novaSenha" type="password" placeholder="Nova senha (mín. 8 caracteres)">
                    </div>
                    <div class="error-text" id="erroNova"></div>
                </div>

                <div class="input-box input-group" id="confirmarSenhaBox" style="display:none;">
                    <div style="display:flex; align-items:center; width:100%;">
                        <i class="fas fa-key"></i>
                        <input id="confirmarSenha" type="password" placeholder="Confirmar senha">
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
    <input type="hidden" name="novaSenha" id="novaSenhaHidden">
</form>

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