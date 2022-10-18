
<?php
include 'pagoModalidadBusiness.php';

if (isset($_POST['actualizar'])) {
    if (isset($_POST['idPagoModalidad']) && isset($_POST['nombreModalidad']) && isset($_POST['descripcionModalidad'])) {

         $id = $_POST['idPagoModalidad'];
         $name = $_POST['nombreModalidad'];
         $descripcion = $_POST['descripcionModalidad'];

        if (strlen($id) > 0 && strlen($name) > 0 && strlen($descripcion) > 0) {

            $pagoModalidad = new PagoModalidad($id, $name, $descripcion, 1);
            $pagoModalidadBusiness = new PagoModalidadBusiness();
            $result = $pagoModalidadBusiness->update($pagoModalidad);

            if ($result == 1) {
                header("location: ../view/listarPagoModalidad.php?success=updated");
            } else {
                header("location: ../view/listarPagoModalidad.php?error=dbError");
            }
        } else {
            header("location: ../view/listarPagoModalidad.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarPagoModalidad.php?error=error");
    }
}


if (isset($_POST['eliminar'])) {
    if (isset($_POST['idPagoModalidad'])) {

        $id = $_POST['idPagoModalidad'];
        $pagoModalidadBusiness = new PagoModalidadBusiness();
        $result = $pagoModalidadBusiness->delete($id);

        if ($result == 1) {
            header("location: ../view/listarPagoModalidad.php?success=deleted");
        } else {
            header("location: ../view/listarPagoModalidad.php?error=dbError");
        }
    } else {
        header("location: ../view/listarPagoModalidad.php?error=error");
    }
}

if (isset($_POST['insertar'])) {
    if (isset($_POST['nombre']) && isset($_POST['descripcion'])) {

        $name = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        if (strlen($name) > 0 && strlen($descripcion) > 0) {
            $pagomodalidad = new PagoModalidad(0, $name, $descripcion, 1);

            $pagoModalidadBusiness = new PagoModalidadBusiness();
            $result = $pagoModalidadBusiness->insertar($pagomodalidad);

            if ($result == 1) {
                header("location: ../view/listarPagoModalidad.php?success=inserted");
            } else {
                header("location: ../view/listarPagoModalidad.php?error=dbError");
            }
        } else {
            header("location: ../view/listarPagoModalidad.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarPagoModalidad.php?error=error");
    }
}
