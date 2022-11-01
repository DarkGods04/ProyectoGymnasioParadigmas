<?php
include_once 'data.php';
include '../domain/clienteTipo.php';

class ClienteTipoData extends Data{

    public function insertClienteTipo($clienteTipo){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryGetLastId = "SELECT MAX(tbcatalogoclientetipoid) AS tbcatalogoclientetipoid FROM tbcatalogoclientetipo";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }
        
        $queryInsert = "INSERT INTO tbcatalogoclientetipo VALUES (" . $nextId .",'" . $clienteTipo->getNombreTBClienteTipo() . "','" . $clienteTipo->getDescripcionTBClienteTipo() . "','" . $clienteTipo->getActivoTBClienteTipo() . "');";
        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }

    public function deleteClienteTipo($idclienteTipo){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryDelete= "UPDATE tbcatalogoclientetipo SET tbcatalogoclientetipoactivo=0 WHERE tbcatalogoclientetipoid='$idclienteTipo'";

        $result = mysqli_query($conn, $queryDelete);
        mysqli_close($conn);

        return $result;
    }

    public function updateClienteTipo($idclienteTipo){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $idTBClienteTipo = $idclienteTipo->getIDClienteTipo();
        $nombreTBClienteTipo = $idclienteTipo->getNombreTBClienteTipo();
        $descripcionTBClienteTipo = $idclienteTipo->getDescripcionTBClienteTipo();

        $queryUpdate = "UPDATE tbcatalogoclientetipo SET tbcatalogoclientetiponombre='$nombreTBClienteTipo',
            tbcatalogoclientetipodescripcion='$descripcionTBClienteTipo' WHERE tbcatalogoclientetipoid = '$idTBClienteTipo'";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getClienteTipo(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcatalogoclientetipo;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $Clientetipos = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbcatalogoclientetipoactivo'] == 1){
                $currentClienteTipo = new ClienteTipo($row['tbcatalogoclientetipoid'], $row['tbcatalogoclientetiponombre'], 
                    $row['tbcatalogoclientetipodescripcion'], $row['tbcatalogoclientetipoactivo']);
                array_push($Clientetipos, $currentClienteTipo);
            }
        }
        return $Clientetipos;
    }

    
    public function buscarClienteTipo($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcatalogoclientetipo Where tbcatalogoclientetipoid LIKE '%$palabra%' OR tbcatalogoclientetiponombre LIKE '%$palabra%' OR tbcatalogoclientetipodescripcion LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $Clientetipos = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbcatalogoclientetipoactivo'] == 1){
                $current = new ClienteTipo($row['tbcatalogoclientetipoid'],$row['tbcatalogoclientetiponombre'],$row['tbcatalogoclientetipodescripcion'],$row['tbcatalogoclientetipoactivo']);
                array_push($Clientetipos, $current);
            }
        }
        return $Clientetipos;
    }

}