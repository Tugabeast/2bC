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
        if(isset($_POST['submitMP3'])) {
    
            // Inserir os valores no banco de dados
            $sqlInsert = "INSERT INTO mp_operation (id, operation, order_given) VALUES ('$id', '$operation', '$order_given')";
            if (mysqli_query($connect, $sqlInsert)) {
                echo " Valores inseridos com sucesso!";
                header("location: index3.php");
            } else {
                echo "Erro ao inserir os valores: " . mysqli_error($connect);
            }
        }
    }

?>