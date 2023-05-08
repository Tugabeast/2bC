<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAPA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/cssdeteste.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    
    <!-- Leaflet CSS and script -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
          crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
            crossorigin=""></script>

            <style>
         .mobile {
                   display: none;
               }

               @media only screen and (max-device-width: 650px) {
                      .mobile{display: block; }
                      .desktop {display: none;}
                  }

			#mapid { height: 500px; width: 1150px; margin: auto;}
            #mapidmobile { height: 350px; width: 350px; margin: auto;}


            table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
}

table th, table td {
  text-align: left;
  padding: 8px;
  border: 1px solid #ddd;
}

table th {
  background-color: #0c2c5b;
  color: #fff;
}

table tr:nth-child(even) {
  background-color: #f2f2f2;
}

table tr:hover {
  background-color: #d8e5f5;
}

table td {
  color: #333;
}

table .yes {
  color: #009933;
}

table .no {
  color: #cc0000;
}



		</style>

    
<?php

require('db_connection.php');

session_start();

if ($_SESSION['logged'] != true) { //verificacao se tem login feito

  $_SESSION['erro'] = "Não tem sessão iniciada. Inicie sessão para continuar.";

  echo "<META HTTP-EQUIV=\"refresh\" content=\"2; URL=login.php\"> ";
} else {

  $nome = $_SESSION['nome'];

  //UPCs
  $Serial_Number_Povoa = "032E280C4321000002";
  $Serial_Number_Aveiro = "018E22DC44F1000003";

  //UARs
  $Serial_Number_UAR11 = "0411180A3E26000012"; //P11 (C.C)
  $Serial_Number_UAR10 = "0411180A3E26000011"; //P10 (L.CP)
  $Serial_Number_UAR9 = "0411180A3E26000010"; //P8 (P. CUF)
  $Serial_Number_UAR8 = "0411180A3E26000009"; //P7 (E.Veiros)
  $Serial_Number_UAR7 = "0411180A3E26000008"; //P6 (Chegado)
  $Serial_Number_UAR6 = "0411180A3E26000007"; //P4 (Testada)
  $Serial_Number_UAR5 = "0411180A3E26000006"; //P2 (M.Garras)
  $Serial_Number_UAR4 = "0111180A3E26000005"; // P5 (CX2)
  $Serial_Number_UAR3 = "0111180A3E26000002"; // P12 (Cires)
  $Serial_Number_UAR2 = "0311180A3E26000003"; // P9 (Póvoa)
  $Serial_Number_UAR1 = "0311180A3E26000004"; //P1 (Aveiro)


  //UPCs
  $queryPovoa = "SELECT VOUT_Measure,IOUT_Measure,UREF_ON_Measure,UREF_Config,UREF_OFF_Measure,System,RSSI,BER,Time_Stamp FROM `UPR_Status` WHERE Serial_Number='$Serial_Number_Povoa' ORDER BY Input DESC LIMIT 1";

  $queryAveiro = "SELECT VOUT_Measure,IOUT_Measure,UREF_ON_Measure,UREF_Config,UREF_OFF_Measure,System,RSSI,BER,Time_Stamp FROM `UPR_Status` WHERE Serial_Number='$Serial_Number_Aveiro' ORDER BY Input DESC LIMIT 1";

  $resultPovoa = mysqli_query($con, $queryPovoa) or die(mysqli_error($con));

  $resultAveiro = mysqli_query($con, $queryAveiro) or die(mysqli_error($con));

  $rowPovoa = mysqli_fetch_assoc($resultPovoa);

  $rowAveiro = mysqli_fetch_assoc($resultAveiro);

  $urefPovoa = number_format(($rowPovoa['UREF_Config'] / 1000), 2, '.', '');
  $urefOnPovoa = number_format(($rowPovoa['UREF_ON_Measure'] / 1000), 2, '.', '');
  $urefOffPovoa  = number_format(($rowPovoa['UREF_OFF_Measure'] / 1000), 2, '.', '');
  $voutPovoa = number_format(($rowPovoa['VOUT_Measure'] / 1000), 2, '.', '');
  $ioutPovoa = number_format(($rowPovoa['IOUT_Measure'] / 1000), 2, '.', '');
  $systemPovoa = $rowPovoa['System'];
  $sinalPovoa = $rowPovoa['RSSI'];
  $berPovoa = $rowPovoa['BER'];
  $timePovoa = $rowPovoa['Time_Stamp'];


  $urefAveiro = number_format(($rowAveiro['UREF_Config'] / 1000), 2, '.', '');
  $urefOnAveiro = number_format(($rowAveiro['UREF_ON_Measure'] / 1000), 2, '.', '');
  $urefOffAveiro  = number_format(($rowAveiro['UREF_OFF_Measure'] / 1000), 2, '.', '');
  $voutAveiro = number_format(($rowAveiro['VOUT_Measure'] / 1000), 2, '.', '');
  $ioutAveiro = number_format(($rowAveiro['IOUT_Measure'] / 1000), 2, '.', '');
  $systemAveiro = $rowAveiro['System'];
  $sinalAveiro = $rowAveiro['RSSI'];
  $berAveiro = $rowAveiro['BER'];
  $timeAveiro = $rowAveiro['Time_Stamp'];

  //P1 (Aveiro) - $Serial_Number_UAR1= "0311180A3E26000004";

  $off_on_UAR1 = "";
  $bat_UAR1 = "";
  $energia_UAR1 = "";

  $queryUAR1U = "SELECT `Potencial_On`,`Potencial_Off` FROM `UAR_OnOff` WHERE Serial_Number='$Serial_Number_UAR1' ORDER BY Input DESC LIMIT 1";
  $resultUAR1U = mysqli_query($con, $queryUAR1U) or die(mysqli_error($con));
  $rowUAR1U = mysqli_fetch_assoc($resultUAR1U);

  $queryUAR1 = "SELECT * FROM `ProCat_ID` WHERE Serial_Number='$Serial_Number_UAR1'";
  $queryUAR1_dados = "SELECT Battery_Level,Cut_Start_Time,Cut_Start_Date,CH1_Uon,CH1_Uoff,Time_Stamp,RSSI,BER FROM `UAR_Status` WHERE Serial_Number='$Serial_Number_UAR1' ORDER BY Input DESC LIMIT 1";

  $resultUAR1 = mysqli_query($con, $queryUAR1) or die(mysqli_error($con));
  $rowUAR1 = mysqli_fetch_assoc($resultUAR1);
  $timeUAR1 = $rowUAR1['Time_Stamp'];
  $resultUAR1_dados = mysqli_query($con, $queryUAR1_dados) or die(mysqli_error($con));
  $rowUAR1_dados = mysqli_fetch_assoc($resultUAR1_dados);

  $dataBD_UAR1 = new DateTime($rowUAR1_dados['Cut_Start_Date'] . ' ' . $rowUAR1_dados['Cut_Start_Time']);

  if ($rowUAR1['Power'] == 0) {
    //bateria
    if ($rowUAR1_dados['Battery_Level'] > 11500) {
      //bateria boa
      $bat_UAR1 = "ok";
    } else if ($rowUAR1_dados['Battery_Level'] <= 11500) {
      //bateria fraca
      $bat_UAR1 = "fraca";
    }
  } else if ($rowUAR1['Power'] == 1) {
    //energia

    $energia_UAR1 = "ok";
  }

  $dataNow = new DateTime('now');


  if ($dataBD_UAR1 < $dataNow) {
    //offline
    $off_on_UAR1 = "off";
  } else {
    //online
    $off_on_UAR1 = "on";
  }

  //  P2 (M.Garras) - $Serial_Number_UAR5 = "0411180A3E26000006"; 

  $off_on_UAR5 = "";
  $bat_UAR5 = "";
  $energia_UAR5 = "";

  $queryUAR5U = "SELECT `Potencial_On`,`Potencial_Off` FROM `UAR_OnOff` WHERE Serial_Number='$Serial_Number_UAR5' ORDER BY Input DESC LIMIT 1";
  $resultUAR5U = mysqli_query($con, $queryUAR5U) or die(mysqli_error($con));
  $rowUAR5U = mysqli_fetch_assoc($resultUAR5U);

  $queryUAR5 = "SELECT * FROM `ProCat_ID` WHERE Serial_Number='$Serial_Number_UAR5'";
  $queryUAR5_dados = "SELECT Battery_Level,Cut_Start_Time,Cut_Start_Date,CH1_Uon,CH1_Uoff,Time_Stamp,RSSI,BER FROM `UAR_Status` WHERE Serial_Number='$Serial_Number_UAR5' ORDER BY Input DESC LIMIT 1";

  $resultUAR5 = mysqli_query($con, $queryUAR5) or die(mysqli_error($con));
  $rowUAR5 = mysqli_fetch_assoc($resultUAR5);
  $timeUAR5 = $rowUAR5['Time_Stamp'];
  $resultUAR5_dados = mysqli_query($con, $queryUAR5_dados) or die(mysqli_error($con));
  $rowUAR5_dados = mysqli_fetch_assoc($resultUAR5_dados);

  $dataBD_UAR5 = new DateTime($rowUAR5_dados['Cut_Start_Date'] . ' ' . $rowUAR5_dados['Cut_Start_Time']);

  if ($rowUAR5['Power'] == 0) {
    //bateria
    if ($rowUAR5_dados['Battery_Level'] > 11500) {
      //bateria boa
      $bat_UAR5 = "ok";
    } else if ($rowUAR5_dados['Battery_Level'] <= 11500) {
      //bateria fraca
      $bat_UAR5 = "fraca";
    }
  } else if ($rowUAR5['Power'] == 1) {
    //energia

    $energia_UAR5 = "ok";
  }

  $dataNow5 = new DateTime('now');


  if ($dataBD_UAR5 < $dataNow5) {
    //offline
    $off_on_UAR5 = "off";
  } else {
    //online
    $off_on_UAR5 = "on";
  }

  //P4 (Testada) - $Serial_Number_UAR6 = "0411180A3E26000007";
  $off_on_UAR6 = "";
  $bat_UAR6 = "";
  $energia_UAR6 = "";

  $queryUAR6U = "SELECT `Potencial_On`,`Potencial_Off` FROM `UAR_OnOff` WHERE Serial_Number='$Serial_Number_UAR6' ORDER BY Input DESC LIMIT 1";
  $resultUAR6U = mysqli_query($con, $queryUAR6U) or die(mysqli_error($con));
  $rowUAR6U = mysqli_fetch_assoc($resultUAR6U);

  $queryUAR6 = "SELECT * FROM `ProCat_ID` WHERE Serial_Number='$Serial_Number_UAR6'";
  $queryUAR6_dados = "SELECT Battery_Level,Cut_Start_Time,Cut_Start_Date,CH1_Uon,CH1_Uoff,Time_Stamp,RSSI,BER FROM `UAR_Status` WHERE Serial_Number='$Serial_Number_UAR6' ORDER BY Input DESC LIMIT 1";

  $resultUAR6 = mysqli_query($con, $queryUAR6) or die(mysqli_error($con));
  $rowUAR6 = mysqli_fetch_assoc($resultUAR6);
  $timeUAR6 = $rowUAR6['Time_Stamp'];

  $resultUAR6_dados = mysqli_query($con, $queryUAR6_dados) or die(mysqli_error($con));
  $rowUAR6_dados = mysqli_fetch_assoc($resultUAR6_dados);

  $dataBD_UAR6 = new DateTime($rowUAR6_dados['Cut_Start_Date'] . ' ' . $rowUAR6_dados['Cut_Start_Time']);

  if ($rowUAR6['Power'] == 0) {
    //bateria
    if ($rowUAR6_dados['Battery_Level'] > 11500) {
      //bateria boa
      $bat_UAR6 = "ok";
    } else if ($rowUAR6_dados['Battery_Level'] <= 11500) {
      //bateria fraca
      $bat_UAR6 = "fraca";
    }
  } else if ($rowUAR6['Power'] == 1) {
    //energia

    $energia_UAR6 = "ok";
  }

  $dataNow = new DateTime('now');


  if ($dataBD_UAR6 < $dataNow) {
    //offline
    $off_on_UAR6 = "off";
  } else {
    //online
    $off_on_UAR6 = "on";
  }



  // P5 (CX2)
  $off_on_UAR4 = "";
  $bat_UAR4 = "";
  $energia_UAR4 = "";

  $queryUAR4U = "SELECT `Potencial_On`,`Potencial_Off` FROM `UAR_OnOff` WHERE Serial_Number='$Serial_Number_UAR4' ORDER BY Input DESC LIMIT 1";
  $resultUAR4U = mysqli_query($con, $queryUAR4U) or die(mysqli_error($con));
  $rowUAR4U = mysqli_fetch_assoc($resultUAR4U);

  $queryUAR4 = "SELECT * FROM `ProCat_ID` WHERE Serial_Number='$Serial_Number_UAR4'";
  $queryUAR4_dados = "SELECT Battery_Level,Cut_Start_Time,Cut_Start_Date,CH1_Uon,CH1_Uoff,Time_Stamp,RSSI,BER FROM `UAR_Status` WHERE Serial_Number='$Serial_Number_UAR4' ORDER BY Input DESC LIMIT 1";

  $resultUAR4 = mysqli_query($con, $queryUAR4) or die(mysqli_error($con));
  $rowUAR4 = mysqli_fetch_assoc($resultUAR4);
  $timeUAR4 = $rowUAR4['Time_Stamp'];

  $resultUAR4_dados = mysqli_query($con, $queryUAR4_dados) or die(mysqli_error($con));
  $rowUAR4_dados = mysqli_fetch_assoc($resultUAR4_dados);

  $dataBD_UAR4 = new DateTime($rowUAR4_dados['Cut_Start_Date'] . ' ' . $rowUAR4_dados['Cut_Start_Time']);

  if ($rowUAR4['Power'] == 0) {
    //bateria
    if ($rowUAR4_dados['Battery_Level'] > 11500) {
      //bateria boa
      $bat_UAR4 = "ok";
    } else if ($rowUAR4_dados['Battery_Level'] <= 11500) {
      //bateria fraca
      $bat_UAR4 = "fraca";
    }
  } else if ($rowUAR4['Power'] == 1) {
    //energia

    $energia_UAR4 = "ok";
  }

  $dataNow = new DateTime('now');


  if ($dataBD_UAR4 < $dataNow) {
    //offline
    $off_on_UAR4 = "off";
  } else {
    //online
    $off_on_UAR4 = "on";
  }


  //P6 (Chegado) - $Serial_Number_UAR7 = "0411180A3E26000008"; 

  $off_on_UAR7 = "";
  $bat_UAR7 = "";
  $energia_UAR7 = "";

  $queryUAR7U = "SELECT `Potencial_On`,`Potencial_Off` FROM `UAR_OnOff` WHERE Serial_Number='$Serial_Number_UAR7' ORDER BY Input DESC LIMIT 1";
  $resultUAR7U = mysqli_query($con, $queryUAR7U) or die(mysqli_error($con));
  $rowUAR7U = mysqli_fetch_assoc($resultUAR7U);

  $queryUAR7 = "SELECT * FROM `ProCat_ID` WHERE Serial_Number='$Serial_Number_UAR7'";
  $queryUAR7_dados = "SELECT Battery_Level,Cut_Start_Time,Cut_Start_Date,CH1_Uon,CH1_Uoff,Time_Stamp,RSSI,BER FROM `UAR_Status` WHERE Serial_Number='$Serial_Number_UAR7' ORDER BY Input DESC LIMIT 1";

  $resultUAR7 = mysqli_query($con, $queryUAR7) or die(mysqli_error($con));
  $rowUAR7 = mysqli_fetch_assoc($resultUAR7);
  $timeUAR7 = $rowUAR7['Time_Stamp'];
  $resultUAR7_dados = mysqli_query($con, $queryUAR7_dados) or die(mysqli_error($con));
  $rowUAR7_dados = mysqli_fetch_assoc($resultUAR7_dados);

  $dataBD_UAR7 = new DateTime($rowUAR7_dados['Cut_Start_Date'] . ' ' . $rowUAR7_dados['Cut_Start_Time']);

  if ($rowUAR7['Power'] == 0) {
    //bateria
    if ($rowUAR7_dados['Battery_Level'] > 11500) {
      //bateria boa
      $bat_UAR7 = "ok";
    } else if ($rowUAR7_dados['Battery_Level'] <= 11500) {
      //bateria fraca
      $bat_UAR7 = "fraca";
    }
  } else if ($rowUAR7['Power'] == 1) {
    //energia

    $energia_UAR7 = "ok";
  }

  $dataNow7 = new DateTime('now');


  if ($dataBD_UAR7 < $dataNow7) {
    //offline
    $off_on_UAR7 = "off";
  } else {
    //online
    $off_on_UAR7 = "on";
  }



  //P7 (E.Veiros) - $Serial_Number_UAR8 = "0411180A3E26000009"; 

  $off_on_UAR8 = "";
  $bat_UAR8 = "";
  $energia_UAR8 = "";

  $queryUAR8U = "SELECT `Potencial_On`,`Potencial_Off` FROM `UAR_OnOff` WHERE Serial_Number='$Serial_Number_UAR8' ORDER BY Input DESC LIMIT 1";
  $resultUAR8U = mysqli_query($con, $queryUAR8U) or die(mysqli_error($con));
  $rowUAR8U = mysqli_fetch_assoc($resultUAR8U);

  $queryUAR8 = "SELECT * FROM `ProCat_ID` WHERE Serial_Number='$Serial_Number_UAR8'";
  $queryUAR8_dados = "SELECT Battery_Level,Cut_Start_Time,Cut_Start_Date,CH1_Uon,CH1_Uoff,Time_Stamp,RSSI,BER FROM `UAR_Status` WHERE Serial_Number='$Serial_Number_UAR8' ORDER BY Input DESC LIMIT 1";

  $resultUAR8 = mysqli_query($con, $queryUAR8) or die(mysqli_error($con));
  $rowUAR8 = mysqli_fetch_assoc($resultUAR8);
  $timeUAR8 = $rowUAR8['Time_Stamp'];
  $resultUAR8_dados = mysqli_query($con, $queryUAR8_dados) or die(mysqli_error($con));
  $rowUAR8_dados = mysqli_fetch_assoc($resultUAR8_dados);

  $dataBD_UAR8 = new DateTime($rowUAR8_dados['Cut_Start_Date'] . ' ' . $rowUAR8_dados['Cut_Start_Time']);

  if ($rowUAR8['Power'] == 0) {
    //bateria
    if ($rowUAR8_dados['Battery_Level'] > 11500) {
      //bateria boa
      $bat_UAR8 = "ok";
    } else if ($rowUAR8_dados['Battery_Level'] <= 11500) {
      //bateria fraca
      $bat_UAR8 = "fraca";
    }
  } else if ($rowUAR8['Power'] == 1) {
    //energia

    $energia_UAR8 = "ok";
  }

  $dataNow8 = new DateTime('now');


  if ($dataBD_UAR8 < $dataNow8) {
    //offline
    $off_on_UAR8 = "off";
  } else {
    //online
    $off_on_UAR8 = "on";
  }


  //P8 (P. CUF) - $Serial_Number_UAR9 = "0411180A3E26000010";

  $off_on_UAR9 = "";
  $bat_UAR9 = "";
  $energia_UAR9 = "";

  $queryUAR9U = "SELECT `Potencial_On`,`Potencial_Off` FROM `UAR_OnOff` WHERE Serial_Number='$Serial_Number_UAR9' ORDER BY Input DESC LIMIT 1";
  $resultUAR9U = mysqli_query($con, $queryUAR9U) or die(mysqli_error($con));
  $rowUAR9U = mysqli_fetch_assoc($resultUAR9U);

  $queryUAR9 = "SELECT * FROM `ProCat_ID` WHERE Serial_Number='$Serial_Number_UAR9'";
  $queryUAR9_dados = "SELECT Battery_Level,Cut_Start_Time,Cut_Start_Date,CH1_Uon,CH1_Uoff,Time_Stamp,RSSI,BER FROM `UAR_Status` WHERE Serial_Number='$Serial_Number_UAR9' ORDER BY Input DESC LIMIT 1";

  $resultUAR9 = mysqli_query($con, $queryUAR9) or die(mysqli_error($con));
  $rowUAR9 = mysqli_fetch_assoc($resultUAR9);
  $timeUAR9 = $rowUAR9['Time_Stamp'];
  $resultUAR9_dados = mysqli_query($con, $queryUAR9_dados) or die(mysqli_error($con));
  $rowUAR9_dados = mysqli_fetch_assoc($resultUAR9_dados);

  $dataBD_UAR9 = new DateTime($rowUAR9_dados['Cut_Start_Date'] . ' ' . $rowUAR9_dados['Cut_Start_Time']);

  if ($rowUAR9['Power'] == 0) {
    //bateria
    if ($rowUAR9_dados['Battery_Level'] > 11500) {
      //bateria boa
      $bat_UAR9 = "ok";
    } else if ($rowUAR9_dados['Battery_Level'] <= 11500) {
      //bateria fraca
      $bat_UAR9 = "fraca";
    }
  } else if ($rowUAR9['Power'] == 1) {
    //energia

    $energia_UAR9 = "ok";
  }

  $dataNow9 = new DateTime('now');


  if ($dataBD_UAR9 < $dataNow9) {
    //offline
    $off_on_UAR9 = "off";
  } else {
    //online
    $off_on_UAR9 = "on";
  }


  // P9 (Póvoa)
  $off_on_UAR2 = "";
  $bat_UAR2 = "";
  $energia_UAR2 = "";

  $queryUAR2U = "SELECT `Potencial_On`,`Potencial_Off` FROM `UAR_OnOff` WHERE Serial_Number='$Serial_Number_UAR2' ORDER BY Input DESC LIMIT 1";
  $resultUAR2U = mysqli_query($con, $queryUAR2U) or die(mysqli_error($con));
  $rowUAR2U = mysqli_fetch_assoc($resultUAR2U);

  $queryUAR2 = "SELECT * FROM `ProCat_ID` WHERE Serial_Number='$Serial_Number_UAR2'";
  $queryUAR2_dados = "SELECT Battery_Level,Cut_Start_Time,Cut_Start_Date,CH1_Uon,CH1_Uoff,Time_Stamp,RSSI,BER FROM `UAR_Status` WHERE Serial_Number='$Serial_Number_UAR2' ORDER BY Input DESC LIMIT 1";
  //new
  $queryUAR2_dados2 = "SELECT Instant_Off, Potencial_On FROM `UAR_OnOff` WHERE Serial_Number='$Serial_Number_UAR2' ORDER BY Input DESC LIMIT 1";


  $resultUAR2 = mysqli_query($con, $queryUAR2) or die(mysqli_error($con));
  $rowUAR2 = mysqli_fetch_assoc($resultUAR2);
  $timeUAR2 = $rowUAR2['Time_Stamp'];

  $resultUAR2_dados = mysqli_query($con, $queryUAR2_dados) or die(mysqli_error($con));
  $rowUAR2_dados = mysqli_fetch_assoc($resultUAR2_dados);

  //new
  $resultUAR2_dados2 = mysqli_query($con, $queryUAR2_dados2) or die(mysqli_error($con));
  $rowUAR2_dados2 = mysqli_fetch_assoc($resultUAR2_dados2);

  $dataBD_UAR2 = new DateTime($rowUAR2_dados['Cut_Start_Date'] . ' ' . $rowUAR2_dados['Cut_Start_Time']);

  if ($rowUAR2['Power'] == 0) {
    //bateria
    if ($rowUAR2_dados['Battery_Level'] > 11500) {
      //bateria boa
      $bat_UAR2 = "ok";
    } else if ($rowUAR2_dados['Battery_Level'] <= 11500) {
      //bateria fraca
      $bat_UAR2 = "fraca";
    }
  } else if ($rowUAR2['Power'] == 1) {
    //energia

    $energia_UAR2 = "ok";
  }

  $dataNow = new DateTime('now');


  if ($dataBD_UAR2 < $dataNow) {
    //offline
    $off_on_UAR2 = "off";
  } else {
    //online
    $off_on_UAR2 = "on";
  }



  //P10 (L.CP) -   $Serial_Number_UAR10 = "0411180A3E26000011"; 

  $off_on_UAR10 = "";
  $bat_UAR10 = "";
  $energia_UAR10 = "";

  $queryUAR10U = "SELECT `Potencial_On`,`Potencial_Off` FROM `UAR_OnOff` WHERE Serial_Number='$Serial_Number_UAR10' ORDER BY Input DESC LIMIT 1";
  $resultUAR10U = mysqli_query($con, $queryUAR10U) or die(mysqli_error($con));
  $rowUAR10U = mysqli_fetch_assoc($resultUAR10U);

  $queryUAR10 = "SELECT * FROM `ProCat_ID` WHERE Serial_Number='$Serial_Number_UAR10'";
  $queryUAR10_dados = "SELECT Battery_Level,Cut_Start_Time,Cut_Start_Date,CH1_Uon,CH1_Uoff,Time_Stamp,RSSI,BER FROM `UAR_Status` WHERE Serial_Number='$Serial_Number_UAR10' ORDER BY Input DESC LIMIT 1";

  $resultUAR10 = mysqli_query($con, $queryUAR10) or die(mysqli_error($con));
  $rowUAR10 = mysqli_fetch_assoc($resultUAR10);
  $timeUAR10 = $rowUAR10['Time_Stamp'];
  $resultUAR10_dados = mysqli_query($con, $queryUAR10_dados) or die(mysqli_error($con));
  $rowUAR10_dados = mysqli_fetch_assoc($resultUAR10_dados);

  $dataBD_UAR10 = new DateTime($rowUAR10_dados['Cut_Start_Date'] . ' ' . $rowUAR10_dados['Cut_Start_Time']);

  if ($rowUAR10['Power'] == 0) {
    //bateria
    if ($rowUAR10_dados['Battery_Level'] > 11500) {
      //bateria boa
      $bat_UAR10 = "ok";
    } else if ($rowUAR10_dados['Battery_Level'] <= 11500) {
      //bateria fraca
      $bat_UAR10 = "fraca";
    }
  } else if ($rowUAR10['Power'] == 1) {
    //energia

    $energia_UAR10 = "ok";
  }

  $dataNow10 = new DateTime('now');


  if ($dataBD_UAR10 < $dataNow10) {
    //offline
    $off_on_UAR10 = "off";
  } else {
    //online
    $off_on_UAR10 = "on";
  }



  //P11 (C.C) - $Serial_Number_UAR11 = "0411180A3E26000012"; 


  $off_on_UAR11 = "";
  $bat_UAR11 = "";
  $energia_UAR11 = "";

  $queryUAR11U = "SELECT `Potencial_On`,`Potencial_Off` FROM `UAR_OnOff` WHERE Serial_Number='$Serial_Number_UAR11' ORDER BY Input DESC LIMIT 1";
  $resultUAR11U = mysqli_query($con, $queryUAR11U) or die(mysqli_error($con));
  $rowUAR11U = mysqli_fetch_assoc($resultUAR11U);

  $queryUAR11 = "SELECT * FROM `ProCat_ID` WHERE Serial_Number='$Serial_Number_UAR11'";
  $queryUAR11_dados = "SELECT Battery_Level,Cut_Start_Time,Cut_Start_Date,CH1_Uon,CH1_Uoff,Time_Stamp,RSSI,BER FROM `UAR_Status` WHERE Serial_Number='$Serial_Number_UAR11' ORDER BY Input DESC LIMIT 1";

  $resultUAR11 = mysqli_query($con, $queryUAR11) or die(mysqli_error($con));
  $rowUAR11 = mysqli_fetch_assoc($resultUAR11);
  $timeUAR11 = $rowUAR11['Time_Stamp'];
  $resultUAR11_dados = mysqli_query($con, $queryUAR11_dados) or die(mysqli_error($con));
  $rowUAR11_dados = mysqli_fetch_assoc($resultUAR11_dados);

  $dataBD_UAR11 = new DateTime($rowUAR11_dados['Cut_Start_Date'] . ' ' . $rowUAR11_dados['Cut_Start_Time']);

  if ($rowUAR11['Power'] == 0) {
    //bateria
    if ($rowUAR11_dados['Battery_Level'] > 11500) {
      //bateria boa
      $bat_UAR11 = "ok";
    } else if ($rowUAR11_dados['Battery_Level'] <= 11500) {
      //bateria fraca
      $bat_UAR11 = "fraca";
    }
  } else if ($rowUAR11['Power'] == 1) {
    //energia

    $energia_UAR11 = "ok";
  }

  $dataNow11 = new DateTime('now');


  if ($dataBD_UAR11 < $dataNow11) {
    //offline
    $off_on_UAR11 = "off";
  } else {
    //online
    $off_on_UAR11 = "on";
  }



  // P12 (Cires)
  $off_on_UAR3 = "";
  $bat_UAR3 = "";
  $energia_UAR3 = "";

  $queryUAR3U = "SELECT `Potencial_On`,`Potencial_Off` FROM `UAR_OnOff` WHERE Serial_Number='$Serial_Number_UAR3' ORDER BY Input DESC LIMIT 1";
  $resultUAR3U = mysqli_query($con, $queryUAR3U) or die(mysqli_error($con));
  $rowUAR3U = mysqli_fetch_assoc($resultUAR3U);

  $queryUAR3 = "SELECT * FROM `ProCat_ID` WHERE Serial_Number='$Serial_Number_UAR3'";
  $queryUAR3_dados = "SELECT Battery_Level,Cut_Start_Time,Cut_Start_Date,CH1_Uon,CH1_Uoff,Time_Stamp,RSSI,BER FROM `UAR_Status` WHERE Serial_Number='$Serial_Number_UAR3' ORDER BY Input DESC LIMIT 1";

  $resultUAR3 = mysqli_query($con, $queryUAR3) or die(mysqli_error($con));
  $rowUAR3 = mysqli_fetch_assoc($resultUAR3);
  $timeUAR3 = $rowUAR3['Time_Stamp'];

  $resultUAR3_dados = mysqli_query($con, $queryUAR3_dados) or die(mysqli_error($con));
  $rowUAR3_dados = mysqli_fetch_assoc($resultUAR3_dados);

  $dataBD_UAR3 = new DateTime($rowUAR3_dados['Cut_Start_Date'] . ' ' . $rowUAR3_dados['Cut_Start_Time']);

  if ($rowUAR3['Power'] == 0) {
    //bateria
    if ($rowUAR3_dados['Battery_Level'] > 11500) {
      //bateria boa
      $bat_UAR3 = "ok";
    } else if ($rowUAR3_dados['Battery_Level'] <= 11500) {
      //bateria fraca
      $bat_UAR3 = "fraca";
    }
  } else if ($rowUAR3['Power'] == 1) {
    //energia

    $energia_UAR3 = "ok";
  }

  $dataNow = new DateTime('now');


  if ($dataBD_UAR3 < $dataNow) {
    //offline
    $off_on_UAR3 = "off";
  } else {
    //online
    $off_on_UAR3 = "on";
  }

}

