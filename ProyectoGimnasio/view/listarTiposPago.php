<?php
include '../business/pagoTipoBusiness.php';
include 'header.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Métodos de pago</title>
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
    <h1>Métodos de pago</h1>

    <div>
        <?php 
        $pagoTipoBusiness = new pagoTipoBusiness(); 
        $pagoTipo = $pagoTipoBusiness->getPagosTipo()?>

        <table border="1">
            <thead style="text-align: center;">
                <tr>
                    <th>ID</th>
                    <th>Método de pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        
            <tbody>
                <?php
                foreach ($pagoTipo as $row) {
                    if ($row->getActivoTBPagoTipo() == 1){
                        echo '<form  method="POST" enctype="multipart/form-data" action="../business/pagoTipoAction.php">';
                        echo '<tr>';
                        echo '<input type="hidden" name="idPagoTipo" id="idPagoTipo" value="' . $row->getIDPagoTipo() . '"/>';
                        echo '<td>' . $row->getIDPagoTipo() . '</td>';
                        echo '<td><input type="text" name="nombrePagoTipo" id="nombrePagoTipo" value="' . $row->getNombreTBPagoTipo() . '"/></td>';

                        echo '<td><input type="submit" name="actualizar" id="actualizar" value="Actualizar" onclick="return confirmarAccionModificar()"/>';
                        echo '<input type="submit" name="eliminar" id="eliminar" value="Eliminar" onclick="return confirmarAccionEliminar()"/></td>';
                        echo '</tr>';
                        echo '</form>';
                    }
                    
                }
                ?>
            
            </tbody>
        </table>
            
    </div></br>

    <div>
        <h3>Registrar un nuevo método de pago</h3>
        
        <form method="POST" id="direccionform" action="../business/pagoTipoAction.php">
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>Método de pago</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="nombrePagoTipo" placeholder="Modalidad"></td>
                        <td><button type="submit" name="insertar" id="insertar" value="insertar">Registrar</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/pagoTipoAction.php">
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