<?php
include '../../config/config.php';

// Consulta ao banco de dados para listar as frases
$query = "SELECT id, frase, explicacao, correta FROM frases WHERE atividade_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $_GET['atividade']); // Certifique-se de passar o ID da atividade corretamente
$stmt->execute();
$result = $stmt->get_result();

$frases = [];

while ($row = $result->fetch_assoc()) {
    $frases[] = [
        'id' => $row['id'],
        'frase' => $row['frase'],
        'explicacao' => $row['explicacao'],
        'correta' => $row['correta']
    ];
}

// Retorna as frases no formato JSON
header('Content-Type: application/json');
echo json_encode($frases);
?>
