<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio Sesion</title>
  <link rel="stylesheet" href="../../CSS/StylesInicioSesion.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="shortcut icon" href="../../IMAGES/gorraBlanca.png" type="image/x-icon">
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg bg-dark fixed-top">
      <div class="container-fluid">
        <div class="navbar-brand">
          <a href="../VISTA/index.html"><img src="../../IMAGES/logo.png" alt="Logo QuickCarry" id="logo"></a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ml-auto"> <!-- Utiliza ml-auto aquí para mover los elementos a la derecha -->
            <li class="nav-item">
              <a class="nav-link active text-light" aria-current="page" href="../VISTA/index.html">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="../VISTA/inicioSesion.php">MeshCap</a>
            </li>
            <li class="nav-item dropdown text-light">
              <a class="nav-link dropdown-toggle text-light" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Nuestra Empresa
              </a>
              <ul class="dropdown-menu ">
                <li><a class="dropdown-item" href="../VISTA/rastrearPaquete.php">Rastrear Paquete</a></li>
                <li><a class="dropdown-item" href="../VISTA/preguntasFrecuentes.html">Preguntas Frecuentes</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <div class="container_total">
    <form action="../CONTROLADOR/recibirDatos.php" method="POST">
      <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                  <div class="mb-md-5 mt-md-4 pb-5">

                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                    <p class="text-white-50 mb-5">Porfavor ingrese los datos para ingresar</p>

                    <div class="form-outline form-white mb-4">
                      <label class="form-label" for="typeEmailX">N° Funcionario</label>
                      <input type="number" id="typeEmailX" class="form-control form-control-lg"
                        name="numero_funcionario" />
                    </div>

                    <div class="form-outline form-white mb-4">
                      <label class="form-label" for="typePasswordX">Contraseña</label>
                      <input type="password" id="typePasswordX" class="form-control form-control-lg" name="clave"
                        maxlength="16" minlength="6" />
                    </div>

                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                      <a href="https://facebook.com" class="text-white"><i class="fab fa-facebook-f fa-lg m-3"></i></a>
                      <a href="https://twitter.com" class="text-white"><i class="fab fa-twitter fa-lg m-3"></i></a>
                      <a href="https://www.google.com/intl/es/gmail/about" class="text-white"><i
                          class="fab fa-google fa-lg m-3"></i></a>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container_error">
          <?php if (isset($_SESSION['error'])) { ?>

            <p>
              <?php echo $_SESSION['error']; ?>
            </p>

            <?php session_unset();
          } ?>
      </section>
    </form>
  </div>
  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
    integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>