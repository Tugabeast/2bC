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

            <div id="map">
                <!--<div id="myDiv" style="width: 80%; margin: auto; opacity: 80%; position: relative; background: transparent;">
--> <!-- Plotly chart will be drawn inside this DIV -->
               <!-- </div>
-->             
                <div id="myDivMapa" style="mix-blend-mode: multiply; margin-top: 1%; width: 80%;height: 0; margin-left: auto; margin-right: auto;  position: relative; background: transparent;">
                        <!-- Plotly chart will be drawn inside this DIV -->
                </div>
            </div>


<!--
            <div id="mapa" > 
                <img src="../images/planta.png" id="planta" name="planta" style="margin: auto; ">
            </div>
-->
            <br>
            <div class="card" id="cardWind" style="width: 50%; margin: auto; background: white; color: black;" >
           <!--\ <div id='myDiv' style="width: 80%; margin: auto;">
                Plotly chart will be drawn inside this DIV 
            </div>
-->
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
                <label >
                    <div id='valuesDiv' style="border-bottom: 1px solid black;"></div>
                    <div id="windIcon" style="text-align: center; margin-top:2rem;" ></div>
                    <div id="windText" style=" margin-top: 1rem;"></div>
                    <?php
                        // Return current date from the remote server
                        $date = date('d-m-y h:i:s');
                        echo '<p style="margin-top:2rem;">'."Ultima Atualização: ".$date.'</p>';
                    ?>
                    <div>Status: Ok</div>
                </label>
            </div>

            
        </main>
        <!--Fim da main-->
        <div class="right" style="display: none;">
            <div class="topo">
                <button id="menu-btn-mobile" onclick="openNavMobile()">
                    <span class="material-symbols-sharp" >menu</span>
                </button>
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

                var chartDataMapa = {
                    r: [radius],
                    theta: [data[currentIndex].direction],
                    name: data[currentIndex].direction,
                    marker: { color: "rgb(106,81,163)" },
                    type: "barpolar"
                };

                var layoutMapa = {
                    font: { size: 16 },
                    legend: { font: { size: 16 } },
                    polar: {
                        barmode: "overlay",
                        bargap: 0,
                        radialaxis: { showticklabels: false,ticksuffix: "%", angle: 45, dtick: 20 },
                        angularaxis: {  
                            direction: "clockwise",
                            tickmode: "array",
                            tickvals: [0, 22.5, 45, 67.5, 90, 112.5, 135, 157.5, 180, 202.5, 225, 247.5, 270, 292.5, 315, 337.5],
                            ticktext: ['N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW', 'SW', 'WSW', 'W', 'WNW', 'NW', 'NNW'],
                            showticklabels: false
                        }
                    },
                    showlegend: false
                    
                };

                Plotly.newPlot("myDivMapa", [chartDataMapa], layoutMapa);



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

                 function displayWindIcon(velocity , direction) {
                    var windIcon = document.getElementById("windIcon");
                    var windText = document.getElementById("windText");
                    var iconPath = "";
                    var iconName = ""; // Variável para armazenar o nome do ícone

                    //valores em metro/minuto
                    var calmo = 16.66667;
                    var aragem = 83.33333;
                    var brisaLeve = 183.3333;
                    var brisaFraca = 316.6667;
                    var brisaModerada = 466.6667;
                    var brisaForte = 633.3333;
                    var ventoFresco = 816.6667;
                    var ventoForte = 1016.667;
                    var ventania = 1233.333;
                    var ventaniaForte = 1466.667;
                    var tempestade = 1700;
                    var tempestadeViolenta = 1950;
                    var furacao = 1966.667;

                    switch (true) {
                        case (velocity < calmo):
                            iconPath = "../images/Iconsvento/1.jpg";
                            iconName = "Calmo";
                            break;
                        case (velocity > calmo && velocity < aragem):
                            iconPath = "../images/Iconsvento/2.jpg";
                            iconName = "Aragem";
                            break;
                        case (velocity > aragem && velocity < brisaLeve):
                            iconPath = "../images/Iconsvento/3.jpg";
                            iconName = "Brisa Leve";
                            break;
                        case (velocity > brisaLeve && velocity < brisaFraca):
                            iconPath = "../images/Iconsvento/4.jpg";
                            iconName = "Brisa Fraca";
                            break;
                        case (velocity > brisaFraca && velocity < brisaModerada):
                            iconPath = "../images/Iconsvento/5.jpg";
                            iconName = "Brisa Moderada";
                            break;
                        case (velocity > brisaModerada && velocity < brisaForte):
                            iconPath = "../images/Iconsvento/6.jpg";
                            iconName = "Brisa Forte";
                            break;
                        case (velocity > brisaForte && velocity < ventoFresco):
                            iconPath = "../images/Iconsvento/7.jpg";
                            iconName = "Vento Fresco";
                            break;
                        case (velocity > ventoFresco && velocity < ventoForte):
                            iconPath = "../images/Iconsvento/8.jpg";
                            iconName = "Vento Forte";
                            break;
                        case (velocity > ventoForte && velocity < ventania):
                            iconPath = "../images/Iconsvento/9.jpg";
                            iconName = "Ventania";
                            break;
                        case (velocity > ventania && velocity < ventaniaForte):
                            iconPath = "../images/Iconsvento/10.jpg";
                            iconName = "Ventania Forte";
                            break;
                        case (velocity > ventaniaForte && velocity < tempestade):
                            iconPath = "../images/Iconsvento/11.jpg";
                            iconName = "Tempestade";
                            break;
                        case (velocity > tempestade && velocity < tempestadeViolenta):
                            iconPath = "../images/Iconsvento/12.jpg";
                            iconName = "Tempestade Violenta";
                            break;
                        case (velocity < furacao):
                            iconPath = "../images/Iconsvento/12.jpg";
                            iconName = "Furacão";
                            break;
                        default:
                            return "Velocidade inválida";
                            break;
                    }

                    // Converter a direção do vento de caractere para número
                    var numericDirection = parseInt(direction);


                    
                    // Verificar se a conversão foi bem-sucedida
                    if (isNaN(numericDirection)) {
                        console.error("Erro ao converter a direção do vento para número.");
                        return;
                    }

                    

                    // Calcular a rotação do ícone com base na direção do vento
                    var rotation;
                    if (numericDirection < 180) {
                        rotation = numericDirection + 180;
                    } else {
                        rotation = numericDirection - 180;
                    }


                    

                    // Exibir o ângulo de rotação na console
                    console.log("Ângulo de rotação: " + rotation + " graus");

                    // Aplicar a rotação ao ícone usando a propriedade transform do CSS
                    windIcon.style.transform = "rotate(" + direction + "deg)";

                    windIcon.innerHTML = `<img src="${iconPath}" alt="Wind Icon">`;
                    
                   // Exibir o texto
                    windText.innerText = iconName;

                }

                displayWindIcon(velocity,direction);


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

                //Plotly.newPlot("myDiv", [chartData], layout);

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