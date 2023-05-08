<?php
header('Access-Control-Allow-Origin: *');
//Construcao da página que busca os dados(dia de hoje) mais recentes que faz ligacao com os graficos

   require('db_connection.php');// ligacao a BD
    $dataFinal = date('Y/m/d', strtotime('+2 days')); // data final dia de hoje +1 dia
    $dataInicial = date('Y/m/d'); // data inicial dia de hoje
    $valor = $_GET['valor'];
    $serial = $_GET['serial'];
    $Serial_Number_Povoa = "032E280C4321000002";
    $Serial_Number_Aveiro = "018E22DC44F1000003";
    if($serial == 'povoa'){
   $query ="SELECT Time_Stamp,`$valor` FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa'"; // query

    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    //
    $prefix = '';

    while ($row = mysqli_fetch_assoc($result)) {

        echo nl2br($prefix . "\n");
        echo '  ' . $row['Time_Stamp'] . ',';
        echo nl2br('  ' . $row[$valor]/1000 . '' . "\n");

        $prefix = "\n";
    }
}
else if($serial == 'aveiro'){
  $query ="SELECT Time_Stamp,`$valor` FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro'"; // query

   $result = mysqli_query($con, $query) or die(mysqli_error($con));
   //
   $prefix = '';

   while ($row = mysqli_fetch_assoc($result)) {

       echo nl2br($prefix . "\n");
       echo '  ' . $row['Time_Stamp'] . ',';
       echo nl2br('  ' . $row[$valor]/1000 . '' . "\n");

       $prefix = "\n";
   }
}

   mysqli_close($con);
  ?>
