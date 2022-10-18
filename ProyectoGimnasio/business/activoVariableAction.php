
<?php
include 'activoVariableBusiness.php';

if (isset($_POST['actualizar'])) {
    if (isset($_POST['idActivo']) && isset($_POST['name']) && isset($_POST['descripcion']) && isset($_POST['cantidad'])
        && isset($_POST['montoCompra'])) {

        $id = $_POST['idActivo'];
        $name = $_POST['name'];
        $descripcion = $_POST['descripcion'];
        $cantidad = $_POST['cantidad'];
        $montoCompra = $_POST['montoCompra'];

        if (strlen($id) > 0 && strlen($name) > 0 && strlen($descripcion) > 0 && strlen($cantidad) > 0
            && strlen($montoCompra) > 0) {

                $tempMonto = str_replace("₡","",$montoCompra);

            if (is_numeric($cantidad)) {
                $activo = new ActivoVariable($id, $name, $descripcion, $cantidad, $tempMonto, 1);
                $activoVariableBusiness = new ActivoVariableBusiness();
                $result = $activoVariableBusiness->update($activo);

                if ($result == 1) {
                    header("location: ../view/listarActivosVariables.php?success=updated");
                } else {
                    header("location: ../view/listarActivosVariables.php?error=dbError");
                }
            } else {
                header("location: ../view/listarActivosVariables.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarActivosVariables.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarActivosVariables.php?error=error");
    }
}


if (isset($_POST['eliminar'])) {
    if (isset($_POST['idActivo'])) {

        $id = $_POST['idActivo'];
        $activoVariableBusiness = new ActivoVariableBusiness();
        $result = $activoVariableBusiness->delete($id);

        if ($result == 1) {
            header("location: ../view/listarActivosVariables.php?success=deleted");
        } else {
            header("location: ../view/listarActivosVariables.php?error=dbError");
        }
    } else {
        header("location: ../view/listarActivosVariables.php?error=error");
    }
}

if (isset($_POST['insertar'])) {
    if (isset($_POST['name']) && isset($_POST['descripcion']) && isset($_POST['cantidad'])
        && isset($_POST['montoCompra'])) {

        $name = $_POST['name'];
        $descripcion = $_POST['descripcion'];
        $cantidad = $_POST['cantidad'];
        $montoCompra = $_POST['montoCompra'];

        if (strlen($name) > 0 && strlen($descripcion) > 0 && strlen($cantidad) > 0
            && strlen($montoCompra) > 0) {

            $tempMonto = str_replace("₡","",$montoCompra);
            $activo = new ActivoVariable(0, $name, $descripcion, $cantidad, $tempMonto, 1);

            if (is_numeric($cantidad)) {
                $activoVariableBusiness = new ActivoVariableBusiness();
                $result = $activoVariableBusiness->insertar($activo);

                if ($result == 1) {
                    header("location: ../view/listarActivosVariables.php?success=inserted");
                } else {
                    header("location: ../view/listarActivosVariables.php?error=dbError");
                }
            } else {
                header("location: ../view/listarActivosVariables.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarActivosVariables.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarActivosVariables.php?error=error");
    }
}
