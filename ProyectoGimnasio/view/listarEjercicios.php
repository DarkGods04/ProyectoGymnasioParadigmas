<?php
include '../business/ejercicioBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Ejercicios</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar este ejercicio?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar este ejercicio?");
        }
    </script>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <h1>Ejercicios</h1>

    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaEjercicios"></ul>
        </div>
    </form><br></br>
    <script src="../js/peticiones.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="../js/jquery_formato.js"></script>    

    <div>
        <?php
        if (!isset($_POST['campo'])) {
            $_POST['campo'] = "";
            $campo = $_POST['campo'];
        }
        $campo = $_POST['campo'];

        $ejercicioBusiness = new EjercicioBusiness();
        $ejercicios = $ejercicioBusiness->buscar($campo);
        if (!empty($ejercicios)) {
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
                    foreach ($ejercicios as $row) {
                        if ($row->getActivoEjercicio() == 1) {
                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/ejercicioAction.php">';
                            echo '<tr>';
                            echo '<input  type="hidden" name="idEjercicio" id="id" value="' . $row->getIdEjercicio() . '"/>';
                            echo '<td>' . $row->getIdEjercicio() . '</td>';
                            echo '<td><input class="mascaraejercicio" type="text" pattern="^[a-z A-Z\u00c0-\u017F]+" name="nombre" id="nombre" value="' . $row->getNombreEjercicio() . '"/></td>';
                            echo '<td><input  type="text" name="descripcion" id="descripcion" value="' . $row->getDescripcionEjercicio() . '"/></td>';

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
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron ejercicios!</p>';
        }
        ?>
    </div><br>

    <div>
        <h3>Registrar un nuevo ejercicio</h3>

        <form method="POST" id="direccionform" action="../business/ejercicioAction.php">
            <table border="1">
                <thead style="text-align: left;">
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acción</th>
                </thead>
                <tbody>
                    <td><input class="mascaraejercicio" pattern="^[a-z A-Z\u00c0-\u017F]+" type="text" name="nombre" placeholder="nombre" value="<?php if(isset($_GET['nombre'])){ echo $_GET['nombre']; }?>"></td>
                    <td><input type="text" name="descripcion" placeholder="Descripción" value="<?php if(isset($_GET['descripcion'])){ echo $_GET['descripcion']; }?>"></td>
                    <td><button type="submit" name="insertar" id="insertar" value="insertar">Registrar</button></td>
                </tbody>
            </table>
        </form>

      
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/ejercicioAction.php">
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
                        } else if ($_GET['error'] == "existe"){
                            echo '<p style="color: red">La palabra ya existe!</p>';
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