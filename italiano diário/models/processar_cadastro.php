<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../config/config.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $status = isset($_POST['status']) ? $_POST['status'] : 'Ativo';

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location:../views/cadastro/index.php?error=email_exists");
        exit();
    } else {
        $sql = "INSERT INTO usuarios (name, email, password, phone, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $password, $phone, $status);

        if ($stmt->execute()) {
            // Configura e envia o e-mail usando PHPMailer
            $mail = new PHPMailer(true);
            try {
                // Configurações do servidor SMTP
                $mail->isSMTP();
                $mail->Host = 'mail.italianodiario.com'; // Servidor SMTP
                $mail->SMTPAuth = true;
                $mail->Username = 'atendimento@italianodiario.com'; // Seu e-mail SMTP
                $mail->Password = 'italianodiario@2024'; // Sua senha SMTP
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // E-mail de boas-vindas para o usuário
                $mail->setFrom('atendimento@italianodiario.com', 'Italiano Diário');
                $mail->addAddress($email, $name);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = "Bem-vindo ao Italiano Diário!";
                $mail->Body = "Olá, $name!\n\nBem-vindo ao Italiano Diário! Estamos felizes por tê-lo conosco.\n\nAtenciosamente,\nEquipe Italiano Diário";
                $mail->send();

                // Enviar notificação para o atendimento
                $mail->clearAddresses();
                $mail->addAddress('atendimento@italianodiario.com');
                $mail->CharSet = 'UTF-8'; // Define a codificação para UTF-8
                $mail->Subject = 'Novo cadastro no Italiano Diario';
                $mail->Body = "O usuário $name se cadastrou com o e-mail $email.";
                $mail->send();

                header("Location:../views/cadastro/sucesso.php");
                exit();
            } catch (Exception $e) {
                echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
            }
        } else {
            echo "Erro: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>
