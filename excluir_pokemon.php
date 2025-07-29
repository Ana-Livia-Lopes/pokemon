<?php
header('Content-Type: application/json');
include 'conexao.php';

$dados = json_decode(file_get_contents('php://input'), true);

if (!isset($dados['id_pokemon'])) {
    echo json_encode(['sucesso' => false, 'erro' => 'ID não informado']);
    exit;
}

$id = $dados['id_pokemon'];
$sql = "DELETE FROM cadastrar_pokemon WHERE id_pokemon=?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    echo json_encode(['sucesso' => true]);
} else {
    echo json_encode(['sucesso' => false, 'erro' => $stmt->error]);
}
$stmt->close();
$conexao->close();
?>