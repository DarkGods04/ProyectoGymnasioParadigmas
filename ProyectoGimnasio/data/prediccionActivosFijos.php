<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];

$sql = "SELECT tbactivofijoid, tbactivofijoplaca, tbactivofijomodelo FROM tbactivofijo 
WHERE (tbactivofijoactivo=1) AND (tbactivofijoid LIKE ? OR tbactivofijoplaca LIKE ? OR tbactivofijomodelo LIKE ?) ORDER BY tbactivofijoid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%', $campo . '%']);

$html = "";
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $html .= "<li onclick=\"mostrar('" . $row["tbactivofijoplaca"] . "')\">" . $row["tbactivofijoid"] . " - " . $row["tbactivofijoplaca"] . " " . $row["tbactivofijomodelo"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
