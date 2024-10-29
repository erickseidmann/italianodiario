<?php
session_start();
include '../../config/config.php'; // Inclui a configuração do banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $atividade_id = $_POST['atividade_id'];
    $texto = $_POST['texto'];
    $palavras = $_POST['palavras'];
    
    // Prepare e execute a inserção
    $stmt = $conn->prepare("INSERT INTO completatexto (atividade_id, texto, palavras) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $atividade_id, $texto, $palavras);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Dados salvos com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar os dados: ' . $conn->error]);
    }
    
    $stmt->close();
    $conn->close();
}
?>
