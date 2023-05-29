
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
        include ('insertcode.php');

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
            <div class="containerphp">
                <div class="table-wraper" style="overflow-y: hidden;">
                    <table class="tabelacrud" id="tabelacrud11" style="width: 100%;">
                        <thead>
                            <tr style="color: white; background: #094b9b;">
                                <th>ID</th>
                                <th>User</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                            <td><?php echo $row['email']?></td>
                                            <td><?php echo $row['phone_number']?></td>
                                            <td><?php echo $row['role']?></td>
                                            <td>
                                                    <button type="button" class="btnedit-utilizador" style="background: #00D4FF;"><span class="material-symbols-sharp" style="color: green;">edit_square</span></button>
                                                    <button type="button" class="btneliminar-utilizador" style="background: #00D4FF;"><span class="material-symbols-sharp" style="color: red;">delete</span></button>
                                            </td>
                                        </tr>
                                    <?php
                                }   
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!--------------------------------- BEGIN MODAL INTRODUZIR UTILIZADOR   -------------------------------->
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 style="text-align: center; margin-bottom: 10px;" class="titulo">Adicionar Utilizador</h2>
                    <form style="text-align: center;" method="POST" action="insertcode.php" >
                        <label>User:</label>
                        <br>
                        <input type="text" id="user" name="user" required style="border: 1px solid black;">
                        <br>
                        <label>Name:</label>
                        <br>
                        <input type="text" id="name" name="name" required style="border: 1px solid black;">
                        <br>
                        <label>Password:</label>
                        <br>
                        <input type="password" id="password" name="password" required style="border: 1px solid black;">
                        <br>
                        <label>Email:</label>
                        <br>
                        <input type="text" id="email" name="email" required style="border: 1px solid black;">
                        <br>
                        <label>Phone Number:</label>
                        <br>
                        <input type="number" name="phone_number" required style="border: 1px solid black;">
                        <br>
                        <label>Role:</label>
                        <br>
                        <select name="role" id="role">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="submit" style="cursor: pointer;" name="adicionar" class="adicionar">Adicionar</button>
                    </form> 
                </div>
            </div>            

            <!--------------------------------- END MODAL INTRODUZIR UTILIZADOR   -------------------------------->

            <!--------------------------------- BEGIN MODAL EDIT UTILIZADOR   -------------------------------->


            <div id="editmodal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 style="text-align: center; margin-bottom: 10px;" class="titulo">Editar Utilizador</h2>
                    <form style="text-align: center;" method="POST" action="editarutilizador.php" >
                        <input type="hidden" name="update_id" id="update_id">
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
                        <label>Phone Number:</label>
                        <br>
                        <input type="number" name="phone_number" id="phone_number" required style="border: 1px solid black;">
                        <br>
                        <label for="role">Role:</label>
                        <br>
                        <select name="role" id="role">
                            <option value="admin" name="admin">Admin</option>
                            <option value="user" name="user">User</option>
                        </select>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="submit" style="cursor: pointer;" name="editarUtilizador" class="adicionar">Editar</button>
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
                    <form style="text-align: center;" method="POST" action="deleteuser.php" >
                        <input type="hidden" name="delete_id" id="delete_id">
                        <label>Tem a certeza que quer eliminar o utilizador?</label>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dismiss="modal">Não</button>
                        <button type="submit" style="cursor: pointer;" name="eliminarUtilizador" class="adicionar">Sim</button>
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
                    <form style="text-align: center;" method="POST" action="adicionaralerta.php" >
                    <!--
                        <label for="user">Nome:</label>
                        <br>
                        <input type="text" id="user" name="user" required style="border: 1px solid black;">
                        <br>
                        <label for="name">Email:</label>
                        <br>
                        <input type="text" id="email" name="email" required style="border: 1px solid black;">
                        <br>
                    -->    
                        <label for="tipoAlert">Tipo Alerta:</label>
                        <br>
                        <input type="checkbox" name="alertH1" id="alertH1" value="alertH1" style="border: 1px solid black; padding:6px;">
                        <label for="alertH1">H1</label>
                        <br>
                        <input type="checkbox" name="alertH2" id="alertH2" value="alertH2" style="border: 1px solid black; padding:6px;">
                        <label for="alertH1">H2</label>
                        <br>
                        <input type="checkbox" name="alertH3" id="alertH3" value="alertH3" style="border: 1px solid black; padding:6px;">
                        <label for="alertH1">H3</label>
                        <br>
                        <label for="tipoAlert">Formato Relatorio:</label>
                        <br>
                        <select name="report_format" id="report_format">
                            <option value="pdf" name="pdf">PDF</option>
                            <option value="csv" name="csv">CSV</option>
                        </select>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="submit" style="cursor: pointer;" name="adicionarAlerta" class="adicionar">Adicionar</button>
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
                    <form style="text-align: center;" method="POST" action="editarAlerta.php" >
                        <input type="hidden" id="editalert_id" name="editalert_id">
                        <!--
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
                    -->
                        <br>
                        <label for="tipoAlert">Formato Relatorio:</label>
                        <br>
                        <select name="report_format" id="report_format">
                            <option value="pdf" name="pdf">PDF</option>
                            <option value="csv" name="csv">CSV</option>
                        </select>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="submit" style="cursor: pointer;" name="alertedit_id" class="adicionar">Editar</button>
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
                    <form style="text-align: center;" method="POST" action="eliminarAlerta.php" >
                        <input type="hidden" id="eliminarAlerta_id" name="eliminarAlerta_id">
                        <label for="user">Tem a certeza que quer eliminar o alerta?</label>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dismiss="modal">Não</button>
                        <button type="submit" style="cursor: pointer;" name="eliminarALerta" class="adicionar">Sim</button>
                    </form> 
                </div>
            </div>


            <!--------------------------------- END MODAL EDITAR ALERTA   -------------------------------->

            <!--------------------------------- BEGIN MODAL ADICINAR MP  -------------------------------->

            <div id="AddMPmodal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 style="text-align: center; margin-bottom: 10px;" class="titulo">Adicionar MP</h2>
                    <form style="text-align: center;" method="POST" action="adicionarMP.php" >
                        <label for="MP_ID">MP:</label>
                        <br>
                        <input type="text" name="MP_ID" id="MP_ID" required style="border: 1px solid black;">
                        <br>
                        <label for="name">Name:</label>
                        <br>
                        <input type="text" name="name" id="name" required style="border: 1px solid black;">
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="submit" style="cursor: pointer;" name="adicionarMP" class="adicionar">Adicionar</button>
                    </form> 
                </div>
            </div>


            <!--------------------------------- END MODAL ADICIONAR MP   -------------------------------->

            <!--------------------------------- BEGIN MODAL EDITAR MP   -------------------------------->

            <div id="EditMPmodal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 style="text-align: center; margin-bottom: 10px;" class="titulo">Editar Meeting Point</h2>
                    <form style="text-align: center;" method="POST" action="editarMP.php" >

                        <input type="hidden" name="mpedit_id" id="mpedit_id">    
                        <label for="user">Nome:</label>
                        <br>
                        <input type="text" id="name" name="name" required style="border: 1px solid black;">
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="submit" style="cursor: pointer;" name="editarMP" class="EditarMP">Editar</button>
                    </form> 
                </div>
            </div>
            <!--------------------------------- END MODAL EDITAR MP   -------------------------------->

            <!--------------------------------- BEGIN MODAL ELIMINAR MP   -------------------------------->

            <div id="EliminarMPmodal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 style="text-align: center; margin-bottom: 10px;" class="titulo">Eliminar Meeting Point</h2>
                    <form style="text-align: center;" method="POST" action="eliminarMP.php" >
                        <input type="hidden" id="mpelimin_id" name="mpelimin_id">
                        <label for="user">Tem a certeza que quer eliminar o Meeting Point?</label>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dismiss="modal">Não</button>
                        <button type="submit" style="cursor: pointer;" name="eliminarMP" class="adicionar">Sim</button>
                    </form> 
                </div>
            </div>

            <!--------------------------------- END MODAL ELIMINAR MP   -------------------------------->
            <br>
            <br>

            <h1 class="titulo" style="text-align: center;">Gestão de Alertas</h1>
            <button type="button" class="btn-add-alert" id="AddAlertmodal"><span class="material-symbols-sharp">warning</span>Adicionar Alerta</button>

            <div class="containerphp">
                <div class="table-wraper"  style="overflow-y: hidden;">
                    <table class="tabelacrud" id="tabelacrud2" style="width: 100%;">
                        <thead>
                            <tr style="color: white; background: #094b9b;">
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
                                                <button type="button" class="edit-alert" style="background: #00D4FF;"><span class="material-symbols-sharp" style="color: green;">edit_square</span></button>
                                                <button type="button" class="eliminar-alert" style="background: #00D4FF;"><span class="material-symbols-sharp" style="color: red;">delete</span></button>
                                            </td>
                                        </tr>
                                    <?php
                                }   
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            
            <br>
            <br>
            <br>
            <h1 class="titulo" style="text-align: center;">Gestão de Meeting Points</h1>
            <h3><?php $msg?></h3>
            <button type="button" class="btn-add-mp" id="AddMPmodal"><span class="material-symbols-sharp">location_on</span>Adicionar MP</button>
            <!--<button type="button" class="btn-add"><span class="material-symbols-sharp">location_on</span>Adicionar Meeting Point</button>-->
            <div class="containerphp">
                <div class="table-wraper"  style="overflow-y: hidden;">
                    <table class="tabelacrud" id="tabelacrud3" style="width: 100%;">
                        <thead>
                            <tr style="color: white; background: #094b9b;">
                                <th>ID</th>
                                <th>MP</th>
                                <th>Name</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                                <button type="button" class="edit-MP" style="background: #00D4FF;"><span class="material-symbols-sharp" style="color: green;">edit_square</span></button>    
                                                <button type="button" class="eliminar-MP" style="background: #00D4FF;" ><span class="material-symbols-sharp" style="color: red;">delete</span></button>
                                            </td>
                                        </tr>
                                    <?php
                                }   
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <br>
            <br>
            <!-- script paginicação-->

            <!-- -->
            <h1 class="titulo" style="text-align: center;">Registo de Operações</h1>
            <!--<button type="button" class="btn-add"><span class="material-symbols-sharp">warning</span>Adiciona operação</button>-->
            <div class="containerphp">
                <div class="table-wraper"  style="overflow-y: hidden;">
                    <table class="tabelacrud" id="tabelacrud4">
                        <thead>
                            <tr style="color: white; background: #094b9b;">
                                <th>Data</th>
                                <th>ID</th>
                                <th>Operações</th>
                                <th>Ordem dada</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php   
                                include('db_connection.php');
                                /* TIRAR O LIMIT 7 */ 
                                $sql = "SELECT * FROM `mp_operation` LIMIT 7";
                                $result = mysqli_query($connect, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    
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
                                        
                                    }   
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <a href="#menu" class="topoo" style="font-size: 18px; color: var(--color-primary); ">VOLTAR AO TOPO^</a>
        </main>
        <!--Fim da main-->
 
    </div>

    <script src="../js/index3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" ></script>
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

        //funcao abrir modal para Editar utilizador
        $(document).ready(function() {
            $('.btnedit-utilizador').on('click', function(){
                $('#editmodal').modal('show');

                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#update_id').val(data[0]);
                    $('#user').val(data[1]);
                    $('#name').val(data[2]);
                    $('#email').val(data[3]);
                    $('#phone_number').val(data[4]);
                    $('#role').val(data[5]);
            });
        });

        //funcao abrir modal para eliminar Utlizador
        $(document).ready(function() {
            $('.btneliminar-utilizador').on('click', function(){
                $('#eliminarmodal').modal('show');

                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#delete_id').val(data[0]);
            });
        });

        //funcao abrir modal para Adicionar alertas
        $(document).ready(function() {
            $('.btn-add-alert').on('click', function(){
                $('#AddAlertmodal').modal('show');
            });
        });

        //funcao abrir modal para editar alertas
        $(document).ready(function() {
            $('.edit-alert').on('click', function(){
                $('#EditAlertmodal').modal('show');

                $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();

                console.log(data);

                $('#editalert_id').val(data[0]);
                $('#report_format').val(data[1]);
            });
        });

        //funcao abrir modal para eliminar Alertas
        $(document).ready(function() {
            $('.eliminar-alert').on('click', function(){
                $('#eliminarAlert').modal('show');


                $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();

                    console.log(data);

                $('#eliminarAlerta_id').val(data[0]);
                
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
            
            $('.edit-MP').on('click', function(e){
                
                $('#EditMPmodal').modal('show');

                $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();

                console.log(data);

                $('#mpedit_id').val(data[0]);
            });
        });

        //funcao abrir modal para eliminar Meeting Point
        $(document).ready(function() {
            $('.eliminar-MP').on('click', function(){
                $('#EliminarMPmodal').modal('show');


                $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();

                console.log(data);

                $('#mpelimin_id').val(data[0]);
            });
        });
        
   
    </script>

</body>

</html>