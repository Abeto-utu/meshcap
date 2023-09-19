<?php require('../MODELO/db.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Paquetes</title>
    <link rel="stylesheet" href ="../CSS/stylesCrudPaquetes.css">
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

      <div class="departamento">
            <select name="departamento" required>
                <option value="Artigas">Artigas</option>
                <option value="Canelones">Canelones</option>
                <option value="Cerro Largo">Cerro Largo</option>
                <option value="Colonia">Colonia</option>
                <option value="Durazno">Durazno</option>
                <option value="Flores">Flores</option>
                <option value="Florida">Florida</option>
                <option value="Lavalleja">Lavalleja</option>
                <option value="Maldonado">Maldonado</option>
                <option value="Montevideo" selected>Montevideo</option>
                <option value="Paysandu">Paysandú</option>
                <option value="Rio negro">Rio Negro</option>
                <option value="Rivera">Rivera</option>
                <option value="Rocha">Rocha</option>
                <option value="Salto">Salto</option>
                <option value="San jose">San José</option>
                <option value="Soriano">Soriano</option>
                <option value="Tacuarembo">Tacuarembó</option>
                <option value="Treinta y Tres">Treinta y tres</option>
            </select>
        </div>

        <div class="localidad">
            <input type="text" name="localidad" placeholder="Localidad..." maxlength="100" required>
        </div>

        <div class="calle">
            <input type="text" name="calle" placeholder="Calle.." maxlength="100" required>
        </div>

        <div class="numero">
            <input type="text" name="numero" placeholder="Número..." maxlength="100" required>
        </div>

            <input type="submit" value ="Guardar" name ="guardar_plataforma">
    </form>
    
        <div class="container_table">
            <table>
                <thead>
                    <tr>
                        <th>N° Plataforma</th>
                        <th>Departamento</th>
                        <th>Ubicacion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM plataforma";
                    $plataforma = mysqli_query($conn,$query);

                    while($fila = mysqli_fetch_array($plataforma)){ ?>
                            <tr>
                                <td><?php echo $fila['id_plataforma']?></td>
                                <td><?php echo $fila['nombre']?></td>
                                <td><?php echo $fila['ubicacion']?></td>
                                <td>
                                    <a href="../CONTROLADOR/editPlataformas.php?id_plataforma=<?php echo $fila['id_plataforma'] ?>"><img src="../IMAGES/edit.png" alt="Icono Para editar" class = "icon" id="edit_icon"></a>
                                    <a href="../CONTROLADOR/deleteCruds.php?id_plataforma=<?php echo $fila['id_plataforma'] ?>"><img src="../IMAGES/delete.png" alt="Icono para eliminar" class ="icon"></a>
                                </td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
      </div>
        <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
</body>
</html>