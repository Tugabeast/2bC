<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard-Login</title>
        <link rel="stylesheet" href="../css/login.css">
    </head>
    <body>
        <form action="../php/loginscript.php" method="post">
            <h2>Login</h2>
            <?php if(isset($_GET['error'])) {?>
                <p class="error"><?php echo $_GET['error']; ?> </p>
                <?php } ?>
            <label>Username</label>
            <input type="text" name="username" placeholder="username">
            <br>
            <label>Password</label>
            <input type="password" name="password" placeholder="password">
            <br>
            <button type="submit">Login</button>
        </form>
    </body>
</html>