<?php
include '../business/clienteRutinaBusiness.php';
include '../business/ejercicioBusiness.php';
include '../business/clienteBusiness.php';
include '../business/instructorBusiness.php';
include '../business/modalidadFuncionalBusiness.php';
include '../business/clienteRutinaDetalleBusiness.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar rutinas </title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea abrir esta rutina ?");
        }

        function confirmarVolverMenuPrincipal() {
            return confirm("¿Está seguro de que desea volver al menú de cliente rutina?");
        }
    </script>
    <a onclick="return confirmarVolverMenuPrincipal()" href="listarMenuClienteRutina.php" style="text-decoration: none; color: blue; font-size: 150%;">Volver atrás</a>

    <h2>Actualizar la rutina de un cliente</h2>
</head>

<body>

    <div>

        <form name="formulario" method="POST" id="direccionform" action="actualizarUnaRutinaCliente.php">
            <table border="1">
                <thead style="hidden-align: left;">
                    <tr>
                        <th>Cliente</th>
                        <th>Instructor</th>
                        <th>Modalidad funcional</th>
                        <th>Ejercicios</th>
                        <th>Fecha</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $clienteRutina = new ClienteRutinaBusiness();
                    $clienteRutinaVector = $clienteRutina->obtener();

                    $ejercicioBusiness = new EjercicioBusiness();
                    $ejerciciosVector = $ejercicioBusiness->obtener();

                    $clienteRutinaDetalle = new ClienteRutinaDetalleBusiness();
                    $rutinaDetalleVector = $clienteRutinaDetalle->obtener();

                    foreach ($clienteRutinaVector as $rutinasVec) {
                    ?>
                        <tr>


                            <td>
                                <?php
                                $clienteBusiness = new ClienteBusiness();
                                $clientes = $clienteBusiness->obtener();
                                foreach ($clientes as $row) :
                                    if ($row->getActivoTBCliente() == 1) {

                                        if ($rutinasVec->getIdTBCliente() == $row->getIdTBCliente()) {
                                            echo '<input type="hidden" value="' . $row->getIdTBCliente() . '">' . $row->getNombreTBCliente() . " " . $row->getApellido1TBCliente() . " " . $row->getApellido2TBCliente() . ", Num: " . $row->getTelefonoTBCliente() . '</input type="hidden">';
                                        }
                                    }
                                endforeach;
                                ?>
                            </td>
                            <td> <?php
                                    $instructorBusiness = new InstructorBusiness();
                                    $instructores = $instructorBusiness->obtener();

                                    foreach ($instructores as $row) :
                                        if ($row->getActivoTBInstructor() == 1) {
                                            if ($rutinasVec->getIdTBIstructor() == $row->getIdTBInstructor()) {
                                                echo '<input type="hidden" value="' . $row->getIdTBInstructor() . '">' . $row->getNombreTBInstructor() . " " . $row->getApellidoTBInstructor() . ", Num: " . $row->getTelefonoTBInstructor() . '</input type="hidden">';
                                            }
                                        }
                                    endforeach;

                                    ?>
                            </td>
                            <td><?php
                                $modalidadFuncionalBusiness = new ModalidadFuncionalBusiness();
                                $modalidades = $modalidadFuncionalBusiness->obtener();

                                foreach ($modalidades as $row) :
                                    if ($row->getActivoTBModalidadFuncional() == 1) {
                                        if ($rutinasVec->getIdTBModalidadFuncional() == $row->getIdTBModalidadFuncional()) {
                                            echo '<input type="hidden" value="' . $row->getIdTBModalidadFuncional() . '">' . $row->getNombreTBModalidadFuncional() . ": " . $row->getDescripcionTBModalidadFuncional() . '</input type="hidden">';
                                        }
                                    }
                                endforeach;

                                ?>
                            </td>
                            <td>
                                <?php
                                foreach ($rutinaDetalleVector as $row) {
                                    if ($rutinasVec->getIdTBClienteRutina() == $row->getIdClienteRutina()) {
                                        foreach ($ejerciciosVector as $ejercicioV) {
                                            if ($ejercicioV->getIdEjercicio() ==  $row->getIdEjercicio()) {
                                                echo '<input type="hidden" name="ejerciciosVector[]" required  value="' . $ejercicioV->getIdEjercicio() . '">' . $ejercicioV->getNombreEjercicio() . " : <br>" . $ejercicioV->getDescripcionEjercicio() . ''; ?>
                                                <br><?php
                                                    echo '_________________________<br>';
                                                }
                                            }
                                        }
                                    } ?>

                            </td>
                            <td><input type="date" name="fecha" id="fecha" readonly value="<?php echo $rutinasVec->getFechaTBClienteRutina(); ?>"></td>
                            <td><button type="submit" name="idRutinaCliente" onclick="return confirmarAccionModificar()" id="idRutinaCliente" value="<?php echo $rutinasVec->getIdTBClienteRutina() ?>">Abrir para actualizar rutina</button></td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
        </form>
    </div>
</body>

</html>