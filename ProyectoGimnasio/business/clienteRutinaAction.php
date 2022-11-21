<?php
include '../business/clienteRutinaBusiness.php';
include '../business/clienteRutinaDetalleBusiness.php';

if (!empty($_POST['idCliente'])) {
    $idCliente = $_POST['idCliente'];
}
if (!empty($_POST['idInstructor'])) {
    $idInstructor = $_POST['idInstructor'];
}
if (!empty($_POST['idModalidadFuncional'])) {
    $idModalidadFuncional = $_POST['idModalidadFuncional'];
}
if (!empty($_POST['ejerciciosVector'])) {
    $ejerciciosSelec = $_POST['ejerciciosVector'];
}
if (!empty($_POST['ejercicio'])) {
    $ejerciciosSelec[] = $_POST['ejercicio'];
}
if (!empty($ejerciciosSelec)) {
    $ejerciciosSelec = serialize($ejerciciosSelec);
    $ejerciciosSelec = urlencode($ejerciciosSelec);
}
if (!empty($_POST['fecha'])) {
    $fecha = $_POST['fecha'];
}

if (isset($_POST['añadirEjercicio'])) {
    header("Location: ../view/listarClienteRutina.php?success=selectedExercise&idCliente=$idCliente&idInstructor=$idInstructor&idModalidadFuncional=$idModalidadFuncional&fecha=$fecha&ejerciciosVector=$ejerciciosSelec");
}

if (isset($_POST['eliminarEjercicio'])) {

    if (!empty($_POST['eliminarEjercicio'])) {
        $id = $_POST['eliminarEjercicio'];

        $datos = urldecode($ejerciciosSelec);
        $array = unserialize($datos);

        for ($i = 0; $i < count($array); $i++) {
            if ($id == $array[$i]) {
                unset($array[$i]);
            }
        }
        $array = array_values($array);

        $array = serialize($array);
        $array = urlencode($array);

        header("Location: ../view/listarClienteRutina.php?success=delete&idCliente=$idCliente&idInstructor=$idInstructor&idModalidadFuncional=$idModalidadFuncional&fecha=$fecha&ejerciciosVector=$array");
    }
}



if (isset($_POST['insertarClienteRutina'])) {
    if (isset($_POST['ejerciciosVector'])) {
        if (isset($_POST['idCliente']) && isset($_POST['idInstructor']) && isset($_POST['fecha']) && isset($_POST['idModalidadFuncional'])) {

            $idCliente = $_POST['idCliente'];
            $idInstructor = $_POST['idInstructor'];
            $fecha = $_POST['fecha'];
            $idModalidadFuncional = $_POST['idModalidadFuncional'];

            if (strlen($idCliente) > 0 && strlen($idInstructor) > 0  && strlen($fecha) > 0 && strlen($idModalidadFuncional) > 0) {

                if (is_numeric($idCliente) && is_numeric($idInstructor) && is_numeric($idModalidadFuncional)) {
                    
                    $clienteRutina = new ClienteRutina(0, $idCliente, $idInstructor, $idModalidadFuncional, $fecha, 1);
                    $clienteRutinaBusiness = new ClienteRutinaBusiness();
                    $resultado = $clienteRutinaBusiness->insertar($clienteRutina);

                    $datos = urldecode($ejerciciosSelec);
                    $array = unserialize($datos);
                    if ($resultado == 0) {
                        header("Location: ../view/listarClienteRutina.php?error=insertError&idCliente=$idCliente&idInstructor=$idInstructor&idModalidadFuncional=$idModalidadFuncional&fecha=$fecha&ejerciciosVector=$array");
                    } else {
                        for ($i = 0; $i < count($array); $i++) {
                            $clienteRutinaDetalle = new ClienteRutinaDetalle(0, $resultado, $array[$i]);
                            $clienteRutinaDetalleBusiness = new ClienteRutinaDetalleBusiness();
                            $resultado1 = $clienteRutinaDetalleBusiness->insertar($clienteRutinaDetalle);
                        }
                    }
                    $array = serialize($array);
                    $array = urlencode($array);

                    if ($resultado1 == 1) {
                        header("Location: ../view/listarClienteRutina.php?success=inserted");
                    } else {
                        header("Location: ../view/listarClienteRutina.php?error=dbError&idCliente=$idCliente&idInstructor=$idInstructor&idModalidadFuncional=$idModalidadFuncional&fecha=$fecha&ejerciciosVector=$ejerciciosSelec");
                    }
                } else {
                    header("Location: ../view/listarClienteRutina.php?error=numberFormat&idCliente=$idCliente&idInstructor=$idInstructor&idModalidadFuncional=$idModalidadFuncional&fecha=$fecha&ejerciciosVector=$ejerciciosSelec");
                }
            } else {
                header("Location: ../view/listarClienteRutina.php?error=emptyField&idCliente=$idCliente&idInstructor=$idInstructor&idModalidadFuncional=$idModalidadFuncional&fecha=$fecha&ejerciciosVector=$ejerciciosSelec");
            }
        } else {
            header("Location: ../view/listarClienteRutina.php?error=error&idCliente=$idCliente&idInstructor=$idInstructor&idModalidadFuncional=$idModalidadFuncional&fecha=$fecha&ejerciciosVector=$arejerciciosSelecray");
        }
    } else {
        header("Location: ../view/listarClienteRutina.php?error=rutinaNotSelected&idCliente=$idCliente&idInstructor=$idInstructor&idModalidadFuncional=$idModalidadFuncional&fecha=$fecha&ejerciciosVector=$ejerciciosSelec");
    }
}
