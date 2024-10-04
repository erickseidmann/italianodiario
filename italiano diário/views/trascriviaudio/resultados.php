<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login/");
    exit;
}

// Conectar ao banco de dados
include '../../config/config.php';

// Consulta para obter os resultados das atividades
$sql = "SELECT user_name, atividade_id, corretas, erradas, pontuacao, data FROM resultados_atividades ORDER BY data DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultados das Atividades</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Resultados das Atividades</h1>
    <table>
        <thead>
            <tr>
                <th>Nome do Usuário</th>
                <th>ID da Atividade</th>
                <th>Corretas</th>
                <th>Erradas</th>
                <th>Pontuação</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['user_name'], ENT_QUOTES); ?></td>
                        <td><?php echo $row['atividade_id']; ?></td>
                        <td><?php echo $row['corretas']; ?></td>
                        <td><?php echo $row['erradas']; ?></td>
                        <td><?php echo $row['pontuacao']; ?></td>
                        <td><?php echo (new DateTime($row['data']))->format('d-m-y H:i'); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhum resultado encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>





