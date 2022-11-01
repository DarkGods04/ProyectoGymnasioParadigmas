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

$sql = "SELECT tbcatalogorutinanivelid, tbcatalogorutinanivelnombre FROM tbcatalogorutinanivel WHERE (tbcatalogorutinanivelactivo=1) AND (tbcatalogorutinanivelid LIKE ? OR tbcatalogorutinanivelnombre LIKE ?) ORDER BY tbcatalogorutinanivelid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%']);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    if ($valor == true) {
        $html .= "<li onclick=\"mostrar('" . $row["tbcatalogorutinanivelnombre"] . "')\">" . $row["tbcatalogorutinanivelid"] . " - " . $row["tbcatalogorutinanivelnombre"] . "</li>";
    } else {
        $html .= "<li onclick=\"mostrarCampo2('" . $row["tbcatalogorutinanivelnombre"] . "')\">" . $row["tbcatalogorutinanivelid"] . " - " . $row["tbcatalogorutinanivelnombre"] . "</li>";
    }
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);
