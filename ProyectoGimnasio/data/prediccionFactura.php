<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];

$sql = "SELECT tbfacturaid FROM tbfactura 
WHERE (tbfacturaactivo=1) AND tbfacturaid LIKE ?  ORDER BY tbfacturaid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%']);

$html = "";
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $html .= "<li onclick=\"mostrar('" . $row["tbfacturaid"] . "')\">" . $row["tbfacturaid"] ."</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
