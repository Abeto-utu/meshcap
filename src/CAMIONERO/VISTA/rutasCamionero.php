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
<html lang="es">

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
                    <h5 class="offcanvas-title text-center" id="offcanvasDarkNavbarLabel" data-i18n="menuTitle">Menú del
                        Backoffice</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="rutasCamionero.php"
                                data-i18n="home">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../VISTA/perfilCamionero.php"
                                data-i18n="profile">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../VISTA/rutasCamionero.php"
                                data-i18n="routes">Rutas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../../HOMEPAGE/VISTA/index.php"
                                data-i18n="logout">Cerrar sesión</a>
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

    <div class="container">
        <div class="container mt-5">
        </div>
        <div class="row">
            <div class="col-md-4">
                <h1 class="mb-4" data-i18n="trunkRoutes">Troncales</h1>
                <div class="container mt-5">
                    <a class="btn btn-secondary" href="troncales.php" role="button" data-i18n="trunkRoutes">Rutas
                        troncales</a>
                </div>
                <div class="container mt-5">
                </div>
            </div>
            <div class="col-md-4">
                <h1 class="mb-4" data-i18n="deliveries">Entregas</h1>
                <div class="container mt-5">
                    <a class="btn btn-secondary" href="entrega.php" role="button" data-i18n="deliveries">Entregas</a>
                    <div class="container mt-5">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h1 class="mb-4" data-i18n="collection">Recolección</h1>
                <table class="table centered-table">
                    <thead>
                        <tr>
                            <th scope="col" data-i18n="client">Cliente</th>
                            <th scope="col" data-i18n="status">Estado</th>
                            <th scope="col" data-i18n="date">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        ($recolecciones = $camioneroModel->infoRecolecciones($camionero["matricula"]));
                        foreach ($recolecciones as $recoleccion) { ?>
                            <tr class="align-middle">
                                <td>
                                    <a
                                        href="../VISTA/verRecoleccion.php?id_recoleccion=<?php echo $recoleccion['id_recoleccion']; ?>">
                                        <?php echo $recoleccion['nombre']; ?>
                                    </a>
                                </td>
                                <td>
                                    <?php
                                    if (empty($recoleccion['fecha_ida'])) {
                                        echo "sin empezar";
                                    } elseif (empty($recoleccion['fecha_llegada'])) {
                                        echo "en proceso";
                                    } else {
                                        echo "finalizado";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (empty($recoleccion['fecha_ida'])) {
                                        echo "-";
                                    } else {
                                        $day = date('d', strtotime($recoleccion['fecha_ida'])); // Day
                                        $month = date('m', strtotime($recoleccion['fecha_ida'])); // Month
                                        $year = date('Y', strtotime($recoleccion['fecha_ida'])); // Year
                                
                                        echo "$day/$month/$year";
                                    }
                                    ?>
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
    <script>
        var textStrings = {
            es: {
                menuTitle: "Rutas",
                home: "Inicio",
                profile: "Perfil",
                routes: "Rutas",
                logout: "Cerrar sesión",
                changeLanguage: "Change language",
                trunkRoutes: "Rutas troncales",
                deliveries: "Entregas",
                collection: "Recolección",
                client: "Cliente",
                status: "Estado",
                date: "Fecha",
                notStarted: "sin empezar",
                inProcess: "en proceso",
                finished: "finalizado"
            },
            en: {
                menuTitle: "Routes",
                home: "Home",
                profile: "Profile",
                routes: "Routes",
                logout: "Log out",
                changeLanguage: "Cambiar idioma",
                trunkRoutes: "Trunk Routes",
                deliveries: "Deliveries",
                collection: "Collection",
                client: "Client",
                status: "Status",
                date: "Date",
                notStarted: "not started",
                inProcess: "in process",
                finished: "finished"
            }
        };

        function changeLanguage() {
            var htmlTag = document.getElementsByTagName('html')[0];
            var language = htmlTag.getAttribute('lang');
            if (language === 'en') {
                htmlTag.setAttribute('lang', 'es');
                updateText('es');
            } else {
                htmlTag.setAttribute('lang', 'en');
                updateText('en');
            }
        }

        function updateText(language) {
            var elements = document.querySelectorAll('[data-i18n]');
            elements.forEach(function (element) {
                var key = element.getAttribute('data-i18n');
                if (textStrings[language][key]) {
                    element.innerText = textStrings[language][key];
                }
            });
        }

        // Initialize the text with the default language
        document.addEventListener('DOMContentLoaded', function () {
            updateText('es'); // Change to 'en' if the default language is English
        });
    </script>
</body>

</html>