<?php

include ('db_connection.php');



if(isset($_POST['adicionarAlerta'])){
    $name  = $_SESSION['name'];
    $email = $_SESSION['email'];

    $alertH1 = $_POST['alertH1'];
    $alertH2 = $_POST['alertH2'];
    $alertH3 = $_POST['alertH3'];

    $formato = $_POST['report_format'];

    
    $sql = "INSERT INTO mp_alert (`name`,`email`, `alertH1`,`alertH2`,`alertH3`,`report_format`) VALUES ('$name','$email', '$alertH1', '$alertH2', '$alertH3', '$formato')";
    $query_run = mysqli_query($connect,$sql);

    if($query_run){
        
        echo "novo user adicionado com sucesso";
        header("location: settings.php");
    }
    else {
        echo "Error: " . $sql . " " . mysqli_error($connect);
        
    }
}




?>

