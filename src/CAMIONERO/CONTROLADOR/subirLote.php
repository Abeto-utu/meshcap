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
    $estado_camionero = $fila['estado'];
    $matricula = $fila['matricula'];
}

// Subir lote

if ($accion == 'subir') {
    $lote = $_POST['lote'];
    echo $lote;
    echo $matricula;


    $query = "SELECT *
    FROM lote
    WHERE id_lote = $lote;
    ";
    $resultado = mysqli_query($conn, $query);

    $fila = $fila = mysqli_fetch_array($resultado);

    if ($fila['estado'] == 'en camion') {
        header("Location: ../MODELO/subirLote.php?error=lec"); // Lote En Camion
        die("Error en la consulta 1");
    }

    if ($fila['estado'] == 'entregado') {
        header("Location: ../MODELO/subirLote.php?error=le"); // Lote Entregado
        die("Error en la consulta 1");
    }
    if ($fila['estado'] == 'abierto') {
        header("Location: ../MODELO/subirLote.php?error=la"); // Lote Abierto
        die("Error en la consulta 1");
    }

    $query = "INSERT INTO vehiculo_plataforma_lote (id_lote, id_plataforma, matricula) 
    VALUES ($lote, (SELECT id_plataforma FROM plataforma_lote WHERE id_lote = $lote), '$matricula');";
    $resultado = mysqli_query($conn, $query);

    if (!$resultado) {
        header("Location: ../MODELO/subirLote.php?error=lne");  // Lote Ya subido
        die("Error en la consulta 1");
    }

    if (empty($fila['fecha_cierre'])) {
        $query = "UPDATE lote
        SET fecha_cierre = CURRENT_TIMESTAMP
        WHERE id_lote = $lote;
        ";
        $resultado = mysqli_query($conn, $query);

        if (!$resultado) {
            die("Error en la consulta 2");
        }
    }

    $query = "UPDATE lote
    SET estado = 'en camion'
    WHERE id_lote = $lote;
    ";
    $resultado = mysqli_query($conn, $query);


    if (!$resultado) {
        die("Error en la consulta 3
        
        ");
    }
    header("Location: ../MODELO/subirLote.php");
}

?>