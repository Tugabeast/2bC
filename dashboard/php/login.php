<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard-Login</title>
        <link rel="stylesheet" href="../css/login.css">
        <?php 
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
}    ?>
    </head>
    <body >
        
        <form action="#" method="post">
            <h2>LOGIN</h2>
            <?php /* if(isset($_GET['error'])) {?>
                <p class="error"><?php echo $_GET['error']; ?> </p>
                <?php } ?>

                <?php if(isset($_GET['sucess'])) {?>
                <p class="sucess"><?php echo $_GET['sucess']; ?> </p>
            <?php } */ ?>
            <label>Email</label>
            <input type="email" name="email" placeholder="email">
            <br>
            <label>Password</label>
            <input type="password" name="password" placeholder="password">
            <br>
            <a href="register.php" class="text-muted">Criar conta</a>
            <button type="submit">Login</button>
        </form>
 
    </body>
</html>