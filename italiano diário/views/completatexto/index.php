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



$atividadesDados = []; // Array para armazenar os dados das atividades
for ($i = 1; $i <= $totalAtividades; $i++) {
    $stmt = $conn->prepare("SELECT texto, palavras FROM completatexto WHERE atividade_id = ?");
    $stmt->bind_param("i", $i); // Passa o ID da atividade
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dadosTextoAtividade = $resultado->fetch_assoc();
    $atividadesDados[$i] = $dadosTextoAtividade; // Armazena os dados no array
    $stmt->close();
}

                

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
        button {
            background-color: #f0f0f0;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 24px; /* Tamanho dos ícones */
            margin: 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e0e0e0;
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

                <?php for ($atividade = 1; $atividade <= $totalAtividades; $atividade++): ?>

                    
                <div id="bootstrap-accordion_<?php echo $atividade; ?>" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">
                    <br>    
                    <div class="card">
                        <div class="card-header">
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
                                <div id="result<?php echo $atividade; ?>" class="result"></div>
                            </div>
                            <div class="table-responsive">
                                <div class="container">
                                <?php if ($isAdmin): ?>
                                                    <h2>Adicione um novo texto e palavras para arrastar</h2>

                                                    <form id="textForm_<?php echo $atividade; ?>" onsubmit="event.preventDefault(); setupActivity(<?php echo $atividade; ?>, document.getElementById(`inputText_<?php echo $atividade; ?>`).value, document.getElementById(`inputWords_<?php echo $atividade; ?>`).value);">
                                                        <div class="form-group">
                                                            <label for="inputText_<?php echo $atividade; ?>">Texto com palavras corretas entre colchetes (exemplo: Mi chiamo [sono]):</label>
                                                            <textarea id="inputText_<?php echo $atividade; ?>" class="form-control" rows="4" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputWords_<?php echo $atividade; ?>">Palavras (separe por vírgula):</label>
                                                            <input type="text" id="inputWords_<?php echo $atividade; ?>" class="form-control" required>
                                                        </div>
                                                        <p>clique no botão duas vezes primeiro para adicionar e revisar e o segundo para salvar</p>
                                                        <button id="enviartexto_<?php echo $atividade; ?>" class="btn btn-primary">Adicionar Texto e Palavras</button>
                                                        <button id="excluirtexto_<?php echo $atividade; ?>" class="btn btn-danger" onclick="confirmarExcluirTexto(<?php echo $atividade; ?>)">Excluir Texto</button>

                                                    </form>
                                                <?php endif; ?>

                                    
                                    <hr>
                                    
                                    <div id="exerciseSection_<?php echo $atividade; ?>" class="d-none">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Elemento para exibir a pontuação -->
                                                <p id="score_<?php echo $atividade; ?>" style="font-weight: bold; color: black;"></p>
                                                <h4>Testo:</h4>
                                                <p id="generatedText_<?php echo $atividade; ?>"></p>
                                            </div>

                                            <div class="col-md-6">
                                                <h4>Opzioni:</h4>
                                                <div id="options_<?php echo $atividade; ?>" class="d-flex flex-wrap"></div>
                                                <button id="verifyBtn_<?php echo $atividade; ?>" class="btn btn-primary" onclick="verificarResposta(<?php echo $atividade; ?>)">Verificar</button>
                                                <br>
                                                <button id="playAudioBtn_<?php echo $atividade; ?>" class="btn btn-primary" onclick="playAudio(<?php echo $atividade; ?>)">
                                                    <i class="fas fa-play"></i>
                                                </button>
                                                <button id="pauseAudioBtn_<?php echo $atividade; ?>" class="btn btn-primary" onclick="pauseAudio(<?php echo $atividade; ?>)">
                                                    <i class="fas fa-pause"></i>
                                                </button>
                                                <button id="stopAudioBtn_<?php echo $atividade; ?>" class="btn btn-primary" onclick="stopAudio(<?php echo $atividade; ?>)">
                                                    <i class="fas fa-stop"></i>
                                                </button>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
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
let utterance; // Para armazenar a fala
let isPlaying = false; // Estado de reprodução
let isPaused = false; // Estado de pausa

function playAudio(atividadeId) {
    const texto = document.getElementById(`generatedText_${atividadeId}`).innerText; // Obtém o texto gerado
    if (!isPlaying || isPaused) {
        // Cria uma nova utterance se não estiver em reprodução ou retoma se estiver em pausa
        if (!utterance || isPaused) {
            utterance = new SpeechSynthesisUtterance(texto);
            utterance.lang = 'it-IT'; // Define o idioma para italiano
            
            // Evento ao terminar a reprodução
            utterance.onend = function() {
                isPlaying = false;
                isPaused = false;
            };
            window.speechSynthesis.speak(utterance);
        } else {
            window.speechSynthesis.resume(); // Retoma a reprodução se estava pausado
        }
        
        isPlaying = true; 
        isPaused = false;
    }
}

function pauseAudio(atividadeId) {
    if (isPlaying && !isPaused) {
        window.speechSynthesis.pause(); // Pausa a fala
        isPaused = true; // Atualiza o estado para pausa
    }
}

function stopAudio(atividadeId) {
    if (isPlaying) {
        window.speechSynthesis.cancel(); // Interrompe a fala
        isPlaying = false; // Reseta o estado de reprodução
        isPaused = false; // Reseta o estado de pausa
    }
}

function confirmarExcluirTexto(atividadeId) {
    const confirmar = confirm("Tem certeza que deseja excluir este texto?");
    if (confirmar) {
        excluirTexto(atividadeId);
    }
}

function excluirTexto(atividadeId) {
    $.ajax({
        type: 'POST',
        url: 'excluirtexto.php', // Arquivo PHP que processará a exclusão do texto
        data: { atividade_id: atividadeId },
        success: function (response) {
            try {
                const result = JSON.parse(response);
                alert(result.message);
                if (result.success) {
                    document.getElementById(`generatedText_${atividadeId}`).innerHTML = ''; // Remove o texto do display
                    document.getElementById(`inputText_${atividadeId}`).value = ''; // Limpa o campo de texto
                    document.getElementById(`inputWords_${atividadeId}`).value = ''; // Limpa o campo de palavras
                }
            } catch (e) {
                alert('Erro ao processar a resposta do servidor.');
            }
        },
        error: function () {
            alert('Erro ao excluir o texto. Tente novamente.');
        }
    });
}
document.addEventListener("DOMContentLoaded", function () {
    const atividades = <?php echo json_encode($atividadesDados); ?>; // Passa o array completo
    const totalAtividades = <?php echo $totalAtividades; ?>;

    for (let atividade = 1; atividade <= totalAtividades; atividade++) {
        const texto = atividades[atividade]?.texto;
        const palavras = atividades[atividade]?.palavras;

        if (typeof texto !== 'undefined' && typeof palavras !== 'undefined') {
            setupActivity(atividade, texto, palavras);
        }

        // Adiciona o event listener para cada botão de enviar texto
        const enviarTextoBtn = document.getElementById(`enviartexto_${atividade}`);
        if (enviarTextoBtn) {
            enviarTextoBtn.addEventListener('click', function (event) {
                event.preventDefault();

                const inputText = document.getElementById(`inputText_${atividade}`).value;
                const inputWords = document.getElementById(`inputWords_${atividade}`).value;

                $.ajax({
                    type: 'POST',
                    url: 'salvartexto.php',
                    data: {
                        atividade_id: atividade,
                        texto: inputText,
                        palavras: inputWords
                    },
                    success: function (response) {
                        try {
                            const result = JSON.parse(response);
                            alert(result.message);
                            if (result.success) {
                                setupActivity(atividade, inputText, inputWords);
                            }
                        } catch (e) {
                            alert('Erro ao processar a resposta do servidor.');
                        }
                    },
                    error: function () {
                        alert('Erro ao salvar os dados. Tente novamente.');
                    }
                });
            });
        }
    }
});

function setupActivity(atividadeId, texto, palavras) {
    let generatedText = document.getElementById(`generatedText_${atividadeId}`);
    let optionsContainer = document.getElementById(`options_${atividadeId}`);
    let exerciseSection = document.getElementById(`exerciseSection_${atividadeId}`);

    if (generatedText && optionsContainer && exerciseSection) {
        generatedText.innerHTML = texto.replace(/\[([^\]]+)\]/g, '<span class="dropzone" data-answer="$1"></span>');
        optionsContainer.innerHTML = '';

        palavras.split(',').forEach(word => {
            let wordOption = document.createElement('div');
            wordOption.className = 'option';
            wordOption.setAttribute('draggable', 'true');
            wordOption.textContent = word.trim();
            
            wordOption.addEventListener('dragstart', function(event) {
                event.dataTransfer.setData('text/plain', wordOption.textContent);
            });

            optionsContainer.appendChild(wordOption);
        });

        exerciseSection.classList.remove('d-none');

        const dropzones = document.querySelectorAll(`.dropzone`);
        dropzones.forEach(dropzone => {
            dropzone.addEventListener('dragover', function(event) {
                event.preventDefault();
                dropzone.classList.add('hover');
            });

            dropzone.addEventListener('dragleave', function() {
                dropzone.classList.remove('hover');
            });

            dropzone.addEventListener('drop', function(event) {
                event.preventDefault();
                const droppedWord = event.dataTransfer.getData('text/plain');
                dropzone.textContent = droppedWord;
                dropzone.classList.remove('hover');

                if (dropzone.dataset.answer === droppedWord) {
                    dropzone.classList.add('correct');
                } else {
                    dropzone.classList.add('incorrect');
                }
            });
        });
    } else {
        console.error(`Elementos não encontrados para a atividade ${atividadeId}`);
    }
}

