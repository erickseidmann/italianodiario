<?php
include '../../config/config.php';

$data = json_decode(file_get_contents("php://input"), true);

$texto = $data['texto'];
$palavras_arrastadas = $data['palavras_arrastadas'];
$atividade_id = 1;  // Isso pode vir dinamicamente ou ser gerado com base em outra lógica

// Inserir o texto na tabela textos_atividade
$sql = "INSERT INTO textos_atividade (texto, atividade_id) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $texto, $atividade_id);
$stmt->execute();
$texto_id = $stmt->insert_id;

// Inserir as palavras selecionadas na tabela
foreach ($palavras_arrastadas as $palavra) {
    $sql_palavra = "INSERT INTO palavras_arrastadas (texto_id, palavra) VALUES (?, ?)";
    $stmt_palavra = $conn->prepare($sql_palavra);
    $stmt_palavra->bind_param("is", $texto_id, $palavra);
    $stmt_palavra->execute();
}

// Retornar resposta de sucesso
echo json_encode(["status" => "sucesso"]);
?>

