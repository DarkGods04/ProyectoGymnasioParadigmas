<?php
include_once 'data.php';
include '../domain/clienteRutina.php';
class ClienteRutinaData extends Data {

    public function insertClienteRutina($clienteRutina) {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        //Se obtiene el último id de la tabla
        $queryGetLastId = "SELECT MAX(tbclienterutinaid) AS tbclienterutinaid FROM tbclienterutina";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $queryInsert = "INSERT INTO tbclienterutina VALUES (" . $nextId . ",'" . $clienteRutina->getIdTBCliente() . "','" .
            $clienteRutina->getIdTBIstructor() . "','" .  $clienteRutina->getIdTBModalidadFuncional() . "','" .
            $clienteRutina->getFechaTBClienteRutina() . "','" . $clienteRutina->getActivoTBClienteRutina() . "');";

        $result = mysqli_query($conn, $queryInsert);
        if ($result == 1) {
            $result = $nextId;
        }
        mysqli_close($conn);
        return $result;
    }
/*
    public function updateClienteRutina($clienteRutina){

    }

    public function deleteClienteRutina($idFactura)
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbclienterutina SET tbclienterutinaactivo=0  WHERE tbclienterutinaid=$idFactura";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }*/

    public function getClienteRutina() {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbclienterutina as one WHERE tbclienterutinafecha in (SELECT MAX(tbclienterutinafecha) FROM tbclienterutina WHERE one.tbclienteid=tbclienteid) order by tbclienterutinafecha DESC;";
        

        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);

        $RutinasCliente = [];
        while ($row = mysqli_fetch_array($result)) {
            $current = new ClienteRutina(
                $row['tbclienterutinaid'],
                $row['tbclienteid'],
                $row['tbinstructorid'],
                $row['tbmodalidadfuncionalid'],
                $row['tbclienterutinafecha'],
                $row['tbclienterutinaactivo'] );
            array_push($RutinasCliente, $current);
        }
        return $RutinasCliente;
    }
/*
    public function buscarClienetRutina($palabra)
    {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelectCliente = "SELECT * FROM tbcliente WHERE tbclientenombre LIKE '%$palabra%' OR tbclienteapellido1 LIKE '%$palabra%' OR
        tbclienteapellido2 LIKE '%$palabra%';";

        $resultCliente = mysqli_query($conn, $querySelectCliente);
        $idCliente = 0;
        while ($rowCliente = mysqli_fetch_array($resultCliente)) {
            if ($rowCliente['tbclienteactivo'] == 1) {
                $idCliente = $rowCliente['tbclienteid'];
            }
        }

        $querySelectInstructor = "SELECT * FROM tbinstructor WHERE tbinstructornombre LIKE '%$palabra%' OR tbinstructorapellido LIKE '%$palabra%';";
        $resultInstructor = mysqli_query($conn, $querySelectInstructor);
        $idInstructor = 0;
        while ($rowInstructor = mysqli_fetch_array($resultInstructor)) {
            if ($rowInstructor['tbinstructoractivo'] == 1) {
                $idInstructor = $rowInstructor['tbinstructorid'];
            }
        }

        $querySelectMetodoPago = "SELECT * FROM tbcatalogopagometodo WHERE tbcatalogopagometodonombre LIKE '%$palabra%';";
        $resultMetodPago = mysqli_query($conn, $querySelectMetodoPago);
        $pagoMetodoid = 0;
        while ($row = mysqli_fetch_array($resultMetodPago)) {
            if ($row['tbcatalogopagometodoactivo'] == 1) {
                $pagoMetodoid = $row['tbcatalogopagometodoid'];
            }
        }

        $querySelectModalidad = "SELECT * FROM tbcatalogopagoperidiocidad Where tbcatalogopagoperidiocidadnombre LIKE '%$palabra%';";
        $resultModalidad = mysqli_query($conn, $querySelectModalidad);
        $idModalidad = 0;
        while ($rowModalidad = mysqli_fetch_array($resultModalidad)) {
            if ($rowModalidad['tbcatalogopagoperidiocidadactivo'] == 1) {
                $idModalidad = $rowModalidad['tbcatalogopagoperidiocidadid'];
            }
        }

        $querySelectImpuesto = "SELECT * FROM tbimpuestoventa WHERE tbimpuestoventadescripcion LIKE '%$palabra%';";
        $resultImpuesto = mysqli_query($conn, $querySelectImpuesto);
        $idImpuesto = 0;
        while ($rowimpuesto = mysqli_fetch_array($resultImpuesto)) {
            if ($rowimpuesto['tbimpuestoventaactivo'] == 1) {
                $idImpuesto = $rowimpuesto['tbimpuestoventaid'];
            }
        }

        $querySelect = "SELECT * FROM tbclienterutina WHERE tbclienterutinaid LIKE '%$palabra%' OR tbclienteid LIKE '%$idCliente%' OR tbinstructorid LIKE '%$idInstructor%' OR tbfacturafechapago LIKE '%$palabra%' OR tbcatalogopagoperidiocidadid LIKE '%$idModalidad%' OR tbimpuestoventaid LIKE '%$idImpuesto%' OR tbfacturamontoneto LIKE '%$palabra%' OR tbcatalogopagometodoid LIKE '%$pagoMetodoid%';";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $RutinasCliente = [];
        while ($row = mysqli_fetch_array($result)) {
            if ($row['tbclienterutinaactivo'] == 1) {
                $currentDireccion = new ClienteRutina(
                    $row['tbclienterutinaid'],
                    $row['tbclienteid'],
                    $row['tbinstructorid'],
                    $row['tbfacturafechapago'],
                    $row['tbcatalogopagoperidiocidadid'],
                    $row['tbimpuestoventaid'],
                    $row['tbfacturamontoneto'],
                    $row['tbcatalogopagometodoid'],
                    $row['tbclienterutinaactivo']
                );
                array_push($RutinasCliente, $currentDireccion);
            }
        }
        return $RutinasCliente;
    }*/

}
