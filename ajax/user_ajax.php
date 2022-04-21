<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
session_start();

include '../core/app/DB/conf.php';


if(array_key_exists("opcion", $_POST)){

    $opcion = $_POST["opcion"];
    $data = array();
        if($opcion == 1){
            $query = "SELECT
                            id,
                            CONCAT (NAME, ' ', lastname) AS 'name',
                            username,
                            email,
                            is_active,
                            is_admin
                        FROM
                            user;";
            $stmt = $dbhost->prepare($query);
            if($stmt->execute()){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $acciones = "<a href='index.php?view=edituser&id=".$row['id']."' title='Editar' class='btn btn-warning btn-xs'><i class='fa fa-pencil'></i></a>
                                <a href='index.php?view=deluser&id=".$row['id']."' class='btn btn-danger btn-xs' rel='tooltip' title='Eliminar' class='btn-simple btn btn-danger btn-xs'><i class='fa fa-remove'></i></a>";
                    $is_active = "";
                    $is_admin = "";
                    if($row['is_active'] == 1){
                        $is_active = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                    }else{
                        $is_active = "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>";
                    }

                    if($row['is_admin'] == 1){
                        $is_admin = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                    }else{
                        $is_admin = "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>";
                    }
                                
                    $data[] = array(
                        "name" => $row["name"],
                        "username" => $row["username"],
                        "email" => $row["email"],
                        "is_active" => $is_active,
                        "is_admin" => $is_admin,
                        "acciones" => $acciones 
                    );
                }     
            } 
        }
    $response_data = array(
        "draw" => 1,
        "recordsTotal" => count($data),
        "recordsFiltered" => count($data),
        "data" => $data
    );
}else{
    $response_data = array(
        "draw" => 1,
        "recordsTotal" => null,
        "recordsFiltered" => null,
        "data" => []
    );
}

echo json_encode($response_data);

?>