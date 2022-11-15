<?php
include 'rutinaNivelBusiness.php';

if (isset($_POST['insertar'])) {
    if (isset($_POST['nombreRutinaNivel']) && isset($_POST['descripcionRutinaNivel'])) {
        $existe = false;
        $nombreRutinaNivel = $_POST['nombreRutinaNivel'];
        $descripcionRutinaNivel = $_POST['descripcionRutinaNivel'];

        $rutinaNivelBusiness = new RutinaNivelBusiness();
        $rutinaNiveles= $rutinaNivelBusiness->obtener();
        foreach ($rutinaNiveles as $row) {
            if ($row->getNombreTBRutinaNivel() == $nombreRutinaNivel) {
                $existe = true;
            }
        }
        if (strlen($nombreRutinaNivel) > 0 && strlen($descripcionRutinaNivel) > 0) {

            if (!is_numeric($nombreRutinaNivel)) {
                if ($existe == false) {
                    $rutinaNivel = new RutinaNivel(0, $nombreRutinaNivel, $descripcionRutinaNivel, 1);
                    $rutinaNivelBusiness = new RutinaNivelBusiness();
                    $resultado = $rutinaNivelBusiness->insertar($rutinaNivel);

                    if ($resultado == 1) {
                        Header("Location: ../view/listarRutinaNivel.php?success=inserted");
                    } else {
                        Header("Location: ../view/listarRutinaNivel.php?error=dbError&nombreRutinaNivel=$nombreRutinaNivel&descripcionRutinaNivel=$descripcionRutinaNivel");
                    }
                } else { 
                    Header("Location: ../view/listarRutinaNivel.php?error=existe&nombreRutinaNivel=$nombreRutinaNivel&descripcionRutinaNivel=$descripcionRutinaNivel");
                }
            } else {
                header("location: ../view/listarRutinaNivel.php?error=numberFormat&nombreRutinaNivel=$nombreRutinaNivel&descripcionRutinaNivel=$descripcionRutinaNivel");
            }
        } else {
            header("location: ../view/listarRutinaNivel.php?error=emptyField&nombreRutinaNivel=$nombreRutinaNivel&descripcionRutinaNivel=$descripcionRutinaNivel");
        }
    } else {
        header("location: ../view/listarRutinaNivel.php?error=error&nombreRutinaNivel=$nombreRutinaNivel&descripcionRutinaNivel=$descripcionRutinaNivel");
    }
}

if (isset($_POST['eliminar'])) {
    if (isset($_POST['idRutinaNivel'])) {
        $id = $_POST['idRutinaNivel'];

        $rutinaNivelBusiness = new RutinaNivelBusiness();
        $result = $rutinaNivelBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarRutinaNivel.php?success=deleted");
        } else {
            header("Location: ../view/listarRutinaNivel.php?error=dbError");
        }
    } else {
        header("location: ../view/listarRutinaNivel.php?error=error");
    }
}

if (isset($_POST['actualizar'])) {

    if (isset($_POST['idRutinaNivel']) && isset($_POST['nombreRutinaNivel']) && isset($_POST['descripcionRutinaNivel'])) {
        $idRutinaNivel = $_POST['idRutinaNivel'];
        $nombreRutinaNivel = $_POST['nombreRutinaNivel'];
        $descripcionRutinaNivel = $_POST['descripcionRutinaNivel'];

        if (strlen($nombreRutinaNivel) > 0 && strlen($descripcionRutinaNivel) > 0) {

            if (!is_numeric($nombreRutinaNivel)) {
                $rutinaNivel = new RutinaNivel($idRutinaNivel, $nombreRutinaNivel, $descripcionRutinaNivel, 1);
                $rutinaNivelBusiness = new RutinaNivelBusiness();
                $resultado = $rutinaNivelBusiness->update($rutinaNivel);

                if ($resultado == 1) {
                    Header("Location: ../view/listarRutinaNivel.php?success=update");
                } else {
                    Header("Location: ../view/listarRutinaNivel.php?error=dbError");
                }
            } else {
                header("location: ../view/listarRutinaNivel.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarRutinaNivel.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarRutinaNivel.php?error=error");
    }
}
