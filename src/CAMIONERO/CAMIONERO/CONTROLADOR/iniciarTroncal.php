<?php
require('../../db.php');
session_start();

if (isset($_GET['a'])) {
    $accion = $_GET['a'];
}

if (isset($_SESSION['username'])) {
    $id_usuario = $_SESSION['username'];
} else {
    header("Location: ../VISTA/inicioSesion.php");
    exit();
}


// Iniciar troncal

if ($accion == 'iniciar') {
    $query = "UPDATE camionero
    SET estado = 'trabajando'
    WHERE id_usuario = $id_usuario;
    ";
    $resultado = mysqli_query($conn, $query);
    if (!$resultado) {
        die("Error en la consulta 1");
    }

    $query = "UPDATE vehiculo
    SET estado = 'en linea'
    WHERE matricula = '$matricula';
    ";
    $resultado = mysqli_query($conn, $query);
    if (!$resultado) {
        die("Error en la consulta 2");
    }


    header("Location: ../VISTA/troncales.php");
}




?>