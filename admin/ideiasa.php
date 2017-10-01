<?php
	session_start();
	include ("conectar.php");
		
	$autentica = $_SESSION["autentica"];
	$email = $_SESSION["email"]; 
	$id =  $_SESSION["idusuario"]; 
	$nome = $_SESSION["nome"];
	$tipo = $_SESSION["tipo"];
	
	if ($tipo != "adm"){
		session_destroy();
		header('Location: login.html');
	}
	
	$auxiliar["1"] = "collapseOne";
	$auxiliar["2"] = "collapseTwo";
	$auxiliar["3"] = "collapseThree";
	$auxiliar["4"] = "collapseFour";
	$auxiliar["5"] = "collapseFive";
	$auxiliar["6"] = "collapseSix";
	$auxiliar["7"] = "collapseSeven";
	$auxiliar["8"] = "collapseEight";
	$auxiliar["9"] = "collapseNine";
	$auxiliar["10"] = "collapseTen";

		
	if ($autentica AND $email != "" AND $id != "" AND $nome != ""){
	
		echo "<!DOCTYPE html>
		<html>
		<head>
			<meta charset='utf-8'>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			<title>Portal do administrador</title>

			<link href='assets/plugins/bootstrap/bootstrap.css' rel='stylesheet' />
			<link href='assets/font-awesome/css/font-awesome.css' rel='stylesheet' />
			<link href='assets/plugins/pace/pace-theme-big-counter.css' rel='stylesheet' />
			<link href='assets/css/style.css' rel='stylesheet' />
			<link href='assets/css/main-style.css' rel='stylesheet' />
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
										<div><small>Logado como administrador(a)</small><p>".$nome."</div>
									</div>
								</div>
							</li>
							<li class='sidebar-search'>
							</li>
							<li>
								<a href='index.php'><i class='fa fa-dashboard fa-fw'></i>Início</a>
							</li>
							<li>
								<a href='#'><i class='fa fa-bar-chart-o fa-fw'></i>Ideias<span class='fa arrow'></span></a>
								<ul class='nav nav-second-level'>
									<li>
										<a href='ideias.php'> - Visualizar ultimas</a>
									</li>
									<li class='selected'>
										<a href='ideiasa.php'> - Atribuir ideias</a>
									</li>
								</ul>
							</li>
							 <li>
								<a href='#'><i class='fa fa-flask fa-fw'></i>Projetos<span class='fa arrow'></a>
								<ul class='nav nav-second-level'>
									<li>
										<a href='projeto.php'> - Visualizar aceites</a>
									</li>
									<li>
										<a href='projetoa.php'> - Visualizar andamentos</a>
									</li>
								</ul>
							</li>
							<li>
								<a href='#'><i class='fa fa-table fa-fw'></i>Campus<span class='fa arrow'></a>
								<ul class='nav nav-second-level'>
									<li>
										<a href='inserecampus.php'> - Adicionar campus</a>
									</li>
									<li>
										<a href='campus.php'> - Alterar/remover campus</a>
									</li>
								</ul>
							</li>
							<li>
								<a href='forms.html'><i class='fa fa-edit fa-fw'></i>Controle de gestão<span class='fa arrow'></a>
								<ul class='nav nav-second-level'>
									<li>
										<a href='novo.php'> - Cadastrar novo gestor</a>
									</li>
									<li>
										<a href='novo.php'> - Cadastrar novo administrador</a>
									</li>
								</ul>
							</li>
							<li>
								<a href='#'><i class='fa fa-wrench fa-fw'></i>Area<span class='fa arrow'></span></a>
								<ul class='nav nav-second-level'>
									<li>
										<a href='area.php'> - Visualizar areas cadastradas</a>
									</li>
									<li>
										<a href='novaarea.php'> - Cadastrar nova area</a>
									</li>
								</ul>
							</li>
							<li>
								<a href='#'><i class='fa fa-sitemap fa-fw'></i>Notícias<span class='fa arrow'></span></a>
								<ul class='nav nav-second-level'>
									<li>
										<a href='vernoticia.php'> - Ver notícias mais recentes</a>
									</li>
									<li>
										<a href='noticia.php'> - Adicionar nova notícia</a>
									</li>
								</ul>
								<!-- second-level-items -->
							</li>
							<li>
								<a href='logout.php'><i class='fa fa-files-o fa-fw'></i>Logout<span class='fa arrow'></span></a>
							</li>
						</ul>
					</div>
				</nav>
				
		<div id='page-wrapper'>
			
			<!--  atribuição de ideias -->
			<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            Atribuição de ideias
                        </div>
                        <div class='panel-body'>
                            <div class='panel-group' id='accordion'>
								";
								
							$buscaideia = mysql_query("SELECT nome, descricao, status, id
														FROM ideias
														WHERE status != 2 AND status != 3
														ORDER BY status DESC");
														
							if($buscaideia){
								
								$i = 1;
								while($listaideia = mysql_fetch_assoc($buscaideia)){	
									echo "
									<form method='post' action='ideiasaa.php'>
										<div class='panel panel-default'>
											<div class='panel-heading'>
												<h4 class='panel-title'>
												<a data-toggle='collapse' data-parent='#accordion' href='#collapseOne'>".$listaideia['nome']."</a>
												<input type='hidden' name='ideia' value='".$listaideia['id']."'>
												</h4>
											</div>
											<div id='".$auxiliar[$i]."' class='panel-collapse collapse in'>
												<div class='panel-body'>
													".$listaideia['descricao']."
													<br><br>
													Atribuir a docente: <select name='docente' id='docente'>
													<option value='falso'> Escolher docente - </option>";
													
												$buscadocente = mysql_query("SELECT id_docente, nome, campus_id
														FROM docente");
														
													while($listadocente = mysql_fetch_assoc($buscadocente)){
														
														//buscar area do docente
														$areadocente = mysql_query("SELECT docente_id, area_id
															FROM docentearea
															WHERE docente_id = '".$listadocente['id_docente']."' ");
															
														while ($listaidarea = mysql_fetch_assoc($areadocente)){
															$areadocente = $listaidarea['area_id'];
														}
															
															$buscaarea = mysql_query("SELECT id, nome
																FROM area 
																WHERE id = '".$areadocente['area_id']."' LIMIT 1");
																						
																while($listaarea = mysql_fetch_assoc($buscaarea)){
																	$areanome = $listaarea['nome'];
																} 
																
														//procurar campus do docente
														$campusdocente = mysql_query("SELECT id_campus, nome
															FROM campus
															WHERE id_campus = '".$listadocente['campus_id']."' ");
															
															while($listacampus = mysql_fetch_assoc($campusdocente)){
																	$campus = $listacampus['nome'];
																}
															
														echo "<option value='".$listadocente['id_docente']."'>".$listadocente['nome']." - ".$areanome." - ".$campus."</option>";
													}
														
													echo "													
													</select><br><br>";
													if ($listaideia['status'] == 0){
														echo "<input type='checkbox' name='desativa' value='1' id='desativa' disabled> <font color='red'>Ideia já em Stand-by&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>";
													}else{
														echo "<input type='checkbox' name='desativa' value='1' id='desativa'> Colocar ideia em Stand-by";
													}
													echo "
													
													
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<button type='submit' class='btn btn-success'>Salvar escolha</button>
												</div>
											</div>
										</div>
									</form>";
									$i++;
								}
							}
							
						echo "
                        </div>
                    </div>
                     <!--Fim da mostra de ideias -->
                </div>
            </div>
				
				<!-- end wrapper -->

			    <script src='assets/plugins/jquery-1.10.2.js'></script>
				<script src='assets/plugins/bootstrap/bootstrap.min.js'></script>
				<script src='assets/plugins/metisMenu/jquery.metisMenu.js'></script>
				<script src='assets/plugins/pace/pace.js'></script>
				<script src='assets/scripts/siminta.js'></script>

		</body>

		</html>";
	}else{
		echo "<script type='text/javascript' language='javascript'>
				alert('Algum dado não foi autenticado corretamente!');
				window.location.href='login.html';
				</script>";
	}
?>