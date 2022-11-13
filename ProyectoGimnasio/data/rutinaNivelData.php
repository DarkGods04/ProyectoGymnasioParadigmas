<?php
include_once 'data.php';
include '../domain/rutinaNivel.php';

class RutinaNivelData extends Data{

    public function insertRutinaNivel($rutinaNivel){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryGetLastId = "SELECT MAX(tbcatalogorutinanivelid) AS tbcatalogorutinanivelid FROM tbcatalogorutinanivel";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }
        
        $queryInsert = "INSERT INTO tbcatalogorutinanivel VALUES (" . $nextId .",'" . $rutinaNivel->getNombreTBRutinaNivel() . "','" . $rutinaNivel->getDescripcionTBRutinaNivel() . "','" . $rutinaNivel->getActivoTBRutinaNivel() . "');";
        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }

    public function deleteRutinaNivel($idTBrutinaNivel){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryDelete= "UPDATE tbcatalogorutinanivel SET tbcatalogorutinanivelactivo=0 WHERE tbcatalogorutinanivelid='$idTBrutinaNivel'";

        $result = mysqli_query($conn, $queryDelete);
        mysqli_close($conn);

        return $result;
    }

    public function updateRutinaNivel($rutinaNivel){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $idTBRutinaNivel = $rutinaNivel->getIDRutinaNivel();
        $nombreTBRutinaNivel = $rutinaNivel->getNombreTBRutinaNivel();
        $descripcionTBRutinaNivel = $rutinaNivel->getDescripcionTBRutinaNivel();

        $queryUpdate = "UPDATE tbcatalogorutinanivel SET tbcatalogorutinanivelnombre='$nombreTBRutinaNivel',
            tbcatalogorutinaniveldescripcion='$descripcionTBRutinaNivel' WHERE tbcatalogorutinanivelid = '$idTBRutinaNivel'";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getRutinaNivel(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcatalogorutinanivel;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $RutinaNiveles = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbcatalogorutinanivelactivo'] == 1){
                $currentRutinaNivel = new RutinaNivel($row['tbcatalogorutinanivelid'], $row['tbcatalogorutinanivelnombre'], 
                    $row['tbcatalogorutinaniveldescripcion'], $row['tbcatalogorutinanivelactivo']);
                array_push($RutinaNiveles, $currentRutinaNivel);
            }
        }
        return $RutinaNiveles;
    }

    
    public function buscarRutinaNivel($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcatalogorutinanivel Where tbcatalogorutinanivelid LIKE '%$palabra%' OR tbcatalogorutinanivelnombre LIKE '%$palabra%' OR tbcatalogorutinaniveldescripcion LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $RutinaNiveles = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbcatalogorutinanivelactivo'] == 1){
                $current = new RutinaNivel($row['tbcatalogorutinanivelid'],$row['tbcatalogorutinanivelnombre'],$row['tbcatalogorutinaniveldescripcion'],$row['tbcatalogorutinanivelactivo']);
                array_push($RutinaNiveles, $current);
            }
        }
        return $RutinaNiveles;
    }

}