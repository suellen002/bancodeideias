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
	
	if(isset($_POST['insereresposta']) AND (is_numeric($_POST['idmensagem']))){
		$resposta = $_POST['resposta'];
		$idfaleconosco = $_POST['idmensagem'];
		
		$atualizaresposta = mysql_query("UPDATE faleconosco 
										SET resposta = '".$resposta."'
										WHERE id = '".$idfaleconosco."' ");
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
							<li  class='selected'>
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
			<h1 class='page-header'>Mensagens atribuídas ao ".$nomecampus."</h1>
            <div class='row'>";
		
		
				$vermensagens = mysql_query("SELECT * FROM
											faleconosco
											WHERE atribuicao = '".$id."' 
											ORDER BY resposta ASC");
											
				if(mysql_num_rows($vermensagens)>0){
											
					while($listamnsagem = mysql_fetch_assoc($vermensagens)){
						$nomeautor = $listamnsagem['nome'];
						$titulo = $listamnsagem['titulo'];
						$conteudo = $listamnsagem['mensagem'];
						$emailautor = $listamnsagem['email'];
						$resposta = $listamnsagem['resposta'];
						$data = date('d/m/Y', strtotime($listamnsagem['data']));
						$idmensagem = $listamnsagem['id'];
						
						echo 
						"<div class='panel panel-default'>
							<div class='panel-heading'>
								<form name= 'form1' action='fconosco.php' method='POST'>
									<br>
									<input type='hidden' name='insereresposta' value='998'>
									<input type='hidden' name='idmensagem' value='".$idmensagem."'>
									<div class='form-group'>
										<label>Recebida em ".$data." por </label>
										<input class='form-control' type='text' name='nomearea' value='".$nomeautor." - ".$emailautor."' disabled>
									</div>
									<div class='form-group'>
										<label>".$titulo."</label>
										<textarea class='form-control' rows='2' name='conteudo' disabled>".$conteudo."</textarea>
									</div>
									";
									
									if($resposta == NULL){
										echo "
										<div class='form-group'>
											<label>Resposta</label>
											<textarea class='form-control' rows='2' name='resposta' placeholder='Limite 500 caracteres'></textarea>
										</div>
										<div>
											<br>
											<button type='submit' class='btn btn-info'>Envia resposta</button>
										</div>
										";
									}else{
										echo "
										<div class='form-group'>
											<label>Resposta</label>
											<textarea class='form-control' rows='2' name='resposta' disabled>".$resposta."</textarea>
										</div>
										<div>
											<br>
											<button type='submit' class='btn btn-info' disabled>Resposta já enviada</button>
										</div>
										";
									}
									echo "
								</form>
							</div><br></div>";
					}
				}else{
					echo "<div class='panel panel-default'>
							<div class='panel-heading'>
									<div class='form-group'>
										<label>Nenhuma mensagem atribuída a esse campus até o momento.</label>
									</div>
							</div>
							</div>";
				}
                     
                echo "</div>
            </div>
				
			    <script src='assets/plugins/jquery-1.10.2.js'></script>
				<script src='assets/plugins/bootstrap/bootstrap.min.js'></script>
				<script src='assets/plugins/metisMenu/jquery.metisMenu.js'></script>
				<script src='assets/plugins/pace/pace.js'></script>
				<script src='assets/scripts/siminta.js'></script>

		</body>

		</html>";
?>