<?php

session_start();

require('db_connection.php');



if ($_SESSION['logged'] != true) { //verificacao se tem login feito

  $_SESSION['erro'] = "Não tem sessão iniciada. Inicie sessão para continuar.";

  echo "<META HTTP-EQUIV=\"refresh\" content=\"2; URL=login.php\"> ";
} else {

  $nome = $_SESSION['nome'];



  $Serial_Number_Povoa = "032E280C4321000002";

  $date = date('Y-m-d H:i:s');
  $month = date("n", strtotime($date));
  $year = date("o", strtotime($date));

  $lastHour =  date('Y-m-d H:i:s', strtotime('1 hour'));



  $queryPovoa = "SELECT VOUT_Measure,IOUT_Measure,UREF_ON_Measure,UREF_ON_Measure,UREF_OFF_Measure,Time_Stamp,UMAX_Config, IMAX_Config,UREF_Config,System,Command_Mode,Operation_Mode,Operation_Type,Alarm_TR,Alarm_Fuse_Positive,Alarm_Fuse_Negative, Alarm_Fuse_UREF, Alarm_UMAX, Alarm_IMAX, Alarm_UREF,Alarm_GPS, RSSI, BER  FROM `UPR_Status` WHERE Serial_Number='$Serial_Number_Povoa' ORDER BY Input DESC LIMIT 1";

  $queryPovoaTrafego = "SELECT SUM(TRAFFIC) AS valor FROM `UPR_Status` WHERE Serial_Number='$Serial_Number_Povoa' AND Month='$month' AND Year='$year'";

  $queryPovoaTrafegoTotal = "SELECT MB_MAX,sim_card_number FROM `ProCat_ID` WHERE Serial_Number='$Serial_Number_Povoa'";

  $resultPovoa3 = mysqli_query($con, $queryPovoaTrafegoTotal) or die(mysqli_error($con));

  $resultPovoa2 = mysqli_query($con, $queryPovoaTrafego) or die(mysqli_error($con));

  $resultPovoa = mysqli_query($con, $queryPovoa) or die(mysqli_error($con));

  $rowPovoa = mysqli_fetch_assoc($resultPovoa);

  $rowPovoa2 = mysqli_fetch_assoc($resultPovoa2);

  $rowPovoa3 = mysqli_fetch_assoc($resultPovoa3);

  $trafegoPovoa = number_format(($rowPovoa2['valor'] / 1048576), 2, '.', '');

  $trafegoTotal = $rowPovoa3['MB_MAX'];

  $telefone = $rowPovoa3['sim_card_number'];

  $registo = $rowPovoa['Time_Stamp'];

  $percentagemRoda = (100 * $trafegoPovoa) / $trafegoTotal;

  $pipePovoa = $rowPovoa['System'];

  $commandPovoa =  $rowPovoa['Command_Mode'];

  $operationModePovoa =  $rowPovoa['Operation_Mode'];

  $operationTypePovoa =  $rowPovoa['Operation_Type'];

  $umaxPovoa = $rowPovoa['UMAX_Config'] / 1000;

  $imaxPovoa = $rowPovoa['IMAX_Config'] / 1000;

  $urefPovoa = $rowPovoa['UREF_Config'] / 1000;

  $sinal = $rowPovoa['RSSI'];

  $ber = $rowPovoa['BER'];

  $uoutPovoa = number_format(($rowPovoa['VOUT_Measure'] / 1000), 2, '.', '');

  $ioutPovoaMeasure = number_format(($rowPovoa['IOUT_Measure'] / 1000), 2, '.', '');

  $urefOnPovoaMeasure = number_format(($rowPovoa['UREF_ON_Measure'] / 1000), 2, '.', '');

  $ureOffPovoaMeasure = number_format(($rowPovoa['UREF_OFF_Measure'] / 1000), 2, '.', '');

  //Alarmes

  $alarmTrPovoa = $rowPovoa['Alarm_TR'];

  $alarmFusePositivePovoa = $rowPovoa['Alarm_Fuse_Positive'];

  $alarmFuseNegativePovoa = $rowPovoa['Alarm_Fuse_Negative'];

  $alarmFuseUrefPovoa = $rowPovoa['Alarm_Fuse_UREF'];

  $alarmUmaxPovoa = $rowPovoa['Alarm_UMAX'];

  $alarmImaxPovoa = $rowPovoa['Alarm_IMAX'];

  $alarmUrefPovoa = $rowPovoa['Alarm_UREF'];

  $alarmGPSPovoa = $rowPovoa['Alarm_GPS'];

  $urefMin = ($rowPovoa['UREF_Config'] * 0.75) / 1000;

  $urefMax = ($rowPovoa['UREF_Config'] * 1.25) / 1000;



  $srcOn = "imagens/on.png";

  $srcOff = "imagens/off.png";

  $srcDes = "imagens/des.png";



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPC PÓVOA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/cssdeteste.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

<link rel="stylesheet" href="../css/jquery.circliful.css">

<link rel="stylesheet" href="../vendor/animate/animate.css">

<link rel="stylesheet" href="../vendor/select2/select2.min.css">

<link rel="stylesheet" href="../vendor/perfect-scrollbar/perfect-scrollbar.css">

<link rel="stylesheet" href="../css/util.css">

<link rel="stylesheet" href="../css/main.css">

<link rel="stylesheet" src="../css/dygraph.css">

<!--Grafico-->

<script src="../js/jquery-3.2.1.min.js"></script>

<!--<script src="../js/bootstrap.min.js"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>

<script src="../js/circle-chart.js"></script>

<script src="../js/jquery.circliful.min.js"></script>

<script src="../js/dygraph.js"></script>
<!--Grafico-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>

    <style>
      .chip {
        display: inline-block;
        padding: 0 25px;
        height: 50px;
        font-size: 16px;
        line-height: 50px;
        border-radius: 25px;
        background-color: #f1f1f1;
      }

      .chip img {
        float: left;
        margin: 0 10px 0 -25px;
        height: 50px;
        width: 50px;
        border-radius: 50%;
      }

      .progress {
        height: 35px;
      }

      .progress .skill {
        font: normal 12px "Open Sans Web";
        line-height: 35px;
        padding: 0;
        margin: 0 0 0 20px;
      }

      .progress .skill .val {
        float: right;
        font-style: normal;
        margin: 0 20px 0 0;
      }

      .progress-bar {
        text-align: left;
        transition-duration: 3s;
      }

      .trafego>#valor {
        display: inline;
      }

      .trafego>#ultimo_registo {
        display: inline;
      }

      .trafego>#telefone {
        display: inline;
      }

      #alarmes>div {
        margin-top: 10px;
        margin-right: 10px;
        margin-top: 10px;
        margin-bottom: 10px;
      }

      table>#circulo {
        text-align: left;
        width: 15%;
      }

      table>#circulo1 {
        text-align: right;
        width: 15%;
      }

      .circle-badge {
        height: 100px;
        width: 100px;
        line-height: 100px;
        border-radius: 50px;
        color: white;
        text-align: center;
      }

      .circulo {
        width: 100px;
        position: relative;
      }

      .circle-chart__text {
        position: absolute;
        width: 100%;
        height: 100%;
        text-align: center;
        left: 0;
        top: 0;
        line-height: 4;
        font-family: sans-serif;
      }

      #button {

        line-height: 12px;

        font-size: 8pt;

        margin-top: 1px;

        margin-right: 2px;

        position: absolute;

        top: 60px;

        right: 20px;

      }

      #button2 {

        line-height: 12px;

        font-size: 8pt;

        margin-top: 1px;

        margin-right: 2px;

        position: absolute;

        top: 60px;

        right: 20px;

      }
    </style>
    
    <script>
      $(document).ready(function() {

        var el = document.querySelector('.circle-chart');
        new CircleChart(el, {
          minVal: 0,
          maxVal: 24
        });
        var el2 = document.querySelector('.circle-chart2');
        new CircleChart(el2, {
          minVal: 0,
          maxVal: 5
        });
        var el3 = document.querySelector('.circle-chart3');
        new CircleChart(el3, {
          minVal: <?php echo $urefMin; ?>,
          maxVal: <?php echo $urefMax; ?>
        })

        $('.progress .progress-bar').css("width", function() {
          var numero = $(this).attr("aria-valuenow");
          if (numero >= 0 && numero <= 69) {
            $(this).css({
              "background-color": "green",
            });
            $(this).css({
              "color": "black",
            });
            return $(this).attr("aria-valuenow") + "%";
          } else if (numero >= 70 && numero <= 84) {
            $(this).css({
              "background-color": "yellow",
            });
            return $(this).attr("aria-valuenow") + "%";
          } else if (numero >= 85 && numero <= 100) {
            $(this).css({
              "background-color": "red",
            });
            return $(this).attr("aria-valuenow") + "%";
          }
        })


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
            url: "online.php?local=povoa",
            success: function(data) {


            }
          });

        });

        $("#button").hide();

        $("#button").click(function() {

          $.ajax({
            url: "trpovoaUpdate.php",
            success: function(data) {

              var myObj = JSON.parse(data);

              if (myObj.alarmFusePositivePovoa === 0) {

                $("#alarmFusePositivePovoa").attr("src", "imagens/des.png");

              } else if (myObj.alarmFusePositivePovoa === 1) {

                $("#alarmFusePositivePovoa").attr("src", "imagens/on.png");

              }

              if (myObj.alarmFuseNegativePovoa === 0) {

                $("#alarmFuseNegativePovoa").attr("src", "imagens/des.png");

              } else if (myObj.alarmFuseNegativePovoa === 1) {

                $("#alarmFuseNegativePovoa").attr("src", "imagens/on.png");

              }

              if (myObj.alarmFuseUrefPovoa === 0) {

                $("#alarmFuseUrefPovoa").attr("src", "imagens/des.png");

              } else if (myObj.alarmFuseUrefPovoa === 1) {

                $("#alarmFuseUrefPovoa").attr("src", "imagens/on.png");

              }

              if (myObj.alarmUmaxPovoa === 0) {

                $("#alarmUmaxPovoa").attr("src", "imagens/des.png");

              } else if (myObj.alarmUmaxPovoa === 1) {

                $("#alarmUmaxPovoa").attr("src", "imagens/on.png");

              }

              if (myObj.alarmImaxPovoa === 0) {

                $("#alarmImaxPovoa").attr("src", "imagens/des.png");

              } else if (myObj.alarmImaxPovoa === 1) {

                $("#alarmUmaxIveiro").attr("src", "imagens/on.png");

              }

              if (myObj.alarmTrPovoa === 0) {

                $("#alarmTrPovoa").attr("src", "imagens/des.png");

              } else if (myObj.alarmTrPovoa === 1) {

                $("#alarmTrPovoa").attr("src", "imagens/on.png");

              }

              if (myObj.alarmUrefPovoa === 0) {

                $("#alarmUrefPovoa").attr("src", "imagens/des.png");

              } else if (myObj.alarmUrefPovoa === 1) {

                $("#alarmGPSPovoa").attr("src", "imagens/on.png");

              }

              if (myObj.alarmFuseUrefPovoa === 0) {

                $("#alarmGPSPovoa").attr("src", "imagens/des.png");

              } else if (myObj.alarmGPSPovoa === 1) {

                $("#alarmGPSPovoa").attr("src", "imagens/on.png");

              }

              if (myObj.pipePovoa === 0) {

                //Desligado Povoa

                $("#ligadoPovoa").attr("src", "imagens/des.png");

                $("#desligadoPovoa").attr("src", "imagens/on.png");

              } else if (myObj.pipePovoa === 1) {

                //ligado Povoa

                $("#ligadoPovoa").attr("src", "imagens/on.png");

                $("#desligadoPovoa").attr("src", "imagens/des.png");

              }

              if (myObj.commandPovoa === 0) {

                //local Povoa

                $("#locaPovoa").attr("src", "imagens/on.png");

                $("#remotoPovoa").attr("src", "imagens/des.png");

              } else if (myObj.commandPovoa === 1) {

                //remoto Povoa

                $("#localPovoa").attr("src", "imagens/des.png");

                $("#remotoPovoa").attr("src", "imagens/on.png");

              }

              if (myObj.operationModePovoa === 0) {

                //Iout Constante Povoa

                $("#urefConstantePovoa").attr("src", "imagens/des.png");

                $("#ioutConstantePovoa").attr("src", "imagens/on.png");

              } else if (myObj.operationModePovoa === 1) {

                //Uref Constante Povoa

                $("#urefConstantePovoa").attr("src", "imagens/on.png");

                $("#ioutConstantePovoa").attr("src", "imagens/des.png");

              }

              if (myObj.operationTypePovoa === 0) {

                //normal Povoa

                $("#normalPovoa").attr("src", "imagens/on.png");

                $("#manutencaoPovoa").attr("src", "imagens/des.png");

              } else if (myObj.operationTypePovoa === 1) {

                //manutencao Povoa

                $("#normalPovoa").attr("src", "imagens/des.png");

                $("#manutencaoPovoa").attr("src", "imagens/on.png");

              }



              $("#urefPovoa").val(myObj.urefPovoa);

              $("#valor").html('<b>Valor: </b>' + myObj.trafegoPovoa + ' MB de ' + myObj.trafegoTotal + ' MB<br>');

              $("#telefone").html('<b>Número Telefone: </b>' + myObj.telefone);

              $("#sinal").html('<b>Sinal: </b>' + myObj.sinal + ' dbm | <b>BER: </b>' + myObj.ber);

              $("#ultimoRegisto").html('<b>Último Registo: </b>' + myObj.ultimoRegisto);

              $("#percentagem").attr("aria-valuenow", myObj.percentagem);

              $("#uoutPovoa").html('<strong><font size="6" text-align="center">' + myObj.uoutPovoa + 'V </font></strong>');

              $("#ioutPovoa").html('<strong><font size="6" text-align="center">' + myObj.ioutPovoa + 'A </font></strong>');

              $("#urefOnPovoa").html('<strong><font size="6" text-align="center"> -' + myObj.urefOnPovoa + 'V </font></strong>');

              $("#urefOffPovoa").html('<strong><font size="6" text-align="center"> -' + myObj.urefOffPovoa + 'V </font></strong>');

              g1.updateOptions(

                {

                  'file': "https://procat.cires2biot.pt/v1/buscarDadosDia.php?valor=VOUT_Measure&serial=povoa"





                }

              );

              g2.updateOptions(

                {

                  'file': "https://procat.cires2biot.pt/v1/buscarDadosDia.php?valor=IOUT_Measure&serial=povoa"





                }

              );

              g3.updateOptions(

                {

                  'file': "https://procat.cires2biot.pt/v1/buscarDadosDia.php?valor=UREF_ON_Measure&serial=povoa"





                }

              );

              g4.updateOptions(

                {

                  'file': "https://procat.cires2biot.pt/v1/buscarDadosDia.php?valor=UREF_OFF_Measure&serial=povoa"





                }

              );













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

        <aside class="sidebar" id="mySidebar">
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
        <main >
            <h1 class="titulo">Monitorização</h1>

            <button id="button">.</button>
    <button id="button2">.</button>

    <div class="container" style="margin-top:50px">

      

      <br>

      <h3>

        <p align="center">UPC Póvoa | <a href="traveiro.php" class="btn btn-primary" role="button">UPC Aveiro</a></p>

      </h3>

    </div>

    <br>

    <div class="row" style="pointer-events: none;">

      <!--Tabela-->
      <!--Operação-->

      <div class="col-sm-6">

        <h3 align="center">Operação</h3>

        <br>

        <table class="table table-hover">

          <tbody>

            <tr>

              <td>Ligado</td>

              <td><img class="img-responsive" id="ligadoPovoa" src="<?php if ($pipePovoa == 1) {

                                                                      echo $srcOn;
                                                                    } else {

                                                                      echo $srcDes;
                                                                    } ?>" width="40" height="5"></td>

              <td>Desligado</td>

              <td><img class="img-responsive" id="desligadoPovoa" src="<?php if ($pipePovoa == 0) {

                                                                          echo $srcOff;
                                                                        } else {

                                                                          echo $srcDes;
                                                                        } ?>" width="40" height="5"></td>

            </tr>

            <tr>

              <td>Local</td>

              <td><img class="img-responsive" id="localPovoa" src="<?php if ($commandPovoa == 0) {

                                                                      echo $srcOn;
                                                                    } else {

                                                                      echo $srcDes;
                                                                    } ?>" width="40" height="5"></td>

              <td>Remoto</td>

              <td><img class="img-responsive" id="remotoPovoa" src="<?php if ($commandPovoa == 1) {

                                                                      echo $srcOn;
                                                                    } else {

                                                                      echo $srcDes;
                                                                    } ?>" width="40" height="5"></td>

            </tr>

            <tr>

              <td>Uref Constante</td>

              <td><img class="img-responsive" id="urefConstantePovoa" src="<?php if ($operationModePovoa == 1) {

                                                                              echo $srcOn;
                                                                            } else {

                                                                              echo $srcDes;
                                                                            } ?>" width="40" height="5"></td>

              <td>Iout Constante</td>

              <td><img class="img-responsive" id="ioutConstantePovoa" src="<?php if ($operationModePovoa == 0) {

                                                                              echo $srcOn;
                                                                            } else {

                                                                              echo $srcDes;
                                                                            } ?>" width="40" height="5"></td>

            </tr>

            <tr>

              <td>Normal</td>

              <td><img class="img-responsive" id="normalPovoa" src="<?php if ($operationTypePovoa == 0) {

                                                                      echo $srcOn;
                                                                    } else {

                                                                      echo $srcDes;
                                                                    } ?>" width="40" height="5"></td>

              <td>Manutenção</td>

              <td><img class="img-responsive" id="manutencaoPovoa" src="<?php if ($operationTypePovoa == 1) {

                                                                          echo $srcOn;
                                                                        } else {

                                                                          echo $srcDes;
                                                                        } ?>" width="40" height="5"></td>

            </tr>

          </tbody>

        </table>

        <br><br>

      </div>

      <!--div operação-->
      <!--Alarmes-->

      <div class="col-sm-6">

        <h3 align="center">Alarmes</h3>

        <br>

        <table class="table table-hover">

          <tbody>

            <tr>

              <td>TR Failure</td>

              <td><img class="img-responsive" id="alarmTrPovoa" src="<?php if ($alarmTrPovoa == 1) {

                                                                        echo $srcOff;
                                                                      } else {

                                                                        echo $srcDes;
                                                                      } ?>" width="40" height="5"></td>

              <td>GPS</td>

              <td><img class="img-responsive" id="alarmGPSPovoa" src="<?php if ($alarmGPSPovoa == 1) {

                                                                        echo $srcOff;
                                                                      } else {

                                                                        echo $srcDes;
                                                                      } ?>" width="40" height="5"></td>

            </tr>

            <tr>

              <td>Umax</td>

              <td><img class="img-responsive" id="alarmUmaxPovoa" src="<?php if ($alarmUmaxPovoa == 1) {

                                                                          echo $srcOff;
                                                                        } else {

                                                                          echo $srcDes;
                                                                        } ?>" width="40" height="5"></td>

              <td>Fuse Vout+</td>

              <td><img class="img-responsive" id="alarmFusePositivePovoa" src="<?php if ($alarmFusePositivePovoa == 1) {

                                                                                  echo $srcOff;
                                                                                } else {

                                                                                  echo $srcDes;
                                                                                } ?>" width="40" height="5"></td>

            </tr>

            <tr>

              <td>Imax</td>

              <td><img class="img-responsive" id="alarmImaxPovoa" src="<?php if ($alarmImaxPovoa == 1) {

                                                                          echo $srcOff;
                                                                        } else {

                                                                          echo $srcDes;
                                                                        } ?>" width="40" height="5"></td>

              <td>Fuse Vout-</td>

              <td><img class="img-responsive" id="alarmFuseNegativePovoa" src="<?php if ($alarmFuseNegativePovoa == 1) {

                                                                                  echo $srcOff;
                                                                                } else {

                                                                                  echo $srcDes;
                                                                                } ?>" width="40" height="5"></td>

            </tr>

            <tr>

              <td>Uref</td>

              <td><img class="img-responsive" id="alarmUrefPovoa" src="<?php if ($alarmUrefPovoa == 1) {

                                                                          echo $srcOff;
                                                                        } else {

                                                                          echo $srcDes;
                                                                        } ?>" width="40" height="5"></td>

              <td>Fuse Uref</td>

              <td><img class="img-responsive" id="alarmFuseUrefPovoa" src="<?php if ($alarmFuseUrefPovoa == 1) {

                                                                              echo $srcOff;
                                                                            } else {

                                                                              echo $srcDes;
                                                                            } ?>" width="40" height="5"></td>

            </tr>

          </tbody>

        </table>

        <br><br>

      </div>

      <!--Div Alarmes-->
      <!--Config-->

      <div class="col-sm-6">

        <br>

        <h3 align="center">Configuração</h3>

        <br>

        <div class="col-md-2" align="center">

          <table class="table">

            <tbody>

              <tr>

                <div class=".circle-chart__text" align="center"><b>Umax(V)</b></div>

                <br>

                <div class="circle-chart circulo" id="umaxPovoa"> <?php echo $umaxPovoa; ?> </div>

              </tr>

            </tbody>

          </table>

        </div>

        <div class="col-md-2" align="center">

          <table class="table">

            <tbody>

              <tr>

                <div class=".circle-chart__text" align="center"></div>

                <br>



              </tr>

            </tbody>

          </table>

        </div>

        <div class="col-md-2" align="center">

          <table class="table">

            <tbody>

              <tr>

                <div class=".circle-chart__text" align="center"><b>Imax(A)</b></div>

                <br>

                <div class="circle-chart2 circulo" id=imaxPovoa> <?php echo $imaxPovoa; ?> </div>

              </tr>

            </tbody>

          </table>

        </div>

        <div class="col-md-2" align="center">

          <table class="table">

            <tbody>

              <tr>

                <div class=".circle-chart__text" align="center"></div>

                <br>



              </tr>

            </tbody>

          </table>

        </div>

        <div class="col-md-2" align="center">

          <table class="table">

            <tbody>

              <tr>

                <div class=".circle-chart__text" align="center"><b>Uref(V)</b></div>

                <br>

                <div class="circle-chart3 circulo" id="urefPovoa"> <?php echo $urefPovoa; ?> </div>

              </tr>

            </tbody>

          </table>

        </div>





        <br><br>

      </div>

      <!--Div config-->
      <!--Trafego-->

      <div class="col-sm-6">

        <br>

        <h3 align="center">Consumo (MB)</h3>

        <br>

        <div>

          <div>

            <div class="progress skill-bar ">

              <div class="progress-bar progress-bar-success" id="percentagem" role="progressbar" aria-valuenow="<?php echo $percentagemRoda; ?>" aria-valuemin="0" aria-valuemax="100"> <span class="skill"> </span> </div>

            </div>

          </div>

        </div>

        <div class="trafego">

          <!--Trafego 2-->

          <div id="valor"> <b>Valor:</b> <?php echo $trafegoPovoa; ?> MB de <?php echo $trafegoTotal; ?> MB </br> </div>

          <div id="telefone"> <b>Número Telefone:</b> <?php echo $telefone; ?> </br> </div>

          <div id="sinal"> <b> Sinal:</b> <?php echo $sinal; ?> dbm | <b>BER: </b> <?php echo $ber; ?></div>

          <div id="ultimoRegisto"> <b>Último Registo:</b> <?php if ($registo > $lastHour) {
                                                            echo '<span style="color:red;"> ' . $registo . '</span>';
                                                          } else {
                                                            echo '<span style="color:green;"> ' . $registo . '</span>';
                                                          }; ?> </br> </div>

        </div>

        <!--Div trafego 2--> <br><br>

      </div>

      <!--Div trafego -->

    </div>

    <div class="row" style="pointer-events: none;">

      <h3 align="center">Parametros Elétricos</h3>

      <br><br>
      <!--Graficos Eletricos-->

      <div class="col-sm-3">

        <div class=".circle-chart__text" align="center"><b>UOUT</b></div>

        <br>

        <div class="circle-badge" style="background:#56B7D6" id="uoutPovoa"><strong>
            <font size="6" text-align="center"><?php echo $uoutPovoa; ?>V</font>
          </strong></div>

        <div id="graphdiv1" style="width:300px; height:150px;"></div>

        <br><br><br><br>
        <script>
          g1 = new Dygraph(document.getElementById("graphdiv1"), "https://procat.cires2biot.pt/v1/buscarDadosDia.php?valor=VOUT_Measure&serial=povoa", {
            labels: ["data", "uout"],



            drawGapEdgePoints: true,

            valueRange: [0, 22]

          });
        </script>

      </div>

      <div class="col-sm-3">

        <div class=".circle-chart__text" align="center"><b>IOUT</b></div>

        <br>

        <div class="circle-badge" style="background:#56B7D6" id="ioutPovoa"><strong>
            <font size="6" text-align="center"><?php echo $ioutPovoaMeasure; ?>A</font>
          </strong></div>

        <div id="graphdiv2" style="width:300px; height:150px;"></div>

        <br><br><br><br>
        <script>
          g2 = new Dygraph(document.getElementById("graphdiv2"), "https://procat.cires2biot.pt/v1/buscarDadosDia.php?valor=IOUT_Measure&serial=povoa", {
            labels: ["data", "iout"],



            drawGapEdgePoints: true,

            valueRange: [0, 5.5]

          });
        </script>

      </div>

      <div class="col-sm-3">

        <div class=".circle-chart__text" align="center"><b>UREF ON</b></div>

        <br>

        <div class="circle-badge" style="background:#56B7D6" id="urefOnPovoa"><strong>
            <font size="6" text-align="center"><?php echo $urefOnPovoaMeasure * -1; ?>V</font>
          </strong></div>

        <div id="graphdiv3" style="width:300px; height:150px;"></div>

        <br><br><br><br>
        <script>
          g3 = new Dygraph(document.getElementById("graphdiv3"), "https://procat.cires2biot.pt/v1/buscarDadosDia.php?valor=UREF_ON_Measure&serial=povoa", {
            labels: ["data", "uref on"],



            drawGapEdgePoints: true,

            valueRange: [0, 5.5]

          });
        </script>

      </div>

      <div class="col-sm-3">

        <div class=".circle-chart__text" align="center"><b>UREF OFF</b></div>

        <br>

        <div class="circle-badge" align="center" style="background:#56B7D6" id="urefOffPovoa"><strong>
            <font size="6"><?php echo $ureOffPovoaMeasure * -1; ?>V</font>
          </strong></div>

        <div id="graphdiv4" style="width:300px; height:150px;"></div>

        <br><br><br><br>
        <script>
          g4 = new Dygraph(document.getElementById("graphdiv4"), "https://procat.cires2biot.pt/v1/buscarDadosDia.php?valor=UREF_OFF_Measure&serial=povoa", {
            labels: ["data", "uref off"],



            drawGapEdgePoints: true,

            valueRange: [0, 5.5]

          });
        </script>

      </div>

      <br><br><br>

    </div>

    <!--Div GE-->
    </div>
    <!--Div tabela-->

        </main>
        <!--Fim da main-->

    </div>


    <script src="../js/circulo.js"></script>
    <script src="../js/index3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>

</html>
<?php } ?>