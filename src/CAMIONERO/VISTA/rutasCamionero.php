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
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
        aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
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

  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h1 class="mb-4">Recoleccion</h1>
        <table class="table centered-table">
          <thead>
            <tr>
              <th scope="col">Cliente</th>
              <th scope="col">Estado</th>
              <th scope="col">Fecha</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT r.id_recoleccion, r.fecha_llegada, r.fecha_ida, cr.id_cliente, c.nombre, rv.matricula
            FROM recoleccion r
            JOIN cliente_recoleccion cr ON r.id_recoleccion = cr.id_recoleccion
            JOIN cliente c ON cr.id_cliente = c.id_cliente
            JOIN recoleccion_vehiculo rv ON r.id_recoleccion = rv.id_recoleccion
            WHERE rv.matricula = '$matricula';
            
            ";
            $recolecciones = mysqli_query($conn, $query);

            while ($fila = mysqli_fetch_array($recolecciones)) { ?>
              <tr class="align-middle">
                <td>
                  <a href="../VISTA/verRecoleccion.php?id_recoleccion=<?php echo $fila['id_recoleccion']; ?>">
                    <?php echo $fila['nombre'] ?>
                  </a>
                </td>
                <td>
                  <?php
                  if (empty($fila['fecha_ida'])) {
                    echo "sin empezar";
                  } elseif (empty($fila['fecha_llegada'])) {
                    echo "en proceso";
                  } else {
                    echo "finalizado";
                  } ?>
                </td>
                <td>
                  <?php
                  if (empty($fila['fecha_ida'])) {
                    echo "-";
                  } else {
                    $day = date('d', strtotime($fila['fecha_ida'])); // Day
                    $month = date('m', strtotime($fila['fecha_ida'])); // Month
                    $year = date('Y', strtotime($fila['fecha_ida'])); // Year
                
                    echo "$day/$month/$year";
                  }
                  ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <h1 class="mb-4">Troncales</h1>
        <div class="container mt-5">
          <a class="btn btn-secondary" href="troncales.php" role="button">Rutas troncales</a>
        </div>
      </div>
      <div class="col-md-4">
        <h1 class="mb-4">Entregas</h1>
        <div class="container mt-5">
          <a class="btn btn-secondary" href="entrega.php" role="button">Entregas</a>
        </div>
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