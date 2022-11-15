<?php
include '../business/facturaBusiness.php';
include '../business/clienteBusiness.php';
include '../business/instructorBusiness.php';
include '../business/impuestoVentaBusiness.php';
include '../business/pagoPeridiocidadBusiness.php';
include '../business/servicioBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Facturas</title>
    <script type="text/javascript">
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar esta factura?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar esta factura?");
        }
    </script>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h1>Facturas</h1>
    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaFacturas"></ul>
        </div>
    </form></br></br>
    <script src="../js/peticiones.js"></script>
    
    <div>
        <?php
        if (!isset($_POST['campo'])) {
            $_POST['campo'] = "";
            $campo = $_POST['campo'];
        }
          $campo = $_POST['campo'];

          $facturaBusiness = new FacturaBusiness();
          $facturas = $facturaBusiness->buscar($campo);
          if (!empty($facturas)) {
        ?>
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Instructor</th>
                        <th>Fecha de pago</th>
                        <th>Peridiocidad de pago</th>
                        <th>Servicios</th>
                        <th>Monto bruto</th>
                        <th>Impuesto de venta</th>
                        <th>Monto neto</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($facturas as $row) {
                        if ($row->getActivoTBFactura() == 1) {
                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/facturaAction.php">';
                            echo '<tr>';
                            echo '<input  type="hidden" name="idFactura" id="id" value="' . $row->getIdTBFactura() . '"/>';
                            echo '<td>' . $row->getIdTBFactura() . '</td>';
                    ?>
                        <td>
                            <?php
                            $clienteBusiness = new ClienteBusiness();
                            $clientes = $clienteBusiness->obtener();
                            foreach ($clientes as $row1) {
                                if ($row1->getActivoTBCliente() == 1) {
                                    if ($row1->getIdTBCliente() == $row->getClienteidTBFactura()) {
                                        echo  '<input type="text" value="' .  $row1->getNombreTBCliente() . " " . $row1->getApellido1TBCliente() . " " . $row1->getApellido2TBCliente() . '"readonly />';
                                    }
                                }
                            } ?>
                        </td>

                        <td>
                            <?php
                            $instructorBusiness = new InstructorBusiness();
                            $instructores = $instructorBusiness->obtener();
                            foreach ($instructores as $row2) {
                                if ($row2->getIdTBInstructor() == $row->getInstructoridTBFactura()) {
                                    echo  '  <input type="text" value="' . $row2->getNombreTBInstructor() . " " . $row2->getApellidoTBInstructor() . '"readonly />';
                                }
                            } ?>
                        </td>

                        <?php echo '<td><input type="date" name="fechaPago"  id="fechaPago" value="' . $row->getFechaPagoTBFactura() . '"readonly /></td>'; ?>

                        <td>
                            <?php
                            $modalidadPagoBusiness = new PagoPeridiocidadBusiness();
                            $modalidadesPago = $modalidadPagoBusiness->obtener();
                            foreach ($modalidadesPago as $modalidades) {
                                if ($modalidades->getIdTBPagoPeridiocidad() == $row->getPagoModalidadTBFactura()) {
                                    echo  '  <input type="text" value="' . $modalidades->getNombreTBPagoPeridiocidad() .  '"readonly />';
                                }
                            } ?>
                        </td>

                        <td>
                            <?php
                            $servicioBusiness = new ServicioBusiness();
                            $servicios = $servicioBusiness->obtener();
                            $array = explode(";", $row->getServiciosTBFactura());
                            $serviciosExist = "";
                            foreach ($servicios as $rr) {
                                foreach ($array as $selected) {
                                    if ($rr->getIdTBServicio() == $selected) {
                                        $serviciosExist = $rr->getNombreTBServicio() . "." . $serviciosExist;
                                    }
                                }
                            }
                            echo '<input type="text" readonly value="' . $serviciosExist . '" />';
                            ?>
                        </td>
                        <?php echo '<td><input type="text" name="montoBruto" id="montoBruto" value="₡ ' . $row->getMontoBrutoTBFactura() .  '"readonly /></td>'; ?>

                        <td>
                            <?php
                            $impuestoVentaBusiness = new ImpuestoVentaBusiness();
                            $impuestoVentas = $impuestoVentaBusiness->obtener();
                            foreach ($impuestoVentas as $row3) {
                                if ($row3->getidImpuestoVenta() == $row->getImpuestoVentaidTBFactura()) {
                                    echo  '  <input type="text" value="' . $row3->getDescripcionImpuestoVenta() . '"readonly />';
                                }
                            } ?>
                        </td>

                        <?php
                        echo '<td><input type="text" name="montoNeto" id="montoNeto" value="₡ ' . $row->getMontoNetoTBFactura() .  '"readonly /></td>';
                        echo '<td><input type="submit" name="eliminarFactura" id="eliminarFactura" value="Anular" onclick="return confirmarAccionEliminar()"/></td>';
                        echo '</tr>';
                        echo '</form>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        <?php
          } else {
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron facturas!</p>';
          }
        ?>
    </div>

    <div>
        <h3>Crear nueva factura</h3>

        <script src="../js/jquery_formato.js"></script>
        <form name="formulario" method="POST" id="direccionform" action="../business/facturaAction.php">
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>Cliente</th>
                        <th>Instructor</th>
                        <th>Fecha de pago</th>
                        <th>Peridiocidad de pago</th>
                        <th>Servicios</th>
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
                                                echo '<option value="' . $row->getIdTBCliente() . '">' . $row->getNombreTBCliente() . " " . $row->getApellido1TBCliente() . " " . $row->getApellido2TBCliente() . '</option>';
                                            }
                                        }

                                    endforeach;
                                } else { ?>
                                    <option value="">Clientes</option>
                                <?php }

                                foreach ($clientes as $row) :
                                    if ($row->getActivoTBCliente() == 1) {
                                        if ($_GET['clienteid'] != $row->getIdTBCliente()) {
                                            echo '<option value="' . $row->getIdTBCliente() . '">' . $row->getNombreTBCliente() . " " . $row->getApellido1TBCliente() . " " . $row->getApellido2TBCliente() . ' - ' . $row->getTelefonoTBCliente() . '</option>';
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
                                                echo '<option value="' . $row->getIdTBInstructor() . '">' . $row->getNombreTBInstructor() . " " . $row->getApellidoTBInstructor() . '</option>';
                                            }
                                        }

                                    endforeach;
                                } else { ?>
                                    <option value="" required>Instructor</option>
                                <?php }

                                foreach ($instructores as $row) :
                                    if ($row->getActivoTBInstructor() == 1) {
                                        if ($_GET['instructorid'] != $row->getIdTBInstructor()) {
                                            echo '<option value="' . $row->getIdTBInstructor() . '">' . $row->getNombreTBInstructor() . " " . $row->getApellidoTBInstructor() . '</option>';
                                        }
                                    }
                                endforeach;
                                ?>
                            </select>
                        </td>

                        <td><input type="date" id="fechaPago" name="fechaPago" value="<?php if (isset($_GET['fechaPago'])) {
                                                                                            echo $_GET['fechaPago'];
                                                                                        } ?>" required>

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
                                                echo '<option value="' . $row->getIdTBPagoPeridiocidad() . '" >' . $row->getNombreTBPagoPeridiocidad() . '</option>';
                                            }
                                        }

                                    endforeach;
                                } else { ?>
                                    <option value="" required>Peridiocidad de pago</option>
                                <?php }

                                foreach ($pagosModalidades as $row) :
                                    if ($row->getActivoTBPagoPeridiocidad() == 1) {
                                        if ($_GET['modalidadPago'] != $row->getIdTBPagoPeridiocidad()) {
                                            echo '<option value="' . $row->getIdTBPagoPeridiocidad() . '">' . $row->getNombreTBPagoPeridiocidad() . '</option>';
                                        }
                                    }
                                endforeach;
                                ?>
                            </select>

                        </td>

                        <td>
                            <?php
                            $servicioBusiness = new ServicioBusiness();
                            $servicios = $servicioBusiness->obtener();
                            ?>

                            <select id="serviciosMult" name="serviciosMult[]" multiple="multiple" method="POST">
                                <?php
                                if (isset($_GET['serviciosMult'])) {
                                    $array = unserialize($_GET['serviciosMult']);
                                    foreach ($servicios as $row) {
                                        $foo = True;
                                        foreach ($array as $selected) {
                                            if ($row->getIdTBServicio() == $selected) {
                                                $foo = false;
                                                echo '<option selected="selected" value="' . $row->getIdTBServicio() . '">' . $row->getNombreTBServicio() . ' </option>';
                                            }
                                        }
                                        if ($foo == true) {
                                            echo '<option value="' . $row->getIdTBServicio() . '">' . $row->getNombreTBServicio() . ' </option>';
                                        }
                                    }
                                } else {
                                    foreach ($servicios as $row) {
                                        echo '<option value="' . $row->getIdTBServicio() . '">' . $row->getNombreTBServicio() . ' </option>';
                                    }
                                } ?>
                            </select>
                            <button name="añadirServicios" id="añadirServicios" value="añadirServicios">Añadir</button>
                        </td>
                        <td><input type="text"class="mascaramonto" name="MontoBruto" readonly value="<?php if (isset($_GET['MontoBruto'])) {
                                                                                        echo $_GET['MontoBruto'];
                                                                                    }else{echo "";} ?>"required>
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
                                                                        } ?>" readonly>
                        <td><button type="submit" name="insertarFactura"  id="insertarFactura" value="insertarFactura">Registrar factura</button></td>
                    </tr>
                </tbody>
            </table>
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
        document.getElementById("fechaPago").setAttribute("max", maxDate);
    </script>

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
                        }else if ($_GET['error'] == "noServiceSelection") {
                            echo '<center><p style="color: red">Servicio no agregado, seleccione un servicio y marque donde dice añadir!</p></center>';
                        }else if ($_GET['error'] == "unselectedTax") {
                            echo '<center><p style="color: red">Impuesto no seleccionado!</p></center>';
                        }else if($_GET['error'] == "serviceTaxnotSelected"){
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
</body>

</html>