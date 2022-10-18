<?php
include '../business/modalidadFuncionalBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Modalidad funcional</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar esta modalidad funcional?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar esta modalidad funcional?");
        }
    </script>
    
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h1>Modalidad funcional</h1>

    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaModalidadFuncional"></ul>
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

        $modalidadFuncionalBusiness = new ModalidadFuncionalBusiness();
        $modalidadesFuncionales = $modalidadFuncionalBusiness->buscar($campo);
        if (!empty($modalidadesFuncionales)) {
        ?>
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($modalidadesFuncionales as $row) {
                        if ($row->getActivoTBModalidadFuncional() == 1) {
                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/modalidadFuncionalAction.php">';
                            echo '<tr>';
                            echo '<input  type="hidden" name="idModalidadFuncional" id="idModalidadFuncional" value="' . $row->getIdTBModalidadFuncional() . '"/>';
                            echo '<td>' . $row->getIdTBModalidadFuncional() . '</td>';
                            echo '<td><input  type="text" name="nombreModalidadFuncional" id="nombreModalidadFuncional" value="' . $row->getNombreTBModalidadFuncional() . '"/></td>';
                            echo '<td><input  type="text" name="descripcionModalidadFuncional" id="descripcionModalidadFuncional" value="' . $row->getDescripcionTBModalidadFuncional() . '"/></td>';
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
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron modalidades funcionales!</p>';
        }
        ?>
    </div><br>

    <div>
        <h3>Registrar una nueva modalidad funcional</h3>

        <form method="POST" id="direccionform" action="../business/modalidadFuncionalAction.php">
            <table border="1">
                <thead style="text-align: left;">
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acción</th>
                </thead>

                <tbody>
                    <td><input type="text" name="nombreModalidadFuncional" class="form-control" placeholder="Nombre de la modalidad funcional"></td>
                    <td><input type="text" name="descripcionModalidadFuncional" class="form-control" placeholder="Descripción de la modalidad funcional"></td>
                    <td><button type="submit" name="insertar" id="insertar" value="insertar">Registrar</button></td>
                </tbody>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/modalidadFuncionalAction.php">
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