<?php
include 'proveedorBusiness.php';

if (isset($_POST['insertar'])) {
    if (isset($_POST['nombreProveedor']) && isset($_POST['casaComercialProveedor']) && isset($_POST['idLineaProductos'])) {

        $nombre = $_POST['nombreProveedor'];
        $casaComercial = $_POST['casaComercialProveedor'];
        $idLineaProductos = $_POST['idLineaProductos'];

        if (strlen($nombre) > 0 && strlen($casaComercial) > 0 && strlen($idLineaProductos) > 0) {

            if (!is_numeric($nombre) && is_numeric($idLineaProductos)) {
                $proveedor = new Proveedor(0, $nombre, $casaComercial, $idLineaProductos,1);
                $proveedorBusiness = new ProveedorBusiness();
                $resultado = $proveedorBusiness->insertar($proveedor);

                if ($resultado == 1) {
                    Header("Location: ../view/listarProveedores.php?success=inserted");
                } else {
                    Header("Location: ../view/listarProveedores.php?error=dbError&nombreProveedor=$nombre&casaComercialProveedor=$casaComercial&idLineaProductos=$idLineaProductos");
                }
            } else {
                header("location: ../view/listarProveedores.php?error=numberFormat&nombreProveedor=$nombre&casaComercialProveedor=$casaComercial&idLineaProductos=$idLineaProductos");
            }
        } else {
            header("location: ../view/listarProveedores.php?error=emptyField&nombreProveedor=$nombre&casaComercialProveedor=$casaComercial&idLineaProductos=$idLineaProductos");
        }
    } else {
        header("location: ../view/listarProveedores.php?error=error&nombreProveedor=$nombre&casaComercialProveedor=$casaComercial&idLineaProductos=$idLineaProductos");
    }
}


if (isset($_POST['eliminar'])) {
    if (isset($_POST['idProveedor'])) {

        $id = $_POST['idProveedor'];
        $proveedorBusiness = new ProveedorBusiness();
        $result = $proveedorBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarProveedores.php?success=deleted");
        } else {
            header("Location: ../view/listarProveedores.php?error=dbError");
        }
    } else {
        header("location: ../view/listarProveedores.php?error=error");
    }
}


if (isset($_POST['actualizar'])) {
    if (isset($_POST['nombreProveedor']) && isset($_POST['casaComercialProveedor']) && isset($_POST['idLineaProductos'])) {

        $id = $_POST['idProveedor'];
        $nombre = $_POST['nombreProveedor'];
        $casaComercial = $_POST['casaComercialProveedor'];
        $idLineaProductos = $_POST['idLineaProductos'];
      
        if (strlen($nombre) > 0 && strlen($casaComercial) > 0 && strlen($idLineaProductos) > 0) {

            if (!is_numeric($nombre) && is_numeric($idLineaProductos)) {

                $proveedor = new Proveedor($id,$nombre, $casaComercial, $idLineaProductos, 1);
                $proveedorBusiness = new ProveedorBusiness();
                $resultado = $proveedorBusiness->update($proveedor);

                if ($resultado == 1) {
                    Header("Location: ../view/listarProveedores.php?success=update");
                } else {

                    Header("Location: ../view/listarProveedores.php?error=dbError");
                }
            } else {
                header("location: ../view/listarProveedores.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarProveedores.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarProveedores.php?error=error");
    }
}
