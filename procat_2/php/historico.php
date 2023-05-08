<?php

session_start();
require('db_connection.php');
//if ($_SESSION['logged'] != true) {//verificacao se tem login feito
//  $_SESSION['erro'] = "Não tem sessão iniciada. Inicie sessão para continuar.";
//echo "<META HTTP-EQUIV=\"refresh\" content=\"2; URL=login.php\"> ";
//} else {


$nome = $_SESSION['nome'];
$Serial_Number_Povoa = "032E280C4321000002";
$Serial_Number_Aveiro = "018E22DC44F1000003";
//BUSCAR TODOS OS DADOS RELATIVOS SOBRE OS ALERTAS E RESPETIVAS INSERIMENTO DE DADOS NA BD

$dataFinal = date('Y/m/d', strtotime('+1 days'));  // data final dia de hoje +1 dia
$dataInicial = date('Y/m/d', strtotime('-30 days')); // data inicial dia de hoje -30 dias ou seja ultimo mes


$date = date('Y-m-d H:i:s');
$month = date("n", strtotime($date));
$year = date("o", strtotime($date));

$prevDate = date("Y-m-d H:i:s", strtotime("-1 month"));
$prevMonth = date("n", strtotime($prevDate));

$prevYear = date("o", strtotime($prevDate));



$queryAveiro = "SELECT SUM(TRAFFIC) AS valor FROM `UPR_Status` WHERE Serial_Number='$Serial_Number_Aveiro' AND Month='$prevMonth' AND Year='$prevYear'";
$resultAveiro = mysqli_query($con, $queryAveiro) or die(mysqli_error($con));
$rowAveiro = mysqli_fetch_assoc($resultAveiro);
$trafegoAveiro = number_format(($rowAveiro['valor'] / 1048576), 2, '.', '');


if ($month > $prevMonth || $year > $prevYear) {
  $query2 = "SELECT Serial_Number,Month,Year,Valor FROM `ProCat_Comm` WHERE Serial_Number='$Serial_Number_Aveiro' AND Month='$prevMonth' AND Year='$prevYear'";
  $resultAveiro2 = mysqli_query($con, $query2) or die(mysqli_error($con));
  $rowAveiro2 = mysqli_fetch_assoc($resultAveiro2);
  $valor = $rowAveiro2['Valor'];

  if ($valor == 0 || $valor == "" || $valor == null || !isset($valor)) {
    $query = "INSERT INTO `ProCat_Comm`(Serial_Number,Year,Month,Traffic_Data,Valor) VALUES ('$Serial_Number_Aveiro','$year','$prevMonth','$trafegoAveiro',1)";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
  }
}

$date2 = date('Y-m-d H:i:s');
$month2 = date("n", strtotime($date2));
$year2 = date("o", strtotime($date2));

$prevDate2 = date("Y-m-d H:i:s", strtotime("-1 month"));
$prevMonth2 = date("n", strtotime($prevDate2));

$prevYear2 = date("o", strtotime($prevDate2));



$queryPovoa = "SELECT SUM(TRAFFIC) AS valor FROM `UPR_Status` WHERE Serial_Number='$Serial_Number_Povoa' AND Month='$prevMonth2'AND Year='$prevYear2' ";
$resultPovoa = mysqli_query($con, $queryPovoa) or die(mysqli_error($con));
$rowPovoa = mysqli_fetch_assoc($resultPovoa);
$trafegoPovoa = number_format(($rowPovoa['valor'] / 1048576), 2, '.', '');


if ($month2 > $prevMonth2 || $year2 > $prevYear2) {
  $query5 = "SELECT Serial_Number,Month,Valor FROM `ProCat_Comm` WHERE Serial_Number='$Serial_Number_Povoa' AND Month='$prevMonth2' AND Year ='$prevYear2'";
  $resultPovoa2 = mysqli_query($con, $query5) or die(mysqli_error($con));
  $rowPovoa2 = mysqli_fetch_assoc($resultPovoa2);
  $valor2 = $rowPovoa2['Valor'];

  if ($valor2 == 0 || $valor2 == "") {
    $query6 = "INSERT INTO `ProCat_Comm`(Serial_Number,Year,Month,Traffic_Data,Valor) VALUES ('$Serial_Number_Povoa','$prevYear2','$prevMonth2','$trafegoPovoa',1)";
    $result6 = mysqli_query($con, $query6) or die(mysqli_error($con));
  }
}
// DADOS RELATIVAMENTE AO HISTORICO DE ALERTAS

