function publicacionExitosa(){
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Publicacion Exitosa',
        showConfirmButton: false,
        timer: 1500
    }).then(function () {
        location.href = "../html/lista.php";
    })
}
function publicacionFallida(){
    Swal.fire({
        icon: "error",
        title: "Algo salio mal al hacer la publicacion...",
        text: "Publicacion no hecha",
        footer: '<p>Esto puede deberse a una falla en la base de datos o conexion...</p>',
        footer: '<p>Porfavor Informa de este error al administrador...</p>'
      }).then(function () {
        location.href = "../html/lista.php";
    })
}
function actualizacionExitosa(){
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Publicacion Actualizada Correctamente',
        showConfirmButton: false,
        timer: 1500
    }).then(function () {
        location.href = "../html/lista.php";
    })
}
function actualizacionFallida(){
    Swal.fire({
        icon: "error",
        title: "Error al actualizar la publicacion...",
        text: "Actualizacion Cancelada",
        footer: '<p>Esto puede deberse a una falla en la base de datos o conexion...</p>',
        footer: '<p>Porfavor Informa de este error al administrador...</p>'
      }).then(function () {
        location.href = "../html/lista.php";
    }) 
}
function formularioNoEnviado(){
    Swal.fire({
        icon: "error",
        title: "Error en el formulario",
        footer: '<p>Esto puede deberse a una falla en la base de datos o conexion...</p>',
        footer: '<p>Porfavor Informa de este error al administrador...</p>'
      }).then(function () {
        location.href = "../html/lista.php";
    })
}
function eliminacionExitosa(){
    Swal.fire({
        title: 'Publicacion eliminada',
        icon: 'success',
        showConfirmButton: false,
        timer: 1700,
    }).then((result) => {
        location.href = "../html/lista.php";
    }
    )
}

