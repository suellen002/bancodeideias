<?php
	session_start();
	
	//$operacao = $_GET['operacao'];
	
	echo "<!DOCTYPE html>
	<html lang='pt-br' style='-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;'>
	<head>
	<meta http-equiv='Content-Type'/>
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
	<!-- wraper -->
	<div id='wrapper'>
		<!-- shell -->
		<div class='shell'>
			<!-- container -->
			<div class='container'>
				<!-- header -->
				<header id='header'>
					<h1 id='logo'><a href='index.html'>Portal de Inovações</a></h1>
					<!-- search -->
					<div class='search'>
						<form method='post'>
							<span class='field'><input type='text' class='field' value='Buscar no portal' title='Buscar' /></span>
							<input type='submit' class='search-btn' value='' />
						</form>
					</div>
					<!-- end of search -->
				</header>
				<!-- end of header -->
				<!-- navigation -->
				<nav id='navigation'>
					<a href='index.html' class='nav-btn'>HOME<span class='arr'></span></a>
					<ul>
						<li><a href='index.html'>HOME</a></li>
						<li><a href='sobre.html'>sobre nós</a></li>
						<li><a href='if.html'>O if</a></li>
						<li class='active'><a href='cadastro.php'>Cadastre-se</a></li>
						<li><a href='banco.php'>banco de ideias</a></li>
						<li><a href='noticias.php'>notícias</a></li>
						<li ><a href='fconosco.html'>fale conosco</a></li>
					</ul>
				</nav>
				<section class='testimonial'>
				<form action='atualiza2.php' method='POST'>
					<center>
					<br><br><br>
					<table cellpadding='10' cellspacing='10'>
						<caption>
							<h2>ATUALIZAÇÃO DE DADOS CADASTRAIS</h2>
						</caption>
						<tr>
							<td>
								<strong class='quote'><i>Nome da empresa:</i></strong>
							</td>
							<td>
								<input type='text' name='nomeempresa' size='50' maxlength='100' value='".$_SESSION["nomeEmp"]."'>
							</td>
						</tr>
						<tr>
							<td>
								<strong class='quote'><i>Razão social:</i></strong>
							</td>
							<td>
								<input type='text' name='razaosocial' size='50' maxlength='100' value='".$_SESSION["razaoS"]."'>
							</td>
						</tr>
						<tr>
							<td>
								<strong class='quote'><i>Cnpj:</i></strong>
							</td>
							<td>
								<input type='text' name='cnpj' size='50' maxlength='100' value='".$_SESSION["cnpj"]."' disabled>
							</td>
						</tr>
						<tr>
							<td>
								<strong class='quote'><i>Senha:</i></strong>
							</td>
							<td>
								<input type='password' name='senha' size='20' maxlength='10' value='".$_SESSION["senha"]."'>
							</td>
						</tr>
						<tr>
							<td>
								<strong class='quote'><i>Nome do representante da empresa:</i></strong>
							</td>
							<td>
								<input type='text' name='nomerepre' size='50' maxlength='100' value='".$_SESSION["nomerepresentante"]."'>					
								<strong class='quote'><i>
							</td>
						</tr>
						<tr>
							<td>
								<i><strong>E-mail:</i></strong>
							</td>
							<td>
								<input type='text' name='email' size='50' maxlength='100' value='".$_SESSION["email"]."'>
							</td>
							<td>
								<strong class='quote'><i>
							</td>
						</tr>
						<tr>
							<td>
								<i><strong>Telefone 1:</i></strong>
							</td>
							<td>
								<input type='text' name='ddd1' size='4' maxlength='2' value='".$_SESSION["ddd1"]."'> - <input type='text' name='tel1' size='15' maxlength='10' value='".$_SESSION["tel1"]."'>
							</td>
						</tr>
						<tr>
							<td>
								<strong class='quote'><i>Telefone 2:</i></strong></align>
							</td>
							<td>
								<input type='text' name='ddd2' size='4' maxlength='2' value='".$_SESSION["ddd2"]."'> - <input type='text' name='tel2' size='15' maxlength='10' value='".$_SESSION["tel2"]."'>
							</td>
						</tr>
						<tr>
							<td>
								<p><strong class='quote'><i>Endereço:</i></strong>
							</td>
							<td>
								<input type='text' name='endereco' size='50' maxlength='100'><p><strong class='quote' value='".$_SESSION["endereco"]."'><i>
							</td>
						<tr>
							<td>
								<i><strong>N°:</i></strong>
							</td>
							<td>
								<input type='text' name='endnum' size='4' maxlength='4' value='".$_SESSION["num"]."'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<strong class='quote'>
								<i><strong>Bairro:</i></strong>
								<input type='text' name='bairro' size='30' maxlength='35' value='".$_SESSION["bairro"]."'>
						</tr>
						<tr>
							<td>
								<strong class='quote'><i><strong>Cidade:</i></strong></align>
							</td>
							<td>
								<input type='text' name='cidade' size='25' maxlength='35' value='".$_SESSION["cidade"]."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<strong class='quote'><i><strong>Estado:</i></strong>
								<select name='estado' disabled>
									<option value='SP' selected>São Paulo</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td>
								<input type='image' src='imagens/botao.PNG' value='submit' >
							</td>
						</tr>
					</table>
					</center>
					<br><br><br>
				</form>
				</section>
				<div id='footer'>
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
					<!-- end of footer-cols -->
					<div class='footer-bottom'>
						<nav class='footer-nav'>
							<ul>
								<li><a href='index.html'>HOME</a></li>
								<li><a href='sobre.html'>sobre nós</a></li>
								<li><a href='if.html'>O if</a></li>
								<li class='active'><a href='cadastro.php'>Cadastre-se</a></li>
								<li><a href='banco.php'>banco de ideias</a></li>
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