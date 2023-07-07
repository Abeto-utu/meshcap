<?php
    require('db.php');

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $query = "DELETE FROM usuarios WHERE id_usuario = $id";
            $resultado = mysqli_query($conn,$query);
                if(!$resultado){
                    die("Error en la consulta");
                }

                header("Location: crudUsuarios.php");
        }
?>