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
$totalAtividades = 50;
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vero e Falso</title>
    
    <!-- Inclui o cabeçalho comum -->
    <?php include '../comun/headeralunos.php'; ?>

    <!-- Inclui o jQuery completo para suportar AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>

    <!-- Estilos customizados -->
    <style>
        .correct { color: green; }
        .incorrect { color: red; }
        .explanation { font-style: italic; color: #555; }
        .feedback { margin-top: 5px; }
        .sentence-text { cursor: pointer; text-decoration: underline; color: #007bff; }
        .result { margin-top: 10px; }

        table, th, td { border: none; }
        tbody { counter-reset: rowNumber; }
        tbody tr { counter-increment: rowNumber; }
        tbody tr td:first-child::before { content: counter(rowNumber) ". "; }
        thead th {
    width: auto; /* Ajusta a largura automaticamente */
}

thead th:nth-child(1) {
    width: 300px; /* Ajusta a largura da coluna Frase */
    white-space: nowrap; /* Impede a quebra de linha */
}

tbody td:nth-child(1) {
    width: 300px; /* Também aplica a largura à célula do corpo */
    white-space: nowrap; /* Impede a quebra de linha */
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
                        <strong><?php echo "$username, Esercizi Vero e Falso"; ?></strong>
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
                                    <strong>Attività <?php echo $atividade; ?> - Aggiungi e Verifica Frasi</strong>
                                </h4>
                                <div class="icon-wrapper">
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </div>
                            </a>
                        </div>
                        
                        <div id="collapse<?php echo $atividade; ?>" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="heading<?php echo $atividade; ?>" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_<?php echo $atividade; ?>">
                            <div class="result mb-3">
                                <p id="correctCount<?php echo $atividade; ?>" class="d-inline">Frasi corrette: 0</p>
                                <span class="d-inline">|</span>
                                <p id="incorrectCount<?php echo $atividade; ?>" class="d-inline">Frasi sbagliate: 0</p>
                            </div>
                            <div class="table-responsive">
                                <div class="container">
                                    <form id="veroFalsoForm<?php echo $atividade; ?>">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th style="width: 300px;">Frase</th>
                                                        <th>Selezionare</th>
                                                        <th>Correzione</th>
                                                        <?php if ($isAdmin): ?>
                                                            <th>Ação</th> <!-- Coluna de exclusão apenas para administrador -->
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody id="questions<?php echo $atividade; ?>">
                                                    <!-- As frases para essa atividade aparecerão aqui -->
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="feedback"></div>
                                        <button type="button" class="btn btn-primary mt-4" onclick="checkAnswers(<?php echo $atividade; ?>)">Verifica Risposte</button>
                                    </form>
                                </div>

                                <div class="row mt-4">
                                <?php if ($isAdmin): ?>
                                    <div class="col-md-6">
                                        <label for="newSentence<?php echo $atividade; ?>">Aggiungi una nuova frase:</label>
                                        <input type="text" id="newSentence<?php echo $atividade; ?>" class="form-control mb-2" placeholder="Es. Lui significa lei - F">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="newExplanation<?php echo $atividade; ?>">Aggiungi una spiegazione (se sbagliato):</label>
                                        <input type="text" id="newExplanation<?php echo $atividade; ?>" class="form-control mb-2" placeholder="Es. 'Lui' significa 'ele', non 'ela'">
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-secondary" onclick="addSentence(<?php echo $atividade; ?>)">Aggiungi Frase</button>
                                    </div>
                                    <?php endif; ?>
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

<section class="footer3 cid-uk6yXlTuod" once="footers" id="footer03-1e">
    <div class="container">
        <div class="row">
            <ul class="header-menu">
                <li class="header-menu-item mbr-fonts-style display-5"><a href="#" class="text-white">Home</a></li>
                <li class="header-menu-item mbr-fonts-style display-5"><a href="#" class="text-white">Blog</a></li>
                <li class="header-menu-item mbr-fonts-style display-5"><a href="#" class="text-white">Login</a></li>
                <li class="header-menu-item mbr-fonts-style display-5"><a href="#" class="text-white">Cadastro</a></li>
            </ul>
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
    var isAdmin = <?php echo json_encode($isAdmin); ?>; // Converte para booleano em JavaScript
</script>


</body>
</html>
