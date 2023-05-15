<?php

    include ('db_connection.php');

    if(isset($_POST['eliminarMP'])){
        $id = $_POST['mpelimin_id'];

        $query = "DELETE FROM meeting_point WHERE id = '$id' ";
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
