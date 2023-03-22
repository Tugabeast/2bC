<?php
    //fixo 
    //$conn = new mysqli('localhost','root','root','dashboard', 3305);
    //portatil
    $conn = new mysqli('localhost','root','porto1893','dashboard', 3306);
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);
        $email = validate($_POST['email']);
        
        $user_data = 'username=' . $username. '&email=' . $email;
        

        if(empty($username)){
            header("location: register.php?error= Username é necessario&$user_data");
            exit();
        }
        else if(empty($password)){
            header("location: register.php?error= Password é necessaria&$user_data");
            exit();
        }   
        else if(empty($email)){
            header("location: register.php?error= Email é necessario&$user_data");
            exit();
        }  
        else{
            $pass = md5($password);

            $sql = "SELECT * FROM login WHERE username= '$username' ";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result)>0) {
                header("Location: register.php?error=O username ja existe, tente outro&$user_data");
                exit();
            }
            else{
                $sql2 = "INSERT INTO login(username, password, email) VALUES('$username', '$pass', '$email')";
                $result2= mysqli_query($conn, $sql2);
                if($result2){
                    header("Location: login.php?sucess=A conta foi criada com sucesso");
                    exit();
                }else{
                    header("Location: register.php?error=Erro desconhecido&$user_data");
                    exit();
                }
            }
        }
    }
    else{
        header("location: register.php");
        exit();
    }

?>