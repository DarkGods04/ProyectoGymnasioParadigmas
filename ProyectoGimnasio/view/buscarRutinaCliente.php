<?php
include '../business/clienteRutinaBusiness.php';
include '../business/ejercicioBusiness.php';
include '../business/clienteBusiness.php';
include '../business/instructorBusiness.php';
include '../business/modalidadFuncionalBusiness.php';
include '../business/clienteRutinaDetalleBusiness.php';
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

        function confirmarAccionBuscar() {
            return confirm("¿Está seguro que desea buscar las rutinas de este usuario?");
        }
    </script>
</head>



<body>
    <?php
    include 'header.php';
    ?>
    <h1>Seleccione su informacion para revisar sus rutinas.</h1>



    <form method="POST" id="direccionform" action="buscarRutinaCliente.php">

  <?php
        $clienteBusiness = new ClienteBusiness();
        $clientes = $clienteBusiness->obtener();
    ?>
    <select name="idCliente">
    <option value="">Seleccione usuario</option>
     <?php foreach($clientes as $row):
     if($row->getActivoTBCliente() == 1){
    ?>
    <?php echo '<option value="'. $row->getIdTBCliente().'">'. $row->getNombreTBCliente()." ".$row->getApellido1TBCliente()." ".$row->getApellido2TBCliente()." - ".$row->getTelefonoTBCliente().'</option>' ?>
     <?php
     } endforeach ?>
    </select>



    <button type="submit" name="buscarCliente" id="buscarCliente" value="buscarCliente" onclick="return confirmarAccionBuscar()">Buscar</button></td>
    
    </form>






    <div>

   
