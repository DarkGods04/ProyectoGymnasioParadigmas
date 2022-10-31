<?php
include '../business/clienteBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Recuperar clientes</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar este cliente?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar este cliente?");
        }

        function confirmarAccionRecuperar() {
            return confirm("¿Está seguro de que desea reactivar este cliente?");
        }
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="../js/jquery_formato.js"></script>
</head>

<body>
    <?php include 'header.php'; ?><br>

    <h1>Recuperar clientes</h1>

    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaClientesDesactivados"></ul>
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

        $clienteBusiness = new ClienteBusiness();
        $clientes = $clienteBusiness->buscarRecuperar($campo);
        if (!empty($clientes)) {
        ?>
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Primer apellido</th>
                        <th>Segundo apellido</th>
                        <th>Correo electrónico</th>
                        <th>Teléfono</th>
                        <th>Fecha nacimiento</th>
                        <th>Género</th>
                        <th>Peso (Kg)</th>
                        <th>Altura (cm)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($clientes as $row) {
                        if ($row->getActivoTBCliente() != 1) {
                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/clienteAction.php">';
                            echo '<tr>';
                            echo '<input  type="hidden" name="idCliente" id="id" value="' . $row->getIdTBCliente() . '"/>';
                            echo '<td>' . $row->getIdTBCliente() . '</td>';
                            echo '<td><input pattern="^[a-zA-Z\u00c0-\u017F]+" type="text" name="nombre" id="nombre" value="' . $row->getNombreTBCliente() . '"/></td>';
                            echo '<td><input pattern="^[a-zA-Z\u00c0-\u017F]+" type="text" name="apellido1" id="apellido1" value="' . $row->getApellido1TBCliente() . '"/></td>';
                            echo '<td><input pattern="^[a-zA-Z\u00c0-\u017F]+" type="text" name="apellido2" id="apellido2" value="' . $row->getApellido2TBCliente() . '"/></td>';
                            echo '<td><input type="text" name="correo" id="correo" value="' . $row->getCorreoTBCliente() .  '"/></td>';
                            echo '<td><input type="text" class="mascaratelefono" name="telefono" id="telefono" value="' . $row->getTelefonoTBCliente() .  '"/></td>';
                            echo '<td><input type="date" name="fechaNacimiento" id="fechaNacimiento" value="' . $row->getFechaNacimientoTBCliente() .  '"/></td>';
                            echo '<td><select name="genero" id="genero">
                                    <option value="' . $row->getGeneroTBCliente() .  '">' . $row->getGeneroTBCliente() . '</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select></td>';
                            echo '<td><input type="text" class="mascarapeso" name="peso" id="peso" value="' . $row->getPesoTBCliente() .  '"/></td>';
                            echo '<td><input type="text" class="mascaraaltura" name="altura" id="altura" value="' . $row->getAlturaTBCliente() .  '"/></td>';
                            
                            echo '<td><input type="submit" name="recuperarCliente" id="recuperarCliente" value="Recuperar" onclick="return confirmarAccionRecuperar()"/></td>';
                            echo '</tr>';
                            echo '</form>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron clientes deshabilitados!</p>';
        }
        ?>
    </div></br>

    <div>
        <button><a href="listarClientes.php" style="text-decoration: none; color: blue; font-size: 140%;">Atrás</a></button>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/clienteAction.php">
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