<?php
include 'servicioBusiness.php';
include 'facturaBusiness.php';
if (isset($_POST["insertar"])) {
    if (isset($_POST["nombreServicio"]) && isset($_POST["descripcionServicio"]) && isset($_POST["montoServicio"])) {

        $nombreServicio = $_POST["nombreServicio"];
        $descripcionServicio = $_POST["descripcionServicio"];
        $montoServicio = $_POST["montoServicio"];

        if (strlen($nombreServicio) > 0 && strlen($descripcionServicio) > 0 && strlen($montoServicio) > 0) {
            $tempMonto = str_replace("₡","",$montoServicio);

            //if (is_numeric($montoServicio)) {
                $servicio = new Servicio(0, $nombreServicio, $descripcionServicio, $tempMonto, 1);
                $servicioBusiness = new servicioBusiness();
                $result = $servicioBusiness->insertar($servicio);

                if ($result == 1) {
                    header("location: ../view/listarServicios.php?success=updated");
                } else {
                    header("location: ../view/listarServicios.php?error=dbError&nombreServicio=$nombreServicio&descripcionServicio=$descripcionServicio&montoServicio=$montoServicio");
                }
            /*} else {
                header("location: ../view/listarServicios.php?error=numberFormat");
            }*/
        } else {
            header("location: ../view/listarServicios.php?error=emptyField&nombreServicio=$nombreServicio&descripcionServicio=$descripcionServicio&montoServicio=$montoServicio");
        }
    } else {
        header("location: ../view/listarServicios.php?error=error&nombreServicio=$nombreServicio&descripcionServicio=$descripcionServicio&montoServicio=$montoServicio");
    }
}


if (isset($_POST['eliminar'])) {
    $facturaBusiness = new FacturaBusiness();
    $facturas = $facturaBusiness->obtener();
    $flag = 0;
    foreach ($facturas as $row) {  $array = explode(";", $row->getServiciosTBFactura());
       
    foreach ($array as $selected) {  if(  $_POST['idServicio'] == $selected  && $row->getActivoTBFactura() == 1 ){  $flag = 1; } }
        
}

    if($flag == 0){

    if (isset($_POST['idServicio'])) {

        $id = $_POST['idServicio'];
        $servicioBusiness = new servicioBusiness();
        $result = $servicioBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarServicios.php?success=deleted");
        } else {
            header("Location: ../view/listarServicios.php?error=dbError");
        }
    } else {
        header("location: ../view/listarServicios.php?error=error");
    }

} else {
    header("location: ../view/listarServicios.php?error=relationError");
}

}

if (isset($_POST['actualizar'])) {
    if (isset($_POST['idServicio']) && isset($_POST['nombreServicio']) && isset($_POST['descripcionServicio']) && isset($_POST['montoServicio'])) {

            $anteriorMontoServicio = $_POST['anteriorMontoServicio'];
            $id = $_POST['idServicio'];
            $nombreServicio = $_POST['nombreServicio'];
            $descripcionServicio = $_POST['descripcionServicio'];
            $montoServicio = $_POST["montoServicio"];

            if (strlen($nombreServicio) > 0 && strlen($descripcionServicio) > 0 && strlen($montoServicio) > 0) {
                $tempMonto = str_replace("₡","",$montoServicio);

                //if (is_numeric($montoServicio)) {
                    $servicio = new Servicio($id, $nombreServicio, $descripcionServicio, $tempMonto, 1);
                    $servicioBusiness = new servicioBusiness();
                    $result = $servicioBusiness->update($servicio, $anteriorMontoServicio);

                    if ($result == 1) {
                        header("location: ../view/listarServicios.php?success=updated");
                    } else {
                        header("location: ../view/listarServicios.php?error=dbError");
                    }
                /*} else {
                    header("location: ../view/listarServicios.php?error=numberFormat");
                }*/
            } else {
                header("location: ../view/listarServicios.php?error=emptyField");
            }
            
    } else {
        header("location: ../view/listarServicios.php?error=error");
    }
}