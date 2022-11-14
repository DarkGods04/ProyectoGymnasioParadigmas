<?php
include_once 'data.php';
include '../domain/compraDetalle.php';

class CompraDetalleData extends Data
{

    public function insertCompraDetalle($compraDetalle)
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbcompradetalleid) AS tbcompradetalleid FROM tbcompradetalle";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbcompradetalle VALUES (" . $nextId . ",'" . $compraDetalle->getIdCompra() . "','" .
            $compraDetalle->getIdProducto() . "','" .  $compraDetalle->getCantidadProducto() . "','" .
            $compraDetalle->getPrecioBrutoProducto() . "','" . $compraDetalle->getCompraDetalleActivo() . "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }


    public function deleteCompraDetalle($idCompraDetalle)
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbcompradetalle SET tbcompradetalleactivo=0 WHERE tbcompradetalleid=$idCompraDetalle;";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getComprasDetalles()
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcompradetalle;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);

        $ComprasDetalles = [];
        while ($row = mysqli_fetch_array($result)) {
            $current = new Compra(
                $row['tbcompradetalleid'],
                $row['tbcompraid'],
                $row['tbproductoid'],
                $row['tbproductocantidad'],
                $row['tbproductopreciobruto'],
                $row['tbcompradetalleactivo'],

            );
            array_push($ComprasDetalles, $current);
        }
        return $ComprasDetalles;
    }

    public function buscarCompraDetalle($palabra)
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');



        $querySelect = "SELECT * FROM tbcompradetalle WHERE tbcompradetalleid LIKE '%$palabra%' OR tbcompraid LIKE '%$palabra%' OR tbproductoid LIKE '%$palabra%' OR tbproductocantidad LIKE '%$palabra%' OR tbproductopreciobruto LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $ComprasDetalles = [];
        while ($row = mysqli_fetch_array($result)) {
            if ($row['tbcompradetalleactivo'] == 1) {
                $currentDireccion = new CompraDetalle(
                $row['tbcompradetalleid'],
                $row['tbcompraid'],
                $row['tbproductoid'],
                $row['tbproductocantidad'],
                $row['tbproductopreciobruto'],
                $row['tbcompradetalleactivo'],

                );
                array_push($ComprasDetalles, $currentDireccion);
            }
        }
        return $ComprasDetalles;
    }
}
