document.addEventListener('DOMContentLoaded', () => {
    const textForm = document.getElementById('textForm');
    const optionsContainer = document.getElementById('options');
    const generatedText = document.getElementById('generatedText');
    const exerciseSection = document.getElementById('exerciseSection');
    const result = document.getElementById('result');
    const verifyBtn = document.getElementById('verifyBtn');

    textForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const inputText = document.getElementById('inputText').value;
        const inputWords = document.getElementById('inputWords').value.split(',');

        // Gerar o texto com zonas dropzone
        let textWithDropzones = inputText.replace(/\[([^\]]+)\]/g, '<span class="dropzone" data-answer="$1"></span>');
        generatedText.innerHTML = textWithDropzones;

        // Exibir palavras como opções
        optionsContainer.innerHTML = '';
        inputWords.forEach(word => {
            let wordOption = document.createElement('div');
            wordOption.className = 'option';
            wordOption.setAttribute('draggable', 'true');
            wordOption.textContent = word.trim();
            optionsContainer.appendChild(wordOption);
        });

        // Tornar visível a seção de exercício
        exerciseSection.classList.remove('d-none');

        // Adicionar eventos de drag-and-drop para as novas opções
        initializeDragAndDrop();
    });

    function initializeDragAndDrop() {
        const options = document.querySelectorAll('.option');
        const dropzones = document.querySelectorAll('.dropzone');

        options.forEach(option => {
            option.addEventListener('dragstart', dragStart);
        });

        dropzones.forEach(dropzone => {
            dropzone.addEventListener('dragover', dragOver);
            dropzone.addEventListener('drop', drop);
        });

        function dragStart(e) {
            e.dataTransfer.setData('text', e.target.textContent);
        }

        function dragOver(e) {
            e.preventDefault();
        }

        function drop(e) {
            e.preventDefault();
            const data = e.dataTransfer.getData('text');
            e.target.textContent = data;
        }

        verifyBtn.addEventListener('click', () => {
            let correctCount = 0;
            let incorrectCount = 0;
            dropzones.forEach(dropzone => {
                if (dropzone.textContent.trim() === dropzone.getAttribute('data-answer')) {
                    dropzone.classList.add('correct');
                    dropzone.classList.remove('incorrect');
                    correctCount++;
                } else {
                    dropzone.classList.add('incorrect');
                    dropzone.classList.remove('correct');
                    incorrectCount++;
                }
            });
            result.innerHTML = `<p>Corretos: ${correctCount}, Errados: ${incorrectCount}</p>`;
            result.classList.add('mt-3');
        });
    }
});