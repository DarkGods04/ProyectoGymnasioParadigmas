<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];

$sql = "SELECT tbcatalogopagoperidiocidadid, tbcatalogopagoperidiocidadnombre FROM tbcatalogopagoperidiocidad 
WHERE (tbcatalogopagoperidiocidadactivo=1) AND (tbcatalogopagoperidiocidadid LIKE ? OR tbcatalogopagoperidiocidadnombre LIKE ?) ORDER BY tbcatalogopagoperidiocidadid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%']);

$html = "";
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('".$row["tbcatalogopagoperidiocidadnombre"]."')\">" . $row["tbcatalogopagoperidiocidadid"] . " - " . $row["tbcatalogopagoperidiocidadnombre"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);