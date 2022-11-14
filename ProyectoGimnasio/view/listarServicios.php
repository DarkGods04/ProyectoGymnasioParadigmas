<?php
require_once '../business/servicioBusiness.php';
$servicioBusiness = new ServicioBusiness();
$serviciosss = $servicioBusiness->obtener();
$fechaActualizacionProxima = new DateTime(date('Y-m-d'));
$fechaActualizacionProxima = $fechaActualizacionProxima->format('Y-m-d');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Servicios</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar este servicio?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar este servicio?");
        }

        function confirmarActualizacionServicio(nombre, monto, dias) {
            return confirm("El servicio con el nombre " + nombre + " y monto = " + monto + " le corresponde una actualización el día de hoy\n ¿Desea realizar esta actualización en caso contrario se aplazara " + dias + " días más?");
        }
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="../js/jquery_formato.js"></script>
</head>

<body>
    <?php include 'header.php'; ?>
    <h1>Servicios</h1>
    <?php
    foreach ($serviciosss as $row) {
        if ($row->getActivoTBServicio() == 1) {
            if ($row->getFechaactualizacionTBServicio() == $fechaActualizacionProxima) {
                $id = $row->getIdTBServicio();
                $nom = $row->getNombreTBServicio();
                $descip = $row->getDescripcionTBServicio();
                $monto = $row->getMontoTBServicio();
                $dias = $row->getPeriodicidadTBServicio();

                $servicio = new Servicio(
                    $id,
                    $nom,
                    $descip,
                    $monto,
                    $row->getActivoTBServicio(),
                    $dias,
                    $row->getFechaactualizacionTBServicio()
                );
    ?>
                <script>
                    if (confirmarActualizacionServicio("<?php echo $nom ?>", "<?php echo $monto ?>", "<?php echo $dias ?>")) {
                        <?php
                        $servicioBusiness->aplazarActualizacion($servicio);
                        ?>
                    }
                </script>
    <?php
            }
        }
    }
    ?>
    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaServicio"></ul>
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
        $servicios = $servicioBusiness->buscar($campo);
        if (!empty($servicios)) {
        ?>
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Monto</th>
                        <th>Periodiocidad de actualización</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($servicios as $row) {

                        if ($row->getActivoTBServicio() == 1) {
                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/servicioAction.php">';
                            echo '<tr>';
                            echo '<input  type="hidden" name="idServicio" id="idServicio" value="' . $row->getIdTBServicio() . '"/>';
                            echo '<td>' . $row->getIdTBServicio() . '</td>';
                            echo '<td><input pattern="^[a-z A-Z\u00c0-\u017F]+" type="text" name="nombreServicio" id="nombreServicio" value="' . $row->getNombreTBServicio() . '"/></td>';
                            echo '<td><input  type="text" name="descripcionServicio" id="descripcionServicio" value="' . $row->getDescripcionTBServicio() . '"/></td>';
                            echo '<td><input  type="text" class="mascaramonto" name="montoServicio" id="montoServicio" value="' . $row->getMontoTBServicio() . '"/></td>';
                            echo '<td><select name="periodicidad" required>.';
                            echo '<option selected value=""hidden>Seleccione periodicidad</option>.';
                            if ($row->getPeriodicidadTBServicio() == 30) {
                                echo '<option selected value="30">Cada 30 días</option>.';
                            } else {
                                echo '<option value="30">Cada 30 días</option>.';
                            }
                            if ($row->getPeriodicidadTBServicio() == 60) {
                                echo '<option selected value="60">Cada 60 días</option>.';
                            } else {
                                echo '<option value="60">Cada 60 días</option>.';
                            }
                            if ($row->getPeriodicidadTBServicio() == 90) {
                                echo '<option selected value="90">Cada 90 días</option>.';
                            } else {
                                echo '<option value="90">Cada 90 días</option>.';
                            }
                            echo '</select></td>.';
                            echo '<input  type="hidden" name="fechaActualizacion" id="fechaActualizacion" value="' . $row->getFechaactualizacionTBServicio() . '"/>';
                            echo '<td><input type="submit" name="actualizar" id="actualizar" value="Actualizar" onclick="return confirmarAccionModificar()"/>';
                            echo '<input type="submit" name="eliminar" id="eliminar" value="Eliminar" onclick="return confirmarAccionEliminar()"/></td>';
                            echo '</tr>';
                            echo '</form>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron servicios!</p>';
        }
        ?>
    </div><br>

    <div>
        <h3>Registrar un nuevo servicio</h3>

        <form method="POST" id="direccionform" action="../business/servicioAction.php">
            <table border="1">
                <thead style="text-align: left;">
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Monto</th>
                    <th>Periodiocidad de actualización</th>
                    <th>Acción</th>
                </thead>

                <tbody>
                    <td><input type="text" pattern="^[a-z A-Z\u00c0-\u017F]+" name="nombreServicio" class="form-control" placeholder="Nombre del servicio" value="<?php if (isset($_GET['nombreServicio'])) {
                                                                                                                                                                        echo $_GET['nombreServicio'];
                                                                                                                                                                    } ?>"></td>
                    <td><input type="text" name="descripcionServicio" class="form-control" placeholder="Descripción del servicio" value="<?php if (isset($_GET['descripcionServicio'])) {
                                                                                                                                                echo $_GET['descripcionServicio'];
                                                                                                                                            } ?>"></td>
                    <td><input type="text" class="mascaramonto" name="montoServicio" class="form-control" placeholder="Monto del servicio" value="<?php if (isset($_GET['montoServicio'])) {
                                                                                                                                                        echo $_GET['montoServicio'];
                                                                                                                                                    } ?>"></td>
                    <td><select name="periodicidad" required>
                            <option value="" hidden>Seleccione periodicidad</option>
                            <option value="30">Cada 30 días</option>
                            <option value="60">Cada 60 días</option>
                            <option value="90">Cada 90 días</option>
                        </select></td>
                    <td><button type="submit" name="insertar" id="insertar" value="insertar">Registrar</button></td>
                </tbody>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/servicioAction.php">
            <tr>
                <td>
                    <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "emptyField") {
                            echo '<p style="color: red">Campo(s) vacio(s)</p>';
                        } else if ($_GET['error'] == "numberFormat") {
                            echo '<p style="color: red">Error, formato de numero!</p>';
                        } else if ($_GET['error'] == "dbError") {
                            echo '<center><p style="color: red">Error al procesar la transacción!</p></center>';
                        } else if ($_GET['error'] == "relationError") {
                            echo '<p style="color: red">Error al eliminar, el elemento tiene registros en otra(s) tabla(s)</p>';
                        } else if ($_GET['error'] == "dublicate") {
                            echo '<center><p style="color: red">Error al procesar la transacción, elemento duplicado!</p></center>';
                        }
                    } else if (isset($_GET['success'])) {
                        echo '<p style="color: green">Transacción realizada!</p>';
                    }
                    ?>
                </td>
            </tr>
        </form>
    </div>
</body>

</html>