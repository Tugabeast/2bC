<?php

    session_start();

    // Defina uma variável para armazenar a mensagem de sucesso
    $mensagem = "";

    // Verifique se os valores do formulário foram enviados
    if(isset($_POST['editarTH'])) {
        // Conecte-se ao banco de dados (você já incluiu o arquivo 'db_connection.php')
        include('db_connection.php');
        
        // Obtenha os valores dos campos do formulário
        $TH_update_id = $_POST['TH_update_id'];
        $threshold_h1 = $_POST['threshold_h1'];
        $threshold_h2 = $_POST['threshold_h2'];

        // Atualize os valores na tabela 'gvir_status'
        $sql = "UPDATE `gvir_status` SET `threshold_h1`='$threshold_h1', `threshold_h2`='$threshold_h2' WHERE `input`='$TH_update_id'";
        $result = mysqli_query($connect, $sql);
        
        // Verifique se a consulta foi executada com sucesso
        if($result) {
            $_SESSION['mensagem'] = "Valores atualizados com sucesso!";
            header("location: graficos.php");
        } else {
            $_SESSION['mensagem'] = "Erro ao atualizar os valores: " . mysqli_error($connect);
        }
        
        
        
    }
?>