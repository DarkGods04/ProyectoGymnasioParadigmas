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

$sql = "SELECT tbcatalogogrupomuscularid, tbcatalogogrupomuscularnombre FROM tbcatalogogrupomuscular WHERE (tbcatalogogrupomuscularactivo=1) AND (tbcatalogogrupomuscularid LIKE ? OR tbcatalogogrupomuscularnombre LIKE ?) ORDER BY tbcatalogogrupomuscularid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%']);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    if ($valor == true) {
        $html .= "<li onclick=\"mostrar('" . $row["tbcatalogogrupomuscularnombre"] . "')\">" . $row["tbcatalogogrupomuscularid"] . " - " . $row["tbcatalogogrupomuscularnombre"] . "</li>";
    } else {
        $html .= "<li onclick=\"mostrarCampo2('" . $row["tbcatalogogrupomuscularnombre"] . "')\">" . $row["tbcatalogogrupomuscularid"] . " - " . $row["tbcatalogogrupomuscularnombre"] . "</li>";
    }
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);
