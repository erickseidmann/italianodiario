<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login/");
    exit;
}

// Conectar ao banco de dados
include '../../config/config.php';

// Verificar se o usuário tem email de administrador
$isAdmin = isset($_SESSION['email']) && $_SESSION['email'] === 'ADM@adm.com';
$username = $isAdmin ? 'ADM' : $_SESSION['name'];
$totalAtividades = 100;

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completa le Texto</title>
    
    <!-- Inclui o cabeçalho comum -->
    <?php include '../comun/headeralunos.php'; ?>

    <!-- Inclui o jQuery completo para suportar AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .option {
            margin: 5px;
            padding: 10px;
            border: 1px solid #ccc;
            cursor: pointer;
        }
        .dropzone {
            border-bottom: 2px solid #ccc;
            padding: 5px;
            min-width: 40px;
            display: inline-block;
            margin-right: 5px;
        }
        .correct {
            color: green;
        }
        .incorrect {
            color: red;
        }
        #generatedText {
            font-size: 22px; /* Ajuste o valor conforme necessário */
        }
    </style>

</head>
<body>

<section class="list01 replym5 cid-uk6yXlo4Q7" id="list01-1d">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="title-wrapper">
                    <h3 class="mbr-section-title mbr-fonts-style display-4">
                        <strong><?php echo "$username, scegli tra le opzioni quelle giuste!"; ?></strong>
                    </h3>
                </div>

                <!-- Início do loop para gerar atividades -->
                <?php for ($atividade = 1; $atividade <= $totalAtividades; $atividade++): ?>
                <div id="bootstrap-accordion_<?php echo $atividade; ?>" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">
                    <br> <!-- Linha separadora entre as atividades -->    
                    <div class="card">
                        <div class="card-header" role="tab" id="heading<?php echo $atividade; ?>">
                            <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" href="#collapse<?php echo $atividade; ?>" aria-expanded="false" aria-controls="collapse<?php echo $atividade; ?>">
                                <h4 class="panel-title-edit mbr-fonts-style display-7">
                                    <strong>Attività <?php echo $atividade; ?> - Scegli tra le opzioni quelle giuste</strong>
                                </h4>
                                <div class="icon-wrapper">
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </div>
                            </a>
                        </div>
                        
                        <div id="collapse<?php echo $atividade; ?>" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="heading<?php echo $atividade; ?>" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_<?php echo $atividade; ?>">
                            <div class="result mb-3">
                                <div id="result<?php echo $atividade; ?>" class="result">
                                   
                                </div>
                            </div>
                            <div class="table-responsive">
                                <div class="container">
                                <!-- Exibir as frases já salvas para esta atividade -->
                                <h2>Adicione um novo texto e palavras para arrastar</h2>

                                <!-- Formulário para Adicionar Texto e Palavras -->
                                        <form id="textForm">
                                            <div class="form-group">
                                                <label for="inputText">Texto com palavras corretas entre colchetes (exemplo: Mi chiamo [sono]):</label>
                                                <textarea id="inputText" class="form-control" rows="4" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputWords">Palavras (separe por vírgula):</label>
                                                <input type="text" id="inputWords" class="form-control" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Adicionar Texto e Palavras</button>
                                        </form>

                                        <hr>
                                        </div>
                                            <div id="result" class="mt-3"></div>
                                        </div>
                                        <h2>Exercício</h2>
                                        <div id="exerciseSection" class="d-none">
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <h4>Texto:</h4>
                                                    <p id="generatedText"></p>
                                                    
                                                </div>

                                                <div class="col-md-6">
                                                    <h4>Opções:</h4>
                                                    <div id="options" class="d-flex flex-wrap"></div>
                                                    <button id="verifyBtn" class="btn btn-primary">Verificar</button>
                                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
                <!-- Fim do loop -->
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
<script src="script.js"></script>


<script>
        
    </script>


    



</body>
</html>
