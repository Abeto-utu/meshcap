<?php
session_start();
require('../../db.php');

    if (isset($_POST['numero_funcionario']) && isset($_POST['clave'])) {
        $numeroFuncionario = $_POST['numero_funcionario'];
        $clave = $_POST['clave'];
        $datos = [
            'numeroFuncionario' => $numeroFuncionario,
            'clave' => $clave,
        ];

        $json = json_encode($datos);

            if ($json) {
                header("Location: ../MODELO/autentificacion.php?data=$json");
            }

    } else {
        $_SESSION['error'] = 'Error al iniciar sesion, usuario o contraseña incorrectos...';
            echo "error aca";
    }
?>