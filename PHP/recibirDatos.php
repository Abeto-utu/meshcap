<?php
session_start();
require('db.php');

    if (isset($_POST['numero_funcionario']) && isset($_POST['clave'])) {
        $numeroFuncionario = $_POST['numero_funcionario'];
        $clave = $_POST['clave'];

        $query = "SELECT puesto FROM usuarios WHERE numero_funcionario = '$numeroFuncionario' AND clave = '$clave'";
        $resultado = mysqli_query($conn, $query);

            if ($resultado) {
                $fila = mysqli_fetch_assoc($resultado);
                $cargo = $fila['puesto'];
            } else {
                $_SESSION['error'] = 'Error al iniciar sesion, usuario o contraseña incorrectos...';
                    header("Location: inicioSesion.php");
            }

            $datos = ['numeroFuncionario' => $numeroFuncionario, 'clave' => $clave, 'puesto' => $cargo];
            $json = json_encode($datos);

                if ($json) {
                    header("Location: autentificacion.php?data=$json");
                    exit();
                } else {
                    $_SESSION['error'] = 'Error al iniciar sesion, usuario o contraseña incorrectos...';
                        header("Location: inicioSesion.php");
                }
    } else {
        $_SESSION['error'] = 'Error al iniciar sesion, usuario o contraseña incorrectos...';
            header("Location: inicioSesion.php");
    }
?>