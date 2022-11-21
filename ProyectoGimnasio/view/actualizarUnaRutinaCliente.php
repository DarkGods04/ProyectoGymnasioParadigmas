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
    <script type="text/javascript">
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar esta rutina al cliente ?");
        }

        function confirmarVolverMenuPrincipal() {
            return confirm("¿Está seguro de que desea volver al menú de cliente rutina?");
        }
    </script>
    <a onclick="return confirmarVolverMenuPrincipal()" href="listarMenuClienteRutina.php" style="text-decoration: none; color: blue; font-size: 150%;">volver atrás</a>

    <h2>Actualizar rutina cliente</h2>
</head>

<body>

    <div>

        <form name="formulario" method="POST" id="direccionform" action="../business/clienteRutinaActualizarAction.php">
            <table border="1">
                <thead style="text-align: left;">
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
                    <tr>
                        <?php
                        $clienteRutina = new ClienteRutinaBusiness();
                        $clienteRutinaVector = $clienteRutina->obtener();

                        $ejercicioBusiness = new EjercicioBusiness();
                        $ejerciciosVector = $ejercicioBusiness->obtener();

                        $clienteRutinaDetalle = new ClienteRutinaDetalleBusiness();
                        $rutinaDetalleVector = $clienteRutinaDetalle->obtener();

                        if (!empty($_GET['idRutinaCliente']) || !empty($_POST['idRutinaCliente'])) {
                            if (!empty($_GET['idRutinaCliente'])) {
                                $idRutinaCliente = $_GET['idRutinaCliente'];
                            } else {
                                $idRutinaCliente = $_POST['idRutinaCliente'];
                            }
                            foreach ($clienteRutinaVector as $rutinasVec) {
                                if ($idRutinaCliente == $rutinasVec->getIdTBClienteRutina()) {
                        ?><input type="hidden" name="idRutinaCliente" value="<?php echo $rutinasVec->getIdTBClienteRutina() ?>">


                                    <td>
                                        <?php
                                        $clienteBusiness = new ClienteBusiness();
                                        $clientes = $clienteBusiness->obtener();

                                        if (isset($_GET['idCliente']) && strlen($_GET['idCliente']) > 0) {
                                            foreach ($clientes as $row) :
                                                if ($row->getActivoTBCliente() == 1) {

                                                    if ($_GET['idCliente'] == $row->getIdTBCliente()) {
                                                        echo '<input type="hidden" name="idCliente" value="' . $row->getIdTBCliente() . '">' . $row->getNombreTBCliente() . " " . $row->getApellido1TBCliente() . " " . $row->getApellido2TBCliente() . ", Num: " . $row->getTelefonoTBCliente() . '</input type="hidden">';
                                                    }
                                                }

                                            endforeach;
                                        } else {

                                            foreach ($clientes as $row) :
                                                if ($row->getActivoTBCliente() == 1) {

                                                    if ($rutinasVec->getIdTBCliente() == $row->getIdTBCliente()) {
                                                        echo '<input type="hidden" name="idCliente" value="' . $row->getIdTBCliente() . '">' . $row->getNombreTBCliente() . " " . $row->getApellido1TBCliente() . " " . $row->getApellido2TBCliente() . ", Num: " . $row->getTelefonoTBCliente() . '</input type="hidden">';
                                                    }
                                                }
                                            endforeach;
                                        }
                                        ?>
                                    </td>
                                    <td> <?php
                                            $instructorBusiness = new InstructorBusiness();
                                            $instructores = $instructorBusiness->obtener();
                                            ?>
                                        <select name="idInstructor" id="idInstructor" required>
                                            <?php
                                            if (isset($_GET['idInstructor']) == $rutinasVec->getIdTBIstructor()) {
                                                foreach ($instructores as $row) :
                                                    if ($row->getActivoTBInstructor() == 1) {
                                                        if ($_GET['idInstructor'] == $row->getIdTBInstructor()) {
                                                            echo '<option value="' . $row->getIdTBInstructor() . '">' . $row->getNombreTBInstructor() . " " . $row->getApellidoTBInstructor() . ", Num: " . $row->getTelefonoTBInstructor() . '</option>';
                                                        }
                                                    }

                                                endforeach;
                                            } else {
                                                foreach ($instructores as $row) :
                                                    if ($row->getActivoTBInstructor() == 1) {
                                                        if ($rutinasVec->getIdTBIstructor() == $row->getIdTBInstructor()) {
                                                            echo '<option value="' . $row->getIdTBInstructor() . '">' . $row->getNombreTBInstructor() . " " . $row->getApellidoTBInstructor() . ", Num: " . $row->getTelefonoTBInstructor() . '</option>';
                                                        }
                                                    }
                                                endforeach;
                                            }

                                            foreach ($instructores as $row) :
                                                if ($row->getActivoTBInstructor() == 1) {
                                                    if ($rutinasVec->getIdTBIstructor() != $row->getIdTBInstructor()) {
                                                        echo '<option value="' . $row->getIdTBInstructor() . '">' . $row->getNombreTBInstructor() . " " . $row->getApellidoTBInstructor() . ", Num: " . $row->getTelefonoTBInstructor() . '</option>';
                                                    }
                                                }
                                            endforeach;
                                            ?>
                                        </select>
                                    </td>
                                    <td><?php
                                        $modalidadFuncionalBusiness = new ModalidadFuncionalBusiness();
                                        $modalidades = $modalidadFuncionalBusiness->obtener();
                                        ?>
                                        <select name="idModalidadFuncional" id="idModalidadFuncional" required>
                                            <?php
                                            if (isset($_GET['idModalidadFuncional']) == $rutinasVec->getIdTBModalidadFuncional()) {
                                                foreach ($modalidades as $row) :
                                                    if ($row->getActivoTBModalidadFuncional() == 1) {
                                                        if ($_GET['idModalidadFuncional'] == $row->getIdTBModalidadFuncional()) {
                                                            echo '<option value="' . $row->getIdTBModalidadFuncional() . '">' . $row->getNombreTBModalidadFuncional() . ": " . $row->getDescripcionTBModalidadFuncional() . '</option>';
                                                        }
                                                    }

                                                endforeach;
                                            } else {
                                                foreach ($modalidades as $row) :
                                                    if ($row->getActivoTBModalidadFuncional() == 1) {
                                                        if ($rutinasVec->getIdTBModalidadFuncional() == $row->getIdTBModalidadFuncional()) {
                                                            echo '<option value="' . $row->getIdTBModalidadFuncional() . '">' . $row->getNombreTBModalidadFuncional() . ": " . $row->getDescripcionTBModalidadFuncional() . '</option>';
                                                        }
                                                    }
                                                endforeach;
                                            }

                                            foreach ($modalidades as $row) :
                                                if ($row->getActivoTBModalidadFuncional() == 1) {
                                                    if ($rutinasVec->getIdTBModalidadFuncional() != $row->getIdTBModalidadFuncional()) {
                                                        echo '<option value="' . $row->getIdTBModalidadFuncional() . '">' . $row->getNombreTBModalidadFuncional() . ": " . $row->getDescripcionTBModalidadFuncional() . '</option>';
                                                    }
                                                }
                                            endforeach;
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="ejercicio" name="ejercicio" method="POST">

                                            <option value="">Ejercicio</option>
                                            <?php
                                            if (isset($_GET['ejerciciosVector'])) {
                                                $array = unserialize($_GET['ejerciciosVector']);
                                                foreach ($ejerciciosVector as $row) {
                                                    $flag = false;
                                                    foreach ($array as $selected) {
                                                        if ($row->getIdEjercicio() == $selected) {
                                                            $flag = true;
                                                        }
                                                    }
                                                    if ($flag == false) {
                                                        echo '<option  value="' . $row->getIdEjercicio() . '">' . $row->getNombreEjercicio() . " : " . $row->getDescripcionEjercicio() . ' </option>';
                                                    }
                                                }
                                            } else {
                                                foreach ($ejerciciosVector as $ejercicioV) {
                                                    $flag = false;
                                                    foreach ($rutinaDetalleVector as $selected) {
                                                        if ($selected->getIdClienteRutina() == $rutinasVec->getIdTBClienteRutina()) {
                                                            if ($ejercicioV->getIdEjercicio() == $selected->getIdEjercicio()) {
                                                                $flag = true;
                                                            }
                                                        }
                                                    }
                                                    if ($flag == false) {
                                                        echo '<option  value="' . $ejercicioV->getIdEjercicio() . '">' . $ejercicioV->getNombreEjercicio() . " : " . $ejercicioV->getDescripcionEjercicio() . ' </option>';
                                                    }
                                                }
                                            } ?>
                                        </select>
                                        <button name="añadirEjercicio" id="añadirEjercicio" value="añadirEjercicio">Añadir ejercicio</button><br><br>

                                        <?php
                                        if (isset($_GET['ejerciciosVector'])) {
                                            $array[] = unserialize($_GET['ejerciciosVector']);
                                            if (count($array) > 0) {
                                                foreach ($ejerciciosVector as $row) {
                                                    for ($i = 0; $i < count($array); $i++) {
                                                        if ($row->getIdEjercicio() == $array[$i]) {
                                                            echo '<input type="hidden" name="ejerciciosVector[]" required  value="' . $row->getIdEjercicio() . '">' . $row->getNombreEjercicio() . " : <br>" . $row->getDescripcionEjercicio() . '';
                                        ?>
                                                            <button name="eliminarEjercicio" id="eliminarEjercicio" value="<?php echo $row->getIdEjercicio() ?>">Eliminar</button>
                                                            <br>
                                                        <?php
                                                            echo '_________________________<br>';
                                                        }
                                                    }
                                                }
                                            }
                                            if (isset($_GET['error'])) {
                                                if ($_GET['error'] == "notEjercicioSelection") {
                                                    echo '<center><p style="color: red">No existe el ejercicio seleccionado !</p></center>';
                                                }
                                            }
                                        } else {
                                            foreach ($rutinaDetalleVector as $row) {
                                                if ($rutinasVec->getIdTBClienteRutina() == $row->getIdClienteRutina()) {
                                                    foreach ($ejerciciosVector as $ejercicioV) {
                                                        if ($ejercicioV->getIdEjercicio() ==  $row->getIdEjercicio()) {
                                                            echo '<input type="hidden" name="ejerciciosVector[]" required  value="' . $ejercicioV->getIdEjercicio() . '">' . $ejercicioV->getNombreEjercicio() . " : <br>" . $ejercicioV->getDescripcionEjercicio() . ''; ?>
                                                            <button type="submit" name="eliminarEjercicio" id="eliminarEjercicio" value="<?php echo $ejercicioV->getIdEjercicio() ?>">Eliminar</button>
                                                            <br><?php
                                                                echo '_________________________<br>';
                                                            }
                                                        }
                                                    }
                                                }
                                            } ?>

                                    </td>
                                    <?php

                                    $fecha = date_create($rutinasVec->getFechaTBClienteRutina());
                                    date_add($fecha, date_interval_create_from_date_string("1 day"));
                                    
                                    $rutinasVec->setFechaTBClienteRutina(date_format($fecha, "Y-m-d"));

                                    ?>
                                    <td><input type="date" name="fecha" id="fecha" min="<?php echo $rutinasVec->getFechaTBClienteRutina(); ?>" value="<?php if (isset($_GET['fecha'])) {
                                                                                                                                                    echo $_GET['fecha'];
                                                                                                                                                } else {
                                                                                                                                                    echo $rutinasVec->getFechaTBClienteRutina();
                                                                                                                                                } ?>"></td>
                                    <td><button type="submit" onclick="return confirmarAccionModificar()" name="actualizarRutinaCliente" id="actualizarRutinaCliente" value="<?php echo $rutinasVec->getIdTBClienteRutina() ?>">Actualizar rutina</button></td>

                        <?php
                                }
                            }
                        }
                        ?>
                    </tr>
                </tbody>
        </form>
    </div>
    <div>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyField") {
                echo '<p style="color: red">Campo(s) vacio(s)</p>';
            } else if ($_GET['error'] == "numberFormat") {
                echo '<p style="color: red">Error, formato de numero!</p>';
            } else if ($_GET['error'] == "dbError") {
                echo '<center><p style="color: red">Error al procesar la transacción!</p></center>';
            } else if ($_GET['error'] == "rutinaNotSelected") {
                echo '<center><p style="color: red">Rutina no seleccionada</p></center>';
            }
        } else if (isset($_GET['success'])) {
            if ($_GET['success'] == "inserted") {
                echo '<p style="color: green">Transacción realizada!</p>';
            }
            if ($_GET['success'] == "selectedExercise") {
                echo '<p style="color: green">Ejercicio seleccionado</p>';
            }
            if ($_GET['success'] == "delete") {
                echo '<p style="color: green">Ejercicio eliminado</p>';
            }
        }
        ?>
    </div>

</body>

</html>