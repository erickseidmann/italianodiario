<?php
require 'config.php';

// Consulta para obter os alunos cadastrados
$sql = "SELECT id, name, email, phone, status FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html  >
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/ita-206x116.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  

  <title>Alunos Cadastrados</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Brygada+1918:wght@400;700&display=swap&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Brygada+1918:wght@400;700&display=swap&display=swap"></noscript>
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css?v=SHCzis"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css?v=SHCzis" type="text/css">

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
  
  <section data-bs-version="5.1" class="menu menu2 cid-umaZ3BkthX" once="menu" id="menu02-1t">
	

	<nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
		<div class="container">
			<div class="navbar-brand">
				<span class="navbar-logo">
					<a href="#">
						<img src="assets/images/ita-206x116.png" alt="" style="height: 4.3rem;">
					</a>
				</span>
				<span class="navbar-caption-wrap"><a class="navbar-caption text-black display-4" href="#">Italiano Diário</a></span>
			</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<div class="hamburger">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav nav-dropdown" data-app-modern-menu="true"><li class="nav-item">
						<a class="nav-link link text-black text-primary display-4" href="index.html">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link link text-black text-primary display-4" href="page1.html" aria-expanded="false">Blog</a>
					</li>
					<li class="nav-item">
						<a class="nav-link link text-black text-primary display-4" href="page2.html">Cadastrar</a>
					</li></ul>
				
				<div class="navbar-buttons mbr-section-btn"><a class="btn btn-primary display-4" href="page3.html">Login</a></div>
			</div>
		</div>
	</nav>
</section>

<section data-bs-version="5.1" class="header1 cid-umaZ3BIyGc" id="header1-1u">
    

    
    

    <div>
        <div class="row flex-row-reverse">
            <div class="col-12 col-lg-6 col-md-6 image">
                <div class="image-wrapper">
                    <img src="assets/images/754a4f77-f595-4264-b1b0-32ea701d61ed-675x1200.jpg" alt="">
                </div>
            </div>
            <div class="col-12 col-lg-6 col-md-6 title">
                <div class="title-wrapper">
                    <h2 class="mbr-section-title mbr-fonts-style display-1"><strong>Gestione
</strong><div><strong>Di
</strong></div><div><strong>studenti</strong></div></h2>
                    
                </div>
            </div>
        </div>
    </div>
