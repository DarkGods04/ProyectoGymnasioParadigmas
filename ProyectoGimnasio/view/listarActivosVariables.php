<?php include("../business/activoVariableBusiness.php"); ?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activos variables</title>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="../js/jquery_formato.js"></script>

    <style type="text/css">
        ul {
            list-style-type: none;
            width: 300px;
            height: auto;
            position: absolute;
            margin-top: 10px;
            margin-left: 10px;
        }

        li {
            background-color: #EEEEEE;
            border-top: 1px solid #9e9e9e;
            padding: 5px;
            width: 100%;
            float: left;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <a onclick="return confirmarVolverMenuPrincipal()" href="menuListarActivos.php" style="text-decoration: none; color: blue; font-size: 150%;">Menú de activos</a>
    <h1>Activos variables</h1>

    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaActivosVariables"></ul>
        </div>
    </form><br></br>
    <script src="../js/peticiones.js"></script>

    <div>
        <?php
        if (!isset($_POST['campo'])) {
            $_POST['campo'] = "";
            $campo = $_POST['campo'];
        }
        $campo = $_POST['campo'];

        $activoVariableBusiness = new ActivoVariableBusiness();
        $activos = $activoVariableBusiness->buscar($campo);
        if (!empty($activos)) {
        ?>
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>ID</th>
                        <th>Nombre activo</th>
                        <th>Descripción</th>
                        <th>Cantidad en existencia</th>
                        <th>Monto compra</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($activos as $row) {
                        if ($row->getActivoTBActivo() == 1) {
                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/activoVariableAction.php">';
                            echo '<tr>';
                            echo '<input  type="hidden" name="idActivo" id="id" value="' . $row->getIdTBActivo() . '"/>';
                            echo '<td>' . $row->getIdTBActivo() . '</td>';
                            echo '<td><input  type="text" name="name" id="name" value="' . $row->getNameTBActivo() . '"/></td>';
                            echo '<td><input  type="text" name="descripcion" id="descripcion" value="' . $row->getDescripcionTBActivo() . '"/></td>';
                            echo '<td><input class="mascaracantidad" type="text" name="cantidad" id="cantidad" value="' . $row->getCantidadTBActivo() . '"/></td>';
                            echo '<td><input type="text" class="mascaramonto" name="montoCompra" id="montoCompra" value="' . $row->getMontoCompraTBActivo() . '"/></td>';
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
            echo '<p style="color: red">SIN RESULTADOS: No hay activos variables registrados!</p>';
        }
        ?>
    </div><br>

    <div>
        <h3>Registrar un nuevo activo variable</h3>

        <form method="POST" id="direccionform" action="../business/activoVariableAction.php">
            <table border="1">
                <thead style="text-align: left;">
                    <th>Nombre activo</th>
                    <th>Descripción</th>
                    <th>Cantidad en existencia</th>
                    <th>Monto Compra</th>
                    <th>Acción</th>
                </thead>

                <tbody>
                    <td><input type="text" name="name" class="form-control" placeholder="Nombre del activo" autofocus></td>
                    <td><input type="text" name="descripcion" class="form-control" placeholder="Descripción del activo" autofocus></td>
                    <td><input type="text" class="mascaracantidad" name="cantidad" class="form-control" placeholder="Cantidad" autofocus></td>
                    <td><input type="text" class="mascaramonto" name="montoCompra" class="form-control" placeholder="Monto de compra" autofocus></td>
                    <td><button type="submit" name="insertar" id="insertar" value="insertar">Registrar</button></td>
                </tbody>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/activoVariableAction.php">
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