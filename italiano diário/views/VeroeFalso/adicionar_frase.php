<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login/");
    exit;
}

include '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receber a frase, explicação e ID da atividade
    $frase = trim($_POST['frase']);
    $explicacao = trim($_POST['explicacao']);
    $correta = $_POST['correta'] === 'V' ? 1 : 0;  // V para verdadeiro, F para falso
    $atividade_id = isset($_POST['atividade_id']) ? intval($_POST['atividade_id']) : 0; // ID da atividade

    // Verificar se o ID da atividade é válido
    if ($atividade_id > 0) {
        // Verificar e remover o sufixo da frase se houver
        if (preg_match('/ - [VF]$/', $frase)) {
            $correta = substr($frase, -1) === 'V' ? 1 : 0;
            $frase = substr($frase, 0, -4);  // Remove o " - V" ou " - F" do final da frase
        }

        // Inserir a nova frase no banco de dados
        $sql = "INSERT INTO frases (frase, explicacao, correta, atividade_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $frase, $explicacao, $correta, $atividade_id);

        if ($stmt->execute()) {
            echo "Frase adicionada com sucesso!";
        } else {
            echo "Erro ao adicionar a frase.";
        }

        $stmt->close();
    } else {
        echo "ID da atividade inválido.";
    }

    $conn->close();
}
?>
