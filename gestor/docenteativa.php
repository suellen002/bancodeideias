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
	
	$acao = $_POST['acao'];
	
	if($acao == "atualiza1"){
		$iddocente = $_POST['docente'];
		$_SESSION['iddocente'] = $iddocente;
		if ($iddocente != 0){
			$_SESSION['atualiza'] = true;
		}	
		
		header("Location:attdocente.php");
	}

	if($acao == "atualiza2"){
		
		//iddocente, nomedoc, emaildoc, pront, area, campus, lattes
				
		$iddocente = $_SESSION['iddocente'];
		
		$nomedoc = $_POST['nomedoc'];
		$pront = $_POST['pront'];
		$areadoc = $_POST['areadoc'];
		$emaildoc = $_POST['emaildoc'];
		$lattes = $_POST['lattes'];
		
		$atualizadocente = mysql_query("UPDATE docente 
										SET nomedoc = '".$nomedoc."', emaildoc = '".$emaildoc."', pront = '".$pront."', area = '".$areadoc."', lattes = '".$lattes."'
										WHERE iddocente = '".$iddocente."' ");
		if($atualizadocente){								
			echo "<script type='text/javascript' language='javascript'>
					alert('Dados do docente atualizado!');
					window.location.href='attdocente.php';
					</script>";
		}else{
			echo "<script type='text/javascript' language='javascript'>
					alert('Dados não podem ser atualizados no momento, tente novamente mais tarde!');
					window.location.href='index.php';
					</script>";
		}
		
		$_SESSION['atualiza'] = false;
	
	}
?>