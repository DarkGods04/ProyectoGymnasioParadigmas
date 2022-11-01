<?php
include 'clienteTipoBusiness.php';

if (isset($_POST['insertar'])) {
    if (isset($_POST['nombreClienteTipo']) && isset($_POST['descripcionClienteTipo'])) {
        $existe = false;
        $nombreClienteTipo = $_POST['nombreClienteTipo'];
        $descripcionClienteTipo = $_POST['descripcionClienteTipo'];

        $clienteTipoBusiness = new ClienteTipoBusiness();
        $clienteTipos= $clienteTipoBusiness->obtener();
        foreach ($clienteTipos as $row) {
            if ($row->getNombreTBClienteTipo() == $nombreClienteTipo) {
                $existe = true;
            }
        }
        if (strlen($nombreClienteTipo) > 0 && strlen($descripcionClienteTipo) > 0) {

            if (!is_numeric($nombreClienteTipo)) {
                if ($existe == false) {
                    $clienteTipo = new ClienteTipo(0, $nombreClienteTipo, $descripcionClienteTipo, 1);
                    $clienteTipoBusiness = new ClienteTipoBusiness();
                    $resultado = $clienteTipoBusiness->insertar($clienteTipo);

                    if ($resultado == 1) {
                        Header("Location: ../view/listarClienteTipo.php?success=inserted");
                    } else {
                        Header("Location: ../view/listarClienteTipo.php?error=dbError&nombreClienteTipo=$nombreClienteTipo&descripcionClienteTipo=$descripcionClienteTipo");
                    }
                } else { 
                    Header("Location: ../view/listarClienteTipo.php?error=existe&nombreClienteTipo=$nombreClienteTipo&descripcionClienteTipo=$descripcionClienteTipo");
                }
            } else {
                header("location: ../view/listarClienteTipo.php?error=numberFormat&nombreClienteTipo=$nombreClienteTipo&descripcionClienteTipo=$descripcionClienteTipo");
            }
        } else {
            header("location: ../view/listarClienteTipo.php?error=emptyField&nombreClienteTipo=$nombreClienteTipo&descripcionClienteTipo=$descripcionClienteTipo");
        }
    } else {
        header("location: ../view/listarClienteTipo.php?error=error&nombreClienteTipo=$nombreClienteTipo&descripcionClienteTipo=$descripcionClienteTipo");
    }
}


if (isset($_POST['eliminar'])) {
    if (isset($_POST['idClienteTipo'])) {
        $id = $_POST['idClienteTipo'];

        $clienteTipoBusiness = new ClienteTipoBusiness();
        $result = $clienteTipoBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarClienteTipo.php?success=deleted");
        } else {
            header("Location: ../view/listarClienteTipo.php?error=dbError");
        }
    } else {
        header("location: ../view/listarClienteTipo.php?error=error");
    }
}

if (isset($_POST['actualizar'])) {

    if (isset($_POST['idClienteTipo']) && isset($_POST['nombreClienteTipo']) && isset($_POST['descripcionClienteTipo'])) {
        $idClienteTipo = $_POST['idClienteTipo'];
        $nombreClienteTipo = $_POST['nombreClienteTipo'];
        $descripcionClienteTipo = $_POST['descripcionClienteTipo'];

        if (strlen($nombreClienteTipo) > 0 && strlen($descripcionClienteTipo) > 0) {

            if (!is_numeric($nombreClienteTipo)) {
                $clienteTipo = new ClienteTipo($idClienteTipo, $nombreClienteTipo, $descripcionClienteTipo, 1);
                $clienteTipoBusiness = new ClienteTipoBusiness();
                $resultado = $clienteTipoBusiness->update($clienteTipo);

                if ($resultado == 1) {
                    Header("Location: ../view/listarClienteTipo.php?success=update");
                } else {
                    Header("Location: ../view/listarClienteTipo.php?error=dbError");
                }
            } else {
                header("location: ../view/listarClienteTipo.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarClienteTipo.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarClienteTipo.php?error=error");
    }
}
