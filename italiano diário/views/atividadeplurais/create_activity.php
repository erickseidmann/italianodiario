<?php
include '../../config/config.php';

// Cria uma nova atividade e retorna o ID
$query = "INSERT INTO atividades (id) VALUES (NULL)";
if ($conn->query($query) === TRUE) {
    $newActivityId = $conn->insert_id;
    echo json_encode(['status' => 'success', 'new_id' => $newActivityId]);
} else {
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
}
?>
