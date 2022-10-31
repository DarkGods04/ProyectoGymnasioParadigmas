<?php
include_once 'data.php';
include '../domain/grupoMuscular.php';

class GrupoMuscularData extends Data{

    public function insertGrupoMuscular($grupoMuscular){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryGetLastId = "SELECT MAX(tbcatalogogrupomuscularid) AS tbcatalogogrupomuscularid FROM tbcatalogogrupomuscular";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }
        
        $queryInsert = "INSERT INTO tbcatalogogrupomuscular VALUES (" . $nextId .",'" . $grupoMuscular->getNombreTBGrupoMuscular() . "','" . $grupoMuscular->getDescripcionTBGrupoMuscular() . "','" . $grupoMuscular->getActivoTBGrupoMuscular() . "');";
        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }

    public function deleteGrupoMuscular($idTBGrupoMuscular){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryDelete= "UPDATE tbcatalogogrupomuscular SET tbcatalogogrupomuscularactivo=0 WHERE tbcatalogogrupomuscularid='$idTBGrupoMuscular'";

        $result = mysqli_query($conn, $queryDelete);
        mysqli_close($conn);

        return $result;
    }

    public function updateGrupoMuscular($grupoMuscular){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $idTBGrupoMuscular = $grupoMuscular->getIDGrupoMuscular();
        $nombreTBGrupoMuscular = $grupoMuscular->getNombreTBGrupoMuscular();
        $descripcionTBGrupoMuscular = $grupoMuscular->getDescripcionTBGrupoMuscular();

        $queryUpdate = "UPDATE tbcatalogogrupomuscular SET tbcatalogogrupomuscularnombre='$nombreTBGrupoMuscular',
            tbcatalogogrupomusculardescripcion='$descripcionTBGrupoMuscular' WHERE tbcatalogogrupomuscularid = '$idTBGrupoMuscular'";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getGrupoMuscular(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcatalogogrupomuscular;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $GruposMusculares = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbcatalogogrupomuscularactivo'] == 1){
                $currentGrupoMuscular = new GrupoMuscular($row['tbcatalogogrupomuscularid'], $row['tbcatalogogrupomuscularnombre'], 
                    $row['tbcatalogogrupomusculardescripcion'], $row['tbcatalogogrupomuscularactivo']);
                array_push($GruposMusculares, $currentGrupoMuscular);
            }
        }
        return $GruposMusculares;
    }

    
    public function buscarGrupoMuscular($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcatalogogrupomuscular Where tbcatalogogrupomuscularid LIKE '%$palabra%' OR tbcatalogogrupomuscularnombre LIKE '%$palabra%' OR tbcatalogogrupomusculardescripcion LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $gruposMusculares = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbcatalogogrupomuscularactivo'] == 1){
                $current = new GrupoMuscular($row['tbcatalogogrupomuscularid'],$row['tbcatalogogrupomuscularnombre'],$row['tbcatalogogrupomusculardescripcion'],$row['tbcatalogogrupomuscularactivo']);
                array_push($gruposMusculares, $current);
            }
        }
        return $gruposMusculares;
    }

}