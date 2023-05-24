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
            <div class="containerphp" style="height: 70vh;">
                <div class="table-wraper" style="overflow-y: hidden; max-height: max-content; width: fit-content; margin-right: 20px;">
                    <table class="tabelacrud" id="tabelacrud1" style="width: 50rem; ">
                        <tr style="background: #094b9b; color: white;">
                            <th>Property</th>
                            <th>Value</th>
                        </tr>
                        <?php   
                            include('db_connection.php');
                            $sql = "SELECT * FROM `gvir_status` Where input=2 ";
                            $result = mysqli_query($connect, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <form action="editarThreshold.php" method="post">
                                    <input type="hidden" id="thedit_id" name="thedit_id">
                                    <tr>
                                        <td>LoRa ID</td>
                                        <td><?php echo $row['id']?></td>
                                    </tr>
                                    <tr>
                                        <td>Serial Number</td>
                                        <td><?php echo $row['serial_number']?></td>
                                    </tr>
                                    <tr>
                                        <td>Last Contact</td>
                                        <td><?php echo $row['datatime']?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td><?php echo $row['status']?></td>
                                    </tr>
                                    <tr>
                                        <td>Gas Concentration</td>
                                        <td><?php echo $row['gas_concentration']?></td>
                                    </tr>
                                    <tr>
                                        <td>Sensor Temperature</td>
                                        <td><?php echo $row['temperature']?></td>
                                    </tr>
                                    <tr>
                                        <td>Response Factor</td>
                                        <td><?php echo $row['response_factor']?></td>
                                    </tr>
                                    <tr>
                                        <td>Sensor Range</td>
                                        <td><?php echo $row['sensor_range']?></td>
                                    </tr>
                                    <tr>
                                        <td>Cal 100</td>
                                        <td><?php echo $row['cal_100']?></td>
                                    </tr>
                                    <tr>
                                        <td>Cal 3000</td>
                                        <td><?php echo $row['cal_3000']?></td>
                                    </tr>
                                    <tr>
                                        <td>Waiting Time</td>
                                        <td><?php echo $row['flag_status']?></td>
                                    </tr>
                                    <tr>
                                        <td>Threshold H1 (ppm)</td>
                                        <td><input type="number" name="threshold_h1" id="threshold_h1" value="<?php echo $row['threshold_h1']?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Threshold H2 (ppm)</td>
                                        <td><input type="number" name="threshold_h2" id="threshold_h2" value="<?php echo $row['threshold_h2']?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Threshold H3 </td>
                                        <td>Definido no autómato</td>
                                    </tr>
                                </form>    
                                <?php
                            }   
                        ?>
                    </table>
                </div>
                <div id="graphdiv3" style="width: 60rem; margin-right: 2rem; margin-top: 4rem;"></div>
                <script type="text/javascript">
                    Dygraph.onDOMready(function onDOMready() {
                        g2 = new Dygraph(
                            document.getElementById("graphdiv3"),
                            "../js/temperatures.csv", // path to CSV file
                        );
                    });
                </script>
            </div>
            <button type="submit" class="btn-add" name="editarTH" style="display: flex; margin-left: 20rem;" >Sumbit thresholds</button>
            <!--https://jsfiddle.net/tr2qcusa/-->
        </main>
        <!--Fim da main-->
    </div>
    <script src="../js/index3.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
            $(document).ready(function() {
            
            $('.btn-add').on('click', function(e){
                

                $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();

                console.log(data);

                $('#thedit_id').val(data[0]);
                $('#threshold_h1').val(data[1]);
                $('#threshold_h2').val(data[2]);
            });
        });
    </script>
</body>

</html>