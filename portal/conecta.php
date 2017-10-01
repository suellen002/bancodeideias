<?php
    include('classesBD.php');
    $connect = new connectBD();
 
    $connect->set('bd','information_schema');
    $connect->set('host','localhost');
    $connect->set('usuario','root');
    $connect->set('senha','');
    $connect->set('sql','SELECT * FROM SCHEMATA S');
 
    $connect->conectar();
    $connect->selecionarDB();
 
    echo 'Foram encontrados: ' . mysql_num_rows($connect->executar()) . ' Schemas em seu banco de dados';
?>