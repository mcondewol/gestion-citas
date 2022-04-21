<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include '../DB/conf.php';


$data = array();
$query = "SELECT U.id, U.nombre as ubicacion, M.nombre as municipio, D.nombre as departamento
            FROM catalogo_ubicaciones U
            INNER JOIN catalogo_municipios M ON U.id_municipio = M.id
            INNER JOIN catalogo_departamentos D ON M.id_departamento = D.id;";

$stmt = $dbhost->prepare($query);
if($stmt->execute()){
    $location = (isset($_POST["option"]))? $_POST["option"] : null;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $selected = ($row["id"] == $location)? "selected" : "";
        $data[] = "<option value='{$row['id']}' {$selected}>".$row['ubicacion']." (".$row['municipio'].", ".$row['departamento'].")</option>";
    }     
} 
$response_data = array(
    "data" => $data
);


echo json_encode($response_data);

?>