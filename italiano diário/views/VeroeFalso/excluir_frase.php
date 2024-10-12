<?php
// Conexão com o banco de dados
include '../../config/config.php';  // Certifique-se de que seu arquivo de conexão esteja correto

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);  // Sanitizar o ID recebido

    // Consulta SQL para excluir a frase com base no ID
    $query = "DELETE FROM frases WHERE id = ?";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $id);  // Bind do ID
        if ($stmt->execute()) {
            echo "Frase excluída com sucesso.";
        } else {
            echo "Erro ao excluir a frase.";
        }
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta.";
    }

    $conn->close();
} else {
    echo "ID da frase não foi fornecido.";
}
?>
