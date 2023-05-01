<?php
/*
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPasswordportatil = 'porto1893';
    $dbPasswordfixo = 'root';
    $dbName = 'dashboard';
    $portportatil = 3306;
    $portfixo = 3305;

    $connect = new mysqli($dbHost,$dbUsername,$dbPasswordfixo,$dbName,$portfixo);
    */
    include ('db_connection.php');
    //$success  = "";

    if(isset($_POST['adicionar'])) {
        $user = $_POST['user'];
        $name  = $_POST['name'];
        //$password = md5($_POST['password']); 
        $password = $_POST['password']; 
        $email = $_POST['email'];
        $phonenumber = $_POST['phone_number'];
        $role = $_POST['role'];
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");
        
        
        //$password = $_POST['password']; 

        $sqlinsert = "INSERT INTO `mp_users` (user,name,password,email,phone_number,role) VALUES 
            VALUES ('$user', '$name','$password','$email','$phonenumber, '$role')";
        
        if(mysqli_query($connect,$sqlinsert)){
            //$success = "novo user adicionado com sucesso!";
            echo "novo user adicionado com sucesso";
            header("location: settings.php");
        }
        else {
            echo "Error: " . $sqlinsert . " " . mysqli_error($connect);
        }
        //mysqli_close($connect);
    }
    


?>