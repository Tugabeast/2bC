<?php
session_start();
require('db_connection.php');


    $nome = $_SESSION['nome'];
    $Serial_Number_Povoa = "032E280C4321000002";
    $Serial_Number_Aveiro = "018E22DC44F1000003";
    $queryPovoa = "SELECT VOUT_Measure,IOUT_Measure,UREF_ON_Measure,UREF_Config,Command_Mode,System,Alarm_TR,Alarm_Fuse_Positive,Alarm_Fuse_Negative, Alarm_Fuse_UREF, Alarm_UMAX, Alarm_IMAX, Alarm_UREF,Alarm_GPS,Time_Stamp FROM `UPR_Status` WHERE Serial_Number='$Serial_Number_Povoa' ORDER BY Input DESC LIMIT 1" ;
    $queryAveiro = "SELECT VOUT_Measure,IOUT_Measure,UREF_ON_Measure,UREF_Config,Command_Mode,System,Alarm_TR,Alarm_Fuse_Positive,Alarm_Fuse_Negative, Alarm_Fuse_UREF, Alarm_UMAX, Alarm_IMAX, Alarm_UREF,Alarm_GPS,Time_Stamp FROM `UPR_Status` WHERE Serial_Number='$Serial_Number_Aveiro' ORDER BY Input DESC LIMIT 1";
    $resultPovoa = mysqli_query($con,$queryPovoa) or die(mysqli_error($con));
    $resultAveiro = mysqli_query($con,$queryAveiro) or die(mysqli_error($con));
    $rowPovoa = mysqli_fetch_assoc($resultPovoa);
    $voutPovoa = number_format(($rowPovoa['VOUT_Measure']/1000),2,'.','');
    $ioutPovoa = number_format(($rowPovoa['IOUT_Measure'] /1000),2,'.','');
    $urefPovoa = number_format(($rowPovoa['UREF_ON_Measure']/1000)*-1,2,'.','');
    $setPointPovoa = number_format(($rowPovoa['UREF_Config']/1000)*-1,2,'.','');
    $operationPovoa =  $rowPovoa['Command_Mode'];
    $pipePovoa = $rowPovoa['System'];
    $alarmTrPovoa = $rowPovoa['Alarm_TR'];
    $alarmFusePositivePovoa = $rowPovoa['Alarm_Fuse_Positive'];
    $alarmFuseNegativePovoa = $rowPovoa['Alarm_Fuse_Negative'];
    $alarmFuseUrefPovoa = $rowPovoa['Alarm_Fuse_UREF'];
    $alarmUmaxPovoa = $rowPovoa['Alarm_UMAX'];
    $alarmImaxPovoa = $rowPovoa['Alarm_IMAX'];
    $alarmUrefPovoa = $rowPovoa['Alarm_UREF'];
    $alarmGPSPovoa = $rowPovoa['Alarm_GPS'];
    $rowAveiro = mysqli_fetch_assoc($resultAveiro);
    $voutAveiro = number_format(($rowAveiro['VOUT_Measure']/1000),2,'.','');
    $ioutAveiro = number_format(($rowAveiro['IOUT_Measure'] /1000),2,'.','');
    $urefAveiro = number_format(($rowAveiro['UREF_ON_Measure']/1000)*-1,2,'.','');
    $setPointAveiro = number_format(($rowAveiro['UREF_Config']/1000)*-1,2,'.','');
    $operationAveiro =  $rowAveiro['Command_Mode'];
    $pipeAveiro = $rowAveiro['System'];
    $alarmTrAveiro = $rowAveiro['Alarm_TR'];
    $alarmFusePositiveAveiro = $rowAveiro['Alarm_Fuse_Positive'];
    $alarmFuseNegativeAveiro = $rowAveiro['Alarm_Fuse_Negative'];
    $alarmFuseUrefAveiro = $rowAveiro['Alarm_Fuse_UREF'];
    $alarmUmaxAveiro = $rowAveiro['Alarm_UMAX'];
    $alarmImaxAveiro = $rowAveiro['Alarm_IMAX'];
    $alarmUrefAveiro = $rowAveiro['Alarm_UREF'];
    $alarmGPSAveiro = $rowAveiro['Alarm_GPS'];
    $srcOn = "imagens/on.png";
    $srcOff = "imagens/off.png";
    $srcDes = "imagens/des.png";
    $srcAmarelo = "imagens/amarelo.png";
    $dataAveiro = $rowAveiro['Time_Stamp'];
    $dataPovoa = $rowPovoa['Time_Stamp'];

    if($alarmTrPovoa != 0 || $alarmFusePositivePovoa != 0 || $alarmFuseNegativePovoa !=0 || $alarmFuseUrefPovoa !=0 || $alarmUmaxPovoa !=0 || $alarmImaxPovoa !=0 || $alarmUrefPovoa != 0 || $alarmGPSPovoa !=0 ){
      $alarmesPovoa = 1;
    }
    else{
      $alarmesPovoa = 0;
    }
    if($alarmTrAveiro != 0 || $alarmFusePositiveAveiro != 0 || $alarmFuseNegativeAveiro !=0 || $alarmFuseUrefAveiro !=0 || $alarmUmaxAveiro !=0 || $alarmImaxAveiro !=0 || $alarmUrefAveiro != 0 || $alarmGPSAveiro !=0 ){
      $alarmesAveiro = 1;
    }
    else{
      $alarmesAveiro = 0;
    }

    echo json_encode(array("voutPovoa" => $voutPovoa, "urefPovoa" => $urefPovoa, "ioutPovoa" => $ioutPovoa, "setPointPovoa" => $setPointPovoa, "operationPovoa" => $operationPovoa, "alarmesPovoa" =>$alarmesPovoa,"pipePovoa" => $pipePovoa, "voutAveiro" => $voutAveiro, "urefAveiro" => $urefAveiro, "ioutAveiro" => $ioutAveiro, "setPointAveiro" => $setPointAveiro, "operationAveiro" => $operationAveiro, "alarmesAveiro" => $alarmesAveiro, "pipeAveiro" => $pipeAveiro, "dataAveiro" => $dataAveiro, "dataPovoa" => $dataPovoa ));
    ?>