<?php
     if (isset($_POST['buscarCliente'])) {

        if (strlen($_POST['idCliente']) > 0 ) {

?>
   
  
            <?php
            $clienteRutina = new ClienteRutinaBusiness();
            $clienteRutinaVector = $clienteRutina->obtener();

            $ejercicioBusiness = new EjercicioBusiness();
            $ejerciciosVector = $ejercicioBusiness->obtener();

            $clienteRutinaDetalle = new ClienteRutinaDetalleBusiness();
            $rutinaDetalleVector = $clienteRutinaDetalle->obtener();
            $cantidad =0;
            foreach ($clienteRutinaVector as $rutinasVec1) {
                if($rutinasVec1->getIdTBCliente() == $_POST['idCliente']){
                    $cantidad++;
                }

            }

            if($cantidad != 0){

                ?>

                <h1>Rutina Actual</h1>

                <form name="formulario" method="POST" id="direccionform" action="actualizarUnaRutinaCliente.php">
                    <table border="1">
                        <thead style="hidden-align: left;">
                            <tr>
                                <th>Cliente</th>
                                <th>Instructor</th>
                                <th>Modalidad funcional</th>
                                <th>Ejercicios</th>
                                <th>Fecha</th>
                               
                            </tr>
                        </thead>
                        <tbody>


                        <?php

            foreach ($clienteRutinaVector as $rutinasVec) {

                if($rutinasVec->getIdTBCliente() == $_POST['idCliente']){
            ?>
                <tr>


                    <td>
                        <?php
                        $clienteBusiness = new ClienteBusiness();
                        $clientes = $clienteBusiness->obtener();
                        foreach ($clientes as $row) :
                            if ($row->getActivoTBCliente() == 1) {

                                if ($rutinasVec->getIdTBCliente() == $row->getIdTBCliente()) {
                                    echo '<input type="hidden" value="' . $row->getIdTBCliente() . '">' . $row->getNombreTBCliente() . " " . $row->getApellido1TBCliente() . " " . $row->getApellido2TBCliente() . ", Num: " . $row->getTelefonoTBCliente() . '</input type="hidden">';
                                }
                            }
                        endforeach;
                        ?>
                    </td>
                    <td> <?php
                            $instructorBusiness = new InstructorBusiness();
                            $instructores = $instructorBusiness->obtener();

                            foreach ($instructores as $row) :
                                if ($row->getActivoTBInstructor() == 1) {
                                    if ($rutinasVec->getIdTBIstructor() == $row->getIdTBInstructor()) {
                                        echo '<input type="hidden" value="' . $row->getIdTBInstructor() . '">' . $row->getNombreTBInstructor() . " " . $row->getApellidoTBInstructor() . ", Num: " . $row->getTelefonoTBInstructor() . '</input type="hidden">';
                                    }
                                }
                            endforeach;

                            ?>
                    </td>
                    <td><?php
                        $modalidadFuncionalBusiness = new ModalidadFuncionalBusiness();
                        $modalidades = $modalidadFuncionalBusiness->obtener();

                        foreach ($modalidades as $row) :
                            if ($row->getActivoTBModalidadFuncional() == 1) {
                                if ($rutinasVec->getIdTBModalidadFuncional() == $row->getIdTBModalidadFuncional()) {
                                    echo '<input type="hidden" value="' . $row->getIdTBModalidadFuncional() . '">' . $row->getNombreTBModalidadFuncional() . ": " . $row->getDescripcionTBModalidadFuncional() . '</input type="hidden">';
                                }
                            }
                        endforeach;

                        ?>
                    </td>
                    <td>
                        <?php
                        foreach ($rutinaDetalleVector as $row) {
                            if ($rutinasVec->getIdTBClienteRutina() == $row->getIdClienteRutina()) {
                                foreach ($ejerciciosVector as $ejercicioV) {
                                    if ($ejercicioV->getIdEjercicio() ==  $row->getIdEjercicio()) {
                                        echo '<input type="hidden" name="ejerciciosVector[]" required  value="' . $ejercicioV->getIdEjercicio() . '">' . $ejercicioV->getNombreEjercicio() . " : <br>" . $ejercicioV->getDescripcionEjercicio() . ''; ?>
                                        <br><?php
                                            echo '_________________________<br>';
                                        }
                                    }
                                }
                            } ?>

                    </td>
                    <td><input type="date" name="fecha" id="fecha" readonly value="<?php echo $rutinasVec->getFechaTBClienteRutina(); ?>"></td>


                </tr>
               
            <?php
                }
            }

        }else{ echo '<h1>'."El usuario no tiene rutinas registradas!!".'</h1>';}

            //FIN DE LA TABLA DE RUTINA ACTUAL

                        $clienteRutina = new ClienteRutinaBusiness();
                        $clienteRutinaVector = $clienteRutina->obtenerTodos();
            
                        $ejercicioBusiness = new EjercicioBusiness();
                        $ejerciciosVector = $ejercicioBusiness->obtener();
            
                        $clienteRutinaDetalle = new ClienteRutinaDetalleBusiness();
                        $rutinaDetalleVector = $clienteRutinaDetalle->obtener();

                        $cantidad1 =0;
                        foreach ($clienteRutinaVector as $rutinasVec2) {
                            if($rutinasVec2->getIdTBCliente() == $_POST['idCliente']){
                                $cantidad1++;
                            }
            
                        }
            
                        if($cantidad1 != 0){


                            ?>
                            </table>
                    
                                <h1>Rutinas Pasadas</h1>
                    
                                <form name="formulario" method="POST" id="direccionform" action="actualizarUnaRutinaCliente.php">
                                    <table border="1">
                                        <thead style="hidden-align: left;">
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Instructor</th>
                                                <th>Modalidad funcional</th>
                                                <th>Ejercicios</th>
                                                <th>Fecha</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>

                        <?php
                        foreach ($clienteRutinaVector as $rutinasVec) {
                            if($rutinasVec->getIdTBCliente() == $_POST['idCliente']){
                        ?>
                            <tr>
            
            
                                <td>
                                    <?php
                                    $clienteBusiness = new ClienteBusiness();
                                    $clientes = $clienteBusiness->obtener();
                                    foreach ($clientes as $row) :
                                        if ($row->getActivoTBCliente() == 1) {
            
                                            if ($rutinasVec->getIdTBCliente() == $row->getIdTBCliente()) {
                                                echo '<input type="hidden" value="' . $row->getIdTBCliente() . '">' . $row->getNombreTBCliente() . " " . $row->getApellido1TBCliente() . " " . $row->getApellido2TBCliente() . ", Num: " . $row->getTelefonoTBCliente() . '</input type="hidden">';
                                            }
                                        }
                                    endforeach;
                                    ?>
                                </td>
                                <td> <?php
                                        $instructorBusiness = new InstructorBusiness();
                                        $instructores = $instructorBusiness->obtener();
            
                                        foreach ($instructores as $row) :
                                            if ($row->getActivoTBInstructor() == 1) {
                                                if ($rutinasVec->getIdTBIstructor() == $row->getIdTBInstructor()) {
                                                    echo '<input type="hidden" value="' . $row->getIdTBInstructor() . '">' . $row->getNombreTBInstructor() . " " . $row->getApellidoTBInstructor() . ", Num: " . $row->getTelefonoTBInstructor() . '</input type="hidden">';
                                                }
                                            }
                                        endforeach;
            
                                        ?>
                                </td>
                                <td><?php
                                    $modalidadFuncionalBusiness = new ModalidadFuncionalBusiness();
                                    $modalidades = $modalidadFuncionalBusiness->obtener();
            
                                    foreach ($modalidades as $row) :
                                        if ($row->getActivoTBModalidadFuncional() == 1) {
                                            if ($rutinasVec->getIdTBModalidadFuncional() == $row->getIdTBModalidadFuncional()) {
                                                echo '<input type="hidden" value="' . $row->getIdTBModalidadFuncional() . '">' . $row->getNombreTBModalidadFuncional() . ": " . $row->getDescripcionTBModalidadFuncional() . '</input type="hidden">';
                                            }
                                        }
                                    endforeach;
            
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach ($rutinaDetalleVector as $row) {
                                        if ($rutinasVec->getIdTBClienteRutina() == $row->getIdClienteRutina()) {
                                            foreach ($ejerciciosVector as $ejercicioV) {
                                                if ($ejercicioV->getIdEjercicio() ==  $row->getIdEjercicio()) {
                                                    echo '<input type="hidden" name="ejerciciosVector[]" required  value="' . $ejercicioV->getIdEjercicio() . '">' . $ejercicioV->getNombreEjercicio() . " : <br>" . $ejercicioV->getDescripcionEjercicio() . ''; ?>
                                                    <br><?php
                                                        echo '_________________________<br>';
                                                    }
                                                }
                                            }
                                        } ?>
            
                                </td>
                                <td><input type="date" name="fecha" id="fecha" readonly value="<?php echo $rutinasVec->getFechaTBClienteRutina(); ?>"></td>
            
            
                            </tr>
                                        
                     
                        <?php
                            }
                        }
                    }


        }else{
            echo '<h1>'."No has seleccionado ningun usuario!!".'</h1>';
        }

    }else{ echo '<h1>'."Seleccione un usuario y precione buscar!".'</h1>';
    
    }




            ?>
        </tbody>
</form>
</div>



 </body>

</html>