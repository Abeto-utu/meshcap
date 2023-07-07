<?php
require("db.php");

if(isset($_POST['guardar'])){
    $clave = $_POST['clave'];
    $cargo = $_POST['cargo'];
    $numero_funcionario = $_POST['numero_funcionario'];

    $query = "INSERT INTO usuarios(puesto, clave ,numero_funcionario) VALUES ('$cargo','$clave','$numero_funcionario')";
    $resultado = mysqli_query($conn,$query);

        if(!$resultado){
            die("Query Fail");
        }
    header("Location: crudUsuarios.php");
}
?>