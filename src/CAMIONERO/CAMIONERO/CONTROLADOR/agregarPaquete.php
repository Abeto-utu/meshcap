<?php
require('../../db.php');
session_start();

if (isset($_GET['id_recoleccion'])) {
    $id_recoleccion = $_GET['id_recoleccion'];
    $accion = $_GET['a'];
}


// Agregar paquete

if ($accion == 'agregar') {
    $departamento = $_POST['departamento'];
    $estado = 'en plataforma'; // DEFAULT PORQUE SON PAQUETES QUE REOCOGE EL CAMIONERO
    $localidad = $_POST['localidad'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $destino = "$numero $calle, $localidad, $departamento";
    $query = "INSERT INTO paquete (destino, estado, fecha_recibo, fecha_entrega) 
    VALUES ('$destino', '$estado', CURRENT_TIMESTAMP, NULL);
    ";
    $resultado = mysqli_query($conn, $query);

    if (!$resultado) {
        die("Error en la consulta");
    }
    header("Location: ../VISTA/verRecoleccion.php?id_recoleccion=$id_recoleccion");
}

?>