<?php
include_once 'data.php';
include '../domain/compra.php';

class CompraData extends Data
{

    public function insertCompra($compra)
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbcompraid) AS tbcompraid FROM tbcompra";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbcompra VALUES (" . $nextId . ",'" . $compra->getFechaCompra() . "','" .
            $compra->getProveedorId() . "','" .  $compra->getMontoNetoCompra() . "','" .
            $compra->getModoPagoCompra() . "','" . $compra->getActivo() . "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $nextId;
    }


    public function deleteCompra($idCompra)
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbcompra SET tbcompraactivo=0  WHERE tbcompraid=$idCompra";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getCompras()
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbcompra;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);

        $Compras = [];
        while ($row = mysqli_fetch_array($result)) {
            $current = new Compra(
                $row['tbcompraid '],
                $row['tbcomprafecha'],
                $row['tbproveedorid'],
                $row['tbcompramontoneto'],
                $row['tbcompramodopago'],
                $row['tbcompraactivo'],

            );
            array_push($Compras, $current);
        }
        return $Compras;
    }

    public function buscarCompra($palabra)
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');



        $querySelect = "SELECT * FROM tbcompra WHERE tbcompraid LIKE '%$palabra%' OR tbcomprafecha LIKE '%$palabra%' OR tbproveedorid LIKE '%$palabra%' OR tbcompramontoneto LIKE '%$palabra%' OR tbcompramodopago LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $Compras = [];
        while ($row = mysqli_fetch_array($result)) {
            if ($row['tbcompraactivo'] == 1) {
                $currentDireccion = new Compra(
                    $row['tbcompraid'],
                    $row['tbcomprafecha'],
                    $row['tbproveedorid'],
                    $row['tbcompramontoneto'],
                    $row['tbcompramodopago'],
                    $row['tbcompraactivo'],

                );
                array_push($Compras, $currentDireccion);
            }
        }
        return $Compras;
    }
}
