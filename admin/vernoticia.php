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
	
		
	if ($autentica AND $email != "" AND $id != "" AND $nome != ""){
	
		echo "<!DOCTYPE html>
		<html>
		<head>
			<meta charset='utf-8'>
			<link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
			<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			<title>Portal do administrador</title>
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
										<a href='novog.php'> - Cadastrar novo gestor</a>
									</li>
									<li>
										<a href='novoa.php'> - Cadastrar novo administrador</a>
									</li>
								</ul>
							</li>
							<li>
								<a href='#'><i class='fa fa-wrench fa-fw'></i>Area<span class='fa arrow'></span></a>
								<ul class='nav nav-second-level'>
									<li  class='selected'>
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
									<li class='selected'>
										<a href='vernoticia.php'> - Ver notícias mais recentes</a>
									</li>
									<li>
										<a href='noticia.php'> - Adicionar nova notícia</a>
									</li>
								</ul>
								<!-- second-level-items -->
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
				
				<div id='page-wrapper'>";
				
		echo " 
			<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'>
                            <i class='fa fa-clock-o fa-fw'></i>Notícias cadastradas do último ano
                        </div>
                        <div class='panel-body'>
                        <ul class='timeline'>";
							
							$contador = 0;
							
							$data = date("Y/m/d");
							$inicio = date('Y/m/d', strtotime('-365 days', strtotime($data)));
							
							$noticias = mysql_query("SELECT id_autor, titulo, conteudo, data, fonte
														FROM noticias
														WHERE data
														BETWEEN ('".$inicio."') AND ('".$data."')");
										
							if($noticias){
								while($listanoticia = mysql_fetch_assoc($noticias)){
									$dataformatada = date('d/m/Y', strtotime($listanoticia['data']));
									if ($contador == 0){
										echo "<li class='timeline-inverted'>
											<div class='timeline-badge warning'>
												<i class='fa fa-credit-card'></i>
											</div>
											<div class='timeline-panel'>
												<div class='timeline-heading'>
													<h4 class='timeline-title'>".$listanoticia['titulo']."</h4>
												</div>
												<div class='timeline-body'><font color='grey'>
													<p>Cadastrado em: ".$dataformatada."</p></font>
												</div>
												<div class='timeline-body'><font color='grey'>
													<p>Por: ";
													if($listanoticia['id_autor'] != $id){
														
														$buscaautor = mysql_query("SELECT nomeusuario, idusuario, tipo
														FROM superusuario 
														WHERE idusuario = '".$listanoticia['id_autor']."' LIMIT 1");
																			
														while($listaautor = mysql_fetch_assoc($buscaautor)){
															$autornome = $listaautor['nomeusuario'];
															$auxiliar = $listaautor['tipo'];
															$buscacampus = mysql_query("SELECT nome, id_gestor
																						FROM campus
																						WHERE id_gestor = '".$listanoticia['id_autor']."'
																						LIMIT 1");
															
															while ($vercampus = mysql_fetch_assoc($buscacampus)){
																$nomecampus = $vercampus['nome'];
															};
																						
														}
														if ($auxiliar == 0){
															echo "Administrador ".$autornome;
														}else{
														echo "Gestor(a) ".$autornome." do campus ".$nomecampus;
														}
													}else{
														echo "Você mesmo.";
													}
													echo "</p></font>
												</div>
												<div class='timeline-body'>
													<p>".$listanoticia['conteudo']."</p>
												</div>
												<br>
												<div class='timeline-body'><font color='grey'>
													<p>Fonte: ".$listanoticia['fonte']."</p></font>
												</div>
											</div>
										</li>
										";
										$contador=1;
									}else{
										echo "<li>
											<div class='timeline-badge danger'>
												<i class='fa fa-credit-card'></i>
											</div>
											<div class='timeline-panel'>
												<div class='timeline-heading'>
													<h4 class='timeline-title'>".$listanoticia['titulo']."</h4>
												</div>
												<div class='timeline-body'><font color='grey'>
													<p>Cadastrado em: ".$dataformatada."</p></font>
												</div>
												<div class='timeline-body'><font color='grey'>
													<p>Por: ";
													if($listanoticia['id_autor'] != $id){
														
														$buscaautor = mysql_query("SELECT nomeusuario, idusuario, tipo
														FROM superusuario 
														WHERE idusuario = '".$listanoticia['id_autor']."' LIMIT 1");
																			
														while($listaautor = mysql_fetch_assoc($buscaautor)){
															$autornome = $listaautor['nomeusuario'];
															$auxiliar = $listaautor['tipo'];
															$buscacampus = mysql_query("SELECT nome, id_gestor
																						FROM campus
																						WHERE id_gestor = '".$listanoticia['id_autor']."'
																						LIMIT 1");
															
															while ($vercampus = mysql_fetch_assoc($buscacampus)){
																$nomecampus = $vercampus['nome'];
															};
																						
														}
														if ($auxiliar == 0){
															echo "Administrador ".$autornome;
														}else{
														echo "Gestor(a) ".$autornome." do campus ".$nomecampus;
														}
													}else{
														echo "Você mesmo.";
													}
													echo "</p></font>
												</div>
												<div class='timeline-body'>
													<p>".$listanoticia['conteudo']."</p>
												</div>
												<br>
												<div class='timeline-body'><font color='grey'>
													<p>Fonte: ".$listanoticia['fonte']."</p></font>
												</div>
											</div>
										</li>";
										$contador=0;
									}
								}
							}else{
								echo "Não há notícias cadastradas";
							}
							echo "
                            </ul>
                        </div>

                    </div>
                    <!--End Timeline -->
                </div>
            </div>
			
		";
		
		echo "
									</tbody>
                                </table>
                            </div>
                            
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