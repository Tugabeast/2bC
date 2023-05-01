
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
        include ('inserdata_settings.php');

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
            <button type="button" class="btn-add" id="myBtn"><span class="material-symbols-sharp">person_add</span>Adicionar Utilizador</button>
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 style="text-align: center; margin-bottom: 10px;" class="titulo">Adicionar Utilizador</h2>
                    <form style="text-align: center;" method="post" action="inserdata_settings.php" >
                        <label for="user">User:</label>
                        <br>
                        <input type="text" id="user" name="user" required style="border: 1px solid black;">
                        <br>
                        <label for="name">Name:</label>
                        <br>
                        <input type="text" id="name" name="name" required style="border: 1px solid black;">
                        <br>
                        <label for="password">Password:</label>
                        <br>
                        <input type="password" id="password" name="password" required style="border: 1px solid black;">
                        <br>
                        <label for="email">Email:</label>
                        <br>
                        <input type="text" id="email" name="email" required style="border: 1px solid black;">
                        <br>
                        <label for="password">Phone Number:</label>
                        <br>
                        <input type="number" name="phone_number" required style="border: 1px solid black;">
                        <br>
                        <label for="role">Role:</label>
                        <br>
                        <select name="role" id="role">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        <br>
                        <br>
                        <button type="submit" style="cursor: pointer;" name="cancelar" class="cancelar">Cancelar</button>
                        <button type="submit" style="cursor: pointer;" name="adicionar" class="adicionar">Adicionar</button>
                    </form> 
                </div>
            </div>

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
                                            <button type="button" class="btnedit-utilizador" style="background: #dddddd;"><span class="material-symbols-sharp" style="color: green;">edit_square</span></button>
                                            <button type="button" class="btneliminar-utilizador" style="background: #dddddd;"><span class="material-symbols-sharp" style="color: red;">delete</span></button>
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

            <!--------------------------------- BEGIN MODAL EDIT UTILIZADOR   -------------------------------->


            <div id="editmodal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 style="text-align: center; margin-bottom: 10px;" class="titulo">Editar Utilizador</h2>
                    <form style="text-align: center;" method="post" action="settings.php" >
                        
                        <label for="user">User:</label>
                        <br>
                        <input type="text" id="user" name="user" required style="border: 1px solid black;">
                        <br>
                        <label for="name">Name:</label>
                        <br>
                        <input type="text" id="name" name="name" required style="border: 1px solid black;">
                        <br>
                        <label for="email">Email:</label>
                        <br>
                        <input type="text" id="email" name="email" required style="border: 1px solid black;">
                        <br>
                        <label for="password">Phone Number:</label>
                        <br>
                        <input type="number" name="phone_number" required style="border: 1px solid black;">
                        <br>
                        <label for="role">Role:</label>
                        <br>
                        <select name="role" id="role">
                            <option value="admin" name="admin">Admin</option>
                            <option value="user" name="user">User</option>
                        </select>
                        <br>
                        <br>
                        <button type="submit" style="cursor: pointer;" name="cancelar" class="cancelar">Cancelar</button>
                        <button type="submit" style="cursor: pointer;" name="adicionar" class="adicionar">Editar</button>
                    </form> 
                </div>
            </div>
                
             <!--------------------------------- END MODAL EDIT UTILIZADOR   -------------------------------->


             <!--------------------------------- BEGIN MODAL ELIMINAR UTILIZADOR   -------------------------------->
             <div id="eliminarmodal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 style="text-align: center; margin-bottom: 10px;" class="titulo">Eliminar Utilizador</h2>
                    <form style="text-align: center;" method="post" action="settings.php" >
                        
                        <label for="user">Tem a certeza que quer eliminar o utilizador?</label>
                        <br>
                        <br>
                        <button type="submit" style="cursor: pointer;" name="cancelar" class="cancelar">Não</button>
                        <button type="submit" style="cursor: pointer;" name="adicionar" class="adicionar">Sim</button>
                    </form> 
                </div>
            </div>
            <!--------------------------------- END MODAL ELIMINAR UTILIZADOR   -------------------------------->

            <!--------------------------------- BEGIN MODAL ADICIONAR ALERTA   -------------------------------->

            <div id="AddAlertmodal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 style="text-align: center; margin-bottom: 10px;" class="titulo">Adicionar Alerta</h2>
                    <form style="text-align: center;" method="post" action="settings.php" >
                        <label for="data">Data:</label>
                        <br>
                        <input type="date" name="data" id="data" required style="border: 1px solid black;">
                        <br>
                        <label for="user">Nome:</label>
                        <br>
                        <input type="text" id="user" name="user" required style="border: 1px solid black;">
                        <br>
                        <label for="name">Email:</label>
                        <br>
                        <input type="text" id="email" name="email" required style="border: 1px solid black;">
                        <br>
                        <label for="tipoAlert">Tipo Alerta:</label>
                        <br>
                        <select name="tipoAlerta" id="tipoAlerta">
                            <option value="h1" name="h1">H1</option>
                            <option value="h2" name="h2">H2</option>
                            <option value="h3" name="h3">H3</option>
                        </select>
                        <br>
                        <label for="tipoAlert">Formato Relatorio:</label>
                        <br>
                        <select name="formato" id="formato">
                            <option value="pdf" name="pdf">PDF</option>
                            <option value="csv" name="csv">CSV</option>
                        </select>
                        <br>
                        <br>
                        <button type="submit" style="cursor: pointer;" name="cancelar" class="cancelar">Cancelar</button>
                        <button type="submit" style="cursor: pointer;" name="adicionar" class="adicionar">Adicionar</button>
                    </form> 
                </div>
            </div>

            <!--------------------------------- END MODAL ADICIONAR ALERTA   -------------------------------->

            <!--------------------------------- BEGIN MODAL EDITAR ALERTA   -------------------------------->
            <div id="EditAlertmodal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 style="text-align: center; margin-bottom: 10px;" class="titulo">Editar Alerta</h2>
                    <form style="text-align: center;" method="post" action="settings.php" >
                        
                        <label for="user">Nome:</label>
                        <br>
                        <input type="text" id="user" name="user" required style="border: 1px solid black;">
                        <br>
                        <label for="name">Email:</label>
                        <br>
                        <input type="text" id="name" name="name" required style="border: 1px solid black;">
                        <br>
                        <label for="tipoAlert">Tipo Alerta:</label>
                        <br>
                        <select name="tipoAlerta" id="tipoAlerta">
                            <option value="h1" name="h1">H1</option>
                            <option value="h2" name="h2">H2</option>
                            <option value="h3" name="h3">H3</option>
                        </select>
                        <br>
                        <label for="tipoAlert">Formato Relatorio:</label>
                        <br>
                        <select name="formato" id="formato">
                            <option value="pdf" name="pdf">PDF</option>
                            <option value="csv" name="csv">CSV</option>
                        </select>
                        <br>
                        <br>
                        <button type="submit" style="cursor: pointer;" name="cancelar" class="cancelar">Cancelar</button>
                        <button type="submit" style="cursor: pointer;" name="adicionar" class="adicionar">Editar</button>
                    </form> 
                </div>
            </div>
            <!--------------------------------- END MODAL EDITAR ALERTA   -------------------------------->

            <!--------------------------------- BEGIN MODAL ELIMINAR ALERTA   -------------------------------->

            <div id="eliminarAlert" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 style="text-align: center; margin-bottom: 10px;" class="titulo">Eliminar Alerta</h2>
                    <form style="text-align: center;" method="post" action="settings.php" >
                        
                        <label for="user">Tem a certeza que quer eliminar o alerta?</label>
                        <br>
                        <br>
                        <button type="submit" style="cursor: pointer;" name="cancelar" class="cancelar">Não</button>
                        <button type="submit" style="cursor: pointer;" name="adicionar" class="adicionar">Sim</button>
                    </form> 
                </div>
            </div>


            <!--------------------------------- END MODAL EDITAR ALERTA   -------------------------------->

            <!--------------------------------- BEGIN MODAL ADICINAR MP  C/ SCRIPT PHP PARA ADICIONAR MEETING POINTS -------------------------------->

            <div id="AddMPmodal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 style="text-align: center; margin-bottom: 10px;" class="titulo">Adicionar MP</h2>
                    <form style="text-align: center;" method="post" action="settings.php" >
                        <label for="MP_ID">MP:</label>
                        <br>
                        <input type="text" name="MP_ID" id="MP_ID" required style="border: 1px solid black;">
                        <br>
                        <label for="name">Name:</label>
                        <br>
                        <input type="text" name="name" id="name" required style="border: 1px solid black;">
                        <br>
                        <br>
                        <button type="submit" style="cursor: pointer;" name="cancelar" class="cancelar">Cancelar</button>
                        <button type="submit" style="cursor: pointer;" name="adicionarMP" class="adicionar">Adicionar</button>
                    </form> 
                </div>
            </div>

            <?php 
                //include ('db_connection.php');

                if(isset($_POST['adicionarMP'])){
                    $MP_ID = $_POST['MP_ID'];
                    $name = $_POST['name'];

                    $sqlinsertMP = "INSERT INTO `meeting_point` (`MP_ID`, `name`) VALUES ('$MP_ID', '$name')";

                    $data = mysqli_query($connect,$sqlinsertMP);

                    if($data){
                        $msg = "MP adicionado com sucesso";
                        //header("location: settings.php");
                    }
                    else{
                        $msg = "MP nao foi adicionado";
                    }


                }

            ?>


            <!--------------------------------- END MODAL ADICIONAR MP   -------------------------------->

            <!--------------------------------- BEGIN MODAL EDITAR MP   -------------------------------->

            <div id="EditMPmodal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 style="text-align: center; margin-bottom: 10px;" class="titulo">Editar Meeting Point</h2>
                    <form style="text-align: center;" method="post" action="settings.php" >

                        <input type="hidden" name="id" id="id">    
                        <label for="user">Nome:</label>
                        <br>
                        <input type="text" id="name" name="name" required style="border: 1px solid black;">
                        <br>
                        <br>
                        <button type="submit" style="cursor: pointer;" name="cancelar" class="cancelar">Cancelar</button>
                        <button type="submit" style="cursor: pointer;" name="EditarMP" class="EditarMP">Editar</button>
                    </form> 
                </div>
            </div>

            <?php 
                if(isset($_POST['EditarMP'])){

                    $id = $_POST ['id'];
                    $name = $_POST['name'];
            
                    $sqlinsertMP = "UPDATE `meeting_point` SET name = '$name' WHERE id = '$id'";
            
                    $data = mysqli_query($connect,$sqlinsertMP);
            
                    if($data){
                        $msg = "MP editado com sucesso";
                        //header("location: settings.php");
                    }
                    else{
                        $msg = "MP nao foi editado";
                    }
            
            
                }
            
            ?>

            <!--------------------------------- END MODAL EDITAR MP   -------------------------------->

            <!--------------------------------- BEGIN MODAL ELIMINAR MP   -------------------------------->

            <div id="EliminarMPmodal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 style="text-align: center; margin-bottom: 10px;" class="titulo">Eliminar Meeting Point</h2>
                    <form style="text-align: center;" method="post" action="settings.php" >
                        
                        <label for="user">Tem a certeza que quer eliminar o Meeting Point?</label>
                        <br>
                        <br>
                        <button type="submit" style="cursor: pointer;" name="cancelar" class="cancelar">Não</button>
                        <button type="submit" style="cursor: pointer;" name="adicionar" class="adicionar">Sim</button>
                    </form> 
                </div>
            </div>

            <!--------------------------------- END MODAL ELIMINAR MP   -------------------------------->

            <h1 class="titulo" style="text-align: center;">Gestão de Alertas</h1>
            <button type="button" class="btn-add-alert" id="AddAlertmodal"><span class="material-symbols-sharp">warning</span>Adicionar Alerta</button>

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
                                            <button type="button" class="edit-alert" style="background: #dddddd;"><span class="material-symbols-sharp" style="color: green;">edit_square</span></button>
                                            <button type="button" class="eliminar-alert" style="background: #dddddd;"><span class="material-symbols-sharp" style="color: red;">delete</span></button>
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
            <h3><?php $msg?></h3>
            <button type="button" class="btn-add-mp" id="AddMPmodal"><span class="material-symbols-sharp">location_on</span>Adicionar MP</button>
            <!--<button type="button" class="btn-add"><span class="material-symbols-sharp">location_on</span>Adicionar Meeting Point</button>-->
            <div class="containerphp">
                <table class="tabelacrud" id="tabelacrud3">
                    <tr>
                        <th>ID</th>
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
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['MP_ID']?></td>
                                    <td><?php echo $row['name']?></td>                           
                                    <td>
                                        <button type="button" class="edit-MP" style="background: #dddddd;"><span class="material-symbols-sharp" style="color: green;">edit_square</span></button>
                                        <button type="button" class="eliminar-MP" style="background: #dddddd;"><span class="material-symbols-sharp" style="color: red;">delete</span></button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!--
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    -->
    <script>
        //script modal adicionar utilizador
        // Get the modal
        var modal = document.getElementById("myModal");
        

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        //quando clica em cancelar, fecha o modal
        var cancelar = document.getElementsByClassName("cancelar");
        cancelar.onclick = function(){
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        //funcao abrir modal para Editar Meeting Point
        $(document).ready(function() {
            $('.btnedit-utilizador').on('click', function(){
                $('#editmodal').modal('show');
            });
        });

        //funcao abrir modal para eliminar Utlizador
        $(document).ready(function() {
            $('.btneliminar-utilizador').on('click', function(){
                $('#eliminarmodal').modal('show');
            });
        });

        //funcao abrir modal para Adicionar Meeting Point
        $(document).ready(function() {
            $('.btn-add-alert').on('click', function(){
                $('#AddAlertmodal').modal('show');
            });
        });

        //funcao abrir modal para editar Meeting Point
        $(document).ready(function() {
            $('.edit-alert').on('click', function(){
                $('#EditAlertmodal').modal('show');
            });
        });

        //funcao abrir modal para eliminar Alerta
        $(document).ready(function() {
            $('.eliminar-alert').on('click', function(){
                $('#eliminarAlert').modal('show');
            });
        });

        //funcao abrir modal para adicionar meeting point
        $(document).ready(function() {
            $('.btn-add-mp').on('click', function(){
                $('#AddMPmodal').modal('show');
            });
        });

        //funcao abrir modal para editar Meeting Point
        $(document).ready(function() {
            $('.edit-MP').on('click', function(){
                $('#EditMPmodal').modal('show');
                /*
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){ 
                    return $(this).text();
                }).get();

                console.log(data);

                $('#name').val(data[1]);

                */
            });
        });

        //funcao abrir modal para eliminar Meeting Point
        $(document).ready(function() {
            $('.eliminar-MP').on('click', function(){
                $('#EliminarMPmodal').modal('show');
            });
        });
        

        
    </script>

</body>

</html>