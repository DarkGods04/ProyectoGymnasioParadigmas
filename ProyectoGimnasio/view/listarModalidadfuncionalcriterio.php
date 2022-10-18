<?php
include '../business/modalidadfuncionalcriterioBusiness.php';
include '../business/ModalidadFuncionalBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Modalidad funcional criterio</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar este criterio?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar este criterio?");
        }

        function confirmarVolverMenuPrincipal() {
            return confirm("¿Está seguro de que desea volver al menú de criterio?");
        }
    </script>
</head>

<body>
    <?php include 'header.php' ?>
    <h1>Modalidad funcional criterios</h1>

    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaModalidadfuncionalcriterio"></ul>
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

        $modalidadfuncionalcriterioBusiness = new ModalidadfuncionalcriterioBusiness();
        $modalidadfuncionalcriterios = $modalidadfuncionalcriterioBusiness->buscar($campo);
        if (!empty($modalidadfuncionalcriterios)) {
        ?>
            <table border="1">
                <thead style="text-align: center;">
                    <tr>
                        <th>ID</th>
                        <th>Modalidad funcional</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th colspan="2">Rangos de criterio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($modalidadfuncionalcriterios as $row) {
                        if ($row->getActivoTBModalidadfuncionalcriterio() == 1) {
                        
                            echo '<form  method="POST" enctype="multipart/form-data" action="../business/modalidadfuncionalcriterioAction.php">';
                            echo '<tr>';
                            echo '<input  type="hidden" name="idModalidadfuncionalcriterio" id="id" value="' . $row->getIdTBModalidadfuncionalcriterio() . '"/>';
                            echo '<td>' . $row->getIdTBModalidadfuncionalcriterio() . '</td>';
                        ?>
                        <td>

                        <?php
                       $modalidadFuncionalBusiness = new ModalidadFuncionalBusiness();
                        $modalidadFuncionales = $modalidadFuncionalBusiness->obtener();
                        ?>
                        <select name="idModalidadfuncional">
                        <?php foreach($modalidadFuncionales as $row1){ 
                           if($row1->getIdTBModalidadFuncional() == $row->getIdModalidadfuncionalTBModalidadfuncionalcriterio()){
                              echo  '  <option value="' .$row1->getIdTBModalidadFuncional() .'" selected disabled hidden>'.$row1->getNombreTBModalidadFuncional().'</option>';
                           }
                           echo  '  <option value="' .$row1->getIdTBModalidadFuncional() .'">'.$row1->getNombreTBModalidadFuncional().'</option>';
                             } ?>
                           </select>
                       </td>

                       <?php
                            echo '<td><input  type="text" name="nombre" id="nombre" value="' . $row->getNombreTBModalidadfuncionalcriterio() . '"/></td>';
                            echo '<td><input type="text" size="40" name="descripcion" id="descripcion" value="' . $row->getDescripcionTBModalidadfuncionalcriterio() .  '"/></td>';
                            echo '<td><input type="text" name="rangoValorMaximo" id="rangoValorMaximo" value="' . $row->getRangoValorMaximoTBModalidadfuncionalcriterio() .  '"/></td>';
                            echo '<td><input type="text" name="rangoValorMinimo" id="rangoValorMinimo" value="'. $row->getRangoValorMinimoTBModalidadfuncionalcriterio() . '"/></td>';
                            echo '<td><input type="submit" name="actualizarModalidadfuncionalcriterio" id="actualizarModalidadfuncionalcriterio" value="Actualizar" onclick="return confirmarAccionModificar()"/>';
                            echo '<input type="submit" name="eliminarModalidadfuncionalcriterio" id="eliminarModalidadfuncionalcriterio" value="Eliminar" onclick="return confirmarAccionEliminar()"/></td>';
                            echo '</tr>';
                            echo '</form>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo '<p style="color: red">SIN RESULTADOS: No hay criterios registrados!</p>';
        }
        ?>
    </div><br>

    <div>
        <h3>Registrar un nuevo criterio funcional</h3>

        <form method="POST" id="direccionform" action="../business/modalidadfuncionalcriterioAction.php">
            <table border="1">
                <thead style="text-align: left;">

                <tr>
                        <th>Modalidad funcional</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th colspan="2">Rangos de criterio</th>
                        <th>Acciones</th>
             </tr>
                </thead>

                <tbody>

                <tr>

                    <td>
                        

                    <?php
        $modalidadFuncionalBusiness = new ModalidadFuncionalBusiness();
        $modalidadFuncionales = $modalidadFuncionalBusiness->obtener();
        ?>
                        <select name="idModalidadfuncional">
                            <option value="">Modalidad funcional</option>
                            <?php foreach($modalidadFuncionales as $row):
                                  if($row->getActivoTBModalidadFuncional() == 1){
                                ?>
                                <?php echo '<option value="'. $row->getIdTBModalidadFuncional().'">'. $row->getNombreTBModalidadFuncional().'</option>' ?>
                                <?php
                                } endforeach ?>
                        </select>



                    </td>


                    <td><input type="text" name="nombre" placeholder="Nombre"></td>
                    <td><input type="text" name="descripcion" placeholder="Descripcion"></td>
                    <td><input type="text" name="rangoValorMaximo" placeholder="Valor Maximo"></td>
                    <td><input type="text" name="rangoValorMinimo" placeholder="Valor Minimo"></td>
                    
                    <td><button type="submit" name="insertarModalidadfuncionalcriterio" id="insertarModalidadfuncionalcriterio" value="insertarModalidadfuncionalcriterio">Registrar criterio</button></td>

                    <tr>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/activoFijoAction.php">
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