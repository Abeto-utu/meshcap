<?php
class PaqueteModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

                                            //LISTAR PAQUETE

    public function listarPaquetes() {
        $query = "SELECT * FROM paquete";
        $result = mysqli_query($this->conn, $query);
        
        if (!$result) {
            // Manejar el error, por ejemplo:
            die("Error al obtener los paquetes: " . mysqli_error($this->conn));
        }
    
        $paquetes = [];
    
        while ($row = mysqli_fetch_assoc($result)) {
            $paquetes[] = $row;
        }
    
        return $paquetes;
    }

                                            //GUARDAR PAQUETE//

        public function guardarPaquete($departamento, $localidad, $calle, $numero, $plataforma_actual_paquete, $estado_paquete) {
            // Preparar el destino combinando los datos del formulario
            $destino = "$numero $calle, $localidad, $departamento";
    
            // Preparar la consulta SQL para insertar el paquete en la base de datos
            $query = "INSERT INTO paquete (destino, estado) VALUES (?, ?)";
            $stmt = mysqli_prepare($this->conn, $query);
    
            // // Vincular los parámetros con los valores
            mysqli_stmt_bind_param($stmt, "ss", $destino, $estado_paquete);
    
            // Ejecutar la consulta
            $resultado = mysqli_stmt_execute($stmt);
    
            // Verificar si la inserción fue exitosa
            if ($resultado) {
                return true; // Inserción exitosa
            } else {
                return false; // Error en la inserción
            }
        }


                                            //ELIMINAR PAQUETE//

        public function eliminarPaquete($id_paquete) {
    // Preparar la consulta SQL para eliminar el paquete por su ID
    $query = "DELETE FROM paquete WHERE id_paquete = ?";
    $stmt = mysqli_prepare($this->conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_paquete); // El segundo argumento debe ser "i" para enteros
        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            return true; // Eliminación exitosa
        } else {
            return false; // Error en la eliminación
        }

        mysqli_stmt_close($stmt);
    } else {
        // Manejar el error
        die("Error en la preparación de la consulta: " . mysqli_error($this->conn));
    }
}




                                            //EDITAR PAQUETE//

        public function editarPaquete($id_paquete, $departamento, $localidad, $calle, $numero, $plataforma_actual_paquete, $estado_paquete) {
    // Preparar el destino combinando los datos del formulario
    $destino = "$numero $calle, $localidad, $departamento";

    // Preparar la consulta SQL para actualizar el paquete
    $query = "UPDATE paquete SET destino = ?, estado = ? WHERE id_paquete = ?";
    $stmt = mysqli_prepare($this->conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssi", $destino, $estado_paquete, $id_paquete);
        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            return true; // Edición exitosa
        } else {
            return false; // Error en la edición
        }

        mysqli_stmt_close($stmt);
    } else {
        // Manejar el error
        die("Error en la preparación de la consulta: " . mysqli_error($this->conn));
    }
}
    }
?>