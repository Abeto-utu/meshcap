<?php
require_once('../../db.php');
require_once('../MODELO/modeloCamionero.php');

$camioneroModel = new camioneroModel($conn);

// Subir lote
if (isset($_GET['subirLote'])) {
    $lote = $_POST['lote'];
    $matricula = $_GET['matricula'];
    // Llamar al método para guardar el lote
    if ($camioneroModel->subirLote($lote, $matricula)) {
        header("Location: ../VISTA/troncales.php");
        exit();
    } else {
        header("Location: ../VISTA/troncales.php?error=subirLote");
    }
}

if (isset($_GET["iniciarTroncal"])) {
    $id_usuario = $_GET['id_usuario'];
    $matricula = $_GET['matricula'];
    if ($camioneroModel->iniciarTroncal($id_usuario, $matricula)) {
        header("Location: ../VISTA/troncales.php");
        exit();
    } else {
        header("Location: ../VISTA/troncales.php?error=iniciarTroncal");
    }
}

if (isset($_GET["finalizarTroncal"])) {
    $id_usuario = $_GET['id_usuario'];
    $matricula = $_GET['matricula'];
    if ($camioneroModel->finalizarTroncal($id_usuario, $matricula)) {
        header("Location: ../VISTA/troncales.php");
        exit();
    } else {
        header("Location: ../VISTA/troncales.php?error=finalizarTroncal");
    }
}

if (isset($_GET["iniciarRecoleccion"])) {
    $id_usuario = $_GET['id_usuario'];
    $matricula = $_GET['matricula'];
    $id_recoleccion = $_GET['id_recoleccion'];
    if ($camioneroModel->inciarRecoleccion($id_recoleccion, $id_usuario, $matricula)) {
        header("Location: ../VISTA/verRecoleccion.php?id_recoleccion=$id_recoleccion");
        exit();
    } else {
        header("Location: ../VISTA/verRecoleccion.php?id_recoleccion=$id_recoleccion&error=iniciarRecoleccion");
    }
}

if (isset($_GET["finalizarRecoleccion"])) {
    $id_usuario = $_GET['id_usuario'];
    $matricula = $_GET['matricula'];
    $id_recoleccion = $_GET['id_recoleccion'];
    if ($camioneroModel->finalizarRecoleccion($id_recoleccion, $id_usuario, $matricula)) {
        header("Location: ../VISTA/verRecoleccion.php?id_recoleccion=$id_recoleccion");
        exit();
    } else {
        header("Location: ../VISTA/verRecoleccion.php?id_recoleccion=$id_recoleccion&error=finalizarRecoleccion");
    }
}

if (isset($_GET["agregarPaquete"])) {
    $id_recoleccion = $_GET["id_recoleccion"];
    if ($camioneroModel->agregarPaquete()) {
        header("Location: ../VISTA/verRecoleccion.php?id_recoleccion=$id_recoleccion");
        exit();
    } else {
        header("Location: ../VISTA/verRecoleccion.php?id_recoleccion=$id_recoleccion&error=agregarPaquete");
        exit();
    }
}

if (isset($_GET["iniciarEntrega"])) {
    $id_usuario = $_GET['id_usuario'];
    $matricula = $_GET['matricula'];
    $id_recorrido = $_GET['id_recorrido'];
    if ($camioneroModel->iniciarEntrega($id_usuario, $matricula, $id_recorrido)) {
        header("Location: ../VISTA/entrega.php");
        exit();
    } else {
        header("Location: ../VISTA/entrega.php?error=iniciarEntrega");
        exit();
    }
}

if (isset($_GET["finalizarEntrega"])) {
    $id_usuario = $_GET['id_usuario'];
    $matricula = $_GET['matricula'];
    $id_recorrido = $_GET['id_recorrido'];
    if ($camioneroModel->finalizarEntrega($id_recorrido, $id_usuario, $matricula)) {
        header("Location: ../VISTA/entrega.php");
        exit();
    } else {
        header("Location: ../VISTA/entrega.php?error=finalizarEntrega");
        exit();
    }
}

if (isset($_GET["entregarPaquete"])) {
    if ($camioneroModel->entregarPaquete()) {
        header("Location: ../VISTA/entrega.php");
        exit();
    } else {
        header("Location: .../VISTA/entrega.php&error=entregarPaquete");
        exit();
    }
}

if (isset($_GET["entregarLote"])) {
    if ($camioneroModel->entregarLote()) {
        header("Location: ../VISTA/troncales.php");
        exit();
    } else {
        header("Location: .../VISTA/troncales.php&error=entregarLote");
        exit();
    }
}

?>