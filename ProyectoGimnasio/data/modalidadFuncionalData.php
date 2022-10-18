<?php
include_once 'data.php';
include '../domain/modalidadFuncional.php';

class ModalidadFuncionalData extends Data{

    public function insertModalidadFuncional($ModalidadFuncional){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryGetLastId = "SELECT MAX(tbmodalidadfuncionalid) AS tbmodalidadfuncionalid  FROM tbmodalidadfuncional";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;
        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $tbmodalidadfuncionalnombre = $ModalidadFuncional->getNombreTBModalidadFuncional();
        $tbmodalidadfuncionaldescripcion = $ModalidadFuncional->getDescripcionTBModalidadFuncional();
        $tbmodalidadfuncionalactivo = $ModalidadFuncional->getActivoTBModalidadFuncional();

        $queryInsert = "INSERT INTO tbmodalidadfuncional VALUES ('$nextId','$tbmodalidadfuncionalnombre','$tbmodalidadfuncionaldescripcion','$tbmodalidadfuncionalactivo');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }

    public function updateModalidadFuncional($ModalidadFuncional){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $tbmodalidadfuncionalid = $ModalidadFuncional->getIdTBModalidadFuncional();
        $tbmodalidadfuncionalnombre = $ModalidadFuncional->getNombreTBModalidadFuncional();
        $tbmodalidadfuncionaldescripcion = $ModalidadFuncional->getDescripcionTBModalidadFuncional();

        $queryUpdate = "UPDATE tbmodalidadfuncional SET tbmodalidadfuncionalnombre='$tbmodalidadfuncionalnombre',
            tbmodalidadfuncionaldescripcion='$tbmodalidadfuncionaldescripcion' WHERE tbmodalidadfuncionalid = $tbmodalidadfuncionalid";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function deleteModalidadFuncional($tbmodalidadfuncionalid){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbmodalidadfuncional SET tbmodalidadfuncionalactivo = 0 WHERE tbmodalidadfuncionalid = $tbmodalidadfuncionalid";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getModalidadesFuncionales(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbmodalidadfuncional;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $ModalidadesFuncionales = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbmodalidadfuncionalactivo'] == 1){
                $currentModalidadFuncional = new ModalidadFuncional($row['tbmodalidadfuncionalid'], $row['tbmodalidadfuncionalnombre'],
                    $row['tbmodalidadfuncionaldescripcion'], $row['tbmodalidadfuncionalactivo']);
                array_push($ModalidadesFuncionales, $currentModalidadFuncional);
            }
        }
        return $ModalidadesFuncionales;
    }

    public function buscarModalidadesFuncionales($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbmodalidadfuncional WHERE tbmodalidadfuncionalid LIKE '%$palabra%' OR
            tbmodalidadfuncionalnombre LIKE '%$palabra%' OR tbmodalidadfuncionaldescripcion LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $ModalidadesFuncionales = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbmodalidadfuncionalactivo'] == 1){
                $currentModalidadFuncional = new ModalidadFuncional($row['tbmodalidadfuncionalid'], $row['tbmodalidadfuncionalnombre'],
                    $row['tbmodalidadfuncionaldescripcion'], $row['tbmodalidadfuncionalactivo']);
                array_push($ModalidadesFuncionales, $currentModalidadFuncional);
            }
        }
        return $ModalidadesFuncionales;
    }

};