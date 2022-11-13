<?php

include_once 'data.php';
include '../domain/proveedor.php';

class ProveedorData extends Data {

    public function insertProveedor($proveedor){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbproveedorid) AS tbproveedorid FROM tbproveedor";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbproveedor VALUES (" . $nextId . ",'" . $proveedor->getNombreCompletoTBProveedor() . "','" .
            $proveedor->getCasaComercialTBProveedor() . "','" . $proveedor->getIdLineaProductosTBCatalogoLineaProductos() . "','" . 
            $proveedor->getActivoTBProveedor() . "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }

    public function updateProveedor($proveedor){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $id = $proveedor->getIdTBProveedor();
        $nombre = $proveedor->getNombreCompletoTBProveedor();
        $casaComercial = $proveedor->getCasaComercialTBProveedor();
        $idLineaProductos = $proveedor->getIdLineaProductosTBCatalogoLineaProductos();
       
        $queryUpdate = "UPDATE tbproveedor SET tbproveedornombrecompleto='$nombre',
            tbproveedorcasacomercial='$casaComercial', tbcatalogolineaproductosid='$idLineaProductos' 
            WHERE tbproveedorid=$id";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);
        return $result;
    }

    public function deleteProveedor($idProveedor){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbproveedor SET tbproveedoractivo=0  WHERE tbproveedorid=$idProveedor";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);
        return $result;
    }

    public function getProveedores(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbproveedor;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $proveedores = [];
        while ($row = mysqli_fetch_array($result)) {
            //if($row['tbproveedoractivo'] == 1){
                $current = new Proveedor($row['tbproveedorid'], $row['tbproveedornombrecompleto'], $row['tbproveedorcasacomercial'], $row['tbcatalogolineaproductosid'],$row['tbproveedoractivo']);
                array_push($proveedores, $current);
            //}
        }
        return $proveedores;
    }

    public function buscarProveedores($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbproveedor WHERE tbproveedorid LIKE '%$palabra%' OR tbproveedornombrecompleto LIKE '%$palabra%' OR
        tbproveedorcasacomercial LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $proveedores = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbproveedoractivo'] == 1){
                $current = new Proveedor($row['tbproveedorid'], $row['tbproveedornombrecompleto'], $row['tbproveedorcasacomercial'],
                    $row['tbcatalogolineaproductosid'], $row['tbproveedoractivo']);
                array_push($proveedores, $current);
            }
        }
        return $proveedores;
    }

};