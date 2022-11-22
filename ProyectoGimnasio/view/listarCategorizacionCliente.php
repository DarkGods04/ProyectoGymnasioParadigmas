<?php
include '../business/categorizacionClienteBusiness.php';
include '../business/clienteTipoBusiness.php';
include '../business/clienteBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Categorizacion de clientes</title>
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
    <h1>Categorizacion de clientes</h1>
    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listarCategorizaciones"></ul>
        </div>
    </form></br></br>
    <div>
        <?php
        if (!isset($_POST['campo'])) {
            $_POST['campo'] = "";
            $campo = $_POST['campo'];
        }
        $campo = $_POST['campo'];

        $categorizacionClienteBusiness = new CategorizacionClienteBusiness();
        $categorizaciones = $categorizacionClienteBusiness->buscar($campo);
        if (!empty($categorizaciones)) {

        ?>
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>Id</th>
                        <th>Cliente</th>
                        <th>Tipo de cliente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($categorizaciones as $row) {



                        if ($row->getCategorizacionClienteActivo() == 1) {
                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/categorizacionClienteAction.php">';
                            echo '<tr>';
                            echo '<input  type="hidden" name="idCategorizacion" id="id" value="' . $row->getIdCategorizacionCliente() . '"/>';
                            echo '<td>' . $row->getIdCategorizacionCliente() . '</td>';
                    ?>

                     


                            <td>
                                <?php
                                $clienteBusiness = new ClienteBusiness();
                                $clientes = $clienteBusiness->obtener();
                                foreach ($clientes as $row1) {
                                    if ($row1->getActivoTBCliente() == 1) {
                                        if ($row1->getIdTBCliente() == $row->getIdCliente()) {
                                            echo '<input  type="hidden" name="idCliente" id="idCliente" value="' . $row->getIdCliente() . '"/>';
                                            echo $row1->getNombreTBCliente() . " " .  $row1->getApellido1TBCliente();
                                        }
                                    }
                                } ?>
                            </td>


                            <td>

                                <?php
                                $clienteTipoBusiness = new ClienteTipoBusiness();
                                $clientes = $clienteTipoBusiness->obtener();
                                ?>
                                <select name="idTipoCliente">
                                    <?php foreach ($clientes as $rowTemp) {
                                        if ($rowTemp->getIDClienteTipo() == $row->getIdTipoCliente()) {
                                            echo '<option value="' . $rowTemp->getIDClienteTipo() . '">' . $rowTemp->getNombreTBClienteTipo() . '</option>';
                                        }
                                    } ?>
                                    <?php foreach ($clientes as $row1) {
                                        echo '<option value="' . $row1->getIDClienteTipo() . '">' . $row1->getNombreTBClienteTipo() . '</option>';
                                    } ?>
                                </select>
                            </td>


                            <td>
                                <input type="submit" name="actualizar" id="actualizar" value="Actualizar" onclick="return confirmarAccionModificar()" />
                                <input type="submit" name="eliminar" id="eliminar" value="Eliminar" onclick="return confirmarAccionEliminar()" />
                            </td>



                    <?php

                           
                            echo '</tr>';
                            echo '</form>';
                        }
                    }


                    ?>
                </tbody>
            </table>
        <?php

        } else {
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron categorizaciones!</p>';
        }
        ?>
    </div></br>

    <div>
        <h3>Registrar un nueva categorizacion a cliente</h3>
        <form method="POST" id="direccionform" action="../business/categorizacionClienteAction.php">
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>Cliente</th>
                        <th>Tipo de cliente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                        <td>

                            <?php
                            $clienteBusiness = new ClienteBusiness();
                            $clientes = $clienteBusiness->obtener();
                            ?>
                            <select name="idCliente" id="idCliente" required>
                                <?php
                                if (isset($_GET['idCliente']) && strlen($_GET['idCliente']) > 0) {
                                    foreach ($clientes as $row) :
                                        if ($row->getActivoTBCliente() == 1) {

                                            if ($_GET['idCliente'] == $row->getIdTBCliente()) {
                                                echo '<option value="' . $row->getIdTBCliente() . '">' .  $row->getNombreTBCliente() . " " .  $row->getApellido1TBCliente()  . '</option>';
                                            }
                                        }

                                    endforeach;
                                } else { ?>
                                    <option value="">Clientes</option>
                                <?php }

                                foreach ($clientes as $row) :
                                    if ($row->getActivoTBCliente() == 1) {
                                        if ($_GET['idCliente'] != $row->getIdTBCliente()) {
                                            echo '<option value="' . $row->getIdTBCliente() . '">' . $row->getNombreTBCliente() . " " .  $row->getApellido1TBCliente() . '</option>';
                                        }
                                    }
                                endforeach;
                                ?>
                            </select>
                        </td>

                        <td>

                            <?php
                            $clienteTipoBusiness = new ClienteTipoBusiness();
                            $clientes = $clienteTipoBusiness->obtener();
                            ?>
                            <select name="idTipoCliente" id="idTipoCliente" required>
                                <?php
                                if (isset($_GET['idTipoCliente']) && strlen($_GET['idTipoCliente']) > 0) {
                                    foreach ($clientes as $row) :
                                        if ($row->getActivoTBClienteTipo() == 1) {

                                            if ($_GET['idTipoCliente'] == $row->getIDClienteTipo()) {
                                                echo '<option value="' . $row->getIDClienteTipo() . '">' .  $row->getNombreTBClienteTipo() . '</option>';
                                            }
                                        }

                                    endforeach;
                                } else { ?>
                                    <option value="">Tipo de cliente</option>
                                <?php }

                                foreach ($clientes as $row) :
                                    if ($row->getActivoTBClienteTipo() == 1) {
                                        if ($_GET['idTipoCliente'] != $row->getIDClienteTipo()) {
                                            echo '<option value="' . $row->getIDClienteTipo() . '">' . $row->getNombreTBClienteTipo() . '</option>';
                                        }
                                    }
                                endforeach;
                                ?>

                            </select>
                        </td>

                        <td><button type="submit" name="insertar" id="insertar" value="insertar">Registrar</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/categorizacionClienteAction.php">
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
                        } else if ($_GET['error'] == "duplicate") {
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