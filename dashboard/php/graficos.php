<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard-Graficos</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://unpkg.com/dygraphs@2.2.1/dist/dygraph.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dygraphs@2.2.1/dist/dygraph.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" crossorigin="" />

    <?php include_once('db_connection.php');
include('protect.php');?>
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <a href="index.php">
                        <img src="../images/logo.PNG">
                    </a>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="index.php">
                    <span class="material-symbols-sharp">grid_view</span>
                    <h3>DashBoard</h3>
                </a>
                <a href="forms.php">
                    <span class="material-symbols-sharp">description</span>
                    <h3>Formulario</h3>
                </a>
                <a href="crud.php">
                    <span class="material-symbols-sharp">table_chart</span>
                    <h3>Tabela Crud</h3>
                </a>
                <a href="mapa.php">
                    <span class="material-symbols-sharp">map</span>
                    <h3>Mapa</h3>
                </a>
                <a href="graficos.php" class="active">
                    <span class=" material-symbols-sharp ">monitoring</span>
                    <h3>Graficos</h3>
                </a>
                <a href="componentes.php">
                    <span class="material-symbols-sharp ">widgets</span>
                    <h3>Componentes</h3>
                </a>
            </div>
        </aside>
        <!-- fim da sidebar -->
        <main>
            <h1 class="titulo">Gráficos</h1>
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
        <div class="right ">
            <div class="top ">
                <button id="menu-btn ">
                    <span class="material-symbols-sharp ">menu</span>
                </button >
                <!--notificacoes-->
                <div class="alertas " onclick="alertasToggle(); ">
                        <span class="material-symbols-sharp ">notifications</span>
                </div>
                <div class="alertas-context ">
                    <ul>
                        <li><a href="# "><span class="material-symbols-sharp ">sell</span>Nova venda realizada!</a></li>
                        <li><a href="# "><span class="material-symbols-sharp ">euro</span>Euro subiu 2% relativamente ao dolar! </a></li>
                        <li><a href="# "><span class="material-symbols-sharp ">payments</span>Pagamento por realizar!</a></li>
                    </ul>
                </div>
                <!--profile dropdown -->
                <div class="profile " onclick="menuToggle(); ">
                    <img class="profile-photo " src="../images/profile.png ">
                </div>    
                <div class="menu-profile ">
                    <h3>Goncalo Alves<br><small class="text-muted ">Web Developer</small></h3>
                    <ul>
                        <li><a href="# "><span class="material-symbols-sharp ">person</span>Profile</a></li>
                        <li><a href="settings.php"><span class="material-symbols-sharp ">settings</span>Settings</a></li>
                        <li><a href="logout.php"><span class="material-symbols-sharp ">logout</span>Logout</a></li>
                    </ul>
                </div>
            </div>
            <!--top end-->
            <div class="recent-updates">
                <h2>Notificações</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo" >
                            <img src="../images/profile.png">
                        </div>
                        <div class="message">
                            <p><b class="sucess">Notificação </b> recebeu o seu pedido da bola de futebol</p>
                            <small class="text-muted">3 minutos atras</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../images/profile3.png">
                        </div>
                        <div class="message">
                            <p><b class="warning">Alerta</b> recebeu o seu pedido das joelheiras</p>
                            <small class="text-muted">2 minutos atras</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../images/profile1.png">
                        </div>
                        <div class="message">
                            <p><b class="danger">Atenção</b> recebeu o seu pedido da bola de voleibol</p>
                            <small class="text-muted">1 hora atras</small>
                        </div>
                    </div>
                </div>
            </div>
            <!--updates recentes end-->
            <div class="sales-analytics ">
                <h2>Analise Saldos</h2>
                <div class="item online ">
                    <div class="icon ">
                        <span class="material-symbols-sharp ">shopping_cart</span>
                    </div>
                    <div class="right ">
                        <div class="info ">
                            <h3>Pedidos Online</h3>
                            <small class="text-muted ">Ultimas 24 horas</small>
                        </div>
                        <h5 class="sucess ">+39%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item offline ">
                    <div class="icon ">
                        <span class="material-symbols-sharp ">local_mall</span>
                    </div>
                    <div class="right ">
                        <div class="info ">
                            <h3>Pedidos Offline</h3>
                            <small class="text-muted ">Ultimas 24 horas</small>
                        </div>
                        <h5 class="danger ">-17%</h5>
                        <h3>1120</h3>
                    </div>
                </div>
                <div class="item customers ">
                    <div class="icon ">
                        <span class="material-symbols-sharp ">person</span>
                    </div>
                    <div class="right ">
                        <div class="info ">
                            <h3>Novos Clientes</h3>
                            <small class="text-muted ">Ultimas 24 horas</small>
                        </div>
                        <h5 class="sucess ">+25%</h5>
                        <h3>569</h3>
                    </div>
                </div>
                <div class="item add-product ">
                    <div>
                        <span class="material-symbols-sharp ">add</span>
                        <h3>Adicionar Produto</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/index.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>
</body>

</html>