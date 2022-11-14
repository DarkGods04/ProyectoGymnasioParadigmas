<?php
include_once 'data.php';
include '../domain/facturaDetalle.php';

class FacturaDetalleData extends Data{

    public function insertFacturaDetalle($facturaDetalle){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbfacturadetalleid) AS tbfacturadetalleid FROM tbfacturadetalle";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbfacturadetalle VALUES (" . $nextId . ",'" . $facturaDetalle->getIdTBFacturaDetalle() . "','" .
            $facturaDetalle->getIdServicioTBFacturaDetalle() . "','" .  $facturaDetalle->getIdTBFactura() . "','" .
            $facturaDetalle->getMontoBrutoTBFacturaDetalle() . "','" . $facturaDetalle->getActivoTBFacturaDetalle() . "','" .
            $facturaDetalle->getCantidadTBServicioFacturaDetalle() . "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }


    public function deleteFacturaDetalle($idFacturaDetalle){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbfacturadetalle SET tbfacturadetalleactivo=0  WHERE tbfacturadetalleid=$idFacturaDetalle";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getFacturaDetalle(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbfacturadetalle;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);

        $FacturaDetalle = [];
        while ($row = mysqli_fetch_array($result)) {
            $current = new Factura(
                $row['tbfacturadetalleid'],
                $row['tbfacturaid'],
                $row['tbservicioid'],
                $row['tbfacturadetallemontobruto'],
                $row['tbfacturadetalleactivo'],
                $row['tbserviciocantidad']
            );
            array_push($FacturaDetalle, $current);
        }
        return $FacturaDetalle;
    }
}