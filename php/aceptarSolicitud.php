<?php
include_once("conexion.php");

if (isset($_GET['id'])) {
    $idSolicitud = $_GET['id'];
    $consultaSolicitud = "SELECT * FROM usuarioPendiente WHERE idpendiente = $idSolicitud";
    $resultadoSolicitud = $conexion->query($consultaSolicitud);

    if ($resultadoSolicitud->num_rows > 0) {
        $filaSolicitud = $resultadoSolicitud->fetch_assoc();
        $nombreUser = $filaSolicitud['nombreUser'];
        $password = $filaSolicitud['password'];
        $rol = 'publicador'; 
        $insertarUsuario = "INSERT INTO usuario (nombreUser, password, rol) VALUES ('$nombreUser', '$password', '$rol')";
        if ($conexion->query($insertarUsuario) === TRUE) {
            $borrarSolicitud = "DELETE FROM usuarioPendiente WHERE idpendiente = $idSolicitud";
            $conexion->query($borrarSolicitud);
            header('Location: ../html/solicitud.php');
            exit();
        } else {
            if ($conexion->errno == 1062) {
                echo "<br>El usuario $nombreUser ya existe.";
            }
        }
    } else {
        echo "Error: No se encontró la solicitud con ID $idSolicitud";
    }
} else {
    echo "Error: No se proporcionó un ID de solicitud";
}
$conexion->close();
?>
