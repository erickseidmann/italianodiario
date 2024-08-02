function getPlural(word) {
    // Basic Italian pluralization rules
    if (word.endsWith('a')) {
        return word.slice(0, -1) + 'e';
    } else if (word.endsWith('o')) {
        return word.slice(0, -1) + 'i';
    } else if (word.endsWith('e')) {
        return word.slice(0, -1) + 'i';
    } else if (word.endsWith('io')) {
        return word.slice(0, -2) + 'i';
    } else {
        return word; // Default case, might need more complex handling for exceptions
    }
}

function checkAnswers() {
    const words = [
        'Casa', 'Muro', 'Festa', 'Quaderno', 'Vita', 
        'Paese', 'Mondo', 'Signora', 'Passaporto', 'Giorno',
        'Mattina', 'Sera', 'Amico', 'Amore', 'Persona'
    ];

    let correctCount = 0;
    let incorrectCount = 0;

    words.forEach((word, index) => {
        const inputId = 'word' + (index + 1);
        const feedbackId = 'feedback' + (index + 1);
        const userAnswer = document.getElementById(inputId).value.trim().toLowerCase();
        const correctAnswer = getPlural(word.toLowerCase());

        if (userAnswer === correctAnswer) {
            document.getElementById(inputId).classList.add('correct');
            document.getElementById(inputId).classList.remove('incorrect');
            document.getElementById(feedbackId).classList.add('correct');
            document.getElementById(feedbackId).classList.remove('incorrect');
            document.getElementById(feedbackId).textContent = 'Parabéns';
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

    document.getElementById('score').textContent = `Corrette: ${correctCount} | Errate: ${incorrectCount}`;
}
