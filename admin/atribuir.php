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
	
	if (isset($_POST['checa']) AND isset($_POST['gestorescolhido']) AND isset($_POST['ideiaescolida'])){
		$gestor = $_POST['gestorescolhido'];
		$ideia = $_POST['ideiaescolida'];
		
		if($gestor > 0){
			$atualizaideia = mysql_query("UPDATE ideias
											SET status = '1', atribuicao = '".$gestor."'
											WHERE id = '".$ideia."' ");
			echo "<script>
					window.close();
				</script>";
		}else{
			$atualizaideia = mysql_query("UPDATE ideias
											SET status = '4'
											WHERE id = '".$ideia."' ");
			echo "<script>
					window.close();
				</script>";		
		}
	}
	
	$operacao=$_GET['tipo'];
	$ideia=$_GET['ideia'];
	
	if ($operacao == "atribuir" AND $ideia != ""){
		//atribur a gestor ou por em stand by
		
		$buscaideia = mysql_query("SELECT id, descricao, status, nome, area_id, empresa_id, data_receb
										FROM ideias 
										WHERE id = '".$ideia."'
										LIMIT 1");
		
		//listar ideias
		while($listaideia = mysql_fetch_assoc($buscaideia)){
			$ideiaid = $listaideia['id'];
			$ideiadescricao = $listaideia['descricao'];
			$ideiastatus = $listaideia['status'];
			$ideianome = $listaideia['nome'];
			$ideiaarea = $listaideia['area_id'];
			$ideiaempresaid = $listaideia['empresa_id'];
			
			//formatar data
			$data = $listaideia['data_receb'];
			$muda = date('d/m/Y', strtotime($data));
			$ideiadata = $muda;
			
			//buscar area da ideia
			$buscaarea = mysql_query("SELECT id, nome
				FROM area 
				WHERE id = '".$listaideia['area_id']."' LIMIT 1");
																		
			while($listaarea = mysql_fetch_assoc($buscaarea)){
				$areanome = $listaarea['nome'];
			}
			
			//busca empresa
			$buscaempresa = mysql_query("SELECT nomeEmp, id, cnpj, razaoS, nomeRep, email, ddd1, tel1, ddd2, tel2, endereco, num, bairro, cidade, estado, porte, tipoempresa, areaatuacao, ativo, data
											FROM empresa 
											WHERE id = '".$listaideia['empresa_id']."' LIMIT 1");
																		
			while($listaempresa = mysql_fetch_assoc($buscaempresa)){
				
				$empresanome = $listaempresa['nomeEmp'];
				$empresacnpj = $listaempresa['cnpj'];
				$empresarazao = $listaempresa['razaoS'];
				$empresarepresentante = $listaempresa['nomeRep'];
				$empresaemail = $listaempresa['email'];
				$empresaddd1 = $listaempresa['ddd1'];
				$empresatel1 = $listaempresa['tel1'];
				$empresaddd2 = $listaempresa['ddd2'];
				$empresatel2 = $listaempresa['tel2'];
				$empresaendereco = $listaempresa['endereco'];
				$empresanum = $listaempresa['num'];
				$empresabairro = $listaempresa['bairro'];
				$empresacidade = $listaempresa['cidade'];
				$empresaestado = $listaempresa['estado'];
				$empresaativo = $listaempresa['ativo'];
				$empresaporte = $listaempresa['porte'];
				//$empresaarea = $listaempresa['areaatuacao'];
				$empresatipo = $listaempresa['tipoempresa'];
				
				$areaempresa = mysql_query("SELECT id, nome
				FROM area 
				WHERE id = '".$listaempresa['areaatuacao']."' LIMIT 1");
																		
				while($listaarea = mysql_fetch_assoc($areaempresa)){
					$empresaarea = $listaarea['nome'];
				}
				
				$dataempresa = $listaempresa['data'];
				$mudaempresa = date('d/m/Y', strtotime($dataempresa));
				
				$empresadata = $mudaempresa;
			}
		}
					
		
		echo "<!DOCTYPE html>
		<html>
		<head>
			<meta charset='utf-8'>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			<title>Portal do administrador</title>
			<!-- Core CSS - Include with every page -->
			<link href='assets/plugins/bootstrap/bootstrap.css' rel='stylesheet' />
			<link href='assets/font-awesome/css/font-awesome.css' rel='stylesheet' />
			<link href='assets/plugins/pace/pace-theme-big-counter.css' rel='stylesheet' />
			<link href='assets/css/style.css' rel='stylesheet' />
			<link href='assets/css/main-style.css' rel='stylesheet' />
			<link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />

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
									<!-- <li>
										<a href='ideiasa.php'> - Atribuir ideias</a>
									</li> -->
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
								<a href='logout.php'><i class='fa fa-files-o fa-fw'></i>Logout<span class='fa arrow'></span></a>
							</li>
						</ul>
					</div>
				</nav>
				
				<div id='page-wrapper'>
				
				<div class='row'>
                <!--  page header -->
                <div class='col-lg-12'>
                    <h1 class='page-header'>".$ideianome."</h1>
                </div>
                 <!--end  page header -->
            </div>
            <div class='row'>
                <div class='col-lg-6'>
                     <!--  Alert Styles -->
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            Dados da ideia
                        </div>
                        <div class='panel-body'>
                            <div class='alert alert-success'>
								<font color='black'<p><b>Nome sugerido pelo autor = </b>".$ideianome."
								<p><b>Descrição: </b>".$ideiadescricao."
								<p><b>Data de recebimento: </b>".$ideiadata."
								<p><b>Area: </b>".$areanome."
								<p><b>Status: </b>";
								if ($ideiastatus == 0){
									echo "Sem atribuição";
								}
								if ($ideiastatus == 3){
									echo "Stand by";
								}
								echo "
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-lg-6'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            Dados da empresa solicitante
                        </div>
                        <div class='panel-body'>
                            <div class='alert alert-info alert-dismissable'>
								<font color='black'>
             					<p>Nome Fantasia: <b>".$empresanome."</b>
								<p>Razão Social: <b>".$empresarazao."</b>
								<p>CNPJ: <b>".$empresacnpj."</b>
								<p>Tipo de empresa: <b>".$empresatipo."</b>
								<p>Porte: <b>".$empresaporte."</b>
								<p>Area de atuação: <b>".$empresaarea."</b>
								<p>Representante: <b>".$empresarepresentante."</b>
								<p>Email: <b>".$empresaemail." <a href='mailto:".$empresaemail.".com?subject=Resposta a ideia - ".$ideianome."&cc=".$email."'>Contatar</a></b>
								<p>Logradouro: <b>".$empresaendereco."</b>  Número: <b>".$empresanum."</b>
								<p>Bairro: <b>".$empresabairro."</b>  Cidade: <b>".$empresacidade."</b> 
								<p>Estado: <b>".$empresaestado." </b>
								<p>Telefone: <b>(".$empresaddd1.") -  ".$empresatel1."</b> ou <b>(".$empresaddd2.") -  ".$empresatel2."</b>
								<p>Registrada no sistema desde: <b>".$empresadata." </b>";
								if ($empresaativo == 1){
									echo "<p><i></font>Empresa com cadastro ativo</i>";
								}else{
									echo "<font color='red'><p><i>Empresa com cadastro inativo</i></font>";
								}
								echo "
                            </div>
                        </div>
                    </div>
				</div>
				<div class='row'>
					<div class='col-lg-6'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
							Escolher responsável pelo desenvolvimento do projeto
                        </div>
                        <div class='panel-body'>
						<form action='atribuir.php' method='post'>
						<input type='hidden' name='checa' value='checa'>
						<input type='hidden' name='ideiaescolida' value='".$ideia."'>
						<select name='gestorescolhido' class='form-control'>
							<option value='0'>Deixar ideia em STAND-BY</option>";
							$buscacampus = mysql_query("SELECT id_campus, nome, id_gestor
														FROM campus");
									
							while($listacampus = mysql_fetch_assoc($buscacampus)){
								echo "<option value='".$listacampus['id_campus']."'".$listacampus['nome']."";
								
								if ($listacampus['id_gestor'] != 0){
									$buscagestor = mysql_query("SELECT idusuario, nomeusuario, tipo
															FROM superusuario
															WHERE idusuario = '".$listacampus['id_gestor']."' AND tipo = '1' 
															LIMIT 1");
									
									while($listagestor = mysql_fetch_assoc($buscagestor)){
										echo "<option value='".$listacampus['id_gestor']."'>".$listacampus['nome']." - Gestor(a) ".$listagestor['nomeusuario']." </option>";
									}
								}else{
									echo "<option value='".$listacampus['id_gestor']."' disabled>".$listacampus['nome']." - Gestor(a) não cadastrado </option>";
								}
							}
							
						echo"
						</select>
						<br>
                            <button class='btn btn-primary btn-lg' data-toggle='modal' data-target='#myModal'>
                            Salvar indicação
                            </button>
                            <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                            <h4 class='modal-title' id='myModalLabel'>Submeter</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <p><b>O projeto terá andamento apenas depois de aceito pelo gestor escolhido</b><br>
											<p>E o mesmo ficará encarregado de montar o projeto, escolher membros e postar atualizações.
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>
                                            <button type='submit' class='btn btn-primary'>Salvar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- End Modals-->
                </div>
                     <!-- End Dismissable Alerts -->
                </div>";
				
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
		if ($operacao == "andamento" AND $ideia != ""){
			//atribur a gestor ou por em stand by
		
		$buscaideia = mysql_query("SELECT id, descricao, status, nome, area_id, empresa_id, data_receb
										FROM ideias 
										WHERE id = '".$ideia."'
										LIMIT 1");
										
		while($listaideia = mysql_fetch_assoc($buscaideia)){
			$ideiaid = $listaideia['id'];
			$ideiadescricao = $listaideia['descricao'];
			$ideiastatus = $listaideia['status'];
			$ideianome = $listaideia['nome'];
			$ideiaarea = $listaideia['area_id'];
			$ideiaempresaid = $listaideia['empresa_id'];
			$ideiadata = $listaideia['data_receb'];
			
			$buscaarea = mysql_query("SELECT id, nome
				FROM area 
				WHERE id = '".$listaideia['area_id']."' LIMIT 1");
																		
			while($listaarea = mysql_fetch_assoc($buscaarea)){
				$areanome = $listaarea['nome'];
			}
			
			$buscaempresa = mysql_query("SELECT nomeEmp,id
											FROM empresa 
											WHERE id = '".$listaideia['empresa_id']."' LIMIT 1");
																		
			while($listaempresa = mysql_fetch_assoc($buscaempresa)){
				$empresanome = $listaempresa['nomeEmp'];
			}
		}
					
		
		echo "<!DOCTYPE html>
		<html>
		<head>
			<meta charset='utf-8'>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			<title>Portal do administrador</title>
			<!-- Core CSS - Include with every page -->
			<link href='assets/plugins/bootstrap/bootstrap.css' rel='stylesheet' />
			<link href='assets/font-awesome/css/font-awesome.css' rel='stylesheet' />
			<link href='assets/plugins/pace/pace-theme-big-counter.css' rel='stylesheet' />
			<link href='assets/css/style.css' rel='stylesheet' />
			<link href='assets/css/main-style.css' rel='stylesheet' />
			<link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />

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
									<!-- <li>
										<a href='ideiasa.php'> - Atribuir ideias</a>
									</li> -->
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
								<a href='logout.php'><i class='fa fa-files-o fa-fw'></i>Logout<span class='fa arrow'></span></a>
							</li>
						</ul>
					</div>
				</nav>
				
				<div id='page-wrapper'>
				
				<div class='row'>
                <!--  page header -->
                <div class='col-lg-12'>
                    <h1 class='page-header'>".$ideianome."</h1>
                </div>
                 <!--end  page header -->
            </div>
            <div class='row'>
                <div class='col-lg-12'>
                     <!--  Alert Styles -->
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            Dados da ideia
                        </div>
                        <div class='panel-body'>
                            <div class='alert alert-success'>
                                ".$ideiadescricao."
                            </div>";
							if($ideiastatus == 1){
								echo "<div class='alert alert-danger'>
									O gestor indicado ainda não criou um projeto para essa ideia.
									</div>";
							}else{
								echo "<div class='alert alert-danger'>
										Ideia transformada em projeto.
									</div>"; 
									
									$verprojetos = mysql_query("SELECT * FROM
													projeto
													WHERE idideia = '".$ideiaid."'
													ORDER BY status ASC 
													LIMIT 1");
													
									if (mysql_num_rows($verprojetos)>0){
										$verp = mysql_fetch_assoc($verprojetos);
										$idprojeto = $verp['idproj'];
										$statusproj = $verp['status'];
										$vertematt = mysql_query("SELECT * FROM
																	projatt
																	WHERE idproj = '".$idprojeto."'
																	ORDER BY data");
																					
												if (mysql_num_rows($vertematt)>0){
													
													echo "<div class='alert alert-info'>";
													while($mostraatt = mysql_fetch_assoc($vertematt)){
														$tituloatt = $mostraatt['tituloatt'];
														$conteudoatt = $mostraatt['descricao'];
														$dataatt = date('d/m/Y', strtotime($mostraatt['data']));
														echo "<p><b>".$tituloatt."</b></p>";
														echo "<p>".$conteudoatt."</p>
														<p><i>".$dataatt."</p></i><br><div>";
													}
													if ($statusproj == 0){
														echo "<p>";
													}else{
														echo " <button type='button' class='btn btn-success disabled'>Projeto finalizado</button><br>";
													}
													echo "</div>";
													
												}
										echo"
										<br><button type='button' class='btn btn-info' onclick='window.print()'>Imprimir progressos</button></div>";
									}
							}
							echo"
                        </div>
                    </div>
                    <!-- End Alert Styles -->
                </div>
                     <!-- End Dismissable Alerts -->
                </div>";
				
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
			//ver andamento
		}else{
			echo "<script>
					window.close();
				</script>";
		}
	}
?>