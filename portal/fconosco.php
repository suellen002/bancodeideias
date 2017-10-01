<?php
	include 'conectar.php';
	include 'funcoes.php';
	session_start();
	
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$mensagem = $_POST['mensagem'];
	$titulo = $_POST['titulo'];
	$data = date("Y-m-d");
	
	if (validaemail($email)){
		$insere = mysql_query("INSERT INTO faleconosco (nome, email, titulo, mensagem, data) VALUES ('".$nome."', '".$email."', '".$titulo."', '".$mensagem."', '".$data."')");
		
		if ($nome == "" or $email == "" or $mensagem == ""){
			echo "<script type='text/javascript' language='javascript'>
					alert('Você esqueceu de preencher algum campo, tente novamente!');
					window.history.back();
			</script>";
		}else{
			if ($insere){
				echo "<script type='text/javascript' language='javascript'>
						alert('Recebemos sua mensagem, por gentileza aguardar retorno de um de nossos gestores!');
						window.location.href='index.html';
					</script>";
				//header('location: fconosco.html');
			}else{
				echo "<script type='text/javascript' language='javascript'>
						alert('Mensagem não enviada!');
						window.location.href='fconosco.html';
					</script>";
				//header('location: fconosco.html');
			}
		}
	}else{
		echo "<script type='text/javascript' language='javascript'>
						alert('O email digitado é invalido, tente novamente!');
						window.history.back();
					</script>";
	}
	mysql_close($conec);
?>