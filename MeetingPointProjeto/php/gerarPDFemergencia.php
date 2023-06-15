<?php
    

    include ('db_connection.php');
    session_start();

    
    require "../vendor/autoload.php";

    use Dompdf\Dompdf;
    use Dompdf\Options;

    $id = $_GET['id'];
    //$mpName = $_SESSION['mpName']; // Recuperar o nome do meeting point da sessão
    $order_given = $_GET['order_given'];



    // Consultar a tabela
    $sql1 = "SELECT datatime, worker_name FROM mp_registered_cards ";
    $result1 = $connect->query($sql1);



    $sql2 = "SELECT * FROM mp_operation ORDER BY datatime";
    $result2 = $connect->query($sql2);
    
    $sql4 = "SELECT datatime FROM mp_operation where id = 8 AND operation= 'Emergency' ORDER BY datatime DESC";
    $result4 = $connect->query($sql4);
    $row4 = mysqli_fetch_assoc($result4);

    $sql3 = "SELECT datatime FROM mp_operation where id = 8 AND operation= 'End_emergency' ORDER BY datatime DESC";
    $result3 = $connect->query($sql3);
    $row3 = mysqli_fetch_assoc($result3);

    $sqlMP = "SELECT MP_ID FROM meeting_point WHERE id = '$id'";
    $resultMP = $connect->query($sqlMP);
    $rowMP = $resultMP->fetch_assoc();
    

    $dompdf = new Dompdf();

    // Gerar o conteúdo HTML do PDF
    $html = '
    <html>
        <head>
            <style>
                body{
                    background: white;
                    font-family: sans-serif;
                } 

                #linha{
                        border-bottom: 1px solid black;
                        padding-bottom: 5px;
                        margin-top: -10px;
                        font-weight: lighter;
                }

                h2{
                    text-align: center;
                    padding-top: 20px;
                }

                table, td, th ,tr {
                    border: 1px solid black; /* Adiciona a cor "black" */
                    text-align: left;
                    padding: 3px;
                    font-weight: lighter;
                    border-collapse: separate;
                }
                

            

                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                footer{
                    border-top: 1px solid black;
                    position: absolute;
                    bottom: 0;
                    width: 100%;
                    height: 2.5rem;
                    text-align: right;
                    
                }
            </style>
        </head>
            <body>
            <header>
                <h4>Relatorio</h4>
                <h5 id="linha"> MeetingPoint - 2BWEBCONNECT </h5>
            </header>

            <h2>Meeting Point</h2>
            <h2>Relatorio de Emergência</h2>
            <h2>'.$rowMP['MP_ID'].'</h2>

            <h3 id="inicio-emergencia">Inicio da emergência:'.$row4['datatime'].'</h3><!--isto tem que ser dinamico/tem que ser a hora em que o MP é clicado-->
            <h3>Ativado: '.$order_given.'</h3>
            <h4>Lista de registados</h4>
            <table>
                
                    <tr style="border:1px solid black;">
                        <th>Data</th>
                        <th>Nome do utilizador</th>
                    </tr>
                
                ';

        // Preencher a tabela com os valores do banco de dados
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $html .= '<tr>
                    <td>' . $row["datatime"] . '</td>
                    <td>' . $row["worker_name"] . '</td>
                </tr>';
            }
        }

        
        $html .= '
                </table>
                <h3 id="fim-emergencia">Fim da emergência:'.$row3['datatime'].'</h3><!--isto tem que ser dinamico/tem que ser a hora em que o MP é clicado-->
                <h3>Ativado: '.$order_given.'</h3>
        </body>
            </html>';


        $dompdf->addInfo("Title","MeetingPoint");

        $dompdf->loadHtml($html);

        

        $dompdf->render();

        $dompdf->stream("MP Relatorio Emergencia",["Attachment" =>0]);

        exit;
?>