<?php
// Conectar ao banco de dados
require '../../config/config.php';

// Buscar o último título, texto e link do vídeo da tabela infoBlog
$sql = "SELECT titulo1, texto1, linkVideo, imagem, titulo2, texto2p1, texto2p2, texto2p3, tituloComentarios, comentario1,fotocomentario1, comentario2, fotocomentario2, comentario3, fotocomentario3, comentario4, fotocomentario4, comentario5, fotocomentario5, comentario6, fotocomentario6, tituloGaleria, subTituloGaleria  FROM infoBlog ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Recuperar o último título, texto e link do vídeo
    $row = $result->fetch_assoc();
    $titulo = $row['titulo1'];
    $texto = $row['texto1'];
    $linkVideo = $row['linkVideo'];
    $imagem = $row['imagem'];
    $titulo2 = $row['titulo2'];
    $texto2p1 = $row['texto2p1'];
    $texto2p2 = $row['texto2p2'];
    $texto2p3 = $row['texto2p3'];
    $tituloComentarios = $row['tituloComentarios'];
    $comentario1 = $row['comentario1'];
    $comentario2 = $row['comentario2'];
    $comentario3 = $row['comentario3'];
    $comentario4 = $row['comentario4'];
    $comentario5 = $row['comentario5'];
    $comentario6 = $row['comentario6'];
    $tituloGaleria = $row['tituloGaleria'];
    $subTituloGaleria = $row['subTituloGaleria'];

} else {
    $titulo = "Nenhum título encontrado";
    $texto = "Nenhum texto encontrado";
    $linkVideo = "https://www.youtube.com/embed/default"; // Link padrão caso não haja vídeo
    $imagem = "../../assets/images/default-image.jpg"; // Imagem padrão caso não haja imagem
    $titulo2 = "Título não encontrado";
    $texto2p1 = "Texto 1 não encontrado";
    $texto2p2 = "Texto 2 não encontrado";
    $texto2p3 = "Texto 3 não encontrado";
    $tituloComentarios = "titulo  não encontrado";
    $comentario1 = "Comentario  não encontrado";
    $comentario2 = "Comentario  não encontrado";
    $comentario3 = "Comentario  não encontrado";
    $comentario4 = "Comentario  não encontrado";
    $comentario5 = "Comentario  não encontrado";
    $comentario6 = "Comentario  não encontrado";
    $tituloGaleria = "Não encontrado";
    $subTituloGaleria = "Não encontrado";
}

$conn->close();
?>
<?php
// Inclui o arquivo de cabeçalho localizado na pasta 'comun'
include '../comun/header.php';
?>

<!-- texto 1 -->
<section data-bs-version="5.1" class="header4 cid-uiYSnHl6ot" id="header04-g">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-md">
				<div class="text-wrapper">
					<h2 class="mbr-section-title mb-4 mbr-fonts-style display-2"><strong><strong><?php echo htmlspecialchars($titulo); ?></strong></strong></h2>
				<p class="mbr-text mb-4 mbr-fonts-style display-7">
                <?php echo htmlspecialchars($texto); ?>
				</p>
				</div>
			</div>
			<div class="mbr-figure col-12 col-md-8"><iframe class="mbr-embedded-video" src="<?php echo htmlspecialchars($linkVideo); ?>?loop=1&amp;autoplay=1" width="1280" height="720" frameborder="0" allowfullscreen></iframe>
            </div></div>
		</div>
       
	</div>
</section>
 <!-- final texto 1 -->


<!-- texto 2 -->
<section data-bs-version="5.1" class="article2 cid-uiYScQuVt6" id="article02-2">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-12 col-lg-6 image-wrapper">
			<img class="w-100" src="../../assets/images/torrepizza1-1256x1675.jpg" alt="">
			</div>
			<div class="col-12 col-md-12 col-lg">
				<div class="text-wrapper align-left">
				<h1 class="mbr-section-title mbr-fonts-style mb-4 display-2"><strong><?php echo htmlspecialchars($titulo2); ?></strong></h1>
				<p class="mbr-text align-left mbr-fonts-style mb-3 display-7"><?php echo htmlspecialchars($texto2p1); ?></p>

				<p class="mbr-text align-left mbr-fonts-style mb-3 display-7"><?php echo htmlspecialchars($texto2p2); ?></p>

				<p class="mbr-text align-left mbr-fonts-style mb-3 display-7"><?php echo htmlspecialchars($texto2p3); ?></p>		
				</div>
			</div>
		</div>
	</div>
</section>
<!-- final texto 2 -->

