<?php 

session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);

include '../DB/conf.php';

if(isset($_SESSION["id"]) && array_key_exists("name", $_POST)){
    $errors = array();
    $messages = array();
    if(array_key_exists("data", $_POST) && $_POST["data"] == true){    
        $carpeta = "../assets/perfil/";
        $target_file = $carpeta . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $errors[]= "El archivo es una imagen - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $errors[]= "El archivo no es una imagen.";
                $uploadOk = 0;
            }
        }

        if ($_FILES["fileToUpload"]["size"] > 2097152) {
            $errors[]= "Lo sentimos, el archivo es demasiado grande. Tamaño máximo admitido: 2 MB";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $errors[]= "Lo sentimos, sólo archivos JPG, JPEG, PNG son permitidos.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $errors[]= "Lo sentimos, tu archivo no fue subido.";
        // if everything is ok, try to upload file
        } else {
            $id_foto = time();
            $url_foto = "../assets/perfil/".$id_foto.".".$imageFileType;
            $query = "UPDATE usuarios SET nombre = :nombre, identidad = :identidad, telefono= :telefono, url_foto = :url_foto WHERE id=:id;";
            $stmt = $dbhost->prepare($query);
            $stmt->bindParam(':nombre', $_POST["name"]);
            $stmt->bindParam(':url_foto', $url_foto);
            $stmt->bindParam(':id', $_SESSION["id"]);
            $stmt->bindParam(':identidad', $_REQUEST["identity"]);
            $stmt->bindParam(':telefono', $_POST["phone"]);
            if($stmt->execute()){
                $_SESSION["name"] = $_POST["name"];
                $_SESSION["url_foto"] = $url_foto;
                $_SESSION["identidad"] = $_REQUEST["identity"];
                $_SESSION["phone"] = $_POST["phone"];
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $url_foto)) {
                    $messages[]= "El Archivo ha sido subido correctamente.";
                } else {
                    $errors[]= "Lo sentimos, hubo un error subiendo el archivo.";
                }
                echo json_encode(array(
                    "status" => 200,
                    "msg" => $messages,
                    "error" => $errors
                ));
            }else{
                echo json_encode(array(
                    "status" => 400,
                    "msg" => $dbhost->errorInfo(),
                    "error" => $errors
                ));
            } 
        }
    }else{
        $query = "UPDATE usuarios SET nombre = :nombre, identidad = :identidad, telefono= :telefono WHERE id=:id;";
        $stmt = $dbhost->prepare($query);
        $stmt->bindParam(':nombre', $_POST["name"]);
        $stmt->bindParam(':id', $_SESSION["id"]);
        $stmt->bindParam(':identidad', $_REQUEST["identity"]);
        $stmt->bindParam(':telefono', $_POST["phone"]);
        if($stmt->execute()){
            $_SESSION["name"] = $_POST["name"];
            $_SESSION["identidad"] = $_REQUEST["identity"];
            $_SESSION["phone"] = $_POST["phone"];
            echo json_encode(array(
                "status" => 200,
                "msg" => $messages,
                "error" => $errors,
                "opcion" =>  "else",
                "data" => array_key_exists("fileToUpload", $_POST)
            ));
        }else{
            echo json_encode(array(
                "status" => 400,
                "msg" => $dbhost->errorInfo(),
                "error" => $errors
            ));
        } 
    }
        
}else{
    header("Location: ../index.php");
}

?>