<?php
include 'productoBusiness.php';


if (isset($_POST['insertar'])) {
    if (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['preciocompra']) &&
        isset($_POST['precioventa']) && isset($_POST['cantidad'])) {

        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $preciocompra = $_POST['preciocompra'];
        $precioventa = $_POST['precioventa'];
        $cantidad = $_POST['cantidad'];
  

        if (strlen($nombre) > 0 && strlen($descripcion) > 0 && strlen($preciocompra) > 0 && strlen($precioventa) > 0 && strlen($cantidad) > 0 ) {

       
            if (!is_numeric($nombre) && !is_numeric($descripcion) && is_numeric($preciocompra) && is_numeric($precioventa) && is_numeric($cantidad)) {
              
                    $producto = new Producto(0, $nombre, $descripcion, $preciocompra, $precioventa, $cantidad, 1);
                    $productoBusiness = new ProductoBusiness();
                    $resultado = $productoBusiness->insertar($producto);

                    if ($resultado == 1) {
                        Header("Location: ../view/listarProducto.php?success=inserted");
                    } else {
                        Header("Location: ../view/listarProducto.php?error=dbError&nombre=$nombre&descripcion=$descripcion&preciocompra=$preciocompra&precioventa=$precioventa&cantidad=$cantidad");
                    }
               
            } else {
                header("location: ../view/listarProducto.php?error=numberFormat&nombre=$nombre&descripcion=$descripcion&preciocompra=$preciocompra&precioventa=$precioventa&cantidad=$cantidad");
            }
        } else {
            header("location: ../view/listarProducto.php?error=emptyField&nombre=$nombre&descripcion=$descripcion&preciocompra=$preciocompra&precioventa=$precioventa&cantidad=$cantidad");
        }
    } else {
        header("location: ../view/listarProducto.php?error=error&nombre=$nombre&descripcion=$descripcion&preciocompra=$preciocompra&precioventa=$precioventa&cantidad=$cantidad");
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

    if (isset($_POST['idproducto']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['preciocompra']) &&
    isset($_POST['precioventa']) && isset($_POST['cantidad'])) {

        $id = $_POST['idproducto'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $preciocompra = $_POST['preciocompra'];
        $precioventa = $_POST['precioventa'];
        $cantidad = $_POST['cantidad'];

        if (strlen($nombre) > 0 && strlen($descripcion) > 0 && strlen($preciocompra) > 0 && strlen($precioventa) > 0
            && strlen($cantidad) > 0 ) {
        
            if (!is_numeric($nombre) && !is_numeric($apellido)) {
               
                    $producto = new Producto($id, $nombre, $descripcion, $preciocompra, $precioventa, $cantidad, 1);
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