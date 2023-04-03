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
    <?php include_once('db_connection.php');
include('protect.php');?>
</head>

<body>
    
    <div class="container">
        
        <aside class="sidebar">
            <div class="top">
                <div class="menu">
                    <i class="material-symbols-sharp" style="color:white">menu</i>
                </div>
             <!--   <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">close</span>
                </div>  -->
                
            </div>
            <div class="sidebar">
                <a href="index.php" >
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
        
    </div>

    <script>
	const menu = document.querySelector(".menu"); // get menu item for click event

menu.addEventListener("click", function () {
	expandSidebar();
	showHover();
	
});

/**
 * expand sidebar if it is short, otherwise collapse it
 */
function expandSidebar() {
	document.querySelector("body").classList.toggle("short");
	let keepSidebar = document.querySelectorAll("body.short");
	if (keepSidebar.length === 1) {
		localStorage.setItem("keepSidebar", "true");
	} else {
		localStorage.removeItem("keepSidebar");
	}
}
/**
 * show hover effect on sidebar
 */
function showHover() {
	const li = document.querySelectorAll(".short .sidebar li a");
	if (li.length > 0) {
		li.forEach(function (item) {
			item.addEventListener("mouseover", function () {
				const text = item.querySelector(".text");
				text.classList.add("hover");
			});
			item.addEventListener("mouseout", function () {
				const text = item.querySelector(".text");
				text.classList.remove("hover");
			});
		});
	}
}/**
 * check local storage for keep sidebar
 */
function showStoredSidebar() {
	if (localStorage.getItem("keepSidebar") === "true") {
		document.querySelector("body").classList.add("short");
		showHover();
		getSearch();
	}
}

showStoredSidebar(); // show sidebar if stored in local storage

	</script>

    <script src="../js/index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>

</html>