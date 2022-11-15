<?php
include 'facturaBusiness.php';
include '../business/servicioBusiness.php';
include '../business/facturaDetalleBusiness.php';

$clienteid = $_POST['clienteid'];
$instructorid = $_POST['instructorid'];
$fechaPago = $_POST['fechaPago'];
$idModalidad = $_POST['modalidadPago'];
$MontoBruto = str_replace("₡", "", $_POST['MontoBruto']);
$pagoMetodoId = $_POST['pagoMetodoId'];
$impuestoVentaid =  $_POST['impuestoVentaid'];
$serviciosMult;


if (!empty($_POST['serviciosMult'])) {
    $serviciosMult = $_POST['serviciosMult'];
}
if (!empty($_POST['idServicio'])) {
    $serviciosSelec = $_POST['idServicio'];
}
if (!empty($_POST['serviciosMult'])) {
    $serviciosSelec[] = $serviciosMult;
}

$cantidadServic = $_POST['cantidadServicio'];
$serviciosSelec = serialize($serviciosSelec);
$serviciosSelec = urlencode($serviciosSelec);
$cantidadServic = serialize($cantidadServic);
$cantidadServic = urlencode($cantidadServic);

if (isset($_POST['calcularImpuesto'])) {
    $servicioBusiness = new ServicioBusiness();
    $servicios = $servicioBusiness->obtener();

    $sumaMonto = 0;
    $datos = urldecode($serviciosSelec);
    $array = unserialize($datos);
    $cantidad = urldecode($cantidadServic);
    $arrayCantidad = unserialize($cantidad);

    for ($i = 0; $i < count($array); $i++) {
        foreach ($servicios as $row) {

            if ($row->getIdTBServicio() == $array[$i]) {
                if ($arrayCantidad[$i] == null) {
                    $arrayCantidad[$i] = 1;
                }
                $sumaMonto = $sumaMonto + $row->getMontoTBServicio() * $arrayCantidad[$i];
            }
        }
    }

    $vetor = serialize($arrayCantidad);
    $vetor = urlencode($vetor);

    if (!empty($_POST['impuestoVentaid'])) {
        $facturaBusiness = new FacturaBusiness();
        $valorImpuesto = $facturaBusiness->obtenerImpuesto($_POST['impuestoVentaid']);

        $calculoImpuesto = ($valorImpuesto * $sumaMonto) / 100;
        $montoNeto = $sumaMonto + $calculoImpuesto;

        header("Location: ../view/listarFactura.php?MontoBruto=$sumaMonto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&MontoNeto=$montoNeto&impuestoVentaid=$impuestoVentaid&serviciosMult=$serviciosMult&pagoMetodoId=$pagoMetodoId&idServicio=$serviciosSelec&cantidadServicio=$vetor");
        exit();
    } else {
        header("location: ../view/listarFactura.php?error=unselectedTax&MontoBruto=$sumaMonto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&serviciosMult=$serviciosMult&pagoMetodoId=$pagoMetodoId&idServicio=$serviciosSelec&cantidadServicio=$vetor");
    }
}

if (isset($_POST['añadirServicio'])) {

    $servicioBusiness = new ServicioBusiness();
    $servicios = $servicioBusiness->obtener();

    $sumaMonto = 0;
    $datos = urldecode($serviciosSelec);
    $array = unserialize($datos);
    $cantidad = urldecode($cantidadServic);
    $arrayCantidad = unserialize($cantidad);

    for ($i = 0; $i < count($array); $i++) {
        foreach ($servicios as $row) {

            if ($row->getIdTBServicio() == $array[$i]) {
                if ($arrayCantidad[$i] == null) {
                    $arrayCantidad[$i] = 1;
                }
                $sumaMonto = $sumaMonto + $row->getMontoTBServicio() * $arrayCantidad[$i];
            }
        }
    }

    $vetor = serialize($arrayCantidad);
    $vetor = urlencode($vetor);

    if (empty($_POST['serviciosMult'])) {
        header("Location: ../view/listarFactura.php?error=noServiceSelection&MontoBruto=$sumaMonto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&impuestoVentaid=$impuestoVentaid&serviciosMult=$serviciosMult&pagoMetodoId=$pagoMetodoId&idServicio=$serviciosSelec&cantidadServicio=$cantidadServic");
    } else {
        header("Location: ../view/listarFactura.php?MontoBruto=$sumaMonto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&impuestoVentaid=$impuestoVentaid&serviciosMult=$serviciosMult&pagoMetodoId=$pagoMetodoId&idServicio=$serviciosSelec&cantidadServicio=$vetor");
    }
}


