<?php
require('../MODELO/db.php');


            //Guardar Vehiculos//--
if(isset($_POST['guardar_vehiculo'])){
    $matricula = $_POST['matricula'];
    $estado = $_POST['estado'];
    $tipo = $_POST['vehiculo'];

            $query = "INSERT INTO vehiculo(matricula,estado,tipo) VALUES ('$matricula','$estado','$tipo')";
            $resultado = mysqli_query($conn, $query); 
            if(!$resultado){
                die("Query Fail");
            }
            header("Location: ../VISTA/crudVehiculos.php");
        }


            //Guardar Paquetes//--
if(isset($_POST['guardar_paquete'])){
    $departamento = $_POST['departamento'];
    $localidad = $_POST['localidad'];
    $numero = $_POST['numero'];
    $calle = $_POST['calle'];
    $estado = $_POST['estado_paquete'];
    $destino = "$numero $calle, $localidad, $departamento";

    $query = "INSERT INTO paquete(destino,estado) VALUES ('$destino','$estado')";
    $resultado = mysqli_query($conn,$query);

        if(!$resultado){
            die("Query Fail");
        }
    header("Location: ../VISTA/crudPaquetes.php");
}


            //Guardar Usuarios//--
if(isset($_POST['guardar_usuario'])){
    $clave = $_POST['clave'];
    $cargo = $_POST['cargo'];
    $numero_funcionario = $_POST['numero_funcionario'];

    $query = "INSERT INTO login(id_usuario, cargo, contrasenha) VALUES ('$numero_funcionario', '$cargo', '$clave')";
    $resultado = mysqli_query($conn,$query);

        if(!$resultado){
            die("Query Fail");
        }
    header("Location: ../VISTA/crudUsuarios.php");
}


            //Guardar Plataformas//--
if(isset($_POST['guardar_plataforma'])){
    $departamento = $_POST['departamento'];
    $localidad = $_POST['localidad'];
    $numero = $_POST['numero'];
    $calle = $_POST['calle'];
    $ubicacion = "$numero $calle, $localidad";

    $query = "INSERT INTO plataforma(ubicacion,nombre) VALUES ('$ubicacion','$departamento')";
    $resultado = mysqli_query($conn,$query);

        if(!$resultado){
            die("Query Fail");
        }
    header("Location: ../VISTA/crudPlataformas.php");
}


           //Guardar Lotes//--
if(isset($_POST['guardar_lote'])){
    $estado = $_POST['estado_lote'];
        
    $query = "INSERT INTO lote(estado) VALUES ('$estado')";
    $resultado = mysqli_query($conn,$query);
        
        if(!$resultado){
            die("Query Fail");
        }
    header("Location: ../VISTA/crudLotes.php");
}
?>