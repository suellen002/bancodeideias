<?php
	session_start();
	include ("conectar.php");
	
	$id =  $_SESSION["idusuario"];
	
		if(isset($_POST['novaarea']) AND $_POST['novaarea'] == 992){
			if(isset($_POST['nomearea']) AND $_POST['nomearea']!="" AND (strlen($_POST['nomearea']) > 5) AND (strlen($_POST['nomearea']) < 50)){
				$nomearea = $_POST['nomearea'];
				$novaarea = mysql_query("INSERT INTO area (nome, sugestor, ativo)
											VALUES ('".$nomearea."', '".$id."', '0')");
											
			if ($novaarea){
				echo "<script type='text/javascript' language='javascript'>
					alert('Area cadastrada com sucesso!');
					window.location.href='area.php';
				</script>";
			}else{
				echo "<script type='text/javascript' language='javascript'>
					alert('Area não pode ser cadastrada!');
					window.location.href='area.php';
				</script>";
			}
			}else{
				echo "<script type='text/javascript' language='javascript'>
					alert('Dado em branco ou com tamanho inadequado, tente novamente!');
					window.location.href='novaarea.php';
				</script>";
			}
		}else{
			echo "<script type='text/javascript' language='javascript'>
					alert('Algo deu errado, tente novamente mais tarde!');
					window.location.href='area.php';
				</script>";
		}
	
		
?>