// Funções de áudio e verificação de respostas
function playAudio(atividadeId) {
    const texto = document.getElementById(`generatedText_${atividadeId}`).innerText;
    if (!isPlaying) {
        utterance = new SpeechSynthesisUtterance(texto);
        utterance.lang = 'it-IT';

        utterance.onend = function() {
            isPlaying = false;
        };

        window.speechSynthesis.speak(utterance);
        isPlaying = true;
    } else {
        window.speechSynthesis.resume();
    }
}

function pauseAudio(atividadeId) {
    if (isPlaying) {
        window.speechSynthesis.pause();
        isPlaying = false;
    }
}

function stopAudio(atividadeId) {
    if (isPlaying) {
        window.speechSynthesis.cancel();
        isPlaying = false;
    }
}



function verificarResposta(atividadeId) {
    let dropzones = document.querySelectorAll(`#exerciseSection_${atividadeId} .dropzone`);
    let correctCount = 0;
    let incorrectCount = 0;

    dropzones.forEach(dropzone => {
        let answer = dropzone.getAttribute('data-answer');
        let userAnswer = dropzone.textContent.trim();

        if (userAnswer === answer) {
            dropzone.classList.add('correct');
            dropzone.classList.remove('incorrect');
            correctCount++;
        } else {
            dropzone.classList.add('incorrect');
            dropzone.classList.remove('correct');
            incorrectCount++;
        }
    });

    let scoreDisplay = document.getElementById(`score_${atividadeId}`);
    scoreDisplay.textContent = `Corrette: ${correctCount} | Sbagliate: ${incorrectCount}`;

    // Envio da pontuação para o backend
    $.ajax({
        type: 'POST',
        url: 'salvarpontuacao.php', // Endereço do arquivo que processará o salvamento da pontuação
        data: {
            atividade_id: atividadeId,
            acertos: correctCount, // Altera para 'acertos'
            erros: incorrectCount,  // Altera para 'erros'
            pontuacao: correctCount // Aqui pode ser definida uma lógica de cálculo se necessário
        },
        success: function (response) {
            try {
                const result = JSON.parse(response);
                if (result.success) {
                    alert("Pontuação salva com sucesso!");
                } else {
                    alert("Falha ao salvar a pontuação: " + result.message);
                }
            } catch (e) {
                alert('Erro ao processar a resposta do servidor.');
            }
        },
        error: function () {
            alert('Erro ao salvar a pontuação. Tente novamente.');
        }
    });
}


</script>







</body>
</html>
