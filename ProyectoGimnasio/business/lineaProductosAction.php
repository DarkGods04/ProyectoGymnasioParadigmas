
<?php
include 'lineaProductosBusiness.php';
include 'proveedorBusiness.php';

if (isset($_POST['actualizar'])) {
    if (isset($_POST['idLineaProductos']) && isset($_POST['nombreLineaProductos']) && isset($_POST['descripcionLineaProductos'])) {

        $id = $_POST['idLineaProductos'];
        $nombre = $_POST['nombreLineaProductos'];
        $descripcion = $_POST['descripcionLineaProductos'];

        if (strlen($nombre) > 0 && strlen($descripcion) > 0) {

            $lineaProductosBusiness = new LineaProductosBusiness();
            $elementos = $lineaProductosBusiness->obtener();
            $flag = 0;
            foreach ($elementos as $row) { if($row->getNombreTBCatalogoLineaProductos() == $_POST['nombreLineaProductos'] && $row->getActivoTBCatalogoLineaProductos() == 1 && $row->getDescripcionTBCatalogoLineaProductos() == $_POST['descripcionLineaProductos']  ){  $flag = 1; } }
                
    if($flag == 0){

            if (!is_numeric($nombre)) {
                $lineaProductos = new LineaProductos($id, $nombre, $descripcion, 1);
                $lineaProductosBusiness = new LineaProductosBusiness();
                $result = $lineaProductosBusiness->update($lineaProductos);

                if ($result == 1) {
                    header("location: ../view/listarLineasProductos.php?success=updated");
                } else {
                    header("location: ../view/listarLineasProductos.php?error=dbError");
                }
            } else {
                header("location: ../view/listarLineasProductos.php?error=numberFormat");
            }

        } else {
            header("location: ../view/listarLineasProductos.php?error=duplicate");
        }
        } else {
            header("location: ../view/listarLineasProductos.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarLineasProductos.php?error=error");
    }
}


if (isset($_POST['eliminar'])) {

    $proveedorBusiness = new ProveedorBusiness();
    $proveedor = $proveedorBusiness->obtener();
    $flag = 0;
    foreach ($proveedor as $row) { if($row->getIdLineaProductosTBCatalogoLineaProductos() == $_POST['idLineaProductos'] && $row->getActivoTBProveedor() == 1 ){  $flag = 1; } }
        
    if($flag == 0){

        if (isset($_POST['idLineaProductos'])) {

            $id = $_POST['idLineaProductos'];
            $lineaProductosBusiness = new LineaProductosBusiness();
            $result = $lineaProductosBusiness->delete($id);

            if ($result == 1) {
                header("location: ../view/listarLineasProductos.php?success=deleted");
            } else {
                header("location: ../view/listarLineasProductos.php?error=dbError");
            }
        } else {
            header("location: ../view/listarLineasProductos.php?error=error");
        }

    } else {
        header("location: ../view/listarLineasProductos.php?error=relationError");
    }
}

if (isset($_POST['insertar'])) {
    if (isset($_POST['nombreLineaProductos']) && isset($_POST['descripcionLineaProductos'])) {
        $existe = false;
        $nombre = $_POST['nombreLineaProductos'];
        $descripcion = $_POST['descripcionLineaProductos'];


        if (strlen($nombre) > 0 && strlen($descripcion) > 0) {

            $lineaProductosBusiness = new LineaProductosBusiness();
            $elementos = $lineaProductosBusiness->obtener();
            $flag = 0;
            foreach ($elementos as $row) { if($row->getNombreTBCatalogoLineaProductos() == $_POST['nombreLineaProductos'] && $row->getActivoTBGrupoMuscular() == 1 && $row->getDescripcionTBCatalogoLineaProductos() == $_POST['descripcionLineaProductos']  ){  $flag = 1; } }
                
    if($flag == 0){
            
            if (!is_numeric($nombre)) {

               
                    $lineaProductos = new LineaProductos(0, $nombre, $descripcion, 1);
                    $lineaProductosBusiness = new LineaProductosBusiness();
                    $result = $lineaProductosBusiness->insertar($lineaProductos);

                    if ($result == 1) {
                        header("location: ../view/listarLineasProductos.php?success=inserted");
                    } else {
                        header("location: ../view/listarLineasProductos.php?error=dbError&nombreLineaProductos=$nombre&descripcionLineaProductos=$descripcion");
                    }
                    
            } else {
                header("location: ../view/listarLineasProductos.php?error=numberFormat&nombreLineaProductos=$nombre&descripcionLineaProductos=$descripcion");
            }

        } else {
            header("location: ../view/listarLineasProductos.php?error=duplicate&nombreLineaProductos=$nombre&descripcionLineaProductos=$descripcion");
        }
        } else {
            header("location: ../view/listarLineasProductos.php?error=emptyField&nombreLineaProductos=$nombre&descripcionLineaProductos=$descripcion");
        }
    } else {
        header("location: ../view/listarLineasProductos.php?error=error&nombreLineaProductos=$nombre&descripcionLineaProductos=$descripcion");
    }
}
