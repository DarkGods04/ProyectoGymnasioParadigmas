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
<link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"><!--botones estilos -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente rutina</title>
    <script type="text/javascript">
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar esta rutina al cliente ?");
        }

        function confirmarVolverMenuPrincipal() {
            return confirm("¿Está seguro de que desea volver al menú de cliente rutina?");
        }
    </script>
    <a onclick="return confirmarVolverMenuPrincipal()" href="listarMenuClienteRutina.php" style="text-decoration: none; color: blue; font-size: 150%;">Volver atrás</a>

    <h1>Crear rutina a un cliente</h1>
</head>

<body>
    <div>
        <form name="formulario" method="POST" id="direccionform" action="../business/clienteRutinaAction.php">
            <?php
            $ejercicioBusiness = new EjercicioBusiness();
            $ejerciciosVector = $ejercicioBusiness->obtener();
            ?>

            <table border="1">

                <br><br>
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
                        foreach ($ejerciciosVector as $row) {
                            echo '<option value="' . $row->getIdEjercicio() . '">' . $row->getNombreEjercicio() . " : " . $row->getDescripcionEjercicio() . ' </option>';
                        }
                    } ?>
                </select>
                <button name="añadirEjercicio" id="añadirEjercicio" value="añadirEjercicio">Añadir ejercicio</button>
                <br><br>
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
                        <td>
                            <?php
                            $clienteBusiness = new ClienteBusiness();
                            $clientes = $clienteBusiness->obtener();
                            ?>
                            <select name="idCliente" id="idCliente">
                                <?php
                                if (isset($_GET['idCliente']) && strlen($_GET['idCliente']) > 0) {
                                    foreach ($clientes as $row) :
                                        if ($row->getActivoTBCliente() == 1) {

                                            if ($_GET['idCliente'] == $row->getIdTBCliente()) {
                                                echo '<option value="' . $row->getIdTBCliente() . '">' . $row->getNombreTBCliente() . " " . $row->getApellido1TBCliente() . " " . $row->getApellido2TBCliente() . ", Num: " . $row->getTelefonoTBCliente() . '</option>';
                                            }
                                        }

                                    endforeach;
                                } else { ?>
                                    <option value="">Clientes</option>
                                <?php }

                                foreach ($clientes as $row) :
                                    if ($row->getActivoTBCliente() == 1) {
                                        if ($_GET['idCliente'] != $row->getIdTBCliente()) {
                                            echo '<option value="' . $row->getIdTBCliente() . '">' . $row->getNombreTBCliente() . " " . $row->getApellido1TBCliente() . " " . $row->getApellido2TBCliente()  . ", Num: " . $row->getTelefonoTBCliente() . '</option>';
                                        }
                                    }
                                endforeach;
                                ?>
                            </select>
                        </td>
                        <td> <?php
                                $instructorBusiness = new InstructorBusiness();
                                $instructores = $instructorBusiness->obtener();
                                ?>
                            <select name="idInstructor" id="idInstructor">
                                <?php
                                if (isset($_GET['idInstructor']) && strlen($_GET['idInstructor']) > 0) {
                                    foreach ($instructores as $row) :
                                        if ($row->getActivoTBInstructor() == 1) {
                                            if ($_GET['idInstructor'] == $row->getIdTBInstructor()) {
                                                echo '<option value="' . $row->getIdTBInstructor() . '">' . $row->getNombreTBInstructor() . " " . $row->getApellidoTBInstructor() . ", Num: " . $row->getTelefonoTBInstructor() . '</option>';
                                            }
                                        }

                                    endforeach;
                                } else { ?>
                                    <option value="">Instructor</option>
                                <?php }

                                foreach ($instructores as $row) :
                                    if ($row->getActivoTBInstructor() == 1) {
                                        if ($_GET['idInstructor'] != $row->getIdTBInstructor()) {
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
                            <select name="idModalidadFuncional" id="idModalidadFuncional">
                                <?php
                                if (isset($_GET['idModalidadFuncional']) && strlen($_GET['idModalidadFuncional']) > 0) {
                                    foreach ($modalidades as $row) :
                                        if ($row->getActivoTBModalidadFuncional() == 1) {
                                            if ($_GET['idModalidadFuncional'] == $row->getIdTBModalidadFuncional()) {
                                                echo '<option value="' . $row->getIdTBModalidadFuncional() . '">' . $row->getNombreTBModalidadFuncional() . ": " . $row->getDescripcionTBModalidadFuncional() . '</option>';
                                            }
                                        }

                                    endforeach;
                                } else { ?>
                                    <option value="">Modalidad funcional</option>
                                <?php }

                                foreach ($modalidades as $row) :
                                    if ($row->getActivoTBModalidadFuncional() == 1) {
                                        if ($_GET['idModalidadFuncional'] != $row->getIdTBModalidadFuncional()) {
                                            echo '<option value="' . $row->getIdTBModalidadFuncional() . '">' . $row->getNombreTBModalidadFuncional() . ": " . $row->getDescripcionTBModalidadFuncional() . '</option>';
                                        }
                                    }
                                endforeach;
                                ?>
                            </select>
                        </td>
                        <td>
                            <?php
                            $ejercicioBusiness = new EjercicioBusiness();
                            $ejercicios = $ejercicioBusiness->obtener();

                            if (isset($_GET['ejerciciosVector'])) {
                                $array[] = unserialize($_GET['ejerciciosVector']);
                                if (count($array) > 0) {
                                    foreach ($ejercicios as $row) {
                                        for ($i = 0; $i < count($array); $i++) {
                                            if ($row->getIdEjercicio() == $array[$i]) {
                                                echo '<input type="hidden" name="ejerciciosVector[]"   value="' . $row->getIdEjercicio() . '">' . $row->getNombreEjercicio() . " : <br>" . $row->getDescripcionEjercicio() . '';
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
                                    if ($_GET['error'] == "noEjercicioSelection") {
                                        echo '<center><p style="color: red">No existe el ejercicio seleccionado !</p></center>';
                                    }
                                }
                            } else {
                                echo '<center><p style="color: red">No existen ejercicios seleccionados !</p></center>';
                            }
                            ?>
                        </td>
                        <td><input type="date" name="fecha" id="fecha" value="<?php if (isset($_GET['fecha'])) {
                                                                                    echo $_GET['fecha'];
                                                                                } ?>"></td>
                        <td><button type="submit" name="insertarClienteRutina" id="insertarClienteRutina" value="insertarClienteRutina">Registrar rutina</button></td>
                    </tr>
                </tbody>
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
        document.getElementById("fecha").setAttribute("max", maxDate);

        var todayDateMin = new Date();
        var mesMin = todayDateMin.getMonth() - 1;
        var anioMin = todayDateMin.getUTCFullYear();
        var diaMin = todayDateMin.getDate();
        if (mesMin < 10) {
            mesMin = "0" + mesMin
        }
        if (diaMin < 10) {
            diaMin = "0" + diaMin;
        }
        var minDate = anioMin + "-" + mesMin + "-" + diaMin;
        document.getElementById("fecha").setAttribute("min", minDate);
    </script>

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