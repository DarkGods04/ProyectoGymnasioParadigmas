<?php
include 'compraBusiness.php';
include 'compraDetalleBusiness.php';


// $clienteid = $_POST['fechaCompra'];
// $instructorid = $_POST['proveedorid'];
// $fechaPago = $_POST['montoNeto'];
// $idModalidad = $_POST['modoPagoCompra'];


// if (isset($_POST['calcularImpuesto'])) {

//     if (!empty($_POST['serviciosMult']) && !empty($_POST['MontoBruto'])) {
//         if (!empty($_POST['impuestoVentaid'])) {
//             $facturaBusiness = new FacturaBusiness();
//             $valorImpuesto = $facturaBusiness->obtenerImpuesto($_POST['impuestoVentaid']);
//             $calculoImpuesto = ($valorImpuesto * $_POST['MontoBruto']) / 100;
//             $montoNeto = $_POST['MontoBruto'] + $calculoImpuesto;

//             header("Location: ../view/listarFacturas.php?MontoBruto=$MontoBruto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&MontoNeto=$montoNeto&impuestoVentaid=$impuestoVentaid&serviciosMult=$serviciosMult");
//             exit();
//         } else {
//             header("location: ../view/listarFacturas.php?error=unselectedTax&MontoBruto=$MontoBruto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&serviciosMult=$serviciosMult");
//         }
//     } else {
//         header("Location: ../view/listarFacturas.php?error=noServiceSelection&MontoBruto=$MontoBruto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&impuestoVentaid=$impuestoVentaid&serviciosMult=$serviciosMult");
//     }
// }

// if (isset($_POST['añadirServicios'])) {
//     if (!empty($_POST['serviciosMult'])) {
//         $servicioBusiness = new ServicioBusiness();
//         $servicios = $servicioBusiness->obtener();
//         $sumaMonto = 0;
//         foreach ($_POST['serviciosMult'] as $selected) {
//             foreach ($servicios as $row) {
//                 if ($row->getIdTBServicio() == $selected) {
//                     $sumaMonto = $sumaMonto + $row->getMontoTBServicio();
//                 }
//             }
//         }
//         header("Location: ../view/listarFacturas.php?MontoBruto=$sumaMonto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&impuestoVentaid=$impuestoVentaid&serviciosMult=$serviciosMult");
//         exit();
//     } else {
//         header("Location: ../view/listarFacturas.php?error=noServiceSelection&MontoBruto=$sumaMonto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&impuestoVentaid=$impuestoVentaid&serviciosMult=$serviciosMult");
//     }
// }

// if (isset($_POST['actualizarServicios'])) {
//     if (!empty($_POST['servicios'])) {
//         $servicioBusiness = new ServicioBusiness();
//         $servicios = $servicioBusiness->obtener();
//         $sumaMonto = 0;
//         foreach ($_POST['serviciosMult'] as $selected) {
//             foreach ($servicios as $row) {
//                 if ($row->getIdTBServicio() == $selected) {
//                     $sumaMonto = $sumaMonto + $row->getMontoTBServicio();
//                 }
//             }
//         }
//         $serviciosMult = serialize($serviciosMult);
//         $serviciosMult = urlencode($serviciosMult);
//         header("Location: ../view/listarFacturas.php?MontoBruto=$sumaMonto&clienteid=$clienteid&instructorid=$instructorid&fechaPago=$fechaPago&modalidadPago=$idModalidad&serviciosMult=$serviciosMult");
//         exit();
//     } else {
//         header("location: ../view/listarFacturas.php?error=emptyField");
//     }
// }



