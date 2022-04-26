<?php
/**
* BookMedik
* @author evilnapsis
**/
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../../vendor/phpmailer/phpmailer/src/Exception.php';
require_once __DIR__ . '/../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../../../vendor/phpmailer/phpmailer/src/SMTP.php';
include "../../autoload.php";
include '../model/ReservationData.php'; 
include '../model/PacientData.php';

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);


	$user = ReservationData::getById($_GET["id"]);
    $user->del();
    $mail->CharSet = 'UTF-8';
	
		try {
            
             // Server settings
             $mail->isSMTP();
             $mail->Host = 'smtp.gmail.com';
             $mail->SMTPAuth = true;
             $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
             $mail->Port = 587;
         
             $mail->Username = 'support@wolvisor.com'; // YOUR gmail email
             //$mail->Password = 'zhikcngxixagwwri'; // YOUR gmail password
             $mail->Password = 'lmceoebvcleisjdx'; // YOUR gmail password
         
             // Sender and recipient settings
             $mail->setFrom('support@wolvisor.com', 'Aprofam');
             $mail->addAddress('mrcou.994@gmail.com', '');
             //setting headers
             // Setting the email content
             $mail->IsHTML(true);
             $subject = "Cancelación de cita";
             $subject = utf8_decode($subject);
             $mail->Subject = $subject;

             $mail->Subject = "Cancelación de Cita";
             $mail->Body = 'Esto es una prueba desde gestion de citas';
         
             if($mail->send()){
                 echo "email enviado";
             }else{
                 echo "no se envio";
             }
            
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
	

	
Core::alert("Eliminado exitosamente!");
print "<script>window.location='index.php?view=reservations';</script>";






 
print "<script>window.location='index.php?view=reservations';</script>";

?>