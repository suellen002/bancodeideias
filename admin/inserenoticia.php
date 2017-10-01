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
	}else{
	
		if(isset($_POST['titulo']) AND isset($_POST['conteudo'])){
			if ((strlen($_POST['titulo']) > 9) AND (strlen($_POST['titulo'] < 100)) AND (strlen($_POST['conteudo']) > 50) AND (strlen($_POST['conteudo']) < 3000)){
					
				$titulo = $_POST['titulo'];
				$conteudo = $_POST['conteudo'];
				$data = date('Y/m/d');
				
				if($_POST['fonte'] != ""){
					$fonte = $_POST['fonte'];
				}else{
					$fonte = "Fonte Própria";
				}
				
				$inserenoticia = mysql_query("INSERT INTO noticias (id_autor, titulo, conteudo, data, fonte)
												VALUES ('".$id."', '".$titulo."', '".$conteudo."', '".$data."', '".$fonte."')");
												
				if($inserenoticia){
					echo "<script type='text/javascript' language='javascript'>
							alert('Notícia cadastrada com sucesso!');
							window.location.href='vernoticia.php';
						</script>";
				}else{
					echo "<script type='text/javascript' language='javascript'>
							alert('Algo deu errado, tente novamente mais tarde!');
							window.location.href='vernoticia.php';
						</script>";
				}
			}else{
				echo "<script type='text/javascript' language='javascript'>
						alert('Dados digitados estão fora do limite de caracteres');
						window.location.href='noticia.php';
					</script>";
			}
			
		}else{
			echo "<script type='text/javascript' language='javascript'>
						alert('Algum dado essencial está em branco!');
						window.location.href='noticia.php';
					</script>";
		}
	}
?>