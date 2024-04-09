<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include_once("../php/conexion.php");
if (!isset($_SESSION['usuario'])) {
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
    exit();
}
if ($rol !== 'admin') {
    header('location: admin.php');
    exit();
}
$totalUsuarios = "SELECT * FROM usuario";
$consultaadmin = $conexion->query($totalUsuarios);

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
                <a class="navbar-brand" href="#">USUARIOS</a>
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
                                <a class="nav-link" href="crear.php">Publicar</a>
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
        <div class="card border-success mb-3" style="max-width: 18rem;">
            <div class="card-body text-success">
                <h5 class="card-title">
                    <?php echo $usuario; ?>
                </h5>
                <p class="card-text">
                   Rango: <?php echo $rol; ?>
            </div>
            <div class="card-footer bg-transparent border-success">
                <p class="card-text">Usuarios Activos: <?php echo $consultaadmin->num_rows; ?></p>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre de Usuario</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($consultaadmin->num_rows > 0) {
                    while ($fila = $consultaadmin->fetch_assoc()) {
                        echo "<tr>
                                <td>{$fila['nombreUser']}</td>
                                <td>
                                    <a href='' class='btn btn-danger'>Dar de Baja</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "No hay usuarios registrados.";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>
<?php include_once("alertas.php") ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
