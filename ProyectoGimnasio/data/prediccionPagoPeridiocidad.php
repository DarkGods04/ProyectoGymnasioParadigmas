<?php

require 'data.php';
$con = new Data();
$pdo = $con->Data();
$valor = true;
if (isset($_POST["campo"]) > 0) {
    $campo = $_POST["campo"];
} else {
    $campo = $_POST["campo2"];
    $valor = false;
}
$html = "";

$sql = "SELECT tbcatalogopagoperidiocidadid, tbcatalogopagoperidiocidadnombre FROM tbcatalogopagoperidiocidad WHERE (tbcatalogopagoperidiocidadactivo=1) AND (tbcatalogopagoperidiocidadid LIKE ? OR tbcatalogopagoperidiocidadnombre LIKE ?) ORDER BY tbcatalogopagoperidiocidadid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%']);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    if ($valor == true) {
        $html .= "<li onclick=\"mostrar('" . $row["tbcatalogopagoperidiocidadnombre"] . "')\">" . $row["tbcatalogopagoperidiocidadid"] . " - " . $row["tbcatalogopagoperidiocidadnombre"] . "</li>";
    } else {
        $html .= "<li onclick=\"mostrarCampo2('" . $row["tbcatalogopagoperidiocidadnombre"] . "')\">" . $row["tbcatalogopagoperidiocidadid"] . " - " . $row["tbcatalogopagoperidiocidadnombre"] . "</li>";
    }
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);
