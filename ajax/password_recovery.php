<?php 

include '../DB/conf.php';

class Password{

    function validar_id($dbhost, $id_request){
        $query = "SELECT * FROM password_recovery WHERE key_request = :key_request AND estado = 1;";
        $stmt = $dbhost->prepare($query);
        $stmt->bindParam(":key_request", $id_request);    
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return [true, $row];
            }else{
                return [false];
            }
        }else{
            return [false, "error"];
        }
    }
}

?>