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
    $pacient = PacientData::getById($user->pacient_id);
    $pacient_email = $pacient->email;
    $user->del();
    $mail->CharSet = 'UTF-8';
	
		try {
            
             // Server settings
             $mail->isSMTP();
             $mail->Host = 'mail.aprofam.net';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->Username = 'servicioalcliente@aprofam.net'; // YOUR gmail email
            $mail->Password = 'Aprofam2022*'; // YOUR gmail password

            // Sender and recipient settings
            $mail->setFrom('servicioalcliente@aprofam.net', 'Aprofam');
             $mail->addAddress($pacient_email, '');
             // Setting the email content
             $mail->IsHTML(true);
             $subject = "Cancelación de cita";
             $subject = utf8_decode($subject);
             $mail->Subject = $subject;

             $mail->Subject = "Cancelación de Cita";
             $mail->Body = 'Su cita ha sido cancelada';
         
             if($mail->send()){
                 $sended = true;
             }else{
                $sended = false;
             }
            
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
	

	
Core::alert("Eliminado exitosamente!");
print "<script>window.location='index.php?view=reservations';</script>";






 
print "<script>window.location='index.php?view=reservations';</script>";

?>