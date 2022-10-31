<?php
include 'grupoMuscularBusiness.php';

if (isset($_POST['insertar'])) {
    if (isset($_POST['nombreGrupoMuscular']) && isset($_POST['descripcionGrupoMuscular'])) {
        $existe = false;
        $nombreGrupoMuscular = $_POST['nombreGrupoMuscular'];
        $descripcionGrupoMuscular = $_POST['descripcionGrupoMuscular'];

        $grupoMuscularBusiness = new GrupoMuscularBusiness();
        $gruposMusculares= $grupoMuscularBusiness->obtener();
        foreach ($gruposMusculares as $row) {
            if ($row->getNombreTBGrupoMuscular() == $nombreGrupoMuscular) {
                $existe = true;
            }
        }
        if (strlen($nombreGrupoMuscular) > 0 && strlen($descripcionGrupoMuscular) > 0) {

            if (!is_numeric($nombreGrupoMuscular)) {
                if ($existe == false) {
                    $grupoMuscular = new GrupoMuscular(0, $nombreGrupoMuscular, $descripcionGrupoMuscular, 1);
                    $grupoMuscularBusiness = new GrupoMuscularBusiness();
                    $resultado = $grupoMuscularBusiness->insertar($grupoMuscular);

                    if ($resultado == 1) {
                        Header("Location: ../view/listarGrupoMuscular.php?success=inserted");
                    } else {
                        Header("Location: ../view/listarGrupoMuscular.php?error=dbError");
                    }
                } else { 
                    Header("Location: ../view/listarGrupoMuscular.php?error=existe");
                }
            } else {
                header("location: ../view/listarGrupoMuscular.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarGrupoMuscular.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarGrupoMuscular.php?error=error");
    }
}

if (isset($_POST['eliminar'])) {
    if (isset($_POST['idGrupoMuscular'])) {
        $id = $_POST['idGrupoMuscular'];

        $grupoMuscularBusiness = new GrupoMuscularBusiness();
        $result = $grupoMuscularBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarGrupoMuscular.php?success=deleted");
        } else {
            header("Location: ../view/listarGrupoMuscular.php?error=dbError");
        }
    } else {
        header("location: ../view/listarGrupoMuscular.php?error=error");
    }
}

if (isset($_POST['actualizar'])) {

    if (isset($_POST['idGrupoMuscular']) && isset($_POST['nombreGrupoMuscular']) && isset($_POST['descripcionGrupoMuscular'])) {
        $idGrupoMuscular = $_POST['idGrupoMuscular'];
        $nombreGrupoMuscular = $_POST['nombreGrupoMuscular'];
        $descripcionGrupoMuscular = $_POST['descripcionGrupoMuscular'];

        if (strlen($nombreGrupoMuscular) > 0 && strlen($descripcionGrupoMuscular) > 0) {

            if (!is_numeric($nombreGrupoMuscular)) {
                $grupoMuscular = new GrupoMuscular($idGrupoMuscular, $nombreGrupoMuscular, $descripcionGrupoMuscular, 1);
                $grupoMuscularBusiness = new grupoMuscularBusiness();
                $resultado = $grupoMuscularBusiness->update($grupoMuscular);

                if ($resultado == 1) {
                    Header("Location: ../view/listarGrupoMuscular.php?success=update");
                } else {
                    Header("Location: ../view/listarGrupoMuscular.php?error=dbError");
                }
            } else {
                header("location: ../view/listarGrupoMuscular.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarGrupoMuscular.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarGrupoMuscular.php?error=error");
    }
}
