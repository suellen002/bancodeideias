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
	
	$opcao = $_POST['opcao'];
	
	if($opcao == "gestor"){
		
		if (isset($_POST['nome']) AND isset($_POST['senha']) AND isset($_POST['campus']) AND isset($_POST['email']) AND $_POST['nome'] != "" AND $_POST['senha'] != "" AND $_POST['email'] != "" AND $_POST['campus']!= ""){
			$nomeusuario = $_POST['nome'];
			$senha = $_POST['senha'];
			$id_campus = $_POST['campus'];
			$emaila = $_POST['email'];
				
			$novogestor = mysql_query("INSERT INTO superusuario (email, senha, tipo,  nomeusuario)
										VALUES ('".$emaila."', '".$senha."', '1', '".$nomeusuario."')");
																					
			if($novogestor){
						
				$buscagestor = mysql_query("SELECT idusuario
											FROM superusuario
											ORDER BY idusuario DESC
											LIMIT 1");
											
				while($listagestor = mysql_fetch_assoc($buscagestor)){
					$inseregestor = mysql_query("UPDATE campus 
										SET id_gestor = '".$listagestor['idusuario']."'
										WHERE id_campus = '".$id_campus."' ");
										
					if ($inseregestor){
						echo "<script type='text/javascript' language='javascript'>
						alert('Gestor cadastrado com sucesso!');
						window.location.href='index.php';
						</script>";
					}else{
						echo "<script type='text/javascript' language='javascript'>
						alert('Algo deu errado, tente novamente mais tarde!');
						window.location.href='index.php';
						</script>";
					}
				}
							
			}else{
				echo "<script type='text/javascript' language='javascript'>
						alert('Algo deu errado, tente novamente mais tarde!');
						window.location.href='index.php';
						</script>";
			}
		}
		else{
			echo "<script type='text/javascript' language='javascript'>
						alert('Dado em branco!');
						window.location.href='novog.php';
						</script>";
		}
			
		
	}else{
		if($opcao == "administrador"){
			if (isset($_POST['nome']) AND isset($_POST['senha']) AND isset($_POST['email']) AND $_POST['nome'] != "" AND $_POST['senha'] != "" AND $_POST['email'] != ""){
				$nomeusuario = $_POST['nome'];
				$senha = $_POST['senha'];
				$emaila = $_POST['email'];
				
				$novoadm = mysql_query("INSERT INTO superusuario (email, senha, tipo, nomeusuario)
													VALUES ('".$emaila."', '".$senha."', '0', '".$nomeusuario."')");
																								
												
				if($novoadm){
					echo "<script type='text/javascript' language='javascript'>
						alert('Administrador cadastrado com sucesso!');
						window.location.href='index.php';
						</script>";
				}else{
					echo "<script type='text/javascript' language='javascript'>
						alert('Algo deu errado, tente novamente mais tarde!');
						window.location.href='index.php';
						</script>";
				}
			
			}else{
				echo "<script type='text/javascript' language='javascript'>
						alert('Algum dado em branco!');
						window.location.href='novoa.php';
						</script>";
			}
		}else{
			echo "<script type='text/javascript' language='javascript'>
					alert('Algo deu errado, tente novamente mais tarde!');
					window.location.href='index.php';
				</script>";
		}
		
	}

?>