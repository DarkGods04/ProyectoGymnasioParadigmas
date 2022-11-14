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
    <title>Clientes</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar este cliente?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar este cliente?");
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
                        <th>Peso (Kg)</th>
                        <th>Altura (cm)</th>
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
                            echo '<td><input pattern="^[a-z A-Z\u00c0-\u017F]+" type="text" name="nombre" id="nombre" value="' . $row->getNombreTBCliente() . '"/></td>';
                            echo '<td><input pattern="^[a-z A-Z\u00c0-\u017F]+" type="text" name="apellido1" id="apellido1" value="' . $row->getApellido1TBCliente() . '"/></td>';
                            echo '<td><input pattern="^[a-z A-Z\u00c0-\u017F]+" type="text" name="apellido2" id="apellido2" value="' . $row->getApellido2TBCliente() . '"/></td>';
                            echo '<td><input type="text" pattern="\w.+@(gmail|est|una|hotmail|yahoo|outlook)+\.(com|es|org|cr|una.ac.cr|cr)+" name="correo" id="correo" placeholder="micorreo@gmail.com" name="correo" id="correo" placeholder="micorreo@gmail.com" name="correo" id="correo" value="' . $row->getCorreoTBCliente() .  '"/></td>';
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
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron clientes!</p>';
        }
        ?>
    </div></br>

    <div>
        <button><a href="listarClientesDesactivos.php" style="text-decoration: none; color: blue; font-size: 140%;">Recuperar clientes</a></button>
    </div>

    <div>
        <h3>Registrar un nuevo cliente</h3>

        <form method="POST" id="formcliente" action="../business/clienteAction.php">
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
                        <th>Peso (Kg)</th>
                        <th>Altura (cm)</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" pattern="^[a-z A-Z\u00c0-\u017F]+" name="nombre" id="nombre" placeholder="Nombre" value="<?php if(isset($_GET['nombre'])){ echo $_GET['nombre']; }?>"  ></td>
                        <td><input type="text" pattern="^[a-z A-Z\u00c0-\u017F]+" name="apellido1" id="apellido1" placeholder="Primer apellido"  value="<?php if(isset($_GET['apellido1'])){ echo $_GET['apellido1']; }?>" ></td>
                        <td><input type="text" pattern="^[a-z A-Z\u00c0-\u017F]+" name="apellido2" id="apellido2" placeholder="Segundo apellido"  value="<?php if(isset($_GET['apellido2'])){ echo $_GET['apellido2']; }?>" ></td>
                        
                        <td><input type="email" pattern="\w.+@(gmail|est|una|hotmail|yahoo|outlook)+\.(com|es|org|cr|una.ac.cr|cr)+" name="correo" id="correo" placeholder="micorreo@gmail.com" name="correo" id="correo" placeholder="micorreo@gmail.com" name="correo" id="correo" placeholder="micorreo@gmail.com"  value="<?php if(isset($_GET['correo'])){ echo $_GET['correo']; }?>" ></td>
                        <td><input type="text" class="mascaratelefono" name="telefono" id="telefono" placeholder="0000-0000"  value="<?php if(isset($_GET['telefono'])){ echo $_GET['telefono']; }?>" ></td>
                        <td><input type="date" name="fechaNacimiento" id="fechaNacimiento" placeholder="Fecha de nacimiento" value="<?php if(isset($_GET['fechaNacimiento'])){ echo $_GET['fechaNacimiento']; }?>" ></td>
                        <td>
                            <select name="genero">
                                <option value="<?php if(isset($_GET['genero'])){ echo $_GET['genero']; }?>"><?php if(isset($_GET['genero'])){ echo $_GET['genero']; }?></option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </td>
                        <td><input type="text" class="mascarapeso" name="peso" id="peso" min="20" max="250" placeholder="000.00kg"  value="<?php if(isset($_GET['peso'])){ echo $_GET['peso']; }?>" ></td>
                        <td><input type="text" class="mascaraaltura" name="altura" id="altura" placeholder="0.00m"  value="<?php if(isset($_GET['altura'])){ echo $_GET['altura']; }?>" ></td>
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