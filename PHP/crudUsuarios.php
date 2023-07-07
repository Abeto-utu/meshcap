<?php require("db.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificación</title>
    <link rel="stylesheet" href="../CSS/stylesCrudUsuarios.css">
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

    <form action="saveUsuarios.php" method="POST">
        <div class="numero_funcionario">
            <input type="number" name="numero_funcionario" placeholder="N° Funcionario..." min ="1000000000" max="9999999999" required>
        </div>
        <div class="clave">
            <input type="text" name="clave" placeholder="Contraseña" maxlength="16" minlength="6" required>
        </div>
        <div class="cargo">
            <select name="cargo" required>
                <option value="camionero">Camionero</option>
                <option value="repartidor">Repartidor</option>
                <option value="almaceneroMontevideo">Almacenero Montevideo</option>
                <option value="almaceneroInterior">Almacenero Interior</option>
                <option value="backoffice">Backoffice</option>
            </select>
        </div>
        <input type="submit" value="Guardar" name="guardar">
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
                $query = "SELECT * FROM usuarios";
                $usuarios = mysqli_query($conn,$query);

                while($fila = mysqli_fetch_array($usuarios)){ ?>
                        <tr>
                            <td><?php echo $fila['numero_funcionario']?></td>
                            <td><?php echo $fila['clave']?></td>
                            <td><?php echo $fila['puesto']?></td>
                            <td><?php echo $fila['fecha_ingreso']?></td>
                            <td>
                                <a href="editUsuarios.php?id=<?php echo $fila['id_usuario'] ?>"><img src="../IMAGES/edit.png" alt="Icono Para editar" class="icon" id="edit_icon"></a>
                                <a href="deleteUsuarios.php?id=<?php echo $fila['id_usuario'] ?>"><img src="../IMAGES/delete.png" alt="Icono para eliminar" class="icon"></a>
                            </td>
                        </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>