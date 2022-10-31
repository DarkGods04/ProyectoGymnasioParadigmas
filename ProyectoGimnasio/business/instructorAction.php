<?php
include 'instructorBusiness.php';
include 'facturaBusiness.php';

if (isset($_POST['insertar'])) {
    if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['correo']) &&
        isset($_POST['telefono']) && isset($_POST['numcuenta']) && isset($_POST['tipoinstructor'])) {

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $numCuenta = $_POST['numcuenta'];
        $tipoinstructor = $_POST['tipoinstructor'];

        if (strlen($nombre) > 0 && strlen($apellido) > 0 && strlen($correo) > 0 && strlen($telefono) > 0
            && strlen($numCuenta) > 0 && strlen($tipoinstructor) > 0) {

            $tempTelefono = str_replace("-", "", $telefono);

            if (!is_numeric($nombre) && !is_numeric($apellido)) {
                if (filter_var($correo, FILTER_VALIDATE_EMAIL)){
                    $instructor = new Instructor(0, $nombre, $apellido, $correo, $tempTelefono, $numCuenta, $tipoinstructor, 1);
                    $instructorBusiness = new InstructorBusiness();
                    $resultado = $instructorBusiness->insertar($instructor);

                    if ($resultado == 1) {
                        Header("Location: ../view/listarInstructores.php?success=inserted");
                    } else {
                        Header("Location: ../view/listarInstructores.php?error=dbError&nombre=$nombre&apellido=$apellido&telefono=$telefono&correo=$correo&numcuenta=$numCuenta&tipoinstructor=$tipoinstructor");
                    }
                } else {
                    header("location: ../view/listarInstructores.php?error=emailError&nombre=$nombre&apellido=$apellido&telefono=$telefono&correo=$correo&numcuenta=$numCuenta&tipoinstructor=$tipoinstructor");
                }
            } else {
                header("location: ../view/listarInstructores.php?error=numberFormat&nombre=$nombre&apellido=$apellido&telefono=$telefono&correo=$correo&numcuenta=$numCuenta&tipoinstructor=$tipoinstructor");
            }
        } else {
            header("location: ../view/listarInstructores.php?error=emptyField&nombre=$nombre&apellido=$apellido&telefono=$telefono&correo=$correo&numcuenta=$numCuenta&tipoinstructor=$tipoinstructor");
        }
    } else {
        header("location: ../view/listarInstructores.php?error=error&nombre=$nombre&apellido=$apellido&telefono=$telefono&correo=$correo&numcuenta=$numCuenta&tipoinstructor=$tipoinstructor");
    }
}


if (isset($_POST['eliminar'])) {

    $facturaBusiness = new FacturaBusiness();
    $facturas = $facturaBusiness->obtener();
    $flag = 0;
    foreach ($facturas as $row) { if($row->getInstructoridTBFactura() == $_POST['idInstructor'] && $row->getActivoTBFactura() == 1 ){  $flag = 1; } }
        
    if($flag == 0){

    if (isset($_POST['idInstructor'])) {
        $id = $_POST['idInstructor'];

        $instructorBusiness = new InstructorBusiness();
        $result = $instructorBusiness->delete($id);

        if ($result == 1) {
            header("Location: ../view/listarInstructores.php?success=deleted");
        } else {
            header("Location: ../view/listarInstructores.php?error=dbError");
        }
    } else {
        header("location: ../view/listarInstructores.php?error=error");
    }

    } else {
    header("location: ../view/listarInstructores.php?error=relationError");
    }

}


if (isset($_POST['actualizar'])) {

    if (isset($_POST['idInstructor']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['correo'])
        && isset($_POST['telefono']) && isset($_POST['numcuenta']) && isset($_POST['tipoinstructor'])) {

        $id = $_POST['idInstructor'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $numCuenta = $_POST['numcuenta'];
        $tipoinstructor = $_POST['tipoinstructor'];

        if (strlen($nombre) > 0 && strlen($apellido) > 0 && strlen($correo) > 0 && strlen($telefono) > 0
            && strlen($numCuenta) > 0 && strlen($tipoinstructor) > 0) {
            $tempTelefono = str_replace("-", "", $telefono);

            if (!is_numeric($nombre) && !is_numeric($apellido)) {
                if (filter_var($correo, FILTER_VALIDATE_EMAIL)){
                    $instructor = new Instructor($id, $nombre, $apellido, $correo, $tempTelefono, $numCuenta, $tipoinstructor, 1);
                    $instructorBusiness = new InstructorBusiness();
                    $resultado = $instructorBusiness->update($instructor);

                    if ($resultado == 1) {
                        Header("Location: ../view/listarInstructores.php?success=update");
                    } else {
                        Header("Location: ../view/listarInstructores.php?error=dbError");
                    }
                } else {
                    header("location: ../view/listarInstructores.php?error=emailError");
                }
            } else {
                header("location: ../view/listarInstructores.php?error=numberFormat");
            }
        } else {
            header("location: ../view/listarInstructores.php?error=emptyField");
        }
    } else {
        header("location: ../view/listarInstructores.php?error=error");
    }
}
