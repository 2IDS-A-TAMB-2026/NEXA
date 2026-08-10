<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Funcionários</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style_geral.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/cadastro_funci.css') ?>">

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

        <div class="sidebar-logo">

    <img src="<?= base_url('assets/images/logo_escura_transparente.png') ?>">

    <div class="sidebar-brand-text">
        <strong>NEXA</strong>
        <span>Segurança é prioridade</span>
    </div>

</div>


        <nav class="menu">

            <div class="menu-title">PRINCIPAL</div>

            <a href="<?= base_url('/dashboard') ?>" >
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


            <div class="menu-title">CADASTROS</div>

            <a href="<?= base_url('/cadastro-funcionario') ?>" class="active">
                <i class="fas fa-users"></i>
                <span>Cadastro Funcionários</span>
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


            <div class="menu-title">CONTA</div>

            <a href="<?= base_url('/administrador') ?>">
                <i class="fas fa-user"></i>
                <span>Perfil</span>
            </a>

        </nav>


        <a href="<?= base_url('/') ?>" class="logout-item">
            <i class="fas fa-sign-out-alt"></i>
            <span>Sair do Sistema</span>
        </a>

    </div>

</aside>
    <header class="dashboard-header">

        <div class="header-title">
            <h1>Cadastro de Funcionários</h1>
            <p>Gerencie os funcionários cadastrados da sua empresa</p>
        </div>

        <div class="header-right">

         

            </div>

             <a href="<?= base_url('/administrador') ?>" class="profile">


                <div class="profile-avatar">

                    <?= strtoupper(substr(session()->get('nome'), 0, 1)) ?>

                </div>



                <div class="profile-info">

                    <strong>
                        <?= esc(session()->get('nome')) ?>
                    </strong>


                    <span>
                        NEXA SOLUÇÕES
                    </span>

                </div>


            </a>

        </div>

    </header>

    <div class="overlay">

        <div class="content-container">

            <section class="form-card">

                <div class="cadastro-topo">

                    <div class="cadastro-info">

                        <div class="funcionario-icon-bg">
                            <i class="fas fa-user-plus"></i>
                        </div>

                        <div>

                            <h2>Cadastrar Novo Funcionário</h2>

                            <p>
                                Preencha as informações para adicionar um novo funcionário ao sistema.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="subtitle">

                    Informações

                </div>



                <form id="form-fun" action="<?= base_url('/Cadastro_Fun/inserir') ?>" method="post"
                    onsubmit="return prepararEEnviar(this);">

                    <?= csrf_field() ?>

                    <input type="hidden" name="CPF_ORIGINAL" id="cpf_original">

                    <div class="form-grid">

                        <!-- Nome -->

                        <div class="form-group">

                            <p class="p-card">Nome completo</p>

                            <div class="input-box">

                                <i class="fas fa-user"></i>

                                <input type="text" id="nome" name="NOME_COMPLETO" placeholder="Nome completo" 
                                   value="<?= old('NOME_COMPLETO') ?>" oninput="validarNome(this)"  >

                            </div>

                            <div class="error-text"></div>

                        </div>

                        <!-- CPF -->

                        <div class="form-group">

                            <p class="p-card">CPF</p>

                            <div class="input-box">

                                <i class="fas fa-id-card"></i>

                                <input type="text" id="cpf" name="CPF" placeholder="000.000.000-00" maxlength="14"
                                    oninput="maskCPF(this)"     value="<?= old('CPF') ?>">

                            </div>

                            <div class="error-text"></div>

                        </div>

                        <!-- Data -->

                        <div class="form-group">

                            <p class="p-card">Data de nascimento</p>

                            <div class="input-box">

                                <i class="fas fa-calendar"></i>

<input 
type="date"
id="nascimento"
name="DATA_NASCIMENTO"
max="<?= date('Y-m-d') ?>
"     value="<?= old('DATA_NASCIMENTO') ?>"
>
                            </div>

                            <div class="error-text"></div>

                        </div>

                        <!-- Email -->

                        <div class="form-group">

                            <p class="p-card">E-mail corporativo</p>

                            <div class="input-box">

                                <i class="fas fa-envelope"></i>

                                <input type="email" id="email" name="EMAIL_CORPORATIVO" placeholder="E-mail corporativo"
                                        value="<?= old('EMAIL_CORPORATIVO') ?>">

                            </div>

                            <div class="error-text"></div>

                        </div>

                        <!-- Telefone -->

                        <div class="form-group">

                            <p class="p-card">Telefone</p>

                            <div class="input-box">

                                <i class="fas fa-phone"></i>

                                <input type="text" id="telefone" name="TELEFONE" placeholder="(00) 00000-0000"
                                    maxlength="15" oninput="maskTel(this)"     value="<?= old('TELEFONE') ?>">

                            </div>

                            <div class="error-text"></div>

                        </div>

                        <!-- RFID -->

                        <div class="form-group">

                            <p class="p-card">UID RFID</p>

                            <div class="input-box">

                                <i class="fas fa-wave-square"></i>

                                <input type="text" id="uid_rfid" name="UID_RFID" placeholder="UID RFID"     value="<?= old('UID_RFID') ?>">

                            </div>

                            <div class="error-text"></div>

                        </div>
                        <!-- Setor -->

                        <div class="form-group">

                            <p class="p-card">Setor</p>

                            <div class="input-box select">

                                <i class="fas fa-building"></i>

                                <select id="id_setor" name="FK_ID_SETOR"     value="<?= old('FK_ID_SETOR') ?>">

                                    <option value="">Selecione o setor</option>

                                    <?php foreach ($setores as $s): ?>

                                      <option value="<?= $s['ID'] ?>"
