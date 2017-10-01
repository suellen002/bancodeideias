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
							<li class='selected'>
								<a href='index.php'><i class='fa fa-dashboard fa-fw'></i>Início</a>
							</li>
							<li>
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
					<div class='row'>
						<div class='col-lg-12'>
							<h1 class='page-header'>Atividades recentes</h1>
						</div>
					</div>

					<div class='row'>
						<!-- Welcome -->
						<div class='col-lg-12'>
							<div class='alert alert-info'>
								<i class='fa fa-folder-open'></i>&nbsp;Bem vindo(a) de volta Sr.(a) <b>".$nome."</b>
								</i><b> </b>representante do <b> ".$nomecampus."</b>
							</div>
						</div>
						<!--end  Welcome -->
					</div>

					<div class='row'>
						<div class='col-lg-12'>

							<div class='panel panel-primary'>
								<div class='panel-heading'>
									<i class='fa fa-bar-chart-o fa-fw'></i>Ideias recebidas
									<div class='pull-right'>
									</div>
								</div>";
								
						$verideias = mysql_query("SELECT * FROM
													ideias
													WHERE atribuicao = '".$idcampus."' AND status = '1' ");
													
						if (mysql_num_rows($verideias)>0){
							
							while ($listaideias = mysql_fetch_assoc($verideias)){
								$nomesugerido = $listaideias['nome'];
								$descricao = $listaideias['descricao'];
								$data = date('d/m/Y', strtotime($listaideias['data_receb']));
								$ideiaid = $listaideias['id'];
								$empresaid = $listaideias['empresa_id'];
								$areaid = $listaideias['area_id'];
								
								$buscaarea = mysql_query("SELECT * FROM area
													WHERE id = '".$areaid."' LIMIT 1");
													
								$mostraarea = mysql_fetch_assoc($buscaarea);

								echo "<div class='row'>
										<form action='atribuir.php' method='post'>
										<div class='col-lg-12'>
											<div class='panel panel-default'>
												<div class='panel-body'>
													<h3 id='grid-responsive-resets'>".$nomesugerido."</h3>
													<p>".$descricao."</p>
													<div class='row show-grid'>
														<div class='col-xs-6 col-sm-3'>Recebida em ".$data."
														</div>
														<div class='col-xs-6 col-sm-5'>Relativa a: ".$mostraarea['nome']."</div>
														<div class='clearfix visible-xs'></div>

														<div class='col-xs-6 col-sm-3'><a href='atribuir.php?tipo=visualizar&ideia=".$ideiaid."'>Mais informações</a></div>
													</div>
												</div>
											</div>
										</div>
									   
									</div>";
							}
						}else{
							echo "<div class='row'>
									<div class='col-lg-12'>
										<div class='panel panel-default'>
											<div class='panel-body'>
												<h3 id='grid-responsive-resets'>O ".$nomecampus." não recebeu nenhuma nova ideia</h3>
											</div>
										</div>
									</div>
								   
								</div>";
						}
							
							echo "
						</div>
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
?>