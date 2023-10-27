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
<html lang="es" id="htmlTag">

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
                    <h5 class="offcanvas-title text-center" id="offcanvasDarkNavbarLabel" data-i18n="menuTitle">Menu del
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
                            <a class="nav-link" aria-current="page" href="../../HOMEPAGE/VISTA/index.html"
                                data-i18n="logout">Cerrar sesión</a>
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
            <div class="col-md-12">
                <h1 class="mb-4" data-i18n="packagesToDeliver">Paquetes a entregar</h1>
                <?php
                ($recorridosActivos = $camioneroModel->recorridosActivos($camionero["id_usuario"]));
                if (count($recorridosActivos) == 1) {
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" data-i18n="address">Domicilio</th>
                                <th scope="col" data-i18n="packages">Paquete/s</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id_recorrido = $recorridosActivos[0]['id_recorrido'];
                            $fecha_inicio = $recorridosActivos[0]['fecha_inicio'];

                            ($paqueteRecorrido = $camioneroModel->paquetesEnRecorrido($id_recorrido));
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
                                <a href=""><button type="button" class="btn btn-secondary" disabled
                                        data-i18n="deliverPackage">Entregar
                                        paquete</button></a>
                                <a
                                    href="../CONTROLADOR/controladorCamionero.php?iniciarEntrega=iniciarEntrega&id_recorrido=<?php echo $id_recorrido ?>&matricula=<?php echo $camionero['matricula'] ?>&id_usuario=<?php echo $camionero['id_usuario'] ?>"><button
                                        type="button" class="btn btn-secondary" data-i18n="startDeliveries">Comenzar
                                        entregas</button></a>
                                <?php
                            } else {
                                if (count($paqueteRecorrido) == 0) {
                                    ?>
                                    <a href=""><button type="button" class="btn btn-secondary" disabled
                                            data-i18n="deliverPackage">Entregar
                                            paquete</button></a>
                                    <a
                                        href="../CONTROLADOR/controladorCamionero.php?finalizarEntrega=finalizarEntrega&id_recorrido=<?php echo $id_recorrido ?>&matricula=<?php echo $camionero['matricula'] ?>&id_usuario=<?php echo $camionero['id_usuario'] ?>"><button
                                            type="button" class="btn btn-secondary" data-i18n="finishDelivery">Finalizar
                                            entrega</button></a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="../VISTA/entregarPaquete.php"><button type="button" class="btn btn-secondary"
                                            data-i18n="deliverPackage">Entregar
                                            paquete</button></a>
                                    <a href=""><button type="button" class="btn btn-secondary" disabled
                                            data-i18n="finishDelivery">Finalizar
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
                } elseif (count($recorridosActivos) == 0) {
                    ?>
                    <p data-i18n="noAssignDeliveries">No hay entregas asignadas</p>
                    <?php
                } else {
                    ?>
                    <p data-i18n="errorTooManyDeliveries">Error, demasiadas entregas asignadas</p>
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
    <script>
        var textStrings = {
            es: {
                menuTitle: "Entregas",
                home: "Inicio",
                profile: "Perfil",
                routes: "Rutas",
                logout: "Cerrar sesión",
                changeLanguage: "Cambiar idioma",
                packagesToDeliver: "Paquetes a entregar",
                address: "Domicilio",
                packages: "Paquete/s",
                deliverPackage: "Entregar paquete",
                startDeliveries: "Comenzar entregas",
                finishDelivery: "Finalizar entrega",
                noAssignDeliveries: "No hay entregas asignadas",
                errorTooManyDeliveries: "Error, demasiadas entregas asignadas"
            },
            en: {
                menuTitle: "Deliveries",
                home: "Home",
                profile: "Profile",
                routes: "Routes",
                logout: "Log out",
                changeLanguage: "Change language",
                packagesToDeliver: "Packages to deliver",
                address: "Address",
                packages: "Package/s",
                deliverPackage: "Deliver package",
                startDeliveries: "Start deliveries",
                finishDelivery: "Finish delivery",
                noAssignDeliveries: "No deliveries assigned",
                errorTooManyDeliveries: "Error, too many deliveries assigned"
            }
        };

        function changeLanguage() {
            var htmlTag = document.getElementById('htmlTag');
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
        document.addEventListener('DOMContentLoaded', function () {
            updateText('es');
        });
    </script>
</body>

</html>