?>
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
                <a href="index.php" >
                <span class="material-symbols-sharp">dashboard</span>
                    <h3 id="dashboard">Monitorização</h3>
                </a>
                <a href="mapa.php" class="active">
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
            <h1 class="titulo">Mapa</h1>
            
            <br>
            
            <div id="mapid"></div>
            <div class="mobile" style="align: center;" id="mapidmobile"></div>
            <br><br><br>
        
           <!--<script>


                const map = L.map('map').setView([40.63452531854529, -8.631775846021162], 16);

                const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                const marker = L.marker([40.63452531854529, -8.631775846021162]).addTo(map)
                    .bindPopup('<b>2BWEBCONNECT</b><br> Parque de Exposições de Aveiro').openPopup();

            </script>-->

            <script>
			
            var mymap = L.map('mapid').setView([40.7033, -8.555], 11);
            
            var mymapmobile = L.map('mapidmobile').setView([40.7033, -8.555], 10);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
attribution: '© <a href="https://www.mapbox.com/about/maps/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> <strong><a href="https://www.mapbox.com/map-feedback/" target="_blank">Improve this map</a></strong>',
tileSize: 512,
maxZoom: 18,
zoomOffset: -1,
id: 'mapbox/streets-v12',
accessToken: 'pk.eyJ1IjoiZ2FiaXBvcnRvMTAiLCJhIjoiY2poZzRtZGY0MDduczMwcHRmNThqZDJhdSJ9.0P1821aaDMKxgRRQ9J_Uyw'
}).addTo(mymap);


