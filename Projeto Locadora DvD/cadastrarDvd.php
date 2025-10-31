<?php
include("conexao.php");

$mensagem = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomedofilme = trim($_POST['nomedofilme']);
    $valor = trim($_POST['valor']);
    $genero = trim($_POST['genero']);

    if(!empty($nomedofilme) && !empty($valor) && !empty($genero)) {
        
        $stmt = $conn->prepare("insert into dvd (nomedofilme, valor, genero) VALUES (?, ?, ?)");
        
        $stmt->bind_param("sds",$nomedofilme,$valor,$genero);

        if ($stmt->execute()) {
            $mensagem = "<p class='msg-success'>Dvd cadastrado com sucesso!</p>";
        } else {
            $mensagem = "<p class='msg-error'>Erro ao cadastrar: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }else{
        $mensagem = "<p class='msg-error'>Preencha todos os campos obrigatórios!</p>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do Dvd</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>DvDs </h1>
        <a href="index.php">Voltar</a>

        <?php echo $mensagem; ?>

        <form method="post" action="">
            <label>Nome do DvD:</label>
            <input type="text" name="nomedofilme" placeholder="Insira o nome do DvD aqui" required>
            <label>Valor (R$):</label>
            <input type="number" name="valor" step="0.01" placeholder="Insira o valor aqui" required>
            <label>Gênero :</label>
            <input type="text" name="genero" placeholder="Insira o gênero do filme aqui" required>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>