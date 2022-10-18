<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];

$sql = "SELECT tbmodalidadfuncionalcriterioid , tbmodalidadfuncionalcriteriomodalidadfuncionalid, tbmodalidadfuncionalcriterionombre, tbmodalidadfuncionalcriteriodescripcion FROM tbmodalidadfuncionalcriterio 
    WHERE (tbmodalidadfuncionalcriterioactivo=1) AND (tbmodalidadfuncionalcriterioid LIKE ? OR tbmodalidadfuncionalcriteriomodalidadfuncionalid LIKE ? OR tbmodalidadfuncionalcriterionombre LIKE ?  
    OR tbmodalidadfuncionalcriteriodescripcion LIKE ?) ORDER BY tbmodalidadfuncionalcriterioid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%', $campo . '%', $campo . '%']);

$html = "";
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('" . $row["tbmodalidadfuncionalcriteriomodalidadfuncionalid"] . "')\">" . $row["tbmodalidadfuncionalcriterioid"] . " - " . $row["tbmodalidadfuncionalcriteriomodalidadfuncionalid"] . " " . $row["tbmodalidadfuncionalcriterionombre"] . " " . $row["tbmodalidadfuncionalcriteriodescripcion"] ."</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
