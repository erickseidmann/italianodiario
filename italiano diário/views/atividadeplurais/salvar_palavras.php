<?php
include '../../config/config.php';

$data = json_decode(file_get_contents("php://input"), true);
$activityNumber = $data['activityNumber'];
$words = $data['words'];

foreach ($words as $word) {
    $singular = $word['singular'];

    // Verifica se a palavra já existe
    $checkQuery = "SELECT COUNT(*) FROM palavras_singular WHERE singular = ? AND atividade_id = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("si", $singular, $activityNumber);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    // Se a palavra não existir, insere
    if ($count === 0) {
        $query = "INSERT INTO palavras_singular (singular, atividade_id) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $singular, $activityNumber);
        $stmt->execute();
        $stmt->close();
    }
}

echo json_encode(['status' => 'success']);
?>