L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
attribution: '© <a href="https://www.mapbox.com/about/maps/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> <strong><a href="https://www.mapbox.com/map-feedback/" target="_blank">Improve this map</a></strong>',
tileSize: 512,
maxZoom: 18,
zoomOffset: -1,
id: 'mapbox/streets-v12',
accessToken: 'c'
}).addTo(mymapmobile);
			/*L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    		maxZoom: 18,
   			id: 'mapbox.streets',
    		accessToken: 'pk.eyJ1IjoiZ2FiaXBvcnRvMTAiLCJhIjoiY2poZzRtZGY0MDduczMwcHRmNThqZDJhdSJ9.0P1821aaDMKxgRRQ9J_Uyw'
			}).addTo(mymap);

            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {

            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'pk.eyJ1IjoiZ2FiaXBvcnRvMTAiLCJhIjoiY2poZzRtZGY0MDduczMwcHRmNThqZDJhdSJ9.0P1821aaDMKxgRRQ9J_Uyw'
            }).addTo(mymapmobile);*/
            //pin verde
            var greenIcon = new L.Icon({
            iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
            });

            //pin vermelho
             var redIcon = new L.Icon({
            iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
            });
            //pin amarelo
            var yellowIcon = new L.Icon({
           iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-yellow.png',
           shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
           iconSize: [25, 41],
           iconAnchor: [12, 41],
           popupAnchor: [1, -34],
           shadowSize: [41, 41]
           });
           //pin azul
           var blueIcon = new L.Icon({
          iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
          shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
          iconSize: [25, 41],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34],
          shadowSize: [41, 41]
          });


          var marker = L.marker([40.765022, -8.589547], {
        icon: <?php if ($systemPovoa == 1) {
                echo "greenIcon";
              } else if ($systemPovoa == 0) {
                echo "redIcon";
              } ?>
      }).addTo(mymap);
      var marker2 = L.marker([40.657515, -8.713612], {
        icon: <?php if ($systemAveiro == 1) {
                echo "greenIcon";
              } else if ($systemAveiro == 0) {
                echo "redIcon";
              } ?>
      }).addTo(mymap);

      var marker_UAR1 = L.marker([40.657515, -8.713512], {
        icon: <?php if ($off_on_UAR1 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR1 == 'on' && $rowUAR1['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR1 == 'on' && $rowUAR1['Power'] == 0 && $bat_UAR1 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR1 == 'on' && $rowUAR1['Power'] == 0 && $bat_UAR1 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymap);
      var marker_UAR2 = L.marker([40.765022, -8.589500], {
        icon: <?php if ($off_on_UAR2 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR2 == 'on' && $rowUAR2['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR2 == 'on' && $rowUAR2['Power'] == 0 && $bat_UAR2 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR2 == 'on' && $rowUAR2['Power'] == 0 && $bat_UAR2 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymap);
      var marker_UAR3 = L.marker([40.780796, -8.571830], {
        icon: <?php if ($off_on_UAR3 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR3 == 'on' && $rowUAR3['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR3 == 'on' && $rowUAR3['Power'] == 0 && $bat_UAR3 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR3 == 'on' && $rowUAR3['Power'] == 0 && $bat_UAR3 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymap);
      var marker_UAR4 = L.marker([40.719075, -8.638983], {
        icon: <?php if ($off_on_UAR4 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR4 == 'on' && $rowUAR4['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR4 == 'on' && $rowUAR4['Power'] == 0 && $bat_UAR4 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR4 == 'on' && $rowUAR4['Power'] == 0 && $bat_UAR4 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymap);
      var marker_UAR5 = L.marker([40.672489, -8.693132], {
        icon: <?php if ($off_on_UAR5 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR5 == 'on' && $rowUAR5['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR5 == 'on' && $rowUAR5['Power'] == 0 && $bat_UAR5 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR5 == 'on' && $rowUAR5['Power'] == 0 && $bat_UAR5 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymap);
      var marker_UAR6 = L.marker([40.710524, -8.646621], {
        icon: <?php if ($off_on_UAR6 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR6 == 'on' && $rowUAR6['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR6 == 'on' && $rowUAR6['Power'] == 0 && $bat_UAR6 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR6 == 'on' && $rowUAR6['Power'] == 0 && $bat_UAR6 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymap);
      var marker_UAR7 = L.marker([40.730089, -8.609734], {
        icon: <?php if ($off_on_UAR7 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR7 == 'on' && $rowUAR7['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR7 == 'on' && $rowUAR7['Power'] == 0 && $bat_UAR7 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR7 == 'on' && $rowUAR7['Power'] == 0 && $bat_UAR7 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymap);
      var marker_UAR8 = L.marker([40.741180, -8.595407], {
        icon: <?php if ($off_on_UAR8 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR8 == 'on' && $rowUAR8['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR8 == 'on' && $rowUAR8['Power'] == 0 && $bat_UAR8 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR8 == 'on' && $rowUAR8['Power'] == 0 && $bat_UAR8 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymap);
      var marker_UAR9 = L.marker([40.750697, -8.595648], {
        icon: <?php if ($off_on_UAR9 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR9 == 'on' && $rowUAR9['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR9 == 'on' && $rowUAR9['Power'] == 0 && $bat_UAR9 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR9 == 'on' && $rowUAR9['Power'] == 0 && $bat_UAR9 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymap);
      var marker_UAR10 = L.marker([40.768836, -8.577914], {
        icon: <?php if ($off_on_UAR10 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR10 == 'on' && $rowUAR10['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR10 == 'on' && $rowUAR10['Power'] == 0 && $bat_UAR10 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR10 == 'on' && $rowUAR10['Power'] == 0 && $bat_UAR10 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymap);
      var marker_UAR11 = L.marker([40.776007, -8.567825], {
        icon: <?php if ($off_on_UAR11 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR11 == 'on' && $rowUAR11['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR11 == 'on' && $rowUAR11['Power'] == 0 && $bat_UAR11 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR11 == 'on' && $rowUAR11['Power'] == 0 && $bat_UAR11 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymap);



      var marker_UAR1_mobile = L.marker([40.657515, -8.713512], {
        icon: <?php if ($off_on_UAR1 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR1 == 'on' && $rowUAR1['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR1 == 'on' && $rowUAR1['Power'] == 0 && $bat_UAR1 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR1 == 'on' && $rowUAR1['Power'] == 0 && $bat_UAR1 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymapmobile);
      var marker_UAR2_mobile = L.marker([40.765022, -8.589500], {
        icon: <?php if ($off_on_UAR2 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR2 == 'on' && $rowUAR2['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR2 == 'on' && $rowUAR2['Power'] == 0 && $bat_UAR2 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR2 == 'on' && $rowUAR2['Power'] == 0 && $bat_UAR2 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymapmobile);
      var marker_UAR3_mobile = L.marker([40.780796, -8.571830], {
        icon: <?php if ($off_on_UAR3 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR3 == 'on' && $rowUAR3['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR3 == 'on' && $rowUAR3['Power'] == 0 && $bat_UAR3 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR3 == 'on' && $rowUAR3['Power'] == 0 && $bat_UAR3 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymapmobile);
      var marker_UAR4_mobile = L.marker([40.719075, -8.638983], {
        icon: <?php if ($off_on_UAR4 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR4 == 'on' && $rowUAR4['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR4 == 'on' && $rowUAR4['Power'] == 0 && $bat_UAR4 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR4 == 'on' && $rowUAR4['Power'] == 0 && $bat_UAR4 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymapmobile);
      var marker_UAR5_mobile = L.marker([40.672489, -8.693132], {
        icon: <?php if ($off_on_UAR5 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR5 == 'on' && $rowUAR5['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR5 == 'on' && $rowUAR5['Power'] == 0 && $bat_UAR5 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR5 == 'on' && $rowUAR5['Power'] == 0 && $bat_UAR5 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymapmobile);
      var marker_UAR6_mobile = L.marker([40.710524, -8.646621], {
        icon: <?php if ($off_on_UAR6 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR6 == 'on' && $rowUAR6['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR6 == 'on' && $rowUAR6['Power'] == 0 && $bat_UAR6 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR6 == 'on' && $rowUAR6['Power'] == 0 && $bat_UAR6 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymapmobile);
      var marker_UAR7_mobile = L.marker([40.730089, -8.609734], {
        icon: <?php if ($off_on_UAR7 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR7 == 'on' && $rowUAR7['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR7 == 'on' && $rowUAR7['Power'] == 0 && $bat_UAR7 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR7 == 'on' && $rowUAR7['Power'] == 0 && $bat_UAR7 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymapmobile);
      var marker_UAR8_mobile = L.marker([40.741180, -8.595407], {
        icon: <?php if ($off_on_UAR8 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR8 == 'on' && $rowUAR8['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR8 == 'on' && $rowUAR8['Power'] == 0 && $bat_UAR8 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR8 == 'on' && $rowUAR8['Power'] == 0 && $bat_UAR8 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymapmobile);
      var marker_UAR9_mobile = L.marker([40.750697, -8.595648], {
        icon: <?php if ($off_on_UAR9 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR9 == 'on' && $rowUAR9['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR9 == 'on' && $rowUAR9['Power'] == 0 && $bat_UAR9 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR9 == 'on' && $rowUAR9['Power'] == 0 && $bat_UAR9 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymapmobile);
      var marker_UAR10_mobile = L.marker([40.768836, -8.577914], {
        icon: <?php if ($off_on_UAR10 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR10 == 'on' && $rowUAR10['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR10 == 'on' && $rowUAR10['Power'] == 0 && $bat_UAR10 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR10 == 'on' && $rowUAR10['Power'] == 0 && $bat_UAR10 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymapmobile);
      var marker_UAR11_mobile = L.marker([40.776007, -8.567825], {
        icon: <?php if ($off_on_UAR11 == 'off') {
                echo "redIcon";
              } else if ($off_on_UAR11 == 'on' && $rowUAR11['Power'] == 1) {
                echo "blueIcon";
              } else if ($off_on_UAR11 == 'on' && $rowUAR11['Power'] == 0 && $bat_UAR11 == 'fraca') {
                echo "yellowIcon";
              } else if ($off_on_UAR11 == 'on' && $rowUAR11['Power'] == 0 && $bat_UAR11 == 'ok') {
                echo "greenIcon";
              } ?>
      }).addTo(mymapmobile);



      var off_on_UAR1 = '<?php echo $off_on_UAR1; ?>';
      var power_UAR1 = <?php echo $rowUAR1['Power']; ?>;
      var bateria_UAR1 = <?php echo $rowUAR1_dados['Battery_Level']; ?>;

      var off_on_UAR2 = '<?php echo $off_on_UAR2; ?>';
      var power_UAR2 = <?php echo $rowUAR2['Power']; ?>;
      var bateria_UAR2 = <?php echo $rowUAR2_dados['Battery_Level']; ?>;

      var off_on_UAR3 = '<?php echo $off_on_UAR3; ?>';
      var power_UAR3 = <?php echo $rowUAR3['Power']; ?>;
      var bateria_UAR3 = <?php echo $rowUAR3_dados['Battery_Level']; ?>;

      var off_on_UAR4 = '<?php echo $off_on_UAR4; ?>';
      var power_UAR4 = <?php echo $rowUAR4['Power']; ?>;
      var bateria_UAR4 = <?php echo $rowUAR4_dados['Battery_Level']; ?>;

      var off_on_UAR5 = '<?php echo $off_on_UAR5; ?>';
      var power_UAR5 = <?php echo $rowUAR5['Power']; ?>;
      var bateria_UAR5 = <?php echo $rowUAR5_dados['Battery_Level']; ?>;

      var off_on_UAR6 = '<?php echo $off_on_UAR6; ?>';
      var power_UAR6 = <?php echo $rowUAR6['Power']; ?>;
      var bateria_UAR6 = <?php echo $rowUAR6_dados['Battery_Level']; ?>;

      var off_on_UAR7 = '<?php echo $off_on_UAR7; ?>';
      var power_UAR7 = <?php echo $rowUAR7['Power']; ?>;
      var bateria_UAR7 = <?php echo $rowUAR7_dados['Battery_Level']; ?>;

      var off_on_UAR8 = '<?php echo $off_on_UAR8; ?>';
      var power_UAR8 = <?php echo $rowUAR8['Power']; ?>;
      var bateria_UAR8 = <?php echo $rowUAR8_dados['Battery_Level']; ?>;

      var off_on_UAR9 = '<?php echo $off_on_UAR9; ?>';
      var power_UAR9 = <?php echo $rowUAR9['Power']; ?>;
      var bateria_UAR9 = <?php echo $rowUAR9_dados['Battery_Level']; ?>;

      var off_on_UAR10 = '<?php echo $off_on_UAR10; ?>';
      var power_UAR10 = <?php echo $rowUAR10['Power']; ?>;
      var bateria_UAR10 = <?php echo $rowUAR10_dados['Battery_Level']; ?>;

      var off_on_UAR11 = '<?php echo $off_on_UAR11; ?>';
      var power_UAR11 = <?php echo $rowUAR11['Power']; ?>;
      var bateria_UAR11 = <?php echo $rowUAR11_dados['Battery_Level']; ?>;

      //P1 (Aveiro) - UAR1 
      if (off_on_UAR1 === 'off') {
        marker_UAR1.bindPopup("<b>Aveiro</b><br><b style='color:red'>Sistema Offline</b><br><b>Data: <?php echo $rowUAR1_dados['Time_Stamp']; ?></b><br><b><a href='uarveiro.php' >Consulta</a></b>");
        marker_UAR1_mobile.bindPopup("<b>UAR1-Aveiro</b><br><b style='color:red'>Sistema Offline</b><br><b><a href='uarveiro.php' >Consulta</a></b>");


      } else if (off_on_UAR1 === 'on' && power_UAR1 === 0 && bateria_UAR1 <= 11500) {
        marker_UAR1.bindPopup("<b>Aveiro</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR1U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR1U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR1_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data: <?php echo $rowUAR1_dados['Time_Stamp']; ?></b><br><b><a href='uarveiro.php' >Consulta</a></b><br>");
        marker_UAR1_mobile.bindPopup("<b>UAR1-Aveiro</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR1U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR1U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR1_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data: <?php echo $rowUAR1_dados['Time_Stamp']; ?></b><br><b><a href='uarveiro.php' >Consulta</a></b><br>");


      } else if (off_on_UAR1 === 'on' && power_UAR1 === 0 && bateria_UAR1 > 11500) {
        marker_UAR1.bindPopup("<b>Aveiro</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR1U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR1U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR1_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR1_dados['Time_Stamp']; ?></b><br><b><a href='uarveiro.php' >Consulta</a></b><br>");
        marker_UAR1_mobile.bindPopup("<b>UAR1-Aveiro</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR1U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR1U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR1_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR1_dados['Time_Stamp']; ?></b><br><b><a href='uarveiro.php' >Consulta</a></b><br>");


      } else if (off_on_UAR1 === 'on' && power_UAR1 === 1) {
        marker_UAR1.bindPopup("<b>Aveiro</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR1U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR1U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR1_dados['Time_Stamp']; ?></b><br><b><a href='uarveiro.php' >Consulta</a></b>");
        marker_UAR1_mobile.bindPopup("<b>UAR1-Aveiro</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR1U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR1U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR1_dados['Time_Stamp']; ?></b><br><b><a href='uarveiro.php' >Consulta</a></b>");

      }

      //P9 (Póvoa) - UAR2 
      if (off_on_UAR2 === 'off') {
        marker_UAR2.bindPopup("<b>Póvoa</b><br><b style='color:red'>Sistema Offline</b><br><b>Data: <?php echo $rowUAR2_dados['Time_Stamp']; ?></b><br><b><a href='uarpovoa.php' >Consulta</a></b>");
        marker_UAR2_mobile.bindPopup("<b>Póvoa</b><br><b style='color:red'>Sistema Offline</b><br><b><a href='uarpovoa.php' >Consulta</a></b>");

      } else if (off_on_UAR2 === 'on' && power_UAR2 === 0 && bateria_UAR2 <= 11500) {
        marker_UAR2.bindPopup("<b>Póvoa</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR2U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR2U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR2_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data: <?php echo $rowUAR2_dados['Time_Stamp']; ?></b><br><b><a href='uarpovoa.php' >Consulta</a></b><br>");
        marker_UAR2_mobile.bindPopup("<b>Póvoa</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR2U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR2U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR2_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data: <?php echo $rowUAR2_dados['Time_Stamp']; ?></b><br><b><a href='uarpovoa.php' >Consulta</a></b><br>");


      } else if (off_on_UAR2 === 'on' && power_UAR2 === 0 && bateria_UAR2 > 11500) {
        marker_UAR2.bindPopup("<b>Póvoa</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR2U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR2U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR2_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR2_dados['Time_Stamp']; ?></b><br><b><a href='uarpovoa.php' >Consulta</a></b><br>");
        marker_UAR2_mobile.bindPopup("<b>Póvoa</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR2U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR2U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR2_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR2_dados['Time_Stamp']; ?></b><br><b><a href='uarpovoa.php' >Consulta</a></b><br>");


      } else if (off_on_UAR2 === 'on' && power_UAR2 === 1) {
        marker_UAR2.bindPopup("<b>Póvoa</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR2U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR2U['Potencial_Off']; ?> + " mV<br><?php ?><b>Power: </b>" + <?php echo $rowUAR2_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR2_dados['Time_Stamp']; ?></b><br><b><a href='uarpovoa.php' >Consulta</a></b>");
        marker_UAR2_mobile.bindPopup("<b>Póvoa</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR2U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR2U['Potencial_Off']; ?> + " mV<br><?php ?><b>Power: </b>" + <?php echo $rowUAR2_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR2_dados['Time_Stamp']; ?></b><br><b><a href='uarpovoa.php' >Consulta</a></b>");

      }

      //P12 (Cires) - UAR3 
      if (off_on_UAR3 === 'off') {
        marker_UAR3.bindPopup("<b>Cires</b><br><b style='color:red'>Sistema Offline</b><br><b>Data: <?php echo $rowUAR3_dados['Time_Stamp']; ?></b><br><b><a href='uarcires.php' >Consulta</a></b>");
        marker_UAR3_mobile.bindPopup("<b>Cires</b><br><b style='color:red'>Sistema Offline</b><br><b>Data:<?php echo $rowUAR3_dados['Time_Stamp']; ?></b><br><b><a href='uarcires.php' >Consulta</a></b>");

      } else if (off_on_UAR3 === 'on' && power_UAR3 === 0 && bateria_UAR3 <= 11500) {
        marker_UAR3.bindPopup("<b>Cires</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR3U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR3U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR3_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data: <?php echo $rowUAR3_dados['Time_Stamp']; ?></b><br><b><a href='uarcires.php' >Consulta</a></b><br>");
        marker_UAR3_mobile.bindPopup("<b>Cires</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR3U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR3U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR3_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data: <?php echo $rowUAR3_dados['Time_Stamp']; ?></b><br><b><a href='uarcires.php' >Consulta</a></b><br>");


      } else if (off_on_UAR3 === 'on' && power_UAR3 === 0 && bateria_UAR3 > 11500) {
        marker_UAR3.bindPopup("<b>Cires</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR3U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR3U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR3_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR3_dados['Time_Stamp']; ?></b><br><b><a href='uarcires.php' >Consulta</a></b><br>");
        marker_UAR3_mobile.bindPopup("<b>Cires</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR3U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR3U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR3_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR3_dados['Time_Stamp']; ?></b><br><b><a href='uarcires.php' >Consulta</a></b><br>");


      } else if (off_on_UAR3 === 'on' && power_UAR3 === 1) {
        marker_UAR3.bindPopup("<b>Cires</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR3U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR3U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b> Data:<?php echo $rowUAR3_dados['Time_Stamp']; ?></b><br><b><a href='uarcires.php' >Consulta</a></b>");
        marker_UAR3_mobile.bindPopup("<b>Cires</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR3U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR3U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b> Data:<?php echo $rowUAR3_dados['Time_Stamp']; ?></b><br><b><a href='uarcires.php' >Consulta</a></b>");

      }

      //P5 (CX2) - UAR4 
      if (off_on_UAR4 === 'off') {
        marker_UAR4.bindPopup("<b>CX2</b><br><b style='color:red'>Sistema Offline</b><br><b>Data: <?php echo $rowUAR4_dados['Time_Stamp']; ?></b><br><b><a href='uarp5.php' >Consulta</a></b>");
        marker_UAR4_mobile.bindPopup("<b>CX2</b><br><b style='color:red'>Sistema Offline</b><br><b><a href='uarp5.php' >Consulta</a></b>");

      } else if (off_on_UAR4 === 'on' && power_UAR4 === 0 && bateria_UAR4 <= 11500) {
        marker_UAR4.bindPopup("<b>CX2</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR4U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR4U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR4_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data: <?php echo $rowUAR4_dados['Time_Stamp']; ?></b><br><b><a href='uarp5.php' >Consulta</a></b><br>");
        marker_UAR4_mobile.bindPopup("<b>CX2</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR4U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR4U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR4_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data:<?php echo $rowUAR4_dados['Time_Stamp']; ?></b><br><b><a href='uarp5.php' >Consulta</a></b><br>");


      } else if (off_on_UAR4 === 'on' && power_UAR4 === 0 && bateria_UAR4 > 11500) {
        marker_UAR4.bindPopup("<b>CX2</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR4U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR4U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR4_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR4_dados['Time_Stamp']; ?></b><br><b><a href='uarp5.php' >Consulta</a></b><br>");
        marker_UAR4_mobile.bindPopup("<b>CX2</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR4U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR4U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR4_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR4_dados['Time_Stamp']; ?></b><br><b><a href='uarp5.php' >Consulta</a></b><br>");


      } else if (off_on_UAR4 === 'on' && power_UAR4 === 1) {
        marker_UAR4.bindPopup("<b>CX2</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR4U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR4U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR4_dados['Time_Stamp']; ?></b><br><b><a href='uarp5.php' >Consulta</a></b>");
        marker_UAR4_mobile.bindPopup("<b> CX2</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR4U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR4U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR4_dados['Time_Stamp']; ?></b><br><b><a href='uarp5.php' >Consulta</a></b>");

      }

      //  P2 (M.Garras) - $Serial_Number_UAR5 = "0411180A3E26000006";

      if (off_on_UAR5 === 'off') {
        marker_UAR5.bindPopup("<b>M.Garras</b><br><b style='color:red'>Sistema Offline</b><br><b>Data: <?php echo $rowUAR5_dados['Time_Stamp']; ?></b><br><b><a href='uargarras.php' >Consulta</a></b>");
        marker_UAR5_mobile.bindPopup("<b>M.Garras</b><br><b style='color:red'>Sistema Offline</b><br><b><a href='uargarras.php' >Consulta</a></b>");

      } else if (off_on_UAR5 === 'on' && power_UAR5 === 0 && bateria_UAR5 <= 11500) {
        marker_UAR5.bindPopup("<b>M.Garras</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR5U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR5U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR5_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data: <?php echo $rowUAR5_dados['Time_Stamp']; ?></b><br><b><a href='uargarras.php' >Consulta</a></b><br>");
        marker_UAR5_mobile.bindPopup("<b>M.Garras</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR5U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR5U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR5_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data:<?php echo $rowUAR5_dados['Time_Stamp']; ?></b><br><b><a href='uargarras.php' >Consulta</a></b><br>");


      } else if (off_on_UAR5 === 'on' && power_UAR5 === 0 && bateria_UAR5 > 11500) {
        marker_UAR5.bindPopup("<b>M.Garras</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR5U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR5U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR5_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR5_dados['Time_Stamp']; ?></b><br><b><a href='uargarras.php' >Consulta</a></b><br>");
        marker_UAR5_mobile.bindPopup("<b>M.Garras</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR5U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR5U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR5_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR5_dados['Time_Stamp']; ?></b><br><b><a href='uargarras.php' >Consulta</a></b><br>");


      } else if (off_on_UAR5 === 'on' && power_UAR5 === 1) {
        marker_UAR5.bindPopup("<b>M.Garras</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR5U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR5U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR5_dados['Time_Stamp']; ?></b><br><b><a href='uargarras.php' >Consulta</a></b>");
        marker_UAR5_mobile.bindPopup("<b>M.Garras</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR5U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR5U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR5_dados['Time_Stamp']; ?></b><br><b><a href='uargarras.php' >Consulta</a></b>");

      }

      //P4 (Testada) - $Serial_Number_UAR6 = "0411180A3E26000007";

      if (off_on_UAR6 === 'off') {
        marker_UAR6.bindPopup("<b>Testada</b><br><b style='color:red'>Sistema Offline</b><br><b>Data: <?php echo $rowUAR6_dados['Time_Stamp']; ?></b><br><b><a href='uartestada.php' >Consulta</a></b>");
        marker_UAR6_mobile.bindPopup("<b>Testada</b><br><b style='color:red'>Sistema Offline</b><br><b><a href='uartestada.php' >Consulta</a></b>");

      } else if (off_on_UAR6 === 'on' && power_UAR6 === 0 && bateria_UAR6 <= 11500) {
        marker_UAR6.bindPopup("<b>Testada</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR6U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR6U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR6_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data: <?php echo $rowUAR6_dados['Time_Stamp']; ?></b><br><b><a href='uartestada.php' >Consulta</a></b><br>");
        marker_UAR6_mobile.bindPopup("<b>Testada</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR6U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR6U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR6_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data:<?php echo $rowUAR6_dados['Time_Stamp']; ?></b><br><b><a href='uartestada.php' >Consulta</a></b><br>");


      } else if (off_on_UAR6 === 'on' && power_UAR6 === 0 && bateria_UAR6 > 11500) {
        marker_UAR6.bindPopup("<b>Testada</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR6U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR6U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR6_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR6_dados['Time_Stamp']; ?></b><br><b><a href='uartestada.php' >Consulta</a></b><br>");
        marker_UAR6_mobile.bindPopup("<b>Testada</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR6U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR6U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR6_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR6_dados['Time_Stamp']; ?></b><br><b><a href='uartestada.php' >Consulta</a></b><br>");


      } else if (off_on_UAR6 === 'on' && power_UAR6 === 1) {
        marker_UAR6.bindPopup("<b>Testada</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR6U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR6U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR6_dados['Time_Stamp']; ?></b><br><b><a href='uartestada.php' >Consulta</a></b>");
        marker_UAR6_mobile.bindPopup("<b>Testada</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR6U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR6U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR6_dados['Time_Stamp']; ?></b><br><b><a href='uartestada.php' >Consulta</a></b>");

      }

      //P6 (Chegado) - $Serial_Number_UAR7 = "0411180A3E26000008"; 

      if (off_on_UAR7 === 'off') {
        marker_UAR7.bindPopup("<b>Chegado</b><br><b style='color:red'>Sistema Offline</b><br><b>Data: <?php echo $rowUAR7_dados['Time_Stamp']; ?></b><br><b><a href='uarchegado.php' >Consulta</a></b>");
        marker_UAR7_mobile.bindPopup("<b>Chegado</b><br><b style='color:red'>Sistema Offline</b><br><b><a href='uarchegado.php' >Consulta</a></b>");

      } else if (off_on_UAR7 === 'on' && power_UAR7 === 0 && bateria_UAR7 <= 11500) {
        marker_UAR7.bindPopup("<b>Chegado</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR7U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR7U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR7_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data: <?php echo $rowUAR7_dados['Time_Stamp']; ?></b><br><b><a href='uarchegado.php' >Consulta</a></b><br>");
        marker_UAR7_mobile.bindPopup("<b>Chegado</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR7U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR7U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR7_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data:<?php echo $rowUAR7_dados['Time_Stamp']; ?></b><br><b><a href='uarchegado.php' >Consulta</a></b><br>");


      } else if (off_on_UAR7 === 'on' && power_UAR7 === 0 && bateria_UAR7 > 11500) {
        marker_UAR7.bindPopup("<b>Chegado</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR7U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR7U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR7_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR7_dados['Time_Stamp']; ?></b><br><b><a href='uarchegado.php' >Consulta</a></b><br>");
        marker_UAR7_mobile.bindPopup("<b>Chegado</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR7U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR7U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR7_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR7_dados['Time_Stamp']; ?></b><br><b><a href='uarchegado.php' >Consulta</a></b><br>");


      } else if (off_on_UAR7 === 'on' && power_UAR7 === 1) {
        marker_UAR7.bindPopup("<b>Chegado</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR7U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR7U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR7_dados['Time_Stamp']; ?></b><br><b><a href='uarchegado.php' >Consulta</a></b>");
        marker_UAR7_mobile.bindPopup("<b>Chegado</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR7U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR7U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR7_dados['Time_Stamp']; ?></b><br><b><a href='uarchegado.php' >Consulta</a></b>");

      }



      //P7 (E.Veiros) - $Serial_Number_UAR8 = "0411180A3E26000009"; 


      if (off_on_UAR8 === 'off') {
        marker_UAR8.bindPopup("<b>E.Veiros</b><br><b style='color:red'>Sistema Offline</b><br><b>Data: <?php echo $rowUAR8_dados['Time_Stamp']; ?></b><br><b><a href='uarvieiros.php' >Consulta</a></b>");
        marker_UAR8_mobile.bindPopup("<b>E.Veiros</b><br><b style='color:red'>Sistema Offline</b><br><b><a href='uarvieiros.php' >Consulta</a></b>");

      } else if (off_on_UAR8 === 'on' && power_UAR8 === 0 && bateria_UAR8 <= 11500) {
        marker_UAR8.bindPopup("<b>E.Veiros</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR8U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR8U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR8_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data: <?php echo $rowUAR8_dados['Time_Stamp']; ?></b><br><b><a href='uarvieiros.php' >Consulta</a></b><br>");
        marker_UAR8_mobile.bindPopup("<b>E.Veiros</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR8U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR8U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR8_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data:<?php echo $timeUAR8; ?></b><br><b><a href='uarvieiros.php' >Consulta</a></b><br>");


      } else if (off_on_UAR8 === 'on' && power_UAR8 === 0 && bateria_UAR8 > 11500) {
        marker_UAR8.bindPopup("<b>E.Veiros</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR8U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR8U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR8_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR8_dados['Time_Stamp']; ?></b><br><b><a href='uarvieiros.php' >Consulta</a></b><br>");
        marker_UAR8_mobile.bindPopup("<b>E.Veiros</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR8U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR8U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR8_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR8_dados['Time_Stamp']; ?></b><br><b><a href='uarvieiros.php' >Consulta</a></b><br>");


      } else if (off_on_UAR8 === 'on' && power_UAR8 === 1) {
        marker_UAR8.bindPopup("<b>E.Veiros</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR8U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR8U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR8_dados['Time_Stamp']; ?></b><br><b><a href='uarvieiros.php.php' >Consulta</a></b>");
        marker_UAR8_mobile.bindPopup("<b>E.Veiros</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR8U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR8U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR8_dados['Time_Stamp']; ?></b><br><b><a href='uarvieiros.php' >Consulta</a></b>");

      }



      //P8 (P. CUF) - $Serial_Number_UAR9 = "0411180A3E26000010";


      if (off_on_UAR9 === 'off') {
        marker_UAR9.bindPopup("<b>P. CUF</b><br><b style='color:red'>Sistema Offline</b><br><b>Data: <?php echo $rowUAR9_dados['Time_Stamp']; ?></b><br><b><a href='uarcuf.php' >Consulta</a></b>");
        marker_UAR9_mobile.bindPopup("<b>P. CUF</b><br><b style='color:red'>Sistema Offline</b><br><b><a href='uarcuf.php' >Consulta</a></b>");

      } else if (off_on_UAR9 === 'on' && power_UAR9 === 0 && bateria_UAR9 <= 11500) {
        marker_UAR9.bindPopup("<b>P. CUF</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR9U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR9U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR9_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data: <?php echo $rowUAR9_dados['Time_Stamp']; ?></b><br><b><a href='uarcuf.php' >Consulta</a></b><br>");
        marker_UAR9_mobile.bindPopup("<b>P. CUF</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR9U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR9U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR9_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data:<?php echo $rowUAR9_dados['Time_Stamp']; ?></b><br><b><a href='uarcuf.php' >Consulta</a></b><br>");


      } else if (off_on_UAR9 === 'on' && power_UAR9 === 0 && bateria_UAR9 > 11500) {
        marker_UAR9.bindPopup("<b>P. CUF</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR9U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR9U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR9_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR9_dados['Time_Stamp']; ?></b><br><b><a href='uarcuf.php' >Consulta</a></b><br>");
        marker_UAR9_mobile.bindPopup("<b>P. CUF</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR9U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR9U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR9_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR9_dados['Time_Stamp']; ?></b><br><b><a href='uarcuf.php' >Consulta</a></b><br>");


      } else if (off_on_UAR9 === 'on' && power_UAR9 === 1) {
        marker_UAR9.bindPopup("<b>P. CUF</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR9U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR9U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR9_dados['Time_Stamp']; ?></b><br><b><a href='uarcuf.php' >Consulta</a></b>");
        marker_UAR9_mobile.bindPopup("<b>P. CUF</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR9U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR9U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR9_dados['Time_Stamp']; ?></b><br><b><a href='uarcuf.php' >Consulta</a></b>");

      }


      //P10 (L.CP) -   $Serial_Number_UAR10 = "0411180A3E26000011"; 


      if (off_on_UAR10 === 'off') {
        marker_UAR10.bindPopup("<b>L.CP</b><br><b style='color:red'>Sistema Offline</b><br><b>Data: <?php echo $rowUAR10_dados['Time_Stamp']; ?></b><br><b><a href='uarlcp.php' >Consulta</a></b>");
        marker_UAR10_mobile.bindPopup("<b>L.CP</b><br><b style='color:red'>Sistema Offline</b><br><b><a href='uarlcp.php' >Consulta</a></b>");

      } else if (off_on_UAR10 === 'on' && power_UAR10 === 0 && bateria_UAR10 <= 11500) {
        marker_UAR10.bindPopup("<b>L.CP</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR10U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR10U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR10_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data: <?php echo $rowUAR10_dados['Time_Stamp']; ?></b><br><b><a href='uarlcp.php' >Consulta</a></b><br>");
        marker_UAR10_mobile.bindPopup("<b>L.CP</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR10U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR10U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR10_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data:<?php echo $rowUAR10_dados['Time_Stamp']; ?></b><br><b><a href='uarlcp.php' >Consulta</a></b><br>");


      } else if (off_on_UAR10 === 'on' && power_UAR10 === 0 && bateria_UAR10 > 11500) {
        marker_UAR10.bindPopup("<b>L.CP</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR10U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR10U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR10_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR10_dados['Time_Stamp']; ?></b><br><b><a href='uarlcp.php' >Consulta</a></b><br>");
        marker_UAR10_mobile.bindPopup("<b>L.CP</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR10U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR10U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR10_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR10_dados['Time_Stamp']; ?></b><br><b><a href='uarlcp.php' >Consulta</a></b><br>");


      } else if (off_on_UAR10 === 'on' && power_UAR10 === 1) {
        marker_UAR10.bindPopup("<b>L.CP</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR10U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR10U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR10_dados['Time_Stamp']; ?></b><br><b><a href='uarlcp.php' >Consulta</a></b>");
        marker_UAR10_mobile.bindPopup("<b>L.CP</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR10U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR10U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR10_dados['Time_Stamp']; ?></b><br><b><a href='uarlcp.php' >Consulta</a></b>");

      }


      //P11 (C.C) - $Serial_Number_UAR11 = "0411180A3E26000012"; 

      if (off_on_UAR11 === 'off') {
        marker_UAR11.bindPopup("<b>C.C</b><br><b style='color:red'>Sistema Offline</b><br><b>Data: <?php echo $rowUAR11_dados['Time_Stamp']; ?></b><br><b><a href='uarcc.php' >Consulta</a></b>");
        marker_UAR11_mobile.bindPopup("<b>C.C</b><br><b style='color:red'>Sistema Offline</b><br><b><a href='uarcc.php' >Consulta</a></b>");

      } else if (off_on_UAR11 === 'on' && power_UAR11 === 0 && bateria_UAR11 <= 11500) {
        marker_UAR11.bindPopup("<b>C.C</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR11U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR11U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR11_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data: <?php echo $rowUAR11_dados['Time_Stamp']; ?></b><br><b><a href='uarcc.php' >Consulta</a></b><br>");
        marker_UAR11_mobile.bindPopup("<b>C.C</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR11U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR11U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR11_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:yellow'>Sistema Ligado (Bateria Fraca)</b><br><b>Data:<?php echo $rowUAR11_dados['Time_Stamp']; ?></b><br><b><a href='uarcc.php' >Consulta</a></b><br>");


      } else if (off_on_UAR11 === 'on' && power_UAR11 === 0 && bateria_UAR11 > 11500) {
        marker_UAR11.bindPopup("<b>C.C</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR11U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR11U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR11_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR11_dados['Time_Stamp']; ?></b><br><b><a href='uarcc.php' >Consulta</a></b><br>");
        marker_UAR11_mobile.bindPopup("<b>C.C</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR11U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR11U['Potencial_Off']; ?> + " mV<br><?php ?><b>Battery Level: </b>" + <?php echo $rowUAR11_dados['Battery_Level'] / 1000; ?> + " V<br><b style='color:green'>Sistema Ligado (Bateria)</b><br><b>Data: <?php echo $rowUAR11_dados['Time_Stamp']; ?></b><br><b><a href='uarcc.php' >Consulta</a></b><br>");


      } else if (off_on_UAR11 === 'on' && power_UAR11 === 1) {
        marker_UAR11.bindPopup("<b>C.C</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR11U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR11U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR11_dados['Time_Stamp']; ?></b><br><b><a href='uarcc.php' >Consulta</a></b>");
        marker_UAR11_mobile.bindPopup("<b>C.C</b><br><b>CH1_Uon: </b>" + <?php echo $rowUAR11U['Potencial_On']; ?> + " mV<br><b>CH1_Uoff: </b>" + <?php echo $rowUAR11U['Potencial_Off']; ?> + " mV<br><b style='color:green'>Sistema Ligado (Energia)</b><br><b>Data: <?php echo $rowUAR11_dados['Time_Stamp']; ?></b><br><b><a href='uarcc.php' >Consulta</a></b>");

      }





      //UPCs ---->

      var marker3 = L.marker([40.765022, -8.589547], {
        icon: <?php if ($systemPovoa == 1) {
                echo "greenIcon";
              } else if ($systemPovoa == 0) {
                echo "redIcon";
              } ?>
      }).addTo(mymapmobile);
      var marker4 = L.marker([40.657515, -8.713612], {
        icon: <?php if ($systemAveiro == 1) {
                echo "greenIcon";
              } else if ($systemAveiro == 0) {
                echo "redIcon";
              } ?>
      }).addTo(mymapmobile);
      //dados Povoa
      marker.bindPopup("<b>UPC Póvoa</b><br><b>VOUT: </b><?php echo $voutPovoa; ?> V<br><b>IOUT: </b><?php echo $ioutPovoa; ?> A<br><b>UREF: </b><?php echo $urefPovoa; ?> V<br><b>UREF ON: </b><?php echo $urefOnPovoa; ?> V<br><b>UREF OFF: </b><?php echo $urefOffPovoa; ?> V<br><b>Sinal: </b><?php echo $sinalPovoa; ?> dbm | <b>BER: </b><?php echo $berPovoa; ?><br><b>Data:</b><?php echo $timePovoa; ?><br><a href='https://cires2biot.pt/monotorizacao.php'>Monitorização</a>");
      //dados Aveiro
      marker2.bindPopup("<b>UPC Aveiro </b></br><b>VOUT: </b><?php echo $voutAveiro; ?> V<br><b>IOUT: </b><?php echo $ioutAveiro; ?> A<br><b>UREF: </b><?php echo $urefAveiro; ?> V<br><b>UREF ON: </b><?php echo $urefOnAveiro; ?> V<br><b>UREF OFF: </b><?php echo $urefOffAveiro; ?> V<br><b>Sinal: </b><?php echo $sinalAveiro; ?> dbm | <b>BER: </b><?php echo $berAveiro; ?><br><b>Data:</b><?php echo $timeAveiro; ?><br><a href='https://cires2biot.pt/monotorizacao.php'>Monitorização</a>");

      marker3.bindPopup("<b>UPC Póvoa</b><br><b>VOUT: </b><?php echo $voutPovoa; ?> V<br><b>IOUT: </b><?php echo $ioutPovoa; ?> A<br><b>UREF: </b><?php echo $urefPovoa; ?> V<br><b>UREF ON: </b><?php echo $urefOnPovoa; ?> V<br><b>UREF OFF: </b><?php echo $urefOffPovoa; ?> V<br><b>Sinal: </b><?php echo $sinalPovoa; ?> dbm | <b>BER: </b><?php echo $berPovoa; ?><br><b>Data:</b><?php echo $timePovoa; ?><br><a href='https://cires2biot.pt/monotorizacao.php'>Monitorização</a>");
      //dados Aveiro
      marker4.bindPopup("<b>UPC Aveiro </b></br><b>VOUT: </b><?php echo $voutAveiro; ?> V<br><b>IOUT: </b><?php echo $ioutAveiro; ?> A<br><b>UREF: </b><?php echo $urefAveiro; ?> V<br><b>UREF ON: </b><?php echo $urefOnAveiro; ?> V<br><b>UREF OFF: </b><?php echo $urefOffAveiro; ?> V<br><b>Sinal: </b><?php echo $sinalAveiro; ?> dbm | <b>BER: </b><?php echo $berAveiro; ?><br><b>Data:</b><?php echo $timeAveiro; ?><br><a href='https://cires2biot.pt/monotorizacao.php'>Monitorização</a>");
    </script>

    <div>
      <table class="table">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Date/time</th>
            <th>Vout [V]</th>
            <th>Iout [A]</th>
            <th>Uref [V]</th>
            <th>Uref_ON [V]</th>
            <th>Uref_OFF [V]</th>
            <th>Sinal [dBm]</th>
            <th>BER</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Aveiro</td>
            <td><?php echo $timeAveiro; ?></td>
            <td><?php echo $voutAveiro; ?></td>
            <td><?php echo $ioutAveiro; ?></td>
            <td><?php echo $urefAveiro; ?></td>
            <td><?php echo $urefOnAveiro; ?></td>
            <td><?php echo $urefOffAveiro; ?></td>
            <td><?php echo $sinalAveiro; ?></td>
            <td><?php echo $berAveiro; ?></td>
          </tr>
          <tr>
            <td>Póvoa</td>
            <td><?php echo $timePovoa; ?></td>
            <td><?php echo $voutPovoa; ?></td>
            <td><?php echo $ioutPovoa; ?></td>
            <td><?php echo $urefPovoa; ?></td>
            <td><?php echo $urefOnPovoa; ?></td>
            <td><?php echo $urefOffPovoa; ?></td>
            <td><?php echo $sinalPovoa; ?></td>
            <td><?php echo $berPovoa; ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <br><br><br>

    <div>
      <table class="table">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Date/time</th>
            <th>CH1_Uon [V]</th>
            <th>CH1_Uoff [V]</th>
            <th>Power [V]</th>
            <th>Sinal [dBm]</th>
            <th>BER</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Aveiro</td>
            <td><?php echo $rowUAR1_dados['Time_Stamp']; ?></td>
            <td><?php echo $rowUAR1U['Potencial_On'] / 1000; ?></td>
            <td><?php echo $rowUAR1U['Potencial_Off'] / 1000; ?></td>
            <td><?php echo $rowUAR1_dados['Battery_Level'] / 1000; ?></td>
            <td><?php echo $rowUAR1_dados['RSSI']; ?></td>
            <td><?php echo $rowUAR1_dados['BER']; ?></td>
          </tr>
          <tr>
            <td>M. Garras</td>
            <td><?php echo $rowUAR5_dados['Time_Stamp']; ?></td>
            <td><?php echo $rowUAR5U['Potencial_On'] / 1000; ?></td>
            <td><?php echo $rowUAR5U['Potencial_Off'] / 1000; ?></td>
            <td><?php echo $rowUAR5_dados['Battery_Level'] / 1000; ?></td>
            <td><?php echo $rowUAR5_dados['RSSI']; ?></td>
            <td><?php echo $rowUAR5_dados['BER']; ?></td>
          </tr>
          <tr>
            <td>Testada</td>
            <td><?php echo $rowUAR6_dados['Time_Stamp']; ?></td>
            <td><?php echo $rowUAR6U['Potencial_On'] / 1000; ?></td>
            <td><?php echo $rowUAR6U['Potencial_Off'] / 1000; ?></td>
            <td><?php echo $rowUAR6_dados['Battery_Level'] / 1000; ?></td>
            <td><?php echo $rowUAR6_dados['RSSI']; ?></td>
            <td><?php echo $rowUAR6_dados['BER']; ?></td>
          </tr>
          <tr>
            <td>CX2</td>
            <td><?php echo $rowUAR4_dados['Time_Stamp']; ?></td>
            <td><?php echo $rowUAR4U['Potencial_On'] / 1000; ?></td>
            <td><?php echo $rowUAR4U['Potencial_Off'] / 1000; ?></td>
            <td><?php echo $rowUAR4_dados['Battery_Level'] / 1000; ?></td>
            <td><?php echo $rowUAR4_dados['RSSI']; ?></td>
            <td><?php echo $rowUAR4_dados['BER']; ?></td>
          </tr>
          <tr>
            <td>Chegado</td>
            <td><?php echo $rowUAR7_dados['Time_Stamp']; ?></td>
            <td><?php echo $rowUAR7U['Potencial_On'] / 1000; ?></td>
            <td><?php echo $rowUAR7U['Potencial_Off'] / 1000; ?></td>
            <td><?php echo $rowUAR7_dados['Battery_Level'] / 1000; ?></td>
            <td><?php echo $rowUAR7_dados['RSSI']; ?></td>
            <td><?php echo $rowUAR7_dados['BER']; ?></td>
          </tr>
          <tr>
            <td>E.Vieiros</td>
            <td><?php echo $rowUAR8_dados['Time_Stamp']; ?></td>
            <td><?php echo $rowUAR8U['Potencial_On'] / 1000; ?></td>
            <td><?php echo $rowUAR8U['Potencial_Off'] / 1000; ?></td>
            <td><?php echo $rowUAR8_dados['Battery_Level'] / 1000; ?></td>
            <td><?php echo $rowUAR8_dados['RSSI']; ?></td>
            <td><?php echo $rowUAR8_dados['BER']; ?></td>
          </tr>
          <tr>
            <td>CUF</td>
            <td><?php echo $rowUAR9_dados['Time_Stamp']; ?></td>
            <td><?php echo $rowUAR9U['Potencial_On'] / 1000; ?></td>
            <td><?php echo $rowUAR9U['Potencial_Off'] / 1000; ?></td>
            <td><?php echo $rowUAR9_dados['Battery_Level'] / 1000; ?></td>
            <td><?php echo $rowUAR9_dados['RSSI']; ?></td>
            <td><?php echo $rowUAR9_dados['BER']; ?></td>
          </tr>
          <tr>
            <td>Póvoa</td>
            <td><?php echo $rowUAR2_dados['Time_Stamp']; ?></td>
            <td><?php echo $rowUAR2U['Potencial_On'] / 1000; ?></td>
            <td><?php echo $rowUAR2U['Potencial_Off'] / 1000; ?></td>
            <td><?php echo $rowUAR2_dados['Battery_Level'] / 1000; ?></td>
            <td><?php echo $rowUAR2_dados['RSSI']; ?></td>
            <td><?php echo $rowUAR2_dados['BER']; ?></td>
          </tr>
          <tr>
            <td>LCP</td>
            <td><?php echo $rowUAR10_dados['Time_Stamp']; ?></td>
            <td><?php echo $rowUAR10U['Potencial_On'] / 1000; ?></td>
            <td><?php echo $rowUAR10U['Potencial_Off'] / 1000; ?></td>
            <td><?php echo $rowUAR10_dados['Battery_Level'] / 1000; ?></td>
            <td><?php echo $rowUAR10_dados['RSSI']; ?></td>
            <td><?php echo $rowUAR10_dados['BER']; ?></td>
          </tr>
          <tr>
            <td>CC</td>
            <td><?php echo $rowUAR11_dados['Time_Stamp']; ?></td>
            <td><?php echo $rowUAR11U['Potencial_On'] / 1000; ?></td>
            <td><?php echo $rowUAR11U['Potencial_Off'] / 1000; ?></td>
            <td><?php echo $rowUAR11_dados['Battery_Level'] / 1000; ?></td>
            <td><?php echo $rowUAR11_dados['RSSI']; ?></td>
            <td><?php echo $rowUAR11_dados['BER']; ?></td>
          </tr>
          <tr>
            <td>Cires</td>
            <td><?php echo $rowUAR3_dados['Time_Stamp']; ?></td>
            <td><?php echo $rowUAR3U['Potencial_On'] / 1000; ?></td>
            <td><?php echo $rowUAR3U['Potencial_Off'] / 1000; ?></td>
            <td><?php echo $rowUAR3_dados['Battery_Level'] / 1000; ?></td>
            <td><?php echo $rowUAR3_dados['RSSI']; ?></td>
            <td><?php echo $rowUAR3_dados['BER']; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    </main>
        <!--Fim da main-->
        
    </div>



    <script src="../js/index3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>

</html>