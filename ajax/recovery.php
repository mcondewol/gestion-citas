<?php 

// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);


include '../DB/conf.php';
include '../ajax/random_string.php';
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
// require_once "../recaptcha/php/recaptchalib.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


try {
    if (!empty($_POST)) {
        // if (!isset($_POST['g-recaptcha-response']) && !isset($_POST['email'])) {
        //     echo json_encode(array(
        //         "status" => 400,
        //         "msg" => "Faltan parametros"
        //     ));
        // }else{
        // $recaptcha = $_POST["g-recaptcha-response"];
        // $recaptcha_secret_key = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';//local
        // $recaptcha_secret_key = '6LeRalEaAAAAACkiAj5clYmGu08-Ru5pDMKO7HFr';//dev
            // $reCaptcha = new ReCaptcha($recaptcha_secret_key);
            // $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $recaptcha);
            // if ($response != null && $response->success) {
        $email = $_POST["email"];
        $query = "SELECT * FROM usuarios WHERE correo = :correo;";
        $stmt = $dbhost->prepare($query);
        $stmt->bindParam(':correo', $email);
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $key_request = $keyPHP.$ivPHP;
                $queryInsert = "INSERT INTO password_recovery(id, key_request, id_usuario, fecha_ing, fecha_mod, estado) 
                                VALUES(null, '{$key_request}', {$row["id"]}, now(), now(), 1);";
                $stmtInsert = $dbhost->prepare($queryInsert);
                if($stmtInsert->execute()){
                    $mail = new PHPMailer(true);
                    //Server settings
                    $mail->Host = 'smtp.gmail.com';
                    $mail->isSMTP();
                    $mail->CharSet = "UTF-8";
                    $mail->Port = 587;
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    // $mail->SMTPSecure = "SSL";
                    // $mail->SMTPSecure = 'tls';
                    $mail->SMTPAuth   = true;
                    $mail->Username = "support@wolvisor.com";
                    $mail->Password = "ikczzbqbjxlhmpau";
                    //Recipients
                    $mail->setFrom('support@wolvisor.com', 'SNACKS YUMMIES');
                    // $mail->addAddress("jquinonez@wol.group");
                    $mail->addAddress($row["correo"]);
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Recuperacion de contraseña';
                    $mail->Body    = "Has solicitado una recuperacion de contraseña para el sitio de Zambospic <br>
                                        Ingresa al siguiente link para ingresar la nueva contraseña <a href='https://zambos.com/zambospic/password?id_request={$key_request}'>Link</a>";

                    try {
                        $mail->send();
                        echo json_encode(array(
                            "status" => 200,
                            "msg" => "Se ha enviado un correo con tus credenciales para ingresar al sitio de Zambospic, si no aparece en la bandeja de entrada revisa la de spam."
                        ));
                    } catch (Exception $e) {
                        echo json_encode(array(
                            "status" => 400,
                            "msg" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
                        ));
                    }                            
                }else{
                    echo json_encode(array(
                        "status" => 400,
                        "msg" => $dbhost->errorInfo()
                    ));
                }
            }else{
                echo json_encode(array(
                    "status" => 400,
                    "msg" => "Correo no registrado"
                ));
            }
        }else{
            echo json_encode(array(
                "status" => 400,
                "msg" => "Error"
            ));
        }
            // }else{
            //     echo json_encode(array(
            //         "status" => 400,
            //         "msg" => "Captcha Invalido"
            //     ));
            // }
        // }
    }else{
        echo json_encode(array(
            "status" => 400,
            "msg" => "No hay parametros"
        ));
    }
} catch (Exception $e) {
    echo json_encode(array(
        "status" => 400,
        "msg" => $e
    ));
}


?>