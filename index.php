
<?php
    session_start();
    include("php/conexion.php");
    if(isset($_POST['Ingresar'])){
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        $consulta = "SELECT * FROM usuario WHERE nombreUser = '$usuario' AND password = '$contrasena'";
        $resultado = mysqli_query($conexion, $consulta);
        $filas = mysqli_num_rows($resultado);
        if($filas){
            $_SESSION['usuario'] = $usuario;
            header("location: html/admin.php");
        }else{
            ?>
<script>
    alert("Usuario o Contraseña Incorrectos");
    window.location = "index.php";
</script>
<?php
        }
    }
    $consultaPublicaciones = "SELECT publicacion.idPublicacion, publicacion.titulo, publicacion.descripcion, publicacion.fecha, publicacion.idImagen, usuario.nombreUser, imagen.ruta AS rutaImagen
    FROM publicacion
    INNER JOIN usuario ON publicacion.usuario = usuario.nombreUser
    LEFT JOIN imagen ON publicacion.idImagen = imagen.idImagen
    ORDER BY publicacion.fecha DESC";
    $resultadoPublicaciones = mysqli_query($conexion, $consultaPublicaciones);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Updates Shit | News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css/stylo.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <style>

    </style>
</head>


<body>
    <div class="container">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-dark" href="#">Daily Updates</a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <a class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#Id2" aria-controls="Id2">Login</a>
                </div>
            </div>
        </header>
        <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="Id2"
            aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="staticBackdropLabel">
                    Inicio de Sesion
                </h5>
                <h6>
                **Solo Publicadores**
                </h6>

                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
            <hr>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario"
                            placeholder="Ingrese su usuario" maxlength="10" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena"
                            placeholder="Ingrese su contraseña" maxlength="10" required>
                    </div>
                    <button type="submit" class="btn btn-primary" title="Ingresar" name="Ingresar">Iniciar
                        Sesión</button>
                    <button type="reset" class="btn btn-danger" title="Limpiar">Limpiar</button>
                </form>
                <hr>
                <p>¿Quieres ser parte del equipo? <a href="html/registro.php">Solicitar</a></p>
            </div>
        </div>
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
                <h1 class="display-4 font-italic">Bienvenid@ a las actualizaciones Diarias</h1>
                <p class="lead my-3">Hola!! Se bienvenido/a las actualizaciones diarias mundiales, hecha un vistazo al
                    planeta que esta en constantes actualizaciones.</p>
            </div>
        </div>
            <?php
$consultaUltimoPost = "SELECT publicacion.idPublicacion, publicacion.titulo, publicacion.descripcion, publicacion.fecha, publicacion.idImagen, usuario.nombreUser, imagen.ruta AS rutaImagen
FROM publicacion INNER JOIN usuario ON publicacion.usuario = usuario.nombreUser LEFT JOIN imagen ON publicacion.idImagen = imagen.idImagen
ORDER BY publicacion.idPublicacion DESC LIMIT 1";

$resultadoUltimoPost = mysqli_query($conexion, $consultaUltimoPost);

if ($filaUltimoPost = mysqli_fetch_assoc($resultadoUltimoPost)) {
    echo '<div class="col-md-6">';
    echo '<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">';
    echo '<div class="col p-4 d-flex flex-column position-static">';
    echo '<strong class="d-inline-block mb-2 text-primary">Última Actualización</strong>';
    echo '<h3 class="mb-0">' . $filaUltimoPost['titulo'] . '</h3>';
    echo '<div class="mb-1 text-muted">' . $filaUltimoPost['fecha'] . '</div>';
    echo '<p>' . $filaUltimoPost['descripcion'] . '</p>';
    echo '</div>';
    
    echo '<div class="col-auto d-none d-lg-block">';
    if (!empty($filaUltimoPost['rutaImagen'])) {
        $rutaImagenMostrarUltimoPost = substr($filaUltimoPost['rutaImagen'], 3);
        echo '<img src="' . $rutaImagenMostrarUltimoPost . '" class="rounded mx-auto d-block" alt="Imagen del último post">';
    } else {
        echo '<p>No hay imagen disponible</p>';
    }
    echo '</div>';
    
    echo '</div>';
    echo '</div>';
}

?>

        </div>
    </div>

    <main class="container">
        <div class="row">
            <div class="col-md-8">
                <?php
$consultaPublicaciones = "SELECT publicacion.idPublicacion, publicacion.titulo, publicacion.descripcion, publicacion.fecha, publicacion.idImagen, usuario.nombreUser, imagen.ruta AS rutaImagen
FROM publicacion INNER JOIN usuario ON publicacion.usuario = usuario.nombreUser LEFT JOIN imagen ON publicacion.idImagen = imagen.idImagen ORDER BY publicacion.idPublicacion DESC";
$resultadoPublicaciones = mysqli_query($conexion, $consultaPublicaciones);

while ($fila = mysqli_fetch_assoc($resultadoPublicaciones)) {
    echo '<hr>';
    echo '<div class="blog-post">';
    echo '<h2 class="blog-post-title">' . $fila['titulo'] . '</h2>';
    echo '<p class="blog-post-meta">' . $fila['fecha'] . ' Por: <a href="#">' . $fila['nombreUser'] . '</a></p>';
    
    echo '<div class="text-center">';
    if (!empty($fila['rutaImagen'])) {
        $rutaImagenMostrar = substr($fila['rutaImagen'], 3);
        echo '<img src="' . $rutaImagenMostrar . '" class="img-fluid" alt="Imagen de la publicación">';
    } else {
        echo '<p>No hay imagen disponible</p>';
    }
    echo '</div>';
    
    echo '<p>' . $fila['descripcion'] . '</p>';
    echo '</div>';
}
?>
                <hr>

            <aside class="col-md-4">
                <div class="p-4 mb-3 bg-light rounded">
                    <h4 class="font-italic">Acerca de:</h4>
                    <p class="mb-0">Esta pagina es meramente hecha por humor con situaciones completamente ficticias e
                        ironicas que se van ocurriendo o basadas en algo que pase en la actualidad... :P</p>
                </div>

                <div class="p-4">
                </div>

                <div class="p-4">
                    <h4 class="font-italic">En otro Lugar</h4>
                    <ol class="list-unstyled">
                        <li><a href="https://github.com/Marc0Val">GitHub</a></li>
                        <li><a href="https://twitter.com/MRC0VLDZ1">Twitter</a></li>
                        <li><a href="https://web.facebook.com/LaNutriaDeMinecraft">Facebook</a></li>
                    </ol>
                </div>
            </aside>

        </div>

    </main>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>