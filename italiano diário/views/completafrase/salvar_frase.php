<?php
// Incluir configuração de banco de dados
include '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $atividade_id = $_POST['atividade_id'];
    $exercicio_numero = $_POST['exercicio_numero'];
    $frase = $_POST['frase'];
    $palavra_oculta = $_POST['palavra_oculta'];

    // Função para salvar a frase no banco
    function salvarFraseNoBanco($atividadeId, $exercicioNumero, $frase, $palavraOculta) {
        include '../../config/config.php';

        $sql = "INSERT INTO atividades_frases (atividade_id, exercicio_numero, frase, palavra_oculta)
                VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("iiss", $atividadeId, $exercicioNumero, $frase, $palavraOculta);

            if ($stmt->execute()) {
                return true;
            } else {
                echo "Erro ao salvar a frase: " . $stmt->error;
            }
        } else {
            echo "Erro ao preparar a consulta: " . $conn->error;
        }

        $stmt->close();
        $conn->close();

        return false;
    }

    if (salvarFraseNoBanco($atividade_id, $exercicio_numero, $frase, $palavra_oculta)) {
        echo "Frase salva com sucesso!";
    } else {
        echo "Erro ao salvar a frase.";
    }
}
?>
