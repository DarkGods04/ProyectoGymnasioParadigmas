<?php
include '../business/pagoModalidadBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Pago modalidad </title>

   <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar esta modalidad de pago?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar esta modalidad de pago?");
        }
    </script>

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
    <?php include 'header.php';?>

    <h1>Pago modalidad</h1>
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
        <h3>Registrar un nuevo tipo de pago modalidad </h3>

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
                        <td><button type="submit" name="insertar" id="insertar" value="insertar">Registrar pago modalidad</button></td>
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