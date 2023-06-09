<?php


include('db_connection.php');

// Atualizar os registros na base de dados
$sql = "UPDATE `mp_registered_cards` SET `mp` = 0, `worker_mp` = 1";
$result = mysqli_query($connect, $sql);

if ($result) {
    echo 'Success';
} else {
    echo 'Error';
}

mysqli_close($connect);
?>