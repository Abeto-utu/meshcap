<?php
require('../MODELO/db.php');
session_start(); 

if(isset($_POST['numero_paquete']) && isset($_POST['rastreo'])) {
    $numero = $_POST['numero_paquete'];

    $query = "SELECT * FROM paquete WHERE id_paquete = $numero";
    $paqueteSeleccionado = mysqli_query($conn, $query);

    if(!$paqueteSeleccionado) {
        $_SESSION['no_encontrado'] = true;
    }

    $_SESSION['resultado_paquete'] = mysqli_fetch_assoc($paqueteSeleccionado);

    header("Location: ../VISTA/rastrearPaquete.php");
    exit;
}
?>