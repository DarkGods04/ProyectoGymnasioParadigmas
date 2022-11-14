<?php
include 'servicioBusiness.php';
include 'facturaBusiness.php';

if (isset($_POST["insertar"])) {
    if (isset($_POST["nombreServicio"]) && isset($_POST["descripcionServicio"]) && isset($_POST["montoServicio"]) && isset($_POST["periodicidad"])) {

        $nombreServicio = $_POST["nombreServicio"];
        $descripcionServicio = $_POST["descripcionServicio"];
        $montoServicio = $_POST["montoServicio"];
        $periodicidad =  $_POST["periodicidad"];
        $fechaActualizacionProxima=new DateTime(date('Y-m-d'));
        $fechaActualizacionProxima->modify('+'."$periodicidad".' day');
        $fechaActualizacionProxima = $fechaActualizacionProxima->format('Y-m-d');

        if (strlen($nombreServicio) > 0 && strlen($descripcionServicio) > 0 && strlen($montoServicio) > 0 ) {
            $tempMonto = str_replace("₡","",$montoServicio);

            $servicioBusiness = new servicioBusiness();
            $elementos = $servicioBusiness->obtener();
            $flag = 0;
            foreach ($elementos as $row) { if($row->getNombreTBServicio() == $_POST['nombreServicio'] && $row->getActivoTBServicio() == 1 && $row->getDescripcionTBServicio() == $_POST['descripcionServicio'] ){  $flag = 1; } }
                
    if($flag == 0){

            if (is_numeric($periodicidad)) {
                $servicio = new Servicio(0, $nombreServicio, $descripcionServicio, $tempMonto, 1,$periodicidad,$fechaActualizacionProxima);
                $servicioBusiness = new servicioBusiness();
                $result = $servicioBusiness->insertar($servicio);

                if ($result == 1) {
                    header("location: ../view/listarServicios.php?success=updated");
                } else {
                    header("location: ../view/listarServicios.php?error=dbError&nombreServicio=$nombreServicio&descripcionServicio=$descripcionServicio&montoServicio=$montoServicio");
                }
            } else {
                header("location: ../view/listarServicios.php?error=numberFormat");
            }

        } else {
            header("location: ../view/listarServicios.php?error=duplicate");
        }
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
            $id = $_POST['idServicio'];
            $nombreServicio = $_POST['nombreServicio'];
            $descripcionServicio = $_POST['descripcionServicio'];
            $montoServicio = $_POST["montoServicio"];
            $periodicidad = $_POST["periodicidad"];
            $fechaActualizacionProxima=new DateTime(date('Y-m-d'));
            $fechaActualizacionProxima->modify('+'."$periodicidad".' day');
            $fechaActualizacionProxima = $fechaActualizacionProxima->format('Y-m-d');

            if ($periodicidad > 0 && strlen($fechaActualizacionProxima) > 0 && strlen($nombreServicio) > 0 && strlen($descripcionServicio) > 0 && strlen($montoServicio) > 0) {
                $tempMonto = str_replace("₡","",$montoServicio);

                $servicioBusiness = new servicioBusiness();
                $elementos = $servicioBusiness->obtener();
                $flag = 0;
                foreach ($elementos as $row) { if($row->getNombreTBServicio() == $_POST['nombreServicio'] && $row->getActivoTBServicio() == 1 && $row->getDescripcionTBServicio() == $_POST['descripcionServicio'] ){  $flag = 1; } }
                    
        if($flag == 0){

                //if (is_numeric($montoServicio)) {
                    $servicio = new Servicio($id, $nombreServicio, $descripcionServicio, $tempMonto, 1,$periodicidad,$fechaActualizacionProxima);
                    $servicioBusiness = new servicioBusiness();
                    $result = $servicioBusiness->update($servicio);

                    if ($result == 1) {
                        header("location: ../view/listarServicios.php?success=updated");
                    } else {
                        header("location: ../view/listarServicios.php?error=dbError");
                    }
                /*} else {
                    header("location: ../view/listarServicios.php?error=numberFormat");
                }*/

                 } else {
                    header("location: ../view/listarServicios.php?error=duplicate");
                }
            } else {
                header("location: ../view/listarServicios.php?error=emptyField");
            }
            
    } else {
        header("location: ../view/listarServicios.php?error=error");
    }
}