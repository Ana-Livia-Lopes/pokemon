<?php
    $dbname = 'db_editora';
    $hostname = 'localhost';
    $password = '';
    $username = 'root';

    $conexao = new mysqli($hostname, $username,$password, $dbname);

    if ($conexao->connect_error) {
        die("falha na coneção: ". $conexao->connect_error);
    };

    $sql_autores = "SELECT autores.nome_autor, livros.titulo_livro, livros.ano_livro, livros.genero_livro 
    FROM livros
    INNER JOIN autores ON livros.fk_id_autor = autores.id_autor
    ORDER BY livros.titulo_livro DESC";
    
    $resultado_autores = $conexao -> query($sql_autores);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
    <h1>Seus Pokémon</h1>
    <div class="tabela-div"></div>
    <table>
        <hr>
        <thead>
            <tr>
                <th>nome</th>
                <th>Tipo</th>
                <th>local encontrado</th>
                <th>Data do registro</th>
                <th>HP</th>
                <th>Ataque</th>
                <th>Defesa</th>
                <th>Observações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado_autores->num_rows >0 ){
                while($linha = $resultado_autores->fetch_assoc()){
                echo"<tr><td>".$linha['nome_autor']."</td><td>".$linha['titulo_livro']."</td><td>".$linha['ano_livro']."</td><td>".$linha['genero_livro']."</td></tr>";
                }
            }
            
            ?>
        </tbody>
    </table>  
    <hr>
    <h2>Pesquisar Pokémon</h2>
    <form action="" method="post">
        <input type="text" id="titulo" name="titulo" required>
        <button type="submit">Pesquisar</button>
    </form>
    

    <?php
    $pesquisa = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['titulo'])) {
        $pesquisa = $_POST['titulo'];
    }

    if (!empty($pesquisa)) {
        $sql_pesquisa = "SELECT livros.titulo_livro FROM livros WHERE livros.titulo_livro LIKE ?";
        $busca = "%".$pesquisa."%";
        $stmt = $conexao->prepare($sql_pesquisa);
        $stmt->bind_param("s", $busca);
        $stmt->execute();
        $resultados_pesquisa = $stmt->get_result();
    
        if ($resultados_pesquisa->num_rows > 0) {
            while ($linha_pesq = $resultados_pesquisa->fetch_assoc()) {
                echo "<h4>".$linha_pesq['titulo_livro']."</h4>";
            }
        }else{
            echo "<h4>Nenhum livro encontrado com o título: ".$pesquisa."</h4>";
        }
        $stmt -> Close();
    }

    ?>

    </div>  
</body>
</html>