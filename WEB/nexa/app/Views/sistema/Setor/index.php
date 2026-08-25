<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Setor</title>


    <link rel="stylesheet" href="<?= base_url('assets/css/acessibilidade_adm.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/style_geral.css') ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/cadastro_setor.css') ?>">


</head>


<body>


    <div vw class="enabled">

        <div vw-access-button class="active"></div>

        <div vw-plugin-wrapper>

            <div class="vw-plugin-top-wrapper"></div>

        </div>

    </div>



    <!-- ======================================================
     SIDEBAR
====================================================== -->


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

            <a href="<?= base_url('/cadastro-funcionario') ?>">
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

            <a href="<?= base_url('/setor') ?>" class="active">
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




    <!-- ======================================================
     MENU ACESSIBILIDADE
====================================================== -->






    <!-- ======================================================
     ÁREA PRINCIPAL
====================================================== -->


    <div class="overlay">


        <main class="main-content">





            <!-- ======================================================
     HEADER
====================================================== -->


            <header class="dashboard-header">


                <div class="header-left">


                    <div class="header-title">


                        <h1>
                            Cadastro de Setores
                        </h1>


                        <p>
                            Gerencie os setores da sua empresa
                        </p>


                    </div>


                </div>





                <div class="header-right">
                    
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



            <button class="access-btn" onclick="mudarFonte('aumentar')">

                A+

            </button>



            <button class="access-btn" onclick="mudarFonte('diminuir')">

                A-

            </button>



            <button class="access-btn" onclick="Acessibilidade.lerPagina()">

                <i class="fas fa-volume-up"></i>

            </button>


        </div>


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





            <!-- ======================================================
     CARD CADASTRO
====================================================== -->


            <section class="cadastro-box">



                <div class="cadastro-topo">



                    <div class="cadastro-info">



                        <div class="camera-icon-bg">


                            <i class="fas fa-building"></i>


                        </div>



                        <div>


                            <h2>
                                Cadastrar Novo Setor
                            </h2>



                            <p>
                                Preencha as informações para adicionar um novo setor ao sistema.
                            </p>



                        </div>


                    </div>








                </div>




                <div class="subtitle">

                    Informações

                </div>



                <form method="post" action="<?= base_url('setor/inserir') ?>" onsubmit="return validarSetor()">




                    <div class="form-grid">


                        <div class="form-group">


                            <p class="p-card">
                                Nome do setor
                            </p>


                            <div class="input-box">

                                <i class="fas fa-building"></i>

                                <input type="text" name="nome_setor" id="nome_setor" placeholder="Ex.: Produção">

                            </div>


                            <div class="error-text"></div>



                            <p class="p-card">
                                Localização
                            </p>


                            <div class="input-box">

                                <i class="fas fa-map-marker-alt"></i>

                                <input type="text" name="localizacao" id="localizacao" placeholder="Ex.: Bloco A">

                            </div>


                            <div class="error-text"></div>



                        </div>




                        <div class="camera-ilustracao">


                            <img src="<?= base_url('assets/images/setor.png') ?>">


                        </div>


                    </div>


                    <div class="btn-area">

                        <button type="submit">

                            <i class="fas fa-plus"></i>

                            Cadastrar

                        </button>

                    </div>



                </form>



            </section>








            <!-- ======================================================
     CARD LISTAGEM
====================================================== -->


            <section class="listagem-box">



                <div class="listagem-header">



                    <div>


                        <h2>

                            Setores Cadastrados

                        </h2>



                        <p>

                            Gerencie todos os setores cadastrados no sistema.

                        </p>



                    </div>





                    <div class="table-tools">



                        <div class="search-box">


                            <i class="fas fa-search"></i>



                            <input type="text" id="pesquisaSetor" placeholder="Pesquisar setor...">



                        </div>




                        <button class="filter-btn">


                            <i class="fas fa-filter"></i>


                        </button>



                    </div>



                </div>






                <div class="table-wrapper">



                    <table class="table-cameras">



                        <colgroup>


                            <col style="width:40%">


                            <col style="width:40%">


                            <col style="width:20%">





                        </colgroup>




                        <thead>


                            <tr>


                                <th>

                                    Setor

                                </th>



                                <th>

                                    Localização

                                </th>






                                <th>

                                    Ações

                                </th>



                            </tr>



                        </thead>






                        <tbody id="lista">



                            <?php foreach ($setores as $s): ?>



                                <tr>


                                    <td>



                                        <div class="table-info">



                                            <div class="table-icon">


                                                <i class="fas fa-building"></i>


                                            </div>




                                            <div>


                                                <strong>

                                                    <?= $s['NOME'] ?>

                                                </strong>


                                            </div>



                                        </div>



                                    </td>







                                    <td>


                                        <i class="fas fa-map-marker-alt" style="color:#0A66C2;margin-right:6px;"></i>


                                        <?= $s['LOCAL'] ?>


                                    </td>








                                    <td>



                                        <div class="table-actions">





                                            <button class="table-action edit" type="button" onclick='editar(
