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
	
	$data = date("Y/m/d");
	$periodo = date('d/m/Y', strtotime('-30 days', strtotime($data)));
	$inicio = date('Y/m/d', strtotime('-30 days', strtotime($data)));
	
	//busca de ideias cadastradas no ultimo mês
	$busca = mysql_query("SELECT * 
							FROM ideias WHERE data_receb
							BETWEEN ('".$inicio."') AND ('".$data."')");
	//ideias totais no portal
	$busca2 = mysql_query("SELECT id
							FROM ideias");
	//ideias em andamento
	$busca3 = mysql_query("SELECT status
							FROM ideias WHERE status = 2 OR status = 3");
		
	//acessos no site no último mês
	$busca4 = mysql_query("SELECT * 
							FROM acesso WHERE data
							BETWEEN ('".$inicio."') AND ('".$data."')");
							
	$busca5 = mysql_query("SELECT * 
							FROM faleconosco WHERE data
							BETWEEN ('".$inicio."') AND ('".$data."')");
	
	$busca6 = mysql_query("SELECT *
							FROM faleconosco
							WHERE atribuicao = NULL AND resposta = NULL");
							
	$busca7 = mysql_query("SELECT *
							FROM empresa WHERE data
							BETWEEN ('".$inicio."') AND ('".$data."')");
							
	$busca8 = mysql_query("SELECT *
							FROM noticias WHERE data
							BETWEEN ('".$inicio."') AND ('".$data."')");
	
	$novasempresas = mysql_num_rows($busca7);
							
	$total = mysql_num_rows($busca2);
	
	$ideiasnomes = mysql_num_rows($busca);
	$desenvolvimento = 0;
	$acesso = mysql_num_rows($busca4);
	$fconosco = mysql_num_rows($busca5);
	$fconoscop= mysql_num_rows($busca6);
	$noticias = mysql_num_rows($busca8);
	
	
	if (mysql_num_rows($busca3) >0){
		$total2 = mysql_num_rows($busca3);
		$desenvolvimento = ($total2 / $total) * 100;
		$desenvolvimento = round($desenvolvimento);
	}
	
	/*
		ITENS MENU
		Ideias
		Campus
		Controle de gestão
		Area
		Noticias
		Fale conosco
		Apoio e projetos
		
	*/
	
	if ($autentica AND $email != "" AND $id != "" AND $nome != ""){
	
		echo "<!DOCTYPE html>
		<html>
		<head>
			<link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
			<meta charset='utf-8'>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			<title>Administrador do portal de inovações</title>
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
										<div><small>Logado como administrador(a)</small><p>".$nome."</div>
									</div>
								</div>
							</li>
							<li class='sidebar-search'>
							</li>
							<li class='selected'>
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
								</i><b> </b>este é o resumo das atividades no portal desde ".$periodo."
							</div>
						</div>
						<!--end  Welcome -->
					</div>


					<div class='row'>
						<!--quick info section -->
						<div class='col-lg-3'>
							<div class='alert alert-danger text-center'>
								<i class='fa fa-calendar fa-3x'></i>&nbsp;<b>".$ideiasnomes."</b> Ideia(s) recebida(s) no último mês

							</div>
						</div>
						<div class='col-lg-3'>
							<div class='alert alert-success text-center'>
								<i class='fa  fa-beer fa-3x'></i>&nbsp;<b>".$desenvolvimento."% </b>Ideias transformadas em projetos  
							</div>
						</div>
						<div class='col-lg-3'>
							<div class='alert alert-info text-center'>
								<i class='fa fa-rss fa-3x'></i>&nbsp;<b>22  </b>Email-s disponíveis na lista de mailing

							</div>
						</div>
						<div class='col-lg-3'>
							<div class='alert alert-warning text-center'>
								<i class='fa  fa-pencil fa-3x'></i>&nbsp;<b>".$novasempresas." </b>Nova(s) empresas cadastradas
							</div>
						</div>
						<!--end quick info section -->
					</div>

					<div class='row'>
						<div class='col-lg-8'>

							<div class='panel panel-primary'>
								<div class='panel-heading'>
									<i class='fa fa-bar-chart-o fa-fw'></i>Últimas ideias recebidas
									<div class='pull-right'>
									</div>
								</div>

								<div class='panel-body'>
									<div class='row'>
										<div class='col-lg-12'>
											<div class='table-responsive'>
												<table class='table table-bordered table-hover table-striped'>
													<thead>
														<tr>
															<th>Data</th>
															<th>Empresa</th>
															<th>Título</th>
															<th>Area</th>
														</tr>
													</thead>
													<tbody>
														";
														//busca de ideias em exibição no inicial
														$buscaideia = mysql_query("SELECT data_receb, empresa_id, nome, area_id, status
															FROM ideias WHERE data_receb
															BETWEEN ('".$inicio."') AND ('".$data."') 
															AND status = 0
															LIMIT 10");
															
														if($buscaideia){
															while($listaideia = mysql_fetch_assoc($buscaideia)){
																//formatar data dia/mês/ano
																$data = $listaideia['data_receb'];
																$muda = date('d/m/Y', strtotime($data));
						
																echo "<tr><td>".$muda."&nbsp;</td>";
																//verificar empresa
																$buscaempresa = mysql_query("SELECT nomeEmp,id
																	FROM empresa 
																	WHERE id = '".$listaideia['empresa_id']."' LIMIT 1");
																	
																while($listaempresa = mysql_fetch_assoc($buscaempresa)){
																	$empresanome = $listaempresa['nomeEmp'];
																}
																	
																echo "<td>".$empresanome."</td>";
																echo "<td>".$listaideia['nome']."</td>";
																//verifica área
																
																//verificar empresa
																$buscaarea = mysql_query("SELECT id, nome
																	FROM area 
																	WHERE id = '".$listaideia['area_id']."' LIMIT 1");
																	
																while($listaarea = mysql_fetch_assoc($buscaarea)){
																	$areanome = $listaarea['nome'];
																}
																echo "<td>".$areanome."</td> </tr>";
															}
														}
														
													echo"
													</tbody>
												</table>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>

						<div class='col-lg-4'>
							<div class='panel panel-primary text-center no-boder'>
								<div class='panel-body yellow'>
									<i class='fa fa-bar-chart-o fa-3x'></i>
									<h3>".$acesso."</h3>
								</div>
								<div class='panel-footer'>
									<span class='panel-eyecandy-title'>Acessos recebidos no portal
									</span>
								</div>
							</div>
							<div class='panel panel-primary text-center no-boder'>
								<div class='panel-body blue'>
									<i class='fa fa-pencil-square-o fa-3x'></i>
									<h3>".$fconoscop."</h3>
								</div>
								<div class='panel-footer'>
									<span class='panel-eyecandy-title'>Mensagens sem resposta/atribuição
									</span>
								</div>
							</div>
							<div class='panel panel-primary text-center no-boder'>
								<div class='panel-body red'>
									<i class='fa fa-thumbs-up fa-3x'></i>
									<h3>".$noticias."</h3>
								</div>
								<div class='panel-footer'>
									<span class='panel-eyecandy-title'>Notícias foram incluídas no portal
									</span>
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