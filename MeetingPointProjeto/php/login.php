<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard-Login</title>
        <link rel="stylesheet" href="../css/login.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php 
        include('db_connection.php');

    session_start();


    // verifica se foi feito um submit do tipo POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se os campos estão preenchidos corretamente
        $user = $_POST['user'];
        $password = $_POST['password'];
        if (validate_login($user, $password, $connect)) {
            try_login($user, $password, $connect);
        }
    }

    function try_login($user, $password, $connect) {
        //protege de sqli injection
        //$email = $connect->real_escape_string($email);
        $user = $connect->real_escape_string($user);

        //vai á base de dados validar a correspondência de dados
        //$sql_code = "SELECT * FROM users WHERE Email = '$email' LIMIT 1";
        $sql_code = "SELECT * FROM mp_users WHERE user = '$user' LIMIT 1";
        $sql_result = $connect->query($sql_code) or die("Falha na execução do código SQL: " . $connect->error);

        $user = $sql_result->fetch_assoc();
        //se os dados forem encontrados na base de dados inicia a sessão e redireciona para a pagina principal
        if ($user) {   
            if (password_verify($password, $user['password'])) {
                $_SESSION['nome'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['email'] = $user['email'];
                if($user['role'] == 'admin') {
                    header("Location: index3.php");
                } else {
                    header("Location: index3.php");
                }
            }
        } else {
            //echo '<h4 class="error">'. "Falha ao logar! Username ou senha incorretos". '</h4>';
        }
    }

    function validate_login($user, $password) {
        if (isset($user) || isset($password)) {
            // valida o email
            
            if (!filter_var($user, FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                //echo '<h4 class="error">'. "Preencha o seu username" . '</h4>';

                return false;
            }

            // valida a password
            if (strlen($password) == 0) {
                //echo '<h4 class="error">'. "Preencha a sua password" . '</h4>';

                return false;
            }
        }

        return true;
    }    
?>

    </head>

    <body>
        <div class="container">
            <div class="title">
                <h2>Meeting Point </h2>
            </div>
            <div class="form-container">
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $user = $_POST['user'];
                        $password = $_POST['password'];

                        if (empty($user)) {
                            echo '<h4 class="error">Preencha o seu username</h4>';
                        } elseif (empty($password)) {
                            echo '<h4 class="error">Preencha a sua password</h4>';
                        } else {
                            echo '<h4 class="error">Falha ao logar! Username ou senha incorretos</h4>';
                        }
                    }
                ?>  
                <form action="#" method="post">
                    <i class="fa-sharp fa-solid fa-envelope"></i>
                    <label>Username</label>
                    <input type="text" name="user" placeholder="username">
                    <br>
                    <i class="fa-sharp fa-solid fa-lock"></i>
                    <label>Password</label>
                    <input type="password" name="password" placeholder="password">
                    <br>
                    <button type="submit" >Login</button>
                </form>
            </div>
        </div>
    </body>
</html>