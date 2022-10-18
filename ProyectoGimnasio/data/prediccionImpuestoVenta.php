<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];

$sql = "SELECT tbimpuestoventaid, tbimpuestoventadescripcion FROM tbimpuestoventa WHERE (tbimpuestoventaactivo=1) AND 
(tbimpuestoventaid LIKE ? OR tbimpuestoventadescripcion LIKE ?) ORDER BY tbimpuestoventaid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo .'%', $campo .'%']);

$html = "";
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('" . $row["tbimpuestoventaid"] . "')\">" . $row["tbimpuestoventaid"] . " - "  . $row["tbimpuestoventadescripcion"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
