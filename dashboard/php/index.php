<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
   
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <a href="#">
                        <img src="../images/logo.PNG">
                    </a>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="index.php" class="active">
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
                <a href="graficos.php">
                    <span class="material-symbols-sharp">monitoring</span>
                    <h3>Graficos</h3>
                </a>
                <a href="componentes.php">
                    <span class="material-symbols-sharp">widgets</span>
                    <h3>Componentes</h3>
                </a>
            </div>
        </aside>

        <!-- fim da sidebar -->
        <main>
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
            <!--Forms teste DB-->
            <!--
            <form action="../php/script.php" method="post" style="
                    padding: 2rem; text-align: center; font-size: 15px;">
                Username: <input type="text" id="username" name="username" style="width: 150px; height: 20px;
                    border: 1px solid black;"><br> Password: <input type="password" name="password" id="password" style="width: 150px; height: 20px;
                    border: 1px solid black;"><br>
                <input type="submit" value="Sumbit" style="width: 150px; height: 20px;
                    border: 1px solid black; margin-top: 20px;">
            </form>
            -->
            <!-- End Forms teste DB-->
        </main>
        <!--Fim da main-->
        <div class="right">
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
                        <li><a href="login.php"><span class="material-symbols-sharp ">logout</span>Logout</a></li>
                    </ul>
                </div>
            </div>
            <!--top end-->
            <div class="recent-updates">
                <h2>Notificações</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
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
            <div class="sales-analytics">
                <h2>Analise Saldos</h2>
                <div class="item online">
                    <div class="icon">
                        <span class="material-symbols-sharp">shopping_cart</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Pedidos Online</h3>
                            <small class="text-muted">Ultimas 24 horas</small>
                        </div>
                        <h5 class="sucess">+39%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item offline">
                    <div class="icon">
                        <span class="material-symbols-sharp">local_mall</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Pedidos Offline</h3>
                            <small class="text-muted">Ultimas 24 horas</small>
                        </div>
                        <h5 class="danger">-17%</h5>
                        <h3>1120</h3>
                    </div>
                </div>
                <div class="item customers">
                    <div class="icon">
                        <span class="material-symbols-sharp">person</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Novos Clientes</h3>
                            <small class="text-muted">Ultimas 24 horas</small>
                        </div>
                        <h5 class="sucess">+25%</h5>
                        <h3>569</h3>
                    </div>
                </div>
                <div class="item add-product">
                    <div>
                        <span class="material-symbols-sharp">add</span>
                        <h3>Adicionar Produto</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>

</html>