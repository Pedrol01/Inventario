<?php
$host = "localhost";
$user = "root"; // Usuário padrão do XAMPP
$pass = ""; // Senha vazia no XAMPP
$db = "minecraft"; // Nome do banco de dados

$conexao = new mysqli($host, $user, $pass);

// Criar o banco de dados se não existir
$conexao->query("CREATE DATABASE IF NOT EXISTS $db");

// Selecionar o banco de dados
$conexao->select_db($db);

// Criar a tabela "inventario" automaticamente se não existir
$conexao->query("CREATE TABLE IF NOT EXISTS inventario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    item VARCHAR(100) NOT NULL
)");
?>
