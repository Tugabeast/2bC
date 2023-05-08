<?php
header('Access-Control-Allow-Origin: *');
//Construcao da página que busca os dados do ultimo mes que faz ligacao com os graficos
   require('db_connection.php');// ligacao a BD
    $dataFinal = date('Y/m/d', strtotime('+1 days'));  // data final dia de hoje +1 dia
    $dataInicial = date('Y/m/d', strtotime('-7 days'));// data inicial dia de hoje -30 dias ou seja ultimo mes
    $valor = $_GET['valor'];
    $serial = $_GET['serial'];
    $Serial_Number_Povoa = "032E280C4321000002";
    $Serial_Number_Aveiro = "018E22DC44F1000003";
    if($serial == 'povoa'){


   $query ="SELECT Time_Stamp,`$valor` FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number = '$Serial_Number_Povoa'"; // query

    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    if($valor == 'Alarm_TR' || $valor == 'Alarm_GPS' || $valor == 'Alarm_UMAX' || $valor == 'Alarm_Fuse_Positive' || $valor == 'Alarm_IMAX' || $valor == 'Alarm_Fuse_Negative' || $valor == 'Alarm_UREF' || $valor == 'Alarm_Fuse_UREF'){

      $prefix = '';

      while ($row = mysqli_fetch_assoc($result)) {

          echo nl2br($prefix . "\n");
          echo '  ' . $row['Time_Stamp'] . ',';
          echo nl2br('  ' . $row[$valor] . '' . "\n");
          echo $valor;
          $prefix = "\n";
      }
    }
    else if($valor == 'UREF_ON_Measure'){
      $prefix = '';

      while ($row = mysqli_fetch_assoc($result)) {

          echo nl2br($prefix . "\n");
          echo '  ' . $row['Time_Stamp'] . ',';
          echo nl2br('  ' . ($row[$valor]/1000)*-1 . '' . "\n");
          echo $valor;
          $prefix = "\n";
      }
    }
    else{
    $prefix = '';

    while ($row = mysqli_fetch_assoc($result)) {

        echo nl2br($prefix . "\n");
        echo '  ' . $row['Time_Stamp'] . ',';
        echo nl2br('  ' . $row[$valor]/1000 . '' . "\n");
        echo $valor;
        $prefix = "\n";
    }

}
}
else if($serial == 'aveiro'){
  $query ="SELECT Time_Stamp,`$valor` FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number = '$Serial_Number_Aveiro'"; // query

   $result = mysqli_query($con, $query) or die(mysqli_error($con));
if($valor == 'Alarm_TR' || $valor == 'Alarm_GPS' || $valor == 'Alarm_UMAX' || $valor == 'Alarm_Fuse_Positive' || $valor == 'Alarm_IMAX' || $valor == 'Alarm_Fuse_Negative' || $valor == 'Alarm_UREF' || $valor == 'Alarm_Fuse_UREF'){
  $prefix = '';

  while ($row = mysqli_fetch_assoc($result)) {

      echo nl2br($prefix . "\n");
      echo '  ' . $row['Time_Stamp'] . ',';
      echo nl2br('  ' . $row[$valor] . '' . "\n");
      echo $valor;
      $prefix = "\n";
  }

}else if($valor == 'UREF_ON_Measure'){
  $prefix = '';

  while ($row = mysqli_fetch_assoc($result)) {

      echo nl2br($prefix . "\n");
      echo '  ' . $row['Time_Stamp'] . ',';
      echo nl2br('  ' . ($row[$valor]/1000)*-1 . '' . "\n");
      echo $valor;
      $prefix = "\n";
  }
}
else{
   $prefix = '';

   while ($row = mysqli_fetch_assoc($result)) {

       echo nl2br($prefix . "\n");
       echo '  ' . $row['Time_Stamp'] . ',';
       echo nl2br('  ' . $row[$valor]/1000 . '' . "\n");
       echo $valor;
       $prefix = "\n";
   }
}
}
  ?>
