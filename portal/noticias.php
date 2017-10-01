<!DOCTYPE html>
<html lang='pt-br' style='-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;'>
	<head>
		<meta name='viewport' content='width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0' />
		<title>Portal de inovações do Instituto federal de Educação, Ciência e Tecnologia de São Paulo - Campus Guarulhos</title>
		<link rel='shortcut icon' type='image/x-icon' href='css/images/favicon.ico' />
		<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
		<link rel='stylesheet' href='css/flexslider.css' type='text/css' media='all' />
		<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500,700' rel='stylesheet' type='text/css' />
				
		<script src='js/jquery-1.8.0.min.js' type='text/javascript'></script>
		<!--[if lt IE 9]>
		<script src='js/modernizr.custom.js'></script>
		<![endif]-->
		<script src='js/jquery.flexslider-min.js' type='text/javascript'></script>
		<script src='js/functions.js' type='text/javascript'></script>
	</head>
	<body>
			
		<div id='wrapper'>
		<div class='shell'>
		<div class='container'>
		<header id='header'>
		<h1 id='logo'><a href='index.html'>Portal de Inovações</a></h1>
		<div class='search'>
		<form method='post'>
			<span class='field'><input type='text' class='field' value='Buscar no portal' title='Buscar no portal' /></span>
			<input type='submit' class='search-btn' value='' />
		</form>
		</div>
		</header>
		<!-- end of header -->
		<!-- navigation -->
		<nav id='navigation'>
		<a href='index.html' class='nav-btn'>HOME<span class='arr'></span></a>
		<ul>
			<li><a href='index.html'>HOME</a></li>
			<li><a href='sobre.html'>sobre nós</a></li>
			<li><a href='if.html'>O if</a></li>
			<li><a href='cadastro.php'>Cadastre-se</a></li>
			<li><a href='banco.php'>banco de ideias</a></li>
			<li class='active'><a href='noticias.php'>notícias</a></li>
			<li><a href='fconosco.html'>fale conosco</a></li>
		</ul>
		</nav>
			<br><br>
			<center><font face="Verdana" size="2">
			
<?php

	include ("conectar.php");
							
	$noticias = mysql_query("SELECT id_autor, titulo, conteudo, data, fonte
									FROM noticias
									ORDER BY id_noticia DESC
									LIMIT 15");
										
	while($listanoticia = mysql_fetch_assoc($noticias)){
		$dataformatada = date('d/m/Y', strtotime($listanoticia['data']));
		echo "<h3><p>".$listanoticia['titulo']."</p></h3>";
		$buscaautor = mysql_query("SELECT nomeusuario, idusuario, tipo
									FROM superusuario 
									WHERE idusuario = '".$listanoticia['id_autor']."' LIMIT 1");
																			
		while($listaautor = mysql_fetch_assoc($buscaautor)){
		$autornome = $listaautor['nomeusuario'];
		$auxiliar = $listaautor['tipo'];
		$buscacampus = mysql_query("SELECT nome, id_gestor
									FROM campus
									WHERE id_gestor = '".$listanoticia['id_autor']."'
									LIMIT 1");
															
			while ($vercampus = mysql_fetch_assoc($buscacampus)){
				$nomecampus = $vercampus['nome'];
			};
																						
		}
		if ($auxiliar == 0){
			echo "Notícia inserida em ".$dataformatada." por Administrador do sistema ".$autornome;
		}else{
			echo "Notícia inserida em ".$dataformatada." por Gestor(a) ".$autornome." do campus ".$nomecampus;
														}
		echo "<p><i>".$listanoticia['titulo']."</i><p><br>";
		echo "<p>".$listanoticia['conteudo']."</p>";
		if(strlen($listanoticia['fonte']) > 15){
			echo "<font>Fonte <a href='".$listanoticia['fonte']."' target='_blank'>".$listanoticia['fonte']."</a></font><br><br>";
		}else{
			echo "<font>Fonte própria</font><br><br>";
		}
	}
	
?>
			
			<br><br>
			
		<br><br><br>
		</center>
				
		<div id="footer">
		<div class="footer-cols">
		<div class="col">
		<h2>Projetos</h2>
		<ul>
			<li><a href="#">Projeto 1</a></li>
			<li><a href="#">Projeto 2</a></li>
			<li><a href="#">Projeto 3</a></li>
			<li><a href="#">Projeto 4</a></li>
		</ul>
		</div>
		<div class="col">
		<h2>Parceiros</h2>
		<ul>
			<li><a href="http://www.golin.com.br/" target="_blank">Metarlugica Golin</a></li>
			<li><a href="http://www.cummins.com.br/" target="_blank">Cummins</a></li>
			<li><a href="http://www.guarulhos.sp.gov.br/" target="_blank">Prefeitura de Guarulhos</a></li>
			<li><a href="https://www.totvs.com/" target="_blank">TOTVS</a></li>
		</ul>
		</div>
		<div class="cl">&nbsp;</div>
		</div>

		<div class="footer-bottom">
		<nav class="footer-nav">
		<ul>
			<li><a href="index.html">HOME</a></li>
			<li><a href="sobre.html">sobre nós</a></li>
			<li><a href="if.html">O if</a></li>
			<li><a href="cadastro.php">Cadastre-se</a></li>
			<li><a href="banco.php">banco de ideias</a></li>
			<li class='active'><a href="noticias.php">notícias</a></li>
			<li><a href="fconosco.html">fale conosco</a></li>
		</ul>
		</nav>
		<p class="copy">&copy; Copyright 2016 - Projeto de TCC desenvolvido para o curso de ADS</p>
		<div class="cl">&nbsp;</div>
		</div>
		</div>
		</div>
		</div>	
	</div>
</body>
</html>