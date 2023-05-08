<?php
header('Access-Control-Allow-Origin: *');
require('db_connection.php');
$dataFinal = date('Y/m/d', strtotime('+1 days'));  // data final dia de hoje +1 dia
$dataInicial = date('Y/m/d', strtotime('-30 days'));// data inicial dia de hoje -30 dias ou seja ultimo mes
$Serial_Number_Povoa = "032E280C4321000002";
$Serial_Number_Aveiro = "018E22DC44F1000003";

//querys Aveiro
$queryAlarmFuseUrefAveiro = "SELECT Time_Stamp as data, Alarm_Fuse_UREF as alarme FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_Fuse_UREF=1 ";
$queryAlarmTRAveiro = "SELECT Time_Stamp, Alarm_TR FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_TR=1 ";
$queryAlarmFusePositiveAveiro = "SELECT Time_Stamp, Alarm_Fuse_Positive FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_Fuse_Positive=1 ";
$queryAlarmFuseNegativeAveiro = "SELECT Time_Stamp, Alarm_Fuse_Negative FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_Fuse_Negative=1 ";
$queryAlarmUMAXAveiro = "SELECT Time_Stamp, Alarm_UMAX FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_UMAX=1 ";
$queryAlarmIMAXAveiro = "SELECT Time_Stamp, Alarm_IMAX FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_IMAX=1 ";
$queryAlarmUREFAveiro = "SELECT Time_Stamp, Alarm_UREF FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_UREF=1 ";
$queryAlarmGPSAveiro = "SELECT Time_Stamp, Alarm_GPS FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_GPS=1 ";

//execute queries Aveiro
$resultAlarmFuseUrefAveiro = mysqli_query($con, $queryAlarmFuseUrefAveiro ) or die(mysqli_error($con));
$resultAlarmTRAveiro = mysqli_query($con, $queryAlarmTRAveiro ) or die(mysqli_error($con));
$resultAlarmFusePositiveAveiro = mysqli_query($con, $queryAlarmFusePositiveAveiro ) or die(mysqli_error($con));
$resultAlarmFuseNegativeAveiro = mysqli_query($con, $queryAlarmFuseNegativeAveiro ) or die(mysqli_error($con));
$resultAlarmUMAXAveiro = mysqli_query($con, $queryAlarmUMAXAveiro ) or die(mysqli_error($con));
$resultAlarmIMAXAveiro = mysqli_query($con, $queryAlarmIMAXAveiro ) or die(mysqli_error($con));
$resultAlarmUREFAveiro = mysqli_query($con, $queryAlarmUREFAveiro ) or die(mysqli_error($con));
$resultAlarmGPSAveiro = mysqli_query($con, $queryAlarmGPSAveiro ) or die(mysqli_error($con));




$data = array();


while( $rows = mysqli_fetch_assoc($resultAlarmFuseUrefAveiro) ) {

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
