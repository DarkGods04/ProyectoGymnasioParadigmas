<?php

require 'data.php';

$con = new Data();
$pdo = $con->Data();
$conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
$conn->set_charset('UTF8');

$campo = $_POST["campo"];
$querySelectCliente = "SELECT * FROM tbcliente WHERE tbclientenombre LIKE '%$campo%' OR tbclienteapellido1 LIKE '%$campo%' OR
        tbclienteapellido2 LIKE '%$campo%';";
$resultCliente = mysqli_query($conn, $querySelectCliente);
$idCliente = 0;
while ($rowCliente = mysqli_fetch_array($resultCliente)) {
    if ($rowCliente['tbclienteactivo'] == 1) {
        $idCliente = $rowCliente['tbclienteid'];
    }
}

$querySelectInstructor = "SELECT * FROM tbinstructor WHERE tbinstructornombre LIKE '%$campo%' OR tbinstructorapellido LIKE '%$campo%';";
$resultInstructor = mysqli_query($conn, $querySelectInstructor);
$idInstructor = 0;
while ($rowInstructor = mysqli_fetch_array($resultInstructor)) {
    if ($rowInstructor['tbinstructoractivo'] == 1) {
        $idInstructor = $rowInstructor['tbinstructorid'];
    }
}

$querySelectModalidad = "SELECT * FROM tbpagomodalidad Where tbpagomodalidadnombre LIKE '%$campo%';";
$resultModalidad = mysqli_query($conn, $querySelectModalidad);
$idModalidad = 0;
while ($rowModalidad = mysqli_fetch_array($resultModalidad)) {
    if ($rowModalidad['tbpagomodalidadactivo'] == 1) {
        $idModalidad = $rowModalidad['tbpagomodalidadid'];
    }
}

$querySelectServicio = "SELECT * FROM tbservicio WHERE tbservicionombre LIKE '%$campo%';";
$idServicio = 0;
$resultServicio = mysqli_query($conn, $querySelectServicio);
while ($rowServicio = mysqli_fetch_array($resultServicio)) {
    if ($rowServicio['tbservicioactivo'] == 1) {
        $idServicio = $rowServicio['tbservicioid'];
    }
}


$querySelectImpuesto = "SELECT * FROM tbimpuestoventa WHERE tbimpuestoventadescripcion LIKE '%$campo%';";
$resultImpuesto = mysqli_query($conn, $querySelectImpuesto);
$idImpuesto = 0;
while ($rowimpuesto = mysqli_fetch_array($resultImpuesto)) {
    if ($rowimpuesto['tbimpuestoventaactivo'] == 1) {
        $idImpuesto = $rowimpuesto['tbimpuestoventaid'];
    }
}

$sql =  "SELECT * FROM tbfactura WHERE tbfacturaid LIKE '%$campo%' OR tbfacturaclienteid LIKE '%$idCliente%' OR tbfacturainstructorid LIKE '%$idInstructor%' OR tbfacturafechapago LIKE '%$campo%' OR tbfacturapagomodalidad LIKE '%$idModalidad%' OR tbfacturaservicios LIKE '%$idServicio%' OR tbfacturaimpuestoventaid LIKE '%$idImpuesto%' OR tbfacturamontobruto LIKE '%$campo%' OR tbfacturamontoneto LIKE '%$campo%';";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%']);

$html = "";
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $html .= "<li onclick=\"mostrar('" . $row["tbfacturaid"] . "')\">" . $row["tbfacturaid"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
