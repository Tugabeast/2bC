

<?php
/*
    //fixo 
    //$conn = new mysqli('localhost','root','root','dashboard', 3305);
    //portatil
    $connect = new mysqli('localhost','root','porto1893','dashboard', 3306);
    //include('db_connection.php');
    
    //session_start();

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
            header("location: login.php?error= Username é necessario");
            exit();
        }
        else if(empty($password)){
            header("location: login.php?error= Password é necessaria");
            exit();
        }   
        else{
            $pass = md5($password);

            $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password' ";
            $result = mysqli_query($connect, $sql);

            if(mysqli_num_rows($result) ===1){
                $row = mysqli_fetch_assoc($result);
                if($row['username'] === $username && $row['password'] === $password){
                    header("location: index.php");
                }
                else{
                    header("location: login.php?error= Username ou Password incorreto/a");
                    exit();
                }
            }
            else{
                header("location: login.php?error= Username ou Password incorreto/a");
                exit();
            }
        }
    }
    else{
        header("location: login.php");
        exit();
    }
    
 */
include('db_connection.php');

session_start();


// verifica se foi feito um submit do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos estão preenchidos corretamente
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (validate_login($email, $password, $connect)) {
        try_login($email, $password, $connect);
    }
}

function try_login($email, $password, $connect) {
    //protege de sqli injection
    $email = $connect->real_escape_string($email);

    //vai á base de dados validar a correspondência de dados
    $sql_code = "SELECT * FROM users WHERE Email = '$email' LIMIT 1";
    $sql_result = $connect->query($sql_code) or die("Falha na execução do código SQL: " . $connect->error);

    $user = $sql_result->fetch_assoc();
     //se os dados forem encontrados na base de dados inicia a sessão e redireciona para a pagina principal
    if ($user) {   
        if (password_verify($password, $user['Password_hash'])) {
            $_SESSION['nome'] = $user['Name'];
            $_SESSION['usertype'] = $user['UserType'];
            if($user['UserType'] == 'Administrator') {
                header("Location: index.php");
            } else {
                header("Location: index.php");
            }
        }
    } else {
        echo "Falha ao logar! E-mail ou senha incorretos";
    }
}

function validate_login($email, $password) {
    if (isset($email) || isset($password)) {
        // valida o email
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Preencha o seu e-mail";

            return false;
        }

        // valida a password
        if (strlen($password) == 0) {
            echo "Preencha a sua password";

            return false;
        }
    }

    return true;
}   
?>
