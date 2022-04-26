<?php
/**
* BookMedik
* @author evilnapsis
* @url http://evilnapsis.com/about/
**/

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

require_once __DIR__ . '/../../../vendor/phpmailer/phpmailer/src/Exception.php';
require_once __DIR__ . '/../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../../../vendor/phpmailer/phpmailer/src/SMTP.php';
include "../../autoload.php";
include '../model/ReservationData.php'; 
include '../model/PacientData.php';


if(count($_POST)>0){
	$user = ReservationData::getById($_POST["id"]);
	$user->title = $_POST["title"];
	$user->pacient_id = $_POST["pacient_id"];
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

	$user->update();

	if ($_POST["status_id"] == 4) {
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
            
            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = "Nueva Cita";
            $mail->Body = 'Hola '. $_SESSION['username'].' '.$_SESSION['lastname'] . ', <br> Tu cita para el día '. $datet[0]. ' en el horario de ' .$datet[1]. ' se agendo de forma exitosa. <br><br> Saludos,';
        
            if($mail->send()){
                echo "email enviado";
            }else{
                echo "no se envio";
            }
            
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
	}

	
Core::alert("Actualizado exitosamente!");
print "<script>window.location='index.php?view=reservations';</script>";


}


?>
