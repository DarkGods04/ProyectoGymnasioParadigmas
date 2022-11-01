<?php
require_once 'data.php';
require_once '../domain/servicio.php';

class ServicioData extends Data
{

    public function insertServicio($Servicio)
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryGetLastId = "SELECT MAX(tbservicioid) AS tbservicioid  FROM tbservicio";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;
        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $tbservicionombre = $Servicio->getNombreTBServicio();
        $tbserviciodescripcion = $Servicio->getDescripcionTBServicio();
        $tbservicioactivo = $Servicio->getActivoTBServicio();

        $queryInsert = "INSERT INTO tbservicio VALUES ('$nextId','$tbservicionombre','$tbserviciodescripcion','$tbservicioactivo');";
        self::insertServicioTarifa($Servicio, $nextId);

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }

    public function insertServicioTarifa($Servicio, $tbservicioid)
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryGetLastId = "SELECT MAX(tbserviciotarifaid) AS tbserviciotarifaid  FROM tbserviciotarifa";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;
        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }

        $tbserviciotarifamonto = $Servicio->getMontoTBServicio();
        $tbserviciotarifaperiodicidadactualizacion = $Servicio->getPeriodicidadTBServicio();
        $tbserviciotarifaproximafechaactualizacion = $Servicio->getFechaactualizacionTBServicio();
        $tbserviciotarifaactivo = 1;
        date_default_timezone_set('America/Costa_Rica');
        $date = date('Y-m-d');

        $queryInsert = "INSERT INTO tbserviciotarifa VALUES ('$nextId','$tbservicioid','$date','$tbserviciotarifamonto','$tbserviciotarifaactivo','$tbserviciotarifaperiodicidadactualizacion','$tbserviciotarifaproximafechaactualizacion');";
        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }

    public function updateServicio($Servicio)
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $tbservicioid = $Servicio->getIdTBServicio();
        $tbservicionombre = $Servicio->getNombreTBServicio();
        $tbserviciodescripcion = $Servicio->getDescripcionTBServicio();

        $queryUpdate = "UPDATE tbservicio SET tbservicionombre='$tbservicionombre', tbserviciodescripcion='$tbserviciodescripcion'
            WHERE tbservicioid = $tbservicioid";
        self::updateServicioTarifa($Servicio);

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }
    public function aplazarActuali($id, $dias)
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $fechaActualizacionProxima = new DateTime(date('Y-m-d'));
        $fechaActualizacionProxima->modify('+' . "$dias" . ' day');
        $fechaActualizacionProxima = $fechaActualizacionProxima->format('Y-m-d');

        $fechaActual = new DateTime(date('Y-m-d'));
        $fechaActual = $fechaActual->format('Y-m-d');
        
        $queryUpdate = "UPDATE tbserviciotarifa SET tbserviciotarifafechamodificacion='$fechaActual', tbserviciotarifaproximafechaactualizacion='$fechaActualizacionProxima'
            WHERE tbserviciotarifaid = $id";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function updateServicioTarifa($Servicio)
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $tbservicioid = $Servicio->getIdTBServicio();
        self::deleteServicioTarifa($tbservicioid);
        self::insertServicioTarifa($Servicio, $tbservicioid);
    }

    public function deleteServicio($tbservicioid)
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbservicio
            SET tbservicioactivo = 0 WHERE tbservicioid = $tbservicioid";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function deleteServicioTarifa($tbservicioid)
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $queryUpdate = "UPDATE tbserviciotarifa
            SET tbserviciotarifaactivo = 0 WHERE tbservicioid = $tbservicioid";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }


    public function getServicios()
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbservicio;";
        $result = mysqli_query($conn, $querySelect);

        $serviciotarifaSelect = "SELECT * FROM tbserviciotarifa;";
        $serviciotarifaResult = mysqli_query($conn, $serviciotarifaSelect);
        mysqli_close($conn);

        $Servicios = [];
        $tbserviciotarifamonto = 0;
        $tbserviciotarifaperiodicidadactualizacion = 0;
        $tbserviciotarifaproximafechaactualizacion = "";
        while ($row = mysqli_fetch_array($result)) {
            if ($row['tbservicioactivo'] == 1) {
                while ($row2 = mysqli_fetch_array($serviciotarifaResult)) {
                    if ($row['tbservicioid'] == $row2['tbservicioid'] && $row2['tbserviciotarifaactivo'] == 1) {
                        $tbserviciotarifamonto = $row2['tbserviciotarifamonto'];
                        $tbserviciotarifaperiodicidadactualizacion = $row2['tbserviciotarifaperiodicidadactualizacion'];
                        $tbserviciotarifaproximafechaactualizacion = $row2['tbserviciotarifaproximafechaactualizacion'];
                        break;
                    }
                }
                mysqli_data_seek($serviciotarifaResult, 0);

                $currentServicio = new Servicio(
                    $row['tbservicioid'],
                    $row['tbservicionombre'],
                    $row['tbserviciodescripcion'],
                    $tbserviciotarifamonto,
                    $row['tbservicioactivo'],
                    $tbserviciotarifaperiodicidadactualizacion,
                    $tbserviciotarifaproximafechaactualizacion
                );
                array_push($Servicios, $currentServicio);
                $tbserviciotarifamonto = 0;
            }
        }
        return $Servicios;
    }


    public function buscarServicios($palabra)
    {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('UTF8');

        $querySelect = "SELECT * FROM tbservicio WHERE tbservicioid LIKE '%$palabra%' OR tbservicionombre LIKE '%$palabra%' OR 
        tbserviciodescripcion LIKE '%$palabra%';";
        $result = mysqli_query($conn, $querySelect);

        $serviciotarifaSelect = "SELECT * FROM tbserviciotarifa;";
        $serviciotarifaResult = mysqli_query($conn, $serviciotarifaSelect);
        mysqli_close($conn);

        $Servicios = [];
        $tbserviciotarifamonto = 0;
        $tbserviciotarifaperiodicidadactualizacion = 0;
        $tbserviciotarifaproximafechaactualizacion = "";
        while ($row = mysqli_fetch_array($result)) {
            if ($row['tbservicioactivo'] == 1) {
                while ($row2 = mysqli_fetch_array($serviciotarifaResult)) {
                    if ($row['tbservicioid'] == $row2['tbservicioid'] && $row2['tbserviciotarifaactivo'] == 1) {
                        $tbserviciotarifamonto = $row2['tbserviciotarifamonto'];
                        $tbserviciotarifaperiodicidadactualizacion = $row2['tbserviciotarifaperiodicidadactualizacion'];
                        $tbserviciotarifaproximafechaactualizacion = $row2['tbserviciotarifaproximafechaactualizacion'];
                        break;
                    }
                }
                mysqli_data_seek($serviciotarifaResult, 0);

                $currentServicio = new Servicio(
                    $row['tbservicioid'],
                    $row['tbservicionombre'],
                    $row['tbserviciodescripcion'],
                    $tbserviciotarifamonto,
                    $row['tbservicioactivo'],
                    $tbserviciotarifaperiodicidadactualizacion,
                    $tbserviciotarifaproximafechaactualizacion
                );
                array_push($Servicios, $currentServicio);
                $tbserviciotarifamonto = 0;
            }
        }
        return $Servicios;
    }
};
