<?php
include("conexao.php");

if (!isset($_GET['id'])) {
    die("ID do cliente não informado!");
}

$id = intval($_GET['id']);
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    $stmt = $conn->prepare("UPDATE clientes SET nome=?, email=?, tel=? WHERE idClientes=?");
    $stmt->bind_param("sssi", $nome, $email, $tel, $id);
    
    if ($stmt->execute()) {
        $mensagem = "<p class='msg-success'>Cliente atualizado com sucesso!</p>";
    } else {
        $mensagem = "<p class='msg-error'>Erro ao atualizar: {$stmt->error}</p>";
    }
}

$stmt = $conn->prepare("SELECT * FROM clientes WHERE idClientes=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$cliente = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Editar Cliente</h1>
    <a href="listarClientes.php">Voltar</a>
    <?= $mensagem ?>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" required>
        <label>Telefone:</label>
        <input type="text" name="tel" value="<?= htmlspecialchars($cliente['tel']) ?>" required>
        <button type="submit">Salvar Alterações</button>
    </form>
</div>
</body>
</html>
