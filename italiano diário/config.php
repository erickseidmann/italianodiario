<?php
 //Configurações de conexão com o banco de dados
//$servername = "localhost"; // ou 127.0.0.1
//$username = "root"; // Nome de usuário do MySQL
//$password = ""; // Senha do MySQL (deixe vazio se não houver senha)
//$dbname = "italiano_diario"; // Nome do banco de dados

$servername = "localhost"; // ou 127.0.0.1
$username = "italiano_italiano"; // Nome de usuário do MySQL
$password = "g*x@Qb{S_WUj"; // Senha do MySQL (deixe vazio se não houver senha)
$dbname = "italiano_diario"; // Nome do banco de dados


// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
