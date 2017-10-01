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
	
	if (isset($_POST['acao']) AND $_POST['acao'] == "atribuir"){
		$responsavel = $_POST['atribuicao'];
		$identificafc = $_POST['identificador'];
		
		$atualizafaleconosco = mysql_query("UPDATE faleconosco 
										SET atribuicao = '".$responsavel."'
										WHERE id = '".$identificafc."' ");
										
		if($atualizafaleconosco){								
			echo "<script type='text/javascript' language='javascript'>
					alert('Mensagem atribuída ao gestor!');
					window.location.href='fconosco.php';
					</script>";
		}else{
			echo "<script type='text/javascript' language='javascript'>
					alert('Não foi possível atribuir essa mensagem no momento, tente novamente mais tarde!');
					window.location.href='fconosco.php';
					</script>";
		}
	}
	
	if (isset($_POST['meu']) AND $_POST['meu'] == 1082){
		$resp = $_POST['verresposta'];
										
		if($resp == ""){								
			echo "<script type='text/javascript' language='javascript'>
					alert('Mensagem ainda não respondida!');
					window.location.href='fconosco.php';
					</script>";
		}else{
			echo "<script type='text/javascript' language='javascript'>
					alert('".$resp."!');
					window.location.href='fconosco.php';
					</script>";
		}
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
                    <h1 class='page-header'>Mensagens recebidas via fale conosco</h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                        </div>
                        <div class='panel-body'>
                            <div class='table-responsive'>
                                <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                    <thead>
                                        <tr>
											<th>Data</th>
                                            <th>Autor</th>
                                            <th>E-mail</th>
											<th>Título</th>
											<th>Atribuição</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
             
            $buscamensagem = mysql_query("SELECT id, data, nome, email, titulo, atribuicao, mensagem, resposta
										FROM faleconosco
										ORDER BY atribuicao ASC");
															
			if($buscamensagem){
				$verifica = 0;
				while($listamensagem = mysql_fetch_assoc($buscamensagem)){
					if($verifica/2 == 0){
						$cor = "odd gradeA";
						$verifica++;
					}else{
						$cor = "even gradeA";
						$verifica++;
					}
					
					$data = $listamensagem['data'];
					$muda = date('d/m/Y', strtotime($data));
					
					$dadoessencial = $listamensagem['id'];
					$mensagem = $listamensagem['mensagem'];
					$resposta = $listamensagem['resposta'];
							
					echo "<tr class='".$cor."'><td>".$muda."</td>";
					echo "<td>".$listamensagem['nome']."</td>";
					echo "<td>".$listamensagem['email']."</td>";
					echo "<td>".$listamensagem['titulo']."</td>";
					echo "<td><form action='fconosco.php' method='post'>";
					
					if($listamensagem['atribuicao'] == 0){
						echo "<input type='hidden' name='acao' value='atribuir'><select name='atribuicao' class='form-control'>";
						$buscaautor = mysql_query("SELECT nomeusuario, idusuario, tipo
													FROM superusuario 
													WHERE tipo = 1");
																			
						while($listaautor = mysql_fetch_assoc($buscaautor)){
							$autornome = $listaautor['nomeusuario'];
							$auxiliar = $listaautor['tipo'];
							$buscacampus = mysql_query("SELECT nome, id_gestor
														FROM campus
														WHERE id_gestor = '".$listaautor['idusuario']."' ");
															
							while ($vercampus = mysql_fetch_assoc($buscacampus)){
								$nomecampus = $vercampus['nome'];
								$idsuperusuario = $vercampus['id_gestor'];
							};
							echo "<option value='".$idsuperusuario."'>".$autornome." - ".$nomecampus." </option>";															
						}
						echo "<input type='hidden' name='identificador' value='".$dadoessencial."'>
						</select>&nbsp;<button type='submit' class='btn btn-outline btn-success'>Atribuir</button></td>";
					}else{
						echo "<input type='hidden' name='meu' value='1082'>
							<input type='hidden' name='verresposta' value='".$resposta."'>
							<button type='submit' class='btn btn-outline btn-warning'>Ver resposta</button></td>";
					}
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