<?php
include '../business/clienteBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
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

    <script>
        function validarCorreo(correo) {
            var cadena = /^\w+([\.-]?\w+)*@(?:|hotmail|outlook|yahoo|live|gmail|est.una|una)\.(?:|com|es|ac.cr|cr)+$/.test(campo.value);
            var esValido = cadena.test(correo);
            if (esValido == false) {
                alert('El correo ingresado es invalido');
            }
        }

        function validarLetras(nombre) {
            var cadena = /^[a-zA-ZÀ-ÿ\s]{1,40}$/;
            var esValido = cadena.test(nombre);
            if (esValido == false) {
                alert('El correo ingresado es invalido');
            }
        }

        function validarLetras(apellido1) {
            var cadena = /^[a-zA-ZÀ-ÿ\s]{1,40}$/;
            var esValido = cadena.test(apellido1);
            if (esValido == false) {
                alert('El correo ingresado es invalido');
            }
        }

        function validarLetras(apellido2) {
            var cadena = /^[a-zA-ZÀ-ÿ\s]{1,40}$/;
            var esValido = cadena.test(apellido2);
            if (esValido == false) {
                alert('El correo ingresado es invalido');
            }
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
    <?php
    include 'header.php';
    ?>
    <h1>Clientes</h1>




    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaClientes"></ul>
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
        $clientes = $clienteBusiness->buscar($campo);
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
                        <th>Peso</th>
                        <th>Altura</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($clientes as $row) {
                        if ($row->getActivoTBCliente() == 1) {
                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/clienteAction.php">';
                            echo '<tr>';
                            echo '<input  type="hidden" name="idCliente" id="id" value="' . $row->getIdTBCliente() . '"/>';
                            echo '<td>' . $row->getIdTBCliente() . '</td>';
                            echo '<td><input class="mascaranombre" type="text" name="nombre" id="nombre" value="' . $row->getNombreTBCliente() . '"/></td>';
                            echo '<td><input class="mascaranombre" type="text" name="apellido1" id="apellido1" value="' . $row->getApellido1TBCliente() . '"/></td>';
                            echo '<td><input class="mascaranombre" type="text" name="apellido2" id="apellido2" value="' . $row->getApellido2TBCliente() . '"/></td>';
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
                            echo '<td><input type="submit" name="actualizarCliente" id="actualizarCliente" value="Actualizar" onclick="return confirmarAccionModificar()"/>';

                            echo '<input type="submit" name="eliminarCliente" id="eliminarCliente" value="Eliminar" onclick="return confirmarAccionEliminar()"/></td>';
                            echo '</tr>';
                            echo '</form>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo '<p style="color: red">SIN RESULTADOS: No hay clientes registrados!</p>';
        }
        ?>
    </div></br>

    <div>
        <h3>Registrar un nuevo cliente</h3>

        <form method="POST" id="direccionform" action="../business/clienteAction.php">
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>Nombre</th>
                        <th>Primer apellido</th>
                        <th>Segundo apellido</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>Fecha nacimiento</th>
                        <th>Genero</th>
                        <th>Peso</th>
                        <th>Altura</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="mascaranombre" name="nombre" id="nombre" placeholder="Nombre" onclick="validarCorreo(document.getElementByID('nombre').value)"></td>
                        <td><input type="text" class="mascaranombre" name="apellido1" id="apellido1" placeholder="Primer apellido" onclick="validarCorreo(document.getElementByID('apellido1').value)"></td>
                        <td><input type="text" class="mascaranombre" name="apellido2" id="apellido2" placeholder="Segundo apellido" onclick="validarCorreo(document.getElementByID('apellido2').value)"></td>

                        <td><input type="email" name="correo" id="correo" placeholder="micorreo@gmail.com" onclick="validarCorreo(document.getElementByID('correo').value)"></td>
                        <td><input type="text" class="mascaratelefono" name="telefono" id="telefono" placeholder="0000-0000"></td>
                        <td><input type="date" name="fechaNacimiento" id="fechaNacimiento" placeholder="Fecha de nacimiento"></td>
                        <td>
                            <select name="genero">
                                <option value="" selected disabled hidden>Género</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </td>
                        <td><input type="text" class="mascarapeso" name="peso" id="peso" placeholder="00.00kg"></td>
                        <td><input type="text" class="mascaraaltura" name="altura" id="altura" placeholder="0.00m"></td>
                        <td><button type="submit" name="insertarCliente" id="insertarCliente" value="insertarCliente">Registrar cliente</button></td>
                    </tr>
                </tbody>
            </table>

        </form>
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