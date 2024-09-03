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

    // Verifica se é o login de administrador
    if ($email === 'ADM@adm.com' && $senha === 'italiano@2024') {
        // Login de administrador bem-sucedido
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = 'admin'; // Definir o papel do usuário como administrador
        header("Location: page10.php");
        exit;
    } else {
        // Prepara a declaração SQL para evitar SQL Injection
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // Verifica se a senha fornecida corresponde ao hash armazenado
            if (password_verify($senha, $row['password'])) {
                // Login bem-sucedido
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $row['name']; // Armazena o nome do usuário na sessão
                header("Location: page4.php");
                exit;
            } else {
                // Senha incorreta
                header("Location: page3.html?error=1");
                exit;
            }
        } else {
            // E-mail não encontrado
            header("Location: page3.html?error=1");
            exit;
        }

        // Fecha a declaração preparada
        $stmt->close();
    }
}

// Fecha a conexão
$conn->close();
?>
