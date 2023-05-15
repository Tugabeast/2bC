<?php 

include ('db_connection.php');

if(isset($_POST['alertedit_id'])){
    $id = $_POST['editalert_id'];

    $formato = $_POST['report_format'];

    $query = "UPDATE mp_alert SET report_format = '$formato' WHERE input = '$id' "; 
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
