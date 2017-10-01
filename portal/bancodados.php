<?php
	session_start();
	include ("conectar.php");
	
	if (isset($_SESSION['logado'])){
		$email = $_SESSION['email'];
		$senha = $_SESSION['senha'];
	}else{
		$email = $_POST['email'];
		$senha = $_POST['senha'];
	}
	
	if ($email != "" and $senha != ""){
	
		$procura = mysql_query("SELECT nomeEmp, razaoS, nomeRep, cnpj, email, ddd1, tel1, ddd2, tel2, endereco, num, cidade, estado, bairro, senha, id, ativo
								FROM empresa 
								WHERE email = '".$email."' AND senha = '".$senha."'");
								
		if (mysql_num_rows($procura)>0){
			$acessoip = $_SERVER['REMOTE_ADDR'];
			$acessodata = date("Y-m-d");
			$acesso = mysql_query("INSERT into acesso (ip, data)
								VALUES ('".$acessoip."', '".$acessodata."')");
			while ($dados = mysql_fetch_assoc($procura) ) { // Obtém os dados da linha atual e avança para o próximo registro
				if ($dados["ativo"] == 0){
					echo "<script type='text/javascript' language='javascript'>
						alert('Olá ".$dados["nomeRep"]." estamos reativando seu cadastro!');
						</script>";
					//verifica se o usuário está ativo
					$ativa = mysql_query("UPDATE empresa 
										SET ativo = '1'
										WHERE id = '".$dados["id"]."'");
					//muda status da empresa para ativo
					if ($ativa){
						echo "<script type='text/javascript' language='javascript'>
						alert('Cadastro reativado com sucesso');
						</script>";
					}else{
						echo "<script type='text/javascript' language='javascript'>
						alert('Seu cadastro não pode ser reativado');
						window.location.href='banco.php';
						</script>";
						
						session_destroy();						
					}
				}
				$_SESSION["logado"] = true; // informa ao sistema usuario logado
				$_SESSION["nomerepresentante"] = $dados["nomeRep"];
				$_SESSION["nomeEmp"] = $dados["nomeEmp"];
				$_SESSION["razaoS"] = $dados["razaoS"];
				$_SESSION["cnpj"] = $dados["cnpj"];	
				$_SESSION["email"] = $dados["email"];
				$_SESSION["ddd1"] = $dados["ddd1"];
				$_SESSION["tel1"] = $dados["tel1"];
				$_SESSION["ddd2"] = $dados["ddd2"];
				$_SESSION["tel2"] = $dados["tel2"];
				$_SESSION["endereco"] = $dados["endereco"];
				$_SESSION["num"] = $dados["num"];
				$_SESSION["cidade"] = $dados["cidade"];
				$_SESSION["estado"] = $dados["estado"];
				$_SESSION["bairro"] = $dados["bairro"];
				$_SESSION["senha"] = $dados["senha"];
				$_SESSION["id"] = $dados["id"];
				//$_SESSION[""]				
			
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
				
				echo "<br><br>
				<font face='Verdana' size='2'>
				<table border='0' width='970' >
				<caption colspan='2'>BEM VINDO ".$_SESSION['nomerepresentante']."</caption>
				<tr>
					<td>
						<a href='cadastro_nova_ideia.php'><img src='imagens/botaomenu1.PNG' alt='index.html'></a><br>
						<a href='atualiza.php'><img src='imagens/botaomenu2.PNG'></a><br>
						<a href='fconosco.html'><img src='imagens/botaomenu3.PNG'><br>
						<a href='desativa.php'><img src='imagens/botaomenu4.PNG'></a><br>
						<a href='sair.php'><img src='imagens/botaomenu5.PNG'></a><br><br><br><br>
					</td>
					<td colspan='3' rowspan='5'>";
								$procuraideias = mysql_query("SELECT nome, descricao, empresa_id
									FROM ideias 
									WHERE empresa_id = '".$_SESSION["id"]."'");
																									
									if((mysql_num_rows($procuraideias)>0)){
										echo "<p><b>IDEIAS CADASTRADAS POR VOCÊ EM NOSSA BASE DE DADOS:</b><br><br>";									
										while($verideias = mysql_fetch_assoc($procuraideias)){
											echo "<p> Título sugerido: ";
											echo "<b>".$verideias["nome"]."</b>";
											echo "<p> Descrição detalhada:";
											//echo $verideias["descricao"];
											//echo "<textarea cols='60' rows='auto' disabled>";
											echo $verideias["descricao"];
											//echo "</textarea>";
											echo" <br><br><br>";
										}
									}else{
										echo "Você ainda não tem nenhum ideia cadastrada em nossa base de dados.";
									}
				
				
				//footer
				echo "</td></tr></table><div id='footer'>
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
			}
			//se ativo != 1, informa cadastro desativado e registra solicitação de ativação ---- OK
			//cadastrar nova ideia -- OK
			//ver ideias cadastradas -- OK
			//atualizar dados -- OK
			//desativar cadastro -- OK
			//sair (session destroy) -- OK
		}else{
			echo "<script type='text/javascript' language='javascript'>
				alert('Não foi possível realizar o seu login, cnpj ou senha não encontrado!');
				window.location.href='banco.php';
			</script>";
		}
	}else{
		echo "<script type='text/javascript' language='javascript'>
			alert('CNPJ ou Senha em branco!');
			window.location.href='banco.php';
		</script>";		
	}
?>