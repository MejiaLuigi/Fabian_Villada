<?php
if($_SERVER['REQUEST_METHOD'] != 'POST' ){
    header("Location: index.html" );
    exit;
}

require 'phpmailer/PHPMailer.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];
$telefono = $_POST['telefono']; 



// Validación del nombre
if (preg_match('/[^\p{L}\s]+/u', $nombre)) {
    echo "El campo de nombre no puede contener caracteres especiales.";
    exit;
}

// Validación del email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "El campo de email debe ser una dirección de correo electrónico válida.";
    exit;
}

// Validación del teléfono
if (preg_match('/[^0-9]+/', $telefono)) {
    echo "El campo de teléfono solo puede contener números.";
    exit;
}



$body = <<<HTML
    <h1>Contacto desde la web</h1>
    <p>De: $nombre  / $email</p>
    <p>telefono: $telefono</p>
    <h2>Mensaje</h2>
    $mensaje
HTML;

$mailer = new PHPMailer();
$mailer->setFrom( $email, "$nombre " );
$mailer->addAddress('info@fabianvillada.com','Sitio web');
$mailer->Subject = "Mensaje web: $asunto";
$mailer->msgHTML($body);
$mailer->AltBody = strip_tags($body);
$mailer->CharSet = 'UTF-8';



$rta = $mailer->send( );

if (!$mailer->send()) {
    echo "Error al enviar el correo electrónico. Por favor, inténtalo de nuevo más tarde.";
    exit;
}
//var_dump($rta);
header("Location: index.html" );
exit;
?>