<?= old('FK_ID_SETOR') == $s['ID'] ? 'selected' : '' ?>>
<?= $s['NOME'] ?>
</option>
                                    <?php endforeach; ?>

                                </select>

                            </div>

                            <div class="error-text"></div>

                        </div>

                        <!-- Senha -->

                        <div class="form-group">

                            <p class="p-card">Senha</p>

                            <div class="input-box">

                                <i class="fas fa-lock"></i>

                                <input type="password" id="senha" name="SENHA" placeholder="Senha" >

                            </div>

                            <div class="error-text"></div>

                        </div>

                        <!-- Confirmar -->

                        <div class="form-group">

                            <p class="p-card">Confirmar senha</p>

                            <div class="input-box">

                                <i class="fas fa-lock"></i>

                                <input type="password" id="confirmSenha" placeholder="Confirmar senha">

                            </div>

                            <div class="error-text"></div>

                        </div>

                        <!-- EPIs -->

                        <div class="form-group full-width">

                            <p class="p-card">EPIs obrigatórios</p>

                            <div class="epi-container">

                                <button type="button" class="btn-selecionar-epi" onclick="abrirModalEPI()">

                                    <i class="fas fa-helmet-safety"></i>

                                    Selecionar EPIs

                                </button>

                                <div id="episSelecionados">

                                    Nenhum EPI selecionado

                                </div>

                                <input type="hidden" id="episHidden" name="EPIS">

                            </div>

                        </div>

                    </div>

                    <div class="btn-area">

                        <button type="button" id="btn-cancelar" class="btn-cancelar" style="display:none"
                            onclick="resetarFormulario()">

                            <i class="fas fa-times"></i>

                            Cancelar

                        </button>

                        <button type="submit" id="btn-salvar">

                            <i class="fas fa-user-plus"></i>

                            Cadastrar Funcionário

                        </button>

                    </div>

                </form>
                
                <div class="form-ilustracao">

                    <img src="<?= base_url('assets/images/cartao.png') ?>" alt="Funcionário">

                </div>

            </section>

            <!-- ===========================================
                 LISTA DOS FUNCIONÁRIOS
            ============================================ -->
            <br>
            <section class="list-card">

                <div class="listagem-header">

                    <div>

                        <h2>Funcionários Cadastrados</h2>

                        <p>

                            Gerencie todos os funcionários cadastrados no sistema.

                        </p>

                    </div>

                    <div class="table-tools">

                        <div class="search-box">

                            <i class="fas fa-search"></i>

                            <input type="text" id="pesquisaFuncionario" placeholder="Pesquisar funcionário...">

                        </div>

                        <button class="filter-btn">

                            <i class="fas fa-filter"></i>

                        </button>

                    </div>

                </div>

                <div class="table-wrapper">

                    <table class="table-funcionarios">

                     <thead>
<tr>
    <th>Funcionário</th>
    <th>CPF</th>
    <th>Data Nasc.</th>
    <th>Email</th>
    <th>Telefone</th>
    <th>UID RFID</th>
    <th>Setor</th>
    <th>EPIs</th>
    <th>Ações</th>
</tr>
</thead>
                        <tbody id="listaFuncionarios">

                            <?php if (!empty($funcionarios)): ?>

                                <?php foreach ($funcionarios as $f): ?>

                                    <tr>

                                        <td>

                                            <strong>

                                                <?= esc($f['NOME_COMPLETO']) ?>

                                            </strong>

                                        </td>

                                        <td>

                                            <?= esc($f['CPF']) ?>

                                        </td>

                                        <td>

                                            <i class="fas fa-building" style="color:#0A66C2;margin-right:6px;"></i>

                                            <?= esc($f['FK_ID_SETOR']) ?>

                                        </td>

                                        <td>

                                            <?= esc($f['EMAIL_CORPORATIVO']) ?>

                                        </td>

                                        <td>

                                            <div class="table-actions">

                                                <button class="table-action edit" onclick="preencherFormulario(

                                            `<?= addslashes($f['NOME_COMPLETO']) ?>`,
                                            `<?= $f['CPF'] ?>`,
                                            `<?= $f['EMAIL_CORPORATIVO'] ?>`,
                                            `<?= $f['TELEFONE'] ?? '' ?>`,
                                            `<?= $f['FK_ID_SETOR'] ?>`,
                                            `<?= $f['UID_RFID'] ?? '' ?>`,
                                            `<?= $f['DATA_NASCIMENTO'] ?? '' ?>`

                                        )">

                                                    <i class="fas fa-pen"></i>

                                                </button>

                                                <button class="table-action delete"
                                                    onclick="confirmarExclusao('<?= $f['CPF'] ?>')">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </div>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td colspan="5" class="mensagem-vazia">

                                        <i class="fas fa-users-slash"></i>

                                        <br><br>

                                        Nenhum funcionário cadastrado.

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

                <div class="table-footer">

                    <div class="rows-page">

                        Mostrar

                        <select id="linhasPagina">

                            <option value="5" selected>5</option>

                            <option value="10">10</option>

                            <option value="20">20</option>

                        </select>

                        por página

                    </div>

                    <div id="infoTabela">

                        Mostrando 0 de 0

                    </div>

                    <div class="pagination">

                        <button id="anterior">

                            <i class="fas fa-chevron-left"></i>

                        </button>

                        <span id="paginaAtual">

                            1

                        </span>

                        <button id="proximo">

                            <i class="fas fa-chevron-right"></i>

                        </button>

                    </div>

                </div>

            </section>

        </div>

        </main>

    </div>
    <script>

