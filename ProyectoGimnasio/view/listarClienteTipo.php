<?php
include '../business/clienteTipoBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Tipos de clientes</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar este tipo de cliente?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar este tipo de cliente?");
        }
    </script>
</head>

<body>
    <?php include 'header.php'; ?>
    <h1>Tipos de clientes </h1>
    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listarClienteTipos"></ul>
        </div>
    </form></br></br>
    <div>
        <?php
        if (!isset($_POST['campo'])) {
            $_POST['campo'] = "";
            $campo = $_POST['campo'];
        }
        $campo = $_POST['campo'];
        $clienteTipoBusiness = new ClienteTipoBusiness();
        $clienteTiposLista = $clienteTipoBusiness->buscar($campo);

        if (!empty($clienteTiposLista)) {
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
                    foreach ($clienteTiposLista as $row) {
                        if ($row->getActivoTBClienteTipo() == 1) {

                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/clienteTipoAction.php">';
                            echo '<tr>';
                            echo '<input type="hidden" name="idClienteTipo" id="idClienteTipo" value="' . $row->getIDClienteTipo() . '"/>';
                            echo '<td>' . $row->getIDClienteTipo() . '</td>';
                            echo '<td><input type="text" pattern="^[a-z A-Z\u00c0-\u017F]+" name="nombreClienteTipo" id="nombreClienteTipo" value="' . $row->getNombreTBClienteTipo() . '"/></td>';
                            echo '<td><input type="text" name="descripcionClienteTipo" id="descripcionClienteTipo" value="' . $row->getDescripcionTBClienteTipo() . '"/></td>';

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
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron tipos de clientes!</p>';
        }
        ?>
    </div></br>

    <div>
        <h3>Registrar un nuevo tipo de cliente </h3>
        <form method="POST" id="direccionform" action="../business/clienteTipoAction.php">
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" pattern="^[a-z A-Z\u00c0-\u017F]+" name="nombreClienteTipo" id="campo2" placeholder="Nombre" value="<?php if(isset($_GET['nombreClienteTipo'])){ echo $_GET['nombreClienteTipo']; }?>"></td>
                        <ul id="listarClienteTipos2"></ul>
                        <td><input type="text" name="descripcionClienteTipo" placeholder="Descripción" value="<?php if(isset($_GET['descripcionClienteTipo'])){ echo $_GET['descripcionClienteTipo']; }?>"></td>
                        <td><button type="submit" name="insertar" id="insertar" value="insertar">Registrar</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/clienteTipoAction.php">
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
                            echo '<center><p style="color: red">¡Este tipo de cliente ya existe, intente de nuevo con otro nombre!</p></center>';
                        }
                        else if ($_GET['error'] == "dublicate") {
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
    <script src="../js/peticiones.js"></script>
</body>

</html>