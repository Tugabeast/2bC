<?php
    $conn = new mysqli('localhost','root','porto1893','dashboard', 3306);
    if (isset($_POST['username']) && isset($_POST['email']) ){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $username = validate($_POST['username']);
        $email = validate($_POST['email']);
        $sql = "SELECT * FROM login WHERE username = '$username' AND email = '$email' ";
        $getdata= mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($getdata);
        //https://www.youtube.com/watch?v=27QUxWZ_l8Q&ab_channel=ShubhraSingh
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard-Settings</title>
        <link rel="stylesheet" href="../css/login.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <body>
        <form action="#" method="POST">
            <h2>SETTINGS CONTA</h2>
            <span id="user-profile" class="material-symbols-sharp">account_circle</span>
            <label >Username</label>
            <!--<input type="text" placeholder="username" name="username" value="<?php echo $row['username'] ?>">-->
            <input type="text" placeholder="username" name="username" value="">
            <br>
            <label >Email</label>
            <input type="email" placeholder="email" name="email">
            <br>
            <a href="forms.php" class="text-muted">Cancelar</a>
            <button type="submit">Guardar</button>
        </form>
    </body>
</html>