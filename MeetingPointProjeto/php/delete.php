<?php 
    include ('db_connection.php');
    if(!empty($_GET['id'])){
       
        $id = $_GET['id'];
        
        $query = "DELETE FROM `mp_users` WHERE id = '$id' " ;
        $query_run = mysqli_query($connect,$query);

        if($query_run){
            echo '<script> alert("Data deleted"); </script>';
            header("Location: settings.php");
        }
        else{
            echo '<script> alert("Data not deleted"); </script>';
            header("Location: settings.php");
        }
    }
    header("Location: settings.php");
    exit();
?>