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

