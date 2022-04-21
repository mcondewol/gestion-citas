<?php 
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header('Content-Type: text/html; charset=utf-8');
//$stmt->rowCount()
//$rowPermisos = $stmtPermisos->fetch(PDO::FETCH_ASSOC);
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include '../DB/conf.php';
include '../ajax/random_string.php';
;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(array_key_exists("name", $_POST) && array_key_exists("last_name",$_POST) && array_key_exists("dpi",$_POST) && array_key_exists("phone",$_POST) && 
array_key_exists("gender" ,$_POST) && array_key_exists("birthday" ,$_POST) && array_key_exists("email" ,$_POST) && array_key_exists("encrypted" ,$_POST)){

    $name = trim($_POST["name"]);
    $last_name = trim($_POST["last_name"]);
    $dpi = trim($_REQUEST["dpi"]);
    $phone = trim($_POST["phone"]);
    $gender = $_POST["gender"];
    $birthday = $_POST["birthday"];
    $email = trim($_POST["email"]);
    $password = $_POST["encrypted"];
    $keyJS = pack("H*", $_POST['keyJS']);
    $ivJS =  pack("H*", $_POST['ivJS']);
    $encrypted = base64_decode($password);
    $plain_password = openssl_decrypt($encrypted, 'AES-128-CBC', $keyJS, OPENSSL_RAW_DATA, $ivJS);
    
    $key = pack("H", $keyPHP);
    $iv =  pack("H", $ivPHP);
    $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
    $iv2 = openssl_random_pseudo_bytes($ivlen);
    $ciphertext_raw = openssl_encrypt($plain_password, $cipher, $plain_password, $options = OPENSSL_RAW_DATA, $iv2);
    $hmac = hash_hmac('sha256', $ciphertext_raw, $plain_password, $as_binary=true);
    $ciphertext = base64_encode( $iv2.$hmac.$ciphertext_raw );

    $query = "SELECT * FROM usuarios WHERE dpi = :dpi OR correo = :email;";
    $stmt = $dbhost->prepare($query);
    $stmt->bindParam(':dpi', $dpi);
    $stmt->bindParam(':email', $email);
    if($stmt->execute()){
        if($stmt->rowCount() > 0){
            echo json_encode(array(
                "status" => 400,
                "msg" => "Usuario ya registrado"
            ));
        }else{
            $queryInsert = "INSERT INTO usuarios(id, nombre, apellido, dpi, telefono, fecha_nacimiento, correo, clave, genero, fecha_registro, estado)
            VALUES(null, :nombre, :apellido, :dpi, :telefono, :fecha, :correo, :clave, :genero, now(), 1);";
            $stmtInsert = $dbhost->prepare($queryInsert);
            $stmtInsert->bindParam(':nombre', $name);
            $stmtInsert->bindParam(':apellido', $last_name);
            $stmtInsert->bindParam(':dpi', $dpi);
            $stmtInsert->bindParam(':telefono', $phone);
            $stmtInsert->bindParam(':fecha', $birthday);
            $stmtInsert->bindParam(':correo', $email);
            $stmtInsert->bindParam(':clave', $ciphertext);
            $stmtInsert->bindParam(':genero', $gender);
            if($stmtInsert->execute()){
                echo json_encode(array(
                    "status" => 200,
                    "msg" => "Registro exitoso."
                ));
            }else{
                echo json_encode(array(
                    "status" => 400,
                    "msg" => $dbhost->errorInfo()
                ));
            } 
        }
    }else{
        echo json_encode(array(
            "status" => 400,
            "msg" => "Usuario ya registrado"
        ));
    }
   
}else{
    echo json_encode(array(
        "status" => 400,
        "msg" => "Faltan parametros"
    ));
}
?>