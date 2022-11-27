<?php
include '../business/instructorBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Instructores</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar este instructor?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar este instructor?");
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
    <h1>Instructores</h1>

    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaInstructor"></ul>
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

        $instructorBusiness = new InstructorBusiness();
        $instructores = $instructorBusiness->buscar($campo);
        if (!empty($instructores)) {
        ?>
            <table border="1">
                <thead style="text-align: center;">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido(s)</th>
                        <th>Correo electrónico</th>
                        <th>Teléfono</th>
                        <th>Número de cuenta</th>
                        <th>Tipo de instructor</th>
                        <th>Acciones</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php
                    foreach ($instructores as $row) {
                        if ($row->getActivoTBInstructor() == 1) {
                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/instructorAction.php">';
                            echo '<tr>';
                            echo '<input type="hidden" name="idInstructor" id="id" value="' . $row->getIdTBInstructor() . '"/>';
                            echo '<td>' . $row->getIdTBInstructor() . '</td>';
                            echo '<td><input pattern="^[a-z A-Z\u00c0-\u017F]+" type="text" name="nombre" id="nombre" value="' . $row->getNombreTBInstructor() . '"/></td>';
                            echo '<td><input pattern="^[a-z A-Z\u00c0-\u017F]+" type="text" name="apellido" id="apellido" value="' . $row->getApellidoTBInstructor() . '"/></td>';
                            echo '<td><input type="text" pattern="\w.+@(gmail|est|una|hotmail|yahoo|outlook)+\.(com|es|org|cr|una.ac.cr|cr)+" name="correo" id="correo" value="' . $row->getCorreoTBInstructor() .  '"/></td>';
                            echo '<td><input type="text" class="mascaratelefono" name="telefono" id="telefono" value="' . $row->getTelefonoTBInstructor() .  '"/></td>';
                            echo '<td><input type="text" class="mascaranumcuenta" name="numcuenta" id="numcuenta" value="' . $row->getNumCuentaTBInstructor() .  '"/></td>';
                            echo '<td><select name="tipoinstructor" id="tipoinstructor">
                                    <option value="' . $row->getTipoTBInstructor() .  '">' . $row->getTipoTBInstructor() . '</option>
                                    <option value="Entrenador personal">Entrenador personal</option>
                                    <option value="Fisioterapeuta">Fisioterapeuta</option>
                                    <option value="Nutricionista">Nutricionista</option>
                                </select></td>';

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
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron instructores!</p>';
        }
        ?>
    </div></br>

    <div>
        <h3>Registrar un nuevo instructor</h3>
        
        <form method="POST" id="direccionform" action="../business/instructorAction.php">
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido(s)</th>
                        <th>Correo electrónico</th>
                        <th>Teléfono</th>
                        <th>Número de cuenta</th>
                        <th>Tipo de instructor</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" pattern="^[a-z A-Z\u00c0-\u017F]+" class="mascaranombre" name="nombre" placeholder="Nombre" value="<?php if(isset($_GET['nombre'])){ echo $_GET['nombre']; }?>"></td>
                        <td><input type="text" pattern="^[a-z A-Z\u00c0-\u017F]+" class="mascaranombre" name="apellido" placeholder="Apellido(s)" value="<?php if(isset($_GET['apellido'])){ echo $_GET['apellido']; }?>"></td>
                        <td><input type="text" pattern="\w.+@(gmail|est|una|hotmail|yahoo|outlook)+\.(com|es|org|cr|una.ac.cr|cr)+" name="correo" placeholder="micorreo@gmail.com" value="<?php if(isset($_GET['correo'])){ echo $_GET['correo']; }?>"></td>
                        <td><input type="tel" class="mascaratelefono" name="telefono" placeholder="Número de teléfono" value="<?php if(isset($_GET['telefono'])){ echo $_GET['telefono']; }?>"></td>
                        <td><input type="text" class="mascaranumcuenta" name="numcuenta" placeholder="Número de cuenta bancaria" value="<?php if(isset($_GET['numcuenta'])){ echo $_GET['numcuenta']; }?>"></td>
                        <td>
                            <select name="tipoinstructor">
                            <option value="<?php if(isset($_GET['tipoinstructor'])){ echo $_GET['tipoinstructor']; }?>"><?php if(isset($_GET['tipoinstructor'])){ echo $_GET['tipoinstructor']; }?></option>
                                <option value="Entrenador personal">Entrenador personal</option>
                                <option value="Fisioterapeuta">Fisioterapeuta</option>
                                <option value="Nutricionista">Nutricionista</option>
                            </select>
                        </td>
                        <td><button type="submit" name="insertar" id="insertar" value="insertar" onclick="validarEspacios()">Registrar instructor</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/instructorAction.php">
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
                        } else if ($_GET['error'] == "emailError"){
                            echo '<p style="color: red">Error de formato en correo!</p>';
                        } else if ($_GET['error'] == "relationError"){
                        echo '<p style="color: red">Error al eliminar, el usuario tiene registros en otra(s) tabla(s)</p>';
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