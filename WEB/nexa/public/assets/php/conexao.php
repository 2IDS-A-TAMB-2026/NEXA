<?php



//ARRUMAR EMAIL DE RECUPERAÇÃO DE SENHA DEPOIS




// configurações do banco
$host = 'localhost';
$db   = 'BD_NEXA';
$user = 'root'; //a gente vai ter que mudar isso?
$pass = 'root';
$charset = 'utf8mb4';

// Data Source Name - define o driver, host, banco e charset
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opções extras para o PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       
    PDO::ATTR_EMULATE_PREPARES   => false,               
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>