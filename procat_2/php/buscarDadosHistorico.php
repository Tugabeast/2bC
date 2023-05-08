<?php
header('Access-Control-Allow-Origin: *');
require('db_connection.php');

$dataFinal = date('Y/m/d', strtotime('+1 days'));  // data final dia de hoje +1 dia
$dataInicial = date('Y/m/d', strtotime('-30 days'));// data inicial dia de hoje -30 dias ou seja ultimo mes
$Serial_Number_Povoa = "032E280C4321000002";
$Serial_Number_Aveiro = "018E22DC44F1000003";

 $valor = $_GET['valor'];
 $serial = $_GET['local'];

if($serial=='povoa'){
	$query ="SELECT Time_Stamp,`$valor`,VOUT_Measure,IOUT_Measure,UREF_ON_Measure FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND `$valor`=1 ";

		$result = mysqli_query($con, $query) or die(mysqli_error($con));

		$data = array();
		$alarme = array();
    $adic = array();

		if($valor == 'Alarm_GPS'){
			while( $row = mysqli_fetch_assoc($result) ) {

			$data[] = $row['Time_Stamp'];
			$alarme[] = "GPS";
      $adic[] = "Falha";

		}

		}
			else if($valor =='Alarm_UREF'){
				while( $row = mysqli_fetch_assoc($result) ) {

			$data[] = $row['Time_Stamp'];
			$alarme[] = "UREF";
      $adic[] = number_format(($row['UREF_ON_Measure']/1000), 2, '.', ''). " V";

		}
			}

			else if($valor =='Alarm_IMAX'){
				while( $row = mysqli_fetch_assoc($result) ) {

			$data[] = $row['Time_Stamp'];
			$alarme[] = "IMAX";
      $adic[] = number_format(($row['IOUT_Measure']/1000),2,'.','')." A";

		}
			}
			else if($valor =='Alarm_UMAX'){
				while( $row = mysqli_fetch_assoc($result) ) {

			$data[] = $row['Time_Stamp'];
			$alarme[] = "UMAX";
      $adic[] = number_format(($row['VOUT_Measure']/1000), 2,'.',''). " V";

		}
			}
			else if($valor =='Alarm_Fuse_Positive'){
				while( $row = mysqli_fetch_assoc($result) ) {

			$data[] = $row['Time_Stamp'];
			$alarme[] = "Fuse +";
      $adic[] = "Falha";

		}
			}
			else if($valor =='Alarm_Fuse_Negative'){
				while( $row = mysqli_fetch_assoc($result) ) {

			$data[] = $row['Time_Stamp'];
			$alarme[] = "Fuse -";
      $adic[] = "Falha";

		}
			}
			else if($valor =='Alarm_TR'){
				while( $row = mysqli_fetch_assoc($result) ) {

			$data[] = $row['Time_Stamp'];
			$alarme[] = "TR";
      $adic[] = "Falha";

		}
			}

}

 else if($serial=='aveiro'){
	$query ="SELECT Time_Stamp,`$valor`,VOUT_Measure,IOUT_Measure,UREF_ON_Measure FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND `$valor`=1 ";

		$result = mysqli_query($con, $query) or die(mysqli_error($con));

		$data = array();
		$alarme = array();
    $adic = array();

		if($valor == 'Alarm_GPS'){
			while( $row = mysqli_fetch_assoc($result) ) {

			$data[] = $row['Time_Stamp'];
			$alarme[] = "GPS";
      $adic[] = "Falha";

		}

		}
			else if($valor =='Alarm_UREF'){
				while( $row = mysqli_fetch_assoc($result) ) {

			$data[] = $row['Time_Stamp'];
			$alarme[] = "UREF";
      $adic[] = number_format(($row['UREF_ON_Measure']/1000),2,'.',''). " V";

		}
			}

			else if($valor =='Alarm_IMAX'){
				while( $row = mysqli_fetch_assoc($result) ) {

			$data[] = $row['Time_Stamp'];
			$alarme[] = "IMAX";
      $adic[] = number_format(($row['IOUT_Measure']/1000),2,'.',''). " A";

		}
			}
			else if($valor =='Alarm_UMAX'){
				while( $row = mysqli_fetch_assoc($result) ) {

			$data[] = $row['Time_Stamp'];
			$alarme[] = "UMAX";
      $adic[] = number_format(($row['VOUT_Measure']/1000),2,'.',''). " V";

		}
			}
			else if($valor =='Alarm_Fuse_Positive'){
				while( $row = mysqli_fetch_assoc($result) ) {

			$data[] = $row['Time_Stamp'];
			$alarme[] = "Fuse +";
      $adic[] = "Falha";

		}
			}
			else if($valor =='Alarm_Fuse_Negative'){
				while( $row = mysqli_fetch_assoc($result) ) {

			$data[] = $row['Time_Stamp'];
			$alarme[] = "Fuse -";
      $adic[] = "Falha";

		}
			}
			else if($valor =='Alarm_TR'){
				while( $row = mysqli_fetch_assoc($result) ) {

			$data[] = $row['Time_Stamp'];
			$alarme[] = "TR";
      $adic[] = "Falha";

		}
			}

}




echo json_encode(array("data" => $data, "alarme" => $alarme, "adic" =>$adic));
?>
