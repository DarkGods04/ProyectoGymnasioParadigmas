<?php

include_once 'data.php';
include '../domain/clientePeso.php';

class ClientePesoData extends Data{

    public function insertarClientePeso($clientePeso){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbclientepesoid) AS tbclientepesoid  FROM tbclientepeso";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbclientepeso VALUES (" . $nextId . ",'" . $clientePeso->getClienteID() . "','" .
        $clientePeso->getClientePesoFecha() . "','" . $clientePeso->getClientePesoPeso() . "','" .
        $clientePeso->getInstructorID() . "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }

    public function obtenerClientePeso(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbclientepeso;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);

        $ClientePeso = [];
        while ($row = mysqli_fetch_array($result)) {
        }
        return $ClientePeso;
    }

    public function buscarClientePeso($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelectCliente = "SELECT * FROM tbcliente WHERE tbclientenombre LIKE '%$palabra%';";
        $resultCliente = mysqli_query($conn, $querySelectCliente);
        $idCliente = 0;
        while ($rowCliente = mysqli_fetch_array($resultCliente)) {
            $idCliente = $rowCliente['tbclienteid'];
        }

        $querySelect = "SELECT * FROM tbclientepeso WHERE tbclientepesoid LIKE '%$palabra%' OR 	tbclientepesoclienteid LIKE '%$idCliente%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $ClientePeso = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentDireccion = new ClientePeso(
                $row['tbclientepesoid'],
                $row['tbclienteid'],
                $row['tbclientepesofecha'],
                $row['tbclientepesopeso'],
                $row['tbclientepesoinstructorid']
            );
            array_push($ClientePeso, $currentDireccion);
        }
        return $ClientePeso;
    }
};