<?php

include_once 'data.php';
include '../domain/activoFijo.php';

class ActivoFijoData extends Data {

    public function insertActivoFijo($activoFijo){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbactivofijoid) AS tbactivofijoid FROM tbactivofijo";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbactivofijo VALUES (" . $nextId . ",'" . $activoFijo->getPlaca() . "','" .
                $activoFijo->getSerie() . "','" . $activoFijo->getModelo() . "','" .
                $activoFijo->getFechaCompra() . "','" . $activoFijo->getMontoCompra() . "','" .
                $activoFijo->getEstadoUso() . "','" . $activoFijo->getActivo() .  "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }


    public function deleteActivoFijo($idActivo){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbactivofijo SET tbactivofijoactivo=0  WHERE tbactivofijoid=$idActivo";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function updateActivoFijo($activoFijo){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $id = $activoFijo->getIdActivo();
        $placa = $activoFijo->getPlaca();
        $serie = $activoFijo->getSerie();
        $modelo = $activoFijo->getModelo();
        $fechaCompra = $activoFijo->getFechaCompra();
        $montocompra = $activoFijo->getMontoCompra();
        $estadoUso = $activoFijo->getEstadoUso();

        $queryUpdate = "UPDATE tbactivofijo SET tbactivofijoplaca='$placa', tbactivofijoserie='$serie', tbactivofijomodelo='$modelo',
            tbactivofijofechacompra='$fechaCompra', tbactivofijomontocompra='$montocompra', tbactivofijoestadouso='$estadoUso'
            WHERE tbactivofijoid=$id";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getActivoFijo(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbactivofijo;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $ActivosFijos = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentDireccion = new ActivoFijo($row['tbactivofijoid'], $row['tbactivofijoplaca'],
                                                $row['tbactivofijoserie'], $row['tbactivofijomodelo'],
                                                $row['tbactivofijofechacompra'], $row['tbactivofijomontocompra'],
                                                $row['tbactivofijoestadouso'], $row['tbactivofijoactivo']);
            array_push($ActivosFijos, $currentDireccion);
        }
        return $ActivosFijos;
    }


    public function buscarActivoFijo($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbactivofijo WHERE tbactivofijoid LIKE '%$palabra%'
                        OR tbactivofijoplaca LIKE '%$palabra%' OR tbactivofijoserie LIKE '%$palabra%'
                        OR tbactivofijomodelo LIKE '%$palabra%' OR tbactivofijofechacompra LIKE '%$palabra%'
                        OR tbactivofijomontocompra LIKE '%$palabra%' OR tbactivofijoestadouso LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $ActivosFijos = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbactivofijoactivo'] == 1){
                $currentDireccion = new ActivoFijo($row['tbactivofijoid'], $row['tbactivofijoplaca'],
                                                    $row['tbactivofijoserie'], $row['tbactivofijomodelo'],
                                                    $row['tbactivofijofechacompra'], $row['tbactivofijomontocompra'],
                                                    $row['tbactivofijoestadouso'], $row['tbactivofijoactivo']);
                array_push($ActivosFijos, $currentDireccion);
            }
        }
        return $ActivosFijos;
    }

}
