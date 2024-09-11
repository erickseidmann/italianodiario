<?php
require '../../config/config.php';

// Consulta para obter os alunos cadastrados
$sql = "SELECT id, name, email, phone, status FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html  >
<head>
  

  
  
  

  <title>Alunos Cadastrados</title>

  <?php
// Inclui o arquivo de cabeçalho localizado na pasta 'comun'
include '../comun/headeradm.php';
?>
  <style>
        .table {
            color: white !important; /* Cor do texto branco com !important para garantir precedência */
            font-weight: bold; /* Texto em negrito */
        }
        .table th, .table td {
            background-color: #333; /* Cor de fundo para melhorar a legibilidade */
            padding: 10px;
        }
        .table th {
            background-color: #555; /* Cor de fundo para cabeçalhos */
        }
    
        .search-bar {
            margin-bottom: 20px; /* Espaçamento abaixo da barra de pesquisa */
        }
        label {
            font-size: 25px;
            font-weight: bold; /* Negrito */
            color: white; /* Texto branco para os labels */
        }
    </style>
  
  
</head>
<body>
  


<section data-bs-version="5.1" class="list04 markm5 cid-umb09qvwjK" id="list04-1z">
    

    
    

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-wrapper">
                    <h2 class="mbr-section-title mbr-fonts-style display-2">
                        Usuários Registrados</h2>
                </div>
                <div id="bootstrap-accordion_2" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">
                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne">
                            <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse1_2" aria-expanded="false" aria-controls="collapse1">
                                <h4 class="panel-title-edit mbr-fonts-style display-7">
                                    Ativar ou Inativar Usuário</h4>
                                <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                            </a>
                        </div>
                        <div id="collapse1_2" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_2">
                        <div class="container mt-5">
                            
                        <!-- Campo de pesquisa -->
                        <input type="text" id="searchInput" class="form-control search-bar" onkeyup="filterTable()" placeholder="Pesquise por nomes...">
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Celular</th>
                                    <th>Status</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody id="alunosTable">
                                <?php if ($result->num_rows > 0): ?>
                                    <?php while($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['phone']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td>
                                                <form action="../../models/alterar_status.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <input type="hidden" name="status" value="<?php echo $row['status'] == 'Ativo' ? 'Inativo' : 'Ativo'; ?>">
                                                    <div class="col-30 col-sm-12 col-md-12 col-lg-12">
                                                        <button type="submit" class="btn btn-primary btn-block">
                                                            <!-- Texto completo para telas médias e maiores -->
                                                            <span class="d-none d-md-inline">
                                                                <?php echo $row['status'] == 'Ativo' ? 'Inativar' : 'Ativar'; ?>
                                                            </span>
                                                            <!-- Texto abreviado para telas pequenas -->
                                                            <span class="d-md-none">
                                                                <?php echo $row['status'] == 'Ativo' ? 'I' : 'A'; ?>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6">Nenhum aluno cadastrado.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        </div>
                                </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" role="tab" id="headingTwo">
                            <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse2_2" aria-expanded="false" aria-controls="collapse2">
                                <h4 class="panel-title-edit mbr-fonts-style display-7">
                                    Excluir Usuário</h4>
                                <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                            </a>
                        </div>
                        <div id="collapse2_2" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_2">
                        <div class="table-container">
                        <?php
                                // Executa a consulta SQL novamente para obter novos resultados
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0): ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>E-mail</th>
                                                <th>Celular</th>
                                                <th>Status</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($row = $result->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['phone']; ?></td>
                                                    <td><?php echo $row['status']; ?></td>
                                                    <td>
                                                        <form action="../../models/excluir_usuario.php" method="POST" style="display:inline;">
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                            <button type="submit" class="btn btn-sm btn-danger btn-block">
                                                                <!-- Texto completo para telas médias e maiores -->
                                                                <span class="d-none d-md-inline">Excluir</span>
                                                                <!-- Texto abreviado para telas pequenas -->
                                                                <span class="d-md-none">Exc.</span>
                                                            </button>
                                                        </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                    </div>
                                <?php else: ?>
                                    <p>Nenhum aluno cadastrado.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card" mbr-if="cardAmount > 2">
                        <div class="card-header" role="tab" id="headingThree">
                            <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                <h4 class="panel-title-edit mbr-fonts-style" mbr-theme-style="display-7" data-app-selector=".panel-title-edit">Editar&nbsp; Blog</h4>
                                <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                            </a>
                        </div>
                        <div id="collapse3" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion" data-bs-parent="#accordion">
                            <div class="panel-body">
                            <div class="container mt-5">
                                
                                <form action="../../models/submitBlog.php" method="POST" enctype="multipart/form-data">
                                    <!-- Título 1 -->
                                    <div class="form-group">
                                        <label for="titulo1">Título 1 (máximo 32 caracteres):</label>
                                        <input type="text" class="form-control" id="titulo1" name="titulo1" maxlength="32" required>
                                    </div>

                                    <!-- Texto 1 -->
                                    <div class="form-group">
                                        <label for="texto1">Texto 1 (máximo 430 caracteres):</label>
                                        <textarea class="form-control" id="texto1" name="texto1" maxlength="430" rows="3" required></textarea>
                                    </div>

                                    <!-- Link do vídeo do YouTube -->
                                    <div class="form-group">
                                        <label for="linkVideo">Link do vídeo do YouTube:</label>
                                        <input type="url" class="form-control" id="linkVideo" name="linkVideo" required>
                                    </div>

                                    <!-- Título 2 -->
                                    <div class="form-group">
                                        <label for="titulo2">Título 2 (máximo 15 caracteres):</label>
                                        <input type="text" class="form-control" id="titulo2" name="titulo2" maxlength="15" required>
                                    </div>

                                    <!-- Texto 2 Parágrafo 1 -->
                                    <div class="form-group">
                                        <label for="texto2p1">Texto 2 Parágrafo 1 (máximo 150 caracteres):</label>
                                        <textarea class="form-control" id="texto2p1" name="texto2p1" maxlength="150" rows="2" required></textarea>
                                    </div>

                                    <!-- Texto 2 Parágrafo 2 -->
                                    <div class="form-group">
                                        <label for="texto2p2">Texto 2 Parágrafo 2 (máximo 150 caracteres):</label>
                                        <textarea class="form-control" id="texto2p2" name="texto2p2" maxlength="150" rows="2" required></textarea>
                                    </div>

                                    <!-- Texto 2 Parágrafo 3 -->
                                    <div class="form-group">
                                        <label for="texto2p3">Texto 2 Parágrafo 3 (máximo 150 caracteres):</label>
                                        <textarea class="form-control" id="texto2p3" name="texto2p3" maxlength="150" rows="2" required></textarea>
                                    </div>

                                    <!-- Adicionar imagem -->
                                    <div class="form-group">
                                        <label for="imagem">Adicionar imagem:</label>
                                        <input type="file" class="form-control-file" id="imagem" name="imagem" accept="image/*">
                                    </div>

                                    <!-- Título Comentários -->
                                    <div class="form-group">
                                        <label for="tituloComentarios">Título Comentários (máximo 150 caracteres):</label>
                                        <textarea class="form-control" id="tituloComentarios" name="tituloComentarios" maxlength="150" rows="2" required></textarea>
                                    </div>

                                    <!-- Comentário 1 -->
                                    <div class="form-group">
                                        <label for="comentario1">Comentário 1 (máximo 187 caracteres):</label>
                                        <textarea class="form-control" id="comentario1" name="comentario1" maxlength="187" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fotoComentario1">Foto Comentário 1:</label>
                                        <input type="file" class="form-control-file" id="fotoComentario1" name="fotoComentario1" accept="image/*" >
                                    </div>

                                    <!-- Comentário 2 -->
                                    <div class="form-group">
                                        <label for="comentario2">Comentário 2 (máximo 187 caracteres):</label>
                                        <textarea class="form-control" id="comentario2" name="comentario2" maxlength="187" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fotoComentario2">Foto Comentário 2:</label>
                                        <input type="file" class="form-control-file" id="fotoComentario2" name="fotoComentario2" accept="image/*" >
                                    </div>

                                    <!-- Comentário 3 -->
                                    <div class="form-group">
                                        <label for="comentario3">Comentário 3 (máximo 187 caracteres):</label>
                                        <textarea class="form-control" id="comentario3" name="comentario3" maxlength="187" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fotoComentario3">Foto Comentário 3:</label>
                                        <input type="file" class="form-control-file" id="fotoComentario3" name="fotoComentario3" accept="image/*" >
                                    </div>

                                    <!-- Comentário 4 -->
                                    <div class="form-group">
                                        <label for="comentario4">Comentário 4 (máximo 187 caracteres):</label>
                                        <textarea class="form-control" id="comentario4" name="comentario4" maxlength="187" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fotoComentario4">Foto Comentário 4:</label>
                                        <input type="file" class="form-control-file" id="fotoComentario4" name="fotoComentario4" accept="image/*" >
                                    </div>

                                    <!-- Comentário 5 -->
                                    <div class="form-group">
                                        <label for="comentario5">Comentário 5 (máximo 187 caracteres):</label>
                                        <textarea class="form-control" id="comentario5" name="comentario5" maxlength="187" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fotoComentario5">Foto Comentário 5:</label>
                                        <input type="file" class="form-control-file" id="fotoComentario5" name="fotoComentario5" accept="image/*"> 
                                    </div>

                                    <!-- Comentário 6 -->
                                    <div class="form-group">
                                        <label for="comentario6">Comentário 6 (máximo 187 caracteres):</label>
                                        <textarea class="form-control" id="comentario6" name="comentario6" maxlength="187" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fotoComentario6">Foto Comentário 6:</label>
                                        <input type="file" class="form-control-file" id="fotoComentario6" name="fotoComentario6" accept="image/*" >
                                    </div>

                                    <!-- Título Galeria -->
                                    <div class="form-group">
                                        <label for="tituloGaleria">Título Galeria (máximo 20 caracteres):</label>
                                        <input type="text" class="form-control" id="tituloGaleria" name="tituloGaleria" maxlength="20" required>
                                    </div>

                                    <!-- Sub Título Galeria -->
                                    <div class="form-group">
                                        <label for="subTituloGaleria">Sub Título Galeria (máximo 25 caracteres):</label>
                                        <input type="text" class="form-control" id="subTituloGaleria" name="subTituloGaleria" maxlength="25" required>
                                    </div>

                                    <!-- Imagem 1 da Galeria -->
                                    <div class="form-group">
                                        <label for="imagemGaleria1">Imagem 1 da Galeria:</label>
                                        <input type="file" class="form-control-file" id="imagemGaleria1" name="imagemGaleria1" accept="image/*" >
                                    </div>

                                    <!-- Imagem 2 da Galeria -->
                                    <div class="form-group">
                                        <label for="imagemGaleria2">Imagem 2 da Galeria:</label>
                                        <input type="file" class="form-control-file" id="imagemGaleria2" name="imagemGaleria2" accept="image/*" >
                                    </div>

                                    <!-- Imagem 3 da Galeria -->
                                    <div class="form-group">
                                        <label for="imagemGaleria3">Imagem 3 da Galeria:</label>
                                        <input type="file" class="form-control-file" id="imagemGaleria3" name="imagemGaleria3" accept="image/*" >
                                    </div>

                                    <!-- Imagem 4 da Galeria -->
                                    <div class="form-group">
                                        <label for="imagemGaleria4">Imagem 4 da Galeria:</label>
                                        <input type="file" class="form-control-file" id="imagemGaleria4" name="imagemGaleria4" accept="image/*" >
                                    </div>

                                    <!-- Imagem 5 da Galeria -->
                                    <div class="form-group">
                                        <label for="imagemGaleria5">Imagem 5 da Galeria:</label>
                                        <input type="file" class="form-control-file" id="imagemGaleria5" name="imagemGaleria5" accept="image/*">
                                    </div>

                                    <!-- Imagem 6 da Galeria -->
                                    <div class="form-group">
                                        <label for="imagemGaleria6">Imagem 6 da Galeria:</label>
                                        <input type="file" class="form-control-file" id="imagemGaleria6" name="imagemGaleria6" accept="image/*" >
                                    </div>

                                    <!-- Imagem 7 da Galeria -->
                                    <div class="form-group">
                                        <label for="imagemGaleria7">Imagem 7 da Galeria:</label>
                                        <input type="file" class="form-control-file" id="imagemGaleria7" name="imagemGaleria7" accept="image/*" >
                                    </div>

                                    <!-- Botão de Enviar -->
                                    <button type="submit" class="btn btn-primary btn-block" value="Enviar">Enviar</button>
                                </form>
                                
                            </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>

<?php
//rodapé
include '../comun/footer.php';
?>
   <!-- Script JavaScript para a barra de pesquisa -->
   <script>
// JavaScript para filtrar a tabela com base na entrada do usuário
document.getElementById('searchInput').addEventListener('keyup', function() {
    let input = this.value.toLowerCase();
    let rows = document.querySelectorAll('#alunosTable tr');

    rows.forEach(row => {
        let name = row.cells[1].textContent.toLowerCase();
        if (name.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>

<?php
$conn->close();
?>
  
</body>
</html>

