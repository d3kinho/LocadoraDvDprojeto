<?php
include("conexao.php");

$mensagem = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $tel = trim($_POST['tel']);

    if(!empty($nome) && !empty($email) && !empty($tel)) {
        $stmt = $conn->prepare("insert into clientes (nome, email, tel) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi",$nome,$email,$tel);

        if ($stmt->execute()) {
            $mensagem = "<p class='msg-success'>Cliente cadastrado com sucesso!</p>";
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
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Clientes</h1>
        <a href="index.php">Voltar</a>

        <?php echo $mensagem; ?>
        
        <form method="post" action="">
            <label>Nome:</label>
            <input type="text" name="nome" placeholder="Insira seu nome aqui" required>
            <label>Email:</label>
            <input type="email" name="email" placeholder="Insira seu email aqui" required> 
            <label>Telefone:</label>
            <input type="number" name="tel" placeholder="Insira seu número aqui" required>
            
            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>