</section>

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
                                                <form action="alterar_status.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <input type="hidden" name="status" value="<?php echo $row['status'] == 'Ativo' ? 'Inativo' : 'Ativo'; ?>">
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <?php echo $row['status'] == 'Ativo' ? 'Inativar' : 'Ativar'; ?>
                                                    </button>
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
                                                        <form action="excluir_usuario.php" method="POST" style="display:inline;">
                                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
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
                                
                                <form action="submitBlog.php" method="POST" enctype="multipart/form-data">
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
                                        <input type="file" class="form-control-file" id="imagem" name="imagem" accept="image/*" required>
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
                                        <input type="file" class="form-control-file" id="fotoComentario1" name="fotoComentario1" accept="image/*" required>
                                    </div>

                                    <!-- Comentário 2 -->
                                    <div class="form-group">
                                        <label for="comentario2">Comentário 2 (máximo 187 caracteres):</label>
                                        <textarea class="form-control" id="comentario2" name="comentario2" maxlength="187" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fotoComentario2">Foto Comentário 2:</label>
                                        <input type="file" class="form-control-file" id="fotoComentario2" name="fotoComentario2" accept="image/*" required>
                                    </div>

                                    <!-- Comentário 3 -->
                                    <div class="form-group">
                                        <label for="comentario3">Comentário 3 (máximo 187 caracteres):</label>
                                        <textarea class="form-control" id="comentario3" name="comentario3" maxlength="187" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fotoComentario3">Foto Comentário 3:</label>
                                        <input type="file" class="form-control-file" id="fotoComentario3" name="fotoComentario3" accept="image/*" required>
                                    </div>

                                    <!-- Comentário 4 -->
                                    <div class="form-group">
                                        <label for="comentario4">Comentário 4 (máximo 187 caracteres):</label>
                                        <textarea class="form-control" id="comentario4" name="comentario4" maxlength="187" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fotoComentario4">Foto Comentário 4:</label>
                                        <input type="file" class="form-control-file" id="fotoComentario4" name="fotoComentario4" accept="image/*" required>
                                    </div>

                                    <!-- Comentário 5 -->
                                    <div class="form-group">
                                        <label for="comentario5">Comentário 5 (máximo 187 caracteres):</label>
                                        <textarea class="form-control" id="comentario5" name="comentario5" maxlength="187" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fotoComentario5">Foto Comentário 5:</label>
                                        <input type="file" class="form-control-file" id="fotoComentario5" name="fotoComentario5" accept="image/*" required>
                                    </div>

                                    <!-- Comentário 6 -->
                                    <div class="form-group">
                                        <label for="comentario6">Comentário 6 (máximo 187 caracteres):</label>
                                        <textarea class="form-control" id="comentario6" name="comentario6" maxlength="187" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fotoComentario6">Foto Comentário 6:</label>
                                        <input type="file" class="form-control-file" id="fotoComentario6" name="fotoComentario6" accept="image/*" required>
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
                                        <input type="file" class="form-control-file" id="imagemGaleria1" name="imagemGaleria1" accept="image/*" required>
                                    </div>

                                    <!-- Imagem 2 da Galeria -->
                                    <div class="form-group">
                                        <label for="imagemGaleria2">Imagem 2 da Galeria:</label>
                                        <input type="file" class="form-control-file" id="imagemGaleria2" name="imagemGaleria2" accept="image/*" required>
                                    </div>

                                    <!-- Imagem 3 da Galeria -->
                                    <div class="form-group">
                                        <label for="imagemGaleria3">Imagem 3 da Galeria:</label>
                                        <input type="file" class="form-control-file" id="imagemGaleria3" name="imagemGaleria3" accept="image/*" required>
                                    </div>

                                    <!-- Imagem 4 da Galeria -->
                                    <div class="form-group">
                                        <label for="imagemGaleria4">Imagem 4 da Galeria:</label>
                                        <input type="file" class="form-control-file" id="imagemGaleria4" name="imagemGaleria4" accept="image/*" required>
                                    </div>

                                    <!-- Imagem 5 da Galeria -->
                                    <div class="form-group">
                                        <label for="imagemGaleria5">Imagem 5 da Galeria:</label>
                                        <input type="file" class="form-control-file" id="imagemGaleria5" name="imagemGaleria5" accept="image/*" required>
                                    </div>

                                    <!-- Imagem 6 da Galeria -->
                                    <div class="form-group">
                                        <label for="imagemGaleria6">Imagem 6 da Galeria:</label>
                                        <input type="file" class="form-control-file" id="imagemGaleria6" name="imagemGaleria6" accept="image/*" required>
                                    </div>

                                    <!-- Imagem 7 da Galeria -->
                                    <div class="form-group">
                                        <label for="imagemGaleria7">Imagem 7 da Galeria:</label>
                                        <input type="file" class="form-control-file" id="imagemGaleria7" name="imagemGaleria7" accept="image/*" required>
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

<section data-bs-version="5.1" class="footer3 cid-umaZ3CTudk" once="footers" id="footer03-1x">

        

    

    <div class="container">
        <div class="row">
            <div class="row-links">
                <ul class="header-menu">
                  
                  
                    
                  
                  
                <li class="header-menu-item mbr-fonts-style display-5">
                    <a href="#" class="text-white">Home</a>
                  </li><li class="header-menu-item mbr-fonts-style display-5">
                    <a href="#" class="text-white">Blog</a>
                  </li><li class="header-menu-item mbr-fonts-style display-5">
                    <a href="#" class="text-white">Login</a>
                  </li><li class="header-menu-item mbr-fonts-style display-5"><a href="#" class="text-white">Cadastro</a></li></ul>
              </div>

            
            <div class="col-12 mt-4">
                <p class="mbr-fonts-style copyright display-7">© 2024 Italiano Diario. Tutti i diritti riservati.</p>
            </div>
        </div>
    </div>
</section>



<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/ytplayer/index.js"></script>
  <script src="assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="assets/mbr-switch-arrow/mbr-switch-arrow.js"></script>
  <script src="assets/theme/js/script.js"></script>
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

