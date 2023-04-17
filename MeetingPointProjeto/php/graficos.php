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
                <!--<p>Bem vindo, <?php echo $result['Name'];?></p>-->
                <a href="logout.php" id="traco">
                    <span class="material-symbols-sharp">logout</span>
                    <h3 id="logout">LOGOUT</h3>
                </a>
            </div>
        </aside>
        <!-- fim da sidebar -->
        <main>
            <h1 class="titulo">GVIR</h1>
            <div id="graphdiv3"></div>
            <script type="text/javascript">
                Dygraph.onDOMready(function onDOMready() {
                    g2 = new Dygraph(
                        document.getElementById("graphdiv3"),
                        "../js/temperatures.csv", // path to CSV file
                    );
                });
            </script>
            <!--https://jsfiddle.net/tr2qcusa/-->
        </main>
        <!--Fim da main-->
    </div>
    <script src="../js/index3.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>
</body>

</html>