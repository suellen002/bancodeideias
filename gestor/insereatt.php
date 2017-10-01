<?php
	session_start();
	include ("conectar.php");
		
	$autentica = $_SESSION["autentica"];
	$email = $_SESSION["email"]; 
	$id =  $_SESSION["idusuario"]; 
	$nome = $_SESSION["nome"];
	$tipo = $_SESSION["tipo"];
	$nomecampus = $_SESSION['nomecampus'];
	$idcampus = $_SESSION['idcampus'];
	
	if(isset($_POST['novaacao'])){
		$data = date("Y-m-d");
		$tituloatt = $_POST['tituloatt'];
		$conteudoatt = $_POST['conteudoatt'];
		$statusproj = $_POST['statusproj'];
		$idprojeto = $_POST['idprojeto'];
		//0 em andamento e 1 finalizado
		
		$tamtituloatt = strlen($tituloatt);
		$tamconteudoatt = strlen($conteudoatt);
		
		
		if(($statusproj == 1) AND ($_POST['primeira'] == 'true')){
			$tituloatt = "";
			$conteudoatt = "Projeto encerrado.";
			$insereatt = mysql_query("INSERT INTO projatt (idproj, data, tituloatt, descricao)
									VALUES ('".$idprojeto."', '".$data."', '".$tituloatt."', '".$conteudoatt."' )");
			$atualizaproj = mysql_query("UPDATE projeto
										SET status = '1'
										WHERE idproj = '".$idprojeto."' ");
										
				$verideia = mysql_query("SELECT idideia
										FROM projeto
										WHERE idproj = '".$idprojeto."' 
										LIMIT 1");
										
				$recebeideia = mysql_fetch_assoc($verideia);
				
				$atualizaideia = mysql_query("UPDATE ideias
										SET status = '3'
										WHERE id = '".$recebeideia['idideia']."' ");
										
			echo "<script type='text/javascript' language='javascript'>
					alert('Projeto finalizado com sucesso!');
					window.location.href='projeto.php';
					</script>";
		}else{
			if($statusproj == 1){
				$tituloatt = "";
				$conteudoatt = "Projeto encerrado.";
				$insereatt = mysql_query("INSERT INTO projatt (idproj, data, tituloatt, descricao)
									VALUES ('".$idprojeto."', '".$data."', '".$tituloatt."', '".$conteudoatt."' )");
				$atualizaproj = mysql_query("UPDATE projeto
										SET status = '1'
										WHERE idproj = '".$idprojeto."' ");
										
				$verideia = mysql_query("SELECT idideia
										FROM projeto
										WHERE idproj = '".$idprojeto."' 
										LIMIT 1");
										
				$recebeideia = mysql_fetch_assoc($verideia);
				
				$atualizaideia = mysql_query("UPDATE ideias
										SET status = '3'
										WHERE id = '".$recebeideia['idideia']."' ");
										
				echo "<script type='text/javascript' language='javascript'>
						alert('Projeto finalizado com sucesso!');
						window.location.href='projeto.php';
						</script>";
			}else{
				if(($tamtituloatt > 10) AND ($tamtituloatt < 100)){
					if(($tamconteudoatt > 50) AND ($tamconteudoatt < 3000)){
						$insereatt = mysql_query("INSERT INTO projatt (idproj, data, tituloatt, descricao)
										VALUES ('".$idprojeto."', '".$data."', '".$tituloatt."', '".$conteudoatt."' )");
										
						echo "<script type='text/javascript' language='javascript'>
								alert('Projeto atualizado com sucesso!');
								window.location.href='projeto.php';
								</script>";
					}else{
						echo "<script type='text/javascript' language='javascript'>
								alert('Conteudo não está dentro do limite de caracteres!');
								window.location.href='projeto.php';
								</script>";
					}
				}else{
					echo "<script type='text/javascript' language='javascript'>
						alert('Título não está dentro do limite de caracteres!');
						window.location.href='projeto.php';
						</script>";			
				}
			}
		}
			
}else{
	if (isset($_POST['nomeprojeto'])){	
		$nomeprojeto = $_POST['nomeprojeto'];	
	}else{
		$nomeprojeto = "";
	}
	
	if ($tipo != "gestor"){
		session_destroy();
		header('Location: login.html');
	}
	
	/*
		Meus projetos
		Docentes
			- Ver docentes
			- Adicionar docente
		Sugerir área
		Noticias
			- Cadastrar
			- Ver minhas notícias
		Fale Conosco
		Logout
		
	*/
	
	if ($autentica AND $email != "" AND $id != "" AND $nome != ""){
		echo "<!DOCTYPE html>
		<html>
		<head>
			<link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
			<meta charset='utf-8'>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			<title>Gestor do portal de inovações</title>
			<link href='assets/plugins/bootstrap/bootstrap.css' rel='stylesheet' />
			<link href='assets/font-awesome/css/font-awesome.css' rel='stylesheet' />
			<link href='assets/plugins/pace/pace-theme-big-counter.css' rel='stylesheet' />
			<link href='assets/css/style.css' rel='stylesheet' />
			<link href='assets/css/main-style.css' rel='stylesheet' />
			<link href='assets/plugins/morris/morris-0.4.3.min.css' rel='stylesheet' />
		   </head>
		<body>
			<div id='wrapper'>
				<nav class='navbar navbar-default navbar-fixed-top' role='navigation' id='navbar'>
					<div class='navbar-header'>
						<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.sidebar-collapse'>
							<span class='sr-only'>Toggle navigation</span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
						</button>
						<a class='navbar-brand' href='index.php'>
							
						</a>
					</div>
				</nav>
				<nav class='navbar-default navbar-static-side' role='navigation'>
					<div class='sidebar-collapse'>
						<ul class='nav' id='side-menu'>
							<li>
								<div class='user-section'>
									<div class='user-info'>
										<div><small>Logado como gestor(a)</small><p>".$nome."</div>
									</div>
								</div>
							</li>
							<li class='sidebar-search'>
							</li>
							<li>
								<a href='index.php'><i class='fa fa-dashboard fa-fw'></i>Início</a>
							</li>
							<li  class='selected'>
								<a href='projeto.php'><i class='fa fa-bar-chart-o fa-fw'></i>Meus Projetos<span class='fa arrow'></span></a>
							</li>
							<li>
								<a href='#'><i class='fa fa-table fa-fw'></i>Gestão de docentes<span class='fa arrow'></a>
								<ul class='nav nav-second-level'>
									<li>
										<a href='novodocente.php'> - Adicionar docente</a>
									</li>
									<li>
										<a href='attdocente.php'> - Alterar docente</a>
									</li>
								</ul>
							</li>
							<li>
								<a href='area.php'><i class='fa fa-edit fa-fw'></i>Sugerir área<span class='fa arrow'></a>
							</li>
							<li>
								<a href='#'><i class='fa fa-wrench fa-fw'></i>Notícias<span class='fa arrow'></span></a>
								<ul class='nav nav-second-level'>
									<li>
										<a href='noticia.php'> - Cadastrar nova notícia</a>
									</li>
									<li>
										<a href='vernoticia.php'> - Ver minhas noticias</a>
									</li>
								</ul>
							</li>
							<li>
								<a href='fconosco.php'><i class='fa fa-sitemap fa-fw'></i>Fale conosco<span class='fa arrow'></span></a>
								<!-- second-level-items -->
							</li>
							<li>
								<a href='logout.php'><i class='fa fa-files-o fa-fw'></i>Logout<span class='fa arrow'></span></a>
							</li>
						</ul>
					</div>
				</nav>
				<div id='page-wrapper'>
			<div class='col-lg-12'>
			<h1 class='page-header'>Atualizar projeto ".$nomeprojeto."</h1>
            <div class='row'>";
				
		
		if (isset($_POST['idprojeto'])){
			echo 
			"<div class='panel panel-default'>
			<div class='panel-heading'>
			<div class='panel-body'>
              <div class='row'>
              <div class='col-lg-10'>
				<form name= 'form1' action='insereatt.php' method='POST'>
					<div class='form-group'>
						<label>Título da atualização</label>
                        <input class='form-control' type='text' name='tituloatt'>
                        <p class='help-block'>Título pode ter entre 10 e 100 caracteres.</p>
                    </div>
                    <div class='form-group'>
                        <label>Conteúdo</label>
                        <textarea class='form-control' rows='5' name='conteudoatt'></textarea>
						<p class='help-block'>Conteúdo pode ter entre 50 e 3000 caracteres.</p>
                    </div>
					<div class='form-group'>
						<label>Status do projeto</label>
						<select name='statusproj' class='form-control'>Status
							<option value='0' checked>Em desenvolvimento</option>
							<option value='1'>Finalizado</option>
						</select>
						<p class='help-block'></p>
                    </div>
					<div>
						<br>
						<button type='submit' class='btn btn-success'>Cadastrar atualização</button>
						<input type='hidden' name='novaacao' value='true'>
						<input type='hidden' name='primeira' value='".$_POST['primeira']."'>
						<input type='hidden' name='idprojeto' value='".$_POST['idprojeto']."'>
					</div>
				</form>";
		}else{
			echo "<script type='text/javascript' language='javascript'>
				alert('Algum dado não foi autenticado corretamente!');
				window.location.href='login.html';
				</script>";
		}								
								
		echo "						</div>
						</div>
						</div>

					</div>

					
				</div>
				<!-- end page-wrapper -->

			</div>
			<!-- end wrapper -->

			<!-- Core Scripts - Include with every page -->
			<script src='assets/plugins/jquery-1.10.2.js'></script>
			<script src='assets/plugins/bootstrap/bootstrap.min.js'></script>
			<script src='assets/plugins/metisMenu/jquery.metisMenu.js'></script>
			<script src='assets/plugins/pace/pace.js'></script>
			<script src='assets/scripts/siminta.js'></script>
			<!-- Page-Level Plugin Scripts-->
			<script src='assets/plugins/morris/raphael-2.1.0.min.js'></script>
			<script src='assets/plugins/morris/morris.js'></script>
			<script src='assets/scripts/dashboard-demo.js'></script>

		</body>

		</html>
		";
	}else{
		echo "<script type='text/javascript' language='javascript'>
				alert('Algum dado não foi autenticado corretamente!');
				window.location.href='login.html';
				</script>";
	}
}
?>