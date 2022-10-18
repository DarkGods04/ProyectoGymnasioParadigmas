<?php

include_once 'data.php';
include '../domain/cliente.php';

class ClienteData extends Data {

    public function insertCliente($cliente){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbclienteid) AS tbclienteid FROM tbcliente";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbcliente VALUES (" . $nextId . ",'" . $cliente->getNombreTBCliente() . "','" .
                $cliente->getApellido1TBCliente() . "','" .  $cliente->getApellido2TBCliente() . "','" .
                $cliente->getTelefonoTBCliente() . "','" . $cliente->getFechaNacimientoTBCliente() . "','" .
                $cliente->getGeneroTBCliente() . "','" . $cliente->getPesoTBCliente() . "','" .
                $cliente->getAlturaTBCliente() . "','" . $cliente->getCorreoTBCliente() . "','" .
                $cliente->getActivoTBCliente() . "');";
                

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }


    public function deleteCliente($idCliente){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbcliente SET tbclienteactivo=0  WHERE tbclienteid=$idCliente";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function recuperarCliente($idCliente){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbcliente SET tbclienteactivo=1  WHERE tbclienteid=$idCliente";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function updateCliente($cliente){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $id = $cliente->getIdTBCliente();
        $nombre = $cliente->getNombreTBCliente();
        $apellido1 = $cliente->getApellido1TBCliente();
        $apellido2 = $cliente->getApellido2TBCliente();
        $correo = $cliente->getCorreoTBCliente();
        $fechaNacimiento = $cliente->getFechaNacimientoTBCliente();
        $genero = $cliente->getGeneroTBCliente();
        $peso = $cliente->getPesoTBCliente();
        $altura = $cliente->getAlturaTBCliente();
        $telefono = $cliente->getTelefonoTBCliente();

        $queryUpdate = "UPDATE tbcliente SET tbclientenombre='$nombre', tbclienteapellido1='$apellido1',
             tbclienteapellido2='$apellido2', tbclientecorreo='$correo', tbclientefechanacimiento='$fechaNacimiento',
            tbclientegenero='$genero', tbclientepeso='$peso', tbclientealtura='$altura', tbclientetelefono='$telefono' WHERE tbclienteid=$id";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getClientes(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcliente;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $Clientes = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentDireccion = new Cliente($row['tbclienteid'], $row['tbclientenombre'], 
            $row['tbclienteapellido1'], $row['tbclienteapellido2'], $row['tbclientetelefono'],
             $row['tbclientefechanacimiento'], $row['tbclientegenero'], $row['tbclientepeso'],
             $row['tbclientealtura'], $row['tbclientecorreo'], $row['tbclienteactivo']);
            array_push($Clientes, $currentDireccion);
        }
        return $Clientes;
    }

    public function buscarClientes($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcliente WHERE tbclienteid LIKE '%$palabra%' OR tbclientenombre LIKE '%$palabra%' OR tbclienteapellido1 LIKE '%$palabra%' OR
        tbclienteapellido2 LIKE '%$palabra%' OR tbclientetelefono LIKE '%$palabra%' OR tbclientefechanacimiento LIKE '%$palabra%' OR tbclientegenero LIKE '%$palabra%' OR 
        tbclientepeso LIKE '%$palabra%' OR tbclientealtura LIKE '%$palabra%' OR tbclientecorreo LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $Clientes = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentDireccion = new Cliente($row['tbclienteid'], $row['tbclientenombre'], 
            $row['tbclienteapellido1'], $row['tbclienteapellido2'], $row['tbclientetelefono'],
            $row['tbclientefechanacimiento'], $row['tbclientegenero'], $row['tbclientepeso'],
            $row['tbclientealtura'], $row['tbclientecorreo'], $row['tbclienteactivo']);
            array_push($Clientes, $currentDireccion);
            
        }
        return $Clientes;
    }

   
    
}

