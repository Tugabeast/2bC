<?php
session_start();

// Defina uma variável para armazenar a mensagem
$mensagem = "";
$mensagemErro = "";

// Verifique se os valores do formulário foram enviados
if(isset($_POST['editarTH'])) {
    // Conecte-se ao banco de dados (você já incluiu o arquivo 'db_connection.php')
    include('db_connection.php');
    
    // Obtenha os valores dos campos do formulário
    $TH_update_ids = $_POST['TH_update_id'];
    $threshold_h1s = $_POST['threshold_h1'];
    $threshold_h2s = $_POST['threshold_h2'];

    // Iterar sobre os valores recebidos e atualizar cada registro individualmente
    $alterou_valores = false;
    foreach ($TH_update_ids as $index => $TH_update_id) {
        $threshold_h1 = $threshold_h1s[$index];
        $threshold_h2 = $threshold_h2s[$index];

        // Verificar se os valores antigos são diferentes dos novos valores
        $old_values = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `gvir_status` WHERE `input`='$TH_update_id'"));
        $old_threshold_h1 = $old_values['threshold_h1'];
        $old_threshold_h2 = $old_values['threshold_h2'];
        if ($threshold_h1 != $old_threshold_h1 || $threshold_h2 != $old_threshold_h2) {
            // Atualizar os valores na tabela 'gvir_status'
            $sql = "UPDATE `gvir_status` SET `threshold_h1`='$threshold_h1', `threshold_h2`='$threshold_h2' WHERE `input`='$TH_update_id'";
            $result = mysqli_query($connect, $sql);

            // Verifique se a consulta foi executada com sucesso
            if($result) {
                $alterou_valores = true;
            } else {
                $mensagem = "Erro ao atualizar os valores: " . mysqli_error($connect);
                break; // Se ocorrer um erro, interrompa o loop
            }
        }
    }

    // Verificar se houve alterações nos valores
    if ($alterou_valores) {
        $mensagem = "Valores atualizados com sucesso!";
    } else {
        $mensagemErro = "Os valores novos são iguais aos antigos. Nenhuma alteração realizada.";
    }

    $_SESSION['mensagem'] = $mensagem;
    $_SESSION['mensagemErro'] = $mensagemErro;
    
    header("location: graficos.php");
}
?>