window.funcionariosData = <?= json_encode($funcionarios ?? [], JSON_UNESCAPED_UNICODE) ?>;

window.setoresData = <?= json_encode($setores ?? [], JSON_UNESCAPED_UNICODE) ?>;

</script>

    <script>
/* ==========================================================
   CADASTRO FUNCIONÁRIOS - JS
   PARTE 1/6
   Dados + Paginação + Pesquisa + Renderização
========================================================== */


/* ==========================================================
   DADOS VINDOS DO PHP
========================================================== */


const funcionarios = window.funcionariosData ?? [];

const setores = window.setoresData ?? [];



/* ==========================================================
   MAPA DE SETORES
========================================================== */


const mapaSetores = {};


setores.forEach(setor => {

    mapaSetores[setor.ID] = setor.NOME;

});



/* ==========================================================
   CONTROLE DA TABELA
========================================================== */


let paginaAtual = 1;

let linhasPorPagina = 5;

let funcionariosFiltrados = [...funcionarios];



/* ==========================================================
   EPIS SELECIONADOS
========================================================== */


let episSelecionados = [];



/* ==========================================================
   INICIALIZAÇÃO
========================================================== */


document.addEventListener("DOMContentLoaded",()=>{


    iniciarEventos();


    renderizarTabela();


});



/* ==========================================================
   EVENTOS
========================================================== */


function iniciarEventos(){


    const pesquisa =
        document.getElementById("pesquisaFuncionario");


    if(pesquisa){


        pesquisa.addEventListener("input",()=>{


            paginaAtual = 1;


            aplicarPesquisa();


        });


    }



    const linhas =
        document.getElementById("linhasPagina");



    if(linhas){


        linhas.addEventListener("change",function(){


            linhasPorPagina =
                Number(this.value);



            paginaAtual = 1;


            renderizarTabela();


        });


    }



    const anterior =
        document.getElementById("anterior");



    if(anterior){


        anterior.addEventListener("click",()=>{


            if(paginaAtual > 1){


                paginaAtual--;


                renderizarTabela();


            }


        });


    }



    const proximo =
        document.getElementById("proximo");



    if(proximo){


        proximo.addEventListener("click",()=>{


            const totalPaginas =
                Math.ceil(
                    funcionariosFiltrados.length /
                    linhasPorPagina
                );



            if(paginaAtual < totalPaginas){


                paginaAtual++;


                renderizarTabela();


            }


        });


    }


}



/* ==========================================================
   PESQUISA
========================================================== */


function aplicarPesquisa(){


    const campo =
        document.getElementById("pesquisaFuncionario");



    if(!campo) return;



    const texto =
        campo.value
        .toLowerCase()
        .trim();




    funcionariosFiltrados =
        funcionarios.filter(fun=>{


            const nome =
                String(fun.NOME_COMPLETO ?? "")
                .toLowerCase();



            const cpf =
                String(fun.CPF ?? "")
                .toLowerCase();



            const email =
                String(fun.EMAIL_CORPORATIVO ?? "")
                .toLowerCase();



            const telefone =
                String(fun.TELEFONE ?? "")
                .toLowerCase();



            const setor =
                String(
                    mapaSetores[fun.FK_ID_SETOR] ?? ""
                )
                .toLowerCase();



            const uid =
                String(fun.UID_RFID ?? "")
                .toLowerCase();



            return (

                nome.includes(texto)

                ||

                cpf.includes(texto)

                ||

                email.includes(texto)

                ||

                telefone.includes(texto)

                ||

                setor.includes(texto)

                ||

                uid.includes(texto)

            );


        });



    renderizarTabela();


}



/* ==========================================================
   RENDERIZAR TABELA
========================================================== */


function renderizarTabela(){



    const tabela =
        document.getElementById("listaFuncionarios");



    if(!tabela) return;



    tabela.innerHTML = "";




    if(funcionariosFiltrados.length === 0){



        tabela.innerHTML = `

            <tr>

                <td colspan="5" class="mensagem-vazia">


                    <i class="fas fa-users-slash"></i>


                    <br><br>


                    Nenhum funcionário encontrado.


                </td>

            </tr>

        `;



        atualizarRodape(0,0,0);



        return;


    }




    const inicio =

        (paginaAtual - 1) *
        linhasPorPagina;




    const fim =

        inicio +
        linhasPorPagina;




    const paginaAtualFuncionarios =

        funcionariosFiltrados.slice(
            inicio,
            fim
        );




   paginaAtualFuncionarios.forEach(fun => {

    let epis = "-";

    if (fun.EPIS) {
        try {
            const lista = JSON.parse(fun.EPIS);
            epis = lista.map(e => e.nome || e.NOME_EPI).join(", ");
        } catch (e) {
            epis = fun.EPIS;
        }
    }

    tabela.innerHTML += `
    <tr>

        <td>
            <div class="func-avatar">
                <div class="func-avatar-icon">
                    <i class="fas fa-user"></i>
                </div>
                <strong>${escapeHTML(fun.NOME_COMPLETO)}</strong>
            </div>
        </td>

        <td>${escapeHTML(fun.CPF)}</td>

        <td>${fun.DATA_NASCIMENTO || "-"}</td>

        <td>${escapeHTML(fun.EMAIL_CORPORATIVO)}</td>

        <td>${fun.TELEFONE || "-"}</td>

        <td>${fun.UID_RFID || "-"}</td>

        <td>${mapaSetores[fun.FK_ID_SETOR] ?? "-"}</td>

        <td>${epis}</td>

        <td>

            <div class="table-actions">

                <button
                    class="table-action edit"
                    onclick="editarFuncionario('${fun.CPF}')">
                    <i class="fas fa-pen"></i>
                </button>

                <button
                    class="table-action delete"
                    onclick="excluirFuncionario('${fun.CPF}')">
                    <i class="fas fa-trash"></i>
                </button>

            </div>

        </td>

    </tr>
    `;
});



    atualizarRodape(

        inicio + 1,

        Math.min(
            fim,
            funcionariosFiltrados.length
        ),

        funcionariosFiltrados.length

    );


}



