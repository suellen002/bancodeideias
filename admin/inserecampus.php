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
			<script language='JavaScript' type='text/javascript' src='js/MascaraValidacao.js'></script>
			
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
									<li class='selected'>
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
		<div class='col-lg-12'>
			<h1 class='page-header'>Adicionar novo campus</h1>
            <div class='row'>";
		
		
				// '".."'
				echo 
				"<div class='panel panel-default'>
			<div class='panel-heading'>
			<div class='panel-body'>
              <div class='row'>
              <div class='col-lg-6'>
				<form name= 'form1' action='inserecampuss.php' method='POST'>
					<input type='hidden' name='acao' value='atualiza2'>
					<input type='hidden' name='campus'>
					<div class='form-group'>
						<input type='hidden' name='insere' value='single'>
						<label>Nome identificador da instituição </label>
                        <input class='form-control' type='text' name='nome'>
                        <p class='help-block'>Ex: Campus Rio de Janeiro</p>
                    </div>
                    <div class='form-group'>
						<label>Endereço</label>
						<input class='form-control' name='endereco'>
                    </div>
					<div class='form-group'>
						<label>Número</label>
						<input class='form-control' name='numero' placeholder='0000'>
                    </div>
					<div class='form-group'>
						<label>Bairro</label>
						<input class='form-control' name='bairro'>
                    </div>
					<div class='form-group'>
						<label>Cidade</label>
						<input class='form-control' name='cidade'>
                    </div>
					<div class='form-group'>
						<label>Estado</label>
						<input class='form-control' name='estado' placeholder='SP' maxlenght='2'>
                    </div>
                    <div class='form-group'>
						<label>CNPJ</label>
						<input class='form-control' name='cnpj' id='cnpj' onKeyPress='MascaraCNPJ(form1.cnpj);' onBlur='ValidarCNPJ(form1.cnpj);'>
                    </div>
					<div class='form-group'>
						<label><font color='red'><small>Vá em adicionar gestor para cadastrar um responsável para este campus</small></font></label>
						<p class='form-control-static'>
                    </div>
					<div>
						<br>
						<button type='submit' class='btn btn-success'>Cadastrar campus</button>
					</div>
				</form>
				</div>

				
				<br><br>
				
				<h1 class='page-header'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ou</h1>
				
				<form action='inserecampuss.php' method='POST' form enctype='multipart/form-data'>
					<div class='col-lg-6'>
					<div class='form-group'>
						 <label>Fazer a inserção de dados em massa</label>
						 <input type='file' name='arquivoupload'>
						 </div>
					 <br>
					 <div class='form-group'>
						<input type='hidden' name='insere' value='massa'>
						<textarea class='form-control' rows='3' disabled>Disponível apenas para arquivos excel                                      Ordenar as tabelas sem título e na ordem                                                     Nome, endereço, Numero, bairro, Cidade, Estado e CNPJ</textarea>
                     </div>
					 <div>
						<br>
						<button type='submit' class='btn btn-success'>Cadastrar planilha</button>
					</div>
				</form>
                        </div>
                    </div>
                     
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