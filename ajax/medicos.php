<?php
    session_start();
    include '../DB/conf.php';
    $especialidad_id = $_POST["especialidad_id"];
    if ($especialidad_id != '') {
        $query = "SELECT *
                FROM catalogo_medicos 
                where idservicio =" . $especialidad_id . ";";
        $stmt = $dbhost->prepare($query); 
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $response = "<option value=''>-- SELECCIONE --</option>";
                foreach($row as $key => $value){
                    $response .= "<option value={$value['id']}>".$value['nombre']."</option>";
                }
                echo $response;
            }else{
                echo "<option>NO HAY CATEGORIAS</option>";
            }
        }
        
    }
?>