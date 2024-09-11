<?php
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Prepara a consulta de exclusão
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Usuário excluído com sucesso!'); window.location.href='../views/adm/index.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir o usuário.'); window.location.href='../views/adm/index.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
