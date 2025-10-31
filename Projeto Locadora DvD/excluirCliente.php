<?php
include("conexao.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM clientes WHERE idClientes=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: listarClientes.php");
exit;
?>
