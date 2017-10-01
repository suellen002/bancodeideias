<?php

	session_start();
	include ("conectar.php");
		
	$autentica = $_SESSION["autentica"];
	$email = $_SESSION["email"]; 
	$id =  $_SESSION["idusuario"]; 
	$nome = $_SESSION["nome"];
	$tipo = $_SESSION["tipo"];
	
	$ideia = $_POST["ideia"];
	$docente = $_POST["docente"];
	$desativa = 0;
	
	if (isset($_POST["desativa"])) {
		$desativa = $_POST["desativa"];
	}
	
	if($desativa == 1){
		$ideiastand = mysql_query("UPDATE ideias 
										SET status = '0'
										WHERE id = '".$ideia."'");
										
		if($ideiastand){
			echo "<script type='text/javascript' language='javascript'>
					alert('Ideia desativada com sucesso! Caso mude de ideia ela poderá ser encontrada no final da fila');
					window.location.href='ideiasa.php';
				</script>";
		}else{
			echo "<script type='text/javascript' language='javascript'>
					alert('Algo deu errado, tente novamente mais tarde');
					window.location.href='ideiasa.php';
				</script>";
		}
	}else{
		if ($docente != "falso"){
			
		
			$atribui = mysql_query("UPDATE ideias 
											SET responsavel = '".$docente."'
											WHERE id = '".$ideia."'");
											
			$statusideia = mysql_query("UPDATE ideias 
											SET status = '2'
											WHERE id = '".$ideia."'");
			
			if($atribui AND $statusideia){
				echo "<script type='text/javascript' language='javascript'>
						alert('Ideia atribuída com sucesso, aguarde parecer do gestor do docente em questão aceitar o projeto');
						window.location.href='ideiasa.php';
					</script>";
			}else{
				echo "<script type='text/javascript' language='javascript'>
						alert('Algo deu errado, tente novamente mais tarde');
						window.location.href='ideiasa.php';
					</script>";
			}
		}else{
			echo "<script type='text/javascript' language='javascript'>
						alert('Opção inválida, atribua a gestor ou deixe a ideia em stand by');
						window.location.href='ideiasa.php';
					</script>";
		}
	}
	
	
	if ($tipo != "adm"){
		session_destroy();
		header('Location: login.html');
	}
	
?>