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

$date = $_POST["date_at"];
$time = $_POST["time_at"];

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
if(count($_POST)>0){

    $timestamp = strtotime($date); 
    $newDate = date("d-m-Y", $timestamp );
    $newTime = date('H:i A', strtotime($time));

	$user = ReservationData::getById($_POST["id"]);
	$user->title = $_POST["title"];
	$user->pacient_id = $_POST["pacient_id"];
    $pacient = PacientData::getById($_POST["pacient_id"]);
	$user->medic_id = $_POST["medic_id"];
	$user->date_at = $_POST["date_at"];
	$user->time_at = $_POST["time_at"]; 
	$user->note = $_POST["note"];

	$user->status_id = $_POST["status_id"];
	$user->payment_id = $_POST["payment_id"];
	$user->price = $_POST["price"];
	$user->sick = $_POST["sick"];
	$user->symtoms = $_POST["symtoms"];
	$user->medicaments = $_POST["medicaments"];
    //$userEmail = $_POST["email"];

    $userEmail = $pacient->email;
    $pacientName = $pacient->name;
    $pacientLastName = $pacient->lastname;

	$user->update();
    $mail->isSMTP();
    $mail->Host = 'mail.aprofam.net';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = 'servicioalcliente@aprofam.net'; // YOUR gmail email
    $mail->Password = 'Aprofam2022*'; // YOUR gmail password

    // Sender and recipient settings
    $mail->setFrom('servicioalcliente@aprofam.net', 'Aprofam');
    $mail->addAddress($userEmail, '');
    
    // Setting the email content
    $mail->IsHTML(true);

	if ($_POST["status_id"] == 4) {
		try {
            
             // Server settings
            
             $subject = "Cancelación de cita";
             $subject = utf8_decode($subject);
             $mail->Subject = $subject;
             $mail->Body = 'Hola '. $pacientName.' '.$pacientLastName . ', <br> Tu cita para el día '. $newDate. ' en el horario de ' .$newTime. ' se cancelo de forma exitosa. <br><br> Saludos,';

             if($mail->send()){
                $sended = true;
             }else{
                $sended = false;
             }
            
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
	}else if($_POST["status_id"] == 1){
        try {
            
            // Server settings
           
            $subject = "Actualización de cita";
            $subject = utf8_decode($subject);
            $mail->Subject = $subject;
            $mail->Body = 'Hola '. $pacientName.' '.$pacientLastName . ', <br> Tu cita para el día '. $newDate. ' en el horario de ' .$newTime. ' se agendo de forma exitosa. <br><br> Saludos,';

            if($mail->send()){
                $sended = true;
            }else{
                $sended = false;
            }
           
       } catch (Exception $e) {
           echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
       }
    }

	
Core::alert("Actualizado exitosamente!");
print "<script>window.location='index.php?view=reservations';</script>";


}


?>
