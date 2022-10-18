<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];

$sql = "SELECT tbmodalidadfuncionalid, tbmodalidadfuncionalnombre, tbmodalidadfuncionaldescripcion FROM tbmodalidadfuncional
    WHERE (tbmodalidadfuncionalactivo=1) AND (tbmodalidadfuncionalid LIKE ? OR tbmodalidadfuncionalnombre LIKE ?
    OR tbmodalidadfuncionaldescripcion LIKE ?) ORDER BY tbmodalidadfuncionalid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%', $campo . '%']);

$html = "";
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('" . $row["tbmodalidadfuncionalnombre"] . "')\">" . $row["tbmodalidadfuncionalnombre"] . " - " . $row["tbmodalidadfuncionaldescripcion"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);