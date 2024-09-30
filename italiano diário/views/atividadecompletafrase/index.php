<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login/");
    exit;
}

// Conectar ao banco de dados
include '../../config/config.php';

// Consultar textos salvos para exibir na tabela por atividade
$query = "SELECT texto, atividade_id FROM textos_atividade ORDER BY atividade_id";
$result = $conn->query($query);

$textsByActivity = [];
while ($row = $result->fetch_assoc()) {
    $activityId = $row['atividade_id'];
    if (!isset($textsByActivity[$activityId])) {
        $textsByActivity[$activityId] = [];
    }
    $textsByActivity[$activityId][] = $row['texto'];
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
    </style>
</head>
<body>

<section data-bs-version="5.1" class="list01 replym5 cid-unuJ7pRY0C" id="list01-20">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="title-wrapper">
                    <h3 class="mbr-section-title mbr-fonts-style display-4">
                        <strong><?php echo "$username, Completa il testo!"; ?></strong>
                    </h3>
                </div>
                <div id="bootstrap-accordion_17" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">

                    <?php for ($activityNumber = 1; $activityNumber <= 50; $activityNumber++): ?>
                    <div class="card">
                        <div class="card-header" role="tab" id="heading<?php echo $activityNumber; ?>">
                            <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" href="#collapse<?php echo $activityNumber; ?>" aria-expanded="false" aria-controls="collapse<?php echo $activityNumber; ?>">
                                <h4 class="panel-title-edit mbr-fonts-style display-7"><strong>Attività <?php echo $activityNumber; ?> - Completa il testo</strong></h4>
                                <div class="icon-wrapper">
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </div>
                            </a>
                        </div>
                        <div id="collapse<?php echo $activityNumber; ?>" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="heading<?php echo $activityNumber; ?>" data-parent="#accordion">
                            <div class="panel-body">
                                <div class="container mt-4">
                                    <div id="score<?php echo $activityNumber; ?>" class="text-center mb-4">Corrette: 0 | Errate: 0</div>

                                    <?php if (isset($textsByActivity[$activityNumber])): ?>
                                        <?php foreach ($textsByActivity[$activityNumber] as $index => $text): ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Opções:</h4>
                                                    <div id="options<?php echo $activityNumber; ?>" class="d-flex flex-wrap">
                                                        <div class="option" draggable="true">sono</div>
                                                        <div class="option" draggable="true">è</div>
                                                        <div class="option" draggable="true">siamo</div>
                                                        <!-- Outras opções podem ser adicionadas -->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4>Testo:</h4>
                                                    <p><?php echo $text; ?> <span class="dropzone" data-answer="sono"></span></p>
                                                    <!-- Exemplo: substitua 'sono' por respostas apropriadas -->
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <button class="btn btn-primary" onclick="checkAnswers(<?php echo $activityNumber; ?>)">Verificar</button>

                                    <?php if ($isAdmin): ?>
                                        <input type="text" id="inputText<?php echo $activityNumber; ?>" placeholder="Adicionar texto" class="form-control mb-2">
                                        <button class="btn btn-primary" onclick="addText(<?php echo $activityNumber; ?>)">Adicionar Texto</button>
                                        <button class="btn btn-success" onclick="salvarTextos(<?php echo $activityNumber; ?>)">Salvar Texto</button>
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
    function processarTexto() {
        const texto = document.getElementById("texto").value;
        const palavras = texto.split(" ");
        const container = document.getElementById("palavrasContainer");
        container.innerHTML = "";

        document.getElementById("palavrasSelecionadas").style.display = "block";

        palavras.forEach((palavra, index) => {
            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.id = "palavra_" + index;
            checkbox.value = palavra;

            const label = document.createElement("label");
            label.htmlFor = "palavra_" + index;
            label.textContent = palavra;

            container.appendChild(checkbox);
            container.appendChild(label);
            container.appendChild(document.createElement("br"));
        });
    }

    function salvarDados() {
        const texto = document.getElementById("texto").value;
        const checkboxes = document.querySelectorAll("#palavrasContainer input[type='checkbox']");
        let palavrasSelecionadas = [];

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                palavrasSelecionadas.push(checkbox.value);
            }
        });

        const dados = {
            texto: texto,
            palavras_arrastadas: palavrasSelecionadas
        };

        fetch('salvar_texto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(dados)
        })
        .then(response => response.json())
        .then(data => {
            alert("Dados salvos com sucesso!");
        })
        .catch((error) => {
            console.error('Erro ao salvar:', error);
        });
    }
</script>
</script>
</body>
</html>