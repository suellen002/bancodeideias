<?php
	session_start();
	include ("conectar.php");
	
	$email = $_POST['email'];
	$senha = $_POST['password'];
	
	//tipo 1 gestor -- 0 admn
	
	
	if ($email != "" and $senha != ""){
	
		$procura = mysql_query("SELECT email, idusuario, tipo, nomeusuario
								FROM superusuario 
								WHERE email = '".$email."' AND senha = '".$senha."' AND TIPO = 1");
								
		if (mysql_num_rows($procura)>0){
			while ($dados = mysql_fetch_assoc($procura) ) { // Obtém os dados da linha atual e avança para o próximo registro
				$_SESSION["autentica"] = true; // informa ao sistema usuario logado
				$_SESSION["email"] = $dados["email"];
				$_SESSION["idusuario"] = $dados["idusuario"];
				$_SESSION["nome"] = $dados["nomeusuario"];
				$_SESSION["tipo"] = "gestor";
				
				$procuracampus = mysql_query("SELECT id_campus, nome, id_gestor
												FROM campus 
												WHERE id_gestor = '".$_SESSION["idusuario"]."' 
												LIMIT 1");
												
				if($procuracampus){
					while ($listacampus = mysql_fetch_assoc($procuracampus)){
						$_SESSION["nomecampus"] = $listacampus["nome"];
						$_SESSION["idcampus"] = $listacampus["id_campus"];
						
						header('Location: index.php');
					}
				}else{
					echo "<script type='text/javascript' language='javascript'>
						alert('Algo deu errado com a localização do seu campus, entre em contato com o administrador do sistema!');
						window.location.href='login.html';
						</script>";
				}
				
			}
		}else{
			echo "<script type='text/javascript' language='javascript'>
						alert('Não encontramos usuario com esses dados!');
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