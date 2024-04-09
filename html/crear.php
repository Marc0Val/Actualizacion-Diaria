<?php
$alerta = "";
session_start();
include_once("../php/conexion.php");
if(!isset($_SESSION['usuario'])){
    header('location: ../index.php');
    exit();
}
$usuario = $_SESSION['usuario'];
$consultaRol = "SELECT rol FROM usuario WHERE nombreUser = '$usuario'";
$resultado = $conexion->query($consultaRol);
if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $rol = $fila['rol'];
} else {
    echo "No se ha encontrado el rol del usuario $usuario";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../php/conexion.php");
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $carpetaDestino = "../imageS/"; 
    $nombreArchivo = $_FILES["imagen"]["name"];
    $rutaCompleta = $carpetaDestino . $nombreArchivo;
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaCompleta);
    $insertImagenQuery = "INSERT INTO imagen (ruta) VALUES ('$rutaCompleta')";
    $conexion->query($insertImagenQuery);
    if ($conexion->affected_rows == 1) {
        $idImagen = $conexion->insert_id;
        $usuario = $_SESSION['usuario'];
        $fecha = date("Y-m-d"); 
        $insertPublicacionQuery = "INSERT INTO publicacion (usuario, titulo, descripcion, fecha, idImagen) VALUES ('$usuario', '$titulo', '$descripcion', '$fecha', '$idImagen')";
        $conexion->query($insertPublicacionQuery);
        if ($conexion->affected_rows == 1) {
            $conexion->close();
            $alerta = "publicacionExitosa";
        } else {
            unlink($rutaCompleta);
            $conexion->close();
            $alerta = "publicacionFallida";
        }
    } else {
        unlink($rutaCompleta);
        $conexion->close();
        $alerta = "publicacionFallida";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PanelAdmin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
</head>

<body>
    <header>
        <nav class="navbar navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Lista General</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                            Menu
                        </h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="admin.php">Principal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="lista.php">Listado de "Noticias"</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Publicar</a>
                            </li>
                            <?php
                                if ($rol == 'admin') {
                                    echo "<li class='nav-item'>
                                            <a class='nav-link text-warning bg-dark' href='solicitud.php'>Solicitud de usuarios</a>
                                        </li>";
                                    echo "<li class='nav-item'>
                                            <a class='nav-link text-warning bg-dark' href='listausers.php'>Lista de usuarios</a>
                                        </li>";
                                }
                            ?>
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" />
                            <button class="btn btn-outline-success" type="submit">
                                Buscar
                            </button>
                        </form>
                        <br>
                        <div class="d-flex justify-content-center">
                            <form action="../php/cerrar.php" method="post">
                                <button type="submit" class="btn btn-outline-danger">Cerrar Sesión</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <div class="container mt-5">
        <hr>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título De la noticia</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingrese el título"
                    required autocomplete="off" maxlength="20" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                    placeholder="Ingrese la descripción" required maxlength="220"></textarea>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen" required>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Publicar</button>
            </div>
        </form>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
<?php include_once("../php/alertas.php") ?>