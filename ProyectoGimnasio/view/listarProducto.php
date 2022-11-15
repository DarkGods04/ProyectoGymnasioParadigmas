<?php
include '../business/productoBusiness.php';
include '../business/lineaProductosBusiness.php';

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Productos</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar este producto?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar este producto?");
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
    <h1>productos</h1>

    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaProductos"></ul>
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
        $lineas = $lineaProductosBusiness->obtener();



        $productoBusiness = new ProductoBusiness();
        $productos = $productoBusiness->buscar($campo);
      
        if (!empty($productos)) {
        ?>
            <table border="1">
                <thead style="text-align: center;">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Linea de producto</th>
                        <th>Precio de compra</th>
                        <th>Precio de venta</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($productos as $row) {
                        if ($row->getActivoTBProducto() == 1) {
                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/productoAction.php">';
                            echo '<tr>';
                            echo '<input type="hidden" name="idproducto" id="id" value="' . $row->getIdTBProducto() . '"/>';
                            echo '<td>' . $row->getIdTBProducto() . '</td>';
                            echo '<td><input pattern="^[a-z A-Z\u00c0-\u017F]+" type="text" name="nombre" id="nombre" value="' . $row->getNombreTBProducto() . '"/></td>';
                            echo '<td><input pattern="^[a-z A-Z\u00c0-\u017F]+" type="text" name="descripcion" id="descripcion" value="' . $row->getDescripcionTBProducto() . '"/></td>';


                            ?>

                            <td>
                           
                            <select name="lineaproductoid">
                        <?php foreach($lineas as $row2){ 
                        if($row2->getIdTBCatalogoLineaProductos() == $row->getIdLineaProductosTBProducto()){
                              echo '<option value="' .$row2->getIdTBCatalogoLineaProductos() .'">'.$row2->getNombreTBCatalogoLineaProductos().'</option>';
                           }
                        } ?>
                        <?php foreach($lineas as $row1){ 
                           echo '<option value="' .$row1->getIdTBCatalogoLineaProductos() .'">'.$row1->getNombreTBCatalogoLineaProductos().'</option>';
                             } ?>
                           </select>
                            </td>

                            <?php

                            echo '<td><input type="text"  class="mascaramonto" name="preciocompra" id="preciocompra" value="' . $row->getPrecioCompraTBProducto() .  '"/></td>';
                            echo '<td><input type="text"  class="mascaramonto"   name="precioventa" id="precioventa" value="' . $row->getPrecioVentaTBProducto() .  '"/></td>';
                            echo '<td><input type="text"  name="cantidad" id="cantidad" value="' . $row->getCantidadTBProducto() .  '"/></td>';
                           
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
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron productos!</p>';
        }
        ?>
    </div></br>

    <div>
        <h3>Registrar un nuevo producto</h3>
        
        <form method="POST" id="direccionform" action="../business/productoAction.php">
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Linea de producto</th>
                        <th>Precio de compra</th>
                        <th>Precio de venta</th>
                        <th>Cantidad</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" pattern="^[a-z A-Z\u00c0-\u017F]+" class="mascaranombre" name="nombre" placeholder="Nombre" value="<?php if(isset($_GET['nombre'])){ echo $_GET['nombre']; }?>"></td>
                        <td><input type="text" pattern="^[a-z A-Z\u00c0-\u017F]+" class="mascaranombre" name="descripcion" placeholder="Descripcion" value="<?php if(isset($_GET['descripcion'])){ echo $_GET['descripcion']; }?>"></td>

                        <td>

                        <?php
                   $lineaProductosBusiness = new LineaProductosBusiness();
                   $lineas = $lineaProductosBusiness->obtener();
                    ?>

                        <select name="lineaproductoid">
                       
                            <?php foreach($lineas as $row5):
                                  if($row5->getActivoTBCatalogoLineaProductos() == 1){
                                ?>
                                <?php echo '<option value="'. $row5->getIdTBCatalogoLineaProductos().'">'. $row5->getNombreTBCatalogoLineaProductos().'</option>' ?>
                                <?php
                                } endforeach ?>
                        </select>
                                
                            </td>

                        <td><input type="text"  class="mascaramonto" name="preciocompra" placeholder="Precio de compra" value="<?php if(isset($_GET['preciocompra'])){ echo $_GET['preciocompra']; }?>"></td>
                        <td><input type="text"  class="mascaramonto" name="precioventa" placeholder="Precio de venta" value="<?php if(isset($_GET['precioventa'])){ echo $_GET['precioventa']; }?>"></td>
                        <td><input type="number" name="cantidad" placeholder="Cantidad de producto" value="<?php if(isset($_GET['cantidad'])){ echo $_GET['cantidad']; }?>"></td>
                        <td><button type="submit" name="insertar" id="insertar" value="insertar" onclick="validarEspacios()">Registrar producto</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/productoAction.php">
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