<?php

    require_once "Models/Connection.php";
    require_once "Controllers/put.controller.php";

    if (isset($_GET["id"])&& isset($_GET["nameId"])){
        $data = array();
        parse_str(file_get_contents('php:://input'), $data);

        $columns = array();

        foreach(array_keys($data) as $key => $values){
            array_push($columns, $values);
        }

        array_push($columns, $_GET["nameId"]);
        $columns = array_unique($columns);

        if(empty(Connection::getColumnsData($table, $columns))){

            $json = array(
               'status'=> 400,
               'result'=> 'Datos no coinciden'
            );
            echo json_encode($json, http_response_code($json['status']));
        }


        /* Cuando se actualiza un registro debe validar el token si coincide o no con el almacenado en la base de datos */
    }

?>