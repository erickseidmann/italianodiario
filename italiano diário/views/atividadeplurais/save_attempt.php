<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login/");
    exit;
}

include '../../config/config.php'; // Conecta ao banco de dados

// Receber os dados da tentativa
$activity_number = $_POST['activity_number'];
$correct_count = $_POST['correct_count'];
$incorrect_count = $_POST['incorrect_count'];
$score = $_POST['score'];
$user_name = isset($_SESSION['email']) && $_SESSION['email'] === 'ADM@adm.com' ? 'ADM' : $_SESSION['name'];

// Pegar a data e hora atuais
$attempt_date = date('Y-m-d H:i:s');

// Inserir os dados na tabela activity_scores
$query = "INSERT INTO activity_scores (user_name, activity_number, correct_count, incorrect_count, score, attempt_date) 
          VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("siiids", $user_name, $activity_number, $correct_count, $incorrect_count, $score, $attempt_date);

if ($stmt->execute()) {
    echo "Dados de tentativa salvos com sucesso!";
} else {
    echo "Erro ao salvar os dados: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
