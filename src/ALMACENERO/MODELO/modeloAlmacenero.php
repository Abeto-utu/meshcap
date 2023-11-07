<?php
class almaceneroModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function infoAlmacenero($id_usuario)
    {
        $query = "SELECT u.id_usuario, u.nombre, u.cargo, up.id_plataforma, p.nombre AS nombre_plataforma
        FROM usuario u
        JOIN usuario_plataforma up ON u.id_usuario = up.id_usuario
        JOIN plataforma p ON up.id_plataforma = p.id_plataforma
        WHERE u.id_usuario = $id_usuario;
        ";
        $result = mysqli_query($this->conn, $query);

        if (!$result) {
            die("Error al obtener informacion de almacenero: " . mysqli_error($this->conn));
        }

        $almacenero = [];

        while ($fila = mysqli_fetch_array($result)) {
            $almacenero = array(
                'id_usuario' => $fila['id_usuario'],
                'nombre' => $fila['nombre'],
                'cargo' => $fila['cargo'],
                'id_plataforma' => $fila['id_plataforma'],
                'nombre_plataforma' => $fila['nombre_plataforma']
            );
        }

        return $almacenero;
    }

    public function paquetesPlatafoma($id_plataforma)
    {

        if ($id_plataforma == '1') { // Si la plataforma es montevideo se comporta diferente
            $query = "SELECT * FROM paquete WHERE estado <> 'entregado';
            ";
            $result = mysqli_query($this->conn, $query);
        } else {
            $query = "SELECT p.*
            FROM paquete p
            JOIN paquete_lote pl ON p.id_paquete = pl.id_paquete
            JOIN plataforma_lote plote ON pl.id_lote = plote.id_lote
            WHERE plote.id_plataforma = 8 AND p.estado <> 'entregado';
            ";
            $result = mysqli_query($this->conn, $query);
        }

        if (!$result) {
            die("Error al obtener informacion de los paquetes en plataforma: " . mysqli_error($this->conn));
        }

        $paquetes = [];

        while ($fila = mysqli_fetch_array($result)) {
            $paquetes[] = $fila;
        }

        return $paquetes;
    }

    public function informacionVehiculo()
    {
        $query = "SELECT v.matricula, v.estado, v.tipo, cv.id_usuario, u.nombre
        FROM vehiculo v
        LEFT JOIN camionero_vehiculo cv ON v.matricula = cv.matricula
        LEFT JOIN usuario u ON cv.id_usuario = u.id_usuario;
        ";
        $result = mysqli_query($this->conn, $query);

        if (!$result) {
            return false;
        }

        $vehiculos = [];

        while ($fila = mysqli_fetch_array($result)) {
            $vehiculos[] = $fila;
        }

        return $vehiculos;
    }

    public function recoleccionesActivas()
    {

        $query = "SELECT r.id_recoleccion, cl.nombre, rv.matricula, r.fecha_llegada, r.fecha_ida
        FROM recoleccion r
        JOIN cliente_recoleccion cr ON r.id_recoleccion = cr.id_recoleccion
        JOIN cliente cl ON cr.id_cliente = cl.id_cliente
        JOIN recoleccion_vehiculo rv ON r.id_recoleccion = rv.id_recoleccion
        WHERE r.fecha_llegada IS NULL;
        ";
        $result = mysqli_query($this->conn, $query);


        if (!$result) {
            die("Error al obtener informacion de las recolecciones activas: " . mysqli_error($this->conn));
        }

        $recolecciones = [];

        while ($fila = mysqli_fetch_array($result)) {
            $recolecciones[] = $fila;
        }

        return $recolecciones;
    }

    public function crearRecoleccion($id_cliente, $matricula)
    {
        $query = "INSERT INTO recoleccion (id_recoleccion, fecha_llegada, fecha_ida) VALUES (NULL, NULL, NULL);";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            return false;
        }

        $query = "SELECT MAX(id_recoleccion) AS highest_id_recoleccion FROM recoleccion;";
        $resultado = mysqli_query($this->conn, $query);

        if ($row = mysqli_fetch_assoc($resultado)) {
            $id_recoleccion = $row['highest_id_recoleccion'];
        } else {
            return false;
        }

        $query = "INSERT INTO `recoleccion_vehiculo`(`id_recoleccion`, `matricula`) VALUES ('$id_recoleccion','$matricula')";
        $resultado = mysqli_query($this->conn, $query);

        if (!$resultado) {
            return false;
        }

        $query = "INSERT INTO `cliente_recoleccion`(`id_recoleccion`, `id_cliente`) VALUES ('$id_recoleccion','$id_cliente')";
        $resultado = mysqli_query($this->conn, $query);

        if ($resultado) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
    }

    public function lotesSinEntregar()
    {

        $query = "SELECT l.*, pl.fecha_llegada, p.nombre
        FROM lote l
        JOIN plataforma_lote pl ON l.id_lote = pl.id_lote
        JOIN plataforma p ON pl.id_plataforma = p.id_plataforma
        WHERE l.estado <> 'entregado';
        ";
        $result = mysqli_query($this->conn, $query);


        if (!$result) {
            die("Error al obtener informacion de los lotes sin entregar: " . mysqli_error($this->conn));
        }

        $lotes = [];

        while ($fila = mysqli_fetch_array($result)) {
            $lotes[] = $fila;
        }

        return $lotes;
    }

    public function mostrarLotes()
    {

        $query = "SELECT l.*, pl.fecha_llegada, p.nombre
        FROM lote l
        JOIN plataforma_lote pl ON l.id_lote = pl.id_lote
        JOIN plataforma p ON pl.id_plataforma = p.id_plataforma;
        ";
        $result = mysqli_query($this->conn, $query);


        if (!$result) {
            die("Error al obtener informacion de los lotes: " . mysqli_error($this->conn));
        }

        $lotes = [];

        while ($fila = mysqli_fetch_array($result)) {
            $lotes[] = $fila;
        }

        return $lotes;
    }

    public function paquetesDeUnLote($id_lote)
    {
        $query = "SELECT p.*
        FROM paquete p
        JOIN paquete_lote pl ON p.id_paquete = pl.id_paquete
        WHERE pl.id_lote = $id_lote;
        ";
        $result = mysqli_query($this->conn, $query);


        if (!$result) {
            die("Error al obtener informacion de los paquetes de un lote: " . mysqli_error($this->conn));
        }

        $paquetes = [];

        while ($fila = mysqli_fetch_array($result)) {
            $paquetes[] = $fila['id_paquete'];
        }

        return $paquetes;
    }

    public function vehiculoDeUnLote($id_lote)
    {
        $query = "SELECT vp.matricula
        FROM vehiculo_plataforma_lote vp
        WHERE vp.id_lote = $id_lote;
        ";
        $result = mysqli_query($this->conn, $query);


        if (!$result) {
            die("Error al obtener vehiculo de un lote: " . mysqli_error($this->conn));
        }

        $camion = [];

        while ($fila = mysqli_fetch_array($result)) {
            $camion[] = $fila;
        }

        if (count($camion) > 0) {
            return $camion[0];
        } else {
            return "";
        }

    }

    public function plataformaLote($id_lote)
    {
        $query = "SELECT * FROM `plataforma_lote` WHERE id_lote = $id_lote;";
        $result = mysqli_query($this->conn, $query);


        if (!$result) {
            return '';
        }

        $camion = [];

        while ($fila = mysqli_fetch_array($result)) {
            $camion[] = $fila;
        }

        if (count($camion) > 0) {
            return $camion[0];
        } else {
            return "";
        }

    }

    public function crearLote($id_plataforma)
    {
        $query = "INSERT INTO `lote`(`id_lote`, `estado`, `fecha_cierre`, `fecha_abierto`) VALUES (NULL,'abierto',NULL,CURRENT_TIMESTAMP)";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            die("error 1 en crear lote" . mysqli_error($this->conn));
        }

        $query = "SELECT MAX(id_lote) AS highest_id_lote FROM lote;";
        $resultado = mysqli_query($this->conn, $query);

        if ($row = mysqli_fetch_assoc($resultado)) {
            $id_lote = $row['highest_id_lote'];
        } else {
            die('error 2 en crear lote' . mysqli_error($this->conn));
        }

        $query = "INSERT INTO `plataforma_lote`(`id_lote`, `id_plataforma`, `fecha_llegada`) VALUES ($id_lote,$id_plataforma,NULL)";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            die("error 3 en crear lote" . mysqli_error($this->conn));
        }

        if ($resultado) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
    }

    public function asignarVehiculoALote($id_lote)
    {
        $query = "INSERT INTO `lote`(`id_lote`, `estado`, `fecha_cierre`, `fecha_abierto`) VALUES (NULL,'abierto',NULL,CURRENT_TIMESTAMP)";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            die("error 1 en crear lote" . mysqli_error($this->conn));
        }

        if ($resultado) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
    }

    public function asignarPaqueteALote($id_lote, $id_paquete)
    {
        $query = "INSERT INTO `paquete_lote`(`id_paquete`, `id_lote`) VALUES ($id_paquete,$id_lote)";
        $resultado = mysqli_query($this->conn, $query);

        if ($resultado) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
    }

    public function cerrarLote($id_lote)
    {
        $query = "UPDATE `lote` SET `estado`='cerrado',`fecha_cierre`=CURRENT_TIMESTAMP WHERE id_lote = $id_lote";
        $resultado = mysqli_query($this->conn, $query);

        if ($resultado) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
    }

    public function entregasActivas()
    {

        $query = "SELECT r.*, rv.*
        FROM recorrido r
        JOIN recorrido_vehiculo rv ON r.id_recorrido = rv.id_recorrido
        WHERE r.estado <> 'finalizado';
        ";
        $result = mysqli_query($this->conn, $query);


        if (!$result) {
            die("Error al obtener informacion de las entregas activas: " . mysqli_error($this->conn));
        }

        $entregas = [];

        while ($fila = mysqli_fetch_array($result)) {
            $entregas[] = $fila;
        }

        return $entregas;
    }

    public function mostrarEntregas()
    {

        $query = "SELECT r.*, rv.*
        FROM recorrido r
        JOIN recorrido_vehiculo rv ON r.id_recorrido = rv.id_recorrido
        ORDER BY r.id_recorrido DESC;
        ";
        $result = mysqli_query($this->conn, $query);


        if (!$result) {
            die("Error al obtener informacion de las entregas: " . mysqli_error($this->conn));
        }

        $entregas = [];

        while ($fila = mysqli_fetch_array($result)) {
            $entregas[] = $fila;
        }

        return $entregas;
    }

    public function paquetesDeUnRecorrido($id_recorrido)
    {
        $query = "SELECT p.*
        FROM paquete p
        JOIN paquete_recorrido pr ON p.id_paquete = pr.id_paquete
        WHERE pr.id_recorrido = $id_recorrido;
        ;
        ";
        $result = mysqli_query($this->conn, $query);


        if (!$result) {
            die("Error al obtener informacion de los paquetes de un recorrido: " . mysqli_error($this->conn));
        }

        $paquetes = [];

        while ($fila = mysqli_fetch_array($result)) {
            $paquetes[] = $fila['id_paquete'];
        }

        return $paquetes;
    }

    public function crearEntrega($matricula)
    {
        $query = "INSERT INTO `recorrido`(`id_recorrido`, `estado`, `fecha_inicio`) VALUES (NULL,'no comenzado',NULL)";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            die("error 1 en crear entrega" . mysqli_error($this->conn));
        }

        $query = "SELECT MAX(id_recorrido) AS highest_id_recorrido FROM recorrido;";
        $resultado = mysqli_query($this->conn, $query);

        if ($row = mysqli_fetch_assoc($resultado)) {
            $id_recorrido = $row['highest_id_recorrido'];
        } else {
            die('error 2 en crear recorrido' . mysqli_error($this->conn));
        }

        $query = "INSERT INTO `recorrido_vehiculo`(`id_recorrido`, `matricula`) VALUES ($id_recorrido,'$matricula')";
        $resultado = mysqli_query($this->conn, $query);
        if (!$resultado) {
            die("error 3 en crear recorrido" . mysqli_error($this->conn));
        }

        if ($resultado) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
    }

    public function asignarPaqueteAEntrega($id_paquete, $id_recorrido)
    {
        $query = "INSERT INTO `paquete_recorrido`(`id_paquete`, `id_recorrido`) VALUES ($id_paquete,$id_recorrido)";
        $resultado = mysqli_query($this->conn, $query);

        if ($resultado) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
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

    public function mostrarPaquetes()
    {


        $query = "SELECT * FROM paquete ORDER BY id_paquete DESC;";
        $result = mysqli_query($this->conn, $query);


        if (!$result) {
            die("Error al obtener informacion de los paquetes: " . mysqli_error($this->conn));
        }

        $paquetes = [];

        while ($fila = mysqli_fetch_array($result)) {
            $paquetes[] = $fila;
        }

        return $paquetes;
    }

    public function mostrarRecolecciones()
    {
        $query = "SELECT r.id_recoleccion, cl.nombre, rv.matricula, r.fecha_llegada, r.fecha_ida
        FROM recoleccion r
        JOIN cliente_recoleccion cr ON r.id_recoleccion = cr.id_recoleccion
        JOIN cliente cl ON cr.id_cliente = cl.id_cliente
        JOIN recoleccion_vehiculo rv ON r.id_recoleccion = rv.id_recoleccion
        ORDER BY id_recoleccion DESC;
        ";
        $result = mysqli_query($this->conn, $query);


        if (!$result) {
            die("Error al obtener informacion de las recolecciones: " . mysqli_error($this->conn));
        }

        $recolecciones = [];

        while ($fila = mysqli_fetch_array($result)) {
            $recolecciones[] = $fila;
        }

        return $recolecciones;
    }

    public function mostrarClientes()
    {


        $query = "SELECT * FROM cliente";
        $result = mysqli_query($this->conn, $query);


        if (!$result) {
            die("Error al obtener informacion de los clientes: " . mysqli_error($this->conn));
        }

        $clientes = [];

        while ($fila = mysqli_fetch_array($result)) {
            $clientes[] = $fila;
        }

        return $clientes;
    }

    public function mostrarVehiculo()
    {
        $query = "SELECT * FROM vehiculo";
        $result = mysqli_query($this->conn, $query);


        if (!$result) {
            die("Error al obtener informacion de los vehiculos: " . mysqli_error($this->conn));
        }

        $vehiculos = [];

        while ($fila = mysqli_fetch_array($result)) {
            $vehiculos[] = $fila;
        }

        return $vehiculos;
    }

    public function mostrarPlataforma()
    {


        $query = "SELECT *
        FROM plataforma
        JOIN plataforma_linea ON plataforma.id_plataforma = plataforma_linea.id_plataforma
        ORDER BY plataforma_linea.id_linea;";
        $result = mysqli_query($this->conn, $query);


        if (!$result) {
            return '';
        }

        $plataformas = [];

        while ($fila = mysqli_fetch_array($result)) {
            $plataformas[] = $fila;
        }

        return $plataformas;
    }

    public function mostrarUnaPlataforma($id_plataforma)
    {
        $query = "SELECT *
        FROM plataforma
        WHERE id_plataforma = $id_plataforma ";
        $result = mysqli_query($this->conn, $query);


        if (!$result) {
            return '';
        }

        $plataformas = [];

        while ($fila = mysqli_fetch_array($result)) {
            $plataformas[] = $fila;
        }

        return $plataformas[0];
    }

    public function paquetesEntregas($id_plataforma)
    {

        if ($id_plataforma == '1') { // Si la plataforma es montevideo se comporta diferente
            $query = "SELECT * FROM paquete WHERE estado = 'en plataforma destino';
            ";
            $result = mysqli_query($this->conn, $query);
        } else {
            $query = "SELECT p.*
            FROM paquete p
            JOIN paquete_lote pl ON p.id_paquete = pl.id_paquete
            JOIN plataforma_lote plote ON pl.id_lote = plote.id_lote
            WHERE plote.id_plataforma = 8 AND p.estado <> 'entregado';
            ";
            $result = mysqli_query($this->conn, $query);
        }

        if (!$result) {
            die("Error al obtener informacion de los paquetes en plataforma: " . mysqli_error($this->conn));
        }

        $paquetes = [];

        while ($fila = mysqli_fetch_array($result)) {
            $paquetes[] = $fila;
        }

        return $paquetes;
    }

    public function desasignarCamionero($id_usuario, $matricula)
    {
        $query = "SELECT estado
        FROM vehiculo
        WHERE matricula = '$matricula';";
        $resultado = mysqli_query($this->conn, $query);

        $fila = mysqli_fetch_assoc($resultado);
        if ($fila['estado'] === 'con conductor') {
            $query = "UPDATE vehiculo
            SET estado = 'sin conductor'
            WHERE matricula = '$matricula';";
            $resultado = mysqli_query($this->conn, $query);

            $query = "UPDATE camionero
            SET estado = 'disponible'
            WHERE id_usuario = $id_usuario;";
            $resultado = mysqli_query($this->conn, $query);

            $query = "DELETE FROM camionero_vehiculo
            WHERE id_usuario = $id_usuario AND matricula = '$matricula';
            ";
            $resultado = mysqli_query($this->conn, $query);
        } else {
            return false;
        }




        if ($resultado) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
    }

    public function informacionCamioneroSinCamion()
    {
        $query = "SELECT u.id_usuario, u.nombre, u.cargo, c.estado
        FROM usuario u
        LEFT JOIN camionero c ON u.id_usuario = c.id_usuario
        LEFT JOIN camionero_vehiculo cv ON c.id_usuario = cv.id_usuario
        WHERE cv.id_usuario IS NULL AND u.cargo = 'camionero';
        ";
        $result = mysqli_query($this->conn, $query);

        if (!$result) {
            return false;
        }

        $usuarios = [];

        while ($fila = mysqli_fetch_array($result)) {
            $usuarios[] = $fila;
        }

        return $usuarios;
    }

    public function asignarCamionero($id_usuario, $matricula)
    {

        $query = "UPDATE vehiculo
            SET estado = 'con conductor'
            WHERE matricula = '$matricula';";
        $resultado = mysqli_query($this->conn, $query);

        $query = "UPDATE camionero
            SET estado = 'disponible'
            WHERE id_usuario = $id_usuario;";
        $resultado = mysqli_query($this->conn, $query);

        $query = "INSERT INTO `camionero_vehiculo`(`id_usuario`, `matricula`) VALUES ($id_usuario,'$matricula')";
        $resultado = mysqli_query($this->conn, $query);

        if ($resultado) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
    }

    public function registrarCamion($matricula, $tipo)
    {
        $query = "INSERT INTO `vehiculo`(`matricula`, `estado`, `tipo`) VALUES ('$matricula','sin conductor','$tipo')";
        $resultado = mysqli_query($this->conn, $query);

        if ($resultado) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
    }
}
?>