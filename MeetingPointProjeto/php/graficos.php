<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard-GVIR</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/cssdeteste.css">
    <script src="https://unpkg.com/dygraphs@2.2.1/dist/dygraph.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dygraphs@2.2.1/dist/dygraph.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" crossorigin="" />

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
            </div>
            <div class="sidebar" style="height: 88.7vh;">
                <a href="index3.php">
                <span class="material-symbols-sharp">distance</span>
                    <h3 id="dashboard">MONITORIZAÇÃO</h3>
                </a>
                <a href="graficos.php" class="active">
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
        <main>
            <h1 class="titulo">GVIR STATUS</h1>
            <div class="containerphp" style="height: 70vh; display: block;" >
                <?php if(isset($_SESSION['mensagem'])): ?>
                <p id="mensagem" style="color: var(--color-sucess); text-align: center; font-size: 16px;"><?php echo $_SESSION['mensagem']; ?></p>
                <?php endif; ?>
                <table class="tabelacrud" id="tabelacrud1" style="width: 50rem;">
                    <thead>
                        <tr style="background: #094b9b; color: white;">
                            <th>Threshold H1</th>
                            <th>Threshold H2</th>
                            <th>LoRa ID</th>
                            <th>Serial Number</th>
                            <th>Last Contact</th>
                            <th>Status</th>
                            <th>Gas Concentration</th>
                            <th>Sensor Temperature</th>
                            <th>Response Factor</th>
                            <th>Sensor Range</th>
                            <th>Cal 100</th>
                            <th>Cal 3000</th>
                            <th>Waiting Time</th>
                            <th>Threshold H3</th>
                        </tr>
                    </thead>
                    <form action="editarThreshold.php" method="POST">
                        <?php   
                            include('db_connection.php');
                            $sql = "SELECT * FROM `gvir_status` LIMIT 5";
                            $result = mysqli_query($connect, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td>
                                <input type="hidden" name="TH_update_id[]" value="<?php echo $row['input'] ?>">
                                <input type="number" name="threshold_h1[]" value="<?php echo $row['threshold_h1'] ?>">
                            </td>
                            <td><input type="number" name="threshold_h2[]" value="<?php echo $row['threshold_h2'] ?>"></td>
                            <td><?php echo $row['id']?></td>
                            <td><?php echo $row['serial_number']?></td>
                            <td><?php echo $row['datatime']?></td>
                            <td><?php echo $row['status']?></td>
                            <td><?php echo $row['gas_concentration']?></td>
                            <td><?php echo $row['temperature']?></td>
                            <td><?php echo $row['response_factor']?></td>
                            <td><?php echo $row['sensor_range']?></td>
                            <td><?php echo $row['cal_100']?></td>
                            <td><?php echo $row['cal_3000']?></td>
                            <td><?php echo $row['flag_status']?></td>
                            <td>Definido no autómato</td>
                        </tr>           
                        <?php
                            }   
                        ?>
                        <button type="submit" class="btn-add" name="editarTH" id="editarTH" style="display: block; margin-bottom: 10px;">Submit thresholds</button>
                    </form>
                </table>
                <form action="#" method="GET">
                    <button name="gerar-graficos" class="btn-add"  type="submit" id="gerar-graficos">Gerar Gráficos</button>    
                    <div id="graphdiv1"></div>
                    <script type="text/javascript">
                        Dygraph.onDOMready(function onDOMready() {
                            g = new Dygraph(
                                document.getElementById("graphdiv1"),
                                <?php
                                    $MyArray = include("gerar_graficos.php");
                                    for ($row = 0; $row < sizeof($MyArray); $row++) {
                                        echo '"'.$MyArray[$row]["label"] . ',' . $MyArray[$row]["y"] . '\n"';
                                        if($row != sizeof($MyArray)-1)
                                            echo "+";
                                    }
                                ?>
                            );
                        });
                    </script>
                </form>
                
            </div>
            
            <!--https://jsfiddle.net/tr2qcusa/-->
        </main>
        <!--Fim da main-->
    </div>
    <script src="../js/index3.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
    setTimeout(function() {
        <?php
        // Verifique se a mensagem está definida na sessão
        if(isset($_SESSION['mensagem'])) {
            // Exiba a mensagem
            echo 'document.getElementById("mensagem").style.display = "none";';
            // Limpe a mensagem da sessão
            unset($_SESSION['mensagem']);
        }
        ?>
    }, 2000); // Tempo em milissegundos (5 segundos)
</script>

</body>

</html>