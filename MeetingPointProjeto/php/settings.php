<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard-Gestao Utilizadores</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/cssdeteste.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    
    
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
                <div class="menu" id="menu">
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
                <table class="tabelacrud" id="tabelacrud1">
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
                                            <a href='#' ><span class="material-symbols-sharp" style="color: red;">delete</span></a>
                                            <!--<a href='settings.php?id=".$result['id']."' ><span class="material-symbols-sharp" style="color: red;">delete</span></a> -->
                                            <!--https://www.youtube.com/watch?v=I2lB7fZE37g&ab_channel=E-CODEC-->  
                                    </td>
                                </tr>
                            <?php
                        }   
                    ?>
                </table>
            </div>
            <br>
            <h1 class="titulo" style="text-align: center;">Gestão de Alertas</h1>
            <button type="button" class="btn-add"><span class="material-symbols-sharp">warning</span>Adicionar Alerta</button>
            <div class="containerphp">
                <table class="tabelacrud" id="tabelacrud2">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Alertas</th>
                            <th>Formato Relatorio</th>
                            <th>Ações</th>
                        </tr>                        
                    </thead>
                    <tbody>
                        <?php   
                            include('db_connection.php');
                            $sql = "SELECT * FROM `mp_alert` ";
                            $result = mysqli_query($connect, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                                    <tr>
                                        <td><?php echo $row['datatime']?></td>
                                        <td><?php echo $row['name']?></td>
                                        <td><?php echo $row['email']?></td>
                                        <td><?php echo $row['alert']?></td>
                                        <td><?php echo $row['report_format']?></td>
                                        <td>
                                            <a href="#"><span class="material-symbols-sharp" style="color: green;">edit_square</span></a>
                                            <a href="#"><span class="material-symbols-sharp" style="color: red;">delete</span></a>
                                        </td>
                                    </tr>
                                <?php
                            }   
                        ?>
                    </tbody>
                </table>
            </div>
            
            
            <br>
            <h1 class="titulo" style="text-align: center;">Gestão de Meeting Points</h1>
            <!--<button type="button" class="btn-add"><span class="material-symbols-sharp">location_on</span>Adicionar Meeting Point</button>-->
            <div class="containerphp">
                <table class="tabelacrud" id="tabelacrud3">
                    <tr>
                        <th>MP</th>
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
                                    <td><?php echo $row['MP_ID']?></td>
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
            <!-- script paginicação-->
            <?php 
                // Define o número de resultados por página
                $results_per_page = 7;

                // Determina o número total de resultados
                    $sql11 = "SELECT COUNT(*) AS num_results FROM mp_operation";
                    $result11 = mysqli_query($connect, $sql11);
                    $row = mysqli_fetch_assoc($result11);
                    $total_results = $row['num_results'];

                // Determina o número total de páginas
                $total_pages = ceil($total_results / $results_per_page);

                 // Determina a página atual
                if (isset($_GET['page'])) {
                    $current_page = $_GET['page'];
                } else {
                    $current_page = 1;
                }

                 // Determina o índice do primeiro resultado na página atual
                $first_result_index = ($current_page - 1) * $results_per_page;
            ?>
            <!-- -->
            <h1 class="titulo" style="text-align: center;">Registo de Operações</h1>
            <!--<button type="button" class="btn-add"><span class="material-symbols-sharp">warning</span>Adiciona operação</button>-->
            <div class="containerphp">
                <table class="tabelacrud" id="tabelacrud4">
                    <tr>
                        <th>Data</th>
                        <th>ID</th>
                        <th>Operações</th>
                        <th>Ordem dada</th>
                    </tr>
                    <?php   
                        include('db_connection.php');
                        $sql = "SELECT * FROM `mp_operation` LIMIT $first_result_index, $results_per_page ";
                        $result = mysqli_query($connect, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $count = $first_result_index + 1;
                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                                    <tr>
                                        <td><?php echo $row['datatime']?></td>
                                        <td><?php echo $row['id']?></td>
                                        <td><?php echo $row['operation']?></td>
                                        <td><?php echo $row['order_given']?></td>
                                        <!--
                                        <td>
                                            <a href="#"><span class="material-symbols-sharp" style="color: green;">edit_square</span></a>
                                            <a href="#"><span class="material-symbols-sharp" style="color: red;">delete</span></a>
                                        </td>
                                        -->
                                    </tr>
                                <?php
                                $count++;
                            }   
                        }
                    ?>
                </table>
            </div>
            <br>
            <a href="#menu" class="topoo" style="font-size: 18px; color: var(--color-primary); ">VOLTAR AO TOPO^</a>
        </main>
        <!--Fim da main-->
 
    </div>
    <!--
    <script>
        $(document).ready(function () {
            $('#tabelacrud3').DataTable({
                responsive: true,
            });
        });
    </script>
    -->
    <script src="../js/index3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!--
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    -->
</body>

</html>