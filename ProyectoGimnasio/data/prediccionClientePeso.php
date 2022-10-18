<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();

$colums = ['tbclientepesoid', 'tbclienteid'];

$campo = $_POST["campo"];

$sql = "SELECT " . implode(", ", $colums) . "
FROM tbclientepeso WHERE tbclienteid  LIKE ? ORDER BY tbclienteid ASC LIMIT 0,10";
$query = $pdo->prepare($sql);
$query->execute([$campo. '%']);

$html = "";
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('".$row["tbclienteid"] ."')\">" . $row["tbclientepesoid"] . " - " . $row["tbclienteid"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
