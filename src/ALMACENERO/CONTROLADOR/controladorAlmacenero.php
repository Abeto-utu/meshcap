<?php
require_once('../../db.php');
require_once('../MODELO/modeloAlmacenero.php');

$almaceneroModel = new almaceneroModel($conn);

if (isset($_GET['crearRecoleccion'])) {
    $matricula = $_POST['matricula'];
    $id_cliente = $_POST['cliente'];
    if ($almaceneroModel->crearRecoleccion($id_cliente, $matricula)) {
        header("Location: ../VISTA/recolecciones.php");
        exit();
    } else {
        header("Location: ../VISTA/recolecciones.php?error=crearRecoleccion");
    }
}

if (isset($_GET['crearLote'])) {
    $id_plataforma = $_POST['plataforma'];
    if ($almaceneroModel->crearLote($id_plataforma)) {
        header("Location: ../VISTA/lotes.php");
        exit();
    } else {
        header("Location: ../VISTA/lotes.php?error=crearLote");
    }
}

if (isset($_GET['apal'])) {
    $id_lote = $_GET['id_lote'];
    $id_paquete = $_POST['paquete'];
    if ($almaceneroModel->asignarPaqueteALote($id_lote, $id_paquete)) {
        header("Location: ../VISTA/lotes.php");
        exit();
    } else {
        header("Location: ../VISTA/lotes.php?error=asignarPaqueteALote");
    }
}

if (isset($_GET['cerrarLote'])) {
    $id_lote = $_GET['id_lote'];
    if ($almaceneroModel->cerrarLote($id_lote)) {
        header("Location: ../VISTA/lotes.php");
        exit();
    } else {
        header("Location: ../VISTA/lotes.php?error=cerrarLote");
    }
}

if (isset($_GET['crearEntrega'])) {
    $matricula = $_POST['matricula'];
    if ($almaceneroModel->crearEntrega($matricula)) {
        header("Location: ../VISTA/entregas.php");
        exit();
    } else {
        header("Location: ../VISTA/entregas.php?error=crearEntrega");
    }
}

if (isset($_GET['apae'])) {
    $id_recorrido = $_GET['id_recorrido'];
    $id_paquete = $_POST['paquete'];
    if ($almaceneroModel->asignarPaqueteAEntrega($id_paquete, $id_recorrido)) {
        header("Location: ../VISTA/entregas.php");
        exit();
    } else {
        header("Location: ../VISTA/entregas.php?error=asignarPaqueteAEntrega");
    }
}

if (isset($_GET["agregarPaquete"])) {
    if ($almaceneroModel->agregarPaquete()) {
        header("Location: ../VISTA/paquetes.php");
        exit();
    } else {
        header("Location: ../VISTA/paquetes.php?error=agregarPaquete");
        exit();
    }
}

if (isset($_GET["entregarPaquete"])) {
    if ($almaceneroModel->entregarPaquete()) {
        header("Location: ../VISTA/paquetes.php");
        exit();
    } else {
        header("Location: .../VISTA/paquetes.php&error=entregarPaquete");
        exit();
    }
}

if (isset($_GET['desasignarCamionero'])) {
    $id_usuario = $_GET['id_usuario'];
    $matricula = $_GET['matricula'];
    if ($almaceneroModel->desasignarCamionero($id_usuario, $matricula)) {
        header("Location: ../VISTA/vehiculos.php");
        exit();
    } else {
        header("Location: ../VISTA/vehiculos.php?error=desasignarCamionero");
    }
}

if (isset($_GET['asignarCamionero'])) {
    $id_usuario = $_POST['usuario'];
    $matricula = $_GET['matricula'];
    if ($almaceneroModel->asignarCamionero($id_usuario, $matricula)) {
        header("Location: ../VISTA/vehiculos.php");
        exit();
    } else {
        header("Location: ../VISTA/vehiculos.php?error=asignarCamionero");
    }
}

if (isset($_GET['registrarCamion'])) {
    $matricula = $_POST['plataforma'];
    $tipo = $_POST['tipo'];

    if ($tipo == 'camioneta' || $tipo == 'camion') {
        if ($almaceneroModel->registrarCamion($matricula, $tipo)) {
            header("Location: ../VISTA/vehiculos.php");
            exit();
        } else {
            header("Location: ../VISTA/vehiculos.php?error=registrarCamion");
        }
    }else {
        header("Location: ../VISTA/vehiculos.php?error=tipoInvalido");
    }
}

?>