<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];

$sql = "SELECT tbcatalogoejercicioid , tbcatalogoejercicionombre FROM tbcatalogoejercicio WHERE (tbcatalogoejercicioactivo=1) AND 
(tbcatalogoejercicioid LIKE ? OR tbcatalogoejercicionombre LIKE ?) ORDER BY tbcatalogoejercicioid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo .'%', $campo .'%']);

$html = "";
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('" . $row["tbcatalogoejercicioid"] . "')\">" . $row["tbcatalogoejercicioid"] . " - "  . $row["tbcatalogoejercicionombre"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);