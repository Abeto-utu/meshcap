<?php
require('../../db.php');
session_start();

if (isset($_GET['id_entrega'])) {
    $id_recorrido = $_GET['id_entrega'];
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
    $nombre = $fila['nombre'];
    $cargo = $fila['cargo'];
    $estado = $fila['estado'];
    $matricula = $fila['matricula'];
}

// Finalizar entrega


$query = "UPDATE recorrido
    SET estado = 'finalizado'
    WHERE id_recorrido = $id_recorrido;";
$resultado = mysqli_query($conn, $query);
if (!$resultado) {
    die("Error en la consulta 1");
}

$query = "UPDATE camionero
    SET estado = 'disponible'
    WHERE id_usuario = $id_usuario;
    ";
$resultado = mysqli_query($conn, $query);
if (!$resultado) {
    die("Error en la consulta 2");
}

$query = "UPDATE vehiculo
    SET estado = 'con conductor'
    WHERE matricula = '$matricula';
    ";
$resultado = mysqli_query($conn, $query);
if (!$resultado) {
    die("Error en la consulta 3");
}

header("Location: ../VISTA/entrega.php");


?>