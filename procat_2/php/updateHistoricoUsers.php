<?php
header('Access-Control-Allow-Origin: *');
require('db_connection.php');

$query = "SELECT Time_Stamp as data, User as nome FROM `ProCat_Access` ";

$result = mysqli_query($con, $query ) or die(mysqli_error($con));

$data = array();

while( $rows = mysqli_fetch_assoc($result) ) {

$data[] = $rows;


}

foreach($data as $key => $subarray) {
  while( $rows = mysqli_fetch_assoc($result) ) {


      $data[$key]['nome'] = $row['nome'];

      }
    }

$results = array(
"sEcho" => 1,
"iTotalRecords" => count($data),
"iTotalDisplayRecords" => count($data),
"aaData" => $data,

);
echo json_encode($results);

?>
