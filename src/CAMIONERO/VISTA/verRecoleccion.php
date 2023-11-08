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

if (isset($_GET['id_recoleccion'])) {
    ($recolecciones = $camioneroModel->infoRecoleccion($_GET['id_recoleccion']));

    foreach ($recolecciones as $recoleccion) {
        $id_recoleccion = $recoleccion['id_recoleccion'];
        $fecha_llegada = $recoleccion['fecha_llegada'];
        $fecha_ida = $recoleccion['fecha_ida'];
        $matricula = $recoleccion['matricula'];
        $nombre_cliente = $recoleccion['nombre_cliente'];
        $id_cliente = $recoleccion['id_cliente'];
        if (empty($recoleccion['fecha_ida'])) {
            $estado = "sin empezar";
        } elseif (empty($recoleccion['fecha_llegada'])) {
            $estado = "en proceso";
        } else {
            $estado = "finalizado";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es" data-i18n="[html]lang">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="title">Rutas</title>
    <link rel="stylesheet" href="../CSS/stylesCrudPaquetes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../IMAGES/gorraBlanca.png" type="image/x-icon">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark p-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="rutasCamionero.php" id="logo"><img src="../../IMAGES/gorraBlanca.png"
                    height="40" alt="">MeshCap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-center" id="offcanvasDarkNavbarLabel" data-i18n="offcanvasTitle">
                        Menú del Backoffice</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../VISTA/rutasCamionero.php"
                                data-i18n="navHome">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="perfilCamionero.php"
                                data-i18n="navProfile">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../VISTA/rutasCamionero.php"
                                data-i18n="navRoutes">Rutas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../../HOMEPAGE/VISTA/index.php"
                                data-i18n="navLogout">Cerrar sesión</a>
                        </li>
                        <li>
                            <p class="nav-link" aria-current="page" onclick="changeLanguage()"
                                data-i18n="changeLanguage">Cambiar idioma</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "agregarPaquete") {
                        echo '<p class="text-danger">Error al agregar paquete</p>';
                    }
                    if ($_GET["error"] == "finalizarRecoleccion") {
                        echo '<p class="text-danger">Error al finalizar recoleccion</p>';
                    }
                    if ($_GET["error"] == "iniciarRecoleccion") {
                        echo '<p class="text-danger">Error al iniciar recoleccion</p>';
                    }
                } ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" data-i18n="collectionDetails">Detalles de Recolección</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th data-i18n="collectionID">ID Recolección</th>
                            <td>
                                <?php echo $id_recoleccion; ?>
                            </td>
                        </tr>
                        <tr>
                            <th data-i18n="name">Nombre</th>
                            <td>
                                <?php echo $nombre_cliente; ?>
                            </td>
                        </tr>
                        <tr>
                            <th data-i18n="status">Estado</th>
                            <td>
                                <?php echo $estado; ?>
                            </td>
                        </tr>
                        <tr>
                            <th data-i18n="plate">Matrícula</th>
                            <td>
                                <?php echo $matricula; ?>
                            </td>
                        </tr>
                        <tr>
                            <th data-i18n="arrivalDate">Fecha de Llegada</th>
                            <td>
                                <?php echo $fecha_llegada; ?>
                            </td>
                        </tr>
                        <tr>
                            <th data-i18n="departureDate">Fecha de Ida</th>
                            <td>
                                <?php echo $fecha_ida; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <?php if ($estado == 'sin empezar') { ?>
                <div class="text-center mt-3">
                    <a href="../CONTROLADOR/controladorCamionero.php?id_usuario=<?php echo $camionero['id_usuario'] ?>&matricula=<?php echo $camionero['matricula'] ?>&id_recoleccion=<?php echo $id_recoleccion ?>&iniciarRecoleccion=iniciarRecoleccion"
                        class="btn btn-primary" data-i18n="startCollection">Iniciar recolección</a>
                </div>
            <?php } ?>

            <?php if ($estado == 'en proceso') { ?>
                <div class="text-center mt-3">
                    <a href="../VISTA/agregarPaquete.php?id_recoleccion=<?php echo $id_recoleccion ?>&a=<?php echo 'agregar' ?>"
                        class="btn btn-primary" data-i18n="addPackage">Agregar paquete</a>
                </div>
                <div class="text-center mt-3">
                    <a href="../CONTROLADOR/controladorCamionero.php?id_usuario=<?php echo $camionero['id_usuario'] ?>&matricula=<?php echo $camionero['matricula'] ?>&id_recoleccion=<?php echo $id_recoleccion ?>&finalizarRecoleccion=finalizarRecoleccion"
                        class="btn btn-primary" data-i18n="finishCollection">Finalizar recolección</a>
                </div>
            <?php } ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script>
    <script>
        function changeLanguage() {
            // Code to change language
            const htmlTag = document.querySelector('html');
            const currentLang = htmlTag.getAttribute('lang');
            const newLang = currentLang === 'en' ? 'es' : 'en'; // Toggle between English and Spanish
            htmlTag.setAttribute('lang', newLang);

            // Translate the text
            const elementsToTranslate = document.querySelectorAll('[data-i18n]');
            elementsToTranslate.forEach(element => {
                const key = element.getAttribute('data-i18n');
                if (translations[newLang] && translations[newLang][key]) {
                    element.innerHTML = translations[newLang][key];
                }
            });
        }

        // Translation dictionary
        const translations = {
            'en': {
                'lang': 'es',
                'title': 'Rutas',
                'offcanvasTitle': 'Backoffice Menu',
                'navHome': 'Home',
                'navProfile': 'Profile',
                'navRoutes': 'Routes',
                'navLogout': 'Log out',
                'changeLanguage': 'Change language',
                'collectionDetails': 'Collection Details',
                'collectionID': 'Collection ID',
                'name': 'Name',
                'status': 'Status',
                'plate': 'Plate',
                'arrivalDate': 'Arrival Date',
                'departureDate': 'Departure Date',
                'startCollection': 'Start collection',
                'addPackage': 'Add package',
                'finishCollection': 'Finish collection'
            },
            'es': {
                'lang': 'en',
                'title': 'Routes',
                'offcanvasTitle': 'Menú del Backoffice',
                'navHome': 'Inicio',
                'navProfile': 'Perfil',
                'navRoutes': 'Rutas',
                'navLogout': 'Cerrar sesión',
                'changeLanguage': 'Cambiar idioma',
                'collectionDetails': 'Detalles de Recolección',
                'collectionID': 'ID Recolección',
                'name': 'Nombre',
                'status': 'Estado',
                'plate': 'Matrícula',
                'arrivalDate': 'Fecha de Llegada',
                'departureDate': 'Fecha de Ida',
                'startCollection': 'Iniciar recolección',
                'addPackage': 'Agregar paquete',
                'finishCollection': 'Finalizar recolección'
            }
        };

        document.addEventListener('DOMContentLoaded', function () {
            updateText('es'); // Change to 'en' if the default language is English
        });
    </script>
</body>

</html>