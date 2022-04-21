<?php 
//$stmt->rowCount()
//$rowPermisos = $stmtPermisos->fetch(PDO::FETCH_ASSOC);
// error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

include '../DB/conf.php';

if(array_key_exists("email", $_POST)){
    $email = $_POST["email"];
    $query = "SELECT * FROM usuarios WHERE correo = :email;";
    $stmt = $dbhost->prepare($query);
    $stmt->bindParam(':email', $email);
    if($stmt->execute()){
        if($stmt->rowCount() > 0){
            echo "false";
        }else{
            echo "true";
        }
        
    }else{
        echo "false";
    }
}else{
    echo "false";
}

$dbhost = null;

?>