<?php

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = 'porto1893';
    $dbName = 'dashboard';
    $port = 3306;

    $connect = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName,$port);

    
if($connect->connect_error){
    die('Conexao falhou: ' .$connect->connect_error);
}

?>