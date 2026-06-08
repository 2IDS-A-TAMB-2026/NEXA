<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<title>NEXA | Recuperar Senha</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- CSS -->
<link rel="stylesheet" href="assets/css/acessibilidade.css">
<link rel="stylesheet" href="assets/css/acessibilidade_login.css">

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
.recover-wrapper{
    width:820px;
    height:420px;
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

.logo-esquerda{
    width:160px;
    z-index:2;
    filter:drop-shadow(0 0 15px rgba(255,255,255,0.25));
    transition:.3s;
}

.logo-esquerda:hover{
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

h2{
    text-align:center;
    font-size:30px;
    font-weight:700;
    color:#1f3c5b;
    margin-bottom:14px;
}

p{
    text-align:center;
    font-size:14px;
    color:#666;
    margin-bottom:20px;
}

/* ===== INPUT ===== */
.input-box{
    position:relative;
    margin-bottom:14px;
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
    margin-top:4px;
}

.btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(0,0,0,0.2);
}

/* ===== MENSAGENS ===== */
.error{
    display:none;
    color:red;
    text-align:center;
    font-size:13px;
    margin-top:10px;
}

.success{
    display:none;
    color:green;
    text-align:center;
    font-size:13px;
    margin-top:10px;
}

/* ===== LINK ===== */
a{
    display:block;
    text-align:center;
    margin-top:16px;
    font-size:14px;
    color:var(--primary);
    text-decoration:none;
}

a:hover{
    text-decoration:underline;
}

/* ===== RESPONSIVO ===== */
@media(max-width:900px){

    .recover-wrapper{
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

    .logo-esquerda{
        width:130px;
    }

    .container{
        padding:30px;
    }

    h2{
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
<div class="recover-wrapper">

    <!-- ESQUERDA -->
    <div class="lado-esquerdo">

            <img class="logo-esquerda" alt="Logo NEXA" src="<?= base_url('assets/images/logo_escura_transparente.png') ?>">
      
    </div>

    <!-- DIREITA -->
    <div class="container">

        <h2>Recuperar Senha</h2>

        <p>
            Digite seu e-mail para continuar
        </p>

        <div class="input-box">

            <i class="fas fa-envelope"></i>

            <input
                type="email"
                id="email"
                placeholder="Seu e-mail"
            >

        </div>

     <button class="btn" onclick="recuperarSenha()">
            Continuar
        </button>

        <div class="error" id="erro">
            E-mail não encontrado
        </div>

        <div class="success" id="sucesso">
            Redirecionando...
        </div>

      <a href="<?= base_url('loginfun') ?>">
            Voltar para o login
        </a>

    </div>

</div>

<!-- SCRIPT -->
<script>

async function recuperarSenha(){

    const email = document.getElementById("email").value;

    const erro = document.getElementById("erro");
    const sucesso = document.getElementById("sucesso");

    erro.style.display = "none";
    sucesso.style.display = "none";

    if(!email){

        erro.innerText = "Digite um e-mail";
        erro.style.display = "block";
        return;

    }

    try{

      const resposta = await fetch(
    "<?= site_url('recuperar/enviar') ?>",
{
    method: "POST",
    headers:{
        "Content-Type":"application/x-www-form-urlencoded"
    },
    body:`email=${encodeURIComponent(email)}`
});
        const texto = await resposta.text();

        if(texto === "sucesso"){

            sucesso.innerText =
            "E-mail enviado com sucesso";

            sucesso.style.display = "block";

        }else{

            erro.innerText = texto;
            erro.style.display = "block";

        }

    }catch(e){

        erro.innerText = "Erro ao conectar";
        erro.style.display = "block";

    }

}

</script>
</body>
</html>