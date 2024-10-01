<?php

/* 
require_once "Connection.php";
require_once "get.model.php"; */

class PutModel{

    //peticion put para editar datos de forma directa/


    static public function putData($table,$data,$id,$nameId){
        //validar el id/
        $response=GetModel::getDataFilter($table,$nameId, $nameId, $id,null,null,null,null);
        if(empty($response)){
            return null;
        }

        //actualizamos los registros/
        $set="";
        foreach($data as $key=>$values){
            $set.=$key."= :".$key.",";  
        }
        $set=substr($set, 0 , -1);

        $sql="UPDATE $table $set WHERE  $nameId = $nameId";

        $link= Connection::connect();
        $stmt=$link ->prepare($sql);

        foreach($data as $key=>$values){
            $stmt->bindParam(":".$key, $data[$key], PDO::PARAM_STR);            
        }
        $stmt ->bindParam(":".$nameId,$id, PDO::PARAM_STR);

        if($stmt-> execute() ){
            $response=array(
                "comment"=>"proceso exitoso"
            );
            return $response;
        }else{
            return $link ->errorInfo();
        }
           
    }
}
?>