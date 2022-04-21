<?php 
//$stmt->rowCount()
//$rowPermisos = $stmtPermisos->fetch(PDO::FETCH_ASSOC);
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

include '../DB/conf.php';

class Ubicaciones{

    function get_all($dbhost){
        $query = "SELECT id, nombre, municipio, departamento
                FROM catalogo_ubicaciones G 
                ;";
        $stmt = $dbhost->prepare($query); 
        
        if($stmt->execute()){
           
            if($stmt->rowCount() > 0){
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $response = "";
                foreach($row as $key => $value ){
                    $response .= "
                            <tr>
                                <th scope='row'>{$value['id']}</th>
                                <td>{$value['nombre']}</td>
                                <td>{$value['municipio']}</td>
                                <td>{$value['departamento']}</td>
                                <td><button type='button' class='btn btn-primary'>Modificar</button>
                                <button type='button' class='btn btn-danger'>Eliminar</button>
                                </td>
                            </tr>
                    ";
                    }
                }
                return $response;
            }else{
               return "";
            }
        
    }

    function getList($dbhost){
        $query = "SELECT id, nombre, municipio, departamento
                FROM catalogo_ubicaciones G 
                ;";
        $stmt = $dbhost->prepare($query); 
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $response = "";
                foreach($row as $key => $value){
                    $response .= "<option value={$value['id']}>".$value['nombre']."</option>";
                }
                return $response;
            }else{
                return "<option>NO HAY CATEGORIAS</option>";
            }
        }
        return "<option>NO HAY CATEGORIAS</option>";
    }
        
}


?>