if (isset($_POST['eliminarServicio'])) {

    if (!empty($_POST['eliminarServicio'])) {
        $id = $_POST['eliminarServicio'];

        $datos = urldecode($serviciosSelec);
        $array = unserialize($datos);
        $cantidad = urldecode($cantidadServic);
        $arrayCantidad = unserialize($cantidad);
        $servicioBusiness = new ServicioBusiness();
        $servicios = $servicioBusiness->obtener();
        $sumaMonto = str_replace("₡", "", $_POST['MontoBruto']);

        for ($i = 0; $i < count($array); $i++) {
            foreach ($servicios as $row) {
                if ($row->getIdTBServicio() == $id && $id == $array[$i]) {
                    $sumaMonto = $sumaMonto - ($row->getMontoTBServicio() * $arrayCantidad[$i]);
                }
            }
        }

        for ($i = 0; $i < count($array); $i++) {
            if ($id == $array[$i]) {
                unset($array[$i]);
                unset($arrayCantidad[$i]);
            }
        }
        $array = array_values($array);
        $arrayCantidad = array_values($arrayCantidad);
        $array = serialize($array);
        $array = urlencode($array);
        $arrayCantidad = serialize($arrayCantidad);
        $arrayCantidad = urlencode($arrayCantidad);
        header("Location: ../view/listarFactura.php?MontoBruto=$sumaMonto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&impuestoVentaid=$impuestoVentaid&serviciosMult=$serviciosMult&pagoMetodoId=$pagoMetodoId&idServicio=$array&cantidadServicio=$arrayCantidad");
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
        header("Location: ../view/listarFactura.php?MontoBruto=$sumaMonto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&serviciosMult=$serviciosMult&pagoMetodoId=$pagoMetodoId");
        exit();
    } else {
        header("location: ../view/listarFactura.php?error=emptyField");
    }
}

