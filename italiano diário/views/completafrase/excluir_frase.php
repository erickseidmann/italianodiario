<?php
include '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $atividade_id = $_POST['atividade_id'];
    $exercicio_numero = $_POST['exercicio_numero'];

    $sql = "DELETE FROM atividades_frases WHERE atividade_id = ? AND exercicio_numero = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ii", $atividade_id, $exercicio_numero);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
    }

    $stmt->close();
    $conn->close();
}
?>
