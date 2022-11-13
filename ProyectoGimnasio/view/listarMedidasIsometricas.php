<?php
include '../business/medidaIsometricaBusiness.php';
include '../business/clienteBusiness.php';
include '../business/grupoMuscularBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Medidas isometricas</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar esta medida?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar esta medida?");
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
    <h1>Medidas isometricas</h1>

    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaMedida"></ul>
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

        $medidaBusiness = new MedidaIsometricaBusiness();
        $medidas = $medidaBusiness->buscar($campo);
        $clienteBusiness = new ClienteBusiness();
        $clientes = $clienteBusiness->obtener();
        $grupoMuscularBusiness = new GrupoMuscularBusiness();
        $gruposMusculares = $grupoMuscularBusiness->obtener();



        if (!empty($medidas)) {
        ?>
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>ID</th>
                        <th>Grupo muscular</th>
                        <th>Cliente</th>
                        <th>Fecha medida</th>
                        <th>Medida(cm)</th>

                    </tr>
                </thead>

                <tbody>
                    <?php


                    foreach ($medidas as $row) {
                        if ($row->getActivo() == 1) {

                            echo '<form method="POST" id="direccionform" action="../business/medidaIsometricaAction.php">';
                            echo '<tr>';
                            echo '<input  type="hidden" name="idMedida" id="idMedida" value="' . $row->getIdMedida() . '"/>';
                            echo '<td>' . $row->getIdMedida() . '</td>';
                            echo '<input  type="hidden" name="idGrupoMuscular" id="idGrupoMuscular" value="' . $row->getIdGrupoMuscular() . '"/>';

                            foreach ($gruposMusculares as $rowGrupoMuscular) {
                                if ($rowGrupoMuscular->getIDGrupoMuscular() == $row->getIdGrupoMuscular()) {
                                    echo '<td>' . $rowGrupoMuscular->getNombreTBGrupoMuscular() . '</td>';
                                }
                            }

                            echo '<input  type="hidden" name="idCliente" id="idCliente" value="' . $row->getIdCliente() . '"/>';
                            foreach ($clientes as $rowCliente) {

                                if ($rowCliente->getIdTBCliente() == $row->getIdCliente()) {
                                    //  echo '<input  type="hidden" name="idCliente" id="idCliente" value="' . $row->getIdCliente() . '"/>';
                                    echo '<td>' . $rowCliente->getNombreTBCliente() . " "  . $rowCliente->getApellido1TBCliente() . '</td>';
                                }
                            }

                            echo '<td><input  type="date" name="fechaMedicion" id="fechaMedicion" value="' . $row->getFechaMedicion() . '" readonly/></td>';
                            echo '<input  type="hidden" class="mascaramedida" name="medida" id="medida" value="' . $row->getMedida() . '"/>';
                            echo '<td>' . $row->getMedida() . '</td>';
                            echo '</tr>';
                            echo '</form>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron medidas isométricas!</p>';
        }
        ?>
    </div><br>

    <div>
        <h3>Registrar una nueva medida isometrica</h3>

        <form method="POST" id="direccionform" action="../business/medidaIsometricaAction.php">
            <table border="1">
                <thead style="text-align: left;">

                    <th>Grupo muscular</th>
                    <th>Cliente</th>
                    <th>Fecha medida</th>
                    <th>Medida(cm)</th>
                    <th>Accion</th>
                </thead>

                <tbody>


                    <?php
                    $grupoMuscularBusiness = new GrupoMuscularBusiness();
                    $gruposMusculares = $grupoMuscularBusiness->obtener();
                    ?>
                    <td>

                    <select name="idGrupoMuscular">
                   
                            <option value="<?php if (isset($_GET['grupoMuscular'])) {
                                                foreach ($gruposMusculares as $row) {
                                                    if ($_GET['grupoMuscular'] == $row->getIDGrupoMuscular()) {
                                                        echo $_GET['grupoMuscular'];
                                                    }
                                                }
                                            } ?>"><?php if (isset($_GET['grupoMuscular'])) {
                                        foreach ($gruposMusculares as $row) {
                                            if ($_GET['grupoMuscular'] == $row->getIDGrupoMuscular()) {
                                                
                                                echo $row->getNombreTBGrupoMuscular();
                                            }
                                        }
                                    } ?></option>
                            <?php foreach ($gruposMusculares as $row) : ?>
                                <?php 
                                     if ($row->getActivoTBGrupoMuscular() == 1) {
                                    echo '<option value="' . $row->getIDGrupoMuscular() . '">' . $row->getNombreTBGrupoMuscular()  . '</option>'; } ?>
                          
                          <?php endforeach ?>
                        </select>


                       

                    </td>

                    <?php
                    $clienteBusiness = new ClienteBusiness();
                    $clientes = $clienteBusiness->obtener();
                    ?>
                    <td>

                        <select name="idCliente">

                            <option value="<?php if (isset($_GET['cliente'])) {
                                                foreach ($clientes as $row) {
                                                    if ($_GET['cliente'] == $row->getIDTBCliente()) {
                                                        echo $_GET['cliente'];
                                                    }
                                                }
                                            } ?>" ><?php if (isset($_GET['cliente'])) {
                                        foreach ($clientes as $row) {
                                            if ($_GET['cliente'] == $row->getIDTBCliente()) {
                                                
                                                echo $row->getNombreTBCliente() . ' ' . $row->getApellido1TBCliente();
                                            }
                                        }
                                    } ?></option>
                            <?php foreach ($clientes as $row) : ?>
                                <?php 
                                     if ($row->getActivoTBCliente() == 1) {
                                    echo '<option value="' . $row->getIDTBCliente() . '">' . $row->getNombreTBCliente() . ' ' . $row->getApellido1TBCliente() . '</option>'; } ?>
                          
                          <?php endforeach ?>
                        </select>





                       

                    </td>

                    <td><input type="date" name="fechaMedicion" id="fechaMedicion" value="<?php if (isset($_GET['fecha']))  echo $_GET['fecha']; ?>"  /></td>

                    <td><input type="text" class="mascaramedida" name="medida" value="<?php if (isset($_GET['medidaIsometrica']))  echo $_GET['medidaIsometrica']; ?>"  class="form-control" placeholder="medida en centimetros" require></td>
                    <td><button type="submit" name="insertar" id="insertar" value="insertar">Registrar</button></td>
                </tbody>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/medidaIsometricaAction.php">
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
                        } else if ($_GET['error'] == "error") {
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