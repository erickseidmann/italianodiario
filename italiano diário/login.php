<?php
// Conexão com o banco de dados
require 'config.php';

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se os campos foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Sanitiza as entradas para evitar SQL Injection
    $email = $conn->real_escape_string($email);

    // Consulta no banco de dados para encontrar o usuário pelo email
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verifica se a senha fornecida corresponde ao hash armazenado
        if (password_verify($senha, $row['password'])) {
            // Login bem-sucedido
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("Location: page4.php");
            exit;
        } else {
            // Senha incorreta
            echo "E-mail ou senha incorretos.";
        }
    } else {
        // E-mail não encontrado
        echo "E-mail ou senha incorretos.";
    }
}

// Fecha a conexão
$conn->close();
?>
