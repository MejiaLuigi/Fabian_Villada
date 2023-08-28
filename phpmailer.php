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
    echo <script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: 'El campo de nombre no puede contener caracteres especiales.'
    });
</script>;
    exit;
}

if (preg_match('/[=¡!@#$%^&*()\-_+|<>?]/', $mensaje)) {
    echo <script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: 'El campo de texto no puede contener caracteres especiales.'
    });
</script>;
    exit;
}

// Validación del email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo <script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: 'El campo de email debe ser una dirección de correo electrónico válida.'
    });
</script>;
    exit;
}

// Validación del teléfono
if (preg_match('/[^0-9]+/', $telefono)) {
    echo <script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: 'El campo de teléfono solo puede contener números.'
    });
</script>;
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
    echo <script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: 'Error al enviar el correo electrónico. Por favor, inténtalo de nuevo más tarde.'
    }).then(() => {
        window.location.href = 'index.html';
    });
    </script>;
} else {
    echo <script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'El mensaje se envió correctamente.'
    }).then(() => {
        window.location.href = 'index.html';
    });
    </script>;
    exit;
}
?>