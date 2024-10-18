<?php
// Conexão com o banco de dados
include '../../config/config.php'; // Ajuste o caminho conforme a estrutura do seu projeto

// Define o cabeçalho de resposta como JSON
header('Content-Type: application/json');

// Verifique se o usuário está logado
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login/");
    exit;
}

// Pegar o nome do usuário logado
$usuario_id = $_SESSION['name'];

// Verifique a conexão
if ($conn->connect_error) {
    echo json_encode([
        'status' => 'error',
        'message' => "Conexão falhou: " . $conn->connect_error
    ]);
    exit;
}

// Dados da pontuação vindos da requisição AJAX
$atividade_id = $_POST['atividade'];
$acertos = $_POST['acertos'];
$erros = $_POST['erros'];
$pontuacao = $_POST['pontuacao'];

// Insere a pontuação no banco de dados
$sql = "INSERT INTO pontucaocompletafrase (usuario_id, atividade_id, acertos, erros, pontuacao) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("siiid", $usuario_id, $atividade_id, $acertos, $erros, $pontuacao);

$response = []; // Inicializa um array para a resposta

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Pontuação salva com sucesso.';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Erro ao salvar pontuação: ' . $stmt->error;
}

$stmt->close();
$conn->close();


exit;
?>
