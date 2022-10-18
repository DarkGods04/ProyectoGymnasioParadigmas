<?php
include 'modalidadfuncionalcriterioBusiness.php';

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

            if (!is_numeric($nombre) && !is_numeric($descripcion) && is_numeric($idModalidadfuncional) && is_numeric($rangoValorMinimo) && is_numeric($rangoValorMaximo) ) {
                $modalidadfuncionalcriterio = new Modalidadfuncionalcriterio(0, $idModalidadfuncional, $nombre, $descripcion, $rangoValorMinimo, $rangoValorMaximo,1);
                $modalidadfuncionalcriterioBusiness = new ModalidadfuncionalcriterioBusiness();
                $resultado = $modalidadfuncionalcriterioBusiness->insertar($modalidadfuncionalcriterio);

                if ($resultado == 1) {
                    Header("Location: ../view/listarModalidadfuncionalcriterio.php?success=inserted");
                } else {
                    Header("Location: ../view/listarModalidadfuncionalcriterio.php?error=dbError");
                }
            } else {
                header("location: ../view/listarModalidadfuncionalcriterio.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarModalidadfuncionalcriterio.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarModalidadfuncionalcriterio.php?error=error");
    }
}


if (isset($_POST['eliminarModalidadfuncionalcriterio'])) {
    if (isset($_POST['idModalidadfuncionalcriterio'])) {
        $id = $_POST['idModalidadfuncionalcriterio'];

        $modalidadfuncionalcriterioBusiness = new ModalidadfuncionalcriterioBusiness();
        $result = $modalidadfuncionalcriterioBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarModalidadfuncionalcriterio.php?success=deleted");
        } else {
            header("Location: ../view/listarModalidadfuncionalcriterio.php?error=dbError");
        }
    } else {
        header("location: ../view/listarModalidadfuncionalcriterio.php?error=error");
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

                $modalidadfuncionalcriterio = new Modalidadfuncionalcriterio($id,$idModalidadfuncional, $nombre, $descripcion, $rangoValorMaximo,$rangoValorMinimo, 1);
                $modalidadfuncionalcriterioBusiness = new ModalidadfuncionalcriterioBusiness();
                $resultado = $modalidadfuncionalcriterioBusiness->update($modalidadfuncionalcriterio);

                if ($resultado == 1) {
                    Header("Location: ../view/listarModalidadfuncionalcriterio.php?success=update");
                } else {

                    Header("Location: ../view/listarModalidadfuncionalcriterio.php?error=dbError");
                }
            } else {
                header("location: ../view/listarModalidadfuncionalcriterio.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarModalidadfuncionalcriterio.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarModalidadfuncionalcriterio.php?error=error");
    }
}
