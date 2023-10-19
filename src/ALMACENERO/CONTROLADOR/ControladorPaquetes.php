<?php
require_once('../../db.php');
require_once('../MODELO/ModeloPaquetes.php');

$paqueteModel = new PaqueteModel($conn);


// Verificar si se ha enviado el formulario para guardar un paquete
if (isset($_POST['guardar_paquete'])) {
    $departamento = $_POST['departamento'];
    $localidad = $_POST['localidad'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $plataforma_actual_paquete = $_POST['plataforma_actual_paquete'];
    $estado_paquete = $_POST['estado_paquete'];

    // Llamar al método para guardar el paquete
    if ($paqueteModel->guardarPaquete($departamento, $localidad, $calle, $numero, $plataforma_actual_paquete, $estado_paquete)) {
        header("Location: ../VISTA/CrudPaquetesAlmacenero.php");
        exit();
    } else {
        // Si hubo un error en la inserción, puedes mostrar un mensaje de error.
        echo "Error al guardar el paquete.";
    }
}



if (isset($_GET['eliminar_paquete'])) {
    $id_paquete = intval($_GET['eliminar_paquete']); // Convierte el valor a un entero

    // Llamar al método para eliminar el paquete
    if ($paqueteModel->eliminarPaquete($id_paquete)) {
        header("Location: ../VISTA/CrudPaquetesAlmacenero.php");
        exit();
    } else {
        // Si hubo un error en la eliminación, puedes mostrar un mensaje de error.
        echo "Error al eliminar el paquete.";
    }
}


if (isset($_POST['editar_paquete'])) {
    $id_paquete = intval($_POST['id_paquete']);
    $departamento = $_POST['departamento'];
    $localidad = $_POST['localidad'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $plataforma_actual_paquete = $_POST['plataforma_actual_paquete'];
    $estado_paquete = $_POST['estado_paquete'];

    // Llamar al método para editar el paquete
    if ($paqueteModel->editarPaquete($id_paquete, $departamento, $localidad, $calle, $numero, $plataforma_actual_paquete, $estado_paquete)) {
        header("Location: ../VISTA/CrudPaquetesAlmacenero.php");
        exit();
    } else {
        // Si hubo un error en la edición, puedes mostrar un mensaje de error.
        echo "Error al editar el paquete.";
    }

}
?>