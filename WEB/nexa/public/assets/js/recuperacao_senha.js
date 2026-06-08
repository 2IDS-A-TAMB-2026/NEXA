const form = document.getElementById('form_recuperacao');
    const msgErro = document.getElementById('mensagem_erro');
    const ref = '123456'; //validação falsa, só para testes

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        //pegando os valores dos inputs
        const codigoIPT = document.getElementById('codigo').value;
        const senhaIPT = document.getElementById('novasenha').value;
        const confirmarIPT = document.getElementById('confirmar').value;

        let erros = [];

        // validação do Código
        if (codigoIPT !== ref) {
            erros.push(1);
             Swal.fire({
                title: "Campos inválidos",
                text: "Verifique se os campos foram preenchidos corretamente.",
                icon: "warning"
            });
            
        }

        //validação de preenchimento de senha
        if (senhaIPT.length < 6) {
            erros.push(2);
            Swal.fire({
                title: "Campos inválidos",
                text: "Verifique se os campos foram preenchidos corretamente.",
                icon: "warning"
            });
        }

        //confirmação da nova senha
        if (senhaIPT !== confirmarIPT) {
            erros.push(3);
            Swal.fire({
                title: "Campos inválidos",
                text: "Verifique se os campos foram preenchidos corretamente.",
                icon: "warning"
            });
        }
        //destaca em vermelho os campos não preenchidos
        if (erros.length > 0) {
            msgErro.style.display = 'none';
            msgErro.innerText = erros[0]; // mostra os erros em ordem de ocorrência/prioridade
            document.getElementById('codigo').style.borderColor = (codigoIPT !== ref) ? 'red' : '#ccc';
            document.getElementById('novasenha').style.borderColor = (senhaIPT == '') ? 'red' : '#ccc';
            document.getElementById('confirmar').style.borderColor = (confirmarIPT !== senhaIPT) ? 'red' : '#ccc';
        } else {
            //mensagem de erro estilizada
            msgErro.style.display = 'none';
            Swal.fire({
                title: "Sucesso!",
                text: "Dados cadastrados com sucesso.",
                icon: "success",
                confirmButtonText: "OK"
            }).then(()=>{
                //recarrega a página
                window.location.reload(true);
            });
            //-->alterar a senha no banco!!!!
        }
    });
