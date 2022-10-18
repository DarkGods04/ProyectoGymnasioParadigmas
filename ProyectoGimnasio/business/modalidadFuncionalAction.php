<?php
include 'modalidadFuncionalBusiness.php';

if (isset($_POST["insertar"])) {
    if (isset($_POST["nombreModalidadFuncional"]) && isset($_POST["descripcionModalidadFuncional"])) {

        $nombreModalidadFuncional = $_POST["nombreModalidadFuncional"];
        $descripcionModalidadFuncional = $_POST["descripcionModalidadFuncional"];

        if (strlen($nombreModalidadFuncional) > 0 && strlen($descripcionModalidadFuncional) > 0) {

            if (!is_numeric($nombreModalidadFuncional)) {
                $modalidadFuncional = new ModalidadFuncional(0, $nombreModalidadFuncional, $descripcionModalidadFuncional, 1);
                $modalidadFuncionalBusiness = new modalidadFuncionalBusiness();
                $result = $modalidadFuncionalBusiness->insertar($modalidadFuncional);

                if ($result == 1) {
                    header("location: ../view/listarModalidadFuncional.php?success=updated");
                } else {
                    header("location: ../view/listarModalidadFuncional.php?error=dbError");
                }
            } else {
                header("location: ../view/listarModalidadFuncional.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarModalidadFuncional.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarModalidadFuncional.php?error=error");
    }
}

if (isset($_POST['eliminar'])) {
    if (isset($_POST['idModalidadFuncional'])) {

        $id = $_POST['idModalidadFuncional'];
        $modalidadFuncionalBusiness = new ModalidadFuncionalBusiness();
        $result = $modalidadFuncionalBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarModalidadFuncional.php?success=deleted");
        } else {
            header("Location: ../view/listarModalidadFuncional.php?error=dbError");
        }
    } else {
        header("location: ../view/listarModalidadFuncional.php?error=error");
    }
}

if (isset($_POST['actualizar'])) {
    if (isset($_POST['idModalidadFuncional']) && isset($_POST['nombreModalidadFuncional']) && isset($_POST['descripcionModalidadFuncional'])) {

        $id = $_POST['idModalidadFuncional'];
        $nombreModalidadFuncional = $_POST["nombreModalidadFuncional"];
        $descripcionModalidadFuncional = $_POST["descripcionModalidadFuncional"];

        if (strlen($nombreModalidadFuncional) > 0 && strlen($descripcionModalidadFuncional) > 0) {

            if (!is_numeric($nombreModalidadFuncional)) {
                $modalidadFuncional = new ModalidadFuncional($id, $nombreModalidadFuncional, $descripcionModalidadFuncional, 1);
                $modalidadFuncionalBusiness = new modalidadFuncionalBusiness();
                $result = $modalidadFuncionalBusiness->update($modalidadFuncional);

                if ($result == 1) {
                    header("location: ../view/listarModalidadFuncional.php?success=updated");
                } else {
                
                    header("location: ../view/listarModalidadFuncional.php?error=dbError");
                }
            } else {
                header("location: ../view/listarModalidadFuncional.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarModalidadFuncional.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarModalidadFuncional.php?error=error");
    }
}
