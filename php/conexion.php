<?php
// Datos de la base de datos, en este caso es local XDXD
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "dshit";
    // Crear conexión 
    $conexion = mysqli_connect($host, $user, $password, $database);
    
    // Comprobar conexión
    if (mysqli_connect_errno()) {
        // si la conexion falla se muestra un mensaje de error
        echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
    }
    else
    {
        // se supone que aqui habria una alerta para indicar que la conexion fue exitosa pero no se me ocurrio como hacerlo XDXD
    }

?>   