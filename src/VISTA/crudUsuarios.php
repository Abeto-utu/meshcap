<?php require('../MODELO/db.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificación</title>
    <link rel="stylesheet" href="../CSS/stylesCrudPaquetes.css">
</head>
<body>
<nav>
    <ul>
      <li>
        <a href="../VISTA/index.html" class="logo">
          <img src="../IMAGES/gorraBlanca.png" alt="Logo Mesh Cap">
          <span class="nav-item">MeshCap</span>
        </a>
      </li>
      
      <li><a href="../VISTA/crudPaquetes.php">
        <i class="fas fa-thin fa-box"></i>
        <span class="nav-item">Paquetes</span>
      </a></li>

      <li><a href="../VISTA/crudLotes.php">
        <i class="fas fa-thin fa-dolly"></i>
        <span class="nav-item">Lotes</span>
      </a></li>

      <li><a href="../VISTA/crudVehiculos.php">
        <i class="fas fa-thin fa-truck"></i>
        <span class="nav-item">Vehiculos</span>
      </a></li>
      
      <li><a href="../VISTA/crudUsuarios.php">
        <i class="fas fa-thin fa-user"></i>
        <span class="nav-item">Usuarios</span>
      </a></li>

      <li><a href="../VISTA/crudPlataformas.php">
        <i class="fas fa-thin fa-warehouse"></i>
        <span class="nav-item">Plataformas</span>
      </a></li>

      <li><a href="#">
        <i class="fas fa-thin fa-gears"></i>
        <span class="nav-item">Configuracion</span>
      </a></li>

      <li><a href="../VISTA/inicioSesion.php" class="logout">
        <i class="fas fa-sign-out-alt"></i>
        <span class="nav-item">Log out</span>
      </a></li>
    </ul>
  </nav>

  <div class="container_total">
    <form action="../CONTROLADOR/saveCruds.php" method="POST">
        <div class="numero_funcionario">
            <input type="number" name="numero_funcionario" placeholder="N° Funcionario..." required>
        </div>
        <div class="clave">
            <input type="text" name="clave" placeholder="Contraseña" maxlength="16" minlength="6" required>
        </div>
        <div class="cargo">
            <select name="cargo" required>
                <option value="camionero">Camionero</option>
                <option value="repartidor">Repartidor</option>
                <option value="almacenero">Almacenero</option>
                <option value="backoffice">Backoffice</option>
            </select>
        </div>
        <input type="submit" value="Guardar" name="guardar_usuario">
    </form>

    <div class="container_table">
        <table>
            <thead>
                <tr>
                    <th>N° funcionario</th>
                    <th>Clave</th>
                    <th>Cargo</th>
                    <th>Fecha Ingreso</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM login";
                $usuarios = mysqli_query($conn,$query);

                while($fila = mysqli_fetch_array($usuarios)){ ?>
                        <tr>
                            <td><?php echo $fila['numero_funcionario']?></td>
                            <td><?php echo $fila['contrasenha']?></td>
                            <td><?php echo $fila['tipo_usuario']?></td>
                            <td><?php echo $fila['fecha_ingreso']?></td>
                            <td>
                                <a href="../CONTROLADOR/editUsuarios.php?id_usuario=<?php echo $fila['id_usuario'] ?>"><img src="../IMAGES/edit.png" alt="Icono Para editar" class="icon" id="edit_icon"></a>
                                <a href="../CONTROLADOR/deleteCruds.php?id_usuario=<?php echo $fila['id_usuario'] ?>"><img src="../IMAGES/delete.png" alt="Icono para eliminar" class="icon"></a>
                            </td>
                        </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
  </div>
  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
</body>