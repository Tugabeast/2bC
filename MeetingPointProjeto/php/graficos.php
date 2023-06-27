<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard-GVIR</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/cssdeteste.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dygraph/2.1.0/dygraph.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dygraph/2.1.0/dygraph.min.css" />

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
                <div class="close" id="close-btn-teste-mobile" >
                    <span class="material-symbols-sharp" onclick="closeNavMobile()" style="color: white;">close</span>
                </div>
            </div>
            <div class="sidebar" style="height: 120vh;">
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
                <p style="margin-top: 26rem; text-align: end; color: white;">Bem vindo, <?php echo $_SESSION['nome'];?></p>
                <a href="logout.php" id="traco">
                    <span class="material-symbols-sharp">logout</span>
                    <h3 id="logout">LOGOUT</h3>
                </a>
            </div>
        </aside>
        <!-- fim da sidebar -->
        <main>
            <h1 class="titulo" style="text-align: center;">GVIR STATUS</h1>
            <div class="containerphp" style="height: 70vh; display: block;" >
                <?php if(isset($_SESSION['mensagem'])): ?>
                <p id="mensagem" style="color: var(--color-sucess); text-align: center; font-size: 16px;"><?php echo $_SESSION['mensagem']; ?></p>
                <?php endif; ?>
                <?php if(isset($_SESSION['mensagemErro'])): ?>
                <p id="mensagemErro" style="color: var(--color-danger); text-align: center; font-size: 16px;"><?php echo $_SESSION['mensagemErro']; ?></p>
                <?php endif; ?>
               
                <table class="tabelacrud" id="tabelacrud1" style="width: 80% !important;">
                    <thead>
                        <tr style="background: #094b9b; color: white; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
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
                            // Consulta para obter a última linha da tabela 'gvir_status'
                            $sql = "SELECT * FROM `gvir_status` ORDER BY `datatime` DESC LIMIT 1";
                            $result = mysqli_query($connect, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td data-label = "Threshold H1">
                                <input type="hidden" name="TH_update_id[]" value="<?php echo $row['input'] ?>">
                                <input type="number" name="threshold_h1[]" value="<?php echo $row['threshold_h1'] ?>">
                            </td>
                            <td data-label = "Threshold H2"><input type="number" name="threshold_h2[]" value="<?php echo $row['threshold_h2'] ?>"></td>
                            <td data-label = "ID"><?php echo $row['id']?></td>
                            <td data-label = "Serial Number"><?php echo $row['serial_number']?></td>
                            <td data-label = "Datatime"><?php echo $row['datatime']?></td>
                            <td data-label = "Status"><?php echo $row['status']?></td>
                            <td data-label = "Gas Concentration"><?php echo $row['gas_concentration']?></td>
                            <td data-label = "Temperature"><?php echo $row['temperature']?></td>
                            <td data-label = "Response Factor"><?php echo $row['response_factor']?></td>
                            <td data-label = "Sensor Range"><?php echo $row['sensor_range']?></td>
                            <td data-label = "Cal 100"><?php echo $row['cal_100']?></td>
                            <td data-label = "Cal 3000"><?php echo $row['cal_3000']?></td>
                            <td data-label = "Flag_status"><?php echo $row['flag_status']?></td>
                            <td data-label = "Threshold H3">Definido no autómato</td>
                        </tr>           
                        <?php
                            }   
                        ?>
                        <button type="submit" class="btn-add" name="editarTH" id="editarTH" style="display: block; margin-bottom: 10px;">Submit thresholds</button>
                    </form>
                </table>
                <br>
                <form action="gerar_graficos.php" method="GET">
                    
                </form>
                <div id="graphdiv1" ></div>
                <script type="text/javascript">

                    // 1. Verifique se o arquivo temporário com os dados existe
                    var file = 'gas_data.json';
                    if (fileExists(file)) {
                        // 2. Carregue o arquivo JSON dos dados
                        loadJSON(file, function(jsonData) {
                        // 3. Verifique se existem dados
                        if (jsonData.length > 0) {
                            var graphData = JSON.parse(jsonData);

                            var graphDataArray = [];
                            for (var i = 0; i < graphData.length; i++) {
                                var value = Number(graphData[i]); // Certifique-se de que o valor seja convertido em um número
                                graphDataArray.push([i, value]);
                            }

                            // 4. Desenhe o gráfico usando Dygraph
                            var g = new Dygraph(
                                document.getElementById("graphdiv1"),
                                graphDataArray,
                                {
                                    xlabel: "Índice",
                                    ylabel: "Gas Concentration",
                                    labels: ["Índice", "Gas Concentration"],
                                    colors: ["blue"],
                                    connectSeparatedPoints: true,
                                    showRangeSelector: true, // Ativa o range selector
                                    rangeSelectorHeight: 100,
                                    rangeSelectorPlotLineWidth: 10,
                                    rangeSelectorForegroundLineWidth: 2,
                                    rangeSelectorWidth: -1000
                                     
                                }
                            );

                            // Selecione o elemento select
                            var selectElement = document.getElementById('gas_concentration');

                            // Adicione o evento de escuta para capturar a alteração de valor
                            selectElement.addEventListener('change', function() {
                            // Obtenha o valor selecionado
                            var selectedValue = parseInt(selectElement.value);

                            // Filtre os dados com base no valor selecionado
                            var filteredData = graphDataArray.filter(function(data) {
                                return data[1] <= selectedValue; // Filtre os dados para temperaturas menores ou iguais ao valor selecionado
                            });

                            // Obtenha o valor máximo para o eixo y
                            var maxYValue = Math.max(...filteredData.map(data => data[1]), selectedValue);

                            // Atualize o gráfico com os dados filtrados e valor máximo do eixo y atualizado
                            if (filteredData.length > 0) {
                                var lastIndex = filteredData.length - 1;
                                g.updateOptions({
                                    file: filteredData,
                                    dateWindow: [0, lastIndex + 1],
                                    valueRange: [0, maxYValue] // Atualize o valor máximo do eixo y
                                });
                            }
                            
                            
                            });
                        }
                        });
                    }

                    // Função para verificar se um arquivo existe
                    function fileExists(file) {
                        var xhr = new XMLHttpRequest();
                        xhr.open('HEAD', file, false);
                        xhr.send();
                        return xhr.status !== 404;
                    }

                    // Função para carregar um arquivo JSON
                    function loadJSON(file, callback) {
                        var xhr = new XMLHttpRequest();
                        xhr.overrideMimeType("application/json");
                        xhr.open('GET', file, true);
                        xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            console.log(xhr.responseText); // Verifique o conteúdo do arquivo JSON
                            callback(xhr.responseText);
                        }
                        };
                        xhr.send(null);
                    }
                </script>
            </div>
            
            <!--https://jsfiddle.net/tr2qcusa/-->
        </main>
        <!--Fim da main-->
        <div class="right" style="display: none;">
            <div class="topo">
                <button id="menu-btn-mobile" onclick="openNavMobile()">
                    <span class="material-symbols-sharp" >menu</span>
                </button >
            </div>
        </div>
    </div>
    <script src="../js/index3.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dygraph/2.1.0/plugins/range-selector.js"></script>

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

    setTimeout(function() {
        <?php
        // Verifique se a mensagem está definida na sessão
        if(isset($_SESSION['mensagemErro'])) {
            // Exiba a mensagem
            echo 'document.getElementById("mensagemErro").style.display = "none";';
            // Limpe a mensagem da sessão
            unset($_SESSION['mensagemErro']);
        }
        ?>
    }, 2000); // Tempo em milissegundos (5 segundos)


</script>

</body>

</html>