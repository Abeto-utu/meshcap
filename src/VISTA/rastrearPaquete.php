<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Carry</title>
    <link rel="stylesheet" href="../CSS/stlyesRastreoPaquete.css">
</head>
<body>
    <header>
    <nav class="navbar">
        <div class="navbar-icon">
          <a href="index.html"><img src="../IMAGES/logo.png" alt="Icono"></a>
        </div>
        <div class="navbar-buttons">
          <a href="../VISTA/index.html"><input type="button" value="Inicio" id="inicio"></a>
          <a href="../VISTA/inicioSesion.php"><input type="button" value="Mesh cap"></a>
          <a href="../VISTA/rastrearPaquete.php"><input type="button" value="Rastrear paquete"></a>
          <a href="../VISTA/sobreNosotros.html"><input type="button" value="Sobre nosotros"></a>
          <a href="../VISTA/preguntasFrecuentes.html"><input type="button" value="Preguntas frecuentes"></a>
          <a href="../VISTA/contacto.html"><input type="button" value="Contacto"></a>
        </div>
      </nav>
    </header>

    <div class="container_total">
      <div>
        <h1>Rastreo Paquete</h1>
      </div>
      <form action="../CONTROLADOR/consultaEstadoPaquete.php" method="POST">

          <label for="numero_paquete">N° Paquete
            <input type="number" name="numero_paquete" id="numero_paquete" placeholder="Numero del paquete..." required>
          </label>
        
          <input type="submit" value="Rastrear" name="rastreo">
      </form>
      <hr>
      <?php
        session_start();

        if(isset($_SESSION['resultado_paquete'])) {
            $resultado_paquete = $_SESSION['resultado_paquete'];?> 
            <p> <?php echo "Numero del Paquete: " . $resultado_paquete['ID_PAQUETE']?></p>
            <p> <?php echo "Estado del Paquete: " . $resultado_paquete['estado']?></p>
            <p> <?php echo "Hora Estimada: " . $resultado_paquete['estado']?></p>
            
      <?php unset($_SESSION['resultado_paquete']);

        } else {
          ?><p class ="error"> <?php echo "No se encontraron resultados para el número de paquete proporcionado.";?></p>
      <?php } ?>
    </div>
</body>
</html>