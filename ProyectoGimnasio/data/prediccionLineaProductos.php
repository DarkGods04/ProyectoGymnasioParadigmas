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

$sql = "SELECT tbcatalogolineaproductosid, tbcatalogolineaproductosnombre FROM tbcatalogolineaproductos WHERE (tbcatalogolineaproductosactivo=1) AND (tbcatalogolineaproductosid LIKE ? OR tbcatalogolineaproductosnombre LIKE ?) ORDER BY tbcatalogolineaproductosid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%']);

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    if ($valor == true) {
        $html .= "<li onclick=\"mostrar('" . $row["tbcatalogolineaproductosnombre"] . "')\">" . $row["tbcatalogolineaproductosid"] . " - " . $row["tbcatalogolineaproductosnombre"] . "</li>";
    } else {
        $html .= "<li onclick=\"mostrarCampo2('" . $row["tbcatalogolineaproductosnombre"] . "')\">" . $row["tbcatalogolineaproductosid"] . " - " . $row["tbcatalogolineaproductosnombre"] . "</li>";
    }
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);