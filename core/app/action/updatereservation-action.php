<?php
/**
* BookMedik
* @author evilnapsis
* @url http://evilnapsis.com/about/
**/

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
            $mail->Password = 'elqbtqgcaicnnzsz'; // YOUR gmail password
        
            // Sender and recipient settings
            $mail->setFrom('support@wolvisor.com', 'Aprofam');
            $mail->addAddress($pacient->email, '');
            
            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = "Cita Cancelada";
            $mail->Body = 'Hola '. $pacient->name . ', <br> Tu cita el día '. $_POST["date_at"]. 'A sido cancelada. <br><br> Saludos,';
        
            $mail->send();
            
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
	}

	
Core::alert("Actualizado exitosamente!");
print "<script>window.location='index.php?view=reservations';</script>";


}


?>
