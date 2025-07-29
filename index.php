<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  
    <div class="container">
    <h1>Coleção de Pokémons</h1>
    <div class="tabela-div"></div>
    <table>
        <!-- <hr> -->
        <thead>
            <tr>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Local encontrado</th>
                <th>Data do registro</th>
                <th>HP</th>
                <th>Ataque</th>
                <th>Defesa</th>
                <th>Observações</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            session_start();
            include 'conexao.php';  
            $sql = "SELECT * FROM cadastrar_pokemon";
            $resultado_pokemons = $conexao->query($sql);
            if ($resultado_pokemons->num_rows >0 ){
                while($linha = $resultado_pokemons->fetch_assoc()){
                    echo"<tr><td>".$linha['nome_pokemon']."</td><td>".$linha['tipo_pokemon']."</td><td>".$linha['loc_pokemon']."</td><td>".$linha['data_pokemon']."</td><td>".$linha['hp_pokemon']."</td><td>".$linha['ataque_pokemon']."</td><td>".$linha['defesa_pokemon']."</td><td>".$linha['obs_pokemon']."</td><td><div class='btn-editar' onclick=\"editarPokemon('{$linha['id_pokemon']}', '{$linha['nome_pokemon']}', '{$linha['tipo_pokemon']}', '{$linha['loc_pokemon']}', '{$linha['data_pokemon']}', '{$linha['hp_pokemon']}', '{$linha['ataque_pokemon']}', '{$linha['defesa_pokemon']}', '{$linha['obs_pokemon']}')\"><i class='fa-solid fa-pencil'></i></div></td></tr>";
                }
            }
            if (!empty($pesquisa)) {
                $sql_pesquisa = "SELECT * FROM cadastrar_pokemon WHERE nome_pokemon LIKE ?";
                $busca = "%".$pesquisa."%";
                $stmt = $conexao->prepare($sql_pesquisa);
                $stmt->bind_param("s", $busca);
                $stmt->execute();
                $resultados_pesquisa = $stmt->get_result();
                if ($resultados_pesquisa->num_rows > 0) {
                    while ($linha_pesq = $resultados_pesquisa->fetch_assoc()) {
                        echo "<tr><td>" . $linha_pesq['nome_pokemon'] . "</td><td>" . $linha_pesq['tipo_pokemon'] . "</td><td>" . $linha_pesq['loc_pokemon'] . "</td><td>" . $linha_pesq['data_pokemon'] . "</td><td>" . $linha_pesq['hp_pokemon'] . "</td><td>" . $linha_pesq['ataque_pesquisa'] . "</td><td>" . $linha_pesq['defesa_pokemon'] . "</td><td>" . $linha_pesq['obs_pokemon'] . "</td><td><a href='editar_pokemon.php?id_pokemon=".$linha_pesq['id_pokemon']."' class='btn-editar'>Editar</a></td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Nenhum Pokémon encontrado com o nome: ".$pesquisa."</td></tr>";
                }
                $stmt->Close();
            }
            ?>
        </tbody>
    </table>  
    <button id="btn-adicionar" onclick="window.location.href='cadastro.php'">Adicionar um Pokémon</button>
    <hr>
    <h2>Pesquisar Pokémon</h2>
    <form action="" method="post">
        <input type="text" id="titulo" name="titulo" required>
        <button id="search" type="submit">Pesquisar</button>
    </form>


    <?php
    $pesquisa = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['titulo'])) {
        $pesquisa = $_POST['titulo'];
    }

    if (!empty($pesquisa)) {
        $sql_pesquisa = "SELECT nome_pokemon FROM cadastrar_pokemon WHERE nome_pokemon LIKE ?";
        $busca = "%".$pesquisa."%";
        $stmt = $conexao->prepare($sql_pesquisa);
        $stmt->bind_param("s", $busca);
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
 <hr>
    <button id="btn-estatisticas" style="margin-bottom:5px;">estatísticas de tipos</button>
    <div id="estatisticas-tipos" style="display:none;">
        <h2>Estatísticas de Tipos de Pokémon</h2>
        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_stats = "SELECT tipo_pokemon, COUNT(*) AS quantidade FROM cadastrar_pokemon GROUP BY tipo_pokemon ORDER BY quantidade DESC";
                $result_stats = $conexao->query($sql_stats);
                if ($result_stats && $result_stats->num_rows > 0) {
                    while($row = $result_stats->fetch_assoc()) {
                        echo "<tr><td>" . $row['tipo_pokemon'] . "</td><td>" . $row['quantidade'] . "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Nenhum dado encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>  
    <script>
function editarPokemon(id, nome, tipo, local, data, hp, ataque, defesa, obs) {
    Swal.fire({
        title: 'Editar Pokémon',
        html:
            `<input id='swal-nome' class='swal2-input' placeholder='Nome' value='${nome}'>` +
            `<input id='swal-tipo' class='swal2-input' placeholder='Tipo' value='${tipo}'>` +
            `<input id='swal-local' class='swal2-input' placeholder='Local' value='${local}'>` +
            `<input id='swal-data' class='swal2-input' placeholder='Data' value='${data}'>` +
            `<input id='swal-hp' class='swal2-input' placeholder='HP' value='${hp}'>` +
            `<input id='swal-ataque' class='swal2-input' placeholder='Ataque' value='${ataque}'>` +
            `<input id='swal-defesa' class='swal2-input' placeholder='Defesa' value='${defesa}'>` +
            `<input id='swal-obs' class='swal2-input' placeholder='Observações' value='${obs}'>`,
        confirmButtonText: 'Salvar',
        showCancelButton: true,
        preConfirm: () => {
            return [
                document.getElementById('swal-nome').value,
                document.getElementById('swal-tipo').value,
                document.getElementById('swal-local').value,
                document.getElementById('swal-data').value,
                document.getElementById('swal-hp').value,
                document.getElementById('swal-ataque').value,
                document.getElementById('swal-defesa').value,
                document.getElementById('swal-obs').value
            ];
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Envia via AJAX para editar_pokemon.php
            fetch('editar_pokemon.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    id_pokemon: id,
                    nome_pokemon: result.value[0],
                    tipo_pokemon: result.value[1],
                    loc_pokemon: result.value[2],
                    data_pokemon: result.value[3],
                    hp_pokemon: result.value[4],
                    ataque_pokemon: result.value[5],
                    defesa_pokemon: result.value[6],
                    obs_pokemon: result.value[7]
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.sucesso){
                    Swal.fire('Salvo!', 'Pokémon editado com sucesso!', 'success').then(()=>location.reload());
                }else{
                    Swal.fire('Erro!', 'Não foi possível editar.', 'error');
                }
            });
        }
    });
}
document.getElementById('btn-estatisticas').onclick = function() {
    var div = document.getElementById('estatisticas-tipos');
    div.style.display = (div.style.display === 'none') ? 'block' : 'none';
    if (div.style.display === 'block') {
        setTimeout(function() {
            div.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 100);
    }
}
</script> 
</body>
</html>
