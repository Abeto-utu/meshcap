<?php
require("db.php");

if(isset($_POST['guardar'])){
    $destino = $_POST['destino'];
    $descripcion = $_POST['descripcion'];
    $numero_paquete = $_POST['numero_paquete'];

    $query = "INSERT INTO rutas(destino, descripcion ,numero_paquete) VALUES ('$destino','$descripcion','$numero_paquete')";
    $resultado = mysqli_query($conn,$query);

        if(!$resultado){
            die("Query Fail");
        }
    header("Location: crudPaquetes.php");
}
?>