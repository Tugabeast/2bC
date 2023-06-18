<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard-WIND</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/cssdeteste.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" ></script>
    
 
    
    
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
            <div class="sidebar" style="height: 88.7vh;">
                <a href="index3.php">
                <span class="material-symbols-sharp">distance</span>
                    <h3 id="dashboard">MONITORIZAÇÃO</h3>
                </a>
                <a href="graficos.php">
                    <span class="material-symbols-sharp">nest_cam_outdoor</span>
                    <h3 id="formulario">GVIR</h3>
                </a>
                <a href="mapa.php" class="active">
                    <span class="material-symbols-sharp">air</span>
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
            <h1 class="titulo" id="registoperacao" style="text-align: center;">WIND</h1>
            <!--<div id="map">
                
            </div>
--> 
<!--
            <div id="mapa" style="height: 50%; " > 
                <img src="../images/planta.png" id="planta" name="planta" style="margin: auto; height: 80%; width: 40%;">
            </div>
            -->          
            <div class="card" style="width: 50%; margin: auto; background: white; color: black;" >
            <div id='myDiv' style="width: 80%; margin: auto;">
                <!-- Plotly chart will be drawn inside this DIV -->
            </div>
                <label style="border-bottom: 1px solid black;">
                    Tempo
                    <select name="TempoMin" id="TempoMin" style="border-bottom: 1px solid black;">
                        <option value="5min">5min</option>
                        <option value="10min">10min</option>
                        <option value="15min">15min</option>
                        <option value="20min">20min</option>
                    </select>
                    /
                    <select name="TempoMax" id="TempoMax" style="border-bottom: 1px solid black;">
                        <option value="10max">10min</option>
                        <option value="15max">15min</option>
                        <option value="20max">20min</option>
                        <option value="25max">25min</option>
                    </select>
                </label>
                <br>
                <label>
                    <div id='valuesDiv' style="border-bottom: 1px solid black;"></div>
                </label>
                <div id="windIcon" style="text-align: center;"></div>
            </div>

            
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

    <script src="../js/mapa.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src='https://cdn.plot.ly/plotly-2.24.1.min.js'></script>

    <script>
    // Fazer a solicitação AJAX para obter os dados do banco de dados
    $.ajax({
        url: 'mapaDados.php',
        data: { limit: 100 }, // Defina o número de registros e o intervalo de tempo desejados
        dataType: 'json',
        success: function (response) {
            // Os dados foram obtidos com sucesso
            // Agora você pode usar os dados para construir o gráfico

            var currentIndex = 0;
            var data = response.data;
            var interval = 5000;

            function displayNext() {
                // Verificar se há mais registros a serem exibidos
                if (currentIndex >= data.length) {
                    currentIndex = 0; // Reiniciar a iteração dos registros
                }

                // Código existente para criar o gráfico Plotly
                var velocity = data[currentIndex].velocity * 16.667;
                //var velocity = data[currentIndex].velocity ;
                var radius = velocity * 0.5; // Ajuste o fator multiplicativo conforme necessário

                var direction = data[currentIndex].direction;
                 var windDirection = "";

                // Código existente para criar o gráfico Plotly
                var chartData = {
                    //r: [data[currentIndex].velocity],
                    r: [radius],
                    theta: [data[currentIndex].direction],
                    name: data[currentIndex].direction,
                    marker: { color: "rgb(106,81,163)" },
                    type: "barpolar"
                };

                // Mapear os ângulos para os pontos cardeais, colaterais e subcolaterais correspondentes
                if (direction >= 348.75 || direction < 11.25) {
                        windDirection = "N";
                    } else if (direction >= 11.25 && direction < 33.75) {
                        windDirection = "NNE";
                    } else if (direction >= 33.75 && direction < 56.25) {
                        windDirection = "NE";
                    } else if (direction >= 56.25 && direction < 78.75) {
                        windDirection = "ENE";
                    } else if (direction >= 78.75 && direction < 101.25) {
                        windDirection = "E";
                    } else if (direction >= 101.25 && direction < 123.75) {
                        windDirection = "ESE";
                    } else if (direction >= 123.75 && direction < 146.25) {
                        windDirection = "SE";
                    } else if (direction >= 146.25 && direction < 168.75) {
                        windDirection = "SSE";
                    } else if (direction >= 168.75 && direction < 191.25) {
                        windDirection = "S";
                    } else if (direction >= 191.25 && direction < 213.75) {
                        windDirection = "SSW";
                    } else if (direction >= 213.75 && direction < 236.25) {
                        windDirection = "SW";
                    } else if (direction >= 236.25 && direction < 258.75) {
                        windDirection = "WSW";
                    } else if (direction >= 258.75 && direction < 281.25) {
                        windDirection = "W";
                    } else if (direction >= 281.25 && direction < 303.75) {
                        windDirection = "WNW";
                    } else if (direction >= 303.75 && direction < 326.25) {
                        windDirection = "NW";
                    } else if (direction >= 326.25 && direction < 348.75) {
                        windDirection = "NNW";
                    }

                    switch (true) {
                        case (velocity < 1):
                            iconPath = "../images/Icons vento/1.jpg";
                            break;
                        case (velocity > 1 && velocity < 5):
                            iconPath = "../images/Icons vento/2.jpg";
                            break;
                        case (velocity < 7):
                            iconPath = "../images/Icons vento/light-breeze.png";
                            break;
                        case (velocity < 11):
                            iconPath = "../images/Icons vento/gentle-breeze.png";
                            break;
                        case (velocity < 17):
                            iconPath = "../images/Icons vento/moderate-breeze.png";
                            break;
                        case (velocity < 22):
                            iconPath = "../images/Icons vento/fresh-breeze.png";
                            break;
                        case (velocity < 28):
                            iconPath = "../images/Icons vento/strong-breeze.png";
                            break;
                        case (velocity < 34):
                            iconPath = "../images/Icons vento/near-gale.png";
                            break;
                        case (velocity < 41):
                            iconPath = "../images/Icons vento/gale.png";
                            break;
                        case (velocity < 48):
                            iconPath = "../images/Icons vento/strong-gale.png";
                            break;
                        case (velocity < 56):
                            iconPath = "../images/Icons vento/storm.png";
                            break;
                        case (velocity < 64):
                            iconPath = "../images/Icons vento/violent-storm.png";
                            break;
                        default:
                            iconPath = "../images/Icons vento/default-icon.png";
                            break;
                    }


        
                // Preencher os dados do gráfico com o próximo conjunto de registros
                /*
                var end = Math.min(currentIndex + limit, data.length);
                for (var i = currentIndex; i < end; i++) {
                    chartData.r.push(data[i].velocity);
                    chartData.theta.push(data[i].direction);
           
                }
*/
                var layout = {
                    title: "Wind Rose",
                    font: { size: 16 },
                    legend: { font: { size: 16 } },
                    polar: {
                        barmode: "overlay",
                        bargap: 0,
                        radialaxis: { ticksuffix: "%", angle: 45, dtick: 20 },
                        angularaxis: {  
                            direction: "clockwise",
                            tickmode: "array",
                            tickvals: [0, 22.5, 45, 67.5, 90, 112.5, 135, 157.5, 180, 202.5, 225, 247.5, 270, 292.5, 315, 337.5],
                            ticktext: ['N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW', 'SW', 'WSW', 'W', 'WNW', 'NW', 'NNW']
                        }
                    }
                };

                Plotly.newPlot("myDiv", [chartData], layout);

                // Exibir os dados do registro no console
                console.log("Direção: " + windDirection);
                console.log("Velocidade: " + velocity.toFixed(2) + " m/min");

                // Atualizar a div de valores com os valores do gráfico
                var valuesDiv = document.getElementById('valuesDiv');
                valuesDiv.innerHTML = "Direção: " + data[currentIndex].direction + " : "  + windDirection + "<br>" +
                    "Velocidade: " + velocity.toFixed(2) + " m/min";

                // Atualizar o índice para o próximo conjunto de registros
                currentIndex ++;

                // Agendar a exibição do próximo conjunto de registros após o intervalo de tempo especificado
                setTimeout(displayNext, interval);
            }

                // Iniciar a exibição dos registros
                //var limit = 100; 
                displayNext(); // Defina o valor de limit conforme desejado
        },
        error: function () {
            // Ocorreu um erro ao obter os dados do banco de dados
            console.error("Erro ao obter os dados do banco de dados.");
        }
    });
</script>
</body>

</html>