<?php
	session_start();
	include ("conectar.php");
	
	$nomeempresa = $_POST['nomeempresa'];
	$razaosocial = $_POST['razaosocial'];
	$cnpj = $_SESSION["cnpj"];
	$senha = $_POST['senha'];
	
	$nomerepresentante = $_POST['nomerepre'];
	$email = $_POST['email'];
	$ddd1 = $_POST['ddd1'];
	$telefone1 = $_POST['tel1'];
	$ddd2 = $_POST['ddd2'];
	$telefone2 = $_POST['tel2'];
	$endereco = $_POST['endereco'];
	$numero = $_POST['endnum'];
	$bairro = $_POST['bairro'];
	$cidade = $_POST['cidade'];
	
	//atualiza a sessão
	$_SESSION["logado"] = true; // informa ao sistema usuario logado
	$_SESSION["nomerepresentante"] = $nomerepresentante;
	$_SESSION["nomeEmp"] = $nomeempresa;
	$_SESSION["razaoS"] = $razaosocial;
	$_SESSION["cnpj"] = $cnpj;	
	$_SESSION["email"] = $email;
	$_SESSION["ddd1"] = $ddd1;
	$_SESSION["tel1"] = $telefone1;
	$_SESSION["ddd2"] = $ddd2;
	$_SESSION["tel2"] = $telefone2;
	$_SESSION["endereco"] = $endereco;
	$_SESSION["num"] = $numero;
	$_SESSION["cidade"] = $cidade;
	$_SESSION["bairro"] = $bairro;
	$_SESSION["senha"] = $senha;
	
	if($nomeempresa == "" or $razaosocial == "" or $cnpj == "" or $senha == "" or $nomerepresentante == "" or $email == "" or $telefone1 == "" or $endereco == "" or $bairro ==""){
		echo "<script type='text/javascript' language='javascript'>
			alert('Dados necessários em branco!');
			window.location.href='atualiza.php';
			</script>";
	}else{
		$update = mysql_query("UPDATE empresa 
								SET nomeEmp = '".$nomeempresa."', razaoS = '".$razaosocial."', nomeRep = '".$nomerepresentante."', email = '".$email."', ddd1 = '".$ddd1."', tel1 = '".$telefone11."', ddd2 = '".$ddd2."', tel2 = '".$telefone22."', endereco = '".$endereco."', num = '".$numero."', bairro = '".$bairro."'
								WHERE cnpj = '".$cnpj."'");
								
		if($update){
			echo "<script type='text/javascript' language='javascript'>
					alert('Dados atualizados com sucesso!');
					window.location.href='index1.html';
				</script>";
		}else{
			echo "<script type='text/javascript' language='javascript'>
					alert('Não foi possível atualizar seus dados, tente novamente mais tarde!');
					window.location.href='index1.html';
				</script>";			
		}
	}
?>