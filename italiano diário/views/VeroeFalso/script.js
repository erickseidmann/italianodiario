function addSentence(atividade_id) {
    var frase = $('#newSentence' + atividade_id).val();
    var explicacao = $('#newExplanation' + atividade_id).val();

    // Definir se a frase é verdadeira ou falsa (você deve ter uma lógica para isso)
    var correta = frase.includes(" - V") ? 'V' : 'F';

    $.ajax({
        url: 'adicionar_frase.php',
        type: 'POST',
        data: {
            frase: frase,
            explicacao: explicacao,
            correta: correta,
            atividade_id: atividade_id
        },
        success: function(response) {
            alert(response);
        },
        error: function() {
            alert('Erro ao adicionar frase.');
        }
    });
}


function checkAnswers(atividade) {
    let correctCount = 0;
    let incorrectCount = 0;

    let sentences = window[`sentences${atividade}`];  // Acessa o array de frases dessa atividade

    sentences.forEach((item, index) => {
        let question = document.querySelector(`#question${atividade}${index}`);
        let selected = question.querySelector(`input[name="sentence${atividade}${index}"]:checked`);
        let feedbackCell = document.getElementById(`feedback${atividade}${index}`);
        feedbackCell.innerHTML = ''; // Limpar feedback anterior

        if (selected) {
            let selectedValue = selected.value;

            if (selectedValue === item.answer) {
                feedbackCell.innerHTML = `<span class="correct">Corretto!</span>`;
                correctCount++;
            } else {
                feedbackCell.innerHTML = `<span class="incorrect">Sbagliato. La risposta corretta è ${item.answer === 'V' ? 'Vero' : 'Falso'}.</span>`;
                
                if (item.explanation) {
                    feedbackCell.innerHTML += `<br><span class="explanation">${item.explanation}</span>`;
                }
                incorrectCount++;
            }
        } else {
            feedbackCell.innerHTML = "<span class='incorrect'>Per favore, seleziona una risposta.</span>";
        }
    });

    document.getElementById(`correctCount${atividade}`).textContent = `Frasi corrette: ${correctCount}`;
    document.getElementById(`incorrectCount${atividade}`).textContent = `Frasi incorrette: ${incorrectCount}`;
    
    // Defina o usuário e a pontuação total
    const usuario = '<?php echo $_SESSION["email"]; ?>'; // Altere isso para o valor real do usuário, se necessário
    const totalScore = correctCount; // Ou qualquer lógica de pontuação que você deseje aplicar
    saveScore(usuario, atividade, correctCount, incorrectCount, totalScore);
}


// Função para carregar as frases e exibi-las
$(document).ready(function() {
    // Carrega as frases para todas as atividades
    for (let atividade = 1; atividade <= 50; atividade++) {
        loadSentences(atividade);
    }
});


function loadSentences(atividade) {
    $.ajax({
        url: 'listar_frases.php',
        method: 'GET',
        data: { atividade: atividade },  // Passa o número da atividade para o PHP
        dataType: 'json',
        success: function(response) {
            $(`#questions${atividade}`).empty(); // Limpa a tabela antes de adicionar novas frases
            window[`sentences${atividade}`] = []; // Reseta o array de frases para essa atividade

            response.forEach(function(sentence, index) {
                var escapedFrase = sentence.frase.replace(/'/g, "\\'").replace(/"/g, '\\"');

                $(`#questions${atividade}`).append(`
                    <tr id="question${atividade}${index}">
                        <td onclick="speakText('${sentence.frase}')">${sentence.frase}</td>
                        <td>
                            <input type="radio" name="sentence${atividade}${index}" value="V"> Vero
                            <br>
                            <input type="radio" name="sentence${atividade}${index}" value="F"> Falso
                        </td>
                        <td id="feedback${atividade}${index}" class="correction"></td>
                        <td>
                            <button onclick="deleteSentence(${sentence.id}, '${escapedFrase}')" class="delete-btn">X</button>
                        </td>
                    </tr>
                `);

                window[`sentences${atividade}`].push({
                    sentence: sentence.frase,
                    answer: sentence.correta === 'V' ? 'V' : 'F',
                    explanation: sentence.explicacao
                });
            });
        },
        error: function(xhr, status, error) {
            console.error('Erro ao carregar as frases:', error);
        }
    });
}


function deleteSentence(id, frase) {
    // Confirmação personalizada com a frase
    if (confirm(`Tem certeza que deseja excluir a frase: "${frase}"?`)) {
        $.ajax({
            url: 'excluir_frase.php',  // Script PHP para excluir a frase
            type: 'POST',
            data: { id: id },  // Enviar o ID da frase
            success: function(response) {
                alert(response);
                loadSentences();  // Recarregar as frases após a exclusão
            },
            error: function() {
                alert("Erro ao excluir a frase.");
            }
        });
    }
}
function speakText(text) {
    if ('speechSynthesis' in window) {
        let speech = new SpeechSynthesisUtterance(text);
        speech.lang = 'it-IT'; // Define o idioma como italiano
        window.speechSynthesis.speak(speech);
    } else {
        alert('La sintesi vocale non è supportata in questo browser.');
    }
}

function saveScore(usuario, atividade, acertos, erros, pontuacao) {
    $.ajax({
        url: 'salvar_pontuacao.php',
        type: 'POST',
        data: {
            usuario: usuario,
            atividade: atividade,
            acertos: acertos,
            erros: erros,
            pontuacao: pontuacao
        },
        dataType: 'json', // Certifique-se de que a resposta seja tratada como JSON
        success: function(response) {
            if (response.status === 'success') {
                alert('Pontuação salva com sucesso!');
            } else {
                alert('Erro: ' + response.message);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Erro ao salvar a pontuação: ' + textStatus, errorThrown);
            
        }
    });
}
