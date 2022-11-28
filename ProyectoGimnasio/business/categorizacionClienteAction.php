<?php
include 'clienteBusiness.php';
include 'categorizacionClienteBusiness.php';

if (isset($_POST['insertar'])) {
    if (isset($_POST['idCliente']) && isset($_POST['idTipoCliente'])) {
        $existe = false;
        $idCliente = $_POST['idCliente'];
        $idTipoCliente = $_POST['idTipoCliente'];

        $categorizacionClienteBusiness = new CategorizacionClienteBusiness();
        $categorizaciones= $categorizacionClienteBusiness->obtener();
        foreach ($categorizaciones as $row) {
            if ($row->getIdCliente() == $idCliente) {
                $existe = true;
            }
        }
        if (strlen($idCliente) > 0 && strlen($idTipoCliente) > 0) {

            $categorizacionClienteBusiness = new CategorizacionClienteBusiness();
            $categorizaciones= $categorizacionClienteBusiness->obtener();
            $flag = 0;
            foreach ($categorizaciones as $row) { 
                if($row->getIdCliente() == $_POST['idCliente'] && $row->getCategorizacionClienteActivo() == 1  ){  
                $flag = 1; 
            } 
        }
                
    if($flag == 0){

            if (is_numeric($idCliente) && is_numeric($idTipoCliente)) {
                if ($existe == false) {
                    $categorizacion = new CategorizacionCliente(0, $idCliente, $idTipoCliente, 1);
                    $CategorizacionClienteBusiness = new CategorizacionClienteBusiness();
                    $resultado = $CategorizacionClienteBusiness->insertar($categorizacion);

                    if ($resultado == 1) {
                        Header("Location: ../view/listarCategorizacionCliente.php?success=inserted");
                    } else {
                        Header("Location: ../view/listarCategorizacionCliente.php?error=dbError&idCliente=$idCliente&idTipoCliente=$idTipoCliente");
                    }
                } else { 
                    Header("Location: ../view/listarCategorizacionCliente.php?error=existe&idCliente=$idCliente&idTipoCliente=$idTipoCliente");
                }
            } else {
                header("location: ../view/listarCategorizacionCliente.php?error=numberFormat&idCliente=$idCliente&idTipoCliente=$idTipoCliente");
            }
        } else {
            header("location: ../view/listarCategorizacionCliente.php?error=duplicate&idCliente=$idCliente&idTipoCliente=$idTipoCliente");
        }
        } else {
            header("location: ../view/listarCategorizacionCliente.php?error=emptyField&idCliente=$idCliente&idTipoCliente=$idTipoCliente");
        }
    } else {
        header("location: ../view/listarCategorizacionCliente.php?error=error&idCliente=$idCliente&idTipoCliente=$idTipoCliente");
    }
}


if (isset($_POST['eliminar'])) {
    if (isset($_POST['idCategorizacion'])) {
        $id = $_POST['idCategorizacion'];

        $categorizacionClienteBusiness = new CategorizacionClienteBusiness();
        $result = $categorizacionClienteBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarCategorizacionCliente.php?success=deleted");
        } else {
            header("Location: ../view/listarCategorizacionCliente.php?error=dbError");
        }
    } else {
        header("location: ../view/listarCategorizacionCliente.php?error=error");
    }
}

if (isset($_POST['actualizar'])) {



    if (isset($_POST['idCategorizacion'])  && isset($_POST['idTipoCliente'])) {
        $idCategorizacion = $_POST['idCategorizacion'];
        $idCliente = $_POST['idCliente'];
        $idClienteTipo = $_POST['idTipoCliente'];

        if (strlen($idClienteTipo) > 0) {

          
            if (is_numeric($idCategorizacion)) {
                $categorizacionCliente = new CategorizacionCliente($idCategorizacion, $idCliente, $idClienteTipo, 1);
                $CategorizacionClienteBusiness = new CategorizacionClienteBusiness();
                $resultado = $CategorizacionClienteBusiness->update($categorizacionCliente);

                if ($resultado == 1) {
                    Header("Location: ../view/listarCategorizacionCliente.php?success=update");
                } else {
                    Header("Location: ../view/listarCategorizacionCliente.php?error=dbError");
                }
            } else {
                header("location: ../view/listarCategorizacionCliente.php?error=numberFormat");
            }

        
        } else {
            header("location: ../view/listarCategorizacionCliente.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarCategorizacionCliente.php?error=error");
    }
}
