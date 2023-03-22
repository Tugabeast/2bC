<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard-signup</title>
        <link rel="stylesheet" href="../css/login.css">
    </head>
    <body>
        <form action="registoscript.php" method="post">
            <h2>CRIAR CONTA</h2>
            <?php if(isset($_GET['error'])) {?>
                <p class="error"><?php echo $_GET['error']; ?> </p>
            <?php } ?>

            <?php if(isset($_GET['sucess'])) {?>
                <p class="sucess"><?php echo $_GET['sucess']; ?> </p>
            <?php } ?>

            <label>Username</label>
            <?php if(isset($_GET['username'])) {?>
                <input type="text" 
                       name="username" 
                       placeholder="username" 
                       value="<?php echo $_GET['username']; ?>"><br>
            <?php }else{ ?>
                <input type="username" 
                       name="username" 
                       placeholder="username"><br>
            <?php } ?>

            <label>Email</label>
            <?php if(isset($_GET['email'])) {?>
                <input type="email" 
                       name="email" 
                       placeholder="email" 
                       value="<?php echo $_GET['email']; ?>"><br>
            <?php }else{ ?>
                <input type="email" 
                       name="email" 
                       placeholder="email"><br>
            <?php } ?>
            
            <label>Password</label>
            <input type="password" name="password" placeholder="password">
            <br>
            <a href="login.php" class="text-muted">Ja tem conta?</a>
            <button type="submit">Sign Up</button>
        </form>
    </body>
</html>