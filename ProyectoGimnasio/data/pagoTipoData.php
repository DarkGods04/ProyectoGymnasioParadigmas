<?php

include_once 'data.php';
include '../domain/pagoTipo.php';

class PagoTipoData extends Data{

    public function insertPagoTipo($pagoTipo){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryGetLastId = "SELECT MAX(tbpagotipoid) AS tbpagotipoid FROM tbpagotipo";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbpagotipo
                            VALUES (" . $nextId .",'" . $pagoTipo->getNombreTBPagoTipo() . "','" .
                            $pagoTipo->getActivoTBPagoTipo() . "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }

    public function deletePagoTipo($idTBPagoTipo){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryDelete= "UPDATE tbpagotipo SET tbpagotipoactivo=0 WHERE tbpagotipoid='$idTBPagoTipo'";

        $result = mysqli_query($conn, $queryDelete);
        mysqli_close($conn);

        return $result;
    }

    public function updatePagoTipo($pagoTipo){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $idTBPagoTipo = $pagoTipo->getIDPagoTipo();
        $nombreTBPagoTipo = $pagoTipo->getNombreTBPagoTipo();

        $queryUpdate = "UPDATE tbpagotipo
                        SET tbpagotipotipo = '$nombreTBPagoTipo' 
                        WHERE tbpagotipoid = '$idTBPagoTipo'";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getPagosTipo(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbpagotipo;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $PagosTipo = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentDireccion = new PagoTipo($row['tbpagotipoid'], $row['tbpagotipotipo'], $row['tbpagotipoactivo']);
            array_push($PagosTipo, $currentDireccion);
        }
        return $PagosTipo;
    }

}