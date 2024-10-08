<?php

require_once "Models/Connection.php";
require_once "Controllers/delete.controller.php";

if(isset ($_GET['id']) && isset($_GET['nameId'])){
    
    if(empty(Connection::getColumnsData($table, $colums))){
        $json=array(
            'status'=>400,
            'result'=>"los campos del formulario no coinciden con la bd"
        );
    
        echo json_encode($json, http_response_code($json["status"]));
        return;
    }

}

?>