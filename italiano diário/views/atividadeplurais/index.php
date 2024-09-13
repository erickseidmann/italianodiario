<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login/index.php");
    exit;
}

// Conectar ao banco de dados
include '../../config/config.php';

// Consultar palavras salvas para exibir na tabela
$query = "SELECT id, singular FROM palavras_singular";
$result = $conn->query($query);

$words = [];
while ($row = $result->fetch_assoc()) {
    $words[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <script src="atividade.js"></script>
    <title>sostantivi al plurale</title>
    <?php
    // Inclui o arquivo de cabeçalho localizado na pasta 'comun'
    include '../comun/headeralunos.php';
    ?>
</head>
<body>

<section data-bs-version="5.1" class="list01 replym5 cid-unuJ7pRY0C" id="list01-20">
    <div class="container" name="Atividade1">
        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="title-wrapper">
                    <h3 class="mbr-section-title mbr-fonts-style display-4" name="Titule">
                        <strong><?php echo $_SESSION['name'] . ", Transforma questi sostantivi al plurale!"; ?></strong>
                    </h3>
                </div>
                <div id="bootstrap-accordion_17" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">
                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne">
                            <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse1_17" aria-expanded="false" aria-controls="collapse1">
                                <h4 class="panel-title-edit mbr-fonts-style display-7"><strong>Attività 1</strong></h4>
                                <div class="icon-wrapper">
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </div>
                            </a>
                        </div>
                        <div id="collapse1_17" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_17">
                            <div class="panel-body">
                                <div class="container mt-4">
                                    <div id="score" class="text-center mb-4">Corrette: 0 | Errate: 0</div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">Numero</th>
                                                    <th scope="col">Singolare</th>
                                                    <th scope="col">Plurale</th>
                                                    <th scope="col">Feedback</th>
                                                    <th scope="col">Ações</th> <!-- Nova coluna para ações -->
                                                </tr>
                                            </thead>
                                            <tbody id="activityBody">
                                                <?php foreach ($words as $index => $word): ?>
                                                <tr>
                                                    <td><?php echo $index + 1; ?></td>
                                                    <td><?php echo htmlspecialchars($word['singular']); ?></td>
                                                    <td><input type="text" id="word<?php echo $index + 1; ?>" class=""></td>
                                                    <td><small id="feedback<?php echo $index + 1; ?>" class="form-text feedback"></small></td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteWord(<?php echo $word['id']; ?>, this)">X</button>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button class="btn btn-primary" onclick="checkAnswers1()">Verifica</button>

                                    <!-- Formulário para adicionar novas palavras -->
                                    <div class="container mt-4">
                                        <h4>Aggiungi Nuove Parole</h4>
                                        <div id="addWordsForm">
                                            <div class="form-group">
                                                <input type="text" id="newSingularWord" placeholder="Singolare" class="form-control">
                                                <button class="btn btn-success mt-2" onclick="addWord()">Adicinar</button>
                                            </div>
                                            <button class="btn btn-primary mt-2" onclick="salvarPalavras()">Salvar Palavras</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

function addWord() {
    wordCount++;
    const tableBody = document.getElementById('activityBody');
    const newWord = document.getElementById('newSingularWord').value.trim();

    if (newWord) {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${wordCount}</td>
            <td>${newWord}</td>
            <td><input type="text" id="word${wordCount}" class="form-control"></td>
            <td><small id="feedback${wordCount}" class="form-text feedback"></small></td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="deleteWord(${wordCount}, this)">Excluir</button>
            </td>
        `;
        tableBody.appendChild(newRow);
        document.getElementById('newSingularWord').value = ''; // Limpar o campo após adicionar
    } else {
        alert('Por favor, insira uma palavra.');
    }
}

function salvarPalavras() {
    const words = [];
    const rows = document.querySelectorAll('#activityBody tr');

    rows.forEach(row => {
        const singular = row.cells[1].textContent.trim();
        if (singular) {
            words.push({ singular: singular });
        }
    });

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "salvar_palavras.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert('Palavras salvas com sucesso!');
            location.reload(); // Atualizar a página para exibir as palavras salvas
        }
    };
    xhr.send(JSON.stringify(words));
}

function getPlural1(word) {
    if (word.endsWith('a')) {
        return word.slice(0, -1) + 'e';
    } else if (word.endsWith('o')) {
        return word.slice(0, -1) + 'i';
    } else if (word.endsWith('e')) {
        return word.slice(0, -1) + 'i';
    } else if (word.endsWith('io')) {
        return word.slice(0, -2) + 'i';
    } else {
        return word; // Caso não seja uma forma comum de plural
    }
}

function sendAttemptData1(correctCount, incorrectCount, score) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'save_attempt.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send(`correct_count=${correctCount}&incorrect_count=${incorrectCount}&score=${score}`);
}

function checkAnswers1() {
    let correctCount = 0;
    let incorrectCount = 0;

    // Pega todas as linhas da tabela
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach((row, index) => {
        const singular = row.cells[1].textContent.trim();
        const input = row.cells[2].querySelector('input').value.trim();
        const feedback = row.cells[3].querySelector('small');

        if (input === getPlural1(singular)) {
            feedback.textContent = 'Correto!';
            feedback.className = 'text-success';
            correctCount++;
        } else {
            feedback.textContent = 'Incorreto.';
            feedback.className = 'text-danger';
            incorrectCount++;
        }
    });

    // Atualiza o contador de respostas
    document.getElementById('score').textContent = `Corrette: ${correctCount} | Errate: ${incorrectCount}`;
    sendAttemptData1(correctCount, incorrectCount, correctCount / (correctCount + incorrectCount) * 100);
}

// Função de exclusão de palavras
function deleteWord(wordId, btnElement) {
    if (confirm('Tem certeza de que deseja excluir esta palavra?')) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'excluir_palavra.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    // Remove a linha da tabela
                    btnElement.closest('tr').remove();
                } else {
                    alert('Erro ao excluir a palavra.');
                }
            }
        };
        xhr.send(`id=${wordId}`);
    }
}
</script>
</body>
</html>
