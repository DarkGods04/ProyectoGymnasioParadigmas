<?php
include 'medidaIsometricaBusiness.php';

if (isset($_POST['insertar'])) {
    if (isset($_POST['idGrupoMuscular']) && isset($_POST['idCliente']) && isset($_POST['fechaMedicion']) && isset($_POST['medida'])) {
        $flag = false;

        $idGrupoMuscular = $_POST['idGrupoMuscular'];
        $idCliente = $_POST['idCliente'];
        $fechaMedicion = $_POST['fechaMedicion'];
        $medida = $_POST['medida'];
        

        $medidaBusiness = new MedidaIsometricaBusiness();


        if (strlen($idGrupoMuscular) > 0 && strlen($idCliente) > 0 && strlen($medida) > 0 && strlen($fechaMedicion) > 0) {

                $tempMedida = str_replace("%", "", $medida);

                $medidaIsometrica = new MedidaIsometrica(0,$idGrupoMuscular,$idCliente,$fechaMedicion, $tempMedida, 1);

                $resultado = $medidaBusiness->insertar($medidaIsometrica);

                if ($resultado == 1) {
                    Header("Location: ../view/listarMedidasIsometricas.php?success=inserted");
                } else {
                    Header("Location: ../view/listarMedidasIsometricas.php?error=dbError&&grupoMuscular=$idGrupoMuscular&&cliente=$idCliente&&fecha=$fechaMedicion&&medidaIsometrica=$medida");
                }
           
        } else {
            header("location: ../view/listarMedidasIsometricas.php?error=emptyField&&grupoMuscular=$idGrupoMuscular&&cliente=$idCliente&&fecha=$fechaMedicion&&medidaIsometrica=$medida");
        }
    } else {
        header("location: ../view/listarMedidasIsometricas.php?error=error&&grupoMuscular=$idGrupoMuscular&&cliente=$idCliente&&fecha=$fechaMedicion&&medidaIsometrica=$medida");
    }
}


if (isset($_POST['eliminar'])) {
    if (isset($_POST['idMedida'])) {
        $id = $_POST['idMedida'];

        $medidaBusiness = new MedidaIsometricaBusiness();
        $result = $medidaBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarMedidasIsometricas.php?success=deleted");
        } else {
            header("Location: ../view/listarMedidasIsometricas.php?error=dbError");
        }
    } else {
        header("location: ../view/listarMedidasIsometricas.php?error=error");
    }
}


if (isset($_POST['actualizar'])) {
    if (isset($_POST['idMedida']) && isset($_POST['idGrupoMuscular']) && isset($_POST['idCliente']) && isset($_POST['fechaMedicion']) && isset($_POST['medida'])) {

        $id = $_POST['idMedida'];
        $idGrupoMuscular = $_POST['idGrupoMuscular'];
        $idCliente = $_POST['idCliente'];
        $fechaMedicion = $_POST['fechaMedicion'];
        $medida = $_POST['medida'];
         

        if (strlen($idGrupoMuscular) > 0 && strlen($idCliente) > 0 && strlen($fechaMedicion) > 0 && strlen($medida) > 0) {
           
           // $tempMedida = str_replace("₡", "", $medida);

            if (is_numeric($medida)) {
                $medidaIsometrica = new MedidaIsometrica($id, $idGrupoMuscular, $idCliente,$fechaMedicion,$medida, 1);
                $medidaIsometricaBusiness = new MedidaIsometricaBusiness();
                $resultado = $medidaIsometricaBusiness->update($medidaIsometrica);

                if ($resultado == 1) {
                    Header("Location: ../view/listarMedidasIsometricas.php?success=update");
                } else {
                    Header("Location: ../view/listarMedidasIsometricas.php?error=dbError");
                }
            } else {
                header("location: ../view/listarMedidasIsometricas.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarMedidasIsometricas.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarMedidasIsometricas.php?error=error");
    }
}
