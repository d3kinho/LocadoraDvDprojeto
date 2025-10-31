<?php
include("conexao.php");

$mensagem = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCliente = trim($_POST['idCliente']);
    
    $idDvd = trim($_POST['idDvd']);
    $dataDevolucao = trim($_POST['dataDevolucao']);
    
    if(empty($dataDevolucao)) {
        $dataDevolucao = NULL;
    }

    if(!empty($idCliente) && !empty($idDvd)) {
        
        $stmt = $conn->prepare("insert into alugueis (idCliente, idDvd, dataDevolucao) VALUES (?, ?, ?)");
        $stmt->bind_param("iis",$idCliente,$idDvd,$dataDevolucao);

        if ($stmt->execute()) {
            $mensagem = "<p class='msg-success'>Aluguel cadastrado com sucesso!</p>";
        } else {
            $mensagem = "<p class='msg-error'>Erro ao cadastrar: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }else{
        $mensagem = "<p class='msg-error'>Preencha os campos de ID do Cliente e ID do DVD!</p>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aluguel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Aluguel</h1>
        <a href="index.php">Voltar</a>
        
        <?php echo $mensagem; ?>

        <form method="post" action="">
            <label>ID do Cliente:</label>
            <input type="number" name="idCliente" placeholder="Insira a Id do cliente aqui" required>

            <label>ID do Dvd:</label>
            <input type="number" name="idDvd" placeholder="Insira a Id do DvD aqui" required>
            <label>Data de Devolução:
            </label>
            <input type="date" name="dataDevolucao" placeholder="Insira a data de devolução aqui (Opcional)">
            
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>