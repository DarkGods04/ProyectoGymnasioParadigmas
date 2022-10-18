<?php
include '../business/servicioBusiness.php';
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
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="../js/jquery_formato.js"></script>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h1>Servicios</h1>

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

        $servicioBusiness = new servicioBusiness();
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
                            echo '<input  type="hidden" name="anteriorMontoServicio" id="anteriorMontoServicio" value="' . $row->getMontoTBServicio() . '"/>';
                            echo '<td>' . $row->getIdTBServicio() . '</td>';
                            echo '<td><input class="mascaranombre" type="text" name="nombreServicio" id="nombreServicio" value="' . $row->getNombreTBServicio() . '"/></td>';
                            echo '<td><input  type="text" name="descripcionServicio" id="descripcionServicio" value="' . $row->getDescripcionTBServicio() . '"/></td>';
                            echo '<td><input  type="text" class="mascaramonto" name="montoServicio" id="montoServicio" value="' . $row->getMontoTBServicio() . '"/></td>';
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
                    <th>Acción</th>
                </thead>

                <tbody>
                    <td><input type="text" class="mascaranombre" name="nombreServicio" class="form-control" placeholder="Nombre del servicio"></td>
                    <td><input type="text" name="descripcionServicio" class="form-control" placeholder="Descripción del servicio"></td>
                    <td><input type="text" class="mascaramonto" name="montoServicio" class="form-control" placeholder="Monto del servicio"></td>
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