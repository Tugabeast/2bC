<?php 
    if(!empty($_GET['id'])){
        include ('db_connection.php');
        $id = $_GET['id'];
        $sql = "SELECT * FROM registration WHERE id = $id";

        $result = $conn->query($sql);

        if($result->num_rows > 0){
            
                $sqldelete= "DELETE FROM registration WHERE id = $id";
                $resultDelete = mysqli_query($connec,$sqldelete);

            
        }
    }
    header("Location: crud.php");
    exit();
?>