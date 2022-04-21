<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include '../DB/conf.php';
include '../ajax/random_string.php';



$id = trim($_POST["id"]);

if($id == null){
    $name = trim($_POST["name"]);
    $specialty = trim($_POST["specialty"]);
    $queryInsert = "INSERT INTO catalogo_medicos(id, nombre, idservicio, usering, fechaing, usermod, fechamod, estado)
            VALUES(null, :nombre, :id_servicio, 130, now(), 130, now(), 1);";
    $stmtInsert = $dbhost->prepare($queryInsert);
    $stmtInsert->bindParam(':nombre', $name);
    $stmtInsert->bindParam(':id_servicio', $specialty);
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
}else{
    if(isset($_POST["status"]) && $_POST["status"] == 0){
        $query = "UPDATE catalogo_medicos SET estado = 0, fechamod = now() WHERE id = :id;";
        $stmt = $dbhost->prepare($query);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()){
            echo json_encode(array(
                "status" => 200,
                "msg" => "Registro eliminado"
            ));
        }else{
            echo json_encode(array(
                "status" => 400,
                "msg" => $dbhost->errorInfo()
            ));
        }       
    }else{
        $name = trim($_POST["name"]);
        $specialty = trim($_POST["specialty"]);
        $query = "UPDATE catalogo_medicos SET nombre = :nombre, idservicio = :id_servicio, fechamod = now() WHERE id = :id;";
        $stmt = $dbhost->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $name);
        $stmt->bindParam(':id_servicio', $specialty);
        if($stmt->execute()){
            echo json_encode(array(
                "status" => 200,
                "msg" => "Modificación exitosa."
            ));
        }else{
            echo json_encode(array(
                "status" => 400,
                "msg" => $dbhost->errorInfo()
            ));
        }       
    }
}
     
?>