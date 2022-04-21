<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include '../DB/conf.php';
include '../ajax/random_string.php';
if(array_key_exists("medico", $_POST) && array_key_exists("fecha", $_POST)){

    $medico = ($_POST["medico"]);
    $date = ($_POST["fecha"]);

    $queryInsert = "INSERT INTO cita(idmedico, idusuario_reservacion, Fecha_reservacion, fechaing, Estado)
                    VALUES(:idmedico, :idusuario_reservacion, :Fecha_reservacion, now(),  1);";
    $stmtInsert = $dbhost->prepare($queryInsert);
    $stmtInsert->bindParam(':idmedico', $medico);
    $stmtInsert->bindParam(':idusuario_reservacion', $_SESSION["id"]);
    $stmtInsert->bindParam(':Fecha_reservacion', $date);
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
    echo json_encode(array(
        "status" => 400,
        "msg" => "Faltan parametros"
    ));
}
?>