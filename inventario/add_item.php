<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Verifica se a coluna "imagem" já existe
$query_check = $conexao->query("SHOW COLUMNS FROM inventario LIKE 'imagem'");
if ($query_check->num_rows == 0) {
    // Se a coluna não existir, criamos ela automaticamente
    $conexao->query("ALTER TABLE inventario ADD imagem VARCHAR(255) NULL");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_SESSION['username'];
    $item = $_POST['item'];
    $imagem = $_POST['imagem']; // URL da imagem

    $query = $conexao->prepare("INSERT INTO inventario (usuario, item, imagem) VALUES (?, ?, ?)");

    if (!$query) {
        die("Erro ao inserir item: " . $conexao->error);
    }

    $query->bind_param("sss", $usuario, $item, $imagem);
    $query->execute();

    echo "<script>alert('Item adicionado com sucesso!'); window.location='inventario.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Item</title>
</head>
<body>

<h2>Adicionar Item ao Inventário</h2>
<form action="add_item.php" method="POST">
    <label>Nome do Item:</label>
    <input type="text" name="item" required>
    <br><br>

    <label>URL da Imagem:</label>
    <input type="text" name="imagem" placeholder="Cole a URL da imagem">
    <br><br>
    
    <button type="submit">Adicionar</button>
</form>

<br>
<a href="inventario.php">Voltar ao Inventário</a>

</body>
</html>
