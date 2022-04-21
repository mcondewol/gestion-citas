<?php 

session_start();
// error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

include '../DB/conf.php';
include '../ajax/random_string.php';

$email = $_POST["email"];
$password = $_POST["encrypted"];
$keyJS = pack("H*", $_POST['keyJS']);
$ivJS =  pack("H*", $_POST['ivJS']);
$encrypted = base64_decode($password);
$plain_password = openssl_decrypt($encrypted, 'AES-128-CBC', $keyJS, OPENSSL_RAW_DATA, $ivJS);

$query = "SELECT * FROM usuarios WHERE correo = :email;";
$stmt = $dbhost->prepare($query);
$stmt->bindParam(':email', $email);

if($stmt->execute()){
    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $c = base64_decode($row["clave"]);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $plain_password, $options=OPENSSL_RAW_DATA, $iv);
        $_SESSION["id"] = $row['id'];
        $_SESSION["correo"] = $email;
        if($plain_password == $original_plaintext){
            echo json_encode(array(
                "status" => 200
            ));
        }else{
            echo json_encode(array(
                "status" => 400,
                "msg" => "Credenciales incorrectas"
            ));
        }
    }else{
        echo json_encode(array(
            "status" => 400,
            "msg" => "Correo o contraseña incorrectos"
        ));
    }
}

?>