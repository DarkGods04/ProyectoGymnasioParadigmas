<?php //require_once '../data/servicioData.php'; ?>
<!DOCTYPE html>
<html>
<?php 
//por favor no tocar lo qu esta comentado 
//$servicioBusiness = new ServicioData();
//$servicios = $servicioBusiness->getServicios();
//$fechaActualizacionProxima = new DateTime(date('Y-m-d'));
//$fechaActualizacionProxima = $fechaActualizacionProxima->format('Y-m-d');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú principal</title>
    <script>
        function confirmarActualizacionServicio(dat,dias) {
            return confirm("El servicio con el nombre  y monto = "+dat+" le corresponde una actualización el día de hoy\n ¿desea realizar esta actualización en caso contrario se aplazara "+dias+" días más?");
        }
    </script>
</head>

<body>
    <h1>Proyecto Gimnasio</h1>
    <h2>Menú principal</h2>
    <?php /*
    foreach ($servicios as $row) {
        if ($row->getActivoTBServicio() == 1) {
            if ($row->getFechaactualizacionTBServicio() == $fechaActualizacionProxima) {
                $id = $row->getIdTBServicio();
                $nom = $row->getNombreTBServicio();
                $monto = $row->getMontoTBServicio();
                $dias =$row->getPeriodicidadTBServicio();
                ?><script>
                    if (confirmarActualizacionServicio("<?php echo $id . "'$nom'" . "'$monto'"; ?>","<?php echo $dias; ?>")) {
                        location.href = "view/listarServicios.php";
                    }else{

                    }
                </script>
                <?php }
        }
    }*/
    ?>
    <div>
        <a href="./view/listarInstructores.php" style="text-decoration: none; color: blue; font-size: 150%;">- Instructores</a>
    </div>

    <div>
        <a href="./view/listarClientes.php" style="text-decoration: none; color: blue; font-size: 150%;">- Clientes</a>
    </div>

    <div>
        <a href="./view/listarClientePeso.php" style="text-decoration: none; color: blue; font-size: 150%;">- Clientes pesos</a>
    </div>

    <div>
        <a href="./view/menuListarActivos.php" style="text-decoration: none; color: blue; font-size: 150%;">- Activos</a>
    </div>

    <div>
        <a href="./view/listarPagoPeridiocidades.php" style="text-decoration: none; color: blue; font-size: 150%;">- Peridiocidades de pago</a>
    </div>

    <div>
        <a href="./view/listarPagoMetodos.php" style="text-decoration: none; color: blue; font-size: 150%;">- Métodos de pago</a>
    </div>

    <div>
        <a href="./view/listarImpuestoVentas.php" style="text-decoration: none; color: blue; font-size: 150%;">- Impuestos de venta</a>
    </div>

    <div>
        <a href="view/listarServicios.php" style="text-decoration: none; color: blue; font-size: 150%;">- Servicios</a>
    </div>

    <div>
        <a href="./view/listarFacturas.php" style="text-decoration: none; color: blue; font-size: 150%;">- Facturas</a>
    </div>

    <div>
        <a href="./view/listarModalidadFuncional.php" style="text-decoration: none; color: blue; font-size: 150%;">- Modalidades Funcionales</a>
    </div>

    <div>
        <a href="./view/listarModalidadFuncionalCriterio.php" style="text-decoration: none; color: blue; font-size: 150%;">- Criterios de Modalidad Funcional</a>
    </div>

    <div>
        <a href="./view/listarEjercicios.php" style="text-decoration: none; color: blue; font-size: 150%;">- Ejercicios</a>
    </div>

    <div>
        <a href="./view/listarGrupoMuscular.php" style="text-decoration: none; color: blue; font-size: 150%;">- Grupo Muscular</a>
    </div>
</body>

</html>