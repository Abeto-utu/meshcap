<?php
require_once('../../db.php');
require_once('../MODELO/ModeloLotes.php');

$loteModel = new loteModel($conn);

// Verificar si se ha enviado el formulario para guardar un lote
if (isset($_POST['guardar_lote'])) {
    $estado = $_POST['estado'];

    // Llamar al método para guardar el lote
    if ($loteModel->guardarLote($estado)) {
        header("Location: ../VISTA/CrudLotesAlmacenero.php");
        exit();
    } else {
        // Si hubo un error en la inserción, puedes mostrar un mensaje de error.
        echo "Error al guardar el lote.";
    }
}



if (isset($_GET['eliminar_lote'])) {
    $id_lote = ($_GET['eliminar_lote']);

    // Llamar al método para eliminar el lote
    if ($loteModel->eliminarLote($id_lote)) {
        header("Location: ../VISTA/CrudLotesAlmacenero.php");
        exit();
    } else {
        // Si hubo un error en la eliminación, puedes mostrar un mensaje de error.
        echo "Error al eliminar el lote.";
    }
}


if (isset($_POST['editar_lote'])) {
    $id_lote = intval($_POST['id_lote']);
    $estado = $_POST['estado'];

    // Llamar al método para editar el lote
    if ($loteModel->editarLote($id_lote, $estado)) {
        header("Location: ../VISTA/CrudLotesAlmacenero.php");
        exit();
    } else {
        // Si hubo un error en la edición, puedes mostrar un mensaje de error.
        echo "Error al editar el lote.";
    }

}


if (isset($_POST['agregar_paquete_a_lote'])) {
    $id_paquete = $_POST['id_paquete'];
    $id_lote = $_POST['id_lote'];

    // Llama al método del modelo para agregar el paquete al lote
    if ($loteModel->agregarPaqueteALote($id_paquete, $id_lote)) {
        header("Location: ../VISTA/crudLotesAlmacenero.php"); // Redirige a la página deseada después de agregar el paquete al lote.
        exit();
    } else {
        // Si hubo un error en la inserción, puedes mostrar un mensaje de error.
        echo "Error al agregar el paquete al lote.";
    }
}







?>