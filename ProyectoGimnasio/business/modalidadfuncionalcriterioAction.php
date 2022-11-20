<?php
include 'modalidadFuncionalCriterioBusiness.php';

if (isset($_POST['insertarModalidadfuncionalcriterio'])) {
    if (isset($_POST['idModalidadfuncional']) && isset($_POST['nombre']) && isset($_POST['descripcion']) &&
        isset($_POST['rangoValorMinimo']) && isset($_POST['rangoValorMaximo'])) {

        $idModalidadfuncional = $_POST['idModalidadfuncional'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $rangoValorMinimo = $_POST['rangoValorMinimo'];
        $rangoValorMaximo = $_POST['rangoValorMaximo'];
        

        if (strlen($idModalidadfuncional) > 0 && strlen($nombre) > 0 && strlen($descripcion) > 0 && strlen($rangoValorMinimo) > 0
            && strlen($rangoValorMaximo) > 0 ) {

                $modalidadfuncionalcriterioBusiness = new ModalidadFuncionalCriterioBusiness();
                $elementos = $modalidadfuncionalcriterioBusiness->obtener();
                $flag = 0;
                foreach ($elementos as $row) { if($row->getNombreTBModalidadfuncionalcriterio() == $_POST['nombre'] && $row->getActivoTBModalidadfuncionalcriterio() == 1 && $row->getDescripcionTBModalidadfuncionalcriterio() == $_POST['descripcion']  ){  $flag = 1; } }
                    
        if($flag == 0){
    

            if (!is_numeric($nombre) && !is_numeric($descripcion) && is_numeric($idModalidadfuncional) && is_numeric($rangoValorMinimo) && is_numeric($rangoValorMaximo) ) {
                $modalidadfuncionalcriterio = new ModalidadFuncionalCriterio(0, $idModalidadfuncional, $nombre, $descripcion, $rangoValorMinimo, $rangoValorMaximo,1);
                $modalidadfuncionalcriterioBusiness = new ModalidadFuncionalCriterioBusiness();
                $resultado = $modalidadfuncionalcriterioBusiness->insertar($modalidadfuncionalcriterio);

                if ($resultado == 1) {
                    Header("Location: ../view/listarModalidadFuncionalCriterio.php?success=inserted");
                } else {
                    Header("Location: ../view/listarModalidadFuncionalCriterio.php?error=dbError&idModalidadfuncional=$idModalidadfuncional&nombre=$nombre&descripcion=$descripcion&rangoValorMinimo=$rangoValorMinimo&rangoValorMaximo=$rangoValorMaximo");
                }
            } else {
                header("location: ../view/listarModalidadFuncionalCriterio.php?error=numberFormat&idModalidadfuncional=$idModalidadfuncional&nombre=$nombre&descripcion=$descripcion&rangoValorMinimo=$rangoValorMinimo&rangoValorMaximo=$rangoValorMaximo");
            }

        } else {
            header("location: ../view/listarModalidadFuncionalCriterio.php?error=duplicate&idModalidadfuncional=$idModalidadfuncional&nombre=$nombre&descripcion=$descripcion&rangoValorMinimo=$rangoValorMinimo&rangoValorMaximo=$rangoValorMaximo");
        }
        } else {
            header("location: ../view/listarModalidadFuncionalCriterio.php?error=emptyField&idModalidadfuncional=$idModalidadfuncional&nombre=$nombre&descripcion=$descripcion&rangoValorMinimo=$rangoValorMinimo&rangoValorMaximo=$rangoValorMaximo");
        }
    } else {
        header("location: ../view/listarModalidadFuncionalCriterio.php?error=error&idModalidadfuncional=$idModalidadfuncional&nombre=$nombre&descripcion=$descripcion&rangoValorMinimo=$rangoValorMinimo&rangoValorMaximo=$rangoValorMaximo");
    }
}


if (isset($_POST['eliminarModalidadfuncionalcriterio'])) {
    if (isset($_POST['idModalidadfuncionalcriterio'])) {
        $id = $_POST['idModalidadfuncionalcriterio'];

        $modalidadfuncionalcriterioBusiness = new ModalidadFuncionalCriterioBusiness();
        $result = $modalidadfuncionalcriterioBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarModalidadFuncionalCriterio.php?success=deleted");
        } else {
            header("Location: ../view/listarModalidadFuncionalCriterio.php?error=dbError");
        }
    } else {
        header("location: ../view/listarModalidadFuncionalCriterio.php?error=error");
    }
}


if (isset($_POST['actualizarModalidadfuncionalcriterio'])) {
    if (isset($_POST['idModalidadfuncionalcriterio']) && isset($_POST['idModalidadfuncional']) && isset($_POST['nombre']) && isset($_POST['descripcion']) &&
    isset($_POST['rangoValorMinimo']) && isset($_POST['rangoValorMaximo'])) {

        $id = $_POST['idModalidadfuncionalcriterio'];
        $idModalidadfuncional = $_POST['idModalidadfuncional'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $rangoValorMaximo = $_POST['rangoValorMaximo'];
        $rangoValorMinimo = $_POST['rangoValorMinimo'];
      
        if (strlen($idModalidadfuncional) > 0 && strlen($nombre) > 0 && strlen($descripcion) > 0 && strlen($rangoValorMinimo) > 0
        && strlen($rangoValorMaximo) > 0) {

          

            if (!is_numeric($nombre) && !is_numeric($descripcion) && is_numeric($idModalidadfuncional) && is_numeric($rangoValorMinimo) && is_numeric($rangoValorMaximo) ) {

                $modalidadfuncionalcriterio = new ModalidadFuncionalCriterio($id,$idModalidadfuncional, $nombre, $descripcion, $rangoValorMaximo,$rangoValorMinimo, 1);
                $modalidadfuncionalcriterioBusiness = new ModalidadFuncionalCriterioBusiness();
                $resultado = $modalidadfuncionalcriterioBusiness->update($modalidadfuncionalcriterio);

                if ($resultado == 1) {
                    Header("Location: ../view/listarModalidadFuncionalCriterio.php?success=update");
                } else {

                    Header("Location: ../view/listarModalidadFuncionalCriterio.php?error=dbError");
                }
            } else {
                header("location: ../view/listarModalidadFuncionalCriterio.php?error=numberFormat");
            }

      
        } else {
            header("location: ../view/listarModalidadFuncionalCriterio.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarModalidadFuncionalCriterio.php?error=error");
    }
}
