<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['username'];

// Buscar os itens do usuário
$query = $conexao->prepare("SELECT item, imagem FROM inventario WHERE usuario=?");

if (!$query) {
    die("Erro na consulta SQL: " . $conexao->error);
}

$query->bind_param("s", $usuario);
$query->execute();
$result = $query->get_result();

$itens = [];
while ($row = $result->fetch_assoc()) {
    $itens[] = $row;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Inventário Minecraft</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #282c34;
            color: white;
            text-align: center;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: #444;
            padding: 20px;
            border-radius: 10px;
        }
        .item {
            background: #666;
            margin: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        .item img {
            width: 100px;
            height: 100px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h2>Inventário de <?php echo $usuario; ?></h2>

<div class="container">
    <h3>Seus Itens:</h3>
    <?php if (empty($itens)): ?>
        <p>Seu inventário está vazio!</p>
    <?php else: ?>
        <?php foreach ($itens as $item): ?>
            <div class="item">
                <strong><?php echo htmlspecialchars($item['item']); ?></strong><br>
                <?php if (!empty($item['imagem'])): ?>
                    <img src="<?php echo htmlspecialchars($item['imagem']); ?>" alt="Imagem do item">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<br>
<a href="add_item.php">Adicionar Item</a> |
<a href="logout.php">Sair</a>

</body>
</html>
