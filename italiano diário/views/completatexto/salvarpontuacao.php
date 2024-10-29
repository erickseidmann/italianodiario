<?php
session_start();
include '../../config/config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "Usuário não autenticado";
    exit;
}

$usuario = $_SESSION['name'];
$atividade_id = $_POST['atividade_id'];
$acertos = $_POST['acertos'];
$erros = $_POST['erros'];
$pontuacao = $_POST['pontuacao'];  // Total de acertos como pontuação

// Preparando a inserção no banco de dados
$stmt = $conn->prepare("INSERT INTO pontucaocompletatexto (usuario, atividade_id, acertos, erros, pontuacao) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("siiid", $usuario, $atividade_id, $acertos, $erros, $pontuacao);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Pontuação salva com sucesso!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao salvar pontuação.']);
}

$stmt->close();
$conn->close();
?>
