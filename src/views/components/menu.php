<?php
require_once __DIR__ . '/../../../config/config.php';
?>
<script src="<?= BASE_URL ?>/js/menu.js"></script>
<div class="left-painel">
	<div class="mini-profilelogo">
		<div>
			<a href="./dashboard">
				<img class="systemlogo" alt="Next Signage" />
				<p>Next<br>Signage</p>
			</a>
		</div>
	</div>
	<div class="botoes">
		<div class="cima">
<!--referencia dos componentes da dashbord e outras telas--->
			<a class="botao conections-menu-button" href="./dashboard">
				<i class="fa-solid fa-plug"></i>
				<p>Conexões</p>
			</a>
			<a class="botao playlists-menu-button" href="./playlists">
				<i class="fa-solid fa-list"></i>
				<p>Playlists</p>
			</a>
		</div>
		<div class="baixo">
			<!-- <a class="botao">
				<i class="fa-solid fa-align-left"></i>
				<p>Documentação</p>
			</a> -->
			<a class="botao">
				<i class="fa-solid fa-people-group"></i>
				<p>Sobre nós</p>
			</a>
			<!-- <a
				class="botao"
				target="_blank"
				rel="noreferrer"
				href="https://github.com/digitalsignageifc/digitalSignage"
			>
				<i class="fa-brands fa-github"></i>
				<p>Github</p>
			</a> -->
		</div>
	</div>
</div>
