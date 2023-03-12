<?php
    $servername = "localhost";
    $username = "root";
    $password = "porto1893";
    $port = 3306;
    $dbname = "dashboard";

    $conn = mysqli_connect($servername ,$username, $password, $dbname, $port);

    if(!$conn){
        die("connection faile" . mysqli_connect_error());
    }
    echo "Connecao bem sucedida";


?>