if (isset($_POST['insertarFactura'])) {
    if (isset($_POST['serviciosMult']) && isset($_POST['impuestoVentaid'])) {
        if (
            isset($_POST['clienteid']) && isset($_POST['instructorid']) && isset($_POST['fechaPago']) && isset($_POST['modalidadPago']) &&
            isset($_POST['serviciosMult']) && isset($_POST['MontoBruto']) && isset($_POST['impuestoVentaid']) && isset($_POST['MontoNeto']) && isset($_POST['pagoMetodoId'])
        ) {

            $clienteid = $_POST['clienteid'];
            $instructorid = $_POST['instructorid'];
            $fechaPago = $_POST['fechaPago'];
            $pagoModalidad = $_POST['modalidadPago'];
            $servicioBusiness = new ServicioBusiness();
            $servicios = $servicioBusiness->obtener();
            $montoBruto = str_replace("₡", "", $_POST['MontoBruto']);
            $impuestoVentaid = $_POST['impuestoVentaid'];
            $pagoMetodoId = $_POST['pagoMetodoId'];

            $montoNeto = str_replace("₡", "", $_POST['MontoNeto']);
            $resultado1 = 0;

            if (
                strlen($clienteid) > 0 && strlen($instructorid) > 0  && strlen($fechaPago) > 0 && strlen($pagoModalidad) > 0 && sizeof($servicios) > 0
                && strlen($montoBruto) > 0 && strlen($impuestoVentaid) > 0  && strlen($montoNeto) > 0 && strlen($pagoMetodoId) > 0
            ) {

                if (is_numeric($clienteid)) {

                    $factura = new Factura(0, $clienteid, $instructorid, $fechaPago, $pagoModalidad, $impuestoVentaid, $montoNeto, $pagoMetodoId, 1);
                    $facturaBusiness = new FacturaBusiness();
                    $resultado = $facturaBusiness->insertar($factura);

                    $datos = urldecode($serviciosSelec);
                    $array = unserialize($datos);
                    $cantidad = urldecode($cantidadServic);
                    $arrayCantidad = unserialize($cantidad);
                    $val = 0;

                    for ($i = 0; $i < count($array); $i++) {
                        foreach ($servicios as $row) {
                            if ($row->getIdTBServicio() == $array[$i]) {
                                if ($arrayCantidad[$i] == null) {
                                    $arrayCantidad[$i] = 1;
                                }
                                if ($resultado == 0) {
                                    Header("Location: ../view/listarFactura.php?error=dbError");
                                } else {
                                    $val = $row->getMontoTBServicio() * $arrayCantidad[$i];
                                    $sumaMonto = $sumaMonto + $val;

                                    $facturaDetalle = new FacturaDetalle(0, $array[$i], $resultado, $val, 1, $arrayCantidad[$i]);
                                    $facturaDetalleBusiness = new FacturaDetalleBusiness();
                                    $resultado1 = $facturaDetalleBusiness->insertar($facturaDetalle);
                                }
                            }
                        }
                    }
                    $vetor = serialize($arrayCantidad);
                    $vetor = urlencode($vetor);
                    $array = serialize($array);
                    $array = urlencode($array);

                    if ($resultado1 == 1) {
                        Header("Location: ../view/imprimirPDF.php?success=inserted&MontoBruto=$sumaMonto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&impuestoVentaid=$impuestoVentaid&serviciosMult=$serviciosMult&montoNeto=$montoNeto&pagoMetodoId=$pagoMetodoId&idServicio=$array&cantidadServicio=$vetor");
                    } else {
                        Header("Location: ../view/listarFactura.php?error=dbError");
                    }
                } else {
                    header("location: ../view/listarFactura.php?error=numberFormat");
                }
            } else {
                header("Location: ../view/listarFactura.php?error=emptyField&MontoBruto=$MontoBruto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&impuestoVentaid=$impuestoVentaid&modalidadPago=$idModalidad&serviciosMult=$serviciosMult&pagoMetodoId=$pagoMetodoId&idServicio=$serviciosSelec&cantidadServicio=$cantidadServic");
            }
        } else {
            header("Location: ../view/listarFactura.php?error=error&MontoBruto=$MontoBruto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&impuestoVentaid=$impuestoVentaid&modalidadPago=$idModalidad&serviciosMult=$serviciosMult&pagoMetodoId=$pagoMetodoId&idServicio=$serviciosSelec&cantidadServicio=$cantidadServic");
        }
    } else {
        header("Location: ../view/listarFactura.php?error=serviceTaxnotSelected&MontoBruto=$MontoBruto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&impuestoVentaid=$impuestoVentaid&modalidadPago=$idModalidad&serviciosMult=$serviciosMult&pagoMetodoId=$pagoMetodoId&idServicio=$serviciosSelec&cantidadServicio=$cantidadServic");
    }
}

if (isset($_POST['eliminarFactura'])) {
    if (isset($_POST['idFactura'])) {
        $id = $_POST['idFactura'];

        $facturaBusiness = new FacturaBusiness();
        $result = $facturaBusiness->delete($id);
        $facturaDetalleBusiness = new FacturaDetalleBusiness();
        $resultado1 = $facturaDetalleBusiness->delete($id);

        if ($result == 1 && $resultado1 == 1) {
            header("Location: ../view/listarHistorialFactura.php?success=deleted");
        } else {
            header("Location: ../view/listarHistorialFactura.php?error=dbError");
        }
    } else {
        header("location: ../view/listarHistorialFactura.php?error=error");
    }
}
