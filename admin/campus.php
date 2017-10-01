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
	
	echo "<!DOCTYPE html>
		<html>
		<head>
			<meta charset='utf-8'>
			<link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
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
								</ul>
							</li>
							<li>
								<a href='#'><i class='fa fa-table fa-fw'></i>Campus<span class='fa arrow'></a>
								<ul class='nav nav-second-level'>
									<li>
										<a href='inserecampus.php'> - Adicionar campus</a>
									</li>
									<li class='selected'>
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
		
		<div class='col-lg-12'>
        <h1 class='page-header'>Controle de campus</h1>
            <div class='row'>

                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                        Remover ou atualizar dados sobre campus
                        </div>
                        <div class='panel-body'>
                            <div class='row'>
                                <div class='col-lg-6'>
                                        ";
		
		$buscacampus = mysql_query("SELECT id_campus, nome, endereco, numero, bairro, cidade, estado, cnpj, id_gestor
											FROM campus");
											
		echo " Selecione um campus para efetuar uma ação:<form action='campusativa.php' method='post'>
				<select name='campus' class='form-control'>
					<option value='0' checked>Selecione um campus</option>";
				
		while($listacampus = mysql_fetch_assoc($buscacampus)){
			echo "<option value='".$listacampus['id_campus']."'>".$listacampus['nome']."
				</option>";
			
			if((isset($_SESSION['atualiza'])) AND ($_SESSION['campus'] == $listacampus['id_campus'])){
				$_SESSION['id_campus'] = $listacampus['id_campus'];
				$_SESSION['nomecampus'] = $listacampus['nome'];
				$_SESSION['endereco'] = $listacampus['endereco'];
				$_SESSION['numero'] = $listacampus['numero'];
				$_SESSION['bairro'] = $listacampus['bairro'];
				$_SESSION['cidade'] = $listacampus['cidade'];
				$_SESSION['estado'] = $listacampus['estado'];
				$_SESSION['cnpj'] = $listacampus['cnpj'];
				$_SESSION['id_gestor'] = $listacampus['id_gestor'];
			}
		}
		
		echo "</select>
			<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type='submit' class='btn btn-outline btn-warning'name='acao' value='atualiza1'>Atualizar campus</button>
			</form>";
			
			if(isset($_SESSION['atualiza']) AND ($_SESSION['atualiza'] == true)){
				// '".."'
				echo 
				"<form action='campusativa.php' method='POST'>
					<br><br>
					</div>
					<div class='col-lg-6'>
					<input type='hidden' name='acao' value='atualiza2'>
					<input type='hidden' name='campus' value='".$_SESSION['campus']."'>
					<div class='form-group'>
						<label>Nome identificador da instituição </label>
                        <input class='form-control' type='text' name='nome' value='".$_SESSION['nomecampus']."'>
                        <p class='help-block'>Ex: Campus Rio de Janeiro</p>
                    </div>
                    <div class='form-group'>
						<label>Endereço</label>
						<input class='form-control' name='endereco' value='".$_SESSION['endereco']."'>
                    </div>
					<div class='form-group'>
						<label>Número</label>
						<input class='form-control' name='numero' value='".$_SESSION['numero']."'>
                    </div>
					<div class='form-group'>
						<label>Bairro</label>
						<input class='form-control' name='bairro' value='".$_SESSION['bairro']."'>
                    </div>
					<div class='form-group'>
						<label>Cidade</label>
						<input class='form-control' name='cidade' value='".$_SESSION['cidade']."'>
                    </div>
					<div class='form-group'>
						<label>Estado</label>
						<input class='form-control' name='estado' value='".$_SESSION['estado']."'>
                    </div>
                    <div class='form-group'>
						<label>CNPJ</label>
						<p class='form-control-static'>".$_SESSION['cnpj']."</p>
                    </div>
					<div class='form-group'>
						<label>Gerido por:</label>
						<p class='form-control-static'>"; 
						if ($_SESSION['id_gestor'] != 0){
							$buscagestor = mysql_query("SELECT idusuario, nomeusuario
											FROM superusuario
											WHERE idusuario = '".$_SESSION['id_gestor']."' ");
							
							while($listagestor = mysql_fetch_assoc($buscagestor)){
								$gestor = $listagestor['nomeusuario'];
							}
						}else{
							$gestor = "O campus ainda não tem um gestor associado a ele";
						}
										
						echo $gestor."</p>
                    </div>
					<div>
						<br>
						<button type='submit' class='btn btn-success'>Atualizar dados</button>
					</div>
				</form>";				
				$_SESSION['atualiza']=false;
			}
		
														
		echo "
                        </div>
                    </div>
                     <!--Fim da mostra de ideias -->
                </div>
            </div>
				
			    <script src='assets/plugins/jquery-1.10.2.js'></script>
				<script src='assets/plugins/bootstrap/bootstrap.min.js'></script>
				<script src='assets/plugins/metisMenu/jquery.metisMenu.js'></script>
				<script src='assets/plugins/pace/pace.js'></script>
				<script src='assets/scripts/siminta.js'></script>

		</body>

		</html>";
?>