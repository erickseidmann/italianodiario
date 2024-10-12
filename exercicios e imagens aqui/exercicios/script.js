// Array para armazenar as frases, respostas corretas e explicações
let sentences = [];

// Função para adicionar novas frases dinamicamente
function addSentence() {
    let newSentenceInput = document.getElementById('newSentence').value;
    let newExplanationInput = document.getElementById('newExplanation').value;
    
    if (newSentenceInput) {
        // Extrair a parte da frase e a resposta correta ("V" ou "F") no final
        let parts = newSentenceInput.split(' - ');
        let sentenceText = parts[0];
        let correctAnswer = parts[1]?.toUpperCase(); // "V" ou "F"

        if (correctAnswer === "V" || correctAnswer === "F") {
            sentences.push({ 
                sentence: sentenceText, 
                answer: correctAnswer, 
                explanation: newExplanationInput 
            });
            updateQuestions();
        } else {
            alert("Per favore, fornire una risposta corretta 'V' o 'F'.");
        }
    }

    // Limpar campos de texto
    document.getElementById('newSentence').value = ''; 
    document.getElementById('newExplanation').value = ''; 
}

// Função para atualizar as perguntas no formulário
function updateQuestions() {
    let questionsDiv = document.getElementById('questions');
    questionsDiv.innerHTML = ''; // Limpar perguntas anteriores

    sentences.forEach((item, index) => {
        let questionHTML = `
            <div class="mb-3" id="question${index}">
                <label class="sentence-text" onclick="speakText('${item.sentence}')">
                    ${index + 1}. ${item.sentence}
                </label><br>
                <input type="radio" name="q${index}" value="V"> Vero
                <input type="radio" name="q${index}" value="F"> Falso
                <div class="feedback"></div>
            </div>
        `;
        questionsDiv.innerHTML += questionHTML;
    });
}

// Função para verificar as respostas do formulário
function checkAnswers() {
    let correctCount = 0;
    let incorrectCount = 0;

    sentences.forEach((item, index) => {
        let question = document.querySelector(`#question${index}`);
        let selected = question.querySelector(`input[name="q${index}"]:checked`);
        let feedbackDiv = question.querySelector('.feedback');
        feedbackDiv.innerHTML = ''; // Limpar feedback anterior

        if (selected) {
            let selectedValue = selected.value;
            
            let feedbackText = document.createElement("p");
            if (selectedValue === item.answer) {
                feedbackText.classList.add("correct");
                feedbackText.textContent = "Corretto!";
                correctCount++;
            } else {
                feedbackText.classList.add("incorrect");
                feedbackText.textContent = `Sbagliato. La risposta corretta è ${item.answer === 'V' ? 'Vero' : 'Falso'}.`;
                
                // Adiciona explicação se estiver errada
                if (item.explanation) {
                    let explanationText = document.createElement("p");
                    explanationText.classList.add("explanation");
                    explanationText.textContent = item.explanation;
                    feedbackDiv.appendChild(explanationText);
                }
                incorrectCount++;
            }
            feedbackDiv.appendChild(feedbackText);
        } else {
            feedbackDiv.innerHTML = "<p class='incorrect'>Per favore, seleziona una risposta.</p>";
        }
    });

    // Atualizar contadores de respostas
    document.getElementById('correctCount').textContent = `Frasi corrette: ${correctCount}`;
    document.getElementById('incorrectCount').textContent = `Frasi sbagliate: ${incorrectCount}`;
}

// Função para falar a frase
function speakText(text) {
    if ('speechSynthesis' in window) {
        let speech = new SpeechSynthesisUtterance(text);
        speech.lang = 'it-IT'; // Define o idioma como italiano
        window.speechSynthesis.speak(speech);
    } else {
        alert('La sintesi vocale non è supportata in questo browser.');
    }
}
