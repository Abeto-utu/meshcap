<?php require("db.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Paquetes</title>
    <link rel="stylesheet" href ="../CSS/stylesCrudPaquetes.css">
</head>
<body>
    <header>
      <nav class="navbar">
        <div class="navbar-icon">
          <a href="../HTML/backoffice.html"><img src="../IMAGES/gorraBlanca.png" alt="Logo de Mesh Cap" class="logo"></a>
        </div>
        <div class="puesto">
          <h1>Backoffice</h1>
        </div>
        <div class="volver">
          <a href="javascript:history.back()"><img src="../IMAGES/flecha.png" alt="Imagen de flecha" class="flecha"></a>
        </div>
      </nav>
    </header>

    <form action="savePaquetes.php" method="POST">
    <div class="numero_paquete">
            <input type="number" name="numero_paquete" placeholder="N° Paquete..." min ="1000000000" max="9999999999" required>
        </div>
        <div class="destino">
            <input type="text" name="destino" placeholder="Destino..." maxlength="100" required>
        </div>
        <div class="descripcion">
            <textarea name="descripcion" id="texto" cols="30" rows="10" placeholder="Descripcion..." maxlength="600" required></textarea>
        </div>
            <input type="submit" value ="Guardar" name ="guardar">
    </form>
    
        <div class="container_table">
            <table>
                <thead>
                    <tr>
                        <th>N° Paquete</th>
                        <th>Destino</th>
                        <th>Descripcion</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM rutas";
                    $rutas = mysqli_query($conn,$query);

                    while($fila = mysqli_fetch_array($rutas)){ ?>
                            <tr>
                                <td><?php echo $fila['numero_paquete']?></td>
                                <td><?php echo $fila['destino']?></td>
                                <td><?php echo $fila['descripcion']?></td>
                                <td><?php echo $fila['fecha']?></td>
                                <td>
                                    <a href="editPaquetes.php?id=<?php echo $fila['id'] ?>"><img src="../IMAGES/edit.png" alt="Icono Para editar" class = "icon" id="edit_icon"></a>
                                    <a href="deletePaquetes.php?id=<?php echo $fila['id'] ?>"><img src="../IMAGES/delete.png" alt="Icono para eliminar" class ="icon"></a>
                                </td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
</body>
</html>