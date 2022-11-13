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

$sql = "SELECT tbcatalogoclientetipoid, tbcatalogoclientetiponombre FROM tbcatalogoclientetipo WHERE (tbcatalogoclientetipoactivo=1) AND (tbcatalogoclientetipoid LIKE ? OR tbcatalogoclientetiponombre LIKE ?) ORDER BY tbcatalogoclientetipoid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%']);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    if ($valor == true) {
        $html .= "<li onclick=\"mostrar('" . $row["tbcatalogoclientetiponombre"] . "')\">" . $row["tbcatalogoclientetipoid"] . " - " . $row["tbcatalogoclientetiponombre"] . "</li>";
    } else {
        $html .= "<li onclick=\"mostrarCampo2('" . $row["tbcatalogoclientetiponombre"] . "')\">" . $row["tbcatalogoclientetipoid"] . " - " . $row["tbcatalogoclientetiponombre"] . "</li>";
    }
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);
