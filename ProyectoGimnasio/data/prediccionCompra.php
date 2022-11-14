<?php

require 'data.php';
$con = new Data();
$pdo = $con->Data();
$campo = $_POST["campo"];
$html = "";

$sqlCompra = "SELECT tbcompraid, tbcomprafecha, tbcompramodopago, tbcompramontoneto FROM tbcompra 
WHERE (tbcompraactivo=1) AND (tbcompraid LIKE ? OR tbcomprafecha LIKE ? OR tbproveedorid LIKE ? OR tbcompramodopago like ? OR tbcompramontoneto LIKE ?) ORDER BY tbclienteid ASC LIMIT 0, 10";
$query = $pdo->prepare($sqlCompra);
$query->execute([$campo . '%', $campo . '%', $campo . '%'], $campo . '%');
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $html .= "<li onclick=\"mostrar('" . $row["tbcompraid"] . "')\">" . $row["tbcomprafecha"] . " - "  . $row["tbcompramodopago"] . " - " . $row["tbcompramontoneto"] . "</li>";
}

$sqlProveedor = "SELECT tbproveedorid , tbproveedornombrecompleto FROM tbproveedor
WHERE (tbproveedoractivo=1) AND (tbproveedornombrecompleto LIKE ?) ORDER BY tbproveedorid ASC LIMIT 0, 10";
$query = $pdo->prepare($sqlProveedor);
$query->execute([$campo . '%', $campo . '%']);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $html .= "<li onclick=\"mostrar('" . $row["tbproveedornombrecompleto"] . "')\">" . $row["tbproveedornombrecompleto"] . "</li>";
}

$sqlProducto = "SELECT tbproductoid , tbproductonombre FROM tbproducto WHERE (tbproductoactivo=1) AND (tbproductonombre LIKE ?) ORDER BY tbproductoid ASC LIMIT 0, 10";
$query = $pdo->prepare($sqlProducto);
$query->execute([$campo . '%']);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $html .= "<li onclick=\"mostrar('" . $row["tbproductoid"] . "')\">" . $row["tbproductoid"] . " - " . $row["tbproductonombre"] . "</li>";
}

$sqlCompraDetalle = "SELECT tbcompradetalleid, tbproductopreciobruto, tbproductocantidad FROM tbcompradetalle WHERE (tbcompradetalleactivo=1) AND 
(tbproductopreciobruto LIKE ? OR tbproductocantidad LIKE ?) ORDER BY tbcompradetalleid ASC LIMIT 0, 10";
$query = $pdo->prepare($sqlCompraDetalle);
$query->execute([$campo . '%', $campo .'%']);
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('" . $row["tbcompradetalleid"] . "')\">" . $row["tbproductopreciobruto"] . " - " .  $row["tbproductocantidad"] . "</li>";
}

$sqlImpuesto = "SELECT tbimpuestoventaid, tbimpuestoventadescripcion FROM tbimpuestoventa WHERE (tbimpuestoventaactivo=1) AND 
(tbimpuestoventaid LIKE ? OR tbimpuestoventadescripcion LIKE ?) ORDER BY tbimpuestoventaid ASC LIMIT 0, 10";
$query = $pdo->prepare($sqlImpuesto);
$query->execute([$campo .'%', $campo .'%']);

while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('" . $row["tbimpuestoventaid"] . "')\">" . $row["tbimpuestoventaid"] . " - "  . $row["tbimpuestoventadescripcion"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
