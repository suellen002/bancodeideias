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
	
	$operacao=$_GET['tipo'];
	$ideia=$_GET['ideia'];
	
	if ($operacao == "visualizar" AND $ideia != ""){
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
			$buscaempresa = mysql_query("SELECT *
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
							<form action='atribuir.php' method='get'>
								<font color='black'<p><b>Nome sugerido pelo autor = </b>".$ideianome."
								<p><b>Descrição: </b>".$ideiadescricao."
								<p><b>Data de recebimento: </b>".$ideiadata."
								<p><b>Area: </b>".$areanome."
								<p><b>Status: </b>Recebida pelo gestor
								<p></p><br>
								<p><button type='submit' class='btn btn-success'>CRIAR PROJETO</button>
								<a href='index.php'>Voltar</a>
								<input type='hidden' name='tipo' value='visualizar'>
								<input type='hidden' name='ideia' value='".$ideiaid."'>
								<input type='hidden' name='checa' value='aceito'>
								</div>
							</form>
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
				<div class='row'>";
				
				if (isset($_GET['checa'])){
					echo "<div class='col-lg-12'>
						<div class='panel panel-default'>
							<div class='panel-heading'>
							Novo projeto do ".$nomecampus."
							</div>
							<div class='panel-body'>
							<form action='aceitaprojeto.php' method='post'>
								<input type='hidden' name='ideiaid' value='".$ideiaid."'>
								<div class='form-group'>
									<label>Título do projeto</label>
									<input class='form-control' type='text' name='titulo'>
									<p class='help-block'>Título pode ter entre 10 e 100 caracteres.</p>
								</div>
								<div class='form-group'>
									<label>Proposta</label>
									<textarea class='form-control' rows='5' name='proposta'></textarea>
									<p class='help-block'>Conteúdo pode ter entre 50 e 3000 caracteres.</p>
								</div>
								<div class='form-group'>
									<label>Autor</label>
									<input class='form-control' name='autor' value='".$nome."' disabled>
									<p class='help-block'>O autor será o responsável por montar a equipe de desenvolvimento e alimentar o sistema com andamentos do projeto.</p>
								</div>
								<div class='form-group'>
									<label>Escolher equipe de desenvolvimento</label>
									<select multiple class='form-control' name='docentes[]'>";
                                    $buscadocente = mysql_query("SELECT iddocente, nomedoc, area, campus
																	FROM docente");
																	
									while($listadocente = mysql_fetch_assoc($buscadocente)){
										echo "<option value='".$listadocente['iddocente']."'>";
										echo $listadocente['nomedoc']." - ";
										
										$buscaarea = mysql_query("SELECT id, nome
																	FROM area
																	WHERE id = '".$listadocente['area']."' 
																	LIMIT 1");
																			
										$mostranomearea = mysql_fetch_assoc($buscaarea);
										echo $mostranomearea['nome']. " - ";
										
										if($listadocente['campus'] == $_SESSION['idcampus']){
											echo $_SESSION['nomecampus'];
										}else{
											$buscacampus = mysql_query("SELECT id_campus, nome
																			FROM campus
																			WHERE id_campus = '".$listadocente['campus']."' 
																			LIMIT 1");
																			
											$mostranomecampus = mysql_fetch_assoc($buscacampus);
											echo $mostranomecampus['nome']. "</option>";
										}
									}
                                    echo "</select>
									<p class='help-block'>Segure CTRL para selecionar mais de um docente</p>
                                </div>
								<div>
									<br>
									<button type='submit' class='btn btn-success'>Cadastrar novo projeto</button>
								</div>
							</form>
							</form>							
						</div>";
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

		</body>

		</html>";

		"<script>
			window.close();
		</script>";
		}else{
			echo "<script>
					window.close();
				</script>";
		}
	
?>