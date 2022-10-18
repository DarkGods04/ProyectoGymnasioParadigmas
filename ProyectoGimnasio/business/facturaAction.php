<?php
include 'facturaBusiness.php';
include '../business/servicioBusiness.php';

$clienteid = $_POST['clienteid'];
$instructorid = $_POST['instructorid'];
$fechaPago = $_POST['fechaPago'];
$idModalidad = $_POST['modalidadPago'];
$MontoBruto = $_POST['MontoBruto'];
$impuestoVentaid =  $_POST['impuestoVentaid'];
$serviciosMult = $_POST['serviciosMult'];

if (isset($_POST['calcularImpuesto'])) {
    if (!empty($_POST['impuestoVentaid'])) {
        $facturaBusiness = new FacturaBusiness();
        $valorImpuesto = $facturaBusiness->obtenerImpuesto($_POST['impuestoVentaid']);
        $calculoImpuesto = ($valorImpuesto * $_POST['MontoBruto']) / 100;
        $montoNeto = $_POST['MontoBruto'] + $calculoImpuesto;
        $serviciosMult = serialize($serviciosMult);
        $serviciosMult = urlencode($serviciosMult);

        header("Location: ../view/listarFacturas.php?MontoBruto=$MontoBruto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&MontoNeto=$montoNeto&impuestoVentaid=$impuestoVentaid&serviciosMult=$serviciosMult");
        exit();
    } else {
        header("location: ../view/listarFacturas.php?error=emptyField");
    }
}

if (isset($_POST['añadirServicios'])) {
    if (!empty($_POST['serviciosMult'])) {
        $servicioBusiness = new ServicioBusiness();
        $servicios = $servicioBusiness->obtener();
        $sumaMonto = 0;
        foreach ($_POST['serviciosMult'] as $selected) {
            foreach ($servicios as $row) {
                if ($row->getIdTBServicio() == $selected) {
                    $sumaMonto = $sumaMonto + $row->getMontoTBServicio();
                }
            }
        }
        $serviciosMult = serialize($serviciosMult);
        $serviciosMult = urlencode($serviciosMult);
        header("Location: ../view/listarFacturas.php?MontoBruto=$sumaMonto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&serviciosMult=$serviciosMult");
        exit();
    } else {
        header("location: ../view/listarFacturas.php?error=emptyField");
    }
}

if (isset($_POST['actualizarServicios'])) {
    if (!empty($_POST['servicios'])) {
        $servicioBusiness = new ServicioBusiness();
        $servicios = $servicioBusiness->obtener();
        $sumaMonto = 0;
        foreach ($_POST['serviciosMult'] as $selected) {
            foreach ($servicios as $row) {
                if ($row->getIdTBServicio() == $selected) {
                    $sumaMonto = $sumaMonto + $row->getMontoTBServicio();
                }
            }
        }
        $serviciosMult = serialize($serviciosMult);
        $serviciosMult = urlencode($serviciosMult);
        header("Location: ../view/listarFacturas.php?MontoBruto=$sumaMonto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&serviciosMult=$serviciosMult");
        exit();
    } else {
        header("location: ../view/listarFacturas.php?error=emptyField");
    }
}


if (isset($_POST['actualizarServicios'])) {
}

if (isset($_POST['insertarFactura'])) {
    if (
        isset($_POST['clienteid']) && isset($_POST['instructorid']) && isset($_POST['fechaPago']) && isset($_POST['modalidadPago']) &&
        isset($_POST['serviciosMult']) && isset($_POST['MontoBruto']) && isset($_POST['impuestoVentaid']) && isset($_POST['MontoNeto'])
    ) {

        $clienteid = $_POST['clienteid'];
        $instructorid = $_POST['instructorid'];
        $fechaPago = $_POST['fechaPago'];
        $pagoModalidad = $_POST['modalidadPago'];
        $servicios = $_POST['serviciosMult'];
        $cadenaServ = implode(";", $servicios);
        $montoBruto = $_POST['MontoBruto'];
        $impuestoVentaid = $_POST['impuestoVentaid'];
        $montoNeto = $_POST['MontoNeto'];

        if (
            strlen($clienteid) > 0 && strlen($instructorid) > 0  && strlen($fechaPago) > 0 && strlen($pagoModalidad) > 0 && sizeof($servicios) > 0
            && strlen($montoBruto) > 0 && strlen($impuestoVentaid) > 0  && strlen($montoNeto) > 0
        ) {

            if (is_numeric($clienteid)) {
                $factura = new Factura(0, $clienteid, $instructorid, $fechaPago, $pagoModalidad, $cadenaServ, $montoBruto, $impuestoVentaid, $montoNeto, 1);
                $facturaBusiness = new FacturaBusiness();
                $resultado = $facturaBusiness->insertar($factura);

                if ($resultado == 1) {
                    Header("Location: ../view/listarFacturas.php?success=inserted");
                } else {
                    Header("Location: ../view/listarFacturas.php?error=dbError");
                }
            } else {
                header("location: ../view/listarFacturas.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarFacturas.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarFacturas.php?error=error");
    }
}

if (isset($_POST['eliminarFactura'])) {
    if (isset($_POST['idFactura'])) {
        $id = $_POST['idFactura'];

        $facturaBusiness = new FacturaBusiness();
        $result = $facturaBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarFacturas.php?success=deleted");
        } else {
            header("Location: ../view/listarFacturas.php?error=dbError");
        }
    } else {
        header("location: ../view/listarFacturas.php?error=error");
    }
}

if (isset($_POST['actualizarFactura'])) {
    if (
        isset($_POST['idFactura']) && isset($_POST['clienteid']) && isset($_POST['instructorid']) && isset($_POST['fechaPago']) && isset($_POST['modalidadPago']) &&
        isset($_POST['servicios']) && isset($_POST['montoBruto']) && isset($_POST['impuestoVentaid']) && isset($_POST['montoNeto'])
    ) {
        $id = $_POST['idFactura'];
        $clienteid = $_POST['clienteid'];
        $instructorid = $_POST['instructorid'];
        $fechaPago = $_POST['fechaPago'];
        $pagoModalidad = $_POST['pagoModalidad'];
        $servicios = $_POST['servicios'];
        $montoBruto = $_POST['montoBruto'];
        $impuestoVentaid = $_POST['impuestoVentaid'];
        $montoNeto = $_POST['montoNeto'];

        if (
            strlen($clienteid) > 0 && strlen($instructorid) > 0  && strlen($fechaPago) > 0 && strlen($pagoModalidad) > 0 && strlen($servicios) > 0
            && strlen($montoBruto) > 0 && strlen($impuestoVentaid) > 0  && strlen($montoNeto) > 0
        ) {

            if (is_numeric($clienteid)) {
                $factura = new Factura($id, $clienteid, $instructorid, $fechaPago, $pagoModalidad, $servicios, $montoBruto, $impuestoVentaid, $montoNeto, 1);
                $facturaBusiness = new FacturaBusiness();
                $resultado = $facturaBusiness->update($factura);

                if ($resultado == 1) {
                    Header("Location: ../view/listarFacturas.php?success=update");
                } else {
                    Header("Location: ../view/listarFacturas.php?error=dbError");
                }
            } else {
                header("location: ../view/listarFacturas.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarFacturas.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarFacturas.php?error=error");
    }
}
