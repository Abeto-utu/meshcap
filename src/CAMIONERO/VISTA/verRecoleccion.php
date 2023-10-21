<?php
require('../../db.php');
session_start();

if (isset($_SESSION['username'])) {
    $id_usuario = $_SESSION['username'];
} else {
    header("Location: ../VISTA/inicioSesion.php");
    exit();
}

if (isset($_GET['id_recoleccion'])) {
    $id = $_GET['id_recoleccion'];
    $query = "SELECT r.id_recoleccion, r.fecha_llegada, r.fecha_ida, cr.id_cliente, cli.nombre as nombre_cliente, rv.matricula
    FROM recoleccion r
    JOIN cliente_recoleccion cr ON r.id_recoleccion = cr.id_recoleccion
    JOIN cliente cli ON cr.id_cliente = cli.id_cliente
    JOIN recoleccion_vehiculo rv ON r.id_recoleccion = rv.id_recoleccion
    WHERE r.id_recoleccion = $id;
    
    ";
    $resultado = mysqli_query($conn, $query);
    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_array($resultado);
        $id_recoleccion = $fila['id_recoleccion'];
        $fecha_llegada = $fila['fecha_llegada'];
        $fecha_ida = $fila['fecha_ida'];
        $matricula = $fila['matricula'];
        $nombre_cliente = $fila['nombre_cliente'];
        $id_cliente = $fila['id_cliente'];
        if (empty($fila['fecha_ida'])) {
            $estado = "sin empezar";
        } elseif (empty($fila['fecha_llegada'])) {
            $estado = "en proceso";
        } else {
            $estado = "finalizado";
        }
    }
}

$nombre = "";
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rutas</title>
    <link rel="stylesheet" href="../CSS/stylesCrudPaquetes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../IMAGES/gorraBlanca.png" type="image/x-icon">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark p-4 ">
        <div class="container-fluid">
            <a class="navbar-brand" href="../VISTA/camionero.php" id="logo"><img src="../../IMAGES/gorraBlanca.png"
                    height="40" alt="">MeshCap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-center" id="offcanvasDarkNavbarLabel">Menu del Backoffice</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../VISTA/camionero.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../VISTA/perfilCamionero.php">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../VISTA/rutasCamionero.php">Rutas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../../HOMEPAGE/VISTA/index.html">Log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2">Detalles de Recolección</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>ID Recolección</th>
                            <td>
                                <?php echo $id_recoleccion; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <td>
                                <?php echo $nombre_cliente; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Estado</th>
                            <td>
                                <?php echo $estado; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Matrícula</th>
                            <td>
                                <?php echo $matricula; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha de Llegada</th>
                            <td>
                                <?php echo $fecha_llegada; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha de Ida</th>
                            <td>
                                <?php echo $fecha_ida; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <?php
            if ($estado == 'sin empezar') { ?>
                <div class="text-center mt-3">
                    <a href="../CONTROLADOR/iniciarRecoleccion.php?id_recoleccion=<?php echo $id_recoleccion ?>&a=<?php echo 'iniciar' ?>"
                        class="btn btn-primary">Iniciar recoleccion</a>
                </div>';
            <?php } ?>

            <?php
            if ($estado == 'en proceso') { ?>
                <div class="text-center mt-3">
                    <a href="../VISTA/agregarPaquete.php?id_recoleccion=<?php echo $id_recoleccion ?>&a=<?php echo 'agregar' ?>"
                        class="btn btn-primary">Agregar paquete</a>
                </div>';
                <div class="text-center mt-3">
                    <a href="../CONTROLADOR/finalizarRecoleccion.php?id_recoleccion=<?php echo $id_recoleccion ?>&a=<?php echo 'finalizar' ?>"
                        class="btn btn-primary">Finalizar recoleccion</a>
                </div>';
            <?php } ?>




        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script>
</body>

</html>