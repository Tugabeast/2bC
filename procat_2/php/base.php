<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MONITORIZACAO</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/cssdeteste.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">



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



        </main>
        <!--Fim da main-->

    </div>



    <script src="../js/index3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>

</html>
