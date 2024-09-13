<?php
// Conectar ao banco de dados
include '../../config/config.php'; // Seu arquivo de conexão com o MySQL

// Receber os dados enviados via POST
$data = json_decode(file_get_contents('php://input'), true);

// Verificar se os dados foram recebidos
if ($data) {
    // Loop para salvar cada palavra no banco de dados
    foreach ($data as $word) {
        $singular = $word['singular'];

        // Preparar e executar a inserção
        $stmt = $conn->prepare("INSERT INTO palavras_singular (singular) VALUES (?)");
        $stmt->bind_param("s", $singular);
        $stmt->execute();
    }

    echo "Palavras salvas com sucesso!";
} else {
    echo "Nenhuma palavra recebida.";
}

// Fechar a conexão
$conn->close();
?>
