<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MONITORIZACAO</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/cssdeteste.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    
    
    <?php 
        include_once('db_connection.php');
        include('protect.php');
    ?>
</head>

<body>
    <?php 
/*
    function loginuser(){
        require_once 'db_connection.php';

        $sel = "SELECT name FROM mp_users Where id = ". $_SESSION['id'];
        $query = mysqli_query($connect,$sel);
        $row = mysqli_fetch_assoc($query);
        return $row;
    }
*/
    ?>
    
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
            </div>
            <div class="sidebar">
                <a href="index3.php" class="active">
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
                <a href="settings.php">
                    <span class="material-symbols-sharp">manage_accounts</span>
                    <h3 id="profile">ADMINISTRAdOR</h3>
                </a>
                <!--<p>Bem vindo, <?php echo $result['Name'];?></p>-->
                <a href="logout.php" id="traco">
                    <span class="material-symbols-sharp">logout</span>
                    <h3 id="logout">LOGOUT</h3>
                </a>

            </div>
        </aside>
        <!-- fim da sidebar -->
        <main >
            <!--<h1 class="titulo">Monitorização</h1>-->
            <!-- script php progress bar -->
            <div class="progressbar">
                <?php 
                    $sqlbar2 = "SELECT * FROM mp_registered_cards where mp != 0 " ;
                    if($result2 = mysqli_query($connect,$sqlbar2)){
                        $rowcount2 = mysqli_num_rows($result2);
                        echo "nr de trabalhadores registado: " . $rowcount2;
                        
                    }
                    echo "<br>";
                    $sqlpbar = "SELECT * FROM mp_registered_cards where mp = 0";
                    if($result = mysqli_query($connect,$sqlpbar)){
                        $rowcount = mysqli_num_rows($result);
                        echo "nr de trabalhadores nao registados: " . $rowcount;
                        
                    }

                    $percentagem = ($rowcount2 /$rowcount)* 100 ;
                    
                ?>
                <br>
                <progress value="<?php echo $rowcount2 ?>" max="<?php echo $rowcount ?>"></progress>
                <br>
                <?php echo round($percentagem,2)  ."%"  ?>
            </div>
            <br>

            <!-- -->
            <h1 class="titulo" style="text-align: center;">Registo de Operações</h1>
            <!--<button type="button" class="btn-add"><span class="material-symbols-sharp">warning</span>Adiciona operação</button>-->
            <div class="containerphp">
                <div class="table-wraper">
                    <table class="tabelacrud" id="tabelacrud4">
                        <thead>
                            <tr style="color: white;background: #094b9b;">
                                <th>Nome</th>
                                <th>Empresa</th>
                                <th>Cargo</th>
                                <th>Meeting Point</th>
                                <th>More</th>
                            </tr>
                        </thead>
                        <?php   
                            include('db_connection.php'); 
                            $sql = "SELECT * FROM `mp_registered_cards`";
                            $result = mysqli_query($connect, $sql);
                            if (mysqli_num_rows($result) > 0) {
                               
                                while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                        <tr>
                                            <td><?php echo $row['worker_name']?></td>
                                            <td><?php echo $row['worker_company']?></td>
                                            <td><?php echo $row['type']?></td>
                                            <td><?php echo $row['mp']?></td>
                                            <td><span style="cursor: pointer;" class="material-symbols-sharp">more_horiz</span></td>
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
                    </table>
                </div>
            </div>
            <br>
            <h1 class="titulo"  style="text-align: center;">Zonas de Meeting Points</h1>  
                <div class="row">
                    <div class="column">
                        <?php
                            include('db_connection.php');
                            $sqlzonas = "SELECT * FROM meeting_point ";
                            $sqltrabalhadoresMP3 = "SELECT * FROM mp_registered_cards WHERE mp=3";
                            $result = mysqli_query($connect,$sqlzonas);
                            $result2= mysqli_query($connect,$sqltrabalhadoresMP3);
                            
                            while($row = mysqli_fetch_assoc($result) AND $row2 = mysqli_fetch_assoc($result2)){
                                $rowcountmp3 = mysqli_num_rows($result2);
                                
                                ?>
                                <div class="card" style="width: 200px; margin: auto; display: grid;" >
                                    <h3><?php echo $row['MP_ID']?></h3>
                                    <h3><?php echo $row['name']?></h3>
                                    <h3><?php echo $rowcountmp3?><span class="material-symbols-sharp">group</span></h3>
                                    <button style="cursor: pointer;" class="abrirDetalhes" type="button">Details</button>
                                </div>
                                <br>
                                <?php
                            }
                        ?>
                    </div>
                    
                </div>

            <br>
            <h1 class="titulo"  style="text-align: center;">Configuração</h1>
            <br>
            <div class="row">
                <br>
                <div class="column">
                    <?php
                        include('db_connection.php');
                        $sqlzonas = "SELECT * FROM meeting_point ";
                        $sqloperation = "SELECT * FROM meeting_point INNER JOIN mp_operation ";
                        //$sqloperation = "SELECT * FROM mp_operation ";
                        $result = mysqli_query($connect,$sqlzonas);
                        //$result2 = mysqli_query($connect,$sqloperation); 
                        while($row = mysqli_fetch_assoc($result) ){                              
                    ?>
                        <div class="card" style="width: 200px; margin: auto; display: grid;" >
                            <h3><?php echo $row['MP_ID']?></h3>
                            <h3><?php echo $row['name']?></h3>
                            <!--<h4><?php echo $row['operation']?></h4>-->
                            <button style="cursor: pointer;" class="abrirDetalhes" type="button">Details</button>
                        </div>
                    <?php
                        }
                    ?>
                </div>
                <br>
                <div class="column">
                    <div class="card" style="width: 100px; margin: auto; display: grid;">
                        <h3>teste2</h3>
                    </div>
                </div>
                <br>
                <div class="column">
                    <div class="card" style="width: 100px; margin: auto; display: grid;">
                        <h3>teste3</h3>
                    </div>
                </div>
                <br>
                <div class="column">
                    <div class="card" style="width: 100px; margin: auto; display: grid;">
                        <h3>teste4</h3>
                    </div>
                </div>
                <br>
                <div class="column">
                    <div class="card" style="width: 100px; margin: auto; display: grid;">
                        <h3>teste5</h3>
                    </div>
                </div>
                <br>
                <div class="column">
                    <div class="card" style="width: 100px; margin: auto; display: grid;">
                        <h3>teste geral</h3>
                    </div>
                </div>

                    
            </div>
            








            <!--------------------------------- BEGIN MODAL DETALHES ZONAS MP   -------------------------------->

            <div id="DetalhesMP" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 style="text-align: center; margin-bottom: 10px;" class="titulo">Detalhes do Meeting Point</h2>
                    <form style="text-align: center;" method="post" action="settings.php" >
                        
                        <label>Sem trabalhadores neste meeting point<span class="material-symbols-sharp">engineering</span></label>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar">Fechar</button>
                    </form> 
                </div>
            </div>

            <!--------------------------------- END MODAL DETALHES ZONAS MP   -------------------------------->
            <a href="#menu" class="topoo" style="font-size: 18px; color: var(--color-primary); ">VOLTAR AO TOPO^</a>
        </main>
        <!--Fim da main-->
        
    </div>

    <script src="../js/index3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  

    <script>


        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];


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

        $(document).ready(function() {
            $('.abrirDetalhes').on('click', function(){
                $('#DetalhesMP').modal('show');
            });
        });
    </script>
</body>

</html>