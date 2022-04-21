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
                        id AS 'pacient_id',
                        CONCAT (name, ' ', lastname) AS 'name',
                        address,
                        email,
                        phone,
                        dpi
                    FROM
                        pacient;";
            $stmt = $dbhost->prepare($query);
            if($stmt->execute()){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $acciones = "<a href='index.php?view=pacienthistory&id=".$row['pacient_id']."' title='Historial' class='btn btn-success btn-xs'><i class='fa fa-history'></i></a>
                                <a href='index.php?view=editpacient&id=".$row['pacient_id']."' title='Editar' class='btn btn-warning btn-xs'><i class='fa fa-pencil'></i></a>
                                <a href='index.php?view=delpacient&id=".$row['pacient_id']."' class='btn btn-danger btn-xs' rel='tooltip' title='Eliminar' class='btn-simple btn btn-danger btn-xs'><i class='fa fa-remove'></i></a>";
                    $data[] = array(
                        "name" => $row["name"],
                        "address" => $row["address"],
                        "email" => $row["email"],
                        "phone" => $row["phone"],
                        "dpi" => $row["dpi"],
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