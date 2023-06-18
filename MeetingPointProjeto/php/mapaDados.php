<?php
 
include ('db_connection.php');

// Obter o número de registros a serem exibidos de cada vez
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 100;

// Obter o intervalo de tempo entre cada exibição (em milissegundos)
$interval = isset($_GET['interval']) ? intval($_GET['interval']) : 5000;

// Executar a consulta SQL
$sql = "SELECT `ep_wind_sensor`.`direction`, `ep_wind_sensor`.`velocity`
        FROM `ep_wind_sensor`
        ORDER BY `ep_wind_sensor`.`datatime` DESC
        LIMIT $limit";
$result = $connect->query($sql);

// Converter os resultados em um array associativo
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Enviar os dados como JSON
echo json_encode(array('data' => $data, 'interval' => $interval));


?>