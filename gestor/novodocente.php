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
	
	if(isset($_POST['controle']) AND $_POST['controle'] == 'insere'){
		
		$nomedocente = $_POST['nome'];
		$emaildocente = $_POST['email'];
		$prontuario = $_POST['prontuario'];
		$lattes = $_POST['lattes'];
		$area = $_POST['area'];
		
		$tamanhonome = strlen($nomedocente);
		$tamanhoemail = strlen($email);
		$tamanhopront = strlen($prontuario);
		$tamanholattes = strlen($lattes);
		
		$conta = "^[a-zA-Z0-9\._-]+@";
		$domino = "[a-zA-Z0-9\._-]+.";
		$extensao = "([a-zA-Z]{2,4})$";
		
		$pattern = $conta.$domino.$extensao;
		
		if (ereg($pattern, $emaildocente)){
				if(($tamanhonome > 10) AND ($tamanhonome < 50) AND ($tamanhopront > 5) AND ($tamanhopront < 10)){
					$inseredocente = mysql_query("INSERT INTO docente (nomedoc, emaildoc, pront, area, campus, lattes)
												VALUES ('".$nomedocente."', '".$emaildocente."' , '".$prontuario."', '".$area."', '".$idcampus."', '".$lattes."')");
												
					if($inseredocente){
						echo "<script type='text/javascript' language='javascript'>
						alert('Professor(a) adicionado na base de dados!');
						window.location.href='attdocente.php'
						</script>";
					}else{
						echo "<script type='text/javascript' language='javascript'>
						alert('Professor(a) não pode ser adicionado no momento, tente novamente mais tarde!');
						window.location.href='index.php'
						</script>";
					}
				}else{
					echo "<script type='text/javascript' language='javascript'>
					alert('Nome ou prontuario fora do limite de caracteres!');
					window.history.back();
					</script>";
				}
		}else{
			echo "<script type='text/javascript' language='javascript'>
				alert('E-mail digitado é invalido!');
				window.history.back();
				</script>";
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
			<h1 class='page-header'>Adicionar novo docente</h1>
            <div class='row'>";
		
		
				// '".."'
				echo 
				"<div class='panel panel-default'>
			<div class='panel-heading'>
			<div class='panel-body'>
              <div class='row'>
              <div class='col-lg-6'>
				<form name= 'form1' action='novodocente.php' method='POST'>
					<input type='hidden' name='novodocente' value='true'>
					<div class='form-group'>
						<label>Nome completo:*</label>
                        <input class='form-control' type='text' name='nome'>
                        <p class='help-block'>Ex: Ronaldo Giubani</p>
                    </div>
                    <div class='form-group'>
						<label>E-mail:*</label>
						<input class='form-control' name='email' placeholder='seuemail@ifsp.edu.br'>
                    </div>
					<div class='form-group'>
						<label>Prontuário:*</label>
						<input class='form-control' name='prontuario' placeholder='000000-0'>
                    </div>
					<div class='form-group'>
						<label>Lattes</label>
						<input class='form-control' name='lattes'>
                    </div>
					<div class='form-group'>
						<label>Vinculado ao:</label>
						<select class='form-control' disabled><option>".$nomecampus."</option></select>
                    </div>
					<div class='form-group'>
						<input name='controle' value='insere' type='hidden'>
						<label>Expertise em: </label>
						<select class='form-control' name='area'>";
					$buscaarea = mysql_query("SELECT * FROM area
												WHERE ativo = 1 ");
													
					while ($mostraarea = mysql_fetch_assoc($buscaarea)){
						echo "<option value='".$mostraarea['id']."'>".$mostraarea['nome'];
						echo "</option>";				
					}
                    echo "</select></div>
					<div>
						<br>
						<button type='submit' class='btn btn-success'>Cadastrar docente</button>
					</div>
				</form>
				</div>

				
				<br><br>
				
				<h1 class='page-header'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ou</h1>
				
				<form action='http://buscatextual.cnpq.br/buscatextual/visualizacv.do' method='POST' target='_blank'>
					<div class='col-lg-6'>
					<div class='form-group'>
						 <label>Buscar professor pelo currículo lattes</label>
						 <input class='form-control' name='id'>
						 <input id='metodo' name='metodo' type='hidden' value='visualizarCV' />
						 <input id='idiomaExibicao' name='idiomaExibicao' type='hidden' value='' />
						 <input id='tipo' name='tipo' type='hidden' value='' />
						 </div>
					 <br>
					 <div>
						<button type='submit' class='btn btn-success'>Buscar pelo lattes</button>
					</div>
                        </div>
                    </div>
                 </form>    
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