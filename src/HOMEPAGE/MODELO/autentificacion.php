<?php
session_start();
require('../../db.php');

if (isset($_GET['data'])) {
    $json = $_GET['data'];
    $objetoDecodificado = json_decode($json);

    if ($objetoDecodificado) {
        $query = "SELECT id_usuario, nombre, cargo FROM usuario";
        $query2 = "SELECT id_usuario, contrasenha FROM login";

        // Ejecutar la consulta 1
        $result1 = mysqli_query($conn, $query);

        if (!$result1) {
            die("Error en la consulta 1: " . mysqli_error($conn));
        }

        // Ejecutar la consulta 2 una vez antes de entrar en el bucle
        $result2 = mysqli_query($conn, $query2);

        if (!$result2) {
            die("Error en la consulta 2: " . mysqli_error($conn));
        }

        // Variable para rastrear si se encontró un usuario
        $encontrado = false;

        // Iterar a través de los resultados de query1
        while ($row1 = mysqli_fetch_assoc($result1)) {
            $idUsuarioQuery1 = $row1['id_usuario'];

            // Iterar a través de los resultados de query2
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $idUsuarioQuery2 = $row2['id_usuario'];
                $clave = $row2['contrasenha'];

                if ($idUsuarioQuery1 == $idUsuarioQuery2) {
                    if (isset($objetoDecodificado->numeroFuncionario) && $objetoDecodificado->numeroFuncionario == $idUsuarioQuery1 && $objetoDecodificado->clave == $clave){
                        $puesto = $row1['cargo'];
                        switch ($puesto) {
                            case 'funcionario':
                                header('Location: ../../ALMACENERO/VISTA/almacenero.html');
                                exit();
                            case 'camionero':
                                header('Location: ../../CAMIONERO/VISTA/camionero.html');
                                exit();
                            case 'administrador':
                                header('Location: ../../BACKOFFICE/VISTA/backoffice.html');
                                exit();
                            default:
                                $_SESSION['error'] = 'Error al iniciar sesión, usuario o contraseña incorrectos...';
                                header("Location: ../VISTA/inicioSesion.php");
                                exit();
                        }
                    } else {
                        $_SESSION['error'] = 'Error al iniciar sesión, usuario o contraseña incorrectos...';
                                header("Location: ../VISTA/inicioSesion.php");
                    }

                    $encontrado = true;
                    break; // Salir del bucle interno
                }
            }
            mysqli_data_seek($result2, 0); // Reiniciar el puntero de resultados de query2
        }

        if (!$encontrado) {
            $_SESSION['error'] = 'Error al iniciar sesión, usuario o contraseña incorrectos...';
            header("Location: ../VISTA/inicioSesion.php");
            exit();
        }

        // Cerrar las conexiones a la base de datos
        mysqli_close($conn);
    } else {
        echo "Error al recibir archivo JSON";
    }
} else {
    echo "Falta el parámetro 'data' en la URL";
}
?>

