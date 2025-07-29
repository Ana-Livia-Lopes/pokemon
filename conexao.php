<!-- Ana Lívia Lopes e Isadora Gomes -->
<?php
    $dbname = 'db_pokemon';
    $hostname = 'localhost';
    $password = '';
    $username = 'root';

    $conexao = new mysqli($hostname, $username,$password, $dbname);

    if ($conexao->connect_error) {
        die("falha na coneção: ". $conexao->connect_error);
    };

    $sql_pokemons= "SELECT nome_pokemon, tipo_pokemon, loc_pokemon, data_pokemon, hp_pokemon, ataque_pokemon, defesa_pokemon, obs_pokemon 
    FROM cadastrar_pokemon
    ORDER BY nome_pokemon ASC";
    
    $resultado_pokemons = $conexao -> query($sql_pokemons);
?>