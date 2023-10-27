<?php
class LoteModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    //LISTAR LOTE

    public function listarLotes()
    {
        $query = "SELECT * FROM lote";
        $result = mysqli_query($this->conn, $query);

        if (!$result) {
            // Manejar el error, por ejemplo:
            die("Error al obtener los Lotes: " . mysqli_error($this->conn));
        }

        $lotes = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $lotes[] = $row;
        }

        return $lotes;
    }

    //GUARDAR LOTE//

    public function guardarLote($estado)
    {
        // Preparar la consulta SQL para insertLOTE en la base de datos
        $query = "INSERT INTO lote (estado) VALUES (?)";
        $stmt = mysqli_prepare($this->conn, $query);

        // // Vincular los parámetros con los valores
        mysqli_stmt_bind_param($stmt, "s", $estado);

        // Ejecutar la consulta
        $resultado = mysqli_stmt_execute($stmt);

        // Verificar si la inserción fue exitosa
        if ($resultado) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
    }


    //ELIMINAR LOTE//

    public function eliminarLote($id_lote)
    {
        // Preparar la consulta SQL para eliminar el LOTE por su ID
        $query = "DELETE FROM lote WHERE id_lote = ?";
        $stmt = mysqli_prepare($this->conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id_lote); // El segundo argumento debe ser "i" para enteros
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




    //EDITAR LOTE//

    public function editarLote($estado, $id_lote)
    {

        // Preparar la consulta SQL para actualizar el lote
        $query = "UPDATE lote SET estado = ? WHERE id_lote = ?";
        $stmt = mysqli_prepare($this->conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $estado, $id_lote);
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
    //AGREGAR PAQUETE A LOTE//
    public function agregarPaqueteALote($id_paquete, $id_lote)
    {
        // Preparar la consulta SQL para insertar un paquete en un lote
        $query = "INSERT INTO paquete_lote (id_paquete, id_lote) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ii", $id_paquete, $id_lote);
            $insercion_exitosa = mysqli_stmt_execute($stmt);

            if ($insercion_exitosa) {
                return true; // Inserción exitosa
            } else {
                return false; // Error en la inserción
            }

            mysqli_stmt_close($stmt);
        } else {
            // Manejar el error
            die("Error en la preparación de la consulta: " . mysqli_error($this->conn));
        }
    }
}


?>