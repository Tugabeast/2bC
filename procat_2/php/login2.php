<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard-Login</title>
        <link rel="stylesheet" href="../css/login2.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php /*
        include('db_connection.php');

session_start();


// verifica se foi feito um submit do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos estão preenchidos corretamente
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (validate_login($username, $password, $con)) {
        try_login($username, $password, $con);
    }
}

function try_login($username, $password, $con) {
    //protege de sqli injection
    $username = $con->real_escape_string($username);

    //vai á base de dados validar a correspondência de dados
    $sql_code = "SELECT * FROM procat_users WHERE User = '$username' LIMIT 1";
    $sql_result = $con->query($sql_code) or die("Falha na execução do código SQL: " . $con->error);

    $user = $sql_result->fetch_assoc();
     //se os dados forem encontrados na base de dados inicia a sessão e redireciona para a pagina principal
    if ($user) {
        if (password_verify($password, $user)) {
            $_SESSION['nome'] = $user['name'];
            $_SESSION['usertype'] = $user['UserType'];
            if($user['UserType'] == 'Administrator') {
                header("Location: index.php");
            } else {
                header("Location: index.php");
            }
        }
    } else {
        echo "Falha ao logar! Username ou senha incorretos";
    }
}

function validate_login($username, $password) {
    if (isset($username) || isset($password)) {
        // valida o email

        if (!filter_var($username)) {
            echo "Preencha o seu username";

            return false;
        }

        // valida a password
        if (strlen($password) == 0) {
            echo "Preencha a sua password";

            return false;
        }
    }

    return true;
}   */


session_start();
//require('db_connection.php');//ligacao BD
//echo "O seu login está a ser verificado. Por favor aguarde...";
if (isset($_POST['username']) && isset($_POST['password'])){
        // removes backslashes
	$username = stripslashes($_POST['username']);
        //escapes special characters in a string
	$usernameEscapado = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_POST['password']);
	$passwordEscapado = mysqli_real_escape_string($con,$password);
	//Encriptacao PW


  $query = "SELECT Password,name FROM `ProCat_Users` WHERE User='$usernameEscapado'";

	$result = mysqli_query($con,$query) or die(mysqli_error($con));
	$row = mysqli_fetch_assoc($result);
	$hash = $row['Password'];
		//if(hash_equals($row['Password'], crypt($passwordEscapado, $row['Password']))){
if(password_verify($passwordEscapado, $hash ) == true){
	    			$_SESSION['logged'] = true;
            $_SESSION['nome'] = $row['name'];
						$nome = $row['name'];
						$_SESSION['Serial_Number_Povoa'] = "032E280C4321000002";
						$_SESSION['Serial_Number_Aveiro'] = "018E22DC44F1000003";
						if($nome == "2BC"){
								//nao lista o 2bc
								echo "<META HTTP-EQUIV=\"refresh\" content=\"2; URL=index.php\"> ";
						}else{
						$query2 = "INSERT INTO `ProCat_Access` (Time_Stamp,User) VALUES (CURRENT_TIMESTAMP,'$nome')";

						$result2 = mysqli_query($con,$query2) or die(mysqli_error($con));
					//	$row2 = mysqli_fetch_assoc($result2);
            $row2 = $result2;

            // Se login for valido rencaminha para monotorizacao

			echo "<META HTTP-EQUIV=\"refresh\" content=\"2; URL=index.php\"> ";
		 }
}

		 else{
                     // Se login errado rencaminha para o index com a mensagem de erro
             $_SESSION["erro"] = "Os valores introduzidos no login estão incorretos. Por favor tente novamente!";

	echo "<META HTTP-EQUIV=\"refresh\" content=\"2; URL=login.php\"> ";

	}
}

 ?>
    </head>
    <body >

    <div class="container">
    <div class="title">
      <h2>Indústria 4.0 - Cires Plataforma IoT Procat</h2>
    </div>
    <div class="form-container">
			<form action="login.php" method="post">
            <!--<h2>Indústria 4.0 - Cires Plataforma IoT Procat<!--<i class="fa-solid fa-location-dot fa-bounce"></i>--> </h2>
            <?php /* if(isset($_GET['error'])) {?>
                <p class="error"><?php echo $_GET['error']; ?> </p>
                <?php } ?>

                <?php if(isset($_GET['sucess'])) {?>
                <p class="sucess"><?php echo $_GET['sucess']; ?> </p>
            <?php } */ ?>
            <i class="fa-sharp fa-solid fa-envelope"></i>
            <label>User</label>
            <input type="text" name="username" placeholder="username">
            <br>
            <i class="fa-sharp fa-solid fa-lock"></i>
            <label>Password</label>
            <input type="password" name="password" placeholder="password">
            <br>
            <button type="submit">Login</button>
        </form>
		</div>
	</div>

    </body>
</html>