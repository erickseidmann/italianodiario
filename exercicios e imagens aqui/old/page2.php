<!DOCTYPE html>
<html  >
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/ita-206x116.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <meta name="description" content="">
  <style>
    .password-container {
      position: relative;
    }
    
    .password-container input {
      width: calc(100% - 40px); /* Ajuste para deixar espaço para o botão */
    }
    
    .password-toggle {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
      color: #888;
    }
    
    .password-toggle i {
      font-size: 1.2em;
    }
  </style>
  
  <title>Cadastro</title>
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

  <script>
    // Verifica se há um erro na URL e exibe um pop-up
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error')) {
            const error = urlParams.get('error');
            if (error === 'email_exists') {
                alert('Esse email já está cadastrado.');
            }
        }
    }
</script>

  
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

<section data-bs-version="5.1" class="header18 cid-uiYWL8R41F" data-bg-video="https://www.youtube.com/watch?v=uCVOwkyXhWI" id="header18-n">
  

  <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(0, 0, 0);"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="content-wrap col-12 col-md-12">
        
        
        
        
      </div>
    </div>
  </div>
</section>

<section data-bs-version="5.1" class="form03 cid-ukflXFv0O6" id="form03-1q">
    

    

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg item-wrapper">
                <div class="mbr-section-head mb-5">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                        <strong>Crie sua conta agora!</strong></h3>
                    
                </div>
                <div class="col-lg-12 mx-auto mbr-form" data-form-type="formoid">
                    <form action="processar_formulario.php" method="POST" class="mbr-form form-with-styler" data-form-title="Form Name">
                        <div class="dragArea row">
                          <div class="col-12 form-group mb-3 mb-3" data-for="name">
                            <input type="text" name="name" placeholder="Nome" data-form-field="name" class="form-control" value="" id="name-form03-1q" required>
                          </div>
                          <div class="col-12 form-group mb-3 mb-3" data-for="email">
                            <input type="email" name="email" placeholder="E-mail" data-form-field="email" class="form-control" value="" id="email-form03-1q" required>
                          </div>
                          <div class="col-12 form-group mb-3 mb-3" data-for="password">
                            <div class="password-container">
                              <input type="password" name="password" placeholder="Senha" data-form-field="password" class="form-control" value="" id="password-form03-1q" required>
                              <span class="password-toggle" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggle-icon"></i>
                              </span>
                            </div>
                          </div>
                          <div class="col-12 form-group mb-3 mb-3" data-for="phone">
                            <input type="tel" name="phone" placeholder="+55 99999-9999" data-form-field="phone" class="form-control" value="" id="phone-form03-1q" pattern="\d{10,14}" title="Número de celular válido deve ter 11 ou 14 dígitos" required>
                            
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
                            <button type="submit" class="btn btn-primary display-7">Cadastrar</button>
                          </div>
                        </div>

                        <input type="hidden" name="status" value="Ativo">

                      </form>
                    
        

                </div>


            </div>
            <div class="col-12 col-lg-6">
                <div class="image-wrapper">
                    <img class="w-100" src="assets/images/img-3595-1-1256x1245.jpg" alt="">
                </div>
            </div>

        </div>
    </div>
</section>

<section data-bs-version="5.1" class="footer3 cid-uiYScXV6Oa" once="footers" id="footer03-l">

        

    

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
  <script src="assets/vimeoplayer/player.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>
  
  <script>
    function togglePassword() {
      var passwordField = document.getElementById("password-form03-1q");
      var toggleIcon = document.getElementById("toggle-icon");
      if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
      } else {
        passwordField.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
      }
    }
  </script>
</body>
</html>