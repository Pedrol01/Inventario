<?php
include('conexao.php');

$username = $_POST['username'];
$password = $_POST['password'];

$query = "INSERT INTO usuarios (username, senha) VALUES ('$username', '$password')";
if (mysqli_query($conexao, $query)) {
    echo "<script>alert('Cadastro realizado com sucesso!'); window.location='login.php';</script>";
} else {
    echo "<script>alert('Erro ao cadastrar!');</script>";
}
?>
