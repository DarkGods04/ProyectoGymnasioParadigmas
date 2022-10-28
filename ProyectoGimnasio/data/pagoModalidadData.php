<?php

include_once 'data.php';
include '../domain/pagoModalidad.php';

class PagoModalidadData extends Data {

    public function insertPagoModalidad($pagoModalidad){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryGetLastId = "SELECT MAX(tbpagomodalidadid) AS tbpagomodalidad  FROM tbpagomodalidad";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }
        
        $nombre = $pagoModalidad->getNombreTBpagoModalidad();
        $tbDescripcion = $pagoModalidad->getDescripcionTBpagoModalidad();
        $tbActivo = $pagoModalidad->getActivoTBpagoModalidad();

        $queryInsert =  "INSERT INTO tbpagomodalidad(tbpagomodalidadid,tbpagomodalidadnombre,tbpagomodalidaddescripcion,tbpagomodalidadactivo) VALUES ('$nextId','$nombre','$tbDescripcion','$tbActivo')";
        
        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }


    public function deletePagoModalidad($idPagoModalidad){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbpagomodalidad SET tbpagomodalidadactivo=0  WHERE tbpagomodalidadid=$idPagoModalidad";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function updatePagoModalidad($pagoModalidad){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $id = $pagoModalidad->getIdTBpagoModalidad();
        $tbNombre = $pagoModalidad->getNombreTBpagoModalidad();
        $tbDescripcion = $pagoModalidad->getDescripcionTBpagoModalidad();

        $queryUpdate = "UPDATE tbpagomodalidad SET tbpagomodalidadnombre='$tbNombre',tbpagomodalidaddescripcion='$tbDescripcion' WHERE tbpagomodalidadid = $id";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getPagoModalidad(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbpagomodalidad;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $pagoModalidadVe = [];
        while ($row = mysqli_fetch_array($result)) {

            $currentPagoModalidad = new PagoModalidad($row['tbpagomodalidadid'],$row['tbpagomodalidadnombre'],$row['tbpagomodalidaddescripcion'],$row['tbpagomodalidadactivo']);
            array_push($pagoModalidadVe, $currentPagoModalidad);
        }
        return $pagoModalidadVe;
    }


    public function buscarPagoModalidad($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbpagomodalidad Where tbpagomodalidadid LIKE '%$palabra%' OR tbpagomodalidadnombre LIKE '%$palabra%' OR tbpagomodalidaddescripcion LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $pagoModalidadVe = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbpagomodalidadactivo'] == 1){
                $currentPagoModalidad = new PagoModalidad($row['tbpagomodalidadid'],$row['tbpagomodalidadnombre'],$row['tbpagomodalidaddescripcion'],$row['tbpagomodalidadactivo']);
                array_push($pagoModalidadVe, $currentPagoModalidad);
            }
        }
        return $pagoModalidadVe;
    }

}