/* ==========================================================
   RODAPÉ PAGINAÇÃO
========================================================== */


function atualizarRodape(inicio,fim,total){



    const info =
        document.getElementById("infoTabela");



    const pagina =
        document.getElementById("paginaAtual");



    const anterior =
        document.getElementById("anterior");



    const proximo =
        document.getElementById("proximo");



    if(info){


        info.innerHTML =
        `Mostrando ${inicio} a ${fim} de ${total}`;


    }



    if(pagina){


        pagina.innerHTML =
            paginaAtual;


    }



    const totalPaginas =
        Math.max(
            1,
            Math.ceil(
                total / linhasPorPagina
            )
        );



    if(anterior){


        anterior.disabled =
            paginaAtual === 1;


    }



    if(proximo){


        proximo.disabled =
            paginaAtual >= totalPaginas;


    }


}



/* ==========================================================
   PROTEÇÃO CONTRA HTML
========================================================== */


function escapeHTML(valor){


    return String(valor ?? "")

    .replaceAll("&","&amp;")

    .replaceAll("<","&lt;")

    .replaceAll(">","&gt;")

    .replaceAll('"',"&quot;")

    .replaceAll("'","&#039;");


}

/* ==========================================================
   CADASTRO FUNCIONÁRIOS - JS
   PARTE 2/6
   Máscaras + Validações + Formulário
========================================================== */


/* ==========================================================
   MÁSCARA CPF
========================================================== */


function maskCPF(input){


    let valor =
        input.value
        .replace(/\D/g,"")
        .substring(0,11);



    valor =
        valor.replace(
            /(\d{3})(\d)/,
            "$1.$2"
        );



    valor =
        valor.replace(
            /(\d{3})(\d)/,
            "$1.$2"
        );



    valor =
        valor.replace(
            /(\d{3})(\d{1,2})$/,
            "$1-$2"
        );



    input.value = valor;


}



/* ==========================================================
   MÁSCARA TELEFONE
========================================================== */


function maskTel(input){


    let valor =
        input.value
        .replace(/\D/g,"")
        .substring(0,11);



    if(valor.length <= 10){


        valor =
        valor.replace(
            /(\d{2})(\d)/,
            "($1) $2"
        );



        valor =
        valor.replace(
            /(\d{4})(\d)/,
            "$1-$2"
        );


    }

    else{


        valor =
        valor.replace(
            /(\d{2})(\d)/,
            "($1) $2"
        );



        valor =
        valor.replace(
            /(\d{5})(\d)/,
            "$1-$2"
        );


    }



    input.value = valor;


}



/* ==========================================================
   VALIDAR NOME
========================================================== */


function validarNome(input){


    const valor =
        input.value.trim();



    const erro =
        input
        .closest(".form-group")
        ?.querySelector(".error-text");



    input.classList.remove("invalid");



    if(valor === ""){


        mostrarErro(
            input,
            erro,
            "Informe o nome completo."
        );


        return false;


    }



    if(valor.length < 3){


        mostrarErro(
            input,
            erro,
            "Nome muito curto."
        );


        return false;


    }



    limparErro(
        input,
        erro
    );



    return true;


}



/* ==========================================================
   VALIDAR CPF
========================================================== */


function validarCPF(cpf){



    cpf =
        cpf
        .replace(/\D/g,"");



    if(cpf.length !== 11)
        return false;



    if(
        cpf === "00000000000" ||
        cpf === "11111111111" ||
        cpf === "22222222222" ||
        cpf === "33333333333" ||
        cpf === "44444444444" ||
        cpf === "55555555555" ||
        cpf === "66666666666" ||
        cpf === "77777777777" ||
        cpf === "88888888888" ||
        cpf === "99999999999"
    )
        return false;



    let soma = 0;

    let resto;



    for(let i=1;i<=9;i++){


        soma +=
        parseInt(cpf.substring(i-1,i))
        *
        (11-i);


    }



    resto =
        (soma * 10) % 11;



    if(resto === 10 || resto === 11)
        resto = 0;



    if(resto !== Number(cpf.substring(9,10)))
        return false;



    soma = 0;



    for(let i=1;i<=10;i++){


        soma +=
        parseInt(cpf.substring(i-1,i))
        *
        (12-i);


    }



    resto =
        (soma * 10) % 11;



    if(resto === 10 || resto === 11)
        resto = 0;



    return resto === Number(cpf.substring(10,11));


}



/* ==========================================================
   VALIDAR EMAIL
========================================================== */


function validarEmail(email){


    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    .test(email);


}



/* ==========================================================
   VALIDAR DATA
========================================================== */


function validarData(data){



    if(!data)
        return false;



    const nascimento =
        new Date(data);



    const hoje =
        new Date();



    return nascimento < hoje;


}



/* ==========================================================
   VALIDAR SENHA
========================================================== */

