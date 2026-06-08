<?php



//ARRUMAR EMAIL DE RECUPERAÇÃO DE SENHA DEPOIS




require 'assets/php/conexao.php'; 
$email = $_POST['email'];
$nova_senha = $_POST['novasenha'];

// Criptografando a senha (NUNCA salve em texto puro)
$senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

$tabelas = ['FUNCIONARIO', 'ADMINISTRADOR'];
$atualizou = false;

foreach ($tabelas as $tabela) {
    // o email existe nessa tabela?
    $sql_check = "SELECT COUNT(*) FROM $tabela WHERE EMAIL_CORPORATIVO = :email";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute(['email' => $email]);
    
    if ($stmt_check->fetchColumn() > 0) {
        // UPDATE na tabela que encontramos o email
        $sql_update = "UPDATE $tabela SET SENHA = :senha WHERE EMAIL_CORPORATIVO = :email";
        $stmt_update = $pdo->prepare($sql_update);
        $sucesso = $stmt_update->execute([
            'SENHA' => $senha_hash, 
            'EMAIL_CORPORATIVO' => $email
        ]);
        if ($sucesso) {
            $atualizou = true;
            break;
        }
    }
}

// Feedback para o usuário
if ($atualizou) {
    echo "Senha alterada com sucesso!";
} else {
    echo "Erro: E-mail não encontrado em nenhuma base de dados.";
}
?>