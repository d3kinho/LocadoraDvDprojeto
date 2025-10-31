<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idClientes = $_POST["idClientes"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];

    $sql = "UPDATE clientes SET nome = ?, email = ?, tel = ? WHERE idClientes = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssi", $nome, $email, $tel, $idClientes);

        if ($stmt->execute()) {
            echo "<script>
                alert('Cliente atualizado com sucesso!');
                window.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao atualizar Cliente: " . addslashes($stmt->error) . "');
                window.location.href = 'index.php';
            </script>";
        }

        $stmt->close();
    } else {
        echo "<script>
            alert('Erro na preparação da consulta: " . addslashes($conn->error) . "');
            window.location.href = 'index.php';
        </script>";
    }

    $conn->close();

} else {
    echo "<script>
        alert('Requisição inválida.');
        window.location.href = 'index.php';
    </script>";
}
?>