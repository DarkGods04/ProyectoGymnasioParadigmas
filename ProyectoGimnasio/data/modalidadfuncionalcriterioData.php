<?php

include_once 'data.php';
include '../domain/modalidadfuncionalcriterio.php';

class ModalidadfuncionalcriterioData extends Data {

    public function insertModalidadfuncionalcriterio($modalidadfuncionalcriterio){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbmodalidadfuncionalcriterioid) AS tbmodalidadfuncionalcriterioid FROM tbmodalidadfuncionalcriterio";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbmodalidadfuncionalcriterio VALUES (" . $nextId . ",'" . $modalidadfuncionalcriterio->getIdModalidadfuncionalTBModalidadfuncionalcriterio() . "','" .
                $modalidadfuncionalcriterio->getNombreTBModalidadfuncionalcriterio() . "','" . $modalidadfuncionalcriterio->getDescripcionTBModalidadfuncionalcriterio() . "','" .
                $modalidadfuncionalcriterio->getRangoValorMaximoTBModalidadfuncionalcriterio() . "','" . $modalidadfuncionalcriterio->getRangoValorMinimoTBModalidadfuncionalcriterio() . "','" .
                $modalidadfuncionalcriterio->getActivoTBModalidadfuncionalcriterio() . "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }

 

 
    public function updateModalidadfuncionalcriterio($modalidadfuncionalcriterio){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $id = $modalidadfuncionalcriterio->getIdTBModalidadfuncionalcriterio();
        $idmodalidadfuncional = $modalidadfuncionalcriterio->getIdModalidadfuncionalTBModalidadfuncionalcriterio();
        $nombre = $modalidadfuncionalcriterio->getNombreTBModalidadfuncionalcriterio();
        $descripcion = $modalidadfuncionalcriterio->getDescripcionTBModalidadfuncionalcriterio();
        $rangoMaximo = $modalidadfuncionalcriterio->getRangoValorMaximoTBModalidadfuncionalcriterio();
        $rangoMinimo = $modalidadfuncionalcriterio->getRangoValorMinimoTBModalidadfuncionalcriterio();
        

        echo '<script>alert("Alfinnn")</script>';
       
        $queryUpdate = "UPDATE tbmodalidadfuncionalcriterio 
                        SET tbmodalidadfuncionalcriteriomodalidadfuncionalid='$idmodalidadfuncional',
                        tbmodalidadfuncionalcriterionombre='$nombre', tbmodalidadfuncionalcriteriodescripcion='$descripcion',
                        tbmodalidadfuncionalcriteriorangomaximo='$rangoMaximo', modalidadfuncionalcriteriorangominimo='$rangoMinimo'
                        WHERE tbmodalidadfuncionalcriterioid=$id";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);
        return $result;
    }


    




    public function deleteModalidadfuncionalcriterio($idModalidadfuncionalcriterio){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbmodalidadfuncionalcriterio SET tbmodalidadfuncionalcriterioactivo=0  WHERE tbmodalidadfuncionalcriterioid=$idModalidadfuncionalcriterio";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    

    public function getModalidadfuncionalcriterio(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbmodalidadfuncionalcriterio;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $Modalidadfuncionalcriterios = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentDireccion = new Modalidadfuncionalcriterio($row['tbmodalidadfuncionalcriterioid'], $row['tbmodalidadfuncionalcriteriomodalidadfuncionalid'], $row['tbmodalidadfuncionalcriterionombre'], $row['tbmodalidadfuncionalcriteriodescripcion'],$row['tbmodalidadfuncionalcriteriorangomaximo'], $row['tbmodalidadfuncionalcriteriorangominimo'],$row['tbmodalidadfuncionalcriterioactivo']);
            array_push($Modalidadfuncionalcriterios, $currentDireccion);
        }
        return $Modalidadfuncionalcriterios;
    }


    public function buscarModalidadfuncionalcriterio($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbmodalidadfuncionalcriterio WHERE tbmodalidadfuncionalcriterioid LIKE '%$palabra%' OR tbmodalidadfuncionalcriteriomodalidadfuncionalid LIKE '%$palabra%' OR
        tbmodalidadfuncionalcriterionombre LIKE '%$palabra%' OR tbmodalidadfuncionalcriteriodescripcion LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $Modalidadfuncionalcriterios = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbmodalidadfuncionalcriterioactivo'] == 1){
                $currentDireccion = new Modalidadfuncionalcriterio($row['tbmodalidadfuncionalcriterioid'], $row['tbmodalidadfuncionalcriteriomodalidadfuncionalid'],
                                                    $row['tbmodalidadfuncionalcriterionombre'], $row['tbmodalidadfuncionalcriteriodescripcion'],
                                                    $row['tbmodalidadfuncionalcriteriorangomaximo'], $row['tbmodalidadfuncionalcriteriorangominimo'],
                                                    $row['tbmodalidadfuncionalcriterioactivo']);
                array_push($Modalidadfuncionalcriterios, $currentDireccion);
            }
        }
        return $Modalidadfuncionalcriterios;
    }

};