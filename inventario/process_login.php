<?php
session_start();
include('conexao.php');

$username = $_POST['username'];
$password = $_POST['password'];

// Verificar se o usuário existe
$query = $conexao->prepare("SELECT senha FROM usuarios WHERE username=?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['senha'])) { // Verifica a senha criptografada
        $_SESSION['username'] = $username;
        header("Location: inventario.php");
        exit();
    }
}

echo "<script>alert('Usuário ou senha incorretos!'); window.location='login.php';</script>";
?>
