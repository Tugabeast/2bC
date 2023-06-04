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
 
    <div class="container" id="container">
        <aside class="sidebar" id="mySidebar">
            <div class="top" id="top">
                <div class="menu" id="menu">
                <h2 style="color:white; display: none;" id="nomeProjeto">MEETING POINT</h2>
                    <i class="material-symbols-sharp" style="color:white" onclick="openNav()" id="abrirside">menu</i>
                    <a href="javascript:void(0)" class="closebtn" id="closebtn" onclick="closeNav()">
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

            


            <!-- -->
            <h1 class="titulo" id="registoperacao" style="text-align: center;">Registo de Operações</h1>
            <br>
            <!--<button type="button" class="btn-add"><span class="material-symbols-sharp">warning</span>Adiciona operação</button>-->
            <div class="containerphp" style="height: 40vh;">
                <input  type="text" id="myInput" onkeyup="myFunction()" placeholder="Procure por nome ou empresa.." title="Type in a name">
                <div class="table-wraper">
                    <table class="tabelacrud" id="tabelacrud4">
                        <thead>
                            <tr style="color: white;background: #094b9b;">
                                <th>Nome</th>
                                <th>Empresa</th>
                                <th>Cargo</th>
                                <th>Meeting Point</th>   
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
                                        </tr>
                                    <?php
                                }   
                            }
                        ?>
                    </table>
                </div>
            </div>

            <br>
            <br>
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
            <br>
            <br>
            <h1 class="titulo"  style="text-align: center;">Zonas de Meeting Points</h1>  
                <br>
                <div class="row" style="text-align: center; margin: auto; display: flex;align-items: center; justify-content: center;">
                    <div class="column">
                        <?php
                            include('db_connection.php');
                            $sqlzona3 = "SELECT * FROM meeting_point WHERE id=3";
                            $sqlzona4 = "SELECT * FROM meeting_point WHERE id=4";
                            $sqlzona5 = "SELECT * FROM meeting_point WHERE id=5";
                            $sqlzona6 = "SELECT * FROM meeting_point WHERE id=6";
                            $sqlzona7 = "SELECT * FROM meeting_point WHERE id=7";

                            $sqltrabalhadoresMP3 = "SELECT * FROM mp_registered_cards WHERE mp=3";
                            $sqltrabalhadoresMP4 = "SELECT * FROM mp_registered_cards WHERE mp=4";
                            $sqltrabalhadoresMP5 = "SELECT * FROM mp_registered_cards WHERE mp=5";
                            $sqltrabalhadoresMP6 = "SELECT * FROM mp_registered_cards WHERE mp=6";
                            $sqltrabalhadoresMP7 = "SELECT * FROM mp_registered_cards WHERE mp=7";

                            
                            $resultMP3 = mysqli_query($connect,$sqlzona3);
                            $resultMP4 = mysqli_query($connect,$sqlzona4);
                            $resultMP5 = mysqli_query($connect,$sqlzona5);
                            $resultMP6 = mysqli_query($connect,$sqlzona6);
                            $resultMP7 = mysqli_query($connect,$sqlzona7);

                            
                            $result3= mysqli_query($connect,$sqltrabalhadoresMP3);
                            $result4= mysqli_query($connect,$sqltrabalhadoresMP4);
                            $result5= mysqli_query($connect,$sqltrabalhadoresMP5);
                            $result6= mysqli_query($connect,$sqltrabalhadoresMP6);
                            $result7= mysqli_query($connect,$sqltrabalhadoresMP7);
                                
                            while($rowMP3 = mysqli_fetch_assoc($resultMP3) AND $rowMP4 = mysqli_fetch_assoc($resultMP4) AND $rowMP5 = mysqli_fetch_assoc($resultMP5) AND $rowMP6= mysqli_fetch_assoc($resultMP6) AND $rowMP7 = mysqli_fetch_assoc($resultMP7) AND  $row3 = mysqli_fetch_assoc($result3) AND $row4 = mysqli_fetch_assoc($result4) AND $row5 = mysqli_fetch_assoc($result5) AND $row6 = mysqli_fetch_assoc($result6) AND $row7 = mysqli_fetch_assoc($result7) ){
                                if($row3['mp']=3 ){
                                    $rowcountmp3= mysqli_num_rows($result3);
                                    ?>
                                    <div class="card" style="width: 200px; margin: auto; display: grid; height: 200px;" >
                                        <h3><?php echo $rowMP3['MP_ID']?></h3>
                                        <h3><?php echo $rowMP3['name']?></h3>
                                        <h3><?php echo $rowcountmp3?><span class="material-symbols-sharp">group</span></h3>
                                        <button style="cursor: pointer;" id="butaodetalhes" class="abrirDetalhesMP3" type="button">Details</button>
                                    </div>
                                    <br>
                                    <?php
                                }
                                ?>
                                </div>
                                <div class="column">            
                                    <?php
                                    if($row4['mp']=4 ){
                                        $rowcountmp4= mysqli_num_rows($result4);
                                    ?>
                                    <div class="card" style="width: 200px; margin: auto; display: grid; height: 200px;" >
                                        <h3><?php echo $rowMP4['MP_ID']?></h3>
                                        <h3><?php echo $rowMP4['name']?></h3>
                                        <h3><?php echo $rowcountmp4?><span class="material-symbols-sharp">group</span></h3>
                                        <button style="cursor: pointer;" id="butaodetalhes" class="abrirDetalhesMP4" type="button">Details</button>
                                    </div>
                                    <br>
                                </div>
                                    <?php    
                                        }
                                    ?>
                                <div class="column">
                                    <?php
                                        if($row5['mp']=5){
                                            $rowcountmp5= mysqli_num_rows($result5);
                                    ?>
                                    <div class="card" style="width: 200px; margin: auto; display: grid; height: 200px;" >
                                        <h3><?php echo $rowMP5['MP_ID']?></h3>
                                        <h3><?php echo $rowMP5['name']?></h3>
                                        <h3><?php echo $rowcountmp5?><span class="material-symbols-sharp">group</span></h3>
                                        <button style="cursor: pointer;" id="butaodetalhes" class="abrirDetalhesMP5" type="button">Details</button>
                                    </div>
                                    <br>
                                    <?php    
                                        }
                                    ?>
                                </div>
                                <div class="column">
                                    <?php
                                        if($row6['mp']=6 ){
                                            $rowcountmp6= mysqli_num_rows($result6);
                                    ?>
                                    <div class="card" style="width: 200px; margin: auto; display: grid; height: 200px;" >
                                        <h3><?php echo $rowMP6['MP_ID']?></h3>
                                        <h3><?php echo $rowMP6['name']?></h3>
                                        <h3><?php echo $rowcountmp6?><span class="material-symbols-sharp">group</span></h3>
                                        <button style="cursor: pointer;" id="butaodetalhes" class="abrirDetalhesMP6" type="button">Details</button>
                                    </div>
                                    <br>
                                    <?php    
                                        }
                                    ?>
                                </div>
                                <div class="column">
                                    <?php
                                        if($row7['mp']=7 ){
                                            $rowcountmp7= mysqli_num_rows($result7);
                                            
                                    ?>
                                    <div class="card" style="width: 200px; margin: auto; display: grid; height: 200px;" >
                                        <h3><?php echo $rowMP7['MP_ID']?></h3>
                                        <h3><?php echo $rowMP7['name']?></h3>
                                        <h3><?php echo $rowcountmp7?><span class="material-symbols-sharp">group</span></h3>
                                        <button style="cursor: pointer;" id="butaodetalhes" class="abrirDetalhesMP7" type="button">Details</button>
                                    </div>
                                    <br>
                                    <?php    
                                        }
                                    ?>
                                </div>
                            <?php    
                            }
                            ?>
                    
                </div>
            <br>
            <br>
            <h1 class="titulo"  style="text-align: center;">Configuração</h1>
            <br>
            <div class="row" style="margin: auto; display: flex; align-items: center; justify-content: center;">
                
                <div class="column">
                    <div class="card" style="width: 200px; margin: auto;">
                        <form method="POST" action="insertCardMP1.php">
                            
                            <h3 style="text-align: center;">
                                <?php
                                    $sqlzona3 = "SELECT * FROM meeting_point WHERE id=3";
                                    $resultMP3 = mysqli_query($connect,$sqlzona3);
                                    $rowMP3 = mysqli_fetch_assoc($resultMP3);

                                    $sqloperation = "SELECT * FROM mp_operation";
                                    $resultop= mysqli_query($connect,$sqloperation);
                                    $rowMPoperation = mysqli_fetch_assoc($resultop);

                                    echo '<h2 style="text-align: center;">'.  $rowMP3['MP_ID']. '</h2>';                                   
                                    echo '<h3 style="text-align: center;">'. $rowMP3['name']. '</h3>';
                                    echo '<br>';
                                    echo '<p style="text-align: center;">'.$rowMPoperation['operation'].'</p>' ;
                                ?>
                            </h3>

                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Standby" id="standby">
                            <label>Standby</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Emergency" id="emergency">
                            <label>Emergencia</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Evacuation" id="evacuation">
                            <label>Evacuação</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="End_Emergency" id="end_emergency">
                            <label>Fim de Emergencia</label>
                            <br>
                            <br>
                            <?php
                                // Return current date from the remote server
                                $date = date('d-m-y h:i:s');
                                echo "Updated: ".$date;
                            ?>
                            <br>
                            <br>
                            <input type="hidden" name="id" value="<?php echo $rowMP3['id']; ?>">
                            <button type="sumbit" id="butaosubmit" name="submitMP1" style="margin: auto;display: flex; cursor:pointer;" >Sumbit</button>
                        </form>
                    </div>
                </div>
                
                <div class="column">
                    <div class="card" style="width: 200px; margin: auto;  ">
                        <form action="insertCardMP2.php" method="POST">
                            <h3 style="text-align: center;">
                                <?php
                                    $sqlzona4 = "SELECT * FROM meeting_point WHERE id=4";
                                    $resultMP4 = mysqli_query($connect,$sqlzona4);
                                    $rowMP4 = mysqli_fetch_assoc($resultMP4);

                                    $sqloperation = "SELECT * FROM mp_operation WHERE id=4";
                                    $resultop= mysqli_query($connect,$sqloperation);
                                    $rowMPoperation = mysqli_fetch_assoc($resultop);

                                    echo '<h2 style="text-align: center;">'.  $rowMP4['MP_ID']. '</h2>';                                   
                                    echo '<h3 style="text-align: center;">'. $rowMP4['name']. '</h3>';
                                    echo '<br>';
                                    echo '<p style="text-align: center;">'.$rowMPoperation['operation'].'</p>' ;
                                ?>
                            </h3>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Standby" id="standby">
                            <label>Standby</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Emergency" id="emergency">
                            <label>Emergencia</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Evacuation" id="evacuation">
                            <label>Evacuação</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="End_Emergency" id="end_emergency">
                            <label>Fim de Emergencia</label>
                            <br>
                            <br>
                            <?php
                                // Return current date from the remote server
                                $date = date('d-m-y h:i:s');
                                echo "Updated: ".$date;
                            ?>
                            <br>
                            <br>
                            <input type="hidden" name="id" value="<?php echo $rowMP4['id']; ?>">
                            <button type="sumbit" id="butaosubmit" name="submitMP2" style="margin: auto;display: flex;cursor:pointer;" >Sumbit</button>
                            
                        </form>
                    </div>
                </div>           
                <div class="column">
                    <div class="card" style="width: 200px; margin: auto;  ">
                        <form action="insertCardMP3.php" method="POST">
                            <h3 style="text-align: center;">
                                <?php
                                    $sqlzona5 = "SELECT * FROM meeting_point WHERE id=5";
                                    $resultMP5 = mysqli_query($connect,$sqlzona5);
                                    $rowMP5= mysqli_fetch_assoc($resultMP5);

                                    $sqloperation = "SELECT * FROM mp_operation WHERE operation='Evacuation' ";
                                    $resultop= mysqli_query($connect,$sqloperation);
                                    $rowMPoperation = mysqli_fetch_assoc($resultop);

                                    echo '<h2 style="text-align: center;">'.  $rowMP5['MP_ID']. '</h2>';                                   
                                    echo '<h3 style="text-align: center;">'. $rowMP5['name']. '</h3>';
                                    echo '<br>';
                                    echo '<p style="text-align: center;">'.$rowMPoperation['operation'].'</p>' ;
                                ?>
                            </h3>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Standby" id="standby">
                            <label>Standby</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Emergency" id="emergency">
                            <label>Emergencia</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Evacuation" id="evacuation">
                            <label>Evacuação</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="End_Emergency" id="end_emergency">
                            <label>Fim de Emergencia</label>
                            <br>
                            <br>
                            <?php
                                // Return current date from the remote server
                                $date = date('d-m-y h:i:s');
                                echo "Updated: ".$date;
                            ?>
                            <br>
                            <br>
                            <input type="hidden" name="id" value="<?php echo $rowMP5['id']; ?>">
                            <button type="sumbit" id="butaosubmit" name="submitMP3" style="margin: auto;display: flex;cursor:pointer;" >Sumbit</button>
                            
                        </form>
                    </div>
                </div>              
                <div class="column">
                    <div class="card" style="width: 200px; margin: auto; ">
                        <form action="insertCardMP4.php" method="POST">
                            <h3 style="text-align: center;">
                                <?php
                                    $sqlzona6 = "SELECT * FROM meeting_point WHERE id=6";
                                    $resultMP6 = mysqli_query($connect,$sqlzona6);
                                    $rowMP6 = mysqli_fetch_assoc($resultMP6);

                                    $sqloperation = "SELECT * FROM mp_operation WHERE operation='emergency' ";
                                    $resultop= mysqli_query($connect,$sqloperation);
                                    $rowMPoperation = mysqli_fetch_assoc($resultop);

                                    echo '<h2 style="text-align: center;">'.  $rowMP6['MP_ID']. '</h2>';                                   
                                    echo '<h3 style="text-align: center;">'. $rowMP6['name']. '</h3>';
                                    echo '<br>';
                                    echo '<p style="text-align: center;">'.$rowMPoperation['operation'].'</p>' ;
                                ?>
                            </h3>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Standby" id="standby">
                            <label>Standby</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Emergency" id="emergency">
                            <label>Emergencia</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Evacuation" id="evacuation">
                            <label>Evacuação</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="End_Emergency" id="end_emergency"> 
                            <label>Fim de Emergencia</label>
                            <br>
                            <br>
                            <?php
                                // Return current date from the remote server
                                $date = date('d-m-y h:i:s');
                                echo "Updated: ".$date;
                            ?>
                            <br>
                            <br>
                            <input type="hidden" name="id" value="<?php echo $rowMP6['id']; ?>">
                            <button type="sumbit" id="butaosubmit" name="submitMP4" style="margin: auto;display: flex;cursor:pointer;" >Sumbit</button>
                            
                        </form>    
                    </div>
                </div>        
                <div class="column">
                    <div class="card" style="width: 200px; margin: auto;  ">
                        <form action="insertCardMP5.php" method="POST">        
                            <h3 style="text-align: center;">
                                <?php
                                    $sqlzona7 = "SELECT * FROM meeting_point WHERE id=7";
                                    $resultMP7 = mysqli_query($connect,$sqlzona7);   
                                    $rowMP7 = mysqli_fetch_assoc($resultMP7);

                                    $sqloperation = "SELECT * FROM mp_operation";
                                    $resultop= mysqli_query($connect,$sqloperation);
                                    $rowMPoperation = mysqli_fetch_assoc($resultop);

                                    echo '<h2 style="text-align: center;">'.  $rowMP7['MP_ID']. '</h2>';                                   
                                    echo '<h3 style="text-align: center;">'. $rowMP7['name']. '</h3>';
                                    echo '<br>';
                                    echo '<p style="text-align: center;">'.$rowMPoperation['operation'].'</p>' ;

                                ?>
                            </h3>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Standby" id="standby">
                            <label>Standby</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Emergency" id="emergency">
                            <label>Emergencia</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Evacuation" id="evacuation">
                            <label>Evacuação</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="End_Emergency" id="end_emergency"> 
                            <label>Fim de Emergencia</label>
                            <br>
                            <br>
                            <?php
                                // Return current date from the remote server
                                $date = date('d-m-y h:i:s');
                                echo "Updated: ".$date;
                            ?>
                            <br>
                            <br>
                            <input type="hidden" name="id" value="<?php echo $rowMP7['id']; ?>">
                            <button type="sumbit" id="butaosubmit"  name="submitMP5" style="margin: auto;display: flex;cursor:pointer;" >Sumbit</button>
                        </form>
                    </div>
                </div>
                <div class="column">
                    <div class="card" style="width: 200px; margin: auto;  ">
                        <form action="insertCardMPmaster.php" method="POST">        
                            <h3 style="text-align: center;">
                                <?php
                                    $sqlzonamaster = "SELECT * FROM meeting_point WHERE id=8";
                                    $resultMPmaster = mysqli_query($connect,$sqlzonamaster);   
                                    $rowMPmaster = mysqli_fetch_assoc($resultMPmaster);

                                    $sqloperation = "SELECT * FROM mp_operation";
                                    $resultop= mysqli_query($connect,$sqloperation);
                                    $rowMPoperation = mysqli_fetch_assoc($resultop);

                                    echo '<h2 style="text-align: center;">'.  $rowMPmaster['MP_ID']. '</h2>';                                   
                                    echo '<h3 style="text-align: center;">'. $rowMPmaster['name']. '</h3>';
                                    echo '<br>';
                                    echo '<p style="text-align: center;">'.$rowMPoperation['operation'].'</p>' ;

                                ?>
                            </h3>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Standby" id="standby">
                            <label>Standby</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Emergency" id="emergency">
                            <label>Emergencia</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Evacuation" id="evacuation">
                            <label>Evacuação</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="End_Emergency" id="end_emergency"> 
                            <label>Fim de Emergencia</label>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <input type="hidden" name="id" value="<?php echo $rowMPmaster['id']; ?>">
                            <button type="sumbit" id="butaosubmit"  name="submitMPmaster" style="margin: auto;display: flex;cursor:pointer;" >Sumbit</button>
                            
                        </form>
                    </div>
                </div>

                    
            </div>
            








            <!--------------------------------- BEGIN MODAL DETALHES ZONAS MP 3  -------------------------------->

            <div id="DetalhesMP3" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form style="text-align: center;" method="post" action="#" >
                        
                        <label>
                            <?php 
                                include('db_connection.php');
                                $sqlzona3 = "SELECT * FROM meeting_point WHERE id=3";
                                $sqltrabalhadoresMP3 = "SELECT * FROM mp_registered_cards WHERE mp=3";
                                $resultMP3 = mysqli_query($connect,$sqlzona3);
                                $result3= mysqli_query($connect,$sqltrabalhadoresMP3);

                                while($rowMP3 = mysqli_fetch_assoc($resultMP3) AND $row3 = mysqli_fetch_assoc($result3)){
                                    
                                    echo '<h1>'. $rowMP3['name']  .'</h1>';
                                    $rowcountmp3= mysqli_num_rows($result3);
                                    echo "Estao ";
                                    echo $rowcountmp3;
                                    ?>
                                    Trabalhadores no
                                    <?php
                                    echo $rowMP3['MP_ID'];
                                } 
                            ?>
                            <span class="material-symbols-sharp">engineering</span>
                        </label>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dissmiss="modal">Fechar</button>
                    </form> 
                </div>
            </div>

            <!--------------------------------- END MODAL DETALHES ZONAS MP3   -------------------------------->

            <!--------------------------------- BEGIN MODAL DETALHES ZONAS MP 4  -------------------------------->

            <div id="DetalhesMP4" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form style="text-align: center;" method="post" action="#" >
                        
                        <label>
                            
                            <?php 
                                include('db_connection.php');
                                $sqlzona4 = "SELECT * FROM meeting_point WHERE id=4";
                                $sqltrabalhadoresMP4 = "SELECT * FROM mp_registered_cards WHERE mp=4";
                                $resultMP4 = mysqli_query($connect,$sqlzona4);
                                $result4= mysqli_query($connect,$sqltrabalhadoresMP4);

                                while($rowMP4 = mysqli_fetch_assoc($resultMP4) AND $row4= mysqli_fetch_assoc($result4)){

                                    echo '<h1>'. $rowMP4['name']  .'</h1>';
                                    $rowcountmp4= mysqli_num_rows($result4);
                                    echo "Estao ";
                                    echo $rowcountmp4;
                                    ?>
                                    Trabalhadores no
                                    <?php
                                    echo $rowMP4['MP_ID'];
                                } 
                            ?>
                            <span class="material-symbols-sharp">engineering</span>
                        </label>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dissmiss="modal">Fechar</button>
                    </form> 
                </div>
            </div>

            <!--------------------------------- END MODAL DETALHES ZONAS MP4   -------------------------------->

             <!--------------------------------- BEGIN MODAL DETALHES ZONAS MP 5  -------------------------------->

             <div id="DetalhesMP5" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form style="text-align: center;" method="post" action="#" >
                        <label>
                            <?php 
                                include('db_connection.php');
                                $sqlzona5 = "SELECT * FROM meeting_point WHERE id=5";
                                $sqltrabalhadoresMP5 = "SELECT * FROM mp_registered_cards WHERE mp=5";
                                $resultMP5 = mysqli_query($connect,$sqlzona5);
                                $result5= mysqli_query($connect,$sqltrabalhadoresMP5);

                                while($rowMP5 = mysqli_fetch_assoc($resultMP5) AND $row5= mysqli_fetch_assoc($result5)){
                                    echo '<h1>'. $rowMP5['name']  .'</h1>';
                                    $rowcountmp5= mysqli_num_rows($result5);
                                    echo "Estao ";
                                    echo $rowcountmp5;
                                    ?>
                                    Trabalhadores no
                                    <?php
                                    echo $rowMP5['MP_ID'];
                                } 
                            ?>
                            <span class="material-symbols-sharp">engineering</span>
                        </label>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dissmiss="modal">Fechar</button>
                    </form> 
                </div>
            </div>

            <!--------------------------------- END MODAL DETALHES ZONAS MP5   -------------------------------->

             <!--------------------------------- BEGIN MODAL DETALHES ZONAS MP 6  -------------------------------->

             <div id="DetalhesMP6" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form style="text-align: center;" method="post" action="#" >                     
                        <label>
                            <?php 
                                include('db_connection.php');
                                $sqlzona6 = "SELECT * FROM meeting_point WHERE id=6";
                                $sqltrabalhadoresMP6 = "SELECT * FROM mp_registered_cards WHERE mp=6";
                                $resultMP6 = mysqli_query($connect,$sqlzona6);
                                $result6= mysqli_query($connect,$sqltrabalhadoresMP6);

                                while($rowMP6 = mysqli_fetch_assoc($resultMP6) AND $row6= mysqli_fetch_assoc($result6)){
                                    echo '<h1>'. $rowMP6['name']  .'</h1>';
                                    $rowcountmp6= mysqli_num_rows($result6);
                                    echo "Estao ";
                                    echo $rowcountmp6;
                                    ?>
                                    Trabalhadores no
                                    <?php
                                    echo $rowMP6['MP_ID'];
                                } 
                            ?>
                            <span class="material-symbols-sharp">engineering</span>
                        </label>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dissmiss="modal">Fechar</button>
                    </form> 
                </div>
            </div>

            <!--------------------------------- END MODAL DETALHES ZONAS MP6   -------------------------------->

             <!--------------------------------- BEGIN MODAL DETALHES ZONAS MP 7  -------------------------------->

             <div id="DetalhesMP7" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form style="text-align: center;" method="post" action="#" >
                        <label> 
                            <?php 
                                include('db_connection.php');
                                $sqlzona7 = "SELECT * FROM meeting_point WHERE id=7";
                                $sqltrabalhadoresMP7 = "SELECT * FROM mp_registered_cards WHERE mp=7";
                                $resultMP7 = mysqli_query($connect,$sqlzona7);
                                $result7= mysqli_query($connect,$sqltrabalhadoresMP7);

                                while($rowMP7 = mysqli_fetch_assoc($resultMP7) AND $row7= mysqli_fetch_assoc($result7)){
                                    echo '<h1>'. $rowMP7['name']  .'</h1>';
                                    $rowcountmp7= mysqli_num_rows($result7);
                                    echo "Estao ";
                                    echo $rowcountmp7;
                                    ?>
                                    Trabalhadores no
                                    <?php
                                    echo $rowMP7['MP_ID'];
                                } 
                            ?>
                            <span class="material-symbols-sharp">engineering</span>
                        </label>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dissmiss="modal">Fechar</button>
                    </form> 
                </div>
            </div>

            <!--------------------------------- END MODAL DETALHES ZONAS MP7   -------------------------------->
            <br>
            <a href="#registoperacao" class="topoo" style="font-size: 18px; color: var(--color-primary); ">VOLTAR AO TOPO^</a>
        </main>
        <!--Fim da main-->
        
    </div>

    <script src="../js/index3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  

    <script>

        // Get the modal
        var modal = document.getElementById("myModal");
                

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

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
            $('.abrirDetalhesMP3').on('click', function(){
                $('#DetalhesMP3').modal('show');
            });
        });

        $(document).ready(function() {
            $('.abrirDetalhesMP4').on('click', function(){
                $('#DetalhesMP4').modal('show');
            });
        });

        $(document).ready(function() {
            $('.abrirDetalhesMP5').on('click', function(){
                $('#DetalhesMP5').modal('show');
            });
        });

        $(document).ready(function() {
            $('.abrirDetalhesMP6').on('click', function(){
                $('#DetalhesMP6').modal('show');
            });
        });

        $(document).ready(function() {
            $('.abrirDetalhesMP7').on('click', function(){
                $('#DetalhesMP7').modal('show');
            });
        });

        //funcao para pesquisar por nomes e empresas na primeira tabela
        function myFunction() {
            var input, filter,table, tr, td1,td2, i, txtValue1,txtValue2;
            input = document.getElementById("myInput");
            
            filter = input.value.toUpperCase();
            
            table = document.getElementById("tabelacrud4");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td1 = tr[i].getElementsByTagName("td")[0];
                td2 = tr[i].getElementsByTagName("td")[1];
                if (td1 && td2) {
                    txtValue1 = td1.textContent || td1.innerText;
                    txtValue2 = td2.textContent || td2.innerText;
                    if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter)> -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }





    </script>
</body>

</html>