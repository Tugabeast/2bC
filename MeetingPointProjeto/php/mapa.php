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
            <div id="map"></div>
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
   

</body>

</html>