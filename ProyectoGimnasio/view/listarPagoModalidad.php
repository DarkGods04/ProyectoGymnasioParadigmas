<?php
include '../business/pagoModalidadBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">    
    <title>Peridiocidad de pago</title>

   <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar esta modalidad de pago?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar esta modalidad de pago?");
        }
    </script>
</head>

<body>
    <?php include 'header.php';?>

    <h1>Periodos de pago</h1>
    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listarModalidadPago"></ul>
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
        $pagoModalidadBusiness = new PagoModalidadBusiness();
        $pagoModalidad = $pagoModalidadBusiness->buscar($campo);

        if (!empty($pagoModalidad)) {
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
                    foreach ($pagoModalidad as $row) {
                        if ($row->getActivoTBpagoModalidad() == 1) {

                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/pagoModalidadAction.php">';
                            echo '<tr>';
                            echo '<input type="hidden" name="idPagoModalidad" id="id" value="' . $row->getIdTBpagoModalidad() . '"/>';
                            echo '<td>' . $row->getIdTBpagoModalidad() . '</td>';
                            echo '<td><input type="text" name="nombreModalidad" id="nombreModalidad" value="' . $row->getNombreTBpagoModalidad() . '"/></td>';
                            echo '<td><input type="text" name="descripcionModalidad" id="descripcionModalidad" value="' . $row->getDescripcionTBpagoModalidad() . '"/></td>';
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
            echo '<p style="color: red">SIN RESULTADOS: No hay modalidades de pago registrados!</p>';
        }
        ?>
    </div></br>

    <div>
        <h3>Registrar un nuevo periodo de pago</h3>

        <form method="POST" id="direccionform" action="../business/pagoModalidadAction.php">
            <table border="1">
                <thead style="text-align: left;">

                    <tr>
                        <th>Nombre</th>
                        <th>Descripcíon</th >
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td><input type="text" name="nombre" placeholder="Nombre"></td>
                        <td><input type="text" name="descripcion" placeholder="Descripción"></td>
                        <td><button type="submit" name="insertar" id="insertar" value="insertar">Registrar</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/pagoModalidadAction.php">
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