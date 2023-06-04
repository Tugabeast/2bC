<?php

session_start();
include ('db_connection.php');



if(isset($_POST['adicionarAlerta'])){
    $name  = $_SESSION['nome'];
    $email = $_SESSION['email'];
    

    $alerts = [];

    // Verificar quais alerts estão selecionados
    if (isset($_POST['alertH1'])) {
        $alerts[] = 'H1';
    }

    if (isset($_POST['alertH2'])) {
        $alerts[] = 'H2';
    }

    if (isset($_POST['alertH3'])) {
        $alerts[] = 'H3';
    }

    // Converter os alerts selecionados em texto separado por vírgulas
    $alertsText = implode(',', $alerts);


    $alertH1 = in_array('H1', $alerts) ? 1 : 0;
    $alertH2 = in_array('H2', $alerts) ? 1 : 0;
    $alertH3 = in_array('H3', $alerts) ? 1 : 0;

    $formato = $_POST['report_format'];

    
    $sql = "INSERT INTO mp_alert (`name`,`email`,`alert`,`alertH1`,`alertH2`,`alertH3`,`report_format`) VALUES ('$name','$email', '$alertsText','$alertH1', '$alertH2', '$alertH3', '$formato')";
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

