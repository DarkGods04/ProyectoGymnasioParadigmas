<?php
include 'impuestoVentaBusiness.php';

if (isset($_POST['insertar'])) {
    if (isset($_POST['valor']) && isset($_POST['descripcion'])) {

        $valor = $_POST['valor'];
        $descripcion = $_POST['descripcion'];
        
        if (strlen($valor) > 0 && strlen($descripcion) > 0 ) {

            $tempValor = str_replace("%", "", $valor);

           
            $impuestoVenta = new ImpuestoVenta(0, $tempValor, $descripcion, 1);
            $impuestoBusiness = new ImpuestoVentaBusiness();
            $resultado = $impuestoBusiness->insertar($impuestoVenta);

            if ($resultado == 1) {
                Header("Location: ../view/listarImpuestoVentas.php?success=inserted");
            } else {
                Header("Location: ../view/listarImpuestoVentas.php?error=dbError");
            }
            
        } else {
            header("location: ../view/listarImpuestoVentas.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarImpuestoVentas.php?error=error");
    }
}


if (isset($_POST['eliminar'])) {
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
}


if (isset($_POST['actualizar'])) {
    if (isset($_POST['idImpuesto']) && isset($_POST['valor']) && isset($_POST['descripcion'])) {

        $id = $_POST['idImpuesto'];
        $valor = $_POST['valor'];
        $descripcion = $_POST['descripcion'];

        if (strlen($valor) > 0 && strlen($descripcion) > 0 ) {
            $tempValor = str_replace("%", "", $valor);

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
            header("location: ../view/listarImpuestoVentas.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarImpuestoVentas.php?error=error");
    }
}
