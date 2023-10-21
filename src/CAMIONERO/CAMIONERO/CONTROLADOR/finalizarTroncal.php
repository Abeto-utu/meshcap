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

$query = "SELECT c.id_usuario, u.nombre, u.cargo, c.estado, cv.matricula
        FROM camionero c
        JOIN camionero_vehiculo cv ON c.id_usuario = cv.id_usuario
        JOIN usuario u ON c.id_usuario = u.id_usuario
        WHERE c.id_usuario = $id_usuario";
$camionero = mysqli_query($conn, $query);

while ($fila = mysqli_fetch_array($camionero)) {
    $id_usuario = $fila['id_usuario'];
    $nombre = $fila['nombre'];
    $cargo = $fila['cargo'];
    $estado = $fila['estado'];
    $matricula = $fila['matricula'];
}

// Finalizar troncal

if ($accion == 'finalizar') {
    $query = "UPDATE camionero
    SET estado = 'disponible'
    WHERE id_usuario = $id_usuario;
    ";
    $resultado = mysqli_query($conn, $query);
    if (!$resultado) {
        die("Error en la consulta 1");
    }

    $query = "UPDATE vehiculo
    SET estado = 'con conductor'
    WHERE matricula = '$matricula';
    ";
    $resultado = mysqli_query($conn, $query);
    if (!$resultado) {
        die("Error en la consulta 2");
    }


    header("Location: ../VISTA/troncales.php");
}

?>