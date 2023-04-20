<?php

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPasswordportatil = 'porto1893';
    $dbPasswordfixo = 'root';
    $dbName = 'dashboard';
    $portportatil = 3306;
    $portfixo = 3305;

    //$connect = new mysqli($dbHost,$dbUsername,$dbPasswordfixo,$dbName,$portfixo);
    $connect = new mysqli($dbHost,$dbUsername,$dbPasswordportatil,$dbName,$portportatil);

    
if($connect->connect_error){
    die('Conexao falhou: ' .$connect->connect_error);
}

?>