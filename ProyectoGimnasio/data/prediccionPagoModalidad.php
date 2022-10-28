<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];

$sql = "SELECT tbpagomodalidadid, tbpagomodalidadnombre FROM tbpagomodalidad 
WHERE (tbpagomodalidadactivo=1) AND (tbpagomodalidadid LIKE ? OR tbpagomodalidadnombre LIKE ?) ORDER BY tbpagomodalidadid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%']);

$html = "";
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('".$row["tbpagomodalidadnombre"]."')\">" . $row["tbpagomodalidadid"] . " - " . $row["tbpagomodalidadnombre"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);