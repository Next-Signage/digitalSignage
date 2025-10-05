<?php
require_once __DIR__ . '/../../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="widp=device-widp, initial-scale=1.0" />
		<title>Dashboard</title>
	
		<link rel="stylesheet" href="<?= BASE_URL ?>/css/variaveis.css" />
		<link rel="stylesheet" href="<?= BASE_URL ?>/css/leftnav.css" />
    	<link rel="stylesheet" href="<?= BASE_URL ?>/css/dashboardstyle.css" />
		<script src="<?= BASE_URL ?>/js/dashboardheader.js"></script>
		<script>
		document.addEventListener("DOMContentLoaded", ()=>{
			document.querySelectorAll(".systemlogo").forEach(element => {
			element.src = "<?= BASE_URL ?>/images/others/logo.png";
			});
		})
		</script>
	</head>
	<body>
		<main>
			<div class="right-painel">
				<div class="up">
					<div class="information">
						<div class="right-info">
							<div class="title">
								<h1>Playlist da cozinha do tio do meu amigo</h1>
							</div>
						</div>
						<div class="left-info">
							<div class="stylisedbutton" id="addfile">
								<i class="fa-solid fa-plus"></i>
								<p>Carregar arquivo</p>
							</div>
							<div class="stylisedbutton" id="associarPlaylist">
								<i class="fa-solid fa-link"> </i> 
								<p>Associar Playlist</p>
							</div>
							<div class="stylisedbutton refresh" id="SaveMidia">
								<i class="fa-solid fa-floppy-disk"></i>
								<p>Salvar Mídia</p>
							</div>
						</div>
					</div>
					<div class="main">
						<div class="table">
							<p class="title">Todas as Mídias</p>
							<div class="linha-info">
								<div><p>Nome</p></div>
								<div><p>Descrição</p></div>
								<div class="center"><p>Data de Adição</p></div>
								<div class="center"><p>Duração</p></div>
								<button style="opacity: 0;"><img src="<?= BASE_URL ?>/images/icons/trash.svg" class="svg-branco" /></button>
							</div>
							<div class="linha">
								<div><p id="namevideo">Video1.mp4</p></div>
								<div><p>Bem vindo ao povo</p></div>
								<div class="center"><p>XX/XX/XXXX</p></div>
								<div class="center"><p>0:03</p></div>
								<div class="end"><i class="fa-solid fa-trash"></i></div>
							</div>
							<div class="linha">
								<div><p id="namevideo">Black Screen.png</p></div>
								<div><p>Transição Magnifica</p></div>
								<div class="center"><p>XX/XX/XXXX</p></div>
								<div class="center"><p>0:03</p></div>
								<div class="end"><i class="fa-solid fa-trash"></i></div>
							</div>
							<div class="linha">
								<div><p id="namevideo">Whatzapp Web 123-456-789-999-999-999-999-999</p></div>
								<div><p>Video pego do zap</p></div>
								<div class="center"><p>XX/XX/XXXX</p></div>
								<div class="center"><p>0:03</p></div>
								<div class="end"><i class="fa-solid fa-trash"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="bottom">
					<button><</button>
					<p>1</p>
					<button>></button>
				</div>
			</div>
		</main>
		<div id="associarPlaylistMSG" style="display: none">
			<div class="blackscreen">
				<p>Associe essa playlist aos seus dispositivos</p>
				<div class="dispositivos">
					<div class="linha-info">
						<div><p>Nome</p></div>
						<div>
							<input
								type="checkbox"
								onchange="
                Array.from(document.getElementsByClassName('linha2')).forEach(element => {
                  element.querySelector('input').checked = this.checked;
                });"
							/>
						</div>
					</div>
					<!-- a mesma coisa dita no comentario acima do elemento do ID "copy-dispositivo" no arquivo conections.html-->
					<div class="linha2" id="copy-dispositivo">
						<div><p>Lorem Ipsum</p></div>
						<div>
							<input type="checkbox" />
						</div>
					</div>
					<div class="linha2">
						<div><p>Lorem Ipsum1</p></div>
						<div>
							<input type="checkbox" />
						</div>
					</div>
					<div class="linha2">
						<div><p>Lorem Ipsum2</p></div>
						<div>
							<input type="checkbox" />
						</div>
					</div>
					<div class="linha2">
						<div><p>Lorem Ipsum3</p></div>
						<div>
							<input type="checkbox" />
						</div>
					</div>
				</div>
				<div>
					<button class="cancelar" id="cancelAssociate">Cancelar</button>
					<button class="confirm" id="AssociatePlaylist">Confirmar</button>
				</div>
			</div>
		</div>
		<input type="file" style="display: none;" id="sendfile" accept=".png,.jpg,.jpeg,.mp4,.avif,.webp,.ico" multiple>
	</body>
	<script src="<?= BASE_URL ?>/js/dashboardjs.js"></script>
	<script>playlistconfig()</script>
</html>
