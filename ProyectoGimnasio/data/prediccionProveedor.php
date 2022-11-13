<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];

$sql = "SELECT tbproveedorid , tbproveedornombrecompleto, tbproveedorcasacomercial FROM tbproveedor 
    WHERE (tbproveedoractivo=1) AND (tbproveedorid LIKE ? OR tbproveedornombrecompleto LIKE ? OR tbproveedorcasacomercial LIKE ?)
    ORDER BY tbproveedorid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%', $campo . '%']);

$html = "";
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('" . $row["tbproveedornombrecompleto"] . "')\">" . $row["tbproveedorid"] . " - " . $row["tbproveedornombrecompleto"] . " " . $row["tbproveedorcasacomercial"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
