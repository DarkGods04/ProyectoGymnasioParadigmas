<?php
include '../business/pagoMetodoBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Métodos de pago</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar este método de pago?");
        }
        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar este método de pago?");
        }
    </script>
</head>

<body>
    <?php include 'header.php';?>

    <h1>Métodos de pago</h1>
    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaPagoMetodo"></ul>
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

        $pagoMetodoBusiness = new PagoMetodoBusiness(); 
        $pagoMetodos = $pagoMetodoBusiness->buscar($campo);

        if (!empty($pagoMetodos)) {
        ?>
            <table border="1">
                <thead style="text-align: center;">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            
                <tbody>
                    <?php
                    foreach ($pagoMetodos as $row) {
                        if ($row->getActivoTBPagoMetodo() == 1){
                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/pagoMetodoAction.php">';
                            echo '<tr>';
                            echo '<input type="hidden" name="idPagoMetodo" id="idPagoMetodo" value="' . $row->getIDPagoMetodo() . '"/>';
                            echo '<td>' . $row->getIDPagoMetodo() . '</td>';
                            echo '<td><input type="text" pattern="^[a-zA-Z\u00c0-\u017F]+" name="nombrePagoMetodo" id="nombrePagoMetodo" value="' . $row->getNombreTBPagoMetodo() . '"/></td>';
                            echo '<td><input type="text" name="descripcionPagoMetodo" id="descripcionPagoMetodo" value="' . $row->getDescripcionTBPagoMetodo() . '"/></td>';

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
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron métodos de pago!</p>';
        }
        ?>
    </div></br>

    <div>
        <h3>Registrar un nuevo método de pago</h3>
        
        <form method="POST" id="direccionform" action="../business/pagoMetodoAction.php">
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" pattern="^[a-zA-Z\u00c0-\u017F]+" name="nombrePagoMetodo" placeholder="Nombre" value="<?php if(isset($_GET['nombrePagoMetodo'])){ echo $_GET['nombrePagoMetodo']; }?>"></td>
                        <td><input type="text" name="descripcionPagoMetodo" placeholder="Descripción" value="<?php if(isset($_GET['descripcionPagoMetodo'])){ echo $_GET['descripcionPagoMetodo']; }?>"></td>
                        <td><button type="submit" name="insertar" id="insertar" value="insertar">Registrar</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/pagoMetodoAction.php">
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