<?php
if($_SERVER['REQUEST_METHOD'] != 'POST' ){
    header("Location: index.html" );
}

/*
if( ! isset( $_POST['nombre'] ) ){
    header("Location: index.html" );
}
*/


$nombre = $_POST['nombre'];
$telefono = $_POST['telefono']
$email = $_POST['email'];

$mensaje = $_POST['mensaje'];

if( empty(trim($nombre)) ) $nombre = 'nombre';
if( empty(trim($email)) ) $email = 'email';
if( empty(trim($telefono)) ) $telefono = 'telefono';
if( empty(trim($mensaje)) ) $mensaje = 'mensaje';
$body = <<<HTML
    <h1>Contacto desde la web</h1>
    <p>De: $nombre  / $email</p>
    <p>telefono: $telefono</p>
    <h2>Mensaje</h2>
    $mensaje
HTML;

//sintaxis de los emails email@algo.com || 
// nombre <email@algo.com>

$headers = "MIME-Version: 1.0 \r\n";
$headers.= "Content-type: text/html; charset=utf-8 \r\n";
$headers.= "From: $nombre $apellido <$email> \r\n";
$headers.= "To: Sitio web <info@fabianvillada.com> \r\n";
// $headers.= "Cc: copia@email.com \r\n";
// $headers.= "Bcc: copia-oculta@email.com \r\n";


//REMITENTE (NOMBRE/APELLIDO - EMAIL)
//ASUNTO 
//CUERPO 
$rta = mail('info@fabianvillada.com', "Mensaje web: $asunto", $body, $headers );
//var_dump($rta);

header("Location: index.html" );