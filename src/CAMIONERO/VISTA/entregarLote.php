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
<html lang="en" data-i18n="[html]lang">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="title">Entregar lote</title>
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
                    <h5 class="offcanvas-title text-center" id="offcanvasDarkNavbarLabel" data-i18n="offcanvasTitle">Menu del Backoffice</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../VISTA/rutasCamionero.php" data-i18n="navHome">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../VISTA/perfilCamionero.php" data-i18n="navProfile">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../VISTA/rutasCamionero.php" data-i18n="navRoutes">Rutas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../../HOMEPAGE/VISTA/index.html" data-i18n="navLogout">Log out</a>
                        </li>
                        <li>
                            <p class="nav-link" aria-current="page" onclick="changeLanguage()" data-i18n="changeLanguage">Change language</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mb-3" data-i18n="deliverBatch">Entregar lote</h1>
                <form action="../CONTROLADOR/controladorCamionero.php?entregarLote=entregarLote" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label" data-i18n="identifier">Identificador:</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="lote">
                    </div>
                    <div class="container mt-3"><button type="submit" class="btn btn-secondary" data-i18n="deliver">Entregar</button></a></div>
                </form>

                <div class="mb-5"></div>

                <h1 class="mb-4" data-i18n="batchesToDeliver">Lotes para entregar</h1>
                <table class="table centered-table">
                    <thead>
                        <tr>
                            <th scope="col" data-i18n="identifier">Identificador</th>
                            <th scope="col" data-i18n="destination">Destino</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $matricula = $camionero["matricula"];
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script>
    <script>
        function changeLanguage() {
            const htmlTag = document.querySelector('html');
            const currentLang = htmlTag.getAttribute('lang');
            const newLang = currentLang === 'en' ? 'es' : 'en';
            htmlTag.setAttribute('lang', newLang);

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
                'title': 'Entregar lote',
                'offcanvasTitle': 'Menu del Backoffice',
                'navHome': 'Inicio',
                'navProfile': 'Perfil',
                'navRoutes': 'Rutas',
                'navLogout': 'Log out',
                'changeLanguage': 'Change language',
                'deliverBatch': 'Deliver batch',
                'identifier': 'Identifier:',
                'deliver': 'Deliver',
                'batchesToDeliver': 'Batches to deliver',
                'destination': 'Destination'
            },
            'es': {
                'lang': 'en',
                'title': 'Deliver batch',
                'offcanvasTitle': 'Backoffice Menu',
                'navHome': 'Home',
                'navProfile': 'Profile',
                'navRoutes': 'Routes',
                'navLogout': 'Cerrar sesión',
                'changeLanguage': 'Cambiar idioma',
                'deliverBatch': 'Entregar lote',
                'identifier': 'Identificador:',
                'deliver': 'Entregar',
                'batchesToDeliver': 'Lotes para entregar',
                'destination': 'Destino'
            }
        };

        document.addEventListener('DOMContentLoaded', function () {
            updateText('es'); // Change to 'en' if the default language is English
        });
    </script>
</body>

</html>
