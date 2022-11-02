<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];


$sql = "SELECT tbclienteid, tbclientenombre,tbclienteapellido1 FROM tbcliente 
WHERE (tbclienteactivo=1) AND (tbclienteid LIKE ? OR tbclientenombre LIKE ? OR tbclienteapellido1 LIKE ?) ORDER BY tbclienteid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%', $campo . '%']);

$html = "";
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $html .= "<li onclick=\"mostrar('" . $row["tbclientenombre"] . "')\">" . $row["tbclienteid"] . " - " . $row["tbclientenombre"] . " " . $row["tbclienteapellido1"] . "</li>";
}

$sql = "SELECT tbcatalogogrupomuscularid, tbcatalogogrupomuscularnombre FROM tbcatalogogrupomuscular WHERE (tbcatalogogrupomuscularactivo=1) AND (tbcatalogogrupomuscularid LIKE ? OR tbcatalogogrupomuscularnombre LIKE ?) ORDER BY tbcatalogogrupomuscularid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%']);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $html .= "<li onclick=\"mostrar('" . $row["tbcatalogogrupomuscularnombre"] . "')\">" . $row["tbcatalogogrupomuscularid"] . " - " . $row["tbcatalogogrupomuscularnombre"] . "</li>";
}

$sql = "SELECT tbmedidaisometricaid, tbmedidaisometricafechamedicion  FROM tbmedidaisometrica WHERE (tbmedidaisometricaactivo=1) AND 
(tbmedidaisometricafechamedicion LIKE ? OR tbmedidaisometricaid LIKE ? ) ORDER BY tbmedidaisometricaid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo .'%', $campo .'%']);

$html = "";
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('" . $row["tbmedidaisometricafechamedicion"] . "')\">" . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);