<?= json_encode($s["ID"]) ?>,
<?= json_encode($s["NOME"]) ?>,
<?= json_encode($s["LOCAL"]) ?>,
<?= json_encode($s["FK_CNPJ_EMPRESA"]) ?>
)'>


                                                <i class="fas fa-pen"></i>


                                            </button>



                                            <a class="table-action delete" onclick="confirmarExclusao('<?= $s['ID'] ?>')">

                                                <i class="fas fa-trash"></i>

                                            </a>



                                        </div>



                                    </td>




                                </tr>



                            <?php endforeach; ?>




                        </tbody>




                    </table>



                </div>








                <!-- ======================================================
     RODAPÉ TABELA
====================================================== -->


                <div class="table-footer">





                    <div class="rows-page">


                        Mostrar



                        <select id="linhasPagina">



                            <option value="5" selected>

                                5

                            </option>



                            <option value="10">

                                10

                            </option>



                            <option value="20">

                                20

                            </option>



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





        </main>


    </div>


    <!-- ======================================================
     MODAL (mantido caso precise)
====================================================== -->


    <div class="modal-bg" id="modalBg" style="display:none;">

        <div class="modal">

            <h2>
                Editar Setor
            </h2>


            <div class="form-group">

                <div class="input-box">

                    <i class="fas fa-building"></i>

                    <input type="text" id="editNome" placeholder="Nome">

                </div>

            </div>




            <div class="form-group">

                <div class="input-box">

                    <i class="fas fa-map-marker-alt"></i>

                    <input type="text" id="editLocal" placeholder="Localização">

                </div>

            </div>




            <div class="modal-buttons">


                <button onclick="fecharModal()">

                    Cancelar

                </button>



                <button class="save-btn" onclick="salvarEdicao()">

                    Salvar

                </button>



            </div>


        </div>

    </div>





    <script>


        // ======================================================
        // DADOS
        // ======================================================


        let setores = <?= json_encode($setores ?? []) ?>;


        let paginaAtual = 1;


        let linhasPorPagina = 5;


        let setoresFiltrados = [...setores];




        // ======================================================
        // INICIALIZAÇÃO
        // ======================================================


        window.onload = function () {


            iniciarEventos();

            renderizar();


        };




        // ======================================================
        // EVENTOS
        // ======================================================


        function iniciarEventos() {



            const pesquisa =
                document.getElementById("pesquisaSetor");



            if (pesquisa) {


                pesquisa.addEventListener("input", function () {


                    paginaAtual = 1;


                    aplicarPesquisa();



                });


            }




            const select =
                document.getElementById("linhasPagina");



            if (select) {



                select.addEventListener("change", function () {


                    linhasPorPagina =
                        parseInt(this.value);



                    paginaAtual = 1;



                    renderizar();



                });


            }




            document.getElementById("anterior")
                .onclick = function () {



                    if (paginaAtual > 1) {


                        paginaAtual--;


                        renderizar();



                    }


                };





            document.getElementById("proximo")
                .onclick = function () {



                    let totalPaginas =
                        Math.ceil(
                            setoresFiltrados.length /
                            linhasPorPagina
                        );



                    if (paginaAtual < totalPaginas) {


                        paginaAtual++;


                        renderizar();


                    }



                };




        }





        // ======================================================
        // PESQUISA
        // ======================================================


        function aplicarPesquisa() {


            let texto =
                document.getElementById("pesquisaSetor")
                    .value
                    .toLowerCase()
                    .trim();



            setoresFiltrados =
                setores.filter(setor => {


                    return (


                        String(setor.NOME)
                            .toLowerCase()
                            .includes(texto)



                        ||

                        String(setor.LOCAL)
                            .toLowerCase()
                            .includes(texto)



                        ||

                        String(setor.FK_CNPJ_EMPRESA)
                            .toLowerCase()
                            .includes(texto)



                    );



                });



            renderizar();



        }





        // ======================================================
        // RENDERIZAÇÃO
        // ======================================================


        function renderizar() {


            const lista =
                document.getElementById("lista");



            lista.innerHTML = "";





            if (setoresFiltrados.length === 0) {



                lista.innerHTML = `


<tr>


<td colspan="4"
class="mensagem-vazia">


<i class="fas fa-building"></i>


<br><br>


Nenhum setor encontrado.



</td>



</tr>


`;



                atualizarRodape(0, 0, 0);


                return;



            }






            const inicio =
                (paginaAtual - 1)
                *
                linhasPorPagina;



            const fim =
                inicio +
                linhasPorPagina;





            const pagina =
                setoresFiltrados.slice(
                    inicio,
                    fim
                );







            pagina.forEach(setor => {



                lista.innerHTML += `



<tr>


<td>


<div class="table-info">


<div class="table-icon">


<i class="fas fa-building"></i>


</div>



<div>


<strong>

${setor.NOME}

</strong>


</div>



</div>


</td>





<td>


<i class="fas fa-map-marker-alt"
style="color:#0A66C2;margin-right:6px;"></i>


${setor.LOCAL}


</td>


<td>


<div class="table-actions">



<button
class="table-action edit"
onclick='editar(
${JSON.stringify(setor.ID)},
${JSON.stringify(setor.NOME)},
${JSON.stringify(setor.LOCAL)},
)'>


<i class="fas fa-pen"></i>


</button>




<a 
class="table-action delete"
onclick="confirmarExclusao(${setor.ID})">

<i class="fas fa-trash"></i>

</a>



</div>



</td>



</tr>



`;



            });




            atualizarRodape(


                inicio + 1,


                Math.min(
                    fim,
                    setoresFiltrados.length
                ),


                setoresFiltrados.length



            );



        }






        // ======================================================
        // RODAPÉ
        // ======================================================


        function atualizarRodape(inicio, fim, total) {



            document.getElementById("infoTabela")
                .innerHTML =
                `Mostrando ${inicio} a ${fim} de ${total}`;




            document.getElementById("paginaAtual")
                .innerHTML =
                paginaAtual;




            let totalPaginas =
                Math.max(
                    1,
                    Math.ceil(
                        total / linhasPorPagina
                    )
                );





            document.getElementById("anterior")
                .disabled =
                paginaAtual === 1;





            document.getElementById("proximo")
                .disabled =
                paginaAtual >= totalPaginas;



        }






        // ======================================================
        // EDITAR
        // ======================================================


        function editar(id, nome, local) {



            Swal.fire({


                title: "Editar Setor",


                width: 600,



                html: `


<input id="swalNome"
class="swal2-input"
placeholder="Nome"
value="${nome}">



<input id="swalLocal"
class="swal2-input"
placeholder="Localização"
value="${local}">




`,



                showCancelButton: true,


                confirmButtonText: "Salvar",


                cancelButtonText: "Cancelar",




                preConfirm() {



                    return {


                        nome_setor:
                            document.getElementById("swalNome").value,


                        localizacao:
                            document.getElementById("swalLocal").value,






                    };


                }



            }).then(result => {


                if (result.isConfirmed) {



                    let form =
                        document.createElement("form");



                    form.method = "POST";


                    form.action =
                        "<?= base_url('setor/atualizar/') ?>"
                        +
                        id;




                    form.innerHTML = `


<input type="hidden"
name="nome_setor"
value="${result.value.nome_setor}">


<input type="hidden"
name="localizacao"
value="${result.value.localizacao}">





`;



                    document.body.appendChild(form);


                    form.submit();



                }


            });



        }






        // ======================================================
        // ACESSIBILIDADE
        // ======================================================


        function toggleAccessMenu() {


            const menu =
                document.getElementById("accessOptions");


            menu.style.display =
                menu.style.display === "flex"
                    ?
                    "none"
                    :
                    "flex";

        }



        function toggleDark() {


            document.body.classList.toggle("dark-mode");
        }



        /* ==========================================================
VALIDAÇÃO CADASTRO SETOR
========================================================== */


        function validarSetor() {


            let valido = true;


            const nome = document.getElementById("nome_setor");

            const local = document.getElementById("localizacao");



            limparErro(nome);

            limparErro(local);



            if (nome.value.trim() === "") {


                mostrarErro(nome, "Campo obrigatório");

                valido = false;


            }



            if (local.value.trim() === "") {


                mostrarErro(local, "Campo obrigatório");

                valido = false;


            }




            if (!valido) {


                Swal.fire({

                    icon: "warning",

                    title: "Campos obrigatórios",

                    text: "Preencha todos os campos antes de cadastrar.",

                    confirmButtonText: "OK",

                    confirmButtonColor: "#0A66C2"

                });


            }



            return valido;


        }






        function mostrarErro(input, mensagem) {



            const box = input.closest(".input-box");


            box.classList.add("erro");



            const erro = box.nextElementSibling;


            if (erro) {

                erro.innerHTML = mensagem;

            }


        }






        function limparErro(input) {


            const box = input.closest(".input-box");


            if (box) {

                box.classList.remove("erro");

            }



            const erro = box.nextElementSibling;


            if (erro) {

                erro.innerHTML = "";

            }


        }







        document.querySelectorAll(".input-box input")
            .forEach(input => {


                input.addEventListener("input", () => {


                    limparErro(input);


                });


            });

        function mostrarErro(input, mensagem) {


            const grupo = input.closest("form");


            const container = input.closest(".form-side");


            const campo = input.parentElement;


            campo.classList.add("erro");


            const erro = campo.nextElementSibling;


            if (erro) {

                erro.innerHTML = mensagem;

            }


        }





        function limparErro(input) {


            const campo = input.parentElement;


            campo.classList.remove("erro");


            const erro = campo.nextElementSibling;


            if (erro) {

                erro.innerHTML = "";

            }


        }





        document.addEventListener("DOMContentLoaded", () => {


            document
                .querySelectorAll(".input-modern input")
                .forEach(input => {


                    input.addEventListener("input", () => {

                        limparErro(input);

                    });


                });


        });

        function confirmarExclusao(id) {

            Swal.fire({

                title: "Excluir setor?",
                text: "Essa ação não poderá ser desfeita.",
                icon: "warning",

                showCancelButton: true,

                confirmButtonText: "Sim, excluir",
                cancelButtonText: "Cancelar",

                confirmButtonColor: "#d33",
                cancelButtonColor: "#0A66C2"


            }).then((result) => {


                if (result.isConfirmed) {


                    window.location.href =
                        "<?= base_url('setor/excluir/') ?>" + id;


                }


            });

        }




    </script>



    <script src="<?= base_url('assets/js/acessibilidade.js') ?>"></script>



    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>


    <script>

        new window.VLibras.Widget(
            'https://vlibras.gov.br/app'
        );


    </script>

    <?php if (session()->getFlashdata('sucesso')): ?>

        <script>

            Swal.fire({

                icon: "success",

                title: "Cadastrado com sucesso!",

                text: "O setor foi adicionado ao sistema.",

                confirmButtonColor: "#0A66C2"

            });


        </script>

    <?php endif; ?><?php if (session()->getFlashdata('sucesso')): ?>

        <script>

            Swal.fire({

                icon: "success",

                title: "Cadastrado com sucesso!",

                text: "O setor foi adicionado ao sistema.",

                confirmButtonColor: "#0A66C2"

            });

        </script>

    <?php endif; ?>


    <?php if (session()->getFlashdata('sucesso_edicao')): ?>

        <script>

            Swal.fire({

                icon: "success",

                title: "Edição concluída!",

                text: "O setor foi atualizado com sucesso.",

                confirmButtonColor: "#0A66C2"

            });

        </script>

    <?php endif; ?>


</body>


</html>