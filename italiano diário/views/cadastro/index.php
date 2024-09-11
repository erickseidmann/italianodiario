<!DOCTYPE html>
<html lang="pt-BR">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<title>Cadastro</title>

<?php
// Inclui o arquivo de cabeçalho localizado na pasta 'comun'
include '../comun/header.php';
?>


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
  


<section data-bs-version="5.1" class="form03 cid-ukflXFv0O6" id="form03-1q">
    

    

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg item-wrapper">
                <div class="mbr-section-head mb-5">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                        <strong>Crie sua conta agora!</strong></h3>
                    
                </div>
                <div class="col-lg-12 mx-auto mbr-form" data-form-type="formoid">
                    <form action="../../models/processar_cadastro.php" method="POST" class="mbr-form form-with-styler" data-form-title="Form Name">
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
                    <img class="w-100" src="../../assets/images/img-3595-1-1256x1245.jpg" alt="">
                </div>
            </div>

        </div>
    </div>
</section>

<?php
//rodapé
include '../comun/footer.php';
?>

  
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