<?php
include 'impuestoVentaBusiness.php';
include 'facturaBusiness.php';

if (isset($_POST['insertar'])) {
    if (isset($_POST['valor']) && isset($_POST['descripcion'])) {

        $valor = $_POST['valor'];
        $descripcion = $_POST['descripcion'];
        
        if (strlen($valor) > 0 && strlen($descripcion) > 0 ) {
            $tempValor = str_replace("%", "", $valor);
            $impuestoBusiness = new ImpuestoVentaBusiness();
            $elementos = $impuestoBusiness->obtener();
            $flag = 0;
            foreach ($elementos as $row) { if($row->getValorImpuestoVenta() == $tempValor && $row->getActivoImpuestoVenta() == 1 && $row->getDescripcionImpuestoVenta() == $_POST['descripcion']  ){  $flag = 1; } }
                
    if($flag == 0){




         

            $impuestoVenta = new ImpuestoVenta(0, $tempValor, $descripcion, 1);
            $impuestoBusiness = new ImpuestoVentaBusiness();
            $resultado = $impuestoBusiness->insertar($impuestoVenta);

            if ($resultado == 1) {
                Header("Location: ../view/listarImpuestoVentas.php?success=inserted");
            } else {
                Header("Location: ../view/listarImpuestoVentas.php?error=dbError&valor=$valor&descripcion=$descripcion");
            }

        } else {
            Header("Location: ../view/listarImpuestoVentas.php?error=duplicate&valor=$valor&descripcion=$descripcion");
        }
            
        } else {
            header("location: ../view/listarImpuestoVentas.php?error=emptyField&valor=$valor&descripcion=$descripcion");
        }
    } else {
        header("location: ../view/listarImpuestoVentas.php?error=error&valor=$valor&descripcion=$descripcion");
    }
}


if (isset($_POST['eliminar'])) {
    $facturaBusiness = new FacturaBusiness();
    $facturas = $facturaBusiness->obtener();
    $flag = 0;
    foreach ($facturas as $row) { if($row->getImpuestoVentaidTBFactura() == $_POST['idImpuesto'] && $row->getActivoTBFactura() == 1 ){  $flag = 1; } }
        
    if($flag == 0){

    if (isset($_POST['idImpuesto'])) {
        $id = $_POST['idImpuesto'];

        $impuestoBusiness = new ImpuestoVentaBusiness();
        $result = $impuestoBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarImpuestoVentas.php?success=deleted");
        } else {
            header("Location: ../view/listarImpuestoVentas.php?error=dbError");
        }
    } else {
        header("location: ../view/listarImpuestoVentas.php?error=error");
    }
    } else {
    header("location: ../view/listarImpuestoVentas.php?error=relationError");
    }
}


if (isset($_POST['actualizar'])) {
    if (isset($_POST['idImpuesto']) && isset($_POST['valor']) && isset($_POST['descripcion'])) {

        $id = $_POST['idImpuesto'];
        $valor = $_POST['valor'];
        $descripcion = $_POST['descripcion'];

        if (strlen($valor) > 0 && strlen($descripcion) > 0 ) {
            $tempValor = str_replace("%", "", $valor);
            $impuestoBusiness = new ImpuestoVentaBusiness();
            $elementos = $impuestoBusiness->obtener();
            $flag = 0;
            foreach ($elementos as $row) { if($row->getValorImpuestoVenta() == $tempValor && $row->getActivoImpuestoVenta() == 1 && $row->getDescripcionImpuestoVenta() == $_POST['descripcion']  ){  $flag = 1; } }
                
    if($flag == 0){




            if (!is_numeric($descripcion)) {
                $impuestoVenta = new ImpuestoVenta($id, $tempValor, $descripcion, 1);
                $impuestoBusiness = new ImpuestoVentaBusiness();
                $resultado = $impuestoBusiness->update($impuestoVenta);

                if ($resultado == 1) {
                    Header("Location: ../view/listarImpuestoVentas.php?success=update");
                } else {
                    Header("Location: ../view/listarImpuestoVentas.php?error=dbError");
                }

                
            } else {
                header("location: ../view/listarImpuestoVentas.php?error=numberFormat");
            }

        } else {
            header("location: ../view/listarImpuestoVentas.php?error=duplicate");
        }

        } else {
            header("location: ../view/listarImpuestoVentas.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarImpuestoVentas.php?error=error");
    }
}
