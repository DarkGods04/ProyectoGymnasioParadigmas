<?php

include_once 'data.php';
include '../domain/medidaIsometrica.php';

class MedidaIsometricaData extends Data {

    public function insertMedida($medida){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbmedidaisometricaid  ) AS tbmedidaisometricaid   FROM tbmedidaisometrica";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 0;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbmedidaisometrica VALUES (" . $nextId . "," . $medida->getIdGrupoMuscular() . "," .
                $medida->getIdCliente() .  ",'" . $medida->getFechaMedicion() . "'," . $medida->getMedida() . "," . $medida->getActivo() . ");";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }


    public function deleteMedida($idMedida){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbmedidaisometrica SET tbmedidaisometricaactivo=0  WHERE tbmedidaisometricaid  = $idMedida";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function updateMedida($medida){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $id = $medida->getIdMedida();
        $idGrupoMuscular = $medida->getIdGrupoMuscular();
        $idCliente = $medida->getIdCliente();
        $fechaMedicion = $medida->getFechaMedicion();
        $medidaIsometrica = $medida->getMedida();

       
        $queryUpdate = "UPDATE tbmedidaisometrica SET tbgrupomuscularid='$idGrupoMuscular', tbclienteid='$idCliente', tbmedidaisometricafechamedicion='$fechaMedicion',  
          tbmedidaisometricamedida='$medidaIsometrica'  WHERE tbmedidaisometricaid =$id";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getMedida(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbmedidaisometrica;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $medidas = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentDireccion = new MedidaIsometrica($row['tbmedidaisometricaid'], $row['tbgrupomuscularid'], $row['tbclienteid'], $row['tbmedidaisometricafechamedicion'], $row['tbmedidaisometricamedida'], $row['tbmedidaisometricaactivo']);
            array_push($medidas, $currentDireccion);
        }
        return $medidas;
    }

    public function buscarMedida($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelectGrupoMuscular = "SELECT * FROM tbcatalogogrupomuscular WHERE tbcatalogogrupomuscularnombre LIKE '%$palabra%';";
        
        $resultGrupoMuscular = mysqli_query($conn, $querySelectGrupoMuscular);
        $idGrupoMuscular = 0;
        while ($rowGrupoMuscular = mysqli_fetch_array($resultGrupoMuscular)) {
            if ($rowGrupoMuscular['tbcatalogogrupomuscularactivo'] == 1) {
                $idGrupoMuscular = $rowGrupoMuscular['tbcatalogogrupomuscularid'];
            }
        }

        $querySelectCliente = "SELECT * FROM tbcliente WHERE tbclientenombre LIKE '%$palabra%' OR tbclienteapellido1 LIKE '%$palabra%' OR
        tbclienteapellido2 LIKE '%$palabra%';";
        
        $resultCliente = mysqli_query($conn, $querySelectCliente);
        $idCliente = 0;
        while ($rowCliente = mysqli_fetch_array($resultCliente)) {
            if ($rowCliente['tbclienteactivo'] == 1) {
                $idCliente = $rowCliente['tbclienteid'];
            }
        }

        $querySelect = "SELECT * FROM tbmedidaisometrica WHERE tbmedidaisometricaid LIKE '%$palabra%' 
                  OR tbgrupomuscularid LIKE '%$idGrupoMuscular%' OR tbclienteid LIKE '%$idCliente%'  OR tbmedidaisometricamedida LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $medidas = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbmedidaisometricaactivo'] == 1){
                $currentDireccion = new MedidaIsometrica($row['tbmedidaisometricaid'], $row['tbgrupomuscularid'], $row['tbclienteid'], $row['tbmedidaisometricafechamedicion'], $row['tbmedidaisometricamedida'],$row['tbmedidaisometricaactivo']);
                array_push($medidas, $currentDireccion);
            }
        }
        return $medidas;
    }

   
    
}