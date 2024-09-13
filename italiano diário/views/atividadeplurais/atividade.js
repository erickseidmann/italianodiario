let activityCounter = 1;

function getPlural(word) {
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

function sendAttemptData(correctCount, incorrectCount, score) {
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

    // Pega todas as linhas da tabela da atividade específica
    const rows = document.querySelector(`#collapse${activityNumber} tbody`).querySelectorAll('tr');

    rows.forEach((row, index) => {
        const singularWord = row.cells[1].textContent.trim().toLowerCase(); // Extrai o singular da célula
        const inputId = 'word' + activityNumber + (index + 1);
        const feedbackId = 'feedback' + activityNumber + (index + 1);
        const userAnswer = document.getElementById(inputId).value.trim().toLowerCase();
        const correctAnswer = getPlural(singularWord);

        if (userAnswer === correctAnswer) {
            document.getElementById(inputId).classList.add('correct');
            document.getElementById(inputId).classList.remove('incorrect');
            document.getElementById(feedbackId).classList.add('correct');
            document.getElementById(feedbackId).classList.remove('incorrect');
            document.getElementById(feedbackId).textContent = 'Congratulazioni';
            correctCount++;
        } else {
            document.getElementById(inputId).classList.add('incorrect');
            document.getElementById(inputId).classList.remove('correct');
            document.getElementById(feedbackId).classList.add('incorrect');
            document.getElementById(feedbackId).classList.remove('correct');
            document.getElementById(feedbackId).textContent = `✖ ${correctAnswer}`;
            incorrectCount++;
        }
    });

    const score = correctCount;
    document.getElementById('score' + activityNumber).textContent = `Corrette: ${correctCount} | Errate: ${incorrectCount}`;
    sendAttemptData(correctCount, incorrectCount, score);
}

// Lógica específica para a primeira atividade
function checkFirstActivityAnswers() {
    let correctCount = 0;
    let incorrectCount = 0;

    // Pega todas as linhas da tabela da primeira atividade
    const rows = document.querySelector('#collapse1_17 tbody').querySelectorAll('tr');

    rows.forEach((row, index) => {
        const singularWord = row.cells[1].textContent.trim().toLowerCase(); // Extrai o singular da célula
        const inputId = 'word' + (index + 1);
        const feedbackId = 'feedback' + (index + 1);
        const userAnswer = document.getElementById(inputId).value.trim().toLowerCase();
        const correctAnswer = getPlural(singularWord);

        if (userAnswer === correctAnswer) {
            document.getElementById(inputId).classList.add('correct');
            document.getElementById(inputId).classList.remove('incorrect');
            document.getElementById(feedbackId).classList.add('correct');
            document.getElementById(feedbackId).classList.remove('incorrect');
            document.getElementById(feedbackId).textContent = 'Congratulazioni';
            correctCount++;
        } else {
            document.getElementById(inputId).classList.add('incorrect');
            document.getElementById(inputId).classList.remove('correct');
            document.getElementById(feedbackId).classList.add('incorrect');
            document.getElementById(feedbackId).classList.remove('correct');
            document.getElementById(feedbackId).textContent = `✖ ${correctAnswer}`;
            incorrectCount++;
        }
    });

    const score = correctCount;
    document.getElementById('score').textContent = `Corrette: ${correctCount} | Errate: ${incorrectCount}`;
    sendAttemptData(correctCount, incorrectCount, score);
}

function createNewActivity() {
    activityCounter++;

    // Pede ao usuário novas palavras no singular
    let newWords = [];
    for (let i = 1; i <= 10; i++) {
        let newWord = prompt(`Digite a palavra no singular ${i}:`);
        if (newWord) {
            newWords.push(newWord.trim());
        } else {
            newWords.push(""); // Caso o usuário cancele ou deixe em branco
        }
    }

    // Cria uma nova atividade
    const newActivity = document.createElement('div');
    newActivity.classList.add('card');
    newActivity.innerHTML = `
        <div class="card-header" role="tab" id="heading${activityCounter}">
            <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse${activityCounter}" aria-expanded="false" aria-controls="collapse${activityCounter}">
                <h4 class="panel-title-edit mbr-fonts-style display-7"><strong>Attività ${activityCounter}</strong></h4>
                <div class="icon-wrapper">
                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                </div>
            </a>
        </div>
        <div id="collapse${activityCounter}" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="heading${activityCounter}" data-parent="#bootstrap-accordion_17">
            <div class="panel-body">
                <div class="container mt-4">
                    <div id="score${activityCounter}" class="text-center mb-4">Corrette: 0 | Errate: 0</div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Numero</th>
                                    <th scope="col">Singolare</th>
                                    <th scope="col"> Plurale</th>
                                    <th scope="col">Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${newWords.map((word, index) => `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${word}</td>
                                        <td><input type="text" id="word${activityCounter}${index + 1}" class=""></td>
                                        <td><small id="feedback${activityCounter}${index + 1}" class="form-text feedback"></small></td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-primary" onclick="checkAnswers(${activityCounter})">Verifica</button>
                </div>
            </div>
        </div>
    `;

    // Adiciona a nova atividade ao container
    document.querySelector('#bootstrap-accordion_17').appendChild(newActivity);
}

// Adiciona um ouvinte de evento para o botão de criação de nova atividade
document.getElementById('newActivityBtn').addEventListener('click', createNewActivity);

// Verifica se estamos na primeira atividade e adiciona o botão de verificação específico para a primeira atividade
if (document.querySelector('#collapse1_17')) {
    document.querySelector('#collapse1_17 .btn-primary').addEventListener('click', checkFirstActivityAnswers);
}



