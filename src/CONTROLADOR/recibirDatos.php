<?php
session_start();
require('../MODELO/db.php');

    if (isset($_POST['numero_funcionario']) && isset($_POST['clave'])) {
        $numeroFuncionario = $_POST['numero_funcionario'];
        $clave = $_POST['clave'];

        $query = "SELECT cargo FROM login WHERE id_usuario = '$numeroFuncionario' AND contrasenha = '$clave'";
        $resultado = mysqli_query($conn, $query);

            if ($resultado) {
                $fila = mysqli_fetch_assoc($resultado);
                $cargo = $fila['cargo'];
            } else {
                $_SESSION['error'] = 'Error al iniciar sesion, usuario o contraseña incorrectos...';
                    header("Location: ../VISTA/inicioSesion.php");
            }

            $datos = ['id_usuario' => $numeroFuncionario, 'contrasenha' => $clave, 'cargo' => $cargo];
            $json = json_encode($datos);

                if ($json) {
                    header("Location: ../CONTROLADOR/autentificacion.php?data=$json");
                    exit();
                } else {
                    $_SESSION['error'] = 'Error al iniciar sesion, usuario o contraseña incorrectos...';
                        header("Location: ../VISTA/inicioSesion.php");
                }
    } else {
        $_SESSION['error'] = 'Error al iniciar sesion, usuario o contraseña incorrectos...';
            header("Location: ../VISTA/inicioSesion.php");
    }
?>