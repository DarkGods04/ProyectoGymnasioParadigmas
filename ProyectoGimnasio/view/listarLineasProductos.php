<?php
include '../business/lineaProductosBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Líneas de productos</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar esta línea de productos?");
        }
        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar esta línea de productos?");
        }
    </script>
</head>

<body>
    <?php include 'header.php'; ?>

    <h1>Líneas de productos</h1>
    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaLineaProductos"></ul>
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

        $lineaProductosBusiness = new LineaProductosBusiness();
        $lineaProductos = $lineaProductosBusiness->buscar($campo);

        if (!empty($lineaProductos)) {
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
                    foreach ($lineaProductos as $row) {
                        if ($row->getActivoTBCatalogoLineaProductos() == 1) {

                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/lineaProductosAction.php">';
                            echo '<tr>';
                            echo '<input type="hidden" name="idLineaProductos" id="idLineaProductos" value="' . $row->getIdTBCatalogoLineaProductos() . '"/>';
                            echo '<td>' . $row->getIdTBCatalogoLineaProductos() . '</td>';
                            echo '<td><input type="text" pattern="^[a-z A-Z\u00c0-\u017F]+" name="nombreLineaProductos" id="nombreLineaProductos" value="' . $row->getNombreTBCatalogoLineaProductos() . '"/></td>';
                            echo '<td><input type="text" name="descripcionLineaProductos" id="descripcionLineaProductos" value="' . $row->getDescripcionTBCatalogoLineaProductos() . '"/></td>';

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
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron líneas de productos!</p>';
        }
        ?>
    </div></br>

    <div>
        <h3>Registrar una nueva línea de productos</h3>

        <form method="POST" id="direccionform" action="../business/lineaProductosAction.php">
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
                    <td><input type="text" pattern="^[a-z A-Z\u00c0-\u017F]+" name="nombreLineaProductos"  id="campo2" placeholder="Nombre" value="<?php if(isset($_GET['nombreLineaProductos'])){ echo $_GET['nombreLineaProductos']; }?>"></td>
                    <ul id="listaLineaProductos2"></ul>
                        <td><input type="text" name="descripcionLineaProductos" placeholder="Descripción" value="<?php if(isset($_GET['descripcionLineaProductos'])){ echo $_GET['descripcionLineaProductos']; }?>"></td>
                        <td><button type="submit" name="insertar" id="insertar" value="insertar">Registrar</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/lineaProductosAction.php">
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
                        } else if ($_GET['error'] == "relationError"){
                            echo '<p style="color: red">Error al eliminar, el elemento se encuentra registrado en otra(s) tabla(s)</p>';
                        } else if ($_GET['error'] == "existe") {
                            echo '<center><p style="color: red">¡Esta línea de productos ya se encuentra registrada en el sistema!</p></center>';
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