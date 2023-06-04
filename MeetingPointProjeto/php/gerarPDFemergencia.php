<?php
    

    include ('db_connection.php');
    session_start();

    
    require "../vendor/autoload.php";

    use Dompdf\Dompdf;
    use Dompdf\Options;

    /*
    $MP_ID = $_POST["MP_ID"];
    $name = $_POST["name"];
    */
    
    

        // Consultar a tabela
        $sql1 = "SELECT datatime, worker_name FROM mp_registered_cards ";
        $result1 = $connect->query($sql1);

        $order_given = $_SESSION['nome'];

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

            table, td, th {
                    border: 1px solid;
                    text-align: left;
                    padding: 3px;
                    font-weight: lighter;
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
            <h2>MP3 - Oficinas</h2><!--isto tem que ser dinamico/tem que ser o MP clicado-->

            <h3>Inicio da emergência: x</h3><!--isto tem que ser dinamico/tem que ser a hora em que o MP é clicado-->
            <h3>Ativado: '.$order_given.'</h3>
            <h4>Lista de registados</h4>
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Nome do utilizador</th>
                    </tr>
                </thead>
                <tbody>';

        // Preencher a tabela com os valores do banco de dados
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $html .= '<tr>
                    <td>' . $row["datatime"] . '</td>
                    <td>' . $row["worker_name"] . '</td>
                </tr>';
            }
        }

        $html .= '</tbody>
            </table>
            <h3>Fim da emergência: x</h3><!--isto tem que ser dinamico/tem que ser a hora em que o MP é clicado-->
            <h3>Ativado: '.$order_given.'</h3>
        </body>
        </html>';


        $dompdf->addInfo("Title","MeetingPoint");

        $dompdf->loadHtml($html);

        

        $dompdf->render();

        $dompdf->stream("MP Relatorio Emergencia",["Attachment" => 0]);

    
?>