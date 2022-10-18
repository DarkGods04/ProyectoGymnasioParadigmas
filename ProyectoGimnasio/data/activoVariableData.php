<?php

include_once 'data.php';
include '../domain/activoVariable.php';

class ActivoVariableData extends Data {

    public function insertActivoVariable($activoVariable){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryGetLastId = "SELECT MAX(tbactivovariableid) AS tbactivovariable  FROM tbactivovariable";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }
        
        $tbname = $activoVariable->getNameTBActivo();
        $tbcantidad = $activoVariable->getCantidadTBActivo();
        $tbmontoCompra = $activoVariable->getMontoCompraTBActivo();
        $tbdescripcion = $activoVariable->getDescripcionTBActivo();
        $tbactivovariable = $activoVariable->getActivoTBActivo();
        $queryInsert =  "INSERT INTO tbactivovariable(tbactivovariableid, tbactivovariablenombre, tbactivovariablecantidad, tbactivovariablemontocompra, tbactivovariabledescripcion, tbactivovariableactivo)
                        VALUES('$nextId','$tbname','$tbcantidad','$tbmontoCompra','$tbdescripcion','$tbactivovariable')";
        
        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }


    public function deleteActivoVariable($idActivoVariable){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbactivovariable SET tbactivovariableactivo=0  WHERE tbactivovariableid=$idActivoVariable";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function updateActivoVariable($activoVariable){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $id = $activoVariable->getIdTBActivo();
        $tbname = $activoVariable->getNameTBActivo();
        $tbdescripcion = $activoVariable->getDescripcionTBActivo();
        $tbcantidad = $activoVariable->getCantidadTBActivo();
        $tbmontoCompra = $activoVariable->getMontoCompraTBActivo();

        $queryUpdate = "UPDATE tbactivovariable 
                        SET tbactivovariablecantidad='$tbcantidad',tbactivovariabledescripcion='$tbdescripcion',tbactivovariablenombre='$tbname',tbactivovariablemontocompra='$tbmontoCompra'
                        WHERE tbactivovariableid = $id";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getActivoVariable(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbactivovariable;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $ActivosVariables = [];
        while ($row = mysqli_fetch_array($result)) {

            $currentActivo = new ActivoVariable($row['tbactivovariableid'],$row['tbactivovariablenombre'],
                                                $row['tbactivovariabledescripcion'],$row['tbactivovariablecantidad'],
                                                $row['tbactivovariablemontocompra'],$row['tbactivovariableactivo']);
            array_push($ActivosVariables, $currentActivo);
        }
        return $ActivosVariables;
    }


    public function buscarActivoVariable($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbactivovariable Where tbactivovariableid LIKE '%$palabra%' OR tbactivovariablenombre LIKE '%$palabra%' OR tbactivovariablecantidad LIKE '%$palabra%' OR tbactivovariabledescripcion LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $ActivosVariables = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbactivovariableactivo'] == 1){
                $currentActivo = new ActivoVariable($row['tbactivovariableid'],$row['tbactivovariablenombre'],
                                                    $row['tbactivovariabledescripcion'],$row['tbactivovariablecantidad'],
                                                    $row['tbactivovariablemontocompra'],$row['tbactivovariableactivo']);
                array_push($ActivosVariables, $currentActivo);
            }
        }
        return $ActivosVariables;
    }

}

