<?php
// Conectar ao banco de dados
include('conexao.php'); // Arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fraseId = $_POST['fraseId'];  // ID da frase enviada pelo AJAX
    $respostaUsuario = $_POST['resposta'];  // Resposta ('V' ou 'F')

    // Buscar a resposta correta no banco de dados
    $query = $pdo->prepare("SELECT correta, explicacao FROM frases WHERE id = :id");
    $query->bindParam(':id', $fraseId, PDO::PARAM_INT);
    $query->execute();
    $frase = $query->fetch(PDO::FETCH_ASSOC);

    if ($frase) {
        $respostaCorreta = $frase['correta'];

        // Verifica se a resposta do usuário está correta
        $correto = $respostaUsuario === $respostaCorreta;

        // Retorna o resultado em formato JSON
        echo json_encode([
            'correto' => $correto,
            'resposta_correta' => $respostaCorreta,
            'explicacao' => $frase['explicacao']
        ]);
    } else {
        // Erro: frase não encontrada
        echo json_encode(['error' => 'Frase não encontrada.']);
    }
}
?>
