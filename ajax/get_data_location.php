<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include '../DB/conf.php';


$response_data = array();

if(array_key_exists("opcion", $_POST)){
    $opcion = $_POST["opcion"];
    if($opcion == 1){
        $query = "SELECT id, nombre FROM catalogo_departamentos;";
        $stmt = $dbhost->prepare($query);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = "<option value='{$row['id']}'>{$row['nombre']}</option>";
            }     
        } 
    }else if($opcion == 2){
        $id_departamento = $_POST["id_departamento"];
        $query = "SELECT id, nombre FROM catalogo_municipios WHERE id_departamento = :id_departamento;";
        $stmt = $dbhost->prepare($query);
        $stmt->bindParam(':id_departamento', $id_departamento);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = "<option value='{$row['id']}'>{$row['nombre']}</option>";
            }     
        } 
    }
    $response_data = array(
        "data" => $data
    );
}else{
    $response_data = array(
        "data" => [],
        "error" => "Faltan parametros"
    );
}
echo json_encode($response_data);

?>