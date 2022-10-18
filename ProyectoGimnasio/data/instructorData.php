<?php

include_once 'data.php';
include '../domain/instructor.php';

class InstructorData extends Data {

    public function insertInstructor($instructor){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbinstructorid) AS tbinstructorid FROM tbinstructor";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbinstructor VALUES (" . $nextId . ",'" . $instructor->getNombreTBInstructor() . "','" .
                $instructor->getApellidoTBInstructor() . "','" . $instructor->getCorreoTBInstructor() . "','" .
                $instructor->getTelefonoTBInstructor() . "','" . $instructor->getNumCuentaTBInstructor() . "','" .
                $instructor->getTipoTBInstructor() . "','" . $instructor->getActivoTBInstructor() . "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }


    public function deleteInstructor($idInstructor){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbinstructor SET tbinstructoractivo=0  WHERE tbinstructorid=$idInstructor";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function updateInstructor($instructor){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $id = $instructor->getIdTBInstructor();
        $nombre = $instructor->getNombreTBInstructor();
        $apellido = $instructor->getApellidoTBInstructor();
        $correo = $instructor->getCorreoTBInstructor();
        $telefono = $instructor->getTelefonoTBInstructor();
        $numcuenta = $instructor->getNumCuentaTBInstructor();
        $tipoinstructor = $instructor->getTipoTBInstructor();

        $queryUpdate = "UPDATE tbinstructor SET tbinstructornombre='$nombre', tbinstructorapellido='$apellido',
            tbinstructorcorreo='$correo', tbinstructortelefono=$telefono, tbinstructornumcuenta='$numcuenta',
            tbinstructortipo='$tipoinstructor' WHERE tbinstructorid=$id";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getInstructores(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbinstructor;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $Instructores = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentDireccion = new Instructor($row['tbinstructorid'], $row['tbinstructornombre'], $row['tbinstructorapellido'], $row['tbinstructorcorreo'], $row['tbinstructortelefono'], $row['tbinstructornumcuenta'], $row['tbinstructortipo'], $row['tbinstructoractivo']);
            array_push($Instructores, $currentDireccion);
        }
        return $Instructores;
    }
    
    public function buscarInstructores($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbinstructor WHERE tbinstructorid LIKE '%$palabra%' OR tbinstructornombre LIKE '%$palabra%' OR tbinstructorapellido LIKE '%$palabra%' OR
        tbinstructorcorreo LIKE '%$palabra%' OR tbinstructortelefono LIKE '%$palabra%' OR tbinstructornumcuenta LIKE '%$palabra%' OR tbinstructortipo LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $Instructores = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbinstructoractivo'] == 1){
                $currentInstructor = new Instructor($row['tbinstructorid'], $row['tbinstructornombre'], $row['tbinstructorapellido'], $row['tbinstructorcorreo'], $row['tbinstructortelefono'], $row['tbinstructornumcuenta'], $row['tbinstructortipo'], $row['tbinstructoractivo']);
                array_push($Instructores, $currentInstructor);
            }
        }
        return $Instructores;
    }


   
    
}

