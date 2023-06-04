<?php 

include ('db_connection.php');

if(isset($_POST['alertedit_id'])){
    $id = $_POST['editalert_id'];

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

    $query = "UPDATE mp_alert SET alert='$alertsText', alertH1='$alertH1',alertH2='$alertH2',alertH3='$alertH3' ,report_format = '$formato' WHERE input = '$id' "; 
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
