<?php
	session_start();
	include ("conectar.php");
	
	$insere = $_POST['insere'];
	
	if ($insere == "single"){
	
		if ($_POST['nome'] != "" AND $_POST['endereco'] != "" AND $_POST['numero'] != "" AND $_POST['bairro'] != "" AND $_POST['cidade'] != "" AND $_POST['estado'] != "" AND $_POST['cnpj'] != ""){
			$nome = $_POST['nome'];
			$endereco = $_POST['endereco'];
			$numero = $_POST['numero'];
			$bairro = $_POST['bairro'];
			$cidade = $_POST['cidade'];
			$estado = $_POST['estado'];
			$cnpj = $_POST['cnpj'];
		
			$insiracampus = mysql_query("INSERT INTO campus (nome, endereco, numero, bairro, cidade, estado, cnpj)
											VALUES ('".$nome."', '".$endereco."', '".$numero."', '".$bairro."', '".$cidade."', '".$estado."', '".$cnpj."')");
										
										
			if($insiracampus){
				echo "<script type='text/javascript' language='javascript'>
					alert('Campus cadastrado com sucesso, não esqueça de cadastrar um novo gestor para poder receber ideias!');
					window.location.href='inserecampus.php';
				</script>";
			}else{
				mysqli_error();
				echo "<script type='text/javascript' language='javascript'>
					alert('Campus não cadastrado, tente novamente mais tarde!');
					
				</script>";
			}
		}else{
			echo "<script type='text/javascript' language='javascript'>
					alert('Existe algum dado em branco!');
					window.location.href='inserecampus.php';
				</script>";
		}
	}else{
		if($insere == "massa"){
			
			if(isset($_FILES['arquivoupload'])){
				
				$arquivo = $_FILES['arquivoupload']['tmp_name'];

				$objeto = fopen ($arquivo, "r");
				
				while(($dados = fgetcsv($objeto, 1000, ";")) != FALSE){
					$insiracampus = mysql_query("INSERT INTO campus (nome, endereco, numero, bairro, cidade, estado, cnpj)
												VALUES ('".$dados['0']."', '".$dados['1']."', '".$dados['2']."', '".$dados['3']."', '".$dados['4']."', '".$dados['5']."', '".$dados['6']."')");
					if ($insiracampus){
						$inseriu = true;
					}else{
						$inseriu = false;
					}
				}
				if ($inseriu){
						echo "<script type='text/javascript' language='javascript'>
							alert('Dados inseridos com sucesso!');
							window.location.href='inserecampus.php';
						</script>";
					}else{
						echo "<script type='text/javascript' language='javascript'>
							alert('Não inserido!');
							window.location.href='inserecampus.php';
							</script>";
					}
				fclose($objeto);	
			}else{
				echo "<script type='text/javascript' language='javascript'>
					alert('Não encontramos nenhuma planilha, tente novamente!');
					window.location.href='inserecampus.php';
				</script>";
			}
			

		}else{
			echo "<script type='text/javascript' language='javascript'>
					alert('Algo deu errado, tente novamente mais tarde!');
					window.location.href='inserecampus.php';
				</script>";
		}
	}

?>