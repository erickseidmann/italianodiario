<?php

echo "O formulário foi enviado."; // Adicione esta linha para verificar

// Inclua o arquivo de configuração
require 'config.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    
    // Prepara a consulta para inserir os dados no banco de dados
    $stmt = $conn->prepare("INSERT INTO usuarios (name, email, password, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $phone);

    // Executa a consulta
    if ($stmt->execute()) {
        // Redireciona para a página de sucesso
        header("Location: sucesso.html");
        exit();
    } else {
        // Exibe mensagem de erro para depuração
        echo "Erro: " . $stmt->error;
    }
    
    // Fecha a declaração e a conexão
    $stmt->close();
    $conn->close();
}
?>
