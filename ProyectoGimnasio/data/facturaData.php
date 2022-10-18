<?php

include_once 'data.php';
include '../domain/factura.php';

class FacturaData extends Data {

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
             tbfacturafechapago='$fechaPago', tbfacturapagomodalidad='$pagoModalidad', tbfacturaservicios='$servicios',
             tbfacturamontobruto='$montoBruto', tbfacturaimpuestoventaid='$impuestoVentaid', tbfacturamontoneto='$montoNeto' WHERE tbfacturaid=$id";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getFacturas(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbfactura;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $Facturas = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentDireccion = new Factura($row['tbfacturaid'], $row['tbfacturaclienteid'], 
            $row['tbfacturainstructorid'], $row['tbfacturafechapago'], $row['tbfacturapagomodalidad'],
             $row['tbfacturaservicios'], $row['tbfacturamontobruto'], $row['tbfacturaimpuestoventaid'],
             $row['tbfacturamontoneto'], $row['tbfacturaactivo']);
            array_push($Facturas, $currentDireccion);
        }
        return $Facturas;
    }

    public function buscarFactura($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbfactura WHERE tbfacturaid LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $Facturas = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbfacturaactivo'] == 1){
                $currentDireccion = new Factura($row['tbfacturaid'], $row['tbfacturaclienteid'], 
                $row['tbfacturainstructorid'], $row['tbfacturafechapago'], $row['tbfacturapagomodalidad'],
                $row['tbfacturaservicios'], $row['tbfacturamontobruto'], $row['tbfacturaimpuestoventaid'],
                $row['tbfacturamontoneto'], $row['tbfacturaactivo']);
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
                if($row['tbimpuestoventaactivo'] == 1){
                    $valorImpuesto = $row['tbimpuestoventavalor'];
                }
       }
    
       return $valorImpuesto;
        
    }
   
    
}

