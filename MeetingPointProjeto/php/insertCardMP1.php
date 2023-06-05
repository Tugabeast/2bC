<?php 
session_start();
include ('db_connection.php');

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os valores do formulário
    $id = $_POST['id'];
    $operation = $_POST['operation'];
    $order_given = $_SESSION['nome'];
    echo $_POST['id']," ",$_POST['operation']," ",$_SESSION['nome'];

    if(isset($_POST['submitMP1'])) {
        // Verificar se existe alguma operação registrada para o ID
        $sqlCheck = "SELECT operation FROM mp_operation WHERE id = '$id' ORDER BY datatime DESC LIMIT 1";
        $resultCheck = mysqli_query($connect, $sqlCheck);
        $rowCheck = mysqli_fetch_assoc($resultCheck);
        $lastOperation = $rowCheck['operation'];

        if ($lastOperation !== $operation) {
            // Inserir os valores no banco de dados
            $sqlInsert = "INSERT INTO mp_operation (id, operation, order_given) VALUES ('$id', '$operation', '$order_given')";
            if (mysqli_query($connect, $sqlInsert)) {
                echo " Valores inseridos com sucesso!";
                header("location: index3.php");
            } else {
                echo "Erro ao inserir os valores: " . mysqli_error($connect);
            }
        } else {
            header("location: index3.php");
        }
    }
}
?>


