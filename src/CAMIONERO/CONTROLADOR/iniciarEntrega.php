<?php
require('../../db.php');
session_start();


if (isset($_SESSION['username'])) {
    $id_usuario = $_SESSION['username'];
} else {
    header("Location: ../VISTA/inicioSesion.php");
    exit();
}

$id_recorrido = $_GET["id_entrega"];

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
    $estado_camionero = $fila['estado'];
    $matricula = $fila['matricula'];
}

// Iniciar entrega

$query = "UPDATE camionero
    SET estado = 'trabajando'
    WHERE id_usuario = $id_usuario;
    ";
$resultado = mysqli_query($conn, $query);
if (!$resultado) {
    die("Error en la consulta 1");
}

$query = "UPDATE vehiculo
    SET estado = 'en recorrido'
    WHERE matricula = '$matricula';
    ";
$resultado = mysqli_query($conn, $query);
if (!$resultado) {
    die("Error en la consulta 2");
}

$query = "UPDATE paquete
SET estado = 'en recorrido'
WHERE id_paquete IN (
    SELECT id_paquete
    FROM paquete_recorrido
    WHERE id_recorrido = $id_recorrido
);";
$resultado = mysqli_query($conn, $query);
if (!$resultado) {
    die("Error en la consulta 3");
}

$query = "UPDATE recorrido
SET fecha_inicio = CURRENT_TIMESTAMP, estado = 'en proceso'
WHERE id_recorrido = $id_recorrido;";
$resultado = mysqli_query($conn, $query);
if (!$resultado) {
    die("Error en la consulta 4");
}


header("Location: ../VISTA/entrega.php");





?>