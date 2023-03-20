<?php 
    if(!empty($_GET['id'])){
        $conn = new mysqli('localhost','root','porto1893','dashboard', 3306);
        $id = $_GET['id'];
        $sql = "SELECT * FROM registration WHERE id = $id";

        $result = $conn->query($sql);

        if($result->num_rows > 0){
            
                $sqldelete= "DELETE FROM registration WHERE id = $id";
                $resultDelete = mysqli_query($conn,$sqldelete);

            
        }
    }
    header("Location: ../php/crud.php");
    exit();
?>