<?php 
    include ('db_connection.php');

    // Busca os nomes na tabela gvir status
    $sql_names = "SELECT temperature,input FROM gvir_status";
    
    $result_names = $connect->query($sql_names);

    if($result_names->num_rows==0){
        echo "Nao há dados de temperatura na base de dados";
        exit;
    }    


    echo $result_names->num_rows;

    $row_names = $result_names->fetch_assoc();

    $temperatures = array();
    $values = array();

    while($row_data = $result_names->fetch_assoc()){
        array_push($temperatures,$row_data["temperature"]);
        array_push($values,$row_data["input"]);
    }

    $data_points = array();

    for($i=0;$i < count($temperatures);$i++){
        array_push($data_points, array("label" => $temperatures[$i], "y"=> $values[$i]));
    }

    return $data_points;

    /*
    x meto os valores da temperatura com os gaps a selecionar como abaixo tem e no y meto os valores min a max

    <label for="periodo">Período:</label>
					<select name="periodHum" id="periodo">
						<option value="1 day" <?php if (isset($_GET["periodHum"]) && $_GET["periodHum"]=="1 day") echo "selected";?>>Últimas 24 horas</option>
						<option value="7 day" <?php if (isset($_GET["periodHum"]) && $_GET["periodHum"]=="7 day") echo "selected";?>>Última semana</option>
						<option value="30 day" <?php if (isset($_GET["periodHum"]) && $_GET["periodHum"]=="30 day") echo "selected";?>>Último mês</option>
						<option value="365 day" <?php if (isset($_GET["periodHum"]) && $_GET["periodHum"]=="365 day") echo "selected";?>>Último ano</option>
					</select>
    */

?>

