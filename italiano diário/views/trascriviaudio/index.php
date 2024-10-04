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
function registrarResultado($conn, $username, $atividadeId, $corretas, $erradas) {
    $pontuacao = $corretas; // Defina a pontuação conforme sua lógica
    $data = date('Y-m-d H:i:s');
    
    $sql = "INSERT INTO resultados_atividades (user_name, atividade_id, corretas, erradas, pontuacao, data) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('siisss', $username, $atividadeId, $corretas, $erradas, $pontuacao, $data);
        $stmt->execute();
        $stmt->close();
    }
}

// Captura as requisições POST para registrar resultados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['atividadeId'])) {
    $atividadeId = (int)$_POST['atividadeId'];
    $corretas = (int)$_POST['corretas'];
    $erradas = (int)$_POST['erradas'];
    
    registrarResultado($conn, $username, $atividadeId, $corretas, $erradas);
}
function handleNewPhrase($conn) {
    if (isset($_POST['newPhrase']) && isset($_POST['atividadeId'])) {
        $novaFrase = trim($_POST['newPhrase']);
        $atividadeId = (int)$_POST['atividadeId']; // Obtém o ID da atividade
        if (!empty($novaFrase)) {
            // Verificar se a frase já existe
            $checkSql = "SELECT COUNT(*) FROM frases_audio WHERE frase_audio = ? AND atividade_id = ?";
            if ($checkStmt = $conn->prepare($checkSql)) {
                $checkStmt->bind_param('si', $novaFrase, $atividadeId);
                $checkStmt->execute();
                $checkStmt->bind_result($count);
                $checkStmt->fetch();
                $checkStmt->close();

                if ($count === 0) { // Se a frase não existir
                    $sql = "INSERT INTO frases_audio (frase_audio, atividade_id) VALUES (?, ?)";
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param('si', $novaFrase, $atividadeId);
                        $stmt->execute();
                        $stmt->close();
                    }
                } else {
                    echo "<script>alert('Frase já existe na atividade $atividadeId!');</script>";
                }
            }
        }
    }
}

function handleDeletePhrase($conn) {
    if (isset($_POST['deletePhraseId'])) {
        $deleteId = $_POST['deletePhraseId'];
        $sql = "DELETE FROM frases_audio WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('i', $deleteId);
            $stmt->execute();
            $stmt->close();
        }
    }
}

// Consultar todas as frases da atividade para exibição
$atividades = range(1, 50); // Cria um array de 1 a 50
$frasesPorAtividade = [];

