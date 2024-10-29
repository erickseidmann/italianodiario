
function setupActivity(atividadeId, texto, palavras) {
    let generatedText = document.getElementById(`generatedText_${atividadeId}`);
    let optionsContainer = document.getElementById(`options_${atividadeId}`);
    let exerciseSection = document.getElementById(`exerciseSection_${atividadeId}`);
    let enviarTextoBtn = document.getElementById(`enviartexto_${atividadeId}`); // Certifique-se de que o ID do botão é único por atividade

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

        enviarTextoBtn.addEventListener('click', function(event) {
            event.preventDefault(); 

            const inputText = document.getElementById(`inputText_${atividadeId}`).value;
            const inputWords = document.getElementById(`inputWords_${atividadeId}`).value;

            $.ajax({
                type: 'POST',
                url: 'salvartexto.php',
                data: {
                    atividade_id: atividadeId,
                    texto: inputText,
                    palavras: inputWords
                },
                success: function(response) {
                    try {
                        const result = JSON.parse(response);
                        alert(result.message); 
                        if (result.success) {
                            setupActivity(atividadeId, inputText, inputWords); 
                        }
                    } catch (e) {
                        alert('Erro ao processar a resposta do servidor.');
                    }
                },
                error: function() {
                    alert('Erro ao salvar os dados. Tente novamente.');
                }
            });
        });
    } else {
        console.error(`Elementos não encontrados para a atividade ${atividadeId}`);
    }
}
function adicionarTextoPalavras(atividadeId) {
    const inputText = document.getElementById(`inputText_${atividadeId}`).value;
    const inputWords = document.getElementById(`inputWords_${atividadeId}`).value;
    
    $.ajax({
        type: 'POST',
        url: 'salvartexto.php',
        data: {
            atividade_id: atividadeId,
            texto: inputText,
            palavras: inputWords
        },
        success: function(response) {
            try {
                const result = JSON.parse(response);
                alert(result.message);
                if (result.success) {
                    setupActivity(atividadeId, inputText, inputWords);
                }
            } catch (e) {
                alert('Erro ao processar a resposta do servidor.');
            }
        },
        error: function() {
            alert('Erro ao salvar os dados. Tente novamente.');
        }
    });
}

