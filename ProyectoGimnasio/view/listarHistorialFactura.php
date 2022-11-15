<?php
include '../business/facturaBusiness.php';
include '../business/clienteBusiness.php';
include '../business/instructorBusiness.php';
include '../business/impuestoVentaBusiness.php';
include '../business/pagoPeridiocidadBusiness.php';
include '../business/servicioBusiness.php';
include '../business/pagoMetodoBusiness.php';
include '../business/facturaDetalleBusiness.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de facturación</title>
    <script type="text/javascript">
        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar esta factura?");
        }
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="../js/jquery_formato.js"></script>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <br></br>
    <a href="../view/listarFactura.php" style="text-decoration: none; color: blue; font-size: 150%;"> Generar nueva factura </a>
    <br></br>
    <h1>Historial factura</h1>
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
                        <th>Método de pago</th>
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
                                $array = null;
                                $arrayCantidad = null;
                                $montoBruto = 0;
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
                                $facturaDetalleBusiness = new FacturaDetalleBusiness();
                                $facturaDetalle = $facturaDetalleBusiness->obtener();
                                // print_r($facturaDetalle);
                                foreach ($facturaDetalle as $rr) {
                                    if ($rr->getIdTBFactura() == $row->getIdTBFactura()) {
                                        $array[] = $rr->getIdServicioTBFacturaDetalle();
                                        $arrayCantidad[] = $rr->getCantidadTBServicioFacturaDetalle();
                                        $montoBruto = $montoBruto + $rr->getMontoBrutoTBFacturaDetalle();
                                    }
                                }
                                $servicioBusiness = new ServicioBusiness();
                                $servicios = $servicioBusiness->obtener();
                                foreach ($servicios as $serv) {
                                    for ($i = 0; $i < count($array); $i++) {

                                        if ($serv->getIdTBServicio() == $array[$i]) {

                                            echo  '<input type="text" value="' . $serv->getNombreTBServicio() . " Cantidad: " . $arrayCantidad[$i] . '"readonly />';
                                        }
                                    }
                                }
                                // print_r($array);
                                //print_r($arrayCantidad);
                                ?>
                            </td>
                            <td><input type="text" class="mascaramonto" name="MontoBruto" id="MontoBruto" value="<?php echo $montoBruto; ?>" /></td>
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
                            echo '<td><input type="text" class="mascaramonto" name="montoNeto" id="montoNeto" value="₡ ' . $row->getMontoNetoTBFactura() .  '"readonly /></td>';
                            ?>
                            <td>
                                <?php
                                $pagoMetodoBusiness = new PagoMetodoBusiness();
                                $metodoPago = $pagoMetodoBusiness->obtener();
                                foreach ($metodoPago as $pago) {
                                    if ($pago->getIDPagoMetodo() == $row->getMetodoDePagoidTBFactura()) {
                                        echo  '  <input type="text" value="' . $pago->getNombreTBPagoMetodo() . '"readonly />';
                                    }
                                } ?>
                            </td>
                    <?php
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
</body>

</html>