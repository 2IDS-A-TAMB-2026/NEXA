<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do administrador | NEXA</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/acessibilidade.css">
    <link rel="stylesheet" href="assets/css/style_geral.css">
    <!--só deixa ele aí, tá funcionando.-->
    <link rel="stylesheet" href="assets/css/cadastro_camera.css">

    <link rel="stylesheet" href="assets/css/perfil_admin.css">



    <style>
        #mudar-senha,
        #atencao {
            display: none;
            font-style: italic;
            color: grey;
            font-size: 14px;
        }

        #clique-editar {
            display: block;
            font-style: italic;
            color: grey;
            font-size: 14px;
        }

        #h1-adm {
            color: #0a66c2;
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
            <a href="<?= base_url('/Camera') ?>">
                <i class="fas fa-camera"></i>
                <span>Cadastro Câmeras</span>
            </a>
            <a href="<?= base_url('/setor') ?>">
                <i class="fas fa-building"></i>
                <span>Cadastro Setores</span>
            </a>
            <a href="<?= base_url('/administrador') ?>" class="active">
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
        <div class="card">
            <h1 id="h1-adm">Perfil do administrador</h1>
            <div class="subtitle">Informações pessoais</div>
            <span id="atencao"><b>ATENÇÃO</b>: você está alterando os dados do seu perfil.</span>
            <span id="clique-editar">Clique em "<b>Editar dados</b>" se quiser mudar os campos abaixo.</span>
            <br>

            <div class="form-grid">
                <!--confia-->
                <form id="editar-perfil" method="post"
                    action="<?= base_url('/administrador/atualizar/' . session()->get('cpf')) ?>">
                    <div class="input-box full">
                        <i class="fas fa-user"></i>
                        <input id="NOME_COMPLETO" name="NOME_COMPLETO" type="text" readonly
                            value="<?= $administrador['NOME_COMPLETO'] ?>">
                    </div>

                    <div class="input-box">
                        <i class="fas fa-envelope"></i>
                        <input id="EMAIL_CORPORATIVO" name="EMAIL_CORPORATIVO" type="email" readonly
                            value="<?= $administrador['EMAIL_CORPORATIVO'] ?>">
                    </div>

                    <div class="input-box" id="telefoneBox">
                        <i class="fas fa-phone"></i>
                        <input id="TELEFONE" name="TELEFONE" type="text" readonly
                            value="<?= $administrador['TELEFONE'] ?>">
                    </div>

                    <div class="input-box" id="telefoneBox">
                        <i class="fas fa-address-card"></i>
                        <input id="cpf" type="text" maxlength="11" oninput="mascaraCPF(this)"
                            value="<?= session()->get('cpf') ?? '000.000.000-00' ?>">
                    </div>

                    <div class="input-box">
                        <i class="fas fa-calendar"></i>
                        <input type="date" value="<?= session()->get('data_nascimento') ?? '11/09/2001' ?>">
                    </div>

                    <div class="input-box" id="senhaBox" style="display:none;">
                        <i class="fas fa-lock"></i>
                        <input id="SENHA" name="SENHA" type="password" placeholder="Digite nova senha">
                    </div>

                    <div class="input-box" id="confirmarSenhaBox" style="display:none;">
                        <i class="fas fa-lock"></i>
                        <input name="CONFIRMAR_SENHA" id="CONFIRMAR_SENHA" type="password"
                            placeholder="Confirmar senha">
                    </div>

                    <div></div>
                    <span id="mudar-senha">Preencha o campo de senha somente se quiser mudá-la!</span>

                    <div id="botoes-edicao">

                        <button type="button" id="botao_editar" onclick="editar()" class="btn">
                            <span class="transition"></span>
                            <span class="gradient"></span>
                            <span class="label">Editar dados</span>
                        </button>

                        <div id="grupo-acoes" style="display:none;">

                            <button type="button" class="btn" onclick="cancelarEdicao()">
                                <span class="transition"></span>
                                <span class="gradient"></span>
                                <span class="label">Cancelar</span>
                            </button>

                            <button id="botao_salvar" class="btn salvar" type="submit">
                                <span class="transition_salvar"></span>
                                <span class="gradient"></span>
                                <span class="label">Salvar</span>
                            </button>

                        </div>

                    </div>
                    <!--<button id="botao_salvar" class="btn salvar" onclick="salvar()" type="submit">
                        <i class="fas fa-save"></i> Salvar
                    </button>-->

                </form>
            </div>

        </div>
    </div>
    <script src="assets/js/acessibilidade.js"></script>

    <script>
        const mudarSenha = document.getElementById('mudar-senha');
        const atencao = document.getElementById('atencao');
        let senhaIPT = document.getElementById('SENHA');
        let nomeIPT = document.getElementById('NOME_COMPLETO');
        let telefoneIPT = document.getElementById('TELEFONE');
        let emailIPT = document.getElementById('EMAIL_CORPORATIVO');
        let btnSalvar = document.getElementById('botao_salvar');
        let btnEditar = document.getElementById('botao_editar');
        let senhaBox = document.getElementById('senhaBox');
        const clique_editar = document.getElementById('clique-editar');

        function mostrarErro(title, msg) {
            Swal.fire({
                icon: "error",
                title: title,
                text: msg,
            });
        }

        document.getElementById('editar-perfil')
            .addEventListener('submit', function (event) {

                event.preventDefault();

                let senha = document.getElementById('SENHA').value;
                let confirmar =
                    document.getElementById('CONFIRMAR_SENHA').value;

                if (senha !== '' && senha !== confirmar) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'As senhas não coincidem.'
                    });

                    return;
                }

                Swal.fire({
                    title: 'Tem certeza?',
                    text: 'Deseja realizar as alterações?',
                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Cancelar'

                }).then((result) => {

                    if (result.isConfirmed) {
                        this.submit();
                        //teste
                        location.reload();
                    }

                });

            });

        function salvar() {
            btnEditar.style.display = "block";
            btnSalvar.style.display = "none";
            mudarSenha.style.display = "none";
            atencao.style.display = "none";
            clique_editar.style.display = "block";
            senhaBox.style.display = "none";
            alert("Perfil atualizado!");

        }
    </script>

    <script>
        const camposEditaveis = [
            nomeIPT,
            emailIPT,
            telefoneIPT,
            senhaIPT
        ];

        function editar() {
            camposEditaveis.forEach(campo =>
                campo.removeAttribute('readonly')
            );

            document.getElementById('confirmarSenhaBox')
                .style.display = 'flex';


            btnEditar.style.display = "none";

            document.getElementById('grupo-acoes')
                .style.display = "flex";

            mudarSenha.style.display = "block";
            atencao.style.display = "block";
            clique_editar.style.display = "none";
            senhaBox.style.display = "flex";
            btnEditar.style.display = "none";
            btnSalvar.style.display = "block";
        }

        function cancelarEdicao() {
            location.reload();
        }

    </script>
</body>

</html>