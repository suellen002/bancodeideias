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

			<!-- Page-Level CSS -->
			<link href='assets/plugins/dataTables/dataTables.bootstrap.css' rel='stylesheet' />
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
									<li class='selected'>
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
									<li class='selected'>
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
                 <!--  page header -->
                <div class='col-lg-12'>
                    <h1 class='page-header'>Ideias recebidas</h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                        Todas as ideias recebidas
                        </div>
                        <div class='panel-body'>
                            <div class='table-responsive'>
                                <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Titulo</th>
                                            <th>Area</th>
                                            <th>Status</th>
                                            <th>Empresa</th>
											<th>Opções</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
             
            $buscaideia = mysql_query("SELECT id, data_receb, nome, area_id, status, empresa_id
										FROM ideias
										ORDER BY status ASC");
															
			if($buscaideia){
				$verifica = 0;
				while($listaideia = mysql_fetch_assoc($buscaideia)){
					if($verifica/2 == 0){
						$cor = "odd gradeA";
						$verifica++;
					}else{
						$cor = "even gradeA";
						$verifica++;
					}
					//formatar data dia/mês/ano
					//	DATA
					$data = $listaideia['data_receb'];
					$muda = date('d/m/Y', strtotime($data));
							
					echo "<tr class='".$cor."'><td>".$muda."</td>";
					//TÍTULO
					echo "<td>".$listaideia['nome']."</td>";
					
					//AREA
					$buscaarea = mysql_query("SELECT id, nome
												FROM area 
												WHERE id = '".$listaideia['area_id']."' LIMIT 1");
																		
					while($listaarea = mysql_fetch_assoc($buscaarea)){
						$areanome = $listaarea['nome'];
					}
					echo "<td>".$areanome."</td>";
					
					//STATUS
					$status = $listaideia['status'];
					if ($status == 0){
						echo "<td>Sem atribuição</td>";
					}
					if ($status == 1){
						echo "<td>Atribuído a gestor</td>";
					}
					if ($status == 2){
						echo "<td>Em desenvolvimento</td>";
					}
					if ($status == 3){
						echo "<td>Concluído</td>";
					}
					if ($status == 4){
						echo "<td>Stand by</td>";
					}
					$empresanome = "";
					//verificar empresa 
					$buscaempresa = mysql_query("SELECT nomeEmp,id
													FROM empresa 
													WHERE id = '".$listaideia['empresa_id']."' LIMIT 1");
																		
					while($listaempresa = mysql_fetch_assoc($buscaempresa)){
						$empresanome = $listaempresa['nomeEmp'];
					}
																		
					echo "<td>".$empresanome."</td>
					<form action='atribuir.php'>";
						$status = $listaideia['status'];
						if ($status == 0){
							echo "<td>
								<a href='atribuir.php?tipo=atribuir&ideia=".$listaideia['id']."' target='_blank' class='btn btn-success'>Atribuir</a>
							</td>";
						}
						if ($status == 1){
							echo "<td>
								<a href='atribuir.php?tipo=andamento&ideia=".$listaideia['id']."' target='_blank' class='btn btn-warning'>Ver detalhes</a>
							</td>";
							
						}
						if ($status == 2){
							echo "<td>
									<a href='atribuir.php?tipo=andamento&ideia=".$listaideia['id']."' target='_blank' class='btn btn-info'>Ver relatório</a>
								</td>"; 
						}
						if ($status == 3){
							echo "<td>
									<a href='atribuir.php?tipo=andamento&ideia=".$listaideia['id']."' target='_blank' class='btn btn-warning'>Ver relatório</a>
								</td>";
						}
						if ($status == 4){
							echo "<td>
								<a href='atribuir.php?tipo=atribuir&ideia=".$listaideia['id']."' target='_blank' class='btn btn-success'>Atribuir</a>
							</td>";
						}
					echo "</form></tr>";												
				}
			}
			
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
			<!-- Page-Level Plugin Scripts-->
			<script src='assets/plugins/dataTables/jquery.dataTables.js'></script>
			<script src='assets/plugins/dataTables/dataTables.bootstrap.js'></script>
			<script>
			$(document).ready(function () {
				$('#dataTables-example').dataTable();
			});
			</script>

		</body>

		</html>";
	}else{
		echo "<script type='text/javascript' language='javascript'>
				alert('Algum dado não foi autenticado corretamente!');
				window.location.href='login.html';
				</script>";
	}
?>