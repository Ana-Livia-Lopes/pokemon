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
            session_start();
            include 'conexao.php';
            if ($resultado_pokemons->num_rows >0 ){
                while($linha = $resultado_pokemons->fetch_assoc()){
                echo"<tr><td>".$linha['nome_pokemon']."</td><td>".$linha['tipo_pokemon']."</td><td>".$linha['loc_pokemon']."</td><td>".$linha['data_pokemon']."</td><td>".$linha['hp_pokemon']."</td><td>".$linha['ataque_pokemon']."</td><td>".$linha['defesa_pokemon']."</td><td>".$linha['obs_pokemon']."</td></tr>";
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
        $sql_pesquisa = "SELECT * FROM pokemons WHERE nome LIKE ? OR tipo LIKE ? OR local_encontrado LIKE ? OR data_registro LIKE ? OR hp LIKE ? OR ataque LIKE ? OR defesa LIKE ? OR observacoes LIKE ?";
        $busca = "%".$pesquisa."%";
        $stmt = $conexao->prepare($sql_pesquisa);
        $stmt->bind_param("ssssssss", $busca, $busca, $busca, $busca, $busca, $busca, $busca, $busca);
        $stmt->execute();
        $resultados_pesquisa = $stmt->get_result();
    
        if ($resultados_pesquisa->num_rows > 0) {
            while ($linha_pesq = $resultados_pesquisa->fetch_assoc()) {
                echo "<h4>".$linha_pesq['nome_pokemon']."</h4>";
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