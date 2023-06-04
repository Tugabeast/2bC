<?php

include('db_connection.php');

if (isset($_POST['eliminarAlerta'])) {
    $id = $_POST['eliminarAlerta_id'];

    $query = "DELETE FROM mp_alert WHERE input = '$id'";
    

    $query_run = mysqli_query($connect, $query);
    

    if ($query_run) {
        echo "utilizador eliminado com sucesso";
        header("location: settings.php");
    } else {
        echo "Error: " . $query . " " . mysqli_error($connect);
    }
    
}

?>