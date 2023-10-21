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
  <title>Camionero</title>
  <link rel="stylesheet" href="../../CSS/stylesCamionero.css">
  <link rel="shortcut icon" href="../../IMAGES/gorraBlanca.png" type="image/x-icon">
</head>

<body>
  <nav>
    <ul>
      <li>
        <a href="../VISTA/camionero.php" class="logo">
          <img src="../../IMAGES/gorraBlanca.png" alt="Logo Mesh Cap">
          <span class="nav-item">MeshCap</span>
        </a>
      </li>

      <li><a href="../VISTA/perfilCamionero.php">
          <i class="fas fa-thin fa-user"></i>
          <span class="nav-item">Perfil</span>
        </a></li>

      <li><a href="../VISTA/rutasCamionero.php">
          <i class="fas fa-thin fa-route"></i>
          <span class="nav-item">Rutas</span>
        </a></li>
    </ul>

    <li><a href="../../HOMEPAGE/VISTA/index.html" class="logout">
        <i class="fas fa-sign-out-alt"></i>
        <span class="nav-item">Log out</span>
      </a></li>
  </nav>

  <div>
    <h1>Bienvenido
      <?php echo $nombre ?>
    </h1>
  </div>
  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
    integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
    crossorigin="anonymous"></script>
</body>

</html>