<?php
include 'modalidadFuncionalBusiness.php';
include 'modalidadfuncionalcriterioBusiness.php';

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
                    header("location: ../view/listarModalidadFuncional.php?success=inserted");
                } else {
                    header("location: ../view/listarModalidadFuncional.php?error=dbError&nombreModalidadFuncional=$nombreModalidadFuncional&descripcionModalidadFuncional=$descripcionModalidadFuncional");
                }
            } else {
                header("location: ../view/listarModalidadFuncional.php?error=numberFormat&nombreModalidadFuncional=$nombreModalidadFuncional&descripcionModalidadFuncional=$descripcionModalidadFuncional");
            }
        } else {
            header("location: ../view/listarModalidadFuncional.php?error=emptyField&nombreModalidadFuncional=$nombreModalidadFuncional&descripcionModalidadFuncional=$descripcionModalidadFuncional");
        }
    } else {
        header("location: ../view/listarModalidadFuncional.php?error=error&nombreModalidadFuncional=$nombreModalidadFuncional&descripcionModalidadFuncional=$descripcionModalidadFuncional");
    }
}

if (isset($_POST['eliminar'])) {

    $modalidadfuncionalcriterioBusiness = new ModalidadFuncionalCriterioBusiness();
    $modalidadfuncionalcriterios = $modalidadfuncionalcriterioBusiness->obtener();
    $flag = 0;
    foreach ($modalidadfuncionalcriterios as $row) { if($row->getIdModalidadfuncionalTBModalidadfuncionalcriterio() == $_POST['idModalidadFuncional'] && $row->getActivoTBModalidadfuncionalcriterio() == 1 ){  $flag = 1; } }
       
    if($flag == 0){

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

    } else {
    header("location: ../view/listarModalidadFuncional.php?error=relationError");
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
