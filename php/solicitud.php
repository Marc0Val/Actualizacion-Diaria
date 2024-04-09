<?php
include("conexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombrePendiente = mysqli_real_escape_string($conexion, $_POST["nombre"]);
    $nombreUsuario = mysqli_real_escape_string($conexion, $_POST["usuario"]);
    $contraseña = mysqli_real_escape_string($conexion, $_POST["contraseña"]);
    $consultaExistencia = "SELECT COUNT(*) as numUsuarios FROM usuarioPendiente WHERE nombreUser = ?";
    $stmtExistencia = $conexion->prepare($consultaExistencia);
    $stmtExistencia->bind_param("s", $nombreUsuario);
    $stmtExistencia->execute();
    $resultadoExistencia = $stmtExistencia->get_result();
    $filaExistencia = $resultadoExistencia->fetch_assoc();

    if ($filaExistencia['numUsuarios'] > 0) {
        echo "<h1>Error: El nombre proporcionado asi como el de usuario pueden haberse ya insertado, prueba mas tarde.</h1>";
    } else {
        $stmt = $conexion->prepare("INSERT INTO usuarioPendiente (nombrependiente, nombreUser, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombrePendiente, $nombreUsuario, $contraseña);

        if ($stmt->execute()) {
            echo "Registro insertado correctamente.";
            header("location: ../index.php");
        } else {
            echo "Error al insertar el registro. Por favor, inténtalo de nuevo más tarde.";
        }

        $stmt->close();
    }
    $stmtExistencia->close();
    $conexion->close();
}
?>
