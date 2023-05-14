<?php
    include ('db_connection.php');
    

    if(isset($_POST['eliminarUtilizador'])){
        $id = $_POST['delete_id'];

        $query = "DELETE FROM mp_users WHERE id = '$id' ";
        $query_run = mysqli_query($connect, $query);

        if($query_run){
            echo "utilizador eliminado com sucesso";
            header("location: settings.php");
        }
        else{
            echo "Error: " . $query . " " . mysqli_error($connect);
        }
    }
?>