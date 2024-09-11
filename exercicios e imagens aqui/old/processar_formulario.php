<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclua o arquivo de configuração
require 'config.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $status = isset($_POST['status']) ? $_POST['status'] : 'Ativo'; // Define 'Ativo' como padrão

    // Verificar se o e-mail já existe
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Se o e-mail já existe, redirecionar de volta ao formulário com uma mensagem de erro
        header("Location: page2.php?error=email_exists");
        exit();
    } else {
        // Se o e-mail não existe, proceder com a inserção
        $sql = "INSERT INTO usuarios (name, email, password, phone, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $password, $phone, $status);

        if ($stmt->execute()) {
            // Redirecionar para uma página de sucesso
            header("Location: sucesso.php");
            exit();
        } else {
            echo "Erro: " . $stmt->error;
        }
    }
    
    // Fecha a declaração e a conexão
    $stmt->close();
    $conn->close();
}
?>
