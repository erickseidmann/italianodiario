<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

// Conteúdo do painel do aluno
echo "Bem-vindo ao seu painel, " . $_SESSION['email'] . "!";
?>
