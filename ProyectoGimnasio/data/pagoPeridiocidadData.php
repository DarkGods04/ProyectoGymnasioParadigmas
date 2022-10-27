<?php

include_once 'data.php';
include '../domain/pagoPeridiocidad.php';

class PagoPeridiocidadData extends Data {

    public function insertPagoPeridiocidad($pagoPeridiocidad){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryGetLastId = "SELECT MAX(tbcatalogopagoperidiocidadid) AS tbcatalogopagoperidiocidadid  FROM tbcatalogopagoperidiocidad";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }
        
        $nombre = $pagoPeridiocidad->getNombreTBPagoPeridiocidad();
        $descripcion = $pagoPeridiocidad->getDescripcionTBPagoPeridiocidad();
        $activo = $pagoPeridiocidad->getActivoTBPagoPeridiocidad();

        $queryInsert =  "INSERT INTO tbcatalogopagoperidiocidad VALUES ('$nextId','$nombre','$descripcion','$activo')";
        
        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }


    public function deletePagoPeridiocidad($idPagoPeridiocidad){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbcatalogopagoperidiocidad SET tbcatalogopagoperidiocidadactivo=0  WHERE tbcatalogopagoperidiocidadid=$idPagoPeridiocidad";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function updatePagoPeridiocidad($pagoPeridiocidad){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $id = $pagoPeridiocidad->getIdTBPagoPeridiocidad();
        $nombre = $pagoPeridiocidad->getNombreTBPagoPeridiocidad();
        $descripcion = $pagoPeridiocidad->getDescripcionTBPagoPeridiocidad();

        $queryUpdate = "UPDATE tbcatalogopagoperidiocidad SET tbcatalogopagoperidiocidadnombre='$nombre',
            tbcatalogopagoperidiocidaddescripcion='$descripcion' WHERE tbcatalogopagoperidiocidadid = $id";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getPagoPeridiocidad(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcatalogopagoperidiocidad;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $pagoPeridiocidades = [];
        while ($row = mysqli_fetch_array($result)) {
            $current = new PagoPeridiocidad($row['tbcatalogopagoperidiocidadid'],$row['tbcatalogopagoperidiocidadnombre'],$row['tbcatalogopagoperidiocidaddescripcion'],$row['tbcatalogopagoperidiocidadactivo']);
            array_push($pagoPeridiocidades, $current);
        }
        return $pagoPeridiocidades;
    }


    public function buscarPagoPeridiocidad($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcatalogopagoperidiocidad Where tbcatalogopagoperidiocidadid LIKE '%$palabra%' OR tbcatalogopagoperidiocidadnombre LIKE '%$palabra%' OR tbcatalogopagoperidiocidaddescripcion LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $pagoPeridiocidades = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbcatalogopagoperidiocidadactivo'] == 1){
                $current = new PagoPeridiocidad($row['tbcatalogopagoperidiocidadid'],$row['tbcatalogopagoperidiocidadnombre'],$row['tbcatalogopagoperidiocidaddescripcion'],$row['tbcatalogopagoperidiocidadactivo']);
                array_push($pagoPeridiocidades, $current);
            }
        }
        return $pagoPeridiocidades;
    }

}

