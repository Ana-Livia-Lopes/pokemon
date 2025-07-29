<!-- Ana Livia Lopes e Isadora Gomes -->
<?php
header('Content-Type: application/json');
include 'conexao.php';

$dados = json_decode(file_get_contents('php://input'), true);

if (!isset($dados['id_pokemon'])) {
    echo json_encode(['sucesso' => false, 'erro' => 'ID não informado']);
    exit;
}

$id = $dados['id_pokemon'];
$nome = $dados['nome_pokemon'];
$tipo = $dados['tipo_pokemon'];
$local = $dados['loc_pokemon'];
$data = $dados['data_pokemon'];
$hp = $dados['hp_pokemon'];
$ataque = $dados['ataque_pokemon'];
$defesa = $dados['defesa_pokemon'];
$obs = $dados['obs_pokemon'];

$sql = "UPDATE cadastrar_pokemon SET nome_pokemon=?, tipo_pokemon=?, loc_pokemon=?, data_pokemon=?, hp_pokemon=?, ataque_pokemon=?, defesa_pokemon=?, obs_pokemon=? WHERE id_pokemon=?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('ssssssssi', $nome, $tipo, $local, $data, $hp, $ataque, $defesa, $obs, $id);

if ($stmt->execute()) {
    echo json_encode(['sucesso' => true]);
} else {
    echo json_encode(['sucesso' => false, 'erro' => $stmt->error]);
}
$stmt->close();
$conexao->close();
?>
