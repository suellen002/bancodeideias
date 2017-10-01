<?php
	session_start();
	
	echo "<TABLE BORDER=2 CELLSPACING=30 CELLPADDING=30>
			<CAPTION>
				<h1>Olá ".$_SESSION["nomerepresentante"]."</h1>
			</CAPTION>
			<CAPTION>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</CAPTION>
			<CAPTION>
				<h3>O que deseja fazer?</h3>
			</CAPTION>
			<TR>
				<TH>Cadastrar nova ideia</TH>
			</TR>
			<TR>
				<TH>Atualizar dados da empresa</TH>
				</TR>
			<TR>
				<TH>Atualizar dados do representante da empresa</TH>
			</TR>
			<TR>
				<TH><a href='desativa.php'>Desativar cadastro</a></TH>
			</TR>
			<TR>
				<TH><a href='sair.php'>Sair</a></TH>
			</TR>
		</TABLE>";
?>