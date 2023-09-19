<?php
session_start();
if (isset($_GET['data'])) {
    $json = $_GET['data'];
    $objetoDecodificado = json_decode($json);

    if ($objetoDecodificado) {
        $puesto = $objetoDecodificado->tipo_usuario;
    } else {
        $_SESSION['error'] = 'Error al iniciar sesion, usuario o contraseña incorrectos...';
            header("Location: ../VISTA/inicioSesion.php");
    }
    
    switch ($puesto) {
        case 'almacenero':
            header('Location: ../VISTA/almacenero.html');
            exit();
        case 'camionero':
            header('Location: ../VISTA/camionero.html');
            exit();
        case 'backoffice':
            header('Location: ../VISTA/backoffice.html');
            exit();
        case 'repartidor':
            header('Location: ../VISTA/repartidor.html');
            exit();    
        default:
            $_SESSION['error'] = 'Error al iniciar sesion, usuario o contraseña incorrectos...';
            header("Location: ../VISTA/inicioSesion.php");
            exit();
    }
} else {
    $_SESSION['error'] = 'Error al iniciar sesion, usuario o contraseña incorrectos...';
        header("Location: ../VISTA/inicioSesion.php");
}
?>