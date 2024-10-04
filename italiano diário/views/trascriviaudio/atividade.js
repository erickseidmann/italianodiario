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
}
