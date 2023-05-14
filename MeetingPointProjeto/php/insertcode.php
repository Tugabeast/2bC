<?php

    include ('db_connection.php');
    //$success  = "";

    if(isset($_POST['adicionar'])) {
        $user = $_POST['user'];
        $name  = $_POST['name'];
        $password = md5($_POST['password']); 
        $email = $_POST['email'];
        $phonenumber = $_POST['phone_number'];
        $role = $_POST['role'];

        
        
        //$password = $_POST['password']; 

        $sqlinsert = "INSERT INTO mp_users (`user`,`name`,`password`,`email`,`phone_number`,`role`) VALUES 
             ('$user', '$name','$password','$email','$phonenumber', '$role')";
        $query_run = mysqli_query($connect,$sqlinsert);     
        
        if($query_run){
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