<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];

$sql = "SELECT tbcatalogopagometodoid, tbcatalogopagometodonombre FROM tbcatalogopagometodo 
WHERE (tbcatalogopagometodoactivo=1) AND (tbcatalogopagometodoid LIKE ? OR tbcatalogopagometodonombre LIKE ?) ORDER BY tbcatalogopagometodoid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%']);

$html = "";
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $html .= "<li onclick=\"mostrar('" . $row["tbcatalogopagometodonombre"] . "')\">" . $row["tbcatalogopagometodoid"] . " - " . $row["tbcatalogopagometodonombre"] . "</li>";
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);