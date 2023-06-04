<?php
session_start();

// Defina uma variável para armazenar a mensagem de sucesso
$mensagem = "";

// Verifique se os valores do formulário foram enviados
if(isset($_POST['editarTH'])) {
    // Conecte-se ao banco de dados (você já incluiu o arquivo 'db_connection.php')
    include('db_connection.php');
    
    // Obtenha os valores dos campos do formulário
    $TH_update_ids = $_POST['TH_update_id'];
    $threshold_h1s = $_POST['threshold_h1'];
    $threshold_h2s = $_POST['threshold_h2'];
    
    // Verifique se algum registro foi selecionado para atualizar
    if(!empty($TH_update_ids)) {
        // Iterar sobre os valores recebidos e atualizar cada registro individualmente
        foreach ($TH_update_ids as $index => $TH_update_id) {
            $threshold_h1 = $threshold_h1s[$index];
            $threshold_h2 = $threshold_h2s[$index];

            // Atualize os valores na tabela 'gvir_status'
            $sql = "UPDATE `gvir_status` SET `threshold_h1`='$threshold_h1', `threshold_h2`='$threshold_h2' WHERE `input`='$TH_update_id'";
            $result = mysqli_query($connect, $sql);
            
            // Verifique se a consulta foi executada com sucesso
            if($result) {
                $mensagem = "Valores atualizados com sucesso!";
            } else {
                $mensagem = "Erro ao atualizar os valores: " . mysqli_error($connect);
                break; // Se ocorrer um erro, interrompa o loop
            }
        }
    } else {
        $mensagem = "Erro: Nenhum registro selecionado para atualizar.";
    }

    $_SESSION['mensagem'] = $mensagem;
    
    header("location: graficos.php");
}
?>