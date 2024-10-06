<?php

require_once "Controllers/get.controller.php";
require_once "Models/GetModel.php";

$select = $_GET["select"] ?? "*";
$orderBy = $_GET["orderBy"] ?? null;
$orderMode = $_GET["orderMode"]?? null;
$startAt = $_GET["startAt"]?? null;
$endAt = $_GET["endAt"]?? null;
$filterTo = $_GET["filterTo"] ?? null;
$inTo = $_GET["inTo"] ?? null;

$response = new GetController();



if(isset($_GET["linkTo"]) && isset($_GET["equalTo"]) && !isset($_GET["rel"]) && !isset($_GET["type"])){

    $response->getDataFilter($table, $select, $_GET["linkTo"],$_GET["equalTo"], $orderBy, $orderMode, $startAt, $endAt);

}else if(isset($_GET["rel"]) && isset($_GET["type"]) && $table == "relations" && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])){

	$response -> getRelData($_GET["rel"],$_GET["type"],$select,$orderBy,$orderMode,$startAt,$endAt);
	
/*=============================================
Peticiones GET con filtro entre tablas relacionadas
=============================================*/

}else{   
    echo('Else de get en services');
    $response->getData($table, $select, $orderBy, $orderMode, $startAt, $endAt);
}
?>
