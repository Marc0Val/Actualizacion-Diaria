<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="../js/alertas.js"></script>

<?php
if ($alerta == "publicacionExitosa") { ?>
<script> publicacionExitosa() </script>
<?php } ?>
<?php
if ($alerta == "publicacionFallida") { ?>
<script> publicacionFallida() </script>
<?php } ?>
<?php
if ($alerta == "actualizacionExitosa") { ?>
<script> actualizacionExitosa() </script>
<?php } ?>
<?php
if ($alerta == "actualizacionFallida") { ?>
<script> actualizacionFallida() </script>
<?php } ?>
<?php
if ($alerta == "formularioNoEnviado") { ?>
<script> formularioNoEnviado() </script>
<?php } ?>
<?php
if ($alerta == "eliminacionExitosa") { ?>
<script> eliminacionExitosa() </script>
<?php } ?>
<?php
if ($alerta == "eliminacionFallida") { ?>
<script> eliminacionFallida() </script>
<?php } ?>