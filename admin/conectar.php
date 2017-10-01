<?php

$conec = mysql_connect("localhost", "root", "") or
			die('Não foi possível conectar');
		mysql_select_db("repositorio", $conec);

mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
	
?>