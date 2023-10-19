<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Carry</title>
    <link rel="stylesheet" href="../../CSS/stlyesRastreoPaquete.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <div class="navbar-brand">
                <a href="../VISTA/index.html"><img src="../../IMAGES/logo.png" alt="Logo QuickCarry" id="logo"></a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse m-2" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto"> <!-- Utiliza ml-auto aquí para mover los elementos a la derecha -->
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="../VISTA/index.html">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../VISTA/inicioSesion.php">MeshCap</a>
                    </li>
                    <li class="nav-item dropdown text-light">
                        <a class="nav-link dropdown-toggle text-light" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
      <div>
        <h1>Rastreo Paquete</h1>
      </div>
      <form action="../CONTROLADOR/consultaEstadoPaquete.php" method="POST">

          <label for="numero_paquete">N° Paquete
            <input type="number" name="numero_paquete" id="numero_paquete" placeholder="Numero del paquete..." required>
          </label>
        
          <input type="submit" value="Rastrear" name="rastreo">
      </form>
      <hr>
      <?php
        session_start();

        if(isset($_SESSION['resultado_paquete'])) {
            $resultado_paquete = $_SESSION['resultado_paquete'];?> 
            <p class="p-2"> <?php echo "Numero del Paquete: " . $resultado_paquete['id_paquete']?></p>
            <p class="p-2"> <?php echo "Estado del Paquete: " . $resultado_paquete['estado']?></p>
            <p class="p-2"> <?php echo "Hora Estimada: " . $resultado_paquete['estado']?></p>
            
      <?php unset($_SESSION['resultado_paquete']);

        } else {
          ?><p class ="error p-2"> <?php echo "No se encontraron resultados para el número de paquete proporcionado.";?></p>
      <?php } ?>
    </div>
    <hr class="m-5 w-70">
    <footer class="text-white text-center text-lg-start" style="background-color: #23242a;">
  <!-- Grid container -->
  <div class="container p-4">
    <!--Grid row-->
    <div class="row mt-4">
      <!--Grid column-->
      <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4">Acerca de la empresa</h5>

          <p>
            Somos una emrpesa enfocada en el ambito de la logistica y nos comprometemos a brindar el mejor servicio posible.
          </p>

          <p>
            La conformidad de nuestros clientes a la hora de finalizar un recorrido es lo que nos caracteriza.
          </p>

        <div class="mt-4">
          <!-- Facebook -->
          <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-facebook-f"></i></a>
          <!-- Twitter -->
          <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-twitter"></i></a>
          <!-- Google + -->
          <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-google-plus-g"></i></a>
          <!-- Linkedin -->
        </div>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-6 mb-4 mb-md-0">

        <div class="form-outline form-white mb-4">
          <h5 class="form-label" for="formControlLg" style="margin-left: 0px;">CONTACTO</h5>
        <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 48.8px;"></div><div class="form-notch-trailing"></div></div></div>

        <ul class="fa-ul" style="margin-left: 1.65em;">
          <li class="mb-3">
            <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2">Montevideo,Av.Gral Rivera, 11600, UY</span>
          </li>
          <li class="mb-3">
            <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2">Abeto@gmail.com</span>
          </li>
          <li class="mb-3">
            <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2">+594 092 951 240</span>
          </li>
        </ul>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4">Horarios de atencion</h5>
          
        <table class="table text-center text-white">
          <tbody class="font-weight-normal">
            <tr>
              <td>Lun - Jue:</td>
              <td>8am - 22pm</td>
            </tr>
            <tr>
              <td>Vie - Sab:</td>
              <td>8am - 19am</td>
            </tr>
            <tr>
              <td>Dom:</td>
              <td>9am - 15pm</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2023 Copyright:
    <a class="text-white" href="../VISTA/index.html">QuickCarry.com</a>
  </div>
  <!-- Copyright -->
</footer>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>