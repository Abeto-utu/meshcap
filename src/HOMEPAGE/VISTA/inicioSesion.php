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

        .navbar,
        .faq {
            padding: 10px 17.5%;
        }

        @media only screen and (max-width: 600px) {

            .faq,
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
            <a class="navbar-brand" href="index.php#inicio" data-i18n="quickCarry">Quick Carry</a>
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
                        <a class="nav-link" href="index.php#paquete" data-i18n="trackPackage">Rastrear Paquete</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#contacto" data-i18n="contact">Contacto</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <section id="inicio">
        <div class="container bg-dark text-white text-center py-5">
            <h1 class="display-4" data-i18n="loginTitle">Iniciar sesión</h1>
            <p class="text-white-50 mb-5" data-i18n="loginSubtitle">Por favor ingrese sus credenciales</p>
            <form action="../CONTROLADOR/recibirDatos.php" method="POST">
                <div class="form-row align-items-center">
                    <div class="col-auto" style="display: flex;align-items: center; justify-content: center;">
                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="typeEmailX" data-i18n="ide">N° Funcionario</label>
                            <input type="number" id="typeEmailX" class="form-control form-control-lg"
                                name="numero_funcionario" />
                        </div>
                    </div>
                    <div class="col-auto" style="display: flex;align-items: center; justify-content: center;">
                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="typePasswordX" data-i18n="pass">Contraseña</label>
                            <input type="password" id="typePasswordX" class="form-control form-control-lg" name="clave"
                                maxlength="16" minlength="6" />
                        </div>
                    </div>

                    <button class="btn btn-outline-light btn-lg px-5" type="submit" data-i18n="send">Ingresar</button>

                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                        <a href="https://facebook.com" class="text-white"><i
                                class="fab fa-facebook-f fa-lg m-3"></i></a>
                        <a href="https://twitter.com" class="text-white"><i class="fab fa-twitter fa-lg m-3"></i></a>
                        <a href="https://www.google.com/intl/es/gmail/about" class="text-white"><i
                                class="fab fa-google fa-lg m-3"></i></a>
                    </div>
                </div>
            </form>
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
                        <a type="button" class="btn btn-floating btn-warning btn-lg" href="https://facebook.com"><i
                                class="fab fa-facebook-f"></i></a>
                        <a type="button" class="btn btn-floating btn-warning btn-lg" href="https://twitter.com"><i
                                class="fab fa-twitter"></i></a>
                        <a type="button" class="btn btn-floating btn-warning btn-lg"
                            href="https://www.google.com/intl/es/gmail/about"><i class="fab fa-google-plus-g"></i></a>
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
                            <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2"
                                data-i18n="homeAddress">Montevideo, Av.Gral Rivera, 11600, UY</span>
                        </li>
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2"
                                data-i18n="emailAddress">Abeto@gmail.com</span>
                        </li>
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2"
                                data-i18n="phoneNumber">+594 092 951 240</span>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 data-i18n="contactUs">CONTACTANOS</h5>
                    <form action="send_email.php" method="post">
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

        <div class="text-center p-3 bg-dark" data-i18n="rightsReserved">© 2023
            Derechos de autor
        </div>
    </footer>

    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-8C+nLr+VwS9+IF3TTDLZomF6uIQvofBDG3Ct7xn1fX2KU9ltHbqIYoRuHQZa4u9p"
        crossorigin="anonymous"></script>

    <script>
        var textStrings = {
            es: {
                loginTitle: "Iniciar sesión",
                loginSubtitle: "Por favor ingrese sus credenciales",
                aboutCompany: "Acerca de la empresa",
                logisticsFocus: "Somos una empresa enfocada en el ámbito de la logística y nos comprometemos a brindar el mejor servicio posible.",
                customerSatisfaction: "La conformidad de nuestros clientes a la hora de finalizar un recorrido es lo que nos caracteriza.",
                contact: "Contacto",
                ide: "Identificador",
                email: "Correo",
                message: "Mensaje",
                send: "Enviar",
                changeLanguage: "Change language",
                trackPackage: "Rastrear Paquete",
                quickCarry: "Quick Carry",
                contactUs: "Contáctanos",
                facebook: "https://facebook.com",
                twitter: "https://twitter.com",
                google: "https://www.google.com/intl/es/gmail/about",
                homeAddress: "Montevideo, Av.Gral Rivera, 11600, UY",
                emailAddress: "Abeto@gmail.com",
                phoneNumber: "+594 092 951 240",
                rightsReserved: "© 2023 Derechos de autor",
                pass: "Contraseña"
            },
            en: {
                loginTitle: "Login",
                loginSubtitle: "Please enter your credentials",
                aboutCompany: "About the company",
                logisticsFocus: "We are a company focused on the field of logistics and committed to providing the best possible service.",
                customerSatisfaction: "Customer satisfaction at the end of a journey is what characterizes us.",
                contact: "Contact",
                ide: "Identifier",
                email: "Email",
                message: "Message",
                send: "Send",
                changeLanguage: "Cambiar idioma",
                trackPackage: "Track Package",
                quickCarry: "Quick Carry",
                contactUs: "Contact Us",
                facebook: "https://facebook.com",
                twitter: "https://twitter.com",
                google: "https://www.google.com/intl/es/gmail/about",
                homeAddress: "Montevideo, Av.Gral Rivera, 11600, UY",
                emailAddress: "Abeto@gmail.com",
                phoneNumber: "+594 092 951 240",
                rightsReserved: "© 2023 All rights reserved",
                pass: "Password"
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
</body>

</html>