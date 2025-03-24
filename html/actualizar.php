<?php
$alerta = "";
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idPublicacion = $_GET['id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("../php/conexion.php");
        $tituloActualizado = $_POST["titulo"];
        $descripcionActualizada = $_POST["descripcion"];
        $actualizarQuery = "UPDATE publicacion SET titulo='$tituloActualizado', descripcion='$descripcionActualizada' WHERE idPublicacion = $idPublicacion";
        $resultadoActualizar = mysqli_query($conexion, $actualizarQuery);
        if ($resultadoActualizar) {
            $alerta = "actualizacionExitosa";
        } else {
            $alerta = "actualizacionFallida";
            echo "Error al actualizar la publicación: " . mysqli_error($conexion);
        }
        mysqli_close($conexion);
    } else {
        if (!$_SERVER["REQUEST_METHOD"] == "POST"){
            $alerta = "formularioNoEnviado";
        }
    }
} else {
    header('Location: lista.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Noticia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
    <script>
        (function (c, s, q, u, a, r, e) {
            c.hj=c.hj||function(){(c.hj.q=c.hj.q||[]).push(arguments)};
            c._hjSettings = { hjid: a };
            r = s.getElementsByTagName('head')[0];
            e = s.createElement('script');
            e.async = true;
            e.src = q + c._hjSettings.hjid + u;
            r.appendChild(e);
        })(window, document, 'https://static.hj.contentsquare.net/c/csq-', '.js', 5345946);
    </script>
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
                        </ul>
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
        <?php
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $idPublicacion = $_GET['id'];
            include("../php/conexion.php");
            $consultaPublicacion = "SELECT idPublicacion, titulo, descripcion FROM publicacion WHERE idPublicacion = $idPublicacion";
            $resultadoConsulta = mysqli_query($conexion, $consultaPublicacion);
            if ($filaPublicacion = mysqli_fetch_assoc($resultadoConsulta)) {
                ?>
                <form action="<?php echo htmlspecialchars("actualizar.php?id=" . $idPublicacion); ?>" method="post"
                    enctype="multipart/form-data">
                    <h1>
                        Actualizar Noticia
                    </h1>
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título De la noticia</label>
                        <input required type="text" class="form-control" id="titulo" name="titulo"
                            value="<?php echo $filaPublicacion['titulo']; ?>" required autocomplete="off" maxlength="20">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea   maxlength="220" required class="form-control" id="descripcion" name="descripcion" rows="3"
                            placeholder="Ingrese la descripción" required><?php echo $filaPublicacion['descripcion'];?></textarea>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
                <?php
            } else {
                header('Location: lista.php');
            }
            mysqli_close($conexion);
        } else {
            header('Location: lista.php');
        }
        ?>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
<?php include_once("../php/alertas.php") ?> 