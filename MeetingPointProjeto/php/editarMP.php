<?php 
    include ('db_connection.php');

    if(isset($_POST['editarMP'])){
        $id = $_POST['mpedit_id'];

        $name  = $_POST['name'];

        $query = "UPDATE meeting_point SET name = '$name' WHERE id = '$id' ";
        $query_run = mysqli_query($connect, $query);

        if($query_run){
            echo "user editado com sucesso";
            header("location: settings.php");
        }
        else{
            echo "Error: " . $query . " " . mysqli_error($connect);
        }
    }

?>