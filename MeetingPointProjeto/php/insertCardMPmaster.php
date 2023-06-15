<?php
session_start();
include ('db_connection.php');

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['submitMPmaster'])) {
        // Obter os valores do formulário
        $id = $_POST['id'];
        $operation = $_POST['operation'];
        $order_given = $_SESSION['nome'];
       
       
        // Verificar se a última operação registrada para o ID é igual à nova operação
        $sqlCheck = "SELECT operation FROM mp_operation WHERE id = '$id' ORDER BY datatime DESC LIMIT 1";
        $resultCheck = mysqli_query($connect, $sqlCheck);

        if (mysqli_num_rows($resultCheck) > 0) {
            $rowCheck = mysqli_fetch_assoc($resultCheck);
            $lastOperation = $rowCheck['operation'];

            if ($lastOperation === $operation) {
                header("location: index3.php");
                exit;
            }
        }

        // Inserir 5 linhas na tabela mp_operation
        for ($i = 3; $i <= 8; $i++) {
            // Verificar novamente se a última operação registrada para o ID é igual à nova operação
            $sqlCheck = "SELECT operation FROM mp_operation WHERE id = '$i' ORDER BY datatime DESC LIMIT 1";
            $resultCheck = mysqli_query($connect, $sqlCheck);

            if (mysqli_num_rows($resultCheck) > 0) {
                $rowCheck = mysqli_fetch_assoc($resultCheck);
                $lastOperation = $rowCheck['operation'];

                if ($lastOperation === $operation) {
                    header("location: index3.php");
                    exit;
                }
            }

            // Inserir o valor na tabela mp_operation
            $sqlInsert = "INSERT INTO mp_operation (id, operation, order_given) VALUES ('$i', '$operation', '$order_given')";
            if (mysqli_query($connect, $sqlInsert)) {
                echo "Valores inseridos com sucesso para o ID $i!";
            } else {
                echo "Erro ao inserir os valores para o ID $i: " . mysqli_error($connect);
            }
        }

        // Verificar se a operação anterior era "Emergência" e a nova operação é "Fim de Emergência"
        if ($lastOperation === "Emergency" && $operation === "End_emergency") {
            // Redirecionar para o arquivo gerarPDFemergencia.php
            header("Location: gerarPDFemergencia.php?id=$id&order_given=$order_given");
            exit;
        }


        header("location: index3.php");
    }
}
?>
