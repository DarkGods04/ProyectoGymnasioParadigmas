<?php
include 'compraBusiness.php';
include 'compraDetalleBusiness.php';
include 'productoBusiness.php';
     
     $fechaCompra = $_POST['fechaCompra'];
     $proveedor = $_POST['proveedorid'];
     $montoNeto = $_POST['montoNeto'];
     $pagoModalidad = $_POST['modoPagoCompra'];

     //compraDetalle
     $idProducto = $_POST['idProducto'];
     $cantidadProducto = $_POST['cantidadProducto'];
     $precioBrutoProducto = $_POST['precioBrutoProducto'];

if (isset($_POST['calcularProductos'])) {
    if (!empty($_POST['cantidadProducto']) && !empty($_POST['idProducto'])) {
        $productoBusiness = new ProductoBusiness();
        $productos = $productoBusiness->obtener();
        $montoNeto = 0;
        $precioBrutoProducto = 0;
       
            foreach ($productos as $row) {
                if ($row->getIdTBProducto() == $_POST['idProducto']) {
                    $montoNeto = $_POST['cantidadProducto'] * $row->getPrecioCompraTBProducto();
                    $precioBrutoProducto = $row->getPrecioCompraTBProducto();
                }
            }
        
        header("Location: ../view/listarCompras.php?fechaCompra=$fechaCompra&proveedorid=$proveedor&montoNeto=$montoNeto&modoPagoCompra=$pagoModalidad&idCompra=0&idProducto=$idProducto&cantidadProducto=$cantidadProducto&precioBrutoProducto=$precioBrutoProducto");
         exit();
    } else {
        header("location: ../view/listarCompras.php?error=emptyField");
    }
}



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


       
        if (strlen($fechaCompra) > 0 && strlen($proveedor) > 0  && strlen($montoNeto) > 0  && strlen($pagoModalidad) > 0 && strlen($idProducto) > 0  && strlen($cantidadProducto) > 0  && strlen($precioBrutoProducto) > 0) {//compraDetalle


           $montoNetoTemp =str_replace("₡","",$montoNeto);
           $montoBrutoTemp =str_replace("₡","",$precioBrutoProducto);

            if (is_numeric($proveedor) && is_numeric($montoNetoTemp) && is_numeric($idProducto) && is_numeric($cantidadProducto) && is_numeric($montoBrutoTemp)) {//compraDetalle

                //compra
                $compra = new Compra(0, $fechaCompra, $proveedor, $montoNetoTemp, $pagoModalidad, 1);
                $compraBusiness = new CompraBusiness();
                $resultado = $compraBusiness->insertar($compra);

                //compraDetalle
                $compraDetalle = new CompraDetalle(0, $resultado, $idProducto, $cantidadProducto, $montoBrutoTemp, 1);
                $compraDetalleBusiness = new CompraDetalleBusiness();
                $resultado2 = $compraDetalleBusiness->insertar($compraDetalle);

                if ($resultado > 0 && $resultado2 == 1) {
                    Header("Location:../view/listarCompras.php?success=inserted");
                } else {
                    Header("Location:../view/listarCompras.php?error=dbError?fechaCompra=$fechaCompra&proveedorid=$proveedor&montoNeto=$montoNetoTemp&modoPagoCompra=$pagoModalidad&idCompra=$resultado&idProducto=$idProducto&cantidadProducto=$cantidadProducto&precioBrutoProducto=$montoBrutoTemp");
                }
            } else {
                header("location:../view/listarCompras.php?error=numberFormat?fechaCompra=$fechaCompra&proveedorid=$proveedor&montoNeto=$montoNetoTemp&modoPagoCompra=$pagoModalidad&idCompra=$resultado&idProducto=$idProducto&cantidadProducto=$cantidadProducto&precioBrutoProducto= $montoBrutoTemp");
            }
        } else {
            header("location:../view/listarCompras.php?error=emptyField?fechaCompra=$fechaCompra&proveedorid=$proveedor&montoNeto=$montoNetoTemp&modoPagoCompra=$pagoModalidad&idCompra=$resultado&idProducto=$idProducto&cantidadProducto=$cantidadProducto&precioBrutoProducto= $montoBrutoTemp");
        }
    } else {
        header("location:../view/listarCompras.php?error=error?fechaCompra=$fechaCompra&proveedorid=$proveedor&montoNeto=$montoNetoTemp&modoPagoCompra=$pagoModalidad&idCompra=$resultado&idProducto=$idProducto&cantidadProducto=$cantidadProducto&precioBrutoProducto=$montoBrutoTemp");
    }
}

if (isset($_POST['anular'])) {
    if (isset($_POST['idCompra'])) {
        $idCompra = $_POST['idCompra'];
       // $idCompraDetalle = $_POST['idCompraDetalle'];
        

        $compraBusiness = new CompraBusiness();
        $result = $compraBusiness->delete($idCompra);

        $compraDetalleBusiness = new CompraDetalleBusiness();
        $result2 = $compraDetalleBusiness->delete($idCompra);

        if ($result == 1 && $result2 == 1) {
            header("Location: ../view/listarCompras.php?success=deleted");
        } 
    } else {
        header("location: ../view/listarCompras.php?error=error");
    }
}
