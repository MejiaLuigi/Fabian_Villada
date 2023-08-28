<?php
if($_SERVER['REQUEST_METHOD'] != 'POST' ){
    header("Location: index.html" );
}

require 'phpmailer/PHPMailer.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];
$telefono = $_POST['telefono']; 

if( empty(trim($nombre)) ) $nombre = '';
if( empty(trim($email)) ) $email = '';
if( empty(trim($telefono)) ) $telefono = '';
if( empty(trim($mensaje)) ) $mensaje = '';

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

//var_dump($rta);
header("Location: index.html" );