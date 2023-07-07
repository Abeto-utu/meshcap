<?php
    require('db.php');

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = "SELECT * FROM rutas WHERE id = $id";
            $resultado = mysqli_query($conn,$query);
                if(mysqli_num_rows($resultado) == 1){
                    $fila = mysqli_fetch_array($resultado);
                    $destino = $fila['destino'];
                    $descripcion = $fila['descripcion'];
                    $numero_paquete = $fila['numero_paquete'];
                }   
        }
        if(isset($_POST['editado'])){
            $id = $_GET['id'];
            $destino = $_POST['destino'];
            $descripcion = $_POST['descripcion'];
            $numero_paquete = $_POST['numero_paquete'];

            $query = "UPDATE rutas SET destino = '$destino', descripcion = '$descripcion', numero_paquete = '$numero_paquete' WHERE id = $id";
            mysqli_query($conn,$query);
            header("Location: crudUsuarios.php");
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href ="../CSS/stylesCrudEdit.css">
    <title>Editar Rutas</title>
</head>
<body>
    <form action="editPaquetes.php?id=<?php echo $id?>" method ="POST">
        <div>
            <input type="number" value="<?php echo $numero_paquete ?>" name ="numero_paquete">
        </div>
        <div>
            <input type="text" value="<?php echo $destino ?>" name ="destino">
        </div>
        <div class="container_update_textarea">
            <textarea name="descripcion" id="" cols="30" rows="10"><?php echo $descripcion?></textarea>
        </div>
            <input type="submit" value="Editar" name="editado">
    </form>
</body>
</html>