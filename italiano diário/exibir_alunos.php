<?php
require 'config.php';

// Consulta para obter os alunos cadastrados
$sql = "SELECT id, name, email, phone, status FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/ita-206x116.png" type="image/x-icon">
  <meta name="description" content="Immerse yourself in the Italian language and culture with our influencer who lived and learned in Italy. Discover the joy of learning Italian through real-life experiences.">
  
    <title>Lista de Alunos</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Brygada+1918:wght@400;700&display=swap&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Brygada+1918:wght@400;700&display=swap&display=swap"></noscript>
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css?v=RFKxCp"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css?v=RFKxCp" type="text/css">
</head>
<body>
<section data-bs-version="5.1" class="menu menu2 cid-uiYScPqB05" once="menu" id="menu02-j">
	

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
						<a class="nav-link link text-black text-primary display-4" href="page1.php" aria-expanded="false">Blog</a>
					</li>
					<li class="nav-item">
						<a class="nav-link link text-black text-primary display-4" href="page2.html">Cadastrar</a>
					</li></ul>
				
				<div class="navbar-buttons mbr-section-btn"><a class="btn btn-primary display-4" href="page3.html">Login</a></div>
			</div>
		</div>
	</nav>
</section>

<section data-bs-version="5.1" class="header18 cid-uiYWL8R41F" data-bg-video="https://www.youtube.com/watch?v=uCVOwkyXhWI" id="header18-n">
  

  <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(0, 0, 0);"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="content-wrap col-12 col-md-12">
        
        
        
        
      </div>
    </div>
  </div>
</section>
    <div class="container mt-5">
        <h2 class="mb-4">Alunos Cadastrados</h2>
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
</body>
</html>

<?php
$conn->close();
?>
