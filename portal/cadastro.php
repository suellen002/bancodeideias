<?php
include 'conectar.php';
?>

<!DOCTYPE html>
<html lang="pt-br" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
<head>
	<meta http-equiv="Content-Type"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0" />
	<title>Portal de inovações do Instituto federal de Educação, Ciência e Tecnologia de São Paulo - Campus Guarulhos</title>
	<link rel="shortcut icon" type="image/x-icon" href="css/images/favicon.ico" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="all" />
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500,700' rel='stylesheet' type='text/css' />
	<link href='https://igorescobar.github.io/jQuery-Mask-Plugin/' rel='stylesheet' type='text/css' />
	
	<script language="JavaScript" type="text/javascript" src="js/MascaraValidacao.js"></script>
	<script src="js/jquery.flexslider-min.js" type="text/javascript"></script>
	<script src="js/functions.js" type="text/javascript"></script>
	<!-- Adicionando JQuery -->
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Adicionando Javascript -->
    <script type="text/javascript" >

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>
</head>
<body>
	<!-- wraper -->
	<div id="wrapper">
		<!-- shell -->
		<div class="shell">
			<!-- container -->
			<div class="container">
				<!-- header -->
				<header id="header">
					<h1 id="logo"><a href="index.html">Portal de Inovações</a></h1>
					<!-- search -->
					<div class="search">
						<form method="post">
							<span class="field"><input type="text" class="field" value="Buscar no portal" title="Buscar" /></span>
							<input type="submit" class="search-btn" value="" />
						</form>
					</div>
					<!-- end of search -->
				</header>
				<!-- end of header -->
				<!-- navigation -->
				<nav id="navigation">
					<a href="index.html" class="nav-btn">HOME<span class="arr"></span></a>
					<ul>
						<li><a href="index.html">HOME</a></li>
						<li><a href="sobre.html">sobre nós</a></li>
						<li><a href="if.html">O if</a></li>
						<li class="active"><a href="cadastro.html">Cadastre-se</a></li>
						<li><a href="banco.php">banco de ideias</a></li>
						<li><a href="noticias.php">notícias</a></li>
						<li ><a href="fconosco.html">fale conosco</a></li>
					</ul>
				</nav>
				<section class="testimonial">
				<form action="cadastro.php" method="POST" name="form1">
					<center>
					<br><br><br>
					<table cellpadding="10" cellspacing="10">
					<input type='hidden' name='controle' value='true'>
						<caption>
							<h2>Cadastro de nova empresa</h2>
						</caption>
						<tr>
							<td>
								<div class="box-cnt">
								<strong class="quote">NOME FANTASIA:*</strong>
								</div>
							</td>
							<td>
								<input type="text" name="nomeempresa" size="50" maxlength="100">
							</td>
						</tr>
						<tr>
							<td>
								<strong class="quote">RAZÃO SOCIAL:*</strong>
							</td>
							<td>
								<input type="text" name="razaosocial" size="50" maxlength="100">
							</td>
						</tr>
						<tr>
							<td>
								<strong class="quote">CNPJ:*</strong>
							</td>
							<td>
								<input type="text" name="cnpj" size="50" maxlength="100" id="cnpj" onKeyPress="MascaraCNPJ(form1.cnpj);" onBlur="ValidarCNPJ(form1.cnpj);">
							</td>
						</tr>
						<tr>
							<td>
								<strong>CEP:*</i></strong>
							</td>
							<td>
								<input type="text" name="cep" size="50" maxlength="9" placeholder="00000-000" id="cep" onblur="pesquisacep(this.value);">
							</td>
						</tr>
						<tr>
							<td>
								<p><strong class="quote">LOGRADOURO:*</strong>
							</td>
							<td>
								<input type="text" name="endereco" size="50" maxlength="100" id="rua"><p><strong class="quote"><i>
							</td>
						</tr>
						<tr>
							<td>
								<i><strong>N°:</i></strong>
							</td>
							<td>
								<input type="text" name="endereconum" size="4" maxlength="5"> &nbsp;
								<strong class="quote">
								<i><strong>BAIRRO:*</i></strong>
								<input type="text" name="bairro" size="30" maxlength="35" id="bairro">
						</tr>
						<tr>
							<td>
								<strong class="quote"><i><strong>CIDADE:*</i></strong></align>
							</td>
							<td>
								<input type="text" name="cidade" size="25" maxlength="35" id="cidade">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<strong class="quote"><i><strong>UF:*</i></strong>
								<input type="text" name="estado" size="11" maxlength="15" id="uf">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<strong class="quote"><i><strong>PORTE:*</i></strong></align>
							</td>
							<td>
								<font color='grey'>
								<select name='porte'>	
									<option value='Microempresa'>Microempresa (Até 19 funcionários)</option>
									<option value='Pequeno porte'>Empresa de Pequeno porte (20 a 99 funcionários)</option>
									<option value='Médio porte'>Empresa de Médio Porte (100 a 499 funcionários)</option>
									<option value='Grande porte'>Empresa de Grande porte (Acima de 500 funcionários)</option>
								</select>
								</font>
							</td>
						</tr>
						<tr>
							<td>
								<strong class="quote"><i><strong>TIPO EMPRESA:*</i></strong></align>
							</td>
							<td>
								<input type="radio" name="tipoempresa" value="Sociedade Anônima ou LTDA">Sociedade Anômima ou LTDA<br>
								<input type="radio" name="tipoempresa" value="microempresa">Microempresa<br>
								<input type="radio" name="tipoempresa" value="Microempreendedor Individual" checked>Microempreendedor Individual<br>
								<input type="radio" name="tipoempresa" value="Empresa Individual de Responsabilidade Limitada (EIRELI)">Empresa Individual de Responsabilidade Limitada (EIRELI)<br>
								<input type="radio" name="tipoempresa" value="Sem fins lucrativos">Sem fins lucrativos<br>
							</td>
						</tr>
						<tr>
							<td>
								<strong class="quote"><i><strong>SEGMENTO:*</i></strong></align>
							</td>
							<td>
								<select name='areaatuacao'>
								<?php
									$buscaarea = mysql_query("SELECT * FROM area
																WHERE ativo = 1
																ORDER BY nome ASC");
																
									while ($listaarea = mysql_fetch_assoc($buscaarea)){
										echo "<option value='".$listaarea['id']."'>".$listaarea['nome']."</option>";
									}
								?>
								</select>
							</td>
						</tr>
					<table>
					<br>
					<table cellpadding="10" cellspacing="10">
						<caption>
							<h1>Representante</h1>
						</caption>
						<tr>
							<td>
								<strong class="quote">REPRESENTANTE*</strong>
							</td>
							<td>
								<input type="text" name="nomerepre" size="50" maxlength="100">					
								<strong class="quote"><i>
							</td>
						</tr>
						<tr>
							<td>
								<strong>E-MAIL:*</i></strong>
							</td>
							<td>
								<input type="text" name="email" size="50" maxlength="100">
							</td>
							<td>
								<strong class="quote"><i>
							</td>
						</tr>
						<tr>
							<td>
								<strong>SENHA:*</i></strong>
							</td>
							<td>
								<input type="password" name="senha" size="50" maxlength="20">
							</td>
							<td>
								<strong class="quote"><i>
							</td>
						</tr>
						<tr>
							<td>
								<strong>TELEFONE:*</i></strong>
							</td>
							<td>
								<input type="text" name="ddd1" size="4" maxlength="4" placeholder="(11)"> - <input type="text" name="telefone1" size="15" maxlength="10" placeholder="(2)2222-2222">
							</td>
						</tr>
						<tr>
							<td>
								<strong class="quote">TELEFONE:</strong></align>
							</td>
							<td>
								<input type="text" name="ddd2" size="4" maxlength="4" placeholder="(11)"> - <input type="text" name="telefone2" size="15" maxlength="10"placeholder="(2)2222-2222">
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td>
								<input type="image" src="imagens/botao.PNG" value="submit" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
						<tr>
							<td>&nbsp;
							</td>
							<td>
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td><font><i>(*) Dados obrigatórios</font>
							</td>
						</tr>
						
						
					</table>
					</center>
					<br><br><br>
				</form>
				</section>
				<div id="footer">
					<div class="footer-cols">
						<div class="col">
							<h2>Projetos</h2>
							<ul>
								<li><a href="#">Projeto 1</a></li>
								<li><a href="#">Projeto 2</a></li>
								<li><a href="#">Projeto 3</a></li>
								<li><a href="#">Projeto 4</a></li>
							</ul>
						</div>
						<div class="col">
							<h2>Parceiros</h2>
							<ul>
								<li><a href="http://www.golin.com.br/" target="_blank">Metarlugica Golin</a></li>
								<li><a href="http://www.cummins.com.br/" target="_blank">Cummins</a></li>
								<li><a href="http://www.guarulhos.sp.gov.br/" target="_blank">Prefeitura de Guarulhos</a></li>
								<li><a href="https://www.totvs.com/" target="_blank">TOTVS</a></li>
							</ul>
						</div>
						<div class="cl">&nbsp;</div>
					</div>
					<!-- end of footer-cols -->
					<div class="footer-bottom">
						<nav class="footer-nav">
							<ul>
								<li><a href="index.html">HOME</a></li>
								<li><a href="sobre.html">sobre nós</a></li>
								<li><a href="if.html">O if</a></li>
								<li class="active"><a href="cadastro.html">Cadastre-se</a></li>
								<li><a href="banco.php">banco de ideias</a></li>
								<li><a href="noticias.php">notícias</a></li>
								<li><a href="fconosco.html">fale conosco</a></li>
							</ul>
						</nav>
						<p class="copy">&copy; Copyright 2016 - Projeto de TCC desenvolvido para o curso de ADS</p>
						<div class="cl">&nbsp;</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>

<?php

	if (isset($_POST['controle'])){;
		include 'conectar.php';
		
		$nomeempresa = $_POST['nomeempresa'];
		$razaosocial = $_POST['razaosocial'];
		$cnpj = $_POST['cnpj'];
		$cep = $_POST['cep'];
		$logradouro = $_POST['endereco'];
		$endereconumero = $_POST['endereconum'];
		$bairro = $_POST['bairro'];
		$cidade = $_POST['cidade'];
		$estado = $_POST['estado'];
		$porte = $_POST['porte'];
		$tipoempresa = $_POST['tipoempresa'];
		$areaatuacao = $_POST['areaatuacao'];
		
		$representante = $_POST['nomerepre'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$ddd1 = $_POST['ddd1'];
		$num1 = $_POST['telefone1'];
		$ddd2 = $_POST['ddd2'];
		$num2 = $_POST['telefone2'];
		
		$valor = trim($cnpj);
		$valor = str_replace(".", "", $valor);
		$valor = str_replace(",", "", $valor);
		$valor = str_replace("-", "", $valor);
		$valor = str_replace("/", "", $valor);
		$cnpj = $valor;
		
		$data = date("Y-m-d");
		
		if($nomeempresa == "" or $razaosocial == "" or $cnpj == "" or $senha == "" or $representante == "" or $email == "" or $num1 == "" or $logradouro == ""){
			echo "<script type='text/javascript' language='javascript'>
				alert('Algum dado essencial está em branco!');
				window.history.back();
				</script>";
		}else{
		
			//verifica se a empresa já está cadastrada no sistema
			$procuracnpj = mysql_query("SELECT cnpj
										FROM empresa 
										WHERE cnpj = '".$cnpj."'");
										
			if(mysql_num_rows($procuracnpj)>0){
				echo "<script type='text/javascript' language='javascript'>
					alert('Empresa já cadastrada!');
					window.location.href='banco.php';
					</script>";
					exit();
			}else{
				$insere = mysql_query("INSERT INTO empresa (nomeEmp, cnpj, razaoS, nomeRep, email, senha, ddd1, tel1, ddd2, tel2, endereco, cep, num, bairro, cidade, estado, porte, tipoempresa, areaatuacao, data) 
						VALUES ('".$nomeempresa."', '".$cnpj."','".$razaosocial."', '".$representante."', '".$email."', '".$senha."', '".$ddd1."', '".$num1."', '".$ddd2."', '".$num2."', '".$logradouro."', '".$cep."', '".$numero."', '".$bairro."', '".$cidade."', '".$estado."', '".$porte."', '".$tipoempresa."', '".$areaatuacao."', '".$data."')");
						//cadastra nova empresa
				echo "<script type='text/javascript' language='javascript'>
					alert('Cadastro realizado com sucesso!');
					window.location.href='banco.php';
					</script>";
			if ($achou){
				if($insere){
					echo "<script type='text/javascript' language='javascript'>
						alert('Cadastro realizado com sucesso!');
						window.location.href='banco.php';
						</script>";
						//header('location: cadastro.html');
				}else{
					echo "<script type='text/javascript' language='javascript'>
					alert('Seu cadastro não pode ser realizado no momento, lamentamos o transtorno!');
					window.location.href='index.html';
					</script>";
							//header('location: index1.html');
				}
			}
			}
		}
	}
?>