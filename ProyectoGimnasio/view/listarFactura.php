<?php
include '../business/facturaBusiness.php';
include '../business/clienteBusiness.php';
include '../business/instructorBusiness.php';
include '../business/impuestoVentaBusiness.php';
include '../business/pagoPeridiocidadBusiness.php';
include '../business/servicioBusiness.php';
include '../business/pagoMetodoBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Factura</title>

    <?php
    include 'header.php';
    ?>

    <h2>Crear nueva factura</h2>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="../js/jquery_formato.js"></script>
</head>

<body>

    <div>

        <h3>Selcciones los Servicios</h3>

        <form name="formulario" method="POST" id="direccionform" action="../business/facturaAction.php">
            <?php
            $servicioBusiness = new ServicioBusiness();
            $servicios = $servicioBusiness->obtener();
            ?>


            <select id="serviciosMult" name="serviciosMult" method="POST">

                <option value="">Servicios</option>
                <?php
                if (isset($_GET['idServicio'])) {
                    $array = unserialize($_GET['idServicio']);
                    foreach ($servicios as $row) {
                        $flag = false;
                        foreach ($array as $selected) {
                            if ($row->getIdTBServicio() == $selected) {
                                $flag = true;
                            }
                        }
                        if ($flag == false) {
                            echo '<option  value="' . $row->getIdTBServicio() . '">' . $row->getNombreTBServicio() . " : " . $row->getDescripcionTBServicio() . ' </option>';
                        }
                    }
                } else {
                    foreach ($servicios as $row) {
                        echo '<option value="' . $row->getIdTBServicio() . '">' . $row->getNombreTBServicio() . " : " . $row->getDescripcionTBServicio() . ' </option>';
                    }
                } ?>
            </select>
            <button name="añadirServicio" id="añadirServicio" value="añadirServicio">Añadir servicio</button>
            <br>

            <?php
            $servicioBusiness = new ServicioBusiness();
            $servicios = $servicioBusiness->obtener();

            if (isset($_GET['idServicio']) && isset($_GET['cantidadServicio'])) {
                $array[] = unserialize($_GET['idServicio']);
                $arrayCantidad = unserialize($_GET['cantidadServicio']);
                if (count($array) > 0) {
                    foreach ($servicios as $row) {
                        for ($i = 0; $i < count($array); $i++) {

                            if ($row->getIdTBServicio() == $array[$i]) {

                                echo '<input type="hidden" name="idServicio[]" required  value="' . $row->getIdTBServicio() . '">' . $row->getNombreTBServicio() . ': ';
            ?>
                                <input type="number" name="cantidadServicio[]" min="1" value="<?php echo $arrayCantidad[$i]; ?>">
                                <button name="eliminarServicio" id="eliminarServicio" value="<?php echo $row->getIdTBServicio() ?>">Eliminar</button>
                                <br>
            <?php
                            }
                        }
                    }
                }
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == "noServiceSelection") {
                        echo '<center><p style="color: red">No existe el servicio seleccionado !</p></center>';
                    }
                }
            } else {
                echo '<center><p style="color: red">No existen servicios seleccionados !</p></center>';
            }
            ?>



            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>Cliente</th>
                        <th>Instructor</th>
                        <th>Fecha de pago</th>
                        <th>Método de pago</th>
                        <th>Peridiocidad de pago</th>
                        <th>Monto bruto</th>
                        <th>Impuesto de venta</th>
                        <th>Monto neto</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php
                            $clienteBusiness = new ClienteBusiness();
                            $clientes = $clienteBusiness->obtener();
                            ?>
                            <select name="clienteid" id="clienteid" required>
                                <?php
                                if (isset($_GET['clienteid']) && strlen($_GET['clienteid']) > 0) {
                                    foreach ($clientes as $row) :
                                        if ($row->getActivoTBCliente() == 1) {

                                            if ($_GET['clienteid'] == $row->getIdTBCliente()) {
                                                echo '<option value="' . $row->getIdTBCliente() . '">' . $row->getNombreTBCliente() . " " . $row->getApellido1TBCliente() . " " . $row->getApellido2TBCliente() . ", Num: " . $row->getTelefonoTBCliente() . '</option>';
                                            }
                                        }

                                    endforeach;
                                } else { ?>
                                    <option value="">Clientes</option>
                                <?php }

                                foreach ($clientes as $row) :
                                    if ($row->getActivoTBCliente() == 1) {
                                        if ($_GET['clienteid'] != $row->getIdTBCliente()) {
                                            echo '<option value="' . $row->getIdTBCliente() . '">' . $row->getNombreTBCliente() . " " . $row->getApellido1TBCliente() . " " . $row->getApellido2TBCliente()  . ", Num: " . $row->getTelefonoTBCliente() . '</option>';
                                        }
                                    }
                                endforeach;
                                ?>
                            </select>
                        </td>

                        <td>
                            <?php
                            $instructorBusiness = new InstructorBusiness();
                            $instructores = $instructorBusiness->obtener();
                            ?>
                            <select name="instructorid" id="instructorid" required>
                                <?php
                                if (isset($_GET['instructorid']) && strlen($_GET['instructorid']) > 0) {
                                    foreach ($instructores as $row) :
                                        if ($row->getActivoTBInstructor() == 1) {
                                            if ($_GET['instructorid'] == $row->getIdTBInstructor()) {
                                                echo '<option value="' . $row->getIdTBInstructor() . '">' . $row->getNombreTBInstructor() . " " . $row->getApellidoTBInstructor() . ", Num: " . $row->getTelefonoTBInstructor() . '</option>';
                                            }
                                        }

                                    endforeach;
                                } else { ?>
                                    <option value="" required>Instructor</option>
                                <?php }

                                foreach ($instructores as $row) :
                                    if ($row->getActivoTBInstructor() == 1) {
                                        if ($_GET['instructorid'] != $row->getIdTBInstructor()) {
                                            echo '<option value="' . $row->getIdTBInstructor() . '">' . $row->getNombreTBInstructor() . " " . $row->getApellidoTBInstructor() . ", Num: " . $row->getTelefonoTBInstructor() . '</option>';
                                        }
                                    }
                                endforeach;
                                ?>
                            </select>
                        </td>

                        <td><input type="date" id="fechaPago" name="fechaPago" value="<?php if (isset($_GET['fechaPago'])) {
                                                                                            echo $_GET['fechaPago'];
                                                                                        } ?>" required>
                        </td>

                        <td>
                            <?php
                            $pagoMetodoBusiness = new PagoMetodoBusiness();
                            $metodoPago = $pagoMetodoBusiness->obtener();
                            ?>
                            <select name="pagoMetodoId" id="pagoMetodoId" required>
                                <?php
                                if (isset($_GET['pagoMetodoId']) && strlen($_GET['pagoMetodoId']) > 0) {
                                    foreach ($metodoPago as $pagoM) :
                                        if ($pagoM->getActivoTBPagoMetodo() == 1) {
                                            if ($_GET['pagoMetodoId'] == $pagoM->getIDPagoMetodo()) {
                                                echo '<option value="' . $pagoM->getIDPagoMetodo() . '">' . $pagoM->getNombreTBPagoMetodo() . '</option>';
                                            }
                                        }

                                    endforeach;
                                } else { ?>
                                    <option value="" required>Método pago</option>
                                <?php }

                                foreach ($metodoPago as $pagoM) :
                                    if ($pagoM->getActivoTBPagoMetodo() == 1) {
                                        if ($_GET['pagoMetodoId'] != $pagoM->getIDPagoMetodo()) {
                                            echo '<option value="' . $pagoM->getIDPagoMetodo() . '">' . $pagoM->getNombreTBPagoMetodo() . '</option>';
                                        }
                                    }
                                endforeach;
                                ?>
                            </select>
                        </td>
                        <td>


                            <?php
                            $pagoModalidadBusiness = new PagoPeridiocidadBusiness();
                            $pagosModalidades = $pagoModalidadBusiness->obtener();
                            ?>

                            <select name="modalidadPago" id="modalidadPago" required>
                                <?php
                                if (isset($_GET['modalidadPago'])) {
                                    foreach ($pagosModalidades as $row) :
                                        if ($row->getActivoTBPagoPeridiocidad() == 1) {

                                            if ($_GET['modalidadPago'] == $row->getIdTBPagoPeridiocidad()) {
                                                echo '<option value="' . $row->getIdTBPagoPeridiocidad() . '" >' . $row->getNombreTBPagoPeridiocidad() . ": " . $row->getDescripcionTBPagoPeridiocidad() . '</option>';
                                            }
                                        }

                                    endforeach;
                                } else { ?>
                                    <option value="" required>Peridiocidad de pago</option>
                                <?php }

                                foreach ($pagosModalidades as $row) :
                                    if ($row->getActivoTBPagoPeridiocidad() == 1) {
                                        if ($_GET['modalidadPago'] != $row->getIdTBPagoPeridiocidad()) {
                                            echo '<option value="' . $row->getIdTBPagoPeridiocidad() . '">' . $row->getNombreTBPagoPeridiocidad() . ": " . $row->getDescripcionTBPagoPeridiocidad() . '</option>';
                                        }
                                    }
                                endforeach;
                                ?>
                            </select>

                        </td>
                        <td><input type="text" class="mascaramonto" name="MontoBruto" readonly value="<?php if (isset($_GET['MontoBruto'])) {
                                                                                                            echo $_GET['MontoBruto'];
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>" required></td>
                        <td>
                            <?php
                            $impuestoVentaBusiness = new ImpuestoVentaBusiness();
                            $impuestoVentas = $impuestoVentaBusiness->obtener();
                            ?>
                            <select name="impuestoVentaid" id="impuestoVentaid" method="POST">
                                <?php
                                if (isset($_GET['impuestoVentaid']) && strlen($_GET['impuestoVentaid']) > 0) {
                                    foreach ($impuestoVentas as $row) :
                                        if ($row->getActivoImpuestoVenta() == 1) {

                                            if ($_GET['impuestoVentaid'] == $row->getidImpuestoVenta()) {
                                                echo '<option value="' . $row->getidImpuestoVenta() . '">' . $row->getDescripcionImpuestoVenta() . '</option>';
                                            }
                                        }
                                    endforeach;
                                } else { ?>
                                    <option value="">Impuesto</option>
                                <?php }
                                foreach ($impuestoVentas as $row) :
                                    if ($row->getActivoImpuestoVenta() == 1) {
                                        if ($_GET['impuestoVentaid'] != $row->getidImpuestoVenta()) {
                                            echo '<option value="' . $row->getidImpuestoVenta() . '">' . $row->getDescripcionImpuestoVenta() . '</option>';
                                        }
                                    }
                                endforeach;
                                ?>

                            </select>
                            <button name="calcularImpuesto" id="calcularImpuesto" value="calcularImpuesto">Calcular monto neto</button>

                        </td>
                        <td><input type="text" class="mascaramonto" name="MontoNeto" value="<?php if (isset($_GET['MontoNeto'])) {
                                                                                                echo $_GET['MontoNeto'];
                                                                                            } ?>" readonly></td>
                        <td><button type="submit" name="insertarFactura" id="insertarFactura" value="insertarFactura">Registrar factura</button></td>
                    </tr>
                </tbody>
            </table>
        </form>

    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/facturaAction.php">
            <tr>
                <td>
                    <?php
                    if (isset($_GET['error'])) {

                        if ($_GET['error'] == "error") {
                            echo '<center><p style="color: red">Error en formato de factura</p></center>';
                        } else if ($_GET['error'] == "emptyField") {
                            echo '<center><p style="color: red">Campo(s) vacio(s)</p></center>';
                        } else if ($_GET['error'] == "numberFormat") {
                            echo '<center><p style="color: red">Error, formato de numero!</p></center>';
                        } else if ($_GET['error'] == "dbError") {
                            echo '<center><p style="color: red">Error al procesar la transacción!</p></center>';
                        } else if ($_GET['error'] == "noServiceSelection") {
                            echo '<center><p style="color: red">Servicio no agregado, seleccione un servicio y marque donde dice añadir!</p></center>';
                        } else if ($_GET['error'] == "unselectedTax") {
                            echo '<center><p style="color: red">Impuesto no seleccionado!</p></center>';
                        } else if ($_GET['error'] == "serviceTaxnotSelected") {
                            echo '<center><p style="color: red">Servicio e impuestos no agregados!</p></center>';
                        }
                    } else if (isset($_GET['success'])) {
                        echo '<center><p style="color: green">Transacción realizada!</p></center>';
                    }
                    ?>
                </td>
            </tr>
        </form>
    </div>
    <script src="../js/jquery_formato.js"></script>
    <br></br>
    <a href="../view/listarHistorialFactura.php" style="text-decoration: none; color: blue; font-size: 150%;"> Ver historial de facturación </a>

</body>

</html>