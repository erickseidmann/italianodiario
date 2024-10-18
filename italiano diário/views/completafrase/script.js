// script.js
let exercises = {}; // Objeto para armazenar os exercícios de cada atividade

// Função para ajustar a largura do input com base no conteúdo
function autoResizeInput(input) {
    input.style.width = '20px'; // Redefine a largura
    input.style.width = ((input.value.length + 1) * 8) + 'px'; // Ajusta a largura com base no conteúdo
}

$(document).ready(function() {
    // Aplicar autoResizeInput para todos os inputs criados dinamicamente
    $('.answerInput').each(function() {
        autoResizeInput(this);
        $(this).on('input', function() {
            autoResizeInput(this);
        });
    });
});

// Função para adicionar um exercício
function addExercise(atividade) {
    const sentence = document.getElementById('sentence_' + atividade).value.trim();
    const wordToHide = document.getElementById('wordToHide_' + atividade).value.trim();

    if (sentence === "" || wordToHide === "") {
        alert("Inserisci una frase e la parola da nascondere.");
        return;
    }

    // Verifica se a palavra a esconder está na frase
    if (sentence.includes(wordToHide)) {
        if (!exercises[atividade]) exercises[atividade] = [];
        const exerciseCount = exercises[atividade].length + 1;

        // AJAX para salvar no banco de dados
        $.ajax({
            url: 'salvar_frase.php',
            type: 'POST',
            data: {
                atividade_id: atividade,
                exercicio_numero: exerciseCount,
                frase: sentence,
                palavra_oculta: wordToHide
            },
            success: function(response) {
                console.log("Frase salva com sucesso no banco.");

                // Parte de manipulação da interface começa aqui
                const inputElement = document.createElement('input');
                inputElement.type = 'text';
                inputElement.id = 'answer' + atividade + '_' + exerciseCount;
                inputElement.placeholder = '_______';
                inputElement.style.border = 'none';
                inputElement.style.borderBottom = '2px solid #000';
                inputElement.style.background = 'transparent';
                inputElement.style.width = '50px'; 
                inputElement.style.minWidth = '50px';
                inputElement.style.maxWidth = '100%';
                inputElement.style.textAlign = 'center';
                inputElement.style.padding = '5px';
                inputElement.style.fontSize = '16px';

                inputElement.addEventListener('input', function() {
                    autoResizeInput(this);
                });

                autoResizeInput(inputElement);

                const parts = sentence.split(wordToHide);
                const modifiedSentence = document.createElement('span');
                modifiedSentence.appendChild(document.createTextNode(parts[0]));
                modifiedSentence.appendChild(inputElement);
                modifiedSentence.appendChild(document.createTextNode(parts[1]));

                const exerciseDiv = document.createElement('div');
                exerciseDiv.classList.add('exercise');
                const label = document.createElement('label');
                label.innerHTML = `${exerciseCount}. `;
                label.appendChild(modifiedSentence);
                const resultSpan = document.createElement('span');
                resultSpan.id = 'result' + atividade + '_' + exerciseCount;
                resultSpan.classList.add('result');
                label.appendChild(resultSpan);

                exerciseDiv.appendChild(label);

                document.getElementById('exercisesSection_' + atividade).appendChild(exerciseDiv);

                // Adiciona o exercício à lista de exercícios da atividade
                exercises[atividade].push({
                    sentence: sentence,
                    hiddenWord: wordToHide,
                    id: exerciseCount
                });

                // Limpa os campos de input
                document.getElementById('sentence_' + atividade).value = '';
                document.getElementById('wordToHide_' + atividade).value = '';
                document.getElementById('verifySection_' + atividade).style.display = 'block';

            },
            error: function(xhr, status, error) {
                console.error("Erro ao salvar a frase: " + error);
            }
        });

    } else {
        alert("La parola da nascondere non è presente nella frase.");
    }
}


// Função para verificar todas as respostas// Função para verificar todas as respostas
function checkAllAnswers(atividade) {
    let corretas = 0;
    let erradas = 0;

    const exercises = window.exercises[atividade];

    for (let exercise of exercises) {
        const userAnswer = document.getElementById('answer' + atividade + '_' + exercise.id).value.trim().toLowerCase();
        const hiddenWord = exercise.hiddenWord.trim().toLowerCase();
        const resultElement = document.getElementById('result' + atividade + '_' + exercise.id);

        if (userAnswer === hiddenWord) {
            resultElement.textContent = "Corretto!";
            resultElement.className = "result correct";
            corretas++;
        } else {
            resultElement.textContent = "Errato! La parola giusta era: " + hiddenWord;
            resultElement.className = "result incorrect";
            erradas++;
        }
    }

    // Atualiza o total de acertos e erros no final
    document.getElementById('score_' + atividade).textContent = "Corrette: " + corretas + " | Errate: " + erradas;

    // Salve a pontuação
    const pontuacao = corretas; // ou a lógica que você usar para calcular a pontuação
    saveScore(usuario_id, atividade, corretas, erradas, pontuacao);
}


function saveScore(usuario_id, atividade_id, acertos, erros, pontuacao) {
    $.ajax({
        url: 'salvar_pontuacao.php',
        type: 'POST',
        data: {
            usuario: usuario_id,
            atividade: atividade_id,
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

function deleteExercise(atividade, exerciseId, phraseElement) {
    // Pergunta ao usuário se ele tem certeza que quer excluir a frase
    if (confirm("Tem certeza que deseja excluir esta frase?")) {
        // AJAX para remover do banco de dados
        $.ajax({
            url: 'excluir_frase.php',
            type: 'POST',
            data: {
                atividade_id: atividade,
                exercicio_numero: exerciseId
            },
            
            success: function(response) {
                console.log("Frase excluída com sucesso.");
                // Remove apenas a frase da interface
                if (phraseElement) { // Verifica se phraseElement está definido
                    phraseElement.remove();
                }
            },
            error: function(xhr, status, error) {
                console.error("Erro ao excluir a frase: " + error);
            }
        });
    } else {
        console.log("Exclusão cancelada pelo usuário.");
    }
}