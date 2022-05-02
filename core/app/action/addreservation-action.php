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

$rx = ReservationData::getRepeated($_POST["pacient_id"],$_POST["medic_id"],$_POST["date_at"],$_POST["time_at"]);
if($rx==null){
    $timestamp = strtotime($date); 
    $newDate = date("d-m-Y", $timestamp );
    $newTime = date('H:i A', strtotime($time));

$r = new ReservationData();
$r->title = $_POST["title"];
$r->note = $_POST["note"];
$r->pacient_id = $_POST["pacient_id"];
$pacient = PacientData::getById($_POST["pacient_id"]);
$r->medic_id = $_POST["medic_id"];
$r->date_at = $_POST["date_at"];
$r->time_at = $_POST["time_at"];
$r->user_id = $_SESSION["user_id"];

$r->status_id = $_POST["status_id"];
$r->payment_id = $_POST["payment_id"];
$r->price = $_POST["price"];
$r->sick = $_POST["sick"];
$r->symtoms = $_POST["symtoms"];
$r->medicaments = $_POST["medicaments"];
$userEmail = $pacient->email;
$pacientName = $pacient->name;
$pacientLastName = $pacient->lastname;


$r->add();

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
    $mail->addAddress($userEmail, '');
    
    // Setting the email content
    $mail->IsHTML(true);

    // Server settings
            
    $subject = "Actualización de cita";
    $subject = utf8_decode($subject);
    $mail->Subject = $subject;
    $mail->Body = 'Hola '. $pacientName.' '.$pacientLastName . ', <br> Tu cita para el día '. $newDate. ' en el horario de ' .$newTime. ' se agendo de forma exitosa. <br><br> Saludos,';

    if($mail->send()){
        echo "email enviado";
    }else{
        echo "no se envio";
    }

Core::alert("Agregado exitosamente!");
}else{
Core::alert("Error al agregar, Cita Repetida!");
}
Core::redir("./index.php?view=reservations");
?>