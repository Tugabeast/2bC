<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MONITORIZACAO</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/cssdeteste.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="../css/monitorizacao.css">
    <script src="https://code.jquery.com/jquery-3.6.4.slim.js" integrity="sha256-dWvV84T6BhzO4vG6gWhsWVKVoa4lVmLnpBOZh/CAHU4=" crossorigin="anonymous"></script>
	<script src="../js/bootstrap.min.js"></script>
    <?php

session_start();

require('db_connection.php');

if ($_SESSION['logged'] != true) { //verificacao se tem login feito

  $_SESSION['erro'] = "Não tem sessão iniciada. Inicie sessão para continuar.";

  echo "<META HTTP-EQUIV=\"refresh\" content=\"2; URL=login.php\"> ";
} else {

  $nome = $_SESSION['nome'];

  $Serial_Number_Povoa = "032E280C4321000002";

  $Serial_Number_Aveiro = "018E22DC44F1000003";

  $queryPovoa = "SELECT VOUT_Measure,IOUT_Measure,UREF_ON_Measure,UREF_Config,Command_Mode,System,Alarm_TR,Alarm_Fuse_Positive,Alarm_Fuse_Negative, Alarm_Fuse_UREF, Alarm_UMAX, Alarm_IMAX, Alarm_UREF,Alarm_GPS,Time_Stamp FROM `UPR_Status` WHERE Serial_Number='$Serial_Number_Povoa' ORDER BY Input DESC LIMIT 1";

  $queryAveiro = "SELECT VOUT_Measure,IOUT_Measure,UREF_ON_Measure,UREF_Config,Command_Mode,System,Alarm_TR,Alarm_Fuse_Positive,Alarm_Fuse_Negative, Alarm_Fuse_UREF, Alarm_UMAX, Alarm_IMAX, Alarm_UREF,Alarm_GPS,Time_Stamp FROM `UPR_Status` WHERE Serial_Number='$Serial_Number_Aveiro' ORDER BY Input DESC LIMIT 1";

  $resultPovoa = mysqli_query($con, $queryPovoa) or die(mysqli_error($con));

  $resultAveiro = mysqli_query($con, $queryAveiro) or die(mysqli_error($con));

  $rowPovoa = mysqli_fetch_assoc($resultPovoa);

  $voutPovoa = number_format(($rowPovoa['VOUT_Measure'] / 1000), 2, '.', '');

  $ioutPovoa = number_format(($rowPovoa['IOUT_Measure'] / 1000), 2, '.', '');

  $urefPovoa = number_format(($rowPovoa['UREF_ON_Measure'] / 1000) * -1, 2, '.', '');

  $setPointPovoa = number_format(($rowPovoa['UREF_Config'] / 1000) * -1, 2, '.', '');

  $operationPovoa =  $rowPovoa['Command_Mode'];

  $pipePovoa = $rowPovoa['System'];

  $alarmTrPovoa = $rowPovoa['Alarm_TR'];

  $alarmFusePositivePovoa = $rowPovoa['Alarm_Fuse_Positive'];

  $alarmFuseNegativePovoa = $rowPovoa['Alarm_Fuse_Negative'];

  $alarmFuseUrefPovoa = $rowPovoa['Alarm_Fuse_UREF'];

  $alarmUmaxPovoa = $rowPovoa['Alarm_UMAX'];

  $alarmImaxPovoa = $rowPovoa['Alarm_IMAX'];

  $alarmUrefPovoa = $rowPovoa['Alarm_UREF'];

  $alarmGPSPovoa = $rowPovoa['Alarm_GPS'];

  $rowAveiro = mysqli_fetch_assoc($resultAveiro);

  $voutAveiro = number_format(($rowAveiro['VOUT_Measure'] / 1000), 2, '.', '');

  $ioutAveiro = number_format(($rowAveiro['IOUT_Measure'] / 1000), 2, '.', '');

  $urefAveiro = number_format(($rowAveiro['UREF_ON_Measure'] / 1000) * -1, 2, '.', '');

  $setPointAveiro = number_format(($rowAveiro['UREF_Config'] / 1000) * -1, 2, '.', '');

  $dataAveiro = $rowAveiro['Time_Stamp'];

  $dataPovoa = $rowPovoa['Time_Stamp'];

  $operationAveiro =  $rowAveiro['Command_Mode'];

  $pipeAveiro = $rowAveiro['System'];

  $alarmTrAveiro = $rowAveiro['Alarm_TR'];

  $alarmFusePositiveAveiro = $rowAveiro['Alarm_Fuse_Positive'];

  $alarmFuseNegativeAveiro = $rowAveiro['Alarm_Fuse_Negative'];

  $alarmFuseUrefAveiro = $rowAveiro['Alarm_Fuse_UREF'];

  $alarmUmaxAveiro = $rowAveiro['Alarm_UMAX'];

  $alarmImaxAveiro = $rowAveiro['Alarm_IMAX'];

  $alarmUrefAveiro = $rowAveiro['Alarm_UREF'];

  $alarmGPSAveiro = $rowAveiro['Alarm_GPS'];

  $srcOn = "imagens/on.png";

  $srcOff = "imagens/off.png";

  $srcDes = "imagens/des.png";

  $srcAmarelo = "imagens/amarelo.png";



?>


<style>
      #button {

        line-height: 12px;

        font-size: 8pt;

        margin-top: 1px;

        margin-right: 2px;

        position: absolute;

        top: 60px;

        right: 20px;

      }

      div#left:hover {

        cursor: hand;

        cursor: pointer;

        opacity: .9;

        text-decoration: underline;

      }

      div#right:hover {

        cursor: hand;

        cursor: pointer;

        opacity: .9;

        text-decoration: underline;

      }

      input[type=text]:hover {

        cursor: hand;

        cursor: pointer;



      }
    </style>

    <script>
      $(document).ready(function() {

        function online() {



          setInterval(function teste2() {

            $("#button2").trigger("click")

          }, 3000);

        };


        function repetir() {



          setInterval(function teste() {

            $("#button").trigger("click")

          }, 5000);

        };
        $("#button2").hide();
        $("#button2").click(function() {

          $.ajax({
            url: "online.php?local=ambos",
            success: function(data) {


            }
          });

        });

        $("#button").hide();

        $("#button").click(function() {

          $.ajax({
            url: "monotorizacaoUpdate.php",
            success: function(data) {

              //update valores visores e alarmes da Povoa

              var myObj = JSON.parse(data);

              $("#voutPovoa").val(myObj.voutPovoa);

              $("#urefPovoa").val(myObj.urefPovoa);

              $("#ioutPovoa").val(myObj.ioutPovoa);

              $("#setPointPovoa").val(myObj.setPointPovoa);

              $("#dataPovoa").val(myObj.dataPovoa);


              if (myObj.operationPovoa === 0) {

                //Local Povoa

                $("#operationPovoaLocal").attr("src", "imagens/on.png");

                $("#operationPovoaRemote").attr("src", "imagens/des.png");

              } else if (myObj.operationPovoa === 1) {

                //remote Povoa

                $("#operationPovoaLocal").attr("src", "imagens/des.png");

                $("#operationPovoaRemote").attr("src", "imagens/on.png");

              }

              if (myObj.pipePovoa === 0) {

                //Pipe Povoa OFF

                $("#pipePovoaOFF").attr("src", "imagens/off.png");

                $("#pipePovoaON").attr("src", "imagens/des.png");

              } else if (myObj.pipePovoa === 1) {

                //Pipe Povoa ON

                $("#pipePovoaOFF").attr("src", "imagens/des.png");

                $("#pipePovoaON").attr("src", "imagens/on.png");

              }



              if (myObj.alarmesPovoa === 1) {

                //alarmes Povoa ON

                $("#alarmPovoa").attr("src", "imagens/amarelo.png");

              } else if (myObj.alarmesPovoa === 0) {

                //alarmes Povoa OFF

                $("#alarmPovoa").attr("src", "imagens/des.png");

              }



              //update valores visores e alarmes de Aveiro

              $("#voutAveiro").val(myObj.voutAveiro);

              $("#urefAveiro").val(myObj.urefAveiro);

              $("#ioutAveiro").val(myObj.ioutAveiro);

              $("#setPointAveiro").val(myObj.setPointAveiro);

              $("#dataAveiro").val(myObj.dataAveiro);





              if (myObj.operationAveiro === 0) {

                //Local Aveiro

                $("#operationAveiroLocal").attr("src", "imagens/on.png");

                $("#operationAveiroRemote").attr("src", "imagens/des.png");

              } else if (myObj.operationAveiro === 1) {

                //remote Aveiro

                $("#operationAveiroLocal").attr("src", "imagens/des.png");

                $("#operationAveiroRemote").attr("src", "imagens/on.png");

              }

              if (myObj.pipeAveiro === 0) {

                //Pipe Aveiro OFF

                $("#pipeAveiroOFF").attr("src", "imagens/off.png");

                $("#pipeAveiroON").attr("src", "imagens/des.png");

              } else if (myObj.pipeAveiro === 1) {

                //Pipe Aveiro ON

                $("#pipeAveiroOFF").attr("src", "imagens/des.png");

                $("#pipeAveiroON").attr("src", "imagens/on.png");

              }



              if (myObj.alarmesAveiro === 1) {

                //alarmes Aveiro ON

                $("#alarmAveiro").attr("src", "imagens/amarelo.png");

              } else if (myObj.alarmesAveiro === 0) {

                //alarmes Aveiro OFF

                $("#alarmAveiro").attr("src", "imagens/des.png");

              }





            }
          });

        });


        online();
        repetir();



      });
    </script>


