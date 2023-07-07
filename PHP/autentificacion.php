<?php
session_start();
if (isset($_GET['data'])) {
    $json = $_GET['data'];
    $objetoDecodificado = json_decode($json);

    if ($objetoDecodificado) {
        $puesto = $objetoDecodificado->puesto;
    } else {
        $_SESSION['error'] = 'Error al iniciar sesion, usuario o contraseña incorrectos...';
            header("Location: inicioSesion.php");
    }
    
    switch ($puesto) {
        case 'almacenero':
            header('Location: ../HTML/almacenero.html');
            exit();
        case 'camionero':
            header('Location: ../HTML/camionero.html');
            exit();
        case 'backoffice':
            header('Location: ../HTML/backoffice.html');
            exit();
        case 'repartidor':
            header('Location: ../HTML/repartidor.html');
            exit();
        case 'almaceneroMontevideo':
            header('Location: ../HTML/almaceneroMontevideo.html');
            exit();
        case 'almaceneroInterior':
            header('Location: ../HTML/almaceneroInterior.html');
            exit();     
        default:
            $_SESSION['error'] = 'Error al iniciar sesion, usuario o contraseña incorrectos...';
            header("Location: inicioSesion.php");
            exit();
    }
} else {
    $_SESSION['error'] = 'Error al iniciar sesion, usuario o contraseña incorrectos...';
        header("Location: inicioSesion.php");
}
?>