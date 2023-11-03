<?php
class CamioneroModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function infoCamionero($id_usuario)
    {
        $query = "SELECT c.id_usuario, u.nombre, u.cargo, c.estado, cv.matricula
        FROM camionero c
        JOIN camionero_vehiculo cv ON c.id_usuario = cv.id_usuario
        JOIN usuario u ON c.id_usuario = u.id_usuario
        WHERE c.id_usuario = $id_usuario
      	UNION
		SELECT id_usuario, estado, estado AS estado2, estado AS estado3, estado AS estado4
        FROM camionero 
        WHERE id_usuario = $id_usuario";
        $result = mysqli_query($this->conn, $query);
        // Lo de los muchos estados es para que no haya error cuando inicia sesion un camionero sin vehiculo. Cuando entra a la pagina no le deja hacer nada basicamente

        if (!$result) {
            die("Error al obtener informacion de camionero: " . mysqli_error($this->conn));
        }

        while ($fila = mysqli_fetch_array($result)) {
            $camionero = array(
                'id_usuario' => $fila['id_usuario'],
                'nombre' => $fila['nombre'],
                'cargo' => $fila['cargo'],
                'estado' => $fila['estado'],
                'matricula' => $fila['matricula']
            );
            break;
        }
        if ($camionero['cargo'] == $camionero['estado']) {
            $camioneroInvalido = array(
                'id_usuario' => $camionero['id_usuario'],
                'nombre' => '-',
                'cargo' => '-',
                'estado' => '-',
                'matricula' => '-'
            );
            return $camioneroInvalido;
        }
        return $camionero;
    }

    public function infoRecolecciones($matricula)
    {
        $query = "SELECT r.id_recoleccion, r.fecha_llegada, r.fecha_ida, c.nombre
        FROM recoleccion r
        JOIN cliente_recoleccion cr ON r.id_recoleccion = cr.id_recoleccion
        JOIN cliente c ON cr.id_cliente = c.id_cliente
        JOIN recoleccion_vehiculo rv ON r.id_recoleccion = rv.id_recoleccion
        WHERE rv.matricula = '$matricula'
        ORDER BY 
          CASE WHEN r.fecha_llegada IS NULL THEN 0 ELSE 1 END,
          r.fecha_llegada;
        ";
        $recolecciones = mysqli_query($this->conn, $query);

        if (!$recolecciones) {
            die("Error: " . mysqli_error($this->conn));
        }

        $resultado = [];

        while ($fila = mysqli_fetch_array($recolecciones)) {
            $resultado[] = $fila;
        }

        return $resultado;
    }

    public function infoRecoleccion($recoleccion)
    {
        $query = "SELECT r.id_recoleccion, r.fecha_llegada, r.fecha_ida, cr.id_cliente, cli.nombre as nombre_cliente, rv.matricula
        FROM recoleccion r
        JOIN cliente_recoleccion cr ON r.id_recoleccion = cr.id_recoleccion
        JOIN cliente cli ON cr.id_cliente = cli.id_cliente
        JOIN recoleccion_vehiculo rv ON r.id_recoleccion = rv.id_recoleccion
        WHERE r.id_recoleccion = $recoleccion";
        $recoleccion = mysqli_query($this->conn, $query);

        if (!$recoleccion) {
            die("Error: " . mysqli_error($this->conn));
        }

        $resultado = [];

        while ($fila = mysqli_fetch_array($recoleccion)) {
            $resultado[] = $fila;
        }

        return $resultado;
    }

    public function subirLote($id_lote, $matricula)
    {
        $query = "SELECT *
        FROM lote
        WHERE id_lote = $id_lote";
        $resultado = mysqli_query($this->conn, $query);

        if (!$resultado) {
            return false;
        }

        $fila = mysqli_fetch_array($resultado);

        if ($fila["estado"] == 'en camion' || $fila["estado"] == 'entregado' || $fila["estado"] == 'abierto') {
            return false;
        }

        $query = "INSERT INTO vehiculo_plataforma_lote (id_lote, id_plataforma, matricula) 
            VALUES ($id_lote, (SELECT id_plataforma FROM plataforma_lote WHERE id_lote = $id_lote), '$matricula');";
        $resultado = mysqli_query($this->conn, $query);

        if (!$resultado) {
            return false;
        }

        if (empty($fila['fecha_cierre'])) {
            $query = "UPDATE lote
                SET fecha_cierre = CURRENT_TIMESTAMP
                WHERE id_lote = $id_lote;";

            $resultado = mysqli_query($this->conn, $query);

            if (!$resultado) {
                return false;
            }
        }

        $query = "UPDATE lote
            SET estado = 'en camion'
            WHERE id_lote = $id_lote;
            ";
        $resultado = mysqli_query($this->conn, $query);

        if ($resultado) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
    }
    public function lotesSinCamion()
    {
        $query = "SELECT pl.id_lote, p.nombre, l.estado
        FROM plataforma_lote pl
        LEFT JOIN vehiculo_plataforma_lote vpl ON pl.id_lote = vpl.id_lote
        JOIN plataforma p ON pl.id_plataforma = p.id_plataforma
        JOIN lote l ON l.id_lote = pl.id_lote
        WHERE pl.fecha_llegada IS NULL 
        AND vpl.id_lote IS NULL
        AND l.estado = 'cerrado';
        ";
        $lotes = mysqli_query($this->conn, $query);

        if (!$lotes) {
            die("Error: " . mysqli_error($this->conn));
        }

        $resultado = [];

        while ($fila = mysqli_fetch_array($lotes)) {
            $resultado[] = $fila;
        }

        return $resultado;
    }

    public function lotesEnCamion($matricula)
    {
        $query = "SELECT l.*, p.*
        FROM vehiculo_plataforma_lote vpl
        JOIN vehiculo v ON vpl.matricula = v.matricula
        JOIN plataforma_lote pl ON vpl.id_lote = pl.id_lote
        JOIN lote l ON vpl.id_lote = l.id_lote
        JOIN plataforma p ON pl.id_plataforma = p.id_plataforma
        WHERE vpl.id_lote IN (
            SELECT id_lote
            FROM plataforma_lote
            WHERE fecha_llegada IS NULL
        ) 
        AND l.estado = 'en camion'
        AND vpl.matricula = '$matricula';
        ";
        $lotes = mysqli_query($this->conn, $query);

        if (!$lotes) {
            die("Error: " . mysqli_error($this->conn));
        }

        $resultado = [];

        while ($fila = mysqli_fetch_array($lotes)) {
            $resultado[] = $fila;
        }

        return $resultado;
    }

    public function paquetesEnRecorrido($id_recorrido)
    {
        $query = "SELECT p.id_paquete, p.destino, p.estado, p.fecha_recibo, p.fecha_entrega
                            FROM paquete p
                            JOIN paquete_recorrido pr ON p.id_paquete = pr.id_paquete
                            WHERE pr.id_recorrido = $id_recorrido AND p.estado <> 'entregado';;
                            ";
        $paqueteRecorrido = mysqli_query($this->conn, $query);

        if (!$paqueteRecorrido) {
            die("Error: " . mysqli_error($this->conn));
        }

        $resultado = [];

        while ($fila = mysqli_fetch_array($paqueteRecorrido)) {
            $resultado[] = $fila;
        }

        return $resultado;
    }

    public function recorridosActivos($id_usuario)
    {
        $query = "SELECT r.id_recorrido, r.estado, r.fecha_inicio, rv.matricula, cv.id_usuario
                        FROM recorrido r
                        JOIN recorrido_vehiculo rv ON r.id_recorrido = rv.id_recorrido
                        JOIN camionero_vehiculo cv ON rv.matricula = cv.matricula
                        WHERE cv.id_usuario = $id_usuario
                        AND r.estado IN ('no comenzado', 'en proceso');
                        ";
        $recorridosActivos = mysqli_query($this->conn, $query);

        if (!$recorridosActivos) {
            die($id_usuario . " gdfgError: " . mysqli_error($this->conn));
        }

        $resultado = [];

        while ($fila = mysqli_fetch_array($recorridosActivos)) {
            $resultado[] = $fila;
        }

        return $resultado;
    }
    public function iniciarTroncal($id_usuario, $matricula)
    {
        $query = "UPDATE camionero
        SET estado = 'trabajando'
        WHERE id_usuario = $id_usuario;
        ";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        $query = "UPDATE vehiculo
        SET estado = 'en linea'
        WHERE matricula = '$matricula';
        ";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }
        return true;
    }
    public function finalizarTroncal($id_usuario, $matricula)
    {
        $query = "UPDATE camionero
        SET estado = 'disponible'
        WHERE id_usuario = $id_usuario;
        ";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        $query = "UPDATE vehiculo
        SET estado = 'con conductor'
        WHERE matricula = '$matricula';
        ";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }
        return true;
    }

    public function inciarRecoleccion($id_recoleccion, $id_usuario, $matricula)
    {
        $query = "UPDATE recoleccion
        SET fecha_ida = CURRENT_TIMESTAMP, fecha_llegada = NULL
        WHERE id_recoleccion = $id_recoleccion;";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        $query = "UPDATE camionero
        SET estado = 'trabajando'
        WHERE id_usuario = $id_usuario;
        ";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        $query = "UPDATE vehiculo
        SET estado = 'en recoleccion'
        WHERE matricula = '$matricula';
        ";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        return true;
    }
    public function finalizarRecoleccion($id_recoleccion, $id_usuario, $matricula)
    {
        $query = "UPDATE recoleccion
        SET fecha_llegada = CURRENT_TIMESTAMP
        WHERE id_recoleccion = $id_recoleccion;";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        $query = "UPDATE camionero
        SET estado = 'disponible'
        WHERE id_usuario = $id_usuario;
        ";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        $query = "UPDATE vehiculo
        SET estado = 'con conductor'
        WHERE matricula = '$matricula';
        ";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        return true;
    }

    public function iniciarEntrega($id_usuario, $matricula, $id_recorrido)
    {
        $query = "UPDATE camionero
        SET estado = 'trabajando'
        WHERE id_usuario = $id_usuario;
        ";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        $query = "UPDATE vehiculo
        SET estado = 'en recorrido'
        WHERE matricula = '$matricula';
        ";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        $query = "UPDATE paquete
        SET estado = 'en recorrido'
        WHERE id_paquete IN (
        SELECT id_paquete
        FROM paquete_recorrido
        WHERE id_recorrido = $id_recorrido
        );";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        $query = "UPDATE recorrido
        SET fecha_inicio = CURRENT_TIMESTAMP, estado = 'en proceso'
        WHERE id_recorrido = $id_recorrido;";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        return true;
    }

    public function finalizarEntrega($id_recorrido, $id_usuario, $matricula)
    {
        $query = "UPDATE recorrido
        SET estado = 'finalizado'
        WHERE id_recorrido = $id_recorrido;";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        $query = "UPDATE camionero
        SET estado = 'disponible'
        WHERE id_usuario = $id_usuario;
        ";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        $query = "UPDATE vehiculo
        SET estado = 'con conductor'
        WHERE matricula = '$matricula';
        ";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        return true;
    }

    public function agregarPaquete()
    {
        $departamento = $_POST['departamento'];
        $estado = 'en plataforma'; // DEFAULT PORQUE SON PAQUETES QUE REOCOGE EL CAMIONERO
        $localidad = $_POST['localidad'];
        $calle = $_POST['calle'];
        $numero = $_POST['numero'];
        $destino = "$numero $calle, $localidad, $departamento";
        $query = "INSERT INTO paquete (destino, estado, fecha_recibo, fecha_entrega) 
        VALUES ('$destino', '$estado', CURRENT_TIMESTAMP, NULL);
        ";
        $resultado = mysqli_query($this->conn, $query);

        if (!$resultado) {
            return false;
        }
        return true;
    }
    public function entregarPaquete()
    {
        $paquete = $_POST['paquete'];

        $query = "UPDATE paquete
        SET estado = 'entregado'
        WHERE id_paquete = $paquete;
        ";
        $resultado = mysqli_query($this->conn, $query);

        if (!$resultado) {
            return false;
        }

        $query = "UPDATE paquete
        SET fecha_entrega = CURRENT_TIMESTAMP
        WHERE id_paquete = $paquete;
        ";
        $resultado = mysqli_query($this->conn, $query);

        if (!$resultado) {
            return false;
        }

        return true;
    }

    public function entregarLote()
    {
        $lote = $_POST['lote'];

        $query = "UPDATE plataforma_lote
        SET fecha_llegada = CURRENT_TIMESTAMP
        WHERE id_lote = $lote;
        ";
        $resultado = mysqli_query($this->conn, $query);

        if (!$resultado) {
            return false;
        }

        $query = "UPDATE paquete
        SET estado = 'en plataforma destino'
        WHERE id_paquete IN (
            SELECT id_paquete
            FROM paquete_lote
            WHERE id_lote = $lote);";
        $resultado = mysqli_query($this->conn, $query);

        if (!$resultado) {
            return false;
        }

        $query = "UPDATE lote
        SET estado = 'entregado'
        WHERE id_lote = $lote;
        ";
        $resultado = mysqli_query($this->conn, $query);

        if (!$resultado) {
            return false;
        }
        return true;
    }

    public function ultimoPaquete()
    {
        $query = "SELECT MAX(id_paquete) AS highest_id_paquete FROM paquete;";
        $resultado = mysqli_query($this->conn, $query);

        if ($row = mysqli_fetch_assoc($resultado)) {
            $id_paquete = $row['highest_id_paquete'];
        } else {
            die('error 1 en consultar ultimo paquete' . mysqli_error($this->conn));
        }

        return $id_paquete;
    }

}
?>