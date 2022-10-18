<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$campo = $_POST["campo"];

$sql = "SELECT tbinstructorid, tbinstructornombre, tbinstructorapellido FROM tbinstructor 
WHERE (tbinstructoractivo=1) AND (tbinstructorid LIKE ? OR tbinstructornombre LIKE ? OR tbinstructorapellido LIKE ?) ORDER BY tbinstructorid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%', $campo . '%']);

$html = "";
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('" . $row["tbinstructornombre"] . "')\">" . $row["tbinstructorid"] . " - " . $row["tbinstructornombre"] . " " . $row["tbinstructorapellido"] . "</li>";
    //$html .= "<li onclick=\"mostrar('" . $row["tbinstructornombre"] . " " . $row['tbinstructorapellido'] . "')\">" . $row["tbinstructorid"] . " - " . $row["tbinstructornombre"] . " " . $row["tbinstructorapellido"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);



