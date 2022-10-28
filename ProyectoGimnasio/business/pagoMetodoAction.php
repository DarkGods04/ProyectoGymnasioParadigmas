<?php
include 'pagoMetodoBusiness.php';

if (isset($_POST['insertar'])){
    if (isset($_POST['nombrePagoMetodo']) && isset($_POST['descripcionPagoMetodo'])){

        $nombrePagoMetodo = $_POST['nombrePagoMetodo'];
        $descripcionPagoMetodo = $_POST['descripcionPagoMetodo'];

        if (strlen($nombrePagoMetodo) > 0 && strlen($descripcionPagoMetodo) > 0){

            if (!is_numeric($nombrePagoMetodo)) {
                $pagoMetodo = new PagoMetodo(0, $nombrePagoMetodo, $descripcionPagoMetodo, 1);
                $pagoMetodoBusiness = new PagoMetodoBusiness();
                $resultado = $pagoMetodoBusiness->insertar($pagoMetodo);

                if ($resultado == 1) {
                    Header("Location: ../view/listarPagoMetodos.php?success=inserted");
                } else {
                    Header("Location: ../view/listarPagoMetodos.php?error=dbError");
                }
            } else {
                header("location: ../view/listarPagoMetodos.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarPagoMetodos.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarPagoMetodos.php?error=error");
    }
}

if (isset($_POST['eliminar'])) {
    if (isset($_POST['idPagoMetodo'])) {
        $id = $_POST['idPagoMetodo'];

        $pagoMetodoBusiness = new PagoMetodoBusiness();
        $result = $pagoMetodoBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarPagoMetodos.php?success=deleted");
        } else {
            header("Location: ../view/listarPagoMetodos.php?error=dbError");
        }
    } else {
        header("location: ../view/listarPagoMetodos.php?error=error");
    }
}

if (isset($_POST['actualizar'])) {

    if (isset($_POST['idPagoMetodo']) && isset($_POST['nombrePagoMetodo']) && isset($_POST['descripcionPagoMetodo'])){
        $idPagoMetodo = $_POST['idPagoMetodo'];
        $nombrePagoMetodo = $_POST['nombrePagoMetodo'];
        $descripcionPagoMetodo = $_POST['descripcionPagoMetodo'];

        if (strlen($nombrePagoMetodo) > 0 && strlen($descripcionPagoMetodo) > 0){

            if (!is_numeric($nombrePagoMetodo)) {
                $pagoMetodo = new PagoMetodo($idPagoMetodo, $nombrePagoMetodo, $descripcionPagoMetodo, 1);
                $pagoMetodoBusiness = new pagoMetodoBusiness();
                $resultado = $pagoMetodoBusiness->update($pagoMetodo);

                if ($resultado == 1) {
                    Header("Location: ../view/listarPagoMetodos.php?success=update");
                } else {
                    Header("Location: ../view/listarPagoMetodos.php?error=dbError");
                }
            } else {
                header("location: ../view/listarPagoMetodos.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarPagoMetodos.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarPagoMetodos.php?error=error");
    }

}