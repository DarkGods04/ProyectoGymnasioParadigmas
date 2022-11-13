<?php
include '../business/proveedorBusiness.php';
include '../business/lineaProductosBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Proveedores</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar este proveedor?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar este proveedor?");
        }
    </script>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h1>Proveedores</h1>

    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaProveedor"></ul>
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

        $proveedorBusiness = new ProveedorBusiness();
        $proveedores = $proveedorBusiness->buscar($campo);
        if (!empty($proveedores)) {
        ?>
            <table border="1">
                <thead style="text-align: center;">
                    <tr>
                        <th>ID</th>
                        <th>Nombre completo</th>
                        <th>Casa comercial</th>
                        <th>Línea de productos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($proveedores as $row) {
                        if ($row->getActivoTBProveedor() == 1) {
                        
                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/proveedorAction.php">';
                            echo '<tr>';
                            echo '<input  type="hidden" name="idProveedor" id="idProveedor" value="' . $row->getIdTBProveedor() . '"/>';
                            echo '<td>' . $row->getIdTBProveedor() . '</td>';
                            echo '<td><input pattern="^[a-z A-Z\u00c0-\u017F]+" type="text" name="nombreProveedor" id="nombreProveedor" value="' . $row->getNombreCompletoTBProveedor() . '"/></td>';
                            echo '<td><input type="text" name="casaComercialProveedor" id="casaComercialProveedor" value="' . $row->getCasaComercialTBProveedor() .  '"/></td>';
                        ?>

                        <td>
                            <?php
                            $lineaProductosBusiness = new LineaProductosBusiness();
                            $lineasProductos = $lineaProductosBusiness->obtener();
                            ?>
                            <select name="idLineaProductos">
                            <?php foreach($lineasProductos as $rowTemp){ 
                                if($rowTemp->getIdTBCatalogoLineaProductos() == $row->getIdLineaProductosTBCatalogoLineaProductos()){
                                    echo '<option value="' .$rowTemp->getIdTBCatalogoLineaProductos() .'">'.$rowTemp->getNombreTBCatalogoLineaProductos().'</option>';
                                }
                            } ?>
                            <?php foreach($lineasProductos as $row1){ 
                                    echo '<option value="' .$row1->getIdTBCatalogoLineaProductos() .'">'.$row1->getNombreTBCatalogoLineaProductos().'</option>';
                            } ?>
                            </select>
                        </td>

                       <?php
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
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron proveedores!</p>';
        }
        ?>
    </div><br>

    <div>
        <h3>Registrar un nuevo proveedor</h3>

        <form method="POST" id="direccionform" action="../business/proveedorAction.php">
            <table border="1">
                <thead style="text-align: left;">
                <tr>
                    <th>Nombre completo</th>
                    <th>Casa comercial</th>
                    <th>Línea de productos</th>
                    <th>Acciones</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td><input type="text" pattern="^[a-z A-Z\u00c0-\u017F]+" name="nombreProveedor" placeholder="Nombre completo" value="<?php if(isset($_GET['nombreProveedor'])){ echo $_GET['nombreProveedor']; }?>"></td>
                    <td><input type="text" name="casaComercialProveedor" placeholder="Casa comercial" value="<?php if(isset($_GET['casaComercialProveedor'])){ echo $_GET['casaComercialProveedor']; }?>"></td>
                    <td>
                        <?php
                        $lineaProductosBusiness = new LineaProductosBusiness();
                        $lineasProductos = $lineaProductosBusiness->obtener();
                        ?>
                        <select name="idLineaProductos">
                        <option value="<?php if(isset($_GET['idLineaProductos'])){foreach ($lineasProductos as $row4){ if($_GET['idLineaProductos'] == $row4->getIdTBCatalogoLineaProductos()){echo $_GET['idLineaProductos'];}}}?>"><?php if(isset($_GET['idLineaProductos'])){foreach ($lineasProductos as $row4){ if($_GET['idLineaProductos'] == $row4->getIdTBCatalogoLineaProductos()){echo $row4->getNombreTBCatalogoLineaProductos();}}}?></option>
                            <?php foreach($lineasProductos as $row):
                                if($row->getActivoTBCatalogoLineaProductos() == 1){
                                ?>
                                <?php echo '<option value="'. $row->getIdTBCatalogoLineaProductos().'">'. $row->getNombreTBCatalogoLineaProductos().'</option>' ?>
                                <?php
                                } endforeach ?>
                        </select>
                    </td>
                    
                    <td><button type="submit" name="insertar" id="insertar" value="insertar">Registrar</button></td>
                    <tr>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/proveedorAction.php">
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