//querys Povoa
$queryAlarmFuseUrefPovoa = "SELECT Time_Stamp, Alarm_Fuse_UREF FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_Fuse_UREF=1 ";
$queryAlarmTRPovoa = "SELECT Time_Stamp, Alarm_TR FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_TR=1 ";
$queryAlarmFusePositivePovoa = "SELECT Time_Stamp, Alarm_Fuse_Positive FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_Fuse_Positive=1 ";
$queryAlarmFuseNegativePovoa = "SELECT Time_Stamp, Alarm_Fuse_Negative FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_Fuse_Negative=1 ";
$queryAlarmUMAXPovoa = "SELECT Time_Stamp, Alarm_UMAX FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_UMAX=1 ";
$queryAlarmIMAXPovoa = "SELECT Time_Stamp, Alarm_IMAX FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_IMAX=1 ";
$queryAlarmUREFPovoa = "SELECT Time_Stamp, Alarm_UREF FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_UREF=1 ";
$queryAlarmGPSPovoa = "SELECT Time_Stamp, Alarm_GPS FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Povoa' AND Alarm_GPS=1 ";

//execute querys Povoa
$resultAlarmFuseUrefPovoa = mysqli_query($con, $queryAlarmFuseUrefPovoa) or die(mysqli_error($con));
$resultAlarmTRPovoa = mysqli_query($con, $queryAlarmTRPovoa) or die(mysqli_error($con));
$resultAlarmFusePositivePovoa = mysqli_query($con, $queryAlarmFusePositivePovoa) or die(mysqli_error($con));
$resultAlarmFuseNegativePovoa = mysqli_query($con, $queryAlarmFuseNegativePovoa) or die(mysqli_error($con));
$resultAlarmUMAXPovoa = mysqli_query($con, $queryAlarmUMAXPovoa) or die(mysqli_error($con));
$resultAlarmIMAXPovoa = mysqli_query($con, $queryAlarmIMAXPovoa) or die(mysqli_error($con));
$resultAlarmUREFPovoa = mysqli_query($con, $queryAlarmUREFPovoa) or die(mysqli_error($con));
$resultAlarmGPSPovoa = mysqli_query($con, $queryAlarmGPSPovoa) or die(mysqli_error($con));

//querys Aveiro
$queryAlarmFuseUrefAveiro = "SELECT Time_Stamp, Alarm_Fuse_UREF FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_Fuse_UREF=1 ";
$queryAlarmTRAveiro = "SELECT Time_Stamp, Alarm_TR FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_TR=1 ";
$queryAlarmFusePositiveAveiro = "SELECT Time_Stamp, Alarm_Fuse_Positive FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_Fuse_Positive=1 ";
$queryAlarmFuseNegativeAveiro = "SELECT Time_Stamp, Alarm_Fuse_Negative FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_Fuse_Negative=1 ";
$queryAlarmUMAXAveiro = "SELECT Time_Stamp, Alarm_UMAX FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_UMAX=1 ";
$queryAlarmIMAXAveiro = "SELECT Time_Stamp, Alarm_IMAX FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_IMAX=1 ";
$queryAlarmUREFAveiro = "SELECT Time_Stamp, Alarm_UREF FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_UREF=1 ";
$queryAlarmGPSAveiro = "SELECT Time_Stamp, Alarm_GPS FROM `UPR_Status` WHERE Time_Stamp BETWEEN '$dataInicial' AND '$dataFinal' AND Serial_Number='$Serial_Number_Aveiro' AND Alarm_GPS=1 ";

