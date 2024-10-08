<?php


    require_once "Models/PostModel.php";
    require_once "Controllers/post.controller.php";


    /* Separar las propiedades del arreglo */
    $columns=array();
    foreach(array_keys($_POST)as $key =>$values){
        array_push($columns, $values);
    }

    /* validamos las tablas y las columnas */

    if(empty(Connection::getColumnsData($table, $columns))){
        $json = array(
            'result'=>400,
            'result'=>"los nombres de los campos de la base de datos no coinciden"
        );

        echo json_encode($json, http_response_code($json["STATUS"]));
    }

    $response=new PostController();

        /* PETICION POST PARA REGISTRO DE USUARIOS */

    if(isset($_GET["register"])&& $_GET["register"==true]){
        
        $sufix=$_GET["sufix"]??"user";
        $response -> postRegister($table, $_POST, $sufix);


        /* CUANDO RECIBE UNA PETICION POST DE LOGIN  */
    }elseif(isset($_GET["login"])&& $_GET["login"==true]){

        $sufix=$_GET["sufix"]??"user";
        $response -> postLogin($table, $_POST, $sufix);

    }elseif(isset($_GET["token"])){

        
        /*  HACER VALIDACIONES DEL TOKEN DE USUARIO JWT  
            peticion post para usuarios no autorizados
            PETICION POST PARA USARIOS AUTORIZADOS 
            VALIDAR CUANDO EL TOKEN EXPIRO
            VALIDAR CUANDO EL TOKEN NO COINCIDE CON EL DE LA BASE DE DATOS
            VALIDAR CUANDO NO SE ENVIA TOKEN 
        */
    }
    
    


?>  