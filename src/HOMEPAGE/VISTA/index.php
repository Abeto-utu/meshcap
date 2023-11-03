<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Carry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../IMAGES/gorraBlanca.png" type="image/x-icon">
    <style>
        html {
            scroll-behavior: smooth;
        }

        .navbar {
            padding: 10px 17.5%;
        }

        @media only screen and (max-width: 600px) {
            .navbar {
                padding: 10px 3%;
            }
        }

        section {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        footer {
            margin-top: auto;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-dark">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#inicio" data-i18n="quickCarry">Quick Carry</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="inicioSesion.php" data-i18n="meshCap">MeshCap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="changeLanguage()" data-i18n="changeLanguage">Change
                            language</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#paquete" data-i18n="trackPackage">Rastrear Paquete</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto" data-i18n="contact">Contacto</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <section id="inicio" style="background-color: rgba(0, 0, 0, 0.2);">
        <div class="container text-white text-center py-5">
            <h1 class="display-4" data-i18n="quickCarry">Quick Carry</h1>
            <h2 data-i18n="reliableLogistics">La empresa de logística más confiable del Uruguay</h2>
            <div class="mt-4">
                <a href="#paquete" class="btn btn-warning btn-lg" data-i18n="trackPackage">Rastrear paquete</a>
            </div>
        </div>
    </section>
    <section id="paquete">
        <div class="container bg-dark text-white text-center py-5">
            <h2 class="display-4" data-i18n="trackPackage">Rastrear paquete</h2>
            <form action="../CONTROLADOR/consultaEstadoPaquete.php" method="POST">
                <div class="form-row align-items-center">
                    <div class="col-auto" style="display: flex;align-items: center; justify-content: center;">
                        <label for="numberInput" class="sr-only" data-i18n="enterIdentifier">Ingrese el
                            identificador:</label>
                        <input class="form-control mb-2" id="numberInput" name="numero_paquete"
                            placeholder="Ingrese el identificador" name="numberInput" style="max-width: 300px;">
                    </div>
                    <div class="col-auto">
                        <button type="submit" value="Rastrear" name="rastreo" class="btn btn-warning mb-2"
                            data-i18n="track">Rastrear</button>
                    </div>
                </div>
            </form>
            <hr>
            <?php
            if (isset($_SESSION['resultado_paquete'])) {
                $resultado_paquete = $_SESSION['resultado_paquete'];

                if (isset($resultado_paquete['nombre'])) {
                    ?> 
                    <p class="p-2">
                    <?php echo "Identificador: " . $resultado_paquete['id_paquete'] ?>
                </p>
                <p class="p-2">
                    <?php echo "Estado del Paquete: " . $resultado_paquete['estado'] ?>
                </p>
                <p class="p-2">
                    <?php echo "Lote: " . $resultado_paquete['id_lote'] ?>
                </p>
                <p class="p-2">
                    <?php echo "Camion: " . $resultado_paquete['matricula'] ?>
                </p>
                <p class="p-2">
                    <?php echo "Camionero: " . $resultado_paquete['nombre'] ?>
                </p>
                    <?php
                } else {
                    ?> 
                    <p class="p-2">
                    <?php echo "Identificador: " . $resultado_paquete['id_paquete'] ?>
                </p>
                <p class="p-2">
                    <?php echo "Destino: " . $resultado_paquete['estado'] ?>
                </p>
                <p class="p-2">
                    <?php echo "Estado: " . $resultado_paquete['id_lote'] ?>
                </p>
                <p class="p-2">
                    <?php echo "Recibo: " . $resultado_paquete['matricula'] ?>
                </p>
                    <?php
                }
                ?>
                

                <?php unset($_SESSION['resultado_paquete']);

            } else {
                echo "<p class='error p-2' data-i18n='ayuda1'>Donde veo el identificador de paquete?</p>
            <p class='error p-2' data-i18n='ayuda2'>Los identificadores suelen encontrarse en la esquina inferior de las etiquetas de cada paquete</p>";
            } ?>

        </div>
    </section>

    <footer id="contacto" class="text-white text-center text-lg-start" style="background-color: rgba(0, 0, 0, 0.2);">
        <div class="container p-4">
            <div class="row mt-4">
                <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4" data-i18n="aboutCompany">Acerca de la empresa</h5>
                    <p data-i18n="logisticsFocus">Somos una empresa enfocada en el ámbito de la logística y nos
                        comprometemos a brindar el mejor servicio posible.</p>
                    <p data-i18n="customerSatisfaction">La conformidad de nuestros clientes a la hora de finalizar un
                        recorrido es lo que nos caracteriza.</p>
                    <div class="mt-4">
                        <a type="button" class="btn btn-floating btn-warning btn-lg"><i
                                class="fab fa-facebook-f"></i></a>
                        <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-twitter"></i></a>
                        <a type="button" class="btn btn-floating btn-warning btn-lg"><i
                                class="fab fa-google-plus-g"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <div class="form-outline form-white mb-4">
                        <h5 class="form-label" for="formControlLg" style="margin-left: 0px;" data-i18n="contact">
                            CONTACTO</h5>
                        <div class="form-notch">
                            <div class="form-notch-leading" style="width: 9px;"></div>
                            <div class="form-notch-middle" style="width: 48.8px;"></div>
                            <div class="form-notch-trailing"></div>
                        </div>
                    </div>
                    <ul class="fa-ul" style="margin-left: 1.65em;">
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2">Montevideo, Av.Gral
                                Rivera, 11600, UY</span>
                        </li>
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-envelope"></i></span><span
                                class="ms-2">Abeto@gmail.com</span>
                        </li>
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2">+594 092 951
                                240</span>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 data-i18n="contactUs">CONTACTANOS</h5>
                    <form action="../CONTROLADOR/send_email.php" method="post">
                        <div class="form-group">
                            <label for="name" data-i18n="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email" data-i18n="email">Correo</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="message" data-i18n="message">Mensaje</label>
                            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-warning" data-i18n="send">Enviar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="text-center p-3 bg-dark" data-i18n="copyright">© 2023 Derechos
            de autor
        </div>
    </footer>

    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-8C+nLr+VwS9+IF3TTDLZomF6uIQvofBDG3Ct7xn1fX2KU9ltHbqIYoRuHQZa4u9p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-rhcZF4Hl1mMj5FnPbX4R2R++fchYV7YB80eYnU8n4cVYx9NLsw8l5+/NEA1Jlw7d"
        crossorigin="anonymous"></script>

    <script>
        var textStrings = {
            es: {
                quickCarry: "Quick Carry",
                reliableLogistics: "La empresa de logística más confiable del Uruguay",
                meshCap: "MeshCap",
                changeLanguage: "Change language",
                trackPackage: "Rastrear Paquete",
                contact: "Contacto",
                enterIdentifier: "Ingrese el identificador:",
                aboutCompany: "Acerca de la empresa",
                logisticsFocus: "Somos una empresa enfocada en el ámbito de la logística y nos comprometemos a brindar el mejor servicio posible.",
                customerSatisfaction: "La conformidad de nuestros clientes a la hora de finalizar un recorrido es lo que nos caracteriza.",
                contactUs: "CONTÁCTANOS",
                name: "Nombre",
                email: "Correo",
                message: "Mensaje",
                send: "Enviar",
                ayuda1: "Donde veo el identificador de paquete?",
                ayuda2: "Los identificadores suelen encontrarse en la esquina inferior de las etiquetas de cada paquete",
                copyright: "© Derechos de autor QuickCarry.com"
            },
            en: {
                quickCarry: "Quick Carry",
                reliableLogistics: "Uruguay's most reliable logistics company",
                meshCap: "MeshCap",
                changeLanguage: "Cambiar idioma",
                trackPackage: "Track Package",
                contact: "Contact",
                enterIdentifier: "Enter Identifier:",
                aboutCompany: "About the company",
                logisticsFocus: "We are a company focused on the logistics sector and we are committed to providing the best possible service.",
                customerSatisfaction: "Customer satisfaction at the end of a journey is what characterizes us.",
                contactUs: "CONTACT US",
                name: "Name",
                email: "Email",
                message: "Message",
                send: "Send",
                ayuda1: "Where is the package identifier?",
                ayuda2: "The id's often are in the bottom left corner of the package's sticker",
                copyright: "© Copyright QuickCarry.com"
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

        document.addEventListener('DOMContentLoaded', function () {
            updateText('es');
        });

        document.addEventListener("DOMContentLoaded", function () {
            var toggler = document.querySelector(".navbar-toggler");
            var navbarMenu = document.querySelector(".navbar-collapse");

            toggler.addEventListener("click", function () {
                navbarMenu.classList.toggle("show");
            });
        });
    </script>
    <script>
        <?php
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            echo "var status = '" . $status . "';";
        } else {
            echo "var status = '';";
        }
        ?>

        if (status !== '') {
            alert(status);
        }
    </script>
</body>

</html>