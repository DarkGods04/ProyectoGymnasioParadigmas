<?php

include_once 'data.php';
include '../domain/producto.php';


class ProductoData extends Data {

    public function insertProducto($producto){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbproductoid) AS tbproductoid FROM tbproducto";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbproducto VALUES (" . $nextId . ",'" . $producto->getNombreTBProducto() . "','" .
                $producto->getDescripcionTBProducto() .  "','" . $producto->getIdLineaProductosTBProducto() . "','" . $producto->getPrecioCompraTBProducto() . "','" .
                $producto->getPrecioVentaTBProducto() . "','" . $producto->getCantidadTBProducto() . "','" .
                $producto->getActivoTBProducto() . "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }


    public function deleteProducto($idProducto){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbproducto SET tbproductoactivo=0  WHERE tbproductoid=$idProducto";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function updateProducto($producto){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $id = $producto->getIdTBProducto();
        $nombre = $producto->getNombreTBProducto();
        $descripcion = $producto->getDescripcionTBProducto();
        $idlineaProducto = $producto->getIdLineaProductosTBProducto();
        $precioCompra = $producto->getPrecioCompraTBProducto();
        $precioVenta = $producto->getPrecioVentaTBProducto();
        $cantidad = $producto->getCantidadTBProducto();
     

        $queryUpdate = "UPDATE tbproducto SET tbproductonombre='$nombre', tbproductodescripcion='$descripcion',
            tbcatalogolineaproductosid='$idlineaProducto', tbproductopreciocompra='$precioCompra', tbproductoprecioventa=$precioVenta, tbproductocantidad='$cantidad' WHERE tbproductoid =$id";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getProductos(){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbproducto;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $productos = [];
   
        while ($row = mysqli_fetch_array($result)) {
            $currentDireccion = new Producto($row['tbproductoid'], $row['tbproductonombre'], $row['tbproductodescripcion'], $row['tbcatalogolineaproductosid'], $row['tbproductopreciocompra'], $row['tbproductoprecioventa'], $row['tbproductocantidad'], $row['tbproductoactivo']);
            array_push($productos, $currentDireccion);
        }
        return $productos;
    }
    
    public function buscarProductos($palabra){
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbproducto WHERE tbproductoid LIKE '%$palabra%' OR tbproductonombre LIKE '%$palabra%' OR tbproductodescripcion LIKE '%$palabra%' OR tbcatalogolineaproductosid LIKE '%$palabra%' OR tbproductocantidad LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        
        $productos = [];
        while($row = mysqli_fetch_array($result)) {

            if($row['tbproductoactivo'] == 1){
                $currentProducto = new Producto($row['tbproductoid'], $row['tbproductonombre'], $row['tbproductodescripcion'], $row['tbcatalogolineaproductosid'], $row['tbproductopreciocompra'], $row['tbproductoprecioventa'], $row['tbproductocantidad'], $row['tbproductoactivo']);
                array_push($productos, $currentProducto);
            }

        }
        return $productos;
    }
    
}

