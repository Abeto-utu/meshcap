<?php
    require('db.php');

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = "SELECT * FROM usuarios WHERE id_usuario = $id";
            $resultado = mysqli_query($conn,$query);
                if(mysqli_num_rows($resultado) == 1){
                    $fila = mysqli_fetch_array($resultado);
                    $numero_funcionario = $fila['numero_funcionario'];
                    $clave = $fila['clave'];
                    $puesto = $fila['puesto'];
                }   
        }
        if(isset($_POST['editado'])){
            $id = $_GET['id'];
            $clave = $_POST['clave'];
            $puesto = $_POST['puesto'];
            $numero_funcionario = $_POST['numero_funcionario'];

            $query = "UPDATE usuarios SET numero_funcionario = '$numero_funcionario', clave = '$clave', puesto = '$puesto' WHERE id_usuario = $id";
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
    <title>Editar Usuario</title>
</head>
<body>
    
    <header>
      <nav class="navbar">
        <div class="navbar-icon">
          <a href="backoffice.html"><img src="../IMAGES/gorraBlanca.png" alt="Logo de Mesh Cap" class="logo"></a>
        </div>
        <div class="puesto">
          <h1>Backoffice</h1>
        </div>
        <div class="perfil">
          <a href="../HTML/index.html"><img src="../IMAGES/flecha.png" alt="Imagen de flecha" class="flecha"></a>
        </div>
      </nav>
    </header>

    <form action="editUsuarios.php?id=<?php echo $id?>" method ="POST">
        <div>
            <input type="number" value="<?php echo $numero_funcionario ?>" name ="numero_funcionario">
        </div>
        <div>
            <input type="text" value="<?php echo $clave ?>" name ="clave">
        </div>
        <div>
            <textarea name="puesto" cols="30" rows="10"><?php echo $puesto?></textarea>
        </div>
            <input type="submit" value="Editar" name="editado">
    </form>
</body>
</html>