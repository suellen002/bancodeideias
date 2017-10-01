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
	
	$titulo = $_POST['titulo'];
	$proposta = $_POST['proposta'];
	
	$tamtitulo = strlen($titulo);
	$tamproposta = strlen($proposta);
	
	if(($tamtitulo > 10) AND ($tamtitulo < 100)){
		if(($tamproposta > 50) AND ($tamproposta < 3000)){	
			if(isset($_POST['docentes']) AND $_POST['docentes'] != NULL){
				
				$quantidadeequipe = count($_POST['docentes']);
				$ideiaid = $_POST['ideiaid'];
				
				$insereprojeto = mysql_query("INSERT INTO projeto (idideia, projresp, nomeproj, proposta)
												VALUES ('".$ideiaid."', '".$id."', '".$titulo."', '".$proposta."' )");
												
				if ($insereprojeto){
					$veridprojeto = mysql_query("SELECT idproj
												FROM projeto
												ORDER BY idproj DESC 
												LIMIT 1");
												
					$listaproj = mysql_fetch_assoc($veridprojeto);
					
					foreach($_POST['docentes'] as $indice => $valor)
					{
						$vetor[$indice] = $valor;
					}
					
					for ($i=0; $i<$quantidadeequipe; $i++){
						$insereequipe = mysql_query("INSERT INTO projparticipante (idproj, iddocente)
												VALUES ('".$listaproj['idproj']."', '".$vetor[$i]."' )");
					}
					
					$atualizaideia = mysql_query("UPDATE ideias 
										SET status = '2'
										WHERE id = '".$ideiaid."' ");
										
					if ($atualizaideia){
					
						echo "<script type='text/javascript' language='javascript'>
								alert('Projeto inserido com sucesso!');
								window.location.href='index.php';
								</script>";
					}else{
						echo "<script type='text/javascript' language='javascript'>
								alert('Ideia não atualizada, contate o administrador do sistema para mais informações!');
								window.location.href='index.php';
								</script>";
					}
					
				}else{
					echo "<script type='text/javascript' language='javascript'>
							alert('Projeto não pode ser inserido no momento!');
							window.history.back();
							</script>";
				}
				
			}else{
				echo "<script type='text/javascript' language='javascript'>
				alert('Selecione no mínimo um gestor!');
				window.history.back();
				</script>";
			}
			
		}else{
			echo "<script type='text/javascript' language='javascript'>
				alert('Proposta não está dentro do limite de caracteres!');
				window.history.back();
				</script>";
		}
	}else{
		echo "<script type='text/javascript' language='javascript'>
			alert('Título não está dentro do limite de caracteres!');
			window.history.back();
			</script>";
	}
	
?>