<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];

$sql = "SELECT tbactivovariableid, tbactivovariablenombre FROM tbactivovariable 
WHERE (tbactivovariableactivo=1) AND (tbactivovariableid LIKE ? OR tbactivovariablenombre LIKE ?) ORDER BY tbactivovariableid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%']);

$html = "";
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('".$row["tbactivovariablenombre"]."')\">" . $row["tbactivovariableid"] . " - " . $row["tbactivovariablenombre"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);



