<?php

    include ('db_connection.php');

    if(isset($_POST['adicionarMP'])){
        $MP_ID = $_POST['MP_ID'];
        $name = $_POST['name'];

        $sqlinsertMP = "INSERT INTO meeting_point (`MP_ID`, `name`) VALUES ('$MP_ID', '$name')";

        $data = mysqli_query($connect,$sqlinsertMP);

        if($data){
            echo "MP adicionado com sucesso";
            header("location: settings.php");
        }
        else{
            echo "MP nao foi adicionado";
        }


    }

?>