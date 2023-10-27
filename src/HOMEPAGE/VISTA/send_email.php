<?php
if(isset($_POST['email'])) {
    $email_to = "genaro.amaral100@gmail.com";
    $email_subject = "quick carry consulta cliente pagina";

    $name = $_POST['name'];
    $email_from = $_POST['email'];
    $message = $_POST['message'];

    $email_message = "Detalles del formulario de contacto:\n\n";
    $email_message .= "Nombre: " . $name . "\n";
    $email_message .= "Correo: " . $email_from . "\n";
    $email_message .= "Mensaje: " . $message . "\n";

    // create email headers
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);

    header("Location: index.php");
}
?>
