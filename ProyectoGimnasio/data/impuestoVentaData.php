<?php

include_once 'data.php';
include '../domain/impuestoVenta.php';

class ImpuestoVentaData extends Data {

    public function insertImpuestoVenta($impuestoVenta){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbimpuestoventaid) AS tbimpuestoventaid FROM tbimpuestoventa";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 0;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbimpuestoventa VALUES (" . $nextId . "," . $impuestoVenta->getValorImpuestoVenta() . ",'" .
                $impuestoVenta->getDescripcionImpuestoVenta() .  "','" . $impuestoVenta->getActivoImpuestoVenta() .  "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }


    public function deleteImpuestoVenta($idImpuesto){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbimpuestoventa SET tbimpuestoventaactivo=0  WHERE tbimpuestoventaid=$idImpuesto";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function updateImpuestoVenta($impuestoVenta){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $id = $impuestoVenta->getIdImpuestoVenta();
        $valor = $impuestoVenta->getValorImpuestoVenta();
        $descripcion = $impuestoVenta->getDescripcionImpuestoVenta();
       
        $queryUpdate = "UPDATE tbimpuestoventa SET tbimpuestoventavalor='$valor', tbimpuestoventadescripcion='$descripcion' 
             WHERE tbimpuestoventaid =$id";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getImpuestoVenta(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbimpuestoventa;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $impuestosVentas = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentDireccion = new ImpuestoVenta($row['tbimpuestoventaid'], $row['tbimpuestoventavalor'], $row['tbimpuestoventadescripcion'], $row['tbimpuestoventaactivo']);
            array_push($impuestosVentas, $currentDireccion);
        }
        return $impuestosVentas;
    }

    public function buscarImpuestoVenta($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbimpuestoventa WHERE tbimpuestoventaid LIKE '%$palabra%' OR tbimpuestoventavalor LIKE '%$palabra%' OR tbimpuestoventadescripcion LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $impuestosVentas = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbimpuestoventaactivo'] == 1){
                $currentDireccion = new ImpuestoVenta($row['tbimpuestoventaid'], $row['tbimpuestoventavalor'], $row['tbimpuestoventadescripcion'], $row['tbimpuestoventaactivo']);
                array_push($impuestosVentas, $currentDireccion);
            }
        }
        return $impuestosVentas;
    }

   
    
}
