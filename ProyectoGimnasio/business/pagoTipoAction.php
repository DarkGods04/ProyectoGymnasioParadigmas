<?php
include 'pagoTipoBusiness.php';

if (isset($_POST['insertar'])){
    if (isset($_POST['nombrePagoTipo'])){

        $nombrePagoTipo = $_POST['nombrePagoTipo'];

        if (strlen($nombrePagoTipo)){
            $pagoTipo = new PagoTipo(0, $nombrePagoTipo, 1);
            $pagoTipoBusiness = new PagoTipoBusiness();
            $resultado = $pagoTipoBusiness->insertar($pagoTipo);

            if ($resultado == 1) {
                Header("Location: ../view/listarTiposPago.php?success=inserted");
            } else {
                Header("Location: ../view/listarTiposPago.php?error=dbError");
            }
        } else {
            header("location: ../view/listarTiposPago.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarTiposPago.php?error=error");
    }
}

if (isset($_POST['eliminar'])) {
    if (isset($_POST['idPagoTipo'])) {
        $id = $_POST['idPagoTipo'];

        $pagoTipoBusiness = new PagoTipoBusiness();
        $result = $pagoTipoBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarTiposPago.php?success=deleted");
        } else {
            header("Location: ../view/listarTiposPago.php?error=dbError");
        }
    } else {
        header("location: ../view/listarTiposPago.php?error=error");
    }
}

if (isset($_POST['actualizar'])) {

    if (isset($_POST['idPagoTipo']) && isset($_POST['nombrePagoTipo'])){
        $idPagoTipo = $_POST['idPagoTipo'];
        $nombrePagoTipo = $_POST['nombrePagoTipo'];

        if (strlen($nombrePagoTipo) > 0){
            $pagoTipo = new PagoTipo($idPagoTipo, $nombrePagoTipo, 1);
            $pagoTipoBusiness = new PagoTipoBusiness();
            $resultado = $pagoTipoBusiness->update($pagoTipo);

            if ($resultado == 1) {
                Header("Location: ../view/listarTiposPago.php?success=update");
            } else {
                Header("Location: ../view/listarTiposPago.php?error=dbError");
            }
        } else {
            header("location: ../view/listarTiposPago.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarTiposPago.php?error=error");
    }

}