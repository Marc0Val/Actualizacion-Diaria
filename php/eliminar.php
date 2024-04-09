<?php
error_reporting(E_ERROR | E_PARSE);
$alerta = "";
include("conexion.php");

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $eliminarPublicacion = "DELETE FROM publicacion WHERE idPublicacion = '$id'";
    $resultadoPublicacion = mysqli_query($conexion, $eliminarPublicacion);
    $eliminarImagen = "DELETE FROM imagen WHERE idImagen = '$id'";
    $resultadoImagen = mysqli_query($conexion, $eliminarImagen);
    if ($resultadoPublicacion && $resultadoImagen) {
        $alerta = "eliminacionExitosa";
    } else {
        $alerta = "eliminacionFallida";
    }
    mysqli_close($conexion);
} else {
    header("Location: ../html/lista.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BORRANDO</title>
</head>

<body>

</body>

</html>
<?php include_once("alertas.php") ?>