<?php
include_once("conexion.php");

if (isset($_GET['id'])) {
    $idSolicitud = $_GET['id'];
    $eliminarSolicitud = "DELETE FROM usuarioPendiente WHERE idpendiente = $idSolicitud";

    if ($conexion->query($eliminarSolicitud) === TRUE) {
        header('Location: ../html/solicitud.php');
        exit();
    } else {
        echo "Error al rechazar solicitud: " . $conexion->error;
    }
} else {
    echo "Error: No se proporcionó un ID de solicitud";
}
$conexion->close();
?>
