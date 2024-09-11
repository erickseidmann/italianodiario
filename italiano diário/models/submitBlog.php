<?php
// Conectar ao banco de dados
require '../config/config.php';

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo1 = isset($_POST['titulo1']) ? $_POST['titulo1'] : '';
    $texto1 = isset($_POST['texto1']) ? $_POST['texto1'] : '';
    $linkVideo = isset($_POST['linkVideo']) ? $_POST['linkVideo'] : '';
    $titulo2 = isset($_POST['titulo2']) ? $_POST['titulo2'] : '';
    $texto2p1 = isset($_POST['texto2p1']) ? $_POST['texto2p1'] : '';
    $texto2p2 = isset($_POST['texto2p2']) ? $_POST['texto2p2'] : '';
    $texto2p3 = isset($_POST['texto2p3']) ? $_POST['texto2p3'] : '';
    $tituloComentarios = isset($_POST['tituloComentarios']) ? $_POST['tituloComentarios'] : '';
    $comentario1 = isset($_POST['comentario1']) ? $_POST['comentario1'] : '';
    $comentario2 = isset($_POST['comentario2']) ? $_POST['comentario2'] : '';
    $comentario3 = isset($_POST['comentario3']) ? $_POST['comentario3'] : '';
    $comentario4 = isset($_POST['comentario4']) ? $_POST['comentario4'] : '';
    $comentario5 = isset($_POST['comentario5']) ? $_POST['comentario5'] : '';
    $comentario6 = isset($_POST['comentario6']) ? $_POST['comentario6'] : '';
    $tituloGaleria = isset($_POST['tituloGaleria']) ? $_POST['tituloGaleria'] : '';
    $subTituloGaleria = isset($_POST['subTituloGaleria']) ? $_POST['subTituloGaleria'] : '';

    // Upload das imagens
    $imagem = isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['imagem']['tmp_name'])) : null;
    $fotoComentario1 = isset($_FILES['fotoComentario1']) && $_FILES['fotoComentario1']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['fotoComentario1']['tmp_name'])) : null;
    $fotoComentario2 = isset($_FILES['fotoComentario2']) && $_FILES['fotoComentario2']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['fotoComentario2']['tmp_name'])) : null;
    $fotoComentario3 = isset($_FILES['fotoComentario3']) && $_FILES['fotoComentario3']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['fotoComentario3']['tmp_name'])) : null;
    $fotoComentario4 = isset($_FILES['fotoComentario4']) && $_FILES['fotoComentario4']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['fotoComentario4']['tmp_name'])) : null;
    $fotoComentario5 = isset($_FILES['fotoComentario5']) && $_FILES['fotoComentario5']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['fotoComentario5']['tmp_name'])) : null;
    $fotoComentario6 = isset($_FILES['fotoComentario6']) && $_FILES['fotoComentario6']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['fotoComentario6']['tmp_name'])) : null;
    $imagemGaleria1 = isset($_FILES['imagemGaleria1']) && $_FILES['imagemGaleria1']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['imagemGaleria1']['tmp_name'])) : null;
    $imagemGaleria2 = isset($_FILES['imagemGaleria2']) && $_FILES['imagemGaleria2']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['imagemGaleria2']['tmp_name'])) : null;
    $imagemGaleria3 = isset($_FILES['imagemGaleria3']) && $_FILES['imagemGaleria3']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['imagemGaleria3']['tmp_name'])) : null;
    $imagemGaleria4 = isset($_FILES['imagemGaleria4']) && $_FILES['imagemGaleria4']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['imagemGaleria4']['tmp_name'])) : null;
    $imagemGaleria5 = isset($_FILES['imagemGaleria5']) && $_FILES['imagemGaleria5']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['imagemGaleria5']['tmp_name'])) : null;
    $imagemGaleria6 = isset($_FILES['imagemGaleria6']) && $_FILES['imagemGaleria6']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['imagemGaleria6']['tmp_name'])) : null;
    $imagemGaleria7 = isset($_FILES['imagemGaleria7']) && $_FILES['imagemGaleria7']['error'] == UPLOAD_ERR_OK ? addslashes(file_get_contents($_FILES['imagemGaleria7']['tmp_name'])) : null;

    // Usar prepared statements para inserir dados no banco de dados
    $stmt = $conn->prepare("INSERT INTO infoBlog (titulo1, texto1, linkVideo, titulo2, texto2p1, texto2p2, texto2p3, imagem, 
                            tituloComentarios, comentario1, fotoComentario1, comentario2, fotoComentario2, comentario3, 
                            fotoComentario3, comentario4, fotoComentario4, comentario5, fotoComentario5, comentario6, 
                            fotoComentario6, tituloGaleria, subTituloGaleria, imagemGaleria1, imagemGaleria2, imagemGaleria3, 
                            imagemGaleria4, imagemGaleria5, imagemGaleria6, imagemGaleria7) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssssssssssssssssssssssss", 
        $titulo1, $texto1, $linkVideo, $titulo2, $texto2p1, $texto2p2, $texto2p3, $imagem, 
        $tituloComentarios, $comentario1, $fotoComentario1, $comentario2, $fotoComentario2, $comentario3, 
        $fotoComentario3, $comentario4, $fotoComentario4, $comentario5, $fotoComentario5, $comentario6, 
        $fotoComentario6, $tituloGaleria, $subTituloGaleria, $imagemGaleria1, $imagemGaleria2, $imagemGaleria3, 
        $imagemGaleria4, $imagemGaleria5, $imagemGaleria6, $imagemGaleria7);

    if ($stmt->execute()) {
        echo "<script>
                alert('Dados enviados com sucesso!');
                window.location.href = '../views/adm/index.php';
              </script>";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