function validarSenha(){

    const senha = document.getElementById("senha");
    const confirmar = document.getElementById("confirmSenha");


    const grupoSenha = senha.closest(".form-group");
    const erroSenha = grupoSenha.querySelector(".error-text");


    const grupoConfirm = confirmar.closest(".form-group");
    const erroConfirm = grupoConfirm.querySelector(".error-text");



    // limpa erros
    senha.closest(".input-box").classList.remove("error");
    confirmar.closest(".input-box").classList.remove("error");

    erroSenha.innerHTML="";
    erroConfirm.innerHTML="";



    if(senha.value.length < 8){

        senha.closest(".input-box").classList.add("error");

        erroSenha.innerHTML =
        "A senha deve possuir no mínimo 8 caracteres.";

        return false;
    }



    if(senha.value !== confirmar.value){

        confirmar.closest(".input-box").classList.add("error");

        erroConfirm.innerHTML =
        "As senhas não coincidem.";

        return false;
    }



    return true;

}


/* ==========================================================
   MOSTRAR ERRO
========================================================== */

function mostrarErroCampo(input,mensagem){


    const grupo =
        input.closest(".form-group");



    if(!grupo)
        return;



    input.closest(".input-box")
    ?.classList.add("error");



    const erro =
        grupo.querySelector(".error-text");



    if(erro){


        erro.innerHTML =
        mensagem;


    }


}



function limparTodosErros(){


    document
    .querySelectorAll(".input-box.error")
    .forEach(campo=>{


        campo.classList.remove(
            "error"
        );


    });



    document
    .querySelectorAll(".error-text")
    .forEach(msg=>{


        msg.innerHTML="";


    });



}


/* ==========================================================
   LIMPAR ERRO
========================================================== */


function limparErro(input,erro){


    input.classList.remove("invalid");



    if(erro)
        erro.innerHTML = "";


}



/* ==========================================================
   PREPARAR ENVIO FORMULÁRIO
========================================================== */
async function prepararEEnviar(form){


    let formularioValido = true;


    limparTodosErros();



    const camposObrigatorios = [


        "nome",

        "cpf",

        "nascimento",

        "email",

        "telefone",

        "uid_rfid",

        "id_setor",

        "senha",

        "confirmSenha"


    ];



    camposObrigatorios.forEach(id=>{


        const campo =
            document.getElementById(id);



        if(campo && campo.value.trim() === ""){


            mostrarErroCampo(
                campo,
                "Campo obrigatório"
            );


            formularioValido = false;


        }

        const campoCPF = document.getElementById("cpf");

const cpfLimpo = campoCPF.value.replace(/\D/g,'');


if(!validarCPF(cpfLimpo)){

    mostrarErroCampo(
        campoCPF,
        "CPF inválido."
    );

    formularioValido = false;

}



    });


async function verificarCPFExistente(cpf){

    const dados = new FormData();

    dados.append(
        "CPF",
        cpf
    );


    const resposta = await fetch(
        "<?= base_url('/Cadastro_Fun/verificarCPF') ?>",
        {
            method:"POST",
            body:dados
        }
    );


    const resultado = await resposta.json();


    return resultado.existe;

}


    // Verifica EPIs obrigatórios

    if(episSelecionados.length === 0){



        const epiBox =
            document.querySelector(
                ".epi-container"
            );



        if(epiBox){


            epiBox.classList.add(
                "error"
            );


        }



        const epiMensagem =
            document.getElementById(
                "episSelecionados"
            );



        if(epiMensagem){


            epiMensagem.innerHTML = `

                <span style="color:#dc2626">

                    Campo obrigatório

                </span>

            `;


        }



        formularioValido = false;



    }

  if(!validarSenha()){
    formularioValido = false;
}


if(!validarNascimento()){
    formularioValido = false;
}




    if(!formularioValido){



        Swal.fire({


            icon:"warning",


            title:"Campos obrigatórios",


            text:"Preencha todos os campos obrigatórios.",


            confirmButtonColor:"#0A66C2"



        });



        return false;


    }






    // CPF envia somente números

    document
    .getElementById("cpf_original")
    .value =
    document
    .getElementById("cpf")
    .value
    .replace(/\D/g,"");





    // salva EPIs

    document
    .getElementById("episHidden")
    .value =
    JSON.stringify(
        episSelecionados
    );

const cpfAtual =
document.getElementById("cpf")
.value
.replace(/\D/g,'');


const cpfExiste =
await verificarCPFExistente(cpfAtual);



if(cpfExiste){


    mostrarErroCampo(
        document.getElementById("cpf"),
        "CPF já cadastrado."
    );


    Swal.fire({

        icon:"warning",
        title:"CPF já cadastrado",
        text:"Já existe um funcionário com esse CPF."

    });


    return false;

}


    return true;


}
/* ==========================================================
   CADASTRO FUNCIONÁRIOS - JS
   PARTE 3/6
   MODAL DE EPIs
========================================================== */
function validarNascimento(){

    const campo =
    document.getElementById("nascimento");


    const erro =
    campo.closest(".form-group")
    .querySelector(".error-text");



    campo.closest(".input-box")
    .classList.remove("error");


    erro.innerHTML="";



    if(!campo.value){

        erro.innerHTML =
        "Informe a data de nascimento.";

        campo.closest(".input-box")
        .classList.add("error");

        return false;
    }



    const nascimento =
    new Date(campo.value);



    const hoje =
    new Date();



    // impede data futura

    if(nascimento > hoje){

        erro.innerHTML =
        "A data de nascimento não pode ser futura.";

        campo.closest(".input-box")
        .classList.add("error");

        return false;

    }




    // calcula idade

    let idade =
    hoje.getFullYear()
    -
    nascimento.getFullYear();



    const mes =
    hoje.getMonth()
    -
    nascimento.getMonth();



    if(
        mes < 0 ||
        (
            mes === 0 &&
            hoje.getDate() < nascimento.getDate()
        )
    ){

        idade--;

    }



    if(idade < 18){


        erro.innerHTML =
        "O funcionário deve possuir no mínimo 18 anos.";


        campo.closest(".input-box")
        .classList.add("error");


        return false;

    }



    return true;

}

