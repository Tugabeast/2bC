<?php
include('db_connection.php');

$response = array();

// Obter o número total de trabalhadores registados
$sqlTotalWorkers = "SELECT COUNT(*) AS totalWorkers FROM mp_registered_cards";
$resultTotalWorkers = mysqli_query($connect, $sqlTotalWorkers);
$rowTotalWorkers = mysqli_fetch_assoc($resultTotalWorkers);
$totalWorkers = $rowTotalWorkers['totalWorkers'];

// Obter o número de trabalhadores registados
$sqlRegisteredWorkers = "SELECT COUNT(*) AS registeredWorkers FROM mp_registered_cards WHERE mp != 0";
$resultRegisteredWorkers = mysqli_query($connect, $sqlRegisteredWorkers);
$rowRegisteredWorkers = mysqli_fetch_assoc($resultRegisteredWorkers);
$registeredWorkers = $rowRegisteredWorkers['registeredWorkers'];

$response['totalWorkers'] = $totalWorkers;
$response['registeredWorkers'] = $registeredWorkers;

header('Content-Type: application/json');
echo json_encode($response);
?>