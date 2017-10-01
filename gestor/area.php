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
	
	echo "<!DOCTYPE html>
		<html>
		<head>
			<meta charset='utf-8'>
			<link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
			<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			<title>Gestor do portal de inovações</title>
			<!-- Core CSS - Include with every page -->
			<link href='assets/plugins/bootstrap/bootstrap.css' rel='stylesheet' />
			<link href='assets/font-awesome/css/font-awesome.css' rel='stylesheet' />
			<link href='assets/plugins/pace/pace-theme-big-counter.css' rel='stylesheet' />
			<link href='assets/css/style.css' rel='stylesheet' />
			<link href='assets/css/main-style.css' rel='stylesheet' />
			<!-- Page Level CSS -->
			<link href='assets/plugins/timeline/timeline.css' rel='stylesheet' />
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
							<li  class='selected'>
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
		<div class='col-lg-10'>
			<h1 class='page-header'>Sugestão de área</h1>
            <div class='row'>";
		
		
				// '".."'
				echo 
				"<div class='panel panel-default'>
			<div class='panel-heading'>
			<div class='panel-body'>
				<form name= 'form1' action='aceitaarea.php' method='POST'>
					<br><br>
					<input type='hidden' name='novaarea' value='992'>
					<div class='form-group'>
						<label>Nome da nova área</label>
                        <input class='form-control' type='text' name='nomearea'>
                        <p class='help-block'>Ex: Biotecnologia</p>
                    </div>
                    <div class='form-group'>
						<label>Sugestão dada por:</label>
						<input class='form-control' name='sugestor' value='".$nome."' disabled>
                    </div>
					<div class='form-group'>
						<label>Status</label>
						<input class='form-control' name='status' value='Inativo - aguardando aceite da administração' disabled>
                    </div>
					<div>
						<br>
						<button type='submit' class='btn btn-success'>Cadastrar Área</button>
					</div>
				</form>
				</div>

				
				<br><br>

                        </div>
                    </div>
                     
                </div>
            </div>
				
			    <script src='assets/plugins/jquery-1.10.2.js'></script>
				<script src='assets/plugins/bootstrap/bootstrap.min.js'></script>
				<script src='assets/plugins/metisMenu/jquery.metisMenu.js'></script>
				<script src='assets/plugins/pace/pace.js'></script>
				<script src='assets/scripts/siminta.js'></script>

		</body>

		</html>";
?>