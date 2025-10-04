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
		<link rel="stylesheet" href="<?= BASE_URL ?>/css/dashboardheader.css" />
		<link rel="stylesheet" href="<?= BASE_URL ?>/css/playlistsconfig.css" />
		<script src="<?= BASE_URL ?>/js/dashboardheader.js"></script>
	</head>
	<body>
		<main>
			<div class="right-painel">
				<div class="title" style="display: none">
					<h1>Playlists</h1>
					<div class="search">
						<img src="images/icons/search.svg" class="svg-branco" />
						<input placeholder="Procurar por playlist" />
					</div>
				</div>
				<div class="main">
					<div class="titlemain">
						<div>
							<h1 id="titleplaylist">Playlist da cozinha do tio do meu amigo</h1>
						</div>
						<div>
							<button id="addfile">
								<p><i class="fa-solid fa-plus"> </i> Carregar arquivo</p>
							</button>
							<button id="associarPlaylist">
								<p><i class="fa-solid fa-link"> </i> Associar Playlist</p>
							</button>
							<button id="associarPlaylist">
								<p><i class="fa-solid fa-floppy-disk"> </i> Salvar Mídia</p>
							</button>
						</div>
					</div>
					<div class="playlists">
          				<p>Todas as Mídias</p>
						<div class="linha-info">
							<div><p><i class="fa-solid fa-tag"> </i> Nome</p></div>
							<div><p><i class="fas fa-align-left"> </i> Descrição</p></div>
							<div><p><i class="fa-solid fa-calendar-days"></i> Data de Adição</p></div>
							<div><p><i class="fa-solid fa-clock"></i> Duração</p></div>
							<button style="opacity: 0;"><img src="<?= BASE_URL ?>/images/icons/trash.svg" class="svg-branco" /></button>
						</div>
						<!-- a mesma coisa dita no comentario acima do elemento do ID "copy-dispositivo" no arquivo conections.html
             a única diferença é que é para a playlist -->
						<div class="linha" id="copy-file">
							<div><p id="namevideo">Video1.mp4</p></div>
							<div><p>Bem vindo ao povo</p></div>
							<div><p>XX/XX/XXXX</p></div>
							<div><p>0:03</p></div>
						</div>
						<div class="linha">
							<div><p id="namevideo">Video1.mp4</p></div>
							<div><p>Bem vindo ao povo</p></div>
							<div><p>XX/XX/XXXX</p></div>
							<div><p>0:03</p></div>
							<button><img src="<?= BASE_URL ?>/images/icons/trash.svg"></button>
						</div>
						<div class="linha">
							<div><p id="namevideo">Black Screen.png</p></div>
							<div><p>Transição Magnifica</p></div>
							<div><p>XX/XX/XXXX</p></div>
							<div><p>0:03</p></div>
							<button><img src="<?= BASE_URL ?>/images/icons/trash.svg"/></button>
						</div>
						<div class="linha">
							<div><p id="namevideo">Whatzapp Web 123-456-789-999-999-999-999-999</p></div>
							<div><p>Video pego do zap</p></div>
							<div><p>XX/XX/XXXX</p></div>
							<div><p>0:03</p></div>
							<button><img src="<?= BASE_URL ?>/images/icons/trash.svg"/></button>
						</div>
					</div>
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
		<input type="file" style="display: none;" id="sendfile" accept=".png,.jpg,.jpeg,.mp4,.avif,.webp,.ico">
	</body>
	<script src="<?= BASE_URL ?>/js/playlistconfig.js"></script>
</html>
