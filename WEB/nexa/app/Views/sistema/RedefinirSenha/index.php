<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>NEXA | Nova Senha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/acessibilidade.css">
    <link rel="stylesheet" href="assets/css/acessibilidade_login.css">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- ICONES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        :root{
            --primary:#0A66C2;
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Inter',sans-serif;
        }

        /* ===== BODY ===== */
        .body_login{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#0057b8,#002f6c);
            overflow:hidden;
            position:relative;
            padding:20px;
        }

        .body_login::before{
            content:"";
            position:absolute;
            width:100%;
            height:100%;
            background:
            radial-gradient(circle at top left, rgba(255,255,255,0.08), transparent 40%),
            radial-gradient(circle at bottom right, rgba(255,255,255,0.05), transparent 40%);
        }

        /* ===== ACESSIBILIDADE ===== */
        .access-bar{
            position:absolute;
            top:15px;
            right:15px;
            display:flex;
            gap:10px;
            z-index:10;
        }

        .access-btn{
            width:40px;
            height:40px;
            border:none;
            border-radius:12px;
            background:#fff;
            color:#0057b8;
            font-size:14px;
            cursor:pointer;
            transition:.3s;
            box-shadow:0 4px 10px rgba(0,0,0,0.15);
        }

        .access-btn:hover{
            transform:translateY(-2px);
        }

        /* ===== CARD ===== */
        .senha-wrapper{
            width:820px;
            height:430px;
            background:#fff;
            border-radius:28px;
            overflow:hidden;
            display:flex;
            box-shadow:0 20px 50px rgba(0,0,0,0.35);
            position:relative;
            z-index:2;
        }

        /* ===== ESQUERDA ===== */
        .lado-esquerdo{
            width:45%;
            background:linear-gradient(145deg,#0057b8,#002f6c);
            display:flex;
            justify-content:center;
            align-items:center;
            position:relative;
        }

        .lado-esquerdo::before{
            content:"";
            position:absolute;
            width:100%;
            height:100%;
            background:linear-gradient(
                135deg,
                rgba(255,255,255,0.06),
                transparent
            );
        }

        .logo{
            width:160px;
            z-index:2;
            filter:drop-shadow(0 0 15px rgba(255,255,255,0.25));
            transition:.3s;
        }

        .logo:hover{
            transform:scale(1.05);
        }

        /* ===== DIREITA ===== */
        .container{
            width:55%;
            background:#fff;
            display:flex;
            flex-direction:column;
            justify-content:center;
            padding:40px;
        }

        .titulo{
            text-align:center;
            font-size:30px;
            font-weight:700;
            color:#1f3c5b;
            margin-bottom:22px;
        }

        /* ===== INPUT ===== */
        .form-group{
            margin-bottom:14px;
        }

        .input-box{
            position:relative;
        }

        .input-box i{
            position:absolute;
            left:14px;
            top:50%;
            transform:translateY(-50%);
            color:#0A66C2;
            font-size:14px;
        }

        .input-box input{
            width:100%;
            height:46px;
            border:2px solid #d1d5db;
            border-radius:12px;
            padding-left:42px;
            font-size:14px;
            outline:none;
            transition:.3s;
            background:#fff;
        }

        .input-box input:focus{
            border-color:#0057b8;
            box-shadow:0 0 10px rgba(0,87,184,0.2);
        }

        .input-box.error{
            border:2px solid #e53935;
            border-radius:12px;
        }

        .error-text{
            color:#e53935;
            font-size:12px;
            margin-top:6px;
            padding-left:6px;
        }

        /* ===== BOTÃO ===== */
        .btn{
            width:100%;
            height:46px;
            border:none;
            border-radius:12px;
            background:linear-gradient(90deg,#0066d6,#003f96);
            color:#fff;
            font-size:17px;
            font-weight:700;
            cursor:pointer;
            transition:.3s;
            margin-top:6px;
        }

        .btn:hover{
            transform:translateY(-2px);
            box-shadow:0 10px 20px rgba(0,0,0,0.2);
        }

        /* ===== ERRO ===== */
        .error{
            margin-top:10px;
            color:red;
            font-size:13px;
            text-align:center;
            display:none;
        }

        /* ===== FOOTER ===== */
        footer{
            margin-top:18px;
            text-align:center;
            font-size:13px;
            color:#9ca3af;
        }

        footer a{
            color:var(--primary);
            text-decoration:none;
        }

        footer a:hover{
            text-decoration:underline;
        }

        /* ===== RESPONSIVO ===== */
        @media(max-width:900px){

            .senha-wrapper{
                width:100%;
                height:auto;
                flex-direction:column;
            }

            .lado-esquerdo,
            .container{
                width:100%;
            }

            .lado-esquerdo{
                padding:35px 0;
            }

            .logo{
                width:130px;
            }

            .container{
                padding:30px;
            }

            .titulo{
                font-size:26px;
            }

        }

    </style>
</head>

<body class="body_login">

    <!-- ACESSIBILIDADE -->
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

    <!-- CARD -->
    <div class="senha-wrapper">

        <!-- ESQUERDA -->
        <div class="lado-esquerdo">

            <img src="assets/images/logo_escura_transparente.png"
                 class="logo">

        </div>

        <!-- DIREITA -->
        <div class="container">

            <h2 class="titulo">
                Criar Nova Senha
            </h2>

            <div class="form-group">

                <div class="input-box">

                    <i class="fas fa-lock"></i>

                    <input
                        type="password"
                        id="senha"
                        placeholder="Nova senha"
                        oninput="clearError(this)"
                    >

                </div>

                <div class="error-text"></div>

            </div>

            <div class="form-group">

                <div class="input-box">

                    <i class="fas fa-lock"></i>

                    <input
                        type="password"
                        id="confirmar"
                        placeholder="Confirmar senha"
                        oninput="clearError(this)"
                    >

                </div>

                <div class="error-text"></div>

            </div>

            <button class="btn" onclick="salvarSenha()">
                Salvar Nova Senha
            </button>

            <div class="error" id="erro">
                As senhas não coincidem!
            </div>

            <footer>

                <a href="login.html">
                    Voltar para login
                </a>

                <br><br>

                <p>
                    © 2026 – NEXA
                </p>

            </footer>

        </div>

    </div>

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        function salvarSenha(){

            const senha = document.getElementById("senha").value;
            const confirmar = document.getElementById("confirmar").value;

            if(senha === "" || confirmar === ""){

                Swal.fire({
                    icon:"warning",
                    title:"Campos vazios",
                    text:"Preencha os dois campos para continuar.",
                    confirmButtonColor:"#0a66c2"
                });

                return;

            }

            if(senha.length < 8){

                Swal.fire({
                    icon:"error",
                    title:"Senha muito curta",
                    text:"A senha deve ter no mínimo 8 caracteres.",
                    confirmButtonColor:"#0a66c2"
                });

                return;

            }

            if(senha !== confirmar){

                Swal.fire({
                    icon:"error",
                    title:"Erro",
                    text:"As senhas não coincidem.",
                    confirmButtonColor:"#0a66c2"
                });

                return;

            }

            Swal.fire({
                icon:"success",
                title:"Senha atualizada!",
                text:"Sua senha foi redefinida com sucesso.",
                confirmButtonColor:"#0a66c2"
            }).then(() => {

                window.location.href = "login.html";

            });

        }

        function toggleDark(){

            document.body.classList.toggle("dark-mode");

        }

    </script>

    <!-- ACESSIBILIDADE -->
    <script src="assets/js/acessibilidade.js"></script>

</body>

</html>