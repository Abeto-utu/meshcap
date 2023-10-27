<?php
require('../../db.php');
require_once('../CONTROLADOR/controladorCamionero.php');
session_start();

if (isset($_SESSION['username'])) {
    ($camionero = $camioneroModel->infoCamionero($_SESSION['username']));
} else {
    header("Location: ../../HOMEPAGE/VISTA/index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir lote</title>
    <link rel="stylesheet" href="../CSS/stylesCrudPaquetes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../IMAGES/gorraBlanca.png" type="image/x-icon">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark p-4 ">
        <div class="container-fluid">
            <a class="navbar-brand" href="../VISTA/rutasCamionero.php" id="logo"><img src="../../IMAGES/gorraBlanca.png"
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
                            <a class="nav-link" aria-current="page" href="../VISTA/rutasCamionero.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../VISTA/perfilCamionero.php">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../VISTA/rutasCamionero.php">Rutas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../../HOMEPAGE/VISTA/index.php">Log out</a>
                        </li>
                        <li>
                            <p class="nav-link" aria-current="page" onclick="changeLanguage()"
                                data-i18n="changeLanguage">Change language</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mb-3">Subir lote</h1>
                <form
                    action="../CONTROLADOR/controladorCamionero.php?subirLote=subirLote&matricula=<?php echo $camionero["matricula"] ?>"
                    method="POST">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Identificador:</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="lote">
                    </div>
                    <?php
                    if (isset($_GET['error'])) {
                        $error = $_GET['error'];
                        if ($error == 'lne') {
                            echo '<p>Ese lote ya esta subido</p>';
                        } elseif ($error == 'lec') {
                            echo '<p>Ese lote ya esta en un camion</p>';
                        } elseif ($error == 'le') {
                            echo '<p>Ese lote ya esta entregado</p>';
                        } elseif ($error == 'la') {
                            echo '<p>Ese lote aun esta abierto. </p>';
                        }
                    }
                    ?>
                    <div class="container mt-3"><button type="submit" class="btn btn-secondary">Subir</button></a></div>
                </form>

                <div class="mb-5"></div>

                <h1 class="mb-4">Lotes sin camion</h1>
                <table class="table centered-table">
                    <thead>
                        <tr>
                            <th scope="col">Identificador</th>
                            <th scope="col">Destino</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        ($lotesSinCamion = $camioneroModel->lotesSinCamion());

                        foreach ($lotesSinCamion as $lote) { ?>
                            <tr class="align-middle">
                                <td>
                                    <?php echo $lote['id_lote'] ?>
                                </td>
                                <td>
                                    <?php echo $lote['nombre'] ?>
                                </td>
                                <td>
                                    <?php echo $lote['estado'] ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


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