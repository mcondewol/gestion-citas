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
                r.id AS 'id',
                CONCAT (p.name, ' ', p.lastname) AS 'pacient',
                CONCAT (m.name, ' ', m.lastname) AS 'medic',
                c.name AS 'category',
                r.`date_at` AS 'date',
                r.`time_at` AS 'time'
            FROM
                reservation r
                INNER JOIN pacient p
                ON p.`id` = r.`pacient_id`
                INNER JOIN medic m
                ON m.`id` = r.`medic_id`
                INNER JOIN category c
                ON c.`id` = m.`category_id`;";
            $stmt = $dbhost->prepare($query);
            if($stmt->execute()){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $acciones = "<a href='index.php?view=reservationhistory&id=".$row['id']."' title='Historial' class='btn btn-success btn-xs'><i class='fa fa-history'></i></a>
                                <a href='index.php?view=editreservation&id=".$row['id']."' title='Editar' class='btn btn-warning btn-xs'><i class='fa fa-pencil'></i></a>
                                <a href='index.php?view=delreservation&id=".$row['id']."' class='btn btn-danger btn-xs' rel='tooltip' title='Eliminar' class='btn-simple btn btn-danger btn-xs'><i class='fa fa-remove'></i></a>";
                    
                    $oldDate = $row["date"];
                    $timestamp = strtotime($oldDate); 
                    $newDate = date("d-m-Y", $timestamp );

                    $oldTime = $row["time"];
                    $newTime = date('H:i A', strtotime($oldTime));
                                
                    $data[] = array(
                        "area" => $row["category"],
                        "pacient" => $row["pacient"],
                        "medic" => $row["medic"],
                        "fecha" => $newDate,
                        "hora" => $newTime,
                        "acciones" => $acciones 
                    );
                }     
            } 
        }else if($opcion == 2){
            $reservationId = $_POST["reservationId"];
            $query = "SELECT
                r.id AS 'id',
                CONCAT (p.name, ' ', p.lastname) AS 'pacient',
                CONCAT (m.name, ' ', m.lastname) AS 'medic',
                c.name AS 'category',
                r.`date_at` AS 'date',
                r.`time_at` AS 'time'
            FROM
                reservation r
                INNER JOIN pacient p
                ON p.`id` = r.`pacient_id`
                INNER JOIN medic m
                ON m.`id` = r.`medic_id`
                INNER JOIN category c
                ON c.`id` = m.`category_id`;";
            $stmt = $dbhost->prepare($query);
            if($stmt->execute()){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                   
                    
                    $oldDate = $row["date"];
                    $timestamp = strtotime($oldDate); 
                    $newDate = date("d-m-Y", $timestamp );

                    $oldTime = $row["time"];
                    $newTime = date('H:i A', strtotime($oldTime));
                                
                    $data[] = array(
                        "area" => $row["category"],
                        "pacient" => $row["pacient"],
                        "medic" => $row["medic"],
                        "fecha" => $newDate,
                        "hora" => $newTime,
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