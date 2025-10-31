<?php

include("conexao.php");

$consulta = $_POST["nome"];
$sql = "SELECT * FROM clientes WHERE nome LIKE '%$consulta%'";
$resultado = $conexao->query($sql);

if ($consulta == "") {
    echo "<script>
        alert('Campo de busca vazio. Por favor, insira um título para buscar.');
        window.location.href = 'formulario.html';
    </script>";
} else {
    if ($resultado->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Código</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Ano de Publicação</th>
                    <th>Gênero</th>
                    <th>Ações</th>
                </tr>";
        while($linha = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>" . $linha["codigo"] . "</td>
                    <td>" . $linha["titulo"] . "</td>
                    <td>" . $linha["autor"] . "</td>
                    <td>" . $linha["ano_publicacao"] . "</td>
                    <td>" . $linha["genero"] . "</td>
                    <td>
                        <form method='post' action='excluir.php' style='display:inline;'>
                            <input type='hidden' name='codigo' value='" . $linha["codigo"] . "'>
                            <button type='submit'>Excluir</button>
                        </form>
                        <form method='get' action='editar.php' style='display:inline; margin-left:5px;'>
                            <input type='hidden' name='codigo' value='" . $linha["codigo"] . "'>
                            <button type='submit'>Editar</button>
                        </form>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<script>
            alert('Nenhum livro encontrado.');
            window.location.href = 'index.html';
        </script>";
    }
}

echo "<div style='margin-top: 20px; text-align: center;'>
        <a href='index.html'>
            <button style='padding: 10px 20px; font-size: 16px;'>Voltar para a página inicial</button>
        </a>
      </div>";

?>