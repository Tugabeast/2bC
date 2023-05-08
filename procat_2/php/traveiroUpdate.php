<?php
header('Access-Control-Allow-Origin: *');
require('db_connection.php');


  $Serial_Number_Aveiro = "018E22DC44F1000003";
  $date = date('Y-m-d H:i:s');
  $month = date("n",strtotime($date));
  $year = date("o",strtotime($date));

  $lastHour =  date('Y-m-d H:i:s', strtotime('1 hour'));

  $queryAveiro = "SELECT VOUT_Measure,IOUT_Measure,UREF_ON_Measure,UREF_ON_Measure,UREF_OFF_Measure,Time_Stamp,UMAX_Config, IMAX_Config,UREF_Config,System,Command_Mode,Operation_Mode,Operation_Type,Alarm_TR,Alarm_Fuse_Positive,Alarm_Fuse_Negative, Alarm_Fuse_UREF, Alarm_UMAX, Alarm_IMAX, Alarm_UREF,Alarm_GPS, RSSI, BER FROM `UPR_Status` WHERE Serial_Number='$Serial_Number_Aveiro' ORDER BY Input DESC LIMIT 1";
 $queryAveiroTrafego = "SELECT SUM(TRAFFIC) AS valor FROM `UPR_Status` WHERE Serial_Number='$Serial_Number_Aveiro' AND Month='$month' AND Year='$year'";
  $queryAveiroTrafegoTotal = "SELECT MB_MAX,sim_card_number FROM `ProCat_ID` WHERE Serial_Number='$Serial_Number_Aveiro'";
  $resultAveiro3 = mysqli_query($con,$queryAveiroTrafegoTotal) or die(mysqli_error($con));
  $resultAveiro2 = mysqli_query($con,$queryAveiroTrafego) or die(mysqli_error($con));
  $resultAveiro = mysqli_query($con,$queryAveiro) or die(mysqli_error($con));
  $rowAveiro = mysqli_fetch_assoc($resultAveiro);
  $rowAveiro2 = mysqli_fetch_assoc($resultAveiro2);
  $rowAveiro3 = mysqli_fetch_assoc($resultAveiro3);

  //Consumo
  $trafegoAveiro = number_format(($rowAveiro2['valor']/1048576), 2, '.', '');
  $trafegoTotal = $rowAveiro3['MB_MAX'];
  $telefone = $rowAveiro3['sim_card_number'];
  $registo = $rowAveiro['Time_Stamp'];
  $percentagemRoda = (100*$trafegoAveiro)/$trafegoTotal;

  //dados
  $pipeAveiro = $rowAveiro['System'];
  $commandAveiro =  $rowAveiro['Command_Mode'];
  $operationModeAveiro =  $rowAveiro['Operation_Mode'];
  $operationTypeAveiro =  $rowAveiro['Operation_Type'];
  $umaxAveiro = $rowAveiro['UMAX_Config']/1000;
  $imaxAveiro = $rowAveiro['IMAX_Config']/1000;
  $urefAveiro = $rowAveiro['UREF_Config']/1000;
  $uoutAveiro = number_format(($rowAveiro['VOUT_Measure']/1000), 2, '.', '');
  $ioutAveiroMeasure = number_format(($rowAveiro['IOUT_Measure']/1000), 2, '.', '');
  $urefOnAveiroMeasure = number_format(($rowAveiro['UREF_ON_Measure']/1000), 2, '.', '');
  $urefOffAveiroMeasure = number_format(($rowAveiro['UREF_OFF_Measure']/1000), 2, '.', '');
  $sinal = $rowAveiro['RSSI'];
  $ber = $rowAveiro['BER'];

  //Alarmes
  $alarmTrAveiro = $rowAveiro['Alarm_TR'];
  $alarmFusePositiveAveiro = $rowAveiro['Alarm_Fuse_Positive'];
  $alarmFuseNegativeAveiro = $rowAveiro['Alarm_Fuse_Negative'];
  $alarmFuseUrefAveiro = $rowAveiro['Alarm_Fuse_UREF'];
  $alarmUmaxAveiro = $rowAveiro['Alarm_UMAX'];
  $alarmImaxAveiro = $rowAveiro['Alarm_IMAX'];
  $alarmUrefAveiro = $rowAveiro['Alarm_UREF'];
  $alarmGPSAveiro = $rowAveiro['Alarm_GPS'];
  $urefMin = ($rowAveiro['UREF_Config']*0.75)/1000;
  $urefMax = ($rowAveiro['UREF_Config']*1.25)/1000;

  $srcOn = "imagens/on.png";
  $srcOff = "imagens/off.png";
  $srcDes = "imagens/des.png";

 if($lastHour < $registo){
    $cor='<span style="color:red;"> '.$registo.'</span>';
  }
 else{
   $cor='<span style="color:green;"> '.$registo.'</span>';
 }
echo json_encode(array("pipeAveiro" => $pipeAveiro, "commandAveiro" => $commandAveiro, "operationModeAveiro" => $operationModeAveiro, "operationTypeAveiro" => $operationTypeAveiro, "alarmTrAveiro" => $alarmTrAveiro, "alarmFusePositiveAveiro" => $alarmFusePositiveAveiro, "alarmFuseNegativeAveiro" => $alarmFuseNegativeAveiro, "alarmFuseUrefAveiro" => $alarmFuseUrefAveiro, "alarmUmaxAveiro" => $alarmUmaxAveiro, "alarmImaxAveiro" => $alarmImaxAveiro , "alarmUrefAveiro" => $alarmUrefAveiro, "alarmGPSAveiro" => $alarmGPSAveiro, "umaxAveiro" => $umaxAveiro, "imaxAveiro" => $imaxAveiro, "urefAveiro" => $urefAveiro, "urefMin" =>$urefMin, "urefMax" =>$urefMax, "trafegoAveiro" => $trafegoAveiro, "trafegoTotal" => $trafegoTotal, "telefone" =>$telefone, "ultimoRegisto" =>$cor, "percentagem" =>$percentagemRoda, "uoutAveiro" => $uoutAveiro, "ioutAveiro" =>$ioutAveiroMeasure, "urefOnAveiro" =>$urefOnAveiroMeasure, "urefOffAveiro" =>$urefOffAveiroMeasure, "sinal" =>$sinal, "ber" => $ber));
    ?>
