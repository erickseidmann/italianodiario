<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

// Conteúdo do painel do aluno
echo "Bem-vindo ao seu painel, " . $_SESSION['name'] . "!";
?>
<!DOCTYPE html>
<html  >
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/ita-206x116.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>Dashbord</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Brygada+1918:wght@400;700&display=swap&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Brygada+1918:wght@400;700&display=swap&display=swap"></noscript>
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css?v=Xv8i78"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css?v=Xv8i78" type="text/css">

  
  
  
</head>
<body>
  
  <section data-bs-version="5.1" class="menu menu2 cid-uj12uObUdP" once="menu" id="menu02-w">
	

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
						<a class="nav-link link text-black text-primary display-4" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link link text-black text-primary display-4" href="page1.php" aria-expanded="false">Blog</a>
					</li>
					<li class="nav-item">
						<a class="nav-link link text-black text-primary display-4" href="page2.php">Cadastrar</a>
					</li></ul>
				
				<div class="navbar-buttons mbr-section-btn"><a class="btn btn-primary display-4" href="page3.php">Login</a></div>
			</div>
		</div>
	</nav>
</section>

<section data-bs-version="5.1" class="header1 cid-uj12D9NRil" id="header1-10">
    

    
    

    <div>
        <div class="row flex-row-reverse">
            <div class="col-12 col-lg-6 col-md-6 image">
                <div class="image-wrapper">
                    <img src="assets/images/754a4f77-f595-4264-b1b0-32ea701d61ed-675x1200.jpg" alt="">
                </div>
            </div>
            <div class="col-12 col-lg-6 col-md-6 title">
                <div class="title-wrapper">
                    <h2 class="mbr-section-title mbr-fonts-style display-1"><strong>Hora de </strong><br><strong>praticar</strong></h2>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="gymm5 list1 cid-uj12Ea9EyK" id="list1-11">
    
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-10 m-auto">
                <div class="content">
                    <div class="mbr-section-head align-left mb-5">
                        <h4 class="mbr-section-subtitle mb-2 mbr-fonts-style display-5"><strong>Exercicios</strong></h4>
                        
                    </div>
                    <div id="bootstrap-accordion_29" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">
                        <div class="card mb-3">
                            <div class="card-header" role="tab" id="headingOne">
                                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse1_29" aria-expanded="false" aria-controls="collapse1">

                                    <h6 class="panel-title-edit mbr-semibold mbr-fonts-style mb-0 display-5">Histórico e pontuações</h6>
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </a>
                            </div>
                            <div id="collapse1_29" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_29">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Exercicio</th>
      <th scope="col">Tentativa</th>
      <th scope="col">Pontuação</th>
      <th scope="col">Data</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">plurale</th>
      <td>1</td>
      <td>10</td>
      <td>12/07/24</td>
    </tr>
    <tr>
      <th scope="row">plurale</th>
      <td>2</td>
      <td>12</td>
      <td>12/07/24</td>
    </tr>
    <tr>
      <th scope="row">plurale</th>
      <td>3</td>
      <td>13</td>
      <td>12/07/24</td>
    </tr>
  </tbody>
