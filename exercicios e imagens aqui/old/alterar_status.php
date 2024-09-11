<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $new_status = $_POST['status'];

    $sql = "UPDATE usuarios SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_status, $id);

    if ($stmt->execute()) {
        // Redirecionar de volta para a lista de alunos
        header("Location: page10.php");
        exit();
    } else {
        echo "Erro ao atualizar o status: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
