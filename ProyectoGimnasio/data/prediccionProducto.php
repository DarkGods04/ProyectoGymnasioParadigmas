<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];

$sql = "SELECT tbproductoid, tbproductonombre, tbproductodescripcion, tbproductocantidad FROM tbproducto WHERE (tbproductoactivo=1) AND (tbproductoid LIKE ? OR tbproductonombre LIKE ? OR tbproductodescripcion LIKE ? OR tbproductocantidad LIKE ?) ORDER BY tbproductoid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%', $campo . '%', $campo . '%']);

$html = "";
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('" . $row["tbproductonombre"] . "')\">" . $row["tbproductoid"] . " - " . $row["tbproductonombre"] . " || " . $row["tbproductodescripcion"] . " || Cant. " . $row["tbproductocantidad"] . "</li>";
 }

echo json_encode($html, JSON_UNESCAPED_UNICODE);