if (isset($_POST['insertarCompra'])) {
     //compra
     $fechaCompra = $_POST['fechaCompra'];
     $proveedor = $_POST['proveedorid'];
     $montoNeto = $_POST['montoNeto'];
     $pagoModalidad = $_POST['modoPagoCompra'];

     //compraDetalle
     $idProducto = $_POST['idProducto'];
     $cantidadProducto = $_POST['cantidadProducto'];
     $precioBrutoProducto = $_POST['precioBrutoProducto'];

    if (isset($_POST['fechaCompra']) && isset($_POST['proveedorid']) && isset($_POST['montoNeto']) && isset($_POST['modoPagoCompra']) && isset($_POST['idProducto']) && isset($_POST['cantidadProducto']) && isset($_POST['precioBrutoProducto'])) { //compraDetalle


       
        if (strlen($fechaCompra) > 0 && strlen($proveedor) > 0  && strlen($montoNeto) > 0  && strlen($pagoModalidad) > 0 && strlen($idProducto) > 0  && strlen($cantidadProducto) > 0  && strlen($precioBrutoProducto= $precioBrutoProducto) > 0) {//compraDetalle

            if (is_numeric($proveedor) && is_numeric($montoNeto) && is_numeric($idProducto) && is_numeric($cantidadProducto) && is_numeric($precioBrutoProducto= $precioBrutoProducto)) {//compraDetalle

                //compra
                $compra = new Compra(0, $fechaCompra, $proveedor, $montoNeto, $pagoModalidad, 1);
                $compraBusiness = new CompraBusiness();
                $resultado = $compraBusiness->insertar($compra);

                //compraDetalle
                $compraDetalle = new CompraDetalle(0, $resultado, $idProducto, $cantidadProducto, $precioBrutoProducto= $precioBrutoProducto, 1);
                $compraDetalleBusiness = new CompraDetalleBusiness();
                $resultado2 = $compraDetalleBusiness->insertar($compraDetalle);

                if ($resultado > 0 && $resultado2 == 1) {
                    Header("Location:../view/listarCompras.php?success=inserted");
                } else {
                    Header("Location:../view/listarCompras.php?error=dbError&fechaCompra=$fechaCompra&proveedorid=$proveedor&montoNeto=$montoNeto&modoPagoCompra=$pagoModalidad
                    &idCompra=$resultado&idProducto=$idProducto&cantidadProducto=$cantidadProducto&precioBrutoProducto=$precioBrutoProducto");
                }
            } else {
                header("location:../view/listarCompras.php?error=numberFormat&fechaCompra=$fechaCompra&proveedorid=$proveedor&montoNeto=$montoNeto&modoPagoCompra=$pagoModalidad
                &idCompra=$resultado&idProducto=$idProducto&cantidadProducto=$cantidadProducto&precioBrutoProducto= $precioBrutoProducto");
            }
        } else {
            header("location:../view/listarCompras.php?error=emptyField&fechaCompra=$fechaCompra&proveedorid=$proveedor&montoNeto=$montoNeto&modoPagoCompra=$pagoModalidad
            &idCompra=$resultado&idProducto=$idProducto&cantidadProducto=$cantidadProducto&precioBrutoProducto= $precioBrutoProducto");
        }
    } else {
        header("location:../view/listarCompras.php?error=error&fechaCompra=$fechaCompra&proveedorid=$proveedor&montoNeto=$montoNeto&modoPagoCompra=$pagoModalidad
        &idCompra=$resultado&idProducto=$idProducto&cantidadProducto=$cantidadProducto&precioBrutoProducto=$precioBrutoProducto");
    }
}

if (isset($_POST['anular'])) {
    if (isset($_POST['idCompra']) && isset($_POST['idCompraDetalle'])) {
        $idCompra = $_POST['idCompra'];
        $idCompraDetalle = $_POST['idCompraDetalle'];
        

        $compraBusiness = new CompraBusiness();
        $result = $compraBusiness->delete($id);

        $compraDetalleBusiness = new CompraDetalleBusiness();
        $result2 = $compraDetalleBusiness->delete($id);

        if ($result == 1 && $result2 == 1) {
            header("Location: ../view/listarCompras.php?success=deleted");
        } else {
            header("Location: ../view/listarCompras.php?error=dbError");
        }
    } else {
        header("location: ../view/listarCompras.php?error=error");
    }
}
