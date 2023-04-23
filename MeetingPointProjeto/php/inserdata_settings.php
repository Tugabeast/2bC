<?php
    include ('db_connection.php');
    //$success  = "";

    if(isset($_POST['adicionar'])) {
        $user = $_POST['user'];
        $name  = $_POST['name'];
        $role = $_POST['role'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phone_number'];
        //$password = md5($_POST['password']); 
        $password = $_POST['password']; 

        $sqlinsert = "INSERT INTO mp_users (user,name,password,email,phone_number,role)
            VALUES ('$user', '$name','$password','$email','$phonenumber, '$role' )";
        
        if(mysqli_query($connect,$sqlinsert)){
            //$success = "novo user adicionado com sucesso!";
            echo "novo user adicionado com sucesso";
        }
        else {
            echo "Error: " . $sqlinsert . " " . mysqli_error($connect);
        }
        //mysqli_close($connect);
    }
?>