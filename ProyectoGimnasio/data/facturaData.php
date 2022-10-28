<?php
include_once 'data.php';
include '../domain/factura.php';

class FacturaData extends Data{

    public function insertFactura($factura){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbfacturaid) AS tbfacturaid FROM tbfactura";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbfactura VALUES (" . $nextId . ",'" . $factura->getClienteidTBFactura() . "','" .
            $factura->getInstructoridTBFactura() . "','" .  $factura->getFechaPagoTBFactura() . "','" .
            $factura->getPagoModalidadTBFactura() . "','" . $factura->getServiciosTBFactura() . "','" .
            $factura->getMontoBrutoTBFactura() . "','" . $factura->getImpuestoVentaidTBFactura() . "','" .
            $factura->getMontoNetoTBFactura() . "','" .
            $factura->getActivoTBFactura() . "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }


    public function deleteFactura($idFactura){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbfactura SET tbfacturaactivo=0  WHERE tbfacturaid=$idFactura";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }
/*
    public function updateFactura($factura){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $id = $factura->getIdTBFactura();
        $clienteid = $factura->getClienteidTBFactura();
        $instructorid = $factura->getInstructoridTBFactura();
        $fechaPago = $factura->getFechaPagoTBFactura();
        $pagoModalidad = $factura->getPagoModalidadTBFactura();
        $servicios = $factura->getServiciosTBFactura();
        $montoBruto = $factura->getMontoBrutoTBFactura();
        $impuestoVentaid = $factura->getImpuestoVentaidTBFactura();
        $montoNeto = $factura->getMontoNetoTBFactura();

        $queryUpdate = "UPDATE tbfactura SET tbfacturaclienteid='$clienteid', tbfacturainstructorid='$instructorid',
             tbfacturafechapago='$fechaPago', tbfacturapagomodalidad='$pagoModalidad', tbservicioid='$servicios',
             tbfacturamontobruto='$montoBruto', tbimpuestoventaid='$impuestoVentaid', tbfacturamontoneto='$montoNeto' WHERE tbfacturaid=$id";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);
        return $result;
    }
*/
    public function getFacturas(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbfactura;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);

        $Facturas = [];
        while ($row = mysqli_fetch_array($result)) {
            $current = new Factura(
                $row['tbfacturaid'],
                $row['tbclienteid'],
                $row['tbinstructorid'],
                $row['tbfacturafechapago'],
                $row['tbcatalogopagoperidiocidadid'],
                $row['tbservicioid'],
                $row['tbfacturamontobruto'],
                $row['tbimpuestoventaid'],
                $row['tbfacturamontoneto'],
                $row['tbfacturaactivo']
            );
            array_push($Facturas, $current);
        }
        return $Facturas;
    }

    public function buscarFactura($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelectCliente = "SELECT * FROM tbcliente WHERE tbclientenombre LIKE '%$palabra%' OR tbclienteapellido1 LIKE '%$palabra%' OR
        tbclienteapellido2 LIKE '%$palabra%';";
        
        $resultCliente = mysqli_query($conn, $querySelectCliente);
        $idCliente = 0;
        while ($rowCliente = mysqli_fetch_array($resultCliente)) {
            if ($rowCliente['tbclienteactivo'] == 1) {
                $idCliente = $rowCliente['tbclienteid'];
            }
        }

        $querySelectInstructor = "SELECT * FROM tbinstructor WHERE tbinstructornombre LIKE '%$palabra%' OR tbinstructorapellido LIKE '%$palabra%';";
        $resultInstructor = mysqli_query($conn, $querySelectInstructor);
        $idInstructor = 0;
        while ($rowInstructor = mysqli_fetch_array($resultInstructor)) {
            if ($rowInstructor['tbinstructoractivo'] == 1) {
                $idInstructor = $rowInstructor['tbinstructorid'];
            }
        }

        $querySelectModalidad = "SELECT * FROM tbcatalogopagoperidiocidad Where tbcatalogopagoperidiocidadid LIKE '%$palabra%';";
        $resultModalidad = mysqli_query($conn, $querySelectModalidad);
        $idModalidad = 0;
        while ($rowModalidad = mysqli_fetch_array($resultModalidad)) {
            if ($rowModalidad['tbcatalogopagoperidiocidadactivo'] == 1) {
                $idModalidad = $rowModalidad['tbcatalogopagoperidiocidadid'];
            }
        }

        $querySelectServicio = "SELECT * FROM tbservicio WHERE tbservicionombre LIKE '%$palabra%';";
        $idServicio = 0;
        $resultServicio = mysqli_query($conn, $querySelectServicio);
        while ($rowServicio = mysqli_fetch_array($resultServicio)) {
            if ($rowServicio['tbservicioactivo'] == 1) {
                $idServicio = $rowServicio['tbservicioid'];
            }
        }

        
        $querySelectImpuesto = "SELECT * FROM tbimpuestoventa WHERE tbimpuestoventadescripcion LIKE '%$palabra%';";
        $resultImpuesto = mysqli_query($conn, $querySelectImpuesto);
        $idImpuesto=0;
        while ($rowimpuesto = mysqli_fetch_array($resultImpuesto)) {
            if ($rowimpuesto['tbimpuestoventaactivo'] == 1) {
                $idImpuesto = $rowimpuesto['tbimpuestoventaid'];
            }
        }

        $querySelect = "SELECT * FROM tbfactura WHERE tbfacturaid LIKE '%$palabra%' OR tbclienteid LIKE '%$idCliente%' OR tbinstructorid LIKE '%$idInstructor%' OR tbfacturafechapago LIKE '%$palabra%' OR tbcatalogopagoperidiocidadid LIKE '%$idModalidad%' OR tbservicioid LIKE '%$idServicio%' OR tbimpuestoventaid LIKE '%$idImpuesto%' OR tbfacturamontobruto LIKE '%$palabra%' OR tbfacturamontoneto LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $Facturas = [];
        while ($row = mysqli_fetch_array($result)) {
            if ($row['tbfacturaactivo'] == 1) {
                $currentDireccion = new Factura(
                    $row['tbfacturaid'],
                    $row['tbclienteid'],
                    $row['tbinstructorid'],
                    $row['tbfacturafechapago'],
                    $row['tbcatalogopagoperidiocidadid'],
                    $row['tbservicioid'],
                    $row['tbfacturamontobruto'],
                    $row['tbimpuestoventaid'],
                    $row['tbfacturamontoneto'],
                    $row['tbfacturaactivo']
                );
                array_push($Facturas, $currentDireccion);
            }
        }
        return $Facturas;
    }

    public function obtenerValorImpuesto($id){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbimpuestoventa WHERE tbimpuestoventaid = $id;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);

        while ($row = mysqli_fetch_array($result)) {
            if ($row['tbimpuestoventaactivo'] == 1) {
                $valorImpuesto = $row['tbimpuestoventavalor'];
            }
        }

        return $valorImpuesto;
    }
}