</table>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header" role="tab" id="headingOne">
                                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse2_29" aria-expanded="false" aria-controls="collapse2">

                                    <h6 class="panel-title-edit mbr-semibold mbr-fonts-style mb-0 display-5">Exercícios disponíveis&nbsp;</h6>
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </a>
                            </div>
                            <div id="collapse2_29" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_29">
                                <div class="panel-body">
                                    <p class="mbr-fonts-style panel-text display-4">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vestibulum
                                        laoreet tincidunt. Proin et sapien scelerisque, ornare lectus eget, iaculis
                                        lectus. Pellentesque viverra molestie tortor. Nunc sed interdum est, in maximus
                                        diam. Donec eu tellus dictum, gravida velit et, sagittis arcu. Proin et lectus
                                        dapibus. Cras fringilla elit velit placerat tortor mollis cursus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header" role="tab" id="headingOne">
                                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse3_29" aria-expanded="false" aria-controls="collapse3">
                                    <h6 class="panel-title-edit mbr-semibold mbr-fonts-style mb-0 display-5">Mauris
                                        porttitor tempor orci vitae?</h6>
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </a>
                            </div>
                            <div id="collapse3_29" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_29">
                                <div class="panel-body">
                                    <p class="mbr-fonts-style panel-text display-4">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vestibulum
                                        laoreet tincidunt. Proin et sapien scelerisque, ornare lectus eget, iaculis
                                        lectus. Pellentesque viverra molestie tortor. Nunc sed interdum est, in maximus
                                        diam. Donec eu tellus dictum, gravida velit et, sagittis arcu. Proin et lectus
                                        dapibus. Cras fringilla elit velit placerat tortor mollis cursus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header" role="tab" id="headingOne">
                                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse4_29" aria-expanded="false" aria-controls="collapse4">
                                    <h6 class="panel-title-edit mbr-semibold mbr-fonts-style mb-0 display-5">Ut ultricies
                                        imperdiet volutpat?</h6>
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </a>
                            </div>
                            <div id="collapse4_29" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_29">
                                <div class="panel-body">
                                    <p class="mbr-fonts-style panel-text display-4">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vestibulum
                                        laoreet tincidunt. Proin et sapien scelerisque, ornare lectus eget, iaculis
                                        lectus. Pellentesque viverra molestie tortor. Nunc sed interdum est, in maximus
                                        diam. Donec eu tellus dictum, gravida velit et, sagittis arcu. Proin et lectus
                                        dapibus. Cras fringilla elit velit placerat tortor mollis cursus.</p>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section data-bs-version="5.1" class="pricing1 cid-uk6A0tj2Ij" id="pricing01-1j">
    
    
    <div class="container">
        <div class="mbr-section-head">
            <h4 class="mbr-section-title mbr-fonts-style align-left mb-0 display-1"><strong>Esercizi</strong></h4>
            
        </div>
        <div class="row mt-4">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="item">
                    <div class="item-head">
                   <h5 class="item-title mbr-fonts-style display-5"><strong>Transforma Questi</strong></h5>
                        
                    </div>
                    <div class="item-content">
                       
                        <p class="mbr-text mbr-fonts-style mt-3 display-7">transforma questi sostantivi al plurale </p>
                        <div class="mbr-section-btn item-footer mt-2"><a href="page5.php" class="btn item-btn btn-lg btn-primary-outline display-7">Iniziare</a></div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-3">
                <div class="item">
                    <div class="item-head">
                   <h5 class="item-title mbr-fonts-style display-5"><strong>Completa le Frasi</strong></h5>
                        
                    </div>
                    <div class="item-content">
                       
                        <p class="mbr-text mbr-fonts-style mt-3 display-7">completa le frasi con il verbo essere </p>
                        <div class="mbr-section-btn item-footer mt-2"><a href="page6.php" class="btn item-btn btn-lg btn-primary-outline display-7">Iniziare</a></div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-3">
                <div class="item">
                    <div class="item-head">
                   <h5 class="item-title mbr-fonts-style display-5"><strong>Scegli tra le Opzioni&nbsp;</strong></h5>
                        
                    </div>
                    <div class="item-content">
                       
                        <p class="mbr-text mbr-fonts-style mt-3 display-7">scegli tra le opzioni quelle giuste&nbsp;</p>
                        <div class="mbr-section-btn item-footer mt-2"><a href="page7.php" class="btn item-btn btn-lg btn-primary-outline display-7">Iniziare</a></div>
                    </div>
                    
                </div>
            </div>
              <div class="col-12 col-md-6 col-lg-3">
                <div class="item">
                    <div class="item-head">
                   <h5 class="item-title mbr-fonts-style display-5"><strong>Trascrivi l'audio</strong></h5>
                        
                    </div>
                    <div class="item-content">
                        <p class="mbr-text mbr-fonts-style mt-3 display-7">Trascrivi l'audio che ascolti</p>
                        <div class="mbr-section-btn item-footer mt-2"><a href="page8.php" class="btn item-btn btn-lg btn-primary-outline display-7">Iniziare</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="footer3 cid-uj12uPZGRF" once="footers" id="footer03-z">

        

    

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
  
  
  
</body>
</html>