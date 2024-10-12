<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login/");
    exit;
}

// Conexão com o banco de dados
include '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Usa o nome de usuário diretamente da sessão
    $usuario = $_SESSION['name'] ?? null; // Ajusta de acordo com a sua variável de sessão
    $atividade = $_POST['atividade'] ?? null;
    $acertos = $_POST['acertos'] ?? null;
    $erros = $_POST['erros'] ?? null;
    $pontuacao = $_POST['pontuacao'] ?? null;

    if ($usuario && $atividade !== null && $acertos !== null && $erros !== null && $pontuacao !== null) {
        // Inserir no banco de dados
        $query = "INSERT INTO pontuacaoVeroFalso (usuario, atividade, acertos, erros, pontuacao) VALUES (?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("ssiii", $usuario, $atividade, $acertos, $erros, $pontuacao);
            if ($stmt->execute()) {
                echo 'Pontuação salva com sucesso!'; // Resposta positiva
            } else {
                echo 'Erro ao salvar pontuação: ' . $conn->error; // Mensagem de erro
            }
            $stmt->close();
        } else {
            echo 'Erro na preparação da consulta: ' . $conn->error;
        }
    } else {
        echo 'Dados inválidos recebidos.';
    }
} else {
    echo 'Método de requisição inválido.';
}
$conn->close();
?>
