<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login/index.php");
    exit;
}

// Conectar ao banco de dados
include '../../config/config.php';

// Consultar palavras salvas para exibir na tabela por atividade
$query = "SELECT singular, atividade_id FROM palavras_singular ORDER BY atividade_id";
$result = $conn->query($query);

$wordsByActivity = [];
while ($row = $result->fetch_assoc()) {
    $activityId = $row['atividade_id'];
    if (!isset($wordsByActivity[$activityId])) {
        $wordsByActivity[$activityId] = [];
    }
    $wordsByActivity[$activityId][] = $row['singular'];
}

// Verificar se o usuário tem email de administrador
$isAdmin = isset($_SESSION['email']) && $_SESSION['email'] === 'ADM@adm.com';
$username = $isAdmin ? 'ADM' : $_SESSION['name'];
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    
    <title>sostantivi al plurale</title>
    <?php
    // Inclui o arquivo de cabeçalho localizado na pasta 'comun'
    include '../comun/headeralunos.php';
    ?>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="atividade.js"></script>
    
</head>
<body>

<section data-bs-version="5.1" class="list01 replym5 cid-unuJ7pRY0C" id="list01-20">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="title-wrapper">
                <h3 class="mbr-section-title mbr-fonts-style display-4">
                        <strong><?php echo "$username, Trasforma questi sostantivi al plurale!"; ?></strong>
                    </h3>
                </div>
                <div id="bootstrap-accordion_17" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">

 
                            <?php for ($activityNumber = 1; $activityNumber <= 50; $activityNumber++): ?>
                    <div class="card">
                        <div class="card-header" role="tab" id="heading<?php echo $activityNumber; ?>">
                            <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse<?php echo $activityNumber; ?>" aria-expanded="false" aria-controls="collapse<?php echo $activityNumber; ?>">
                                <h4 class="panel-title-edit mbr-fonts-style display-7"><strong>Attività <?php echo $activityNumber; ?> - Trasforma questi sostantivi al plurale </strong></h4>
                                <div class="icon-wrapper">
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </div>
                            </a>
                        </div>
                        <div id="collapse<?php echo $activityNumber; ?>" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="heading<?php echo $activityNumber; ?>" data-parent="#accordion">
                            <div class="panel-body">
                                <div class="container mt-4">
                                
                                    <div id="score<?php echo $activityNumber; ?>" class="text-center mb-4">Corrette: 0 | Errate: 0</div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">Numero</th>
                                                    <th scope="col">Singolare</th>
                                                    <th scope="col">Plurale</th>
                                                    <th scope="col">Feedback</th>
                                                    <?php if ($isAdmin): ?>
                                                    <th scope="col">EXCLUIR</th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody id="activityBody<?php echo $activityNumber; ?>">
                                            <?php if (isset($wordsByActivity[$activityNumber])): ?>
                                                    <?php foreach ($wordsByActivity[$activityNumber] as $index => $word): ?>
                                                        <tr>
                                                            <td><?php echo $index + 1; ?></td>
                                                            <td><?php echo htmlspecialchars($word); ?></td>
                                                            <td><input type="text" class=""></td>
                                                            <td><small class="form-text feedback"></small></td>
                                                            <?php if ($isAdmin): ?>
                                                                 <td>
                                                                     <button onclick="deleteWord(<?php echo $index; ?>, this)">x</button>
                                                                 </td>
                                                             <?php endif; ?>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>

                                            </tbody>

                                        </table>
                                    </div>
                                    <button class="btn btn-primary" onclick="checkAnswers(<?php echo $activityNumber; ?>)">Verificar</button>
                                    <?php if ($isAdmin): ?>
                                        <input type="text" id="inputSingular<?php echo $activityNumber; ?>" placeholder="Adicionar palavra singular" class="form-control mb-2">
                                        <button class="btn btn-primary" onclick="addSingleWord(<?php echo $activityNumber; ?>)">Adicionar Palavra</button>
                                        <button class="btn btn-success" onclick="salvarPalavras(<?php echo $activityNumber; ?>)">Salvar Palavras</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>

                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="footer3 cid-uj14efcLgb" once="footers" id="footer03-15">
    <div class="container">
        <div class="row">
            <div class="row-links">
                <ul class="header-menu">
                    <li class="header-menu-item mbr-fonts-style display-5">
                        <a href="#" class="text-white">Home</a>
                    </li>
                    <li class="header-menu-item mbr-fonts-style display-5">
                        <a href="#" class="text-white">Blog</a>
                    </li>
                    <li class="header-menu-item mbr-fonts-style display-5">
                        <a href="#" class="text-white">Login</a>
                    </li>
                    <li class="header-menu-item mbr-fonts-style display-5">
                        <a href="#" class="text-white">Cadastro</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 mt-4">
                <p class="mbr-fonts-style copyright display-7">© 2024 Italiano Diario. Tutti i diritti riservati.</p>
            </div>
        </div>
    </div>
</section>

<script>
let wordCount = <?php echo count($words); ?>; // Número inicial de palavras

let wordCounters = {}; // Inicializamos os contadores para cada atividade

<?php foreach ($wordsByActivity as $activityNumber => $words): ?>
    wordCounters[<?php echo $activityNumber; ?>] = <?php echo count($words); ?>;
<?php endforeach; ?>

// Caso alguma atividade não tenha palavras, iniciamos o contador como 0
for (let i = 1; i <= 50; i++) {
    if (!wordCounters[i]) {
        wordCounters[i] = 0;
    }
}





</script>
</body>
</html>
