<?php
include_once 'data.php';
include '../domain/categorizacionCliente.php';

class CategorizacionClienteData extends Data{

    public function insertCategorizacionCliente($categorizacionCliente){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryGetLastId = "SELECT MAX(tbcategorizacionclienteid) AS tbcategorizacionclienteid  FROM tbcategorizacioncliente";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }
        
        $queryInsert = "INSERT INTO tbcategorizacioncliente VALUES (" . $nextId .",'" . $categorizacionCliente->getIdCliente() . "','" . $categorizacionCliente->getIdTipoCliente() . "','" . $categorizacionCliente->getCategorizacionClienteActivo() . "');";
        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }

    public function deleteCategorizacionCliente($idCategorizacionCliente){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryDelete= "UPDATE tbcategorizacioncliente SET tbcategorizacionclienteactivo=0 WHERE tbcategorizacionclienteid='$idCategorizacionCliente'";

        $result = mysqli_query($conn, $queryDelete);
        mysqli_close($conn);

        return $result;
    }

    public function updateCategorizacionCliente($categorizacionCliente){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $idCategorizacionCliente = $categorizacionCliente->getIdCategorizacionCliente();
        $idCliente = $categorizacionCliente->getIdCliente();
        $idTipoCliente = $categorizacionCliente->getIdTipoCliente();

        $queryUpdate = "UPDATE tbcategorizacioncliente SET tbclienteid='$idCliente',
            tbcatalogoclientetipoid='$idTipoCliente' WHERE tbcategorizacionclienteid = '$idCategorizacionCliente'";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getCategorizacionCliente(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcategorizacioncliente;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $categorizacionCliente = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbcategorizacionclienteactivo'] == 1){
                $currentCategorizacion = new CategorizacionCliente(
                 $row['tbcategorizacionclienteid'], 
                 $row['tbclienteid'], 
                 $row['tbcatalogoclientetipoid'],
                 $row['tbcategorizacionclienteactivo']);
                array_push($categorizacionCliente, $currentCategorizacion);
            }
        }
        return $categorizacionCliente;
    }

    
    public function buscarCategorizacion($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcategorizacioncliente Where tbcategorizacionclienteid LIKE '%$palabra%' OR tbclienteid LIKE '%$palabra%' OR tbcatalogoclientetipoid LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $categorizaciones = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbcategorizacionclienteactivo'] == 1){
                $current = new CategorizacionCliente(
                $row['tbcategorizacionclienteid'],
                $row['tbclienteid'],
                $row['tbcatalogoclientetipoid'],
                $row['tbcategorizacionclienteactivo']);
                array_push($categorizaciones, $current);
            }
        }
        return $categorizaciones;
    }

}