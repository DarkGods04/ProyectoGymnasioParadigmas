<?php

include_once 'data.php';
include '../domain/lineaProductos.php';

class LineaProductosData extends Data {

    public function insertLineaProductos($lineaProductos){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryGetLastId = "SELECT MAX(tbcatalogolineaproductosid) AS tbcatalogolineaproductosid  FROM tbcatalogolineaproductos";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }
        
        $nombre = $lineaProductos->getNombreTBCatalogoLineaProductos();
        $descripcion = $lineaProductos->getDescripcionTBCatalogoLineaProductos();
        $activo = $lineaProductos->getActivoTBCatalogoLineaProductos();

        $queryInsert =  "INSERT INTO tbcatalogolineaproductos VALUES ('$nextId','$nombre','$descripcion','$activo')";
        
        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }


    public function deleteLineaProductos($idLineaProductos){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbcatalogolineaproductos SET tbcatalogolineaproductosactivo=0  WHERE tbcatalogolineaproductosid=$idLineaProductos";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function updateLineaProductos($lineaProductos){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $id = $lineaProductos->getIdTBCatalogoLineaProductos();
        $nombre = $lineaProductos->getNombreTBCatalogoLineaProductos();
        $descripcion = $lineaProductos->getDescripcionTBCatalogoLineaProductos();

        $queryUpdate = "UPDATE tbcatalogolineaproductos SET tbcatalogolineaproductosnombre='$nombre',
            tbcatalogolineaproductosdescripcion='$descripcion' WHERE tbcatalogolineaproductosid = $id";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getLineaProductos(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcatalogolineaproductos;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $lineaProductos = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbcatalogolineaproductosactivo'] == 1){
                $current = new LineaProductos($row['tbcatalogolineaproductosid'],$row['tbcatalogolineaproductosnombre'],$row['tbcatalogolineaproductosdescripcion'],$row['tbcatalogolineaproductosactivo']);
                array_push($lineaProductos, $current);
            }
        }
        return $lineaProductos;
    }


    public function buscarLineaProductos($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcatalogolineaproductos WHERE tbcatalogolineaproductosid LIKE '%$palabra%' OR tbcatalogolineaproductosnombre LIKE '%$palabra%' OR tbcatalogolineaproductosdescripcion LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $lineaProductos = [];
        while ($row = mysqli_fetch_array($result)) {
            if($row['tbcatalogolineaproductosactivo'] == 1){
                $current = new LineaProductos($row['tbcatalogolineaproductosid'],$row['tbcatalogolineaproductosnombre'],$row['tbcatalogolineaproductosdescripcion'],$row['tbcatalogolineaproductosactivo']);
                array_push($lineaProductos, $current);
            }
        }
        return $lineaProductos;
    }

}