//execute querys Aveiro
$resultAlarmFuseUrefAveiro = mysqli_query($con, $queryAlarmFuseUrefAveiro) or die(mysqli_error($con));
$resultAlarmTRAveiro = mysqli_query($con, $queryAlarmTRAveiro) or die(mysqli_error($con));
$resultAlarmFusePositiveAveiro = mysqli_query($con, $queryAlarmFusePositiveAveiro) or die(mysqli_error($con));
$resultAlarmFuseNegativeAveiro = mysqli_query($con, $queryAlarmFuseNegativeAveiro) or die(mysqli_error($con));
$resultAlarmUMAXAveiro = mysqli_query($con, $queryAlarmUMAXAveiro) or die(mysqli_error($con));
$resultAlarmIMAXAveiro = mysqli_query($con, $queryAlarmIMAXAveiro) or die(mysqli_error($con));
$resultAlarmUREFAveiro = mysqli_query($con, $queryAlarmUREFAveiro) or die(mysqli_error($con));
$resultAlarmGPSAveiro = mysqli_query($con, $queryAlarmGPSAveiro) or die(mysqli_error($con));



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HISTÓRICO</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/cssdeteste.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">


    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="../css/jquery-ui.css">
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap CSS --> <!--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
-->
  <script src="../js/jquery-ui.js"></script>

  <script>
    $(document).ready(function() {

      $.datepicker.regional['pt'] = {
        clearText: 'Apagar',
        clearStatus: '',
        closeText: 'Fechar',
        closeStatus: 'Fechar sem guardar',
        prevText: '<Anterior',
        prevStatus: 'Ver mês anterior',
        nextText: 'Seguinte>',
        nextStatus: 'Ver mês seguinte',
        currentText: 'Atual',
        currentStatus: 'Ver mês atual',
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
          'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',
          'Jul', 'Aug', 'Set', 'Out', 'Nov', 'Dez'
        ],
        monthStatus: 'Ver outro mês',
        yearStatus: 'Ver outro ano',
        weekHeader: 'Sm',
        weekStatus: '',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
        dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
        dayStatus: 'Utilizar DD como primeiro dia da semana',
        dateStatus: 'Escolher  DD, MM d',
        dateFormat: 'yy/mm/dd',
        firstDay: 0,
        initStatus: 'Escolher uma data',
        isRTL: false
      };
      $.datepicker.setDefaults($.datepicker.regional['pt']); //define o calendario para portugues
      var tableUsers = $('#datatableUsers').DataTable({
        "oLanguage": {
          "sEmptyTable": "Nenhum registo encontrado",
          "sInfo": "A Mostrar  _START_ até _END_ de _TOTAL_ registos",
          "sInfoEmpty": "A Mostrar de 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "A cargar dados...",
          "sProcessing": "A Processar...",
          "sZeroRecords": "Nenhum registo encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
          },
          "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
          }
        },
        "ajax": "updateHistoricoUsers.php",
        "bPaginate": true,
        "bProcessing": true,
        "pageLength": 5,
        "columns": [{
            mData: 'data'
          },
          {
            mData: 'nome'
          }


        ]
      });


      var tablePovoa = $('#datatablePovoa').DataTable({
        "oLanguage": {
          "sEmptyTable": "Nenhum registo encontrado",
          "sInfo": "A Mostrar  _START_ até _END_ de _TOTAL_ registos",
          "sInfoEmpty": "A Mostrar de 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "A cargar dados...",
          "sProcessing": "A Processar...",
          "sZeroRecords": "Nenhum registo encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
          },
          "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
          }
        },
        "ajax": "updateHistoricoPovoa.php",
        "bPaginate": true,
        "bProcessing": true,
        "pageLength": 5,
        "columns": [{
            mData: 'data'
          },
          {
            mData: 'alarme'
          },
          {
            mData: 'adic'
          }

        ],

        createdRow: function() {
          this.api().columns([1]).every(function() {
            var column = this;
            var select = $('<select><option value="">Alarmes</option></select>')
              .appendTo($(column.header()).empty())
              .on('change', function() {
                var val = $.fn.dataTable.util.escapeRegex(
                  $(this).val()
                );

                column
                  .search(val ? '^' + val + '$' : '', true, false)
                  .draw();
              });

            column.data().unique().sort().each(function(d, j) {
              select.append('<option value="' + d + '">' + d + '</option>')
            });
          });
        }

      });


      var tableAveiro = $('#datatableAveiro').DataTable({
        "oLanguage": {
          "sEmptyTable": "Nenhum registo encontrado",
          "sInfo": "A Mostrar  _START_ até _END_ de _TOTAL_ registos",
          "sInfoEmpty": "A Mostrar de 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "A cargar dados...",
          "sProcessing": "A Processar...",
          "sZeroRecords": "Nenhum registo encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
          },
          "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
          }
        },
        "ajax": "updateHistoricoAveiro.php",
        "bPaginate": true,
        "bProcessing": true,
        "pageLength": 5,
        "columns": [{
            mData: 'data'
          },
          {
            mData: 'alarme'
          },
          {
            mData: 'adic'
          }


        ],
        createdRow: function() {
          this.api().columns([1]).every(function() {
            var column = this;
            var select = $('<select><option value="">Alarmes</option></select>')
              .appendTo($(column.header()).empty())
              .on('change', function() {
                var val = $.fn.dataTable.util.escapeRegex(
                  $(this).val()
                );

                column
                  .search(val ? '^' + val + '$' : '', true, false)
                  .draw();
              });

            column.data().unique().sort().each(function(d, j) {
              select.append('<option value="' + d + '">' + d + '</option>')
            });
          });
        }

      });
      $("#dataInicialUsers").datepicker({
        showOn: "button",
        buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
        buttonImageOnly: true,
        "onSelect": function(date) {
          minDateFilterUsers = new Date(date).getTime();
          tableUsers.draw();
        }
      }).keyup(function() {
        minDateFilterUsers = new Date(this.value).getTime();
        tableUsers.draw();
      });

      $("#dataFinalUsers").datepicker({
        showOn: "button",
        buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
        buttonImageOnly: true,
        "onSelect": function(date) {
          maxDateFilterUsers = new Date(date).getTime();
          tableUsers.draw();
        }
      }).keyup(function() {
        maxDateFilterUsers = new Date(this.value).getTime();
        tableUsers.draw();
      });


      minDateFilterUsers = "";
      maxDateFilterUsers = "";

      $("#dataInicialAveiro").datepicker({
        showOn: "button",
        buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
        buttonImageOnly: true,
        "onSelect": function(date) {
          minDateFilterAveiro = new Date(date).getTime();
          tableAveiro.draw();
        }
      }).keyup(function() {
        minDateFilterAveiro = new Date(this.value).getTime();
        tableAveiro.draw();
      });

      $("#dataFinalAveiro").datepicker({
        showOn: "button",
        buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
        buttonImageOnly: true,
        "onSelect": function(date) {
          maxDateFilterAveiro = new Date(date).getTime();
          tableAveiro.draw();
        }
      }).keyup(function() {
        maxDateFilterAveiro = new Date(this.value).getTime();
        tableAveiro.draw();
      });


      minDateFilterAveiro = "";
      maxDateFilterAveiro = "";


      $("#dataInicialPovoa").datepicker({
        showOn: "button",
        buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
        buttonImageOnly: true,
        "onSelect": function(date) {
          minDateFilterPovoa = new Date(date).getTime();
          tablePovoa.draw();
        }
      }).keyup(function() {
        minDateFilterPovoa = new Date(this.value).getTime();
        tablePovoa.draw();
      });

      $("#dataFinalPovoa").datepicker({
        showOn: "button",
        buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
        buttonImageOnly: true,
        "onSelect": function(date) {
          maxDateFilterPovoa = new Date(date).getTime();
          tablePovoa.draw();
        }
      }).keyup(function() {
        maxDateFilterPovoa = new Date(this.value).getTime();
        tablePovoa.draw();
      });


      minDateFilterPovoa = "";
      maxDateFilterPovoa = "";


      $.fn.dataTableExt.afnFiltering.push(
        function(oSettings, aData, iDataIndex) {
          if (typeof aData._date == 'undefined') {
            aData._date = new Date(aData[0]).getTime();
          }

          if (minDateFilterAveiro && !isNaN(minDateFilterAveiro)) {
            if (aData._date < minDateFilterAveiro) {
              return false;
            }
          }

          if (maxDateFilterAveiro && !isNaN(maxDateFilterAveiro)) {
            if (aData._date > maxDateFilterAveiro) {
              return false;
            }
          }

          return true;
        }
      );

      $.fn.dataTableExt.afnFiltering.push(
        function(oSettings, aData, iDataIndex) {
          if (typeof aData._date == 'undefined') {
            aData._date = new Date(aData[0]).getTime();
          }

          if (minDateFilterUsers && !isNaN(minDateFilterUsers)) {
            if (aData._date < minDateFilterUsers) {
              return false;
            }
          }

          if (maxDateFilterUsers && !isNaN(maxDateFilterUsers)) {
            if (aData._date > maxDateFilterUsers) {
              return false;
            }
          }

          return true;
        }
      );

      $.fn.dataTableExt.afnFiltering.push(
        function(oSettings, aData, iDataIndex) {
          if (typeof aData._date == 'undefined') {
            aData._date = new Date(aData[0]).getTime();
          }

          if (minDateFilterPovoa && !isNaN(minDateFilterPovoa)) {
            if (aData._date < minDateFilterPovoa) {
              return false;
            }
          }

          if (maxDateFilterPovoa && !isNaN(maxDateFilterPovoa)) {
            if (aData._date > maxDateFilterPovoa) {
              return false;
            }
          }

          return true;
        }
      );





      //buscar dados relativamente ao Historico na povoa
      $.ajax({
        url: "buscarDadosHistorico.php?local=povoa&valor=Alarm_GPS",
        success: function(data) {
          var myObj = JSON.parse(data);

          for (var i = 0; i < myObj.data.length; i++) {
            tablePovoa.row.add({
              "data": myObj.data[i],
              "alarme": myObj.alarme[i],
              "adic": myObj.adic[i]

            }).draw();
          }
        }
      });

      $.ajax({
        url: "buscarDadosHistorico.php?local=povoa&valor=Alarm_UREF",
        success: function(data) {
          var myObj = JSON.parse(data);
          for (var i = 0; i < myObj.data.length; i++) {
            tablePovoa.row.add({
              "data": myObj.data[i],
              "alarme": myObj.alarme[i],
              "adic": myObj.adic[i]

            }).draw();
          }
        }
      });

      $.ajax({
        url: "buscarDadosHistorico.php?local=povoa&valor=Alarm_IMAX",
        success: function(data) {
          var myObj = JSON.parse(data);
          for (var i = 0; i < myObj.data.length; i++) {
            tablePovoa.row.add({
              "data": myObj.data[i],
              "alarme": myObj.alarme[i],
              "adic": myObj.adic[i]

            }).draw();
          }
        }
      });
      $.ajax({
        url: "buscarDadosHistorico.php?local=povoa&valor=Alarm_UMAX",
        success: function(data) {
          var myObj = JSON.parse(data);
          for (var i = 0; i < myObj.data.length; i++) {
            tablePovoa.row.add({
              "data": myObj.data[i],
              "alarme": myObj.alarme[i],
              "adic": myObj.adic[i]

            }).draw();
          }
        }
      });

      $.ajax({
        url: "buscarDadosHistorico.php?local=povoa&valor=Alarm_Fuse_Positive",
        success: function(data) {
          var myObj = JSON.parse(data);
          for (var i = 0; i < myObj.data.length; i++) {
            tablePovoa.row.add({
              "data": myObj.data[i],
              "alarme": myObj.alarme[i],
              "adic": myObj.adic[i]

            }).draw();
          }
        }
      });

      $.ajax({
        url: "buscarDadosHistorico.php?local=povoa&valor=Alarm_Fuse_Negative",
        success: function(data) {
          var myObj = JSON.parse(data);
          for (var i = 0; i < myObj.data.length; i++) {
            tablePovoa.row.add({
              "data": myObj.data[i],
              "alarme": myObj.alarme[i],
              "adic": myObj.adic[i]

            }).draw();
          }
        }
      });
      $.ajax({
        url: "buscarDadosHistorico.php?local=povoa&valor=Alarm_TR",
        success: function(data) {
          var myObj = JSON.parse(data);
          for (var i = 0; i < myObj.data.length; i++) {
            tablePovoa.row.add({
              "data": myObj.data[i],
              "alarme": myObj.alarme[i],
              "adic": myObj.adic[i]

            }).draw();
          }
        }
      });


      //Buscar dados relativamente ao historico em Aveiro
      $.ajax({
        url: "buscarDadosHistorico.php?local=aveiro&valor=Alarm_GPS",
        success: function(data) {
          var myObj = JSON.parse(data);

          for (var i = 0; i < myObj.data.length; i++) {
            tableAveiro.row.add({
              "data": myObj.data[i],
              "alarme": myObj.alarme[i],
              "adic": myObj.adic[i]

            }).draw();
          }
        }
      });

      $.ajax({
        url: "buscarDadosHistorico.php?local=aveiro&valor=Alarm_UREF",
        success: function(data) {
          var myObj = JSON.parse(data);
          for (var i = 0; i < myObj.data.length; i++) {
            tableAveiro.row.add({
              "data": myObj.data[i],
              "alarme": myObj.alarme[i],
              "adic": myObj.adic[i]

            }).draw();
          }
        }
      });

      $.ajax({
        url: "buscarDadosHistorico.php?local=aveiro&valor=Alarm_IMAX",
        success: function(data) {
          var myObj = JSON.parse(data);
          for (var i = 0; i < myObj.data.length; i++) {
            tableAveiro.row.add({
              "data": myObj.data[i],
              "alarme": myObj.alarme[i],
              "adic": myObj.adic[i]

            }).draw();
          }
        }
      });
      $.ajax({
        url: "buscarDadosHistorico.php?local=aveiro&valor=Alarm_UMAX",
        success: function(data) {
          var myObj = JSON.parse(data);
          for (var i = 0; i < myObj.data.length; i++) {
            tableAveiro.row.add({
              "data": myObj.data[i],
              "alarme": myObj.alarme[i],
              "adic": myObj.adic[i]

            }).draw();
          }
        }
      });

      $.ajax({
        url: "buscarDadosHistorico.php?local=aveiro&valor=Alarm_Fuse_Positive",
        success: function(data) {
          var myObj = JSON.parse(data);
          for (var i = 0; i < myObj.data.length; i++) {
            tableAveiro.row.add({
              "data": myObj.data[i],
              "alarme": myObj.alarme[i],
              "adic": myObj.adic[i]

            }).draw();
          }
        }
      });

      $.ajax({
        url: "buscarDadosHistorico.php?local=aveiro&valor=Alarm_Fuse_Negative",
        success: function(data) {
          var myObj = JSON.parse(data);
          for (var i = 0; i < myObj.data.length; i++) {
            tableAveiro.row.add({
              "data": myObj.data[i],
              "alarme": myObj.alarme[i],
              "adic": myObj.adic[i]

            }).draw();
          }
        }
      });
      $.ajax({
        url: "buscarDadosHistorico.php?local=aveiro&valor=Alarm_TR",
        success: function(data) {
          var myObj = JSON.parse(data);
          for (var i = 0; i < myObj.data.length; i++) {
            tableAveiro.row.add({
              "data": myObj.data[i],
              "alarme": myObj.alarme[i],
              "adic": myObj.adic[i]

            }).draw();
          }
        }
      });




    });
  </script>



  <!--FUNCÃO BOTÃO ADICIONAR-->
  <style type="text/css">
    button {
      float: right;
    }
    
    /* Style for the table */
