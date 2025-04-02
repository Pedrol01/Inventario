<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Criptografar a senha

    // Verifica se o usuário já existe
    $query = $conexao->prepare("SELECT id FROM usuarios WHERE username=?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Usuário já existe!'); window.location='cadastro.php';</script>";
        exit();
    }

    // Inserir no banco
    $query = $conexao->prepare("INSERT INTO usuarios (username, senha) VALUES (?, ?)");
    $query->bind_param("ss", $username, $password);

    if ($query->execute()) {
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Minecraft</title>
</head>
<body>

<h2>Cadastro Minecraft</h2>
<form action="cadastro.php" method="POST">
    <label>Usuário:</label>
    <input type="text" name="username" required>
    <br><br>
    
    <label>Senha:</label>
    <input type="password" name="password" required>
    <br><br>
    
    <button type="submit">Cadastrar</button>
</form>

<a href="login.php">Já tem uma conta? Faça login</a>

</body>
</html>
