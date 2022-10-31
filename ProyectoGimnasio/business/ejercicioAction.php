<?php
include 'ejercicioBusiness.php';

if (isset($_POST['insertar'])) {
    if (isset($_POST['nombre']) && isset($_POST['descripcion'])) {
        $flag = false;
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        $ejercicioBusiness = new EjercicioBusiness();

        $ejercicios = $ejercicioBusiness->obtener();

        foreach ($ejercicios as $row) {
            if ($row->getNombreEjercicio() == $nombre) {
                $flag = true;
            }
        }

        if (strlen($nombre) > 0 && strlen($descripcion) > 0) {

            if ($flag == false) {

                $tempNombre = str_replace("%", "", $nombre);

                $ejercicio = new Ejercicio(0, $tempNombre, $descripcion, 1);

                $resultado = $ejercicioBusiness->insertar($ejercicio);

                if ($resultado == 1) {
                    Header("Location: ../view/listarEjercicios.php?success=inserted");
                } else {
                    Header("Location: ../view/listarEjercicios.php?error=dbError&nombre=$nombre&descripcion=$descripcion");
                }
            } else {
                header("location: ../view/listarEjercicios.php?error=existe&nombre=$nombre&descripcion=$descripcion");
            }
        } else {
            header("location: ../view/listarEjercicios.php?error=emptyField&nombre=$nombre&descripcion=$descripcion");
        }
    } else {
        header("location: ../view/listarEjercicios.php?error=error&nombre=$nombre&descripcion=$descripcion");
    }
}


if (isset($_POST['eliminar'])) {
    if (isset($_POST['idEjercicio'])) {
        $id = $_POST['idEjercicio'];

        $ejercicioBusiness = new EjercicioBusiness();
        $result = $ejercicioBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarEjercicios.php?success=deleted");
        } else {
            header("Location: ../view/listarEjercicios.php?error=dbError");
        }
    } else {
        header("location: ../view/listarEjercicios.php?error=error");
    }
}


if (isset($_POST['actualizar'])) {
    if (isset($_POST['idEjercicio']) && isset($_POST['nombre']) && isset($_POST['descripcion'])) {

        $id = $_POST['idEjercicio'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        if (strlen($nombre) > 0 && strlen($descripcion) > 0) {
            $tempNombre = str_replace("%", "", $nombre);

            if (!is_numeric($descripcion)) {
                $ejercicio = new Ejercicio($id, $tempNombre, $descripcion, 1);
                $ejercicioBusiness = new ejercicioBusiness();
                $resultado = $ejercicioBusiness->update($ejercicio);

                if ($resultado == 1) {
                    Header("Location: ../view/listarEjercicios.php?success=update");
                } else {
                    Header("Location: ../view/listarEjercicios.php?error=dbError");
                }
            } else {
                header("location: ../view/listarEjercicios.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarEjercicios.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarEjercicios.php?error=error");
    }
}
