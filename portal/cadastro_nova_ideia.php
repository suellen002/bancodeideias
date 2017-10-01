<?php
	session_start();
	include ("conectar.php");
	
//TOPO INCONDICIONAL	
	echo "<!DOCTYPE html>
			<html lang='pt-br' style='-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;'>
			<head>
			<meta charset='utf-8'/>
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
		
			<font face='Verdana' size='2'>
			
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
					<li class='active'><a href='banco.php'>banco de ideias</a></li>
					<li><a href='noticias.php'>notícias</a></li>
					<li><a href='fconosco.html'>fale conosco</a></li>
				</ul>
			</nav>'
	";
	
	echo "
		<form action='cadastro_nova_ideia.php' method='POST'>
		<center>
		<table cellpadding='10' cellspacing='10'>
			<br>
			<caption>
				<h2>Cadastrar nova ideia</h2>
			</caption>
			<tr>
				<td>&nbsp;
				</td>
			</tr>
			<tr>
				<td>
					<strong>Título sugerido:</strong></align>
				</td>
				<td>
					<input type='text' name='titulo' size='79' maxlength='75'>
					<input type='hidden' name='envio' value='10'>
				</td>
			</tr>
			<tr>
				<td><strong>Área</strong>
				</td>
				<td>
					<select name='area'>
			";
					
					$buscaarea = mysql_query('SELECT nome, id
								FROM area
								WHERE ativo = 1 ');
					if($buscaarea){
						while($listaarea = mysql_fetch_assoc($buscaarea)){
							echo "<option value='".$listaarea["id"]."'>".$listaarea["nome"]."</option>";
						}
					}
			echo " </select>
				</td>
			</tr>
			<tr>
				<td><strong>Descreva sua ideia:</strong>
				</td>
				<td>
					<textarea cols='81' rows='9' name='descricao' maxlength='990' placeholder='Limite 950 caracteres' >
					</textarea>
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
					<input type='image' src='imagens/botao.PNG' value='submit' >&nbsp;&nbsp;&nbsp;&nbsp;>
				</td>
			</tr>
		</table>
		<br><br>
		</center>
		</form>
	";
	
	//FOOTER INCONDICIONAL TAMBÉM
	echo "<div id='footer'>
		<div class='footer-cols'>
		<div class='col'>
		<h2>Projetos</h2>
		<ul>
			<li><a href='#'>Projeto 1</a></li>
			<li><a href='#'>Projeto 2</a></li>
			<li><a href='#'>Projeto 3</a></li>
			<li><a href='#'>Projeto 4</a></li>
		</ul>
		</div>
		<div class='col'>
			<h2>Parceiros</h2>
			<ul>
				<li><a href='http://www.golin.com.br/' target='_blank'>Metarlugica Golin</a></li>
				<li><a href='http://www.cummins.com.br/' target='_blank'>Cummins</a></li>
				<li><a href='http://www.guarulhos.sp.gov.br/' target='_blank'>Prefeitura de Guarulhos</a></li>
				<li><a href='https://www.totvs.com/' target='_blank'>TOTVS</a></li>
			</ul>
		</div>
		<div class='cl'>&nbsp;</div>
		</div>
		<div class='footer-bottom'>
			<nav class='footer-nav'>
			<ul>
				<li><a href='index.html'>HOME</a></li>
				<li><a href='sobre.html'>sobre nós</a></li>
				<li><a href='if.html'>O if</a></li>
				<li><a href='cadastro.php'>Cadastre-se</a></li>
				<li class='active'><a href='banco.php'>banco de ideias</a></li>
				<li><a href='noticias.php'>notícias</a></li>
				<li><a href='fconosco.html'>fale conosco</a></li>

			</ul>
			</nav>
			<p class='copy'>&copy; Copyright 2016 - Projeto de TCC desenvolvido para o curso de ADS</p>
			<div class='cl'>&nbsp;</div>
			</div>
			</div>
		</div>
		</div>
	</div>
</body>
</html>";	

$nome = $_POST["titulo"];
$descricao = $_POST["descricao"];
$area_id = $_POST["area"];
$hidden = $_POST["envio"];
$id = $_SESSION["id"];
$data = date("Y-m-d");

if ($hidden == 10){
	if ($nome != "" AND $descricao != "" AND $id != ""){
		$insereideia = mysql_query("INSERT INTO ideias (nome, descricao, area_id, empresa_id, data_receb) 
				VALUES ('".$nome."', '".$descricao."', '".$area_id."', '".$id."', '".$data."')");
		
		if($insereideia){
			echo "<script type='text/javascript' language='javascript'>
			alert('Registramos sua ideia! Aguarde a avaliação de viabilidade de um dos nossos administradores');
			window.location.href='banco.php';
			</script>";
		}else{
			echo "<script type='text/javascript' language='javascript'>
			alert('Algo deu errado... redirecionando');
			window.location.href='index.html';
			</script>";
		}
	}else{
		echo "<script type='text/javascript' language='javascript'>
			alert('Você não preencheu todas as opções!');
		</script>";
	}	
}

?>