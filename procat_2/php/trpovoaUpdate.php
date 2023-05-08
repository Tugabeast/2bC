<?php
header('Access-Control-Allow-Origin: *');
require('db_connection.php');


  $Serial_Number_Povoa = "032E280C4321000002";
  $date = date('Y-m-d H:i:s');
  $month = date("n",strtotime($date));
  $year = date("o",strtotime($date));
  $lastHour =  date('Y-m-d H:i:s', strtotime('1 hour'));
  $queryPovoa = "SELECT VOUT_Measure,IOUT_Measure,UREF_ON_Measure,UREF_ON_Measure,UREF_OFF_Measure,Time_Stamp,UMAX_Config, IMAX_Config,UREF_Config,System,Command_Mode,Operation_Mode,Operation_Type,Alarm_TR,Alarm_Fuse_Positive,Alarm_Fuse_Negative, Alarm_Fuse_UREF, Alarm_UMAX, Alarm_IMAX, Alarm_UREF,Alarm_GPS, RSSI, BER  FROM `UPR_Status` WHERE Serial_Number='$Serial_Number_Povoa' ORDER BY Input DESC LIMIT 1";
  $queryPovoaTrafego = "SELECT SUM(TRAFFIC) AS valor FROM `UPR_Status` WHERE Serial_Number='$Serial_Number_Povoa' AND Month='$month' AND Year='$year'";
  $queryPovoaTrafegoTotal = "SELECT MB_MAX,sim_card_number FROM `ProCat_ID` WHERE Serial_Number='$Serial_Number_Povoa'";
  $resultPovoa3 = mysqli_query($con,$queryPovoaTrafegoTotal) or die(mysqli_error($con));
  $resultPovoa2 = mysqli_query($con,$queryPovoaTrafego) or die(mysqli_error($con));
  $resultPovoa = mysqli_query($con,$queryPovoa) or die(mysqli_error($con));
  $rowPovoa = mysqli_fetch_assoc($resultPovoa);
  $rowPovoa2 = mysqli_fetch_assoc($resultPovoa2);
  $rowPovoa3 = mysqli_fetch_assoc($resultPovoa3);

  //Consumo
  $trafegoPovoa = number_format(($rowPovoa2['valor']/1048576), 2, '.', '');
  $trafegoTotal = $rowPovoa3['MB_MAX'];
  $telefone = $rowPovoa3['sim_card_number'];
  $registo = $rowPovoa['Time_Stamp'];
  $percentagemRoda = (100*$trafegoPovoa)/$trafegoTotal;

  //dados
  $pipePovoa = $rowPovoa['System'];
  $commandPovoa =  $rowPovoa['Command_Mode'];
  $operationModePovoa =  $rowPovoa['Operation_Mode'];
  $operationTypePovoa =  $rowPovoa['Operation_Type'];
  $umaxPovoa = $rowPovoa['UMAX_Config']/1000;
  $imaxPovoa = $rowPovoa['IMAX_Config']/1000;
  $urefPovoa = $rowPovoa['UREF_Config']/1000;
  $sinal = $rowPovoa['RSSI'];
  $ber = $rowPovoa['BER'];
  $uoutPovoa = number_format(($rowPovoa['VOUT_Measure']/1000), 2, '.', '');
  $ioutPovoaMeasure = number_format(($rowPovoa['IOUT_Measure']/1000), 2, '.', '');
  $urefOnPovoaMeasure = number_format(($rowPovoa['UREF_ON_Measure']/1000), 2, '.', '');
  $urefOffPovoaMeasure = number_format(($rowPovoa['UREF_OFF_Measure']/1000), 2, '.', '');

  //Alarmes
  $alarmTrPovoa = $rowPovoa['Alarm_TR'];
  $alarmFusePositivePovoa = $rowPovoa['Alarm_Fuse_Positive'];
  $alarmFuseNegativePovoa = $rowPovoa['Alarm_Fuse_Negative'];
  $alarmFuseUrefPovoa = $rowPovoa['Alarm_Fuse_UREF'];
  $alarmUmaxPovoa = $rowPovoa['Alarm_UMAX'];
  $alarmImaxPovoa = $rowPovoa['Alarm_IMAX'];
  $alarmUrefPovoa = $rowPovoa['Alarm_UREF'];
  $alarmGPSPovoa = $rowPovoa['Alarm_GPS'];
  $urefMin = ($rowPovoa['UREF_Config']*0.75)/1000;
  $urefMax = ($rowPovoa['UREF_Config']*1.25)/1000;

  $srcOn = "imagens/on.png";
  $srcOff = "imagens/off.png";
  $srcDes = "imagens/des.png";

  if($lastHour < $registo){
    $cor='<span style="color:red;"> '.$registo.'</span>';
  }
 else{
   $cor='<span style="color:green;"> '.$registo.'</span>';
 }
echo json_encode(array("pipePovoa" => $pipePovoa, "commandPovoa" => $commandPovoa, "operationModePovoa" => $operationModePovoa, "operationTypePovoa" => $operationTypePovoa, "alarmTrPovoa" => $alarmTrPovoa, "alarmFusePositivePovoa" => $alarmFusePositivePovoa, "alarmFuseNegativePovoa" => $alarmFuseNegativePovoa, "alarmFuseUrefPovoa" => $alarmFuseUrefPovoa, "alarmUmaxPovoa" => $alarmUmaxPovoa, "alarmImaxPovoa" => $alarmImaxPovoa , "alarmUrefPovoa" => $alarmUrefPovoa, "alarmGPSPovoa" => $alarmGPSPovoa, "umaxPovoa" => $umaxPovoa, "imaxPovoa" => $imaxPovoa, "urefPovoa" => $urefPovoa, "urefMin" =>$urefMin, "urefMax" =>$urefMax, "trafegoPovoa" => $trafegoPovoa, "trafegoTotal" => $trafegoTotal, "telefone" =>$telefone, "ultimoRegisto" =>$cor, "percentagem" =>$percentagemRoda, "uoutPovoa" => $uoutPovoa, "ioutPovoa" =>$ioutPovoaMeasure, "urefOnPovoa" =>$urefOnPovoaMeasure, "urefOffPovoa" =>$urefOffPovoaMeasure, "sinal" =>$sinal, "ber" => $ber));
    ?>