/* ==========================================================
   ABRIR MODAL
========================================================== */

function abrirModalEPI(){

    const modal =
        document.getElementById("modalEPI");


    if(!modal)
        return;


    modal.classList.add("active");


    restaurarSelecionadosEPI();

}

/* ==========================================================
   FECHAR MODAL
========================================================== */


function fecharModalEPI(){


    const modal =
        document.getElementById("modalEPI");



    if(!modal)
        return;



    modal.classList.remove("active");



}



/* ==========================================================
   SELECIONAR / DESSELECIONAR EPI
========================================================== */


function toggleEPI(element,id,nome){



    const existe =
        episSelecionados.find(
            epi => epi.id == id
        );



    if(existe){


        episSelecionados =
            episSelecionados.filter(
                epi => epi.id != id
            );



        element.classList.remove(
            "selected"
        );



    }

    else{


        episSelecionados.push({

            id:id,

            nome:nome

        });



        element.classList.add(
            "selected"
        );


    }



}



/* ==========================================================
   SALVAR EPIs SELECIONADOS
========================================================== */


function salvarEPIs(){



    const area =
        document.getElementById(
            "episSelecionados"
        );



    if(!area)
        return;



    area.innerHTML = "";




    if(episSelecionados.length === 0){



        area.innerHTML = `

            <span style="color:#94a3b8">

                Nenhum EPI selecionado

            </span>

        `;



        document
        .getElementById("episHidden")
        .value = "";



        fecharModalEPI();


        return;


    }





    episSelecionados.forEach(epi=>{


        area.innerHTML += `


            <span class="epi-tag">


                <i class="fas fa-helmet-safety"></i>


                ${escapeHTML(epi.nome)}


            </span>


        `;



    });




    document
    .getElementById("episHidden")
    .value =
        JSON.stringify(episSelecionados);




    fecharModalEPI();



}



/* ==========================================================
   LIMPAR SELEÇÃO VISUAL DO MODAL
========================================================== */


function limparSelecionadosEPI(){



    document
    .querySelectorAll(".epi-opcao")
    .forEach(item=>{


        item.classList.remove(
            "selected"
        );


    });



}



/* ==========================================================
   RESTAURAR EPIs AO ABRIR MODAL
========================================================== */


function restaurarSelecionadosEPI(){



    document
    .querySelectorAll(".epi-opcao")
    .forEach(item=>{


        const onclick =
            item.getAttribute(
                "onclick"
            );



        if(!onclick)
            return;



        episSelecionados.forEach(epi=>{


            if(
                onclick.includes(
                    `, ${epi.id},`
                )
            ){


                item.classList.add(
                    "selected"
                );


            }


        });



    });



}



/* ==========================================================
   FECHAR CLICANDO FORA
========================================================== */


document.addEventListener(
"click",
function(event){



    const modal =
        document.getElementById(
            "modalEPI"
        );



    if(!modal)
        return;




    if(
        event.target === modal
    ){


        fecharModalEPI();


    }



});

/* ==========================================================
   CADASTRO FUNCIONÁRIOS - JS
   PARTE 4/6
   EDITAR FUNCIONÁRIO
========================================================== */



function editarFuncionario(cpf){



    const fun =
        funcionarios.find(
            f => String(f.CPF) === String(cpf)
        );



    if(!fun){


        Swal.fire({

            icon:"error",

            title:"Erro",

            text:"Funcionário não encontrado."

        });


        return;


    }
    episSelecionados = fun.EPIS ?? [];






    Swal.fire({


        title:"Editar Funcionário",


        width:700,


        html:`


        <div class="swal-form">


            <input

            id="swalNome"

            class="swal2-input"

            placeholder="Nome completo"

            value="${escapeHTML(fun.NOME_COMPLETO)}">



            <input

            id="swalCpf"

            class="swal2-input"

            value="${escapeHTML(fun.CPF)}"

            readonly>



            <input

            id="swalNascimento"

            class="swal2-input"

            type="date"

            value="${fun.DATA_NASCIMENTO ?? ""}">



            <input

            id="swalEmail"

            class="swal2-input"

            type="email"

            placeholder="E-mail"

            value="${escapeHTML(fun.EMAIL_CORPORATIVO)}">



            <input

            id="swalTelefone"

            class="swal2-input"

            placeholder="Telefone"

            value="${escapeHTML(fun.TELEFONE ?? "")}"

            maxlength="15">



            <input

            id="swalRFID"

            class="swal2-input"

            placeholder="UID RFID"

            value="${escapeHTML(fun.UID_RFID ?? "")}">



            <select

            id="swalSetor"

            class="swal2-select">


                <option value="">

                    Selecione o setor

                </option>



                ${

                setores.map(setor=>`


                    <option

                    value="${setor.ID}">


                        ${escapeHTML(setor.NOME)}


                    </option>


                `).join("")


                }


            </select>

            <div class="epi-edicao">

    <p>EPIs obrigatórios</p>

    <div id="swalEpis">

    </div>

</div>


        </div>


        `,



        didOpen:()=>{

        function carregarEpisEdicao(epis){

    const area =
        document.getElementById("swalEpis");


    area.innerHTML="";


    epis.forEach(epi=>{


        area.innerHTML += `

        <label>

            <input 
            type="checkbox"
            value="${epi.id}"
            checked>

            ${epi.nome}

        </label>

        `;


    });

}


            const setor =
                document.getElementById(
                    "swalSetor"
                );



            if(setor){


                setor.value =
                    fun.FK_ID_SETOR;


            }




            const telefone =
                document.getElementById(
                    "swalTelefone"
                );



            if(telefone){


                telefone.addEventListener(
                    "input",
                    ()=>{
                        maskTel(telefone);
                    }
                );


            }


        },



        showCancelButton:true,


        confirmButtonText:"Salvar",


        cancelButtonText:"Cancelar",


        confirmButtonColor:"#0A66C2",


        cancelButtonColor:"#94a3b8",




        preConfirm:()=>{



            const nome =
                document
                .getElementById("swalNome")
                .value
                .trim();




            const nascimento =
                document
                .getElementById("swalNascimento")
                .value;




            const email =
                document
                .getElementById("swalEmail")
                .value
                .trim();




            const telefone =
                document
                .getElementById("swalTelefone")
                .value
                .trim();




            const uid =
                document
                .getElementById("swalRFID")
                .value
                .trim();




            const setor =
                document
                .getElementById("swalSetor")
                .value;





            if(nome.length < 3){


                Swal.showValidationMessage(
                    "Informe um nome válido."
                );


                return false;


            }





            if(!validarEmail(email)){


                Swal.showValidationMessage(
                    "Informe um e-mail válido."
                );


                return false;


            }





            if(!validarData(nascimento)){


                Swal.showValidationMessage(
                    "Informe uma data válida."
                );


                return false;


            }





            if(setor === ""){


                Swal.showValidationMessage(
                    "Selecione um setor."
                );


                return false;


            }




            return{


                nome,


                nascimento,


                email,


                telefone,


                uid,


                setor


            };


        }



    })



    .then(resultado=>{



        if(!resultado.isConfirmed)
            return;




        enviarEdicaoFuncionario(

            fun.CPF,

            resultado.value

        );



    });



}





