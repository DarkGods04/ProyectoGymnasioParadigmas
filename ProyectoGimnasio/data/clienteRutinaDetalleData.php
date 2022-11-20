<?php
include_once 'data.php';
include '../domain/clienteRutinaDetalle.php';

class ClienteRutinaDetalleData extends Data{

    public function insertClienteRutinaDetalle($clienteRutinaDetalle){
   
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbclienterutinadetalleid) AS tbclienterutinadetalleid FROM tbclienterutinadetalle";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbclienterutinadetalle VALUES (" . $nextId . ",'" . $clienteRutinaDetalle->getIdClienteRutina() . "','" .  $clienteRutinaDetalle->getIdEjercicio() . "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }

    public function updateClienteRutinaDetalle($clienteRutinaDetalle){

    }

    public function getClienteRutinaDetalle(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbclienterutinadetalle;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);

        $ClienteRutinaDetalle = [];
        while ($row = mysqli_fetch_array($result)) {
	
            $current = new ClienteRutinaDetalle(
                $row['tbclienterutinadetalleid'],
                $row['tbclienterutinaid'],
                $row['tbejercicioid']);
            array_push($ClienteRutinaDetalle, $current);
        }
        return $ClienteRutinaDetalle;
    }
}