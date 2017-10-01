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
							<li  class='selected'>
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
		
		<div class='col-lg-12'>
        <h1 class='page-header'>Controle de docentes</h1>
            <div class='row'>

                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                        Atualizar dados sobre campus
                        </div>
                        <div class='panel-body'>
                            <div class='row'>
                                <div class='col-lg-6'>
                                        ";
		
		$buscadocente = mysql_query("SELECT * FROM docente
										WHERE campus = '".$idcampus."' ");
											
		echo " Selecione um docente para efetuar uma ação:<form action='docenteativa.php' method='post'>
					<input type='hidden' name='acao' value='atualiza1'>
					<select name='docente' class='form-control'>
					<option value='0' checked>Selecione um docente</option>";
				
		while($listadocentes = mysql_fetch_assoc($buscadocente)){
			echo "<option value='".$listadocentes['iddocente']."'>".$listadocentes['nomedoc']."
				</option>";
			
			if((isset($_SESSION['atualiza'])) AND ($listadocentes['iddocente'] == $_SESSION['iddocente'])){
				$_SESSION['iddocente'] = $listadocentes['iddocente'];
				$_SESSION['nomedoc'] = $listadocentes['nomedoc'];
				$_SESSION['emaildoc'] = $listadocentes['emaildoc'];
				$_SESSION['pront'] = $listadocentes['pront'];
				$_SESSION['area'] = $listadocentes['area'];
				$_SESSION['campus'] = $listadocentes['campus'];
				$_SESSION['lattes'] = $listadocentes['lattes'];
			}
		}
		
		echo "</select>
			<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type='submit' class='btn btn-outline btn-warning' name='acao' value='atualiza1'>Atualizar docente</button>
			</form>";
			
			if(isset($_SESSION['atualiza']) AND ($_SESSION['atualiza'] == true)){
				// '".."'
				echo 
				"<form action='docenteativa.php' method='POST'>
					<br><br>
					</div>
					<div class='col-lg-6'>
					<input type='hidden' name='acao' value='atualiza2'>
					<input type='hidden' name='iddocente' value='".$_SESSION['iddocente']."'>
					<div class='form-group'>
						<label>Nome docente </label>
                        <input class='form-control' type='text' name='nomedoc' value='".$_SESSION['nomedoc']."'>
                        <p class='help-block'>Ex: Reginaldo Soeiro</p>
                    </div>
                    <div class='form-group'>
						<label>Prontuario</label>
						<input class='form-control' name='pront' value='".$_SESSION['pront']."'>
                    </div>
					<div class='form-group'>
						<label>E-mail</label>
						<input class='form-control' name='emaildoc' value='".$_SESSION['emaildoc']."'>
                    </div>
					<div class='form-group'>
						<label>Lattes</label>
						<input class='form-control' name='lattes' value='".$_SESSION['lattes']."'>
                    </div>
					<div class='form-group'>
						<label>Campus</label>
						<input class='form-control' name='campus' value='".$nomecampus."' disabled>
                    </div>
					<div class='form-group'>
						<label>Área:</label>
						<div class='form-group'>
						<select class='form-control' name='areadoc'>";
							$verarea = mysql_query("SELECT * FROM 
													area
													WHERE ativo = '1' ");
													
							while($mostraarea = mysql_fetch_assoc($verarea)){
								$idarea = $mostraarea['id'];
								$nomearea = $mostraarea['nome'];
								if($idarea == $_SESSION['area']){
									echo "<option value='".$idarea."' selected>".$nomearea."</option>";
								}else{
									echo "<option value='".$idarea."'>".$nomearea."</option>";
								}
							}
						
						echo "
						</select>
                    </div>
                    </div>
					<div>
						<br>
						<button type='submit' class='btn btn-success'>Atualizar dados</button>
					</div>
				</form>";	
					$_SESSION['atualiza'] = false;
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
?>