<!-- comentarios -->
<section data-bs-version="5.1" class="people04 cid-uiYVUX1Xlv" id="people04-h">
	<div class="container">
		<div class="row mb-5 justify-content-center">
			<div class="col-12 mb-0 content-head">
				<h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
				<strong><?php echo htmlspecialchars($tituloComentarios); ?></strong></h3>	
			</div>
		</div>
		<div class="row mbr-masonry" data-masonry="{&quot;percentPosition&quot;: true }">
			<div class="item features-without-image col-12 col-md-6 col-lg-4 active">
				<div class="item-wrapper">
					<div class="card-box align-left">
					<p class="card-text mbr-fonts-style display-7">
                    <?php echo htmlspecialchars($comentario1); ?>
						</p>
						<div class="img-wrapper mt-4 mb-2">
						<img src="../../assets/images/img-3594-1-160x160.jpg" alt="" data-slide-to="0" data-bs-slide-to="0">
						</div>
						<h5 class="card-title mbr-fonts-style display-7">
						
						</h5>
					</div>
				</div>
			</div>
			<div class="item features-without-image col-12 col-md-6 col-lg-4">
				<div class="item-wrapper">
					<div class="card-box align-left">
						<!-- editavel --><p class="card-text mbr-fonts-style display-7">
						<?php echo htmlspecialchars($comentario2); ?>
						</p>
						<div class="img-wrapper mt-4 mb-2">
						<!-- editavel -->	<img src="../../assets/images/img-1698-original-160x213.jpg" data-slide-to="1" data-bs-slide-to="1" alt="">
						</div>
						<h5 class="card-title mbr-fonts-style display-7">
						
					</div>
				</div>
			</div>
			<div class="item features-without-image col-12 col-md-6 col-lg-4">
				<div class="item-wrapper">
					<div class="card-box align-left">
					<?php echo htmlspecialchars($comentario3); ?>
						<div class="img-wrapper mt-4 mb-2">
					<!-- editavel -->		<img src="../../assets/images/img-3594-1-160x160.jpg" data-slide-to="2" data-bs-slide-to="2" alt="">
						</div>
						<h5 class="card-title mbr-fonts-style display-7">
						
						</h5>
					</div>
				</div>
			</div>
			<div class="item features-without-image col-12 col-md-6 col-lg-4">
				<div class="item-wrapper">
					<div class="card-box align-left">
						<!-- editavel --><p class="card-text mbr-fonts-style display-7">
						<?php echo htmlspecialchars($comentario4); ?>
						</p>
						<div class="img-wrapper mt-4 mb-2">
						<!-- editavel -->	<img src="../../assets/images/img-3594-1-160x160.jpg" data-slide-to="3" data-bs-slide-to="3" alt="">
						</div>
						<h5 class="card-title mbr-fonts-style display-7">
						
						</h5>
					</div>
				</div>
			</div>
			<div class="item features-without-image col-12 col-md-6 col-lg-4">
				<div class="item-wrapper">
					<div class="card-box align-left">
						<!-- editavel --><p class="card-text mbr-fonts-style display-7">
                        <?php echo htmlspecialchars($comentario5); ?>
						</p>
						<div class="img-wrapper mt-4 mb-2">
						<!-- editavel -->	<img src="../../assets/images/img-3909-2-original-160x213.jpg" data-slide-to="4" data-bs-slide-to="4" alt="">
						</div>
						<h5 class="card-title mbr-fonts-style display-7">
						
						</h5>
					</div>
				</div>
			</div>
			<div class="item features-without-image col-12 col-md-6 col-lg-4">
				<div class="item-wrapper">
					<div class="card-box align-left">
						<!-- editavel --><p class="card-text mbr-fonts-style display-7">
                        <?php echo htmlspecialchars($comentario6); ?>
						</p>
						<div class="img-wrapper mt-4 mb-2">
						<!-- editavel -->	<img src="../../assets/images/img-3909-2-original-160x213.jpg" data-slide-to="5" data-bs-slide-to="5" alt="">
						</div>
						<h5 class="card-title mbr-fonts-style display-7">
						
						</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section data-bs-version="5.1" class="gallery1 mbr-gallery cid-uiYW13AMoE" id="gallery02-i">   
    
    

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 content-head">
                <div class="mbr-section-head mb-5">
                <h3 class="mbr-section-title mbr-fonts-style align-center m-0 display-2"><strong><?php echo htmlspecialchars($tituloGaleria); ?></strong></h3>
                <h4 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 mt-4 display-7"><?php echo htmlspecialchars($subTituloGaleria); ?></h4>
                </div>
            </div>
        </div>
        <div class="row mbr-gallery mbr-masonry" data-masonry="{&quot;percentPosition&quot;: true }">
            <div class="col-12 col-md-6 col-lg-3 item gallery-image">
                <div class="item-wrapper" data-toggle="modal" data-bs-toggle="modal" data-target="#umgIjV30xq-modal" data-bs-target="#umgIjV30xq-modal">
                  <!-- editavel -->  <img class="w-100" src="../../assets/images/tumblr-90347fb8d03396f60d6d028c5ceb60be-83827fc2-1280-838x562.jpg" alt="" data-slide-to="0" data-bs-slide-to="0" data-target="#lb-umgIjV30xq" data-bs-target="#lb-umgIjV30xq">
                    <div class="icon-wrapper">
                        <span class="mobi-mbri mobi-mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                    </div>
                </div>
                
            </div>
            <div class="col-12 col-md-6 col-lg-3 item gallery-image">
                <div class="item-wrapper" data-toggle="modal" data-bs-toggle="modal" data-target="#umgIjV30xq-modal" data-bs-target="#umgIjV30xq-modal">
                  <!-- editavel -->  <img class="w-100" src="../../assets/images/img-8077-original-1-838x1117.jpg" alt="" data-slide-to="1" data-bs-slide-to="1" data-target="#lb-umgIjV30xq" data-bs-target="#lb-umgIjV30xq">
                    <div class="icon-wrapper">
                        <span class="mobi-mbri mobi-mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                    </div>
                </div>
                
            </div>
            <div class="col-12 col-md-6 col-lg-3 item gallery-image">
                <div class="item-wrapper" data-toggle="modal" data-bs-toggle="modal" data-target="#umgIjV30xq-modal" data-bs-target="#umgIjV30xq-modal">
                 <!-- editavel -->   <img class="w-100" src="../../assets/images/img-2571-original-838x1117.jpg" alt="" data-slide-to="2" data-bs-slide-to="2" data-target="#lb-umgIjV30xq" data-bs-target="#lb-umgIjV30xq">
                    <div class="icon-wrapper">
                        <span class="mobi-mbri mobi-mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                    </div>
                </div>
                
            </div>
            <div class="col-12 col-md-6 col-lg-3 item gallery-image">
                <div class="item-wrapper" data-toggle="modal" data-bs-toggle="modal" data-target="#umgIjV30xq-modal" data-bs-target="#umgIjV30xq-modal">
                <!-- editavel -->    <img class="w-100" src="../../assets/images/754a4f77-f595-4264-b1b0-32ea701d61ed-675x1200.jpg" alt="" data-slide-to="3" data-bs-slide-to="3" data-target="#lb-umgIjV30xq" data-bs-target="#lb-umgIjV30xq">
                    <div class="icon-wrapper">
                        <span class="mobi-mbri mobi-mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                    </div>
                </div>
                
            </div>
            <div class="col-12 col-md-6 col-lg-3 item gallery-image">
                <div class="item-wrapper" data-toggle="modal" data-bs-toggle="modal" data-target="#umgIjV30xq-modal" data-bs-target="#umgIjV30xq-modal">
                 <!-- editavel -->   <img class="w-100" src="../../assets/images/tumblr-90347fb8d03396f60d6d028c5ceb60be-83827fc2-1280-838x562.jpg" alt="" data-slide-to="4" data-bs-slide-to="4" data-target="#lb-umgIjV30xq" data-bs-target="#lb-umgIjV30xq">
                    <div class="icon-wrapper">
                        <span class="mobi-mbri mobi-mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                    </div>
                </div>
                
            </div>
            <div class="col-12 col-md-6 col-lg-3 item gallery-image">
                <div class="item-wrapper" data-toggle="modal" data-bs-toggle="modal" data-target="#umgIjV30xq-modal" data-bs-target="#umgIjV30xq-modal">
                 <!-- editavel -->   <img class="w-100" src="../../assets/images/italy-736x919.jpg" alt="" data-slide-to="5" data-bs-slide-to="5" data-target="#lb-umgIjV30xq" data-bs-target="#lb-umgIjV30xq">
                    <div class="icon-wrapper">
                        <span class="mobi-mbri mobi-mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                    </div>
                </div>
                
            </div>
            <div class="col-12 col-md-6 col-lg-3 item gallery-image">
                <div class="item-wrapper" data-toggle="modal" data-bs-toggle="modal" data-target="#umgIjV30xq-modal" data-bs-target="#umgIjV30xq-modal">
                <!-- editavel -->    <img class="w-100" src="../../assets/images/the-prettiest-towns-on-lake-como-736x1104.jpg" alt="" data-slide-to="6" data-bs-slide-to="6" data-target="#lb-umgIjV30xq" data-bs-target="#lb-umgIjV30xq">
                    <div class="icon-wrapper">
                        <span class="mobi-mbri mobi-mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="modal mbr-slider" tabindex="-1" role="dialog" aria-hidden="true" id="umgIjV30xq-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="carousel slide" id="lb-umgIjV30xq" data-interval="5000" data-bs-interval="5000">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                            <!-- editavel -->        <img class="d-block w-100" src="../../assets/images/tumblr-90347fb8d03396f60d6d028c5ceb60be-83827fc2-1280-838x562.jpg" alt="">
                                </div>
                                <div class="carousel-item">
                            <!-- editavel -->        <img class="d-block w-100" src="../../assets/images/img-8077-original-1-838x1117.jpg" alt="">
                                </div>
                                <div class="carousel-item">
                             <!-- editavel -->       <img class="d-block w-100" src="../../assets/images/img-2571-original-838x1117.jpg" alt="">
                                </div>
                                <div class="carousel-item">
                            <!-- editavel -->        <img class="d-block w-100" src="../../assets/images/754a4f77-f595-4264-b1b0-32ea701d61ed-675x1200.jpg" alt="">
                                </div>
                                <div class="carousel-item">
                            <!-- editavel -->        <img class="d-block w-100" src="../../assets/images/tumblr-90347fb8d03396f60d6d028c5ceb60be-83827fc2-1280-838x562.jpg" alt="">
                                </div>
                                <div class="carousel-item">
                            <!-- editavel -->        <img class="d-block w-100" src="../../assets/images/italy-736x919.jpg" alt="">
                                </div>
                                <div class="carousel-item">
                              <!-- editavel -->      <img class="d-block w-100" src="../../assets/images/the-prettiest-towns-on-lake-como-736x1104.jpg" alt="">
                                </div>
                            </div>
                            <ol class="carousel-indicators">
                                <li data-slide-to="0" data-bs-slide-to="0" class="active" data-target="#lb-umgIjV30xq" data-bs-target="#lb-umgIjV30xq"></li>
                                <li data-slide-to="1" data-bs-slide-to="1" data-target="#lb-umgIjV30xq" data-bs-target="#lb-umgIjV30xq"></li>
                                <li data-slide-to="2" data-bs-slide-to="2" data-target="#lb-umgIjV30xq" data-bs-target="#lb-umgIjV30xq"></li>
                                <li data-slide-to="3" data-bs-slide-to="3" data-target="#lb-umgIjV30xq" data-bs-target="#lb-umgIjV30xq"></li>
                                <li data-slide-to="4" data-bs-slide-to="4" data-target="#lb-umgIjV30xq" data-bs-target="#lb-umgIjV30xq"></li>
                                <li data-slide-to="5" data-bs-slide-to="5" data-target="#lb-umgIjV30xq" data-bs-target="#lb-umgIjV30xq"></li>
                                <li data-slide-to="6" data-bs-slide-to="6" data-target="#lb-umgIjV30xq" data-bs-target="#lb-umgIjV30xq"></li>
                            </ol>
                            <a role="button" href="" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                            </a>
                            <a class="carousel-control-prev carousel-control" role="button" data-slide="prev" data-bs-slide="prev" href="#lb-umgIjV30xq">
                                <span class="mobi-mbri mobi-mbri-arrow-prev" aria-hidden="true"></span>
                                <span class="sr-only visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next carousel-control" role="button" data-slide="next" data-bs-slide="next" href="#lb-umgIjV30xq">
                                <span class="mobi-mbri mobi-mbri-arrow-next" aria-hidden="true"></span>
                                <span class="sr-only visually-hidden">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php
//rodapé
include '../comun/footer.php';
?>


<script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/smoothscroll/smooth-scroll.js"></script>
  <script src="../../assets/ytplayer/index.js"></script>
  <script src="../../assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="../../assets/vimeoplayer/player.js"></script>
  <script src="../../assets/masonry/masonry.pkgd.min.js"></script>
  <script src="../../assets/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="../../assets/theme/js/script.js"></script>
  <script src="../../assets/gallery/player.min.js"></script>
  <script src="../../assets/gallery/script.js"></script>
  <script src="../../assets/formoid.min.js"></script>
  
  
  
</body>
</html>