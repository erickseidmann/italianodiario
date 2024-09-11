<!DOCTYPE html>
<html  >
<head>
  <title>Login</title>

  <?php
// Inclui o arquivo de cabeçalho localizado na pasta 'comun'
include '../comun/header.php';
?>
  
</head>
<body>
  


<section data-bs-version="5.1" class="form5 cid-ukfgWHD3fU" id="form02-1l">
    
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 content-head">
                <div class="mbr-section-head mb-5">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                        
                        <strong>Acesse agora!</strong></h3>
                    
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
              <form action="../../models/processar_login.php" method="POST" class="mbr-form form-with-styler" data-form-title="Form Name">
                <div class="dragArea row">
                    <div class="col-md col-sm-12 form-group mb-3" data-for="email">
                        <input type="email" name="email" placeholder="E-mail" data-form-field="email" class="form-control" id="email-form02-1l" required>
                    </div>
                    <div class="col-12 form-group mb-3 position-relative" data-for="senha">
                      <input type="password" name="senha" placeholder="Senha" data-form-field="senha" class="form-control" id="senha-form02-1l" required>
                      <span toggle="#senha-form02-1l" class="fa fa-fw fa-eye toggle-password" style="position: absolute; top: 50%; right: 50px; cursor: pointer; transform: translateY(-50%);"></span>
                  </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
                        <button type="submit" class="btn btn-primary display-7">Login</button>
                    </div>
                </div>
            </form>
            
            </div>
        </div>
    </div>
</section>

<?php
//rodapé
include '../comun/footer.php';
?>

<script>
  // Verifica se há um parâmetro de erro na URL
  window.onload = function() {
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has('error')) {
          alert("E-mail ou senha incorretos.");
      }
  }

  // Função para alternar a visibilidade da senha
  document.querySelectorAll('.toggle-password').forEach(item => {
      item.addEventListener('click', function () {
          const input = document.querySelector(this.getAttribute('toggle'));
          if (input.getAttribute('type') === 'password') {
              input.setAttribute('type', 'text');
              this.classList.remove('fa-eye');
              this.classList.add('fa-eye-slash');
          } else {
              input.setAttribute('type', 'password');
              this.classList.remove('fa-eye-slash');
              this.classList.add('fa-eye');
          }
      });
  });
</script>

<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/ytplayer/index.js"></script>
  <script src="assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="assets/vimeoplayer/player.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/formoid.min.js"></script>
  
  
  
</body>
</html>