<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/cssdeteste.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
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
             <!--   <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">close</span>
                </div>  -->
                
            </div>
            <div class="sidebar">
                <a href="index.php" class="active">
                <span class="material-symbols-sharp">distance</span>
                    <h3 id="dashboard">MEETING POINT</h3>
                </a>
                <a href="forms.php">
                    <span class="material-symbols-sharp">nest_cam_outdoor</span>
                    <h3 id="formulario">GVIR</h3>
                </a>
                <a href="crud.php"><span class="material-symbols-sharp">air</span>
                    <h3 id="tabelacrud">WIND</h3>
                </a>
                <a href="settings.php">
                    <span class="material-symbols-sharp">manage_accounts</span>
                    <h3 id="profile">ADMIN</h3>
                </a>
                <a href="mapa.php">
                    <span class="material-symbols-sharp">map</span>
                    <h3 id="mapa">Mapa</h3>
                </a>
                <a href="graficos.php">
                    <span class="material-symbols-sharp">monitoring</span>
                    <h3 id="graficos">Graficos</h3>
                </a>
                <a href="componentes.php">
                    <span class="material-symbols-sharp">widgets</span>
                    <h3 id="componentes">Componentes</h3>
                </a>
                <a href="logout.php" id="traco">
                    <span class="material-symbols-sharp">logout</span>
                    <h3 id="logout">Logout</h3>
                </a>
            </div>
        </aside>
        <!-- fim da sidebar -->
        <main >
            <h1 class="titulo">DashBoard</h1>
            <div class="insights">
                <div class="sales">
                    <span class="material-symbols-sharp">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Vendas</h3>
                            <h1>25024€</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='36' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Ultimas 24 horas</small>
                </div>
                <!--fim sales-->
                <div class="expenses">
                    <span class="material-symbols-sharp">bar_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Despesas</h3>
                            <h1>14160€</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='36' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>62%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Ultimas 24 horas</small>
                </div>
                <!--fim expenses-->
                <div class="income">
                    <span class="material-symbols-sharp">stacked_line_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Ganhos</h3>
                            <h1>10864€</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='36' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>44%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Ultimas 24 horas</small>
                </div>
                <!--fim incomes-->
            </div>
            <!-- insights fim-->
            <div class="recent-orders">
                <h2>Pedidos Recentes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nome do Produto</th>
                            <th>Numero do Produto</th>
                            <th>Pagamento</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                        <tbody>
                            <tr>
                                <td>Bolas de futebol nikes</td>
                                <td>4125€</td>
                                <td>Feito</td>
                                <td class="sucess">Em Movimento</td>
                                <td class="primary">Detalhes</td>
                            </tr>
                            <tr>
                                <td>Bolas de andebol ardidas</td>
                                <td>1234€</td>
                                <td>Pendente</td>
                                <td class="warning">Em Transacao</td>
                                <td class="primary">Detalhes</td>
                            </tr>
                            <tr>
                                <td>Bolas de voleibol champinhon</td>
                                <td>4321€</td>
                                <td>Cancelado</td>
                                <td class="danger">Esta Parado</td>
                                <td class="primary">Detalhes</td>
                            </tr>
                            <tr>
                                <td>Bolas de basket guchie</td>
                                <td>6789€</td>
                                <td>Feito</td>
                                <td class="sucess">Em Movimento</td>
                                <td class="primary">Detalhes</td>
                            </tr>
                            <tr>
                                <td>Bolas de futsal clipers</td>
                                <td>9876€</td>
                                <td>Pendente</td>
                                <td class="danger">Preso Alfandega</td>
                                <td class="primary">Detalhes</td>
                            </tr>

                        </tbody>
                    </thead>
                </table>
                <a href="#">Mostrar Todas</a>
            </div>
        </main>
        <!--Fim da main-->
        
    </div>



    <script src="../js/index2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>

</html>