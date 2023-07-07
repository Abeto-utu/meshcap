<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesion</title>
    <link rel="stylesheet" href="../CSS/StylesInicioSesion.css">
</head>
<body>
    <div class="container_image">
        <img src="../IMAGES/perfil_image.png" alt="Imagen de inicio de sesion de usuario">
    </div>
    <div class="container_total">
        <div><h1>Inciar Sesion</h1></div>
        <form action="recibirDatos.php" method="POST">
            <div>
                <input type="number" placeholder="N° funcionario..." name="numero_funcionario" min ="1000000000" max="9999999999" required>
            </div>
            <div>
                <input type="password" placeholder="Contraseña..." name="clave" maxlength="16" minlength="6" required>
            </div>
            <div>
                <input type="submit" value="Iniciar">
            </div>
            <div class="container_error">
                <?php
                    if(isset($_SESSION['error'])){
                ?>     <p><?php echo $_SESSION['error'];?></p>
                <?php session_unset(); } ?>
            </div>
        </form>
    </div>
</body>
</html>