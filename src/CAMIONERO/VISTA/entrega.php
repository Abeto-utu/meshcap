<?php
/* error_reporting(E_ALL ^ E_WARNING);  */
require('../../db.php');
session_start();

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrega</title>
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
            <div class="col-md-12">
                <h1 class="mb-4">Paquetes a entregar</h1>
                <?php
                $query = "SELECT r.id_recorrido, r.estado, r.fecha_inicio, rv.matricula, cv.id_usuario
                        FROM recorrido r
                        JOIN recorrido_vehiculo rv ON r.id_recorrido = rv.id_recorrido
                        JOIN camionero_vehiculo cv ON rv.matricula = cv.matricula
                        WHERE cv.id_usuario = $id_usuario
                        AND r.estado IN ('no comenzado', 'en proceso');
                        ";
                $recorridosActivos = mysqli_query($conn, $query);
                if (mysqli_num_rows($recorridosActivos) == 1) {
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Domicilio</th>
                                <th scope="col">Paquete/s</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $resultArray = mysqli_fetch_array($recorridosActivos);
                            $id_recorrido = $resultArray['id_recorrido'];
                            $fecha_inicio = $resultArray['fecha_inicio'];

                            $query = "SELECT p.id_paquete, p.destino, p.estado, p.fecha_recibo, p.fecha_entrega
                            FROM paquete p
                            JOIN paquete_recorrido pr ON p.id_paquete = pr.id_paquete
                            WHERE pr.id_recorrido = $id_recorrido AND p.estado <> 'entregado';;
                            ";
                            $paqueteRecorrido = mysqli_query($conn, $query);

                            $newArray = [];
                            foreach ($paqueteRecorrido as $item) {
                                $destino = $item['destino'];
                                $id_paquete = $item['id_paquete'];

                                if (!array_key_exists($destino, $newArray)) {
                                    $newArray[$destino] = ['id_paquete' => [$id_paquete]];
                                } else {
                                    $newArray[$destino]['id_paquete'][] = $id_paquete;
                                }
                            }

                            foreach ($newArray as $destino => $values) {
                                echo '<tr>';
                                echo '<td>' . $destino . '</td>';
                                echo '<td>' . implode(', ', $values['id_paquete']) . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <?php
                            if (empty($fecha_inicio)) {
                                ?>
                                <a href=""><button type="button" class="btn btn-secondary" disabled>Entregar
                                        paquete</button></a>
                                <a href="../CONTROLADOR/iniciarEntrega.php?id_entrega=<?php echo $id_recorrido ?>"><button
                                        type="button" class="btn btn-secondary">Comenzar entregas</button></a>
                                <?php
                            } else {
                                if (mysqli_num_rows($paqueteRecorrido) == 0) {
                                    ?>
                                    <a href=""><button type="button" class="btn btn-secondary" disabled>Entregar
                                            paquete</button></a>
                                    <a href="../CONTROLADOR/finalizarEntrega.php?id_entrega=<?php echo $id_recorrido ?>"><button
                                            type="button" class="btn btn-secondary">Finalizar entrega</button></a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="../MODELO/entregarPaquete.php"><button type="button" class="btn btn-secondary">Entregar
                                            paquete</button></a>
                                    <a href=""><button type="button" class="btn btn-secondary" disabled>Finalizar
                                            entrega</button></a>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>

                        </div>
                    </div>


                    <?php
                } elseif (mysqli_num_rows($recorridosActivos) == 0) {
                    ?>
                    <p>No hay entregas asignadas</p>
                    <?php
                } else {
                    ?>
                    <p>error, demasiadas entregas asignadas</p>
                    <?php
                }
                ?>

            </div>
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