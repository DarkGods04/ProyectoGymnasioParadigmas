<?php
require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];

$sql = "SELECT tbservicioid, tbservicionombre, tbserviciodescripcion FROM tbservicio WHERE (tbservicioactivo=1) AND 
(tbservicioid LIKE ? OR tbservicionombre LIKE ? OR tbserviciodescripcion LIKE ?) ORDER BY tbservicioid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%', $campo . '%']);

$html = "";
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('" . $row["tbservicionombre"] . "')\">" . $row["tbservicionombre"] . " - " . $row["tbserviciodescripcion"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);