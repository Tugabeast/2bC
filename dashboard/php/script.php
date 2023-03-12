<?php 
/*
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    if(!empty($username)){
        if(!empty($password)){
            $host = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbname = "dashboard";

            //conexao a db
            $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

            if(mysqli_connect_error()){
                die('connect error (' . mysqli_connect_errno() .')'. mysqli_connect_error());
            }
            else{
                $sql = "INSERT INTO account (username, password)
                values ('$username','$password')";
                if($conn->query($sql)){
                    echo "nova row adicionada com sucesso";
                }
                else{
                    echo "Erro" . $sql . $conn->error;
                }
            }
            $conn->close();
        }
        else{
            echo "Password nao pode tar vazia";
            die();
        }
    }
    else{
        echo " Username nao pode tar vazio";
        die();
    }
*/


$username = $_POST['username'];
$password = $_POST['password'];

$conn = new mysqli('localhost','root','porto1893','dashboard', 3306);
if($conn->connect_error){
    die('Conexao falhou: ' .$conn->connect_error);
}
else{
    $stmt = $conn->prepare("insert into registration(username, password) values(?, ?)");
    $stmt->bind_param("ss",$username,$password);
    $stmt->execute();
    echo "registo feito";
    $stmt->close();
    $conn->close();
    
}

header("location: ../html/forms.html");
exit();

?>