<?php

require_once "Connection.php";
require_once "GetModel.php";

class DeleteModel{

    static public function deleteData($table, $id, $nameId){
        $response=GetModel::getDataFilter($table, $nameId,$nameId, $id, null, null, null, null);
        if (empty($response)){
            return null;
        }
        $sql ="DELETE FROM $table WHERE $nameId=:$nameId";
        $link = Connection::connect();
        $stmt = $link->prepare($sql);
        $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_STR);
        if($stmt -> execute()){
			$response = array(
				"lastId" => $link->lastInsertId(),
				"comment" => "The delete was successful"	
            );
			return $response;
		}else{
			return $link->errorInfo();
		}
    }


    
    static public function deleteConditionalData($table, $condition){

    }
}

?>