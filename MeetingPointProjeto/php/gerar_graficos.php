<?php
include('db_connection.php');

// 2. Obtenha os valores da coluna "temperature" da tabela "gvir_status"
$sql = "SELECT gas_concentration FROM gvir_status";
$result = $connect->query($sql);

// 3. Crie um array para armazenar os valores
$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row["gas_concentration"];
    }
}

// 4. Feche a conexão com o banco de dados
$connect->close();

// 5. Converta o array de dados em JSON
$jsonData = json_encode($data);

// 6. Salve os dados em um arquivo temporário
$file = 'gas_data.json';
file_put_contents($file, $jsonData);

// 7. Redirecione para a página graficos.php com os parâmetros de temperatura selecionados
if (isset($_GET['gas_concentration'])) {
    header("Location: graficos.php?gas_concentration=" . $_GET['gas_concentration']);
} else {
    header("Location: graficos.php");
}
exit();
?>