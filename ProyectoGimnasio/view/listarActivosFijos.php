<?php
include '../business/activoFijoBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Activos fijos</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar este activo?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar este activo?");
        }

        function confirmarVolverMenuPrincipal() {
            return confirm("¿Está seguro de que desea volver al menú de activos?");
        }
    </script>
    <script src="../js/peticiones.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="../js/jquery_formato.js"></script>
</head>

<body>
    <a onclick="return confirmarVolverMenuPrincipal()" href="menuListarActivos.php" style="text-decoration: none; color: blue; font-size: 150%;">Menú de activos</a>
    <h1>Activos fijos</h1>

    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaActivosFijos"></ul>
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

        $activoBusiness = new ActivoFijoBusiness();
        $activos = $activoBusiness->buscar($campo);
        if (!empty($activos)) {
        ?>
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>ID</th>
                        <th>Placa</th>
                        <th>Número serie</th>
                        <th>Modelo</th>
                        <th>Fecha compra</th>
                        <th>Monto compra</th>
                        <th>Estado de uso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($activos as $row) {
                        if ($row->getActivo() == 1) {
                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/activoFijoAction.php">';
                            echo '<tr>';
                            echo '<input  type="hidden" name="idActivo" id="id" value="' . $row->getIdActivo() . '"/>';
                            echo '<td>' . $row->getIdActivo() . '</td>';
                            echo '<td><input  type="text" name="placa" id="placa" value="' . $row->getPlaca() . '"/></td>';
                            echo '<td><input  type="text" name="serie" id="serie" value="' . $row->getSerie() . '"/></td>';
                            echo '<td><input type="text" name="modelo" id="modelo" value="' . $row->getModelo() .  '"/></td>';
                            echo '<td><input type="date" name="fechaCompra" id="fechaCompra" value="' . $row->getFechaCompra() .  '"/></td>';
                            echo '<td><input type="text" class="mascaramonto" name="montoCompra" id="montoCompra" value="'. $row->getMontoCompra() . '"/></td>';
                            echo '<td><select name="estadoUso" id="estadoUso">
                                    <option value="' . $row->getEstadoUso() .  '">' . $row->getEstadoUso() . '</option>
                                    <option value="En uso">En uso</option>
                                    <option value="Fuera de uso">Fuera de uso</option>
                                </select></td>';

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
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron activos fijos!</p>';
        }
        ?>
    </div><br>

    <div>
        <h3>Registrar un nuevo activo fijo</h3>

        <form method="POST" id="direccionform" action="../business/activoFijoAction.php">
            <table border="1">
                <thead style="text-align: left;">
                    <th>Placa</th>
                    <th>Número serie</th>
                    <th>Modelo</th>
                    <th>Fecha compra</th>
                    <th>Monto compra</th>
                    <th>Estado de uso</th>
                    <th>Acción</th>
                </thead>

                <tbody>
                    <td><input type="text" name="placa" placeholder="Placa del activo"></td>
                    <td><input type="text" name="serie" placeholder="Número de serie"></td>
                    <td><input type="text" name="modelo" placeholder="Modelo del equipo"></td>
                    <td><input type="date" name="fechaCompra"></td>
                    <td><input type="text" class="mascaramonto" name="montoCompra" placeholder="Monto de compra"></td>
                    <td>
                        <select name="estadoUso">
                            <option value="" selected disabled hidden>Estado de uso</option>
                            <option value="En uso">En uso</option>
                            <option value="Fuera de uso">Fuera de uso</option>
                        </select>
                    </td>
                    <td><button type="submit" name="insertar" id="insertar" value="insertar">Registrar activo</button></td>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/activoFijoAction.php">
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