<?php
include_once 'data.php';
include '../domain/pagoMetodo.php';

class PagoMetodoData extends Data{

    public function insertPagoMetodo($pagoMetodo){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryGetLastId = "SELECT MAX(tbcatalogopagometodoid) AS tbcatalogopagometodoid FROM tbcatalogopagometodo";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbcatalogopagometodo VALUES (" . $nextId .",'" . $pagoMetodo->getNombreTBPagoMetodo() . "','" . $pagoMetodo->getDescripcionTBPagoMetodo() . "','" . $pagoMetodo->getActivoTBPagoMetodo() . "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }

    public function deletePagoMetodo($idTBPagoMetodo){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryDelete= "UPDATE tbcatalogopagometodo SET tbcatalogopagometodoactivo=0 WHERE tbcatalogopagometodoid='$idTBPagoMetodo'";

        $result = mysqli_query($conn, $queryDelete);
        mysqli_close($conn);

        return $result;
    }

    public function updatePagoMetodo($pagoMetodo){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $idTBPagoMetodo = $pagoMetodo->getIDPagoMetodo();
        $nombreTBPagoMetodo = $pagoMetodo->getNombreTBPagoMetodo();
        $descripcionTBPagoMetodo = $pagoMetodo->getDescripcionTBPagoMetodo();

        $queryUpdate = "UPDATE tbcatalogopagometodo SET tbcatalogopagometodonombre='$nombreTBPagoMetodo',
            tbcatalogopagometododescripcion='$descripcionTBPagoMetodo' WHERE tbcatalogopagometodoid = '$idTBPagoMetodo'";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getPagoMetodos(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcatalogopagometodo;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $PagosMetodo = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbcatalogopagometodoactivo'] == 1){
                $currentPagoMetodo = new PagoMetodo($row['tbcatalogopagometodoid'], $row['tbcatalogopagometodonombre'], 
                    $row['tbcatalogopagometododescripcion'], $row['tbcatalogopagometodoactivo']);
                array_push($PagosMetodo, $currentPagoMetodo);
            }
        }
        return $PagosMetodo;
    }

}