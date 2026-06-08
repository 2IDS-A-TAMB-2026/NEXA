<?php

class Banco {
    private $host = "localhost";
    private $banco = "BD_NEXA";
    private $usuario = "root";
    private $senha = "root";

    public function conectar() {
        try {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->banco;charset=utf8", $this->usuario, $this->senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
}
?>