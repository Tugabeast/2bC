<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard-Gestao Utilizadores</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/cssdeteste.css">
    
    
    <?php 
        include_once('db_connection.php');
        include('protect.php');

        if(isset($_GET['id'])){
            echo $_GET['id'];
        }
    ?>

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
            <h1 class="titulo" style="text-align: center;">Gestão Utilizadores</h1>
            <button type="button" class="btn-add"><span class="material-symbols-sharp">person_add</span>Adicionar Utilizador</button>
            <div class="containerphp">
                <table class="tabelacrud" id="tabelacrud">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Ações</th>
                    </tr>
                    <?php   
                        include('db_connection.php');
                        $sql = "SELECT * FROM `mp_users` ";
                        $result = mysqli_query($connect, $sql);
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                                <tr>
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['user']?></td>
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo $row['role']?></td>
                                    <td>
                                            <a href="#"><span class="material-symbols-sharp" style="color: green;">edit_square</span></a>
                                            <a href='settings.php?id=".$result['id']."' ><span class="material-symbols-sharp" style="color: red;">delete</span></a> 
                                            <!--https://www.youtube.com/watch?v=I2lB7fZE37g&ab_channel=E-CODEC-->  
                                    </td>
                                </tr>
                            <?php
                        }   
                    ?>
                </table>
            </div>
            <br>
            <h1 class="titulo" style="text-align: center;">Gestão de Meeting Points</h1>
            <button type="button" class="btn-add"><span class="material-symbols-sharp">location_on</span>Adicionar Meeting Point</button>
            <div class="containerphp">
                <table class="tabelacrud" id="tabelacrud">
                    <tr>
                        <th>Name</th>
                        <th>Ações</th>
                    </tr>
                    <?php   
                        include('db_connection.php');
                        $sql = "SELECT * FROM `meeting_point` ";
                        $result = mysqli_query($connect, $sql);
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                                <tr>
                                    <td><?php echo $row['name']?></td>
                                    <td>
                                        <a href="#"><span class="material-symbols-sharp" style="color: green;">edit_square</span></a>
                                        <a href="#"><span class="material-symbols-sharp" style="color: red;">delete</span></a>
                                    </td>
                                </tr>
                            <?php
                        }   
                    ?>
                </table>
            </div>
            <br>
        </main>
        <!--Fim da main-->
 
    </div>
    
    <script src="../js/index3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</body>

</html>