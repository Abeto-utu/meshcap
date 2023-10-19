<?php
    require('../../db.php');


                //Eliminar Usuario//--

        if(isset($_GET['id_usuario'])){
            $id = $_GET['id_usuario'];

            $query = "DELETE FROM login WHERE id_usuario = '$id'";
            $resultado = mysqli_query($conn,$query);
            $query2 = "DELETE FROM usuario WHERE id_usuario = '$id'";
            $resultado2 = mysqli_query($conn,$query2);
            
                if(!$resultado || !$resultado2){
                    die("Error en la consulta");
                }

                header("Location: ../VISTA/crudUsuarios.php");
        }


                //Eliminar vehiculo//--     

        if(isset($_GET['matricula'])){
            $matricula = $_GET['matricula'];

            $query = "DELETE FROM vehiculo WHERE matricula = '$matricula'";
            $resultado = mysqli_query($conn,$query);
                if(!$resultado){
                    die("Error en la consulta");
                }

                header("Location: ../VISTA/crudVehiculos.php");
        }


                //Eliminar paquete//--

        if(isset($_GET['id_paquete'])){
            $id = $_GET['id_paquete'];

            $query = "DELETE FROM paquete WHERE id_paquete = '$id'";
            $resultado = mysqli_query($conn,$query);
                if(!$resultado){
                    die("Error en la consulta");
                }

                header("Location: ../VISTA/crudPaquetes.php");
        }


                //Eliminar plataforma//--

        if(isset($_GET['id_plataforma'])){
            $id = $_GET['id_plataforma'];
        
            $query = "DELETE FROM plataforma WHERE id_plataforma = '$id'";
            $resultado = mysqli_query($conn,$query);
                if(!$resultado){
                    die("Error en la consulta");
                }
        
                header("Location: ../VISTA/crudPlataformas.php");
            }
            

                //Eliminar Lote//--

        if(isset($_GET['id_lote'])){
            $id = $_GET['id_lote'];
        
            $query = "DELETE FROM lote WHERE id_lote = '$id'";
            $resultado = mysqli_query($conn,$query);
                if(!$resultado){
                    die("Error en la consulta");
                }
        
                header("Location: ../VISTA/crudLotes.php");
            }
?>