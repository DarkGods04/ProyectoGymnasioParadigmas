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
$serviciosMult = serialize($serviciosMult);
$serviciosMult = urlencode($serviciosMult);

if (isset($_POST['calcularImpuesto'])) {

    if (!empty($_POST['serviciosMult']) && !empty($_POST['MontoBruto'])) {
        if (!empty($_POST['impuestoVentaid'])) {
            $facturaBusiness = new FacturaBusiness();
            $valorImpuesto = $facturaBusiness->obtenerImpuesto($_POST['impuestoVentaid']);
            $calculoImpuesto = ($valorImpuesto * $_POST['MontoBruto']) / 100;
            $montoNeto = $_POST['MontoBruto'] + $calculoImpuesto;

            header("Location: ../view/listarFacturas.php?MontoBruto=$MontoBruto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&MontoNeto=$montoNeto&impuestoVentaid=$impuestoVentaid&serviciosMult=$serviciosMult");
            exit();
        } else {
            header("location: ../view/listarFacturas.php?error=unselectedTax&MontoBruto=$MontoBruto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&serviciosMult=$serviciosMult");
        }
    } else {
        header("Location: ../view/listarFacturas.php?error=noServiceSelection&MontoBruto=$MontoBruto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&impuestoVentaid=$impuestoVentaid&serviciosMult=$serviciosMult");
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
        header("Location: ../view/listarFacturas.php?MontoBruto=$sumaMonto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&impuestoVentaid=$impuestoVentaid&serviciosMult=$serviciosMult");
        exit();
    } else {
        header("Location: ../view/listarFacturas.php?error=noServiceSelection&MontoBruto=$sumaMonto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&impuestoVentaid=$impuestoVentaid&serviciosMult=$serviciosMult");
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

if (isset($_POST['insertarFactura'])) {
    if (isset($_POST['serviciosMult']) && isset($_POST['impuestoVentaid'])) {
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
                header("Location: ../view/listarFacturas.php?error=emptyField&MontoBruto=$MontoBruto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&impuestoVentaid=$impuestoVentaid&modalidadPago=$idModalidad&serviciosMult=$serviciosMult");
            }
        } else {
            header("Location: ../view/listarFacturas.php?error=error&MontoBruto=$MontoBruto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&impuestoVentaid=$impuestoVentaid&modalidadPago=$idModalidad&serviciosMult=$serviciosMult");
        }
    } else {
        header("Location: ../view/listarFacturas.php?error=serviceTaxnotSelected&MontoBruto=$MontoBruto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&impuestoVentaid=$impuestoVentaid&modalidadPago=$idModalidad&serviciosMult=$serviciosMult");
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
