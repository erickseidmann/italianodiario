<?php
include '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $atividadeId = $_POST['atividade_id'];

    // Excluir o texto da atividade no banco de dados
    $stmt = $conn->prepare("DELETE FROM completatexto WHERE atividade_id = ?");
    $stmt->bind_param("i", $atividadeId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Texto excluído com sucesso.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao excluir o texto.']);
    }

    $stmt->close();
    $conn->close();
}
?>