/* ==========================================================
   ENVIA EDIÇÃO PARA CONTROLLER
========================================================== */


function enviarEdicaoFuncionario(cpf,dados){



    const form =
        document.createElement(
            "form"
        );



    form.method="POST";



    form.action =

    `<?= base_url('/Cadastro_Fun/editar/') ?>/${cpf}`;



const campos = {

    CPF_ORIGINAL:
    cpf,


    NOME_COMPLETO:
    dados.nome,


    EMAIL_CORPORATIVO:
    dados.email,


    TELEFONE:
    dados.telefone,


    DATA_NASCIMENTO:
    dados.nascimento,


    UID_RFID:
    dados.uid,


    FK_ID_SETOR:
    dados.setor,


    EPIS:
    JSON.stringify(episSelecionados)

};



    Object.keys(campos)
    .forEach(nome=>{


        const input =
            document.createElement(
                "input"
            );



        input.type="hidden";


        input.name=nome;


        input.value=campos[nome];



        form.appendChild(input);



    });





    document.body.appendChild(form);



    form.submit();



}
/* ==========================================================
   CADASTRO FUNCIONÁRIOS - JS
   PARTE 5/6
   Exclusão + Reset + Limpeza
========================================================== */



/* ==========================================================
   EXCLUIR FUNCIONÁRIO
========================================================== */


function excluirFuncionario(cpf){



    Swal.fire({


        title:"Excluir funcionário?",


        text:"Essa ação não poderá ser desfeita.",


        icon:"warning",


        showCancelButton:true,


        confirmButtonText:"Excluir",


        cancelButtonText:"Cancelar",


        confirmButtonColor:"#dc2626",


        cancelButtonColor:"#0A66C2"



    })



    .then(resultado=>{



        if(resultado.isConfirmed){



            window.location.href =

            `<?= base_url('/Cadastro_Fun/excluir/') ?>/${cpf}`;



        }



    });



}





/* ==========================================================
   RESETAR FORMULÁRIO
========================================================== */


function resetarFormulario(){



    const form =
        document.getElementById(
            "form-fun"
        );



    if(!form)
        return;




    Swal.fire({


        title:"Limpar formulário?",


        text:"Todos os dados preenchidos serão apagados.",


        icon:"question",


        showCancelButton:true,


        confirmButtonText:"Limpar",


        cancelButtonText:"Cancelar",


        confirmButtonColor:"#0A66C2"



    })



    .then(resultado=>{



        if(!resultado.isConfirmed)
            return;




        form.reset();




        limparEPIs();




        document
        .querySelectorAll(".error-text")
        .forEach(erro=>{


            erro.innerHTML="";


        });




        document
        .querySelectorAll(".input-box")
        .forEach(box=>{


            box.classList.remove(
                "error"
            );


        });




        document
        .getElementById("btn-cancelar")
        ?.style
        .setProperty(
            "display",
            "none"
        );




        Swal.fire({


            icon:"success",


            title:"Limpo!",


            text:"Formulário resetado.",


            timer:1500,


            showConfirmButton:false



        });



    });



}







/* ==========================================================
   LIMPAR EPIs
========================================================== */


function limparEPIs(){



    episSelecionados = [];



    const campo =
        document.getElementById(
            "episHidden"
        );



    if(campo)
        campo.value="";




    const area =
        document.getElementById(
            "episSelecionados"
        );



    if(area){


        area.innerHTML = `

        <span style="color:#94a3b8">

            Nenhum EPI selecionado

        </span>

        `;


    }




    limparSelecionadosEPI();



}







/* ==========================================================
   MOSTRAR BOTÃO CANCELAR AO EDITAR
========================================================== */


