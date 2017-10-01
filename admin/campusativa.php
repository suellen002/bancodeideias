<?php
	session_start();
	include ("conectar.php");
	
	$acao = $_POST['acao'];
	$campus = $_POST['campus'];
		
	if($acao == "deleta"){
			
			if ($campus > 0){
		
				$deletacampus = mysql_query("DELETE FROM campus
													WHERE id_campus != '0' AND id_campus = '".$campus."' ");
				
				if($deletacampus){
					
					$buscagestor = mysql_query("SELECT id_campus 
												FROM superusuario
												WHERE id_campus = '".$campus."' ");
												
					$check = mysql_num_rows($buscagestor);
												
					if($check > 0){
						$deletagestor = mysql_query("DELETE FROM superusuario
													WHERE id_campus != '0' AND id_campus = '".$campus."' ");
					}
					
					echo "<script type='text/javascript' language='javascript'>
						alert('Campus deletado com sucesso como também seu respectivo gestor!');
						window.location.href='campus.php';
						</script>";
				}else{
					echo "<script type='text/javascript' language='javascript'>
						alert('Campus não excluído!');
						window.location.href='campus.php';
						</script>";
				}
			}else{
				echo "<script type='text/javascript' language='javascript'>
						window.location.href='campus.php';
						</script>";
			}
	}
	
	if($acao == "atualiza1"){
		$_SESSION['campus'] = $campus;
		if ($campus != 0){
			$_SESSION['atualiza'] = true;
		}
		
		header("Location:campus.php");
	}
	
	if($acao == "atualiza2"){
		
		$campus = $_SESSION['id_campus'];
		
		$nome = $_POST['nome'];
		$endereco = $_POST['endereco'];
		$numero = $_POST['numero'];
		$bairro = $_POST['bairro'];
		$cidade = $_POST['cidade'];
		$estado = $_POST['estado'];
		
		$atualizacampus = mysql_query("UPDATE campus 
										SET nome = '".$nome."', endereco = '".$endereco."', numero = '".$numero."', bairro = '".$bairro."', cidade = '".$cidade."', estado = '".$estado."'
										WHERE id_campus = '".$campus."' ");
		if($atualizacampus){								
			echo "<script type='text/javascript' language='javascript'>
					alert('Dados do campus atualizado!');
					window.location.href='campus.php';
					</script>";
		}else{
			echo "<script type='text/javascript' language='javascript'>
					alert('Dados não podem ser atualizados no momento, tente novamente mais tarde!');
					window.location.href='campus.php';
					</script>";
		}
		
		$_SESSION['atualiza'] = false;
	}
?>