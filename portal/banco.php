<?php
	session_start();
	
		echo "<!DOCTYPE html>
				<html lang='pt-br' style='-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;'>
				<head>
				<meta charset='utf-8' />
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
						<li class='active'><a href='banco.php'>banco de ideias</a></li>
						<li><a href='noticias.php'>notícias</a></li>
						<li><a href='fconosco.html'>fale conosco</a></li>
					</ul>
				</nav>'
		";
		
		if (isset($_SESSION["logado"]) != true){
		echo "
			<form action='bancodados.php' method='POST'>
				<br><br><br>
				<center>
				<table table cellspacing='15' cellpadding='10'>
				<caption>
					<h2>LOGAR NO PORTAL</h2>
				</caption>
				<tr>
					<td>&nbsp;
					</td>
				</tr>
				<tr>
					<td>
						<strong class='quote'>EMAIL:</strong>
					</td>
					<td>
						<input type='text' name='email' size='30' maxlength='30'>
					</td>
				</tr>
				<tr>
					<td>
						<strong class='quote'>SENHA:</strong>
					</td>
					<td>
						<input type='password' name='senha' size='30' maxlength='20'>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<div class='checkbox'>
                        <label>
                            <input name='remember' type='checkbox' value='Remember Me' checked>Lembre-se de mim
                        </label>
                        </div>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						<br>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						<input type='image' src='imagens/login.PNG' value='submit' >
					</td>
				</tr>
			</table>
			<br><br><br>
		</form>
		";
		}else{
			header ("Location: bancodados.php");
		}
		
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
?>