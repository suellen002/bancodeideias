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
					<div class='row'>
						<div class='col-lg-12'>
							<h1 class='page-header'>Meus projetos</h1>
						</div>
					</div>
					
					<div class='row'>
						<div class='col-lg-12'>

							<div class='panel panel-primary'>
								<div class='panel-heading'>
									<i class='fa fa-bar-chart-o fa-fw'></i>Projetos vinculados ao ".$nomecampus."
									<div class='pull-right'>
									</div>
								</div>";
								
						$verprojetos = mysql_query("SELECT * FROM
													projeto
													WHERE projresp = '".$id."'
													ORDER BY status ASC");
													
						if (mysql_num_rows($verprojetos)>0){
							
							while ($listaprojetos = mysql_fetch_assoc($verprojetos)){
								
								$nomeprojeto = $listaprojetos['nomeproj'];
								$proposta = $listaprojetos['proposta'];
								$statusproj = $listaprojetos['status'];
								$idprojeto = $listaprojetos['idproj'];

								echo "<div class='row'>
									<form action='insereatt.php' method='post'>
									<div class='col-lg-12'>
										<div class='panel panel-default'>
											<div class='panel-body'>
												<h3 id='grid-responsive-resets'>".$nomeprojeto."</h3>
												<p><i>EQUIPE COMPOSTA POR: ".$nome." - líder";
												$verenvolvidos = mysql_query("SELECT * FROM projparticipante
																				WHERE idproj = '".$idprojeto."' ");
																				
												while ($listaenvolvidos = mysql_fetch_assoc($verenvolvidos)){
													$buscadocente = mysql_query("SELECT iddocente, nomedoc, campus
																						FROM docente
																						WHERE iddocente = '".$listaenvolvidos['iddocente']."' ");
																						
													while($listadocente = mysql_fetch_assoc($buscadocente)){
														echo ", ".$listadocente['nomedoc']." - ";
														
														if($listadocente['campus'] == $_SESSION['idcampus']){
															echo $_SESSION['nomecampus'];
														}else{
															$buscacampus = mysql_query("SELECT id_campus, nome
																							FROM campus
																							WHERE id_campus = '".$listadocente['campus']."' 
																							LIMIT 1");
																							
															$mostranomecampus = mysql_fetch_assoc($buscacampus);
															echo $mostranomecampus['nome'];
														}
													}
												}
												echo "</i></p>
												<p>".$proposta."</p>
												<div class='row show-grid'>";
												
												$vertematt = mysql_query("SELECT * FROM
																					projatt
																					WHERE idproj = '".$idprojeto."'
																					ORDER BY data");
																					
												if (mysql_num_rows($vertematt)>0){
													while($mostraatt = mysql_fetch_assoc($vertematt)){
														$tituloatt = $mostraatt['tituloatt'];
														$conteudoatt = $mostraatt['descricao'];
														$dataatt = date('d/m/Y', strtotime($mostraatt['data']));
														echo "<div class='col-xs-12 col-sm-12'><p><b>".$tituloatt."</b></p>";
														echo "<p>".$conteudoatt."</p>
														<p><i>".$dataatt."</p></i><br><div>";
													}
													if ($statusproj == 0){
														echo "<p><button type='submit' class='btn btn-success'>Inserir mais informações.</button>
														<input type='hidden' name='primeira' value='false'>
														<input type='hidden' name='idprojeto' value='".$idprojeto."'>
														<input type='hidden' name='nomeprojeto' value='".$nomeprojeto."'></p><br></div>";
													}else{
														echo " <button type='button' class='btn btn-success disabled'>Projeto finalizado</button>
														<input type='hidden' name='imprime' value='sim'>
														<button type='button' class='btn btn-info' onclick='window.print()'>Imprimir progressos</button></div>";
													}
													
												}else{
													echo "<div class='col-xs-12 col-sm-12'><i><p>Projeto não tem nenhuma atualização até o momento</i></p><br>";
													echo "<p><button type='submit' class='btn btn-success'>Inserir mais informações.</button>
															<input type='hidden' name='primeira' value='true'>
															<input type='hidden' name='idprojeto' value='".$idprojeto."'>
															<input type='hidden' name='nomeprojeto' value='".$nomeprojeto."'></p></div></div></div>";
												}
												
												echo "
												</div>
												</form>
											</div>
										</div>									   
									</div>";
							}
						}else{
							echo "
								<div class='row'>
									<div class='col-lg-12'>
										<div class='panel panel-default'>
											<div class='panel-body'>
												<h3 id='grid-responsive-resets'>O ".$nomecampus." não é autor de nenhum projeto no momento</h3>
											</div>
										</div>
									</div>
								   
								</div>";
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
?>