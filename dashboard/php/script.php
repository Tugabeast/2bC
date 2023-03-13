<?php 

//script portatil

$username = $_POST['username'];
$password = $_POST['password'];

$conn = new mysqli('localhost','root','porto1893','dashboard',3306);
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

//script fixo
/*
$username = $_POST['username'];
$password = $_POST['password'];

$conn = new mysqli('localhost','root','root','dashboard', 3305);
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

header('Location: ../html/forms.html');
exit();
*/
?>