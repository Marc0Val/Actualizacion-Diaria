<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud Personal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="../index.php" class="btn btn-info">Volver</a>
            </div>
            <div class="col-12">
                <p>Para solicitar unirte al personal de publicadores de "Actualizaciones Diarias"...</p>
                <p>Debes llenar el siguiente formulario con los datos que se le piden...</p>
                <p>Una vez enviado, se pide ser paciente hasta que el Administrador apruebe la solicitud</p>
                <p>GRACIAS!!</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>
                    Formulario.
                </h2>
                <form action="../php/solicitud.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Real:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Real" maxlength="20" required>
                    </div>
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Nombre de Usuario:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de Usuario" maxlength="10" required>
                    </div>
                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" maxlength="10" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <button type="reset" class="btn btn-danger">Limpiar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>