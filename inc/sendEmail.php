<?php

$to = 'mor-nia@hotmail.com';

function url(){
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
  );
}

if($_GET) {

   $name = trim(stripslashes($_POST['cName']));
   $email = trim(stripslashes($_POST['cEmail']));
   $subject = trim(stripslashes($_POST['cSubject']));
   $contact_message = trim(stripslashes($_POST['cMessage']));


	if ($subject == '') { $subject = "Envío de formulario de contacto"; }

   // Set Message
   $message .= "Correo de: " . $name . "<br />";
   $message .= "Direccion de correo: " . $email . "<br />";
   $message .= "Mensaje: <br />";
   $message .= nl2br($contact_message);
   $message .= "<br /> ----- <br /> Este correo fue enviado desde tu sitio web: " . url() . " <br />";

   // Set From: header
   $from =  $name . " <" . $email . ">";

   // Email Headers
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

   ini_set("sendmail_from", $to); // for windows server
   $mail = mail($to, $subject, $message, $headers);

	if ($mail) { echo "OK"; }
   else { echo "Algo ha ido mal, vuelva a intentarlo de nuevo"; }

}

?>