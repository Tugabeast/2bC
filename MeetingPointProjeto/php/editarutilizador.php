<?php
    include ('db_connection.php');

    if(isset($_POST['editarUtilizador'])){
        $id = $_POST['update_id'];

        $user = $_POST['user'];
        $name  = $_POST['name'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phone_number'];
        $role = $_POST['role'];

        $query = "UPDATE mp_users SET user = '$user', name= '$name', email = '$email', phone_number = '$phonenumber', role = '$role' WHERE id = '$id' ";
        $query_run = mysqli_query($connect, $query);

        if($query_run){
            echo "user editado com sucesso";
            header("location: settings.php");
        }
        else{
            echo "Error: " . $query . " " . mysqli_error($connect);
        }
    }

?>