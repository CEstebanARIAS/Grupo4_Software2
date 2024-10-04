<?php
class Connection
{

    /*Informacion de la BD */
    static public function infoDatabase()
    {
        $infoDB = array(
            "database" => 'u145597152_grupocuatro', 
            "user" => 'u145597152_ugrupocuatro', 
            "pass" => 'x+ZI$x[6'
        );
        return $infoDB;
    }

    // apikey
    static public function apikey()
    {
        return "asdkfah234$#%";
    }

    static public function publicAccess()
    {
        $table = ["lotes"];
        return $table;
    }

    static public function connect()
    {
        try {
            $link = new PDO(
                "mysql:host=auth-db1526.hstgr.io;dbname=" . Connection::infoDatabase()["database"],
                Connection::infoDatabase()["user"],
                Connection::infoDatabase()["pass"]
            );
            $link->exec("set names utf8");
        } catch (PDOException $e) {
            die("Error" . $e->getMessage());
        }
        return $link;
    }

    /* validar exixtencias de tablas en la base de datos */
    static public function getColumnsData($table, $columns){
        /* traer el nombre de la base de datos */
        $database = Connection::infoDatabase()["database"];
        /* traer todas las columnas que tenemos en la baase de datos */
        $validate = Connection::connect()
        ->query("SELECT column_name FROM information_schema.columns WHERE table_schema = '" . Connection::infoDatabase()["database"] . "' AND table_name = '$table'")
        ->fetch(PDO::FETCH_OBJ);

        
        /* Validamos la existencia de la tabla */
        if(empty($validate)){
            return null;
        }else{
            if($columns[0]=="*"){
                array_shift($columns);
            }
        }
        /*Validamos la existencia de columnas */
        foreach ($validate as $column) {
           
        }
        return $validate; // Retornar las columnas si todo está bien
    } 

    static public function jwt(){

    }


}
