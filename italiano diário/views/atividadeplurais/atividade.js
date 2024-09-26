 // Número inicial de palavras

let wordCounters = {}; // Contadores separados para cada atividade

function addSingleWord(activityNumber) {
    const inputSingular = document.getElementById(`inputSingular${activityNumber}`);
    const singularWord = inputSingular.value.trim();
    
    if (!singularWord) {
        alert('Por favor, insira uma palavra.');
        return;
    }

    if (!wordCounters[activityNumber]) {
        wordCounters[activityNumber] = 0;
    }

    wordCounters[activityNumber]++;

    const tableBody = document.getElementById(`activityBody${activityNumber}`);
    const newRow = document.createElement('tr');

    newRow.innerHTML = `
        <td>${wordCounters[activityNumber]}</td>
        <td>${singularWord}</td>
        <td><input type="text" class="form-control"></td>
        <td><small class="form-text feedback"></small></td>
    `;

    tableBody.appendChild(newRow);
    inputSingular.value = ''; // Limpa o campo de input
}

function salvarPalavras(activityNumber) {
    const words = [];
    const rows = document.querySelectorAll(`#activityBody${activityNumber} tr`);

    // Iterar pelas linhas da tabela e capturar apenas as palavras no singular
    rows.forEach((row, index) => {
        const singular = row.cells[1].textContent.trim(); // Pega a palavra singular da tabela

        // Verifica se a palavra no singular não está vazia
        if (singular) {
            words.push({ singular: singular }); // Armazena apenas a palavra no singular
        }
    });

    // Verifica se há palavras para salvar
    if (words.length > 0) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "salvar_palavras.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert('Palavras singulares salvas com sucesso para atividade ' + activityNumber);
            }
        };

        // Enviar apenas as palavras no singular
        xhr.send(JSON.stringify({ activityNumber: activityNumber, words: words }));
    } else {
        alert('Por favor, adicione palavras antes de salvar.');
    }
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

function checkAnswers(activityNumber) {
    let correctCount = 0;
    let incorrectCount = 0;

    const rows = document.querySelectorAll(`#activityBody${activityNumber} tr`);

    rows.forEach((row, index) => {
        const singular = row.cells[1].textContent.trim();
        const input = row.cells[2].querySelector('input').value.trim();
        const feedback = row.cells[3].querySelector('small');

        feedback.innerHTML = '';

        // Corrigido para usar getPlural1
        if (input === getPlural1(singular)) {
            feedback.innerHTML = '<span class="text-success">&#10004;</span>';
            feedback.className = 'text-success';
            correctCount++;
        } else {
            const correctPlural = getPlural1(singular);
            feedback.innerHTML = `
                <span class="text-danger" 
                      data-toggle="tooltip" 
                      title="Sugestão: ${correctPlural}" 
                      style="cursor: pointer;">
                    &#10008;
                </span>`;
            feedback.className = 'text-danger';
            incorrectCount++;
        }
    });

    document.getElementById(`score${activityNumber}`).textContent = `Corrette: ${correctCount} | Errate: ${incorrectCount}`;
    sendAttemptData(correctCount, incorrectCount, correctCount / (correctCount + incorrectCount) * 100, activityNumber);

    // Ativa tooltips
    $('[data-toggle="tooltip"]').tooltip();
}

function sendAttemptData(correctCount, incorrectCount, score, activityNumber) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'save_attempt.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send(`activity_number=${activityNumber}&correct_count=${correctCount}&incorrect_count=${incorrectCount}&score=${score}`);
}


// Função de exclusão de palavras
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
        xhr.send(`id=${wordId}`); // Enviando o ID da palavra para exclusão
    }
}

function checkAnswers(activityNumber) {
    let correctCount = 0;
    let incorrectCount = 0;

    // Altera a seleção para as linhas da atividade específica
    const rows = document.querySelectorAll(`#activityBody${activityNumber} tr`);

    rows.forEach((row) => {
        const singular = row.cells[1].textContent.trim();
        const input = row.cells[2].querySelector('input').value.trim().toLowerCase(); // Converte a entrada para minúsculas
        const correctPlural = getPlural1(singular).toLowerCase(); // Converte a resposta correta para minúsculas
        const feedback = row.cells[3].querySelector('small');

        feedback.innerHTML = '';

        if (input === correctPlural) {
            feedback.innerHTML = '<span class="text-success">&#10004;</span>';
            feedback.className = 'text-success';
            correctCount++;
        } else {
            feedback.innerHTML = `
                <span class="text-danger" 
                      data-toggle="tooltip" 
                      title="Sugestão: ${correctPlural}" 
                      style="cursor: pointer;">
                    &#10008;
                </span>`;
            feedback.className = 'text-danger';
            incorrectCount++;
        }
    });

    // Atualiza a pontuação
    document.getElementById(`score${activityNumber}`).textContent = `Corrette: ${correctCount} | Errate: ${incorrectCount}`;
    
    // Enviar dados da tentativa
    sendAttemptData1(correctCount, incorrectCount, (correctCount / (correctCount + incorrectCount)) * 100, activityNumber);

    // Ativa tooltips
    $('[data-toggle="tooltip"]').tooltip();
}

function sendAttemptData1(correctCount, incorrectCount, score, activityNumber) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'save_attempt.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);  // Exibe a resposta do PHP
        }
    };

    xhr.send(`activity_number=${activityNumber}&correct_count=${correctCount}&incorrect_count=${incorrectCount}&score=${score}`);
}
