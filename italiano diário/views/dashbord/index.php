<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login/");
    exit;
}

// Conectar ao banco de dados
include '../../config/config.php';

// Obter o nome do usuário logado
$user_name = $_SESSION['name'];

// Consultar as pontuações do banco de dados filtradas pelo usuário logado
$query_scores = "SELECT user_name, activity_number, correct_count, incorrect_count, score, attempt_date 
                 FROM activity_scores 
                 WHERE user_name = ? 
                 ORDER BY attempt_date DESC";

// Preparar a consulta
$stmt_scores = $conn->prepare($query_scores);
$stmt_scores->bind_param("s", $user_name);
$stmt_scores->execute();
$result_scores = $stmt_scores->get_result();

if ($result_scores === false) {
    die("Erro na consulta de scores: " . $conn->error);
}

// Consultar resultados das atividades filtradas pelo usuário logado
$query_results = "SELECT user_name, atividade_id, corretas, erradas, pontuacao, data 
                  FROM resultados_atividades 
                  WHERE user_name = ? 
                  ORDER BY data DESC";

// Preparar a consulta
$stmt_results = $conn->prepare($query_results);
$stmt_results->bind_param("s", $user_name);
$stmt_results->execute();
$result_results = $stmt_results->get_result();

if ($result_results === false) {
    die("Erro na consulta de resultados: " . $conn->error);
}


// Consultar resultados das atividades "Vero o Falso" filtradas pelo usuário logado
$query_verofalso = "SELECT usuario, atividade, acertos, erros, pontuacao, data 
                    FROM pontuacaoVeroFalso 
                    WHERE usuario = ? 
                    ORDER BY data DESC";

// Preparar a consulta
$stmt_verofalso = $conn->prepare($query_verofalso);
$stmt_verofalso->bind_param("s", $user_name);
$stmt_verofalso->execute();
$result_verofalso = $stmt_verofalso->get_result();

if ($result_verofalso === false) {
    die("Erro na consulta de resultados 'Vero o Falso': " . $conn->error);
}

$query_completa_le_frasi = "SELECT  usuario_id, atividade_id, acertos, erros, pontuacao, data 
                             FROM pontucaocompletafrase
                             WHERE usuario_id = ? 
                             ORDER BY data DESC";

// Preparar a consulta
$stmt_completa_le_frasi = $conn->prepare($query_completa_le_frasi);
$stmt_completa_le_frasi->bind_param("s", $user_name);
$stmt_completa_le_frasi->execute();
$result_completa_le_frasi = $stmt_completa_le_frasi->get_result();

if ($result_completa_le_frasi === false) {
    die("Erro na consulta de resultados 'Completa le frasi': " . $conn->error);
}

// Substitua `usuario_id` pelo nome da coluna correta, se necessário
$query_completa_texto = "SELECT usuario, atividade_id, acertos, erros, pontuacao, data 
                          FROM pontucaocompletatexto 
                          WHERE usuario = ? 
                          ORDER BY data DESC";

// Preparar a consulta
$stmt_completa_texto = $conn->prepare($query_completa_texto);
$stmt_completa_texto->bind_param("s", $user_name); // `usuario` deve ser um valor adequado para filtrar
$stmt_completa_texto->execute();
$result_completa_texto = $stmt_completa_texto->get_result();

if ($result_completa_texto === false) {
    die("Erro na consulta de resultados 'Completa texto': " . $conn->error);
}

// Fechar a conexão ao banco de dados
$conn->close();
?>
<!DOCTYPE html>
<html  >
<head>

  
  <title>Dashbord</title>
  <?php
// Inclui o arquivo de cabeçalho localizado na pasta 'comun'
include '../comun/headeralunos.php';
?>

  
  
  
</head>
<body>