table {
  width: 100%;
  border-collapse: collapse;
}

/* Style for the table header */
thead {
  background-color: #333;
  color: #fff;
}

/* Style for the table header cells */
thead th {
  padding: 12px;
  text-align: left;
}

/* Style for the table body */
tbody {
  background-color: #f2f2f2;
}

/* Style for the table body cells */
tbody td {
  padding: 12px;
  text-align: left;
}

/* Style for the table striped rows */
tbody tr:nth-child(even) {
  background-color: #ddd;
}

/* Style for the input elements */
input {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

/* Style for the date labels */
.date-label {
  font-weight: bold;
  margin-right: 5px;
}

/* Style for the table headings */
h3 {
  /**/
  font-weight: bold;
  margin-top: 20px;
  margin-bottom: 10px;
}

/* Style for the strong tags */
strong {
  font-weight: bold;
  font-size: 1.5em;
}


  </style>

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
              <a href="index.php">
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
              <a href="historico.php" class="active">
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
            <h1 class="titulo">Histórico</h1>

<!--TABELA LISTA AVEIRO-->
<br />


<h3><strong>Alertas UPC Aveiro</strong></h3><br>

<span id="dataIa" class="date-label">Data Inicial: </span><input class="date_range_filter date hasDatepicker" type="text" id="dataInicialAveiro" />&ensp;&ensp;
<span id="dataFa" class="date-label">Data Final:</span><input class="date_range_filter date" type="text" id="dataFinalAveiro" /> &ensp;&ensp;<br><br>

<table class="table table-striped" id="datatableAveiro" class="display">

  <thead>
    <tr>
      <th>Data</th>
      <th>Alarme</th>
      <th>Valor</th>
    </tr>

  </thead>

</table>

<!--TABELA LISTA POVOA-->
<br /><br />

<h3><strong>Alertas UPC Póvoa</strong></h3><br>
<span id="dataIp" class="date-label">Data Inicial: </span><input class="date_range_filter date" type="text" id="dataInicialPovoa" />&ensp;&ensp;
<span id="dataFp" class="date-label">Data Final:</span><input class="date_range_filter date" type="text" id="dataFinalPovoa" /> &ensp;&ensp;<br><br>

<table class="table table-striped" id="datatablePovoa" class="display">
  <thead>
    <tr>
      <th>Data</th>
      <th>Alarme</th>
      <th>Valor</th>
    </tr>

  </thead>

</table>


<!--CONSUMOS AVEIRO-->
<br /><br />
<h3><strong>Consumos UPC Aveiro</strong></h3><br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Ano</th>
      <th>Mês</th>
      <th>Consumo (MB)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $resultAveiro = mysqli_query($con, "SELECT Traffic_Data,Month,Year FROM `ProCat_Comm` WHERE Serial_Number = '$Serial_Number_Aveiro' "); // using mysqli_query instead
    while ($res = mysqli_fetch_assoc($resultAveiro)) {
      if ($res['Month'] == 1) {
        echo "<tr>";
        echo "<td>" . $res['Year'] . "</td>";
        echo "<td>Janeiro</td>";
        echo "<td>" . $res['Traffic_Data'] . "</td>";
      }
      if ($res['Month'] == 2) {
        echo "<tr>";
        echo "<td>" . $res['Year'] . "</td>";
        echo "<td>Fevereiro</td>";
        echo "<td>" . $res['Traffic_Data'] . "</td>";
      }
      if ($res['Month'] == 3) {
        echo "<tr>";
        echo "<td>" . $res['Year'] . "</td>";
        echo "<td>Março</td>";
        echo "<td>" . $res['Traffic_Data'] . "</td>";
      }
      if ($res['Month'] == 4) {
        echo "<tr>";
        echo "<td>" . $res['Year'] . "</td>";
        echo "<td>Abril</td>";
        echo "<td>" . $res['Traffic_Data'] . "</td>";
      }
      if ($res['Month'] == 5) {
        echo "<tr>";
        echo "<td>" . $res['Year'] . "</td>";
        echo "<td>Maio</td>";
        echo "<td>" . $res['Traffic_Data'] . "</td>";
      }
      if ($res['Month'] == 6) {
        echo "<tr>";
        echo "<td>" . $res['Year'] . "</td>";
        echo "<td>Junho</td>";
        echo "<td>" . $res['Traffic_Data'] . "</td>";
      }
      if ($res['Month'] == 7) {
        echo "<tr>";
        echo "<td>" . $res['Year'] . "</td>";
        echo "<td>Julho</td>";
        echo "<td>" . $res['Traffic_Data'] . "</td>";
      }
      if ($res['Month'] == 8) {
        echo "<tr>";
        echo "<td>" . $res['Year'] . "</td>";
        echo "<td>Agosto</td>";
        echo "<td>" . $res['Traffic_Data'] . "</td>";
      }
      if ($res['Month'] == 9) {
        echo "<tr>";
        echo "<td>" . $res['Year'] . "</td>";
        echo "<td>Setembro</td>";
        echo "<td>" . $res['Traffic_Data'] . "</td>";
      }
      if ($res['Month'] == 10) {
        echo "<tr>";
        echo "<td>" . $res['Year'] . "</td>";
        echo "<td>Outubro</td>";
        echo "<td>" . $res['Traffic_Data'] . "</td>";
      }
      if ($res['Month'] == 11) {
        echo "<tr>";
        echo "<td>" . $res['Year'] . "</td>";
        echo "<td>Novembro</td>";
        echo "<td>" . $res['Traffic_Data'] . "</td>";
      }
      if ($res['Month'] == 12) {
        echo "<tr>";
        echo "<td>" . $res['Year'] . "</td>";
        echo "<td>Dezembro</td>";
        echo "<td>" . $res['Traffic_Data'] . "</td>";
      }
    }
    ?>

  </tbody>
</table>

<!--CONSUMOS POVOA-->
<br /><br />
<h3><strong>Consumos UPC Póvoa</strong></h3><br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Ano</th>
      <th>Mês</th>
      <th>Consumo (MB)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $resultPovoa = mysqli_query($con, "SELECT Year,Month,Traffic_Data FROM `ProCat_Comm` WHERE Serial_Number = '$Serial_Number_Povoa'");
    while ($res2 = mysqli_fetch_assoc($resultPovoa)) {
      if ($res2['Month'] == 1) {
        echo "<tr>";
        echo "<td>" . $res2['Year'] . "</td>";
        echo "<td>Janeiro</td>";
        echo "<td>" . $res2['Traffic_Data'] . "</td>";
      }
      if ($res2['Month'] == 2) {
        echo "<tr>";
        echo "<td>" . $res2['Year'] . "</td>";
        echo "<td>Fevereiro</td>";
        echo "<td>" . $res2['Traffic_Data'] . "</td>";
      }
      if ($res2['Month'] == 3) {
        echo "<tr>";
        echo "<td>" . $res2['Year'] . "</td>";
        echo "<td>Março</td>";
        echo "<td>" . $res2['Traffic_Data'] . "</td>";
      }
      if ($res2['Month'] == 4) {
        echo "<tr>";
        echo "<td>" . $res2['Year'] . "</td>";
        echo "<td>Abril</td>";
        echo "<td>" . $res2['Traffic_Data'] . "</td>";
      }
      if ($res2['Month'] == 5) {
        echo "<tr>";
        echo "<td>" . $res2['Year'] . "</td>";
        echo "<td>Maio</td>";
        echo "<td>" . $res2['Traffic_Data'] . "</td>";
      }
      if ($res2['Month'] == 6) {
        echo "<tr>";
        echo "<td>" . $res2['Year'] . "</td>";
        echo "<td>Junho</td>";
        echo "<td>" . $res2['Traffic_Data'] . "</td>";
      }
      if ($res2['Month'] == 7) {
        echo "<tr>";
        echo "<td>" . $res2['Year'] . "</td>";
        echo "<td>Julho</td>";
        echo "<td>" . $res2['Traffic_Data'] . "</td>";
      }
      if ($res2['Month'] == 8) {
        echo "<tr>";
        echo "<td>" . $res2['Year'] . "</td>";
        echo "<td>Agosto</td>";
        echo "<td>" . $res2['Traffic_Data'] . "</td>";
      }
      if ($res2['Month'] == 9) {
        echo "<tr>";
        echo "<td>" . $res2['Year'] . "</td>";
        echo "<td>Setembro</td>";
        echo "<td>" . $res2['Traffic_Data'] . "</td>";
      }
      if ($res2['Month'] == 10) {
        echo "<tr>";
        echo "<td>" . $res2['Year'] . "</td>";
        echo "<td>Outubro</td>";
        echo "<td>" . $res2['Traffic_Data'] . "</td>";
      }
      if ($res2['Month'] == 11) {
        echo "<tr>";
        echo "<td>" . $res2['Year'] . "</td>";
        echo "<td>Novembro</td>";
        echo "<td>" . $res2['Traffic_Data'] . "</td>";
      }
      if ($res2['Month'] == 12) {
        echo "<tr>";
        echo "<td>" . $res2['Year'] . "</td>";
        echo "<td>Dezembro</td>";
        echo "<td>" . $res2['Traffic_Data'] . "</td>";
      }
    }

    ?>

  </tbody>
</table>

<!--TABELA LISTA Utilizadores-->
<br />


<h3><strong>Registo de Logins</strong></h3><br>

<span id="dataIa" class="date-label">Data Inicial: </span><input class="date_range_filter date" type="text" id="dataInicialUsers" />&ensp;&ensp;
<span id="dataFa" class="date-label">Data Final:</span><input class="date_range_filter date" type="text" id="dataFinalUsers" /> &ensp;&ensp;<br><br>

<table class="table table-striped" id="datatableUsers" class="display">

  <thead>
    <tr>
      <th>Data</th>
      <th>Nome</th>

    </tr>

  </thead>

</table>




        </main>
        <!--Fim da main-->

    </div>



    <script src="../js/index3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>

</html>
<?php ?>