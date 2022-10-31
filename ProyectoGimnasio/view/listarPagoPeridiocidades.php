<?php
include '../business/pagoPeridiocidadBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Peridiocidades de pago</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar esta peridiocidad de pago?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar esta peridiocidad de pago?");
        }
    </script>
</head>

<body>
    <?php include 'header.php'; ?>

    <h1>Peridiocidades de pago </h1>
    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listarPagoPeridiocidad"></ul>
        </div>
    </form></br></br>
    <div>
        <?php
        if (!isset($_POST['campo'])) {
            $_POST['campo'] = "";
            $campo = $_POST['campo'];
        }
        $campo = $_POST['campo'];
        $pagoPeridiocidadBusiness = new PagoPeridiocidadBusiness();
        $pagoPeridiocidades = $pagoPeridiocidadBusiness->buscar($campo);

        if (!empty($pagoPeridiocidades)) {
        ?>
            <table border="1">
                <thead style="text-align: center;">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcíon</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($pagoPeridiocidades as $row) {
                        if ($row->getActivoTBPagoPeridiocidad() == 1) {

                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/pagoPeridiocidadAction.php">';
                            echo '<tr>';
                            echo '<input type="hidden" name="idPagoPeridiocidad" id="idPagoPeridiocidad" value="' . $row->getIdTBPagoPeridiocidad() . '"/>';
                            echo '<td>' . $row->getIdTBPagoPeridiocidad() . '</td>';
                            echo '<td><input type="text" pattern="^[a-zA-Z\u00c0-\u017F]+" name="nombrePagoPeridiocidad" id="nombrePagoPeridiocidad" value="' . $row->getNombreTBPagoPeridiocidad() . '"/></td>';
                            echo '<td><input type="text" name="descripcionPagoPeridiocidad" id="descripcionPagoPeridiocidad" value="' . $row->getDescripcionTBPagoPeridiocidad() . '"/></td>';

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
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron peridiocidades de pago!</p>';
        }
        ?>
    </div></br>

    <div>
        <h3>Registrar una nueva peridiocidad de pago </h3>

        <form method="POST" id="direccionform" action="../business/pagoPeridiocidadAction.php">
            <table border="1">
                <thead style="text-align: left;">

                    <tr>
                        <th>Nombre</th>
                        <th>Descripcíon</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" pattern="^[a-zA-Z\u00c0-\u017F]+" name="nombrePagoPeridiocidad" id="campo2" placeholder="Nombre"></td>
                        <ul id="listarPagoPeridiocidad2"></ul>
                        <td><input type="text" name="descripcionPagoPeridiocidad" placeholder="Descripción"></td>
                        <td><button type="submit" name="insertar" id="insertar" value="insertar">Registrar</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/pagoPeridiocidadAction.php">
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
                        } else if ($_GET['error'] == "existe") {
                            echo '<center><p style="color: red">¡Esta periodicidad de pago ya existe, intente de nuevo con otro nombre!</p></center>';
                        }
                    } else if (isset($_GET['success'])) {
                        echo '<p style="color: green">Transacción realizada!</p>';
                    }
                    ?>
                </td>
            </tr>
        </form>
    </div>
    <script src="../js/peticiones.js"></script>
</body>

</html>