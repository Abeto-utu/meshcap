<?php
require('../../db.php');
session_start(); 

if(isset($_POST['numero_paquete']) && isset($_POST['rastreo'])) {
    $numero = $_POST['numero_paquete'];

    $query = "SELECT pa.id_paquete, pa.estado, vp.id_lote, v.matricula, u.nombre
    FROM paquete_lote p
    JOIN vehiculo_plataforma_lote vp ON p.id_lote = vp.id_lote
    JOIN paquete pa ON p.id_paquete = pa.id_paquete
    JOIN plataforma_lote pl ON vp.id_lote = pl.id_lote
    JOIN vehiculo v ON vp.matricula = v.matricula
    JOIN camionero_vehiculo cv ON v.matricula = cv.matricula
    JOIN usuario u ON cv.id_usuario = u.id_usuario
    WHERE p.id_paquete = $numero
    UNION
    SELECT *
    FROM paquete
    WHERE id_paquete = $numero;
    ";
    $paqueteSeleccionado = mysqli_query($conn, $query);

    if(!$paqueteSeleccionado) {
        header("Location: ../VISTA/index.php?error=pne#paquete");
    } else 

    $_SESSION['resultado_paquete'] = mysqli_fetch_assoc($paqueteSeleccionado);

    header("Location: ../VISTA/index.php#paquete");
    exit;
}
?>