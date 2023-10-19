<?php require('../../db.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Lotes</title>
    <link rel="stylesheet" href ="../CSS/stylesCrudPaquetes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-dark bg-dark p-4 ">
    <div class="container-fluid">
      <a class="navbar-brand" href="../../VISTA/index.html" id="logo"><img src="../../IMAGES/gorraBlanca.png" height="40" alt="">MeshCap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title text-center" id="offcanvasDarkNavbarLabel">Menu del Backoffice</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../VISTA/backoffice.html">Inicio</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Menus
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="../VISTA/crudPaquetes.php"> <i class="fas fa-thin fa-box"></i> Paquetes</a></li>
              <li><a class="dropdown-item" href="../VISTA/crudLotes.php"> <i class="fas fa-thin fa-dolly"></i> Lotes</a></li>
              <li><a class="dropdown-item" href="../VISTA/crudVehiculos.php"> <i class="fas fa-thin fa-truck"></i> Vehiculos</a></li>
              <li><a class="dropdown-item" href="../VISTA/crudUsuarios.php"> <i class="fas fa-thin fa-user"></i> Usuarios</a></li>
              <li><a class="dropdown-item" href="../VISTA/crudPlataformas.php"> <i class="fas fa-thin fa-warehouse"></i> Plataformas</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="../VISTA/inicioSesion.php">Log out</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<div class="container-fluid row" $id="container-total">
      <form action="../CONTROLADOR/saveCruds.php" method="POST" class="col-3 p-5 m-3 bg-dark text-light">
        <div class="mb-3">
          <h3 class ="text-light text-center">Registro Lotes</h3>
            <label for="exampleInputEmail1" class="form-label">Estado del lote</label>
              <select class="form-select mb-3" aria-label="Default select example" name="estado_lote">
                <option value="De Camino al Almacen">De camino al almacen</option>
                <option value="En almacen">En almacen</option>
                <option value="De camino al destino">De camino al destino</option>
                <option value="Entregado">Entregado</option>   
              </select>

              <button type="submit" class="btn btn-secondary " name="guardar_lote">Guardar</button>
      </form>
</div>
      <div class="col-8 p-5 text-center">
          <div style="max-height: 600px; overflow-y: auto;">
              <table class="table col-8">
              <thead class="table-dark fs-4">
                  <tr class="align-middle">
                    <th scope="col">N° Lote</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha de Apertura</th>
                    <th scope="col">Fecha de Cierre</th>
                    <th scope="col">Fecha de Entrega</th>
                    <th scope="col">Acciones</th>
                  </tr>
              </thead>
              <tbody>
              <tbody>
                    <?php
                    $query = "SELECT * FROM lote";
                    $lote = mysqli_query($conn,$query);

                    while($fila = mysqli_fetch_array($lote)){ ?>
                            <tr class="align-middle">
                                <td><?php echo $fila['id_lote']?></td>
                                <td><?php echo $fila['estado']?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                  <a href="../VISTA/editLotes.php?id_lote=<?php echo $fila['id_lote']; ?>" class="btn btn-small btn-warning"><i class="fas fa-pen-nib"></i></a>
                                  <a href="../CONTROLADOR/deleteCruds.php?id_lote=<?php echo $fila['id_lote']; ?>" class="btn btn-small btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
          </div>
    </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
</body>
</html>