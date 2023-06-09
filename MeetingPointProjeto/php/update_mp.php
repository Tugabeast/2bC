<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $workerName = $_POST['workerName'];
    $newMpValue = $_POST['newMpValue'];

    if ($newMpValue >= 3 && $newMpValue <= 7) {
        // Update the mp_registered_cards table with the new value
        $sql = "UPDATE mp_registered_cards SET mp = '$newMpValue', worker_mp = '2' WHERE worker_name = '$workerName'";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            echo "Success";
        } else {
            echo "Error";
        }
    } else {
        echo "Invalid MP value";
    }
}
?>
