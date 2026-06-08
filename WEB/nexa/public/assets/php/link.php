<?php



//ARRUMAR EMAIL DE RECUPERAÇÃO DE SENHA DEPOIS




$link = "http://http://10.141.128.38/nexa-web/recuperacao_senha?email=" . urlencode($email);

$assunto = "Redefinição de Senha";
$mensagem = "Clique aqui para mudar sua senha: " . $link;
$headers = "From: suporte@seusite.com";

if(mail($email, $assunto, $mensagem, $headers)) {
    echo "Verifique seu e-mail para redefinir a senha.";
} else {
    echo "Erro ao enviar e-mail.";
}
?>