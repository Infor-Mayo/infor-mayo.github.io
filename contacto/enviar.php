<?php
if(isset($_POST['enviar'])) {
    // Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
    $email_to = "marioartola811@gmail.com";
    $email_subject = "Mensaje desde tu sitio web";

    // Aquí se toman los valores del formulario
    $nombre = $_POST['nombre']; // requerido
    $email_from = $_POST['email']; // requerido
    $telefono = $_POST['telefono']; // no requerido 
    $mensaje = $_POST['mensaje']; // requerido

    $email_message = "Detalles del formulario de contacto:\n\n";
    $email_message .= "Nombre: ".$nombre."\n";
    $email_message .= "Email: ".$email_from."\n";
    $email_message .= "Teléfono: ".$telefono."\n";
    $email_message .= "Mensaje: ".$mensaje."\n\n";


    // Ahora se envía el correo electrónico usando la función mail() de PHP
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();

    @mail($email_to, $email_subject, $email_message, $headers);

    // se muestra un mensaje de éxito al usuario en la página de gracias.
    header("Location: gracias.html");
}
?>
