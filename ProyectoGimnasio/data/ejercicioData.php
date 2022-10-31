<?php

include_once 'data.php';
include '../domain/ejercicio.php';

class EjercicioData extends Data {

    public function insertEjercicio($ejercicio){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbcatalogoejercicioid ) AS tbcatalogoejercicioid  FROM tbcatalogoejercicio";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 0;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbcatalogoejercicio VALUES (" . $nextId . ",'" . $ejercicio->getNombreEjercicio() . "','" .
                $ejercicio->getDescripcionEjercicio() .  "','" . $ejercicio->getActivoEjercicio() .  "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }


    public function deleteEjercicio($idEjercicio){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbcatalogoejercicio SET tbcatalogoejercicioactivo=0  WHERE tbcatalogoejercicioid =$idEjercicio";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function updateEjercicio($ejercicio){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $id = $ejercicio->getIdEjercicio();
        $nombre = $ejercicio->getNombreEjercicio();
        $descripcion = $ejercicio->getDescripcionEjercicio();
       
        $queryUpdate = "UPDATE tbcatalogoejercicio SET tbcatalogoejercicionombre='$nombre', tbcatalogoejerciciodescripcion='$descripcion' 
             WHERE tbcatalogoejercicioid =$id";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getEjercicio(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcatalogoejercicio;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $ejercicios = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentDireccion = new Ejercicio($row['tbcatalogoejercicioid'], $row['tbcatalogoejercicionombre'], $row['tbcatalogoejerciciodescripcion'], $row['tbcatalogoejercicioactivo']);
            array_push($ejercicios, $currentDireccion);
        }
        return $ejercicios;
    }

    public function buscarEjercicio($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcatalogoejercicio WHERE tbcatalogoejercicioid LIKE '%$palabra%' OR tbcatalogoejercicioid LIKE '%$palabra%' OR tbcatalogoejercicionombre LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $ejercicios = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbcatalogoejercicioactivo'] == 1){
                $currentDireccion = new Ejercicio($row['tbcatalogoejercicioid'], $row['tbcatalogoejercicionombre'], $row['tbcatalogoejerciciodescripcion'], $row['tbcatalogoejercicioactivo']);
                array_push($ejercicios, $currentDireccion);
            }
        }
        return $ejercicios;
    }

   
    
}