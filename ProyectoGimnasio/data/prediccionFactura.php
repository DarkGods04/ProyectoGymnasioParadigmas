<?php

require 'data.php';
$con = new Data();
$pdo = $con->Data();
$campo = $_POST["campo"];
$html = "";

$sqlCliente = "SELECT  tbclienteid, tbclientenombre, tbclienteapellido1,tbclienteapellido2 FROM tbcliente WHERE (tbclienteactivo=1) AND tbclientenombre LIKE ?  OR tbclienteapellido1 LIKE ?  OR
tbclienteapellido2 LIKE ? ORDER BY tbclienteid ASC LIMIT 0, 10";
$query = $pdo->prepare($sqlCliente);
$query->execute([$campo . '%', $campo . '%', $campo . '%']);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $html .= "<li onclick=\"mostrar('" . $row["tbclientenombre"] . "')\">" . $row["tbclientenombre"] . " " . $row["tbclienteapellido1"] . " " . $row["tbclienteapellido2"] . "</li>";
}

$sqlInstructor = "SELECT tbinstructorid, tbinstructornombre, tbinstructorapellido FROM tbinstructor 
WHERE (tbinstructoractivo=1) AND (tbinstructornombre LIKE ? OR tbinstructorapellido LIKE ?) ORDER BY tbinstructorid ASC LIMIT 0, 10";
$query = $pdo->prepare($sqlInstructor);
$query->execute([$campo . '%', $campo . '%']);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $html .= "<li onclick=\"mostrar('" . $row["tbinstructornombre"] . "')\">" . $row["tbinstructornombre"] . " " . $row["tbinstructorapellido"] . "</li>";
}

$sql = "SELECT tbcatalogopagoperidiocidadid, tbcatalogopagoperidiocidadnombre FROM tbcatalogopagoperidiocidad WHERE (tbcatalogopagoperidiocidadactivo=1) AND (tbcatalogopagoperidiocidadid LIKE ? OR tbcatalogopagoperidiocidadnombre LIKE ?) ORDER BY tbcatalogopagoperidiocidadid ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%']);
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $html .= "<li onclick=\"mostrar('" . $row["tbcatalogopagoperidiocidadnombre"] . "')\">" . $row["tbcatalogopagoperidiocidadid"] . " - " . $row["tbcatalogopagoperidiocidadnombre"] . "</li>";
}

$sqlServicio = "SELECT tbservicioid, tbservicionombre FROM tbservicio WHERE (tbservicioactivo=1) AND 
(tbservicionombre LIKE ?) ORDER BY tbservicioid ASC LIMIT 0, 10";
$query = $pdo->prepare($sqlServicio);
$query->execute([$campo . '%']);
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('" . $row["tbservicionombre"] . "')\">" . $row["tbservicionombre"] . "</li>";
}

$sqlImpuesto = "SELECT tbimpuestoventaid, tbimpuestoventadescripcion FROM tbimpuestoventa WHERE (tbimpuestoventaactivo=1) AND 
(tbimpuestoventadescripcion LIKE ?) ORDER BY tbimpuestoventaid ASC LIMIT 0, 10";
$query = $pdo->prepare($sqlImpuesto);
$query->execute([$campo .'%']);
while($row = $query-> fetch(PDO::FETCH_ASSOC)){
    $html .= "<li onclick=\"mostrar('" . $row["tbimpuestoventadescripcion"] . "')\">" . $row["tbimpuestoventadescripcion"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
