<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Minecraft</title>
</head>
<body>

<h2>Login Minecraft</h2>
<form action="process_login.php" method="POST">
    <label>Usuário:</label>
    <input type="text" name="username" required>
    <br><br>
    
    <label>Senha:</label>
    <input type="password" name="password" required>
    <br><br>
    
    <button type="submit">Entrar</button>
</form>

<a href="cadastro.php">Criar conta</a>

</body>
</html>
