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
	
    

    <style>
    .red-row td {
        color: red;
    }

    .red-row td a {
        color: red;
    }

    .green-row td {
        color: green;
    }

    .green-row td a {
        color: green;
    }
</style>
    
    <?php 
        include_once('db_connection.php');
        include('protect.php');
    ?>
    <style>
        #close-btn-teste-mobile{
            display: none;
        }
    </style>
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
                <div class="close" id="close-btn-teste-mobile" >
                    <span class="material-symbols-sharp" onclick="closeNavMobile()" style="color: white;">close</span>
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
                <p style="margin-top: 26rem; text-align: end; color: white;">Bem vindo, <?php echo $_SESSION['nome'];?></p>
                <a href="logout.php" id="traco">
                    <span class="material-symbols-sharp">logout</span>
                    <h3 id="logout">LOGOUT</h3>
                </a>

            </div>
        </aside>
        <!-- fim da sidebar -->
        <main >
            <h1 class="titulo" id="registoperacao" style="text-align: center;">Registo de Operações</h1>
            <br>
            <!--<button type="button" class="btn-add"><span class="material-symbols-sharp">warning</span>Adiciona operação</button>-->
            <div class="containerphp" style="height: 40vh;">
                <div class="table-wraper" id="table-wraper">
                <input  type="text" id="myInput" onkeyup="myFunction()" placeholder="Procure por nome ou empresa.." title="Type in a name">
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
                                    $textColor = ($row['mp'] == 0) ? 'red' : 'green';
                                    $rowClass = ($row['mp'] == 0) ? 'red-row' : 'green-row';
                                    ?>
                                    <tr class="<?php echo $rowClass; ?>">
                                        <td data-label = "Nome">
                                            <a href="#" class="edit-link" data-worker-name="<?php echo $row['worker_name']; ?>" style="font-weight: bold; color: <?php echo $textColor; ?>">
                                                <?php echo $row['worker_name']; ?>
                                            </a>
                                        </td>
                                        <td data-label = "Empresa" style="color: <?php echo $textColor; ?> "><?php echo $row['worker_company']; ?></td>
                                        <td data-label = "Cargo" style="color: <?php echo $textColor; ?> "><?php echo $row['type']; ?></td>
                                        <td data-label = "Meeting Point" style="color: <?php echo $textColor; ?> "><?php echo $row['mp']; ?></td>
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
                
            <span id="registeredCount">
                <?php 
                    $sqlbar2 = "SELECT COUNT(*) AS registeredWorkers FROM mp_registered_cards WHERE mp != 0";
                    $result2 = mysqli_query($connect, $sqlbar2);
                    $rowcount2 = mysqli_fetch_assoc($result2)['registeredWorkers'];
                    echo "nr de trabalhadores registados: <span id='registeredWorkersCount'>" . $rowcount2 . "</span>";
                ?>
            </span>
            <br>
            <span id="unregisteredCount">
                <?php
                    $sqlpbar = "SELECT COUNT(*) AS unregisteredWorkers FROM mp_registered_cards WHERE mp = 0";
                    $result = mysqli_query($connect, $sqlpbar);
                    $rowcount = mysqli_fetch_assoc($result)['unregisteredWorkers'];
                    echo "nr de trabalhadores não registados: <span id='unregisteredWorkersCount'>" . $rowcount . "</span>";
                ?>
            </span>
                
                <br>
                <progress id="progressBar" value="<?php echo $rowcount2 ?>" max="<?php echo $rowcount ?>"></progress>
                <br>
                <span></span>
                <span id="progressPercentage"><?php echo round($percentagem, 2) . "%" ?></span>
            </div>
            <br>
            <br>
            <br>
            <h1 class="titulo"  style="text-align: center;">Zonas de Meeting Points</h1>  
                <br>
                <div class="row" style="text-align: center; margin: auto; display: flex; align-items: center; justify-content: center;">
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

                    $resultMP3 = mysqli_query($connect, $sqlzona3);
                    $resultMP4 = mysqli_query($connect, $sqlzona4);
                    $resultMP5 = mysqli_query($connect, $sqlzona5);
                    $resultMP6 = mysqli_query($connect, $sqlzona6);
                    $resultMP7 = mysqli_query($connect, $sqlzona7);

                    $result3 = mysqli_query($connect, $sqltrabalhadoresMP3);
                    $result4 = mysqli_query($connect, $sqltrabalhadoresMP4);
                    $result5 = mysqli_query($connect, $sqltrabalhadoresMP5);
                    $result6 = mysqli_query($connect, $sqltrabalhadoresMP6);
                    $result7 = mysqli_query($connect, $sqltrabalhadoresMP7);

                    function renderCard($rowMP, $rowcount, $mpClass)
                    {
                        ?>
                        <div class="column">
                            <div class="card" style="width: 200px; margin: auto; display: grid; height: 200px;">
                                <h3><?php echo $rowMP['MP_ID']; ?></h3>
                                <h3><?php echo $rowMP['name']; ?></h3>
                                <h3><?php echo $rowcount; ?><span class="material-symbols-sharp">group</span></h3>
                                <button style="cursor: pointer;" id="butaodetalhes" class="abrirDetalhes<?php echo $mpClass; ?>"
                                    type="button">Details
                                </button>
                            </div>
                            <br>
                        </div>
                        <?php
                    }

                    $rowMP3 = mysqli_fetch_assoc($resultMP3);
                    if ($rowMP3) {
                        $rowcountmp3 = mysqli_num_rows($result3);
                        renderCard($rowMP3, $rowcountmp3, 'MP3');
                    }

                    $rowMP4 = mysqli_fetch_assoc($resultMP4);
                    if ($rowMP4) {
                        $rowcountmp4 = mysqli_num_rows($result4);
                        renderCard($rowMP4, $rowcountmp4, 'MP4');
                    }

                    $rowMP5 = mysqli_fetch_assoc($resultMP5);
                    if ($rowMP5) {
                        $rowcountmp5 = mysqli_num_rows($result5);
                        renderCard($rowMP5, $rowcountmp5, 'MP5');
                    }

                    $rowMP6 = mysqli_fetch_assoc($resultMP6);
                    if ($rowMP6) {
                        $rowcountmp6 = mysqli_num_rows($result6);
                        renderCard($rowMP6, $rowcountmp6, 'MP6');
                    }

                    $rowMP7 = mysqli_fetch_assoc($resultMP7);
                    if ($rowMP7) {
                        $rowcountmp7 = mysqli_num_rows($result7);
                        renderCard($rowMP7, $rowcountmp7, 'MP7');
                    }
                    ?>
                </div>

                <br>
                <br>
                <h1 class="titulo"  style="text-align: center;">Configuração</h1>
                <br>
                <div class="row" style="margin: auto; display: flex; align-items: center; justify-content: center;">
                    
                <div class="column">
                    <?php
                    include('db_connection.php');
                        $query = "SELECT id, operation AS last_operation FROM mp_operation WHERE (id, datatime) IN (SELECT id, MAX(datatime) FROM mp_operation GROUP BY id) ORDER BY id";
                        $result = mysqli_query($connect, $query);

                        // Criar um array associativo com os últimos valores de operação para cada ID
                        $lastOperations = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $lastOperations[$row['id']] = $row['last_operation'];
                        }
                    ?>

                    <div class="card" style="width: 200px; margin: auto;">
                        <form method="POST" action="insertCardMP1.php">
                            <h3 style="text-align: center;">
                                <?php
                                $sqlzona3 = "SELECT * FROM meeting_point WHERE id=3";
                                $resultMP3 = mysqli_query($connect, $sqlzona3);
                                $rowMP3 = mysqli_fetch_assoc($resultMP3);

                                echo '<h2 style="text-align: center;">'. $rowMP3['MP_ID']. '</h2>';
                                echo '<h3 style="text-align: center;">'. $rowMP3['name']. '</h3>';
                                echo '<br>';
                                echo '<p style="text-align: center;">'. $lastOperations[3]. '</p>';
                                ?>
                            </h3>

                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Standby" id="standby"<?php if ($lastOperations[3] == 'Standby') echo ' checked'; ?>>
                            <label>Standby</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Emergency" id="emergency"<?php if ($lastOperations[3] == 'Emergency') echo ' checked'; ?>>
                            <label>Emergencia</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Evacuation" id="evacuation"<?php if ($lastOperations[3] == 'Evacuation') echo ' checked'; ?>>
                            <label>Evacuação</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="End_Emergency" id="end_emergency"<?php if ($lastOperations[3] == 'End_Emergency') echo ' checked'; ?>>
                            <label>Fim de Emergencia</label>
                            <br>
                            <br>
                            <?php
                            // Retorna a data atual do servidor remoto
                            $date = date('d-m-y h:i:s');
                            echo "Atualizado: " . $date;
                            ?>
                            <br>
                            <br>
                            <input type="hidden" name="id" value="<?php echo $rowMP3['id']; ?>">
                            <button type="submit" id="butaosubmit" name="submitMP1" style="margin: auto;display: flex; cursor:pointer;">Submit</button>
                        </form>
                    </div>

                </div>
                
                <div class="column">
                    <?php
                        include('db_connection.php');
                        $query = "SELECT id, operation AS last_operation FROM mp_operation WHERE (id, datatime) IN (SELECT id, MAX(datatime) FROM mp_operation GROUP BY id) ORDER BY id";
                        $result = mysqli_query($connect, $query);

                        // Criar um array associativo com os últimos valores de operação para cada ID
                        $lastOperations = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $lastOperations[$row['id']] = $row['last_operation'];
                        }
                    ?>
                    <div class="card" style="width: 200px; margin: auto;  ">
                        <form action="insertCardMP1.php" method="POST">
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
                                    echo '<p style="text-align: center;">'. $lastOperations[4]. '</p>';
                                ?>
                            </h3>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Standby" id="standby"<?php if ($lastOperations[4] == 'Standby') echo ' checked'; ?>>
                            <label>Standby</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Emergency" id="emergency"<?php if ($lastOperations[4] == 'Emergency') echo ' checked'; ?>>
                            <label>Emergencia</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Evacuation" id="evacuation"<?php if ($lastOperations[4] == 'Evacuation') echo ' checked'; ?>>
                            <label>Evacuação</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="End_Emergency" id="end_emergency"<?php if ($lastOperations[4] == 'End_Emergency') echo ' checked'; ?>>
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
                            <button type="sumbit" id="butaosubmit" name="submitMP1" style="margin: auto;display: flex;cursor:pointer;" >Submit</button>
                            
                        </form>
                    </div>
                </div>           
                <div class="column">
                    <?php
                        include('db_connection.php');
                        $query = "SELECT id, operation AS last_operation FROM mp_operation WHERE (id, datatime) IN (SELECT id, MAX(datatime) FROM mp_operation GROUP BY id) ORDER BY id";
                        $result = mysqli_query($connect, $query);

                        // Criar um array associativo com os últimos valores de operação para cada ID
                        $lastOperations = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $lastOperations[$row['id']] = $row['last_operation'];
                        }
                    ?>
                    <div class="card" style="width: 200px; margin: auto;  ">
                        <form action="insertCardMP1.php" method="POST">
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
                                    echo '<p style="text-align: center;">'. $lastOperations[5]. '</p>';
                                ?>
                            </h3>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Standby" id="standby"<?php if ($lastOperations[5] == 'Standby') echo ' checked'; ?>>
                            <label>Standby</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Emergency" id="emergency"<?php if ($lastOperations[5] == 'Emergency') echo ' checked'; ?>>
                            <label>Emergencia</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Evacuation" id="evacuation"<?php if ($lastOperations[5] == 'Evacuation') echo ' checked'; ?>>
                            <label>Evacuação</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="End_Emergency" id="end_emergency"<?php if ($lastOperations[5] == 'End_Emergency') echo ' checked'; ?>>
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
                            <button type="sumbit" id="butaosubmit" name="submitMP1" style="margin: auto;display: flex;cursor:pointer;" >Submit</button>
                            
                        </form>
                    </div>
                </div>              
                <div class="column">
                    <?php
                        include('db_connection.php');
                        $query = "SELECT id, operation AS last_operation FROM mp_operation WHERE (id, datatime) IN (SELECT id, MAX(datatime) FROM mp_operation GROUP BY id) ORDER BY id";
                        $result = mysqli_query($connect, $query);

                        // Criar um array associativo com os últimos valores de operação para cada ID
                        $lastOperations = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $lastOperations[$row['id']] = $row['last_operation'];
                        }
                    ?>
                    <div class="card" style="width: 200px; margin: auto; ">
                        <form action="insertCardMP1.php" method="POST">
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
                                    echo '<p style="text-align: center;">'. $lastOperations[6]. '</p>';
                                ?>
                            </h3>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Standby" id="standby"<?php if ($lastOperations[6] == 'Standby') echo ' checked'; ?>>
                            <label>Standby</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Emergency" id="emergency"<?php if ($lastOperations[6] == 'Emergency') echo ' checked'; ?>>
                            <label>Emergencia</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Evacuation" id="evacuation"<?php if ($lastOperations[6] == 'Evacuation') echo ' checked'; ?>>
                            <label>Evacuação</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="End_Emergency" id="end_emergency"<?php if ($lastOperations[6] == 'End_Emergency') echo ' checked'; ?>>
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
                            <button type="sumbit" id="butaosubmit" name="submitMP1" style="margin: auto;display: flex;cursor:pointer;" >Submit</button>
                            
                        </form>    
                    </div>
                </div>        
                <div class="column">
                    <?php
                        include('db_connection.php');
                        $query = "SELECT id, operation AS last_operation FROM mp_operation WHERE (id, datatime) IN (SELECT id, MAX(datatime) FROM mp_operation GROUP BY id) ORDER BY id";
                        $result = mysqli_query($connect, $query);

                        // Criar um array associativo com os últimos valores de operação para cada ID
                        $lastOperations = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $lastOperations[$row['id']] = $row['last_operation'];
                        }
                    ?>
                    <div class="card" style="width: 200px; margin: auto;  ">
                        <form action="insertCardMP1.php" method="POST">        
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
                                    echo '<p style="text-align: center;">'. $lastOperations[7]. '</p>';

                                ?>
                            </h3>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Standby" id="standby"<?php if ($lastOperations[7] == 'Standby') echo ' checked'; ?>>
                            <label>Standby</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Emergency" id="emergency"<?php if ($lastOperations[7] == 'Emergency') echo ' checked'; ?>>
                            <label>Emergencia</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Evacuation" id="evacuation"<?php if ($lastOperations[7] == 'Evacuation') echo ' checked'; ?>>
                            <label>Evacuação</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="End_Emergency" id="end_emergency"<?php if ($lastOperations[7] == 'End_Emergency') echo ' checked'; ?>>
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
                            <button type="sumbit" id="butaosubmit"  name="submitMP1" style="margin: auto;display: flex;cursor:pointer;" >Submit</button>
                        </form>
                    </div>
                </div>
                <div class="column">
                    <?php
                        include('db_connection.php');
                        $query = "SELECT id, operation AS last_operation FROM mp_operation WHERE (id, datatime) IN (SELECT id, MAX(datatime) FROM mp_operation GROUP BY id) ORDER BY id";
                        $result = mysqli_query($connect, $query);

                        // Criar um array associativo com os últimos valores de operação para cada ID
                        $lastOperations = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $lastOperations[$row['id']] = $row['last_operation'];
                        }
                    ?>
                    <div class="card" style="width: 200px; margin: auto;  ">
                        <form action="insertCardMPmaster.php" method="POST">        
                            <h3 style="text-align: center;">
                                <?php
                                    $sqlzonamaster = "SELECT * FROM meeting_point WHERE MP_ID='MP Master'  ";
                                    $resultMPmaster = mysqli_query($connect,$sqlzonamaster);   
                                    $rowMPmaster = mysqli_fetch_assoc($resultMPmaster);

                                    $sqloperation = "SELECT * FROM mp_operation";
                                    $resultop= mysqli_query($connect,$sqloperation);
                                    $rowMPoperation = mysqli_fetch_assoc($resultop);

                                    echo '<h2 style="text-align: center;">'.  $rowMPmaster['MP_ID']. '</h2>';                                   
                                    echo '<h3 style="text-align: center;">'. $rowMPmaster['name']. '</h3>';
                                    echo '<br>';
                                    echo '<p style="text-align: center;">'. $lastOperations[8]. '</p>';

                                ?>
                            </h3>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Standby" id="standby"<?php if ($lastOperations[8] == 'Standby') echo ' checked'; ?>>
                            <label>Standby</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Emergency" id="emergency"<?php if ($lastOperations[8] == 'Emergency') echo ' checked'; ?>>
                            <label>Emergencia</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="Evacuation" id="evacuation"<?php if ($lastOperations[8] == 'Evacuation') echo ' checked'; ?>>
                            <label>Evacuação</label>
                            <br>
                            <input type="radio" class="checkoption" name="operation" value="End_emergency" id="end_emergency"<?php if ($lastOperations[8] == 'End_Emergency') echo ' checked'; ?>>
                            <label>Fim de Emergencia</label>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <input type="hidden" name="id" value="<?php echo $rowMPmaster['id']; ?>">   
                            <button type="sumbit" id="butaosubmit"  name="submitMPmaster" style="margin: auto;display: flex;cursor:pointer;" >Submit</button>       
                        </form>
                    </div>
                </div>

                    
            </div>
            








            <!--------------------------------- BEGIN MODAL DETALHES ZONAS MP 3  -------------------------------->

            <div id="DetalhesMP3" class="modal">
            <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form style="text-align: center;" method="post" action="#">
                        <label>
                            <?php
                            include('db_connection.php');
                            $sqlzona3 = "SELECT * FROM meeting_point WHERE id=3";
                            $sqltrabalhadoresMP3 = "SELECT * FROM mp_registered_cards WHERE mp=3";
                            $resultMP3 = mysqli_query($connect, $sqlzona3);
                            $result3 = mysqli_query($connect, $sqltrabalhadoresMP3);

                            $rowMP3 = mysqli_fetch_assoc($resultMP3);
                            $row3 = mysqli_fetch_assoc($result3);

                            if ($rowMP3 && $row3) {
                                echo '<h1>' . $rowMP3['name'] . '</h1>';
                                $rowcountmp3 = mysqli_num_rows($result3);
                                echo "Estão " . $rowcountmp3 . " trabalhadores no " . $rowMP3['MP_ID'];
                            } else {
                                echo '<h1>' . $rowMP3['name'] . '</h1>';
                                echo "Não há trabalhadores neste meeting point.";
                            }
                            ?>
                            <span class="material-symbols-sharp">engineering</span>
                        </label>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dismiss="modal">Fechar</button>
                    </form>
                </div>
            </div>

            <!--------------------------------- END MODAL DETALHES ZONAS MP3   -------------------------------->

            <!--------------------------------- BEGIN MODAL DETALHES ZONAS MP 4  -------------------------------->

            <div id="DetalhesMP4" class="modal">
            <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form style="text-align: center;" method="post" action="#">
                        <label>
                            <?php
                            include('db_connection.php');
                            $sqlzona4 = "SELECT * FROM meeting_point WHERE id=4";
                            $sqltrabalhadoresMP4 = "SELECT * FROM mp_registered_cards WHERE mp=4";
                            $resultMP4 = mysqli_query($connect, $sqlzona4);
                            $result4 = mysqli_query($connect, $sqltrabalhadoresMP4);

                            $rowMP4 = mysqli_fetch_assoc($resultMP4);
                            $row4 = mysqli_fetch_assoc($result4);

                            if ($rowMP4 && $row4) {
                                echo '<h1>' . $rowMP4['name'] . '</h1>';
                                $rowcountmp4 = mysqli_num_rows($result4);
                                echo "Estão " . $rowcountmp4 . " trabalhadores no " . $rowMP4['MP_ID'];
                            } else {
                                echo '<h1>' . $rowMP4['name'] . '</h1>';
                                echo "Não há trabalhadores neste meeting point.";
                            }
                            ?>
                            <span class="material-symbols-sharp">engineering</span>
                        </label>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dismiss="modal">Fechar</button>
                    </form>
                </div>
            </div>

            <!--------------------------------- END MODAL DETALHES ZONAS MP4   -------------------------------->

             <!--------------------------------- BEGIN MODAL DETALHES ZONAS MP 5  -------------------------------->

            <div id="DetalhesMP5" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form style="text-align: center;" method="post" action="#">
                        <label>
                            <?php
                            include('db_connection.php');
                            $sqlzona5 = "SELECT * FROM meeting_point WHERE id=5";
                            $sqltrabalhadoresMP5 = "SELECT * FROM mp_registered_cards WHERE mp=5";
                            $resultMP5 = mysqli_query($connect, $sqlzona5);
                            $result5 = mysqli_query($connect, $sqltrabalhadoresMP5);

                            $rowMP5 = mysqli_fetch_assoc($resultMP5);
                            $row5= mysqli_fetch_assoc($result5);

                            if ($rowMP5 && $row5) {
                                echo '<h1>' . $rowMP5['name'] . '</h1>';
                                $rowcountmp5 = mysqli_num_rows($result5);
                                echo "Estão " . $rowcountmp5 . " trabalhadores no " . $rowMP5['MP_ID'];
                            } else {
                                echo '<h1>' . $rowMP5['name'] . '</h1>';
                                echo "Não há trabalhadores neste meeting point.";
                            }
                            ?>
                            <span class="material-symbols-sharp">engineering</span>
                        </label>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dismiss="modal">Fechar</button>
                    </form>
                </div>
            </div>

            <!--------------------------------- END MODAL DETALHES ZONAS MP5   -------------------------------->

             <!--------------------------------- BEGIN MODAL DETALHES ZONAS MP 6  -------------------------------->

             <div id="DetalhesMP6" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form style="text-align: center;" method="post" action="#">
                        <label>
                            <?php
                            include('db_connection.php');
                            $sqlzona6 = "SELECT * FROM meeting_point WHERE id=6";
                            $sqltrabalhadoresMP6 = "SELECT * FROM mp_registered_cards WHERE mp=6";
                            $resultMP6 = mysqli_query($connect, $sqlzona6);
                            $result6 = mysqli_query($connect, $sqltrabalhadoresMP6);

                            $rowMP6 = mysqli_fetch_assoc($resultMP6);
                            $row6= mysqli_fetch_assoc($result6);

                            if ($rowMP6 && $row6) {
                                echo '<h1>' . $rowMP6['name'] . '</h1>';
                                $rowcountmp6 = mysqli_num_rows($result6);
                                echo "Estão " . $rowcountmp6 . " trabalhadores no " . $rowMP6['MP_ID'];
                            } else {
                                echo '<h1>' . $rowMP6['name'] . '</h1>';
                                echo "Não há trabalhadores neste meeting point.";
                            }
                            ?>
                            <span class="material-symbols-sharp">engineering</span>
                        </label>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dismiss="modal">Fechar</button>
                    </form>
                </div>
            </div>

            <!--------------------------------- END MODAL DETALHES ZONAS MP6   -------------------------------->

             <!--------------------------------- BEGIN MODAL DETALHES ZONAS MP 7  -------------------------------->

            <div id="DetalhesMP7" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form style="text-align: center;" method="post" action="#">
                        <label>
                            <?php
                            include('db_connection.php');
                            $sqlzona5 = "SELECT * FROM meeting_point WHERE id=7";
                            $sqltrabalhadoresMP7 = "SELECT * FROM mp_registered_cards WHERE mp=7";
                            $resultMP7 = mysqli_query($connect, $sqlzona7);
                            $result7 = mysqli_query($connect, $sqltrabalhadoresMP7);

                            $rowMP7= mysqli_fetch_assoc($resultMP7);
                            $row7= mysqli_fetch_assoc($result7);

                            if ($rowMP7 && $row7) {
                                echo '<h1>' . $rowMP7['name'] . '</h1>';
                                $rowcountmp7 = mysqli_num_rows($result7);
                                echo "Estão " . $rowcountmp7. " trabalhadores no " . $rowMP7['MP_ID'];
                            } else {
                                echo '<h1>' . $rowMP7['name'] . '</h1>';
                                echo "Não há trabalhadores neste meeting point.";
                            }
                            ?>
                            <span class="material-symbols-sharp">engineering</span>
                        </label>
                        <br>
                        <br>
                        <button type="button" style="cursor: pointer;" name="cancelar" class="cancelar" data-dismiss="modal">Fechar</button>
                    </form>
                </div>
            </div>

            <!--------------------------------- END MODAL DETALHES ZONAS MP7   -------------------------------->

                <!--------------------------------- BEGIN MODAL EDITAR MP TABELA REGISTO OPERAÇÕES   -------------------------------->
                <div id="editModal" class="modal">
                    <div class="modal-content" style="text-align: center;">
                        <span class="close">&times;</span>
                        <?php
                        if (isset($_POST["worker_name"])) {
                            $workerName = $_POST["worker_name"];
                            echo '<h2>Editar Meeting Point de ' . $workerName . '</h2>';
                        } else {
                            echo '<h2>Editar Meeting Point</h2>';
                        }
                        ?>
                        <form id="editForm" method="POST">
                            <input type="hidden" id="editWorkerName" name="editWorkerName" value="">
                            <label for="editMp">Novo valor de MP:</label>
                            <input style="border: 1px solid black;" type="number" id="editMp" name="editMp" min="3" max="7" required>
                            <input type="submit" id="salvarMP" value="Salvar">
                        </form>
                    </div>
                </div>
                <!--------------------------------- END MODAL EDITAR MP TABELA REGISTO OPERAÇÕES   -------------------------------->
            <br>
            <a href="#registoperacao" class="topoo" style="font-size: 18px; color: var(--color-primary); ">VOLTAR AO TOPO^</a>
        </main>
        <div class="right" style="display: none;">
            <div class="topo">
                <button id="menu-btn-mobile" onclick="openNavMobile()">
                    <span class="material-symbols-sharp" >menu</span>
                </button >
            </div>
        </div>
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


        $(document).ready(function() {
            // Quando o link de edição for clicado
            $('.edit-link').on('click', function() {
                var workerName = $(this).data('worker-name');
                $('#editWorkerName').val(workerName);
                $('#editModal').find('h2').text('Editar Meeting Point de ' + workerName);
                $('#editModal').modal('show');
            });

            // Quando o formulário de edição for enviado
            $('#editForm').on('submit', function(e) {
                e.preventDefault(); // Impede o envio do formulário e o recarregamento da página

                var editMpValue = $('#editMp').val();
                if (editMpValue < 3 || editMpValue > 7) {
                    alert("O valor do MP deve estar entre 3 e 7.");
                    return false;
                }

                var workerName = $('#editWorkerName').val();
                var newMpValue = editMpValue;
                // Enviar uma requisição AJAX para atualizar o MP no servidor
                $.ajax({
                    url: 'update_mp.php',
                    method: 'POST',
                    data: { workerName: workerName, newMpValue: newMpValue },
                    success: function(response) {
                        if (response === "Success") {
                            updateMpValue(workerName, newMpValue); // Chamada para atualizar a linha com o novo valor
                            updateProgressBar(); // Chamada para atualizar a barra de progresso
                            alert("MP atualizado com sucesso!");
                            $('#editModal').modal('hide');
                        } else if (response === "Invalid MP value") {
                            alert("O valor do MP deve estar entre 3 e 7.");
                        } else {
                            alert("Ocorreu um erro ao atualizar o MP.");
                        }
                    },
                    error: function() {
                        alert("Ocorreu um erro ao atualizar o MP.");
                    }
                });
                return false;
            });

            // Função para atualizar os valores do MP na tabela
            function updateMpValue(workerName, newMpValue) {
                var $row = $('a.edit-link[data-worker-name="' + workerName + '"]').closest('tr');
                var $workerNameCell = $row.find('td:first-child a');
                var $workerCompanyCell = $row.find('td:nth-child(2)');
                var $typeCell = $row.find('td:nth-child(3)');
                var $mpCell = $row.find('td:nth-child(4)');
                var $rowClass = (newMpValue == 0) ? 'red-row' : 'green-row';
                var textColor = (newMpValue == 0) ? 'red' : 'green';
                $row.removeClass('red-row green-row').addClass($rowClass);
                $workerNameCell.css('color', textColor);
                $workerCompanyCell.css('color', textColor);
                $typeCell.css('color', textColor);
                $mpCell.text(newMpValue).css('color', textColor);
            }

            function updateProgressBar() {
                $.ajax({
                    url: 'update_progress.php', // Arquivo PHP que atualiza o valor da barra de progresso
                    type: 'GET',
                    success: function(response) {
                        var totalWorkers = response.totalWorkers;
                        var registeredWorkers = response.registeredWorkers;
                        var unregisteredWorkers = totalWorkers - registeredWorkers;
                        var progressPercentage = (registeredWorkers / totalWorkers) * 100;
                        $('#registeredWorkersCount').text(registeredWorkers);
                        $('#unregisteredWorkersCount').text(unregisteredWorkers);
                        $('#progressBar').val(registeredWorkers);
                        $('#progressBar').attr('max', totalWorkers);
                        $('#progressPercentage').text(progressPercentage.toFixed(2) + '%');
                    },
                    error: function() {
                        alert("Ocorreu um erro ao atualizar a barra de progresso.");
                    }
                });
            }

            // Chamar a função de atualização da barra de progresso inicialmente
            updateProgressBar();

                // Atualizar a barra de progresso a cada 5 segundos
                setInterval(updateProgress, 1000);


        });

        

    </script>

</body>

</html>