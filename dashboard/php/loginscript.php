<?php
    //fixo 
    //$conn = new mysqli('localhost','root','root','dashboard', 3305);
    //portatil
    $conn = new mysqli('localhost','root','porto1893','dashboard', 3306);
    if (isset($_POST['username']) && isset($_POST['password']) ) {
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);

        if(empty($username)){
            header("location: ../php/login.php?error= Username é necessario");
            exit();
        }
        else if(empty($password)){
            header("location: ../php/login.php?error= Password é necessaria");
            exit();
        }   
        else{
            $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password' ";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) ===1){
                $row = mysqli_fetch_assoc($result);
                if($row['username'] === $username && $row['password'] === $password){
                    header("Location: ../html/index.html");
                }
                else{
                    header("location: ../php/login.php?error= Username ou Password incorreto/a");
                    exit();
                }
            }
            else{
                header("location: ../php/login.php?error= Username ou Password incorreto/a");
                exit();
            }
        }
    }
    else{
        header("location: ../php/login.php");
        exit();
    }

?>