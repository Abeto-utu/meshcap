<?php
require('../../db.php');
session_start();

if (isset($_SESSION['username'])) {
    $id_usuario = $_SESSION['username'];
} else {
    header("Location: ../VISTA/inicioSesion.php");
    exit();
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
    $estado = $fila['estado'];
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
            <div class="col-md-12">
                <h1 class="mb-4">Recorrido </h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Plataformas</th>
                            <th scope="col">Lote/s</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT l.*, p.*
                        FROM vehiculo_plataforma_lote vpl
                        JOIN vehiculo v ON vpl.matricula = v.matricula
                        JOIN plataforma_lote pl ON vpl.id_lote = pl.id_lote
                        JOIN lote l ON vpl.id_lote = l.id_lote
                        JOIN plataforma p ON pl.id_plataforma = p.id_plataforma
                        WHERE vpl.id_lote IN (
                            SELECT id_lote
                            FROM plataforma_lote
                            WHERE fecha_llegada IS NULL
                        ) 
                        AND l.estado = 'en camion'
                        AND vpl.matricula = '$matricula';
                        ";
                        $paquetes = mysqli_query($conn, $query);

                        if ($paquetes) {
                            $resultArray = [];

                            while ($fila = mysqli_fetch_array($paquetes)) {
                                $plataforma = $fila['nombre'];
                                $lote = $fila['id_lote'];

                                if (!array_key_exists($plataforma, $resultArray)) {
                                    $resultArray[$plataforma] = [];
                                }
                                $resultArray[$plataforma][] = $lote;
                            }

                            foreach ($resultArray as $plataforma => $lotes) {
                                ?>
                                <td>
                                    <?php echo $plataforma ?>
                                </td>
                                <td>
                                    <?php echo implode(", ", $lotes); ?>
                                </td>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <?php
                if ($estado == 'trabajando') {
                    if (mysqli_num_rows($paquetes) == 0) {
                        ?>
                        <a href="../MODELO/entregarLote.php"><button type="button" class="btn btn-secondary">Entregar
                                lote</button></a>
                        <a href="../CONTROLADOR/finalizarTroncal.php?a=finalizar"><button type="button"
                                class="btn btn-primary">Finalizar recorrido</button></a>
                        <?php
                    } else {
                        ?>
                        <a href="../MODELO/entregarLote.php"><button type="button" class="btn btn-secondary">Entregar
                                lote</button></a>
                        <a href=""><button type="button" class="btn btn-primary" disabled>Finalizar recorrido</button></a>
                        <?php
                    }
                } ?>


                <?php
                if ($estado == 'disponible') { ?>
                    <a href="../MODELO/subirLote.php"><button type="button" class="btn btn-secondary">Subir
                            lote</button></a>

                    <?php
                    if (mysqli_num_rows($paquetes) == 0) {
                        ?>
                        <a href=""><button type="button" class="btn btn-primary" disabled>Marcar salida</button></a>
                        <?php
                    } else {
                        ?>
                        <a href="../CONTROLADOR/iniciarTroncal.php?a=<?php echo 'iniciar' ?>"><button type="button"
                                class="btn btn-primary">Marcar salida</button></a>
                        <?php
                    }
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