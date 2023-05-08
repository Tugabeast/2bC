<?php
header('Access-Control-Allow-Origin: *');
require('db_connection.php');
$dataFinal = date('Y/m/d', strtotime('+1 days'));  // data final dia de hoje +1 dia
$dataInicial = date('Y/m/d', strtotime('-30 days'));// data inicial dia de hoje -30 dias ou seja ultimo mes
$Serial_Number_Povoa = "032E280C4321000002";
$Serial_Number_Aveiro = "018E22DC44F1000003";



//querys Povoa
$queryAlarmFuseUrefPovoa = "SELECT Time_Stamp as data, Alarm_Fuse_UREF as alarme FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_Fuse_UREF=1 ";
$queryAlarmTRPovoa = "SELECT Time_Stamp, Alarm_TR FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_TR=1 ";
$queryAlarmFusePositivePovoa = "SELECT Time_Stamp, Alarm_Fuse_Positive FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_Fuse_Positive=1 ";
$queryAlarmFuseNegativePovoa = "SELECT Time_Stamp, Alarm_Fuse_Negative FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_Fuse_Negative=1 ";
$queryAlarmUMAXPovoa = "SELECT Time_Stamp, Alarm_UMAX FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_UMAX=1 ";
$queryAlarmIMAXPovoa = "SELECT Time_Stamp, Alarm_IMAX FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_IMAX=1 ";
$queryAlarmUREFPovoa = "SELECT Time_Stamp as data, Alarm_UREF as alarme FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_UREF=1 ";
$queryAlarmGPSPovoa = "SELECT Time_Stamp, Alarm_GPS FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_GPS=1 ";
//execute queries Povoa
$resultAlarmFuseUrefPovoa = mysqli_query($con, $queryAlarmFuseUrefPovoa ) or die(mysqli_error($con));
$resultAlarmTRPovoa = mysqli_query($con, $queryAlarmTRPovoa ) or die(mysqli_error($con));
$resultAlarmFusePositivePovoa = mysqli_query($con, $queryAlarmFusePositivePovoa ) or die(mysqli_error($con));
$resultAlarmFuseNegativePovoa = mysqli_query($con, $queryAlarmFuseNegativePovoa ) or die(mysqli_error($con));
$resultAlarmUMAXPovoa = mysqli_query($con, $queryAlarmUMAXPovoa ) or die(mysqli_error($con));
$resultAlarmIMAXPovoa = mysqli_query($con, $queryAlarmIMAXPovoa ) or die(mysqli_error($con));
$resultAlarmUREFPovoa = mysqli_query($con, $queryAlarmUREFPovoa ) or die(mysqli_error($con));
$resultAlarmGPSPovoa = mysqli_query($con, $queryAlarmGPSPovoa ) or die(mysqli_error($con));




$data = array();


while( $rows = mysqli_fetch_assoc($resultAlarmFuseUrefPovoa) ) {

$data[] = $rows;

}
foreach($data as $key => $subarray) {
      $data[$key]['alarme'] = 'Fuse Uref';
      $data[$key]['adic'] = 'Falha';
      }

$results = array(
"sEcho" => 1,
"iTotalRecords" => count($data),
"iTotalDisplayRecords" => count($data),
"aaData" => $data,

);
echo json_encode($results);
?>
