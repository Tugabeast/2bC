<!-- verifica se temos os dados da sessão,
se não inicia a sessão e depois destroi esses dados e redireciona para o login -->
<?php

if(!isset($_SESSION)) {
    session_start();
}

session_destroy();

header("Location: login.php");
?>
