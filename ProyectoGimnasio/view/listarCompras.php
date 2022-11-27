<?php
include '../business/compraBusiness.php';
include '../business/compraDetalleBusiness.php';
include '../business/productoBusiness.php';

include '../business/proveedorBusiness.php';

?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Compras</title>
    <script type="text/javascript">
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar esta compra?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar esta compra?");
        }
    </script>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h1>Compras</h1>
    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaCompras"></ul>
        </div>
    </form></br></br>
    <script src="../js/peticiones.js"></script>
    <script type="text/javascript" src="../js/jquery_formato.js"></script>    

    <div>

        <?php
        if (!isset($_POST['campo'])) {
            $_POST['campo'] = "";
            $campo = $_POST['campo'];
        }
        $campo = $_POST['campo'];

      
        $compraBusiness = new CompraBusiness();
        $compras = $compraBusiness->buscar($campo);

        $compraDetalleBusiness = new CompraDetalleBusiness();
        $comprasDetalle = $compraDetalleBusiness->buscar($campo);
       
     
        
        // $compraBusiness = new CompraBusiness();
        // $compras = $compraBusiness->buscar($campo);

        // $compraDetalleBusiness = new CompraDetalleBusiness();
        // $comprasDetalle = $compraDetalleBusiness->buscar($campo);

        
     

        if (!empty($compras) && !empty($comprasDetalle)) {
            
        ?>
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>ID</th>
                        <th>Fecha de Compra</th>
                        <th>Proveedor</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Modo de pago</th>
                        <th>Precio bruto producto(C/U)</th>
                        <th>Monto neto</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($compras as $row) {
                        
                      

                        if ($row->getActivo() == 1) {
                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/compraAction.php">';
                            echo '<tr>';
                            echo '<input  type="hidden" name="idCompra" id="id" value="' . $row->getIdCompra() . '"/>';
                            echo '<td>' . $row->getIdCompra() . '</td>';
                    ?>

                            <?php echo '<td><input type="date" name="fechaPago"  id="fechaPago" value="' . $row->getFechaCompra() . '"readonly /></td>'; ?>

                            <td>
                                <?php
                                $proveedorBusiness = new ProveedorBusiness();
                                $proveedores = $proveedorBusiness->obtener();
                                foreach ($proveedores as $row1) {
                                    if ($row1->getActivoTBProveedor() == 1) {
                                        if ($row1->getIdTBProveedor() == $row->getProveedorId()) {
                                            echo  '<input type="text" value="' .  $row1->getNombreCompletoTBProveedor() .  '"readonly />';
                                            
                                        }
                                    }
                                } ?>
                            </td>




                           <td>
                            <?php
                            $productoBusiness = new ProductoBusiness();
                            $productos = $productoBusiness->obtener();
                            

                            foreach ($comprasDetalle as $row2) {
                                foreach ($productos as $row1) {
                                    if ($row1->getActivoTBProducto() == 1) {
                                        if ($row1->getIdTBProducto() == $row2->getIdProducto()) {
                                            if ($row->getIdCompra() == $row2->getIdCompra()) {
                                                
                                                echo  '<input type="text" value="' .  $row1->getNombreTBProducto() .  '"readonly />';
                                            }
                                        }
                                    }
                                }
                            }
                            ?>

                           </td>

                           <td>
                            <?php
                            $productoBusiness = new ProductoBusiness();
                            $productos = $productoBusiness->obtener();

                            foreach ($comprasDetalle as $row2) {
                                foreach ($productos as $row1) {

                                    if ($row1->getActivoTBProducto() == 1) {
                                        if ($row1->getIdTBProducto() == $row2->getIdProducto()) {
                                            if ($row->getIdCompra() == $row2->getIdCompra()) {
                                                
                                                echo  '<input type="text" value="' .  $row2->getCantidadProducto() .  '"readonly />';
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                           </td>


                            <td>
                                <?php
                                foreach ($comprasDetalle as $row2) {
                                    if ($row->getIdCompra() == $row2->getIdCompra()) {
                                        if ($row->getModoPagoCompra() == 1) {

                                            echo  '<input type="text" value="' .  "Credito" .  '"readonly />';
                                        } else {
                                            echo  '<input type="text" value="' .  "Contado" .  '"readonly />';
                                        }
                                    }
                                }
                                ?>
                            </td>

                            <?php foreach ($comprasDetalle as $row2) {
                                if ($row->getIdCompra() == $row2->getIdCompra()) {
                                    echo '<td><input type="text" name="montoBruto" id="montoBruto" value="₡ ' . $row2->getPrecioBrutoProducto() .  '"readonly /></td>';
                                }
                            }
                            ?>

                            <?php echo '<td><input type="text" name="montoNeto" id="montoNeto" value="₡ ' . $row->getMontoNetoCompra() .  '"readonly /></td>'; ?>



                    <?php

                            echo '<td><input type="submit" name="anular" id="anular" value="anular" onclick="return confirmarAccionEliminar()"/></td>';
                            echo '</tr>';
                            echo '</form>';
                        }
                    }
                    
                
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron compras!</p>';
        }
        ?>
    </div>

    <div>
        <h3>Crear nueva compra</h3>

        <script src="../js/jquery_formato.js"></script>
        <form name="formulario" method="POST" id="direccionform" action="../business/compraAction.php">
            <table border="1">
                <thead style="text-align: left;">
                    <tr>

                        <th>Fecha de Compra</th>
                        <th>Proveedor</th>
                        <th>Modo de pago</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio bruto producto(C/U)</th>
                        <th>Monto neto</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>




                        <td><input type="date" id="fechaCompra" name="fechaCompra" value="<?php if (isset($_GET['fechaCompra'])) {
                                                                                                echo $_GET['fechaCompra'];
                                                                                            } ?>" required>




                        <td>
                            <?php
                            $proveedorBusiness = new ProveedorBusiness();
                            $proveedores = $proveedorBusiness->obtener();
                            ?>
                            <select name="proveedorid" id="proveedorid" required>
                                <?php
                                if (isset($_GET['proveedorid']) && strlen($_GET['proveedorid']) > 0) {
                                    foreach ($proveedores as $row) :
                                        if ($row->getActivoTBProveedor() == 1) {

                                            if ($_GET['proveedorid'] == $row->getIdTBProveedor()) {
                                                echo '<option value="' . $row->getIdTBProveedor() . '">' . $row->getNombreCompletoTBProveedor() . '</option>';
                                            }
                                        }

                                    endforeach;
                                } else { ?>
                                    <option value="">Proveedores</option>
                                <?php }

                                foreach ($proveedores as $row) :
                                    if ($row->getActivoTBProveedor() == 1) {
                                        if ($_GET['proveedorid'] != $row->getIdTBProveedor()) {
                                            echo '<option value="' . $row->getIdTBProveedor() . '">' . $row->getNombreCompletoTBProveedor() . '</option>';
                                        }
                                    }
                                endforeach;
                                ?>
                            </select>
                        </td>


                        <td>

                            <select name="modoPagoCompra" id="modoPagoCompra" required>
                                <?php
                                if (isset($_GET['modoPagoCompra'])) {
                                    if ($_GET['modoPagoCompra'] == 0) {
                                        echo '<option value="' . $_GET['modoPagoCompra'] . '">' . "Contado" . '</option>';
                                    } else {
                                        echo '<option value="' . $_GET['modoPagoCompra'] . '">' . "Credito" . '</option>';
                                    }
                                    // echo '<option value="' . 0 . '" >' . "Contado" . '</option>';
                                    // echo '<option value="' . 1 . '" >' . "credito" . '</option>';
                                } else { ?>
                                    <option value="" required>Modo de pago</option>
                                <?php

                                    echo '<option value="' . 0 . '" >' . "Contado" . '</option>';
                                    echo '<option value="' . 1 . '" >' . "Credito" . '</option>';
                                }

                                ?>
                            </select>

                        </td>

                        <td>
                            <?php
                            $productoBusiness = new ProductoBusiness();
                            $productos = $productoBusiness->obtener();
                            ?>
                            <select name="idProducto" id="idProducto" required>
                                <?php
                                if (isset($_GET['idProducto']) && strlen($_GET['idProducto']) > 0) {
                                    foreach ($productos as $row) :
                                        if ($row->getActivoTBProducto() == 1) {

                                            if ($_GET['idProducto'] == $row->getIdTBProducto()) {
                                                echo '<option value="' . $row->getIdTBProducto() . '">' . $row->getNombreTBProducto() . '</option>';
                                            }
                                        }

                                    endforeach;
                                } else { ?>
                                    <option value="">Productos</option>
                                <?php }

                                foreach ($productos as $row) :
                                    if ($row->getActivoTBProducto() == 1) {
                                        if ($_GET['idProducto'] != $row->getIdTBProducto()) {
                                            echo '<option value="' . $row->getIdTBProducto() . '">' . $row->getNombreTBProducto() . '</option>';
                                        }
                                    }
                                endforeach;
                                ?>
                            </select>
                        </td>





                        <td><input type="number" min="0" max="15" name="cantidadProducto" value="<?php if (isset($_GET['cantidadProducto'])) {
                                                                                    echo $_GET['cantidadProducto'];
                                                                                } ?>"required>

                            <input class="button" type="submit" name="calcularProductos" id="calcularProductos" onclick="res()" value="Calcular">

                        </td>


                        <td><input type="text"  name="precioBrutoProducto" value="<?php if (isset($_GET['precioBrutoProducto'])) {
                                                                                                            echo "₡" . $_GET['precioBrutoProducto'];
                                                                                                        } ?>"readonly></td>
                        <td><input type="text"  name="montoNeto" value="<?php if (isset($_GET['montoNeto'])) {
                                                                                                echo "₡" . $_GET['montoNeto'];
                                                                                            } ?>"readonly></td>



                        <td><button type="submit" name="insertarCompra" id="insertarCompra" value="insertarCompra">Registrar compra</button></td>
                    </tr>
                </tbody>
            </table>

            <script>
                function res() {
                    //  var m1 = document.getElementsByName("cantidadProducto").value;
                    //var multi = m1 + m1 ;
                    document.getElementsByName("montoNeto").innerHTML = "hola";

                }
            </script>

        </form>

    </div>

    <script>
        var todayDateMax = new Date();
        var mesMax = todayDateMax.getMonth() + 1;
        var anioMax = todayDateMax.getUTCFullYear();
        var diaMax = todayDateMax.getDate();
        if (mesMax < 10) {
            mesMax = "0" + mesMax
        }
        if (diaMax < 10) {
            diaMax = "0" + diaMax;
        }
        var maxDate = anioMax + "-" + mesMax + "-" + diaMax;
        document.getElementById("fechaCompra").setAttribute("max", maxDate);
    </script>


    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/compraAction.php">
            <tr>
                <td>
                    <?php
                    if (isset($_GET['error'])) {

                        if ($_GET['error'] == "error") {
                            echo '<center><p style="color: red">Error en formato de compra</p></center>';
                        } else if ($_GET['error'] == "emptyField") {
                            echo '<center><p style="color: red">Campo(s) vacio(s)</p></center>';
                        } else if ($_GET['error'] == "numberFormat") {
                            echo '<center><p style="color: red">Error, formato de numero!</p></center>';
                        } /*else if ($_GET['error'] == "dbError") {
                            echo '<center><p style="color: red">Error al procesar la transacción!</p></center>';
                        } */
                    } else if (isset($_GET['success'])) {
                        echo '<center><p style="color: green">Transacción realizada!</p></center>';
                    }
                    ?>
                </td>
            </tr>
        </form>
    </div>
    <script src="../js/jquery_formato.js"></script>
</body>

</html>