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

function salvarFraseNoBanco($atividadeId, $exercicioNumero, $frase, $palavraOculta) {
    // Conectar ao banco de dados
    include '../../config/config.php';

    // Preparar a consulta SQL
    $sql = "INSERT INTO atividades_frases (atividade_id, exercicio_numero, frase, palavra_oculta)
            VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Vincular os parâmetros
        $stmt->bind_param("iiss", $atividadeId, $exercicioNumero, $frase, $palavraOculta);

        // Executar a consulta
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Erro ao salvar a frase: " . $stmt->error;
        }
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }

    // Fechar a conexão
    $stmt->close();
    $conn->close();

    return false;
}

function obterFrasesAtividade($atividadeId) {
    // Conectar ao banco de dados
    include '../../config/config.php';

    // Preparar a consulta SQL
    $sql = "SELECT exercicio_numero, frase, palavra_oculta FROM atividades_frases WHERE atividade_id = ?";
    
    $frases = [];

    if ($stmt = $conn->prepare($sql)) {
        // Vincular os parâmetros
        $stmt->bind_param("i", $atividadeId);
        // Executar a consulta
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $frases[] = $row;
            }
        } else {
            echo "Erro ao obter frases: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();

    return $frases;

    
}


?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completa le Frasi</title>
    
    <!-- Inclui o cabeçalho comum -->
    <?php include '../comun/headeralunos.php'; ?>

    <!-- Inclui o jQuery completo para suportar AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Estilos customizados -->
    <style>
        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            border: none;
            border-bottom: 2px solid #000; /* Linha embaixo */
            background: transparent;
            width: auto;
            min-width: 60px; /* Largura mínima */
            max-width: 100%; /* Largura máxima responsiva */
            text-align: center; /* Centralizar o texto no input */
            padding: 5px;
            font-size: 16px; /* Ajuste o tamanho da fonte conforme necessário */
        }

        input[type="text"]:focus {
            outline: none; /* Remove o contorno azul padrão ao focar */
            border-bottom: 2px solid #007BFF; /* Altera a cor da linha ao focar, opcional */
        }

        .correct {
           color: green;
             text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
        }

        .incorrect {
            color: red;
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
        }

        .result {
            margin-left: 15px;
        }

        .exercise {
            margin-bottom: 20px;
        }

        .score {
            font-weight: bold;
            margin-bottom: 20px;
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
                        <strong><?php echo "$username, Completa le frasi con il verbo essere!"; ?></strong>
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
                                    <strong>Attività <?php echo $atividade; ?> - Completa le frasi</strong>
                                </h4>
                                <div class="icon-wrapper">
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </div>
                            </a>
                        </div>
                        
                        <div id="collapse<?php echo $atividade; ?>" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="heading<?php echo $atividade; ?>" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_<?php echo $atividade; ?>">
                            <div class="result mb-3">
                                <div id="score_<?php echo $atividade; ?>" class="score">
                                    Corrette: 0 | Errate: 0
                                </div>
                            </div>
                            <div class="table-responsive">
                                <div class="container">
                                <!-- Exibir as frases já salvas para esta atividade -->
                                <?php
                                    $frasesSalvas = obterFrasesAtividade($atividade);
                                    echo "<script>window.exercises = window.exercises || {};</script>";
                                    echo "<script>window.exercises[$atividade] = [];</script>";
                                                    
                                    if (!empty($frasesSalvas)) {
                                        // Inicializar o contador para a enumeração das frases
                                        $numeroExercicio = 1; 
                                        foreach ($frasesSalvas as $frase) {
                                            $parts = explode($frase['palavra_oculta'], $frase['frase']);
                                            echo '<div class="exercise">';
                                            echo '<label>' . $numeroExercicio . '. ';
                                            echo $parts[0] . '<input type="text" class="answerInput" id="answer' . $atividade . '_' . $numeroExercicio . '"  style="border-bottom: 2px solid #000; min-width: 50px;">' . $parts[1] ;
                                            if ($isAdmin) {
                                                echo '<button class="delete-button" onclick="deleteExercise(' . $atividade . ', ' . $numeroExercicio . ', this.closest(\'.exercise\'))">Excluir</button>';
                                            }

                                            echo '</label>';
                                            echo '<span class="result" id="result' . $atividade . '_' . $numeroExercicio . '"></span>';
                                            echo '</div>';
                                            echo "<script>window.exercises[$atividade].push({id: " . $numeroExercicio . ", hiddenWord: '" . $frase['palavra_oculta'] . "'});</script>";
                                        
                                            // Incrementar o contador
                                            $numeroExercicio++; 
                                        }
                                    }
                                ?>
                                
                                <!-- O exercício será adicionado à seção específica de cada atividade -->
                                <div id="exercisesSection_<?php echo $atividade; ?>"></div>

                                <!-- Exibir o botão de verificação para a atividade específica -->
                                <div id="verifySection_<?php echo $atividade; ?>" >
                                    <button class="btn btn-secondary" type="button" onclick="checkAllAnswers(<?php echo $atividade; ?>)">Verifica le risposte</button>
                                </div>
                                <!-- Atualize o ID de cada elemento dentro do loop para incluir o número da atividade -->
                                <?php if ($isAdmin): ?>
                                <form id="createExerciseForm_<?php echo $atividade; ?>">
                                    <label for="sentence_<?php echo $atividade; ?>">Frase: <input type="text" id="sentence_<?php echo $atividade; ?>" placeholder="Es. Io sono felice"></label>
                                    <label for="wordToHide_<?php echo $atividade; ?>">Parola da nascondere: <input type="text" id="wordToHide_<?php echo $atividade; ?>" placeholder="Es. felice"></label>
                                    <button class="btn btn-secondary" type="button" onclick="addExercise(<?php echo $atividade; ?>)">Aggiungi frase</button>
                                </form>
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
    var usuario_id = <?php echo isset($_SESSION['user_id']) ? json_encode($_SESSION['user_id']) : 'null'; ?>;
</script>


    



</body>
</html>
