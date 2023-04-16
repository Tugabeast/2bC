<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard-Gestao Utilizadores</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/cssdeteste.css">
    <script src="bootstrap.bundle.min.js / bootstrap.bundle.js"></script>
    
    <?php include_once('db_connection.php');
include('protect.php');?>

</head>

<body>
    <div class="container" id="container">
    <aside class="sidebar" id="mySidebar">
            <div class="top" id="main" >
                <div class="menu">
                <h2 style="color:white; display: none;" id="nomeProjeto">MEETING POINT</h2>
                    <i class="material-symbols-sharp" style="color:white" onclick="openNav()" id="abrirside">menu</i>
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
                        <span class="material-symbols-sharp" id="closeside" style="display: none; color: white; justify-content: center;">close</span>
                    </a>
                </div>
             <!--   <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">close</span>
                </div>  -->
                
            </div>
            <div class="sidebar">
                <a href="index3.php" >
                <span class="material-symbols-sharp">distance</span>
                    <h3 id="dashboard">MONITORIZAÇÃO</h3>
                </a>
                <a href="graficos.php">
                    <span class="material-symbols-sharp">nest_cam_outdoor</span>
                    <h3 id="formulario">GVIR</h3>
                </a>
                <a href="mapa.php"><span class="material-symbols-sharp">air</span>
                    <h3 id="tabelacrud">WIND</h3>
                </a>
                <a href="settings.php" class="active">
                    <span class="material-symbols-sharp">manage_accounts</span>
                    <h3 id="profile">ADMINISTRADOR</h3>
                </a>
                <a href="logout.php" id="traco">
                    <span class="material-symbols-sharp">logout</span>
                    <h3 id="logout">LOGOUT</h3>
                </a>
            </div>
        </aside>
        <!-- fim da sidebar -->
        <main>
            <h1 class="titulo">Gestao Utilizadores</h1>
            
            <form action="#" style="background: var(--color-background); border-radius: var(--border-radius-1); padding: var(--card-padding);">
            <!--<h2>Gestão de Utilizadores</h2>-->
            <br>
            <br>
            <label class="form-label" for="email">Email<i class="required">: </i></label>
            <input id="email" type="email" placeholder="Email" name="email" required >
            <br>
            <br>
            <label class="form-label" for="password">Password<i class="required">: </i></label>
            <input id="password" type="password" class="form-control" placeholder="A sua password" name="password" required>
            <br>
            <br>
            <label class="form-label" for="password">Confirmar Password<i class="required">: </i></label>
            <input id="check_password" type="password" class="form-control" placeholder="Confirme a sua password" name="check_password" required>
            <br>
            <br>
            <label for="users">Escolher Tipo Usuario: </label>
            <select name="users" id="users">            
                <option value="user">User</option>
                <option value="admin">Admin</option>                   
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-primary" value="Registar">
            </form>
        </main>
        <!--Fim da main-->
 
    </div>
    
    <script src="../js/index3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</body>

</html>