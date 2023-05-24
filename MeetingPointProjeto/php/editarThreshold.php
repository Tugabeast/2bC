<?php

include ('db_connection.php');

if(isset($_POST['editarTH'])){
    $id = $_POST['thedit_id'];

    $TH1  = $_POST['threshold_h1'];
    $TH2  = $_POST['threshold_h2'];

    $query = "UPDATE gvir_status SET threshold_h1 = '$TH1 ', threshold_h2 = '$TH2' WHERE input = '$id' ";
    $query_run = mysqli_query($connect, $query);

    if($query_run){
        echo "user editado com sucesso";
        header("location: graficos.php");
    }
    else{
        echo "Error: " . $query . " " . mysqli_error($connect);
    }
}

?>