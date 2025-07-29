<!-- Ana Lívia Lopes e Isadora Gomes -->
<?php include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $var_nome = $_POST["nome"];
    $var_tipo = $_POST["tipo"];
    $var_loc = $_POST["loc"];
    $var_data = $_POST["data"];
    $var_hp = $_POST["hp"];
    $var_ataque = $_POST["ataque"];
    $var_defesa = $_POST["defesa"];

    $sql_insercao = "INSERT INTO cadastrar_pokemon (nome_pokemon, tipo_pokemon, loc_pokemon, data_pokemon, hp_pokemon, ataque_pokemon, defesa_pokemon) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conexao->prepare($sql_insercao);

    $stmt->bind_param("sssssss", $var_nome, $var_tipo, $var_loc, $var_data, $var_hp, $var_ataque, $var_defesa);

    if ($stmt->execute()) {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        text: "Cadastro efetuado com sucesso!",
                        icon: "success"
                    }).then(() => {
                        window.location = "index.php";
                    });
                });
              </script>';
    } else {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        text: "Erro ao cadastrar Pokémon: ' . $conexao->error . '",
                        icon: "error"
                    });
                });
              </script>';
    }

    $stmt->close();
    $conexao->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="cadastro.css">
    <title>Cadastrar Pokémon</title>
</head>
<body>
    <div id='voltar'>
                <button class="botaoVoltar2" onclick="window.location.href='index.php'">⭠ Voltar</button>
            </div>
<section class="secao-cadastro">
    
    <div class="box-cadastro">
        <form action="" method="POST" id="form-cadastro-aluno">
            <h1>Cadastre um Pokémon</h1>
            <label for="nome">Nome</label>
            <input class="campo-inserir" type="text" name="nome" required>
            
            <div>
            <label for="tipo">Tipo</label>
            <div>
            <select name="tipo" id="select-tipo">
                <option>Normal</option>
                <option>Fogo</option>
                <option>Água</option>
                <option>Grama</option>
                <option>Elétrico</option>
                <option>Gelo</option>
                <option>Lutador</option>
                <option>Veneno</option>
                <option>Terra</option>
                <option>Voador</option>
                <option>Psíquico</option>
                <option>Inseto</option>   
                <option>Pedra</option>
                <option>Fantasma</option>
                <option>Dragão</option>
                <option>Aço</option>
                <option>Sombrio</option>
                <option>Fada</option>
            </select>
            </div>
            </div>

            <label for="loc">Localização encontrada</label>
            <input class="campo-inserir" type="text" name="loc" required>

            <label for="data">Data do registro</label>
            <input class="campo-inserir" type="date" name="data" required>
            
            <label for="hp">HP</label>
            <input class="campo-inserir" type="text" name="hp" required>
            
            <label for="ataque">Ataque</label>
            <input class="campo-inserir" type="text" name="ataque" required>

            <label for="defesa">Defesa</label>
            <input class="campo-inserir" type="text" name="defesa" required>

            <label for="obs">Observações</label>
            <input class="campo-inserir" type="text" name="obs">
            
            <button id="botao-cadastrar" type="submit">Cadastrar</button>
        </form>
    </div>
</section>
</body>
</html>