<?php
include 'productoBusiness.php';


if (isset($_POST['insertar'])) {
    if (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['lineaproductoid']) && isset($_POST['preciocompra']) &&
        isset($_POST['precioventa']) && isset($_POST['cantidad'])) {

        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $lineaproductoid = $_POST['lineaproductoid'];
        $preciocompra = $_POST['preciocompra'];
        $precioventa = $_POST['precioventa'];
        $cantidad = $_POST['cantidad'];
  

        if (strlen($nombre) > 0 && strlen($descripcion) > 0 && strlen($lineaproductoid) > 0 && strlen($preciocompra) > 0 && strlen($precioventa) > 0 && strlen($cantidad) > 0 ) {

            $tempPreciocompra = str_replace("₡","",$preciocompra);
            $tempPrecioventa = str_replace("₡","",$precioventa);

            $productoBusiness = new ProductoBusiness();
            $elementos = $productoBusiness->obtener();
            $flag = 0;
            foreach ($elementos as $row) { if($row->getNombreTBProducto() == $_POST['nombre'] && $row->getActivoTBProducto() == 1 && $row->getDescripcionTBProducto() == $_POST['descripcion'] ){  $flag = 1; } }
                
    if($flag == 0){
       
            if (!is_numeric($nombre) && !is_numeric($descripcion) && is_numeric($tempPreciocompra) && is_numeric($tempPrecioventa) && is_numeric($cantidad)) {
              
                    $producto = new Producto(0, $nombre, $descripcion, $lineaproductoid, $tempPreciocompra, $tempPrecioventa, $cantidad, 1);
                    $productoBusiness = new ProductoBusiness();
                    $resultado = $productoBusiness->insertar($producto);

                    if ($resultado == 1) {
                        Header("Location: ../view/listarProducto.php?success=inserted");
                    } else {
                        Header("Location: ../view/listarProducto.php?error=dbError&nombre=$nombre&descripcion=$descripcion&lineaproductoid=$lineaproductoid&preciocompra=$tempPreciocompra&precioventa=$tempPrecioventa&cantidad=$cantidad");
                    }
               
            } else {
                header("location: ../view/listarProducto.php?error=numberFormat&nombre=$nombre&descripcion=$descripcion&lineaproductoid=$lineaproductoid&preciocompra=$tempPreciocompra&precioventa=$tempPrecioventa&cantidad=$cantidad");
            }

        } else {
            header("location: ../view/listarProducto.php?error=duplicate&nombre=$nombre&descripcion=$descripcion&lineaproductoid=$lineaproductoid&preciocompra=$tempPreciocompra&precioventa=$tempPrecioventa&cantidad=$cantidad");
        }
        } else {
            header("location: ../view/listarProducto.php?error=emptyField&nombre=$nombre&descripcion=$descripcion&lineaproductoid=$lineaproductoid&preciocompra=$preciocompra&precioventa=$precioventa&cantidad=$cantidad");
        }
    } else {
        header("location: ../view/listarProducto.php?error=error&nombre=$nombre&descripcion=$descripcion&lineaproductoid=$lineaproductoid&preciocompra=$tempPreciocompra&precioventa=$tempPrecioventa&cantidad=$cantidad");
    }
}


if (isset($_POST['eliminar'])) {


    if (isset($_POST['idproducto'])) {
        $id = $_POST['idproducto'];

        $productoBusiness = new ProductoBusiness();
        $result = $productoBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarProducto.php?success=deleted");
        } else {
            header("Location: ../view/listarProducto.php?error=dbError");
        }
    } else {
        header("location: ../view/listarProducto.php?error=error");
    }

}


if (isset($_POST['actualizar'])) {

    if (isset($_POST['idproducto']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['lineaproductoid']) && isset($_POST['preciocompra']) &&
    isset($_POST['precioventa']) && isset($_POST['cantidad'])) {

        $id = $_POST['idproducto'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $lineaproductoid = $_POST['lineaproductoid'];
        $preciocompra = $_POST['preciocompra'];
        $precioventa = $_POST['precioventa'];
        $cantidad = $_POST['cantidad'];

        if (strlen($nombre) > 0 && strlen($descripcion) > 0 && strlen($lineaproductoid)  > 0 && strlen($preciocompra) > 0 && strlen($precioventa) > 0
            && strlen($cantidad) > 0 ) {

                $tempPreciocompra = str_replace("₡","",$preciocompra);
                $tempPrecioventa = str_replace("₡","",$precioventa);

              
        
            if (!is_numeric($nombre) && !is_numeric($descripcion)) {
               
                    $producto = new Producto($id, $nombre, $descripcion,$lineaproductoid, $tempPreciocompra, $tempPrecioventa, $cantidad, 1);
                    $productoBusiness = new ProductoBusiness();
                    $resultado = $productoBusiness->update($producto);

                    if ($resultado == 1) {
                        Header("Location: ../view/listarProducto.php?success=update");
                    } else {
                        Header("Location: ../view/listarProducto.php?error=dbError");
                    }
               
            } else {
                header("location: ../view/listarProducto.php?error=numberFormat");
            }

        } else {
            header("location: ../view/listarProducto.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarProducto.php?error=error");
    }
}
