<?php
require_once('../../db.php');
require_once('../MODELO/ModeloVehiculos.php');

$vehiculoModel = new VehiculoModel($conn);


// Verificar si se ha enviado el formulario para guardar un vehiculo
if (isset($_POST['guardar_vehiculo'])) {
    $matricula = $_POST['matricula'];
    $estado = $_POST['estado_vehiculo'];
    $tipo = $_POST['tipo_vehiculo'];

    // Llamar al método para guardar el vehiculo
    if ($vehiculoModel->guardarVehiculo($matricula, $tipo, $estado)) {
        header("Location: ../VISTA/CrudVehiculosAlmacenero.php");
        exit();
    } else {
        // Si hubo un error en la inserción, puedes mostrar un mensaje de error.
        echo "Error al guardar el vehiculo.";
    }
}



if (isset($_GET['eliminar_vehiculo'])) {
    $matricula = $_GET['eliminar_vehiculo'];
    // Llamar al método para eliminar el vehiculo
    if ($vehiculoModel->eliminarVehiculo($matricula)) {
        header("Location: ../VISTA/CrudVehiculosAlmacenero.php");
        exit();
    } else {
        // Si hubo un error en la eliminación, puedes mostrar un mensaje de error.
        echo "Error al eliminar el vehiculo.";
    }
}


if (isset($_POST['editar_vehiculo'])) {
    $id_vehiculo = intval($_POST['matricula']);
    $tipo_vehiculo = $_POST['tipo_vehiculo'];
    $estado_vehiculo = $_POST['estado_vehiculo'];

    // Llamar al método para editar el vehiculo
    if ($vehiculoModel->editarvehiculo($matricula, $tipo_vehiculo, $estado_vehiculo)) {
        header("Location: ../VISTA/CrudVehiculosAlmacenero.php");
        exit();
    } else {
        // Si hubo un error en la edición, puedes mostrar un mensaje de error.
        echo "Error al editar el vehiculo.";
    }

}
?>