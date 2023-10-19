<?php
class VehiculoModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

                                            //LISTAR Vehiculo

    public function listarVehiculo() {
        $query = "SELECT * FROM vehiculo";
        $result = mysqli_query($this->conn, $query);
        
        if (!$result) {
            // Manejar el error, por ejemplo:
            die("Error al obtener los Vehiculos: " . mysqli_error($this->conn));
        }
    
        $vehiculos = [];
    
        while ($row = mysqli_fetch_assoc($result)) {
            $vehiculos[] = $row;
        }
    
        return $vehiculos;
    }

                                            //GUARDAR VEHICULO//

        public function guardarVehiculo($matricula, $tipo, $estado) {
        // Preparar la consulta SQL para insertar el Vehiculo en la base de datos
        $query = "INSERT INTO vehiculo (matricula, estado, tipo) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);

        // Vincular los parámetros con las referencias a las variables
        mysqli_stmt_bind_param($stmt, "sss", $matricula, $estado, $tipo);

        // Ejecutar la consulta
        $resultado = mysqli_stmt_execute($stmt);

        // Verificar si la inserción fue exitosa
        if ($resultado) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
    }


                                            //ELIMINAR VEHICULO//

        public function eliminarVehiculo($matricula) {
    // Preparar la consulta SQL para eliminar el VEHICULO por su MATRICULA
    $query = "DELETE FROM vehiculo WHERE matricula = ?";
    $stmt = mysqli_prepare($this->conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $matricula); // El segundo argumento debe ser "s" para cadenas
        $resultado = mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt); // Mover esta línea aquí

        if ($resultado) {
            return true; // Eliminación exitosa
        } else {
            return false; // Error en la eliminación
        }
    } else {
        // Manejar el error
        die("Error en la preparación de la consulta: " . mysqli_error($this->conn));
    }
}

                                            //EDITAR VEHICULO//

       public function editarVehiculo($estado, $matricula) {
    // Preparar la consulta SQL para actualizar el estado del vehículo
    $query = "UPDATE vehiculo SET estado = ? WHERE matricula = ?";
    $stmt = mysqli_prepare($this->conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $estado, $matricula); // Ambos argumentos deben ser "s" para cadenas
        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            mysqli_stmt_close($stmt);
            return true; // Edición exitosa
        } else {
            mysqli_stmt_close($stmt);
            return false; // Error en la edición
        }
    } else {
        // Manejar el error
        die("Error en la preparación de la consulta: " . mysqli_error($this->conn));
    }
}
    }
?>