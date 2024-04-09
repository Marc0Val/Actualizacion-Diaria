<?php
    session_start();
    session_unset();
    session_destroy();
    $alerta = "sesionCerrada";
    header("Location: ../index.php");
    exit();
?>