foreach ($atividades as $atividadeId) {
    handleNewPhrase($conn, $atividadeId);
    handleDeletePhrase($conn);

    $sql = "SELECT id, frase_audio FROM frases_audio WHERE atividade_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $atividadeId);
    $stmt->execute();
    $result = $stmt->get_result();

    $frasesPorAtividade[$atividadeId] = [];
    while ($row = $result->fetch_assoc()) {
        $frasesPorAtividade[$atividadeId][] = $row;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Trascrivi l'audio</title>
    <?php include '../comun/headeralunos.php'; ?>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="atividade.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<section data-bs-version="5.1" class="list01 replym5 cid-uk6zooppKo" id="list01-1h">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="title-wrapper">
                    <h3 class="mbr-section-title mbr-fonts-style display-4">
                        <strong><?php echo "$username, Trascrivi l'audio!"; ?></strong>
                    </h3>
                </div>
                <div id="bootstrap-accordion_47" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">
                    <?php for ($atividadeId = 1; $atividadeId <= 50; $atividadeId++): ?>
                        <div class="card">
                            <div class="card-header" role="tab" id="heading<?php echo $atividadeId; ?>">
                                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" href="#collapse<?php echo $atividadeId; ?>" aria-expanded="false" aria-controls="collapse<?php echo $atividadeId; ?>">
                                    <h4 class="panel-title-edit mbr-fonts-style display-7">
                                        <strong>Attività <?php echo $atividadeId; ?> - Trascrivi l'audio</strong>
                                    </h4>
                                    <div class="icon-wrapper">
                                        <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                    </div>
                                </a>
                            </div>
                            <div id="collapse<?php echo $atividadeId; ?>" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="heading<?php echo $atividadeId; ?>" data-parent="#bootstrap-accordion_47">
                            <div id="summary<?php echo $atividadeId; ?>" class="text-center mb-4">Corrette: 0 | Errate: 0</div>
        <div class="panel-body">
        
            <table >
                <thead>
                    <tr>
                        <th>Audio</th>
                        <th>Transcrição</th>
                        <th>Correção</th>
                        <?php if ($isAdmin): ?><th>Ações</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody id="transcriptionTableBody<?php echo $atividadeId; ?>">
                    <?php
                    $frases = $frasesPorAtividade[$atividadeId];
                    foreach ($frases as $index => $frase) {
                        echo '<tr id="row-' . $frase['id'] . '">
            <td class="audio-column">
                <div class="audio-container">
                    
                    <button class="btn btn-primary" onclick="playAudio(\'' . htmlspecialchars($frase['frase_audio'], ENT_QUOTES) . '\')">
                      ' . ($index + 1) . '   <i class="fas fa-play"></i>
                    </button>
                </div>
            </td>
                            <td><textarea id="transcription' . $atividadeId . '_' . ($index + 1) . '" class="" placeholder="Transcreva aqui" rows="1" oninput="adjustHeight(this)"></textarea></td>
                            <td>
                                <span id="checkmark' . $atividadeId . '_' . ($index + 1) . '" class="checkmark" style="display:none; color: green;">&#10003;</span>
                                <span id="error' . $atividadeId . '_' . ($index + 1) . '" class="error-message" style="display:none; color: red;" data-correct-phrase="' . htmlspecialchars($frase['frase_audio'], ENT_QUOTES) . '" onmouseover="showCorrectPhrase(this)" onclick="showCorrectPhrase(this)">
                                    <span style="color: red;">&#10008;</span>
                                </span>
                            </td>
                            <td>';
                        if ($isAdmin) {
                            echo '<button class="btn btn-danger" onclick="deletePhrase(' . $frase['id'] . ')">&#10008;</button>';
                        } 
                        echo '</td></tr>';
                    }
                    ?>
                </tbody>

            </table>
            <button id="verifyBtn<?php echo $atividadeId; ?>" class="btn btn-success mt-3" onclick="verificarTranscricao(<?php echo $atividadeId; ?>)">Verificar</button>
           
            <?php if ($isAdmin): ?>
            <div class="add-phrase">
                <input type="hidden" class="atividadeId" value="<?php echo $atividadeId; ?>">
                <textarea id="newPhrase" class="" placeholder="Digite sua nova frase aqui" rows="1" oninput="adjustHeight(this)"></textarea>
                <button class="addPhraseBtn btn btn-primary">Adicionar Frase</button>
            </div>
            <?php endif; ?>
            <div id="newAudioButtons" class="mt-3"></div>
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
                    <li class="header-menu-item mbr-fonts-style display-5"><a href="#" class="text-white">Home</a></li>
                    <li class="header-menu-item mbr-fonts-style display-5"><a href="#" class="text-white">Blog</a></li>
                    <li class="header-menu-item mbr-fonts-style display-5"><a href="#" class="text-white">Login</a></li>
                    <li class="header-menu-item mbr-fonts-style display-5"><a href="#" class="text-white">Cadastro</a></li>
                </ul>
            </div>
            <div class="col-12 mt-4">
                <p class="mbr-fonts-style copyright display-7">© 2024 Italiano Diario. Tutti i diritti riservati.</p>
            </div>
        </div>
    </div>
</section>

<script>
    function adjustHeight(el) {
        el.style.height = "auto"; // Reset the height
        el.style.height = (el.scrollHeight) + "px"; // Set it to the scroll height
    }

    function playAudio(text) {
    if (!window.speechSynthesis) {
        console.error('API de síntese de fala não suportada neste navegador.');
        return;
    }

    console.log('Tocando áudio para a frase:', text); // Log para verificar se a função está sendo chamada corretamente
    
    const utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = 'it-IT';

    utterance.onerror = function(event) {
        console.error('Erro na reprodução de áudio:', event.error);
    };

    speechSynthesis.speak(utterance);
}
    function deletePhrase(phraseId) {
        if (confirm('Tem certeza de que deseja excluir esta frase?')) {
            // Envia a requisição para deletar a frase
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'deletePhraseId=' + phraseId
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Exibe a resposta do servidor no console

                // Remove a linha da tabela
                const row = document.getElementById('row-' + phraseId);
                if (row) {
                    row.remove();
                }
            })
            .catch(error => console.error('Erro ao excluir a frase:', error));
        }
    }

    document.querySelectorAll('.addPhraseBtn').forEach(button => {
    button.addEventListener('click', () => {
        const newPhrase = button.previousElementSibling.value.trim(); // Pega a frase
        const atividadeId = button.previousElementSibling.previousElementSibling.value; // Pega o ID da atividade

        if (newPhrase) {
            // Seleciona o corpo da tabela correto com base no ID da atividade
            const tableBody = document.getElementById('transcriptionTableBody' + atividadeId);
            const rowCount = tableBody.querySelectorAll('tr').length + 1; // Conta linhas existentes na tabela correta
            
            // Adiciona a nova frase à tabela correta
            const newRow = `
                <tr>
                    <td><button class="btn btn-primary" onclick="playAudio('${newPhrase}')"><i class="fas fa-play"></i></button></td>
                    <td><textarea id="transcription${rowCount}" class="" placeholder="Transcreva aqui" rows="1" oninput="adjustHeight(this)"></textarea></td>
            <td>
                <span id="checkmark' . $atividadeId . '_' . ($index + 1) . '" class="checkmark" style="display:none; color: green;">&#10003;</span>
                <span id="error' . $atividadeId . '_' . ($index + 1) . '" class="error-message" style="display:none; color: red;" onclick="showCorrectPhrase(\'' . $frase['frase_audio'] . '\')">
                    <span style="color: red;">&#10008;</span> <!-- Ícone de erro em vermelho -->
                </span>
            </td>
                </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', newRow); // Insere a nova frase na tabela da atividade correspondente

            // Limpa o campo de entrada após adicionar a frase
            button.previousElementSibling.value = '';

            // Enviar a nova frase para o servidor
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'newPhrase=' + encodeURIComponent(newPhrase) + '&atividadeId=' + encodeURIComponent(atividadeId)
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Resposta do servidor
                // Aqui você pode adicionar lógica para lidar com a resposta, se necessário
            })
            .catch(error => console.error('Erro ao adicionar a frase:', error));
        }
    });
});
document.getElementById('verifyBtn').addEventListener('click', () => {
    // Loop através de cada atividade e verificar as transcrições
    for (let atividadeId = 1; atividadeId <= 50; atividadeId++) {
        const tableBody = document.getElementById('transcriptionTableBody' + atividadeId);
        const rows = tableBody.querySelectorAll('tr');
        
        rows.forEach((row, index) => {
            const transcriptionTextarea = row.querySelector('textarea');
            const transcription = transcriptionTextarea.value.trim(); // Transcrição do usuário
            const fraseOriginal = row.querySelector('button').getAttribute('onclick').match(/'(.*?)'/)[1]; // Frase original associada ao áudio

            if (transcription.toLowerCase() === fraseOriginal.toLowerCase()) {
                // Se a transcrição estiver correta
                row.querySelector('.checkmark').style.display = 'inline'; // Mostrar ícone de check
                row.querySelector('.error-message').style.display = 'none'; // Esconder ícone de erro
            } else {
                // Se a transcrição estiver incorreta
                row.querySelector('.checkmark').style.display = 'none'; // Esconder ícone de check
                row.querySelector('.error-message').style.display = 'inline'; // Mostrar ícone de erro
            }
        });
    }
});

 
   
    function showTooltip(element, correctPhrase) {
    // Acha o span de tooltip dentro do elemento
    const tooltip = element.nextElementSibling;
    
    // Configura o texto do tooltip
    tooltip.innerText = 'Frase correta: ' + correctPhrase;

    // Exibe o tooltip
    tooltip.style.display = 'block';

    // Esconde o tooltip depois de um tempo (3 segundos por exemplo)
    setTimeout(() => {
        tooltip.style.display = 'none';
    }, 3000);
}

document.querySelectorAll('.add-phrase button').forEach(button => {
    button.addEventListener('click', () => {
        const newPhrase = button.previousElementSibling.value.trim(); // Pega a frase
        const atividadeId = button.previousElementSibling.previousElementSibling.value; // Pega o ID da atividade

        if (newPhrase) {
            // Adiciona a nova frase à tabela
            const rowCount = document.querySelectorAll('#transcriptionTableBody tr').length + 1; // Contar linhas existentes
            const newRow = `
                <tr>
                    <td><button class="btn btn-primary" onclick="playAudio('${newPhrase}')"><i class="fas fa-play"></i></button></td>
                    <td><textarea id="transcription${rowCount}" class="" placeholder="Transcreva aqui" rows="1" oninput="adjustHeight(this)"></textarea></td>
                    <td>
                        <span id="checkmark${rowCount}" class="checkmark" style="display:none; color: green;">&#10003;</span>
                        <span id="error${rowCount}" class="error-message" style="display:none; color: red;" onclick="showCorrectPhrase('${newPhrase}')">&#10008;</span>
                    </td>
                </tr>
            `;
            document.getElementById('transcriptionTableBody').insertAdjacentHTML('beforeend', newRow);

            // Limpa o campo de entrada após adicionar a frase
            button.previousElementSibling.value = '';

            // Enviar a nova frase para o servidor
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'newPhrase=' + encodeURIComponent(newPhrase) + '&atividadeId=' + atividadeId
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Exibe a resposta do servidor no console
            })
            .catch(error => console.error('Erro ao adicionar a frase:', error));
        }
    });
});
function verificarTranscricao(atividadeId) {
    const tableBody = document.getElementById('transcriptionTableBody' + atividadeId);
    const rows = tableBody.querySelectorAll('tr');

    rows.forEach((row, index) => {
        const transcriptionTextarea = row.querySelector('textarea');
        const transcriptionText = transcriptionTextarea.value.trim();
        const fraseOriginal = row.querySelector('button').getAttribute('onclick').match(/'([^']+)'/)[1]; // Captura o texto original

        const checkmark = document.getElementById('checkmark' + atividadeId + '_' + (index + 1));
        const errorMessage = document.getElementById('error' + atividadeId + '_' + (index + 1));

        if (transcriptionText === fraseOriginal) {
            checkmark.style.display = 'inline';
            errorMessage.style.display = 'none';
        } else {
            checkmark.style.display = 'none';
            errorMessage.style.display = 'inline';
        }
    });

    // Atualizar resumo ou alguma outra lógica de feedback para essa atividade
    const summary = document.getElementById('summary' + atividadeId);
    summary.innerText = 'Verificação concluída para a atividade ' + atividadeId + '.';
}
function showCorrectPhrase(element) {
    // Obtém a frase correta do atributo data
    const correctPhrase = element.getAttribute('data-correct-phrase');
    
    // Exibe a frase correta, pode ser através de um alert ou tooltip
    // Para um alert simples:
    
    
    // Se quiser um tooltip, você pode criar um elemento div
    // (opcional, removível para apenas alert)
    const tooltip = document.createElement('div');
    tooltip.style.position = 'absolute';
    tooltip.style.backgroundColor = '#fff';
    tooltip.style.border = '1px solid #ccc';
    tooltip.style.padding = '5px';
    tooltip.style.zIndex = '1000';
    tooltip.innerText = correctPhrase;

    // Posiciona o tooltip
    document.body.appendChild(tooltip);
    const rect = element.getBoundingClientRect();
    tooltip.style.left = rect.left + window.scrollX + 'px';
    tooltip.style.top = rect.top + window.scrollY - 30 + 'px';

    // Remove o tooltip após um segundo
    setTimeout(() => {
        tooltip.remove();
    }, 3000);
}

function verificarTranscricao(atividadeId) {
    const tableBody = document.getElementById('transcriptionTableBody' + atividadeId);
    const rows = tableBody.querySelectorAll('tr');

    let correctCount = 0;
    let incorrectCount = 0;

    rows.forEach(row => {
        const textarea = row.querySelector('textarea');
        const correctPhrase = row.querySelector('.error-message').getAttribute('data-correct-phrase');

        if (textarea.value.trim() === correctPhrase) {
            correctCount++;
            row.querySelector('.checkmark').style.display = 'inline';
            row.querySelector('.error-message').style.display = 'none';
        } else {
            incorrectCount++;
            row.querySelector('.checkmark').style.display = 'none';
            row.querySelector('.error-message').style.display = 'inline';
        }
    });

    const summaryDiv = document.getElementById('summary' + atividadeId);
    summaryDiv.innerHTML = `Corretas: ${correctCount}, Erradas: ${incorrectCount}`;

    // Registrar resultado no banco de dados
    fetch('', { // Aqui você deixa vazio para enviar para o próprio arquivo
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `atividadeId=${atividadeId}&corretas=${correctCount}&erradas=${incorrectCount}`
});
}
    
    
</script>
</body>
</html>
