<?php
include 'activoFijoBusiness.php';

if (isset($_POST['insertar'])) {
    if (isset($_POST['placa']) && isset($_POST['serie']) && isset($_POST['modelo']) &&
        isset($_POST['fechaCompra']) && isset($_POST['montoCompra']) && isset($_POST['estadoUso'])) {

        $placa = $_POST['placa'];
        $serie = $_POST['serie'];
        $modelo = $_POST['modelo'];
        $fechaCompra = $_POST['fechaCompra'];
        $montoCompra = $_POST['montoCompra'];
        $estadoUso = $_POST['estadoUso'];

        if (strlen($placa) > 0 && strlen($serie) > 0 && strlen($modelo) > 0 && strlen($fechaCompra) > 0
            && strlen($montoCompra) > 0 && strlen($estadoUso) > 0) {

                $tempMonto = str_replace("₡","",$montoCompra);

            if (!is_numeric($estadoUso)) {
                $activo = new ActivoFijo(0, $placa, $serie, $modelo, $fechaCompra, $tempMonto, $estadoUso, 1);
                $activoBusiness = new ActivoFijoBusiness();
                $resultado = $activoBusiness->insertar($activo);

                if ($resultado == 1) {
                    Header("Location: ../view/listarActivosFijos.php?success=inserted");
                } else {
                    Header("Location: ../view/listarActivosFijos.php?error=dbError");
                }
            } else {
                header("location: ../view/listarActivosFijos.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarActivosFijos.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarActivosFijos.php?error=error");
    }
}


if (isset($_POST['eliminar'])) {
    if (isset($_POST['idActivo'])) {
        $id = $_POST['idActivo'];

        $activoBusiness = new ActivoFijoBusiness();
        $result = $activoBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarActivosFijos.php?success=deleted");
        } else {
            header("Location: ../view/listarActivosFijos.php?error=dbError");
        }
    } else {
        header("location: ../view/listarActivosFijos.php?error=error");
    }
}


if (isset($_POST['actualizar'])) {
    if (isset($_POST['idActivo']) && isset($_POST['placa']) && isset($_POST['serie']) && isset($_POST['modelo'])
        && isset($_POST['fechaCompra']) && isset ($_POST['montoCompra']) && isset($_POST['estadoUso'])) {

        $id = $_POST['idActivo'];
        $placa = $_POST['placa'];
        $serie = $_POST['serie'];
        $modelo = $_POST['modelo'];
        $fechaCompra = $_POST['fechaCompra'];
        $montoCompra = $_POST['montoCompra'];
        $estadoUso = $_POST['estadoUso'];

        if (strlen($placa) > 0 && strlen($serie) > 0 && strlen($modelo) > 0 && strlen($fechaCompra) > 0
            && strlen($montoCompra) > 0 && strlen($estadoUso) > 0) {

                $tempMonto = str_replace("₡","",$montoCompra);

            if (!is_numeric($estadoUso)) {

                $activo = new ActivoFijo($id, $placa, $serie, $modelo, $fechaCompra, $tempMonto, $estadoUso, 1);
                $activoBusiness = new ActivoFijoBusiness();
                $resultado = $activoBusiness->update($activo);

                if ($resultado == 1) {
                    Header("Location: ../view/listarActivosFijos.php?success=update");
                } else {
                    Header("Location: ../view/listarActivosFijos.php?error=dbError");
                }
            } else {
                header("location: ../view/listarActivosFijos.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarActivosFijos.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarActivosFijos.php?error=error");
    }
}
