<?php

    include ('db_connection.php');

    if(isset($_POST['butaosubmit'])){
        $datas = $_POST['data'];
        $allData= implode($datas);

        $sqlinsertMP = "INSERT INTO mp_operation (`MP_ID`, `name`) VALUES ('$MP_ID', '$name')";
        


    }

?>