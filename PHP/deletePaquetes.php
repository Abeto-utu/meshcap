<?php
    require('db.php');

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $query = "DELETE FROM rutas WHERE id = $id";
            $resultado = mysqli_query($conn,$query);
                if(!$resultado){
                    die("Error en la consulta");
                }

                header("Location: crudPaquetes.php");
        }
?>