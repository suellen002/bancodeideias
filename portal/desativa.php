<?php
	session_start();
	include ("conectar.php");
	
	$cnpj = $_SESSION["cnpj"];
	
	$procura = mysql_query("SELECT cnpj, nomeRep, ativo
								FROM empresa 
								WHERE cnpj = '".$cnpj."'");
		
	if ($procura){
		while ($dados = mysql_fetch_assoc($procura) ) { // Obtém os dados da linha atual e avança para o próximo registro
			if ($dados["ativo"] == 1){
				echo "<script type='text/javascript' language='javascript'>
					alert('Olá ".$dados["nomeRep"]." estamos desativando seu cadastro!');
				</script>";
				//verifica se o usuário está ativo
				$desativa = mysql_query("UPDATE empresa 
										SET ativo = '0'
										WHERE cnpj = '".$dados["cnpj"]."'");
										
				if($desativa){
					echo "<script type='text/javascript' language='javascript'>
						alert('Seu cadastro foi desativado com sucesso!');
						window.location.href='index1.html';
					</script>";
				}else{
					session_destroy();
					echo "<script type='text/javascript' language='javascript'>
					alert('Seu cadastro não pode ser desativado!');
					window.location.href='bancodados.php';
					</script>";
				}
			}else{
				session_destroy();
				echo "<script type='text/javascript' language='javascript'>
					alert('Seu cadastro já se encontra inativo!');
					window.location.href='index1.html';
				</script>";
			//inserir acima - window.location.href='index1.html';
			}
		}
	}else{
		session_destroy();
		echo "<script type='text/javascript' language='javascript'>
			alert('Seu cadastro não pode ser desativado! Algo deu errado!');
			window.location.href='index1.html';
		</script>";
	}
	
	mysql_close();
	
	/*
	envio de email confirmando desativação do cadastro
	$headers = "MIME-Version: 1.1\r\n";
	$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
	$headers .= // dominio????
	$headers .= "Return-Path: eu@seudominio.com\r\n"; 
	$envio = mail("destinatario@algum-email.com", "Assunto", "Texto", $headers);
	 
	if($envio)
	 echo "Mensagem enviada com sucesso";
	else
	 echo "A mensagem não pode ser enviada";
	?> */
?>