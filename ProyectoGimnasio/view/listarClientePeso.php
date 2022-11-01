<?php
    include '../business/clientePesoBusiness.php';
    include '../business/instructorBusiness.php';
    include '../business/clienteBusiness.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Peso clientes</title>
    <script>
        function confirmarAccionModificar() {
            return confirm("¿Está seguro de que desea modificar este peso?");
        }

        function confirmarAccionEliminar() {
            return confirm("¿Está seguro de que desea eliminar este peso?");
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
    <h1>Peso por cliente</h1>

    <form action="" method="post" autocomplete="off">
        <div>
            <label for="campo"> Buscar: </label>
            <input type="text" name="campo" id="campo" placeholder="Buscar">
            <button type="submit" name="buscar" id="buscar" value="buscar">Buscar</button>
            <ul id="listaClientePeso"></ul>
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
        
        $clientePesoBusiness = new ClientePesoBusiness();
        $clientePeso = $clientePesoBusiness->buscar($campo);
        if (!empty($clientePeso)) {
        ?>
            <table border="1">
                <thead style="text-align: left;">
                    <tr>
                        <th>Cliente</th>
                        <th>Fecha pesaje</th>
                        <th>Peso</th>
                        <th>Instructor</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $instructorBusiness = new InstructorBusiness();
                    $clienteBusiness = new ClienteBusiness();
                    $instructor = $instructorBusiness->obtener();
                    $cliente = $clienteBusiness->obtener();

                    foreach ($clientePeso as $row) {
                        echo '<form  method="POST" enctype="multipart/form-data" action="../business/clientePesoAction.php">';
                        echo '<tr>';
                        echo '<input  type="hidden" name="tbclientepesoid" id="id" value="' . $row->getClientePesoID() . '"/>';
                        foreach($cliente as $row1){
                            if($row->getClienteID() == $row1->getIdTBCliente()){
                                echo '<td>' .  $row1->getNombreTBCliente() . ' ' . $row1->getApellido1TBCliente() . '</td>';
                            }
                        }
                        echo '<td>' . $row->getClientePesoFecha() . '</td>';
                        echo '<td class="mascarapeso">' . $row->getClientePesoPeso() . '</td>';
                        foreach ($instructor as $row2){
                            if($row->getInstructorID() == $row2->getIdTBInstructor()){
                                echo '<td>' . $row2->getNombreTBInstructor() . '</td>';
                            }
                        }
                        echo '</tr>';
                        echo '</form>';
                    }   
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo '<p style="color: red">SIN RESULTADOS: No se encontraron pesos de clientes!</p>';
        }
        ?>
    </div><br>

    <div>
        <h3>Registrar un nuevo peso</h3>

        <form method="POST" id="direccionform" action="../business/clientePesoAction.php" autocomplete="off">
            <table border="1">
                <thead style="text-align: left;">
                    <th>Cliente</th>
                    <th>Fecha pesaje</th>
                    <th>Peso</th>
                    <th>Instructor</th>
                    <th>Acción</th>
                </thead>
                <tbody>
                    <td>
                        <select name="clienteid">
                        <option value="<?php if(isset($_GET['clienteid'])){foreach ($cliente as $row4){ if($_GET['clienteid'] == $row4->getIDTBCliente()){echo $_GET['clienteid'];}}}?>"><?php if(isset($_GET['clienteid'])){foreach ($cliente as $row4){ if($_GET['clienteid'] == $row4->getIDTBCliente()){echo $row4->getNombreTBCliente() . ' ' . $row4->getApellido1TBCliente();}}}?></option>
                            <?php foreach ($cliente as $row): ?>
                                <?php echo '<option value="'. $row->getIDTBCliente().'">' . $row->getNombreTBCliente() . ' ' . $row->getApellido1TBCliente() . '</option>' ?> 
                            <?php endforeach ?>
                        </select>
                    </td>
                    <td><input type="date" name="clientepesofecha" value="<?php if(isset($_GET['clientepesofecha'])){ echo $_GET['clientepesofecha']; }?>"></td>
                    <td><input type="text" class="mascarapeso" name="clientepesopeso" placeholder="Peso del cliente" value="<?php if(isset($_GET['clientepesopeso'])){ echo $_GET['clientepesopeso']; }?>"></td>
                    <td>
                        <select name="instructorid">
                        <option value="<?php if(isset($_GET['instructorid'])){foreach ($instructor as $row5){ if($_GET['instructorid'] == $row5->getIdTBInstructor()){echo $_GET['instructorid'];}}}?>"><?php if(isset($_GET['instructorid'])){foreach ($instructor as $row5){ if($_GET['instructorid'] == $row5->getIdTBInstructor()){echo $row5->getNombreTBInstructor();}}}?></option>
                            <?php foreach ($instructor as $row): ?>
                                <?php echo '<option value="'. $row->getIdTBInstructor() .'">'. $row->getNombreTBInstructor() . '</option>' ?>
                            <?php endforeach ?>
                        </select>
                    </td>
                    <td><button type="submit" name="btnregistrar" id="btnregistrar" value="btnregistrar">Registrar peso</button></td>
                </tbody>
            </table>
        </form>
    </div>

    <div>
        <form method="POST" enctype="multipart/form-data" action="../business/clientePesoAction.php">
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