<section data-bs-version="5.1" class="gymm5 list1 cid-uj12Ea9EyK" id="list1-11">
    
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-10 m-auto">
                <div class="content">
                    <div class="mbr-section-head align-left mb-5">
                        <h4 class="mbr-section-subtitle mb-2 mbr-fonts-style display-5"><strong><?php echo "Bem-vindo, " . $_SESSION['name'] . "!"; ?></strong></h4>
                        
                    </div>
                    <div id="bootstrap-accordion_29" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">
                        <div class="card mb-3">
                            <div class="card-header" role="tab" id="headingOne">
                                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse1_29" aria-expanded="false" aria-controls="collapse1">

                                    <h6 class="panel-title-edit mbr-semibold mbr-fonts-style mb-0 display-5">Histórico e pontuações Plurale</h6>
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </a>
                            </div>
                            <div id="collapse1_29" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_29">
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Usuário</th>
                                                <th scope="col">Atividade</th>
                                                <th scope="col">Acertos</th>
                                                <th scope="col">Erros</th>
                                                <th scope="col">Pontuação</th>
                                                <th scope="col">Data</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($result_scores->num_rows > 0): ?>
                                                <?php while($row = $result_scores->fetch_assoc()): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['activity_number']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['correct_count']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['incorrect_count']); ?></td>
                                                        <td><?php echo intval($row['score']); ?></td>
                                                        <td><?php echo date('d/m/y - H:i', strtotime($row['attempt_date'])); ?></td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">Nenhum dado encontrado.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header" role="tab" id="headingOne">
                                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse2_29" aria-expanded="false" aria-controls="collapse2">

                                    <h6 class="panel-title-edit mbr-semibold mbr-fonts-style mb-0 display-5">Histórico e pontuações Trascrivi l'audio</h6>
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </a>
                            </div>
                            <div id="collapse2_29" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_29">
                                <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                            <th scope="col">Usuário</th>
                                                <th scope="col">Atividade</th>
                                                <th scope="col">Acertos</th>
                                                <th scope="col">Erros</th>
                                                <th scope="col">Pontuação</th>
                                                <th scope="col">Data</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($result_results->num_rows > 0): ?>
                                                <?php while($row = $result_results->fetch_assoc()): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row['user_name'], ENT_QUOTES); ?></td>
                                                        <td><?php echo htmlspecialchars($row['atividade_id']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['corretas']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['erradas']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['pontuacao']); ?></td>
                                                        
                                                        <td><?php echo date('d/m/y - H:i', strtotime($row['data'])); ?></td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6">Nenhum resultado encontrado.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header" role="tab" id="headingOne">
                                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse3_29" aria-expanded="false" aria-controls="collapse3">
                                    <h6 class="panel-title-edit mbr-semibold mbr-fonts-style mb-0 display-5">Histórico e pontuações Vero o falso</h6>
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </a>
                            </div>
                            <div id="collapse3_29" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_29">
                                <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                            <th scope="col">Usuário</th>
                                                <th scope="col">Atividade</th>
                                                <th scope="col">Acertos</th>
                                                <th scope="col">Erros</th>
                                                <th scope="col">Pontuação</th>
                                                <th scope="col">Data</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($result_verofalso->num_rows > 0): ?>
                                                <?php while($row = $result_verofalso->fetch_assoc()): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row['usuario'], ENT_QUOTES); ?></td>
                                                        <td><?php echo htmlspecialchars($row['atividade']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['acertos']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['erros']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['pontuacao']); ?></td>
                                                        <td><?php echo date('d/m/y - H:i', strtotime($row['data'])); ?></td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6">Nenhum resultado encontrado.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header" role="tab" id="headingOne">
                                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse4_29" aria-expanded="false" aria-controls="collapse4">
                                    <h6 class="panel-title-edit mbr-semibold mbr-fonts-style mb-0 display-5">Histórico e pontuações completa le frasi</h6>
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </a>
                            </div>
                            <div id="collapse4_29" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_29">
                                <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                      <thead class="thead-dark">
                                          <tr>
                                              <th scope="col">Usuário</th>
                                              <th scope="col">Atividade</th>
                                              <th scope="col">Acertos</th>
                                              <th scope="col">Erros</th>
                                              <th scope="col">Pontuação</th>
                                              <th scope="col">Data</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php if ($result_completa_le_frasi->num_rows > 0): ?>
                                              <?php while($row = $result_completa_le_frasi->fetch_assoc()): ?>
                                                  <tr>
                                                      <td><?php echo htmlspecialchars($row['usuario_id'], ENT_QUOTES); ?></td>
                                                      <td><?php echo htmlspecialchars($row['atividade_id']); ?></td>
                                                      <td><?php echo htmlspecialchars($row['acertos']); ?></td>
                                                      <td><?php echo htmlspecialchars($row['erros']); ?></td>
                                                      <td><?php echo round($row['pontuacao']); ?></td>
                                                      <td><?php echo date('d/m/y - H:i', strtotime($row['data'])); ?></td>
                                                  </tr>
                                              <?php endwhile; ?>
                                          <?php else: ?>
                                              <tr>
                                                  <td colspan="6">Nenhum resultado encontrado.</td>
                                              </tr>
                                          <?php endif; ?>
                                      </tbody>
                                  </table>

                                </div>
                            </div>
                        </div>
                        <div class="card mb-3" mbr-if="cardAmount > 5">
                            <div class="card-header" role="tab" id="headingOne">
                                <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core href="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    <h6 class="panel-title-edit mbr-semibold mbr-fonts-style mb-0 display-5">Histórico e pontuações completa la Testo</h6>
                                    <span class="sign mbr-iconfont mobi-mbri-plus mobi-mbri"></span>
                                </a>
                            </div>
                            <div id="collapse6" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" data-bs-parent="#accordion">
                                <div class="panel-body">
                                <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Usuário</th>
                                                    <th scope="col">Atividade</th>
                                                    <th scope="col">Acertos</th>
                                                    <th scope="col">Erros</th>
                                                    <th scope="col">Pontuação</th>
                                                    <th scope="col">Data</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($result_completa_texto->num_rows > 0): ?>
                                                    <?php while($row = $result_completa_texto->fetch_assoc()): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($row['usuario'], ENT_QUOTES); ?></td>
                                                            <td><?php echo htmlspecialchars($row['atividade_id']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['acertos']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['erros']); ?></td>
                                                            <td><?php echo round($row['pontuacao'], 2); ?></td> <!-- Exibe 2 casas decimais -->
                                                            <td><?php echo date('d/m/y - H:i', strtotime($row['data'])); ?></td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="6">Nenhum resultado encontrado.</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section data-bs-version="5.1" class="pricing1 cid-uk6A0tj2Ij" id="pricing01-1j">
    
    
    <div class="container">
        <div class="mbr-section-head">
            <h4 class="mbr-section-title mbr-fonts-style align-left mb-0 display-1"><strong>Esercizi</strong></h4>
            
        </div>
        <div class="row mt-4">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="item">
                    <div class="item-head">
                   <h5 class="item-title mbr-fonts-style display-5"><strong>Transforma Questi</strong></h5>
                        
                    </div>
                    <div class="item-content">
                       
                        <p class="mbr-text mbr-fonts-style mt-3 display-7">transforma questi sostantivi al plurale </p>
                        <div class="mbr-section-btn item-footer mt-2"><a href="../atividadeplurais/" class="btn item-btn btn-lg btn-primary-outline display-7">Iniziare</a></div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-3">
                <div class="item">
                    <div class="item-head">
                   <h5 class="item-title mbr-fonts-style display-5"><strong>Completa le Frasi</strong></h5>
                        
                    </div>
                    <div class="item-content">
                       
                        <p class="mbr-text mbr-fonts-style mt-3 display-7">completa le frasi con il verbo essere </p>
                        <div class="mbr-section-btn item-footer mt-2"><a href="../completafrase/" class="btn item-btn btn-lg btn-primary-outline display-7">Iniziare</a></div>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-3">
                <div class="item">
                    <div class="item-head">
                   <h5 class="item-title mbr-fonts-style display-5"><strong>Completa il testo</strong></h5>
                        
                    </div>
                    <div class="item-content">
                       
                        <p class="mbr-text mbr-fonts-style mt-3 display-7"> scegli tra le opzioni quelle giuste</p>
                        <div class="mbr-section-btn item-footer mt-2"><a href="../completatexto/" class="btn item-btn btn-lg btn-primary-outline display-7">Iniziare</a></div>
                    </div>
                    
                </div>
            </div>
              <div class="col-12 col-md-6 col-lg-3">
                <div class="item">
                    <div class="item-head">
                   <h5 class="item-title mbr-fonts-style display-5"><strong>Trascrivi l'audio</strong></h5>
                        
                    </div>
                    <div class="item-content">
                        <p class="mbr-text mbr-fonts-style mt-3 display-7">Trascrivi l'audio che ascolti</p>
                        <div class="mbr-section-btn item-footer mt-2"><a href="../trascriviaudio/" class="btn item-btn btn-lg btn-primary-outline display-7">Iniziare</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="footer3 cid-uj12uPZGRF" once="footers" id="footer03-z">

        

    

    <div class="container">
        <div class="row">
            <div class="row-links">
                <ul class="header-menu">
                  
                  
                    
                  
                  
                <li class="header-menu-item mbr-fonts-style display-5">
                    <a href="#" class="text-white">Home</a>
                  </li><li class="header-menu-item mbr-fonts-style display-5">
                    <a href="#" class="text-white">Blog</a>
                  </li><li class="header-menu-item mbr-fonts-style display-5">
                    <a href="#" class="text-white">Login</a>
                  </li><li class="header-menu-item mbr-fonts-style display-5"><a href="#" class="text-white">Cadastro</a></li></ul>
              </div>

            
            <div class="col-12 mt-4">
                <p class="mbr-fonts-style copyright display-7">© 2024 Italiano Diario. Tutti i diritti riservati.</p>
            </div>
        </div>
    </div>
</section>


<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/ytplayer/index.js"></script>
  <script src="assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="assets/mbr-switch-arrow/mbr-switch-arrow.js"></script>
  <script src="assets/theme/js/script.js"></script>
  
  
  
</body>
</html>