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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
</head>

<body>
    <div style="text-align:center;">
        <table>
            <tr>
                <h3>Factura</h3>
                <script src="../js/app.js"></script>
                <p id=cliente><?php
                                $clienteBusiness = new ClienteBusiness();
                                $clientes = $clienteBusiness->obtener();

                                if (isset($_GET['cliente'])) {
                                    foreach ($clientes as $row) :
                                        if ($row->getActivoTBCliente() == 1) {
                                            if ($_GET['cliente'] == $row->getIdTBCliente()) {

                                                echo " Cliente: " . $row->getNombreTBCliente() . " " . $row->getApellido1TBCliente();
                                            }
                                        }
                                    endforeach;
                                } ?></p>
                <thead style="text-align: left;">
                    <p id=instructor><?php
                                        $instructorBusiness = new InstructorBusiness();
                                        $instructores = $instructorBusiness->obtener();

                                        if (isset($_GET['instructor'])) {

                                            foreach ($instructores as $row) :
                                                if ($row->getActivoTBInstructor() == 1) {
                                                    if ($_GET['instructor'] == $row->getIdTBInstructor()) {

                                                        echo " Instructor: " . $row->getNombreTBInstructor() . " " . $row->getApellidoTBInstructor();
                                                    }
                                                }
                                            endforeach;
                                        } ?></p>

                    <p id="fechaPago">
                        <?php
                        if (isset($_GET['fechaPago'])) {
                            echo "Fecha de pago: " . $_GET['fechaPago'];
                        } ?></p>

                    <p id="modalidadPago">
                        <?php
                        $pagoModalidadBusiness = new PagoPeridiocidadBusiness();
                        $pagosModalidades = $pagoModalidadBusiness->obtener();


                        if (isset($_GET['modalidadPago'])) {

                            foreach ($pagosModalidades as $row) :
                                if ($row->getActivoTBPagoPeridiocidad() == 1) {
                                    if ($_GET['modalidadPago'] == $row->getIdTBPagoPeridiocidad()) {

                                        echo "Periocidad de pago: " . $row->getNombreTBPagoPeridiocidad();
                                    }
                                }
                            endforeach;
                        }
                        ?>

                    </p>
                    <?php
                    $servicioBusiness = new ServicioBusiness();
                    $servicios = $servicioBusiness->obtener();

                    if (isset($_GET['serviciosMult'])) {
                        $array = unserialize($_GET['serviciosMult']);
                        echo " Servicios adquiridos: ";
                        foreach ($servicios as $row) {
                            $foo = True;
                            foreach ($array as $selected) {
                                if ($row->getIdTBServicio() == $selected) {
                                    $foo = false;
                                    echo $row->getNombreTBServicio() . "-";
                                }
                            }
                        }
                    }
                    ?>
                    </p>
                    <p id=montoBruto>
                        <?php if (isset($_GET['MontoBruto'])) {
                            echo "Monto bruto: ₡" . $_GET['MontoBruto'];
                        } else {
                            echo "";
                        } ?>

                    </p>

                    <p id=impuestoVenta>
                        <?php
                        $impuestoVentaBusiness = new ImpuestoVentaBusiness();
                        $impuestoVentas = $impuestoVentaBusiness->obtener();


                        if (isset($_GET['impuestoVenta'])) {

                            foreach ($impuestoVentas as $row) :
                                if ($row->getActivoImpuestoVenta() == 1) {
                                    if ($_GET['impuestoVenta'] == $row->getidImpuestoVenta()) {

                                        echo "Impuesto aplicado: " . $row->getDescripcionImpuestoVenta();
                                    }
                                }
                            endforeach;
                        }
                        ?>
                    </p>
                    <p id=montoNeto>
                        <?php if (isset($_GET['montoNeto'])) {
                            echo "Monto neto: ₡" . $_GET['montoNeto'];
                        } else {
                            echo "";
                        } ?>
                    </p>

                    <p id=pagoMetodoId>
                        <?php
                        $pagoMetodoBusiness = new PagoMetodoBusiness();
                        $metodoPago = $pagoMetodoBusiness->obtener();
                        if (isset($_GET['pagoMetodoId'])) {

                            foreach ($metodoPago as $row) :
                                if ($row->getActivoTBPagoMetodo() == 1) {
                                    if ($_GET['pagoMetodoId'] == $row->getIDPagoMetodo()) {

                                        echo "Método de pago aplicado: " . $row->getNombreTBPagoMetodo();
                                    }
                                }
                            endforeach;
                        }
                        ?>
                    </p>
                </thead>
                <script>
                    window.print()
                </script>
                <div>
                    <a href="listarFactura.php?success=success" style="text-decoration: none; color: blue; font-size: 150%;">- Volver a factura</a>
                </div>
            </tr>
        </table>
    </div>

</body>

</html>