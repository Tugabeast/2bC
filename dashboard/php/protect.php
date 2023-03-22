<!-- vai buscar os dados da sessão, verifica se existe dados no id,
senão dá erro e volta para a pagina login.php -->
<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['nome'])) {
    
    header("Location: login.php");
    
}

?>
