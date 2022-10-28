<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];

$sql = "SELECT tbclienteid, tbclientenombre, tbclienteapellido1 FROM tbcliente 
WHERE (tbclienteactivo=0) AND tbclienteid LIKE ? OR tbclientenombre LIKE ? OR tbclienteapellido1 LIKE ? ORDER BY tbclienteid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%', $campo . '%']);

$html = "";
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $html .= "<li onclick=\"mostrar('" . $row["tbclientenombre"] . "')\">" . $row["tbclienteid"] . " - " . $row["tbclientenombre"] . " " . $row["tbclienteapellido1"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