</head>

<body>

    <div class="container" id="container">

        <aside class="sidebar" id="mySidebar" style="left:0;margin-left:0;position:absolute">
            <div class="top" id="main" >
                <div class="menu">
                <h2 style="color:white; display: none;" id="nomeProjeto">PROCAT</h2>
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
              <a href="index.php" class="active">
              <span class="material-symbols-sharp">dashboard</span>
                  <h3 id="dashboard">Monitorização</h3>
              </a>
              <a href="mapa.php">
                  <span class="material-symbols-sharp">distance</span>
                  <h3 id="localizacao">Localização</h3>
              </a>
              <a href="graficos.php">
                  <span class="material-symbols-sharp">query_stats</span>
                  <h3 id="consulta">Consulta</h3>
              </a>
              <a href="historico.php">
                  <span class="material-symbols-sharp">history</span>
                  <h3 id="historico">Histórico</h3>
              </a>
              <a href="controlo.php">
                  <span class="material-symbols-sharp">toggle_on</span>
                  <h3 id="controlo">Controlo</h3>
              </a>
              <a href="settings.php">
                  <span class="material-symbols-sharp">manage_accounts</span>
                  <h3 id="profile">Gestão</h3>
              </a>
              <a href="logout.php" id="traco">
                  <span class="material-symbols-sharp">logout</span>
                  <h3 id="logout">LOGOUT</h3>
              </a>
            </div>
        </aside>
        <!-- fim da sidebar -->
        <main style="height:100%;top: 0;left:15%;position:absolute" >
            <h1 class="titulo">Monitorização</h1>

            <button id="button">.</button>
    <button id="button2">.</button>

    <div id="wrap" class="row">

      <div id="left" class="col-sm-6" style="border:3px solid #cecece;margin:2%;border-radius: 25px;" onclick="window.location = 'trpovoa.php'">

        <h3 align="center">Unidade de Polarização Catódica</h3>

        <h3 align="center"><b>UPC - PÓVOA</b></h3>

        <form>

          <div class="col-sm-6" align="center">

            <input type="text" id="voutPovoa" name="vout" value="<?php echo $voutPovoa; ?>" style="text-align:center; height:50px; width:100px; color:red;background-color:black;padding-bottom:0px;" disabled="disabled">

            <label for="vout" style="padding-top:0px;">VOUT</label>

          </div>



          <div class="col-sm-6" align="center">

            <input type="text" id="ioutPovoa" name="iout" value="<?php echo $ioutPovoa; ?>" style="text-align:center; height:50px; width:100px;color:red;background-color:black;" disabled="disabled">

            <label for="iout">IOUT</label>

          </div>



          <div class="col-sm-6" align="center">

            <input type="text" id="urefPovoa" name="uref" value="<?php echo $urefPovoa; ?>" style="text-align:center; height:50px; width:100px;color:red;background-color:black;" disabled="disabled">

            <label for="uref">UREF</label>

          </div>



          <div class="col-sm-6" align="center">

            <input type="text" id="setPointPovoa" name="setPoint" value="<?php echo $setPointPovoa; ?>" style="text-align:center; height:50px; width:100px;color:red;background-color:black;" disabled="disabled">

            <label for="setPoint">SetPoint</label>

          </div>

        </form>



        <h4 align="center">OPERATION</h4>

        <div align="center">

          <img class="img-responsive" id="operationPovoaLocal" src="<?php if ($operationPovoa == 0) {

                                                                      echo $srcOn;
                                                                    } else {

                                                                      echo $srcDes;
                                                                    } ?>" style="width:40px;height:40px">

          <p>Local</p>



        </div>

        <div align="center">

          <img class="img-responsive" id="operationPovoaRemote" src="<?php if ($operationPovoa == 1) {

                                                                        echo $srcOn;
                                                                      } else {

                                                                        echo $srcDes;
                                                                      } ?>" style="width:40px;height:40px">

          <p>Remote</p>



        </div>



        <h4 align="center">PIPE POLARIZATION</h4>

        <div align="center">

          <img class="img-responsive" id="pipePovoaOFF" src="<?php if ($pipePovoa == 0) {

                                                                echo $srcOff;
                                                              } else {

                                                                echo $srcDes;
                                                              } ?>"  style="width:40px;height:40px">

          <p>OFF</p>



        </div>

        <div align="center">

          <img class="img-responsive" id="pipePovoaON" src="<?php if ($pipePovoa == 1) {

                                                              echo $srcOn;
                                                            } else {

                                                              echo $srcDes;
                                                            } ?>" style="width:40px;height:40px">

          <p>ON</p>



        </div>



        <div align="center">

          <h4>ALARM</h4>

          <img class="img-responsive" id="alarmPovoa" src="<?php if ($alarmTrPovoa != 0 || $alarmFusePositivePovoa != 0 || $alarmFuseNegativePovoa != 0 || $alarmFuseUrefPovoa != 0 || $alarmUmaxPovoa != 0 || $alarmImaxPovoa != 0 || $alarmUrefPovoa != 0 || $alarmGPSPovoa != 0) {

                                                              echo $srcAmarelo;
                                                            } else {

                                                              echo $srcDes;
                                                            } ?>" style="width:40px;height:40px"><br><br>
          <p id="dataPovoa">Data: <?php echo $dataPovoa; ?></p>
        </div>

      </div>

      <div id="right" class="col-sm-6" style="border:3px solid #cecece; margin:2%;border-radius: 25px;" onclick="window.location = 'traveiro.php'">

        <h3 align="center">Unidade de Polarização Catódica</h3>

        <h3 align="center"><b>UPC - AVEIRO</b></h3>

        <form>

          <div class="col-sm-6" align="center">

            <input type="text" id="vout" name="vout" value="<?php echo $voutAveiro; ?>" style="text-align:center; height:50px; width:100px; color:red;background-color:black;" disabled="disabled">

            <label for="vout" style="padding-top:0px;">VOUT</label>

          </div>



          <div class="col-sm-6" align="center">

            <input type="text" id="uref" name="uref" value="<?php echo $ioutAveiro; ?>" style="text-align:center; height:50px; width:100px;color:red;background-color:black;" disabled="disabled">

            <label for="uref">IOUT</label>

          </div>



          <div class="col-sm-6" align="center">

            <input type="text" id="iout" name="iout" value="<?php echo $urefAveiro; ?>" style="text-align:center; height:50px; width:100px;color:red;background-color:black;" disabled="disabled">

            <label for="iout">UREF</label>

          </div>



          <div class="col-sm-6" align="center">

            <input type="text" id="setPoint" name="setPoint" value="<?php echo $setPointAveiro; ?>" style="text-align:center; height:50px; width:100px;color:red;background-color:black;" disabled="disabled">

            <label for="setPoint">SetPoint</label>

          </div>

        </form>



        <h4 align="center">OPERATION</h4>

        <div align="center">

          <img class="img-responsive" id="operationAveiroLocal" src="<?php if ($operationAveiro == 0) {

                                                                        echo $srcOn;
                                                                      } else {

                                                                        echo $srcDes;
                                                                      } ?>" style="width:40px;height:40px">

          <p>Local</p>



        </div>

        <div align="center">

          <img class="img-responsive" id="operationAveiroRemote" src="<?php if ($operationAveiro == 1) {

                                                                        echo $srcOn;
                                                                      } else {

                                                                        echo $srcDes;
                                                                      } ?>" style="width:40px;height:40px">

          <p>Remote</p>



        </div>



        <h4 align="center"><?php echo "PIPE POLARIZATION"; ?></h4>

        <div align="center">



          <img class="img-responsive" id="pipeAveiroOFF" src="<?php if ($pipeAveiro == 0) {

                                                                echo $srcOff;
                                                              } else {

                                                                echo $srcDes;
                                                              } ?>" style="width:40px;height:40px">

          <p>OFF</p>



        </div>

        <div align="center">

          <img class="img-responsive" id="pipeAveiroON" src="<?php if ($pipeAveiro == 1) {

                                                                echo $srcOn;
                                                              } else {

                                                                echo $srcDes;
                                                              } ?>" style="width:40px;height:40px">

          <p>ON</p>



        </div>

        <div align="center">

          <h4>ALARM</h4>

          <img class="img-responsive" id="alarmAveiro" src="<?php if ($alarmTrAveiro != 0 || $alarmFusePositiveAveiro != 0 || $alarmFuseNegativeAveiro != 0 || $alarmFuseUrefAveiro != 0 || $alarmUmaxAveiro != 0 || $alarmImaxAveiro != 0 || $alarmUrefAveiro != 0 || $alarmGPSAveiro != 0) {

                                                              echo $srcAmarelo;
                                                            } else {

                                                              echo $srcDes;
                                                            } ?>" style="width:40px;height:40px"><br><br>
          <p id="dataAveiro">Data: <?php echo $dataAveiro; ?></p>
        </div>

      </div>

    </div>

	</main>
	<!--Fim da main-->

    </div>



    <script src="../js/index3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>

</html>
<?php } ?>