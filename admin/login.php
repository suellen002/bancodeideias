<?php
	session_start();
	include ("conectar.php");
	
	$email = $_POST['email'];
	$senha = $_POST['password'];
	
	//tipo 1 gestor -- 0 admn
	
	
	if ($email != "" and $senha != ""){
	
		$procura = mysql_query("SELECT email, idusuario, tipo, nomeusuario
								FROM superusuario 
								WHERE email = '".$email."' AND senha = '".$senha."' AND TIPO = 0");
								
		if (mysql_num_rows($procura)>0){
			while ($dados = mysql_fetch_assoc($procura) ) { // Obtém os dados da linha atual e avança para o próximo registro
				$_SESSION["autentica"] = true; // informa ao sistema usuario logado
				$_SESSION["email"] = $dados["email"];
				$_SESSION["idusuario"] = $dados["idusuario"];
				$_SESSION["nome"] = $dados["nomeusuario"];
				$_SESSION["tipo"] = "adm";
				
				header('Location: index.php');
				
			}
		}else{
			echo "<script type='text/javascript' language='javascript'>
						alert('Não foi encontrado usuario com esses dados!');
						window.location.href='login.html';
						</script>";
		}
	}else{
			echo "<script type='text/javascript' language='javascript'>
						alert('Dado em branco');
						window.location.href='login.html';
						</script>";
		
	}
	
?>