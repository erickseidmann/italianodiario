<section data-bs-version="5.1" class="list01 replym5 cid-uk6zooppKo" id="list01-1h">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="title-wrapper">
                    <h3 class="mbr-section-title mbr-fonts-style display-4">
                        <strong><?php echo "$username, Trascrivi l'audio!"; ?></strong>
                    </h3>
                </div>
                <div id="bootstrap-accordion_47" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">
                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne">
                            <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse1_47" aria-expanded="false" aria-controls="collapse1">
                                <h4 class="panel-title-edit mbr-fonts-style display-7">
                                    <strong>Attività 1 - Trascrivi l'audio</strong></h4>
                                <div class="icon-wrapper">
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </div>
                            </a>
                        </div>
                        <div id="collapse1_47" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_47">
                            <div class="panel-body">
                            <table>
                                    <thead>
                                        <tr>
                                            <th>Audio</th>
                                            <th>Transcrição</th>
                                            <th>Correção</th>
                                            <th>Ações</th> <!-- Nova coluna para exclusão -->
                                        </tr>
                                    </thead>
                                    <tbody id="transcriptionTableBody">
                                        <?php
                                        // Exibe as frases existentes no banco de dados
                                        foreach ($frases as $index => $frase) {
                                            echo '<tr id="row-' . $frase['id'] . '">
                                                <td>' . ($index + 1) . '. <button class="btn btn-primary" onclick="playAudio(\'' . $frase['frase_audio'] . '\')"><i class="fas fa-play"></i></button></td>
                                                <td><textarea id="transcription' . ($index + 1) . '" class="" placeholder="Transcreva aqui" rows="1" oninput="adjustHeight(this)"></textarea></td>
                                                <td>
                                                    <span id="checkmark' . ($index + 1) . '" class="checkmark" style="display:none; color: green;">&#10003;</span>
                                                    <span id="error' . ($index + 1) . '" class="error-message" style="display:none; color: red; font-size: 12px;" onclick="showTooltip(this, \'' . $frase['frase_audio'] . '\')">&#x2716;</span>
                                                </td>
                                                <td><button class="btn btn-danger" onclick="deletePhrase(' . $frase['id'] . ')">&#10006;</button></td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>

                                </table>
                                <button id="verifyBtn" class="btn btn-success mt-3">Verificar</button>
                                <div id="summary" class="mt-3"></div>

                                <div class="add-phrase">
                                    <textarea id="newPhrase" class="" placeholder="Digite sua nova frase aqui" rows="1" oninput="adjustHeight(this)"></textarea>
                                    <button id="addPhraseBtn" class="btn btn-primary">Adicionar Frase</button>
                                </div>
                                <div id="newAudioButtons" class="mt-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>