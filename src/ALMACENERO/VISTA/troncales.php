<?php
require('../../db.php');
require_once('../CONTROLADOR/controladorAlmacenero.php');
session_start();

if (isset($_SESSION['username'])) {
    ($almacenero = $almaceneroModel->infoAlmacenero($_SESSION['username']));
} else {
    header("Location: ../../HOMEPAGE/VISTA/index.php");
    exit();
}

header("Location: almacenero.php");
exit();

?>