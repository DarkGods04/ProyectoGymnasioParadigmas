
<?php
include 'pagoPeridiocidadBusiness.php';
include 'facturaBusiness.php';

if (isset($_POST['actualizar'])) {
    if (isset($_POST['idPagoPeridiocidad']) && isset($_POST['nombrePagoPeridiocidad']) && isset($_POST['descripcionPagoPeridiocidad'])) {

        $id = $_POST['idPagoPeridiocidad'];
        $nombre = $_POST['nombrePagoPeridiocidad'];
        $descripcion = $_POST['descripcionPagoPeridiocidad'];

        if (strlen($nombre) > 0 && strlen($descripcion) > 0) {

            if (!is_numeric($nombre)) {
                $pagoPeridiocidad = new PagoPeridiocidad($id, $nombre, $descripcion, 1);
                $pagoPeridiocidadBusiness = new PagoPeridiocidadBusiness();
                $result = $pagoPeridiocidadBusiness->update($pagoPeridiocidad);

                if ($result == 1) {
                    header("location: ../view/listarPagoPeridiocidades.php?success=updated");
                } else {
                    header("location: ../view/listarPagoPeridiocidades.php?error=dbError");
                }
            } else {
                header("location: ../view/listarPagoPeridiocidades.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarPagoPeridiocidades.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarPagoPeridiocidades.php?error=error");
    }
}


if (isset($_POST['eliminar'])) {

    $facturaBusiness = new FacturaBusiness();
    $facturas = $facturaBusiness->obtener();
    $flag = 0;
    foreach ($facturas as $row) { if($row->getPagoModalidadTBFactura() == $_POST['idPagoPeridiocidad'] && $row->getActivoTBFactura() == 1 ){  $flag = 1; } }
        
    if($flag == 0){

    if (isset($_POST['idPagoPeridiocidad'])) {

        $id = $_POST['idPagoPeridiocidad'];
        $pagoPeridiocidadBusiness = new PagoPeridiocidadBusiness();
        $result = $pagoPeridiocidadBusiness->delete($id);

        if ($result == 1) {
            header("location: ../view/listarPagoPeridiocidades.php?success=deleted");
        } else {
            header("location: ../view/listarPagoPeridiocidades.php?error=dbError");
        }
    } else {
        header("location: ../view/listarPagoPeridiocidades.php?error=error");
    }

    } else {
    header("location: ../view/listarPagoPeridiocidades.php?error=relationError");
    }
}

if (isset($_POST['insertar'])) {
    if (isset($_POST['nombrePagoPeridiocidad']) && isset($_POST['descripcionPagoPeridiocidad'])) {
        $existe = false;
        $nombre = $_POST['nombrePagoPeridiocidad'];
        $descripcion = $_POST['descripcionPagoPeridiocidad'];
        $pagoPeridiocidadBusiness = new PagoPeridiocidadBusiness();
        $pagoPeridiocidades = $pagoPeridiocidadBusiness->obtener();
        foreach ($pagoPeridiocidades as $row) {
            if ($row->getNombreTBPagoPeridiocidad() == $nombre) {
                $existe = true;
            }
        }

        if (strlen($nombre) > 0 && strlen($descripcion) > 0) {
            
            if (!is_numeric($nombre)) {
                if ($existe == false) {
                    $pagoPeridiocidad = new PagoPeridiocidad(0, $nombre, $descripcion, 1);
                    $pagoPeridiocidadBusiness = new PagoPeridiocidadBusiness();
                    $result = $pagoPeridiocidadBusiness->insertar($pagoPeridiocidad);

                    if ($result == 1) {
                        header("location: ../view/listarPagoPeridiocidades.php?success=inserted");
                    } else {
                        header("location: ../view/listarPagoPeridiocidades.php?error=dbError&nombrePagoPeridiocidad=$nombre&descripcionPagoPeridiocidad=$descripcion");
                    }
                } else {
                    header("location: ../view/listarPagoPeridiocidades.php?error=existe&nombrePagoPeridiocidad=$nombre&descripcionPagoPeridiocidad=$descripcion");
                }
            } else {
                header("location: ../view/listarPagoPeridiocidades.php?error=numberFormat&nombrePagoPeridiocidad=$nombre&descripcionPagoPeridiocidad=$descripcion");
            }
        } else {
            header("location: ../view/listarPagoPeridiocidades.php?error=emptyField&nombrePagoPeridiocidad=$nombre&descripcionPagoPeridiocidad=$descripcion");
        }
    } else {
        header("location: ../view/listarPagoPeridiocidades.php?error=error&nombrePagoPeridiocidad=$nombre&descripcionPagoPeridiocidad=$descripcion");
    }
}