function ativarModoEdicao(){



    const btn =
        document.getElementById(
            "btn-cancelar"
        );



    if(btn){


        btn.style.display="flex";


    }



}





/* ==========================================================
   LIMPAR CLASSE DE ERRO DOS INPUTS
========================================================== */


document.addEventListener(
"input",
(event)=>{



    const input =
        event.target;



    if(
        input.tagName === "INPUT" ||
        input.tagName === "SELECT"
    ){


        const grupo =
            input.closest(
                ".form-group"
            );



        if(grupo){



            const erro =
                grupo.querySelector(
                    ".error-text"
                );



            input.classList.remove(
                "invalid"
            );



            if(erro)
                erro.innerHTML="";



        }


    }



});







/* ==========================================================
   FECHAR MODAL COM ESC
========================================================== */


document.addEventListener(
"keydown",
(event)=>{



    if(event.key === "Escape"){


        fecharModalEPI();


    }



});







/* ==========================================================
   ALERTA DE SUCESSO VIA URL
========================================================== */


document.addEventListener(
"DOMContentLoaded",
()=>{



    const url =
        new URLSearchParams(
            window.location.search
        );



    const sucesso =
        url.get("sucesso");



    const erro =
        url.get("erro");




    if(sucesso){



        Swal.fire({


            icon:"success",


            title:"Sucesso!",


            text:sucesso,


            timer:2000,


            showConfirmButton:false



        });



    }




    if(erro){



        Swal.fire({


            icon:"error",


            title:"Erro",


            text:erro



        });



    }



});

/* ==========================================================
   PARTE 6/6
   AJUSTES FINAIS
========================================================== */


/* ==========================================================
   VERIFICAR ELEMENTOS IMPORTANTES
========================================================== */


function verificarElementos(){


    const elementos = [

        "form-fun",

        "nome",

        "cpf",

        "email",

        "senha",

        "confirmSenha",

        "episHidden",

        "listaFuncionarios"

    ];



    elementos.forEach(id=>{


        if(!document.getElementById(id)){


            console.warn(
                `Elemento não encontrado: ${id}`
            );


        }


    });


}



document.addEventListener(
"DOMContentLoaded",
()=>{


    verificarElementos();


});




/* ==========================================================
   MÁSCARA CPF AO CARREGAR
========================================================== */


document.addEventListener(
"DOMContentLoaded",
()=>{


    const cpf =
        document.getElementById("cpf");



    if(cpf && cpf.value){


        maskCPF(cpf);


    }



});





/* ==========================================================
   BLOQUEAR ENVIO DUPLO
========================================================== */


document.addEventListener(
"DOMContentLoaded",
()=>{


    const form =
        document.getElementById(
            "form-fun"
        );



    if(!form)
        return;




    form.addEventListener(
    "submit",
    ()=>{



        const botao =
            document.getElementById(
                "btn-salvar"
            );






    });



});






/* ==========================================================
   CARREGAR EPIs EXISTENTES AO EDITAR
========================================================== */


function carregarEPIsExistentes(lista){



    if(!Array.isArray(lista))
        return;




    episSelecionados =
        lista.map(epi=>({


            id:
            epi.id ??
            epi.ID,



            nome:
            epi.nome ??
            epi.NOME_EPI



        }));




    salvarEPIs();



}





/* ==========================================================
   TRATAMENTO DE ERROS GERAIS
========================================================== */


window.addEventListener(
"error",
(event)=>{


    console.error(
        "Erro JS:",
        event.message
    );


});






/* ==========================================================
   IMPEDIR CARACTERES ESPECIAIS NO NOME
========================================================== */


document.addEventListener(
"DOMContentLoaded",
()=>{


    const nome =
        document.getElementById(
            "nome"
        );



    if(nome){


        nome.addEventListener(
        "input",
        ()=>{


            nome.value =
            nome.value.replace(
                /[^A-Za-zÀ-ÿ\s]/g,
                ""
            );


        });


    }



});

document.addEventListener("input",function(e){


    const campo = e.target;


    if(
        campo.tagName === "INPUT" ||
        campo.tagName === "SELECT"
    ){


        const box =
            campo.closest(".input-box");


        const grupo =
            campo.closest(".form-group");



        if(box && campo.value.trim() !== ""){


            box.classList.remove(
                "error"
            );


        }



        if(grupo){


            const erro =
                grupo.querySelector(
                    ".error-text"
                );


            if(erro){

                erro.innerHTML="";

            }


        }


    }



});
</script>
    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>

    <div class="modal-epi" id="modalEPI">

        <div class="modal-card">

            <h2>Selecionar EPIs Obrigatórios</h2>

            <div class="epi-layout">

                <?php if (!empty($epis)): ?>

                    <?php foreach ($epis as $epi): ?>

                        <div class="epi-opcao" onclick="toggleEPI(

                        this,

                        <?= $epi['ID'] ?>,

                        '<?= esc($epi['NOME_EPI']) ?>'

                    )">

                            <i class="fas fa-helmet-safety"></i>

                            <span>

                                <?= esc($epi['NOME_EPI']) ?>

                            </span>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <p>Nenhum EPI cadastrado.</p>

                <?php endif; ?>

                <div class="trabalhador-centro">

                    <img src="<?= base_url('assets/images/trabalhador.png') ?>">

                </div>

            </div>

            <div class="modal-botoes">

                <button class="btn-salvar-epi" onclick="salvarEPIs()">

                    Salvar

                </button>

                <button class="btn-cancelar-epi" onclick="fecharModalEPI()">

                    Cancelar

                </button>

            </div>

        </div>

    </div>

</body>

</html>