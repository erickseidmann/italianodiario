<?php
// Conectar ao banco de dados
require 'config.php';

// Obter o ID da URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Preparar a consulta para buscar a imagem com base no ID
    $sql = "SELECT imagem FROM infoBlog WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($imagem);
    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        // Definir o tipo de conteúdo da imagem
        header("Content-Type: image/jpeg");
        echo $imagem;
    } else {
        echo "Imagem não encontrada!";
    }
    $stmt->close();
} else {
    echo "ID inválido!";
}

$conn->close();
?>
